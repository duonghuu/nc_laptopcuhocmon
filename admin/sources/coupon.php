<?php	if(!defined('_source')) die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";

switch($act)
{
	case "man":
		get_items();
		$template = "coupon/man/items";
		break;
	case "add":
		$template = "coupon/man/item_add";
		break;
	case "edit":
		get_item();
		$template = "coupon/man/item_add";
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

	$sql = "select * from #_coupon order by stt,id desc";
	$d->query($sql);
	$items = $d->result_array();
	
	$curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
	$url="index.php?com=coupon&act=man";
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
		transfer("Không nhận được dữ liệu", "index.php?com=coupon&act=man");
	
	$sql = "select * from #_coupon where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=coupon&act=man");
	$item = $d->fetch_array();
}

function save_item()
{
	global $d;
	
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=coupon&act=man");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";

	if($id)
	{
		$id =  themdau($_POST['id']);
		$data['ma'] = $_POST['ma'];
		$data['phantram'] = (int)$_POST['phantram'];		
		$data['loai'] = (int)$_POST['loai'];
		$data['ngaybatdau'] = strtotime($_POST['ngaybatdau']);
		$data['ngayketthuc'] = strtotime($_POST['ngayketthuc']);
		$data['tinhtrang'] = (int)$_POST['tinhtrang'];
		$data['stt'] = $_POST['stt'];
		
		$d->setTable('coupon');
		$d->setWhere('id', $id);
		if($d->update($data))
			redirect("index.php?com=coupon&act=man");
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=coupon&act=man");
	}
	else
	{ 
		$nm=(int)$_REQUEST['nm'];
		for($i=0;$i<$nm;$i++)
		{
			if((int)$_POST['phantram']>0)
			{
				$data['phantram'] = (int)$_POST['phantram'];		
				$data['loai'] = (int)$_POST['loai'];
				$data['ngaybatdau'] = strtotime($_POST['ngaybatdau']);
				$data['ngayketthuc'] = strtotime($_POST['ngayketthuc']);
				$data['ma'] = $_POST['ma'.$i];
				$data['stt'] = $i+1;
				$data['tinhtrang'] = 0;
				$d->setTable('coupon');
				$d->insert($data);
			}
		}
		redirect("index.php?com=coupon&act=man");
	}
}

function delete_item()
{
	global $d;
	
	if(isset($_GET['id']))
	{
		$id =  themdau($_GET['id']);

		$sql = "delete from #_coupon where id='".$id."'";
		if($d->query($sql))
			header("Location:index.php?com=coupon&act=man");
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=coupon&act=man");
	}
	elseif (isset($_GET['listid'])==true)
	{
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
		$sql = "select * from #_coupon where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			$sql = "delete from #_coupon where id='".$id."'";
			$d->query($sql);
		}
			
		} redirect("index.php?com=coupon&act=man&curPage=".@$_REQUEST['curPage']."");
	}
	else transfer("Không nhận được dữ liệu", "index.php?com=coupon&act=man");
}
?>