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
	$const = sanitize($_POST['const']);
	
	$d->reset();
	$sql = "select photo,thumb from #_$tbl where id='".$id."'";
	$d->query($sql);
	$row=$d->fetch_array();

	$path="../../upload/".$const."/".$row['photo'];
	$path_thumb="../../upload/".$const."/".$row['thumb'];

	delete_file($path);
	delete_file($path_thumb);
	
	$d->reset();
	$sql = "delete from #_$tbl where id='".$id."'";
	$d->query($sql);
?>