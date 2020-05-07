<div class="title-main">
    <span><?=$title_tcat?></span>
</div>
<div class="content-main w-clear">
	<?php if(count($album)>0) { ?>
	    <div id="tva" style="display:none;">
	        <?php for($i=0;$i<count($album);$i++) { ?>
	            <a href="thu-vien-anh/<?=$album[$i]["tenkhongdau"]?>-<?=$album[$i]["id"]?>.html" title="<?=$album[$i]["ten".$lang]?>">
	                <img alt="<?=$album[$i]["ten".$lang]?>" src="<?=_upload_photo_l.$album[$i]["photo"]?>" data-image="<?=_upload_photo_l.$album[$i]["photo"]?>" data-description="<?=$album[$i]["ten".$lang]?>" style="display:none">
	            </a>
	        <?php } ?>
	    </div>
	<?php } ?>
</div>