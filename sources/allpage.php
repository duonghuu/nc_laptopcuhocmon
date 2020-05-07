<?php  
	if(!defined('_source')) die("Error");

    $favicon = get_fetch_array("SELECT photo FROM table_photo WHERE hienthi=1 AND type='favicon' AND act='photo_static'");
    $logo = get_fetch_array("SELECT photo FROM table_photo WHERE type='logo' AND act='photo_static'");
    $mxh1 = get_result_array("SELECT photo, link FROM table_photo WHERE type='mangxahoi1' AND hienthi=1 ORDER BY stt,id DESC");
    $mxh2 = get_result_array("SELECT photo, link FROM table_photo WHERE type='mangxahoi2' AND hienthi=1 ORDER BY stt,id DESC");
    $splistmenu = get_result_array("SELECT ten$lang, tenkhongdau, id FROM table_product_list WHERE hienthi=1 AND type='san-pham' ORDER BY stt,id DESC");
    $splistfix = get_result_array("SELECT ten$lang, tenkhongdau, id FROM table_product_list WHERE hienthi=1 AND type='san-pham' ORDER BY stt,id DESC LIMIT 9");
    $dvmenu = get_result_array("SELECT ten$lang, tenkhongdau, id FROM table_news WHERE hienthi=1 AND type='dich-vu' ORDER BY stt,id DESC");
    $csmmenu = get_result_array("SELECT ten$lang, tenkhongdau, id FROM table_news WHERE hienthi=1 AND type='chinh-sach-mua' ORDER BY stt,id DESC");
    $tagsnb = get_result_array("SELECT ten$lang, tenkhongdau, id FROM table_tags_list WHERE type='san-pham' AND noibat>0 ORDER BY stt,id DESC");
    $ghmp = get_fetch_array("SELECT ten$lang FROM table_news_static WHERE type='giao-hang-mien-phi'");
    $footer = get_fetch_array("SELECT ten$lang, noidung$lang FROM table_news_static WHERE type='footer'");

    /* Đăng Ký Nhận Mail */
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['recaptcha_response_newsletter']) && $config_recaptcha==true && isset($_POST['submit-newsletter']))
    {
        $recaptcha_response_newsletter = $_POST['recaptcha_response_newsletter'];
        $recaptcha = file_get_contents($config_urlapi.'?secret='.$config_secretkey.'&response='.$recaptcha_response_newsletter);
        $recaptcha = json_decode($recaptcha);

        if ($recaptcha->score >= 0.5)
        {
            $d->reset();
            $data['email'] = sanitize($_REQUEST['email-newsletter']);
            $data['ngaytao'] = time();
            $data['type'] = 'dangkynhantin';
            $d->setTable('email_dk');
            if($d->insert($data))
            {
                transfer("Đăng ký nhận tin thành công. Chúng tôi sẽ liên hệ với bạn sớm.",$config_url_http);
            }
            else
            {
                transfer("Đăng ký thất bại. Vui lòng thử lại sau.",$config_url_http);
            }
        }
        else
        {
            transfer("Bạn đã gửi đăng ký và đang trong quá trình xét duyệt của ban quản trị website.",$config_url_http);
        }
    }
?>