<!-- Begin Bảng Điều Khiển -->
<div class="breadcrumbwidget">
    <ul class="breadcrumb">
        <li><a href="index.php">Bảng điều khiển</a> <span class="divider">/</span></li>
        <li class="active">Quản lý size <?=$config['product'][$type]['title_main']?></li>
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
					<form name="frm" method="post" action="index.php?com=product&act=save_size&type=<?=$_GET['type']?>" enctype="multipart/form-data" class="stdform stdform2">
						
						<?php if($config['product'][$type]['size_gia']=='true') { ?>
							<p><label>Giá:</label><span class="field"><input type="text" name="gia" value="<?=@$item['gia']?>" class="input-xxlarge" placeholder="Giá *" required/></span></p>
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
                                </div>
                            <?php } ?>
                        </div>
                        <!-- End Tab -->
						
						<p><label>STT :</label><span class="field"><input type="number" min="0" name="stt" value="<?=isset($item['stt'])?$item['stt']:1?>" style="width:30px" required></span></p>
						<p><label>Hiển thị:</label><span class="field"><input type="checkbox" name="hienthi" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?>></span></p>
						<p class="stdformbutton">
							<input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
							<button type="submit" class="btn btn-primary"><span class="iconfa-save"></span> Lưu</button>
							<button type="reset" class="btn"><span class="iconfa-refresh"></span> Làm lại</button>
							<button type="button" onclick="javascript:window.location='index.php?com=product&act=man_size&type=<?=$_GET['type']?>'" class="btn"><span class="iconfa-off"></span> Thoát</button>
						</p>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>