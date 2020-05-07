<script language="javascript">
	function doEnter(evt){
		var key;
		if(evt.keyCode == 13 || evt.which == 13){
			onSearch(evt);
		}
	}
	
	function onSearch(evt){	
		var keyword = document.getElementById("keyword").value;		
			location.href = "index.php?com=order&act=man&keyword="+keyword;
			loadPage(document.location);
	}							
</script>

<!-- Begin Bảng Điều Khiển -->
<div class="breadcrumbwidget">
    <ul class="breadcrumb">
        <li><a href="index.php">Bảng điều khiển</a> <span class="divider">/</span></li>
        <li class="active">Danh sách đơn hàng</li>
    </ul>
</div>
<!-- End Bảng Điều Khiển -->

<div class="pagetitle">
	<h1>Đơn hàng</h1>
</div>

<div class="maincontent">
	<div class="contentinner">
		<div class="row-fluid">
			<div class="span12">
				<!-- Begin Search -->
				<div class="input-append">
					<input name="keyword" id="keyword" type="text" placeholder="Tìm kiếm danh mục ..." onkeypress="doEnter(event,'keyword')"/>
					<button type="button" class="btn" onclick="onSearch()"><span class="icon-search"></span></button>
				</div>
				<!-- End Search -->
					
				<div class="form-table">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>STT</th>
						        <th>Mã đơn hàng</th>
						        <th>Hình thức thanh toán</th>
							  	<th>Họ tên</th>
							  	<th>Ngày đặt</th>
							  	<th>Số tiền</th>
							  	<?php if($phicoupon==true) { ?>
							  		<th>Số tiền <span style="color: red">(Ưu đãi)</span></th>
							  	<?php } ?>
							  	<?php if($phiship==true) { ?>
							  		<th>Phí SHIP</th>
							  	<?php } ?>
							  	<th>Tình trạng</th>
								<th>Thao tác</th>
							</tr>
						</thead>

						<?php if(empty($items)) echo "<tr><td colspan='10'>Không có mục nào ...</td></tr>";

						else { for($i=0, $count=count($items); $i<$count; $i++){ $tongthu = $tongthu + $items[$i]['tonggia']; ?>

						<tr>
							<td style="width:5%;"><?=$items[$i]['id']?></td>
							<td style="width:5%;"><?=$items[$i]['madonhang']?></td>
							<td style="width:10%;"><?=get_httt($items[$i]['httt'])?></td>
							<td style="width:15%;"><a href="index.php?com=order&act=edit&id=<?=$items[$i]['id']?>" title="Cập nhật"><?=$items[$i]['hoten']?></a></td>
							<td style="width:10%;" class="action"><?=date("h:i:s A - d/m/Y", $items[$i]['ngaytao'])?></td>
							<td style="width:10%;"><?=number_format($items[$i]['tonggia'], 0, ',', '.')?>&nbsp;VNĐ</td>
							<?php if($phicoupon==true) { ?>
								<td style="width:10%;">
									<?=number_format($items[$i]['phicoupon'], 0, ',', '.')?>&nbsp;VNĐ
									&nbsp;(<span style="color: red">-<?=$items[$i]['phantramcoupon'].get_loai_coupon($items[$i]['loaicoupon'])?></span>)
								</td>
							<?php } ?>
							<?php if($phiship==true) { ?>
								<td style="width:10%;"><?=number_format($items[$i]['phiship'], 0, ',', '.')?>&nbsp;VNĐ</td>
							<?php } ?>
							<td style="width:10%;">
								<?php 
								$sql="select trangthai from table_tinhtrang where id='".$items[$i]['tinhtrang']."'";
								$d->query($sql);
								$result=$d->fetch_array();
								echo $result['trangthai'];
								?>
							</td>
							<td style="width:10%;" class="action">
								<?php if($export_wo==true) { ?>
									<a href="index.php?com=export_word&id=<?=$items[$i]['id']?>" title="Xuất file Word">
										<i class="fa fa-file-word-o" aria-hidden="true"></i>
									</a>&nbsp
								<?php } ?>
								<?php if($export_ex==true) { ?>
									<a href="index.php?com=export_excel&id=<?=$items[$i]['id']?>" title="Xuất file Excel">
										<i class="fa fa-file-excel-o" aria-hidden="true"></i>
									</a>&nbsp
								<?php } ?>
								<a href="index.php?com=order&act=edit&id=<?=$items[$i]['id']?>" title="Sửa"><span class="iconfa-edit"></span></a>&nbsp
								<a href="index.php?com=order&act=delete&id=<?=$items[$i]['id']?>" onClick="if(!confirm('Bạn có chắc muốn xóa dữ liệu ?')) return false;" title="Xóa"><span class="iconfa-trash"></span></a>
							</td>
						</tr>

						<?php }	} ?>
					</table>
				</div>
				
				<!-- Begin Paging -->
				<div class="pagination pagination-centered" <?=($paging['paging'] == "<ul></ul>")?'style="height: 0px; margin: 0px;"':''?>><?=$paging['paging']?></div>
				<!-- End Paging -->
			</div>
		</div>
	</div>
</div>