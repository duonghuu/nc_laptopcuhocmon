<!-- Begin Bảng Điều Khiển -->
<div class="breadcrumbwidget">
    <ul class="breadcrumb">
        <li><a href="index.php">Bảng điều khiển</a> <span class="divider">/</span></li>
        <li><a href="index.php?com=coupon&act=man">Quản lý mã ưu đãi</a> <span class="divider">/</span></li>
        <li class="active">Chi tiết mã ưu đãi</li>
    </ul>
</div>
<!-- End Bảng Điều Khiển -->

<div class="pagetitle">
	<h1><?php if ($_REQUEST['act']=="edit") echo "Cập nhật"; else echo "Thêm mới"; ?></h1>
</div>

<?php
	function fns_Rand_digit($min,$max,$num)
	{
		$result='';
		for($i=0;$i<$num;$i++){
			$result.=rand($min,$max);
		}
		return $result;	
	}

	function cp_rand()
	{
		$f = substr(str_shuffle(str_repeat("ABCDEFGHIJKLMNOPQRSTUVXYZabcdefghijklmnopqrstuvwxyz", 5)), 0, 3);
		$m=substr(md5(time()),0,3);
		$l=fns_Rand_digit(0,9,3);
		return $f.$m.$l;
	}
	
	function chk_cp($cp)
	{
		global $d;
		
		$d->reset();
		$sql="select id from #_coupon where ma='$cp'";
		$d->query($sql);
		$tmp=$d->fetch_array();
		
		if($tmp['id']!="")
		{
			return 1;	
		}	
		else
		{
			return 0;	
		}
	}

	if((int)$_REQUEST['nm']>0)
	{
		$nm=$_REQUEST['nm'];
	}
	else
	{
		$nm=20;
	}
?>

<script>
  jQuery(function() {
    jQuery("#ngaybatdau").datepicker({"dateFormat": "dd-mm-yy" });
    jQuery("#ngayketthuc").datepicker({"dateFormat": "dd-mm-yy" });
  });
</script>

<div class="maincontent">
	<div class="contentinner">
		<div class="row-fluid">
			<div class="span12">
				<h4 class="widgettitle nomargin shadowed"></h4>
				<div class="widgetcontent bordered shadowed nopadding">
					<form name="frm" method="post" action="index.php?com=coupon&act=save&curPage=<?=$_REQUEST['curPage']?>&nm=<?=$nm?>" enctype="multipart/form-data" class="stdform stdform2">
						<?php if($_GET['act']=='edit') { ?>
							<p><label>Mã:</label><span class="field">
								<input type="text" readonly="true" name='ma' id='ma' value="<?=@$item['ma']?>" class="input-xxlarge" style="width: 200px" required/>
							</p>
						<?php } ?>
						<p><label>Loại giảm:</label><span class="field">
							<input type="text" name="phantram" value="<?=@$item['phantram']?>" class="input-xxlarge" style="width: 200px" required/>
							<select name="loai" style="width: 55px">
								<option <?php if($item['loai']==0) { echo "selected"; } ?> value="0">%</option>
								<option <?php if($item['loai']==1) { echo "selected"; } ?> value="1">VNĐ</option>
							</select></span>
						</p>
						<p><label>Ngày bắt đầu:</label><span class="field"><input type="text" name="ngaybatdau" id="ngaybatdau" value="<?php if($_GET['act']=='edit') echo date('d-m-Y',$item['ngaybatdau'])?>" class="input" /></span></p>
						<p><label>Ngày kết thúc:</label><span class="field"><input type="text" name="ngayketthuc" id="ngayketthuc" value="<?php if($_GET['act']=='edit') echo date('d-m-Y',$item['ngayketthuc'])?>" class="input" /></span></p>
						<p><label>STT:</label> <span class="field"><input type="number" min="0" name="stt" value="<?=isset($item['stt'])?$item['stt']:1?>" style="width:30px"></span></p>
						<?php if($_GET['act']=='edit') { ?>
							<p><label>Tình trạng:</label><span class="field">
								<select name="tinhtrang">
									<option <?php if($item['tinhtrang']==0) { echo "selected"; } ?> value="0">Chưa sử dụng</option>
									<option <?php if($item['tinhtrang']==1) { echo "selected"; } ?> value="1">Đã sử dụng</option>
									<option <?php if($item['tinhtrang']==2) { echo "selected"; } ?> value="2">Hết hạn</option>
									<option <?php if($item['tinhtrang']==3) { echo "selected"; } ?> value="3">Đã gửi</option>
								</select></span>
							</p>
					    <?php } ?>
						<?php 
							if($_GET['act']=='add') {
								for($i=0;$i<$nm;$i++){
									$ck=1;
									while($ck!=0)
									{
										$ma=cp_rand();
										$ck=chk_cp($ma);
									} ?>
							    	<p><label>Mã <?=($i+1)?>:</label><span class="field"><?=$ma?></span></p>
							    	<input type="hidden" name="ma<?=$i?>" value="<?=$ma?>"/>
					    <?php } } ?>
						<p class="stdformbutton">
							<input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
							<button type="submit" class="btn btn-primary"><span class="iconfa-save"></span> Lưu</button>
							<button type="reset" class="btn"><span class="iconfa-refresh"></span> Làm lại</button>
							<button type="button" onclick="javascript:window.location='index.php?com=coupon&act=man'" class="btn"><span class="iconfa-off"></span> Thoát</button>
						</p>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>