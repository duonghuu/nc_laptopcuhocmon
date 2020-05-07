<?php
	session_start();
	error_reporting(0);
	@define ( '_template' , '../templates/');
	@define ( '_source' , '../sources/');
	@define ( '_lib' , '../lib/');
	include_once _lib."config.php";
	include_once _lib."constant.php";
	include_once _lib."functions.php";
	include_once _lib."library.php";
	include_once _lib."class.database.php";	
	$d = new database($config['database']);

	if(check_login()==false){die();}

	$table=sanitize($_POST['tbl']);
	$id=sanitize($_POST['id']);
	$loai=sanitize($_POST['loai']);

	$d->reset();
	$sql="select $loai from #_$table where id='$id'";
	$d->query($sql);
	$tmp=$d->fetch_array();

	if($tmp[$loai]>0)
	{
		$d->reset();
		$data_show[$loai] = 0;
		$d->setTable($table);
		$d->setWhere('id',$id);
		$d->update($data_show);
	}
	else
	{
		$d->reset();
		$data_show[$loai] = 1;
		$d->setTable($table);
		$d->setWhere('id',$id);
		$d->update($data_show);
	}
?>