<?php
	session_start();
	
	@define ( '_template' , '../templates/');
	@define ( '_source' , '../sources/');
	@define ( '_lib' , '../lib/');
	include_once _lib."config.php";
	include_once _lib."functions.php";
	include_once _lib."constant.php";
	include_once _lib."library.php";
	include_once _lib."class.database.php";
	$d = new database($config['database']);	

	if(check_login()==false){die();}

	$id = sanitize($_POST['id']);
	$tbl = sanitize($_POST['tbl']);
	
	$d->reset();
	$sql = "delete from #_$tbl where id='".$id."'";
	$d->query($sql);
?>