<?php
	$com = (isset($_REQUEST['com'])) ? addslashes($_REQUEST['com']) : "";
	$type = (isset($_REQUEST['type'])) ? addslashes($_REQUEST['type']) : "";
	$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";

	if($_REQUEST['author'])
	{ 
	  	header('Content-Type: text/html; charset=utf-8');
	  	echo '<pre>';
	  	print_r($config['author']);
	  	echo '</pre>';
	  	die();
	}

	switch($com)
	{
		case 'lien-he':
			$source = "contact";
			$template = "contact";
			$title_tcat = _lienhe;
			break;

		case 'tin-tuc':
			$source = "tintuc";
			$template = isset($_GET['id']) ? "tintuc_detail" : "";
			$type=$com;
			break;

		case 'dich-vu':
			$source = "tintuc";
			$template = isset($_GET['id']) ? "tintuc_detail" : "tintuc";
			$title_tcat=_dichvu;
			$type=$com;
			break;

		case 'chinh-sach-mua':
			$source = "tintuc";
			$template = isset($_GET['id']) ? "tintuc_detail" : "tintuc";
			$title_tcat="Chính sách mua";
			$type=$com;
			break;

		case 'cong-trinh':
			$source = "tintuc";
			$template = isset($_GET['id']) ? "tintuc_detail" : "tintuc";
			$title_tcat="Công trình đã thi công";
			$type=$com;
			break;

		case 'san-pham':
			$source = "product";
			$template = isset($_GET['id']) ? "product_detail" : "product";
			$title_tcat=_sanpham;
			$type=$com;
			break;

		case 'tim-kiem':
			$source = "search";
			$template = "product";
			$title_tcat=_ketquatimkiem;
			break;

		case 'tags-san-pham':
			$source = "tags";
			$template = "product";
			$type='san-pham';
			$table='product';
			break;

		// case 'download':
		// 	$source = "download";
		// 	$template = "download";
		// 	$title_tcat="Download";
		// 	$type='taptin';
		// 	break;
		
		// case 'video':
		// 	$source = "video";
		// 	$template = "video";
		// 	$title_tcat='Video';
		// 	$type=$com;
		// 	break;

		// case 'thu-vien-anh':
		// 	$source = "album";
		// 	$template = isset($_GET['id']) ? "thuvienanh_detail" : "thuvienanh";
		// 	$title_tcat=_thuvienanh;
		// 	$type=$com;
		// 	break;

		case 'gio-hang':
			$source = "giohang";
			$template='giohang';
			break;

		// case 'account':
		// 	$source = "user";
		// 	break;

		// case 'ngonngu':
		// 	if(isset($_GET['lang']))
		// 	{
		// 		switch($_GET['lang'])
		// 		{
		// 			case 'vi':
		// 				$_SESSION['lang'] = 'vi';
		// 				break;
		// 			case 'cn':
		// 				$_SESSION['lang'] = 'cn';
		// 				break;
		// 			case 'en':
		// 				$_SESSION['lang'] = 'en';
		// 				break;
		// 			case 'jp':
		// 				$_SESSION['lang'] = 'jp';
		// 				break;
		// 			case 'ko':
		// 				$_SESSION['lang'] = 'ko';
		// 				break;
		// 			case 'fr':
		// 				$_SESSION['lang'] = 'fr';
		// 				break;
		// 			default: 
		// 				$_SESSION['lang'] = 'vi';
		// 				break;
		// 		}
		// 	}
		// 	redirect($_SERVER['HTTP_REFERER']);
		// 	break;
			
		case '':
		case 'index':
			$source = "index";
			$template ="index";
			break;

		default: 
			redirect($config_url_http."404.php");
			break;
	}

	if($template=="") redirect($config_url_http."404.php");
	if($source!="") include _source.$source.".php";
?>