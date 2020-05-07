<?php  
	if(!defined('_source')) die("Error");

    $slider = get_result_array("SELECT photo, link FROM table_photo WHERE hienthi=1 AND type='slide' ORDER BY stt,id DESC");
    $videohome = get_result_array("SELECT link_video, id, ten$lang FROM table_photo WHERE hienthi=1 AND type='video' ORDER BY stt, id DESC");
    $dvnb = get_result_array("SELECT ten$lang, tenkhongdau, mota$lang, id, photo FROM table_news WHERE hienthi=1 AND type='dich-vu' AND noibat>0 ORDER BY stt,id DESC");
    $splistnb = get_result_array("SELECT ten$lang, tenkhongdau, id FROM table_product_list WHERE hienthi=1 AND type='san-pham' AND noibat>0 ORDER BY stt,id DESC");
    $proall = get_result_array("SELECT id FROM table_product WHERE hienthi=1 AND type='san-pham' ORDER BY stt,id DESC");
    $prom = get_result_array("SELECT ten$lang, mota$lang, tenkhongdau, gia, giagiam, photo, id FROM table_product WHERE hienthi=1 AND type='san-pham' AND moi>0 ORDER BY stt,id DESC");
    $ttnb = get_result_array("SELECT ten$lang, tenkhongdau, ngaytao, id, photo FROM table_news WHERE hienthi=1 AND type='tin-tuc' AND noibat>0 ORDER BY stt,id DESC");
    $slogandv = get_fetch_array("SELECT ten$lang FROM table_news_static WHERE type='slogan-dich-vu'");
    $sloganintro = get_fetch_array("SELECT ten$lang FROM table_news_static WHERE type='slogan-intro'");
?>