<?php  
	if(!defined('_source')) die("Error");
		
	@$id=addslashes($_GET['id']);
	
	if($id!='')
	{
		$d->reset();
		$sql = "select * from #_tags_list where tenkhongdau='".$id."' and type='".$type."'";
		$d->query($sql);
		$name_tag = $d->fetch_array();

		if($name_tag['id']=='')
		{
			redirect($config_url_http."404.php");	
		}
		
		$d->reset();
		$sql = "select * from #_".$table." where id IN (select id_pro from #_tags_group where id_tags='".$name_tag['id']."') and type='".$type."' order by stt asc,ngaytao desc";
		$d->query($sql);
		$product = $d->result_array();

		$title_bar='Tags: '.$name_tag['ten'.$lang].' - ';	
		$title_tcat='Tags: '.$name_tag['ten'.$lang];

		$seo_h1=$name_tag['seo_h1'];
		$seo_h2=$name_tag['seo_h2'];
		$seo_h3=$name_tag['seo_h3'];
		$title_custom=$name_tag['title'];
		$keywords_custom=$name_tag['keywords'];
		$description_custom=$name_tag['description'];
	
		$curPage = isset($_GET['p']) ? $_GET['p'] : 1;
		$url=getCurrentPageURL();
		$maxR=20;
		$maxP=5;
		$paging=paging_home($product, $url, $curPage, $maxR, $maxP);
		$product=$paging['source'];

		/* Crumbtrail */
		$crumbtrail="<li><a class='crumbtrail_lst' title='".$title_tcat."'>".$title_tcat."</a></li>";
	}
?>