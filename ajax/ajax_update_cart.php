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
	$q = sanitize($_POST['q']);
	$mau = sanitize($_POST['mau']);
	$size = sanitize($_POST['size']);
	$pr_trans = sanitize($_POST['pr_trans']);
	$max=count($_SESSION['cart']);

	for($i=0;$i<$max;$i++)
	{
		if($pid==$_SESSION['cart'][$i]['productid'] && $mau==$_SESSION['cart'][$i]['mau'] && $size==$_SESSION['cart'][$i]['size'])
		{
			if($q) $_SESSION['cart'][$i]['qty'] = $q;
			break;
		}
	}
	
	$giaban = number_format(get_price($pid)*$q,0, ',', '.')."đ";
	$giakm = number_format(get_price_km($pid)*$q,0, ',', '.')."đ";
	$tonggia = number_format(get_order_total()+$pr_trans,0, ',', '.')."đ";

	if(isset($_SESSION['coupon']['total']))
	{
		$tonggia_coupon = number_format(get_total_price_coupon(get_order_total()+$pr_trans),0, ',', '.')."đ";
		$_SESSION['coupon']['total']=get_total_price_coupon(get_order_total()+$pr_trans);
	}
	else
	{
		$tonggia_coupon=0;
	}

	$data = array('giaban' => $giaban,'giakm' => $giakm, 'tonggia' => $tonggia, 'tonggia_coupon' => $tonggia_coupon);
	echo json_encode($data);
?>