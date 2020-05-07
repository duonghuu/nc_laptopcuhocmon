<?php	if(!defined('_source')) die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";

switch($act)
{
	/* Begin Photo Static */
	case "photo_static":
		get_photo_static();
		$template = "photo/static/photo_static";
		break;
	case "save_static":
		save_static();
		break;
	/* End Photo Static */

	/* Begin Background */
	case "photo_background":
		get_photo_background();
		$template = "photo/background/photo_background";
		break;
	case "save_photo_background":
		save_photo_background();
		break;
	/* End Background */

	/* Begin Man Photo */
	case "man_photo":
		get_photos();
		$template = "photo/man/photos";
		break;
	case "add_photo":
		$template = "photo/man/photo_add";
		break;
	case "edit_photo":
		get_photo();
		$template = "photo/man/photo_edit";
		break;
	case "save_photo":
		save_photo();
		break;
	case "delete_photo":
		delete_photo();
		break;
	/* End Man Photo */			

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

/* Begin Background */
function get_photo_background()
{
	global $d, $item;
	$type=$_REQUEST['type'];

	$sql = "select * from #_photo where act='photo_background' and type='".$type."'";
	$d->query($sql);
	$item = $d->fetch_array();
}

function save_photo_background()
{
	global $d,$config;

	$type=$_REQUEST['type'];

	$file_name = $_FILES['file']['name'];
	$file_name = explode('.',$file_name);
	$file_name = changeTitle($file_name[0]);
	$file_name = $file_name.'_'.date('HisdmY', time());

	$sql = "select * from #_photo where act='photo_background' and type='".$type."'";
	$d->query($sql);
	$item = $d->fetch_array();
	$id=$item['id'];

	if($id)
	{
		if($photo = upload_image("file", $config['photo']['photo_background'][$type]['img_type'], _upload_photo, $file_name))
		{
			$data['photo'] = $photo;
			$d->setTable('photo');
			$d->setWhere('id', $id);
			$d->setWhere('act','photo_background');
			$d->setWhere('type',$type);
			$d->select();
			if($d->num_rows()>0)
			{
				$row = $d->fetch_array();
				delete_file(_upload_photo.$row['photo']);
			}
		}

		$data['mau'] = magic_quote($_POST['mau']);
		$data['background_repeat'] = magic_quote($_POST['background_repeat']);
		$data['background_size'] = magic_quote($_POST['background_size']);
		$data['background_position'] = magic_quote($_POST['background_position']);
		$data['background_attachment'] = magic_quote($_POST['background_attachment']);
		$data['loaihienthi'] = $_POST['loaihienthi'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaysua'] = time();

		$d->setTable('photo');
		$d->setWhere('id', $id);
		$d->setWhere('act','photo_background');
		$d->setWhere('type',$type);

		if($d->update($data))
			redirect("index.php?com=photo&act=photo_background&type=".$type);
		else
			transfer("Unable to save data!", "index.php?com=photo&act=photo_background&type=".$type);
	}
	else
	{
		if($photo = upload_image("file", $config['photo']['photo_background'][$type]['img_type'], _upload_photo, $file_name))
		{
			$data['photo'] = $photo;
		}
		else
		{
			$data['photo'] = "";
		}

		$data['mau'] = magic_quote($_POST['mau']);
		$data['background_repeat'] = magic_quote($_POST['background_repeat']);
		$data['background_size'] = magic_quote($_POST['background_size']);
		$data['background_position'] = magic_quote($_POST['background_position']);
		$data['background_attachment'] = magic_quote($_POST['background_attachment']);
		$data['loaihienthi'] = $_POST['loaihienthi'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaytao'] = time();
		$data['type']=$type;
		$data['act']='photo_background';

		if($data['photo']!='' || $data['mau']!='' )
		{
			$d->setTable('photo');

			if($d->insert($data))
				redirect("index.php?com=photo&act=photo_background&type=".$type);
			else
				transfer("Unable to save data!", "index.php?com=photo&act=photo_background&type=".$type);
		}
		else redirect("index.php?com=photo&act=photo_background&type=".$type);
	}
}
/* End Background */

/* Begin Photo Static */
function get_photo_static()
{
	global $d, $item;
	$type=$_REQUEST['type'];

	$sql = "select * from #_photo where act='photo_static' and type='".$type."'";
	$d->query($sql);
	$item = $d->fetch_array();
}

function save_static()
{
	global $d,$config;

	$type=$_REQUEST['type'];

	$file_name = $_FILES['file']['name'];
	$file_name = explode('.',$file_name);
	$file_name = changeTitle($file_name[0]);
	$file_name = $file_name.'_'.date('HisdmY', time());

	$sql = "select * from #_photo where act='photo_static' and type='".$type."'";
	$d->query($sql);
	$item = $d->fetch_array();
	$id=$item['id'];

	/* Begin Post Dữ Liệu */
	foreach($config['lang'] as $key => $value) 
	{
		$data['ten'.$key] = magic_quote($_POST['ten'.$key]);
		$data['mota'.$key] = magic_quote($_POST['mota'.$key]);
		$data['noidung'.$key] = magic_quote($_POST['noidung'.$key]);
	}
	$data['tenkhongdau'] = changeTitle(magic_quote($_POST['tenvi']));
	$data['link'] = magic_quote($_POST['link']);
	$data['link_video'] = magic_quote($_POST['link_video']);
	$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
	$data['type']=$type;
	$data['act']='photo_static';
	/* End Post Dữ Liệu */

	if($id)
	{
		if($photo = upload_image("file", $config['photo']['photo_static'][$type]['img_type'], _upload_photo, $file_name))
		{
			$data['photo'] = $photo;
			if($config['photo']['photo_static'][$type]['flash']!=true)
			{	
				$data['thumb'] = create_thumb($data['photo'], $config['photo']['photo_static'][$type]['thumb_width'], $config['photo']['photo_static'][$type]['thumb_height'], _upload_photo,$file_name,$config['photo']['photo_static'][$type]['thumb_ratio']);
			}
			$d->setTable('photo');
			$d->setWhere('id', $id);
			$d->setWhere('act','photo_static');
			$d->setWhere('type',$type);
			$d->select();
			if($d->num_rows()>0)
			{
				$row = $d->fetch_array();
				delete_file(_upload_photo.$row['photo']);
				delete_file(_upload_photo.$row['thumb']);
			}
		}

		$data['ngaysua'] = time();

		$d->setTable('photo');
		$d->setWhere('id', $id);
		$d->setWhere('act','photo_static');
		$d->setWhere('type',$type);

		if($d->update($data)) redirect("index.php?com=photo&act=photo_static&type=".$type);
		else transfer("Unable to save data!", "index.php?com=photo&act=photo_static&type=".$type);
	}
	else
	{
		if($photo = upload_image("file", $config['photo']['photo_static'][$type]['img_type'], _upload_photo, $file_name))
		{
			$data['photo'] = $photo;
			if($config['photo']['photo_static'][$type]['flash']!=true)
			{
				$data['thumb'] = create_thumb($data['photo'], $config['photo']['photo_static'][$type]['thumb_width'], $config['photo']['photo_static'][$type]['thumb_height'], _upload_photo,$file_name,$config['photo']['photo_static'][$type]['thumb_ratio']);
			}
		}
		else
		{
			$data['photo'] = "";
			$data['thumb'] = "";
		}

		$data['ngaytao'] = time();

		if($data['photo']!='')
		{
			$d->setTable('photo');
			if($d->insert($data)) redirect("index.php?com=photo&act=photo_static&type=".$type);
			else transfer("Unable to save data!", "index.php?com=photo&act=photo_static&type=".$type);	
		}
		else redirect("index.php?com=photo&act=photo_static&type=".$type);
	}
}
/* End Photo Static */

/* Begin Man Photo Pro */
function get_photos()
{
	global $d, $items, $paging;	
	$type=$_REQUEST['type'];
	
	$sql = "select * from #_photo where type='".$type."' and act<>'photo_static' order by stt,id desc ";			
	$d->query($sql);
	$items = $d->result_array();
	
	$curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
	$url="index.php?com=photo&act=man_photo&type=".$type."";
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

	if(!$id)
		transfer("Không nhận được dữ liệu", "index.php?com=photo&act=man_photo&type=".$type."");
	
	$d->setTable('photo');
	$d->setWhere('type', $type);
	$d->setWhere('id', $id);
	$d->select();
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=photo&act=man_photo&type=".$type."");
	$item = $d->fetch_array();
	$d->reset();
}

function save_photo()
{
	global $d, $config;

	$type = $_REQUEST['type'];
	$file_name=fns_Rand_digit(0,9,10);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=photo&act=man_photo&type=".$type."");
	
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";

	if($id)
	{
		if($photo = upload_image("file", $config['photo']['man_photo'][$type]['img_type_photo'], _upload_photo,$file_name))
		{
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], $config['photo']['man_photo'][$type]['thumb_width_photo'], $config['photo']['man_photo'][$type]['thumb_height_photo'], _upload_photo,$file_name,$config['photo']['man_photo'][$type]['thumb_ratio_photo']);
			$d->setTable('photo');
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
		$data['link'] = magic_quote($_POST['link']);
		$data['link_video'] = magic_quote($_POST['link_video']);
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;

		$d->reset();
		$d->setTable('photo');
		$d->setWhere('id', $id);
		$d->setWhere('type', $type);
		if(!$d->update($data)) transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=photo&act=man_photo&type=".$type."");
		redirect("index.php?com=photo&act=man_photo&type=".$type."");
	}
	else
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
			$data['stt'] = $_POST['stt'.$i];
			$data['link'] = magic_quote($_POST['link'.$i]);
			$data['link_video'] = magic_quote($_POST['link_video'.$i]);
			$data['hienthi'] = isset($_POST['hienthi'.$i]) ? 1 : 0;
			$data['type'] = $type;

			if($config['photo']['man_photo'][$type]['images_photo']=='true')
			{
				if($photo = upload_image("file".$i, $config['photo']['man_photo'][$type]['img_type_photo'], _upload_photo,$file_name.$i))
				{
					$data['photo'] = $photo;
					$data['thumb'] = create_thumb($data['photo'], $config['photo']['man_photo'][$type]['thumb_width_photo'], $config['photo']['man_photo'][$type]['thumb_height_photo'], _upload_photo,$file_name.$i,$config['photo']['man_photo'][$type]['thumb_ratio_photo']);

					$d->setTable('photo');
					if(!$d->insert($data)) transfer("Lưu dữ liệu bị lỗi", "index.php?com=photo&act=man_photo&type=".$type."");
				}
			}
			else
			{
				if($data['tenvi']!='' || $data['link']!='' || $data['link_video']!='')
				{		
					$d->setTable('photo');
					if(!$d->insert($data)) transfer("Lưu dữ liệu bị lỗi", "index.php?com=photo&act=man_photo&type=".$type."");
				}
			}
		}
		redirect("index.php?com=photo&act=man_photo&type=".$type."");
	}
}

function delete_photo()
{
	global $d;
	$type=$_REQUEST['type'];
	
	if(isset($_GET['id']))
	{
		$id=themdau($_GET['id']);

		$d->setTable('photo');
		$d->setWhere('id', $id);
		$d->setWhere('type', $type);
		$d->select();
		if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=photo&act=man_photo&type=".$type."");
		$row = $d->fetch_array();
			delete_file(_upload_photo.$row['photo']);		
			delete_file(_upload_photo.$row['thumb']);		
		if($d->delete())
			redirect("index.php?com=photo&act=man_photo&type=".$type."");
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=photo&act=man_photo&type=".$type."");
	}
	elseif (isset($_GET['listid'])==true)
	{
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
		$sql = "select * from #_photo where id='".$id."' and type='".$type."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_photo.$row['photo']);
				delete_file(_upload_photo.$row['thumb']);
			}
			$sql = "delete from #_photo where id='".$id."' and type='".$type."'";
			$d->query($sql);
		}
			
		} redirect("index.php?com=photo&act=man_photo&type=".$type."");
	}
	else transfer("Không nhận được dữ liệu", "index.php?com=photo&act=man_photo&type=".$type."");
}
/* End Man Photo Pro */

?>