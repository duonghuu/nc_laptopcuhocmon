<!-- Begin Bảng Điều Khiển -->
<div class="breadcrumbwidget">
    <ul class="breadcrumb">
        <li><a href="index.php">Bảng điều khiển</a> <span class="divider">/</span></li>
        <li class="active">Hổ trợ trực tuyến</li>
    </ul>
</div>
<!-- End Bảng Điều Khiển -->

<div class="pagetitle">
	<h1>Danh sách hổ trợ trực tuyến</h1>
</div>

<div class="maincontent">
	<div class="contentinner">
		<div class="row-fluid">
			<div class="span12">
				<form action="index.php?com=yahoo&act=man" method="POST" name="update_position">
					<table class="table table-bordered" <?=(count($items))?'id="dyntable"':''?>>
						<thead>
							<tr>
								<th style="width:3%" align="center"><input type="checkbox" name="selectall" id="selectall" class="checkall" /></th>
								<th>STT</th>
						        <th>Họ tên</th>
						        <?php if($config['yahoo']['email']=="true") { ?>
						        	<th>Email</th>
						        <?php } ?>
						        <?php if($config['yahoo']['skype']=="true") { ?>
						        	<th>Skype</th>
						        <?php } ?>
						        <?php if($config['yahoo']['zalo']=="true") { ?>
						        	<th>Zalo</th>
						        <?php } ?>
						        <?php if($config['yahoo']['viber']=="true") { ?>
						        	<th>Viber</th>
						        <?php } ?>
						        <?php if($config['yahoo']['dienthoai']=="true") { ?>
						        	<th>Điện thoại</th>
						        <?php } ?>
						        <?php foreach ($config['yahoo']['check'] as $key => $value) { ?>
								  	<th><?=$value?></th>
								<?php } ?>
							  	<th>Hiển thị</th>
								<th>Thao tác</th>
							</tr>
						</thead>

						<?php if(empty($items)) echo "<tr><td colspan='10'>Không có mục nào ...</td></tr>";

						else { for($i=0, $count=count($items); $i<$count; $i++) { ?>

						<tr><input type="hidden" name="stt[id][]" value="<?=$items[$i]["id"]?>">
							<td style="width:3%;" align="center"><input type="checkbox" name="chose" id="chose" value="<?=$items[$i]['id']?>" class="chon" /></td>	
							<td style="width:5%;"><input type="number" min="0" name="stt[stt][]" id="stt" value="<?=$items[$i]['stt']?>" data-id="<?=$items[$i]['id']?>" data-table="yahoo" class="selectinput update_stt" /></td>
							<td style="width:10%;">
								<a href="index.php?com=yahoo&act=edit&id=<?=$items[$i]['id']?>" title="Cập nhật"><?=$items[$i]['ten']?></a>
							</td>
							<?php if($config['yahoo']['email']=="true") { ?>
								<td style="width:10%;"><?=$items[$i]['email']?></td>
							<?php } ?>
							<?php if($config['yahoo']['skype']=="true") { ?>
								<td style="width:10%;"><?=$items[$i]['skype']?></td>
							<?php } ?>
							<?php if($config['yahoo']['zalo']=="true") { ?>
								<td style="width:10%;"><?=$items[$i]['zalo']?></td>
							<?php } ?>
							<?php if($config['yahoo']['viber']=="true") { ?>
								<td style="width:10%;"><?=$items[$i]['viber']?></td>
							<?php } ?>
							<?php if($config['yahoo']['dienthoai']=="true") { ?>
								<td style="width:10%;"><?=$items[$i]['dienthoai']?></td>
							<?php } ?>
							<?php foreach ($config['yahoo']['check'] as $key => $value) { ?>
							  	<td style="width:5%;" class="action">
									<a data-table="yahoo" data-id="<?=$items[$i]['id']?>" data-loai="<?=$key?>" class="show_ajax" title="<?=$value?>">
										<?php if($items[$i][$key]>0) { ?>
											<span class="iconfa-ok-circle text-success"></span>
										<?php } else { ?>
											<span class="iconfa-ban-circle "></span>
										<?php } ?>
									</a>
								</td>
							<?php } ?>
							<td style="width:5%;" class="action">
								<a data-table="yahoo" data-id="<?=$items[$i]['id']?>" data-loai="hienthi" class="show_ajax" title="Hiển thị">
									<?php if($items[$i]['hienthi']>0) { ?>
										<span class="iconfa-ok-circle text-success"></span>
									<?php } else { ?>
										<span class="iconfa-ban-circle "></span>
									<?php } ?>
								</a>
							</td>
							<td style="width:5%;" class="action">
								<a href="index.php?com=yahoo&act=edit&id=<?=$items[$i]['id']?>" title="Sửa"><span class="iconfa-edit"></span></a>&nbsp
								<a href="index.php?com=yahoo&act=delete&id=<?=$items[$i]['id']?>" onClick="if(!confirm('Bạn có chắc muốn xóa dữ liệu ?')) return false;" title="Xóa"><span class="iconfa-trash"></span></a>
							</td>
						</tr>

						<?php }	} ?>
					</table>
				</form>

				<div class="pagination pagination-centered" <?=($paging['paging'] == "<ul></ul>")?'style="height: 0px; margin: 0px;"':''?>><?=$paging['paging']?></div>

				<div class="actionfull">
					<a href="index.php?com=yahoo&act=add" class="btn btn-rounded"><icon class="icon-plus"></icon> Thêm mới</a>
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

	if(jQuery('#delall').length > 0) {
		jQuery('#delall').click(function(){
			var listid="";
			jQuery("input[name='chose']").each(function(){
				if (this.checked) listid = listid+","+this.value;
		    });
			listid=listid.substr(1);
			if (listid=="") { alert("Chọn hãy chọn ít nhất 1 mục để xóa!"); return false;}
			hoi = confirm("Bạn có chắc muốn xóa những mục đã chọn?");
			if (hoi==true) document.location = "index.php?com=yahoo&act=delete&listid=" + listid;
		});
	}

	jQuery("#update").click(function(){
		update_position.submit();
	});
</script>