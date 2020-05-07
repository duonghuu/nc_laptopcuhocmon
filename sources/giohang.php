<?php
	if(!defined('_source')) die("Error");		

	$title_bar = _giohang;

	/* Crumbtrail */
	$crumbtrail="<li><a class='crumbtrail_lst' title='".$title_crumb."'>".$title_crumb."</a></li>";

	$d->reset();
	$sql = "select ten,id from #_tinhthanh order by id asc";
	$d->query($sql);
	$tinhthanh=$d->result_array();

	$d->reset();
	$sql = "select ten$lang, mota$lang, tenkhongdau, id from #_news where type='hinh-thuc-thanh-toan' order by stt,id desc";
	$d->query($sql);
	$httt=$d->result_array();

	if($_REQUEST['coupon']=='coupon')
	{
		$code_coupon=$_POST['code-coupon'];

		$d->reset();
		$sql = "select * from #_coupon where ma='".$code_coupon."'";
		$d->query($sql);
		$coupon = $d->fetch_array();

		if($coupon['ngayketthuc']<time())
		{
			transfer( "Mã ưu đãi đã hết hạng ! <br> Vui lòng liên hệ với chúng tôi.","gio-hang.html");
		}

		if($coupon['tinhtrang']!=0)
		{
			transfer( "Mã ưu đãi đã được sử dụng hoặc không tồn tại !","gio-hang.html");
		}

		$_SESSION['coupon']['id']=$coupon['id'];
		$_SESSION['coupon']['price']=$coupon['phantram'];
		$_SESSION['coupon']['loai']=$coupon['loai'];
		$_SESSION['coupon']['total'] = get_total_price_coupon(get_order_total());
	}

	if(isset($_POST['thanhtoan']))
	{
		$hoten=magic_quote($_POST['ten']);
		$dienthoai=magic_quote($_POST['dienthoai']);
		$diachi=magic_quote($_POST['diachi']);
		$email=magic_quote($_POST['email']);
		$noidung=magic_quote($_POST['noidung']);
		$tinhthanh=get_tinhthanh($_POST['tinhthanh']);
		$quanhuyen=get_quanhuyen($_POST['quanhuyen']);
		$phuongxa=get_phuongxa($_POST['phuongxa']);
		$phiship=(int)$_POST['price-transport'];
		$phiuudai=(int)$_POST['price-coupon'];
		$httt=(int)$_POST['httt'];
		
		$hoten=trim(strip_tags($hoten));
		$dienthoai=trim(strip_tags($dienthoai));	
		$diachi=trim(strip_tags($diachi.', '.$phuongxa.', '.$quanhuyen.', '.$tinhthanh));	
		$email=trim(strip_tags($email));	
		$noidung=trim(strip_tags($noidung));	
		
		$body_thanhtoan.='<table width="100%" style="background: rgba(238, 238, 238, 0.4);margin-bottom: 10px;border: 1px solid #ddd;" class="table table-bordered table-cart">';
		if(is_array($_SESSION['cart']))
		{
			$body_thanhtoan.=
				'<thead><tr>
					<td style="border: 1px solid #ddd;padding: 8px;background: rgba(238, 238, 238, 0.4)" align="center" width="20%">Hình</td>
					<td style="border: 1px solid #ddd;padding: 8px;background: rgba(238, 238, 238, 0.4)" align="center" width="30%">Sản phẩm</td>
					<td style="border: 1px solid #ddd;padding: 8px;background: rgba(238, 238, 238, 0.4)" align="center">Giá</td>
					<td style="border: 1px solid #ddd;padding: 8px;background: rgba(238, 238, 238, 0.4)" align="center">Số lượng</td>
					<td style="border: 1px solid #ddd;padding: 8px;background: rgba(238, 238, 238, 0.4)" align="center">Thành tiền</td>
				</tr></thead>';
			$max=count($_SESSION['cart']);
			for($i=0;$i<$max;$i++)
			{
				$pid=$_SESSION['cart'][$i]['productid'];
				$q=$_SESSION['cart'][$i]['qty'];					
				$mau=$_SESSION['cart'][$i]['mau'];					
				$size=$_SESSION['cart'][$i]['size'];					
				$proinfo = get_product_info($pid);
				$pmau=get_product_mau($mau);
				$psize=get_product_size($size);
				$s_m='';
				if($pmau!=''&&$psize!='') $s_m=$pmau." - ".$psize;
				else if($pmau!='') $s_m=$pmau;
				else if($psize!='') $s_m=$psize;
				if($q==0) continue;
				
				$body_thanhtoan.='<tr><td style="border: 1px solid #ddd;" align="center"><img style="margin: auto;" src="'.$config_url_http."upload/product/".$proinfo['photo'].'" width="100" height="100"></td>';				
				
				if($s_m!='')
					$body_thanhtoan.='<td style="border: 1px solid #ddd;" align="center"><a style="text-decoration: none;" href="'.$config_url_http.$proinfo['type'].'/'.$proinfo['tenkhongdau'].'-'.$proinfo['id'].'.html" target="_blank">'.$proinfo['ten'.$lang].'</a><br/><div style="font-size: 12px;margin: 5px 0px;text-align: left;padding: 0px 10px;">'.str_replace("\n","<br/>",$proinfo['khuyenmai'.$lang]).'</div><b>Màu - Size:</b> '.$s_m.'</td>';
				else
					$body_thanhtoan.='<td style="border: 1px solid #ddd;" align="center"><a style="text-decoration: none;" href="'.$config_url_http.$proinfo['type'].'/'.$proinfo['tenkhongdau'].'-'.$proinfo['id'].'.html" target="_blank">'.$proinfo['ten'.$lang].'</a><br/><div style="font-size: 12px;margin: 5px 0px;text-align: left;padding: 0px 10px;">'.str_replace("\n","<br/>",$proinfo['khuyenmai'.$lang]).'</div></td>';
				
				if(check_price($pid)) 
				{
					$body_thanhtoan.='<td style="border: 1px solid #ddd;" align="center"><p style="background: transparent;border: 0px;color: red;font-size: 14px;">'.number_format(get_price_km($pid),0, ',', '.').'đ</p>';
					$body_thanhtoan.='<p style="background: transparent;border: 0px;color: gray; text-decoration: line-through;">'.number_format(get_price($pid),0, ',', '.').'đ</p></td>';
				} 
				else 
				{
					$body_thanhtoan.='<td style="border: 1px solid #ddd;" align="center"><p style="background: transparent;border: 0px;color: red;font-size: 14px;">'.number_format(get_price($pid),0, ',', '.').'đ</p></td>';
				}
				
				$body_thanhtoan.='<td style="border: 1px solid #ddd;" align="center">'.$q.'</td>';
				
				if(check_price($pid)) 
				{
					$body_thanhtoan.='<td style="border: 1px solid #ddd;" align="center"><p style="background: transparent;border: 0px;color: red;font-size: 14px;">'.number_format(get_price_km($pid)*$q,0, ',', '.').'đ</p>';
					$body_thanhtoan.='<p style="background: transparent;border: 0px;color: gray; text-decoration: line-through;">'.number_format(get_price($pid)*$q,0, ',', '.').'đ</p></td></tr>';
				} else 
				{
					$body_thanhtoan.='<td style="border: 1px solid #ddd;" align="center"><p style="background: transparent;border: 0px;color: red;font-size: 14px;">'.number_format(get_price($pid)*$q,0, ',', '.').'đ</p></td></tr>';
				}
			}
			if($phiship!=0 && $_SESSION['coupon']['id']==0)
			{
				$body_thanhtoan.='<tr><td style="border: 1px solid #ddd;text-align:right" colspan="5"><strong>Phí vận chuyển:</strong> <strong style="color: red">'.number_format($phiship,0, ',', '.').'đ<strong></td></tr>';
				$body_thanhtoan.='<tr><td style="border: 1px solid #ddd;text-align:right" colspan="5"><strong>Tổng tiền:</strong> <strong style="color: gray; text-decoration: line-through;">'.number_format(get_order_total(),0, ',', '.').'đ<strong></td></tr>';
				$body_thanhtoan.='<tr><td style="border: 1px solid #ddd;text-align:right" colspan="5"><strong>Tổng tiền + Phí vận chuyển:</strong> <strong style="color: red">'.number_format((int)$_POST['price-final'],0, ',', '.').'đ<strong></td></tr>';
			}
			else if($phiship!=0 && $_SESSION['coupon']['id']!=0)
			{
				$body_thanhtoan.='<tr><td style="border: 1px solid #ddd;text-align:right" colspan="5"><strong>Phí vận chuyển:</strong> <strong style="color: red">'.number_format($phiship,0, ',', '.').'đ<strong></td></tr>';
				$body_thanhtoan.='<tr><td style="border: 1px solid #ddd;text-align:right;" colspan="5"><strong>Tổng tiền + Phí vận chuyển:</strong> <strong style="color: gray; text-decoration: line-through;">'.number_format((int)$_POST['price-final'],0, ',', '.').'đ<strong></td></tr>';
				$body_thanhtoan.='<tr><td style="border: 1px solid #ddd;text-align:right" colspan="5"><strong>Tổng tiền <span style="color:red">(-'.get_price_coupon().' Ưu Đãi)</span>:</strong> <strong style="color: red">'.number_format($phiuudai,0, ',', '.').'đ<strong></td></tr>';
			}
			else if($phiship==0 && $_SESSION['coupon']['id']!=0)
			{
				$body_thanhtoan.='<tr><td style="border: 1px solid #ddd;text-align:right" colspan="5"><strong>Tổng tiền:</strong> <strong style="color: gray; text-decoration: line-through;">'.number_format((int)$_POST['price-final'],0, ',', '.').'đ<strong></td></tr>';
				$body_thanhtoan.='<tr><td style="border: 1px solid #ddd;text-align:right" colspan="5"><strong>Tổng tiền <span style="color:red">(-'.get_price_coupon().' Ưu Đãi)</span>:</strong> <strong style="color: red">'.number_format($_SESSION['coupon']['total'],0, ',', '.').'đ<strong></td></tr>';
			}
			else
			{
				$body_thanhtoan.='<tr><td style="border: 1px solid #ddd;text-align: right;background: rgba(238, 238, 238, 0.4);" colspan="5"><strong>Tổng tiền:</strong> <strong style="color: red">'.number_format(get_order_total(),0, ',', '.').'đ<strong></td></tr>';
			}
		}
		else
		{
			$body_thanhtoan.='<tr><td style="border: 1px solid #ddd;">'._khongtimthayketqua.' !</td></tr>';
		}
		$body_thanhtoan.='</table>';

		$mahoadon=strtoupper(ChuoiNgauNhien(6));
		$ngaydangky=time();
		$tonggia=((int)$_POST['price-final']=='')?get_order_total():(int)$_POST['price-final'];
		$loaicoupon=$_SESSION['coupon']['loai'];
		$phantramcoupon=$_SESSION['coupon']['price'];
		$phicoupon=($phiship!=0)?$phiuudai:$_SESSION['coupon']['total'];
		$id_user=$_SESSION[$login_name]['id'];

		/* Begin lưu đơn hàng */
		$d->reset();
		$data_donhang['id_user'] = $id_user;
		$data_donhang['madonhang'] = $mahoadon;
		$data_donhang['hinhdaidien'] = $phinh;
		$data_donhang['hoten'] = $hoten;
		$data_donhang['dienthoai'] = $dienthoai;
		$data_donhang['diachi'] = $diachi;
		$data_donhang['email'] = $email;
		$data_donhang['httt'] = $httt;
		$data_donhang['phiship'] = $phiship;
		$data_donhang['phicoupon'] = $phicoupon;
		$data_donhang['loaicoupon'] = $loaicoupon;
		$data_donhang['phantramcoupon'] = $phantramcoupon;
		$data_donhang['tonggia'] = $tonggia;
		$data_donhang['noidung'] = $noidung;
		$data_donhang['donhang'] = $body_thanhtoan;
		$data_donhang['ngaytao'] = $ngaydangky;
		$data_donhang['tinhtrang'] = 1;
		$data_donhang['tinhthanh'] = $tinhthanh;
		$data_donhang['quanhuyen'] = $quanhuyen;
		$d->setTable('donhang');
		$d->insert($data_donhang);
		/* End lưu đơn hàng */

		/* Begin lưu đơn hàng chi tiết */
		$id_order = mysql_insert_id();

		for($i=0;$i<$max;$i++)
		{
			$pid = $_SESSION['cart'][$i]['productid'];
			$q = $_SESSION['cart'][$i]['qty'];
			$proinfo = get_product_info($pid);
			$gia = get_price($pid);
			$giagiam =get_price_km($pid);
			$mau=get_product_mau($_SESSION['cart'][$i]['mau']);
			$size=get_product_size($_SESSION['cart'][$i]['size']);
			
			if($q==0) continue;

			$d->reset();
			$data_donhangchitiet['id_product'] = $pid;
			$data_donhangchitiet['id_order'] = $id_order;
			$data_donhangchitiet['ten'] = $proinfo['ten'.$lang];
			$data_donhangchitiet['mau'] = $mau;
			$data_donhangchitiet['size'] = $size;
			$data_donhangchitiet['gia'] = $gia;
			$data_donhangchitiet['giagiam'] = $giagiam;
			$data_donhangchitiet['soluong'] = $q;
			$d->setTable('donhang_detail');
			$d->insert($data_donhangchitiet);
		}
		/* End lưu đơn hàng chi tiết */

		/* Begin Nội Dung Email Gửi */
			/* Begin Section: Header */
			$body='<table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-spacing: 0; border-collapse: collapse;font-size: 13px;max-width: 650px;margin: auto;word-break: break-all;">';
			$body.='<tbody>';
			$body.='<tr style="background: '.$config_background.';color: #fff;">';
				$body.='<td style="padding: 10px;">'.get_logo_form($config_size_logo).'</td>';
				$body.='<td style="text-align: right;padding: 10px;">';
					$body.='<p style="margin: 0px;">Hotline:<span style="margin-left: 5px;color: '.$config_color.';font-weight: bold;">'.$row_setting['hotline'].'</span></p>';
					$body.='<p style="margin: 0px;margin-top: 2px;margin-bottom: 6px;">Hỗ trợ:<span style="margin-left: 5px;color: '.$config_color.';font-weight: bold;">'.$row_setting['email'].'</span></p>';
					if($config_mxh) $body.=get_mxh_form();
				$body.='</td>';
			$body.='</tr>';
			$body.='</tbody>';
			$body.='</table>';
			/* End Section: Header */

			/* Begin Section: Content */
			$body.='<table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-spacing: 0;border-collapse: collapse;font-size: 13px;margin: 10px auto;border: 1px dashed #ccc;background: rgba(238, 238, 238, 0.4);word-break: break-all;">';
			$body.='<tbody>';
			$body.='<tr><td style="padding: 15px 10px;">';
				$body.='<div style="line-height: 20px;">';
					$body.='<p><span style="font-weight: bold; margin-right: 10px;">Họ tên:</span>'.$hoten.'</p>';
					$body.='<p><span style="font-weight: bold; margin-right: 10px;">Địa chỉ:</span>'.$diachi.'</p>';
					$body.='<p><span style="font-weight: bold; margin-right: 10px;">Tỉnh thành:</span>'.$tinhthanh.'</p>';
					$body.='<p><span style="font-weight: bold; margin-right: 10px;">Quận huyện:</span>'.$quanhuyen.'</p>';
					$body.='<p><span style="font-weight: bold; margin-right: 10px;">Phường xã:</span>'.$phuongxa.'</p>';
					$body.='<p><span style="font-weight: bold; margin-right: 10px;">Điện thoại:</span>'.$dienthoai.'</p>';
					$body.='<p><span style="font-weight: bold; margin-right: 10px;">Email:</span>'.$email.'</p>';
					$body.='<p><span style="font-weight: bold; margin-right: 10px;">Yêu cầu khác:</span>'.$noidung.'</p>';
				$body.='</div>';
			$body.='</td></tr>';
			$body.='</tbody>';
			$body.='</table>';
			/* End Section: Content */

			/* Begin Section: Đơn Hàng */
			$body.=$body_thanhtoan;
			/* End Section: Đơn Hàng */

			/* Begin Section: Footer */
			$body.='<table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-spacing: 0;border-collapse: collapse;font-size: 13px;max-width: 650px;margin: auto;border-top: 1px solid #e0e0e0;word-break: break-all;">';
			$body.='<tbody>';
			$body.='<tr><td style="text-align: center;font-weight: bold;font-size: 17px;padding-top: 15px;color: #313131;">'.get_footer_form('ten','vi').'</td></tr>';
			$body.='<tr><td style="padding: 0px 10px;padding-top: 5px;line-height: 20px;text-align: center;font-size: 13px;">'.get_footer_form('noidung','vi').'</td></tr>';
			$body.='</tbody>';
			$body.='</table>';
			/* End Section: Footer */
		/* End Nội Dung Email Gửi */

		// Khởi tạo đối tượng
		include_once "phpmailer/class.phpmailer.php";
		$mail = new PHPMailer();
		
		// Thiết lập thông tin
		$mail->IsSMTP();
		$mail->SMTPAuth   = true;
		$mail->Host       = $config_ip;
		$mail->Username   = $config_email;
		$mail->Password   = $config_pass;
		$mail->SetFrom($row_setting['email'],$row_setting['ten'.$lang]);

		// Thiết lập thông tin người nhận
		$mail->AddAddress($row_setting['email'],$row_setting['ten'.$lang]);

		// Thiết lập thông tin người nhận (Khách hàng)
		$mail->AddAddress($email,$hoten);

		// Thiết lập email nhận email hồi đáp nếu người nhận nhấn nút Reply
		$mail->AddReplyTo($row_setting['email'],$row_setting['ten'.$lang]);

		$mail->Subject = "Thông Tin Đơn Hàng Từ ".$row_setting['ten'.$lang];

		// Thiết lập định dạng font chữ
		$mail->CharSet = "utf-8";
		$mail->AltBody = "To view the message, please use an HTML compatible email viewer!";

		// Thiết lập nội dung chính của email
		$mail->MsgHTML($body);

		// Gửi email
		$mail->Send();

		//Thiết lập thông tin người nhận
		$mail->AddAddress($_POST['email'],$row_setting['ten'.$lang]);
		
		//Thiết lập email nhận email hồi đáp nếu người nhận nhấn nút Reply
		$mail->AddReplyTo($row_setting['email'],$row_setting['ten'.$lang]);

		$thongtindh.='<b style="font-size: 16px;line-height: 25px;">Cảm ơn khách hàng <span style="text-transform: uppercase;">'.$_POST['ten'].'</span> đã đặt hàng tại website '.$row_setting['website'].' </b><br/>';
		$thongtindh.='<b style="font-size: 16px;line-height: 25px;">Mã đơn hàng của quý khách là: </b><span style="color: #f00;font-size: 16px;line-height: 25px;">'.$mahoadon.'</span><br/><br/>';
		$thongtindh.='<b>THÔNG TIN ĐƠN HÀNG CỦA QUÝ KHÁCH BAO GỒM: </b><br/><br/>';
		$thongtinchuyenkhoan.='<b style="color: green;font-size: 16px;line-height: 25px;">Thông tin đơn hàng đã được tiếp nhận và chờ xử lý.<br/>Chân thành cảm ơn quý khách đã tin dùng sản phẩm của '.$row_setting['website'].' !</b><br/><br/>';
		
		// Thiết lập tiêu đề
		$mail->Subject = "THông Tin Đơn Hàng Từ ".$row_setting['website']."";
		
		// Thiết lập định dạng font chữ
		$mail->CharSet = "utf-8";
		$mail->AltBody = "To view the message, please use an HTML compatible email viewer!";
		
		// Thiết lập nội dung chính của email
		$mail->MsgHTML($thongtindh.$body.$thongtinchuyenkhoan);

		// Gửi email
		$mail->Send();

		/* Cập nhật tình trạng mã ưu đãi */
		if(isset($_SESSION['coupon']['id']))
		{
			$data_coupon['tinhtrang']='1';
	        $d->setTable('coupon');
	        $d->setWhere('id',$_SESSION['coupon']['id']);
	        if($d->update($data_coupon))
	        {
	        	unset($_SESSION['cart']);
				unset($_SESSION['coupon']);
				transfer("Thông tin đơn hàng đã được gửi thành công!<br/>", $config_url_http);
	        }
	    }
	    else
        {
        	unset($_SESSION['cart']);
			unset($_SESSION['coupon']);
			transfer("Thông tin đơn hàng đã được gửi thành công!<br/>", $config_url_http);
        }
	}
?>