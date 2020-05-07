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

	$id=sanitize($_GET['id']);
	$pic = get_fetch_array("SELECT photo FROM table_product WHERE hienthi>0 AND id=$id AND type='san-pham'");	
?>
<style type="text/css">
	.popup{border:1px solid #00A503;background:#fff;}
</style>
<div class="popup"><img src="<?=_upload_product_l.$pic['photo']?>"/></div>