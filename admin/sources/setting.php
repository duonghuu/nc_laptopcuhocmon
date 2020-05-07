<?php	if(!defined('_source')) die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";

switch($act)
{
	case "capnhat":
		get_setting();
		$template = "setting/man/item_add";
		break;
	case "save":
		save_setting();
		break;
		
	default:
		$template = "index";
}

function get_setting()
{
	global $d, $item;

	$sql = "select * from #_setting where id='18'";
	$d->query($sql);
	$item = $d->fetch_array();
}

function save_setting()
{
	global $d, $config;
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=setting&act=capnhat");

	foreach($config['lang'] as $key => $value) 
	{
		$data['ten'.$key] = magic_quote($_POST['ten'.$key]);
		$data['mota'.$key] = magic_quote($_POST['mota'.$key]);
		$data['noidung'.$key] = magic_quote($_POST['noidung'.$key]);
	}
	$data['tenkhongdau'] = changeTitle(magic_quote($_POST['tenvi']));
	$data['ip_host'] = magic_quote($_POST['ip_host']);
	$data['email_host'] = magic_quote($_POST['email_host']);
	$data['password_host'] = magic_quote($_POST['password_host']);
	$data['seo_h1'] = magic_quote($_POST['seo_h1']);
	$data['seo_h2'] = magic_quote($_POST['seo_h2']);
	$data['seo_h3'] = magic_quote($_POST['seo_h3']);
	$data['seo_h4'] = magic_quote($_POST['seo_h4']);
	$data['seo_h5'] = magic_quote($_POST['seo_h5']);
	$data['seo_h6'] = magic_quote($_POST['seo_h6']);
	$data['title'] = magic_quote($_POST['title']);
	$data['keywords'] = magic_quote($_POST['keywords']);
	$data['description'] = magic_quote($_POST['description']);
	$data['lang_default'] = (isset($_POST['lang_default']))?magic_quote($_POST['lang_default']):'vi';
	$data['hotline'] = magic_quote($_POST['hotline']);
	$data['dienthoai'] = magic_quote($_POST['dienthoai']);
	$data['email'] = magic_quote($_POST['email']);
	$data['diachi'] = magic_quote($_POST['diachi']);
	$data['copyright'] = magic_quote($_POST['copyright']);
	$data['toado'] = magic_quote($_POST['toado']);
	$data['fax'] = magic_quote($_POST['fax']);
	$data['slogan'] = magic_quote($_POST['slogan']);
	$data['zalo'] = magic_quote($_POST['zalo']);
	$data['oaidzalo'] = magic_quote($_POST['oaidzalo']);
	$data['viber'] = magic_quote($_POST['viber']);
	$data['skype'] = magic_quote($_POST['skype']);
	$data['facebook'] = magic_quote($_POST['facebook']);
	$data['youtube'] = magic_quote($_POST['youtube']);
	$data['twitter'] = magic_quote($_POST['twitter']);
	$data['pinterest'] = magic_quote($_POST['pinterest']);
	$data['website'] = magic_quote($_POST['website']);
	$data['vchat'] = magic_quote($_POST['vchat']);
	$data['analytics'] = magic_quote($_POST['analytics']);
	$data['mastertool'] = magic_quote($_POST['mastertool']);
	$data['headjs'] = magic_quote($_POST['headjs']);
	$data['bodyjs'] = magic_quote($_POST['bodyjs']);
	$data['toado_iframe'] = magic_quote($_POST['toado_iframe']);
	$data['fanpage'] = magic_quote($_POST['fanpage']);
	$data['fanpage_google'] = magic_quote($_POST['fanpage_google']);
	
	$d->reset();
	$d->setTable('setting');
	$d->setWhere('id',18);
	if($d->update($data)) redirect("index.php?com=setting&act=capnhat");
	else transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=setting&act=capnhat");
}
?>