<?php	if(!defined('_source')) die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";

$id=$_REQUEST['id'];
$type=$_REQUEST['type'];

switch($act)
{
	/* Begin Man Album */
	case "man":
		get_items();
		$template = "album/man/items";
		break;
	case "add":		
		$template = "album/man/item_add";
		break;
	case "edit":		
		get_item();
		$template = "album/man/item_add";
		break;
	case "save":
		save_item();
		break;
	case "delete":
		delete_item();
		break;
	/* End Man Album */
	
	/* Begin Man Photo Album */
	case "man_photo":
		get_photos();
		$template = "album/photo/photos";
		break;
	case "add_photo":
		$template = "album/photo/photo_add";
		break;
	case "edit_photo":
		get_photo();
		$template = "album/photo/photo_edit";
		break;
	case "save_photo":
		save_photo();
		break;
	case "delete_photo":
		delete_photo();
		break;
	/* End Man Photo Album */

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

/* Begin Man Album */
function get_items()
{
	global $d, $items, $paging,$urldanhmuc;
	$type=$_REQUEST['type'];

	$sql = "select * from #_album where id<>0";	
	
	if($_REQUEST['keyword']!='')
	{
	$keyword=addslashes($_REQUEST['keyword']);
	$sql.=" and (tenvi LIKE '%$keyword%' or tenen LIKE '%$keyword%')";
	}
	$sql.=" and type='".$type."' order by stt,id desc";

	$d->query($sql);
	$items = $d->result_array();
	
	$curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
	$url="index.php?com=album&act=man".$urldanhmuc."&type=".$type."";
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
		transfer("Không nhận được dữ liệu", "index.php?com=album&act=man&type=".$type."");	
	$sql = "select * from #_album where id='".$id."' and type='".$type."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=album&act=man&type=".$type."");
	$item = $d->fetch_array();	

	/* Lấy nhiều hình ảnh */
	$sql = "select * from #_album_hinhanh where id_photo='".$id."' and type='".$type."' order by id asc";
	$d->query($sql);
	$list_hinhanh = $d->result_array();
}

function save_item()
{
	global $d,$config;

	$type=$_REQUEST['type'];
	$file_name=fns_Rand_digit(0,9,12);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=album&act=man&type=".$type."");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	
	/* Begin Post Dữ Liệu */
	foreach($config['lang'] as $key => $value) 
	{
		$data['ten'.$key] = magic_quote($_POST['ten'.$key]);
		$data['mota'.$key] = magic_quote($_POST['mota'.$key]);
		$data['noidung'.$key] = magic_quote($_POST['noidung'.$key]);
	}
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
		if($photo = upload_image("file", $config['album'][$type]['img_type'], _upload_photo,$file_name))
		{
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], $config['album'][$type]['thumb_width'], $config['album'][$type]['thumb_height'], _upload_photo,$file_name,$config['album'][$type]['thumb_ratio']);
			$d->setTable('album');
			$d->setWhere('id', $id);
			$d->setWhere('type', $type);
			$d->select();
			if($d->num_rows()>0)
			{
				$row = $d->fetch_array();
				delete_file(_upload_photo.$row['photo']);				
				delete_file(_upload_photo.$row['thumb']);				
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
	            if(move_uploaded_file($myFile["tmp_name"][$i], _upload_photo."/".$file_name."_".$myFile["name"][$i]))
	            {       							
					$data1['photo'] = $file_name."_".$myFile["name"][$i];
					$data1['thumb'] = create_thumb($data1['photo'], $config['album'][$type]['thumb_width_photo'], $config['album'][$type]['thumb_height_photo'], _upload_photo, $file_name."_".$myFile["name"][$i],$config['album'][$type]['thumb_ratio_photo']);
					$data1['stt'] = (int)$_POST['stt-multi-pic'][$i];		
					// $data1['tenvi'] = $_POST['ten-multi-pic'][$i];	
					$data1['id_photo'] = $id;
					$data1['type'] = $type;
					$data1['hienthi'] = 1;
					$d->setTable('album_hinhanh');
					$d->insert($data1);
	            }
            }
        }				 			
		
		$data['ngaysua'] = time();

		$d->setTable('album');
		$d->setWhere('id', $id);
		$d->setWhere('type', $type);
		if($d->update($data)) redirect("index.php?com=album&act=man&type=".$type."");
		else transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=album&act=man&type=".$type."");
	}
	else
	{
		if($photo = upload_image("file", $config['album'][$type]['img_type'], _upload_photo,$file_name))
		{
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], $config['album'][$type]['thumb_width'], $config['album'][$type]['thumb_height'], _upload_photo,$file_name,$config['album'][$type]['thumb_ratio']);
		}					

		$data['ngaytao'] = time();

		$d->setTable('album');
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
		            if(move_uploaded_file($myFile["tmp_name"][$i], _upload_photo."/".$file_name."_".$myFile["name"][$i]))
		            {       							
						$data1['photo'] = $file_name."_".$myFile["name"][$i];
						$data1['thumb'] = create_thumb($data1['photo'], $config['album'][$type]['thumb_width_photo'], $config['album'][$type]['thumb_height_photo'], _upload_photo, $file_name."_".$myFile["name"][$i],$config['album'][$type]['thumb_ratio_photo']);	
						$data1['stt'] = (int)$_POST['stt-multi-pic'][$i];		
						// $data1['tenvi'] = $_POST['ten-multi-pic'][$i];
						$data1['id_photo'] = $id_newest;
						$data1['type'] = $type;
						$data1['hienthi'] = 1;
						$d->setTable('album_hinhanh');
						$d->insert($data1);
		            }
	            }
	        }
			redirect("index.php?com=album&act=man&type=".$type."");
		}
		else transfer("Lưu dữ liệu bị lỗi", "index.php?com=album&act=man&type=".$type."");
	}
}

function delete_item()
{
	global $d;
	$type=$_REQUEST['type'];

	if(isset($_GET['id']))
	{
		$id = themdau($_GET['id']);
		
		$d->reset();
		$sql = "select * from #_album where id='".$id."' and type='".$type."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_photo.$row['photo']);
				delete_file(_upload_photo.$row['thumb']);
			}
			$sql = "delete from #_album where id='".$id."' and type='".$type."'";
			$d->query($sql);
		}
		
		if($d->query($sql))
		{
			/* Begin Xóa Nhiều Hình */
			$d->reset();
			$sql = "select * from #_album_hinhanh where id_photo='".$id."'";
			$d->query($sql);

			if($d->num_rows()>0)
			{
				while($row = $d->fetch_array()){
					delete_file(_upload_photo.$row['photo']);
					delete_file(_upload_photo.$row['thumb']);
				}
				$sql = "delete from #_album_hinhanh where id_photo='".$id."'";
				$d->query($sql);
			}
			/* End Xóa Nhiều Hình */
			redirect("index.php?com=album&act=man&type=".$type."");
		}
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=album&act=man&type=".$type."");
	}
	elseif (isset($_GET['listid'])==true)
	{
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
		$sql = "select * from #_album where id='".$id."' and type='".$type."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_photo.$row['photo']);
				delete_file(_upload_photo.$row['thumb']);
			}
			$sql = "delete from #_album where id='".$id."' and type='".$type."'";
			$d->query($sql);

			/* Begin Xóa Nhiều Hình */
			$d->reset();
			$sql = "select * from #_album_hinhanh where id_photo='".$id."'";
			$d->query($sql);

			if($d->num_rows()>0)
			{
				while($row = $d->fetch_array()){
					delete_file(_upload_photo.$row['photo']);
					delete_file(_upload_photo.$row['thumb']);
				}
				$sql = "delete from #_album_hinhanh where id_photo='".$id."'";
				$d->query($sql);
			}
			/* End Xóa Nhiều Hình */
		}
			
		} redirect("index.php?com=album&act=man&type=".$type."");
	} 
	else transfer("Không nhận được dữ liệu", "index.php?com=album&act=man&type=".$type."");
}
/* End Man Album */

/* Begin Man Photo Album */
function get_photos()
{
	global $d, $items, $paging;	
	$type=$_REQUEST['type'];
	
	$sql = "select * from #_album_hinhanh where ( id_photo = '".$_REQUEST['idc']."' OR '".$_REQUEST['idc']."'=0  ) and type='".$type."' order by stt,id desc ";			
	$d->query($sql);
	$items = $d->result_array();
	
	$curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
	$url="index.php?com=album&act=man_photo&idc=".$_REQUEST['idc']."&type=".$type."";
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

	if(!$id) transfer("Không nhận được dữ liệu", "index.php?com=album&act=man_photo&idc=".$_REQUEST['idc']."&type=".$type."");
	
	$d->setTable('album_hinhanh');
	$d->setWhere('type', $type);
	$d->setWhere('id', $id);
	$d->select();
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=album&act=man_photo&idc=".$_REQUEST['idc']."&type=".$type."");
	$item = $d->fetch_array();
	$d->reset();
}

function save_photo()
{
	global $d,$config;

	$type = $_REQUEST['type'];
	$file_name=fns_Rand_digit(0,9,10);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=album&act=man_photo&idc=".$_REQUEST['idc']."&type=".$type."");
	
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";

	if($id)
	{
		if($photo = upload_image("file", $config['album'][$type]['img_type_photo'], _upload_photo,$file_name))
		{
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], $config['album'][$type]['thumb_width_photo'], $config['album'][$type]['thumb_height_photo'], _upload_photo,$file_name,$config['album'][$type]['thumb_ratio_photo']);
			$d->setTable('album_hinhanh');
			$d->setWhere('id', $id);
			$d->setWhere('type', $type);
			$d->select();
			if($d->num_rows()>0)
			{
				$row = $d->fetch_array();
				delete_file(_upload_photo.$row['photo']);				
				delete_file(_upload_photo.$row['thumb']);				
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
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;

		$d->reset();
		$d->setTable('album_hinhanh');
		$d->setWhere('id', $id);
		$d->setWhere('type', $type);
		if(!$d->update($data)) transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=album&act=man_photo&idc=".$_REQUEST['idc']."&type=".$type."");
		redirect("index.php?com=album&act=man_photo&idc=".$_REQUEST['idc']."&type=".$type."");
	}
	else
	{
		for($i=0; $i<5; $i++)
		{
			if($photo = upload_image("file".$i, $config['album'][$type]['img_type_photo'], _upload_photo,$file_name.$i))
			{
				$data['photo'] = $photo;
				$data['thumb'] = create_thumb($data['photo'], $config['album'][$type]['thumb_width_photo'], $config['album'][$type]['thumb_height_photo'], _upload_photo,$file_name.$i,$config['album'][$type]['thumb_ratio_photo']);
				
				foreach($config['lang'] as $key => $value) 
				{
					$data['ten'.$key] = magic_quote($_POST['ten'.$key.$i]);
					$data['mota'.$key] = magic_quote($_POST['mota'.$key.$i]);
					$data['noidung'.$key] = magic_quote($_POST['noidung'.$key.$i]);
				}
				$data['tenkhongdau'] = changeTitle(magic_quote($_POST['tenvi'.$i]));
				$data['mau'] = magic_quote($_POST['mau'.$i]);
				$data['stt'] = $_POST['stt'.$i];
				$data['hienthi'] = isset($_POST['hienthi'.$i]) ? 1 : 0;
				$data['type'] = $type;
				$data['id_photo'] = $_REQUEST['idc'];
				
				$d->setTable('album_hinhanh');
				if(!$d->insert($data)) transfer("Lưu dữ liệu bị lỗi", "index.php?com=album&act=man_photo&idc=".$_REQUEST['idc']."&type=".$type."");
			}
		}
		redirect("index.php?com=album&act=man_photo&idc=".$_REQUEST['idc']."&type=".$type."");
	}
}

function delete_photo()
{
	global $d;
	$type=$_REQUEST['type'];
	
	if(isset($_GET['id']))
	{
		$id=themdau($_GET['id']);

		$d->setTable('album_hinhanh');
		$d->setWhere('id', $id);
		$d->setWhere('type', $type);
		$d->select();
		if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=album&act=man_photo&idc=".$_REQUEST['idc']."&type=".$type."");
		$row = $d->fetch_array();
			delete_file(_upload_photo.$row['photo']);		
			delete_file(_upload_photo.$row['thumb']);		
		if($d->delete())
			redirect("index.php?com=album&act=man_photo&idc=".$_REQUEST['idc']."&type=".$type."");
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=album&act=man_photo&idc=".$_REQUEST['idc']."&type=".$type."");
	}
	elseif (isset($_GET['listid'])==true)
	{
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
		$sql = "select * from #_album_hinhanh where id='".$id."' and type='".$type."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_photo.$row['photo']);
				delete_file(_upload_photo.$row['thumb']);
			}
			$sql = "delete from #_album_hinhanh where id='".$id."' and type='".$type."'";
			$d->query($sql);
		}
			
		} redirect("index.php?com=album&act=man_photo&idc=".$_REQUEST['idc']."&type=".$type."");
	}
	else transfer("Không nhận được dữ liệu", "index.php?com=album&act=man_photo&idc=".$_REQUEST['idc']."&type=".$type."");
}
/* End Man Photo Album */

?>