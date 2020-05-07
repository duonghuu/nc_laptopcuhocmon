<!-- Begin Bảng Điều Khiển -->
<div class="breadcrumbwidget">
    <ul class="breadcrumb">
        <li><a href="index.php">Bảng điều khiển</a> <span class="divider">/</span></li>
        <li class="active">Quản lý phân quyền</li>
    </ul>
</div>
<!-- End Bảng Điều Khiển -->

<div class="maincontent">
	<div class="contentinner">
		<div class="row-fluid">
			<div class="span12">
				<h4 class="widgettitle nomargin shadowed"></h4>
				<div class="widgetcontent bordered shadowed nopadding">
					<form name="frm" method="post" action="index.php?com=user&act=save_phanquyen" enctype="multipart/form-data" class="stdform stdform2">

						<?php if(count($config['product'])>0) { ?>
						    <?php foreach($config['product'] as $key => $value) { if($value['dropdown']==true) { ?>
							    <!-- Begin Phân Quyền Sản Phẩm Có Cấp - <?=$value['title_main']?> -->
							    <div class="wrap-phanquyen">
							    	<b>Phân quyền <?=$value['title_main']?></b>
							    	<?php if($value['list']=='true') { ?>
									    <p><label>Danh mục cấp 1</label>
								    		<div class="item-phanquyen">
								    			<input name="quyen[]" type="checkbox" value="product_man_list_<?=$key?>" <?php if(in_array('product_man_list_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Xem danh sách
								    		</div>
								    		<div class="item-phanquyen">
								    			<input name="quyen[]" type="checkbox" value="product_add_list_<?=$key?>" <?php if(in_array('product_add_list_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Thêm mới
								    		</div>
								    		<div class="item-phanquyen">
												<input name="quyen[]" type="checkbox" value="product_edit_list_<?=$key?>" <?php if(in_array('product_edit_list_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Chỉnh sửa
											</div>
											<div class="item-phanquyen">
												<input name="quyen[]" type="checkbox" value="product_delete_list_<?=$key?>" <?php if(in_array('product_delete_list_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Xóa
											</div>
									    </p>
								    <?php } ?>
								    <?php if($value['cat']=='true') { ?>
									    <p><label>Danh mục cấp 2</label>
								    		<div class="item-phanquyen">
								    			<input name="quyen[]" type="checkbox" value="product_man_cat_<?=$key?>" <?php if(in_array('product_man_cat_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Xem danh sách
								    		</div>
								    		<div class="item-phanquyen">
								    			<input name="quyen[]" type="checkbox" value="product_add_cat_<?=$key?>" <?php if(in_array('product_add_cat_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Thêm mới
								    		</div>
								    		<div class="item-phanquyen">
												<input name="quyen[]" type="checkbox" value="product_edit_cat_<?=$key?>" <?php if(in_array('product_edit_cat_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Chỉnh sửa
											</div>
											<div class="item-phanquyen">
												<input name="quyen[]" type="checkbox" value="product_delete_cat_<?=$key?>" <?php if(in_array('product_delete_cat_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Xóa
											</div>
									    </p>
									<?php } ?>
									<?php if($value['item']=='true') { ?>
									    <p><label>Danh mục cấp 3</label>
								    		<div class="item-phanquyen">
								    			<input name="quyen[]" type="checkbox" value="product_man_item_<?=$key?>" <?php if(in_array('product_man_item_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Xem danh sách
								    		</div>
								    		<div class="item-phanquyen">
								    			<input name="quyen[]" type="checkbox" value="product_add_item_<?=$key?>" <?php if(in_array('product_add_item_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Thêm mới
								    		</div>
								    		<div class="item-phanquyen">
												<input name="quyen[]" type="checkbox" value="product_edit_item_<?=$key?>" <?php if(in_array('product_edit_item_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Chỉnh sửa
											</div>
											<div class="item-phanquyen">
												<input name="quyen[]" type="checkbox" value="product_delete_item_<?=$key?>" <?php if(in_array('product_delete_item_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Xóa
											</div>
									    </p>
									<?php } ?>
									<?php if($value['capbon']=='true') { ?>
									    <p><label>Danh mục cấp 4</label>
								    		<div class="item-phanquyen">
								    			<input name="quyen[]" type="checkbox" value="product_man_capbon_<?=$key?>" <?php if(in_array('product_man_capbon_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Xem danh sách
								    		</div>
								    		<div class="item-phanquyen">
								    			<input name="quyen[]" type="checkbox" value="product_add_capbon_<?=$key?>" <?php if(in_array('product_add_capbon_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Thêm mới
								    		</div>
								    		<div class="item-phanquyen">
												<input name="quyen[]" type="checkbox" value="product_edit_capbon_<?=$key?>" <?php if(in_array('product_edit_capbon_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Chỉnh sửa
											</div>
											<div class="item-phanquyen">
												<input name="quyen[]" type="checkbox" value="product_delete_capbon_<?=$key?>" <?php if(in_array('product_delete_capbon_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Xóa
											</div>
									    </p>
									<?php } ?>
									<?php if($value['nhanhieu_list']=='true') { ?>
									    <p><label>Danh mục nhãn hiệu</label>
								    		<div class="item-phanquyen">
								    			<input name="quyen[]" type="checkbox" value="product_man_nhanhieu_<?=$key?>" <?php if(in_array('product_man_nhanhieu_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Xem danh sách
								    		</div>
								    		<div class="item-phanquyen">
								    			<input name="quyen[]" type="checkbox" value="product_add_nhanhieu_<?=$key?>" <?php if(in_array('product_add_nhanhieu_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Thêm mới
								    		</div>
								    		<div class="item-phanquyen">
												<input name="quyen[]" type="checkbox" value="product_edit_nhanhieu_<?=$key?>" <?php if(in_array('product_edit_nhanhieu_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Chỉnh sửa
											</div>
											<div class="item-phanquyen">
												<input name="quyen[]" type="checkbox" value="product_delete_nhanhieu_<?=$key?>" <?php if(in_array('product_delete_nhanhieu_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Xóa
											</div>
									    </p>
									<?php } ?>
									<?php if($value['mau']=='true') { ?>
									    <p><label>Danh mục màu</label>
								    		<div class="item-phanquyen">
								    			<input name="quyen[]" type="checkbox" value="product_man_mau_<?=$key?>" <?php if(in_array('product_man_mau_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Xem danh sách
								    		</div>
								    		<div class="item-phanquyen">
								    			<input name="quyen[]" type="checkbox" value="product_add_mau_<?=$key?>" <?php if(in_array('product_add_mau_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Thêm mới
								    		</div>
								    		<div class="item-phanquyen">
												<input name="quyen[]" type="checkbox" value="product_edit_mau_<?=$key?>" <?php if(in_array('product_edit_mau_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Chỉnh sửa
											</div>
											<div class="item-phanquyen">
												<input name="quyen[]" type="checkbox" value="product_delete_mau_<?=$key?>" <?php if(in_array('product_delete_mau_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Xóa
											</div>
									    </p>
									<?php } ?>
									<?php if($value['size']=='true') { ?>
									    <p><label>Danh mục size</label>
								    		<div class="item-phanquyen">
								    			<input name="quyen[]" type="checkbox" value="product_man_size_<?=$key?>" <?php if(in_array('product_man_size_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Xem danh sách
								    		</div>
								    		<div class="item-phanquyen">
								    			<input name="quyen[]" type="checkbox" value="product_add_size_<?=$key?>" <?php if(in_array('product_add_size_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Thêm mới
								    		</div>
								    		<div class="item-phanquyen">
												<input name="quyen[]" type="checkbox" value="product_edit_size_<?=$key?>" <?php if(in_array('product_edit_size_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Chỉnh sửa
											</div>
											<div class="item-phanquyen">
												<input name="quyen[]" type="checkbox" value="product_delete_size_<?=$key?>" <?php if(in_array('product_delete_size_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Xóa
											</div>
									    </p>
									<?php } ?>
								    <p><label><?=$value['title_main']?></label>
							    		<div class="item-phanquyen">
							    			<input name="quyen[]" type="checkbox" value="product_man_<?=$key?>" <?php if(in_array('product_man_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Xem danh sách
							    		</div>
							    		<div class="item-phanquyen">
							    			<input name="quyen[]" type="checkbox" value="product_add_<?=$key?>" <?php if(in_array('product_add_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Thêm mới
							    		</div>
							    		<div class="item-phanquyen">
											<input name="quyen[]" type="checkbox" value="product_edit_<?=$key?>" <?php if(in_array('product_edit_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Chỉnh sửa
										</div>
										<div class="item-phanquyen">
											<input name="quyen[]" type="checkbox" value="product_delete_<?=$key?>" <?php if(in_array('product_delete_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Xóa
										</div>
								    </p>
									<?php if($value['multipic']=='true') { ?>
									    <p><label>Hình ảnh <?=$value['title_main']?></label>
								    		<div class="item-phanquyen">
								    			<input name="quyen[]" type="checkbox" value="product_man_photo_<?=$key?>" <?php if(in_array('product_man_photo_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Xem danh sách
								    		</div>
								    		<div class="item-phanquyen">
								    			<input name="quyen[]" type="checkbox" value="product_add_photo_<?=$key?>" <?php if(in_array('product_add_photo_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Thêm mới
								    		</div>
								    		<div class="item-phanquyen">
												<input name="quyen[]" type="checkbox" value="product_edit_photo_<?=$key?>" <?php if(in_array('product_edit_photo_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Chỉnh sửa
											</div>
											<div class="item-phanquyen">
												<input name="quyen[]" type="checkbox" value="product_delete_photo_<?=$key?>" <?php if(in_array('product_delete_photo_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Xóa
											</div>
									    </p>
									<?php } ?>
									<?php if($value['import']=='true') { ?>
									    <p><label>Import <?=$value['title_main']?></label>
								    		<div class="item-phanquyen">
								    			<input name="quyen[]" type="checkbox" value="import_capnhat_<?=$key?>" <?php if(in_array('import_capnhat_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Cập nhật
								    		</div>
									    </p>
									<?php } ?>
									<?php if($value['export']=='true') { ?>
									    <p><label>Export <?=$value['title_main']?></label>
								    		<div class="item-phanquyen">
								    			<input name="quyen[]" type="checkbox" value="export_<?=$key?>" <?php if(in_array('export_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Xuất tập tin
								    		</div>
									    </p>
									<?php } ?>
							    </div>
							    <!-- End Phân Quyền Sản Phẩm Có Cấp - <?=$value['title_main']?> -->
							<?php } } ?>
						<?php } ?>

						<?php if($config_showpagepro>0) { ?>
						    <?php foreach($config['product'] as $key => $value) { if($value['dropdown']==false) { ?>
							    <!-- Begin Phân Quyền Sản Phẩm Không Cấp - <?=$value['title_main']?> -->
							    <div class="wrap-phanquyen">
							    	<b>Phân quyền <?=$value['title_main']?></b>
									<?php if($value['mau']=='true') { ?>
									    <p><label>Danh mục màu</label>
								    		<div class="item-phanquyen">
								    			<input name="quyen[]" type="checkbox" value="product_man_mau_<?=$key?>" <?php if(in_array('product_man_mau_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Xem danh sách
								    		</div>
								    		<div class="item-phanquyen">
								    			<input name="quyen[]" type="checkbox" value="product_add_mau_<?=$key?>" <?php if(in_array('product_add_mau_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Thêm mới
								    		</div>
								    		<div class="item-phanquyen">
												<input name="quyen[]" type="checkbox" value="product_edit_mau_<?=$key?>" <?php if(in_array('product_edit_mau_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Chỉnh sửa
											</div>
											<div class="item-phanquyen">
												<input name="quyen[]" type="checkbox" value="product_delete_mau_<?=$key?>" <?php if(in_array('product_delete_mau_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Xóa
											</div>
									    </p>
									<?php } ?>
									<?php if($value['size']=='true') { ?>
									    <p><label>Danh mục size</label>
								    		<div class="item-phanquyen">
								    			<input name="quyen[]" type="checkbox" value="product_man_size_<?=$key?>" <?php if(in_array('product_man_size_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Xem danh sách
								    		</div>
								    		<div class="item-phanquyen">
								    			<input name="quyen[]" type="checkbox" value="product_add_size_<?=$key?>" <?php if(in_array('product_add_size_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Thêm mới
								    		</div>
								    		<div class="item-phanquyen">
												<input name="quyen[]" type="checkbox" value="product_edit_size_<?=$key?>" <?php if(in_array('product_edit_size_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Chỉnh sửa
											</div>
											<div class="item-phanquyen">
												<input name="quyen[]" type="checkbox" value="product_delete_size_<?=$key?>" <?php if(in_array('product_delete_size_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Xóa
											</div>
									    </p>
									<?php } ?>
								    <p><label><?=$value['title_main']?></label>
							    		<div class="item-phanquyen">
							    			<input name="quyen[]" type="checkbox" value="product_man_<?=$key?>" <?php if(in_array('product_man_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Xem danh sách
							    		</div>
							    		<div class="item-phanquyen">
							    			<input name="quyen[]" type="checkbox" value="product_add_<?=$key?>" <?php if(in_array('product_add_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Thêm mới
							    		</div>
							    		<div class="item-phanquyen">
											<input name="quyen[]" type="checkbox" value="product_edit_<?=$key?>" <?php if(in_array('product_edit_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Chỉnh sửa
										</div>
										<div class="item-phanquyen">
											<input name="quyen[]" type="checkbox" value="product_delete_<?=$key?>" <?php if(in_array('product_delete_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Xóa
										</div>
								    </p>
									<?php if($value['multipic']=='true') { ?>
									    <p><label>Hình ảnh <?=$value['title_main']?></label>
								    		<div class="item-phanquyen">
								    			<input name="quyen[]" type="checkbox" value="product_man_photo_<?=$key?>" <?php if(in_array('product_man_photo_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Xem danh sách
								    		</div>
								    		<div class="item-phanquyen">
								    			<input name="quyen[]" type="checkbox" value="product_add_photo_<?=$key?>" <?php if(in_array('product_add_photo_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Thêm mới
								    		</div>
								    		<div class="item-phanquyen">
												<input name="quyen[]" type="checkbox" value="product_edit_photo_<?=$key?>" <?php if(in_array('product_edit_photo_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Chỉnh sửa
											</div>
											<div class="item-phanquyen">
												<input name="quyen[]" type="checkbox" value="product_delete_photo_<?=$key?>" <?php if(in_array('product_delete_photo_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Xóa
											</div>
									    </p>
									<?php } ?>
									<?php if($value['import']=='true') { ?>
									    <p><label>Import <?=$value['title_main']?></label>
								    		<div class="item-phanquyen">
								    			<input name="quyen[]" type="checkbox" value="import_capnhat_<?=$key?>" <?php if(in_array('import_capnhat_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Cập nhật
								    		</div>
									    </p>
									<?php } ?>
									<?php if($value['export']=='true') { ?>
									    <p><label>Export <?=$value['title_main']?></label>
								    		<div class="item-phanquyen">
								    			<input name="quyen[]" type="checkbox" value="export_<?=$key?>" <?php if(in_array('export_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Xuất tập tin
								    		</div>
									    </p>
									<?php } ?>
							    </div>
							    <!-- End Phân Quyền Sản Phẩm Không Cấp - <?=$value['title_main']?> -->
							<?php } } ?>
						<?php } ?>

						<?php if($coupon==true) { ?>
							<!-- Begin Phân Quyền Hổ trợ trực tuyến -->
							<div class="wrap-phanquyen">
						    	<b>Phân quyền quản lý mã ưu đãi</b>
							    <p><label>Quản lý mã ưu đãi</label>
						    		<div class="item-phanquyen">
						    			<input name="quyen[]" type="checkbox" value="coupon_man" <?php if(in_array('coupon_man', $ds_quyen)) echo 'checked="checked"'; ?> >Xem danh sách
						    		</div>
						    		<div class="item-phanquyen">
						    			<input name="quyen[]" type="checkbox" value="coupon_add" <?php if(in_array('coupon_add', $ds_quyen)) echo 'checked="checked"'; ?> >Thêm mới
						    		</div>
						    		<div class="item-phanquyen">
						    			<input name="quyen[]" type="checkbox" value="coupon_edit" <?php if(in_array('coupon_edit', $ds_quyen)) echo 'checked="checked"'; ?> >Chỉnh sửa
						    		</div>
						    		<div class="item-phanquyen">
						    			<input name="quyen[]" type="checkbox" value="coupon_delete" <?php if(in_array('coupon_delete', $ds_quyen)) echo 'checked="checked"'; ?> >Xóa
						    		</div>
							    </p>
							</div>
							<!-- Begin Phân Quyền Hổ trợ trực tuyến -->
						<?php } ?>

						<?php if(count($config['tags_list'])>0) { ?>
							<!-- Begin Phân Quyền Tags -->
							<div class="wrap-phanquyen">
						    	<b>Phân quyền tags</b>
						    	<?php foreach($config['tags_list'] as $key => $value) { ?>
								    <p><label><?=$value['title_main']?></label>
							    		<div class="item-phanquyen">
							    			<input name="quyen[]" type="checkbox" value="tags_list_man_<?=$key?>" <?php if(in_array('tags_list_man_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Xem danh sách
							    		</div>
							    		<div class="item-phanquyen">
							    			<input name="quyen[]" type="checkbox" value="tags_list_add_<?=$key?>" <?php if(in_array('tags_list_add_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Thêm mới
							    		</div>
							    		<div class="item-phanquyen">
							    			<input name="quyen[]" type="checkbox" value="tags_list_edit_<?=$key?>" <?php if(in_array('tags_list_edit_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Chỉnh sửa
							    		</div>
							    		<div class="item-phanquyen">
							    			<input name="quyen[]" type="checkbox" value="tags_list_delete_<?=$key?>" <?php if(in_array('tags_list_delete_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Xóa
							    		</div>
								    </p>
								<?php } ?>
							</div>
							<!-- Begin Phân Quyền Tags -->
						<?php } ?>

						<?php if($binhluan==true) { ?>
						    <!-- Begin Phân Quyền Bình Luận -->
						    <div class="wrap-phanquyen">
						    	<b>Phân quyền bình luận</b>
							    <p><label>Bình luận</label>
						    		<div class="item-phanquyen">
						    			<input name="quyen[]" type="checkbox" value="comment_man" <?php if(in_array('comment_man', $ds_quyen)) echo 'checked="checked"'; ?> >Xem danh sách
						    		</div>
						    		<div class="item-phanquyen">
										<input name="quyen[]" type="checkbox" value="comment_edit" <?php if(in_array('comment_edit', $ds_quyen)) echo 'checked="checked"'; ?> >Trả lời
									</div>
									<div class="item-phanquyen">
										<input name="quyen[]" type="checkbox" value="comment_delete" <?php if(in_array('comment_delete', $ds_quyen)) echo 'checked="checked"'; ?> >Xóa
									</div>
							    </p>
							</div>
						    <!-- End Phân Quyền Bình Luận -->
						<?php } ?>

						<?php if(count($config['news'])>0) { ?>
							<?php foreach($config['news'] as $key => $value) { if($value['dropdown']==true) { ?>
							    <!-- Begin Phân Quyền Bài Viết <?=$value['title_main']?> Có Cấp -->
							    <div class="wrap-phanquyen">
							    	<b>Phân quyền <?=$value['title_main']?></b>
								    <?php if($value['list']=='true') { ?>
									    <p><label>Danh mục cấp 1</label>
								    		<div class="item-phanquyen">
								    			<input name="quyen[]" type="checkbox" value="news_man_list_<?=$key?>" <?php if(in_array('news_man_list_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Xem danh sách
								    		</div>
								    		<div class="item-phanquyen">
								    			<input name="quyen[]" type="checkbox" value="news_add_list_<?=$key?>" <?php if(in_array('news_add_list_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Thêm mới
								    		</div>
								    		<div class="item-phanquyen">
												<input name="quyen[]" type="checkbox" value="news_edit_list_<?=$key?>" <?php if(in_array('news_edit_list_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Chỉnh sửa
											</div>
											<div class="item-phanquyen">
												<input name="quyen[]" type="checkbox" value="news_delete_list_<?=$key?>" <?php if(in_array('news_delete_list_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Xóa
											</div>
									    </p>
									<?php } ?>
									<?php if($value['cat']=='true') { ?>
									    <p><label>Danh mục cấp 2</label>
								    		<div class="item-phanquyen">
								    			<input name="quyen[]" type="checkbox" value="news_man_cat_<?=$key?>" <?php if(in_array('news_man_cat_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Xem danh sách
								    		</div>
								    		<div class="item-phanquyen">
								    			<input name="quyen[]" type="checkbox" value="news_add_cat_<?=$key?>" <?php if(in_array('news_add_cat_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Thêm mới
								    		</div>
								    		<div class="item-phanquyen">
												<input name="quyen[]" type="checkbox" value="news_edit_cat_<?=$key?>" <?php if(in_array('news_edit_cat_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Chỉnh sửa
											</div>
											<div class="item-phanquyen">
												<input name="quyen[]" type="checkbox" value="news_delete_cat_<?=$key?>" <?php if(in_array('news_delete_cat_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Xóa
											</div>
									    </p>
									<?php } ?>
									<?php if($value['item']=='true') { ?>
									    <p><label>Danh mục cấp 3</label>
								    		<div class="item-phanquyen">
								    			<input name="quyen[]" type="checkbox" value="news_man_item_<?=$key?>" <?php if(in_array('news_man_item_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Xem danh sách
								    		</div>
								    		<div class="item-phanquyen">
								    			<input name="quyen[]" type="checkbox" value="news_add_item_<?=$key?>" <?php if(in_array('news_add_item_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Thêm mới
								    		</div>
								    		<div class="item-phanquyen">
												<input name="quyen[]" type="checkbox" value="news_edit_item_<?=$key?>" <?php if(in_array('news_edit_item_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Chỉnh sửa
											</div>
											<div class="item-phanquyen">
												<input name="quyen[]" type="checkbox" value="news_delete_item_<?=$key?>" <?php if(in_array('news_delete_item_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Xóa
											</div>
									    </p>
									<?php } ?>
								    <p><label><?=$value['title_main']?></label>
							    		<div class="item-phanquyen">
							    			<input name="quyen[]" type="checkbox" value="news_man_<?=$key?>" <?php if(in_array('news_man_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Xem danh sách
							    		</div>
							    		<div class="item-phanquyen">
							    			<input name="quyen[]" type="checkbox" value="news_add_<?=$key?>" <?php if(in_array('news_add_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Thêm mới
							    		</div>
							    		<div class="item-phanquyen">
											<input name="quyen[]" type="checkbox" value="news_edit_<?=$key?>" <?php if(in_array('news_edit_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Chỉnh sửa
										</div>
										<div class="item-phanquyen">
											<input name="quyen[]" type="checkbox" value="news_delete_<?=$key?>" <?php if(in_array('news_delete_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Xóa
										</div>
								    </p>
								    <?php if($value['multipic']=='true') { ?>
									    <p><label>Hình ảnh <?=$value['title_main']?></label>
								    		<div class="item-phanquyen">
								    			<input name="quyen[]" type="checkbox" value="news_man_photo_<?=$key?>" <?php if(in_array('news_man_photo_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Xem danh sách
								    		</div>
								    		<div class="item-phanquyen">
								    			<input name="quyen[]" type="checkbox" value="news_add_photo_<?=$key?>" <?php if(in_array('news_add_photo_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Thêm mới
								    		</div>
								    		<div class="item-phanquyen">
												<input name="quyen[]" type="checkbox" value="news_edit_photo_<?=$key?>" <?php if(in_array('news_edit_photo_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Chỉnh sửa
											</div>
											<div class="item-phanquyen">
												<input name="quyen[]" type="checkbox" value="news_delete_photo_<?=$key?>" <?php if(in_array('news_delete_photo_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Xóa
											</div>
									    </p>
									<?php } ?>
								</div>
								<!-- End Phân Quyền Bài Viết <?=$value['title_main']?> Có Cấp -->
							<?php } } ?>
						<?php } ?>

						<?php if($config_showpagenews>0) { ?>
							<!-- Begin Phân Quyền Bài Viết Không Cấp -->
						    <div class="wrap-phanquyen">
						    	<b>Phân quyền bài viết</b>
								<?php foreach($config['news'] as $key => $value) { if($value['dropdown']==false) { ?>
								    <p><label><?=$value['title_main']?></label>
							    		<div class="item-phanquyen">
							    			<input name="quyen[]" type="checkbox" value="news_man_<?=$key?>" <?php if(in_array('news_man_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Xem danh sách
							    		</div>
							    		<div class="item-phanquyen">
							    			<input name="quyen[]" type="checkbox" value="news_add_<?=$key?>" <?php if(in_array('news_add_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Thêm mới
							    		</div>
							    		<div class="item-phanquyen">
											<input name="quyen[]" type="checkbox" value="news_edit_<?=$key?>" <?php if(in_array('news_edit_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Chỉnh sửa
										</div>
										<div class="item-phanquyen">
											<input name="quyen[]" type="checkbox" value="news_delete_<?=$key?>" <?php if(in_array('news_delete_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Xóa
										</div>
								    </p>
								    <?php if($value['multipic']=='true') { ?>
									    <p><label>Hình ảnh <?=$value['title_main']?></label>
								    		<div class="item-phanquyen">
								    			<input name="quyen[]" type="checkbox" value="news_man_photo_<?=$key?>" <?php if(in_array('news_man_photo_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Xem danh sách
								    		</div>
								    		<div class="item-phanquyen">
								    			<input name="quyen[]" type="checkbox" value="news_add_photo_<?=$key?>" <?php if(in_array('news_add_photo_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Thêm mới
								    		</div>
								    		<div class="item-phanquyen">
												<input name="quyen[]" type="checkbox" value="news_edit_photo_<?=$key?>" <?php if(in_array('news_edit_photo_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Chỉnh sửa
											</div>
											<div class="item-phanquyen">
												<input name="quyen[]" type="checkbox" value="news_delete_photo_<?=$key?>" <?php if(in_array('news_delete_photo_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Xóa
											</div>
									    </p>
									<?php } ?>
								<?php } } ?>
							</div>
							<!-- End Phân Quyền Bài Viết Không Cấp -->
						<?php } ?>

						<?php if(count($config['photo'])>0) { ?>
						    <!-- Begin Phân Quyền Hình Ảnh - Video -->
						    <div class="wrap-phanquyen">
						    	<b>Phân quyền hình ảnh - video</b>

						    	<?php if(count($config['photo']['photo_background'])>0) { foreach($config['photo']['photo_background'] as $key => $value) { ?>
		                            <p><label><?=$value['title_main']?></label>
							    		<div class="item-phanquyen">
											<input name="quyen[]" type="checkbox" value="photo_photo_background_<?=$key?>" <?php if(in_array('photo_photo_background_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Chỉnh sửa
										</div>
								    </p>
		                        <?php } } ?>

		                        <?php if(count($config['photo']['photo_static'])>0) { foreach($config['photo']['photo_static'] as $key => $value) { ?>
		                            <p><label><?=$value['title_main']?></label>
							    		<div class="item-phanquyen">
											<input name="quyen[]" type="checkbox" value="photo_photo_static_<?=$key?>" <?php if(in_array('photo_photo_static_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Chỉnh sửa
										</div>
								    </p>
		                        <?php } } ?>
		                        
		                        <?php if(count($config['photo']['man_photo'])>0) { foreach($config['photo']['man_photo'] as $key => $value) { ?>
		                            <p><label><?=$value['title_main_photo']?></label>
							    		<div class="item-phanquyen">
							    			<input name="quyen[]" type="checkbox" value="photo_man_photo_<?=$key?>" <?php if(in_array('photo_man_photo_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Xem danh sách
							    		</div>
							    		<div class="item-phanquyen">
							    			<input name="quyen[]" type="checkbox" value="photo_add_photo_<?=$key?>" <?php if(in_array('photo_add_photo_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Thêm mới
							    		</div>
							    		<div class="item-phanquyen">
											<input name="quyen[]" type="checkbox" value="photo_edit_photo_<?=$key?>" <?php if(in_array('photo_edit_photo_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Chỉnh sửa
										</div>
										<div class="item-phanquyen">
											<input name="quyen[]" type="checkbox" value="photo_delete_photo_<?=$key?>" <?php if(in_array('photo_delete_photo_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Xóa
										</div>
								    </p>
		                        <?php } } ?>
							</div>
							<!-- End Phân Quyền Hình Ảnh - Video -->
						<?php } ?>

						<?php if(count($config['album'])>0) { ?>
							<!-- Begin Phân Quyền Album -->
							<div class="wrap-phanquyen">
						    	<b>Phân quyền album</b>
						    	<?php foreach($config['album'] as $key => $value) { ?>
								    <p><label><?=$value['title_main']?></label>
							    		<div class="item-phanquyen">
							    			<input name="quyen[]" type="checkbox" value="album_man_<?=$key?>" <?php if(in_array('album_man_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Xem danh sách
							    		</div>
							    		<div class="item-phanquyen">
							    			<input name="quyen[]" type="checkbox" value="album_add_<?=$key?>" <?php if(in_array('album_add_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Thêm mới
							    		</div>
							    		<div class="item-phanquyen">
											<input name="quyen[]" type="checkbox" value="album_edit_<?=$key?>" <?php if(in_array('album_edit_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Chỉnh sửa
										</div>
										<div class="item-phanquyen">
											<input name="quyen[]" type="checkbox" value="album_delete_<?=$key?>" <?php if(in_array('album_delete_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Xóa
										</div>
								    </p>
								    <p><label>Hình ảnh <?=$value['title_main']?></label>
							    		<div class="item-phanquyen">
							    			<input name="quyen[]" type="checkbox" value="album_man_photo_<?=$key?>" <?php if(in_array('album_man_photo_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Xem danh sách
							    		</div>
							    		<div class="item-phanquyen">
							    			<input name="quyen[]" type="checkbox" value="album_add_photo_<?=$key?>" <?php if(in_array('album_add_photo_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Thêm mới
							    		</div>
							    		<div class="item-phanquyen">
											<input name="quyen[]" type="checkbox" value="album_edit_photo_<?=$key?>" <?php if(in_array('album_edit_photo_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Chỉnh sửa
										</div>
										<div class="item-phanquyen">
											<input name="quyen[]" type="checkbox" value="album_delete_photo_<?=$key?>" <?php if(in_array('album_delete_photo_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Xóa
										</div>
								    </p>
								<?php } ?>
							</div>
							<!-- Begin Phân Quyền Album -->
						<?php } ?>

						<?php if(count($config['lienket'])>0) { ?>
							<!-- Begin Phân Quyền Liên Kết -->
							<div class="wrap-phanquyen">
						    	<b>Phân quyền liên kết</b>
						    	<?php foreach($config['lienket'] as $key => $value) { ?>
								    <p><label><?=$value['title_main']?></label>
							    		<div class="item-phanquyen">
							    			<input name="quyen[]" type="checkbox" value="lienket_man_<?=$key?>" <?php if(in_array('lienket_man_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Xem danh sách
							    		</div>
							    		<div class="item-phanquyen">
							    			<input name="quyen[]" type="checkbox" value="lienket_add_<?=$key?>" <?php if(in_array('lienket_add_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Thêm mới
							    		</div>
							    		<div class="item-phanquyen">
							    			<input name="quyen[]" type="checkbox" value="lienket_edit_<?=$key?>" <?php if(in_array('lienket_edit_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Chỉnh sửa
							    		</div>
							    		<div class="item-phanquyen">
							    			<input name="quyen[]" type="checkbox" value="lienket_delete_<?=$key?>" <?php if(in_array('lienket_delete_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Xóa
							    		</div>
								    </p>
								<?php } ?>
							</div>
							<!-- Begin Phân Quyền Liên Kết -->
						<?php } ?>

						<?php if(count($config['email_dk'])>0) { ?>
							<!-- Begin Phân Quyền Email -->
							<div class="wrap-phanquyen">
						    	<b>Phân quyền email</b>
							    <?php foreach($config['email_dk'] as $key => $value) { ?>
								    <p><label><?=$value['title_main']?></label>
							    		<div class="item-phanquyen">
							    			<input name="quyen[]" type="checkbox" value="email_dk_man_<?=$key?>" <?php if(in_array('email_dk_man_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Xem danh sách
							    		</div>
							    		<div class="item-phanquyen">
							    			<input name="quyen[]" type="checkbox" value="email_dk_add_<?=$key?>" <?php if(in_array('email_dk_add_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Thêm mới
							    		</div>
							    		<div class="item-phanquyen">
											<input name="quyen[]" type="checkbox" value="email_dk_edit_<?=$key?>" <?php if(in_array('email_dk_edit_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Chỉnh sửa
										</div>
										<div class="item-phanquyen">
											<input name="quyen[]" type="checkbox" value="email_dk_delete_<?=$key?>" <?php if(in_array('email_dk_delete_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Xóa
										</div>
								    </p>
								<?php } ?>
							</div>
							<!-- Begin Phân Quyền Email -->
						<?php } ?>

						<?php if(count($config['news_static'])>0) { ?>
							<!-- Begin Phân Quyền Bài Viết Tĩnh -->
							<div class="wrap-phanquyen">
						    	<b>Phân quyền bài viết tĩnh</b>
						    	<?php foreach($config['news_static'] as $key => $value) { ?>
								    <p><label><?=$value['title_main']?></label>
							    		<div class="item-phanquyen">
							    			<input name="quyen[]" type="checkbox" value="news_static_capnhat_<?=$key?>" <?php if(in_array('news_static_capnhat_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Chỉnh sửa
							    		</div>
							    		<div class="item-phanquyen">
							    			<input name="quyen[]" type="checkbox" value="news_static_man_photo_<?=$key?>" <?php if(in_array('news_static_man_photo_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Thêm mới hình
							    		</div>
							    		<div class="item-phanquyen">
							    			<input name="quyen[]" type="checkbox" value="news_static_edit_photo_<?=$key?>" <?php if(in_array('news_static_edit_photo_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Chỉnh sửa hình
							    		</div>
							    		<div class="item-phanquyen">
							    			<input name="quyen[]" type="checkbox" value="news_static_delete_photo_<?=$key?>" <?php if(in_array('news_static_delete_photo_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Xóa hình
							    		</div>
								    </p>
								<?php } ?>
							</div>
							<!-- End Phân Quyền Bài Viết Tĩnh -->
						<?php } ?>

						<?php if(count($config['download'])>0) { ?>
							<!-- Begin Phân Quyền File -->
							<div class="wrap-phanquyen">
						    	<b>Phân quyền file</b>
						    	<?php foreach($config['download'] as $key => $value) { ?>
								    <p><label><?=$value['title_main']?></label>
							    		<div class="item-phanquyen">
							    			<input name="quyen[]" type="checkbox" value="download_man_<?=$key?>" <?php if(in_array('download_man_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Xem danh sách
							    		</div>
							    		<div class="item-phanquyen">
							    			<input name="quyen[]" type="checkbox" value="download_add_<?=$key?>" <?php if(in_array('download_add_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Thêm mới
							    		</div>
							    		<div class="item-phanquyen">
							    			<input name="quyen[]" type="checkbox" value="download_edit_<?=$key?>" <?php if(in_array('download_edit_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Chỉnh sửa
							    		</div>
							    		<div class="item-phanquyen">
							    			<input name="quyen[]" type="checkbox" value="download_delete_<?=$key?>" <?php if(in_array('download_delete_'.$key, $ds_quyen)) echo 'checked="checked"'; ?> >Xóa
							    		</div>
								    </p>
								<?php } ?>
							</div>
							<!-- Begin Phân Quyền File -->
						<?php } ?>

						<?php if($hotrotructuyen==true) { ?>
							<!-- Begin Phân Quyền Hổ trợ trực tuyến -->
							<div class="wrap-phanquyen">
						    	<b>Phân quyền hổ trợ trực tuyến</b>
							    <p><label>Hổ trợ trực tuyến</label>
						    		<div class="item-phanquyen">
						    			<input name="quyen[]" type="checkbox" value="yahoo_man" <?php if(in_array('yahoo_man', $ds_quyen)) echo 'checked="checked"'; ?> >Xem danh sách
						    		</div>
						    		<div class="item-phanquyen">
						    			<input name="quyen[]" type="checkbox" value="yahoo_add" <?php if(in_array('yahoo_add', $ds_quyen)) echo 'checked="checked"'; ?> >Thêm mới
						    		</div>
						    		<div class="item-phanquyen">
						    			<input name="quyen[]" type="checkbox" value="yahoo_edit" <?php if(in_array('yahoo_edit', $ds_quyen)) echo 'checked="checked"'; ?> >Chỉnh sửa
						    		</div>
						    		<div class="item-phanquyen">
						    			<input name="quyen[]" type="checkbox" value="yahoo_delete" <?php if(in_array('yahoo_delete', $ds_quyen)) echo 'checked="checked"'; ?> >Xóa
						    		</div>
							    </p>
							</div>
							<!-- Begin Phân Quyền Hổ trợ trực tuyến -->
						<?php } ?>

						<?php if($bando==true) { ?>
							<!-- Begin Phân Quyền Hổ trợ trực tuyến -->
							<div class="wrap-phanquyen">
						    	<b>Phân quyền Bản đồ</b>
							    <p><label>Bản đồ</label>
						    		<div class="item-phanquyen">
						    			<input name="quyen[]" type="checkbox" value="bando_man" <?php if(in_array('bando_man', $ds_quyen)) echo 'checked="checked"'; ?> >Xem danh sách
						    		</div>
						    		<div class="item-phanquyen">
						    			<input name="quyen[]" type="checkbox" value="bando_add" <?php if(in_array('bando_add', $ds_quyen)) echo 'checked="checked"'; ?> >Thêm mới
						    		</div>
						    		<div class="item-phanquyen">
						    			<input name="quyen[]" type="checkbox" value="bando_edit" <?php if(in_array('bando_edit', $ds_quyen)) echo 'checked="checked"'; ?> >Chỉnh sửa
						    		</div>
						    		<div class="item-phanquyen">
						    			<input name="quyen[]" type="checkbox" value="bando_delete" <?php if(in_array('bando_delete', $ds_quyen)) echo 'checked="checked"'; ?> >Xóa
						    		</div>
							    </p>
							</div>
							<!-- Begin Phân Quyền Hổ trợ trực tuyến -->
						<?php } ?>

						<?php if($tinhthanh_quanhuyen==true) { ?>
						    <!-- Begin Phân Quyền Tỉnh Thành -->
						    <div class="wrap-phanquyen">
						    	<b>Phân quyền địa điểm</b>
							    <?php if($config['tinhthanh_quanhuyen']['list']=='true') { ?>
								    <p><label>Tỉnh thành</label>
							    		<div class="item-phanquyen">
							    			<input name="quyen[]" type="checkbox" value="tinhthanh_quanhuyen_man_list" <?php if(in_array('tinhthanh_quanhuyen_man_list', $ds_quyen)) echo 'checked="checked"'; ?> >Xem danh sách
							    		</div>
							    		<div class="item-phanquyen">
							    			<input name="quyen[]" type="checkbox" value="tinhthanh_quanhuyen_add_list" <?php if(in_array('tinhthanh_quanhuyen_add_list', $ds_quyen)) echo 'checked="checked"'; ?> >Thêm mới
							    		</div>
							    		<div class="item-phanquyen">
											<input name="quyen[]" type="checkbox" value="tinhthanh_quanhuyen_edit_list" <?php if(in_array('tinhthanh_quanhuyen_edit_list', $ds_quyen)) echo 'checked="checked"'; ?> >Chỉnh sửa
										</div>
										<div class="item-phanquyen">
											<input name="quyen[]" type="checkbox" value="tinhthanh_quanhuyen_delete_list" <?php if(in_array('tinhthanh_quanhuyen_delete_list', $ds_quyen)) echo 'checked="checked"'; ?> >Xóa
										</div>
								    </p>
								<?php } ?>
								<?php if($config['tinhthanh_quanhuyen']['cat']=='true') { ?>
								    <p><label>Quận huyện</label>
							    		<div class="item-phanquyen">
							    			<input name="quyen[]" type="checkbox" value="tinhthanh_quanhuyen_man_cat" <?php if(in_array('tinhthanh_quanhuyen_man_cat', $ds_quyen)) echo 'checked="checked"'; ?> >Xem danh sách
							    		</div>
							    		<div class="item-phanquyen">
							    			<input name="quyen[]" type="checkbox" value="tinhthanh_quanhuyen_add_cat" <?php if(in_array('tinhthanh_quanhuyen_add_cat', $ds_quyen)) echo 'checked="checked"'; ?> >Thêm mới
							    		</div>
							    		<div class="item-phanquyen">
											<input name="quyen[]" type="checkbox" value="tinhthanh_quanhuyen_edit_cat" <?php if(in_array('tinhthanh_quanhuyen_edit_cat', $ds_quyen)) echo 'checked="checked"'; ?> >Chỉnh sửa
										</div>
										<div class="item-phanquyen">
											<input name="quyen[]" type="checkbox" value="tinhthanh_quanhuyen_delete_cat" <?php if(in_array('tinhthanh_quanhuyen_delete_cat', $ds_quyen)) echo 'checked="checked"'; ?> >Xóa
										</div>
								    </p>
								<?php } ?>
								<?php if($config['tinhthanh_quanhuyen']['man']=='true') { ?>
								    <p><label><?=$config['tinhthanh_quanhuyen']['title_sub']?></label>
							    		<div class="item-phanquyen">
							    			<input name="quyen[]" type="checkbox" value="tinhthanh_quanhuyen_man" <?php if(in_array('tinhthanh_quanhuyen_man', $ds_quyen)) echo 'checked="checked"'; ?> >Xem danh sách
							    		</div>
							    		<div class="item-phanquyen">
							    			<input name="quyen[]" type="checkbox" value="tinhthanh_quanhuyen_add" <?php if(in_array('tinhthanh_quanhuyen_add', $ds_quyen)) echo 'checked="checked"'; ?> >Thêm mới
							    		</div>
							    		<div class="item-phanquyen">
											<input name="quyen[]" type="checkbox" value="tinhthanh_quanhuyen_edit" <?php if(in_array('tinhthanh_quanhuyen_edit', $ds_quyen)) echo 'checked="checked"'; ?> >Chỉnh sửa
										</div>
										<div class="item-phanquyen">
											<input name="quyen[]" type="checkbox" value="tinhthanh_quanhuyen_delete" <?php if(in_array('tinhthanh_quanhuyen_delete', $ds_quyen)) echo 'checked="checked"'; ?> >Xóa
										</div>
								    </p>
								<?php } ?>
							</div>
							<!-- End Phân Quyền Tỉnh Thành -->
						<?php } ?>
						
						<!-- Begin Phân Quyền Thiết Lập Thiết lập thông tin -->
						<div class="wrap-phanquyen">
					    	<b>Phân quyền thiết lập chính</b>
						    <p><label>Thiết lập thông tin</label>
					    		<div class="item-phanquyen">
					    			<input name="quyen[]" type="checkbox" value="setting_capnhat" <?php if(in_array('setting_capnhat', $ds_quyen)) echo 'checked="checked"'; ?> >Chỉnh sửa
					    		</div>
						    </p>
						</div>
						<!-- Begin Phân Quyền Thiết Lập Thiết lập thông tin -->

						<p class="stdformbutton">
							<input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
							<button type="submit" class="btn btn-primary"><span class="iconfa-save"></span> Phân quyền</button>
							<button type="button" onclick="javascript:window.location='index.php?com=user&act=man'" class="btn"><span class="iconfa-off"></span> Thoát</button>
						</p>	
					</form>
				</div>
			</div>
		</div>
	</div>
</div>