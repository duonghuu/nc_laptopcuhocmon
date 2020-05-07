<?php	if(!defined('_source')) die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
$type=$_REQUEST['type'];

switch($act)
{
	case "man":
		get_items();
		$template = "download/man/items";
		break;
	case "add":
		$template = "download/man/item_add";
		break;
	case "edit":		
		get_item();		
		$template = "download/man/item_add";
		break;
	case "save":
		save_item();
		break;
	case "delete":
		delete_item();
		break;	
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

function get_items()
{
	global $d, $items, $paging;
	$type=$_REQUEST['type'];
	
	$sql = "select * from #_download where id<>0";
	if($_REQUEST['keyword']!='')
	{
	$keyword=addslashes($_REQUEST['keyword']);
	$sql.=" and (tenvi LIKE '%$keyword%' or tenen LIKE '%$keyword%')";
	}
	$sql.=" and type='".$type."' order by stt,id desc";
	
	$d->query($sql);
	$items = $d->result_array();
	
	$curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
	$url="index.php?com=download&act=man&type=".$type."";
	$maxR=10;
	$maxP=10;
	$paging=paging($items, $url, $curPage, $maxR, $maxP);
	$items=$paging['source'];
}

function get_item()
{
	global $d, $item;
	$type=$_REQUEST['type'];
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", "index.php?com=download&act=man&type=".$type."");
	
	$sql = "select * from #_download where id='".$id."' and type='".$type."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=download&act=man&type=".$type."");
	$item = $d->fetch_array();
}

function save_item()
{
	global $d,$config;

	$type=$_REQUEST['type'];
	$file_name=fns_Rand_digit(0,9,8);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=download&act=man&type=".$type."");
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
		if($file = upload_image("file", $config['download'][$type]['file_type'],_upload_file,$file_name))
		{
			$data['file'] = $file;			
			$d->setTable('download');
			$d->setWhere('id', $id);
			$d->setWhere('type', $type);
			$d->select();
			if($d->num_rows()>0)
			{
				$row = $d->fetch_array();
				delete_file(_upload_file.$row['file']);				
			}
		}

		if($photo = upload_image("file_hinh", $config['download'][$type]['img_type'],_upload_photo,$file_name."_hinh"))
		{
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], $config['download'][$type]['thumb_width'], $config['download'][$type]['thumb_height'], _upload_photo,$file_name."_hinh",$config['download'][$type]['thumb_ratio']);		
			$d->setTable('download');
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

		$data['ngaysua'] = time();
		
		$d->setTable('download');
		$d->setWhere('id', $id);
		$d->setWhere('type', $type);
		if($d->update($data)) redirect("index.php?com=download&act=man&type=".$type."");
		else transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=download&act=man&type=".$type."");
	}
	else
	{
		if($file = upload_image("file", $config['download'][$type]['file_type'],_upload_file,$file_name))
		{
			$data['file'] = $file;			
		}

		if($photo = upload_image("file_hinh", $config['download'][$type]['img_type'],_upload_photo,$file_name."_hinh"))
		{
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], $config['download'][$type]['thumb_width'], $config['download'][$type]['thumb_height'], _upload_photo,$file_name."_hinh",$config['download'][$type]['thumb_ratio']);			
		}		
		
		$data['ngaytao'] = time();
		
		$d->setTable('download');
		if($d->insert($data)) redirect("index.php?com=download&act=man&type=".$type."");
		else transfer("Lưu dữ liệu bị lỗi", "index.php?com=download&act=man&type=".$type."");
	}
}

function delete_item()
{
	global $d;
	$type=$_REQUEST['type'];
	if(isset($_GET['id']))
	{
		$id =  themdau($_GET['id']);
		
		$d->reset();
		$sql = "select * from #_download where id='".$id."' and type='".$type."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_file.$row['file']);			
				delete_file(_upload_photo.$row['photo']);			
				delete_file(_upload_photo.$row['thumb']);			
			}
			$sql = "delete from #_download where id='".$id."' and type='".$type."'";
			$d->query($sql);
		}
		if($d->query($sql))
			redirect("index.php?com=download&act=man&type=".$type."");
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=download&act=man&type=".$type."");
	}
	elseif (isset($_GET['listid'])==true)
	{
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
		$sql = "select * from #_download where id='".$id."' and type='".$type."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_file.$row['file']);			
				delete_file(_upload_photo.$row['photo']);			
				delete_file(_upload_photo.$row['thumb']);			
			}
			$sql = "delete from #_download where id='".$id."' and type='".$type."'";
			$d->query($sql);
		}
			
		} redirect("index.php?com=download&act=man&type=".$type."");
	} 
	else transfer("Không nhận được dữ liệu", "index.php?com=download&act=man&type=".$type."");
}

?>