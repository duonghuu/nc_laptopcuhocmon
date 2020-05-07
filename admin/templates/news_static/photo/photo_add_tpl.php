<!-- Begin Bảng Điều Khiển -->
<div class="breadcrumbwidget">
    <ul class="breadcrumb">
        <li><a href="index.php">Bảng điều khiển</a> <span class="divider">/</span></li>
        <li><a href="index.php?com=news_static&act=capnhat&type=<?=$_GET['type']?>">Bài viết</a> <span class="divider">/</span></li>
        <li class="active"><?=$config['news_static'][$type]['title_main_photo']?></li>
    </ul>
</div>
<!-- End Bảng Điều Khiển -->

<div class="pagetitle">
	<h1>Thêm mới <?=$config['news_static'][$type]['title_main_photo']?></h1>
</div>

<div class="maincontent">
	<div class="contentinner">
		<div class="row-fluid">
			<div class="span12">
				<h4 class="widgettitle nomargin shadowed"></h4>
				<div class="widgetcontent bordered shadowed nopadding">
					<form name="frm" method="post" action="index.php?com=news_static&act=save_photo&type=<?=$_GET['type']?>" enctype="multipart/form-data" class="stdform stdform3">
						<?php for ($i=0; $i < 5; $i++) { ?>
						
						<?php if($config['news_static'][$type]['mausac_photo']=='true') { ?>
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
							        jQuery('.mau_color_picker').colorpicker();
							    });
							</script>
							<p><label>Màu sắc:</label>
						    	<span class="field mau_color_picker">
						    		<input type="text" id="mau<?=$i?>" maxlength="7" style="width:60px" name="mau<?=$i?>"/>
									<span class="input-group-addon"><i></i></span>
								</span>
							</p>
						<?php } ?>

						<?php if($config['news_static'][$type]['images_photo']=='true') { ?>
                            <p><label>Upload hình ảnh <?=$i+1?>:</label><span class="field"><input type="file" name="file<?=$i?>" class="uniform-file" /> <strong><?php echo $config['news_static'][$type]['img_type_photo']." - Width: ".$config['news_static'][$type]['width_photo']." px - Height: ".$config['news_static'][$type]['height_photo']." px"?></strong></span></p>
                        <?php } ?>
						
						<!-- Tiêu đề -->
                        <?php if($config['news_static'][$type]['tieude_photo']=='true') { ?>
                            <?php foreach($config['lang'] as $key => $value) { ?>
                                <p><label>Tiêu đề (<?=$key?>) <?=$i+1?>:</label><span class="field"><input type="text" name="ten<?=$key?><?=$i?>" class="input-xxlarge" placeholder="Tiêu đề (<?=$key?>) *"/></span></p>
                            <?php } ?>
                        <?php } ?>

                        <!-- Mô tả -->
                        <?php if($config['news_static'][$type]['mota_photo']=='true') { ?>
                            <?php foreach($config['lang'] as $key => $value) { ?>
                                <p><label>Mô tả (<?=$key?>) <?=$i+1?>:</label><span class="field"><textarea name="mota<?=$key?><?=$i?>" id="mota<?=$key?><?=$i?>" rows="5" cols="80" style="width: 100%; box-sizing: border-box;" class="tinymce"></textarea></span>
                                <?php if($config['news_static'][$type]['mota_cke_photo']=='true') { ?>
                                    <script type="text/javascript">
                                        var motavi<?=$i?> = CKEDITOR.replace('mota<?=$key?><?=$i?>');
                                    </script>
                                <?php } ?>
                            <?php } ?>
                        <?php } ?>

                        <!-- Nội Dung -->
                        <?php if($config['news_static'][$type]['noidung_photo']=='true') { ?>
                            <?php foreach($config['lang'] as $key => $value) { ?>
                                <p><label>Nội dung (<?=$key?>) <?=$i+1?>:</label><span class="field"><textarea name="noidung<?=$key?><?=$i?>" id="noidung<?=$key?><?=$i?>" rows="5" cols="80" style="width: 100%; box-sizing: border-box;" class="tinymce"></textarea></span>
                                <?php if($config['news_static'][$type]['noidung_cke_photo']=='true') { ?>
                                    <script type="text/javascript">
                                        var noidungvi<?=$i?> = CKEDITOR.replace('noidung<?=$key?><?=$i?>');
                                    </script>
                                <?php } ?>
                            <?php } ?>
                        <?php } ?>
						
						<p><label>STT:</label><span class="field"><input type="number" min="0" name="stt<?=$i?>" value="1" style="width:30px"></span></p>
						<p><label>Hiển thị:</label><span class="field"><input type="checkbox" name="hienthi<?=$i?>" checked="checked"></span></p>
						<hr/>
						<?php } ?>

						<p class="stdformbutton">
							<button type="submit" class="btn btn-primary"><span class="iconfa-save"></span> Lưu</button>
							<button type="reset" class="btn"><span class="iconfa-refresh"></span> Làm lại</button>
							<button type="button" onclick="javascript:window.location='index.php?com=news_static&act=man_photo&type=<?=$_GET['type']?>'" class="btn"><span class="iconfa-off"></span> Thoát</button>
						</p>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>