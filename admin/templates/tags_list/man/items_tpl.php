<!-- Begin Bảng Điều Khiển -->
<div class="breadcrumbwidget">
    <ul class="breadcrumb">
        <li><a href="index.php">Bảng điều khiển</a> <span class="divider">/</span></li>
        <li class="active">Danh sách <?=$config['tags_list'][$type]['title_main']?></li>
    </ul>
</div>
<!-- End Bảng Điều Khiển -->

<div class="pagetitle">
	<h1><?=$config['tags_list'][$type]['title_main']?></h1>
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

				<form action="index.php?com=tags_list&act=man&type=<?=$_GET['type']?>" method="POST" name="update_position">
					<table class="table table-bordered" <?=(count($items))?'id="dyntable"':''?>>
						<thead>
							<tr>
								<th style="width:3%" align="center"><input type="checkbox" name="selectall" id="selectall" class="checkall" /></th>
								<th>STT</th>
								<?php if($config['tags_list'][$type]['show_images']=='true') { ?>
						        	<th>Hình đại diện</th>
						    	<?php } ?>
						        <th>Tiêu đề</th>
						        <th>Mục liên kết</th>
						        <?php foreach ($config['tags_list'][$type]['check'] as $key => $value) { ?>
								  	<th><?=$value?></th>
								<?php } ?>
							  	<th>Hiển thị</th>
								<th>Thao tác</th>
							</tr>
						</thead>

						<?php if(empty($items)) echo "<tr><td colspan='15'>Không có mục nào ...</td></tr>";

						else { for($i=0, $count=count($items); $i<$count; $i++) { ?>

						<tr><input type="hidden" name="stt[id][]" value="<?=$items[$i]["id"]?>">
							<td style="width:3%;" align="center"><input type="checkbox" name="chose" id="chose" value="<?=$items[$i]['id']?>" class="chon" /></td>	
							<td style="width:5%;"><input type="number" min="0" name="stt[stt][]" id="stt" value="<?=$items[$i]['stt']?>" data-id="<?=$items[$i]['id']?>" data-table="tags_list" class="selectinput update_stt" /></td>
							<?php if($config['tags_list'][$type]['show_images']=='true') { ?>
								<td style="width:3%;">
									<a href="index.php?com=tags_list&act=edit&id=<?=$items[$i]['id']?>&type=<?=$_GET['type']?>" title="Cập nhật"><img style="max-width: 60px;max-height: 60px;margin: auto;" onerror="src='img/noimage.png'" src="<?=_upload_tags?><?=$items[$i]['photo']?>" alt="<?=$items[$i]['tenvi']?>"></a>
								</td>
							<?php } ?>
							<td style="width:20%;">
								<a href="index.php?com=tags_list&act=edit&id=<?=$items[$i]['id']?>&type=<?=$_GET['type']?>" title="Cập nhật"><?=$items[$i]['tenvi']?></a>
							</td>
							<td style="width:10%;">
								<?php
									$d->reset();
									$sql = "select * from table_tags_list where id='".$items[$i]['id']."' and type='".$_REQUEST['type']."'";
									$d->query($sql);
									$name_tag = $d->fetch_array();
									$d->reset();
									
									$sql_tags = "select * from table_".$config['tags_list'][$type]['table']." where id IN (select id_pro from table_tags_group where id_tags='".$name_tag['id']."') and type='".$_REQUEST['type']."' order by stt asc,ngaytao desc";
									$d->query($sql_tags);
									$item_lienket = $d->result_array();
								?>
								<a href="index.php?com=tags_list&act=edit&id=<?=$items[$i]['id']?>&type=<?=$_GET['type']?>" title="(<?=count($item_lienket)?>) liên kết">(<?=count($item_lienket)?>) liên kết</a>
							</td>
							<?php foreach ($config['tags_list'][$type]['check'] as $key => $value) { ?>
							  	<td style="width:5%;" class="action">
									<a data-table="tags_list" data-id="<?=$items[$i]['id']?>" data-loai="<?=$key?>" class="show_ajax" title="<?=$value?>">
										<?php if($items[$i][$key]>0) { ?>
											<span class="iconfa-ok-circle text-success"></span>
										<?php } else { ?>
											<span class="iconfa-ban-circle "></span>
										<?php } ?>
									</a>
								</td>
							<?php } ?>
							<td style="width:5%;" class="action">
								<a data-table="tags_list" data-id="<?=$items[$i]['id']?>" data-loai="hienthi" class="show_ajax" title="Hiển thị">
									<?php if($items[$i]['hienthi']>0) { ?>
										<span class="iconfa-ok-circle text-success"></span>
									<?php } else { ?>
										<span class="iconfa-ban-circle "></span>
									<?php } ?>
								</a>
							</td>
							<td style="width:5%;" class="action">
								<a href="index.php?com=tags_list&act=edit&id=<?=$items[$i]['id']?>&type=<?=$_GET['type']?>" title="Sửa"><span class="iconfa-edit"></span></a>&nbsp&nbsp
								<a href="index.php?com=tags_list&act=delete&id=<?=$items[$i]['id']?>&type=<?=$_GET['type']?>" onClick="if(!confirm('Bạn có chắc muốn xóa mục này ?')) return false;" title="Xóa"><span class="iconfa-trash"></span></a>
							</td>
						</tr>

						<?php }	} ?>
					</table>
				</form>

				<!-- Begin Paging -->
				<div class="pagination pagination-centered" <?=($paging['paging'] == "<ul></ul>")?'style="height: 0px; margin: 0px;"':''?>><?=$paging['paging']?></div>
				<!-- End Paging -->

				<!-- Begin Button Action -->
				<div class="actionfull">
					<a href="index.php?com=tags_list&act=add&type=<?=$_GET['type']?>" class="btn btn-rounded"><icon class="icon-plus"></icon> Thêm mới</a>
					<button class="btn btn-rounded" id="delall"><span class="icon-trash"></span> Xóa nhiều</button>
					<!-- <button class="btn btn-rounded" id="update"><span class="icon-refresh"></span> Cập nhật STT</button> -->
				</div>
				<!-- End Button Action -->
			</div>
		</div>
	</div>
</div>

<script>
	jQuery('#tabs').tabs();
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
			if (hoi==true) document.location = "index.php?com=tags_list&act=delete&type=<?=$_GET['type']?>&listid=" + listid;
		});
	}

	jQuery("#update").click(function(){
		update_position.submit();
	});

	function doEnter(evt){
		var key;
		if(evt.keyCode == 13 || evt.which == 13){
			onSearch(evt);
		}
	}
	
	function onSearch(evt){	
		var keyword = document.getElementById("keyword").value;		
			location.href = "index.php?com=tags_list&act=man&type=<?=$_GET['type']?>&keyword="+keyword;
			loadPage(document.location);
	}
</script>