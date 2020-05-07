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

    $cmd = sanitize($_POST['cmd']);
    $id = sanitize($_POST['id']);
    $mau = sanitize($_POST['mau']);
	$size = sanitize($_POST['size']);
	$q = sanitize($_POST['qty']);
	$q = ($q>1)?$q:1;

	if(isset($cmd))
	{
		if($cmd=='addcart' && isset($id))
		{
			addtocart($id,$q,$mau,$size);

			if(isset($_SESSION['coupon']['total']))
			{
				$_SESSION['coupon']['total']=get_total_price_coupon(get_order_total());
			}
			
			$count_cart = count($_SESSION['cart']);
			$data = array('count_cart' => $count_cart);
			echo json_encode($data);
		}
	}
?>