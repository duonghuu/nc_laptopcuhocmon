<?php	if(!defined('_source')) die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
$id=$_REQUEST['id'];

switch($act)
{

	case "man":
		get_items();
		$template = "lang/man/items";
		break;
	case "add":		
		$template = "lang/man/item_add";
		break;
	case "edit":		
		get_item();
		$template = "lang/man/item_add";
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

	$sql = "select * from #_lang";	
	
	if($_REQUEST['keyword']!='')
	{
	$keyword=addslashes($_REQUEST['keyword']);
	$sql.=" where giatri LIKE '%$keyword%'";
	}
	$sql.=" order by stt,id desc";
	
	$d->query($sql);
	$items = $d->result_array();
	
	// $curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
	// $url="index.php?com=lang&act=man";
	// $maxR=10;
	// $maxP=10;
	// $paging=paging($items, $url, $curPage, $maxR, $maxP);
	// $items=$paging['source'];
}

function get_item()
{
	global $d, $item,$ds_tags;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", "index.php?com=lang&act=man");	
	$sql = "select * from #_lang where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=lang&act=man");
	$item = $d->fetch_array();	
}

function save_item()
{
	global $d;
	$file_name=fns_Rand_digit(0,9,12);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=lang&act=man");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	
	/* Begin Post Dữ Liệu */
	$data['giatri'] = magic_quote($_POST['giatri']);
	$data['langvi'] = magic_quote($_POST['langvi']);
	$data['langcn'] = magic_quote($_POST['langcn']);
	$data['langen'] = magic_quote($_POST['langen']);
	$data['langjp'] = magic_quote($_POST['langjp']);
	$data['langko'] = magic_quote($_POST['langko']);
	$data['langfr'] = magic_quote($_POST['langfr']);
	/* End Post Dữ Liệu */

	if($id)
	{								
		$d->setTable('lang');
		$d->setWhere('id', $id);
		if($d->update($data)) redirect("index.php?com=lang&act=man&curPage=".$_REQUEST['curPage']."");
		else transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=lang&act=man");
	}
	else
	{	
		$d->setTable('lang');
		if(!$d->insert($data)) transfer("Lưu dữ liệu bị lỗi", "index.php?com=lang&act=man");
		redirect("index.php?com=lang&act=man");
	}
}

function delete_item()
{
	global $d;

	if(isset($_GET['id']))
	{
		$id =  themdau($_GET['id']);
		$d->reset();
		$sql = "delete from #_lang where id='".$id."'";

		if($d->query($sql))
			redirect("index.php?com=lang&act=man");
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=lang&act=man");
	}
	elseif (isset($_GET['listid'])==true)
	{
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++)
		{
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
			$sql = "delete from #_lang where id='".$id."'";
			$d->query($sql);
		} 
		redirect("index.php?com=lang&act=man");
	}
	else 
		transfer("Không nhận được dữ liệu", "index.php?com=lang&act=man");
}

?>