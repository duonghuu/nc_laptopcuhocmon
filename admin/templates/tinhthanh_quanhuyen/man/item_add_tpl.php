<?php 
	function get_main_list()
	{
		$sql="select * from table_tinhthanh order by id asc";
		$stmt=mysql_query($sql);
		$str='<select id="id_list" name="id_list" onchange="select_onchange_1()" class="chzn-select">
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
		$str='<select id="id_cat" name="id_cat" onchange="select_onchange_2()" class="chzn-select">
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
		$sql="select ten,id from table_phuongxa where id_cat='".$_REQUEST['id_cat']."' and id_list='".$_REQUEST['id_list']."' order by id asc";
		$stmt=mysql_query($sql);
		$str='
		<select id="id_item" name="id_item" class="chzn-select">
		<option value="">Phường xã</option>			
		';
		while ($row=@mysql_fetch_array($stmt)) 
		{
			if($row["id"]==$_REQUEST['id_item'])
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
        <li class="active">Chi tiết <?=$config['tinhthanh_quanhuyen']['title_sub']?></li>
    </ul>
</div>
<!-- End Bảng Điều Khiển -->

<div class="pagetitle">
	<h1><?php if ($_REQUEST['act']=="edit") echo "Cập nhật"; else echo "Thêm mới"; ?></h1>
</div>

<div class="maincontent">
	<div class="contentinner">
		<div class="row-fluid">
			<div class="span12">
				<h4 class="widgettitle nomargin shadowed"></h4>
				<div class="widgetcontent bordered shadowed nopadding">
					<form name="frm" method="post" action="index.php?com=tinhthanh_quanhuyen&act=save" enctype="multipart/form-data" class="stdform stdform2">
					    
						<?php if($config['tinhthanh_quanhuyen']['list']=='true') { ?>
					    	<p><label>Tỉnh thành:</label><span class="field"><?=get_main_list();?></span></p>
					    <?php } ?>
					    <?php if($config['tinhthanh_quanhuyen']['cat']=='true') { ?>
					    	<p><label>Quận huyện:</label><span class="field"><?=get_main_cat();?></span></p> 
					    <?php } ?>
					    <?php if($config['tinhthanh_quanhuyen']['item']=='true') { ?>
					    	<p><label>Phường xã:</label><span class="field"><?=get_main_item();?></span></p> 
					    <?php } ?>
					    
					    <?php if($config['tinhthanh_quanhuyen']['images']=='true') { ?>
                            <?php if($_GET['act']=='edit') { ?>
                                <p><label>Hình hiện tại:</label><span class="field"><img src="<?=_upload_news.$item['photo']?>" onerror="src='img/noimage.png'" alt="NO PHOTO" style="max-width: 150px"/></span></p>
                            <?php } ?>
                            <p><label>Upload hình ảnh:</label><span class="field"><input type="file" name="file" class="uniform-file" /> <strong><?php echo $config['tinhthanh_quanhuyen']['img_type']." - Width: ".$config['tinhthanh_quanhuyen']['width']." px - Height: ".$config['tinhthanh_quanhuyen']['height']." px"?></strong></span></p>
                        <?php } ?>

						<?php if($config['tinhthanh_quanhuyen']['dienthoai']=='true') { ?>
					    	<p><label>Điện thoại:</label><span class="field"><input type="text" name="dienthoai" value="<?=@$item['dienthoai']?>" class="input-xxlarge" placeholder=" Số điện thoại"/> <b></b></span></p>
					    <?php } ?>

					    <?php if($config['tinhthanh_quanhuyen']['map']=='true') { ?>
						    <p>
								<label>Google Map:</label>
								<span class="field">
									<input type="text" name="toado" value="<?=@$item['toado']?>" class="input-xxlarge" placeholder="Tọa độ Google Map"/>
									<strong><a href="https://www.google.com/maps" target="_blank" title="Lấy tọa độ Google Map"> ( Lấy tọa độ )</a></strong>
								</span>
							</p>
						<?php } ?>

						<?php if($config['tinhthanh_quanhuyen']['map_iframe']=='true') { ?>
							<p>
								<label>Google Map (Iframe):</label>
								<span class="field">
									<input type="text" name="toado_iframe" value="<?=@$item['toado_iframe']?>" class="input-xxlarge" placeholder="Tọa độ Google Map nhúng bằng Iframe"/>
									<strong><a href="https://www.google.com/maps" target="_blank" title="Lấy mã nhúng Google Map"> ( Lấy mã nhúng )</a></strong>
								</span>
							</p>
						<?php } ?>

						<?php if($config['tinhthanh_quanhuyen']['phanloai']=='true') { ?>
						    <p><label>Loại:</label>
						    	<span class="field">
						    		<input type="radio" <?php if($item['loai']==1&&$item['loai']!='') echo 'checked="checked"';?> name="loai" value="1" class="input-xxlarge"/> Showroom
						    		<input type="radio" <?php if($item['loai']==0&&$item['loai']!='') echo 'checked="checked"';?> name="loai" value="0" class="input-xxlarge"/> Đại lý
						    	</span>
						    </p>
						<?php } ?>

					    <!-- Begin Tab -->
                        <div id="tabs">
                            <ul>
                                <?php foreach($config['lang'] as $key => $value) { ?>
                                    <li><a href="#tabs-<?=$key?>"><?=$value?></a></li>
                                <?php } ?>
                            </ul>
                            <div class="clear"></div>
                            <?php foreach($config['lang'] as $key => $value) { ?>
                                <div id="tabs-<?=$key?>">
                                    <p><label>Tên (<?=$key?>):</label><span class="field"><input type="text" name="ten<?=$key?>" value="<?=@$item['ten'.$key]?>" class="input-xxlarge" placeholder="Tên (<?=$key?>)"/></span></p>
                                    <?php if($config['tinhthanh_quanhuyen']['mota']=='true') { ?>
                                        <p><label>Mô tả (<?=$key?>):</label></p></br></br>
                                        <p><textarea name="mota<?=$key?>" id="mota<?=$key?>" rows="5" cols="80" style="width: 100%; box-sizing: border-box;" class="tinymce"><?=@$item['mota'.$key]?></textarea></p>
                                        <?php if($config['tinhthanh_quanhuyen']['mota_cke']=='true') { ?>
                                            <script type="text/javascript">
                                                var mota<?=$key?> = CKEDITOR.replace('mota<?=$key?>');
                                            </script>
                                        <?php } ?>
                                    <?php } ?>
                                    <?php if($config['tinhthanh_quanhuyen']['noidung']=='true') { ?>
                                        <p><label>Nội dung (<?=$key?>):</label></p></br></br>
                                        <p><textarea name="noidung<?=$key?>" id="noidung<?=$key?>" rows="5" cols="80" style="width: 100%; box-sizing: border-box;" class="tinymce"><?=@$item['noidung'.$key]?></textarea></p>
                                        <?php if($config['tinhthanh_quanhuyen']['noidung_cke']=='true') { ?>
                                            <script type="text/javascript">
                                                var noidung<?=$key?> = CKEDITOR.replace('noidung<?=$key?>');
                                            </script>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                        <!-- End Tab -->

					    <p><label>STT:</label> <span class="field"><input type="number" min="0" name="stt" value="<?=isset($item['stt'])?$item['stt']:1?>" style="width:30px"></span></p>

						<p><label>Hiển thị:</label><span class="field"><input type="checkbox" name="hienthi" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?>></span></p>
						
						<p class="stdformbutton">
							<input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
							<button type="submit" class="btn btn-primary"><span class="iconfa-save"></span> Lưu</button>
							<button type="reset" class="btn"><span class="iconfa-refresh"></span> Làm lại</button>
							<button type="button" onclick="javascript:window.location='index.php?com=tinhthanh_quanhuyen&act=man'" class="btn"><span class="iconfa-off"></span> Thoát</button>
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
		var url = "index.php?com=tinhthanh_quanhuyen&act=<?php if($_REQUEST['act']=='edit') echo 'edit'; else echo 'add';?><?php if($_REQUEST['id']!='') echo"&id=".$_REQUEST['id']; ?>";

		if(list > 0) url += "&id_list="+list;

		window.location = url;
	}
	function select_onchange_2()
	{				
		var list = jQuery("#id_list").val();
		var cat = jQuery("#id_cat").val();
		var url = "index.php?com=tinhthanh_quanhuyen&act=<?php if($_REQUEST['act']=='edit') echo 'edit'; else echo 'add';?><?php if($_REQUEST['id']!='') echo"&id=".$_REQUEST['id']; ?>";

		if(list > 0) url += "&id_list="+list;
		if(cat > 0) url += "&id_cat="+cat;

		window.location = url;
	}
</script>