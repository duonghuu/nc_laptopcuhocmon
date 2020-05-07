<?php  
	if(!defined('_source')) die("Error");

	$title_bar=$title_tcat.' - ';

	$d->reset();
	$sql="select photo,link_video,tenvi from #_photo where hienthi=1 and type='".$type."' order by stt,id desc";	
	$d->query($sql);
	$video=$d->result_array();

	$curPage = isset($_GET['p']) ? $_GET['p'] : 1;
	$url=getCurrentPageURL();	
	$maxR=20;
	$maxP=5;
	$paging=paging_home($video, $url, $curPage, $maxR, $maxP);
	$video=$paging['source'];

	/* Crumbtrail */
	$crumbtrail="<li><a class='crumbtrail_lst' title='".$title_tcat."'>".$title_tcat."</a></li>";
?>