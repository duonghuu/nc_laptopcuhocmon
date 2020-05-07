<?php  
	session_start();
	error_reporting(0);

	@define ( '_lib' , '../admin/lib/');
	@define ( '_source' , '../sources/');

	include_once _lib."config.php";
	include_once _lib."constant.php";
	include_once _lib."functions.php";
	include_once _lib."class.database.php";
	include_once _lib."functions_giohang.php";
	$d = new database($config['database']);

	$id=sanitize($_POST['id']);
	$gia_qh = get_fetch_array("SELECT gia FROM table_phuongxa WHERE id=$id");	
	$giaship_goc=$gia_qh['gia'];
	$tonggia_goc=get_order_total()+$gia_qh['gia'];
	$giaship = number_format($gia_qh['gia'],0, ',', '.');
	$tonggia = number_format(get_order_total()+$gia_qh['gia'],0, ',', '.');
	
	if(isset($_SESSION['coupon']['total']))
	{
		$tonggia_coupon_goc=$_SESSION['coupon']['total']+$gia_qh['gia'];
		$tonggia_coupon = number_format($_SESSION['coupon']['total']+$gia_qh['gia'],0, ',', '.');
	}
	else
	{
		$tonggia_coupon_goc=0;
		$tonggia_coupon=0;
	}

	$data = array('giaship' => $giaship, 'tonggia' => $tonggia, 'giaship_goc' => $giaship_goc, 'tonggia_goc' => $tonggia_goc, 'tonggia_coupon' => $tonggia_coupon, 'tonggia_coupon_goc' => $tonggia_coupon_goc);
	echo json_encode($data);
?>