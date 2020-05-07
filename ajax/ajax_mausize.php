<?php
	session_start();
    error_reporting(0);
  
	@define ( '_lib' , '../admin/lib/');
	@define ( '_source' , '../sources/');

    include_once _lib."config.php";
    include_once _lib."constant.php";
    include_once _lib."functions.php";
    include_once _lib."functions_giohang.php";
    include_once _lib."class.database.php";
    $d = new database($config['database']);

    $idmausize=sanitize($_POST['idmausize']);
    $pid=sanitize($_POST['pid']);
    $mauold=sanitize($_POST['mauold']);
    $sizeold=sanitize($_POST['sizeold']);
    $kind=sanitize($_POST['kind']);

    if($kind=='mau')
    {
    	update_product($pid,$idmausize,$sizeold,$mauold,$sizeold);
    }
    else if($kind=='size')
    {
    	update_product($pid,$mauold,$idmausize,$mauold,$sizeold);
    }
?>