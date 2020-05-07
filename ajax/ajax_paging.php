<?php
	session_start();
	error_reporting(0);
	$session=session_id();

	@define ( '_template' , '../templates/');
	@define ( '_source' , '../sources/');
	@define ( '_lib' , '../admin/lib/');
	
	if(!isset($_SESSION['lang']))
    {
       $_SESSION['lang']='vi';
    }

    $lang=$_SESSION['lang'];
	include_once _lib."config.php";
	include_once _lib."constant.php";
	include_once _lib."functions.php";
	include_once _lib."class.database.php";

	$d = new database($config['database']);

	require_once _source."lang.php";
	include_once "class_paging_ajax.php";

	$page = sanitize($_POST["page"]);
	$per_page = sanitize($_POST['per_page']);
	$idcat = sanitize($_POST['idcat']);
	
	if(isset($page))
    {
		$paging = new paging_ajax();
		$paging->class_pagination = "pagination-ajax";
		$paging->class_active = "active";
		$paging->class_inactive = "inactive";
		$paging->class_go_button = "go_button";
		$paging->class_text_total = "total";
		$paging->class_txt_goto = "txt_go_button";
		$paging->per_page = $per_page; 	
		$paging->page = $page;
		$paging->text_sql = "SELECT ten$lang, mota$lang, tenkhongdau, id, photo, gia, giagiam FROM table_product WHERE hienthi=1 AND id_cat=$idcat AND noibat>0 AND type='san-pham' ORDER BY stt,id DESC";
		$product = $paging->GetResult();
		$message = '';
		$paging->data = "".$message."";
    } 
?>
<?php for($i=0;$i<count($product);$i++) { ?>
	<a class="sp" href="san-pham/<?=$product[$i]['tenkhongdau']?>-<?=$product[$i]['id']?>.html" title="<?=$product[$i]['ten'.$lang]?>">
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
<?php } ?>
<div class="clear"></div>
<?=$paging->Load();?>