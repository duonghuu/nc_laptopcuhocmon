<?php	if(!defined('_source')) die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";

switch($act)
{
	case "man":
		get_items();
		$template = "yahoo/man/items";
		break;
	case "add":
		$template = "yahoo/man/item_add";
		break;
	case "edit":
		get_item();
		$template = "yahoo/man/item_add";
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

	$sql = "select * from #_yahoo order by stt,ten";
	$d->query($sql);
	$items = $d->result_array();
	
	$curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
	$url="index.php?com=yahoo&act=man";
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
		transfer("Không nhận được dữ liệu", "index.php?com=yahoo&act=man");
	
	$sql = "select * from #_yahoo where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=yahoo&act=man");
	$item = $d->fetch_array();
}

function save_item()
{
	global $d, $config;
	$file_name=fns_Rand_digit(0,9,12);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=yahoo&act=man");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";

	/* Begin Post Dữ Liệu */
	$data['ten'] = magic_quote($_POST['ten']);
	$data['viber'] = magic_quote($_POST['viber']);
	$data['zalo'] = magic_quote($_POST['zalo']);
	$data['skype'] = magic_quote($_POST['skype']);
	$data['email'] = magic_quote($_POST['email']);
	$data['dienthoai'] = magic_quote($_POST['dienthoai']);
	$data['stt'] = $_POST['stt'];
	$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
	/* End Post Dữ Liệu */

	if($id)
	{
		if($photo = upload_image("file", $config['yahoo']['img_type'], _upload_photo,$file_name))
		{
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], $config['yahoo']['thumb_width'], $config['yahoo']['thumb_height'], _upload_photo,$file_name,$config['yahoo']['thumb_ratio']);
			$d->setTable('yahoo');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0)
			{
				$row = $d->fetch_array();
				delete_file(_upload_photo.$row['photo']);				
				delete_file(_upload_photo.$row['thumb']);				
			}
		}

		$data['ngaysua'] = time();
		
		$d->setTable('yahoo');
		$d->setWhere('id', $id);
		if($d->update($data)) redirect("index.php?com=yahoo&act=man&curPage=".$_REQUEST['curPage']."");
		else transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=yahoo&act=man");
	}
	else
	{ 
		if($photo = upload_image("file", $config['yahoo']['img_type'], _upload_photo,$file_name))
		{
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], $config['yahoo']['thumb_width'], $config['yahoo']['thumb_height'], _upload_photo,$file_name,$config['yahoo']['thumb_ratio']);
		}

		$data['ngaytao'] = time();
		
		$d->setTable('yahoo');
		if($d->insert($data)) redirect("index.php?com=yahoo&act=man&curPage=".$_REQUEST['curPage']."");
		else transfer("Lưu dữ liệu bị lỗi", "index.php?com=yahoo&act=man");
	}
}

function delete_item()
{
	global $d;
	
	if(isset($_GET['id']))
	{
		$id =  themdau($_GET['id']);

		$d->reset();
		$sql = "select * from #_yahoo where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_photo.$row['photo']);
				delete_file(_upload_photo.$row['thumb']);
			}
			$sql = "delete from #_yahoo where id='".$id."'";
			$d->query($sql);
		}

		if($d->query($sql))
			header("Location:index.php?com=yahoo&act=man");
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=yahoo&act=man");
	}
	elseif (isset($_GET['listid'])==true)
	{
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
		$sql = "select * from #_yahoo where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_photo.$row['photo']);
				delete_file(_upload_photo.$row['thumb']);
			}
			$sql = "delete from #_yahoo where id='".$id."'";
			$d->query($sql);
		}
			
		} redirect("index.php?com=yahoo&act=man");
	}
	else transfer("Không nhận được dữ liệu", "index.php?com=yahoo&act=man");
}

?>