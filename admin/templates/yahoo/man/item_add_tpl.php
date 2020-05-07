<!-- Begin Bảng Điều Khiển -->
<div class="breadcrumbwidget">
    <ul class="breadcrumb">
        <li><a href="index.php">Bảng điều khiển</a> <span class="divider">/</span></li>
        <li class="active">Chi tiết hổ trợ trực tuyến</li>
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
					<form name="frm" method="post" action="index.php?com=yahoo&act=save" enctype="multipart/form-data" class="stdform stdform2">

						<?php if($config['yahoo']['images']=='true') { ?>
                            <?php if($_GET['act']=='edit') { ?>
                                <p><label>Hình hiện tại:</label><span class="field"><img src="<?=_upload_photo.$item['photo']?>" onerror="src='img/noimage.png'" alt="NO PHOTO" style="max-width: 150px"/></span></p>
                            <?php } ?>
                            <p><label>Upload hình ảnh:</label><span class="field"><input type="file" name="file" class="uniform-file" /> <strong><?php echo $config['yahoo']['img_type']." - Width: ".$config['yahoo']['width']." px - Height: ".$config['yahoo']['height']." px"?></strong></span></p>
                        <?php } ?>

						<p><label>Họ tên:</label><span class="field"><input type="text" name="ten" value="<?=@$item['ten']?>" class="input-xxlarge" placeholder="Họ tên *" required/></span></p>
						<?php if($config['yahoo']['email']=="true") { ?>
							<p><label>Email:</label><span class="field"><input type="text" name="email" value="<?=@$item['email']?>" class="input-xxlarge" placeholder="Email *" required/></span></p>
						<?php } ?>
						<?php if($config['yahoo']['skype']=="true") { ?>
							<p><label>Skype:</label><span class="field"><input type="text" name="skype" value="<?=@$item['skype']?>" class="input-xxlarge" placeholder="Skype *"/></span></p>
						<?php } ?>
						<?php if($config['yahoo']['zalo']=="true") { ?>
							<p><label>Zalo:</label><span class="field"><input type="text" name="zalo" value="<?=@$item['zalo']?>" class="input-xxlarge" placeholder="Zalo *" required/></span></p>
						<?php } ?>
						<?php if($config['yahoo']['viber']=="true") { ?>
							<p><label>Viber:</label><span class="field"><input type="text" name="viber" value="<?=@$item['viber']?>" class="input-xxlarge" placeholder="Viber *" required/></span></p>
						<?php } ?>
						<?php if($config['yahoo']['dienthoai']=="true") { ?>
							<p><label>Điện thoại:</label><span class="field"><input type="text" name="dienthoai" value="<?=@$item['dienthoai']?>" class="input-xxlarge" placeholder="Điện thoại *"/></span></p>
						<?php } ?>
						<p><label>STT :</label><span class="field"><input type="number" min="0" name="stt" value="<?=isset($item['stt'])?$item['stt']:1?>" style="width:30px" required></span></p>
						<p><label>Hiển thị:</label><span class="field"><input type="checkbox" name="hienthi" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?>></span></p>
						<p class="stdformbutton">
							<input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
							<button type="submit" class="btn btn-primary"><span class="iconfa-save"></span> Lưu</button>
							<button type="reset" class="btn"><span class="iconfa-refresh"></span> Làm lại</button>
							<button type="button" onclick="javascript:window.location='index.php?com=yahoo&act=man'" class="btn"><span class="iconfa-off"></span> Thoát</button>
						</p>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>