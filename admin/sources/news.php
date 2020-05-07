<?php	if(!defined('_source')) die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
$urldanhmuc ="";
$urldanhmuc.= (isset($_REQUEST['id_list'])) ? "&id_list=".addslashes($_REQUEST['id_list']) : "";
$urldanhmuc.= (isset($_REQUEST['id_cat'])) ? "&id_cat=".addslashes($_REQUEST['id_cat']) : "";
$urldanhmuc.= (isset($_REQUEST['id_item'])) ? "&id_item=".addslashes($_REQUEST['id_item']) : "";
$urldanhmuc.= (isset($_REQUEST['keyword'])) ? "&keyword=".addslashes($_REQUEST['keyword']) : "";

$id=$_REQUEST['id'];
$type=$_REQUEST['type'];

switch($act)
{
	/* Begin Man News Cấp Tin Tức */
	case "man":
		get_items();
		$template = "news/man/items";
		break;
	case "add":		
		$template = "news/man/item_add";
		break;
	case "edit":		
		get_item();
		$template = "news/man/item_add";
		break;
	case "save":
		save_item();
		break;
	case "delete":
		delete_item();
		break;
	/* End Man News Cấp Tin Tức */

	/* Begin Man News Cấp 1 */
	case "man_list":
		get_lists();
		$template = "news/list/lists";
		break;
	case "add_list":		
		$template = "news/list/list_add";
		break;
	case "edit_list":		
		get_list();
		$template = "news/list/list_add";
		break;
	case "save_list":
		save_list();
		break;
	case "delete_list":
		delete_list();
		break;
	/* End Man News Cấp 1 */

	/* Begin Man News Cấp 2 */
	case "man_cat":
		get_cats();
		$template = "news/cat/cats";
		break;
	case "add_cat":		
		$template = "news/cat/cat_add";
		break;
	case "edit_cat":		
		get_cat();
		$template = "news/cat/cat_add";
		break;
	case "save_cat":
		save_cat();
		break;
	case "delete_cat":
		delete_cat();
		break;
	/* End Man News Cấp 2 */

	/* Begin Man News Cấp 3 */
	case "man_item":
		get_loais();
		$template = "news/item/loais";
		break;
	case "add_item":		
		$template = "news/item/loai_add";
		break;
	case "edit_item":		
		get_loai();
		$template = "news/item/loai_add";
		break;
	case "save_item":
		save_loai();
		break;
	case "delete_item":
		delete_loai();
		break;
	/* End Man News Cấp 3 */
	
	/* Begin Man Photo News */
	case "man_photo":
		get_photos();
		$template = "news/photo/photos";
		break;
	case "add_photo":
		$template = "news/photo/photo_add";
		break;
	case "edit_photo":
		get_photo();
		$template = "news/photo/photo_edit";
		break;
	case "save_photo":
		save_photo();
		break;
	case "delete_photo":
		delete_photo();
		break;
	/* End Man Photo News */

	default:
		$template = "index";
}

function fns_Rand_digit($min,$max,$num)
{
	$result='';
	for($i=0;$i<$num;$i++){
		$result.=rand($min,$max);
	}
	return $result;	
}

/* Begin Man News Cấp Tin Tức */
function get_items()
{
	global $d, $items, $paging, $urldanhmuc;
	$type=$_REQUEST['type'];

	$sql = "select * from #_news where id<>0";	
	if((int)$_REQUEST['id_list']!='')
	{
	$sql.=" and id_list=".$_REQUEST['id_list']."";
	}
	if((int)$_REQUEST['id_cat']!='')
	{
	$sql.=" and	id_cat=".$_REQUEST['id_cat']."";
	}
	if((int)$_REQUEST['id_item']!='')
	{
	$sql.=" and	id_item=".$_REQUEST['id_item']."";
	}
	
	if($_REQUEST['keyword']!='')
	{
	$keyword=addslashes($_REQUEST['keyword']);
	$sql.=" and (tenvi LIKE '%$keyword%' or tenen LIKE '%$keyword%')";
	}
	$sql.=" and type='".$type."' order by stt,id desc";

	$d->query($sql);
	$items = $d->result_array();
	
	$curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
	$url="index.php?com=news&act=man".$urldanhmuc."&type=".$type."";
	$maxR=10;
	$maxP=10;
	$paging=paging($items, $url, $curPage, $maxR, $maxP);
	$items=$paging['source'];
}

function get_item()
{
	global $d, $item, $list_hinhanh;
	$type=$_REQUEST['type'];

	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", "index.php?com=news&act=man&type=".$type."");	
	$sql = "select * from #_news where id='".$id."' and type='".$type."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=news&act=man&type=".$type."");
	$item = $d->fetch_array();

	/* Lấy nhiều hình ảnh */
	$sql = "select * from #_news_hinhanh where id_photo='".$id."' and type='".$type."' and kind='man' and val='".$type."' order by id asc";
	$d->query($sql);
	$list_hinhanh = $d->result_array();	
}

function save_item()
{
	global $d,$config;

	$type=$_REQUEST['type'];
	$file_name=fns_Rand_digit(0,9,12);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=news&act=man&type=".$type."");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	
	/* Begin Post Dữ Liệu */
	foreach($config['lang'] as $key => $value) 
	{
		$data['ten'.$key] = magic_quote($_POST['ten'.$key]);
		$data['mota'.$key] = magic_quote($_POST['mota'.$key]);
		$data['noidung'.$key] = magic_quote($_POST['noidung'.$key]);
	}
    $data['id_list'] = (int)$_POST['id_list'];
	$data['id_cat'] = (int)$_POST['id_cat'];
	$data['id_item'] = (int)$_POST['id_item'];
	$data['tenkhongdau'] = changeTitle(magic_quote($_POST['tenvi']));
	$data['mau'] = magic_quote($_POST['mau']);
	$data['link_video'] = magic_quote($_POST['link_video']);
	$data['seo_h1'] = magic_quote($_POST['seo_h1']);
	$data['seo_h2'] = magic_quote($_POST['seo_h2']);
	$data['seo_h3'] = magic_quote($_POST['seo_h3']);
	$data['title'] = magic_quote($_POST['title']);
	$data['keywords'] = magic_quote($_POST['keywords']);
	$data['description'] = magic_quote($_POST['description']);
	$data['stt'] = $_POST['stt'];
	$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
	$data['type'] = $type;
	/* End Post Dữ Liệu */

	if($id)
	{
		if($photo = upload_image("file", $config['news'][$type]['img_type'], _upload_news,$file_name))
		{
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], $config['news'][$type]['thumb_width'], $config['news'][$type]['thumb_height'], _upload_news,$file_name,$config['news'][$type]['thumb_ratio']);			
			$d->setTable('news');
			$d->setWhere('id', $id);
			$d->setWhere('type', $type);
			$d->select();
			if($d->num_rows()>0)
			{
				$row = $d->fetch_array();
				delete_file(_upload_news.$row['photo']);				
				delete_file(_upload_news.$row['thumb']);				
			}
		}	
		
		if($taptin = upload_image("file_2", $config['news'][$type]['file_type'],_upload_file,$file_name."_2"))
		{
			$data['taptin'] = $taptin;			
			$d->setTable('news');
			$d->setWhere('id', $id);
			$d->setWhere('type', $type);
			$d->select();
			if($d->num_rows()>0)
			{
				$row = $d->fetch_array();
				delete_file(_upload_file.$row['taptin']);				
			}
		}

		/* Xử Lý Lưu Nhiều Hình Ảnh */
		if (isset($_FILES['files'])) 
		{
            $myFile = $_FILES['files'];
            $fileCount = count($myFile["name"]);
            $file_name=fns_Rand_digit(0,9,6);

            for($i = 0; $i < $fileCount; $i++) 
            {  
	            if(move_uploaded_file($myFile["tmp_name"][$i], _upload_news."/".$file_name."_".$myFile["name"][$i]))
	            {       							
					$data1['photo'] = $file_name."_".$myFile["name"][$i];
					$data1['thumb'] = create_thumb($data1['photo'], $config['news'][$type]['multipic_arr'][$type]['thumb_width_photo'], $config['news'][$type]['multipic_arr'][$type]['thumb_height_photo'], _upload_news, $file_name."_".$myFile["name"][$i],$config['news'][$type]['multipic_arr'][$type]['thumb_ratio_photo']);	
					$data1['stt'] = (int)$_POST['stt-multi-pic'][$i];		
					// $data1['tenvi'] = $_POST['ten-multi-pic'][$i];		
					$data1['id_photo'] = $id;
					$data1['type'] = $type;
					$data1['kind'] = 'man';
					$data1['val'] = $type;
					$data1['hienthi'] = 1;
					$d->setTable('news_hinhanh');
					$d->insert($data1);
	            }
            }
        }

		$data['ngaysua'] = time();

		$d->setTable('news');
		$d->setWhere('id', $id);
		$d->setWhere('type', $type);
		if($d->update($data))
		{
			/* Cập nhật TAGS GROUP */
			$sql = "delete from #_tags_group where id_pro = '".$id."'";
			$d->query($sql);
			
			if($_POST['tags_group'])
			{
				$idTeam = $_POST['tags_group'];
				for($i=0;$i<count($idTeam);$i++)
				{
					$tags_group['id_pro'] = $id;
					$tags_group['id_tags'] = $idTeam[$i];
					$tags_group['type'] = $type;
					$d->setTable('tags_group');
					$d->insert($tags_group);
				}
			}

			redirect("index.php?com=news&act=man&type=".$type."");
		}
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=news&act=man&type=".$type."");
	}
	else
	{
		if($photo = upload_image("file", $config['news'][$type]['img_type'], _upload_news,$file_name)){
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], $config['news'][$type]['thumb_width'], $config['news'][$type]['thumb_height'], _upload_news,$file_name,$config['news'][$type]['thumb_ratio']);				
		}
		if($taptin = upload_image("file_2", $config['news'][$type]['file_type'],_upload_file,$file_name."_2")){
			$data['taptin'] = $taptin;			
		}		

		$data['ngaytao'] = time();

		$d->setTable('news');
		if($d->insert($data))
		{
			/* Xử Lý Lưu Nhiều Hình Ảnh */
			$id_newest = mysql_insert_id();
			if (isset($_FILES['files'])) 
			{
	            $myFile = $_FILES['files'];
	            $fileCount = count($myFile["name"]);
	            $file_name=fns_Rand_digit(0,9,6);

	            for ($i = 0; $i < $fileCount; $i++) 
	            {  
		            if(move_uploaded_file($myFile["tmp_name"][$i], _upload_news."/".$file_name."_".$myFile["name"][$i]))
		            {       							
						$data1['photo'] = $file_name."_".$myFile["name"][$i];
						$data1['thumb'] = create_thumb($data1['photo'], $config['news'][$type]['multipic_arr'][$type]['thumb_width_photo'], $config['news'][$type]['multipic_arr'][$type]['thumb_height_photo'], _upload_news, $file_name."_".$myFile["name"][$i],$config['news'][$type]['multipic_arr'][$type]['thumb_ratio_photo']);
						$data1['stt'] = (int)$_POST['stt-multi-pic'][$i];		
						// $data1['tenvi'] = $_POST['ten-multi-pic'][$i];		
						$data1['id_photo'] = $id_newest;
						$data1['type'] = $type;
						$data1['kind'] = 'man';
						$data1['val'] = $type;
						$data1['hienthi'] = 1;
						$d->setTable('news_hinhanh');
						$d->insert($data1);
		            }
	            }
	        }	

	        /* Xử lý TAGS GROUP */
			if($_POST['tags_group']){
				$idTeam = $_POST['tags_group'];
				for($i=0;$i<count($idTeam);$i++){
					$tags_group['id_pro'] = $id_newest;
					$tags_group['id_tags'] = $idTeam[$i];
					$tags_group['type'] = $type;
					$d->setTable('tags_group');
					$d->insert($tags_group);
				}
			}
	        
			redirect("index.php?com=news&act=man&type=".$type."");
		}
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=news&act=man&type=".$type."");
	}
}

function delete_item()
{
	global $d;
	$type=$_REQUEST['type'];

	if(isset($_GET['id']))
	{
		$id =  themdau($_GET['id']);
		
		/* Xóa TAGS GROUP */
		$sql = "delete from #_tags_group where id_pro = '".$id."'";
		$d->query($sql);

		$d->reset();
		$sql = "select * from #_news where id='".$id."' and type='".$type."'";
		$d->query($sql);

		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_news.$row['photo']);
				delete_file(_upload_news.$row['thumb']);
				delete_file(_upload_file.$row['taptin']);
			}
			$sql = "delete from #_news where id='".$id."' and type='".$type."'";
			$d->query($sql);
		}
		
		if($d->query($sql))
		{
			/* Begin Xóa Nhiều Hình */
			$d->reset();
			$sql = "select * from #_news_hinhanh where id_photo='".$id."' and kind='man'";
			$d->query($sql);

			if($d->num_rows()>0)
			{
				while($row = $d->fetch_array()){
					delete_file(_upload_news.$row['photo']);
					delete_file(_upload_news.$row['thumb']);
					delete_file(_upload_file.$row['taptin']);
				}
				$sql = "delete from #_news_hinhanh where id_photo='".$id."' and kind='man'";
				$d->query($sql);
			}
			/* End Xóa Nhiều Hình */
			redirect("index.php?com=news&act=man&type=".$type."");
		}
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=news&act=man&type=".$type."");
	}
	elseif (isset($_GET['listid'])==true)
	{
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++)
		{
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		

			/* Xóa TAGS GROUP */
			$sql = "delete from #_tags_group where id_pro = '".$id."'";
			$d->query($sql);
			
			$d->reset();
			$sql = "select * from #_news where id='".$id."' and type='".$type."'";
			$d->query($sql);
			
			if($d->num_rows()>0)
			{
				while($row = $d->fetch_array())
				{
					delete_file(_upload_news.$row['photo']);
					delete_file(_upload_news.$row['thumb']);
					delete_file(_upload_file.$row['taptin']);
				}
				$sql = "delete from #_news where id='".$id."' and type='".$type."'";
				$d->query($sql);

				/* Begin Xóa Nhiều Hình */
				$d->reset();
				$sql = "select * from #_news_hinhanh where id_photo='".$id."' and kind='man'";
				$d->query($sql);

				if($d->num_rows()>0)
				{
					while($row = $d->fetch_array()){
						delete_file(_upload_news.$row['photo']);
						delete_file(_upload_news.$row['thumb']);
						delete_file(_upload_file.$row['taptin']);
					}
					$sql = "delete from #_news_hinhanh where id_photo='".$id."' and kind='man'";
					$d->query($sql);
				}
				/* End Xóa Nhiều Hình */
			}	
		} 
		redirect("index.php?com=news&act=man&type=".$type."");
	} 
	else transfer("Không nhận được dữ liệu", "index.php?com=news&act=man&type=".$type."");
}
/* End Man News Cấp Tin Tức */

/* Begin Man News Cấp 2 */
function get_cats()
{
	global $d, $items, $paging, $urldanhmuc;
	$type=$_REQUEST['type'];
	
	$sql = "select * from #_news_cat where id<>0";
		
	if((int)$_REQUEST['id_list']!='')
	{
	$sql.=" and id_list=".$_REQUEST['id_list']."";
	}

	if($_REQUEST['keyword']!='')
	{
	$keyword=addslashes($_REQUEST['keyword']);
	$sql.=" and (tenvi LIKE '%$keyword%' or tenen LIKE '%$keyword%')";
	}
	$sql.=" and type='".$type."' order by stt";
	
	$d->query($sql);
	$items = $d->result_array();
	
	$curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
	$url="index.php?com=news&act=man_cat".$urldanhmuc."&type=".$type."";
	$maxR=10;
	$maxP=10;
	$paging=paging($items, $url, $curPage, $maxR, $maxP);
	$items=$paging['source'];
}

function get_cat()
{
	global $d, $item;
	$type=$_REQUEST['type'];
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
	transfer("Không nhận được dữ liệu", "index.php?com=news&act=man_cat&type=".$type."");
	
	$sql = "select * from #_news_cat where id='".$id."' and type='".$type."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=news&act=man_cat&type=".$type."");
	$item = $d->fetch_array();
}

function save_cat()
{
	global $d,$config;
	$type=$_REQUEST['type'];
	$file_name=fns_Rand_digit(0,9,12);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=news&act=man_cat&type=".$type."");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";

	/* Begin Post Dữ Liệu */
	foreach($config['lang'] as $key => $value) 
	{
		$data['ten'.$key] = magic_quote($_POST['ten'.$key]);
		$data['mota'.$key] = magic_quote($_POST['mota'.$key]);
		$data['noidung'.$key] = magic_quote($_POST['noidung'.$key]);
	}
	$data['id_list'] = $_POST['id_list'];
	$data['tenkhongdau'] = changeTitle(magic_quote($_POST['tenvi']));
	$data['seo_h1'] = magic_quote($_POST['seo_h1']);
	$data['seo_h2'] = magic_quote($_POST['seo_h2']);
	$data['seo_h3'] = magic_quote($_POST['seo_h3']);
	$data['title'] = magic_quote($_POST['title']);
	$data['keywords'] = magic_quote($_POST['keywords']);
	$data['description'] = magic_quote($_POST['description']);
	$data['stt'] = $_POST['stt'];
	$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
	$data['type'] = $type;
	/* End Post Dữ Liệu */

	if($id)
	{		
		if($photo = upload_image("file", $config['news'][$type]['img_type_cat'], _upload_news,$file_name))
		{
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], $config['news'][$type]['thumb_width_cat'], $config['news'][$type]['thumb_height_cat'], _upload_news,$file_name,$config['news'][$type]['thumb_ratio_cat']);			
			$d->setTable('news_cat');
			$d->setWhere('id', $id);
			$d->setWhere('type', $type);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_news.$row['photo']);				
				delete_file(_upload_news.$row['thumb']);				
			}
		}

		$data['ngaysua'] = time();
		
		$d->setTable('news_cat');
		$d->setWhere('id', $id);
		$d->setWhere('type', $type);
		if($d->update($data)) redirect("index.php?com=news&act=man_cat&curPage=".$_REQUEST['curPage']."&type=".$type."");
		else transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=news&act=man_cat&type=".$type."");
	}
	else
	{		
		if($photo = upload_image("file", $config['news'][$type]['img_type_cat'], _upload_news,$file_name))
		{
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], $config['news'][$type]['thumb_width_cat'], $config['news'][$type]['thumb_height_cat'], _upload_news,$file_name,$config['news'][$type]['thumb_ratio_cat']);		
		}

		$data['ngaytao'] = time();
		
		$d->setTable('news_cat');
		if($d->insert($data)) redirect("index.php?com=news&act=man_cat&type=".$type."");
		else transfer("Lưu dữ liệu bị lỗi", "index.php?com=news&act=man_cat&type=".$type."");
	}
}

function delete_cat()
{
	global $d;
	$type=$_REQUEST['type'];
	if(isset($_GET['id']))
	{
		$id =  themdau($_GET['id']);		
		$d->reset();
		$sql = "select * from #_news_cat where id='".$id."' and type='".$type."'";
		$d->query($sql);

		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_news.$row['photo']);
				delete_file(_upload_news.$row['thumb']);
			}
			$sql = "delete from #_news_cat where id='".$id."' and type='".$type."'";
			$d->query($sql);
		}
		
		if($d->query($sql))
		{
			redirect("index.php?com=news&act=man_cat&type=".$type."");
		}
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=news&act=man_cat&type=".$type."");
	}
	elseif (isset($_GET['listid'])==true)
	{
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
		$sql = "select * from #_news_cat where id='".$id."' and type='".$type."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_news.$row['photo']);
				delete_file(_upload_news.$row['thumb']);
			}
			$sql = "delete from #_news_cat where id='".$id."' and type='".$type."'";
			$d->query($sql);
		}
			
		} redirect("index.php?com=news&act=man_cat&type=".$type."");
	}
	else transfer("Không nhận được dữ liệu", "index.php?com=news&act=man_cat&type=".$type."");
}
/* End Man News Cấp 2 */

/* Begin Man News Cấp 3 */
function get_loais()
{
	global $d, $items, $paging, $urldanhmuc;
	$type=$_REQUEST['type'];
	
	$sql = "select * from #_news_item where id<>0";
		
	if((int)$_REQUEST['id_list']!='')
	{
	$sql.=" and id_list=".$_REQUEST['id_list']."";
	}
	if((int)$_REQUEST['id_cat']!='')
	{
	$sql.=" and id_cat=".$_REQUEST['id_cat']."";
	}

	if($_REQUEST['keyword']!='')
	{
	$keyword=addslashes($_REQUEST['keyword']);
	$sql.=" and (tenvi LIKE '%$keyword%' or tenen LIKE '%$keyword%')";
	}
	$sql.=" and type='".$type."' order by stt";
	
	$d->query($sql);
	$items = $d->result_array();
	
	$curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
	$url="index.php?com=news&act=man_item".$urldanhmuc."&type=".$type."";
	$maxR=10;
	$maxP=10;
	$paging=paging($items, $url, $curPage, $maxR, $maxP);
	$items=$paging['source'];
}

function get_loai()
{
	global $d, $item;
	$type=$_REQUEST['type'];
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
	transfer("Không nhận được dữ liệu", "index.php?com=news&act=man_item&type=".$type."");
	
	$sql = "select * from #_news_item where id='".$id."' and type='".$type."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=news&act=man_item&type=".$type."");
	$item = $d->fetch_array();
}

function save_loai()
{
	global $d,$config;

	$type=$_REQUEST['type'];
	$file_name=fns_Rand_digit(0,9,12);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=news&act=man_item&type=".$type."");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";

	/* Begin Post Dữ Liệu */
	foreach($config['lang'] as $key => $value) 
	{
		$data['ten'.$key] = magic_quote($_POST['ten'.$key]);
		$data['mota'.$key] = magic_quote($_POST['mota'.$key]);
		$data['noidung'.$key] = magic_quote($_POST['noidung'.$key]);
	}
	$data['id_list'] = $_POST['id_list'];	
	$data['id_cat']= $_POST['id_cat'];
	$data['tenkhongdau'] = changeTitle(magic_quote($_POST['tenvi']));	
	$data['seo_h1'] = magic_quote($_POST['seo_h1']);
	$data['seo_h2'] = magic_quote($_POST['seo_h2']);
	$data['seo_h3'] = magic_quote($_POST['seo_h3']);
	$data['title'] = magic_quote($_POST['title']);
	$data['keywords'] = magic_quote($_POST['keywords']);
	$data['description'] = magic_quote($_POST['description']);
	$data['stt'] = $_POST['stt'];
	$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
	$data['type'] = $type;
	/* End Post Dữ Liệu */

	if($id)
	{
		if($photo = upload_image("file", $config['news'][$type]['img_type_item'], _upload_news,$file_name))
		{
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], $config['news'][$type]['thumb_width_item'], $config['news'][$type]['thumb_height_item'], _upload_news,$file_name,$config['news'][$type]['thumb_ratio_item']);		
			$d->setTable('news_item');
			$d->setWhere('id', $id);
			$d->setWhere('type', $type);
			$d->select();
			if($d->num_rows()>0)
			{
				$row = $d->fetch_array();
				delete_file(_upload_news.$row['photo']);				
				delete_file(_upload_news.$row['thumb']);				
			}
		}

		$data['ngaysua'] = time();
		
		$d->setTable('news_item');
		$d->setWhere('id', $id);
		$d->setWhere('type', $type);
		if($d->update($data)) redirect("index.php?com=news&act=man_item&curPage=".$_REQUEST['curPage']."&type=".$type."");
		else transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=news&act=man_item&type=".$type."");
	}
	else
	{	
		if($photo = upload_image("file", $config['news'][$type]['img_type_item'], _upload_news,$file_name))
		{
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], $config['news'][$type]['thumb_width_cat'], $config['news'][$type]['thumb_height_cat'], _upload_news,$file_name,$config['news'][$type]['thumb_ratio_cat']);		
		}	

		$data['ngaytao'] = time();
		
		$d->setTable('news_item');
		if($d->insert($data)) redirect("index.php?com=news&act=man_item&type=".$type."");
		else transfer("Lưu dữ liệu bị lỗi", "index.php?com=news&act=man_item&type=".$type."");
	}
}

function delete_loai()
{
	global $d;
	$type=$_REQUEST['type'];
	if(isset($_GET['id']))
	{
		$id =  themdau($_GET['id']);		
		$d->reset();
		$sql = "select * from #_news_item where id='".$id."' and type='".$type."'";
		$d->query($sql);

		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_news.$row['photo']);
				delete_file(_upload_news.$row['thumb']);
			}
			$sql = "delete from #_news_item where id='".$id."' and type='".$type."'";
			$d->query($sql);
		}
		
		if($d->query($sql))
		{
			redirect("index.php?com=news&act=man_item&type=".$type."");
		}
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=news&act=man_item&type=".$type."");
	}
	elseif (isset($_GET['listid'])==true)
	{
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
		$sql = "select * from #_news_item where id='".$id."' and type='".$type."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_news.$row['photo']);
				delete_file(_upload_news.$row['thumb']);
			}
			$sql = "delete from #_news_item where id='".$id."' and type='".$type."'";
			$d->query($sql);
		}
			
		} redirect("index.php?com=news&act=man_item&type=".$type."");
	}
	else transfer("Không nhận được dữ liệu", "index.php?com=news&act=man_item&type=".$type."");
}
/* End Man News Cấp 3 */

/* Begin Man News Cấp 1 */
function get_lists()
{
	global $d, $items, $paging;
	$type=$_REQUEST['type'];
	
	$sql = "select * from #_news_list where id<>0";	

	if($_REQUEST['keyword']!='')
	{
	$keyword=addslashes($_REQUEST['keyword']);
	$sql.=" and (tenvi LIKE '%$keyword%' or tenen LIKE '%$keyword%')";
	}		
	$sql.=" and type='".$type."' order by stt,id desc";
	
	$d->query($sql);
	$items = $d->result_array();
	
	$curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
	$url="index.php?com=news&act=man_list&type=".$type."";
	$maxR=10;
	$maxP=10;
	$paging=paging($items, $url, $curPage, $maxR, $maxP);
	$items=$paging['source'];
}

function get_list()
{
	global $d, $item, $list_hinhanh;
	$type=$_REQUEST['type'];
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
	transfer("Không nhận được dữ liệu", "index.php?com=news&act=man_list&type=".$type."");	
	$sql = "select * from #_news_list where id='".$id."' and type='".$type."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=news&act=man_list&type=".$type."");
	$item = $d->fetch_array();	

	/* Lấy nhiều hình ảnh */
	$sql = "select * from #_news_hinhanh where id_photo='".$id."' and type='".$type."' and kind='man_list' and val='".$type."' order by id asc";
	$d->query($sql);
	$list_hinhanh = $d->result_array();	
}

function save_list()
{
	global $d,$config;

	$type=$_REQUEST['type'];
	$file_name=fns_Rand_digit(0,9,12);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=news&act=man_list&type=".$type."");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";

	/* Begin Post Dữ Liệu */
	foreach($config['lang'] as $key => $value) 
	{
		$data['ten'.$key] = magic_quote($_POST['ten'.$key]);
		$data['mota'.$key] = magic_quote($_POST['mota'.$key]);
		$data['noidung'.$key] = magic_quote($_POST['noidung'.$key]);
	}
	$data['tenkhongdau'] = changeTitle(magic_quote($_POST['tenvi']));
	$data['mau'] = magic_quote($_POST['mau']);
	$data['seo_h1'] = magic_quote($_POST['seo_h1']);
	$data['seo_h2'] = magic_quote($_POST['seo_h2']);
	$data['seo_h3'] = magic_quote($_POST['seo_h3']);
	$data['title'] = magic_quote($_POST['title']);
	$data['keywords'] = magic_quote($_POST['keywords']);
	$data['description'] = magic_quote($_POST['description']);
	$data['stt'] = $_POST['stt'];
	$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
	$data['type'] = $type;
	/* End Post Dữ Liệu */

	if($id)
	{					
		if($photo = upload_image("file", $config['news'][$type]['img_type_list'], _upload_news,$file_name))
		{
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], $config['news'][$type]['thumb_width_list'], $config['news'][$type]['thumb_height_list'], _upload_news,$file_name,$config['news'][$type]['thumb_ratio_list']);
			$d->setTable('news_list');
			$d->setWhere('id', $id);
			$d->setWhere('type', $type);
			$d->select();
			if($d->num_rows()>0)
			{
				$row = $d->fetch_array();
				delete_file(_upload_news.$row['photo']);					
				delete_file(_upload_news.$row['thumb']);					
			}
		}		

		/* Xử Lý Lưu Nhiều Hình Ảnh */
		if (isset($_FILES['files'])) 
		{
            $myFile = $_FILES['files'];
            $fileCount = count($myFile["name"]);
            $file_name=fns_Rand_digit(0,9,6);

            for ($i = 0; $i < $fileCount; $i++) 
            {  
	            if(move_uploaded_file($myFile["tmp_name"][$i], _upload_news."/".$file_name."_".$myFile["name"][$i]))
	            {       							
					$data1['photo'] = $file_name."_".$myFile["name"][$i];
					$data1['thumb'] = create_thumb($data1['photo'], $config['news'][$type]['multipic_list_arr'][$type]['thumb_width_photo'], $config['news'][$type]['multipic_list_arr'][$type]['thumb_height_photo'], _upload_news, $file_name."_".$myFile["name"][$i],$config['news'][$type]['multipic_list_arr'][$type]['thumb_ratio_photo']);	
					$data1['stt'] = (int)$_POST['stt-multi-pic'][$i];		
					// $data1['tenvi'] = $_POST['ten-multi-pic'][$i];		
					$data1['id_photo'] = $id;
					$data1['type'] = $type;
					$data1['kind'] = 'man_list';
					$data1['val'] = $type;
					$data1['hienthi'] = 1;
					$d->setTable('news_hinhanh');
					$d->insert($data1);
	            }
            }
        }	

		$data['ngaysua'] = time();
		
		$d->setTable('news_list');
		$d->setWhere('id', $id);
		$d->setWhere('type', $type);
		if($d->update($data)) redirect("index.php?com=news&act=man_list&curPage=".$_REQUEST['curPage']."&type=".$type."");
		else transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=news&act=man_list&type=".$type."");
	}
	else
	{				
		if($photo = upload_image("file", $config['news'][$type]['img_type_list'], _upload_news,$file_name))
		{
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], $config['news'][$type]['thumb_width_list'], $config['news'][$type]['thumb_height_list'], _upload_news,$file_name,$config['news'][$type]['thumb_ratio_list']);			
		}
		
		$data['ngaytao'] = time();
		
		$d->setTable('news_list');
		if($d->insert($data))
		{
			/* Xử Lý Lưu Nhiều Hình Ảnh */
			$id_newest = mysql_insert_id();
			if (isset($_FILES['files'])) 
			{
	            $myFile = $_FILES['files'];
	            $fileCount = count($myFile["name"]);
	            $file_name=fns_Rand_digit(0,9,6);

	            for ($i = 0; $i < $fileCount; $i++) 
	            {  
		            if(move_uploaded_file($myFile["tmp_name"][$i], _upload_news."/".$file_name."_".$myFile["name"][$i]))
		            {       							
						$data1['photo'] = $file_name."_".$myFile["name"][$i];
						$data1['thumb'] = create_thumb($data1['photo'], $config['news'][$type]['multipic_list_arr'][$type]['thumb_width_photo'], $config['news'][$type]['multipic_list_arr'][$type]['thumb_height_photo'], _upload_news, $file_name."_".$myFile["name"][$i],$config['news'][$type]['multipic_list_arr'][$type]['thumb_ratio_photo']);	
						$data1['stt'] = (int)$_POST['stt-multi-pic'][$i];		
						// $data1['tenvi'] = $_POST['ten-multi-pic'][$i];		
						$data1['id_photo'] = $id_newest;
						$data1['type'] = $type;
						$data1['kind'] = 'man_list';
						$data1['val'] = $type;
						$data1['hienthi'] = 1;
						$d->setTable('news_hinhanh');
						$d->insert($data1);
		            }
	            }
	        }
			redirect("index.php?com=news&act=man_list&type=".$type."");
		}
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=news&act=man_list&type=".$type."");
	}
}

function delete_list()
{
	global $d;
	$type=$_REQUEST['type'];
	if(isset($_GET['id']))
	{
		$id =  themdau($_GET['id']);		
		$d->reset();
		$sql = "select * from #_news_list where id='".$id."' and type='".$type."'";
		$d->query($sql);

		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_news.$row['photo']);
				delete_file(_upload_news.$row['thumb']);
			}
			$sql = "delete from #_news_list where id='".$id."' and type='".$type."'";
			$d->query($sql);
		}
	
		if($d->query($sql))
		{
			/* Begin Xóa Nhiều Hình */
			$d->reset();
			$sql = "select * from #_news_hinhanh where id_photo='".$id."' and kind='man_list'";
			$d->query($sql);

			if($d->num_rows()>0)
			{
				while($row = $d->fetch_array())
				{
					delete_file(_upload_news.$row['photo']);
					delete_file(_upload_news.$row['thumb']);
				}
				$sql = "delete from #_news_hinhanh where id_photo='".$id."' and kind='man_list'";
				$d->query($sql);
			}
			/* End Xóa Nhiều Hình */
			redirect("index.php?com=news&act=man_list&type=".$type."");
		}
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=news&act=man_list&type=".$type."");
	}
	elseif (isset($_GET['listid'])==true)
	{
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
		$sql = "select * from #_news_list where id='".$id."' and type='".$type."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_news.$row['photo']);
				delete_file(_upload_news.$row['thumb']);
			}
			$sql = "delete from #_news_list where id='".$id."' and type='".$type."'";
			$d->query($sql);

			/* Begin Xóa Nhiều Hình */
			$d->reset();
			$sql = "select * from #_news_hinhanh where id_photo='".$id."' and kind='man_list'";
			$d->query($sql);

			if($d->num_rows()>0)
			{
				while($row = $d->fetch_array())
				{
					delete_file(_upload_news.$row['photo']);
					delete_file(_upload_news.$row['thumb']);
				}
				$sql = "delete from #_news_hinhanh where id_photo='".$id."' and kind='man_list'";
				$d->query($sql);
			}
			/* End Xóa Nhiều Hình */
		}
			
		} redirect("index.php?com=news&act=man_list&type=".$type."");
	}
	else transfer("Không nhận được dữ liệu", "index.php?com=news&act=man_list&type=".$type."");
}
/* End Man News Cấp 1 */

/* Begin Man Photo News */
function get_photos()
{
	global $d, $items, $paging;	
	$type=$_REQUEST['type'];
	$kind=$_REQUEST['kind'];
	$val=$_REQUEST['val'];
	
	$sql = "select * from #_news_hinhanh where ( id_photo = '".$_REQUEST['idc']."' OR '".$_REQUEST['idc']."'=0  ) and type='".$type."' and kind='".$kind."' and val='".$val."' order by stt,id desc ";			
	$d->query($sql);
	$items = $d->result_array();
	
	$curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
	$url="index.php?com=news&act=man_photo&idc=".$_REQUEST['idc']."&type=".$type."&kind=".$kind."&val=".$val."";
	$maxR=10;
	$maxP=10;
	$paging=paging($items, $url, $curPage, $maxR, $maxP);
	$items=$paging['source'];
}

function get_photo()
{
	global $d, $item, $list_cat;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	$type = $_REQUEST['type'];
	$kind = $_REQUEST['kind'];
	$val = $_REQUEST['val'];

	if(!$id)
		transfer("Không nhận được dữ liệu", "index.php?com=news&act=man_photo&idc=".$_REQUEST['idc']."&type=".$type."&kind=".$kind."&val=".$val."");
	
	$d->setTable('news_hinhanh');
	$d->setWhere('type', $type);
	$d->setWhere('kind', $kind);
	$d->setWhere('val', $val);
	$d->setWhere('id', $id);
	$d->select();
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=news&act=man_photo&idc=".$_REQUEST['idc']."&type=".$type."&kind=".$kind."&val=".$val."");
	$item = $d->fetch_array();
	$d->reset();
}

function save_photo()
{
	global $d,$config;

	$type = $_REQUEST['type'];
	$kind = $_REQUEST['kind'];
	$define_str_arr=($kind=='man_list')?'multipic_list_arr':'multipic_arr';
	$val = $_REQUEST['val'];
	$file_name=fns_Rand_digit(0,9,10);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=news&act=man_photo&idc=".$_REQUEST['idc']."&type=".$type."&kind=".$kind."&val=".$val."");
	
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";

	if($id)
	{
		if($photo = upload_image("file", $config['news'][$type][$define_str_arr][$val]['img_type_photo'], _upload_news,$file_name))
		{
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], $config['news'][$type][$define_str_arr][$val]['thumb_width_photo'], $config['news'][$type][$define_str_arr][$val]['thumb_height_photo'], _upload_news,$file_name,$config['news'][$type][$define_str_arr][$val]['thumb_ratio_photo']);
			$d->setTable('news_hinhanh');
			$d->setWhere('id', $id);
			$d->setWhere('type', $type);
			$d->setWhere('kind', $kind);
			$d->select();
			if($d->num_rows()>0)
			{
				$row = $d->fetch_array();
				delete_file(_upload_news.$row['photo']);				
				delete_file(_upload_news.$row['thumb']);				
			}
		}

		if($taptin = upload_image("file2", $config['news'][$type][$define_str_arr][$val]['file_type_photo'],_upload_file,$file_name."_taptin"))
		{
			$data['taptin'] = $taptin;			
			$d->setTable('news_hinhanh');
			$d->setWhere('id', $id);
			$d->setWhere('type', $type);
			$d->setWhere('kind', $kind);
			$d->select();
			if($d->num_rows()>0)
			{
				$row = $d->fetch_array();
				delete_file(_upload_file.$row['taptin']);				
			}
		}
		
		foreach($config['lang'] as $key => $value) 
		{
			$data['ten'.$key] = magic_quote($_POST['ten'.$key]);
			$data['mota'.$key] = magic_quote($_POST['mota'.$key]);
			$data['noidung'.$key] = magic_quote($_POST['noidung'.$key]);
		}
		$data['tenkhongdau'] = changeTitle(magic_quote($_POST['tenvi']));
		$data['mau'] = magic_quote($_POST['mau']);
		$data['link'] = magic_quote($_POST['link']);
		$data['link_video'] = magic_quote($_POST['link_video']);
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;

		$d->reset();
		$d->setTable('news_hinhanh');
		$d->setWhere('id', $id);
		$d->setWhere('type', $type);
		$d->setWhere('kind', $kind);
		$d->setWhere('val', $val);
		if(!$d->update($data)) transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=news&act=man_photo&idc=".$_REQUEST['idc']."&type=".$type."&kind=".$kind."&val=".$val."");
		redirect("index.php?com=news&act=man_photo&idc=".$_REQUEST['idc']."&type=".$type."&kind=".$kind."&val=".$val."");
	}
	{
		for($i=0; $i<5; $i++)
		{
			foreach($config['lang'] as $key => $value) 
			{
				$data['ten'.$key] = magic_quote($_POST['ten'.$key.$i]);
				$data['mota'.$key] = magic_quote($_POST['mota'.$key.$i]);
				$data['noidung'.$key] = magic_quote($_POST['noidung'.$key.$i]);
			}
			$data['tenkhongdau'] = changeTitle(magic_quote($_POST['tenvi'.$i]));
			$data['mau'] = magic_quote($_POST['mau'.$i]);
			$data['link'] = magic_quote($_POST['link'.$i]);
			$data['link_video'] = magic_quote($_POST['link_video'.$i]);
			$data['stt'] = $_POST['stt'.$i];
			$data['hienthi'] = isset($_POST['hienthi'.$i]) ? 1 : 0;
			$data['type'] = $type;
			$data['kind'] = $kind;
			$data['val'] = $val;
			$data['id_photo'] = $_REQUEST['idc'];

			if($config['news'][$type][$define_str_arr][$val]['file_photo']=='true')
			{
				if($taptin = upload_image("file2".$i, $config['news'][$type][$define_str_arr][$val]['file_type_photo'],_upload_file,$file_name."_taptin".$i)){
					$data['taptin'] = $taptin;		
				}
			}

			if($config['news'][$type][$define_str_arr][$val]['images_photo']=='true')
			{
				if($photo = upload_image("file".$i, $config['news'][$type][$define_str_arr][$val]['img_type_photo'], _upload_news,$file_name.$i))
				{
					$data['photo'] = $photo;
					$data['thumb'] = create_thumb($data['photo'], $config['news'][$type][$define_str_arr][$val]['thumb_width_photo'], $config['news'][$type][$define_str_arr][$val]['thumb_height_photo'], _upload_news,$file_name.$i,$config['news'][$type][$define_str_arr][$val]['thumb_ratio_photo']);

					$d->setTable('news_hinhanh');
					if(!$d->insert($data)) transfer("Lưu dữ liệu bị lỗi", "index.php?com=news&act=man_photo&idc=".$_REQUEST['idc']."&type=".$type."&kind=".$kind."&val=".$val."");
				}
			}
			else
			{
				if($data['tenvi']!='' || $data['mau']!='' || $data['link']!='' || $data['link_video']!='')
				{		
					$d->setTable('news_hinhanh');
					if(!$d->insert($data)) transfer("Lưu dữ liệu bị lỗi", "index.php?com=news&act=man_photo&idc=".$_REQUEST['idc']."&type=".$type."&kind=".$kind."&val=".$val."");
				}
			}
		}
		redirect("index.php?com=news&act=man_photo&idc=".$_REQUEST['idc']."&type=".$type."&kind=".$kind."&val=".$val."");
	}
}

function delete_photo()
{
	global $d;
	$type=$_REQUEST['type'];
	$kind=$_REQUEST['kind'];
	$val=$_REQUEST['val'];
	
	if(isset($_GET['id']))
	{
		$id=themdau($_GET['id']);

		$d->setTable('news_hinhanh');
		$d->setWhere('id', $id);
		$d->setWhere('type', $type);
		$d->setWhere('kind', $kind);
		$d->setWhere('val', $val);
		$d->select();
		if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=news&act=man_photo&idc=".$_REQUEST['idc']."&type=".$type."&kind=".$kind."&val=".$val."");
		$row = $d->fetch_array();
			delete_file(_upload_news.$row['photo']);		
			delete_file(_upload_news.$row['thumb']);		
			delete_file(_upload_file.$row['taptin']);		
		if($d->delete())
			redirect("index.php?com=news&act=man_photo&idc=".$_REQUEST['idc']."&type=".$type."&kind=".$kind."&val=".$val."");
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=news&act=man_photo&idc=".$_REQUEST['idc']."&type=".$type."&kind=".$kind."&val=".$val."");
	}
	elseif (isset($_GET['listid'])==true)
	{
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
		$sql = "select * from #_news_hinhanh where id='".$id."' and type='".$type."' and kind='".$kind."' and val='".$val."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_news.$row['photo']);
				delete_file(_upload_news.$row['thumb']);
				delete_file(_upload_file.$row['taptin']);
			}
			$sql = "delete from #_news_hinhanh where id='".$id."' and type='".$type."' and kind='".$kind."' and val='".$val."'";
			$d->query($sql);
		}
			
		} redirect("index.php?com=news&act=man_photo&idc=".$_REQUEST['idc']."&type=".$type."&kind=".$kind."&val=".$val."");
	}
	else transfer("Không nhận được dữ liệu", "index.php?com=news&act=man_photo&idc=".$_REQUEST['idc']."&type=".$type."&kind=".$kind."&val=".$val."");
}
/* End Man Photo News */

?>