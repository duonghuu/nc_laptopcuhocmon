<?php  
	if(!defined('_source')) die("Error");

	$title_bar=$title_tcat." - ";

	$d->reset();
	$sql = "select * from #_download where hienthi=1 and type='".$type."' order by stt,ngaytao desc";
	$d->query($sql);
	$download = $d->result_array();

	$curPage = isset($_GET['p']) ? $_GET['p'] : 1;
	$url=getCurrentPageURL();
	$maxR=12;
	$maxP=5;
	$paging=paging_home($download, $url, $curPage, $maxR, $maxP);
	$download=$paging['source'];

	/* Crumbtrail */
	$crumbtrail="<li><a class='crumbtrail_lst' title='".$title_tcat."'>".$title_tcat."</a></li>";
?>