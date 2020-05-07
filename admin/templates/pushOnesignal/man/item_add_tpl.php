<!-- <link rel="stylesheet" type="text/css" href="css/jquery.datetimepicker.css"/ > -->

<!-- Begin Bảng Điều Khiển -->
<div class="breadcrumbwidget">
    <ul class="breadcrumb">
        <li><a href="index.php">Bảng điều khiển</a> <span class="divider">/</span></li>
        <li class="active">Chi tiết thông báo đẩy</li>
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
					<form name="frm" method="post" action="index.php?com=pushOnesignal&act=save" enctype="multipart/form-data" class="stdform stdform2">
					    
                        <?php if($_GET['act']=='edit') { ?>
                            <p><label>Hình hiện tại:</label><span class="field"><img src="<?=_upload_sync.$item['photo']?>" onerror="src='img/noimage.png'" alt="NO PHOTO" style="max-width: 150px"/></span></p>
                        <?php } ?>
                        <p><label>Upload hình ảnh:</label><span class="field"><input type="file" name="file" class="uniform-file" onchange="imgreview(this)" /> <strong>.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF - Width: 100px - Height: 100px</strong></span></p>
					   	
						<p><label>Tiêu đề:</label><span class="field"><input type="text" name="name" id="name" value="<?=@$item['name']?>" class="input-xxlarge" placeholder="Tiêu đề"/></span></p>
						
						<p><label>Link:</label><span class="field"><input type="text" name="link" id="link" value="<?=@$item['link']?>" class="input-xxlarge" placeholder="Link"/></span></p>

						<!-- <p><label>Số lần ghi:</label><span class="field"><input type="text" name="number" value="<?=@$item['number']?>" class="input-small" placeholder="Số lần ghi"/></span></p> -->
						
						<!-- <p><label>Số lần còn:</label><span class="field"><input type="text" value="<?=@$item['solancon']?>" class="input-small" readonly placeholder="Số lần còn"/> <strong>Khi "Số lần còn" bằng 0. Vui lòng cập nhật lại "Số lần ghi"</strong></span></p> -->

						<!-- <p><label>Thời gian bắt đầu đẩy tin:</label><span class="field"><input type="text" name="time_star" value="<?=$item['gio'].':'.$item['phut']?>" readonly style="cursor: pointer" class="input-small datetimepicker2" placeholder="Thời gian bắt đầu đẩy tin"/></span></p> -->
						
						<!-- <p><label>Thời gian:</label><span class="field"><input type="number" name="times" value="<?=$item['times']?>" class="input-small" placeholder="Thời gian"/> <strong>Thời gian thực hiện thông báo đẩy tính bằng phút. VD: 1h thực hiện thông báo 1 lần. Nhập 60</strong></span></p> -->
						
						<p><label>Mô tả:</label><span class="field"><textarea name="description" id="description" rows="5" cols="80" style="width: 100%; box-sizing: border-box;" class="tinymce"><?=@$item['description']?></textarea></span></p>

					    <p><label>STT:</label> <span class="field"><input type="number" min="0" name="stt" value="<?=isset($item['stt'])?$item['stt']:1?>" style="width:30px"></span></p>

						<h4 class="widgettitle nomargin shadowed">Xem trước thông báo đẩy</h4>
					    <div class="reviewOnesignal">
							<div class="img">
								<img class="imgview" onerror="src='img/noimage.png'" src="<?=_upload_sync.$item['photo']?>" alt="images">
							</div>
							<div class="detail">
								<h2 id="caption"><?=empty($item['name'])?'OneSignal Web Push Notification':$item['name'] ?></h2>
								<h3 id="desc"><?=empty($item['description'])?'This is an example of web push notifications.':$item['description'] ?></h3>
								<h4 id="linkto"><?=empty($item['link'])?'https://youlink.com':$item['link'] ?></h4>
							</div>
						</div>
						
						<p class="stdformbutton">
							<input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
							<button type="submit" class="btn btn-primary"><span class="iconfa-save"></span> Lưu</button>
							<button type="reset" class="btn"><span class="iconfa-refresh"></span> Làm lại</button>
							<button type="button" onclick="javascript:window.location='index.php?com=pushOnesignal&act=man'" class="btn"><span class="iconfa-off"></span> Thoát</button>
						</p>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- <script src="js/jquery.datetimepicker.full.min.js"></script> -->
<script type="text/javascript">
	function imgreview(input)
	{
		if (input.files && input.files[0])
		{
			var filerd = new FileReader();
			filerd.onload = function(e){
				jQuery('.imgview').attr('src',e.target.result);
			};
			filerd.readAsDataURL(input.files[0]);
		}
	}
	jQuery(document).ready(function() {
		// jQuery('.datetimepicker2').datetimepicker({
		// 	datepicker:false,
		// 	format:'H:i'
		// });	
		// jQuery.datetimepicker.setLocale('de');
		// jQuery('#datetimepicker1').datetimepicker({
		// 	i18n:{
		// 		de:{
		// 			months:[
		// 			'Januar','Februar','März','April',
		// 			'Mai','Juni','Juli','August',
		// 			'September','Oktober','November','Dezember',
		// 			],
		// 			dayOfWeek:[
		// 			"So.", "Mo", "Di", "Mi", 
		// 			"Do", "Fr", "Sa.",
		// 			]
		// 		}
		// 	},
		// 	timepicker:false,
		// 	format:'d.m.Y'
		// });
		jQuery('#name').keyup(function(event) {
			document.getElementById("caption").innerHTML = this.value;
		});
		jQuery('#name').change(function(event) {
			document.getElementById("caption").innerHTML = this.value;
		});
		jQuery('#description').keyup(function(event) {
			document.getElementById("desc").innerHTML = this.value;
		});
		jQuery('#description').change(function(event) {
			document.getElementById("desc").innerHTML = this.value;
		});
		jQuery('#link').keyup(function(event) {
			document.getElementById("linkto").innerHTML = this.value;
		});
		jQuery('#link').change(function(event) {
			document.getElementById("linkto").innerHTML = this.value;
		});
	});
</script>