<?php  
	if(!defined('_source')) die("Error");

	$title_bar=$title_tcat." - ";

	/* Crumbtrail */
	$crumbtrail="<li><a class='crumbtrail_lst' title='".$title_tcat."'>".$title_tcat."</a></li>";

	if(isset($_GET['keyword']) || isset($_GET['cate']))
	{
		$tukhoa =  $_GET['keyword'];
		$cate =  $_GET['cate'];
		$tukhoa = trim(strip_tags($tukhoa));
		if(get_magic_quotes_gpc()==false) $tukhoa = mysql_real_escape_string($tukhoa);

		if($cate != 0 && $tukhoa == '')
		{
			$sql2 = "select * from #_product where id_list = '".$cate."' and hienthi=1 and type='san-pham' order by stt,id desc";
			$d->query($sql2);
			$product = $d->result_array();
		}
		else if($cate != 0 && $tukhoa != '')
		{
			$sql2 = "select * from #_product where id_list = '".$cate."' and type='san-pham' and (ten$lang LIKE '%".$tukhoa."%' or tenkhongdau LIKE '%".$tukhoa."%') and hienthi=1 order by stt,id desc";
			$d->query($sql2);
			$product = $d->result_array();
		}
		else if($cate == 0 && $tukhoa != '')
		{
			$sql2 = "select * from #_product where type='san-pham' and (ten$lang LIKE '%".$tukhoa."%' or tenkhongdau LIKE '%".$tukhoa."%') and hienthi=1 order by stt,id desc";
			$d->query($sql2);
			$product = $d->result_array();
		}
		
		$curPage = isset($_GET['p']) ? $_GET['p'] : 1;
		$url=getCurrentPageURL();
		$maxR=20;
		$maxP=5;
		$paging=paging_home($product, $url, $curPage, $maxR, $maxP);
		$product=$paging['source'];
	}									
?>