<?php
	function get_main_list()
	{
		$sql="select ten, id from table_tinhthanh order by id asc";
		$stmt=mysql_query($sql);
		$str='<select id="id_list" name="id_list" onchange="select_onchange_1()" class="chzn-select">
			  <option value="">Tỉnh thành</option>';
		while ($row=@mysql_fetch_array($stmt)) 
		{
			if($row["id"]==$_REQUEST['id_list'])
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
		$sql="select ten,id from table_quanhuyen where id_list='".$_REQUEST['id_list']."' order by id asc";
		$stmt=mysql_query($sql);
		$str='
		<select id="id_cat" name="id_cat" class="chzn-select">
		<option value="">Quận huyện</option>			
		';
		while ($row=@mysql_fetch_array($stmt)) 
		{
			if($row["id"]==$_REQUEST['id_cat'])
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
        <li class="active">Chi tiết phường xã</li>
    </ul>
</div>
<!-- End Bảng Điều Khiển -->

<div class="pagetitle">
	<h1><?php if ($_REQUEST['act']=="edit_item") echo "Cập nhật"; else echo "Thêm mới"; ?></h1>
</div>

<div class="maincontent">
	<div class="contentinner">
		<div class="row-fluid">
			<div class="span12">
				<h4 class="widgettitle nomargin shadowed"></h4>
				<div class="widgetcontent bordered shadowed nopadding">
					<form name="frm" method="post" action="index.php?com=tinhthanh_quanhuyen&act=save_item" enctype="multipart/form-data" class="stdform stdform2">
					    <p><label>Tỉnh thành:</label><span class="field"><?=get_main_list();?></span></p>
					    <p><label>Quận huyện:</label><span class="field"><?=get_main_cat();?></span></p>
                        
                        <p><label>Tiêu đề:</label><span class="field"><input type="text" name="ten" value="<?=@$item['ten']?>" class="input-xxlarge" required placeholder="Tiêu đề"/></span></p>

                        <?php if($config['tinhthanh_quanhuyen']['giaship']=='true') { ?>
					    	<p><label>Giá SHIP:</label><span class="field"><input type="text" name="gia" value="<?=@$item['gia']?>" class="input-xxlarge" required placeholder="Giá SHIP"/> <strong>VNĐ</strong></span></p>
					    <?php } ?>

					    <p><label>STT:</label> <span class="field"><input type="number" min="0" name="stt" value="<?=isset($item['stt'])?$item['stt']:1?>" style="width:30px"></span></p>

						<p><label>Hiển thị:</label><span class="field"><input type="checkbox" name="hienthi" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?>></span></p>
						
						<p class="stdformbutton">
							<input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
							<button type="submit" class="btn btn-primary"><span class="iconfa-save"></span> Lưu</button>
							<button type="reset" class="btn"><span class="iconfa-refresh"></span> Làm lại</button>
							<button type="button" onclick="javascript:window.location='index.php?com=tinhthanh_quanhuyen&act=man_item'" class="btn"><span class="iconfa-off"></span> Thoát</button>
						</p>	
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	function select_onchange_1()
	{				
		var list = jQuery("#id_list").val();
		var url = "index.php?com=tinhthanh_quanhuyen&act=<?php if($_REQUEST['act']=='edit_item') echo 'edit_item'; else echo 'add_item';?><?php if($_REQUEST['id']!='') echo"&id=".$_REQUEST['id']; ?>&type=<?=$_GET['type']?>";

		if(list > 0) url += "&id_list="+list;

		window.location = url;
	}
</script>