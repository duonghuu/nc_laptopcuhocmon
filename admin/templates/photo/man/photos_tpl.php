<!-- Begin Bảng Điều Khiển -->
<div class="breadcrumbwidget">
    <ul class="breadcrumb">
        <li><a href="index.php">Bảng điều khiển</a> <span class="divider">/</span></li>
        <li class="active">Danh sách <?=$config['photo']['man_photo'][$type]['title_main_photo']?></li>
    </ul>
</div>
<!-- End Bảng Điều Khiển -->

<div class="pagetitle">
	<h1>Danh sách <?=$config['photo']['man_photo'][$type]['title_main_photo']?></h1>
</div>

<div class="maincontent">
	<div class="contentinner">
		<div class="row-fluid">
			<div class="span12">
				<form action="index.php?com=photo&act=man_photo&type=<?=$_GET['type']?>" method="POST" name="update_position">
					<table class="table table-bordered" <?=(count($items))?'id="dyntable"':''?>>
						<thead>
							<tr>
								<th style="width:3%" align="center"><input type="checkbox" name="selectall" id="selectall" class="checkall" /></th>
								<th>STT</th>
								<?php if($config['photo']['man_photo'][$type]['tieude_photo']=='true') { ?>
						        	<th>Tiêu đề</th>
						        <?php } ?>
						        <?php if($config['photo']['man_photo'][$type]['link_photo']=='true') { ?>
						        	<th>Link</th>
						        <?php } ?>
						        <?php if($config['photo']['man_photo'][$type]['video_photo']=='true') { ?>
						        	<th>Link video</th>
						        <?php } ?>
						        <?php if($config['photo']['man_photo'][$type]['avatar_photo']=='true') { ?>
						        	<th>Hình ảnh</th>
						        <?php } ?>
						        <?php foreach ($config['photo']['man_photo'][$type]['check_photo'] as $key => $value) { ?>
								  	<th><?=$value?></th>
								<?php } ?>
							  	<th>Hiển thị</th>
								<th>Thao tác</th>
							</tr>
					    </thead>

						<?php if(empty($items)) echo "<tr><td colspan='10'>Không có mục nào ...</td></tr>";

						else { for($i=0, $count=count($items); $i<$count; $i++){?>

						<tr><input type="hidden" name="stt[id][]" value="<?=$items[$i]["id"]?>">
							<td style="width:3%;" align="center"><input type="checkbox" name="chose" id="chose" value="<?=$items[$i]['id']?>" class="chon" /></td>	
							<td style="width:5%;"><input type="number" min="0" name="stt[stt][]" id="stt" value="<?=$items[$i]['stt']?>" data-id="<?=$items[$i]['id']?>" data-table="photo" class="selectinput update_stt" /></td>
							<?php if($config['photo']['man_photo'][$type]['tieude_photo']=='true') { ?>
								<td style="width:25%;" class="text-left">
									<a href="index.php?com=photo&act=edit_photo&id=<?=$items[$i]['id']?>&type=<?=$_GET['type']?>" title="Cập nhật"><?=$items[$i]['tenvi']?></a>
								</td>
							<?php } ?>
							<?php if($config['photo']['man_photo'][$type]['link_photo']=='true') { ?>
								<td style="width:15%;" class="text-left">
									<a href="index.php?com=photo&act=edit_photo&id=<?=$items[$i]['id']?>&type=<?=$_GET['type']?>" title="Cập nhật"><?=$items[$i]['link']?></a>
								</td>
							<?php } ?>
							<?php if($config['photo']['man_photo'][$type]['video_photo']=='true') { ?>
								<td style="width:15%;" class="text-left">
									<a href="<?=$items[$i]['link_video']?>" target="_blank" title="Xem video">Xem trên Youtube</a>
								</td>
							<?php } ?>
							<?php if($config['photo']['man_photo'][$type]['avatar_photo']=='true') { ?>
								<td style="width:20%;" class="text-left">
									<a href="index.php?com=photo&act=edit_photo&id=<?=$items[$i]['id']?>&type=<?=$_GET['type']?>" title="Cập nhật">
										<img src="<?=_upload_photo.$items[$i]['photo']?>" onerror="src='img/noimage.png'" alt="NO PHOTO" style="max-width: 150px"/>
									</a>
								</td>
							<?php } ?>
							<?php foreach ($config['photo']['man_photo'][$type]['check_photo'] as $key => $value) { ?>
							  	<td style="width:5%;" class="action">
									<a data-table="photo" data-id="<?=$items[$i]['id']?>" data-loai="<?=$key?>" class="show_ajax" title="<?=$value?>">
										<?php if($items[$i][$key]>0) { ?>
											<span class="iconfa-ok-circle text-success"></span>
										<?php } else { ?>
											<span class="iconfa-ban-circle "></span>
										<?php } ?>
									</a>
								</td>
							<?php } ?>
							<td style="width:5%;" class="action">
								<a data-table="photo" data-id="<?=$items[$i]['id']?>" data-loai="hienthi" class="show_ajax" title="Hiển thị">
									<?php if($items[$i]['hienthi']>0) { ?>
										<span class="iconfa-ok-circle text-success"></span>
									<?php } else { ?>
										<span class="iconfa-ban-circle "></span>
									<?php } ?>
								</a>
							</td>
							<td style="width:10%;" class="action">
								<a href="index.php?com=photo&act=edit_photo&id=<?=$items[$i]['id']?>&type=<?=$_GET['type']?>" title="Cập nhật"><span class="iconfa-edit"></span></a>&nbsp
								<a href="index.php?com=photo&act=delete_photo&id=<?=$items[$i]['id']?>&type=<?=$_GET['type']?>" onClick="if(!confirm('Bạn có chắc muốn xóa dữ liệu ?')) return false;" title="Delete"><span class="iconfa-trash"></span></a>
							</td>
						</tr>

						<?php }	} ?>
					</table>
				</form>

				<div class="pagination pagination-centered" <?=($paging['paging'] == "<ul></ul>")?'style="height: 0px; margin: 0px;"':''?>><?=$paging['paging']?></div>

				<div class="actionfull">
					<a href="index.php?com=photo&act=add_photo&type=<?=$_GET['type']?>" class="btn btn-rounded"><icon class="icon-plus"></icon> Thêm mới</a>
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
	   	} 
	   	else 
	   	{		
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
			if (hoi==true) document.location = "index.php?com=photo&act=delete_photo&type=<?=$_GET['type']?>&listid=" + listid;
		});

	}

	jQuery("#update").click(function(){
		update_position.submit();
	});
</script>