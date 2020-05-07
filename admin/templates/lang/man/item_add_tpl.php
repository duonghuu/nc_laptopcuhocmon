<!-- Begin Bảng Điều Khiển -->
<div class="breadcrumbwidget">
    <ul class="breadcrumb">
        <li><a href="index.php">Bảng điều khiển</a> <span class="divider">/</span></li>
        <li class="active">Quản lý ngôn ngữ</li>
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
					<form name="frm" method="post" action="index.php?com=lang&act=save" enctype="multipart/form-data" class="stdform stdform2">
						<p>
							<label>Biến định nghĩa:</label>
							<span class="field">
							<?php if($_REQUEST['act']=="add"){ ?>
								<input type="text" name="giatri" class="input-xxlarge" placeholder="Biến định nghĩa *" required/>
							<?php } else { ?>
								<input type="text" name="giatri" class="input-xxlarge" <?php if($_SESSION['login']['username']!="coder" && $_SESSION['login']['password']!="487b60d660404828de12de149518232c") echo 'readonly="true" style="border:none;background:none;box-shadow:none;"'; ?> value="<?=@$item['giatri']?>" />
							<?php } ?>
							</span>
						</p>
						<?php foreach($config['lang'] as $key => $value) { ?>
		                  	<p><label><?=$value?>:</label><span class="field"><input type="text" name="lang<?=$key?>" value="<?=@$item['lang'.$key]?>" class="input-xxlarge" placeholder="<?=$value?> *"/></span></p>
		                <?php } ?>
						<p class="stdformbutton">
							<input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
							<button type="submit" class="btn btn-primary"><span class="iconfa-save"></span> Lưu</button>
							<button type="reset" class="btn"><span class="iconfa-refresh"></span> Làm lại</button>
							<button type="button" onclick="javascript:window.location='index.php?com=lang&act=man'" class="btn"><span class="iconfa-off"></span> Thoát</button>
						</p>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>