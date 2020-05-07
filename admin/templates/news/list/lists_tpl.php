<!-- Begin Bảng Điều Khiển -->
<div class="breadcrumbwidget">
    <ul class="breadcrumb">
        <li><a href="index.php">Bảng điều khiển</a> <span class="divider">/</span></li>
        <li class="active">Danh sách <?=$config['news'][$type]['title_main_list']?></li>
    </ul>
</div>
<!-- End Bảng Điều Khiển -->

<div class="pagetitle">
	<h1><?=$config['news'][$type]['title_main_list']?></h1>
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
				<span>&nbsp&nbsp<?php echo isset($_REQUEST['keyword'])?"Kết quả tìm kiếm cho từ khóa [ <b>".$_REQUEST['keyword']."</b> ]":""; ?></span>
				<!-- End Search -->

				<form action="index.php?com=news&act=man_list&type=<?=$_GET['type']?>" method="POST" name="update_position">
					<table class="table table-bordered" <?=(count($items))?'id="dyntable"':''?>>
						<thead>
							<tr>
								<th style="width:3%" align="center"><input type="checkbox" name="selecteall" id="selecteall" class="checkall" /></th>
								<th>STT</th>
								<?php if($config['news'][$type]['show_images_list']=='true') { ?>
						        	<th>Hình đại diện</th>
						    	<?php } ?>
								<th>Tên danh mục</th>
								<?php if(count($config['news'][$type]['multipic_list_arr'])>0) { ?>
							        <?php foreach ($config['news'][$type]['multipic_list_arr'] as $key => $value) { ?>
							        	<th><?=$value['title_sub_photo']?></th>
							        <?php } ?>
							    <?php } ?>
								<?php foreach ($config['news'][$type]['check_list'] as $key => $value) { ?>
								  	<th><?=$value?></th>
								<?php } ?>
						       	<th>Hiển thị</th>
						       	<th>Thao tác</th>
							</tr>
						</thead>

						<?php if(empty($items)) echo "<tr><td colspan='10'>Không có mục nào ...</td></tr>";

						else { for($i=0, $count=count($items); $i<$count; $i++) { ?>

						<tr><input type="hidden" name="stt[id][]" value="<?=$items[$i]["id"]?>">
							<td style="width:3%;" align="center"><input type="checkbox" name="chose" id="chose" value="<?=$items[$i]['id']?>" /></td>
							<td style="width:5%;"><input type="number" min="0" name="stt[stt][]" id="stt" value="<?=$items[$i]['stt']?>" data-id="<?=$items[$i]['id']?>" data-table="news_list" class="selectinput update_stt" /></td>
							<?php if($config['news'][$type]['show_images_list']=='true') { ?>
								<td style="width:3%;">
									<a href="index.php?com=news&act=edit_list&id=<?=$items[$i]['id']?>&type=<?=$_GET['type']?>" title="Chỉnh sửa"><img style="max-width: 60px;max-height: 60px;margin: auto;" onerror="src='img/noimage.png'" src="<?=_upload_news?><?=$items[$i]['photo']?>" alt="<?=$items[$i]['tenvi']?>"></a>
								</td>
							<?php } ?>
							<td style="width:15%;" class="text-left">
								<a href="index.php?com=news&act=edit_list&id=<?=$items[$i]['id']?>&type=<?=$_GET['type']?>" title="Chỉnh sửa"><?=$items[$i]['tenvi']?></a>
							</td>
							<?php if(count($config['news'][$type]['multipic_list_arr'])>0) { ?>
								<?php foreach ($config['news'][$type]['multipic_list_arr'] as $key => $value) { ?>
						        	<td style="width:5%;">
										<?php
											$d->reset();
											$sql = "SELECT id FROM table_news_hinhanh WHERE id_photo = ".$items[$i]['id']." and type='".$_GET['type']."' and kind='man_list' and val='".$key."'";
											$d->query($sql);
											$sl_multipic = $d->result_array();
										?>
										<a href="index.php?com=news&act=man_photo&idc=<?=$items[$i]['id']?>&type=<?=$_GET['type']?>&kind=man_list&val=<?=$key?>" title="<?=count($sl_multipic)?> <?=$value['title_sub_photo']?>">(<?=count($sl_multipic)?>) <?=$value['title_sub_photo']?></a>
									</td>
						        <?php } ?>
							<?php } ?>
							<?php foreach ($config['news'][$type]['check_list'] as $key => $value) { ?>
							  	<td style="width:5%;" class="action">
									<a data-table="news_list" data-id="<?=$items[$i]['id']?>" data-loai="<?=$key?>" class="show_ajax" title="<?=$value?>">
										<?php if($items[$i][$key]>0) { ?>
											<span class="iconfa-ok-circle text-success"></span>
										<?php } else { ?>
											<span class="iconfa-ban-circle "></span>
										<?php } ?>
									</a>
								</td>
							<?php } ?>
							<td style="width:5%;" class="action">
								<a data-table="news_list" data-id="<?=$items[$i]['id']?>" data-loai="hienthi" class="show_ajax" title="Hiển thị">
									<?php if($items[$i]['hienthi']>0) { ?>
										<span class="iconfa-ok-circle text-success"></span>
									<?php } else { ?>
										<span class="iconfa-ban-circle "></span>
									<?php } ?>
								</a>
							</td>
							<td style="width:5%;" class="action">
								<a href="index.php?com=news&act=edit_list&id=<?=$items[$i]['id']?>&type=<?=$_GET['type']?>" title="Chỉnh sửa"><span class="iconfa-edit"></span></a>&nbsp&nbsp
								<a href="index.php?com=news&act=delete_list&id=<?=$items[$i]['id']?>&type=<?=$_GET['type']?>" title="Xóa" onClick="if(!confirm('Bạn có chắc muốn xóa mục này?')) return false;"><span class="iconfa-trash"></span></a>
							</td>
						</tr>

						<?php } } ?>
					</table>

				</form>

				<div class="pagination pagination-centered" <?=($paging['paging'] == "<ul></ul>")?'style="height: 0px; margin: 0px;"':''?>><?=$paging['paging']?></div>

				<div class="actionfull">
					<a href="index.php?com=news&act=add_list&type=<?=$_GET['type']?>" class="btn btn-rounded"><icon class="icon-plus"></icon> Tạo mới</a>
					<button class="btn btn-rounded" id="delall"><span class="icon-trash"></span> Xóa nhiều</button>
					<!-- <button class="btn btn-rounded" id="update"><span class="icon-refresh"></span> Cập nhật STT</button> -->
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	function doEnter(evt){
		var key;
		if(evt.keyCode == 13 || evt.which == 13){
			onSearch(evt);
		}
	}
	
	function onSearch(evt){	
		var keyword = document.getElementById("keyword").value;		
			location.href = "index.php?com=news&act=man_list&type=<?=$_GET['type']?>&keyword="+keyword;
			loadPage(document.location);
	}

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
			if (hoi==true) document.location = "index.php?com=news&act=delete_list&type=<?=$_GET['type']?>&listid=" + listid;
		});
	}

	jQuery("#update").click(function(){
		update_position.submit();
	});
</script>