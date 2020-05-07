<?php
if(!defined('_source')) die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";

$id=$_REQUEST['id'];

switch($act)
{
	case "man":
		get_items();
		$template = "donhang/man/items";
		break;
	case "edit":		
		get_item();
		$template = "donhang/man/item_add";
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

function get_items()
{
	global $d, $items, $paging;
	
	$sql = "select * from #_donhang where id<>0";	
	if($_REQUEST['keyword']!='')
	{
		$keyword=addslashes($_REQUEST['keyword']);
		$sql.=" and hoten LIKE '%$keyword%'";
	}	
	if((int)$_REQUEST['tinhtrang']!='')
	{
		$sql.=" and tinhtrang=".(int)$_REQUEST['tinhtrang']."";
	}
	$sql.=" order by ngaytao desc";
	$d->query($sql);
	$items = $d->result_array();
	
	$curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
	$url="index.php?com=order&act=man&tinhtrang=".$_GET['tinhtrang'];
	$maxR=10;
	$maxP=10;
	$paging=paging($items, $url, $curPage, $maxR, $maxP);
	$items=$paging['source'];
}

function get_item()
{
	global $d, $item;

	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id) transfer("Không nhận được dữ liệu", "index.php?com=order&act=man");
	
	$sql = "select * from #_donhang where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=order&act=man");
	$item = $d->fetch_array();	
}

function save_item()
{
	global $d;

	$file_name=fns_Rand_digit(0,9,12);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=order&act=man");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	
	/* Begin Post Dữ Liệu */
	$data['ghichu'] = magic_quote($_POST['ghichu']);
	$data['tinhtrang'] = $_POST['tinhtrang'];
	/* End Post Dữ Liệu */

	if($id)
	{				
		$d->setTable('donhang');
		$d->setWhere('id', $id);
		if($d->update($data)) redirect("index.php?com=order&act=man&curPage=".$_REQUEST['curPage']);
		else transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=order&act=man");
	}
	else
	{
		$d->setTable('donhang');
		if($d->insert($data)) redirect("index.php?com=order&act=man");
		else transfer("Lưu dữ liệu bị lỗi", "index.php?com=order&act=man");
	}
}

function delete_item()
{
	global $d;

	if($_REQUEST['curPage']!='')
	{
		$id_catt.="&curPage=".$_REQUEST['curPage'];
	}
	if(isset($_GET['id']))
	{
		$id =  themdau($_GET['id']);
		$d->reset();
		$sql = "delete from #_donhang_detail where id_order='".$id."'";
		$d->query($sql);

		$d->reset();
		$sql = "delete from #_donhang where id='".$id."'";
		$d->query($sql);
		if($d->query($sql)) redirect("index.php?com=order&act=man".$id_catt);
		else transfer("Xóa dữ liệu bị lỗi", "index.php?com=order&act=man");
	}
	else transfer("Không nhận được dữ liệu", "index.php?com=order&act=man");
}
?>