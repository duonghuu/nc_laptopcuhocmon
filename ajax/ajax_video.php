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
	
	$id = sanitize($_POST['id']);
	$video = get_fetch_array("SELECT link_video FROM table_photo WHERE id=$id");
?>
<iframe width="100%" height="300" src="//www.youtube.com/embed/<?=getYoutubeIdFromUrl($video['link_video'])?>" frameborder="0" allowfullscreen></iframe>