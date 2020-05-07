<?php	if(!defined('_source')) die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
$urldanhmuc ="";
$urldanhmuc.= (isset($_REQUEST['id_list'])) ? "&id_list=".addslashes($_REQUEST['id_list']) : "";
$urldanhmuc.= (isset($_REQUEST['id_cat'])) ? "&id_cat=".addslashes($_REQUEST['id_cat']) : "";
$urldanhmuc.= (isset($_REQUEST['id_item'])) ? "&id_item=".addslashes($_REQUEST['id_item']) : "";
$urldanhmuc.= (isset($_REQUEST['keyword'])) ? "&keyword=".addslashes($_REQUEST['keyword']) : "";

$id=$_REQUEST['id'];

switch($act)
{
	/* Begin Man Chi Nhánh */
	case "man":
		get_items();
		$template = "tinhthanh_quanhuyen/man/items";
		break;
	case "add":		
		$template = "tinhthanh_quanhuyen/man/item_add";
		break;
	case "edit":		
		get_item();
		$template = "tinhthanh_quanhuyen/man/item_add";
		break;
	case "save":
		save_item();
		break;
	case "delete":
		delete_item();
		break;
	/* End Man Chi Nhánh */

	/* Begin Tỉnh Thành */
	case "man_list":
		get_lists();
		$template = "tinhthanh_quanhuyen/list/lists";
		break;
	case "add_list":		
		$template = "tinhthanh_quanhuyen/list/list_add";
		break;
	case "edit_list":		
		get_list();
		$template = "tinhthanh_quanhuyen/list/list_add";
		break;
	case "save_list":
		save_list();
		break;
	case "delete_list":
		delete_list();
		break;
	/* End Tỉnh Thành */

	/* Begin Quận Huyện */
	case "man_cat":
		get_cats();
		$template = "tinhthanh_quanhuyen/cat/cats";
		break;
	case "add_cat":		
		$template = "tinhthanh_quanhuyen/cat/cat_add";
		break;
	case "edit_cat":		
		get_cat();
		$template = "tinhthanh_quanhuyen/cat/cat_add";
		break;
	case "save_cat":
		save_cat();
		break;
	case "delete_cat":
		delete_cat();
		break;
	/* End Quận Huyện */

	/* Begin Phường Xã */
	case "man_item":
		get_loais();
		$template = "tinhthanh_quanhuyen/item/loais";
		break;
	case "add_item":		
		$template = "tinhthanh_quanhuyen/item/loai_add";
		break;
	case "edit_item":		
		get_loai();
		$template = "tinhthanh_quanhuyen/item/loai_add";
		break;
	case "save_item":
		save_loai();
		break;
	case "delete_item":
		delete_loai();
		break;
	/* End Phường Xã */

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

/* Begin Man Chi Nhánh */
function get_items()
{
	global $d, $items, $paging, $urldanhmuc;

	$sql = "select * from #_chinhanh where id<>0";	
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
	$sql.=" order by stt,id desc";

	$d->query($sql);
	$items = $d->result_array();
}

function get_item()
{
	global $d, $item;
	
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", "index.php?com=tinhthanh_quanhuyen&act=man");	
	$sql = "select * from #_chinhanh where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=tinhthanh_quanhuyen&act=man");
	$item = $d->fetch_array();
}

function save_item()
{
	global $d, $config;

	$file_name=fns_Rand_digit(0,9,12);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=tinhthanh_quanhuyen&act=man");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	
	/* Begin Post Dữ Liệu */
	foreach($config['lang'] as $key => $value) 
	{
		$data['ten'.$key] = magic_quote($_POST['ten'.$key]);
		$data['mota'.$key] = magic_quote($_POST['mota'.$key]);
		$data['noidung'.$key] = magic_quote($_POST['noidung'.$key]);
	}
	$data['id_list'] = (int)$_POST['id_list'];			
	$data['id_cat'] = (int)$_POST['id_cat'];		
	$data['id_item'] = (int)$_POST['id_item'];
	$data['tenkhongdau'] = changeTitle(magic_quote($_POST['tenvi']));
	$data['toado_iframe'] = magic_quote($_POST['toado_iframe']);				
	$data['toado'] = magic_quote($_POST['toado']);				
	$data['loai'] = magic_quote($_POST['loai']);				
	$data['dienthoai'] = magic_quote($_POST['dienthoai']);
	$data['stt'] = $_POST['stt'];
	$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
	/* End Post Dữ Liệu */

	if($id)
	{
		if($photo = upload_image("file", $config['tinhthanh_quanhuyen']['img_type'], _upload_news,$file_name))
		{
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], $config['tinhthanh_quanhuyen']['thumb_width'], $config['tinhthanh_quanhuyen']['thumb_height'], _upload_news,$file_name,$config['tinhthanh_quanhuyen']['thumb_ratio']);			
			$d->setTable('chinhanh');
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

		$d->setTable('chinhanh');
		$d->setWhere('id', $id);
		if($d->update($data)) redirect("index.php?com=tinhthanh_quanhuyen&act=man");
		else transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=tinhthanh_quanhuyen&act=man");
	}
	else
	{
		if($photo = upload_image("file", $config['tinhthanh_quanhuyen']['img_type'], _upload_news,$file_name))
		{
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], $config['tinhthanh_quanhuyen']['thumb_width'], $config['tinhthanh_quanhuyen']['thumb_height'], _upload_news,$file_name,$config['tinhthanh_quanhuyen']['thumb_ratio']);
		}	

		$data['ngaytao'] = time();

		$d->setTable('chinhanh');
		if($d->insert($data)) redirect("index.php?com=tinhthanh_quanhuyen&act=man");
		else transfer("Lưu dữ liệu bị lỗi", "index.php?com=tinhthanh_quanhuyen&act=man");
	}
}

function delete_item()
{
	global $d;

	if(isset($_GET['id']))
	{
		$id =  themdau($_GET['id']);
		
		$d->reset();
		$sql = "select * from #_chinhanh where id='".$id."'";
		$d->query($sql);

		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_news.$row['photo']);
				delete_file(_upload_news.$row['thumb']);
			}
			$sql = "delete from #_chinhanh where id='".$id."'";
			$d->query($sql);
		}
		
		if($d->query($sql))
		{
			redirect("index.php?com=tinhthanh_quanhuyen&act=man");
		}
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=tinhthanh_quanhuyen&act=man");
	}
	elseif (isset($_GET['listid'])==true)
	{
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++)
		{
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
			$sql = "select * from #_chinhanh where id='".$id."'";
			$d->query($sql);
			
			if($d->num_rows()>0)
			{
				while($row = $d->fetch_array())
				{
					delete_file(_upload_news.$row['photo']);
					delete_file(_upload_news.$row['thumb']);
				}
				$sql = "delete from #_chinhanh where id='".$id."'";
				$d->query($sql);
			}	
		} 
		redirect("index.php?com=tinhthanh_quanhuyen&act=man");
	} 
	else transfer("Không nhận được dữ liệu", "index.php?com=tinhthanh_quanhuyen&act=man");
}
/* End Man Chi Nhánh */

/* Begin Tỉnh Thành */
function get_lists()
{
	global $d, $items, $paging, $urldanhmuc;
	
	$sql = "select * from #_tinhthanh where id<>0";	

	if($_REQUEST['keyword']!='')
	{
	$keyword=addslashes($_REQUEST['keyword']);
	$sql.=" and (ten LIKE '%$keyword%')";
	}		
	$sql.=" order by stt,id desc";
	
	$d->query($sql);
	$items = $d->result_array();
	
	$curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
	$url="index.php?com=tinhthanh_quanhuyen".$urldanhmuc."&act=man_list";
	$maxR=10;
	$maxP=10;
	$paging=paging($items, $url, $curPage, $maxR, $maxP);
	$items=$paging['source'];
}

function get_list()
{
	global $d, $item;

	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
	transfer("Không nhận được dữ liệu", "index.php?com=tinhthanh_quanhuyen&act=man_list");	
	$sql = "select * from #_tinhthanh where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=tinhthanh_quanhuyen&act=man_list");
	$item = $d->fetch_array();	
}

function save_list()
{
	global $d;

	$file_name=fns_Rand_digit(0,9,12);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=tinhthanh_quanhuyen&act=man_list");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";

	/* Begin Post Dữ Liệu */
	$data['ten'] = magic_quote($_POST['ten']);
	$data['tenkhongdau'] = changeTitle(magic_quote($_POST['ten']));
	$data['stt'] = $_POST['stt'];
	$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
	/* End Post Dữ Liệu */

	if($id)
	{
		$data['ngaysua'] = time();
		
		$d->setTable('tinhthanh');
		$d->setWhere('id', $id);
		if($d->update($data)) redirect("index.php?com=tinhthanh_quanhuyen&act=man_list");
		else transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=tinhthanh_quanhuyen&act=man_list");
	}
	else
	{
		$data['ngaytao'] = time();
		
		$d->setTable('tinhthanh');
		if($d->insert($data)) redirect("index.php?com=tinhthanh_quanhuyen&act=man_list");
		else transfer("Lưu dữ liệu bị lỗi", "index.php?com=tinhthanh_quanhuyen&act=man_list");
	}
}

function delete_list()
{
	global $d;
	
	if(isset($_GET['id']))
	{
		$id =  themdau($_GET['id']);		
		$d->reset();		
		
		$sql = "delete from #_tinhthanh where id='".$id."'";
		$d->query($sql);
	
		if($d->query($sql))
			redirect("index.php?com=tinhthanh_quanhuyen&act=man_list");
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=tinhthanh_quanhuyen&act=man_list");
	}
	elseif (isset($_GET['listid'])==true)
	{
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
		$sql = "select * from #_tinhthanh where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			$sql = "delete from #_tinhthanh where id='".$id."'";
			$d->query($sql);
		}
			
		} redirect("index.php?com=tinhthanh_quanhuyen&act=man_list");
	}
	else transfer("Không nhận được dữ liệu", "index.php?com=tinhthanh_quanhuyen&act=man_list");
}
/* End Tỉnh Thành */

/* Begin Quận Huyện */
function get_cats()
{
	global $d, $items, $paging, $urldanhmuc;
	
	$sql = "select * from #_quanhuyen where id<>0";
		
	if((int)$_REQUEST['id_list']!='')
	{
	$sql.=" and id_list=".$_REQUEST['id_list']."";
	}

	if($_REQUEST['keyword']!='')
	{
	$keyword=addslashes($_REQUEST['keyword']);
	$sql.=" and (ten LIKE '%$keyword%')";
	}
	$sql.=" order by stt";
	
	$d->query($sql);
	$items = $d->result_array();
	
	$curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
	$url="index.php?com=tinhthanh_quanhuyen".$urldanhmuc."&act=man_cat";
	$maxR=10;
	$maxP=10;
	$paging=paging($items, $url, $curPage, $maxR, $maxP);
	$items=$paging['source'];
}

function get_cat()
{
	global $d, $item;
	
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
	transfer("Không nhận được dữ liệu", "index.php?com=tinhthanh_quanhuyen&act=man_cat");
	
	$sql = "select * from #_quanhuyen where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=tinhthanh_quanhuyen&act=man_cat");
	$item = $d->fetch_array();
}

function save_cat()
{
	global $d;

	$file_name=fns_Rand_digit(0,9,12);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=tinhthanh_quanhuyen&act=man_cat");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";

	/* Begin Post Dữ Liệu */
	$data['id_list'] = $_POST['id_list'];
	$data['ten'] = magic_quote($_POST['ten']);
	$data['tenkhongdau'] = changeTitle(magic_quote($_POST['ten']));
	$data['stt'] = $_POST['stt'];
	$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
	/* End Post Dữ Liệu */

	if($id)
	{
		$data['ngaysua'] = time();
		
		$d->setTable('quanhuyen');
		$d->setWhere('id', $id);
		if($d->update($data)) redirect("index.php?com=tinhthanh_quanhuyen&act=man_cat");
		else transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=tinhthanh_quanhuyen&act=man_cat");
	}
	else
	{
		$data['ngaytao'] = time();
		
		$d->setTable('quanhuyen');
		if($d->insert($data)) redirect("index.php?com=tinhthanh_quanhuyen&act=man_cat");
		else transfer("Lưu dữ liệu bị lỗi", "index.php?com=tinhthanh_quanhuyen&act=man_cat");
	}
}

function delete_cat()
{
	global $d;

	if(isset($_GET['id']))
	{
		$id =  themdau($_GET['id']);		
		$d->reset();		
		$sql = "delete from #_quanhuyen where id='".$id."'";
		$d->query($sql);
		
		if($d->query($sql))
			redirect("index.php?com=tinhthanh_quanhuyen&act=man_cat");
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=tinhthanh_quanhuyen&act=man_cat");
	}
	elseif (isset($_GET['listid'])==true)
	{
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
		$sql = "select * from #_quanhuyen where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			$sql = "delete from #_quanhuyen where id='".$id."'";
			$d->query($sql);
		}
			
		} redirect("index.php?com=tinhthanh_quanhuyen&act=man_cat");
	}
	else transfer("Không nhận được dữ liệu", "index.php?com=tinhthanh_quanhuyen&act=man_cat");
}
/* End Quận Huyện */

/* Begin Phường Xã */
function get_loais()
{
	global $d, $items, $paging, $urldanhmuc;
	
	$sql = "select * from #_phuongxa where id<>0";
		
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
	$sql.=" and (ten LIKE '%$keyword%')";
	}
	$sql.=" order by id asc";
	
	$d->query($sql);
	$items = $d->result_array();
	
	$curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
	$url="index.php?com=tinhthanh_quanhuyen".$urldanhmuc."&act=man_item";
	$maxR=10;
	$maxP=10;
	$paging=paging($items, $url, $curPage, $maxR, $maxP);
	$items=$paging['source'];
}

function get_loai()
{
	global $d, $item;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
	transfer("Không nhận được dữ liệu", "index.php?com=tinhthanh_quanhuyen&act=man_item");
	
	$sql = "select * from #_phuongxa where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=tinhthanh_quanhuyen&act=man_item");
	$item = $d->fetch_array();
}

function save_loai()
{
	global $d,$config;

	$file_name=fns_Rand_digit(0,9,12);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=tinhthanh_quanhuyen&act=man_item");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";

	/* Begin Post Dữ Liệu */
	$data['id_list'] = $_POST['id_list'];	
	$data['id_cat']= $_POST['id_cat'];
	$data['ten'] = magic_quote($_POST['ten']);
	$data['tenkhongdau'] = changeTitle(magic_quote($_POST['ten']));
	$data['gia'] = (int)$_POST['gia'];	
	$data['stt'] = $_POST['stt'];
	$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
	/* End Post Dữ Liệu */

	if($id)
	{
		$data['ngaysua'] = time();
		
		$d->setTable('phuongxa');
		$d->setWhere('id', $id);
		if($d->update($data)) redirect("index.php?com=tinhthanh_quanhuyen&act=man_item");
		else transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=tinhthanh_quanhuyen&act=man_item");
	}
	else
	{
		$data['ngaytao'] = time();
		
		$d->setTable('phuongxa');
		if($d->insert($data)) redirect("index.php?com=tinhthanh_quanhuyen&act=man_item");
		else transfer("Lưu dữ liệu bị lỗi", "index.php?com=tinhthanh_quanhuyen&act=man_item");
	}
}

function delete_loai()
{
	global $d;

	if(isset($_GET['id']))
	{
		$id =  themdau($_GET['id']);		
		$d->reset();
		$sql = "select * from #_phuongxa where id='".$id."'";
		$d->query($sql);

		if($d->num_rows()>0){
			$sql = "delete from #_phuongxa where id='".$id."'";
			$d->query($sql);
		}
		
		if($d->query($sql))
		{
			redirect("index.php?com=tinhthanh_quanhuyen&act=man_item");
		}
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=tinhthanh_quanhuyen&act=man_item");
	}
	elseif (isset($_GET['listid'])==true)
	{
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
		$sql = "select * from #_phuongxa where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			$sql = "delete from #_phuongxa where id='".$id."'";
			$d->query($sql);
		}
			
		} redirect("index.php?com=tinhthanh_quanhuyen&act=man_item");
	}
	else transfer("Không nhận được dữ liệu", "index.php?com=tinhthanh_quanhuyen&act=man_item");
}
/* End Phường Xã */

?>