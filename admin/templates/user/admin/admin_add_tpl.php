<script language="javascript" src="media/scripts/my_script.js"></script>
<script language="javascript">
	function js_submit()
	{
		if(isEmpty(document.frm.username, "Tài khoản không được bỏ trống!")){
			return false;
		}

		if(isEmpty(document.frm.oldpassword, "Mật khẩu không được để trống")){
			return false;
		}

		if(!isEmpty(document.frm.new_pass) && document.frm.new_pass.value.length<6){
			alert("Mật khẩu tối thiểu 6 ký tự!");
			document.frm.new_pass.focus();
			return false;
		}

		if(!isEmpty(document.frm.new_pass) && document.frm.new_pass.value!=document.frm.renew_pass.value){
			alert("Nhập lại mật khẩu chưa trùng khớp!");
			document.frm.renew_pass.focus();
			return false;
		}

		if(!isEmpty(document.frm.email) && !check_email(document.frm.email.value)){
			alert('Email không hợp lệ!');
			document.frm.email.focus();
			return false;
		}
	}
</script>

<!-- Begin Bảng Điều Khiển -->
<div class="breadcrumbwidget">
    <ul class="breadcrumb">
        <li><a href="index.php">Bảng điều khiển</a> <span class="divider">/</span></li>
        <li class="active">Quản lý admin</li>
    </ul>
</div>
<!-- End Bảng Điều Khiển -->

<div class="maincontent">
	<div class="contentinner">
		<div class="row-fluid">
			<div class="span12">
				<h3>Quản lý</h3>
				<h4 class="widgettitle nomargin shadowed">Thay đổi mật khẩu</h4>
				<div class="widgetcontent bordered shadowed nopadding">
					<form name="frm" method="post" action="index.php?com=user&act=admin_edit" enctype="multipart/form-data" class="stdform stdform2">
						<p><label>Tài khoản <span class="require">*</span></label><span class="field"><input type="text" name="username" id="username" value="<?=$item['username']?>" class="input" readonly/></span></p>
						<p><label>Họ tên</label><span class="field"><input type="text" name="ten" id="ten" value="<?=$item['ten']?>" class="input" /></span></p>
						<p><label>Mật khẩu cũ <span class="require">*</span></label><span class="field"><input type="password" name="oldpassword" id="oldpassword" value="" class="input" /></span></p>
						<p><label>Mật khẩu mới </label><span class="field"><input type="password" name="new_pass" id="new_pass" value="" class="input" /></span></p>
						<p><label>Nhập lại mật khẩu mới</label><span class="field"><input type="password" name="renew_pass" id="renew_pass" value="" class="input" /></span></p>
						<p class="stdformbutton">
							<input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
							<button type="submit" class="btn btn-primary"><span class="iconfa-save"></span> Lưu</button>
							<button type="reset" class="btn"><span class="iconfa-refresh"></span> Làm lại</button>
							<button type="button" onclick="javascript:window.location='index.php'" class="btn"><span class="iconfa-off"></span> Thoát</button>
						</p>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>