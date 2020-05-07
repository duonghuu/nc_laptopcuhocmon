<!-- Begin Bảng Điều Khiển -->
<div class="breadcrumbwidget">
    <ul class="breadcrumb">
        <li><a href="index.php">Bảng điều khiển</a> <span class="divider">/</span></li>
        <li class="active">Quản lý <?=$config['photo']['photo_background'][$type]['title_main']?></li>
    </ul>
</div>
<!-- End Bảng Điều Khiển -->

<div class="pagetitle">
	<h1><?=$config['photo']['photo_background'][$type]['title_main']?></h1>
</div>

<div class="maincontent">
	<div class="contentinner">
		<div class="row-fluid">
			<div class="span12">
				<h4 class="widgettitle nomargin shadowed"></h4>
				<div class="widgetcontent bordered shadowed nopadding">
					<form name="frm" method="post" action="index.php?com=photo&act=save_photo_background&type=<?=$_GET['type']?>" enctype="multipart/form-data" class="stdform stdform2">
						
						<?php if($config['photo']['photo_background'][$type]['background']=='true') { ?>
							<?php if ($item['photo']!="") {?>
							<p><label>Hình hiện tại:</label><span class="field"><img src="<?=_upload_photo.$item['photo']?>" style="max-width: 150px" onerror="src='img/noimage.png'" alt="NO PHOTO"/></span></p>
							<?php } ?>
							<p><label>Upload hình ảnh:</label><span class="field"><input type="file" name="file" class="uniform-file" /> <strong><?php echo $config['photo']['photo_background'][$type]['img_type'] ?></strong></span></p>

							<p><label>Tùy chọn lặp:</label>
								<span class="field">
									<select id="background_repeat" name="background_repeat" class="main_font">
				  						<option value="">Chọn thuộc tính</option>
				  						<option <?php if($item['background_repeat']=='no-repeat') echo 'selected="selected"' ?> value="no-repeat">Không lặp lại</option>
				  						<option <?php if($item['background_repeat']=='repeat') echo 'selected="selected"' ?> value="repeat">Lặp lại</option>
				  						<option <?php if($item['background_repeat']=='repeat-x') echo 'selected="selected"' ?> value="repeat-x">Lặp lại theo chiều ngang</option>
				  						<option <?php if($item['background_repeat']=='repeat-y') echo 'selected="selected"' ?> value="repeat-y">Lặp lại theo chiều dọc</option>
				  					</select>
								</span>
							</p>

							<p><label>Kích thước:</label>
								<span class="field">
									<select id="background_size" name="background_size" class="main_font">
				  						<option value="">Chọn thuộc tính</option>
				  						<option <?php if($item['background_size']=='auto') echo 'selected="selected"' ?> value="auto">Auto</option>
				  						<option <?php if($item['background_size']=='cover') echo 'selected="selected"' ?> value="cover">Cover</option>
				  						<option <?php if($item['background_size']=='contain') echo 'selected="selected"' ?> value="contain">Contain</option>
				  						<option <?php if($item['background_size']=='100% 100%') echo 'selected="selected"' ?> value="100% 100%">Toàn màn hình</option>
				  						<option <?php if($item['background_size']=='100% auto') echo 'selected="selected"' ?> value="100% auto">Toàn màn hình theo chiều ngang</option>
				  						<option <?php if($item['background_size']=='auto 100%') echo 'selected="selected"' ?> value="auto 100%">Toàn màn hình theo chiều dọc</option>
				  					</select>
								</span>
							</p>

							<p><label>Vị trí:</label>
								<span class="field">
									<select id="background_position" name="background_position" class="main_font">
				  						<option value="">Chọn thuộc tính</option>
				  						<option <?php if($item['background_position']=='left top') echo 'selected="selected"' ?> value="left top">Canh Trái - Canh Trên</option>
				  						<option <?php if($item['background_position']=='left bottom') echo 'selected="selected"' ?> value="left bottom">Canh Trái - Canh Dưới</option>
				  						<option <?php if($item['background_position']=='left center') echo 'selected="selected"' ?> value="left center">Canh Trái - Canh Giữa</option>
				  						<option <?php if($item['background_position']=='right top') echo 'selected="selected"' ?> value="right top">Canh Phải - Canh Trên</option>
				  						<option <?php if($item['background_position']=='right bottom') echo 'selected="selected"' ?> value="right bottom">Canh Phải - Canh Dưới</option>
				  						<option <?php if($item['background_position']=='right center') echo 'selected="selected"' ?> value="right center">Canh Phải - Canh Giữa</option>
				  						<option <?php if($item['background_position']=='center top') echo 'selected="selected"' ?> value="center top">Canh Giữa - Canh Trên</option>
				  						<option <?php if($item['background_position']=='center bottom') echo 'selected="selected"' ?> value="center bottom">Canh Giữa - Canh Dưới</option>
				  						<option <?php if($item['background_position']=='center center') echo 'selected="selected"' ?> value="center center">Canh Giữa - Canh Giữa</option>
				  					</select>
								</span>
							</p>
							<p><label>Cố định:</label>
								<span class="field">
									<input type="checkbox" name="background_attachment" value="fixed" <?=(!isset($item['background_attachment']) || $item['background_attachment']=="fixed")?'checked="checked"':''?>> 
								</span>
							</p>
						<?php } ?>

						<?php if($config['photo']['photo_background'][$type]['mausac']=='true') { ?>
							<p><label>Màu sắc:</label>
						    	<span class="field mau_news_static">
						    		<input type="text" id="mau" maxlength="7" style="width:60px" name="mau" value="<?=$item['mau']?>"/>
									<span class="input-group-addon"><i></i></span>
								</span>
							</p>
							<!-- ColorPicker -->
							<script type="text/javascript" src="plugin/bootstrap-colorpicker-master/js/bootstrap-colorpicker.js"></script>
							<link type="text/css" rel="stylesheet" href="plugin/bootstrap-colorpicker-master/css/bootstrap-colorpicker.css" />

							<style type="text/css">
								.colorpicker 
								{
								    width: 140px !important;
								    height: 115px !important;
								    background: white !important; 
								}
								.colorpicker.colorpicker-visible 
								{
								    margin-top: 10px;
								    margin-left: -20px;
								}
							</style>

							<script>
							    jQuery(function(){
							        jQuery('.mau_news_static').colorpicker();
							    });
							</script>
						<?php } ?>

						<?php if($config['photo']['photo_background'][$type]['background']=='true') { ?>
							<p><label>Loại Hiển thị:</label>
								<span class="field">
									<input type="radio" name="loaihienthi" value="1" <?=($item['loaihienthi']==1)?'checked="checked"':''?>> Hình nền
									<input type="radio" name="loaihienthi" value="0" <?=($item['loaihienthi']==0)?'checked="checked"':''?>> Màu sắc
								</span>
							</p>
						<?php } ?>

						<p><label>Hiển thị:</label><span class="field"><input type="checkbox" name="hienthi" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?>></span></p>

						<p class="stdformbutton">						
							<input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
							<button type="submit" class="btn btn-primary"><span class="iconfa-save"></span> Lưu</button>
						</p>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>