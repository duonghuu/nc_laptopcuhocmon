<!-- Begin Bảng Điều Khiển -->
<div class="breadcrumbwidget">
    <ul class="breadcrumb">
        <li><a href="index.php">Bảng điều khiển</a> <span class="divider">/</span></li>
        <li class="active">Quản lý thông tin công ty</li>
    </ul>
</div>
<!-- End Bảng Điều Khiển -->

<div class="pagetitle">
	<h1>Thông tin chính</h1>
</div>

<div class="maincontent">
	<div class="contentinner">
		<div class="row-fluid">
			<div class="span12">
				<h4 class="widgettitle nomargin shadowed"></h4>
				<div class="widgetcontent bordered shadowed nopadding">
					<form name="frm" method="post" action="index.php?com=setting&act=save" enctype="multipart/form-data" class="stdform stdform2">
						<?php if(count($config['lang'])>1) { ?>
							<p>
								<label>Ngôn ngữ mặc định:</label>
								<span class="field">
									<?php foreach($config['lang'] as $key => $value) { ?>
					                  	<input type="radio" <?=($key=='vi')?"checked":($key==$item['lang_default'])?"checked":""?> value="<?=$key?>" name="lang_default" id="lang_default"> <?=$value?>
					                <?php } ?>
								</span>
							</p>
						<?php } ?>

						<p><label>IP host:</label><span class="field"><input type="text" name="ip_host" value="<?=@$item['ip_host']?>" class="input-xxlarge" placeholder="IP host"/></span></p>
						<p><label>Email host:</label><span class="field"><input type="email" name="email_host" value="<?=@$item['email_host']?>" class="input-xxlarge" placeholder="Email host"/></span></p>
						<p><label>Password host:</label><span class="field"><input type="text" name="password_host" value="<?=@$item['password_host']?>" class="input-xxlarge" placeholder="Password host"/></span></p>

						<p><label>SEO H1:</label> <span class="field"><textarea name="seo_h1" id="seo_h1" style="height: 100px" class="input-xxlarge" placeholder="SEO H1"><?=$item['seo_h1']?></textarea></span></p>
                        <p><label>SEO H2:</label> <span class="field"><textarea name="seo_h2" id="seo_h2" style="height: 100px" class="input-xxlarge" placeholder="SEO h2"><?=$item['seo_h2']?></textarea></span></p>
                        <p><label>SEO H3:</label> <span class="field"><textarea name="seo_h3" id="seo_h3" style="height: 100px" class="input-xxlarge" placeholder="SEO h3"><?=$item['seo_h3']?></textarea></span></p>
                        <p><label>SEO H4:</label> <span class="field"><textarea name="seo_h4" id="seo_h4" style="height: 100px" class="input-xxlarge" placeholder="SEO h4"><?=$item['seo_h4']?></textarea></span></p>
                        <p><label>SEO H5:</label> <span class="field"><textarea name="seo_h5" id="seo_h5" style="height: 100px" class="input-xxlarge" placeholder="SEO h5"><?=$item['seo_h5']?></textarea></span></p>
                        <p><label>SEO H6:</label> <span class="field"><textarea name="seo_h6" id="seo_h6" style="height: 100px" class="input-xxlarge" placeholder="SEO h6"><?=$item['seo_h6']?></textarea></span></p>
						<p><label>SEO Title:</label><span class="field"><input type="text" name="title" value="<?=@$item['title']?>" class="input-xxlarge" placeholder="SEO Title" /></span></p>
						<p><label>SEO Keywords:</label><span class="field"><textarea name="keywords" id="keywords" rows="5" class="input-xxlarge" placeholder="SEO Keywords"><?=@$item['keywords']?></textarea></span></p>
						<p><label>SEO Description:</label><span class="field"><textarea name="description" id="description" rows="5" class="input-xxlarge" placeholder="SEO Description"><?=@$item['description']?></textarea></span></p>
						<p><label>Google analytics:</label><span class="field"><textarea name="analytics" id="analytics" rows="5" class="input-xxlarge" placeholder="Google analytics"><?=unzip_chuanhoa(@$item['analytics'])?></textarea></span></p>
						<p><label>Google Webmaster Tool:</label><span class="field"><textarea name="mastertool" id="mastertool" rows="5" class="input-xxlarge" placeholder="Google Webmaster Tool"><?=unzip_chuanhoa(@$item['mastertool'])?></textarea></span></p>
						<p><label>Head JS:</label><span class="field"><textarea name="headjs" id="headjs" rows="5" class="input-xxlarge" placeholder="Head JS"><?=unzip_chuanhoa(@$item['headjs'])?></textarea></span></p>
						<p><label>Body JS:</label><span class="field"><textarea name="bodyjs" id="bodyjs" rows="5" class="input-xxlarge" placeholder="Body JS"><?=unzip_chuanhoa(@$item['bodyjs'])?></textarea></span></p>
						
						<?php if($config['setting']['vchat']=='true') { ?>
							<p><label>Vchat:</label><span class="field"><textarea name="vchat" id="vchat" rows="5" class="input-xxlarge" placeholder="Vchat"><?=unzip_chuanhoa(@$item['vchat'])?></textarea></span></p>
						<?php } ?>
						
						<?php if($config['setting']['diachi']=='true') { ?>
							<p><label>Địa chỉ:</label><span class="field"><input type="text" name="diachi" value="<?=@$item['diachi']?>" class="input-xxlarge" placeholder="Địa chỉ"/></span></p>
						<?php } ?>

						<?php if($config['setting']['dienthoai']=='true') { ?>
							<p><label>Điện thoại:</label><span class="field"><input type="text" name="dienthoai" value="<?=@$item['dienthoai']?>" class="input-xxlarge" placeholder="Điện thoại"/></span></p>
						<?php } ?>

						<?php if($config['setting']['fax']=='true') { ?>
							<p><label>Fax:</label><span class="field"><input type="text" name="fax" value="<?=@$item['fax']?>" class="input-xxlarge" placeholder="Fax"/></span></p>
						<?php } ?>

						<?php if($config['setting']['slogan']=='true') { ?>
							<p><label>Slogan:</label><span class="field"><input type="text" name="slogan" value="<?=@$item['slogan']?>" class="input-xxlarge" placeholder="Slogan"/></span></p>
						<?php } ?>

						<?php if($config['setting']['hotline']=='true') { ?>
							<p><label>Hotline:</label><span class="field"><input type="text" name="hotline" value="<?=@$item['hotline']?>" class="input-xxlarge" placeholder="Hotline"/></span></p>
						<?php } ?>

						<?php if($config['setting']['zalo']=='true') { ?>
							<p><label>Zalo:</label><span class="field"><input type="text" name="zalo" value="<?=@$item['zalo']?>" class="input-xxlarge" placeholder="Zalo"/></span></p>
						<?php } ?>

						<?php if($config['setting']['oaidzalo']=='true') { ?>
							<p><label>OAID Zalo:</label><span class="field"><input type="text" name="oaidzalo" value="<?=@$item['oaidzalo']?>" class="input-xxlarge" placeholder="OAID Zalo"/></span></p>
						<?php } ?>

						<?php if($config['setting']['viber']=='true') { ?>
							<p><label>Viber:</label><span class="field"><input type="text" name="viber" value="<?=@$item['viber']?>" class="input-xxlarge" placeholder="Viber"/></span></p>
						<?php } ?>

						<?php if($config['setting']['skype']=='true') { ?>
							<p><label>Skype:</label><span class="field"><input type="text" name="skype" value="<?=@$item['skype']?>" class="input-xxlarge" placeholder="Skype"/></span></p>
						<?php } ?>

						<?php if($config['setting']['facebook']=='true') { ?>
							<p><label>Facebook:</label><span class="field"><input type="text" name="facebook" value="<?=@$item['facebook']?>" class="input-xxlarge" placeholder="Facebook"/></span></p>
						<?php } ?>

						<?php if($config['setting']['youtube']=='true') { ?>
							<p><label>Youtube:</label><span class="field"><input type="text" name="youtube" value="<?=@$item['youtube']?>" class="input-xxlarge" placeholder="Youtube"/></span></p>
						<?php } ?>

						<?php if($config['setting']['twitter']=='true') { ?>
							<p><label>Twitter:</label><span class="field"><input type="text" name="twitter" value="<?=@$item['twitter']?>" class="input-xxlarge" placeholder="Twitter"/></span></p>
						<?php } ?>

						<?php if($config['setting']['pinterest']=='true') { ?>
							<p><label>Pinterest:</label><span class="field"><input type="text" name="pinterest" value="<?=@$item['pinterest']?>" class="input-xxlarge" placeholder="Pinterest"/></span></p>
						<?php } ?>

						<?php if($config['setting']['email']=='true') { ?>
							<p><label>Email:</label><span class="field"><input type="email" name="email" value="<?=@$item['email']?>" class="input-xxlarge" placeholder="Email"/></span></p>
						<?php } ?>

						<?php if($config['setting']['website']=='true') { ?>
							<p><label>Website:</label><span class="field"><input type="text" name="website" value="<?=@$item['website']?>" class="input-xxlarge" placeholder="Website"/></span></p>
						<?php } ?>

						<?php if($config['setting']['fb_facebook']=='true') { ?>
							<p><label>Fanpage facebook:</label><span class="field"><input type="text" name="fanpage" value="<?=@$item['fanpage']?>" class="input-xxlarge" placeholder="Fanpage facebook"/></span></p>
						<?php } ?>

						<?php if($config['setting']['fb_google']=='true') { ?>
							<p><label>Fanpage google:</label><span class="field"><input type="text" name="fanpage_google" value="<?=@$item['fanpage_google']?>" class="input-xxlarge" placeholder="Fanpage google"/></span></p>
						<?php } ?>

						<?php if($config['setting']['map']=='true') { ?>
							<p><label>Google Map:</label><span class="field"><input type="text" name="toado" value="<?=@$item['toado']?>" class="input-large" placeholder="Tọa độ Google Map"/></span></p>
						<?php } ?>

						<?php if($config['setting']['map_iframe']=='true') { ?>
							<p>
								<label>Google Map (Iframe):</label>
								<span class="field">
									<textarea name="toado_iframe" id="toado_iframe" rows="5" class="input-xxlarge" placeholder="Tọa độ Google Map nhúng bằng Iframe"><?=unzip_chuanhoa(@$item['toado_iframe'])?></textarea>
									<strong><a href="https://www.google.com/maps" target="_blank" title="Lấy mã nhúng Google Map"> ( Lấy mã nhúng )</a></strong>
								</span>
							</p>
						<?php } ?>

						<?php if($config['setting']['copyright']=='true') { ?>
							<p><label>Copyright:</label><span class="field"><input type="text" name="copyright" value="<?=@$item['copyright']?>" class="input-xxlarge" placeholder="Copyright"/></span></p>
						<?php } ?>
						
						<!-- Begin Tab -->
                        <div id="tabs">
                            <ul>
                                <?php foreach($config['lang'] as $key => $value) { ?>
                                    <li><a href="#tabs-<?=$key?>"><?=$value?></a></li>
                                <?php } ?>
                            </ul>
                            <div class="clear"></div>
                            <?php foreach($config['lang'] as $key => $value) { ?>
                                <div id="tabs-<?=$key?>">
                                    <p><label>Tên (<?=$key?>):</label><span class="field"><input type="text" name="ten<?=$key?>" value="<?=@$item['ten'.$key]?>" class="input-xxlarge" placeholder="Tên (<?=$key?>)"/></span></p>
                                    <?php if($config['setting']['mota']=='true') { ?>
                                        <p><label>Mô tả (<?=$key?>):</label></p></br></br>
                                        <p><textarea name="mota<?=$key?>" id="mota<?=$key?>" rows="5" cols="80" style="width: 100%; box-sizing: border-box;" class="tinymce"><?=@$item['mota'.$key]?></textarea></p>
                                        <?php if($config['setting']['mota_cke']=='true') { ?>
                                            <script type="text/javascript">
                                                var mota<?=$key?> = CKEDITOR.replace('mota<?=$key?>');
                                            </script>
                                        <?php } ?>
                                    <?php } ?>
                                    <?php if($config['setting']['noidung']=='true') { ?>
                                        <p><label>Nội dung (<?=$key?>):</label></p></br></br>
                                        <p><textarea name="noidung<?=$key?>" id="noidung<?=$key?>" rows="5" cols="80" style="width: 100%; box-sizing: border-box;" class="tinymce"><?=@$item['noidung'.$key]?></textarea></p>
                                        <?php if($config['setting']['noidung_cke']=='true') { ?>
                                            <script type="text/javascript">
                                                var noidung<?=$key?> = CKEDITOR.replace('noidung<?=$key?>');
                                            </script>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                        <!-- End Tab -->

                        <?php if($config['setting']['seo']=='true') { ?>
                        <!-- Thông Tin SEO -->
                        <p><label>SEO H1:</label> <span class="field"><textarea name="seo_h1" id="seo_h1" style="height: 100px" class="input-xxlarge" placeholder="SEO H1"><?=$item['seo_h1']?></textarea></span></p>
                        <p><label>SEO H2:</label> <span class="field"><textarea name="seo_h2" id="seo_h2" style="height: 100px" class="input-xxlarge" placeholder="SEO h2"><?=$item['seo_h2']?></textarea></span></p>
                        <p><label>SEO H3:</label> <span class="field"><textarea name="seo_h3" id="seo_h3" style="height: 100px" class="input-xxlarge" placeholder="SEO h3"><?=$item['seo_h3']?></textarea></span></p>
                        <p><label>SEO Title:</label> <span class="field"><textarea name="title" id="title" style="height: 100px" class="input-xxlarge" placeholder="SEO Title"><?=$item['title']?></textarea></span></p>
                        <p><label>SEO Keywords:</label> <span class="field"><textarea name="keywords" id="keywords" style="height: 100px" class="input-xxlarge" placeholder="SEO Keywords"><?=$item['keywords']?></textarea></span></p>
                        <p><label>SEO Description:</label><span class="field"> <textarea name="description" id="description" style="height: 100px" class="input-xxlarge" placeholder="SEO Description"><?=$item['description']?></textarea></span></p>
                        <!-- Thông Tin SEO -->
                        <?php } ?>

						<p class="stdformbutton">
							<input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
							<button type="submit" class="btn btn-primary"><span class="iconfa-save"></span> Lưu</button>
							<button type="reset" class="btn"><span class="iconfa-refresh"></span> Làm lại</button>
						</p>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>