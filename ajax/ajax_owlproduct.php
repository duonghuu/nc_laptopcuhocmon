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
	
	$tab = sanitize($_POST['tab']);
	$product = get_result_array("SELECT ten$lang, mota$lang, tenkhongdau, gia, giagiam, photo, id FROM table_product WHERE hienthi=1 AND type='san-pham' AND $tab>0 ORDER BY stt,id DESC");
?>
<div class="owl-carousel owl-theme owl-product-type">
	<?php for($i=0;$i<count($product);$i++) { ?>
		<div>
			<a class="sp" href="dich-vu/<?=$product[$i]['tenkhongdau']?>-<?=$product[$i]['id']?>.html" title="<?=$product[$i]['ten'.$lang]?>">
				<div class="info-sp">
					<div class="pic-sp scale-img">
						<img src="270x205x2/100/100/0/0/product/<?=_upload_product_l.$product[$i]['photo']?>" alt="<?=$product[$i]['ten'.$lang]?>"/>
						<div class="desc-sp scroll-maded transition"><?=str_replace("\n","<br>",$product[$i]['mota'.$lang])?></div>
					</div>
					<h3 class="name-sp transition"><?=$product[$i]['ten'.$lang]?></h3>
				</div>
				<div class="price-sp">
					<?php if($product[$i]['giagiam']) { ?>
						<p class="price-old-sp"><?=number_format($product[$i]['gia'],0, ',', '.')?><b>đ</b></p>
						<p class="price-new-sp"><?=number_format($product[$i]['giagiam'],0, ',', '.')?><b>đ</b></p>
					<?php } else { ?>
						<p class="price-new-sp"><?=($product[$i]['gia'])?number_format($product[$i]['gia'],0, ',', '.')."<b>đ</b>":_lienhe?></p>
					<?php } ?>
				</div>
			</a>
		</div>
	<?php } ?>
</div>