<div class="title-main"><span><?=$tintuc_tinh_detail['ten'.$lang]?></span></div>
<div class="content-main w-clear"><?=check_ssl_content($tintuc_tinh_detail['noidung'.$lang])?></div>
<div class="share">
	<b><?=_chiase?>:</b>
	<div class="social-plugin w-clear">
        <div class="addthis_inline_share_toolbox_qj48"></div>
        <div class="zalo-share-button" data-href="<?=getCurrentPageURL()?>" data-oaid="<?=($row_setting['oaidzalo']!='')?$row_setting['oaidzalo']:'579745863508352884'?>" data-layout="3" data-color="blue" data-customize=false></div>
    </div>
</div>