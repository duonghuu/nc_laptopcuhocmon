<?php  
	if(!defined('_source')) die("Error");

	/* Crumbtrail */
	$crumbtrail="<li><a class='crumbtrail_lst' title='".$title_tcat."'>".$title_tcat."</a></li>";	

	$d->reset();
	$sql_detail = "select * from #_news_static where type='".$type."'";
	$d->query($sql_detail);
	$tintuc_tinh_detail = $d->fetch_array();

	$d->reset();
	$sql="select * from #_news_static_hinhanh where hienthi=1 and type='".$type."' order by stt,ngaytao desc";
	$d->query($sql);
	$hinhanhttt = $d->result_array();

	$title_bar=$tintuc_tinh_detail['ten'.$lang].' - ';
	$title_tcat=$tintuc_tinh_detail['ten'.$lang];
	$seo_h1=$tintuc_tinh_detail['seo_h1'];
	$seo_h2=$tintuc_tinh_detail['seo_h2'];
	$seo_h3=$tintuc_tinh_detail['seo_h3'];
	$title_custom=$tintuc_tinh_detail['title'];
	$keywords_custom=$tintuc_tinh_detail['keywords'];
	$description_custom=$tintuc_tinh_detail['description'];

	/* Share */
	$ten_share = $tintuc_tinh_detail['ten'.$lang];
	$img_share = $config_url_http._upload_news_l."525x275x2/".$tintuc_tinh_detail['photo'];
	$title_share = $tintuc_tinh_detail['title'];
	$description_share = $tintuc_tinh_detail['description'];
	$url_share = curPageURL();
?>