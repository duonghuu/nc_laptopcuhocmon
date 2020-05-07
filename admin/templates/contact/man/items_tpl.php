<!-- Begin Bảng Điều Khiển -->
<div class="breadcrumbwidget">
    <ul class="breadcrumb">
        <li><a href="index.php">Bảng điều khiển</a> <span class="divider">/</span></li>
        <li class="active">Danh sách liên hệ</li>
    </ul>
</div>
<!-- End Bảng Điều Khiển -->

<div class="pagetitle">
	<h1>Danh sách liên hệ</h1>
</div>
<div class="maincontent">
	<div class="contentinner">
		<div class="row-fluid">
			<div class="span12">
				<form action="index.php?com=contact&act=man" method="POST" name="update_position">
					<table class="table table-bordered" <?=(count($items))?'id="dyntable"':''?>>
						<thead>
							<tr>
								<th style="width:3%" align="center"><input type="checkbox" name="selecteall" id="selecteall" class="checkall" /></th>
								<th>STT</th>
								<th>Họ tên</th>
								<th>Email</th>
								<th>Điện thoại</th>
						       	<th>Xác nhận</th>
						       	<th>Thao tác</th>
							</tr>
						</thead>
						<?php if(empty($items)) echo "<tr><td colspan='10'>Chưa có mục nào ...</td></tr>";
						else {
						for($i=0, $count=count($items); $i<$count; $i++){?>
						<tr><input type="hidden" name="stt[id][]" value="<?=$items[$i]["id"]?>">
							<td style="width:3%;" align="center"><input type="checkbox" name="chose" id="chose" value="<?=$items[$i]['id']?>" /></td>
							<td style="width:5%;"><input type="number" min="0" name="stt[stt][]" id="stt" value="<?=$items[$i]['stt']?>" data-id="<?=$items[$i]['id']?>" data-table="contact" class="selectinput update_stt" /></td>
							<td style="width:15%;">
								<a href="index.php?com=contact&act=edit&id=<?=$items[$i]['id']?>" title="Chỉnh sửa"><?=$items[$i]['ten']?></a>
							</td>
							<td style="width:15%;">
								<?=$items[$i]['email']?>
							</td>
							<td style="width:5%;">
								<?=$items[$i]['dienthoai']?>
							</td>
							<td style="width:5%;" class="action">
								<a data-table="contact" data-id="<?=$items[$i]['id']?>" data-loai="hienthi" class="show_ajax" title="Xác nhận">
									<?php if($items[$i]['hienthi']>0) { ?>
										<span class="iconfa-ok-circle text-success"></span>
									<?php } else { ?>
										<span class="iconfa-ban-circle "></span>
									<?php } ?>
								</a>
							</td>
							<td style="width:5%;" class="action">
								<a href="index.php?com=contact&act=edit&id=<?=$items[$i]['id']?>" title="Chỉnh sửa"><span class="iconfa-edit"></span></a>&nbsp&nbsp
								<a href="index.php?com=contact&act=delete&id=<?=$items[$i]['id']?>" title="Xóa" onClick="if(!confirm('Bạn có chắc muốn xóa email này?')) return false;"><span class="iconfa-trash"></span></a>
							</td>
						</tr>
						<?php } }?>
					</table>
				</form>
				
				<div class="pagination pagination-centered" <?=($paging['paging'] == "<ul></ul>")?'style="height: 0px; margin: 0px;"':''?>><?=$paging['paging']?></div>

				<div class="actionfull">
					<!-- <a href="index.php?com=contact&act=add" class="btn btn-rounded"><icon class="icon-plus"></icon> Tạo mới</a> -->
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
	      	//check all rows in table
	      	ch.each(function(){ 
	         	jQuery(this).attr('checked',true);
	         	jQuery(this).parent().addClass('checked');
	         	jQuery(this).parents('tr').addClass('selected');
	      	});			
	   	} else {		
	      //uncheck all rows in table
	      	ch.each(function(){ 
	         	jQuery(this).attr('checked',false); 
	         	jQuery(this).parent().removeClass('checked');
	         	jQuery(this).parents('tr').removeClass('selected');
	      	});	
	   	}
	});

	if(jQuery('#delall').length > 0) {
		jQuery('#delall').click(function(){
			var listid="";
			jQuery("input[name='chose']").each(function(){
				if (this.checked) listid = listid+","+this.value;
		    });
			listid=listid.substr(1);
			if (listid=="") { alert("Chọn hãy chọn ít nhất 1 mục để xóa!"); return false;}
			hoi = confirm("Bạn có chắc muốn xóa những mục đã chọn?");
			if (hoi==true) document.location = "index.php?com=contact&act=delete&listid=" + listid;
		});
	}

	jQuery("#update").click(function(){
		update_position.submit();
	});
</script>