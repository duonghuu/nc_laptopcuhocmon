<div class="title-main"><span><?=$title_tcat?></span></div>
<div class="tva-detail w-clear">
    <?php for($i=0;$i<count($hinhanhalbum);$i++) { ?><a rel="prettyPhoto[tva]" href="<?=_upload_photo_l.$hinhanhalbum[$i]['photo']?>" title="<?=$row_detail['ten'.$lang]?>"><img src="<?=_upload_photo_l?>250x250x1/<?=$hinhanhalbum[$i]['photo']?>" alt="<?=$row_detail['ten'.$lang]?>"></a><?php } ?>
</div>