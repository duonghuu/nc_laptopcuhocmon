<!-- Begin Bảng Điều Khiển -->
<div class="breadcrumbwidget">
    <ul class="breadcrumb">
        <li><a href="index.php">Bảng điều khiển</a> <span class="divider">/</span></li>
        <li class="active">Thông tin liên hệ</li>
    </ul>
</div>
<!-- End Bảng Điều Khiển -->

<div class="pagetitle">
	<h1><?php if ($_REQUEST['act']=="edit") echo "Cập nhật"; else echo "Thêm mới"; ?></h1>
</div>

<div class="maincontent">
	<div class="contentinner">
		<div class="row-fluid">
			<div class="span12">
				<h4 class="widgettitle nomargin shadowed"></h4>
				<div class="widgetcontent bordered shadowed nopadding">
					<form name="frm" method="post" action="index.php?com=contact&act=save" enctype="multipart/form-data" class="stdform stdform2">
						<?php if($_GET['act']=='edit') { ?>
					    	<p><label>File hiện tại:</label><span class="field"><a href="<?=_upload_file.$item['file']?>" title="Tập tin hiện tại"><span class="icon-download"></span> Download file</a> (<?=$item['file']?>)</span></p>
					    <?php } ?>
					    <p><label>Họ tên:</label><span class="field"><input type="text" name="ten" value="<?=@$item['ten']?>" class="input-xlarge" placeholder="Họ tên"/></span></p>
					    <p><label>Email *:</label><span class="field"><input type="email" name="email" value="<?=@$item['email']?>" class="input-xlarge" placeholder="Email *" required/></span></p>
					    <p><label>Điện thoại:</label><span class="field"><input type="text" name="dienthoai" value="<?=@$item['dienthoai']?>" class="input-xlarge" placeholder="Điện thoại"/></span></p>
					    <p><label>Địa chỉ:</label><span class="field"><textarea name="diachi" id="diachi" rows="5" cols="80" style="width: 100%; box-sizing: border-box" class="tinymce"><?=@$item['diachi']?></textarea></span></p>
					    <p><label>Tiêu đề:</label><span class="field"><input type="text" name="tieude" value="<?=@$item['tieude']?>" class="input-xlarge" placeholder="Tiêu đề"/></span></p>
					    <p><label>Nội dung:</label><span class="field"><textarea name="noidung" id="noidung" rows="10" cols="80" style="width: 100%; box-sizing: border-box" class="tinymce"><?=@$item['noidung']?></textarea></span></p>
					    <p><label>Ghi chú:</label><span class="field"><textarea name="ghichu" id="ghichu" rows="10" cols="80" style="width: 100%; box-sizing: border-box" class="tinymce"><?=@$item['ghichu']?></textarea></span></p>
					    <p><label>STT:</label> <span class="field"><input type="number" min="0" name="stt" value="<?=isset($item['stt'])?$item['stt']:1?>" style="width:30px"></span></p>
						<!-- <p><label>Hiển thị:</label><span class="field"><input type="checkbox" name="hienthi" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?>></span></p> -->
						<p class="stdformbutton">
							<input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
							<button type="submit" class="btn btn-primary"><span class="iconfa-save"></span> Xác nhận</button>
							<button type="reset" class="btn"><span class="iconfa-refresh"></span> Làm lại</button>
							<button type="button" onclick="javascript:window.location='index.php?com=contact&act=man'" class="btn"><span class="iconfa-off"></span> Thoát</button>
						</p>	
					</form>
				</div>
			</div>
		</div>
	</div>
</div>