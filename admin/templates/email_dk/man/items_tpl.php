<!-- Begin Bảng Điều Khiển -->
<div class="breadcrumbwidget">
    <ul class="breadcrumb">
        <li><a href="index.php">Bảng điều khiển</a> <span class="divider">/</span></li>
        <li class="active">Danh sách <?=$config['email_dk'][$type]['title_main']?></li>
    </ul>
</div>
<!-- End Bảng Điều Khiển -->

<div class="pagetitle">
	<h1><?=$config['email_dk'][$type]['title_main']?></h1>
</div>
<div class="maincontent">
	<div class="contentinner">
		<div class="row-fluid">
			<div class="span12">
				<?php if($config['email_dk'][$type]['guiemail']=='true') { ?>
					<p>Chọn email sau đó kéo xuống dưới cùng danh sách này để có thể thiết lập nội dung email muốn gửi đi</p>
				<?php } ?>
				<form action="index.php?com=email_dk&act=man&type=<?=$_GET['type']?>" method="POST" name="update_position">
					<table class="table table-bordered" <?=(count($items))?'id="dyntable"':''?>>
						<thead>
							<tr>
								<th style="width:3%" align="center"><input type="checkbox" name="selecteall" id="selecteall" class="checkall" /></th>
								<th>STT</th>
								<?php if($config['email_dk'][$type]['showtieude']=='true') { ?>
									<th>Họ tên</th>
								<?php } ?>
								<?php if($config['email_dk'][$type]['email']=='true') { ?>
									<th>Email</th>
								<?php } ?>
								<?php if($config['email_dk'][$type]['showdienthoai']=='true') { ?>
									<th>Điện thoại</th>
								<?php } ?>
								<?php if($config['email_dk'][$type]['file']=='true') { ?>
						        	<th>Download</th>
						        <?php } ?>
								<?php if($config['email_dk'][$type]['showngaytao']=='true') { ?>
									<th>Ngày tạo</th>
								<?php } ?>
								<?php if(count($config['email_dk'][$type]['tinhtrang'])>0) { ?>
									<th>Tình trạng</th>
								<?php } ?>
						       	<!-- <th>Hiển thị</th> -->
						       	<th>Thao tác</th>
							</tr>
						</thead>
						<?php if(empty($items)) echo "<tr><td colspan='10'>Chưa có email nào ...</td></tr>";
						else {
						for($i=0, $count=count($items); $i<$count; $i++){?>
						<tr><input type="hidden" name="stt[id][]" value="<?=$items[$i]["id"]?>">
							<td style="width:3%;" align="center"><input type="checkbox" name="chose" id="chose" value="<?=$items[$i]['id']?>" /></td>
							<td style="width:5%;"><input type="number" min="0" name="stt[stt][]" id="stt" value="<?=$items[$i]['stt']?>" data-id="<?=$items[$i]['id']?>" data-table="email_dk" class="selectinput update_stt" /></td>
							<?php if($config['email_dk'][$type]['showtieude']=='true') { ?>
								<td style="width:15%;">
									<a href="index.php?com=email_dk&act=edit&id=<?=$items[$i]['id']?>&type=<?=$_GET['type']?>" title="Chỉnh sửa"><?=$items[$i]['ten']?></a>
								</td>
							<?php } ?>
							<?php if($config['email_dk'][$type]['email']=='true') { ?>
								<td style="width:15%;">
									<?=$items[$i]['email']?>
								</td>
							<?php } ?>
							<?php if($config['email_dk'][$type]['showdienthoai']=='true') { ?>
								<td style="width:5%;">
									<?=$items[$i]['dienthoai']?>
								</td>
							<?php } ?>
							<?php if($config['email_dk'][$type]['file']=='true') { ?>
								<td style="width:10%;">
									<?php if($items[$i]['file']!='') { ?>
										<a href="<?=_upload_file.$items[$i]['file']?>" title="Tập tin hiện tại"><span class="icon-download"></span> Download file</a>
									<?php } else { echo "Tập tin trống"; } ?>
								</td>
							<?php } ?>
							<?php if($config['email_dk'][$type]['showngaytao']=='true') { ?>
								<td style="width:10%;"><?=date("h:i:s A - d/m/Y", $items[$i]['ngaytao'])?></td>
							<?php } ?>
							<?php if(count($config['email_dk'][$type]['tinhtrang'])>0) { ?>
								<td style="width:10%;"><?=get_tinhtrang_email($items[$i]['tinhtrang'],$type)?></td>
							<?php } ?>
							<!-- <td style="width:5%;" class="action">
								<a data-table="email_dk" data-id="<?=$items[$i]['id']?>" data-loai="hienthi" class="show_ajax" title="Hiển thị">
									<?php if($items[$i]['hienthi']>0) { ?>
										<span class="iconfa-ok-circle text-success"></span>
									<?php } else { ?>
										<span class="iconfa-ban-circle "></span>
									<?php } ?>
								</a>
							</td> -->
							<td style="width:5%;" class="action">
								<a href="index.php?com=email_dk&act=edit&id=<?=$items[$i]['id']?>&type=<?=$_GET['type']?>" title="Chỉnh sửa"><span class="iconfa-edit"></span></a>&nbsp&nbsp
								<a href="index.php?com=email_dk&act=delete&id=<?=$items[$i]['id']?>&type=<?=$_GET['type']?>" title="Xóa" onClick="if(!confirm('Bạn có chắc muốn xóa email này?')) return false;"><span class="iconfa-trash"></span></a>
							</td>
						</tr>
						<?php } }?>
					</table>
				</form>
				
				<div class="pagination pagination-centered" <?=($paging['paging'] == "<ul></ul>")?'style="height: 0px; margin: 0px;"':''?>><?=$paging['paging']?></div>
				
				<div class="actionfull">
					<a href="index.php?com=email_dk&act=add&type=<?=$_GET['type']?>" class="btn btn-rounded"><icon class="icon-plus"></icon> Tạo mới</a>
					<button class="btn btn-rounded" id="delall"><span class="icon-trash"></span> Xóa nhiều</button>
					<!-- <button class="btn btn-rounded" id="update"><span class="icon-refresh"></span> Cập nhật STT</button> -->
				</div>
				<?php if($config['email_dk'][$type]['guiemail']=='true') { ?>
				<br/>
				<h4 class="widgettitle nomargin shadowed">Gửi email đến danh sách được chọn</h4>
				<div class="widgetcontent bordered shadowed nopadding">
					<form name="frm" method="post" action="index.php?com=email_dk&act=man&type=<?=$_GET['type']?>" enctype="multipart/form-data" class="stdform stdform2">
					    <p><label>Tiêu đề email:</label><span class="field"><input type="text" name="tieude" class="input-xxlarge" placeholder="Tiêu đề email" required/></span></p>
						<p><label>File đính kèm:</label><span class="field"><input type="file" name="file" class="uniform-file" /> Kiểu file hỗ trợ: <b>doc | docx | pdf | rar | zip | ppt | pptx | xls | jpg | jpeg | png | gif</b> - Tối đa <b>25Mb</b> </span></p>
						<p><label>Nội dung thông tin:</label></p>
						<p><textarea name="noidung" id="noidung" rows="15" cols="80" style="width: 80%" class="tinymce"></textarea></p>
						<p class="stdformbutton">
							<input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
							<input type="hidden" name="listemail">
							<a href="javascript:void(0)" id="sendmail" title="Gửi thư" class="btn btn-primary">Gửi thư <span class="iconfa-plane"></span> </a>
						</p>	
					</form>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>

<script>
	jQuery('.checkall').click(function(){
	   	var parentTable = jQuery(this).parents('table');										   
	   	var ch = parentTable.find('tbody input[type=checkbox]');
	   	if(jQuery(this).is(':checked')) {			
	      	//check all rows in table
	      	ch.each(function(){ 
	         	jQuery(this).attr('checked',true);
	         	jQuery(this).parent().addClass('checked');
	         	jQuery(this).parents('tr').addClass('selected');
	      	});			
	   	} else {		
	      //uncheck all rows in table
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
			if (hoi==true) document.location = "index.php?com=email_dk&act=delete&type=<?=$_GET['type']?>&listid=" + listid;
		});
	}

	if(jQuery('#sendmail').length > 0) {
		jQuery('#sendmail').click(function(){
			var listemail="";
			jQuery("input[name='chose']").each(function(){
				if (this.checked) listemail = listemail+","+this.value;
		    });
			listemail=listemail.substr(1);
			if (listemail=="") { alert("Chọn hãy chọn ít nhất 1 mục để gửi!\n"); return false;}
			hoi = confirm("Bạn có chắc muốn gửi thư đi?\n");
			if (hoi==true) { document.frm.listemail.value=listemail; document.frm.submit(); }
		});
	}

	jQuery("#update").click(function(){
		update_position.submit();
	});

	<?php if($config['email_dk'][$type]['guiemail']=='true') { ?>
		var editor = CKEDITOR.replace( 'noidung' );
	<?php } ?>
</script>