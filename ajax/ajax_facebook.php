<?php
	session_start();
	error_reporting(0);

	@define ( '_lib' , '../admin/lib/');
	@define ( '_source' , '../sources/');

	include_once _lib."config.php";
	include_once _lib."constant.php";
	include_once _lib."functions.php";
	include_once _lib."class.database.php";
	$d = new database($config['database']);

	$fbUser = sanitize($_POST['fbUser']);
    $fb_id = $fbUser['id'];
    $fb_name = $fbUser['first_name']." ".$fbUser['last_name'];
    $fb_img = $fbUser['picture']['data']['url'];
    $fb_email = $fbUser['email'];
	$str_return="";
	$error_return=0;

	$user_fb = get_fetch_array("SELECT id FROM table_user WHERE role=1 AND email='".$fb_email."'");

	if($user_fb['id']!='')
	{
		$row_user = get_fetch_array("SELECT * FROM table_user WHERE role=1 AND hienthi>0 AND email='".$fb_email."'");

		if($row_user['id']=='')
		{
			$str_return="Tài khoản của bạn đã bị đình chỉ hoặc bị vô hiệu. Vui lòng liên hệ với chúng tôi.";
			$error_return=1;
		}
		else
		{
			$_SESSION[$login_name][$login_name] = true;
			$_SESSION[$login_name]['id'] = $row_user['id'];
			$_SESSION[$login_name]['dienthoai'] = $row_user['dienthoai'];
			$_SESSION[$login_name]['diachi'] = $row_user['diachi'];
			$_SESSION[$login_name]['email'] = $row_user['email'];
			$_SESSION[$login_name]['ten'] = $row_user['ten'];
			$_SESSION[$login_name]['id_social'] = $row_user['id_social'];

			$str_return="Đăng nhập thành công";
		}
	}
	else
	{
		$row_user = get_fetch_array("SELECT * FROM table_user WHERE role=1 AND hienthi>0 AND email='".$fb_email."'");

		$data['ten']=$fb_name;
		$data['username']='Login by Facebook';
		$data['email']=$fb_email;
		$data['avatar']=uploadUrl($fb_img,_upload_user,"jpg,bmp,jpeg,png,gif","20000000");
		$data['role']=1;
		$data['hienthi']=1;
		$data['id_social']=1;
		$d->setTable('user');
		$d->insert($data);

		$_SESSION[$login_name][$login_name] = true;
		$_SESSION[$login_name]['id'] = $row_user['id'];
		$_SESSION[$login_name]['dienthoai'] = $row_user['dienthoai'];
		$_SESSION[$login_name]['diachi'] = $row_user['diachi'];
		$_SESSION[$login_name]['email'] = $row_user['email'];
		$_SESSION[$login_name]['ten'] = $row_user['ten'];
		$_SESSION[$login_name]['id_social'] = $row_user['id_social'];

		$str_return="Đăng ký thành viên thành công";
	}

	$data = array('str_return' => $str_return, 'error_return' => $error_return);
	echo json_encode($data);
?>