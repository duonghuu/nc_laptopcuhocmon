<!-- Begin Bảng Điều Khiển -->
<div class="breadcrumbwidget">
    <ul class="breadcrumb">
        <li><a href="index.php">Bảng điều khiển</a> <span class="divider">/</span></li>
        <li class="active">Chi tiết <?=$config['email_dk'][$type]['title_main']?></li>
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
					<form name="frm" method="post" action="index.php?com=email_dk&act=save&type=<?=$_GET['type']?>" enctype="multipart/form-data" class="stdform stdform2">
					    <?php if($config['email_dk'][$type]['file']=='true') { ?>
					    	<?php if($_GET['act']=='edit' && $item['file']!='') { ?>
                                <p><label>File hiện tại:</label><span class="field"><a href="<?=_upload_file.$item['file']?>" title="Tập tin hiện tại"><span class="icon-download"></span> Download file</a> (<?=$item['file']?>)</span></p>
                            <?php } ?>
                            <p><label>Upload file:</label><span class="field"><input type="file" name="file" class="uniform-file" /> <strong><?=$config['email_dk'][$type]['file_type']?></strong></span></p>
					    <?php } ?>
					    <?php if($config['email_dk'][$type]['tieude']=='true') { ?>
					    	<p><label>Họ tên:</label><span class="field"><input type="text" name="ten" value="<?=@$item['ten']?>" class="input-xlarge" placeholder="Họ tên"/></span></p>
					    <?php } ?>
					    <?php if($config['email_dk'][$type]['email']=='true') { ?>
					    	<p><label>Email *:</label><span class="field"><input type="email" name="email" value="<?=@$item['email']?>" class="input-xlarge" placeholder="Email *" required/></span></p>
					    <?php } ?>
					    <?php if($config['email_dk'][$type]['dienthoai']=='true') { ?>
					    	<p><label>Điện thoại:</label><span class="field"><input type="text" name="dienthoai" value="<?=@$item['dienthoai']?>" class="input-xlarge" placeholder="Điện thoại"/></span></p>
					    <?php } ?>
					    <?php if($config['email_dk'][$type]['diachi']=='true') { ?>
					    	<p><label>Địa chỉ:</label><span class="field"><textarea name="diachi" id="diachi" rows="5" cols="80" style="width: 100%; box-sizing: border-box" class="tinymce"><?=@$item['diachi']?></textarea></span></p>
					    <?php } ?>
					    <?php if($config['email_dk'][$type]['chude']=='true') { ?>
					    	<p><label>Chủ đề:</label><span class="field"><input type="text" name="chude" value="<?=@$item['chude']?>" class="input-xlarge" placeholder="Chủ đề"/></span></p>
					    <?php } ?>
					    <?php if($config['email_dk'][$type]['noidung']=='true') { ?>
					    	<p><label>Nội dung:</label><span class="field"><textarea name="noidung" id="noidung" rows="10" cols="80" style="width: 100%; box-sizing: border-box" class="tinymce"><?=@$item['noidung']?></textarea></span></p>
					    <?php } ?>
					    <?php if($config['email_dk'][$type]['ghichu']=='true') { ?>
					    	<p><label>Ghi chú:</label><span class="field"><textarea name="ghichu" id="ghichu" rows="5" cols="80" style="width: 100%; box-sizing: border-box" class="tinymce"><?=@$item['ghichu']?></textarea></span></p>
					    <?php } ?>
					    <?php if(count($config['email_dk'][$type]['tinhtrang'])>0) { ?>
					    	<p><label>Tình trạng:</label><span class="field">
					    		<select name="tinhtrang" id="tinhtrang">
					    			<option value="">Cập nhật tình trạng</option>
					    			<?php foreach ($config['email_dk'][$type]['tinhtrang'] as $key => $value) { ?>
										<option <?=(@$item['tinhtrang']==$key)?"selected":""?> value="<?=$key?>"><?=$value?></option>
									<?php } ?>
					    		</select>
					    	</span></p>
					    <?php } ?>
					    <p><label>STT:</label> <span class="field"><input type="number" min="0" name="stt" value="<?=isset($item['stt'])?$item['stt']:1?>" style="width:30px"></span></p>
						<!-- <p><label>Hiển thị:</label><span class="field"><input type="checkbox" name="hienthi" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?>></span></p> -->
						<p class="stdformbutton">
							<input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
							<button type="submit" class="btn btn-primary"><span class="iconfa-save"></span> Lưu</button>
							<button type="reset" class="btn"><span class="iconfa-refresh"></span> Làm lại</button>
							<button type="button" onclick="javascript:window.location='index.php?com=email_dk&act=man&type=<?=$_GET['type']?>'" class="btn"><span class="iconfa-off"></span> Thoát</button>
						</p>	
					</form>
				</div>
			</div>
		</div>
	</div>
</div>