<?php
	if(!defined('_lib')) die("Error");
	date_default_timezone_set('Asia/Ho_Chi_Minh');
	error_reporting(0);

	/* 
		Version 4.5
		Powered by Phúc Tài - phuctai.nina@gmail.com
	*/

function check_ssl_content($content){

    global $config;
    $pageURL = 'http';
    if ($_SERVER["HTTPS"] == "on") {
    $pageURLs .= $pageURL."s";
    $pageURLs .= "://";
    $pageURL .= "://";
    $pageURL.=$config['arrayDomainSSL'][0];
    $pageURLs.=$config['arrayDomainSSL'][0];
    return str_replace($pageURL,$pageURLs,$content);
    }else{
    return $content;
    }

}
//==========
function get_http(){

    $pageURL = 'http';
    if ($_SERVER["HTTPS"] == "on") {
    $pageURL .= "s";
    }
    $pageURL .= "://";
    return $pageURL;

}

$https= get_http();

	$config_url_folder="/2005/nc_laptopcuhocmon";
	$config_url=$_SERVER["SERVER_NAME"].$config_url_folder;
	$config_url_http=$https.$config_url."/";
	$config['database']['servername'] = 'localhost';
	$config['database']['username'] = 'root';
	$config['database']['password'] = '';
	$config['database']['database'] = 'nc_laptopcuhocmon';
	$config['database']['refix'] = 'table_';
	$config['author']['name'] = 'Diệp Phúc Tài';
	$config['author']['email'] = 'phuctai.nina@gmail.com';
	$config['author']['timefinish'] = '06/2019';
	$config['salt']='@#$fd_!34^';

	/* Cấu hình tiêu đề website */
	$config_title_log="LAPTOP NGUYỄN CƯỜNG";
	$config_title_index="LAPTOP NGUYỄN CƯỜNG";
	$config_title_menu="LAPTOP NGUYỄN CƯỜNG";

	/* Cấu hình Google Recaptcha Key */
	$config_recaptcha=true;
	$config_urlapi='https://www.google.com/recaptcha/api/siteverify';
	$config_sitekey='6LfA1KkUAAAAACODZiYzLWMyVr5m2hnB7wTFtse3';
	$config_secretkey='6LfA1KkUAAAAAMFZ__iOI04ySYw8tOzQQ3xUGUDD';

	/* Cấu hình số lần đăng nhập và thời gian chờ đăng nhập */
	$config['login']['attempt'] = 5; // Số lần cho phép đăng nhập sai
	$config['login']['delay'] = 15; // Thời gian chờ khi cho phép đăng nhập lại

	// Cấu hình OneSignal
	$config_onesignal = false;
	$config_onesignal_id = "af12ae0e-cfb7-41d0-91d8-8997fca889f8";
	$config_onesignal_rest_id = "MWFmZGVhMzYtY2U0Zi00MjA0LTg0ODEtZWFkZTZlNmM1MDg4";

	/* Cấu hình ngôn ngữ (Available 6 Languages) */
	// "vi"=>"Tiếng Việt" 
	// "en"=>"Tiếng Anh" 
	// "cn"=>"Tiếng Trung" 
	// "jp"=>"Tiếng Nhật" 
	// "ko"=>"Tiếng Hàn" 
	// "fr"=>"Tiếng Pháp"
	$config['lang']=array("vi"=>"Tiếng Việt");

	/* CKFinder */
	$config['finder']['folder'] = $config_url_folder;
	$config['finder']['dir'] = "/upload/ckfinder/";

	/* Cấu hình form gửi mail */
	$config_size_logo="280x80x2";
	$config_mxh=true;
	$config_background="#F3F3F3";
	$config_color="#333";

	$config['arrayDomainSSL'] = array("laptopcuhocmon.com");
?>