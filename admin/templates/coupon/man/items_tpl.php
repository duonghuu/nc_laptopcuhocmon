<!-- Begin Bảng Điều Khiển -->
<div class="breadcrumbwidget">
    <ul class="breadcrumb">
        <li><a href="index.php">Bảng điều khiển</a> <span class="divider">/</span></li>
        <li class="active">Quản lý mã ưu đãi</li>
    </ul>
</div>
<!-- End Bảng Điều Khiển -->

<div class="pagetitle">
	<h1>Danh sách mã ưu đãi</h1>
</div>

<?php 
	function update_cp_st($id,$st)
	{
		global $d;

		$d->reset();
		$data_coupon['tinhtrang'] = $st;
		$d->setTable('coupon');
		$d->setWhere('id',$id);
		$d->update($data_coupon);
	}
?>

<div class="maincontent">
	<div class="contentinner">
		<div class="row-fluid">
			<div class="span12">
				<div class="input-append">
					<input name="nm" id="nm" type="text" onkeypress="doEnter(event,'nm')" placeholder="Nhập số lượng mã cần tạo"/>
					<button type="button" class="btn" onclick="tao_ma()">Tạo</span></button>
				</div>
				<form action="index.php?com=coupon&act=man" method="POST" name="update_position">
					<table class="table table-bordered" <?=(count($items))?'id="dyntable"':''?>>
						<thead>
							<tr>
								<th style="width:3%" align="center"><input type="checkbox" name="selectall" id="selectall" class="checkall" /></th>
								<th>STT</th>
						        <th>Mã ưu đãi</th>
						        <th>Giảm</th>
							  	<th>Ngày bắt đầu</th>
							  	<th>Ngày kết thúc</th>
							  	<th>Tình trạng</th>
								<th>Thao tác</th>
							</tr>
						</thead>

						<?php if(empty($items)) echo "<tr><td colspan='10'>Không có mục nào ...</td></tr>";

						else { for($i=0, $count=count($items); $i<$count; $i++) { ?>

						<tr><input type="hidden" name="stt[id][]" value="<?=$items[$i]["id"]?>">
							<td style="width:3%;" align="center"><input type="checkbox" name="chose" id="chose" value="<?=$items[$i]['id']?>" class="chon" /></td>	
							<td style="width:5%;"><input type="number" min="0" name="stt[stt][]" id="stt" value="<?=$items[$i]['stt']?>" data-id="<?=$items[$i]['id']?>" data-table="coupon" class="selectinput update_stt" /></td>
							<td style="width:10%;">
								<a href="index.php?com=coupon&act=edit&id=<?=$items[$i]['id']?>" title="Cập nhật"><?=$items[$i]['ma']?></a>
							</td>
							<td style="width:10%;">
								<?php
					    			/* Cập nhật tình trạng hết hạn */
					    			if($items[$i]['ngayketthuc']<time())
					    			{
					    				update_cp_st($items[$i]['id'],3);
					    			}

					    			if($items[$i]['loai']==0)
					    			{
					    				echo $items[$i]['phantram'].'%';	
					    			}
					    			else
					    			{
					    				echo number_format($items[$i]['phantram'],0,'',',').'VNĐ';
					    			}
					    		?>
							</td>
							<td style="width:5%;" class="action"><?=date('d-m-Y',$items[$i]['ngaybatdau'])?></td>
							<td style="width:5%;" class="action"><?=date('d-m-Y',$items[$i]['ngayketthuc'])?></td>
							<td style="width:10%;">
								<?php
									if($items[$i]['tinhtrang']==0)
									{
										echo 'Chưa sử dụng';	
									}
									elseif($items[$i]['tinhtrang']==1)
									{
										echo 'Đã sử dụng';
									}
									elseif($items[$i]['tinhtrang']==2)
									{
										echo 'Hết hạn';
									}
									elseif($items[$i]['tinhtrang']==3)
									{
										echo 'Đã gửi';	
									}
								?>
							</td>
							<td style="width:5%;" class="action">
								<a href="index.php?com=coupon&act=edit&id=<?=$items[$i]['id']?>" title="Sửa"><span class="iconfa-edit"></span></a>&nbsp
								<a href="index.php?com=coupon&act=delete&id=<?=$items[$i]['id']?>" onClick="if(!confirm('Bạn có chắc muốn xóa dữ liệu ?')) return false;" title="Xóa"><span class="iconfa-trash"></span></a>
							</td>
						</tr>

						<?php }	} ?>
					</table>
				</form>

				<div class="pagination pagination-centered" <?=($paging['paging'] == "<ul></ul>")?'style="height: 0px; margin: 0px;"':''?>><?=$paging['paging']?></div>

				<div class="actionfull">
					<a href="index.php?com=coupon&act=add" class="btn btn-rounded"><icon class="icon-plus"></icon> Thêm mới</a>
					<button class="btn btn-rounded" id="delall"><span class="icon-trash"></span> Xóa nhiều</button>
					<!-- <button class="btn btn-rounded" id="update"><span class="icon-refresh"></span> Cập nhật STT</button> -->
				</div>

			</div>
		</div>
	</div>
</div>

<script>
	jQuery('.checkall').click(function(){
	   	var parentTable = jQuery(this).parents('table');										   
	   	var ch = parentTable.find('tbody input[type=checkbox]');
	   	if(jQuery(this).is(':checked')) {			
	      	ch.each(function(){ 
	         	jQuery(this).attr('checked',true);
	         	jQuery(this).parent().addClass('checked');
	         	jQuery(this).parents('tr').addClass('selected');
	      	});			
	   	} else {		
	      	ch.each(function(){ 
	         	jQuery(this).attr('checked',false); 
	         	jQuery(this).parent().removeClass('checked');
	         	jQuery(this).parents('tr').removeClass('selected');
	      	});	
	   	}
	});

	function doEnter(evt){
		var key;
		if(evt.keyCode == 13 || evt.which == 13){
			tao_ma(evt);
		}
	}
	
	function tao_ma(evt){	
		var nm = document.getElementById("nm").value;		
			location.href = "index.php?com=coupon&act=add&nm="+nm;
			loadPage(document.location);
	}

	if(jQuery('#delall').length > 0) {
		jQuery('#delall').click(function(){
			var listid="";
			jQuery("input[name='chose']").each(function(){
				if (this.checked) listid = listid+","+this.value;
		    });
			listid=listid.substr(1);
			if (listid=="") { alert("Chọn hãy chọn ít nhất 1 mục để xóa!"); return false;}
			hoi = confirm("Bạn có chắc muốn xóa những mục đã chọn?");
			if (hoi==true) document.location = "index.php?com=coupon&act=delete&listid=" + listid;
		});
	}

	jQuery("#update").click(function(){
		update_position.submit();
	});
</script>