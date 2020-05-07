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

	$id_comment = sanitize($_POST['id_comment']);
	$ip = getRealIPAddress();
	$comment_tool = get_fetch_array("SELECT * FROM table_comment_tool WHERE id_comment=$id_comment AND ip=$ip");
	$thich = get_fetch_array("SELECT thich FROM table_comment WHERE id=$id_comment");

	if($comment_tool['id']>0)
	{
		$thich = $thich['thich'] - 1;

		/* Xóa đi lượt thích của IP thuộc vào comment hiện tại */
		$d->reset();
		$sql = "delete from #_comment_tool where id_comment='".$id_comment."' and ip='".$ip."'";
		$d->query($sql);
	}
	else
	{
		$thich = $thich['thich'] + 1;

		/* Thêm IP thuộc vào comment hiện tại */
		$d->reset();
		$data_ipthuoccommenthientai['id_comment'] = $id_comment;
		$data_ipthuoccommenthientai['ip'] = $ip;
		$d->setTable('comment_tool');
		$d->insert($data_ipthuoccommenthientai);
	}

	/* Cập nhật số lượng thích */
	$d->reset();
	$data_soluongthich['thich'] = $thich;
	$d->setTable('comment');
	$d->setWhere('id',$id_comment);
	$d->update($data_soluongthich);

	$data = array('thich' => $thich);
	echo json_encode($data);
?>