<?php	if(!defined('_source')) die("Error");
$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
$pid=(int)$_REQUEST['pid'];

switch($act){
	case "man":
		get_items();
		$template = "comment/man/items";
		break;
	case "add":
		$template = "comment/man/item_add";
		break;
	case "edit":
		get_item();
		$template = "comment/man/item_add";
		break;
	case "save":
		save_item();
		break;
	case "delete":
		del_item();
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
	global $d, $items;
	
	$sql = "select * from #_comment where pid=0";
	$sql.=" order by ngaydang desc";
	
	$d->query($sql);
	$items = $d->result_array();
}

function get_item()
{
	global $d, $item;
	
	$id= addslashes($_GET['id']);
	$sql = "select * from #_comment where id=$id";
	$d->query($sql);
	$item = $d->fetch_array();
}

function save_item()
{
	global $d, $config_ip, $config_url_http, $config_email, $config_pass, $row_setting, $config_background, $config_size_logo, $config_color, $config_mxh;

	$data['pid'] = (int)$_POST['pid'];
	$data['hoten'] = magic_quote($_POST['hoten']);
	$data['typereply'] = magic_quote($_POST['typereply']);
	$data['diachi'] = magic_quote($_POST['diachi']);
	$data['dienthoai'] = magic_quote($_POST['dienthoai']);
	$data['email'] = magic_quote($_POST['email']);
	$data['noidung'] = magic_quote($_POST['noidung']);
	$data['url'] = magic_quote($_POST['url']);
	$data['admin'] = 1;
	$data['ngaydang'] = time();
	$data['stt'] = $_POST['stt'];
	$data['hienthi'] = 0;
	
	$d->setTable('comment');
	if($d->insert($data))
	{
		include_once "phpmailer/class.phpmailer.php";	
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->Host       = $config_ip;
		$mail->SMTPAuth   = true;
		$mail->Host       = $config_ip;
		$mail->Username   = $config_email;
		$mail->Password   = $config_pass;

		// Thiết lập thông tin
		$mail->SetFrom($config_email,$row_setting['tenvi']);

		// Thiết lập thông tin người nhận
		$mail->AddAddress($data['email'], $row_setting['tenvi']);
		
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
			$body.='<tr><td style="padding: 15px 10px;"><div><b>Đường dẫn chủ đề:</b></div><a href="'.$data['url'].'">'.$data['url'].'</a></td></tr>';
			$body.='<tr><td style="padding: 15px 10px;"><div><b>Thắc mắc:</b></div>'.str_replace('\"','"', $data['noidung']).'</td></tr>';
			$body.='<tr><td style="padding: 15px 10px;"><div><b>Trả lời bởi </b><strong style="color: red;text-transform: uppercase">'.$data['hoten'].'</strong>:</div> '.str_replace('\"','"', $data['noidung']).'</td></tr>';
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
		$mail->Send();

		redirect("index.php?com=comment&act=man");
	}
	else transfer("Lưu dữ liệu bị lỗi", "index.php?com=comment&act=man");
}

function del_item()
{
	global $d;
	if(isset($_GET['id']))
	{
		$id =  themdau($_GET['id']);
		// Kiem tra no la tin con hay la tin cha
		$d->reset();
		$sql = "select pid from #_comment where id='".$id."'";
		$d->query($sql);
		$ck=$d->fetch_array();
		if($ck['pid']>0)
		{
			$d->reset();
			$sql = "delete from #_comment where id='".$id."'";
			$d->query($sql);
		}
		else
		{
			$d->reset();
			$sql = "delete from #_comment where id='".$id."' or pid='".$id."'";
			$d->query($sql);	
		}
		// Ket thuc kiem tra
	}
	if($d->query($sql))
		redirect("index.php?com=comment&act=man");
	else
		transfer("Xóa dữ liệu bị lỗi", "index.php?com=comment&act=man");
}
?>