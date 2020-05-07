<?php  
	if(!defined('_source')) die("Error");

	@$id=addslashes($_GET['id']);
	@$idl=addslashes($_GET['idl']);
	@$idc=addslashes($_GET['idc']);
	@$idi=addslashes($_GET['idi']);
	@$ids=addslashes($_GET['ids']);

	if($id!='')
	{
		$d->reset();
		$sql = "select * from #_product where hienthi=1 and id='".$id."' and type='".$type."'";
		$d->query($sql);
		$row_detail = $d->fetch_array();

		/* Cập nhật lượt xem */
		$d->reset();
		$data_luotxem['luotxem'] = $row_detail['luotxem'] + 1;
		$d->setTable('product');
		$d->setWhere('id',$row_detail['id']);
		$d->update($data_luotxem);

		if($row_detail['id']=='')
		{
			redirect($config_url_http."404.php");	
		}

		/* Begin Load và xử lý comment */
		$cu=getCurrentPageURL();
        if(isset($_POST['cm']))
        {
            if(strtolower($cm['hoten'])!='admin')
            {
                $cm=$_POST['cm'];
                $cm['hienthi']=0;
                $cm['ngaydang']=time();
                $cm['url']=$cu;
                $d->setTable('comment');
                $d->insert($cm);
            }
        }
        /* End Load và xử lý comment */

        /* Lấy tags */
        $d->reset();
		$sql = "select * from #_tags_list where type='".$type."' and id in (select id_tags from #_tags_group where id_pro='".$row_detail['id']."' and type='".$type."')";
		$d->query($sql);
		$tags = $d->result_array();

		/* Lấy hỗ trợ online */
		$d->reset();
		$sql = "select ten$lang, photo from #_news where hienthi=1 and type='ho-tro-online' order by stt,id desc";
		$d->query($sql);
		$hotroonline = $d->result_array();

		/* Lấy hỗ trợ mua hàng */
		$d->reset();
		$sql = "select ten$lang, photo from #_news where hienthi=1 and type='ho-tro-mua-hang' order by stt,id desc";
		$d->query($sql);
		$hotromuahang = $d->result_array();

		/* Lấy màu */
		$d->reset();
		$sql = "select * from #_product_mau where hienthi=1 and type='".$type."' and find_in_set(id,'".$row_detail['id_mau']."') order by stt,id desc";
		$d->query($sql);
		$mau = $d->result_array();

		/* Lấy size */
		$d->reset();
		$sql = "select * from #_product_size where hienthi=1 and type='".$type."' and find_in_set(id,'".$row_detail['id_size']."') order by stt,id desc";
		$d->query($sql);
		$size = $d->result_array();

		/* Lấy ra cấp 1 */
		$d->reset();
		$sql = "select ten$lang, tenkhongdau, id from #_product_list where hienthi=1 and id='".$row_detail['id_list']."' and type='".$type."'";
		$d->query($sql);
		$pro_list = $d->fetch_array();

		/* Lấy ra cấp 2 */
		$d->reset();
		$sql = "select ten$lang, tenkhongdau, id from #_product_cat where hienthi=1 and id='".$row_detail['id_cat']."' and type='".$type."'";
		$d->query($sql);
		$pro_cat = $d->fetch_array();

		/* Lấy ra cấp 3 */
		$d->reset();
		$sql = "select ten$lang, tenkhongdau, id from #_product_item where hienthi=1 and id='".$row_detail['id_item']."' and type='".$type."'";
		$d->query($sql);
		$pro_item = $d->fetch_array();

		/* Lấy ra cấp 4 */
		$d->reset();
		$sql = "select ten$lang, tenkhongdau, id from #_product_capbon where hienthi=1 and id='".$row_detail['id_capbon']."' and type='".$type."'";
		$d->query($sql);
		$pro_capbon = $d->fetch_array();

		/* Crumbtrail */
		$crumbtrail.="<li><a href='".$com.".html' title='".$title_tcat."'>".$title_tcat."</a></li>";
		if($pro_list['id']!='')
		{
			$crumbtrail.="<li class='crumbtrail_br'></li>";
			$crumbtrail.="<li><a href='".$com."/".$pro_list['tenkhongdau']."-".$pro_list['id']."/' title='".$pro_list['ten'.$lang]."'>".$pro_list['ten'.$lang]."</a></li>";
		}
		if($pro_cat['id']!='')
		{
			$crumbtrail.="<li class='crumbtrail_br'></li>";
			$crumbtrail.="<li><a href='".$com."/".$pro_list['tenkhongdau']."/".$pro_cat['tenkhongdau']."-".$pro_cat['id']."/' title='".$pro_cat['ten'.$lang]."'>".$pro_cat['ten'.$lang]."</a></li>";
		}
		if($pro_item['id']!='')
		{
			$crumbtrail.="<li class='crumbtrail_br'></li>";
			$crumbtrail.="<li><a href='".$com."/".$pro_list['tenkhongdau']."/".$pro_cat['tenkhongdau']."/".$pro_item['tenkhongdau']."-".$pro_item['id']."/' title='".$pro_item['ten'.$lang]."'>".$pro_item['ten'.$lang]."</a></li>";
		}
		if($pro_capbon['id']!='')
		{
			$crumbtrail.="<li class='crumbtrail_br'></li>";
			$crumbtrail.="<li><a href='".$com."/".$pro_list['tenkhongdau']."/".$pro_cat['tenkhongdau']."/".$pro_item['tenkhongdau']."/".$pro_capbon['tenkhongdau']."-".$pro_capbon['id']."/' title='".$pro_capbon['ten'.$lang]."'>".$pro_capbon['ten'.$lang]."</a></li>";
		}
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
		$sql="select photo from #_product_hinhanh where hienthi=1 and id_photo = '".$row_detail['id']."' and type='".$type."' and kind='man' and val='".$type."' order by stt,id desc";
		$d->query($sql);
		$hinhanhsp = $d->result_array();

		$d->reset();					
		$sql = "select * from #_product where hienthi=1 and id <>'".$id."' and id_list='".$row_detail['id_list']."' and type='".$type."' order by stt,id desc";
		$d->query($sql);
		$product = $d->result_array();

		$curPage = isset($_GET['p']) ? $_GET['p'] : 1;
		$url=getCurrentPageURL();	
		$maxR=8;
		$maxP=3;
		$paging=paging_home($product, $url, $curPage, $maxR, $maxP);
		$product=$paging['source'];

		/* Share */
		$ten_share = $row_detail['ten'.$lang];
		$img_share = $config_url_http._upload_product_l."525x275x2/".$row_detail['photo'];
		$title_share = $row_detail['title'];
		$description_share = $row_detail['description'];
		$url_share = curPageURL();
	}
	else if($idl!='')
	{	
		$d->reset();					
		$sql="select * from #_product_list where id='".$idl."' and type='".$type."'";
		$d->query($sql);
		$pro_list=$d->fetch_array();

		if($pro_list['id']=='')
		{
			redirect($config_url_http."404.php");	
		}

		/* Crumbtrail */
		$crumbtrail.="<li><a href='".$com.".html' title='".$title_tcat."'>".$title_tcat."</a></li>";
		$crumbtrail.="<li class='crumbtrail_br'></li>";
		$crumbtrail.="<li><a class='crumbtrail_lst' title='".$pro_list['ten'.$lang]."'>".$pro_list['ten'.$lang]."</a></li>";

		$title_bar=$pro_list['ten'.$lang].' - ';	
		$title_tcat=$pro_list['ten'.$lang];
		$seo_h1=$pro_list['seo_h1'];
		$seo_h2=$pro_list['seo_h2'];
		$seo_h3=$pro_list['seo_h3'];
		$title_custom=$pro_list['title'];
		$keywords_custom=$pro_list['keywords'];
		$description_custom=$pro_list['description'];

		$d->reset();
		$sql="select * from #_product where id_list='".$idl."' and type='".$type."' and hienthi=1 order by stt,id desc";
		$d->query($sql);
		$product=$d->result_array();
		
		$curPage = isset($_GET['p']) ? $_GET['p'] : 1;
		$url=getCurrentPageURL();	
		$maxR=20;
		$maxP=5;
		$paging=paging_home($product, $url, $curPage, $maxR, $maxP);
		$product=$paging['source'];	
	}
	else if($idc!='')
	{	
		$d->reset();					
		$sql="select * from #_product_cat where id='".$idc."' and type='".$type."'";
		$d->query($sql);
		$pro_cat=$d->fetch_array();

		if($pro_cat['id']=='')
		{
			redirect($config_url_http."404.php");	
		}

		// Lấy ra cấp 1
		$d->reset();					
		$sql="select * from #_product_list where id='".$pro_cat['id_list']."' and type='".$type."'";
		$d->query($sql);
		$pro_list=$d->fetch_array();

		/* Crumbtrail */
		$crumbtrail.="<li><a href='".$com.".html' title='".$title_tcat."'>".$title_tcat."</a></li>";
		if($pro_list['id']!='')
		{
			$crumbtrail.="<li class='crumbtrail_br'></li>";
			$crumbtrail.="<li><a href='".$com."/".$pro_list['tenkhongdau']."-".$pro_list['id']."/' title='".$pro_list['ten'.$lang]."'>".$pro_list['ten'.$lang]."</a></li>";
		}
		$crumbtrail.="<li class='crumbtrail_br'></li>";
		$crumbtrail.="<li><a class='crumbtrail_lst' title='".$pro_cat['ten'.$lang]."'>".$pro_cat['ten'.$lang]."</a></li>";

		$title_bar=$pro_cat['ten'.$lang].' - ';	
		$title_tcat=$pro_cat['ten'.$lang];
		$seo_h1=$pro_cat['seo_h1'];
		$seo_h2=$pro_cat['seo_h2'];
		$seo_h3=$pro_cat['seo_h3'];
		$title_custom=$pro_cat['title'];
		$keywords_custom=$pro_cat['keywords'];
		$description_custom=$pro_cat['description'];

		$d->reset();
		$sql="select * from #_product where id_cat='".$idc."' and type='".$type."' and hienthi=1 order by stt,id desc";
		$d->query($sql);
		$product=$d->result_array();
		
		$curPage = isset($_GET['p']) ? $_GET['p'] : 1;
		$url=getCurrentPageURL();	
		$maxR=20;
		$maxP=5;
		$paging=paging_home($product, $url, $curPage, $maxR, $maxP);
		$product=$paging['source'];	
	}
	else if($idi!='')
	{	
		$d->reset();					
		$sql="select * from #_product_item where id='".$idi."' and type='".$type."'";
		$d->query($sql);
		$pro_item=$d->fetch_array();

		if($pro_item['id']=='')
		{
			redirect($config_url_http."404.php");	
		}

		/* Lấy ra cấp 1 */
		$d->reset();					
		$sql="select * from #_product_list where id='".$pro_item['id_list']."' and type='".$type."'";			
		$d->query($sql);
		$pro_list=$d->fetch_array();

		/* Lấy ra cấp 2 */
		$d->reset();					
		$sql="select * from #_product_cat where id_list='".$pro_item['id_list']."' and id='".$pro_item['id_cat']."' and type='".$type."'";			
		$d->query($sql);
		$pro_cat=$d->fetch_array();

		/* Crumbtrail */
		$crumbtrail.="<li><a href='".$com.".html' title='".$title_tcat."'>".$title_tcat."</a></li>";
		if($pro_list['id']!='')
		{
			$crumbtrail.="<li class='crumbtrail_br'></li>";
			$crumbtrail.="<li><a href='".$com."/".$pro_list['tenkhongdau']."-".$pro_list['id']."/' title='".$pro_list['ten'.$lang]."'>".$pro_list['ten'.$lang]."</a></li>";
		}
		if($pro_cat['id']!='')
		{
			$crumbtrail.="<li class='crumbtrail_br'></li>";
			$crumbtrail.="<li><a href='".$com."/".$pro_list['tenkhongdau']."/".$pro_cat['tenkhongdau']."-".$pro_cat['id']."/' title='".$pro_cat['ten'.$lang]."'>".$pro_cat['ten'.$lang]."</a></li>";
		}
		$crumbtrail.="<li class='crumbtrail_br'></li>";
		$crumbtrail.="<li><a class='crumbtrail_lst' title='".$pro_item['ten'.$lang]."'>".$pro_item['ten'.$lang]."</a></li>";

		$title_bar=$pro_item['ten'.$lang].' - ';	
		$title_tcat=$pro_item['ten'.$lang];
		$seo_h1=$pro_item['seo_h1'];
		$seo_h2=$pro_item['seo_h2'];
		$seo_h3=$pro_item['seo_h3'];
		$title_custom=$pro_item['title'];
		$keywords_custom=$pro_item['keywords'];
		$description_custom=$pro_item['description'];

		$d->reset();
		$sql="select * from #_product where id_item='".$idi."' and type='".$type."' and hienthi=1 order by stt,id desc";			
		$d->query($sql);
		$product=$d->result_array();
		
		$curPage = isset($_GET['p']) ? $_GET['p'] : 1;
		$url=getCurrentPageURL();	
		$maxR=20;
		$maxP=5;
		$paging=paging_home($product, $url, $curPage, $maxR, $maxP);
		$product=$paging['source'];	
	}
	else if($ids!='')
	{	
		$d->reset();					
		$sql="select * from #_product_capbon where id='".$ids."' and type='".$type."'";
		$d->query($sql);
		$pro_capbon=$d->fetch_array();

		if($pro_capbon['id']=='')
		{
			redirect($config_url_http."404.php");	
		}

		/* Lấy ra cấp 1 */
		$d->reset();					
		$sql="select * from #_product_list where id='".$pro_capbon['id_list']."' and type='".$type."'";			
		$d->query($sql);
		$pro_list=$d->fetch_array();

		/* Lấy ra cấp 2 */
		$d->reset();					
		$sql="select * from #_product_cat where id_list='".$pro_capbon['id_list']."' and id='".$pro_capbon['id_cat']."' and type='".$type."'";			
		$d->query($sql);
		$pro_cat=$d->fetch_array();

		/* Lấy ra cấp 3 */
		$d->reset();					
		$sql="select * from #_product_item where id_list='".$pro_capbon['id_list']."' and id_cat='".$pro_capbon['id_cat']."' and id='".$pro_capbon['id_item']."' and type='".$type."'";			
		$d->query($sql);
		$pro_item=$d->fetch_array();

		/* Crumbtrail */
		$crumbtrail.="<li><a href='".$com.".html' title='".$title_tcat."'>".$title_tcat."</a></li>";
		if($pro_list['id']!='')
		{
			$crumbtrail.="<li class='crumbtrail_br'></li>";
			$crumbtrail.="<li><a href='".$com."/".$pro_list['tenkhongdau']."-".$pro_list['id']."/' title='".$pro_list['ten'.$lang]."'>".$pro_list['ten'.$lang]."</a></li>";
		}
		if($pro_cat['id']!='')
		{
			$crumbtrail.="<li class='crumbtrail_br'></li>";
			$crumbtrail.="<li><a href='".$com."/".$pro_list['tenkhongdau']."/".$pro_cat['tenkhongdau']."-".$pro_cat['id']."/' title='".$pro_cat['ten'.$lang]."'>".$pro_cat['ten'.$lang]."</a></li>";
		}
		if($pro_item['id']!='')
		{
			$crumbtrail.="<li class='crumbtrail_br'></li>";
			$crumbtrail.="<li><a href='".$com."/".$pro_list['tenkhongdau']."/".$pro_cat['tenkhongdau']."/".$pro_item['tenkhongdau']."-".$pro_item['id']."/' title='".$pro_item['ten'.$lang]."'>".$pro_item['ten'.$lang]."</a></li>";
		}
		$crumbtrail.="<li class='crumbtrail_br'></li>";
		$crumbtrail.="<li><a class='crumbtrail_lst' title='".$pro_capbon['ten'.$lang]."'>".$pro_capbon['ten'.$lang]."</a></li>";

		$title_bar=$pro_capbon['ten'.$lang].' - ';	
		$title_tcat=$pro_capbon['ten'.$lang];
		$seo_h1=$pro_capbon['seo_h1'];
		$seo_h2=$pro_capbon['seo_h2'];
		$seo_h3=$pro_capbon['seo_h3'];
		$title_custom=$pro_capbon['title'];
		$keywords_custom=$pro_capbon['keywords'];
		$description_custom=$pro_capbon['description'];

		$d->reset();
		$sql="select * from #_product where id_capbon='".$ids."' and type='".$type."' and hienthi=1 order by stt,id desc";
		$d->query($sql);
		$product=$d->result_array();
		
		$curPage = isset($_GET['p']) ? $_GET['p'] : 1;
		$url=getCurrentPageURL();	
		$maxR=20;
		$maxP=5;
		$paging=paging_home($product, $url, $curPage, $maxR, $maxP);
		$product=$paging['source'];	
	}
	else
	{
		$title_bar=$title_tcat." - ";

		$d->reset();
		$sql = "select * from #_product where hienthi=1 and type='".$type."' order by stt,id desc";
		$d->query($sql);
		$product = $d->result_array();

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