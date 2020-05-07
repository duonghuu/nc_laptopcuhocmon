<?php	if(!defined('_source')) die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";

switch($act)
{
	/* Begin Thông Tin Admin */
	case "login":
		if(!empty($_POST)) login();
		$template = "user/login";
		break;
	case "logout":
		logout();
		break;	
	case "admin_edit":
		edit();
		$template = "user/admin/admin_add";
		break;
	/* End Thông Tin Admin */

	/* Begin Thông Tin Tài Khoản Admin */
	case "man_admin":
		if(check_access3()){
			transfer("Bạn không có quyền vào trang này", "index.php");
			exit;
		}
		get_items_admin();
		$template = "user/man_admin/items";
		break;

	case "add_admin":
		if(check_access3()){
			transfer("Bạn không có quyền vào trang này", "index.php");
			exit;
		}
		$template = "user/man_admin/item_add";
		break;

	case "edit_admin":
		if(check_access3()){
			transfer("Bạn không có quyền vào trang này", "index.php");
			exit;
		}
		get_item_admin();
		$template = "user/man_admin/item_add";
		break;

	case "save_admin":
		save_item_admin();
		break;
	
	case "delete_admin":
		if(check_access3()){
			transfer("Bạn không có quyền vào trang này", "index.php");
			exit;
		}
		delete_item_admin();
		break;
	/* End Thông Tin Tài Khoản Admin */

	/* Begin Thông Tin Tài Khoản Người Dùng */
	case "man":
		if(check_access3()){
			transfer("Bạn không có quyền vào trang này", "index.php");
			exit;
		}
		get_items();
		$template = "user/man/items";
		break;

	case "add":
		if(check_access3()){
			transfer("Bạn không có quyền vào trang này", "index.php");
			exit;
		}
		$template = "user/man/item_add";
		break;

	case "edit":
		if(check_access3()){
			transfer("Bạn không có quyền vào trang này", "index.php");
			exit;
		}
		get_item();
		$template = "user/man/item_add";
		break;

	case "save":
		save_item();
		break;
	
	case "delete":
		if(check_access3()){
			transfer("Bạn không có quyền vào trang này", "index.php");
			exit;
		}
		delete_item();
		break;
	/* End Thông Tin Tài Khoản Người Dùng */
	
	/* Begin Phân Quyền */
	case "phanquyen":
		if(check_access3()){
			transfer("Bạn không có quyền vào trang này", "index.php");
			exit;
		}
		phanquyen();
		$template = "user/admin/phanquyen";
		break;

	case "save_phanquyen":
		if(check_access3()){
			transfer("Bạn không có quyền vào trang này", "index.php");
			exit;
		}
		save_phanquyen();
		break;
	/* End Phân Quyền */

	default:
		$template = "index";
}

/* Begin Phân Quyền */
function phanquyen()
{
	global $d, $item, $ds_quyen;

	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", "index.php?com=user&act=man_admin");

	$sql = "select * from #_user where id='".$id."' and role=3";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Tài khoản không tồn tại !", "index.php?com=user&act=man_admin");
	$item = $d->fetch_array();

	// Lấy danh sách quyền
	$d->reset();
	$sql = "select ma,quyen from #_phanquyen where ma_quan_tri='".$id."'";
	$d->query($sql);
	$arr = $d->result_array();
	if(!empty($arr))
	{
		foreach($arr as $quyen)
		{
			$ds_quyen[] = $quyen['quyen'];
		}
	}
	else
	{
		$ds_quyen[] = '';
	}
}

function save_phanquyen()
{
	global $d;

	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	if(!$id) transfer("Không nhận được dữ liệu !", "index.php?com=user&act=man_admin");

	// Xử lý tham số bắt buộc
	// if(empty($_POST['quyen'])){
	// 	transfer("Vui lòng chọn quyền cho tài khoản này !", "index.php?com=user&act=phanquyen&id=$id");
	// }
	
	$sql = "select * from #_user where id='".$id."' and role=3";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Tài khoản không tồn tại !", "index.php?com=user&act=man_admin");

	// Xóa hết các quyên hiện tại
	$sql = "delete from #_phanquyen where ma_quan_tri='".$id."'";
	$d->query($sql);

	// Thêm các quyền mới vào
	// foreach($_POST['quyen'] as $quyen){	
	// 	$data['ma_quan_tri'] = $id;
	// 	$data['quyen'] = $quyen;
	// 	$d->setTable('phanquyen');
	// 	$d->insert($data);
	// }
	$quyen=$_POST['quyen'];
	for($i=0;$i<count($quyen);$i++)
	{	
		$data['ma_quan_tri'] = $id;
		$data['quyen'] = $quyen[$i];
		$d->setTable('phanquyen');
		$d->insert($data);
	}
	transfer("Phân quyền thành công !", "index.php?com=user&act=man_admin");
}
/* End Phân Quyền */

/* Begin Thông Tin Tài Khoản Admin */
function get_items_admin()
{
	global $d, $items, $paging;

	$sql = "select * from #_user where role=3 and id <> 1 and (username <> 'coder' or password <> '487b60d660404828de12de149518232c') order by username";
	$d->query($sql);
	$items = $d->result_array();
	
	// $curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
	// $url="index.php?com=user&act=man_admin";
	// $maxR=10;
	// $maxP=4;
	// $paging=paging($items, $url, $curPage, $maxR, $maxP);
	// $items=$paging['source'];
}

function get_item_admin()
{
	global $d, $item;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", "index.php?com=user&act=man_admin");
	
	$sql = "select * from #_user where id='".$id."' and role=3";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=user&act=man_admin");
	$item = $d->fetch_array();
}

function save_item_admin()
{
	global $d, $config;
	
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=user&act=man_admin");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	if($id)
	{
		$id =  themdau($_POST['id']);

		$d->reset();
		$d->setTable('user');
		$d->setWhere('id', $id);
		$d->select();
		if($d->num_rows()>0){
			$row = $d->fetch_array();
			if($row['role']!=3) transfer("Bạn không có quyền trên tài khoản này.<br>Mọi thắc mắc xin liên hệ quản trị website.", "index.php?com=user&act=man_admin");
		}

		// $d->reset();
		// $d->setTable('user');
		// $d->setWhere('username', $_POST['username']);
		// $d->select();
		// if($d->num_rows()>0) transfer("Tên đăng nhập nay đã có.<br>Xin chọn tên khác.", "index.php?com=user&act=edit_admin&id=".$id);
		
		if($_POST['password']!='')
        {
            $password=$_POST['password'];
            $confirm_password=$_POST['confirm_password'];

            if($confirm_password=='')
            {
                transfer("Chưa xác nhận mật khẩu mới","index.php?com=user&act=edit_admin&id=".$id);
            }

            if($password!=$confirm_password)
            {
                transfer("Xác nhận mật khẩu mới không chính xác","index.php?com=user&act=edit_admin&id=".$id);
            }

            $d->reset();
            $data['password'] = md5('$nina@'.$password.$config['salt']);
        }

		$data['email'] = $_POST['email'];
		$data['ten'] = $_POST['ten'];
		$data['sex'] = $_POST['sex'];
		$data['dienthoai'] = $_POST['dienthoai'];
		$data['yahoo'] = $_POST['yahoo'];
		$data['skype'] = $_POST['skype'];
		$data['diachi'] = $_POST['diachi'];
		$data['ngaysinh'] = strtotime($_POST['ngaysinh']);
		$data['city'] = $_POST['city'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		
		$d->reset();
		$d->setTable('user');
		$d->setWhere('id', $id);
		$d->setWhere('role',3);
		if($d->update($data))
			transfer("Dữ liệu đã được cập nhật", "index.php?com=user&act=man_admin");
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=user&act=man_admin");
	
	}
	else
	{
		$d->reset();
		$d->setTable('user');
		$d->setWhere('username', $_POST['username']);
		$d->select();
		if($d->num_rows()>0) transfer("Tên đăng nhập nay đã có.<br>Xin chọn tên khác.", "index.php?com=user&act=edit_admin&id=".$id);
		
		if($_POST['password']=="") transfer("Chưa nhập mật khẩu", "index.php?com=user&act=add_admin");
		
		$data['username'] = $_POST['username'];
		$data['password'] = md5('$nina@'.$_POST['password'].$config['salt']);
		$data['email'] = $_POST['email'];
		$data['ten'] = $_POST['ten'];
		$data['sex'] = $_POST['sex'];
		$data['dienthoai'] = $_POST['dienthoai'];
		$data['yahoo'] = $_POST['yahoo'];
		$data['skype'] = $_POST['skype'];
		$data['diachi'] = $_POST['diachi'];
		$data['city'] = $_POST['city'];
		$data['ngaysinh'] = strtotime($_POST['ngaysinh']);
		$data['role'] = 3;
		$data['com'] = "user";
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		
		$d->setTable('user');
		if($d->insert($data))
			transfer("Dữ liệu đã được lưu", "index.php?com=user&act=man_admin");
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=user&act=man_admin");
	}
}

function delete_item_admin()
{
	global $d;
	
	if(isset($_GET['id']))
	{
		$id =  themdau($_GET['id']);

		$d->reset();
		$d->setTable('user');
		$d->setWhere('id', $id);
		$d->select();
		if($d->num_rows()>0){
			$row = $d->fetch_array();
			if($row['role']!=3) transfer("Bạn không có quyền trên tài khoản này.<br>Mọi thắc mắc xin liên hệ quản trị website.", "index.php?com=user&act=man_admin");
		}

		$sql = "delete from #_user where id='".$id."'";
		if($d->query($sql))
			transfer("Dữ liệu đã được xóa", "index.php?com=user&act=man_admin");
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=user&act=man_admin");
	}
	else transfer("Không nhận được dữ liệu", "index.php?com=user&act=man_admin");
}
/* End Thông Tin Tài Khoản Admin */

/* Begin Thông Tin Tài Khoản Người Dùng */
function get_items()
{
	global $d, $items, $paging;

	$sql = "select * from #_user where role=1 and id <> 1 and (username <> 'coder' or password <> '487b60d660404828de12de149518232c') order by username";
	$d->query($sql);
	$items = $d->result_array();
	
	// $curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
	// $url="index.php?com=user&act=man";
	// $maxR=10;
	// $maxP=4;
	// $paging=paging($items, $url, $curPage, $maxR, $maxP);
	// $items=$paging['source'];
}

function get_item()
{
	global $d, $item;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", "index.php?com=user&act=man");
	
	$sql = "select * from #_user where id='".$id."' and role=1";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=user&act=man");
	$item = $d->fetch_array();
}

function save_item()
{
	global $d;
	
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=user&act=man");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	if($id)
	{
		$id =  themdau($_POST['id']);

		$d->reset();
		$d->setTable('user');
		$d->setWhere('id', $id);
		$d->select();
		if($d->num_rows()>0){
			$row = $d->fetch_array();
			if($row['role']!=1) transfer("Bạn không có quyền trên tài khoản này.<br>Mọi thắc mắc xin liên hệ quản trị website.", "index.php?com=user&act=man");
		}

		// $d->reset();
		// $d->setTable('user');
		// $d->setWhere('username', $_POST['username']);
		// $d->select();
		// if($d->num_rows()>0) transfer("Tên đăng nhập nay đã có.<br>Xin chọn tên khác.", "index.php?com=user&act=edit&id=".$id);
		
		if($_POST['password']!='')
        {
            $password=$_POST['password'];
            $confirm_password=$_POST['confirm_password'];

            if($confirm_password=='')
            {
                transfer("Chưa xác nhận mật khẩu mới","index.php?com=user&act=edit&id=".$id);
            }

            if($password!=$confirm_password)
            {
                transfer("Xác nhận mật khẩu mới không chính xác","index.php?com=user&act=edit&id=".$id);
            }

            $d->reset();
            $data['password'] = md5($password);
        }

		$data['email'] = $_POST['email'];
		$data['ten'] = $_POST['ten'];
		$data['sex'] = $_POST['sex'];
		$data['dienthoai'] = $_POST['dienthoai'];
		$data['yahoo'] = $_POST['yahoo'];
		$data['skype'] = $_POST['skype'];
		$data['diachi'] = $_POST['diachi'];
		$data['ngaysinh'] = strtotime($_POST['ngaysinh']);
		$data['city'] = $_POST['city'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		
		$d->reset();
		$d->setTable('user');
		$d->setWhere('id', $id);
		$d->setWhere('role', 1);
		if($d->update($data))
			transfer("Dữ liệu đã được cập nhật", "index.php?com=user&act=man");
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=user&act=man");
	
	}
	else
	{
		$d->reset();
		$d->setTable('user');
		$d->setWhere('username', $_POST['username']);
		$d->select();
		if($d->num_rows()>0) transfer("Tên đăng nhập nay đã có.<br>Xin chọn tên khác.", "index.php?com=user&act=edit&id=".$id);
		
		if($_POST['password']=="") transfer("Chưa nhập mật khẩu", "index.php?com=user&act=add");
		$data['username'] = $_POST['username'];
		$data['password'] = md5($_POST['password']);
		$data['email'] = $_POST['email'];
		$data['ten'] = $_POST['ten'];
		$data['sex'] = $_POST['sex'];
		$data['dienthoai'] = $_POST['dienthoai'];
		$data['yahoo'] = $_POST['yahoo'];
		$data['skype'] = $_POST['skype'];
		$data['diachi'] = $_POST['diachi'];
		$data['city'] = $_POST['city'];
		$data['ngaysinh'] = strtotime($_POST['ngaysinh']);
		$data['role'] = 1;
		$data['com'] = "user";
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		
		$d->setTable('user');
		if($d->insert($data))
			transfer("Dữ liệu đã được lưu", "index.php?com=user&act=man");
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=user&act=man");
	}
}

function delete_item()
{
	global $d;
	
	if(isset($_GET['id']))
	{
		$id =  themdau($_GET['id']);

		$d->reset();
		$d->setTable('user');
		$d->setWhere('id', $id);
		$d->select();
		if($d->num_rows()>0){
			$row = $d->fetch_array();
			if($row['role'] != 1) transfer("Bạn không có quyền trên tài khoản này.<br>Mọi thắc mắc xin liên hệ quản trị website.", "index.php?com=user&act=man");
		}

		$sql = "delete from #_user where id='".$id."'";
		if($d->query($sql))
			transfer("Dữ liệu đã được xóa", "index.php?com=user&act=man");
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=user&act=man");
	}
	else transfer("Không nhận được dữ liệu", "index.php?com=user&act=man");
}
/* End Thông Tin Tài Khoản Người Dùng */

/* Begin Thông Tin Admin */
function edit()
{
	global $d, $item, $login_name, $config;
	
	if(!empty($_POST))
	{
		$sql = "select * from #_user where username!='".$_SESSION['login']['username']."' and username='".$_POST['username']."' and role=3";
		$d->query($sql);
		if($d->num_rows() > 0) transfer("Tên đăng nhập này đã có","index.php?com=user&act=admin_edit");
		
		if($_POST['oldpassword']!='' || $_POST['new_pass']!='' ||  $_POST['renew_pass']!='')
		{
			$oldpassword=$_POST['oldpassword'];
			$new_pass=$_POST['new_pass'];
			$renew_pass=$_POST['renew_pass'];

			if($oldpassword=='') transfer("Mật khẩu cũ chưa nhập","index.php?com=user&act=admin_edit");
			if($new_pass=='') transfer("Mật khẩu mới chưa nhập","index.php?com=user&act=admin_edit");
			if($renew_pass=='') transfer("Chưa xác nhận mật khẩu mới","index.php?com=user&act=admin_edit");

			$sql = "select * from #_user where username='".$_SESSION['login']['username']."'";
			$d->query($sql);
			if($d->num_rows() == 1)
			{
				$row = $d->fetch_array();
				if($row['password'] != md5('$nina@'.$_POST['oldpassword'].$config['salt'])) transfer("Mật khẩu không chính xác","index.php?com=user&act=admin_edit");
			}
			else
			{
				die('Hệ thống bị lỗi. Xin liên hệ với admin. <br>Cám ơn.');
			}
			if($_POST['new_pass']!="")
			{
				if($_POST['new_pass']=='123qwe' || $_POST['new_pass']=='123456' || $_POST['new_pass']=='ninaco') transfer("Mật khẩu bạn đặt quá dễ, xin vui lòng chọn mật khẩu khác","index.php?com=user&act=admin_edit");			
				$data['password'] = md5('$nina@'.$_POST['new_pass'].$config['salt']);
				$flag_change_pass=true;
			}
		}
		
		$data['username'] = $_POST['username'];
		$data['ten'] = $_POST['ten'];
		$data['email'] = $_POST['email'];
		$data['yahoo'] = $_POST['yahoo'];
		$data['skype'] = $_POST['skype'];
		$data['dienthoai'] = $_POST['dienthoai'];
		
		$d->reset();
		$d->setTable('user');
		$d->setWhere('username', $_SESSION['login']['username']);
		if($d->update($data)){
			if($flag_change_pass==true) session_unset();
			transfer("Dữ liệu đã được lưu.","index.php");
		}
	}
	
	$sql = "select * from #_user where username='".$_SESSION['login']['username']."'";
	$d->query($sql);
	if($d->num_rows() == 1){
		$item = $d->fetch_array();
	}
}
	
function login()
{
	global $d, $login_name, $config;
	
	$username = $_POST['username'];
	$password = $_POST['password'];
	$login_failed = false;
	
	$sql = "select * from #_user where username='".$username."' and hienthi>0";
	$d->query($sql);
	if($d->num_rows() == 1)
	{
		$row = $d->fetch_array();
		if(($row['password'] == encrypt_password($password,$config['salt'])) && ($row['role'] == 3))
		{
			$timenow = time();
			$id_user = $row['id'];
			$ip= getRealIPAddress();
			$token = md5(time());
			$user_agent = $_SERVER['HTTP_USER_AGENT'];
			$sessionhash = md5(sha1($row['password'].$row['username']));

			/* Begin ghi log truy cập thành công */
			$d->reset();
			$data_ghilogtruycap['id_user'] = $id_user;
			$data_ghilogtruycap['ip'] = $ip;
			$data_ghilogtruycap['timelog'] = $timenow;
			$data_ghilogtruycap['user_agent'] = $user_agent;
			$d->setTable('user_log');
			$d->insert($data_ghilogtruycap);
			/* End ghi log truy cập thành công */

			/* Begin tạo log và login session */
			$d->reset();
			$data_taologvaloginsession['login_session'] = $sessionhash;
			$data_taologvaloginsession['lastlogin'] = $timenow;
			$data_taologvaloginsession['user_token'] = $token;
			$d->setTable('user');
			$d->setWhere('id',$id_user);
			$d->update($data_taologvaloginsession);
			/* Begin tạo log và login session */

			/* Begin khởi tạo Session để kiểm tra số lần đăng nhập */
			$d->reset();
			$data_taosessionkiemtrasolandangnhap['login_session'] = $sessionhash;
			$data_taosessionkiemtrasolandangnhap['lastlogin'] = $timenow;
			$d->setTable('user');
			$d->setWhere('id',$id_user);
			$d->update($data_taosessionkiemtrasolandangnhap);
			/* End khởi tạo Session để kiểm tra số lần đăng nhập */

			/* Begin Reset số lần đăng nhập và thời gian đăng nhập */
			$d->reset();
			$sql = "select id,login_ip,login_attempts,attempt_time,locked_time from #_user_limit where login_ip = '$ip'  order by  id desc limit 1";
			$d->query($sql);
			if($d->num_rows()==1)
			{
				$row_limitlogin = $d->result_array();
		        $id_login = $row_limitlogin[0]['id'];
		        
		        $d->reset();
				$data_resetsolandangnhap['login_attempts'] = 0;
				$data_resetsolandangnhap['locked_time'] = 0;
				$d->setTable('user_limit');
				$d->setWhere('id',$id_login);
				$d->update($data_resetsolandangnhap);
		   	}
			/* End Reset số lần đăng nhập và thời gian đăng nhập */

			$_SESSION[$login_name] = true;
			$_SESSION['login']['username'] = $username;
			$_SESSION['login']['id'] = $row['id'];
			$_SESSION['login']['quyen'] = $row['quyen'];
			$_SESSION['login']['token'] = $sessionhash;
			$_SESSION['login']['password'] = $row['password'];
			$_SESSION['isLoggedIn'] = true;
			$_SESSION['login_session'] = $sessionhash;
			$_SESSION['login_token'] = $token;
			$_SESSION['login']['idUser'] = $row['id'];

			/* Begin Cập nhật quyền của user đăng nhập */
			$d->reset();
			$data_capnhatquyen['quyen'] = $_SESSION['login']['token'];
			$d->setTable('user');
			$d->setWhere('id',$row['id']);
			$d->update($data_capnhatquyen);
			/* End Cập nhật quyền của user đăng nhập */
			
			/* Begin Lấy quyền của user đăng nhập */
			$sql_quyen = "select * from #_phanquyen where ma_quan_tri = '".$row['id']."'";
			$d->query($sql_quyen);
			$result = $d->result_array();
			if(!empty($result))
			{
				foreach ($result as $kq) 
				{
					$_SESSION['list_quyen'][] = $kq['quyen'];
				}
			}
			else
			{
				$_SESSION['list_quyen'][]='';
			}
			/* End Lấy quyền của user đăng nhập */

			redirect("index.php");
		}
		else
		{
			$login_failed = true;
		}
	}
	else
	{
		$login_failed = true;
	}
	if($login_failed)
	{
		$ip = getRealIPAddress();
		$d->reset();
		$sql = "select id,login_ip,login_attempts,attempt_time,locked_time from #_user_limit where login_ip =  '$ip'  order by  id desc limit 1";
		$d->query($sql);			
		if($d->num_rows()==1)
		{
			$row = $d->result_array();
			$id_login = $row[0]['id'];
			$attempt =$row[0]['login_attempts'];
			$noofattmpt = $config['login']['attempt'];
			if($attempt<$noofattmpt)
			{
				$attempt = $attempt +1;

				/* Begin Cập nhật số lần đăng nhập sai */
				$d->reset();
				$data_capnhatsolandangnhapsai['login_attempts'] = $attempt;
				$d->setTable('user_limit');
				$d->setWhere('id',$id_login);
				$d->update($data_capnhatsolandangnhapsai);
				/* End Cập nhật số lần đăng nhập sai */
					
				$no_ofattmpt =  $noofattmpt+1;
				$remain_attempt = $no_ofattmpt - $attempt;
				$msg = 'Sai thông tin. Còn '.$remain_attempt.' lần thử!';
			}
			else
			{
				if($row[0]['locked_time']==0)
				{
					$attempt = $attempt +1;
					$timenow = time();

					/* Begin Cập nhật số lần đăng nhập sai */
					$d->reset();
					$data_capnhatsolandangnhapsai['login_attempts'] = $attempt;
					$data_capnhatsolandangnhapsai['locked_time'] = $timenow;
					$d->setTable('user_limit');
					$d->setWhere('id',$id_login);
					$d->update($data_capnhatsolandangnhapsai);
					/* End Cập nhật số lần đăng nhập sai */
				}
				else
				{
					$attempt = $attempt +1;

					/* Begin Cập nhật số lần đăng nhập sai */
					$d->reset();
					$data_capnhatsolandangnhapsai['login_attempts'] = $attempt;
					$d->setTable('user_limit');
					$d->setWhere('id',$id_login);
					$d->update($data_capnhatsolandangnhapsai);
					/* End Cập nhật số lần đăng nhập sai */
				}
				$delay_time = $config['login']['delay'];
				$msg = "Bạn đã hết lần thử. Vui lòng thử lại sau ".$delay_time." phút!";
			}
		}
		else
		{
			$timenow = time();

			/* Begin Cập nhật thông tin đăng nhập sai */
			$d->reset();
			$data_ghilogtruycap['login_ip'] = $ip;
			$data_ghilogtruycap['login_attempts'] = 1;
			$data_ghilogtruycap['attempt_time'] = $timenow;
			$data_ghilogtruycap['locked_time'] = 0;
			$d->setTable('user_limit');
			$d->insert($data_ghilogtruycap);
			/* End Cập nhật thông tin đăng nhập sai */

			$remain_attempt = $config['login']['attempt'];
			$msg = 'Sai thông tin. Còn '.$remain_attempt.' lần thử!';
		}
		transfer($msg, "index.php?com=user&act=login");
	}
	transfer("Tên đăng nhập, mật khẩu không chính xác", "index.php?com=user&act=login");
}

function logout()
{
	global $login_name, $d;

	/* Begin Cập nhật quyền */
	$d->reset();
	$data_capnhatquyen['quyen'] = '';
	$d->setTable('user');
	$d->setWhere('id',$_SESSION['login']['idUser']);
	$d->update($data_capnhatquyen);
	/* End Cập nhật quyền */

	$_SESSION[$login_name] = false;
	unset($_SESSION['login']);
	unset($_SESSION['list_quyen']);
	redirect("index.php?com=user&act=login");
}
/* End Thông Tin Admin */

?>