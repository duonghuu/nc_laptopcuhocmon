<div class="title-main"><span><?=$title_tcat?></span></div>
<div class="content-main w-clear">
	<div class="top-contact">
		<div class="article-contact"><?=$row_lienhe['noidung'.$lang]?></div>
		<form class="form-contact" method="post" action="" enctype="multipart/form-data">					
			<input type="text" name="ten" placeholder="<?=_hoten?>" required />
			<input type="number" name="dienthoai" placeholder="<?=_sodienthoai?>" required />
			<input type="text" name="diachi" placeholder="<?=_diachi?>" required />
			<input type="email" name="email" placeholder="Email" required />
			<input type="text" name="tieude" placeholder="<?=_chude?>" required />
			<textarea name="noidung" placeholder="<?=_noidung?>"></textarea>
			<div class="button-contact">
				<div class="file-contact">
					<span class="open-file-contact transition"><b class="text-hide"><?=_dinhkemtaptin?></b></span>
					<input type="file" name="file" id="input-file-contact"/></div>
				<div class="post-contact">
					<input type="submit" class="transition" value="<?=_gui?>"/>
					<input type="reset" class="transition" value="<?=_nhaplai?>"/>
					<input type="hidden" name="recaptcha_response_contact" id="recaptchaResponseContact">
				</div>
			</div>
		</form>
	</div>
	<div class="bottom-contact"><?=$row_setting['toado_iframe']?></div>
</div>