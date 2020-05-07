<?php
    $d->reset();
    $sql = "SELECT photo, link, hienthi from table_photo where type='popup' and act='photo_static'";
    $d->query($sql);
    $popup = $d->fetch_array();
?>
<?php if($popup['hienthi']>0) { ?>
	<a class="popup-open" data-popup-open="pop-home" href="#"></a>
	<div class="popup" data-popup="pop-home">
	    <div class="wrap-pop-home">
	        <img src="<?=_upload_photo_l?>975x570x1/<?=$popup['photo']?>" alt="Popup">
	        <a class="popup-close" data-popup-close="pop-home">x</a>
	    </div>
	</div>
<?php } ?>