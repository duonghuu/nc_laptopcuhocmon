<?php	if(!defined('_source')) die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
$urldanhmuc ="";
$urldanhmuc.= (isset($_REQUEST['id_list'])) ? "&id_list=".addslashes($_REQUEST['id_list']) : "";
$urldanhmuc.= (isset($_REQUEST['id_cat'])) ? "&id_cat=".addslashes($_REQUEST['id_cat']) : "";
$urldanhmuc.= (isset($_REQUEST['id_item'])) ? "&id_item=".addslashes($_REQUEST['id_item']) : "";
$urldanhmuc.= (isset($_REQUEST['id_capbon'])) ? "&id_capbon=".addslashes($_REQUEST['id_capbon']) : "";
$urldanhmuc.= (isset($_REQUEST['id_nhanhieu'])) ? "&id_nhanhieu=".addslashes($_REQUEST['id_nhanhieu']) : "";
$urldanhmuc.= (isset($_REQUEST['keyword'])) ? "&keyword=".addslashes($_REQUEST['keyword']) : "";

$id=$_REQUEST['id'];
$type=$_REQUEST['type'];

/* Define mảng multipic: list, cat, item, man */
$define_str_arr=($_REQUEST['kind']=='man_list')?'multipic_list_arr':'multipic_arr';

switch($act)
{
	/* Begin Man Pro Cấp Sản Phẩm */
	case "man":
		get_items();
		$template = "product/man/items";
		break;
	case "add":		
		$template = "product/man/item_add";
		break;
	case "edit":		
		get_item();
		$template = "product/man/item_add";
		break;
	case "save":
		save_item();
		break;
	case "delete":
		delete_item();
		break;
	/* End Man Pro Cấp Sản Phẩm */

	/* Begin Man Pro Size */
	case "man_size":
		get_items_size();
		$template = "product/size/items";
		break;
	case "add_size":		
		$template = "product/size/item_add";
		break;
	case "edit_size":		
		get_item_size();
		$template = "product/size/item_add";
		break;
	case "save_size":
		save_item_size();
		break;
	case "delete_size":
		delete_item_size();
		break;
	/* End Man Pro Size */

	/* Begin Man Pro Màu */
	case "man_mau":
		get_items_mau();
		$template = "product/mau/items";
		break;
	case "add_mau":		
		$template = "product/mau/item_add";
		break;
	case "edit_mau":		
		get_item_mau();
		$template = "product/mau/item_add";
		break;
	case "save_mau":
		save_item_mau();
		break;
	case "delete_mau":
		delete_item_mau();
		break;
	/* End Man Pro Màu */

	/* Begin Man Pro Nhãn Hiệu */
	case "man_nhanhieu":
		get_nhanhieus();
		$template = "product/nhanhieu/nhanhieu";
		break;
	case "add_nhanhieu":		
		$template = "product/nhanhieu/nhanhieu_add";
		break;
	case "edit_nhanhieu":		
		get_nhanhieu();
		$template = "product/nhanhieu/nhanhieu_add";
		break;
	case "save_nhanhieu":
		save_nhanhieu();
		break;
	case "delete_nhanhieu":
		delete_nhanhieu();
		break;
	/* End Man Pro Nhãn Hiệu */

	/* Begin Man Pro Cấp 1 */
	case "man_list":
		get_lists();
		$template = "product/list/lists";
		break;
	case "add_list":		
		$template = "product/list/list_add";
		break;
	case "edit_list":		
		get_list();
		$template = "product/list/list_add";
		break;
	case "save_list":
		save_list();
		break;
	case "delete_list":
		delete_list();
		break;
	/* End Man Pro Cấp 1 */

	/* Begin Man Pro Cấp 2 */
	case "man_cat":
		get_cats();
		$template = "product/cat/cats";
		break;
	case "add_cat":		
		$template = "product/cat/cat_add";
		break;
	case "edit_cat":		
		get_cat();
		$template = "product/cat/cat_add";
		break;
	case "save_cat":
		save_cat();
		break;
	case "delete_cat":
		delete_cat();
		break;
	/* End Man Pro Cấp 2 */

	/* Begin Man Pro Cấp 3 */
	case "man_item":
		get_loais();
		$template = "product/item/loais";
		break;
	case "add_item":		
		$template = "product/item/loai_add";
		break;
	case "edit_item":		
		get_loai();
		$template = "product/item/loai_add";
		break;
	case "save_item":
		save_loai();
		break;
	case "delete_item":
		delete_loai();
		break;
	/* End Man Pro Cấp 3 */

	/* Begin Man Pro Cấp 4 */
	case "man_capbon":
		get_capbons();
		$template = "product/capbon/capbons";
		break;
	case "add_capbon":		
		$template = "product/capbon/capbon_add";
		break;
	case "edit_capbon":		
		get_capbon();
		$template = "product/capbon/capbon_add";
		break;
	case "save_capbon":
		save_capbon();
		break;
	case "delete_capbon":
		delete_capbon();
		break;
	/* End Man Pro Cấp 4 */
	
	/* Begin Man Photo Pro */
	case "man_photo":
		get_photos();
		$template = "product/photo/photos";
		break;
	case "add_photo":
		$template = "product/photo/photo_add";
		break;
	case "edit_photo":
		get_photo();
		$template = "product/photo/photo_edit";
		break;
	case "save_photo":
		save_photo();
		break;
	case "delete_photo":
		delete_photo();
		break;
	/* End Man Photo Pro */

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

/* Begin Man Pro Cấp Sản Phẩm */
function get_items()
{
	global $d, $items, $paging, $urldanhmuc;
	$type=$_REQUEST['type'];

	$sql = "select * from #_product where id<>0";	
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
	if((int)$_REQUEST['id_capbon']!='')
	{
	$sql.=" and	id_capbon=".$_REQUEST['id_capbon']."";
	}
	if((int)$_REQUEST['id_nhanhieu']!='')
	{
	$sql.=" and	id_nhanhieu=".$_REQUEST['id_nhanhieu']."";
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
	$url="index.php?com=product&act=man".$urldanhmuc."&type=".$type."";
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
		transfer("Không nhận được dữ liệu", "index.php?com=product&act=man&type=".$type."");	
	$sql = "select * from #_product where id='".$id."' and type='".$type."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=product&act=man&type=".$type."");
	$item = $d->fetch_array();

	/* Lấy nhiều hình ảnh */
	$sql = "select * from #_product_hinhanh where id_photo='".$id."' and type='".$type."' and kind='man' and val='".$type."' order by id asc";
	$d->query($sql);
	$list_hinhanh = $d->result_array();	
}

function save_item()
{
	global $d,$config;

	$type=$_REQUEST['type'];
	$file_name=fns_Rand_digit(0,9,12);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=product&act=man&type=".$type."");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";

	/* Begin Post Dữ liệu */
	foreach($config['lang'] as $key => $value) 
	{
		$data['ten'.$key] = magic_quote($_POST['ten'.$key]);
		$data['mota'.$key] = magic_quote($_POST['mota'.$key]);
		$data['noidung'.$key] = magic_quote($_POST['noidung'.$key]);
		$data['thongsokythuat'.$key] = magic_quote($_POST['thongsokythuat'.$key]);
		$data['khuyenmai'.$key] = magic_quote($_POST['khuyenmai'.$key]);
	}
	if($config['product'][$type]['size']=='true') 
	{
		if($_POST['size_group']!='') $data['id_size'] = implode(",", $_POST['size_group']);
		else $data['id_size'] = "";
	}
	if($config['product'][$type]['mau']=='true')
	{
		if($_POST['mau_group']!='') $data['id_mau'] = implode(",", $_POST['mau_group']);
		else $data['id_mau'] = "";
	}
	$data['id_list'] = (int)$_POST['id_list'];			
	$data['id_cat'] = (int)$_POST['id_cat'];	
	$data['id_item'] = (int)$_POST['id_item'];		
	$data['id_capbon'] = (int)$_POST['id_capbon'];		
	$data['id_nhanhieu'] = (int)$_POST['id_nhanhieu'];
	$data['tenkhongdau'] = changeTitle(magic_quote($_POST['tenvi']));
	$data['seo_h1'] = magic_quote($_POST['seo_h1']);
	$data['seo_h2'] = magic_quote($_POST['seo_h2']);
	$data['seo_h3'] = magic_quote($_POST['seo_h3']);
	$data['title'] = magic_quote($_POST['title']);
	$data['keywords'] = magic_quote($_POST['keywords']);
	$data['description'] = magic_quote($_POST['description']);
	$data['masp'] = magic_quote($_POST['masp']);
	$data['gia'] = (int)$_POST['gia'];
	$data['giakm'] = (int)$_POST['giakm'];
	$data['giagiam'] = (int)$_POST['giagiam'];	
	$data['tinhtrang'] = magic_quote($_POST['tinhtrang']);				
	$data['mau'] = magic_quote($_POST['mau']);				
	$data['link_video'] = magic_quote($_POST['link_video']);
	$data['stt'] = $_POST['stt'];
	$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
	$data['type'] = $type;
	/* End Post Dữ liệu */

	if($id)
	{
		if($photo = upload_image("file", $config['product'][$type]['img_type'], _upload_product,$file_name))
		{
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], $config['product'][$type]['thumb_width'], $config['product'][$type]['thumb_height'], _upload_product,$file_name,$config['product'][$type]['thumb_ratio']);
			$d->setTable('product');
			$d->setWhere('id', $id);
			$d->setWhere('type', $type);
			$d->select();
			if($d->num_rows()>0)
			{
				$row = $d->fetch_array();
				delete_file(_upload_product.$row['photo']);				
				delete_file(_upload_product.$row['thumb']);				
			}
		}

		if($taptin = upload_image("file2", $config['product'][$type]['file_type'],_upload_file,$file_name."_taptin"))
		{
			$data['taptin'] = $taptin;			
			$d->setTable('product');
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

            for ($i = 0; $i < $fileCount; $i++) 
            {  
	            if(move_uploaded_file($myFile["tmp_name"][$i], _upload_product."/".$file_name."_".$myFile["name"][$i]))
	            {       							
					$data1['photo'] = $file_name."_".$myFile["name"][$i];
					$data1['thumb'] = create_thumb($data1['photo'], $config['product'][$type]['multipic_arr'][$type]['thumb_width_photo'], $config['product'][$type]['multipic_arr'][$type]['thumb_height_photo'], _upload_product, $file_name."_".$myFile["name"][$i],$config['product'][$type]['multipic_arr'][$type]['thumb_ratio_photo']);	
					$data1['stt'] = (int)$_POST['stt-multi-pic'][$i];		
					// $data1['tenvi'] = $_POST['ten-multi-pic'][$i];		
					$data1['id_photo'] = $id;
					$data1['type'] = $type;
					$data1['kind'] = 'man';
					$data1['val'] = $type;
					$data1['hienthi'] = 1;
					$d->setTable('product_hinhanh');
					$d->insert($data1);
	            }
            }
        }		

		$data['ngaysua'] = time();

		$d->setTable('product');
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
		
			redirect("index.php?com=product&act=man&type=".$type."");
		}
		else transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=product&act=man&type=".$type."");
	}
	else
	{
		if($photo = upload_image("file", $config['product'][$type]['img_type'], _upload_product,$file_name))
		{
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], $config['product'][$type]['thumb_width'], $config['product'][$type]['thumb_height'], _upload_product,$file_name,$config['product'][$type]['thumb_ratio']);			
		}

		if($taptin = upload_image("file2", $config['product'][$type]['file_type'],_upload_file,$file_name."_taptin"))
		{
			$data['taptin'] = $taptin;		
		}		
	
		$data['ngaytao'] = time();

		$d->setTable('product');
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
		            if(move_uploaded_file($myFile["tmp_name"][$i], _upload_product."/".$file_name."_".$myFile["name"][$i]))
		            {       							
						$data1['photo'] = $file_name."_".$myFile["name"][$i];
						$data1['thumb'] = create_thumb($data1['photo'], $config['product'][$type]['multipic_arr'][$type]['thumb_width_photo'], $config['product'][$type]['multipic_arr'][$type]['thumb_height_photo'], _upload_product, $file_name."_".$myFile["name"][$i],$config['product'][$type]['multipic_arr'][$type]['thumb_ratio_photo']);	
						$data1['stt'] = (int)$_POST['stt-multi-pic'][$i];		
						// $data1['tenvi'] = $_POST['ten-multi-pic'][$i];		
						$data1['id_photo'] = $id_newest;
						$data1['type'] = $type;
						$data1['kind'] = 'man';
						$data1['val'] = $type;
						$data1['hienthi'] = 1;
						$d->setTable('product_hinhanh');
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
			redirect("index.php?com=product&act=man&type=".$type."");
		}
		else transfer("Lưu dữ liệu bị lỗi", "index.php?com=product&act=man&type=".$type."");
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
		$sql = "select * from #_product where id='".$id."' and type='".$type."'";
		$d->query($sql);

		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_product.$row['photo']);
				delete_file(_upload_product.$row['thumb']);
				delete_file(_upload_file.$row['taptin']);
			}
			$sql = "delete from #_product where id='".$id."' and type='".$type."'";
			$d->query($sql);
		}
		
		if($d->query($sql))
		{
			/* Begin Xóa Nhiều Hình */
			$d->reset();
			$sql = "select * from #_product_hinhanh where id_photo='".$id."' and kind='man'";
			$d->query($sql);

			if($d->num_rows()>0)
			{
				while($row = $d->fetch_array()){
					delete_file(_upload_product.$row['photo']);
					delete_file(_upload_product.$row['thumb']);
					delete_file(_upload_file.$row['taptin']);
				}
				$sql = "delete from #_product_hinhanh where id_photo='".$id."' and kind='man'";
				$d->query($sql);
			}
			/* End Xóa Nhiều Hình */
			redirect("index.php?com=product&act=man&type=".$type."");
		}
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=product&act=man&type=".$type."");
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
			$sql = "select * from #_product where id='".$id."' and type='".$type."'";
			$d->query($sql);

			if($d->num_rows()>0)
			{
				while($row = $d->fetch_array())
				{
					delete_file(_upload_product.$row['photo']);
					delete_file(_upload_product.$row['thumb']);
					delete_file(_upload_file.$row['taptin']);
				}
				$sql = "delete from #_product where id='".$id."' and type='".$type."'";
				$d->query($sql);

				/* Begin Xóa Nhiều Hình */
				$d->reset();
				$sql = "select * from #_product_hinhanh where id_photo='".$id."' and kind='man'";
				$d->query($sql);

				if($d->num_rows()>0)
				{
					while($row = $d->fetch_array())
					{
						delete_file(_upload_product.$row['photo']);
						delete_file(_upload_product.$row['thumb']);
						delete_file(_upload_file.$row['taptin']);
					}
					$sql = "delete from #_product_hinhanh where id_photo='".$id."' and kind='man'";
					$d->query($sql);
				}
				/* End Xóa Nhiều Hình */
			}	
		} 
		redirect("index.php?com=product&act=man&type=".$type."");
	} 
	else transfer("Không nhận được dữ liệu", "index.php?com=product&act=man&type=".$type."");
}
/* End Man Pro Cấp Sản Phẩm */

/* Begin Man Pro Size */
function get_items_size()
{
	global $d, $items;
	$type=$_REQUEST['type'];

	$sql = "select * from #_product_size where id<>0";
	
	if($_REQUEST['keyword']!='')
	{
	$keyword=addslashes($_REQUEST['keyword']);
	$sql.=" and (tenvi LIKE '%$keyword%' or tenen LIKE '%$keyword%')";
	}
	$sql.=" and type='".$type."' order by stt,id desc";

	$d->query($sql);
	$items = $d->result_array();
}

function get_item_size()
{
	global $d, $item;
	$type=$_REQUEST['type'];

	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", "index.php?com=product&act=man_size&type=".$type."");	
	$sql = "select * from #_product_size where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=product&act=man_size&type=".$type."");
	$item = $d->fetch_array();
}

function save_item_size()
{
	global $d, $config;

	$type=$_REQUEST['type'];
	$file_name=fns_Rand_digit(0,9,12);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=product&act=man_size&type=".$type."");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";

	/* Begin Post Dữ Liệu */
	foreach($config['lang'] as $key => $value) 
	{
		$data['ten'.$key] = magic_quote($_POST['ten'.$key]);
	}
	$data['tenkhongdau'] = changeTitle(magic_quote($_POST['tenvi']));
	$data['gia'] = (int)$_POST['gia'];			
	$data['stt'] = $_POST['stt'];
	$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
	$data['type'] = $type;
	/* End Post Dữ Liệu */

	if($id)
	{
		$data['ngaysua'] = time();

		$d->setTable('product_size');
		$d->setWhere('id', $id);
		$d->setWhere('type', $type);
		if($d->update($data)) redirect("index.php?com=product&act=man_size&type=".$type."");
		else transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=product&act=man_size&type=".$type."");
	}
	else
	{
		$data['ngaytao'] = time();

		$d->setTable('product_size');
		if($d->insert($data)) redirect("index.php?com=product&act=man_size&type=".$type."");
		else transfer("Lưu dữ liệu bị lỗi", "index.php?com=product&act=man_size&type=".$type."");
	}
}

function delete_item_size()
{
	global $d;
	$type=$_REQUEST['type'];

	if(isset($_GET['id']))
	{
		$id =  themdau($_GET['id']);
		
		$d->reset();
		$sql = "select * from #_product_size where id='".$id."' and type='".$type."'";
		$d->query($sql);

		if($d->num_rows()>0){
			$sql = "delete from #_product_size where id='".$id."' and type='".$type."'";
			$d->query($sql);
		}
		
		if($d->query($sql))
		{
			redirect("index.php?com=product&act=man_size&type=".$type."");
		}
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=product&act=man_size&type=".$type."");
	}
	elseif (isset($_GET['listid'])==true)
	{
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++)
		{
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
			$sql = "select * from #_product_size where id='".$id."' and type='".$type."'";
			$d->query($sql);

			if($d->num_rows()>0)
			{
				$sql = "delete from #_product_size where id='".$id."' and type='".$type."'";
				$d->query($sql);
			}	
		} 
		redirect("index.php?com=product&act=man_size&type=".$type."");
	} 
	else transfer("Không nhận được dữ liệu", "index.php?com=product&act=man_size&type=".$type."");
}
/* End Man Pro Size */

/* Begin Man Pro Màu */
function get_items_mau()
{
	global $d, $items;
	$type=$_REQUEST['type'];
	
	$sql = "select * from #_product_mau where id<>0";
	
	if($_REQUEST['keyword']!='')
	{
	$keyword=addslashes($_REQUEST['keyword']);
	$sql.=" and (tenvi LIKE '%$keyword%' or tenen LIKE '%$keyword%')";
	}
	$sql.=" and type='".$type."' order by stt,id desc";

	$d->query($sql);
	$items = $d->result_array();
}

function get_item_mau()
{
	global $d, $item;
	$type=$_REQUEST['type'];

	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", "index.php?com=product&act=man_mau&type=".$type."");	
	$sql = "select * from #_product_mau where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=product&act=man_mau&type=".$type."");
	$item = $d->fetch_array();
}

function save_item_mau()
{
	global $d, $config;

	$type=$_REQUEST['type'];
	$file_name=fns_Rand_digit(0,9,12);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=product&act=man_mau&type=".$type."");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";

	/* Begin Post Dữ Liệu */
	foreach($config['lang'] as $key => $value) 
	{
		$data['ten'.$key] = magic_quote($_POST['ten'.$key]);
	}
	$data['tenkhongdau'] = changeTitle(magic_quote($_POST['tenvi']));
	$data['gia'] = (int)$_POST['gia'];
	$data['loaihienthi'] = (int)$_POST['loaihienthi'];
	$data['mau'] = magic_quote($_POST['mau']);			
	$data['stt'] = $_POST['stt'];
	$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
	$data['type'] = $type;
	/* End Post Dữ Liệu */

	if($id)
	{
		if($photo = upload_image("file", $config['product'][$type]['img_type_mau'], _upload_mau,$file_name))
		{
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], $config['product'][$type]['thumb_width_mau'], $config['product'][$type]['thumb_height_mau'], _upload_mau,$file_name,$config['product'][$type]['thumb_ratio_mau']);
			$d->setTable('product_mau');
			$d->setWhere('id', $id);
			$d->setWhere('type', $type);
			$d->select();
			if($d->num_rows()>0)
			{
				$row = $d->fetch_array();
				delete_file(_upload_mau.$row['photo']);				
				delete_file(_upload_mau.$row['thumb']);				
			}
		}

		$data['ngaysua'] = time();

		$d->setTable('product_mau');
		$d->setWhere('id', $id);
		$d->setWhere('type', $type);
		if($d->update($data)) redirect("index.php?com=product&act=man_mau&type=".$type."");
		else transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=product&act=man_mau&type=".$type."");
	}
	else
	{	
		if($photo = upload_image("file", $config['product'][$type]['img_type_mau'], _upload_mau,$file_name))
		{
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], $config['product'][$type]['thumb_width_mau'], $config['product'][$type]['thumb_height_mau'], _upload_mau,$file_name,$config['product'][$type]['thumb_ratio_mau']);			
		}

		$data['ngaytao'] = time();

		$d->setTable('product_mau');
		if($d->insert($data)) redirect("index.php?com=product&act=man_mau&type=".$type."");
		else transfer("Lưu dữ liệu bị lỗi", "index.php?com=product&act=man_mau&type=".$type."");
	}
}

function delete_item_mau()
{
	global $d;
	$type=$_REQUEST['type'];

	if(isset($_GET['id']))
	{
		$id =  themdau($_GET['id']);
		
		$d->reset();
		$sql = "select * from #_product_mau where id='".$id."' and type='".$type."'";
		$d->query($sql);

		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_mau.$row['photo']);
				delete_file(_upload_mau.$row['thumb']);
			}
			$sql = "delete from #_product_mau where id='".$id."' and type='".$type."'";
			$d->query($sql);
		}
		
		if($d->query($sql))
		{
			redirect("index.php?com=product&act=man_mau&type=".$type."");
		}
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=product&act=man_mau&type=".$type."");
	}
	elseif (isset($_GET['listid'])==true)
	{
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++)
		{
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
			$sql = "select * from #_product_mau where id='".$id."' and type='".$type."'";
			$d->query($sql);

			if($d->num_rows()>0)
			{
				while($row = $d->fetch_array()){
					delete_file(_upload_mau.$row['photo']);
					delete_file(_upload_mau.$row['thumb']);
				}
				$sql = "delete from #_product_mau where id='".$id."' and type='".$type."'";
				$d->query($sql);
			}	
		} 
		redirect("index.php?com=product&act=man_mau&type=".$type."");
	} 
	else transfer("Không nhận được dữ liệu", "index.php?com=product&act=man_mau&type=".$type."");
}
/* End Man Pro Màu */

/* Begin Man Pro Cấp 2 */
function get_cats()
{
	global $d, $items, $paging, $urldanhmuc;
	$type=$_REQUEST['type'];
	
	$sql = "select * from #_product_cat where id<>0";
		
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
	$url="index.php?com=product&act=man_cat".$urldanhmuc."&type=".$type."";
	$maxR=10;
	$maxP=10;
	$paging=paging($items, $url, $curPage, $maxR, $maxP);
	$items=$paging['source'];
}

function get_cat()
{
	global $d, $item, $list_hinhanh;
	$type=$_REQUEST['type'];
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
	transfer("Không nhận được dữ liệu", "index.php?com=product&act=man_cat&type=".$type."");
	
	$sql = "select * from #_product_cat where id='".$id."' and type='".$type."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=product&act=man_cat&type=".$type."");
	$item = $d->fetch_array();
}

function save_cat()
{
	global $d,$config;

	$type=$_REQUEST['type'];
	$file_name=fns_Rand_digit(0,9,12);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=product&act=man_cat&type=".$type."");
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
		if($photo = upload_image("file", $config['product'][$type]['img_type_cat'], _upload_product,$file_name))
		{
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], $config['product'][$type]['thumb_width_cat'], $config['product'][$type]['thumb_height_cat'], _upload_product,$file_name,$config['product'][$type]['thumb_ratio_cat']);			
			$d->setTable('product_cat');
			$d->setWhere('id', $id);
			$d->setWhere('type', $type);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_product.$row['photo']);				
				delete_file(_upload_product.$row['thumb']);				
			}
		}

		$data['ngaysua'] = time();
		
		$d->setTable('product_cat');
		$d->setWhere('id', $id);
		$d->setWhere('type', $type);
		if($d->update($data)) redirect("index.php?com=product&act=man_cat&curPage=".$_REQUEST['curPage']."&type=".$type."");
		else transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=product&act=man_cat&type=".$type."");
	}
	else
	{		
		if($photo = upload_image("file", $config['product'][$type]['img_type_cat'], _upload_product,$file_name))
		{
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], $config['product'][$type]['thumb_width_cat'], $config['product'][$type]['thumb_height_cat'], _upload_product,$file_name,$config['product'][$type]['thumb_ratio_cat']);		
		}

		$data['ngaytao'] = time();
		
		$d->setTable('product_cat');
		if($d->insert($data)) redirect("index.php?com=product&act=man_cat&type=".$type."");
		else transfer("Lưu dữ liệu bị lỗi", "index.php?com=product&act=man_cat&type=".$type."");
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
		$sql = "select * from #_product_cat where id='".$id."' and type='".$type."'";
		$d->query($sql);

		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_product.$row['photo']);
				delete_file(_upload_product.$row['thumb']);
			}
			$sql = "delete from #_product_cat where id='".$id."' and type='".$type."'";
			$d->query($sql);
		}
		
		if($d->query($sql))
		{
			redirect("index.php?com=product&act=man_cat&type=".$type."");
		}
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=product&act=man_cat&type=".$type."");
	}
	elseif (isset($_GET['listid'])==true)
	{
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++)
		{
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
			$sql = "select * from #_product_cat where id='".$id."' and type='".$type."'";
			$d->query($sql);
			if($d->num_rows()>0)
			{
				while($row = $d->fetch_array())
				{
					delete_file(_upload_product.$row['photo']);
					delete_file(_upload_product.$row['thumb']);
				}
				$sql = "delete from #_product_cat where id='".$id."' and type='".$type."'";
				$d->query($sql);
			}
		} redirect("index.php?com=product&act=man_cat&type=".$type."");
	}
	else transfer("Không nhận được dữ liệu", "index.php?com=product&act=man_cat&type=".$type."");
}
/* End Man Pro Cấp 2 */

/* Begin Man Pro Cấp 3 */
function get_loais()
{
	global $d, $items, $paging, $urldanhmuc;
	$type=$_REQUEST['type'];
	
	$sql = "select * from #_product_item where id<>0";
		
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
	$url="index.php?com=product&act=man_item".$urldanhmuc."&type=".$type."";
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
	transfer("Không nhận được dữ liệu", "index.php?com=product&act=man_item&type=".$type."");
	
	$sql = "select * from #_product_item where id='".$id."' and type='".$type."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=product&act=man_item&type=".$type."");
	$item = $d->fetch_array();
}

function save_loai()
{
	global $d,$config;

	$type=$_REQUEST['type'];
	$file_name=fns_Rand_digit(0,9,12);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=product&act=man_item&type=".$type."");
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
		if($photo = upload_image("file", $config['product'][$type]['img_type_item'], _upload_product,$file_name))
		{
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], $config['product'][$type]['thumb_width_item'], $config['product'][$type]['thumb_height_item'], _upload_product,$file_name,$config['product'][$type]['thumb_ratio_item']);		
			$d->setTable('product_item');
			$d->setWhere('id', $id);
			$d->setWhere('type', $type);
			$d->select();
			if($d->num_rows()>0)
			{
				$row = $d->fetch_array();
				delete_file(_upload_product.$row['photo']);				
				delete_file(_upload_product.$row['thumb']);				
			}
		}

		$data['ngaysua'] = time();
		
		$d->setTable('product_item');
		$d->setWhere('id', $id);
		$d->setWhere('type', $type);
		if($d->update($data)) redirect("index.php?com=product&act=man_item&curPage=".$_REQUEST['curPage']."&type=".$type."");
		else transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=product&act=man_item&type=".$type."");
	}
	else
	{	
		if($photo = upload_image("file", $config['product'][$type]['img_type_item'], _upload_product,$file_name))
		{
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], $config['product'][$type]['thumb_width_cat'], $config['product'][$type]['thumb_height_cat'], _upload_product,$file_name,$config['product'][$type]['thumb_ratio_cat']);		
		}	

		$data['ngaytao'] = time();
		
		$d->setTable('product_item');
		if($d->insert($data)) redirect("index.php?com=product&act=man_item&type=".$type."");
		else transfer("Lưu dữ liệu bị lỗi", "index.php?com=product&act=man_item&type=".$type."");
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
		$sql = "select * from #_product_item where id='".$id."' and type='".$type."'";
		$d->query($sql);

		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_product.$row['photo']);
				delete_file(_upload_product.$row['thumb']);
			}
			$sql = "delete from #_product_item where id='".$id."' and type='".$type."'";
			$d->query($sql);
		}
		
		if($d->query($sql))
		{
			redirect("index.php?com=product&act=man_item&type=".$type."");
		}
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=product&act=man_item&type=".$type."");
	}
	elseif (isset($_GET['listid'])==true)
	{
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
			$sql = "select * from #_product_item where id='".$id."' and type='".$type."'";
			$d->query($sql);
			if($d->num_rows()>0)
			{
				while($row = $d->fetch_array())
				{
					delete_file(_upload_product.$row['photo']);
					delete_file(_upload_product.$row['thumb']);
				}
				$sql = "delete from #_product_item where id='".$id."' and type='".$type."'";
				$d->query($sql);
			}
		} redirect("index.php?com=product&act=man_item&type=".$type."");
	}
	else transfer("Không nhận được dữ liệu", "index.php?com=product&act=man_item&type=".$type."");
}
/* End Man Pro Cấp 3 */

/* Begin Man Pro Cấp 4 */
function get_capbons()
{
	global $d, $items, $paging, $urldanhmuc;
	$type=$_REQUEST['type'];

	$sql = "select * from #_product_capbon where id<>0";	
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
	$url="index.php?com=product&act=man_capbon".$urldanhmuc."&type=".$type."";
	$maxR=10;
	$maxP=10;
	$paging=paging($items, $url, $curPage, $maxR, $maxP);
	$items=$paging['source'];
}

function get_capbon()
{
	global $d, $item;
	$type=$_REQUEST['type'];

	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", "index.php?com=product&act=man_capbon&type=".$type."");	
	$sql = "select * from #_product_capbon where id='".$id."' and type='".$type."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=product&act=man_capbon&type=".$type."");
	$item = $d->fetch_array();
}

function save_capbon()
{
	global $d,$config;

	$type=$_REQUEST['type'];
	$file_name=fns_Rand_digit(0,9,12);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=product&act=man_capbon&type=".$type."");
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
	$data['id_item']= $_POST['id_item'];
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
		if($photo = upload_image("file", $config['product'][$type]['img_type_capbon'], _upload_product,$file_name))
		{
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], $config['product'][$type]['thumb_width_capbon'], $config['product'][$type]['thumb_height_capbon'], _upload_product,$file_name,$config['product'][$type]['thumb_ratio_capbon']);			
			$d->setTable('product_capbon');
			$d->setWhere('id', $id);
			$d->setWhere('type', $type);
			$d->select();
			if($d->num_rows()>0)
			{
				$row = $d->fetch_array();
				delete_file(_upload_product.$row['photo']);				
				delete_file(_upload_product.$row['thumb']);				
			}
		}

		$data['ngaysua'] = time();
		
		$d->setTable('product_capbon');
		$d->setWhere('id', $id);
		$d->setWhere('type', $type);
		if($d->update($data)) redirect("index.php?com=product&act=man_capbon&curPage=".$_REQUEST['curPage']."&type=".$type."");
		else transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=product&act=man_capbon&type=".$type."");
	}
	else
	{	
		if($photo = upload_image("file", $config['product'][$type]['img_type_capbon'], _upload_product,$file_name))
		{
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], $config['product'][$type]['thumb_width_capbon'], $config['product'][$type]['thumb_height_capbon'], _upload_product,$file_name,$config['product'][$type]['thumb_ratio_capbon']);		
		}	

		$data['ngaytao'] = time();
		
		$d->setTable('product_capbon');
		if($d->insert($data)) redirect("index.php?com=product&act=man_capbon&type=".$type."");
		else transfer("Lưu dữ liệu bị lỗi", "index.php?com=product&act=man_capbon&type=".$type."");
	}
}

function delete_capbon()
{
	global $d;
	$type=$_REQUEST['type'];

	if(isset($_GET['id']))
	{
		$id =  themdau($_GET['id']);
		
		$d->reset();
		$sql = "select * from #_product_capbon where id='".$id."' and type='".$type."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_product.$row['photo']);
				delete_file(_upload_product.$row['thumb']);
			}
			$sql = "delete from #_product_capbon where id='".$id."' and type='".$type."'";
			$d->query($sql);
		}
		
		if($d->query($sql))
		{
			redirect("index.php?com=product&act=man_capbon&type=".$type."");
		}
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=product&act=man_capbon&type=".$type."");
	}
	elseif (isset($_GET['listid'])==true)
	{
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++)
		{
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
			$sql = "select * from #_product_capbon where id='".$id."' and type='".$type."'";
			$d->query($sql);
			if($d->num_rows()>0)
			{
				while($row = $d->fetch_array())
				{
					delete_file(_upload_product.$row['photo']);
					delete_file(_upload_product.$row['thumb']);
				}
				$sql = "delete from #_product_capbon where id='".$id."' and type='".$type."'";
				$d->query($sql);
			}
		} redirect("index.php?com=product&act=man_capbon&type=".$type."");
	} 
	else transfer("Không nhận được dữ liệu", "index.php?com=product&act=man_capbon&type=".$type."");
}
/* End Man Pro Cấp 4 */

/* Begin Man Pro Cấp 1 */
function get_lists()
{
	global $d, $items, $paging;
	$type=$_REQUEST['type'];
	
	$sql = "select * from #_product_list where id<>0";	

	if($_REQUEST['keyword']!='')
	{
	$keyword=addslashes($_REQUEST['keyword']);
	$sql.=" and (tenvi LIKE '%$keyword%' or tenen LIKE '%$keyword%')";
	}		
	$sql.=" and type='".$type."' order by stt,id desc";
	
	$d->query($sql);
	$items = $d->result_array();
	
	$curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
	$url="index.php?com=product&act=man_list&type=".$type."";
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
	transfer("Không nhận được dữ liệu", "index.php?com=product&act=man_list&type=".$type."");	
	$sql = "select * from #_product_list where id='".$id."' and type='".$type."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=product&act=man_list&type=".$type."");
	$item = $d->fetch_array();	

	/* Lấy nhiều hình ảnh */
	$sql = "select * from #_product_hinhanh where id_photo='".$id."' and type='".$type."' and kind='man_list' and val='".$type."' order by id asc";
	$d->query($sql);
	$list_hinhanh = $d->result_array();
}

function save_list()
{
	global $d,$config;

	$type=$_REQUEST['type'];
	$file_name=fns_Rand_digit(0,9,12);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=product&act=man_list&type=".$type."");
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
		if($photo = upload_image("file", $config['product'][$type]['img_type_list'], _upload_product,$file_name))
		{
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], $config['product'][$type]['thumb_width_list'], $config['product'][$type]['thumb_height_list'], _upload_product,$file_name,$config['product'][$type]['thumb_ratio_list']);
			$d->setTable('product_list');
			$d->setWhere('id', $id);
			$d->setWhere('type', $type);
			$d->select();
			if($d->num_rows()>0)
			{
				$row = $d->fetch_array();
				delete_file(_upload_product.$row['photo']);					
				delete_file(_upload_product.$row['thumb']);					
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
	            if(move_uploaded_file($myFile["tmp_name"][$i], _upload_product."/".$file_name."_".$myFile["name"][$i]))
	            {       							
					$data1['photo'] = $file_name."_".$myFile["name"][$i];
					$data1['thumb'] = create_thumb($data1['photo'], $config['product'][$type]['multipic_list_arr'][$type]['thumb_width_photo'], $config['product'][$type]['multipic_list_arr'][$type]['thumb_height_photo'], _upload_product, $file_name."_".$myFile["name"][$i],$config['product'][$type]['multipic_list_arr'][$type]['thumb_ratio_photo']);	
					$data1['stt'] = (int)$_POST['stt-multi-pic'][$i];		
					// $data1['tenvi'] = $_POST['ten-multi-pic'][$i];		
					$data1['id_photo'] = $id;
					$data1['type'] = $type;
					$data1['kind'] = 'man_list';
					$data1['val'] = $type;
					$data1['hienthi'] = 1;
					$d->setTable('product_hinhanh');
					$d->insert($data1);
	            }
            }
        }

		$data['ngaysua'] = time();
		
		$d->setTable('product_list');
		$d->setWhere('id', $id);
		$d->setWhere('type', $type);
		if($d->update($data)) redirect("index.php?com=product&act=man_list&curPage=".$_REQUEST['curPage']."&type=".$type."");
		else transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=product&act=man_list&type=".$type."");
	}
	else
	{				
		if($photo = upload_image("file", $config['product'][$type]['img_type_list'], _upload_product,$file_name)){
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], $config['product'][$type]['thumb_width_list'], $config['product'][$type]['thumb_height_list'], _upload_product,$file_name,$config['product'][$type]['thumb_ratio_list']);			
		}
		
		$data['ngaytao'] = time();
		
		$d->setTable('product_list');
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
		            if(move_uploaded_file($myFile["tmp_name"][$i], _upload_product."/".$file_name."_".$myFile["name"][$i]))
		            {       							
						$data1['photo'] = $file_name."_".$myFile["name"][$i];
						$data1['thumb'] = create_thumb($data1['photo'], $config['product'][$type]['multipic_list_arr'][$type]['thumb_width_photo'], $config['product'][$type]['multipic_list_arr'][$type]['thumb_height_photo'], _upload_product, $file_name."_".$myFile["name"][$i],$config['product'][$type]['multipic_list_arr'][$type]['thumb_ratio_photo']);	
						$data1['stt'] = (int)$_POST['stt-multi-pic'][$i];		
						// $data1['tenvi'] = $_POST['ten-multi-pic'][$i];		
						$data1['id_photo'] = $id_newest;
						$data1['type'] = $type;
						$data1['kind'] = 'man_list';
						$data1['val'] = $type;
						$data1['hienthi'] = 1;
						$d->setTable('product_hinhanh');
						$d->insert($data1);
		            }
	            }
	        }

			redirect("index.php?com=product&act=man_list&type=".$type."");
		}
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=product&act=man_list&type=".$type."");
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
		$sql = "select * from #_product_list where id='".$id."' and type='".$type."'";
		$d->query($sql);

		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_product.$row['photo']);
				delete_file(_upload_product.$row['thumb']);
			}
			$sql = "delete from #_product_list where id='".$id."' and type='".$type."'";
			$d->query($sql);
		}
	
		if($d->query($sql))
		{
			/* Begin Xóa Nhiều Hình */
			$d->reset();
			$sql = "select * from #_product_hinhanh where id_photo='".$id."' and kind='man_list'";
			$d->query($sql);

			if($d->num_rows()>0)
			{
				while($row = $d->fetch_array())
				{
					delete_file(_upload_product.$row['photo']);
					delete_file(_upload_product.$row['thumb']);
				}
				$sql = "delete from #_product_hinhanh where id_photo='".$id."' and kind='man_list'";
				$d->query($sql);
			}
			/* End Xóa Nhiều Hình */
			redirect("index.php?com=product&act=man_list&type=".$type."");
		}
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=product&act=man_list&type=".$type."");
	}
	elseif (isset($_GET['listid'])==true)
	{
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++)
		{
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
			$sql = "select * from #_product_list where id='".$id."' and type='".$type."'";
			$d->query($sql);
			if($d->num_rows()>0)
			{
				while($row = $d->fetch_array())
				{
					delete_file(_upload_product.$row['photo']);
					delete_file(_upload_product.$row['thumb']);
				}
				$sql = "delete from #_product_list where id='".$id."' and type='".$type."'";
				$d->query($sql);
				
				/* Begin Xóa Nhiều Hình */
				$d->reset();
				$sql = "select * from #_product_hinhanh where id_photo='".$id."' and kind='man_list'";
				$d->query($sql);

				if($d->num_rows()>0)
				{
					while($row = $d->fetch_array())
					{
						delete_file(_upload_product.$row['photo']);
						delete_file(_upload_product.$row['thumb']);
					}
					$sql = "delete from #_product_hinhanh where id_photo='".$id."' and kind='man_list'";
					$d->query($sql);
				}
				/* End Xóa Nhiều Hình */
			}
		} redirect("index.php?com=product&act=man_list&type=".$type."");
	}
	else transfer("Không nhận được dữ liệu", "index.php?com=product&act=man_list&type=".$type."");
}
/* End Man Pro Cấp 1 */

/* Begin Man Pro Nhãn Hiệu */
function get_nhanhieus()
{
	global $d, $items, $paging;
	$type=$_REQUEST['type'];
	
	$sql = "select * from #_product_nhanhieu where id<>0";	

	if($_REQUEST['keyword']!='')
	{
	$keyword=addslashes($_REQUEST['keyword']);
	$sql.=" and (tenvi LIKE '%$keyword%' or tenen LIKE '%$keyword%')";
	}		
	$sql.=" and type='".$type."' order by stt,id desc";
	
	$d->query($sql);
	$items = $d->result_array();
	
	$curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
	$url="index.php?com=product&act=man_nhanhieu&type=".$type."";
	$maxR=10;
	$maxP=10;
	$paging=paging($items, $url, $curPage, $maxR, $maxP);
	$items=$paging['source'];
}

function get_nhanhieu()
{
	global $d, $item;
	$type=$_REQUEST['type'];
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
	transfer("Không nhận được dữ liệu", "index.php?com=product&act=man_nhanhieu&type=".$type."");	
	$sql = "select * from #_product_nhanhieu where id='".$id."' and type='".$type."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=product&act=man_nhanhieu&type=".$type."");
	$item = $d->fetch_array();		
}

function save_nhanhieu()
{
	global $d,$config;

	$type=$_REQUEST['type'];
	$file_name=fns_Rand_digit(0,9,12);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=product&act=man_nhanhieu&type=".$type."");
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
		if($photo = upload_image("file", $config['product'][$type]['img_type_nhanhieu'], _upload_product,$file_name))
		{
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], $config['product'][$type]['thumb_width_nhanhieu'], $config['product'][$type]['thumb_height_nhanhieu'], _upload_product,$file_name,$config['product'][$type]['thumb_ratio_nhanhieu']);		
			$d->setTable('product_nhanhieu');
			$d->setWhere('id', $id);
			$d->setWhere('type', $type);
			$d->select();
			if($d->num_rows()>0)
			{
				$row = $d->fetch_array();
				delete_file(_upload_product.$row['photo']);					
				delete_file(_upload_product.$row['thumb']);					
			}
		}

		$data['ngaysua'] = time();
		
		$d->setTable('product_nhanhieu');
		$d->setWhere('id', $id);
		$d->setWhere('type', $type);
		if($d->update($data)) redirect("index.php?com=product&act=man_nhanhieu&curPage=".$_REQUEST['curPage']."&type=".$type."");
		else transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=product&act=man_nhanhieu&type=".$type."");
	}
	else
	{				
		if($photo = upload_image("file", $config['product'][$type]['img_type_nhanhieu'], _upload_product,$file_name))
		{
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], $config['product'][$type]['thumb_width_nhanhieu'], $config['product'][$type]['thumb_height_nhanhieu'], _upload_product,$file_name,$config['product'][$type]['thumb_ratio_nhanhieu']);				
		}
		
		$data['ngaytao'] = time();
		
		$d->setTable('product_nhanhieu');
		if($d->insert($data)) redirect("index.php?com=product&act=man_nhanhieu&type=".$type."");
		else transfer("Lưu dữ liệu bị lỗi", "index.php?com=product&act=man_nhanhieu&type=".$type."");
	}
}

function delete_nhanhieu()
{
	global $d;
	$type=$_REQUEST['type'];
	if(isset($_GET['id']))
	{
		$id = themdau($_GET['id']);		
		$d->reset();
		$sql = "select * from #_product_nhanhieu where id='".$id."' and type='".$type."'";
		$d->query($sql);

		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_product.$row['photo']);
				delete_file(_upload_product.$row['thumb']);
			}
			$sql = "delete from #_product_nhanhieu where id='".$id."' and type='".$type."'";
			$d->query($sql);
		}
	
		if($d->query($sql))
			redirect("index.php?com=product&act=man_nhanhieu&type=".$type."");
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=product&act=man_nhanhieu&type=".$type."");
	}
	elseif (isset($_GET['listid'])==true)
	{
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
		$sql = "select * from #_product_nhanhieu where id='".$id."' and type='".$type."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_product.$row['photo']);
				delete_file(_upload_product.$row['thumb']);
			}
			$sql = "delete from #_product_nhanhieu where id='".$id."' and type='".$type."'";
			$d->query($sql);
		}
			
		} redirect("index.php?com=product&act=man_nhanhieu&type=".$type."");
	}
	else transfer("Không nhận được dữ liệu", "index.php?com=product&act=man_nhanhieu&type=".$type."");
}
/* End Man Pro Nhãn Hiệu */

/* Begin Man Photo Pro */
function get_photos()
{
	global $d, $items, $paging;	
	$type=$_REQUEST['type'];
	$kind=$_REQUEST['kind'];
	$val=$_REQUEST['val'];
	
	$sql = "select * from #_product_hinhanh where ( id_photo = '".$_REQUEST['idc']."' OR '".$_REQUEST['idc']."'=0  ) and type='".$type."' and kind='".$kind."' and val='".$val."' order by stt,id desc ";			
	$d->query($sql);
	$items = $d->result_array();
	
	$curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
	$url="index.php?com=product&act=man_photo&idc=".$_REQUEST['idc']."&type=".$type."&kind=".$kind."&val=".$val."";
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
		transfer("Không nhận được dữ liệu", "index.php?com=product&act=man_photo&idc=".$_REQUEST['idc']."&type=".$type."&kind=".$kind."&val=".$val."");
	
	$d->setTable('product_hinhanh');
	$d->setWhere('type', $type);
	$d->setWhere('kind', $kind);
	$d->setWhere('val', $val);
	$d->setWhere('id', $id);
	$d->select();
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=product&act=man_photo&idc=".$_REQUEST['idc']."&type=".$type."&kind=".$kind."&val=".$val."");
	$item = $d->fetch_array();
	$d->reset();
}

function save_photo()
{
	global $d,$config,$define_str_arr;

	$type = $_REQUEST['type'];
	$kind = $_REQUEST['kind'];
	$val = $_REQUEST['val'];
	$file_name=fns_Rand_digit(0,9,10);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=product&act=man_photo&idc=".$_REQUEST['idc']."&type=".$type."&kind=".$kind."&val=".$val."");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";

	if($id)
	{
		if($photo = upload_image("file", $config['product'][$type][$define_str_arr][$val]['img_type_photo'], _upload_product,$file_name))
		{
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], $config['product'][$type][$define_str_arr][$val]['thumb_width_photo'], $config['product'][$type][$define_str_arr][$val]['thumb_height_photo'], _upload_product,$file_name,$config['product'][$type][$define_str_arr][$val]['thumb_ratio_photo']);
			$d->setTable('product_hinhanh');
			$d->setWhere('id', $id);
			$d->setWhere('type', $type);
			$d->setWhere('kind', $kind);
			$d->select();
			if($d->num_rows()>0)
			{
				$row = $d->fetch_array();
				delete_file(_upload_product.$row['photo']);				
				delete_file(_upload_product.$row['thumb']);				
			}
		}

		if($taptin = upload_image("file2", $config['product'][$type][$define_str_arr][$val]['file_type_photo'],_upload_file,$file_name."_taptin"))
		{
			$data['taptin'] = $taptin;			
			$d->setTable('product_hinhanh');
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
		$data['id_mau'] = (int)$_POST['id_mau'];
		$data['link'] = magic_quote($_POST['link']);
		$data['link_video'] = magic_quote($_POST['link_video']);
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;

		$d->reset();
		$d->setTable('product_hinhanh');
		$d->setWhere('id', $id);
		$d->setWhere('type', $type);
		$d->setWhere('kind', $kind);
		$d->setWhere('val', $val);
		if(!$d->update($data)) transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=product&act=man_photo&idc=".$_REQUEST['idc']."&type=".$type."&kind=".$kind."");
		redirect("index.php?com=product&act=man_photo&idc=".$_REQUEST['idc']."&type=".$type."&kind=".$kind."&val=".$val."");
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
			$data['id_mau'] = (int)$_POST['id_mau'];
			$data['link'] = magic_quote($_POST['link'.$i]);
			$data['link_video'] = magic_quote($_POST['link_video'.$i]);
			$data['stt'] = $_POST['stt'.$i];
			$data['hienthi'] = isset($_POST['hienthi'.$i]) ? 1 : 0;
			$data['type'] = $type;
			$data['kind'] = $kind;
			$data['val'] = $val;
			$data['id_photo'] = $_REQUEST['idc'];

			if($config['product'][$type][$define_str_arr][$val]['file_photo']=='true')
			{
				if($taptin = upload_image("file2".$i, $config['product'][$type][$define_str_arr][$val]['file_type_photo'],_upload_file,$file_name."_taptin".$i))
				{
					$data['taptin'] = $taptin;		
				}
			}

			if($config['product'][$type][$define_str_arr][$val]['images_photo']=='true')
			{
				if($photo = upload_image("file".$i, $config['product'][$type][$define_str_arr][$val]['img_type_photo'], _upload_product,$file_name.$i))
				{
					$data['photo'] = $photo;
					$data['thumb'] = create_thumb($data['photo'], $config['product'][$type][$define_str_arr][$val]['thumb_width_photo'], $config['product'][$type][$define_str_arr][$val]['thumb_height_photo'], _upload_product,$file_name.$i,$config['product'][$type][$define_str_arr][$val]['thumb_ratio_photo']);

					$d->setTable('product_hinhanh');
					if(!$d->insert($data)) transfer("Lưu dữ liệu bị lỗi", "index.php?com=product&act=man_photo&idc=".$_REQUEST['idc']."&type=".$type."&kind=".$kind."&val=".$val."");
				}
			}
			else
			{
				if($data['tenvi']!='' || $data['mau']!='' || $data['link']!='' || $data['link_video']!='')
				{		
					$d->setTable('product_hinhanh');
					if(!$d->insert($data)) transfer("Lưu dữ liệu bị lỗi", "index.php?com=product&act=man_photo&idc=".$_REQUEST['idc']."&type=".$type."&kind=".$kind."&val=".$val."");
				}
			}
		}
		redirect("index.php?com=product&act=man_photo&idc=".$_REQUEST['idc']."&type=".$type."&kind=".$kind."&val=".$val."");
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

		$d->setTable('product_hinhanh');
		$d->setWhere('id', $id);
		$d->setWhere('type', $type);
		$d->setWhere('kind', $kind);
		$d->setWhere('val', $val);
		$d->select();
		if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=product&act=man_photo&idc=".$_REQUEST['idc']."&type=".$type."&kind=".$kind."&val=".$val."");
		$row = $d->fetch_array();
			delete_file(_upload_product.$row['photo']);		
			delete_file(_upload_product.$row['thumb']);	
			delete_file(_upload_file.$row['taptin']);	
		if($d->delete())
			redirect("index.php?com=product&act=man_photo&idc=".$_REQUEST['idc']."&type=".$type."&kind=".$kind."&val=".$val."");
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=product&act=man_photo&idc=".$_REQUEST['idc']."&type=".$type."&kind=".$kind."&val=".$val."");
	}
	elseif (isset($_GET['listid'])==true)
	{
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
		$sql = "select * from #_product_hinhanh where id='".$id."' and type='".$type."' and kind='".$kind."' and val='".$val."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_product.$row['photo']);
				delete_file(_upload_product.$row['thumb']);
				delete_file(_upload_file.$row['taptin']);
			}
			$sql = "delete from #_product_hinhanh where id='".$id."' and type='".$type."' and kind='".$kind."' and val='".$val."'";
			$d->query($sql);
		}
			
		} redirect("index.php?com=product&act=man_photo&idc=".$_REQUEST['idc']."&type=".$type."&kind=".$kind."&val=".$val."");
	}
	else transfer("Không nhận được dữ liệu", "index.php?com=product&act=man_photo&idc=".$_REQUEST['idc']."&type=".$type."&kind=".$kind."&val=".$val."");
}
/* End Man Photo Pro */
?>