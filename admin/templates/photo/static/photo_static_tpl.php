<!-- Begin Bảng Điều Khiển -->
<div class="breadcrumbwidget">
    <ul class="breadcrumb">
        <li><a href="index.php">Bảng điều khiển</a> <span class="divider">/</span></li>
        <li class="active">Quản lý <?=$config['photo']['photo_static'][$type]['title_main']?></li>
    </ul>
</div>
<!-- End Bảng Điều Khiển -->

<div class="pagetitle">
	<h1><?=$config['photo']['photo_static'][$type]['title_main']?></h1>
</div>

<div class="maincontent">
	<div class="contentinner">
		<div class="row-fluid">
			<div class="span12">
				<h4 class="widgettitle nomargin shadowed"></h4>
				<div class="widgetcontent bordered shadowed nopadding">
					<form name="frm" method="post" action="index.php?com=photo&act=save_static&type=<?=$_GET['type']?>" enctype="multipart/form-data" class="stdform stdform2">
						
						<?php if($config['photo']['photo_static'][$type]['flash']=='true') { ?>
							<?php if ($item['photo']!="") { ?>
								<p><label>Hình hiện tại:</label><span class="field">
								<object codebase="http://active.macromedia.com/flash4/cabs/swflash.cab#version=4,0,0,0" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000">
					              	<param NAME="_cx" VALUE="13414">
					              	<param NAME="_cy" VALUE="6641">
					              	<param NAME="FlashVars" VALUE>
					              	<param NAME="Movie" VALUE="<?=_upload_photo.$item['photo']?>">
					              	<param NAME="Src" VALUE="<?=_upload_photo.$item['photo']?>">
					              	<param NAME="Quality" VALUE="High">
					              	<param NAME="AllowScriptAccess" VALUE>
					              	<param NAME="DeviceFont" VALUE="0">
					              	<param NAME="EmbedMovie" VALUE="0">
					              	<param NAME="SWRemote" VALUE>
					              	<param NAME="MovieData" VALUE>
					              	<param NAME="SeamlessTabbing" VALUE="1">
					              	<param NAME="Profile" VALUE="0">
					              	<param NAME="ProfileAddress" VALUE>
					              	<param NAME="ProfilePort" VALUE="0">
					              	<param NAME="AllowNetworking" VALUE="all">
					              	<param NAME="AllowFullScreen" VALUE="false">
					              	<param name="scale" value="ExactFit">
					             	<embed src="<?=_upload_photo.$item['photo']?>" quality="High" pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" style="max-width: 400px" scale="ExactFit"></embed>
					            </object>
					            </span></p>
							<?php } ?>
						<?php } ?>

						<?php if($config['photo']['photo_static'][$type]['images']=='true') { ?>
							<p><label>Hình hiện tại:</label><span class="field"><img src="<?=_upload_photo.$item['photo']?>" onerror="src='img/noimage.png'" alt="NO PHOTO" style="max-width: 150px"/></span></p>
						<?php } ?>

						<p><label>Upload hình ảnh:</label><span class="field"><input type="file" name="file" class="uniform-file" /> <strong><?php echo $config['photo']['photo_static'][$type]['img_type']." - Width: ".$config['photo']['photo_static'][$type]['width']." px - Height: ".$config['photo']['photo_static'][$type]['height']." px"?></strong></span></p>

						<?php if($config['photo']['photo_static'][$type]['link']=='true') { ?>
							<p><label>Link:</label><span class="field"><input type="text" value="<?=$item['link']?>" name="link" class="input-xxlarge" placeholder="Link *"/></span></p>
						<?php } ?>

						<?php if($config['photo']['photo_static'][$type]['video']=='true') { ?>
                        	<p><label>Link video:</label><span class="field"><input type="text" value="<?=$item['link_video']?>" name="link_video" id="link_video" class="input-xxlarge" placeholder="Link video *"/></span></p>
                            <p><label>Video demo:</label><span class="field">
                                <iframe id="load_video" width="314" src="//www.youtube.com/embed/<?=getYoutubeIdFromUrl(@$item['link_video'])?>" width="300" <?php if(@$item["link_video"] == "") echo "height='0'"; else echo "height='200'";?> frameborder="0" allowfullscreen></iframe>
                            </span></p>

                            <script type="text/javascript">
                                function youtube_parser(url)
                                {
                                    var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
                                    var match = url.match(regExp);
                                    return (match&&match[7].length==11)? match[7] : false;
                                }
                                
                                jQuery().ready(function(e) 
                                {
                                    jQuery("#link_video").change(function(){
                                        var url = youtube_parser(jQuery(this).val());
                                        jQuery("span#notify-video-demo").hide();
                                        jQuery("#load_video").attr("src","//www.youtube.com/embed/"+url).css({"height": "200", "width": "300"});
                                    })
                                });
                            </script>
                        <?php } ?>

						<!-- Tiêu đề -->
                        <?php if($config['photo']['photo_static'][$type]['tieude']=='true') { ?>
                            <?php foreach($config['lang'] as $key => $value) { ?>
                                <p><label>Tiêu đề (<?=$key?>) <?=$i+1?>:</label><span class="field"><input type="text" name="ten<?=$key?><?=$i?>" class="input-xxlarge" value="<?=@$item['ten'.$key]?>" placeholder="Tiêu đề (<?=$key?>) *"/></span></p>
                            <?php } ?>
                        <?php } ?>

                        <!-- Mô tả -->
                        <?php if($config['photo']['photo_static'][$type]['mota']=='true') { ?>
                            <?php foreach($config['lang'] as $key => $value) { ?>
                                <p><label>Mô tả (<?=$key?>) <?=$i+1?>:</label><span class="field"><textarea name="mota<?=$key?><?=$i?>" id="mota<?=$key?><?=$i?>" rows="5" cols="80" style="width: 100%; box-sizing: border-box;" class="tinymce"><?=@$item['mota'.$key]?></textarea></span>
                                <?php if($config['photo']['photo_static'][$type]['mota_cke']=='true') { ?>
                                    <script type="text/javascript">
                                        var motavi<?=$i?> = CKEDITOR.replace('mota<?=$key?><?=$i?>');
                                    </script>
                                <?php } ?>
                            <?php } ?>
                        <?php } ?>

                        <!-- Nội Dung -->
                        <?php if($config['photo']['photo_static'][$type]['noidung']=='true') { ?>
                            <?php foreach($config['lang'] as $key => $value) { ?>
                                <p><label>Nội dung (<?=$key?>) <?=$i+1?>:</label><span class="field"><textarea name="noidung<?=$key?><?=$i?>" id="noidung<?=$key?><?=$i?>" rows="5" cols="80" style="width: 100%; box-sizing: border-box;" class="tinymce"><?=@$item['noidung'.$key]?></textarea></span>
                                <?php if($config['photo']['photo_static'][$type]['noidung_cke']=='true') { ?>
                                    <script type="text/javascript">
                                        var noidungvi<?=$i?> = CKEDITOR.replace('noidung<?=$key?><?=$i?>');
                                    </script>
                                <?php } ?>
                            <?php } ?>
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