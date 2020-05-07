<?php  
	if(!defined('_source')) die("Error");

	@$id=addslashes($_GET['id']);
	@$idl=addslashes($_GET['idl']);
	@$idc=addslashes($_GET['idc']);
	@$idi=addslashes($_GET['idi']);

	if($id!='')
	{
		$d->reset();
		$sql_detail = "select * from #_news where hienthi=1 and id='".$id."' and type='".$type."'";
		$d->query($sql_detail);
		$tintuc_detail = $d->fetch_array();

		/* Cập nhật lượt xem */
		$d->reset();
		$data_luotxem['luotxem'] = $tintuc_detail['luotxem'] + 1;
		$d->setTable('news');
		$d->setWhere('id',$tintuc_detail['id']);
		$d->update($data_luotxem);

		if($tintuc_detail['id']=='')
		{
			redirect($config_url_http."404.php");	
		}

		/* Lấy ra cấp 1 */
		$d->reset();
		$sql = "select ten$lang, tenkhongdau, id from #_news_list where hienthi=1 and id='".$tintuc_detail['id_list']."' and type='".$type."'";
		$d->query($sql);
		$news_list = $d->fetch_array();

		/* Lấy ra cấp 2 */
		$d->reset();
		$sql = "select ten$lang, tenkhongdau, id from #_news_cat where hienthi=1 and id='".$tintuc_detail['id_cat']."' and type='".$type."'";
		$d->query($sql);
		$news_cat = $d->fetch_array();

		/* Lấy ra cấp 3 */
		$d->reset();
		$sql = "select ten$lang, tenkhongdau, id from #_news_item where hienthi=1 and id='".$tintuc_detail['id_item']."' and type='".$type."'";
		$d->query($sql);
		$news_item = $d->fetch_array();

		/* Crumbtrail */
		$crumbtrail.="<li><a href='".$com.".html' title='".$title_tcat."'>".$title_tcat."</a></li>";
		if($news_list['id']!='')
		{
			$crumbtrail.="<li class='crumbtrail_br'></li>";
			$crumbtrail.="<li><a href='".$com."/".$news_list['tenkhongdau']."-".$news_list['id']."/' title='".$news_list['ten'.$lang]."'>".$news_list['ten'.$lang]."</a></li>";
		}
		if($news_cat['id']!='')
		{
			$crumbtrail.="<li class='crumbtrail_br'></li>";
			$crumbtrail.="<li><a href='".$com."/".$news_list['tenkhongdau']."/".$news_cat['tenkhongdau']."-".$news_cat['id']."/' title='".$news_cat['ten'.$lang]."'>".$news_cat['ten'.$lang]."</a></li>";
		}
		if($news_item['id']!='')
		{
			$crumbtrail.="<li class='crumbtrail_br'></li>";
			$crumbtrail.="<li><a href='".$com."/".$news_list['tenkhongdau']."/".$news_cat['tenkhongdau']."/".$news_item['tenkhongdau']."-".$news_item['id']."/' title='".$news_item['ten'.$lang]."'>".$news_item['ten'.$lang]."</a></li>";
		}
		$crumbtrail.="<li class='crumbtrail_br'></li>";
		$crumbtrail.="<li><a class='crumbtrail_lst' title='".$tintuc_detail['ten'.$lang]."'>".$tintuc_detail['ten'.$lang]."</a></li>";

		$title_bar=$tintuc_detail['ten'.$lang].' - ';
		$title_tcat=$tintuc_detail['ten'.$lang];	
		$seo_h1=$tintuc_detail['seo_h1'];
		$seo_h2=$tintuc_detail['seo_h2'];
		$seo_h3=$tintuc_detail['seo_h3'];
		$title_custom=$tintuc_detail['title'];
		$keywords_custom=$tintuc_detail['keywords'];
		$description_custom=$tintuc_detail['description'];
		
		$sql="select photo from #_news_hinhanh where hienthi=1 and type='".$type."' and id_photo = '".$tintuc_detail['id']."' and kind='man' and val='".$type."' order by stt,ngaytao desc";
		$d->query($sql);
		$hinhanhtt = $d->result_array();

		$d->reset();					
		$sql = "select * from #_news where hienthi=1 and id <>'".$id."' and type='".$type."' order by stt,ngaytao desc";
		$d->query($sql);
		$tintuc = $d->result_array();

		/* Share */
		$ten_share = $tintuc_detail['ten'.$lang];
		$img_share = $config_url_http._upload_news_l."525x275x2/".$tintuc_detail['photo'];
		$title_share = $tintuc_detail['title'];
		$description_share = $tintuc_detail['description'];
		$url_share = curPageURL();
	}
	else if($idl!='')
	{	
		$d->reset();					
		$sql="select * from #_news_list where id='".$idl."' and type='".$type."'";
		$d->query($sql);
		$news_list=$d->fetch_array();

		if($news_list['id']=='')
		{
			redirect($config_url_http."404.php");	
		}

		/* Crumbtrail */
		$crumbtrail.="<li><a href='".$com.".html' title='".$title_tcat."'>".$title_tcat."</a></li>";
		$crumbtrail.="<li class='crumbtrail_br'></li>";
		$crumbtrail.="<li><a class='crumbtrail_lst' title='".$news_list['ten'.$lang]."'>".$news_list['ten'.$lang]."</a></li>";

		$title_bar=$news_list['ten'.$lang].' - ';	
		$title_tcat=$news_list['ten'.$lang];
		$seo_h1=$news_list['seo_h1'];
		$seo_h2=$news_list['seo_h2'];
		$seo_h3=$news_list['seo_h3'];
		$title_custom=$news_list['title'];
		$keywords_custom=$news_list['keywords'];
		$description_custom=$news_list['description'];

		$d->reset();
		$sql="select * from #_news where id_list='".$idl."' and type='".$type."' and hienthi=1 order by stt,id desc";
		$d->query($sql);
		$tintuc=$d->result_array();
		
		$curPage = isset($_GET['p']) ? $_GET['p'] : 1;
		$url=getCurrentPageURL();	
		$maxR=10;
		$maxP=5;
		$paging=paging_home($tintuc, $url, $curPage, $maxR, $maxP);
		$tintuc=$paging['source'];	
	}
	else if($idc!='')
	{	
		$d->reset();					
		$sql="select * from #_news_cat where id='".$idc."' and type='".$type."'";
		$d->query($sql);
		$news_cat=$d->fetch_array();

		if($news_cat['id']=='')
		{
			redirect($config_url_http."404.php");	
		}

		// Lấy ra cấp 1
		$d->reset();					
		$sql="select * from #_news_list where id='".$news_cat['id_list']."' and type='".$type."'";
		$d->query($sql);
		$news_list=$d->fetch_array();

		/* Crumbtrail */
		$crumbtrail.="<li><a href='".$com.".html' title='".$title_tcat."'>".$title_tcat."</a></li>";
		if($news_list['id']!='')
		{
			$crumbtrail.="<li class='crumbtrail_br'></li>";
			$crumbtrail.="<li><a href='".$com."/".$news_list['tenkhongdau']."-".$news_list['id']."/' title='".$news_list['ten'.$lang]."'>".$news_list['ten'.$lang]."</a></li>";
		}
		$crumbtrail.="<li class='crumbtrail_br'></li>";
		$crumbtrail.="<li><a class='crumbtrail_lst' title='".$news_cat['ten'.$lang]."'>".$news_cat['ten'.$lang]."</a></li>";

		$title_bar=$news_cat['ten'.$lang].' - ';	
		$title_tcat=$news_cat['ten'.$lang];
		$seo_h1=$news_cat['seo_h1'];
		$seo_h2=$news_cat['seo_h2'];
		$seo_h3=$news_cat['seo_h3'];
		$title_custom=$news_cat['title'];
		$keywords_custom=$news_cat['keywords'];
		$description_custom=$news_cat['description'];

		$d->reset();
		$sql="select * from #_news where id_cat='".$idc."' and type='".$type."' and hienthi=1 order by stt,id desc";
		$d->query($sql);
		$tintuc=$d->result_array();
		
		$curPage = isset($_GET['p']) ? $_GET['p'] : 1;
		$url=getCurrentPageURL();	
		$maxR=10;
		$maxP=5;
		$paging=paging_home($tintuc, $url, $curPage, $maxR, $maxP);
		$tintuc=$paging['source'];	
	}
	else if($idi!='')
	{	
		$d->reset();					
		$sql="select * from #_news_item where id='".$idi."' and type='".$type."'";
		$d->query($sql);
		$news_item=$d->fetch_array();

		if($news_item['id']=='')
		{
			redirect($config_url_http."404.php");	
		}

		/* Lấy ra cấp 1 */
		$d->reset();					
		$sql="select * from #_news_list where id='".$news_item['id_list']."' and type='".$type."'";			
		$d->query($sql);
		$news_list=$d->fetch_array();

		/* Lấy ra cấp 2 */
		$d->reset();					
		$sql="select * from #_news_cat where id_list='".$news_item['id_list']."' and id='".$news_item['id_cat']."' and type='".$type."'";			
		$d->query($sql);
		$news_cat=$d->fetch_array();

		/* Crumbtrail */
		$crumbtrail.="<li><a href='".$com.".html' title='".$title_tcat."'>".$title_tcat."</a></li>";
		if($news_list['id']!='')
		{
			$crumbtrail.="<li class='crumbtrail_br'></li>";
			$crumbtrail.="<li><a href='".$com."/".$news_list['tenkhongdau']."-".$news_list['id']."/' title='".$news_list['ten'.$lang]."'>".$news_list['ten'.$lang]."</a></li>";
		}
		if($news_cat['id']!='')
		{
			$crumbtrail.="<li class='crumbtrail_br'></li>";
			$crumbtrail.="<li><a href='".$com."/".$news_list['tenkhongdau']."/".$news_cat['tenkhongdau']."-".$news_cat['id']."/' title='".$news_cat['ten'.$lang]."'>".$news_cat['ten'.$lang]."</a></li>";
		}
		$crumbtrail.="<li class='crumbtrail_br'></li>";
		$crumbtrail.="<li><a class='crumbtrail_lst' title='".$news_item['ten'.$lang]."'>".$news_item['ten'.$lang]."</a></li>";

		$title_bar=$news_item['ten'.$lang].' - ';	
		$title_tcat=$news_item['ten'.$lang];
		$seo_h1=$news_item['seo_h1'];
		$seo_h2=$news_item['seo_h2'];
		$seo_h3=$news_item['seo_h3'];
		$title_custom=$news_item['title'];
		$keywords_custom=$news_item['keywords'];
		$description_custom=$news_item['description'];

		$d->reset();
		$sql="select * from #_news where id_item='".$idi."' and type='".$type."' and hienthi=1 order by stt,id desc";			
		$d->query($sql);
		$tintuc=$d->result_array();
		
		$curPage = isset($_GET['p']) ? $_GET['p'] : 1;
		$url=getCurrentPageURL();	
		$maxR=10;
		$maxP=5;
		$paging=paging_home($tintuc, $url, $curPage, $maxR, $maxP);
		$tintuc=$paging['source'];	
	}
	else
	{
		$title_bar=$title_tcat." - ";
		
		$d->reset();
		$sql = "select * from #_news where hienthi=1 and type='".$type."' order by stt,ngaytao desc";
		$d->query($sql);
		$tintuc = $d->result_array();
		
		$curPage = isset($_GET['p']) ? $_GET['p'] : 1;
		$url=getCurrentPageURL();	
		$maxR=10;
		$maxP=5;
		$paging=paging_home($tintuc, $url, $curPage, $maxR, $maxP);
		$tintuc=$paging['source'];	

		/* Crumbtrail */
		$crumbtrail="<li><a class='crumbtrail_lst' title='".$title_tcat."'>".$title_tcat."</a></li>";
	}
?>