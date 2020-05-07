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
	include_once _lib."functions_giohang.php";
	include_once _lib."class.database.php";
	$d = new database($config['database']);
	require_once _source."lang.php";

	$pid = sanitize($_POST['pid']);
	$mau = sanitize($_POST['mau']);
	$size = sanitize($_POST['size']);
	remove_product($pid,$mau,$size);
	$max=count($_SESSION['cart']);
	$tonggia=number_format(get_order_total(),0, ',', '.')."đ";

	$data = array('tonggia' => $tonggia, 'max' => $max);
	echo json_encode($data);
?>