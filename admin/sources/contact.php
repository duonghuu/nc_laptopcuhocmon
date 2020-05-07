<?php	if(!defined('_source')) die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";

switch($act)
{
	case "man":
		get_items();
		$template = "contact/man/items";
		break;
	case "add":
		$template = "contact/man/item_add";
		break;
	case "edit":
		get_item();
		$template = "contact/man/item_add";
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
	
	$sql = "select * from #_contact order by id desc";
	$d->query($sql);
	$items = $d->result_array();
	
	$curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
	$url="index.php?com=contact&act=man";
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
		transfer("Không nhận được dữ liệu", "index.php?com=contact&act=man");
	
	$sql = "select * from #_contact where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=contact&act=man");
	$item = $d->fetch_array();
}

function save_item()
{
	global $d;

	$file_name=fns_Rand_digit(0,9,8);
	$file_contact=fns_Rand_digit(0,9,5);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=contact&act=man");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";

	/* Begin Post Dữ Liệu */
	$data['ten'] = magic_quote($_POST['ten']);
	$data['diachi'] = magic_quote($_POST['diachi']);
	$data['dienthoai'] = magic_quote($_POST['dienthoai']);
	$data['noidung'] = magic_quote($_POST['noidung']);
	$data['ghichu'] = magic_quote($_POST['ghichu']);
	$data['email'] = magic_quote($_POST['email']);
	$data['stt'] = magic_quote($_POST['stt']);
	/* End Post Dữ Liệu */

	if($id)
	{
		if($file = upload_image("file",'doc|docx|pdf|rar|zip|ppt|pptx|DOC|DOCX|PDF|RAR|ZIP|PPT|PPTX|xls|jpg|png|gif|JPG|PNG|GIF|xls|XLS',_upload_file,$file_name))
		{
			$data['file'] = $file;			
			$d->setTable('contact');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0)
			{
				$row = $d->fetch_array();
				delete_file(_upload_file.$row['file']);				
			}
		}

		$data['hienthi'] = 1;
		$data['ngaysua'] = time();
		
		$d->setTable('contact');
		$d->setWhere('id', $id);
		if($d->update($data)) redirect("index.php?com=contact&act=man");
		else transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=contact&act=man");
	}
	else
	{
		if($file = upload_image("file",'doc|docx|pdf|rar|zip|ppt|pptx|DOC|DOCX|PDF|RAR|ZIP|PPT|PPTX|xls|jpg|png|gif|JPG|PNG|GIF|xls|XLS',_upload_file,$file_name))
		{
			$data['file'] = $file;			
		}

		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaytao'] = time();

		$d->setTable('contact');
		if($d->insert($data)) redirect("index.php?com=contact&act=man");
		else transfer("Lưu dữ liệu bị lỗi", "index.php?com=contact&act=man");
	}
}

function delete_item()
{
	global $d;
	
	if(isset($_GET['id']))
	{
		$id =  themdau($_GET['id']);

		$d->reset();
		$sql = "select * from #_contact where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_file.$row['file']);
			}
			$sql = "delete from #_contact where id='".$id."'";
			$d->query($sql);
		}
		
		if($d->query($sql))
			header("Location:index.php?com=contact&act=man");
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=contact&act=man");
	}
	elseif (isset($_GET['listid'])==true)
	{
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
		$sql = "select * from #_contact where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_file.$row['file']);
			}
			$sql = "delete from #_contact where id='".$id."'";
			$d->query($sql);
		}
			
		} redirect("index.php?com=contact&act=man");
	}
	else transfer("Không nhận được dữ liệu", "index.php?com=contact&act=man");
}

?>