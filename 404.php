<?php
    session_start();
    @define ( '_lib' , './admin/lib/');
    @define ( '_source' , './sources/');

    include_once _lib."AntiSQLInjection.php";
    include_once _lib."config.php";
    include_once _lib."class.database.php";
    $d = new database($config['database']);

    // Setting
    $d->reset();
    $sql = "select * from table_setting";
    $d->query($sql);
    $row_setting = $d->fetch_array();

    if($_REQUEST['lang']!='') $_SESSION['lang']=$_REQUEST['lang'];
    else if(!isset($_SESSION['lang']) && !isset($_REQUEST['lang'])) $_SESSION['lang']=$row_setting['lang_default'];
    $lang=$_SESSION['lang'];
    require_once _source."lang.php";
?>
<!DOCTYPE html>
<html lang="vi">
<head>
	<meta charset="UTF-8" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8" />
	<title>ERROR 404</title>
	<meta name="keywords" content="404 ERROR">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="assets/404_files/style.css" rel="stylesheet" type="text/css" media="all">
</head>
<body>
	<div class="wrap">
		<div class="content">
			<img src="assets/404_files//error-img.png" title="error 404">
			<p><span><label>O</label>hh.....</span><?=_trangbantruycapkhongtontai?></p>
			<a href="index.html"><?=_vetrangchu?></a>
		</div>
	</div>
</body>
</html>