<?php  
	if(!defined('_source')) die("Error");

	@$id=addslashes($_GET['id']);

	if($id!='')
	{
		$d->reset();
		$sql_detail = "select * from #_album where hienthi=1 and id='".$id."' and type='".$type."'";
		$d->query($sql_detail);
		$row_detail = $d->fetch_array();

		/* Cập nhật lượt xem */
		$d->reset();
		$data_luotxem['luotxem'] = $row_detail['luotxem'] + 1;
		$d->setTable('album');
		$d->setWhere('id',$row_detail['id']);
		$d->update($data_luotxem);

		if($row_detail['id']=='')
		{
			redirect($config_url_http."404.php");	
		}

		/* Crumbtrail */
		$crumbtrail.="<li><a href='".$com.".html' title='".$title_tcat."'>".$title_tcat."</a></li>";
		$crumbtrail.="<li class='crumbtrail_br'></li>";
		$crumbtrail.="<li><a class='crumbtrail_lst' title='".$row_detail['ten'.$lang]."'>".$row_detail['ten'.$lang]."</a></li>";

		$title_bar=$row_detail['ten'.$lang].' - ';
		$title_tcat=$row_detail['ten'.$lang];
		$seo_h1=$row_detail['seo_h1'];
		$seo_h2=$row_detail['seo_h2'];
		$seo_h3=$row_detail['seo_h3'];
		$title_custom=$row_detail['title'];
		$keywords_custom=$row_detail['keywords'];
		$description_custom=$row_detail['description'];
		
		$d->reset();
		$sql="select * from #_album_hinhanh where hienthi=1 and id_photo = '".$row_detail['id']."' and type='".$type."' order by stt,id desc";
		$d->query($sql);
		$hinhanhalbum = $d->result_array();

		/* Share */
		$ten_share = $row_detail['ten'.$lang];
		$img_share = $config_url_http._upload_photo_l."525x275x2/".$row_detail['photo'];
		$title_share = $row_detail['title'];
		$description_share = $row_detail['description'];
		$url_share = curPageURL();
	}
	else
	{
		$title_bar=$title_tcat." - ";

		$d->reset();
		$sql = "select ten$lang,photo,tenkhongdau,id from #_album where hienthi=1 and type='".$type."' order by stt,id desc";
		$d->query($sql);
		$album = $d->result_array();

		$curPage = isset($_GET['p']) ? $_GET['p'] : 1;
		$url=getCurrentPageURL();	
		$maxR=12;
		$maxP=5;
		$paging=paging_home($album, $url, $curPage, $maxR, $maxP);
		$album=$paging['source'];	

		/* Crumbtrail */
		$crumbtrail="<li><a class='crumbtrail_lst' title='".$title_tcat."'>".$title_tcat."</a></li>";
	}
?>