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

	$gg_id=sanitize($_POST['id']);
	$gg_name=sanitize($_POST['name']);
	$gg_img=sanitize($_POST['img']);
	$gg_email=sanitize($_POST['email']);
	$str_return="";
	$error_return=0;

	$d->reset();
	$sql="select id from #_user where email='".$gg_email."' and role='1'";
	$d->query($sql);
	$user_gg=$d->fetch_array();

	$user_gg = get_fetch_array("SELECT id FROM table_user WHERE role=1 AND email='".$gg_email."'");

	if($user_gg['id']!='')
	{
		$row_user = get_fetch_array("SELECT * FROM table_user WHERE role=1 AND hienthi>0 AND email='".$gg_email."'");

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
		$row_user = get_fetch_array("SELECT * FROM table_user WHERE role=1 AND hienthi>0 AND email='".$gg_email."'");

		$data['ten']=$gg_name;
		$data['username']='Login by Google';
		$data['email']=$gg_email;
		$data['avatar']=uploadUrl($gg_img,_upload_user,"jpg,bmp,jpeg,png,gif","20000000");
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