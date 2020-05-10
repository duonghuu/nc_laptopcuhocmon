<?php if(!defined('_lib')) die("Error");
function showProduct($v,$options=array(),$k=null){
	global $lang;
	$link = "san-pham/".$v["tenkhongdau"].$v["id"].".html";
	$img = "270x245x2/100/100/0/0/product/"._upload_product_l.$v['photo'];
	$mota = str_replace("\n","<br>",$v['mota'.$lang]);
	$s_gia = "";
	if($v["giagiam"]) {
		$s_gia .= '<p class="price-old-sp">'.number_format($v['gia'],0, ',', '.').'<b>đ</b></p>';
		$s_gia .= '<p class="price-new-sp">'.number_format($v['giagiam'],0, ',', '.').'<b>đ</b></p>';
	}else{
		$s_gia .= '<p class="price-new-sp">'.(($v['gia'])?number_format($v['gia'],0, ',', '.')."<b>đ</b>":_lienhe).'</p>';
	}
	if(($options["slick"])){
		$imgurl='<img src="'.$img.'" alt="'.$v["ten$lang"].'" />';
		$slickdiv = '<div class="slick-box-item">';
		$slickenddiv = '</div>';
	}else{
		$imgurl='<img src="'.$img.'" alt="'.$v["ten$lang"].'" />';
		$slickdiv=$slickenddiv="";
	}
	echo $slickdiv.'<div class="pr-box">
            <a class="sp" href="'.$link.'" title="'.$v["ten$lang"].'">
                <div class="info-sp">
                    <div class="pic-sp scale-img">
                        '.$imgurl.'
                        <div class="desc-sp scroll-maded transition">'.$mota.'</div>
                    </div>
                    <h3 class="name-sp transition">'.$v["ten$lang"].'</h3>
                </div>
                <div class="price-sp">'.$s_gia.'                
                </div>
            </a>
        </div>'.$slickenddiv;
}
/* Begin Kiểm tra dữ liệu nhập vào */
function cleanInput($input)
{
	$search = array(
		'@<script[^>]*?>.*?</script>@si',   // Loại bỏ javascript
		'@<[\/\!]*?[^<>]*?>@si',            // Loại bỏ HTML tags
		'@<style[^>]*?>.*?</style>@siU',    // Loại bỏ style tags
		'@<![\s\S]*?--[ \t\n\r]*>@'         // Loại bỏ multi-line comments
	);
	$output = preg_replace($search, '', $input);
	return $output;
}

function sanitize($input)
{
	if (is_array($input))
	{
		foreach($input as $var=>$val)
		{
			$output[$var] = sanitize($val);
		}
	}
	else
	{
		if (get_magic_quotes_gpc())
		{
			$input = stripslashes($input);
		}
		$input  = cleanInput($input);
		$output = mysql_real_escape_string($input);
	}
	return $output;
}
/* End Kiểm tra dữ liệu nhập vào */

/* Begin hàm kiểm tra đăng nhập khi thao tác */
function check_login()
{
	global $d;
	
	$d->reset();
	$sql = "select * from #_user where quyen ='".$_SESSION['login']['token']."' and hienthi>0";
	$d->query($sql);
	$reuslr_products = $d->result_array();

	if(count($reuslr_products)==1 && $reuslr_products[0]['quyen']!='')
	{
		return true;
	}
	else
	{
		$_SESSION['login']=NULL;
		session_unset();
		return false;
	}
}
/* End hàm kiểm tra đăng nhập khi thao tác */

/* Begin hàm lấy dữ liệu dạng fetch */
function get_fetch_array($sql)
{
	global $d;

	$d->reset();
	$d->query($sql);
	$fetch = $d->fetch_array();
	
	return $fetch;
}
/* End hàm lấy dữ liệu dạng fetch */

/* Begin hàm lấy dữ liệu dạng array */
function get_result_array($sql)
{
	global $d;

	$d->reset();
	$d->query($sql);
	$result = $d->result_array();

	return $result;
}
/* End hàm lấy dữ liệu dạng array */

/* Begin Lấy IP */
function getRealIPAddress()
{
	if(!empty($_SERVER['HTTP_CLIENT_IP']))
	{
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	}
	elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
	{
		$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
	}
	else
	{
		$ip = $_SERVER['REMOTE_ADDR'];
	}
	return $ip;
}
/* End Lấy IP */

/* Mã hóa mật khẩu admin */
function encrypt_password($str,$salt)
{
	return md5('$nina@'.$str.$salt);
}

/* Kiểm tra phân quyền */
function check_access($com='',$act='',$type='')
{
	$str=$com;
	if($act!='')
		$str.='_'.$act;
	if($type!='')
		$str.='_'.$type;

	if(!in_array($str, $_SESSION['list_quyen'])) return true; /* Không tồn tại quyền */
	else return false;
}

/* Kiểm tra phân quyền 2 */
function check_access2($com='',$act='',$arr=array())
{
	$str=$com;
	if($act!='')
		$str.='_'.$act;

	if($arr!=NULL) {
		foreach ($arr as $key => $value) {
			if(!in_array($str."_".$key, $_SESSION['list_quyen'])) return true; /* Không tồn tại quyền */
		}
	}
	return false;
}

/* Kiểm Tra Loại Người Dùng */
function check_access3()
{
	if($_SESSION['login']['id']!=1 && ($_SESSION['login']['username']!='coder' || $_SESSION['login']['password']!='487b60d660404828de12de149518232c'))
		return true;
	else
		return false;
}

/* Kiêm tra loại */
function get_loai_coupon($loai)
{
	if($loai==0) 
	{ 
		$loai="%"; 
	} 
	else if($loai==1) 
	{ 
		$loai="đ"; 
	}
	return $loai;
}

/* Lấy tình trạng của đăng ký nận tin */
function get_tinhtrang_email($tinhtrang,$type)
{
	global $config;
	$loai=='';
	foreach ($config['email_dk'][$type]['tinhtrang'] as $key => $value)
	{
		if($key==$tinhtrang)
		{
			$loai=$value;
			break;
		}
	}
	if($loai=='') $loai="Đang chờ duyệt...";
	return $loai;
}

/* Lấy 2 ký tự cuối của tên */
function split_name($str)
{
	$trim_name=trim($str);
	$arr_name=explode(' ',$trim_name);

	if(count($arr_name)<2) $dk=1;
	else $dk=2;

	for($k=count($arr_name);$k>=count($arr_name)-$dk;$k--)
	{
		if($arr_name[$k]!='')
			$name_exp.=substr(stripUnicode($arr_name[$k]),0,1);
	}
	$name_exp=chunk_split($name_exp,1,",");
	$name_exp=rtrim($name_exp,",");
	$arr_name=explode(',',$name_exp);
	$name_exp='';
	for($u=count($arr_name);$u>=0;$u--)
	{
		if($arr_name[$u]!='')
			$name_exp.=substr(stripUnicode($arr_name[$u]),0,1);
	}
	return $name_exp;
}

/* Lấy httt */
function get_httt($httt)
{
	global $d, $row;
	$d->reset();
	$sql = "select tenvi from #_news where id=$httt";
	$d->query($sql);
	$row=$d->fetch_array();
	return $row['tenvi'];
}

/* Lấy màu cart thumb */
function get_mau_cart_thumb($id)
{
	global $d, $row;
	$sql = "select mau, loaihienthi, thumb, tenvi from #_product_mau where id=$id";
	$d->query($sql);
	$row = $d->fetch_array();
	return $row;
}

/* Lấy tỉnh thành */
function get_tinhthanh($id)
{
	global $d, $row;
	$sql = "select ten from #_tinhthanh where id=$id";
	$d->query($sql);
	$row = $d->fetch_array();
	return $row['ten'];
}

/* Lấy quận huyện */
function get_quanhuyen($id)
{
	global $d, $row;
	$sql = "select ten from #_quanhuyen where id=$id";
	$d->query($sql);
	$row = $d->fetch_array();
	return $row['ten'];
}

/* Lấy phường xã */
function get_phuongxa($id)
{
	global $d, $row;
	$sql = "select ten from #_phuongxa where id=$id";
	$d->query($sql);
	$row = $d->fetch_array();
	return $row['ten'];
}

/* Lấy Logo Form */
function get_logo_form($size)
{
	global $d, $config_url_http;

	$d->reset();
	$sql = "select photo from #_photo where type='logo_form' and act='photo_static'";
	$d->query($sql);
	$logo_mail = $d->fetch_array();

	$str='<a href=""><img src="'.$config_url_http.'upload/photo/'.$size."/".$logo_mail['photo'].'"/></a>';

	return $str;
}

/* Login By Cookie */
function login_by_cookie($iduser)
{
	global $d;
	$cond=true;
	$d->reset();
    $sql = "select * from #_user where id = '".$iduser."' and hienthi='1' and role=1";
    $d->query($sql);
    if($d->num_rows() == 1)
    {
        $row = $d->fetch_array();
        $_SESSION[$login_name][$login_name] = true;
        $_SESSION[$login_name]['id'] = $row['id'];
        $_SESSION[$login_name]['username'] = $row['username'];
        $_SESSION[$login_name]['dienthoai'] = $row['dienthoai'];
        $_SESSION[$login_name]['diachi'] = $row['diachi'];
        $_SESSION[$login_name]['email'] = $row['email'];
        $_SESSION[$login_name]['ten'] = $row['ten'];
        $time_expiry=time()+3600*24*7;
        $iduser=$row['id'];
        setcookie('iduser',$iduser,$time_expiry,'/');
    }
    else
    {
    	$cond=false;
    }
    return $cond;
}

/* Hàm loại bỏ ký tự đặc biệt trong chuỗi */
function remove_plaintext( $string, $keep_image = true, $keep_link = true )
{
	if( $keep_image )
	{
		if( preg_match_all( "/\<img[^\>]*src=\"([^\"]*)\"[^\>]*\>/is", $string, $match ) )
		{
			foreach( $match[0] as $key => $_m )
			{
				$textimg = '';
				if( strpos( $match[1][$key], 'data:image/png;base64' ) === false )
				{
					$textimg = " " . $match[1][$key];
				}
				if( preg_match_all( "/\<img[^\>]*alt=\"([^\"]+)\"[^\>]*\>/is", $_m, $m_alt ) )
				{
					$textimg .= " " . $m_alt[1][0];
				}
				$string = str_replace( $_m, $textimg, $string );
			}
		}
	}
	if( $keep_link )
	{
		if( preg_match_all( "/\<a[^\>]*href=\"([^\"]+)\"[^\>]*\>(.*)\<\/a\>/isU", $string, $match ) )
		{
			foreach( $match[0] as $key => $_m )
			{
				$string = str_replace( $_m, $match[1][$key] . " " . $match[2][$key], $string );
			}
		}
	}
	$string = str_replace( ' ', ' ', strip_tags( $string ) );
	return preg_replace( '/[ ]+/', ' ', $string );
}

/* Lấy Footer Form */
function get_footer_form($col,$lang)
{
	global $d;

	$d->reset();
	$sql = "select $col$lang from #_news_static where type='footer_form'";
	$d->query($sql);
	$footer_form = $d->fetch_array();

	return remove_plaintext($footer_form[$col.$lang]);
}

/* Lấy Mạng Xã Hội Form */
function get_mxh_form()
{
	global $d, $config_url_http;

	$str='';
	$d->reset();
    $sql = "select photo,link from #_photo where type='mangxahoi_form' and hienthi>0 order by stt,id desc";
    $d->query($sql);
    $mangxahoi_form = $d->result_array();

    if(count($mangxahoi_form)>0)
    {
	    $str.='<ul style="margin: 0px;;list-style: none;padding: 0px;">';
		for($i=0;$i<count($mangxahoi_form);$i++) $str.='<li style="display: inline-block;vertical-align: middle;margin-left: 5px;"><a href="'.$mangxahoi_form[$i]['link'].'"><img src="'.$config_url_http.'upload/photo/26x26x1/'.$mangxahoi_form[$i]['photo'].'"></a></li>';
		$str.='</ul>';
	}

	return $str;
}

/* Xử Lý Link Youtube */
function getYoutubeIdFromUrl($url) 
{
    $parts = parse_url($url);
    if (isset($parts['query'])) 
    {
        parse_str($parts['query'], $qs);
        if (isset($qs['v'])) {
            return $qs['v'];
        } else if ($qs['vi']) {
            return $qs['vi'];
        }
    }
    if (isset($parts['path'])) 
    {
        $path = explode('/', trim($parts['path'], '/'));
        return $path[count($path) - 1];
    }
    return false;
}

/* Lấy hình từ google - facebook */
function uploadUrl($url,$savePath,$imageRestrict,$imageSizeRestrcit)
{
	$type_upload = explode(',',$imageRestrict);
	$ext = substr(basename($url),strrpos(basename($url),".")+1);
	$tmp = explode('?',$ext);
	$ext = $tmp[0];
	$name = ChuoiNgauNhien(6);
	$result = "ERROR 1";
	if(!in_array($ext,$type_upload))
	{
	    return 'ERROR 2';
	}
	else
	{
		for($i=0;$i<5;$i++)
		{
	    	$rd.=rand(0,9);
		}
		$fn = $savePath.$rd.$name.'.'.$ext;
		$fp = fopen($fn,"w");
		$noidung = file_get_contents($url);
		fwrite($fp,$noidung,strlen($noidung));
		fclose($fp);
		$result = $rd.$name.'.'.$ext;
	}
	return $result;
}  

function convert_number_to_words($number) 
{
	$hyphen      = ' ';
	$conjunction = '  ';
	$separator   = ' ';
	$negative    = 'âm ';
	$decimal     = ' phẩy ';
	$dictionary  = array(
	0                   => 'Không',
	1                   => 'Một',
	2                   => 'Hai',
	3                   => 'Ba',
	4                   => 'Bốn',
	5                   => 'Năm',
	6                   => 'Sáu',
	7                   => 'Bảy',
	8                   => 'Tám',
	9                   => 'Chín',
	10                  => 'Mười',
	11                  => 'Mười Một',
	12                  => 'Mười Hai',
	13                  => 'Mười Ba',
	14                  => 'Mười Bốn',
	15                  => 'Mười Lăm',
	16                  => 'Mười Sáu',
	17                  => 'Mười Bảy',
	18                  => 'Mười Tám',
	19                  => 'Mười Chín',
	20                  => 'Hai Mươi',
	30                  => 'Ba Mươi',
	40                  => 'Bốn Mươi',
	50                  => 'Năm Mươi',
	60                  => 'Sáu Mươi',
	70                  => 'Bảy Mươi',
	80                  => 'Tám Mươi',
	90                  => 'Chín Mươi',
	100                 => 'Trăm',
	1000                => 'Ngàn',
	1000000             => 'Triệu',
	1000000000          => 'Tỷ',
	1000000000000       => 'Nghìn Tỷ',
	1000000000000000    => 'Ngàn Triệu Triệu',
	1000000000000000000 => 'Tỷ Tỷ'
	);
		 
	if (!is_numeric($number)) 
	{
		return false;
	}
		 
	if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) 
	{
		trigger_error('convert_number_to_words only accepts numbers between -'.PHP_INT_MAX.' and '.PHP_INT_MAX,E_USER_WARNING);
		return false;
	}
		 
	if ($number < 0) 
	{
		return $negative . convert_number_to_words(abs($number));
	}
		 
	$string = $fraction = null;
		 
	if (strpos($number, '.') !== false) 
	{
		list($number, $fraction) = explode('.', $number);
	}
		 
	switch (true) 
	{
		case $number < 21:
			$string = $dictionary[$number];
			break;
		case $number < 100:
			$tens   = ((int) ($number / 10)) * 10;
			$units  = $number % 10;
			$string = $dictionary[$tens];
			if ($units) {
			$string .= $hyphen . $dictionary[$units];
			}
			break;
		case $number < 1000:
			$hundreds  = $number / 100;
			$remainder = $number % 100;
			$string = $dictionary[$hundreds] . ' ' . $dictionary[100];
			if ($remainder) {
			$string .= $conjunction . convert_number_to_words($remainder);
			}
			break;
		default:
			$baseUnit = pow(1000, floor(log($number, 1000)));
			$numBaseUnits = (int) ($number / $baseUnit);
			$remainder = $number % $baseUnit;
			$string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
			if ($remainder) {
			$string .= $remainder < 100 ? $conjunction : $separator;
			$string .= convert_number_to_words($remainder);
			}
			break;
	}
		 
	if (null !== $fraction && is_numeric($fraction)) 
	{
		$string .= $decimal;
		$words = array();
		foreach (str_split((string) $fraction) as $number) 
		{
			$words[] = $dictionary[$number];
		}
		$string .= implode(' ', $words);
	}
	return $string;
}

function create_alias($table, $alias, $id='', $i=0)
{
	global $d;

	if($i==0) $num='';
	else $num = '-'.$i;

	$alias_return = $alias.$num;

	if($id) $andwhere = ' AND id <> '.$id;

	$d->reset();
	$sql = "SELECT alias, id FROM $table WHERE alias = '$alias_return' $andwhere";
	$d->query($sql);
	$item = $d->fetch_array();

	if($item['id'])
		return create_alias($table, $alias, $id, $i+1);
	else return $alias_return;
}

function magic_quote($str, $id_connect=false)	
{	
	if (is_array($str))
	{
		foreach($str as $key => $val)
		{
			$str[$key] = escape_str($val);
		}
		return $str;
	}

	if (is_numeric($str)) 
	{
		return $str;
	}

	if(get_magic_quotes_gpc())
	{
		$str = stripslashes($str);
	}

	if(function_exists('mysql_real_escape_string') AND is_resource($id_connect))
	{
		return mysql_real_escape_string($str, $id_connect);
	}
	elseif (function_exists('mysql_escape_string'))
	{
		return mysql_escape_string($str);
	}
	else
	{
		return addslashes($str);
	}
}

function escape_str($str, $id_connect=false)	
{	
	if (is_array($str))
	{
		foreach($str as $key => $val)
		{
			$str[$key] = escape_str($val);
		}
		return $str;
	}

	if (is_numeric($str)) 
	{
		return $str;
	}

	if(get_magic_quotes_gpc())
	{
		$str = stripslashes($str);
	}

	if (function_exists('mysql_real_escape_string') AND is_resource($id_connect))
	{
		return "'".mysql_real_escape_string($str, $id_connect)."'";
	}
	elseif (function_exists('mysql_escape_string'))
	{
		return "'".mysql_escape_string($str)."'";
	}
	else
	{
		return "'".addslashes($str)."'";
	}
}

function make_date($time,$dot='.',$lang='vi',$f=false)
{
	$str = ($lang == 'vi') ? date("d{$dot}m{$dot}Y",$time) : date("m{$dot}d{$dot}Y",$time);

	if($f)
	{
		$thu['vi'] = array('Chủ nhật','Thứ hai','Thứ ba','Thứ tư','Thứ năm','Thứ sáu','Thứ bảy');
		$thu['en'] = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
		$str = $thu[$lang][date('w',$time)].', '.$str;
	}
	return $str;
}

function alert($s)
{
	echo '<script language="javascript"> alert("'.$s.'") </script>';
}

function delete_file($file)
{
	return @unlink($file);
}

function upload_image($file, $extension, $folder, $newname='')
{
	if(isset($_FILES[$file]) && !$_FILES[$file]['error'])
	{
		$ext = explode('.', $_FILES[$file]['name']);
		$ext = $ext[count($ext)-1];
		$name = basename($_FILES[$file]['name'], '.'.$ext);

		if(strpos($extension, $ext)===false)
		{
			alert('Chỉ hỗ trợ upload file dạng '.$extension);
			return false;
		}

		if($newname=='' && file_exists($folder.$_FILES[$file]['name']))
			for($i=0; $i<100; $i++)
			{
				if(!file_exists($folder.$name.$i.'.'.$ext)){
					$_FILES[$file]['name'] = $name.$i.'.'.$ext;
					break;
				}
			}
		else
		{
			$_FILES[$file]['name'] = $newname.'.'.$ext;
		}

		if (!copy($_FILES[$file]["tmp_name"], $folder.$_FILES[$file]['name']))	
		{
			if ( !move_uploaded_file($_FILES[$file]["tmp_name"], $folder.$_FILES[$file]['name']))	
			{
				return false;
			}
		}
		return $_FILES[$file]['name'];
	}
	return false;
}

function thumb_image($file, $width, $height, $folder)
{	
	if(!file_exists($folder.$file))	return false;

	if($cursize = getimagesize ($folder.$file)) 
	{					
		$newsize = setWidthHeight($cursize[0], $cursize[1], $width, $height);
		$info = pathinfo($file);
		$dst = imagecreatetruecolor ($newsize[0],$newsize[1]);
		$types = array('jpg' => array('imagecreatefromjpeg', 'imagejpeg'),
			'gif' => array('imagecreatefromgif', 'imagegif'),
			'png' => array('imagecreatefrompng', 'imagepng'));
		$func = $types[$info['extension']][0];
		$src = $func($folder.$file); 
		imagecopyresampled($dst, $src, 0, 0, 0, 0,$newsize[0], $newsize[1],$cursize[0], $cursize[1]);
		$func = $types[$info['extension']][1];
		$new_file = str_replace('.'.$info['extension'],'_thumb.'.$info['extension'],$file);
		return $func($dst, $folder.$new_file) ? $new_file : false;
	}
}

function setWidthHeight($width, $height, $maxWidth, $maxHeight)
{
	$ret = array($width, $height);
	$ratio = $width / $height;

	if($width > $maxWidth || $height > $maxHeight) 
	{
		$ret[0] = $maxWidth;
		$ret[1] = $ret[0] / $ratio;

		if($ret[1] > $maxHeight) 
		{
			$ret[1] = $maxHeight;
			$ret[0] = $ret[1] * $ratio;
		}
	}
	return $ret;
}

function transfer($msg, $page="index.html")
{
	$showtext = $msg;
	$page_transfer = $page;
	include("./templates/transfer_tpl.php");
	exit();
}

function redirect($url='')
{
	echo '<script language="javascript">window.location = "'.$url.'" </script>';
	exit();
}

function back($n=1)
{
	echo '<script language="javascript">history.go = "'.-intval($n).'" </script>';
	exit();
}

function chuanhoa($s)
{
	$s = str_replace("'", '&#039;', $s);
	$s = str_replace('"', '&quot;', $s);
	$s = str_replace('<', '&lt;', $s);
	$s = str_replace('>', '&gt;', $s);
	return $s;
}

function unzip_chuanhoa($s)
{
	$s = str_replace('&#039;', "'", $s);
	$s = str_replace('&quot;', '"', $s);
	$s = str_replace('&lt;', '<', $s);
	$s = str_replace('&gt;', '>', $s);
	return $s;
}

function themdau($s)
{
	$s = addslashes($s);
	return $s;
}

function bodau($s)
{
	$s = stripslashes($s);
	return $s;
}

function dump($arr, $exit=1)
{
	echo "<pre>";	
	var_dump($arr);
	echo "<pre>";	
	if($exit)	exit();
}

function paging($r, $url='', $curPg=1, $mxR=5, $mxP=5, $class_paging='')
{
	if($curPg<1) $curPg=1;
	if($mxR<1) $mxR=5;
	if($mxP<1) $mxP=5;

	$totalRows=count($r);

	if($totalRows==0)	
		return array('source'=>NULL, 'paging'=>NULL);

	$totalPages=ceil($totalRows/$mxR);

	if($curPg > $totalPages) $curPg=$totalPages;

	$_SESSION['maxRow']=$mxR;
	$_SESSION['curPage']=$curPg;

	$r2=array();
	$paging="";

	$start=($curPg-1)*$mxR;
	$end=($start+$mxR)<$totalRows?($start+$mxR):$totalRows;
	$j=0;

	for($i=$start;$i<$end;$i++)
		$r2[$j++]=$r[$i];

	$curRow = ($curPg-1)*$mxR+1;	

	if($totalRows>$mxR)
	{
		$start=1;
		$end=1;
		$paging1 ="";
		for($i=1;$i<=$totalPages;$i++)
		{	
			if(($i>((int)(($curPg-1)/$mxP))* $mxP) && ($i<=((int)(($curPg-1)/$mxP+1))* $mxP))
			{
				if($start==1) $start=$i;
				if($i==$curPg)
				{
					$paging1.=" <a class='active'>".$i."</a> "; //dang xem
				} 		  	
				else    
				{
					$paging1 .= " <a href='".$url."&curPage=".$i."'>".$i."</a> ";	
				}
				$end=$i;	
			}
		}
		$paging .=" <a href='".$url."'>"._trangdau."</a> "; //ve dau
		
		$paging .=" <a href='".$url."&curPage=".($curPg-1)."'><</a> "; //ve truoc
		
		$paging.=$paging1; 
		
		$paging .=" <a href='".$url."&curPage=".($curPg+1)."'>></a> "; //ke
		
		$paging .=" <a href='".$url."&curPage=".($totalPages)."'>"._trangcuoi."</a> "; //ve cuoi
	}

	$r3['curPage']=$curPg;
	$r3['source']=$r2;
	$r3['paging']=$paging;
	return $r3;
}

function paging_home($r, $url='', $curPg=1, $mxR=5, $mxP=5, $class_paging='')
{
	if($curPg<1) $curPg=1;
	if($mxR<1) $mxR=5;
	if($mxP<1) $mxP=5;
	$totalRows=count($r);

	if($totalRows==0)	
		return array('source'=>NULL, 'paging'=>NULL);

	$totalPages=ceil($totalRows/$mxR);

	if($curPg > $totalPages) $curPg=$totalPages;

	$_SESSION['maxRow']=$mxR;
	$_SESSION['curPage']=$curPg;

	$r2=array();
	$paging="";

	$start=($curPg-1)*$mxR;		
	$end=($start+$mxR)<$totalRows?($start+$mxR):$totalRows;
	$j=0;
	
	for($i=$start;$i<$end;$i++)
		$r2[$j++]=$r[$i];
	
	$curRow = ($curPg-1)*$mxR+1;	

	if($totalRows>$mxR)
	{
		$from = $curPg - $mxP;	
		$to = $curPg + $mxP;
		if ($from <=0) { $from = 1;   $to = $mxP*2; }
		if ($to > $totalPages) { $to = $totalPages; }
		for($j = $from; $j <= $to; $j++) 
		{
			if ($j == $curPg) $links = $links . "<li class='active'><a data-ajax='false' href=\"#\" title=''>{$j}</a></li>";		
			else
			{				
				$qt = $url. "&p={$j}";
				$links= $links . "<li><a data-ajax='false' title=\""._page." {$j}\" href='{$qt}'>{$j}</a></li>";
			}
		}
		if($curPg==1 || $curPg < 0)
		{
			$paging .="<li class='disabled'><span title=''>"._trangdau."</span></li>"; //ve dau				
			$paging .="<li class='disabled'><span title=''><</span></li>"; //ve truoc
		}
		else
		{
			$paging .="<li><a data-ajax='false' href='".$url."' title=''>"._trangdau."</a></li>"; //ve dau				
			$paging .="<li><a data-ajax='false' href='".$url."&p=".($curPg-1)."' title=''><</a></li>"; //ve truoc
		}
		$paging.=$links; 
		if($curPg == $totalPages || $curPg > $totalPages)
		{
			$paging .="<li class='disabled'><span title=''>></span></li>"; //ke
			$paging .="<li class='disabled'><span title=''>"._trangcuoi."</span></li>"; //ve cuoi
		}
		else
		{
			$paging .="<li><a data-ajax='false' href='".$url."&p=".($curPg+1)."' title=''>></a></li>"; //ke				
			$paging .="<li><a data-ajax='false' href='".$url."&p=".($totalPages)."' title=''>"._trangcuoi."</a></li>"; //ve cuoi
		}
	}		
	$r3['curPage']=$curPg;
	$r3['source']=$r2;
	$r3['paging']=$paging;			
	$r3['totalRows']=$totalRows;
	return $r3;
}

function truncateString($str, $chars, $replacement="...") 
{
	if(strlen($str)<$chars)
		return $str;
	else
	{
		$str = substr($str, 0, $chars);
		$space_pos = strrpos($str,' ');
		$str = substr($str, 0, $space_pos);
	}	
	return $str.' '.$replacement;	
}

function catchuoi($chuoi,$gioihan)
{
	if(strlen($chuoi)<=$gioihan)
	{
		return $chuoi;
	}
	else
	{
		if(strpos($chuoi," ",$gioihan) > $gioihan)
		{
			$new_gioihan=strpos($chuoi," ",$gioihan);
			$new_chuoi = substr($chuoi,0,$new_gioihan)."...";
			return $new_chuoi;
		}
		$new_chuoi = substr($chuoi,0,$gioihan)."...";
		return $new_chuoi;
	}
}

function stripUnicode($str)
{
	if(!$str) return false;
	$unicode = array(
		'a'=>'á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ',
		'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
		'd'=>'đ',
		'D'=>'Đ',
		'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
		'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
		'i'=>'í|ì|ỉ|ĩ|ị',	  
		'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
		'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
		'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
		'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
		'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
		'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
		'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ'
	);
	foreach($unicode as $khongdau=>$codau) 
	{
		$arr=explode("|",$codau);
		$str = str_replace($arr,$khongdau,$str);
	}
	return $str;
}

function changeTitle($str)
{
	$str = stripUnicode($str);
	$str = mb_convert_case($str,MB_CASE_LOWER,'utf-8');
	$str = trim($str);
	$str=preg_replace('/[^a-zA-Z0-9\ ]/','',$str); 
	$str = str_replace("  "," ",$str);
	$str = str_replace(" ","-",$str);
	return $str;
}

function curPageURL()
{
	$pageURL = 'http';
	if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
	$pageURL .= "://";
	if ($_SERVER["SERVER_PORT"] != "80") 
	{
		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	} 
	else 
	{
		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	}
	return $pageURL;
}

function getCurrentPageURL() 
{
	$pageURL = 'http';
	if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
	$pageURL .= "://";
	if ($_SERVER["SERVER_PORT"] != "80") 
	{
		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	} else {
		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	}
	$pageURL = explode("&p=", $pageURL);
	return $pageURL[0];
}

function create_thumb($file, $width, $height, $folder,$file_name,$zoom_crop='1')
{
	$new_width   = $width;
	$new_height   = $height;

	if($new_width && !$new_height) 
	{
		$new_height = floor ($height * ($new_width / $width));
	} 
	else if($new_height && !$new_width) 
	{
		$new_width = floor ($width * ($new_height / $height));
	}

	$image_url = $folder.$file;
	$origin_x = 0;
	$origin_y = 0;

	$array = getimagesize($image_url);

	if($array)
	{
		list($image_w, $image_h) = $array;
	}
	else
	{
		die("NO IMAGE $image_url");
	}

	$width=$image_w;
	$height=$image_h;
	$image_ext = explode('.', $image_url);
	$image_ext = trim(strtolower($image_ext[count($image_ext)-1]));

	switch(strtoupper($image_ext))
	{
		case 'JPG' :
		case 'JPEG' :
		$image = imagecreatefromjpeg($image_url);
		$func='imagejpeg';
		break;

		case 'PNG' :
		$image = imagecreatefrompng($image_url);
		$func='imagepng';
		break;

		case 'GIF' :
		$image = imagecreatefromgif($image_url);
		$func='imagegif';
		break;

		default : die("UNKNOWN IMAGE TYPE: $image_url");
	}

	if($zoom_crop == 3) 
	{
		$final_height = $height * ($new_width / $width);
		if ($final_height > $new_height) 
		{
			$new_width = $width * ($new_height / $height);
		} 
		else 
		{
			$new_height = $final_height;
		}
	}
	$canvas = imagecreatetruecolor ($new_width, $new_height);
	imagealphablending ($canvas, false);
	$color = imagecolorallocatealpha ($canvas, 255, 255, 255, 127);
	imagefill ($canvas, 0, 0, $color);
	
	if($zoom_crop == 2) 
	{
		$final_height = $height * ($new_width / $width);
		if ($final_height > $new_height) 
		{
			$origin_x = $new_width / 2;
			$new_width = $width * ($new_height / $height);
			$origin_x = round ($origin_x - ($new_width / 2));
		} 
		else 
		{
			$origin_y = $new_height / 2;
			$new_height = $final_height;
			$origin_y = round ($origin_y - ($new_height / 2));
		}
	}

	imagesavealpha ($canvas, true);
	if($zoom_crop > 0) 
	{
		$src_x = $src_y = 0;
		$src_w = $width;
		$src_h = $height;
		$cmp_x = $width / $new_width;
		$cmp_y = $height / $new_height;

		if($cmp_x > $cmp_y) 
		{
			$src_w = round ($width / $cmp_x * $cmp_y);
			$src_x = round (($width - ($width / $cmp_x * $cmp_y)) / 2);
		} 
		else if($cmp_y > $cmp_x) 
		{
			$src_h = round ($height / $cmp_y * $cmp_x);
			$src_y = round (($height - ($height / $cmp_y * $cmp_x)) / 2);
		}

		if($align) 
		{
			if (strpos ($align, 't') !== false) 
			{
				$src_y = 0;
			}
			if (strpos ($align, 'b') !== false) 
			{
				$src_y = $height - $src_h;
			}
			if (strpos ($align, 'l') !== false) 
			{
				$src_x = 0;
			}
			if (strpos ($align, 'r') !== false) 
			{
				$src_x = $width - $src_w;
			}
		}
		imagecopyresampled ($canvas, $image, $origin_x, $origin_y, $src_x, $src_y, $new_width, $new_height, $src_w, $src_h);
	} 
	else 
	{
		imagecopyresampled ($canvas, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
	}

	$new_file=$file_name.'_'.$new_width.'x'.$new_height.'.'.$image_ext;
	if($func=='imagejpeg') $func($canvas, $folder.$new_file,100);
	else $func($canvas, $folder.$new_file,floor ($quality * 0.09));
	return $new_file;
}

function ChuoiNgauNhien($sokytu)
{
	$chuoi="ABCDEFGHIJKLMNOPQRSTUVWXYZWabcdefghijklmnopqrstuvwxyzw0123456789";
	for ($i=0; $i < $sokytu; $i++)
	{
		$vitri = mt_rand( 0 ,strlen($chuoi) );
		$giatri= $giatri . substr($chuoi,$vitri,1 );
	}
	return $giatri;
} 

function showDigits($digits='00000')
{
	$ret = "";
	$digits = str_split($digits);
	foreach($digits as $digit)
	{
		$ret .= '<img src="images/counter/'.$digit.'.jpg" align="absmiddle" />';
	}
	return $ret;
}

function _substr($str,$n)
{
	if(strlen($str)<$n) return $str;
	$html = substr($str,0,$n);
	$html = substr($html,0,strrpos($html,' '));
	return $html.'...';
}
?>