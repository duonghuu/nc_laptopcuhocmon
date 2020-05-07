<!-- Begin Bảng Điều Khiển -->
<div class="breadcrumbwidget">
    <ul class="breadcrumb">
        <li><a href="index.php">Bảng điều khiển</a> <span class="divider">/</span></li>
        <li class="active">Chi tiết địa điểm</li>
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
					<form name="frm" method="post" action="index.php?com=map&act=save" enctype="multipart/form-data" class="stdform stdform2">
						
						<?php if($config['map']['images']=='true') { ?>
                            <?php if($_GET['act']=='edit') { ?>
                                <p><label>Hình hiện tại:</label><span class="field"><img src="<?=_upload_news.$item['photo']?>" onerror="src='img/noimage.png'" alt="NO PHOTO" style="max-width: 150px"/></span></p>
                            <?php } ?>
                            <p><label>Upload hình ảnh:</label><span class="field"><input type="file" name="file" class="uniform-file" /> <strong><?php echo $config['map']['img_type']." - Width: ".$config['map']['width']." px - Height: ".$config['map']['height']." px"?></strong></span></p>
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
                                   <p><label>Địa chỉ (<?=$key?>):</label><span class="field"><input type="text" name="diachi<?=$key?>" value="<?=@$item['diachi'.$key]?>" class="input-xxlarge" placeholder="Địa chỉ (<?=$key?>)" <?php if($key=='vi') { ?> onblur="showAddress(this.value);" <?php } ?> /></span></p>
                                </div>
                            <?php } ?>
                        </div>
                        <!-- End Tab -->
                        
                        <?php if($config['map']['dienthoai']=='true') { ?>
                        	<p><label>Điện thoại: </label><span class="field"><input type="text" name="dienthoai" value="<?=@$item['dienthoai']?>" class="input-xxlarge" placeholder="Điện thoại"/></span></p>
                        <?php } ?>
                        <?php if($config['map']['email']=='true') { ?>
                        	<p><label>Email: </label><span class="field"><input type="text" name="email" value="<?=@$item['email']?>" class="input-xxlarge" placeholder="Email"/></span></p>
                        <?php } ?>

                        <p><label>Tọa độ: </label><span class="field"><input type="text" name="toado" value="<?=@$item['toado']?>" class="input-xxlarge" placeholder="Tọa độ" id="txt_location"/></span></p>
						
					    <p><label>STT: </label> <span class="field"><input type="number" min="0" name="stt" value="<?=isset($item['stt'])?$item['stt']:1?>" style="width:30px"></span></p>

						<p><label>Hiển thị: </label><span class="field"><input type="checkbox" name="hienthi" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?>></span></p>
						
						<p>
							<div class="box-map">
								<div id="map"></div>	
							</div>
						</p>

						<p class="note"><span> Kéo hình</span> <img src="http://maps.gstatic.com/mapfiles/markers2/marker.png"> <span>để dời đến địa chỉ bạn muốn ! </span></p>

						<p class="stdformbutton">
							<input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
							<button type="submit" class="btn btn-primary"><span class="iconfa-save"></span> Lưu</button>
							<button type="reset" class="btn"><span class="iconfa-refresh"></span> Làm lại</button>
							<button type="button" onclick="javascript:window.location='index.php?com=map&act=man'" class="btn"><span class="iconfa-off"></span> Thoát</button>
						</p>

					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=AIzaSyB7i5Eo6hlGSgIpQtJN01gpfoZ0i0i22xo" type="text/javascript"></script>

<script type="text/javascript">
	function load() 
	{
		if (GBrowserIsCompatible()) {
			var map = new GMap2(document.getElementById("map"));
			map.addControl(new GSmallMapControl());
			map.addControl(new GMapTypeControl());

			var center = new GLatLng(<?php if($item['toado']!='') echo $item['toado']; else echo $config['locationdefault']?>);
			map.setCenter(center, 15);
			geocoder = new GClientGeocoder();

			var marker = new GMarker(center, {draggable: true});  
			map.addOverlay(marker);   

			document.getElementById("txt_location").value = center.lat().toFixed(6) +','+center.lng().toFixed(6);
			GEvent.addListener(marker, "dragend", function() {
				var point = marker.getPoint();
				map.panTo(point);
				document.getElementById("txt_location").value = point.lat().toFixed(6) +','+point.lng().toFixed(6);
			});

			GEvent.addListener(map, "moveend", function() {
			  	map.clearOverlays();
				var center = map.getCenter();
				var marker = new GMarker(center, {draggable: true});
				map.addOverlay(marker);
				document.getElementById("txt_location").value = center.lat().toFixed(6) +','+center.lng().toFixed(6);
				GEvent.addListener(marker, "dragend", function() {
					var point =marker.getPoint();
					map.panTo(point);
					document.getElementById("txt_location").value = point.lat().toFixed(6) +','+point.lng().toFixed(6);
				});
			});
		}
	}

	function showAddress(address) 
	{
		var map = new GMap2(document.getElementById("map"));
		map.addControl(new GSmallMapControl());
		map.addControl(new GMapTypeControl());
		if (geocoder) {
			geocoder.getLatLng(
				address,
				function(point) {
				    if (!point) {
				      alert(address + " not found");
				    } else {
				        document.getElementById("txt_location").value = point.lat().toFixed(6) +','+point.lng().toFixed(6);
						map.clearOverlays()
						map.setCenter(point, 14);
						var marker = new GMarker(point, {draggable: true});  
						map.addOverlay(marker);

						GEvent.addListener(marker, "dragend", function() {
							var pt = marker.getPoint();
							map.panTo(pt);
							document.getElementById("txt_location").value = pt.lat().toFixed(6) +','+pt.lng().toFixed(6);
						});
						GEvent.addListener(map, "moveend", function() {
						  	map.clearOverlays();
							var center = map.getCenter();
							var marker = new GMarker(center, {draggable: true});
							map.addOverlay(marker);
							document.getElementById("txt_location").value = center.lat().toFixed(6) +','+center.lng().toFixed(6);
							GEvent.addListener(marker, "dragend", function() {
								var pt = marker.getPoint();
								map.panTo(pt);
								document.getElementById("txt_location").value = pt.lat().toFixed(6) +','+pt.lng().toFixed(6);
							});

						});
				    }
				}
			);
		}
	}
</script>