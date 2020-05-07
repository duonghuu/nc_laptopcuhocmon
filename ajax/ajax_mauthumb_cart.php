<?php
	session_start();
	error_reporting(0);

	@define ( '_lib' , '../admin/lib/');
	@define ( '_source' , '../sources/');
	
	if(!isset($_SESSION['lang'])) $_SESSION['lang']='vi';
    $lang=$_SESSION['lang'];

	include_once _lib."config.php";
	include_once _lib."constant.php";
	include_once _lib."functions.php";
	include_once _lib."class.database.php";
	$d = new database($config['database']);
	require_once _source."lang.php";
	
	$id_mau = sanitize($_POST['id_mau']);
	$idpro = sanitize($_POST['idpro']);
	$hinhanhsp = get_result_array("SELECT photo, id_photo, id FROM table_product_hinhanh WHERE id_mau=$id_mau AND id_photo=$idpro AND type='san-pham' AND val='san-pham'");
	$row_detail = get_fetch_array("SELECT ten$lang FROM table_product WHERE id=$idpro AND type='san-pham'");
?>

<?php if(count($hinhanhsp)>0) { ?>
	<a id="Zoom-1" class="MagicZoom" href="400x350x1/100/100/10/10/detail/<?=_upload_product_l.$hinhanhsp[0]['photo']?>" title="<?=$row_detail['ten'.$lang]?>"><img src="400x350x1/100/100/10/10/detail/<?=_upload_product_l.$hinhanhsp[0]['photo']?>" alt="<?=$row_detail['ten'.$lang]?>"></a>
    <div class="selectors slick-thumb-pro">
        <div><a class="thumb-pro-detail" data-zoom-id="Zoom-1" href="400x350x1/100/100/10/10/detail/<?=_upload_product_l.$hinhanhsp[0]['photo']?>" title="<?=$row_detail['ten'.$lang]?>"><img src="400x350x1/100/100/10/10/detail/<?=_upload_product_l.$hinhanhsp[0]['photo']?>" alt="<?=$row_detail['ten'.$lang]?>"></a></div>
        <?php for($i=1;$i<count($hinhanhsp);$i++) { ?>
            <div><a class="thumb-pro-detail" data-zoom-id="Zoom-1" href="400x350x1/100/100/10/10/detail/<?=_upload_product_l.$hinhanhsp[$i]['photo']?>" title="<?=$row_detail['ten'.$lang]?>"><img src="400x350x1/100/100/10/10/detail/<?=_upload_product_l.$hinhanhsp[$i]['photo']?>" alt="<?=$row_detail['ten'.$lang]?>"></a></div>
        <?php } ?>
    </div>
	
	<!-- Begin JS MagicZoom -->
	<script src="assets/magiczoomplus/magiczoomplus.js" type="text/javascript"></script>
	<!-- End JS MagicZoom -->

	<script type="text/javascript">
	    $(document).ready(function() 
	    {
	        /* Thumb Pro */
            $(".slick-thumb-pro").slick({
                dots: false,
                autoplay: false,
                infinite: true,
                slidesToShow: 4,
                slidesToScroll: 1,
                responsive:
                [
                    {
                        breakpoint: 968,
                        settings:
                        {
                            slidesToShow: 4
                        }
                    }
                ]
            });
	    });
	</script>
<?php } else { ?>
	<img onerror="src='assets/images/noimage.png'" alt="<?=_khongtimthayketqua?>" src=""/>
<?php } ?>