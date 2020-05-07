<?php
	@define ( '_lib' , './admin/lib/');
	@define ( '_source' , './sources/');

	if(!isset($_SESSION['lang'])) $_SESSION['lang']='vi';
	$lang=$_SESSION['lang'];

	include_once _lib."AntiSQLInjection.php";
	include_once _lib."config.php";
	include_once _lib."class.database.php";
	$d = new database($config['database']);
	require_once _source."lang.php";

    header("Content-Type: application/xml; charset=utf-8");
	echo '<?xml version="1.0" encoding="UTF-8"?>';
	echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">'; 
	echo '<url><loc>'.$config_url_http.'index.html</loc><lastmod>'.date('c',time()).'</lastmod><changefreq>daily</changefreq><priority>0.1</priority></url>';
	echo '<url><loc>'.$config_url_http.'san-pham.html</loc><lastmod>'.date('c',time()).'</lastmod><changefreq>daily</changefreq><priority>0.1</priority></url>';
	echo '<url><loc>'.$config_url_http.'dich-vu.html</loc><lastmod>'.date('c',time()).'</lastmod><changefreq>daily</changefreq><priority>0.1</priority></url>';
	echo '<url><loc>'.$config_url_http.'chinh-sach-mua.html</loc><lastmod>'.date('c',time()).'</lastmod><changefreq>daily</changefreq><priority>0.1</priority></url>';
	echo '<url><loc>'.$config_url_http.'cong-trinh.html</loc><lastmod>'.date('c',time()).'</lastmod><changefreq>daily</changefreq><priority>0.1</priority></url>';
	echo '<url><loc>'.$config_url_http.'lien-he.html</loc><lastmod>'.date('c',time()).'</lastmod><changefreq>daily</changefreq><priority>0.1</priority></url>';

	function get_category_sitemap($id,$table)
	{
		global $d;

		$d->reset();
		$sql = "select tenkhongdau from #_$table where id='".$id."' order by '".$orderby."' desc";
		$d->query($sql);
		$category = $d->fetch_array();

		return $category['tenkhongdau'];
	}

	function create_sitemap($com='',$type='',$table='',$level='',$tail='',$time='',$changefreq='',$priority='',$lang='vi',$orderby='')
	{
		global $d, $sitemap, $config_url_http;

		if($level != "" && $table != 'tags_list')
		{
			$tablesitemap = $table;
			$table=$table."_".$level;
		}

		$d->reset();
		$sql = "select * from #_$table where type='".$type."' order by '".$orderby."' desc";
		$d->query($sql);
		$sitemap = $d->result_array();

		for($i=0;$i<count($sitemap);$i++)
		{
			$urlsitemap = "";
			if($level == 'list')
			{
				$urlsitemap = $config_url_http.$type.'/'.$sitemap[$i]['tenkhongdau'].'-'.$sitemap[$i]['id'].$tail;
			}
			else if($level == 'cat')
			{
				$table_list=$tablesitemap.'_list';
				$urlsitemap = $config_url_http.$type.'/'.get_category_sitemap($sitemap[$i]['id_list'],$table_list).'/'.$sitemap[$i]['tenkhongdau'].'-'.$sitemap[$i]['id'].$tail;
			}
			else if($level == 'item')
			{
				$table_list=$tablesitemap.'_list';
				$table_cat=$tablesitemap.'_cat';
				$urlsitemap = $config_url_http.$type.'/'.get_category_sitemap($sitemap[$i]['id_list'],$table_list).'/'.get_category_sitemap($sitemap[$i]['id_cat'],$table_cat).'/'.$sitemap[$i]['tenkhongdau'].'-'.$sitemap[$i]['id'].$tail;
			}
			else if($level == 'capbon')
			{
				$table_list=$tablesitemap.'_list';
				$table_cat=$tablesitemap.'_cat';
				$table_item=$tablesitemap.'_item';
				$urlsitemap = $config_url_http.$type.'/'.get_category_sitemap($sitemap[$i]['id_list'],$table_list).'/'.get_category_sitemap($sitemap[$i]['id_cat'],$table_cat).'/'.get_category_sitemap($sitemap[$i]['id_item'],$table_item).'/'.$sitemap[$i]['tenkhongdau'].'-'.$sitemap[$i]['id'].$tail;
			}
			else if($level == '' && $table == 'tags_list')
			{
				$urlsitemap = $config_url_http.$com.'/'.$sitemap[$i]['tenkhongdau'];
			}
			else
			{
				$urlsitemap = $config_url_http.$type.'/'.$sitemap[$i]['tenkhongdau'].'-'.$sitemap[$i]['id'].'.'.$tail;
			}

			echo '<url>'; 
			echo '<loc>'.$urlsitemap.'</loc>'; 
			echo '<changefreq>'.$changefreq.'</changefreq>';
			echo '<lastmod>'.date($time,$sitemap[$i]['ngaytao']).'</lastmod>';
			echo '<priority>'.$priority.'</priority>';
			echo '</url>';
		}
	}

	/* Sản phẩm */
	create_sitemap("","san-pham","product","list","/","c","daily","1",$lang,"stt,id");
	create_sitemap("","san-pham","product","cat","/","c","daily","1",$lang,"stt,id");
	// create_sitemap("","san-pham","product","item","/","c","daily","1",$lang,"stt,id");
	// create_sitemap("","san-pham","product","capbon","/","c","daily","1",$lang,"stt,id");
	create_sitemap("","san-pham","product","","html","c","daily","1",$lang,"stt,id");

	/* Tags sản phẩm */
	create_sitemap("tags-san-pham","san-pham","tags_list","","","c","daily","1",$lang,"stt,id");
	
	/* Bài Viết */
	create_sitemap("","tin-tuc","news","","html","c","daily","1",$lang,"stt,id");
	create_sitemap("","dich-vu","news","","html","c","daily","1",$lang,"stt,id");
	create_sitemap("","chinh-sach-mua","news","","html","c","daily","1",$lang,"stt,id");
	create_sitemap("","cong-trinh","news","","html","c","daily","1",$lang,"stt,id");

	/* Kết Thúc Tạo Sitemap */
	echo '</urlset>';
?>