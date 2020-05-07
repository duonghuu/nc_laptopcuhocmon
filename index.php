<?php
    session_start();
    @define ( '_lib' , './admin/lib/');
    @define ( '_source' , './sources/');
    @define('_template','./templates/');

    include_once _lib."AntiSQLInjection.php";
    include_once _lib."config.php";
    // if(count($config['arrayDomainSSL'])) include_once _lib."checkSSL.php";
    include_once _lib."class.database.php";
    $d = new database($config['database']);

    /* Setting */
    $d->reset();
    $sql = "select * from table_setting";
    $d->query($sql);
    $row_setting = $d->fetch_array();

    /* Cấu hình địa chỉ ip */
    $config_ip=$row_setting['ip_host'];
    $config_email=$row_setting['email_host'];
    $config_pass=$row_setting['password_host'];

    // if($_REQUEST['lang']!='') $_SESSION['lang']=$_REQUEST['lang'];
    // else if(!isset($_SESSION['lang']) && !isset($_REQUEST['lang'])) $_SESSION['lang']=$row_setting['lang_default'];
    // $lang=$_SESSION['lang'];
    $lang="vi";

    include_once _lib."Mobile_Detect.php";
    $detect = new Mobile_Detect;
    $deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');

    include_once _lib."constant.php";
    include_once _lib."functions.php";
    include_once _lib."functions_giohang.php";
    require_once _source."lang.php";
    include_once _lib."file_requick.php";
    include_once _source."counter.php";
    include_once _source."useronline.php";
    include_once _source."allpage.php";

    if($_REQUEST['command']=='delete')
    {
        remove_product($_REQUEST['pid'],$_REQUEST['mau'],$_REQUEST['size']);
    }
    else if($_REQUEST['command']=='update')
    {
        update_product($_REQUEST['pid'],$_REQUEST['mau'],$_REQUEST['size'],$_REQUEST['mauold'],$_REQUEST['sizeold']);
    }
    else if($_REQUEST['command']=='clear')
    {
        unset($_SESSION['cart']);
        unset($_SESSION['coupon']);
    }

    /* Kiểm Tra Và Đăng Nhập Bằng Cookie Login */
    // if(isset($_COOKIE['iduser']) && $_COOKIE['iduser']>0) login_by_cookie($_COOKIE['iduser']);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <?php include _source."head.php"; ?>
    <?php include _source."css.php"; ?>
</head>
<body>
    <?php
        include _source."seo.php";
        include _template."layout/header.php";
        include _template."layout/menu.php";
        include _template."layout/mmenu.php";
        if($source=='index') include _template."layout/slide.php";
    ?>
    <div class="wrap-main <?=($source=='index')?'wrap-home':''?> w-clear"><?php include _template.$template."_tpl.php"; ?></div>
    <?php
        include _template."layout/footer.php";
        include _template."layout/messenger2.php";
        include _source."js.php";
    ?>
    <?php if($deviceType=='phone') { ?>
        <div class="support-online">
            <div class="support-content" style="display: block;">
                <a target="_blank" href="tel:<?=preg_replace('/[^0-9]/','',$row_setting['hotline']);?>" class="not-loading call-now" rel="nofollow">
                    <i class="fa fa-whatsapp" aria-hidden="true"></i>
                    <div class="animated infinite zoomIn kenit-alo-circle"></div>
                    <div class="animated infinite pulse kenit-alo-circle-fill"></div>
                    <span>Hotline: <?=preg_replace('/[^0-9]/','',$row_setting['hotline']);?></span>
                </a>
                <a class="mes not-loading" target="_blank" href="lien-he.html">
                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                    <span>Chỉ đường</span>
                </a>
                <a class="mes not-loading" target="_blank" href="//zalo.me/<?=preg_replace('/[^0-9]/','',$row_setting['zalo']);?>">
                    <img src="assets/images/zalo-combo.png" alt="icon zalo">
                    <span>Zalo</span>
                </a>
                <a class="sms not-loading" target="_blank" href="sms:<?=preg_replace('/[^0-9]/','',$row_setting['hotline']);?>">
                    <i class="fa fa-weixin" aria-hidden="true"></i>
                    <span>SMS: <?=preg_replace('/[^0-9]/','',$row_setting['hotline']);?></span>
                </a>
            </div>
            <a class="btn-support not-loading">
                <div class="animated infinite zoomIn kenit-alo-circle"></div>
                <div class="animated infinite pulse kenit-alo-circle-fill"></div>
                <i class="fa fa-user-circle" aria-hidden="true"></i>
            </a>
        </div>
    <?php } ?>
</body>
</html>