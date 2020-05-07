<?php 
	function get_main_list()
	{
		$sql="select * from table_tinhthanh order by id asc";
		$stmt=mysql_query($sql);
		$str='<select id="id_list" name="id_list" onchange="select_onchange_1()" class="chzn-select my-chzn-select">
			<option value="0">Tỉnh thành</option>
			';
		while ($row=@mysql_fetch_array($stmt)) 
		{
			if($row["id"]==(int)@$_REQUEST["id_list"])
				$selected="selected";
			else 
				$selected="";
			$str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten"].'</option>';
		}
		$str.='</select>';
		return $str;
	}

	function get_main_cat()
	{
		$sql="select * from table_quanhuyen WHERE id_list = ".$_REQUEST['id_list']." order by id asc";
		$stmt=mysql_query($sql);
		$str='<select id="id_cat" name="id_cat" onchange="select_onchange_2()" class="chzn-select my-chzn-select">
			 <option value="0">Quận huyện</option>
			';
		while ($row=@mysql_fetch_array($stmt)) 
		{
			if($row["id"]==(int)@$_REQUEST["id_cat"])
				$selected="selected";
			else 
				$selected="";
			$str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten"].'</option>';			
		}
		$str.='</select>';
		return $str;
	}

	function get_main_item()
	{
		$sql="select * from table_phuongxa where id_list = ".$_REQUEST['id_list']." and id_cat = ".$_REQUEST['id_cat']." order by id asc";
		$stmt=mysql_query($sql);
		$str='<select id="id_item" name="id_item" onchange="select_onchange_3()" class="chzn-select my-chzn-select">
			 <option value="0">Phường xã</option>
			';
		while ($row=@mysql_fetch_array($stmt)) 
		{
			if($row["id"]==(int)@$_REQUEST["id_item"])
				$selected="selected";
			else 
				$selected="";
			$str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten"].'</option>';			
		}
		$str.='</select>';
		return $str;
	}
?>

<!-- Begin Bảng Điều Khiển -->
<div class="breadcrumbwidget">
    <ul class="breadcrumb">
        <li><a href="index.php">Bảng điều khiển</a> <span class="divider">/</span></li>
        <li class="active">Danh sách <?=$config['tinhthanh_quanhuyen']['title_sub']?></li>
    </ul>
</div>
<!-- End Bảng Điều Khiển -->

<div class="pagetitle">
	<h1>Danh sách <?=$config['tinhthanh_quanhuyen']['title_sub']?></h1>
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

				<!-- Begin Category -->
				<?php if($config['tinhthanh_quanhuyen']['list']==true) { ?>
			  		<th><?=get_main_list()?></th>
			  	<?php } ?>
			  	<?php if($config['tinhthanh_quanhuyen']['cat']==true) { ?>
			  		<th><?=get_main_cat()?></th>
			  	<?php } ?>
			  	<?php if($config['tinhthanh_quanhuyen']['item']==true) { ?>
			  		<th><?=get_main_item()?></th>
			  	<?php } ?>
			  	<!-- End Category -->

				<form action="index.php?com=tinhthanh_quanhuyen&act=man" method="POST" name="update_position">
					<table class="table table-bordered" <?=(count($items))?'id="dyntable"':''?>>
						<thead>
							<tr>
								<th style="width:3%" align="center"><input type="checkbox" name="selectall" id="selectall" class="checkall" /></th>
								<th>STT</th>
						        <th>Tiêu đề</th>
							  	<?php foreach ($config['tinhthanh_quanhuyen']['check'] as $key => $value) { ?>
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
							<td style="width:5%;"><input type="number" min="0" name="stt[stt][]" id="stt" value="<?=$items[$i]['stt']?>" data-id="<?=$items[$i]['id']?>" data-table="chinhanh" class="selectinput update_stt" /></td>
							<td style="width:20%;">
								<a href="index.php?com=tinhthanh_quanhuyen&act=edit&id_list=<?=$items[$i]['id_list']?>&id_cat=<?=$items[$i]['id_cat']?>&id_item=<?=$items[$i]['id_item']?>&id=<?=$items[$i]['id']?>" title="Cập nhật"><?=$items[$i]['tenvi']?></a>
							</td>
							<?php foreach ($config['tinhthanh_quanhuyen']['check'] as $key => $value) { ?>
							  	<td style="width:5%;" class="action">
									<a data-table="chinhanh" data-id="<?=$items[$i]['id']?>" data-loai="<?=$key?>" class="show_ajax" title="<?=$value?>">
										<?php if($items[$i][$key]>0) { ?>
											<span class="iconfa-ok-circle text-success"></span>
										<?php } else { ?>
											<span class="iconfa-ban-circle "></span>
										<?php } ?>
									</a>
								</td>
							<?php } ?>
							<td style="width:5%;" class="action">
								<a data-table="chinhanh" data-id="<?=$items[$i]['id']?>" data-loai="hienthi" class="show_ajax" title="Hiển thị">
									<?php if($items[$i]['hienthi']>0) { ?>
										<span class="iconfa-ok-circle text-success"></span>
									<?php } else { ?>
										<span class="iconfa-ban-circle "></span>
									<?php } ?>
								</a>
							</td>
							<td style="width:5%;" class="action">
								<a href="index.php?com=tinhthanh_quanhuyen&act=edit&id_list=<?=$items[$i]['id_list']?>&id_cat=<?=$items[$i]['id_cat']?>&id_item=<?=$items[$i]['id_item']?>&id=<?=$items[$i]['id']?>" title="Sửa"><span class="iconfa-edit"></span></a>&nbsp&nbsp
								<a href="index.php?com=tinhthanh_quanhuyen&act=delete&id=<?=$items[$i]['id']?>" onClick="if(!confirm('Bạn có chắc muốn xóa mục này ?')) return false;" title="Xóa"><span class="iconfa-trash"></span></a>
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
					<a href="index.php?com=tinhthanh_quanhuyen&act=add" class="btn btn-rounded"><icon class="icon-plus"></icon> Thêm mới</a>
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
			if (hoi==true) document.location = "index.php?com=tinhthanh_quanhuyen&act=delete&listid=" + listid;
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
			location.href = "index.php?com=tinhthanh_quanhuyen&act=man&keyword="+keyword;
			loadPage(document.location);
	}

	function select_onchange_1()
	{
		var list = jQuery("#id_list").val();
		var url = "index.php?com=tinhthanh_quanhuyen&act=man";

		if(list > 0) url += "&id_list="+list;

		window.location = url;
	}

	function select_onchange_2()
	{
		var list = jQuery("#id_list").val();
		var cat = jQuery("#id_cat").val();
		var url = "index.php?com=tinhthanh_quanhuyen&act=man";

		if(list > 0) url += "&id_list="+list;
		if(cat > 0) url += "&id_cat="+cat;

		window.location = url;
	}

	function select_onchange_3()
	{
		var list = jQuery("#id_list").val();
		var cat = jQuery("#id_cat").val();
		var item = jQuery("#id_item").val();
		var url = "index.php?com=tinhthanh_quanhuyen&act=man";

		if(list > 0) url += "&id_list="+list;
		if(cat > 0) url += "&id_cat="+cat;
		if(item > 0) url += "&id_item="+item;

		window.location = url;
	}
</script>