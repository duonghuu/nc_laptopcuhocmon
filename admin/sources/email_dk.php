<?php	if(!defined('_source')) die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
$type=$_REQUEST['type'];

if(isset($_POST["listemail"]))
{
	$file_name=fns_Rand_digit(0,9,8);
	if($file = upload_image("file", $config['email_dk'][$type]['file_type'], _upload_file,$file_name))
	{
		$data['file'] = $file;
	}
	
	include_once "phpmailer/class.phpmailer.php";	
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->SMTPAuth   = true;
	$mail->Host       = $config_ip;
	$mail->Username   = $config_email;
	$mail->Password   = $config_pass;

	// Thiết lập thông tin
	$mail->SetFrom($config_email,$row_setting['tenvi']);

	/* Lấy danh sách các id để gửi */
	$listemail = explode(",",$_POST['listemail']); 
	for($i=0; $i<count($listemail); $i++ )
	{
		$idTin=$listemail[$i]; 
		$id =  themdau($idTin);		
		$d->reset();
		$sql = "select email from #_email_dk where id='".$id."' and type='".$type."'";
		$d->query($sql);

		if($d->num_rows()>0)
		{
			while($row = $d->fetch_array())
			{
				$mail->AddAddress($row['email'], $row['email']);
			}
		}

	}
	
	// Thiết lập tiêu đề
	$mail->Subject = $row_setting['tenvi']." - ".$_POST['tieude'];
	$mail->IsHTML(true);
	
	// Thiết lập định dạng font chữ
	$mail->CharSet = "utf-8";
	$mail->AltBody = "To view the message, please use an HTML compatible email viewer!";	

	/* Begin Nội Dung Email Gửi */
		/* Begin Section: Header */
		$body='<table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-spacing: 0; border-collapse: collapse;font-size: 13px;max-width: 650px;margin: auto;word-break: break-all;">';
		$body.='<tbody>';
		$body.='<tr style="background: '.$config_background.';color: #fff;">';
			$body.='<td style="padding: 10px;">'.get_logo_form($config_size_logo).'</td>';
			$body.='<td style="text-align: right;padding: 10px;">';
				$body.='<p style="margin: 0px;">Hotline:<span style="margin-left: 5px;color: '.$config_color.';font-weight: bold;">'.$row_setting['hotline'].'</span></p>';
				$body.='<p style="margin: 0px;margin-top: 2px;margin-bottom: 6px;">Hỗ trợ:<span style="margin-left: 5px;color: '.$config_color.';font-weight: bold;">'.$row_setting['email'].'</span></p>';
				if($config_mxh) $body.=get_mxh_form();
			$body.='</td>';
		$body.='</tr>';
		$body.='</tbody>';
		$body.='</table>';
		/* End Section: Header */

		/* Begin Section: Content */
		$body.='<table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-spacing: 0;border-collapse: collapse;font-size: 13px;max-width: 650px;margin: 10px auto;border: 1px dashed #ccc;background: rgba(238, 238, 238, 0.4);word-break: break-all;">';
		$body.='<tbody>';
		$body.='<tr><td style="padding: 15px 10px;">'.str_replace('\"','"', $_POST['noidung']).'</td></tr>';
		$body.='</tbody>';
		$body.='</table>';
		/* End Section: Content */

		/* Begin Section: Footer */
		$body.='<table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-spacing: 0;border-collapse: collapse;font-size: 13px;max-width: 650px;margin: auto;border-top: 1px solid #e0e0e0;word-break: break-all;">';
		$body.='<tbody>';
		$body.='<tr><td style="text-align: center;font-weight: bold;font-size: 17px;padding-top: 15px;color: #313131;">'.get_footer_form('ten','vi').'</td></tr>';
		$body.='<tr><td style="padding: 0px 10px;padding-top: 5px;line-height: 20px;text-align: center;font-size: 13px;">'.get_footer_form('noidung','vi').'</td></tr>';
		$body.='</tbody>';
		$body.='</table>';
		/* End Section: Footer */
	/* End Nội Dung Email Gửi */

	$mail->Body = $body;
	
	if($data['file'])
	{
		$mail->AddAttachment(_upload_file.$data['file']);
	}
	
	if($mail->Send())
		transfer("Email đã được gửi đi.", "index.php?com=email_dk&act=man&type=".$type."");
	else
		transfer("Hệ thống bị lỗi, xin thử lại sau.", "index.php?com=email_dk&act=man&type=".$type."");
}

switch($act)
{
	case "man":
		get_items();
		$template = "email_dk/man/items";
		break;
	case "add":
		$template = "email_dk/man/item_add";
		break;
	case "edit":
		get_item();
		$template = "email_dk/man/item_add";
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
	
	$sql = "select * from #_email_dk where type='".$type."' order by stt,id desc";
	$d->query($sql);
	$items = $d->result_array();
	
	$curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
	$url="index.php?com=email_dk&act=man&type=".$type."";
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
		transfer("Không nhận được dữ liệu", "index.php?com=email_dk&act=man&type=".$type."");
	
	$sql = "select * from #_email_dk where id='".$id."' and type='".$type."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=email_dk&act=man&type=".$type."");
	$item = $d->fetch_array();
}

function save_item()
{
	global $d,$config;
	$type=$_REQUEST['type'];
	$file_name=fns_Rand_digit(0,9,8);
	$file_email_dk=fns_Rand_digit(0,9,5);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=email_dk&act=man&type=".$type."");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";

	/* Begin Post Dữ Liệu */
	$data['ten'] = magic_quote($_POST['ten']);
	$data['chude'] = magic_quote($_POST['chude']);
	$data['diachi'] = magic_quote($_POST['diachi']);
	$data['dienthoai'] = magic_quote($_POST['dienthoai']);
	$data['noidung'] = magic_quote($_POST['noidung']);
	$data['ghichu'] = magic_quote($_POST['ghichu']);
	$data['tinhtrang'] = magic_quote($_POST['tinhtrang']);
	$data['email'] = magic_quote($_POST['email']);
	$data['stt'] = $_POST['stt'];
	$data['hienthi'] = isset($_POST['hienthi']) ? 1 : ($_POST['tinhtrang']!='') ? 1 : 0;
	$data['type'] = $type;
	/* End Post Dữ Liệu */

	if($id)
	{
		if($file = upload_image("file", $config['email_dk'][$type]['file_type'],_upload_file,$file_name))
		{
			$data['file'] = $file;			
			$d->setTable('email_dk');
			$d->setWhere('id', $id);
			$d->setWhere('type', $type);
			$d->select();
			if($d->num_rows()>0)
			{
				$row = $d->fetch_array();
				delete_file(_upload_file.$row['file']);				
			}
		}

		$data['ngaysua'] = time();
		
		$d->setTable('email_dk');
		$d->setWhere('id', $id);
		$d->setWhere('type', $type);
		if($d->update($data)) redirect("index.php?com=email_dk&act=man&type=".$type."");
		else transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=email_dk&act=man&type=".$type."");
	}
	else
	{
		if($file = upload_image("file", $config['email_dk'][$type]['file_type'],_upload_file,$file_name))
		{
			$data['file'] = $file;			
		}

		$data['ngaytao'] = time();

		$d->setTable('email_dk');
		if($d->insert($data)) redirect("index.php?com=email_dk&act=man&type=".$type."");
		else transfer("Lưu dữ liệu bị lỗi", "index.php?com=email_dk&act=man&type=".$type."");
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
		$sql = "select * from #_email_dk where id='".$id."' and type='".$type."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_file.$row['file']);
			}
			$sql = "delete from #_email_dk where id='".$id."' and type='".$type."'";
			$d->query($sql);
		}
		
		if($d->query($sql))
			header("Location:index.php?com=email_dk&act=man&type=".$type."");
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=email_dk&act=man&type=".$type."");
	}
	elseif (isset($_GET['listid'])==true)
	{
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
		$sql = "select * from #_email_dk where id='".$id."' and type='".$type."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_file.$row['file']);
			}
			$sql = "delete from #_email_dk where id='".$id."' and type='".$type."'";
			$d->query($sql);
		}
			
		} redirect("index.php?com=email_dk&act=man&type=".$type."");
	}
	else transfer("Không nhận được dữ liệu", "index.php?com=email_dk&act=man&type=".$type."");
}

?>