<?php	if(!defined('_source')) die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";

switch($act)
{
	case "man":
		get_items();
		$template = "map/items";
		break;
	case "add":
		$template = "map/item_add";
		break;
	case "edit":		
		get_item();		
		$template = "map/item_add";
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
		
	$sql = "select * from #_map where id<>0";
	if($_REQUEST['keyword']!='')
	{
		$keyword=addslashes($_REQUEST['keyword']);
		$sql.=" and (tenvi LIKE '%$keyword%' or tenen LIKE '%$keyword%')";
	}		
	$sql.="  order by stt asc, id desc";
	$d->query($sql);
	$items = $d->result_array();
	
	$curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
	$url="index.php?com=map&act=man";
	$maxR=10;
	$maxP=10;
	$paging=paging($items, $url, $curPage, $maxR, $maxP);
	$items=$paging['source'];
}

function get_item()
{
	global $d, $item;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", "index.php?com=map&act=man");
	
	$sql = "select * from #_map where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=map&act=man");
	$item = $d->fetch_array();
}

function save_item()
{
	global $d,$config;
	$file_name=fns_Rand_digit(0,9,12);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=map&act=man");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";

	/* Begin Post Dữ Liệu */
	foreach($config['lang'] as $key => $value) 
	{
		$data['ten'.$key] = magic_quote($_POST['ten'.$key]);
		$data['diachi'.$key] = magic_quote($_POST['diachi'.$key]);
	}
	$data['tenkhongdau'] = changeTitle(magic_quote($_POST['tenvi']));
	$data['dienthoai'] = magic_quote($_POST['dienthoai']);
	$data['email'] = magic_quote($_POST['email']);
	$data['toado'] = magic_quote($_POST['toado']);
	$data['stt'] = $_POST['stt'];
	$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
	/* End Post Dữ Liệu */

	if($id)
	{
		if($photo = upload_image("file", $config['map']['img_type'],_upload_news,$file_name))
		{
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], $config['map']['thumb_width'], $config['map']['thumb_height'], _upload_news,$file_name,$config['map']['thumb_ratio']);
			$d->setTable('map');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0)
			{
				$row = $d->fetch_array();
				delete_file(_upload_news.$row['photo']);
				delete_file(_upload_news.$row['thumb']);
			}
		}

		$data['ngaysua'] = time();
		
		$d->setTable('map');
		$d->setWhere('id', $id);
		if($d->update($data)) redirect("index.php?com=map&act=man");
		else transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=map&act=man");
	}
	else
	{
		if($photo = upload_image("file", $config['map']['img_type'],_upload_news,$file_name))
		{
		 	$data['photo'] = $photo;
		 	$data['thumb'] = create_thumb($data['photo'], $config['map']['thumb_width'], $config['map']['thumb_height'], _upload_news,$file_name,$config['map']['thumb_ratio']);
		}

		$data['ngaytao'] = time();
		
		$d->setTable('map');
		if($d->insert($data)) redirect("index.php?com=map&act=man");
		else transfer("Lưu dữ liệu bị lỗi", "index.php?com=map&act=man");
	}
}

function delete_item()
{
	global $d;
	
	if(isset($_GET['id']))
	{
		$id =  themdau($_GET['id']);
		
		$d->reset();
		$sql = "select * from #_map where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0)
		{
			while($row = $d->fetch_array())
			{
				delete_file(_upload_news.$row['photo']);
				delete_file(_upload_news.$row['thumb']);
			}
			$sql = "delete from #_map where id='".$id."'";
			$d->query($sql);
		}
		
		if($d->query($sql))
			redirect("index.php?com=map&act=man");
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=map&act=man");
	}
	elseif (isset($_GET['listid'])==true)
	{
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
		$sql = "select * from #_map where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0)
		{
			while($row = $d->fetch_array())
			{
				delete_file(_upload_product.$row['photo']);
				delete_file(_upload_product.$row['thumb']);
			}
			$sql = "delete from #_map where id='".$id."'";
			$d->query($sql);
		}	
	} 
	redirect("index.php?com=map&act=man");} else transfer("Không nhận được dữ liệu", "index.php?com=map&act=man");
}
?>