<script type="text/javascript">
	jQuery(function() {
		jQuery( "#ngaysinh" ).datepicker({
			dateFormat: 'dd-mm-yy'
		});
	});
</script>

<!-- Begin Bảng Điều Khiển -->
<div class="breadcrumbwidget">
    <ul class="breadcrumb">
        <li><a href="index.php">Bảng điều khiển</a> <span class="divider">/</span></li>
        <li class="active">Quản lý tài khoản admin</li>
    </ul>
</div>
<!-- End Bảng Điều Khiển -->

<div class="pagetitle">
	<h1><?php if ($_REQUEST['act']=="edit") echo 'Cập nhật admin'; else echo 'Thêm mới admin'; ?></h1>
</div>

<div class="maincontent">
	<div class="contentinner">
		<div class="row-fluid">
			<div class="span12">
				<h4 class="widgettitle nomargin shadowed"></h4>
				<div class="widgetcontent bordered shadowed nopadding">
					<form name="frm" method="post" action="index.php?com=user&act=save_admin" enctype="multipart/form-data" class="stdform stdform2">
						<p><label>Tài khoản <span class="require">*</span></label><span class="field"><input type="text" name="username" id="username" value="<?=$item['username']?>" class="input" <?php if($_GET['act'] == "edit_admin") echo "readonly"; ?> required="" placeholder="Tài khoản"/></span></p>
						<p><label>Họ và tên</label><span class="field"><input type="text" name="ten" id="ten" value="<?=$item['ten']?>" class="input" placeholder="Họ và tên"/></span></p>
						<p><label>Mật khẩu <span class="require">*</span></label><span class="field"><input type="password" name="password" id="password" value="" class="input" placeholder="Mật khẩu"/></span></p>
						<p><label>Nhắc lại mật khẩu <span class="require">*</span></label><span class="field"><input type="password" id="confirm_password" name="confirm_password" class="input" placeholder="Nhắc lại mật khẩu"></span></p>
						<p><label>Email <span class="require">*</span></label><span class="field"><input type="email" name="email" id="email" value="<?=$item['email']?>" required="" class="input" placeholder="Email"/></span></p>
						<p><label>Địa chỉ</label><span class="field"><input type="text" name="diachi" id="diachi" value="<?=$item['diachi']?>" class="input" placeholder="Địa chỉ"/></span></p>
						<p><label>Điện thoại</label><span class="field"><input type="text" name="dienthoai" value="<?=$item['dienthoai']?>" class="input" placeholder="Điện thoại"/></span></p>
						<!-- <p><label>Ngày sinh</label><span class="field"><input type="text" id="ngaysinh" name="ngaysinh" value="<?php if($item['ngaysinh']!=0) echo date('d-m-Y',$item['ngaysinh']); else echo "" ?>" class="input" placeholder="Ngày sinh" /></span></p> -->
						<p><label>Được hoạt động</label><span class="field"><input type="checkbox" name="hienthi" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?>></span></p>

						<p class="stdformbutton">
							<input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
							<button type="submit" class="btn btn-primary"><span class="iconfa-save"></span> Lưu</button>
							<button type="reset" class="btn"><span class="iconfa-refresh"></span> Làm lại</button>
							<button type="button" onclick="javascript:window.location='index.php?com=user&act=man_admin'" class="btn"><span class="iconfa-off"></span> Thoát</button>
						</p>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	var password = document.getElementById('password'), confirm_password = document.getElementById('confirm_password');
	function validatePassword() {
	    if (password.value != confirm_password.value) {
	        confirm_password.setCustomValidity("Mật khẩu và Nhắc lại mật khẩu không trùng khớp");
	    } else {
	        confirm_password.setCustomValidity('');
	    }
	}
	password.onchange = validatePassword;
	confirm_password.onkeyup = validatePassword;
</script>