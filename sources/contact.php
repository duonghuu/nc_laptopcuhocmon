<?php 
	if(!defined('_source')) die("Error");
	
	$title_bar = $title_tcat." - ";

	/* Crumbtrail */
	$crumbtrail="<li><a class='crumbtrail_lst' title='".$title_tcat."'>".$title_tcat."</a></li>";

	if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['recaptcha_response_contact']) && $config_recaptcha==true)
	{
		$recaptcha_response_contact = $_POST['recaptcha_response_contact'];
        $recaptcha = file_get_contents($config_urlapi.'?secret='.$config_secretkey.'&response='.$recaptcha_response_contact);
        $recaptcha = json_decode($recaptcha);

		if ($recaptcha->score >= 0.5)
		{
			function fns_Rand_digit($min,$max,$num)
			{
				$result='';
				for($i=0;$i<$num;$i++){
					$result.=rand($min,$max);
				}
				return $result;	
			}
			$file_name=fns_Rand_digit(0,9,12);
			if($file_att = upload_image("file", 'doc|docx|pdf|rar|zip|ppt|pptx|DOC|DOCX|PDF|RAR|ZIP|PPT|PPTX|xls|xlsx|jpg|png|gif|JPG|PNG|GIF', _upload_file_l,$file_name))
			{
				$data['file'] = $file_att;	
			}

		    $data['ten'] = magic_quote($_POST['ten']);
		    $data['diachi'] = $_POST['diachi'];
		    $data['dienthoai'] = $_POST['dienthoai'];
			$data['email'] = magic_quote($_POST['email']);
		    $data['tieude'] = magic_quote($_POST['tieude']);
		    $data['noidung'] = magic_quote($_POST['noidung']);
		    $data['ngaytao'] = time(); 
		    $d->setTable('contact');
		    $d->insert($data);
			
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
				$body.='<table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-spacing: 0;border-collapse: collapse;font-size: 13px;margin: 10px auto;border: 1px dashed #ccc;background: rgba(238, 238, 238, 0.4);word-break: break-all;">';
				$body.='<tbody>';
				$body.='<tr><td style="padding: 15px 10px;">';
					$body.='<div style="line-height: 20px;">';
						$body.='<p><span style="font-weight: bold; margin-right: 10px;">Họ tên:</span>'.$data['ten'].'</p>';
						$body.='<p><span style="font-weight: bold; margin-right: 10px;">Địa chỉ:</span>'.$data['diachi'].'</p>';
						$body.='<p><span style="font-weight: bold; margin-right: 10px;">Điện thoại:</span>'.$data['dienthoai'].'</p>';
						$body.='<p><span style="font-weight: bold; margin-right: 10px;">Email:</span>'.$data['email'].'</p>';
						$body.='<p><span style="font-weight: bold; margin-right: 10px;">Tiêu đề:</span>'.$data['tieude'].'</p>';
						$body.='<p><span style="font-weight: bold; margin-right: 10px;">Nội dung:</span>'.str_replace('\"','"', $data['noidung']).'</p>';
					$body.='</div>';
				$body.='</td></tr>';
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

			// Khởi tạo đối tượng
			include_once _lib."C_email.php";
			include_once "phpmailer/class.phpmailer.php";
			$mail = new PHPMailer();

			// Thiết lập thông tin
			$mail->IsSMTP();
			$mail->SMTPAuth   = true;
			$mail->Host       = $config_ip;
			$mail->Username   = $config_email;
			$mail->Password   = $config_pass;
			$mail->SetFrom($row_setting['email'],$row_setting['ten'.$lang]);

			// Thiết lập thông tin người nhận
			$mail->AddAddress($row_setting['email'],$row_setting['ten'.$lang]);

			// Thiết lập email nhận email hồi đáp nếu người nhận nhấn nút Reply
			$mail->AddReplyTo($row_setting['email'],$row_setting['ten'.$lang]);

			// Thiết lập tiêu đề
			$mail->Subject = "Thư Liên Hệ Từ ".$row_setting['ten'.$lang];

			// Thiết lập định dạng font chữ
			$mail->CharSet = "utf-8";
			$mail->AltBody = "To view the message, please use an HTML compatible email viewer!";

			// Thiết lập nội dung chính của email
			$mail->MsgHTML($body);

			if($data['file'])
			{
				$mail->AddAttachment(_upload_file_l.$data['file']);
			}

			if(!$mail->Send()) 
			{
				transfer( "Có lỗi xảy ra.",$config_url_http);
			} 
			else 
			{
				transfer("Gửi liên hệ thành công.",$config_url_http);	
			}
		}
		else
		{
			transfer("Bạn đã gửi thông tin. Vui lòng chờ xác nhận của chúng tôi.",$config_url_http);
		}
	}
	
	$d->reset();
    $sql = "select noidung$lang from #_news_static where type='lienhe'";
    $d->query($sql);
    $row_lienhe = $d->fetch_array();
?>