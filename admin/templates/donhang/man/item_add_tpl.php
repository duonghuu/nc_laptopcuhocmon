<?php
	function get_status($i=0)
	{
		$sql="select * from table_tinhtrang order by id";
		$stmt=mysql_query($sql);
		$str='<select id="tinhtrang" name="tinhtrang" class="main_font">';
		while ($row=@mysql_fetch_array($stmt)) 
		{
			if($row["id"]==$i)
				$selected="selected";
			else 
				$selected="";
			$str.='<option value='.$row["id"].' '.$selected.'>'.$row["trangthai"].'</option>';			
		}
		$str.='</select>';
		return $str;
	}
?>

<!-- Begin Bảng Điều Khiển -->
<div class="breadcrumbwidget">
    <ul class="breadcrumb">
        <li><a href="index.php">Bảng điều khiển</a> <span class="divider">/</span></li>
        <li class="active">Chi tiết đơn hàng: <?=@$item['madonhang']?></li>
    </ul>
</div>
<!-- End Bảng Điều Khiển -->

<div class="pagetitle">
	<h1>Chi tiết đơn hàng</h1>
</div>

<div class="maincontent">
	<div class="contentinner">
		<div class="row-fluid">
			<div class="span12">
				<h4 class="widgettitle nomargin shadowed"></h4>
				<div class="widgetcontent bordered shadowed nopadding">
					<form name="frm" method="post" action="index.php?com=order&act=save" enctype="multipart/form-data" class="stdform stdform2">
						<p><label>Mã đơn hàng:</label><span class="field"><?=@$item['madonhang']?></span></p>
						<p><label>Hình thức thanh toán:</label><span class="field"><?=get_httt($item['httt'])?></span></p>
						<p><label>Họ tên:</label><span class="field"><?=@$item['hoten']?></span></p>
						<p><label>Điện thoại:</label><span class="field"><?=@$item['dienthoai']?></span></p>
						<p><label>Email:</label><span class="field"><?=@$item['email']?></span></p>
						<p><label>Địa chỉ:</label><span class="field"><?=@$item['diachi']?></span></p>
						<p><label>Ngày đặt:</label><span class="field"><b><?=date("h:i:s A - d/m/Y", $item['ngaytao'])?></b></span></p>
						<p><label>Tình trạng:</label><span class="field"><?=get_status($item['tinhtrang'])?></span></p>
						<p>
							<label>Ghi chú:</label>
							<span class="field"><textarea name="noidung" id="noidung" rows="10" cols="30" style="width: 90%"><?=@$item['noidung']?></textarea></span>
						</p>
						<p>
							<?=$item['donhang']?>
						</p>
						<p class="stdformbutton">
							<input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
							<button type="submit" class="btn btn-primary"><span class="iconfa-save"></span> Lưu</button>
							<button type="reset" class="btn"><span class="iconfa-refresh"></span> Làm lại</button>
							<button type="button" onclick="javascript:window.location='index.php?com=order&act=man'" class="btn"><span class="iconfa-off"></span> Thoát</button>
						</p>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>