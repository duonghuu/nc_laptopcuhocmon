<?php
if(!defined('_source')) die("Error");

switch($_GET['act'])
{
	case "man":
	get_mans();
	$template = "pushOnesignal/man/items";
	break;

	case "add":
	$template = "pushOnesignal/man/item_add";
	break;

	case "edit":
	get_man();
	$template = "pushOnesignal/man/item_add";
	break;

	case "save":
	save_man();
	break;

	case "sync":
	sendSync();
	break;

	case "delete":
	delete_man();
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

function get_mans()
{
	global $d, $items, $paging;

	$sql = "select * from #_pushonesignal where id<>0";	
	
	if($_REQUEST['keyword']!='')
	{
	$keyword=addslashes($_REQUEST['keyword']);
	$sql.=" and (name LIKE '%$keyword%')";
	}
	$sql.=" order by id desc";

	$d->query($sql);
	$items = $d->result_array();
	
	$curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
	$url="index.php?com=pushOnesignal&act=man";
	$maxR=10;
	$maxP=10;
	$paging=paging($items, $url, $curPage, $maxR, $maxP);
	$items=$paging['source'];
}

function get_man()
{
	global $d, $item;

	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", "index.php?com=pushOnesignal&act=man");	
	$sql = "select * from #_pushonesignal where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=pushOnesignal&act=man");
	$item = $d->fetch_array();	
}

function save_man()
{
	global $d;

	$file_name=fns_Rand_digit(0,9,15);

	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=pushOnesignal&act=man");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";

	/* Begin Post Dữ Liệu */
	// $time_star_tpl = explode(':',$_POST['time_star']) ;
	// $time_star_h = $time_star_tpl[0]; 
	// $time_star_p = substr($time_star_tpl[1], 0,2);
	// $data['gio'] = $time_star_h;
	// $data['phut'] = $time_star_p;
	// $data['timegannhat'] = strtotime($_POST['time_star']);
	// $data['times'] = $_POST['times'];
	// $data['number'] = $_POST['number'];
	// $data['solancon'] = $_POST['number'];
	$data['name'] = $_POST['name'];			
	$data['description'] = $_POST['description'];
	$data['link'] = $_POST['link'];	
	$data['stt'] = $_POST['stt'];	
	$data['date'] = time();
	/* End Post Dữ Liệu */

	if($id)
	{
		if($photo = upload_image("file", '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF', _upload_sync,$file_name))
		{
			$data['photo'] = $photo;	
			$data['thumb'] = create_thumb($data['photo'], 100, 100, _upload_sync,$file_name,1);		
			$d->setTable('pushonesignal');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0)
			{
				$row = $d->fetch_array();
				delete_file(_upload_sync.$row['photo']);	
				delete_file(_upload_sync.$row['thumb']);				
			}
		}
	
		$d->setTable('pushonesignal');
		$d->setWhere('id', $id);
		if($d->update($data)) transfer("Cập nhật dữ liệu thành công", "index.php?com=pushOnesignal&act=man");
		else transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=pushOnesignal&act=man");
	}
	else
	{
		if($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG', _upload_sync,$file_name))
		{
			$data['photo'] = $photo;		
			$data['thumb'] = create_thumb($data['photo'], 100, 100, _upload_sync,$file_name,1);
		}

		$d->setTable('pushonesignal');
		if($d->insert($data)) transfer("Lưu dữ liệu thành công", "index.php?com=pushOnesignal&act=man");
		else transfer("Lưu dữ liệu bị lỗi", "index.php?com=pushOnesignal&act=man");
	}
}

function delete_man()
{
	global $d;

	if(isset($_GET['id']))
	{
		$id = themdau($_GET['id']);
		$d->reset();
		$sql = "select id,photo,thumb from #_pushonesignal where id='".$id."'";
		$d->query($sql);
		$row = $d->fetch_array();

		delete_file(_upload_sync.$row['photo']);
		delete_file(_upload_sync.$row['thumb']);

		$sql = "delete from #_pushonesignal where id='".$id."'";
		$d->query($sql);

		if($d->query($sql)) transfer("Xóa dữ liệu thành công","index.php?com=pushOnesignal&act=man");
		else transfer("Xóa dữ liệu bị lỗi","index.php?com=pushOnesignal&act=man");
	}
	elseif(isset($_GET['listid'])==true)
	{
		$listid = explode(",",$_GET['listid']); 
		for($i=0;$i<count($listid);$i++)
		{
			$idTin = $listid[$i]; 
			$id = themdau($idTin);

			$d->reset();
			$sql = "select id,photo,thumb from #_pushonesignal where id='".$id."'";
			$d->query($sql);
			$row = $d->fetch_array();

			delete_file(_upload_sync.$row['photo']);
			delete_file(_upload_sync.$row['thumb']);

			$sql = "delete from #_pushonesignal where id='".$id."'";
			$d->query($sql);
		}
		transfer("Xóa dữ liệu thành công.","index.php?com=pushOnesignal&act=man");
	}
	else
	{
		transfer("Không nhận được dữ liệu","index.php?com=pushOnesignal&act=man");
	}
}
	
function sendMessage_onesignal($heading,$content,$url='https://www.google.com/',$photo)
{
	global $d, $config_url_http, $config_onesignal_id, $config_onesignal_rest_id;
	
	$contents = array(
		"en" => $content
	);
	$headings = array(
		"en" => $heading
	);
	$uphoto = $config_url_http._upload_sync_l.$photo;
	
	$fields = array(
		'app_id' => $config_onesignal_id,
		'included_segments' => array('All'),
		'contents' => $contents,
		'headings' => $headings,
		'url' => $url,
		'chrome_web_image' => $uphoto
	);
	$fields = json_encode($fields);

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
	'Authorization: Basic '.$config_onesignal_rest_id));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($ch, CURLOPT_HEADER, FALSE);
	curl_setopt($ch, CURLOPT_POST, TRUE);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	$response = curl_exec($ch);
	curl_close($ch);
	
	return $response;
}
 
function sendSync()
{
	global $config, $d;

	if(isset($_GET['id']))
	{
		$id = themdau($_GET['id']);
		$d->reset();
		$sql = "select id,photo,thumb,name,description,link from #_pushonesignal where id='".$id."'";
		$d->query($sql);
		$row = $d->fetch_array();
		
		sendMessage_onesignal($row['name'],$row['description'],$row['link'],$row['photo']);
	}
	transfer("Gửi thông báo thành công", "index.php?com=pushOnesignal&act=man");	
}
?>