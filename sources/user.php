<?php
	if(!defined('_source')) die("Error");

	$kind=addslashes($_GET['kind']);

	switch($kind)
	{
		case 'dang-nhap':
			$title_tcat="Đăng nhập";
			$template = "account/dangnhap";
			if(isset($_SESSION[$login_name][$login_name])){transfer("Trang không tồn tại.",$config_url_http);}
			if(isset($_POST['dangnhap'])){login();}
			break;

		case 'dang-ky':
			$title_tcat="Đăng ký thành viên";
			$template = "account/dangky";
			if(isset($_SESSION[$login_name][$login_name])){transfer("Trang không tồn tại.",$config_url_http);}
			if(isset($_POST['dangky'])){signup();}
			break;

		case 'quen-mat-khau':
			$title_tcat="Quên mật khẩu";
			$template = "account/quenmatkhau";
			if(isset($_SESSION[$login_name][$login_name])){transfer("Trang không tồn tại.",$config_url_http);}
			if(isset($_POST['quenmatkhau'])){doimatkhau_user();}
			break;

		case 'kich-hoat':
			$title_tcat="Kích hoạt thành viên";
			$template = "account/kichhoat";
			if(isset($_SESSION[$login_name][$login_name])){transfer("Trang không tồn tại.",$config_url_http);}
			if(isset($_POST['kichhoat'])){active_user();}
			break;

		case 'thong-tin':
			if(!isset($_SESSION[$login_name][$login_name])){transfer("Trang không tồn tại.",$config_url_http);}
			$template = "account/thongtin";
			$title_tcat="Cập nhật thông tin cá nhân";
			info_user();
			break;

		case 'dang-xuat':
			if(!isset($_SESSION[$login_name][$login_name])){transfer("Trang không tồn tại.",$config_url_http);}
			logout();
		
		default:
			$template = "404";
			break;
	}

	$title_bar=$title_tcat.' - ';

	/* Crumbtrail */
	$crumbtrail="<li><a class='crumbtrail_lst' title='".$title_tcat."'>".$title_tcat."</a></li>";

	function fns_Rand_digit($min,$max,$num)
	{
		$result='';
		for($i=0;$i<$num;$i++){
			$result.=rand($min,$max);
		}
		return $result;
	}

	function info_user()
	{
		global $d, $row_detail, $config_url_http;

		if(isset($_SESSION[$login_name]['id']))
		{
	        $d->reset();
	        $sql = "select * from #_user where id='".$_SESSION[$login_name]['id']."'";
	        $d->query($sql);
	        $row_detail = $d->fetch_array();
		}

	    if(isset($_POST['capnhatthongtin']))
	    {
	        if($_POST['password']!='')
	        {
	            $password=$_POST['password'];
	            $new_password=$_POST['new-password'];
	            $new_password_confirm=$_POST['new-password-confirm'];

	            $d->reset();
	            $d->setTable('user');
	            $d->setWhere('id', $_SESSION[$login_name]['id']);
	            $d->setWhere('password', md5($password));
	            $d->select();
	            if($d->num_rows()==0) transfer("Mật khẩu cũ không chính xác", "");

	            if($new_password=='' || ($new_password!=$new_password_confirm))
	            {
	                transfer("Thông tin mật khẩu mới không chính xác", "");
	            }

	            $d->reset();
	            $data_pass['password'] = md5($new_password);
	            $d->setTable('user');
	            $d->setWhere('id',$_SESSION[$login_name]['id']);
	            $d->update($data_pass);
	        }

	        $data['ten'] = magic_quote($_POST['ten']);
	        $data['diachi'] = magic_quote($_POST['diachi']);
	        $data['dienthoai'] = magic_quote($_POST['dienthoai']);
	        $data['email'] = magic_quote($_POST['email']);
	        $data['ngaysinh'] = strtotime(str_replace("/","-",$_POST['ngaysinh']));
	        $data['sex'] = magic_quote($_POST['sex']);

	        $d->reset();
	        $d->setTable('user');
	        $d->setWhere('id', $_SESSION[$login_name]['id']);
	        if($d->update($data))
	        {
	        	if($password!='')
	        	{
	        		global $d, $login_name;

		            if(isset($_SESSION[$login_name]) and isset($_SESSION[$login_name][$login_name]))
		            {
		                $_SESSION[$login_name][$login_name] = false;
		                unset($_SESSION[$login_name]);
		            }
		            if(isset($_COOKIE['iduser']))
		            {
		                setcookie('iduser',"",-1,'/');
		            }
	            	transfer("Cập nhật thông tin thành công !", $config_url_http."account/dang-nhap.html");
	        	}
	        	transfer("Cập nhật thông tin thành công !", $config_url_http."account/thong-tin.html");	            
	        }
	    }
	}

	function active_user()
	{
		global $d, $row_detail, $config_url_http, $flag;

		$id=$_GET['id'];
		$flag=false;

		/* Kiểm tra thông tin */
		$d->reset();
        $sql = "select hienthi,maxacnhan,id from #_user where id='".$id."'";
        $d->query($sql);
        $row_detail = $d->fetch_array();

        if($row_detail['id']=='')
        {
        	transfer("Tài khoản của bạn chưa được kích hoạt.",$config_url_http);
        }
        else if($row_detail['hienthi']>0)
        {
        	transfer("Tài khoản của bạn đã được kích hoạt.",$config_url_http);
        }
        else
        {
    		$maxacnhan=trim($_POST['maxacnhan']);
    		if($row_detail['maxacnhan']==$maxacnhan)
        	{
        		$data['hienthi']='1';
				$d->reset();
				$d->setTable('user');
				$d->setWhere('id', $id);
				if($d->update($data))
				{
					transfer("Kích hoạt tài khoản thành công.",$config_url_http."account/dang-nhap.html");
				}
        	}
        	else
        	{
        		transfer("Mã xác nhận không đúng. Vui lòng nhập lại mã xác nhận.",$config_url_http."account/kich-hoat.html/id=".$id);
        	}
        }
	}

	function login()
	{
		global $d, $login_name, $config_url_http;

		if($_POST['username']=="") 
		{
			transfer("Chưa nhập tên tài khoản", 'account/dang-nhap.html');
		}
		if($_POST['password']=="") 
		{
			transfer("Chưa nhập mật khẩu", 'account/dang-nhap.html');
		}
		$username = magic_quote($_POST['username']);
		$password = magic_quote($_POST['password']);
		$sql = "select * from #_user where username = '".$username."' and hienthi='1'";
		$d->query($sql);
		if($d->num_rows() == 1)
		{
			$row = $d->fetch_array();
			if(($row['password'] == md5($password)) && ($row['role'] == 1))
			{
				$_SESSION[$login_name][$login_name] = true;
				$_SESSION[$login_name]['id'] = $row['id'];
				$_SESSION[$login_name]['username'] = $row['username'];
				$_SESSION[$login_name]['dienthoai'] = $row['dienthoai'];
				$_SESSION[$login_name]['diachi'] = $row['diachi'];
				$_SESSION[$login_name]['email'] = $row['email'];
				$_SESSION[$login_name]['ten'] = $row['ten'];
				$_SESSION[$login_name]['photo'] = $row['photo'];
				if(isset($_POST['remember-login']) and $_POST['remember-login']=='1')
				{
					$time_expiry=time()+3600*24*7;
					$iduser=$row['id'];
					setcookie('iduser',$iduser,$time_expiry,'/');
				}
				transfer("Đăng nhập thành công", $config_url_http);
			}
		}
		transfer("Tên đăng nhập hoặc mật khẩu không chính xác <br/> Hoặc tài khoản của bạn chưa được xác nhận từ Quản trị website !", $config_url_http."account/dang-nhap.html");
	}

	function signup()
	{
		global $d, $login_name, $config_url_http;

		if($_POST['password']!=$_POST['password_2']) 
		{
			transfer("Xác nhận mật khẩu không trùng khớp !", $config_url_http."account/dang-ky.html");
		}

		/* Kiểm tra tên đăng ký */
		$d->reset();
		$d->setTable('user');
		$d->setWhere('username', magic_quote($_POST['username']));
		$d->select();
		if($d->num_rows()>0) 
		{
			transfer("Tên đăng nhập đã tồn tại !", $config_url_http."account/dang-ky.html");
		}

		/* Kiểm tra email đăng ký */
		$d->reset();
		$d->setTable('user');
		$d->setWhere('email', magic_quote($_POST['email']));
		$d->select();
		if($d->num_rows()>0) 
		{
			transfer("Địa chỉ email đã tồn tại !", $config_url_http."account/dang-ky.html");
		}

		$d->reset();
		$data['ten'] = magic_quote($_POST['ten']);
		$data['username'] = magic_quote($_POST['username']);
		$data['password'] = md5($_POST['password']);
		$data['email'] = magic_quote($_POST['email']);
		$data['dienthoai'] = magic_quote($_POST['dienthoai']);
		$data['diachi'] = magic_quote($_POST['diachi']);
		$data['sex'] = magic_quote($_POST['sex']);
		$data['ngaysinh'] = strtotime(str_replace("/","-",$_POST['ngaysinh']));
		$data['role'] = '1';
		$data['com'] = 'user';
		$data['hienthi'] = '0';
		$maxacnhan=fns_Rand_digit(0,3,6);
		$data['maxacnhan'] = $maxacnhan;
		$name_conf=$data['username'];
		$email_conf=$data['email'];
		
		$d->setTable('user');
		if($d->insert($data))
		{
			sendactive_user($name_conf,$maxacnhan);
			transfer("Đăng ký thành viên thành công ! </br> Vui lòng kiểm tra email: ".$email_conf.".</br> Để kích hoạt tài khoản !", $config_url_http."account/dang-nhap.html");
		}
		else
		{
			transfer("Đăng ký thành viên thất bại ! </br> Hãy liên hệ với chúng tôi !", $config_url_http);
		}
	}

	function sendactive_user($tennguoidung='',$maxacnhan='')
	{
		global $d, $setting, $config_ip, $config_email, $config_pass, $config_url_http, $config_background, $config_mxh, $config_size_logo, $config_color, $lang, $row_setting;

		/* Lấy thông tin thiết lập */
		$d->reset();
		$sql = "select * from #_setting";
		$d->query($sql);
		$setting = $d->fetch_array();

		$d->reset();
		$sql = "select * from #_user where username = '".$tennguoidung."'";
		$d->query($sql);
		$row = $d->fetch_array();

		$id_nguoidung = $row['id'];
		$username_md5=md5($row['username']);
		$email_md5=md5($row['email']);

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
			$body.='<tr><td style="padding: 15px 10px;">';
				$body.='<p style="margin: 0px;margin-bottom: 20px;">Xin chào: <span style="font-weight: bold;">'.$row['ten'].'</span></p>';
				$body.='<div style="line-height: 20px;">';
					$body.='<p style="margin: 0px;margin-bottom: 5px;">Mã xác nhận tài khoản của bạn là: <a style="color: #3367d6;">'.$maxacnhan.'</a></p>';
					$body.='<p style="margin: 0px;margin-bottom: 5px;">Đường dẫn xác nhận của bạn: <a style="color: #3367d6;" href="'.$config_url_http."account/kich-hoat.html/id=".$id_nguoidung.'">'.$config_url_http."account/kich-hoat.html/id=".$id_nguoidung.'</a></p>';
					$body.='<p style="margin: 0px;">Để bảo mật, bạn vui lòng thay đổi mật khẩu sau khi đăng nhập và không tiết lộ bất kỳ thông tin cá nhân nào.</p>';
				$body.='</div>';
			$body.='</td></tr>';
			$body.='</tbody>';
			$body.='</table>';
			/* End Section: Content */

			/* Begin Section: Footer */
			$body.='<table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-spacing: 0;border-collapse: collapse;font-size: 13px;max-width: 650px;margin: auto;border-top: 1px solid #e0e0e0;word-break: break-all;">';
			$body.='<tbody>';
			$body.='<tr><td style="text-align: center;font-weight: bold;font-size: 17px;padding-top: 15px;color: #313131;">'.get_footer_form('ten',$lang).'</td></tr>';
			$body.='<tr><td style="padding: 0px 10px;padding-top: 5px;line-height: 20px;text-align: center;font-size: 13px;">'.get_footer_form('noidung',$lang).'</td></tr>';
			$body.='</tbody>';
			$body.='</table>';
			/* End Section: Footer */
		/* End Nội Dung Email Gửi */

		// Khởi tạo đối tượng
		include_once "phpmailer/class.phpmailer.php";
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPAuth   = true;
		$mail->Host       = $config_ip;
		$mail->Username   = $config_email;
		$mail->Password   = $config_pass;
		$mail->SetFrom($setting['email'],$setting['title']);
		$mail->AddAddress($row['email'],$row['username']);
		$mail->AddReplyTo($setting['email'],$setting['title']);
		$mail->Subject = "Kích Hoạt Tài Khoản Thành Viên";
		$mail->CharSet = "utf-8";
		$mail->AltBody = "To view the message, please use an HTML compatible email viewer!";
		$mail->MsgHTML($body);

		if(!$mail->Send()) 
		{
			transfer( "Có lỗi xảy ra trong quá trình kích hoạt tài khoản !",$config_url_http."lien-he.html");
		} 
	}

	function doimatkhau_user()
	{
		global $d, $setting, $login_name, $config_ip, $config_email, $config_pass, $config_url_http, $config_background, $config_mxh, $config_size_logo, $config_color, $row_setting, $lang;

		/* Lấy thông tin thiết lập */
		$d->reset();
		$sql = "select * from #_setting";
		$d->query($sql);
		$setting = $d->fetch_array();

		if($_POST['username']=="") transfer("Chưa nhập tên tài khoản", $config_url_http."account/quen-mat-khau.html");
		if($_POST['email']=="") transfer("Chưa nhập email đăng ký tài khoản", $config_url_http."account/quen-mat-khau.html");

		// kiem tra ten dang ki va email
		$d->reset();
		$d->setTable('user');
		$d->setWhere('username', magic_quote($_POST['username']));
		$d->setWhere('email', magic_quote($_POST['email']));
		$d->select();
		if($d->num_rows()==0) transfer("Tên đăng nhập và email không đúng.", $config_url_http."account/quen-mat-khau.html");
		
		$tennguoidung=magic_quote($_POST['username']);
		$email=magic_quote($_POST['email']);
		$string = md5(rand(0,999)*time());
		$newpass = substr($string, 15, 6);

		$d->reset();
		$data['password'] = md5($newpass);
		$d->setTable('user');
		$d->setWhere('username', magic_quote($_POST['username']));
		$d->setWhere('email', magic_quote($_POST['email']));
		$d->update($data);

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
			$body.='<tr><td style="padding: 15px 10px;">';
				$body.='<p style="margin: 0px;margin-bottom: 20px;">Xin chào: <span style="font-weight: bold;">'.$tennguoidung.'</span></p>';
				$body.='<div style="line-height: 20px;">';
					$body.='<p style="margin: 0px;margin-bottom: 5px;">Mật khẩu mới của bạn là: <a style="color: #3367d6;">'.$newpass.'</a></p>';
					$body.='<p style="margin: 0px;">Để bảo mật, bạn vui lòng thay đổi mật khẩu sau khi đăng nhập và không tiết lộ bất kỳ thông tin cá nhân nào.</p>';
				$body.='</div>';
			$body.='</td></tr>';
			$body.='</tbody>';
			$body.='</table>';
			/* End Section: Content */

			/* Begin Section: Footer */
			$body.='<table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-spacing: 0;border-collapse: collapse;font-size: 13px;max-width: 650px;margin: auto;border-top: 1px solid #e0e0e0;word-break: break-all;">';
			$body.='<tbody>';
			$body.='<tr><td style="text-align: center;font-weight: bold;font-size: 17px;padding-top: 15px;color: #313131;">'.get_footer_form('ten',$lang).'</td></tr>';
			$body.='<tr><td style="padding: 0px 10px;padding-top: 5px;line-height: 20px;text-align: center;font-size: 13px;">'.get_footer_form('noidung',$lang).'</td></tr>';
			$body.='</tbody>';
			$body.='</table>';
			/* End Section: Footer */
		/* End Nội Dung Email Gửi */
		include_once "phpmailer/class.phpmailer.php";
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPAuth   = true;
		$mail->Host       = $config_ip;
		$mail->Username   = $config_email;
		$mail->Password   = $config_pass;
		$mail->SetFrom($setting['email'],$setting['title']);
		$mail->AddAddress($email,$tennguoidung);
		$mail->AddReplyTo($setting['email'],$setting['title']);
		$mail->Subject    = "Lấy lại mật khẩu";
		$mail->CharSet = "utf-8";
		$mail->AltBody = "To view the message, please use an HTML compatible email viewer!";
		$mail->MsgHTML($body);
		if(!$mail->Send()) 
		{
			transfer( "Có lỗi xảy ra, vui lòng liện hệ quản trị website !", $config_url_http."account/quen-mat-khau.html");
		} 
		else 
		{
			global $d, $login_name;
			if(isset($_SESSION[$login_name]) and isset($_SESSION[$login_name][$login_name]))
			{
				$_SESSION[$login_name][$login_name] = false;
				unset($_SESSION[$login_name]);
			}
			if(isset($_COOKIE['iduser']))
			{
				setcookie('iduser',"",-1,'/');
			}
			transfer("Lấy lại mật khẩu thành công ! <br/> Vui lòng kiểm tra email: ".$email, $config_url_http);	
		}
	}

	function logout()
	{
		global $d, $login_name, $config_url_http;

		if(isset($_SESSION[$login_name])){
			$_SESSION[$login_name][$login_name] = false;
			unset($_SESSION[$login_name]);
		}
		
		if(isset($_COOKIE['iduser'])){
			setcookie('iduser',"",-1,'/');
		}
		redirect($config_url_http);
	}
?>