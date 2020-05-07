<?php
	session_start();
	@define ( '_template' , './templates/');
	@define ( '_source' , './sources/');
	@define ( '_lib' , './lib/');
	@define ( _trangdau , 'Trang đầu');
	@define ( _trangcuoi , 'Trang cuối');

	include_once _lib."AntiSQLInjection.php";
	include_once _lib."config.php";
	// if(count($config['arrayDomainSSL'])) include_once _lib."checkSSL.php";
	include_once _lib."constant.php";
	include_once _lib."config_type.php";
	include_once _lib."functions.php";
	include_once _lib."library.php";
	include_once _lib."class.database.php";

	$com = (isset($_REQUEST['com'])) ? addslashes($_REQUEST['com']) : "";
	$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
	$type = (isset($_REQUEST['type'])) ? addslashes($_REQUEST['type']) : "";
	$login_name = $config_url_http;
	
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

	/* Begin Kiểm tra 2 máy đăng nhập cùng 1 tài khoản */
	if(isset($_SESSION[$login_name]) || $_SESSION[$login_name]==true)
	{
		$id_user = (int)$_SESSION['login']['id'];
		$timenow = time();

		$d->reset();
		$sql="select username,password,lastlogin,user_token from #_user WHERE id ='$id_user'";
		$d->query($sql);
		$row=$d->fetch_array();

		$sessionhash = md5(sha1($row['password'].$row['username']));
		
		if($_SESSION['login_session']!=$sessionhash || ($timenow - $row['lastlogin'])>3600)
		{
			session_destroy();
			redirect("index.php?com=user&act=login");
		}

		if($_SESSION['login_token']!==$row['user_token']) $notice_admin = 'Có người đang đăng nhập tài khoản của bạn !';
		else $notice_admin ='';

		$token = md5(time());
		$_SESSION['login_token'] = $token;

		/* Begin Cập nhật lại thời gian hoạt động và token */
		$d->reset();
		$data_capnhatthoigianhoatdong['lastlogin'] = $timenow;
		$data_capnhatthoigianhoatdong['user_token'] = $token;
		$d->setTable('user');
		$d->setWhere('id',$id_user);
		$d->update($data_capnhatthoigianhoatdong);
		/* End Cập nhật lại thời gian hoạt động và token */
	}
	/* End Kiểm tra 2 máy đăng nhập cùng 1 tài khoản */

	/* Begin Kiểm tra đăng nhập tài khoản sai theo số lần */
	$ip = getRealIPAddress();
	$d->reset();
	$sql="select id,login_ip,login_attempts,attempt_time,locked_time from #_user_limit WHERE login_ip = '$ip' ORDER BY id DESC LIMIT 1 ";
	$d->query($sql);
	if($d->num_rows()==1)
	{
		$row = $d->result_array();
		$id_login = $row[0]['id'];
		$time_now = time();
		if($row[0]['locked_time']>0)
		{
			$locked_time = $row[0]['locked_time'];
			$delay_time = $config['login']['delay'];
			$interval = $time_now  - $locked_time;
			if($interval <= $delay_time*60)
			{
				$time_remain = $delay_time*60 - $interval;
				$msg = "Xin lỗi..! Vui lòng thử lại sau ". round($time_remain/60)." phút..!";
				transfer($msg, "index.php?com=user&act=login");
			}
			else
			{
				$d->reset();
				$data_kiemtradangsaitheosolan['login_attempts'] = 0;
				$data_kiemtradangsaitheosolan['attempt_time'] = $time_now;
				$data_kiemtradangsaitheosolan['locked_time'] = 0;
				$d->setTable('user_limit');
				$d->setWhere('id',$id_login);
				$d->update($data_kiemtradangsaitheosolan);
			}
		}
	}
	/* End Kiểm tra đăng nhập tài khoản sai theo số lần */

	/* SESSION CKFinder */
	$_SESSION['SCRIPT_FILENAME'] = 'http://'.$_SERVER["SERVER_NAME"];
	$_SESSION['SERVER_FOLDER'] = $config['finder']['folder'];
	$_SESSION['UPLOAD_DIR'] = $config['finder']['dir'];

	if($config_phanquyen=='true' && isset($_SESSION[$login_name])) 
	{
		/* Kiểm tra phân quyền */
		if(check_access3())
		{
			$kiemtra = 1;
			if( $act != 'save' && 
				$act != 'save_list' && 
				$act != 'save_cat' && 
				$act != 'save_item' && 
				$act != 'save_capbon' &&
				$act != 'save_nhanhieu' &&
				$act != 'save_mau' &&
				$act != 'save_size' &&
				$act != 'save_photo_background' &&
				$act != 'save_static' &&
				$act != 'save_photo')
			{
				if($com != 'user') 
				{
					if($com != '' && $com != 'index')
					{
						if($type != '')
							$quyen_user = $com.'_'.$act.'_'.$type;
						else
							$quyen_user = $com.'_'.$act;

						if($quyen_user == '_'){
							$quyen_user=='';
						}
						if(!in_array($quyen_user, $_SESSION['list_quyen']))
						{
							transfer("Bạn không có quyền vào khu vực này !","index.php");
							exit;
						}
					}
				}
			}
		}
	}

	/* Kiểm tra có đăng nhập chưa */
	if(check_login()==false && $act!="login")
	{
		redirect("index.php?com=user&act=login");
	}

	switch($com)
	{
		case 'pushOnesignal':
			$source = "pushOnesignal";
			break;
		case 'product':
			$source = "product";
			break;
		case 'contact':
			$source = "contact";
			break;
		case 'coupon':
			$source = "coupon";
			break;
		case 'tinhthanh_quanhuyen':
			$source = "tinhthanh_quanhuyen";
			break;
		case 'album':
			$source = "album";
			break;
		case 'comment':
			$source = "comment";
			break;
		case 'tags_list':
			$source = "tags_list";
			break;
		case 'order':
			$source = "donhang";
			break;
		case 'download':
			$source = "download";
			break;
		case 'import':
			$source = "import";
			break;
		case 'export':
			$source = "export";
			break;
		case 'export_word':
			$source = "export_word";
			break;
		case 'export_excel':
			$source = "export_excel";
			break;
		case 'tags':
			$source = "tags";
			break;
		case 'lienket':
			$source = "lienket";
			break;
		case 'news':
			$source = "news";
			break;
		case 'news_static':
			$source = "news_static";
			break;
		case 'yahoo':
			$source = "yahoo";
			break;
		case 'email_dk':
			$source = "email_dk";
			break;
		case 'photo':
			$source = "photo";
			break;
		case 'setting':
			$source = "setting";
			break;
		case 'lang':
			$source = "lang";
			break;
		case 'user':
			$source = "user";
			break;
		case 'map':
			$source = "map";
			break;
			
		default: 
			$source = "";
			$template = "index";
			break;
	}
	
	if((!isset($_SESSION[$login_name]) || $_SESSION[$login_name]==false) && $act!="login")
	{
		redirect("index.php?com=user&act=login");
	}
	
	if($source!="") include _source.$source.".php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
"http://www.w3.org/TR/html4/DTD/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Administrator Manager - <?=$row_setting['title']?></title>
	<link href="img/favicon.png" rel="shortcut icon" type="image/x-icon" />

	<link rel="stylesheet" href="css/style.default.css" type="text/css" />
	<link rel="stylesheet" href="css/style.dark.css" type="text/css" />
	<link rel="stylesheet" href="css/bootstrap-fileupload.min.css" type="text/css" />
	<link rel="stylesheet" href="css/style.custom.css" type="text/css" />

	<!-- Font Awesome -->
	<link href="css/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

	<!-- Multi select -->
	<link href="plugin/sumoselect/sumoselect.css" rel="stylesheet" />

	<!-- CSS vs JS Upload Multi Picture -->
	<link href="plugin/multi-pic/css/jquery.filer.css" type="text/css" rel="stylesheet" />
	<link href="plugin/multi-pic/css/jquery.filer-dragdropbox-theme.css" type="text/css" rel="stylesheet" />
	<link href="plugin/multi-pic/style-multi-pic.css" type="text/css" rel="stylesheet" />

	<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
	<script type="text/javascript" src="js/jquery-migrate-1.1.1.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui-1.9.2.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/bootstrap-fileupload.min.js"></script>
	<script type="text/javascript" src="js/jquery.uniform.min.js"></script>
	<script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="js/chosen.jquery.min.js"></script>
	<script type="text/javascript" src="js/custom.js"></script>
	<script type="text/javascript" src="js/forms.js"></script>

	<!-- Multi select -->
	<script src="plugin/sumoselect/jquery.sumoselect.min.js"></script>

	<!-- Ckfinder -->
	<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
	<script type="text/javascript">
		CKEDITOR.editorConfig = function( config ) {
			/* Config General */
			config.language = 'vi';
			config.skin = 'moono-lisa';
			config.width = 'auto';
			config.height = 500;

			/* Config CSS */
			config.contentsCss =
			[
				'<?=$config_url_http?>/admin/ckeditor/plugins/fontawesome/font-awesome/css/font-awesome.min.css',
				'<?=$config_url_http?>/admin/ckeditor/contents.css'
			];

			/* All Plugins */
			config.extraPlugins = 'yaqr,texttransform,eqneditor,copyformatting,html5video,html5audio,flash,youtube,wordcount,tableresize,image2,widget,lineutils,fontawesome,clipboard,dialog,dialogui,widgetselection,lineheight,video,videodetector';

			/* Config Lineheight */
			config.line_height = '1;1.1;1.2;1.3;1.4;1.5;2;2.5;3;3.5;4;4.5;5';

			/* Config FontAwesome */
			config.allowedContent = true;
			config.fontAwesome_version = '4.6';
			config.fontAwesome_html_tag = 'i';
			config.fontAwesome_size = 'class';
			CKEDITOR.dtd.$removeEmpty['span'] = false;
			CKEDITOR.dtd.$removeEmpty['i'] = false;
			config.fontAwesome_unicode = false;

			config.pasteFromWordRemoveFontStyles = false;
			config.pasteFromWordRemoveStyles = false;
			
			/* Config CKFinder */
			config.filebrowserBrowseUrl = 'ckfinder/ckfinder.html';
			config.filebrowserImageBrowseUrl = 'ckfinder/ckfinder.html?type=Images';
			config.filebrowserFlashBrowseUrl = 'ckfinder/ckfinder.html?type=Flash';
			config.filebrowserUploadUrl = 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
			config.filebrowserImageUploadUrl = 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
			config.filebrowserFlashUploadUrl = 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';

			/* Config ToolBar */
			config.toolbar = [
				{ name: 'document', items: [ 'Source', '-', 'Save', 'NewPage', 'Preview', 'Print', '-', 'Templates' ] },
				{ name: 'clipboard', items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', 'PasteFromExcel', '-', 'Undo', 'Redo' ] },
				{ name: 'editing', items: [ 'Find', 'Replace', '-', 'SelectAll', '-', 'Scayt' ] },
				{ name: 'forms', items: [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField' ] },
				'/',
				{ name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'CopyFormatting', 'RemoveFormat' ] },
				{ name: 'texttransform', items: [ 'TransformTextToUppercase', 'TransformTextToLowercase', 'TransformTextCapitalize', 'TransformTextSwitcher' ] },
				{ name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language' ] },
				{ name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
				{ name: 'insert', items: [ 'FontAwesome', 'Image', 'Flash', 'Yaqr', 'Youtube', 'VideoDetector', 'Html5video', 'Video', 'Html5audio', 'Iframe', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'EqnEditor', 'PageBreak' ] },
				'/',
				{ name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize', 'lineheight' ] },
				{ name: 'colors', items: [ 'TextColor', 'BGColor' ] },
				{ name: 'tools', items: [ 'Maximize', 'ShowBlocks' ] },
				{ name: 'about', items: [ 'About' ] }
			];
			
			/* Config StylesSet */
			config.stylesSet = [
			    { name : 'Font Seguoe Regular', element : 'span', attributes : { 'class' : 'segui' } },
			    { name : 'Font Seguoe Semibold', element : 'span', attributes : { 'class' : 'seguisb' } },
			    { name:'Italic title', element:'span', styles:{'font-style':'italic'} },
			    { name:'Special Container', element:'div', styles:{'background' : '#eee', 'border' : '1px solid #ccc', 'padding' : '5px 10px'} },
			    { name:'Big', element:'big' },
			    { name:'Small', element:'small' },
			    { name:'Inline ', element:'q' },
			    { name : 'marker', element : 'span', attributes : { 'class' : 'marker' } }
			];
			
			/* Config Wordcount */
			config.wordcount = {
			    // Whether or not you want to show the Paragraphs Count
			    showParagraphs: true,
			    // Whether or not you want to show the Word Count
			    showWordCount: true,
			    // Whether or not you want to show the Char Count
			    showCharCount: true,
			    // Whether or not you want to count Spaces as Chars
			    countSpacesAsChars: false,
			    // Whether or not to include Html chars in the Char Count
			    countHTML: false,
			    // Maximum allowed Word Count, -1 is default for unlimited
			    // maxWordCount: 2000000000,
			    // Maximum allowed Char Count, -1 is default for unlimited
			    // maxCharCount: 2000000000,
			    // Add filter to add or remove element before counting (see CKEDITOR.htmlParser.filter), Default value : null (no filter)
			    filter: new CKEDITOR.htmlParser.filter({
			        elements: {
			            div: function( element ) {
			                if(element.attributes.class == 'mediaembed') {
			                    return false;
			                }
			            }
			        }
			    })
			};
		};
	</script>
	<script type="text/javascript" src="ckfinder/ckfinder.js"></script>

	<!-- My Script -->
	<script src="js/myscript.js"></script>

	<!-- CSS vs JS Upload Multi Picture -->
	<script type="text/javascript" src="plugin/multi-pic/js/jquery.filer.js"></script>
</head>

<body <?=($_GET['act']=="login")?'class="loginbody"':''?> <?php if($source=='map' && ($act=='add' || $act=='edit')) { echo 'onload="load()"';}?>>
	<?php 
		if(isset($_SESSION[$login_name]) && ($_SESSION[$login_name] == true)) 
		{ 
			/* Lưu lại thời gian khi vừa đăng nhập */
			$sql = "UPDATE table_user SET last_login = ".time()." WHERE username = '".$_SESSION['login']['username']."'";
			$d->query($sql); ?>

			<div class="mainwrapper fullwrapper">
				<div class="leftpanel"><?php include _template."menu_tpl.php" ?></div>
				<div class="rightpanel">
					<?php include _template."header_tpl.php" ?>
					<?php if($notice_admin!="") echo "<strong class='notifi-login'>".$notice_admin."</strong>"; ?>
			    	<?php include _template.$template."_tpl.php" ?>
				    <?php include _template."footer_tpl.php" ?>
			    </div>
			</div>
		<?php 
		} 
		else 
		{ 
			/* Giao diện login */
			include _template.$template."_tpl.php" ; 
		} 
	?>
</body>
</html>