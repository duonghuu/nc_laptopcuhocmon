<div class="title-main"><span>Chi tiết bài viết</span></div>
<div class="content-main w-clear"><?=check_ssl_content($tintuc_detail['noidung'.$lang])?></div>
<div class="share">
	<b><?=_chiase?>:</b>
	<div class="social-plugin w-clear">
        <div class="addthis_inline_share_toolbox_qj48"></div>
        <div class="zalo-share-button" data-href="<?=getCurrentPageURL()?>" data-oaid="<?=($row_setting['oaidzalo']!='')?$row_setting['oaidzalo']:'579745863508352884'?>" data-layout="3" data-color="blue" data-customize=false></div>
    </div>
</div>
<div class="share othernews">
    <b><?=_baivietkhac?>:</b>
    <ul class="list-news-other">
        <?php for($i=0;$i<count($tintuc);$i++) { ?>
            <li><a href="<?=$com?>/<?=$tintuc[$i]['tenkhongdau']?>-<?=$tintuc[$i]['id']?>.html" title="<?=$tintuc[$i]['ten'.$lang]?>">
                <?=$tintuc[$i]['ten'.$lang]?> - <?=date("d/m/Y",$tintuc[$i]['ngaytao'])?>
            </a></li>
        <?php } ?>
    </ul>
</div>