<?php
	session_start();
    date_default_timezone_set('Asia/Ho_Chi_Minh'); //Set múi giờ mặc định
	@define ( '_lib' , './lib/');
	include_once _lib."config.php";
	include_once _lib."constant.php";
	include_once _lib."functions.php";
	include_once _lib."library.php";
	include_once _lib."class.database.php";	
	
	$login_name = $config_url_http;
	
	if((!isset($_SESSION[$login_name]) || $_SESSION[$login_name]==false) && $act!="login"){
		redirect("index.php?com=user&act=login");
	}
	
	$d = new database($config['database']);
	$d->reset();

	/* Kiểm tra id */
	$id_order= intval($_GET['id']);
	if($id_order<=0){
		transfer("Không có dữ liệu","index.php?com=order&act=man");
		exit();
	}

	/* Lấy đơn hàng */
	$sql="select * from #_donhang where id='$id_order'";
	$d->query($sql);
	$row_detail=$d->fetch_array();
	if($row_detail==null){
		transfer("Dữ liệu không có thực hoặc đã xóa","index.php?com=order&act=man");
		exit();
	}

	/* Lấy thông tin công ty */
	$sql = "select * from #_setting limit 0,1";
	$d->query($sql);
	$row_setting= $d->fetch_array();

	/* Lấy ngày */
	$now = time();
	$ngay = "Ngày ".date("d",$now)." Tháng ".date("m",$now)." Năm ".date("Y",$now);

	/* Khởi tạo PHPWord */
	require_once 'PHPWord.php';
	$PHPWord = new PHPWord();

	/* Load file Word mẫu */
	$document = $PHPWord->loadTemplate('donhang.docx');

	/* Thiết lập thông tin công ty */
	$document->setValue('{tencty}', $row_setting["tenvi"]);
	$document->setValue('{diachicty}', $row_setting["diachi"]);
	$document->setValue('{ngayht}', $ngay);

	/* Thiết lập thông tin khách hàng */
	$document->setValue('{hotenkh}', $row_detail["hoten"]);
	$document->setValue('{dienthoaikh}', $row_detail["dienthoai"]);
	$document->setValue('{emailkh}', $row_detail["email"]);
	$document->setValue('{diachikh}', $row_detail["diachi"]);
	$document->setValue('{noidungkh}', $row_detail["noidung"]);

	/* Lấy ra chi tiết đơn hàng */
	$sql="select * from #_donhang_detail where id_order=".$id_order;
	$d->query($sql);
	$row_order = $d->result_array();

	$data = array();
	$total_price = 0;
	$total_price_giam = 0;
	$total_count = 0;

	for ($i=0,$count=count($row_order); $i < $count; $i++) 
	{ 
		$data["stt"][$i] = $i+1;
		$data["name"][$i] = $row_order[$i]["ten"];
		$data["mau"][$i] = $row_order[$i]["mau"];
		$data["size"][$i] = $row_order[$i]["size"];
		$data["soluong"][$i] = $row_order[$i]["soluong"];
		
		/* Giá dùng để tính toán */
		$gia = $row_order[$i]["gia"]*$data["soluong"][$i];
		$giagiam = $row_order[$i]["giagiam"]*$data["soluong"][$i];
		
		/* Giá dùng để hiển thị trên template */
		$data["gia"][$i] = number_format($gia);
		$data["giagiam"][$i] = number_format($giagiam);

		/* Kiểm tra nếu Giám giảm = 0 => Giám giảm = Giá gốc */
		$giagiam = ($giagiam==0)?$gia:$giagiam;
		
		/* Tổng giá */
		$total_count += $data["soluong"][$i];
		$total_price += $gia;
		$total_price_giam += $giagiam;
	}

	/* Tính tổng giá, tổng giá giảm, tổng giá khi ưu đãi */
	$total_price_final=$total_price+$row_detail['phiship'];
	$total_price_giam_final=$total_price_giam+$row_detail['phiship'];
	$total_price_uudai_final=$row_detail['phicoupon'];

	/* Thiết lập đối tượng dữ liệu từng dòng */
	$document->cloneRow('TB', $data);

	/* Thiết lập biến dữ liệu */
	$document->setValue('{tongsolg}', number_format($total_count));
	$document->setValue('{congtien}', number_format($total_price));
	$document->setValue('{congtienkm}', number_format($total_price_giam));
	$document->setValue('{thanhtien}', number_format($total_price_final));
	$document->setValue('{thanhtien_giam}', number_format($total_price_giam_final));
	$document->setValue('{phiship}', number_format($row_detail['phiship']));
	$document->setValue('{phicoupon}', number_format($row_detail['phicoupon']));
	$document->setValue('{tongtienchu}', convert_number_to_words(($total_price_uudai_final==0)?(($total_price_giam_final==0)?$total_price_final:$total_price_giam_final):$total_price_uudai_final));
	
	/* Lưu file */
	$filename = "Don_Hang_".date('dmY').".docx";
	$document->save($filename);
	header('Content-Description: File Transfer');
	header('Content-Type: application/octet-stream');
	header('Content-Disposition: attachment; filename='.$filename);
	header('Content-Transfer-Encoding: binary');
	header('Expires: 0');
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	header('Pragma: public');
	header('Content-Length: '. filesize($filename));
	flush();
	readfile($filename);
	unlink($filename);
?>