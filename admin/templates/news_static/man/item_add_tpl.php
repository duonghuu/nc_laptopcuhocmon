<!-- Begin Bảng Điều Khiển -->
<div class="breadcrumbwidget">
    <ul class="breadcrumb">
        <li><a href="index.php">Bảng điều khiển</a> <span class="divider">/</span></li>
        <li class="active">Quản lý <?=$config['news_static'][$type]['title_main']?></li>
    </ul>
</div>
<!-- End Bảng Điều Khiển -->

<div class="pagetitle">
	<h1>Cập nhật nội dung <?=$config['news_static'][$type]['title_main']?></h1>
</div>

<div class="maincontent">
	<div class="contentinner">
		<div class="row-fluid">
			<div class="span12">
				<h4 class="widgettitle nomargin shadowed"></h4>
				<div class="widgetcontent bordered shadowed nopadding">
					<form name="frm" method="post" action="index.php?com=news_static&act=save&type=<?=$_GET['type']?>" enctype="multipart/form-data" class="stdform stdform2">	
						
                        <?php if($config['news_static'][$type]['images']=='true') { ?>
                            <?php if($_GET['act']=='capnhat') { ?>
                                <p><label>Hình hiện tại:</label><span class="field"><img src="<?=_upload_news.$item['photo']?>" onerror="src='img/noimage.png'" alt="NO PHOTO" style="max-width: 150px"/></span></p>
                            <?php } ?>
                            <p><label>Upload hình ảnh:</label><span class="field"><input type="file" name="file" class="uniform-file" /> <strong><?php echo $config['news_static'][$type]['img_type']." - Width: ".$config['news_static'][$type]['width']." px - Height: ".$config['news_static'][$type]['height']." px"?></strong></span></p>
                        <?php } ?>

						<?php if($config['news_static'][$type]['multipic']=='true') { ?>
							<p><label>Hình ảnh:</label><span class="field">
								<?php
									$d->reset();
									$sql = "SELECT id FROM table_news_static_hinhanh WHERE type='".$_GET['type']."'";
									$d->query($sql);
									$pictures = $d->result_array();
								?>
								<a href="index.php?com=news_static&act=man_photo&type=<?=$_GET['type']?>" title="<?=count($pictures)?> Hình ảnh">(<?=count($pictures)?>) Hình ảnh</a>
							</span></p>
							<p>
						    	<label>Album:</label>
	                            <span class="field">
	                                <a class="file_input" style="padding:3px 16px;" data-jfiler-name="files" data-jfiler-extensions="jpg, jpeg, png, gif"><i class="fa fa-paperclip"></i> Thêm hình ảnh</a>
	                            </span>
	                        </p>
	                        <?php if(count($list_hinhanh)!=0) { ?>
	                            <div class="block-multi-pic"><label class="lbl_multi_pic">Album hiện tại:</label>
	                                <div class="content-multi-pic">
	                                    <?php for($i=0;$i<count($list_hinhanh);$i++) { ?>
	                                        <div class="item_pic item_trash_pic<?=$list_hinhanh[$i]['id']?>">
	                                            <img onerror="src='img/noimage.png'" class="img_item_pic" width="100" src="<?=_upload_news.$list_hinhanh[$i]['photo']?>" />
	                                            <a href="javascript:void(0)" class="icon-jfi-trash jFiler-item-trash-action delete_item_pic" rel="<?=$list_hinhanh[$i]['id']?>"></a>
	                                            <div id="loader<?=$list_hinhanh[$i]['id']?>" class="loader_item_pic">
	                                                <img src="plugin/multi-pic/assets/images/ajax-loader.gif" />
	                                            </div>
	                                        </div>
	                                    <?php } ?>
	                                </div>
	                            </div>
	                        <?php } ?>
	                    <?php } ?>

                        <?php if($config['news_static'][$type]['video']=='true') { ?>
                            <p><label>Link video:</label><span class="field"><input type="text" value="<?=$item['link_video']?>" name="link_video" id="link_video" class="input-xxlarge" placeholder="Link video *"/></span></p>
                            <p><label>Video demo:</label><span class="field">
                                <iframe id="load_video" width="314" src="//www.youtube.com/embed/<?=getYoutubeIdFromUrl(@$item['link_video'])?>" width="300" <?php if(@$item["link_video"] == "") echo "height='0'"; else echo "height='200'";?> frameborder="0" allowfullscreen></iframe>
                            </span></p>

                            <script type="text/javascript">
                                function youtube_parser(url)
                                {
                                    var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
                                    var match = url.match(regExp);
                                    return (match&&match[7].length==11)? match[7] : false;
                                }
                                
                                jQuery().ready(function(e) 
                                {
                                    jQuery("#link_video").change(function(){
                                        var url = youtube_parser(jQuery(this).val());
                                        jQuery("span#notify-video-demo").hide();
                                        jQuery("#load_video").attr("src","//www.youtube.com/embed/"+url).css({"height": "200", "width": "300"});
                                    })
                                });
                            </script>
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
                                    <?php if($config['news_static'][$type]['tieude']=='true') { ?>
                                        <p><label>Tên (<?=$key?>):</label><span class="field"><input type="text" name="ten<?=$key?>" value="<?=@$item['ten'.$key]?>" class="input-xxlarge" placeholder="Tên (<?=$key?>)"/></span></p>
                                    <?php } ?>
                                    <?php if($config['news_static'][$type]['mota']=='true') { ?>
                                        <p><label>Mô tả (<?=$key?>):</label></p></br></br>
                                        <p><textarea name="mota<?=$key?>" id="mota<?=$key?>" rows="5" cols="80" style="width: 100%; box-sizing: border-box;" class="tinymce"><?=@$item['mota'.$key]?></textarea></p>
                                        <?php if($config['news_static'][$type]['mota_cke']=='true') { ?>
                                            <script type="text/javascript">
                                                var mota<?=$key?> = CKEDITOR.replace('mota<?=$key?>');
                                            </script>
                                        <?php } ?>
                                    <?php } ?>
                                    <?php if($config['news_static'][$type]['noidung']=='true') { ?>
                                        <p><label>Nội dung (<?=$key?>):</label></p></br></br>
                                        <p><textarea name="noidung<?=$key?>" id="noidung<?=$key?>" rows="5" cols="80" style="width: 100%; box-sizing: border-box;" class="tinymce"><?=@$item['noidung'.$key]?></textarea></p>
                                        <?php if($config['news_static'][$type]['noidung_cke']=='true') { ?>
                                            <script type="text/javascript">
                                                var noidung<?=$key?> = CKEDITOR.replace('noidung<?=$key?>');
                                            </script>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                        <!-- End Tab -->

                        <?php if($config['news_static'][$type]['seo']=='true') { ?>
                        <!-- Thông Tin SEO -->
                        <p><label>SEO H1:</label> <span class="field"><textarea name="seo_h1" id="seo_h1" style="height: 100px" class="input-xxlarge" placeholder="SEO H1"><?=$item['seo_h1']?></textarea></span></p>
                        <p><label>SEO H2:</label> <span class="field"><textarea name="seo_h2" id="seo_h2" style="height: 100px" class="input-xxlarge" placeholder="SEO h2"><?=$item['seo_h2']?></textarea></span></p>
                        <p><label>SEO H3:</label> <span class="field"><textarea name="seo_h3" id="seo_h3" style="height: 100px" class="input-xxlarge" placeholder="SEO h3"><?=$item['seo_h3']?></textarea></span></p>
                        <p><label>SEO Title:</label> <span class="field"><textarea name="title" id="title" style="height: 100px" class="input-xxlarge" placeholder="SEO Title"><?=$item['title']?></textarea></span></p>
                        <p><label>SEO Keywords:</label> <span class="field"><textarea name="keywords" id="keywords" style="height: 100px" class="input-xxlarge" placeholder="SEO Keywords"><?=$item['keywords']?></textarea></span></p>
                        <p><label>SEO Description:</label><span class="field"> <textarea name="description" id="description" style="height: 100px" class="input-xxlarge" placeholder="SEO Description"><?=$item['description']?></textarea></span></p>
                        <!-- Thông Tin SEO -->
                        <?php } ?>

                        <p><label>Hiển thị:</label><span class="field"><input type="checkbox" name="hienthi" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?>></span></p>

						<p class="stdformbutton">
							<input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
							<input type="hidden" name="idc" id="idc" value="<?=@$item['id']?>" />
							<button type="submit" class="btn btn-primary"><span class="iconfa-save"></span> Lưu</button>
							<button type="reset" class="btn"><span class="iconfa-refresh"></span> Làm lại</button>
						</p>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<?php if($config['news_static'][$type]['multipic']=='true') { ?>
    <script>
        jQuery(document).ready(function() {
            jQuery(".delete_item_pic").click(function(event) {
                var r = confirm("Bạn có chắc muốn xóa mục này ?");
                if (r == true) {
                    var id=jQuery(this).attr("rel");
                    jQuery('#loader'+id).css('display', 'block');
                    jQuery.ajax({
                        type: 'POST',
                        url: 'ajax/ajax_multi_pic.php',
                        data: {'id':id,'tbl':'news_static_hinhanh','const':'news'},
                        success: function(data) {
                          jQuery('#loader'+id).css('display', 'none');
                          jQuery('.item_trash_pic'+id).remove();
                        }
                    });
                } else {
                  return false;
                } 
            });
        });
    </script>

    <script>
        jQuery(document).ready(function() {
            jQuery('.file_input').filer({
                showThumbs: true,
                templates: {
                    box: '<ul class="jFiler-item-list"></ul>',
                    item: '<li class="jFiler-item">\
                                <div class="jFiler-item-container">\
                                    <div class="jFiler-item-inner">\
                                        <div class="jFiler-item-thumb">\
                                            <div class="jFiler-item-status"></div>\
                                            <div class="jFiler-item-info">\
                                                <span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name | limitTo: 25}}</b></span>\
                                            </div>\
                                            {{fi-image}}\
                                        </div>\
                                        <div class="jFiler-item-assets jFiler-row">\
                                            <ul class="list-inline pull-left">\
                                                <li><span class="jFiler-item-others">{{fi-icon}} {{fi-size2}}</span></li>\
                                            </ul>\
                                            <ul class="list-inline pull-right">\
                                                <li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
                                            </ul>\
                                        </div>\
                                        <input type="text" style="width:158px;font-size:11px;margin-bottom:5px" placeholder="Số thứ tự" name="stt-multi-pic[]" class="stt-multi-pic" />\
                                        <?php /* <br/>\
                                        <input type="text" style="width:158px;font-size:11px" placeholder="Tiêu đề" name="ten-multi-pic[]" class="ten-multi-pic" />\ */ ?></div>\
                                </div>\
                            </li>',
                    itemAppend: '<li class="jFiler-item">\
                                <div class="jFiler-item-container">\
                                    <div class="jFiler-item-inner">\
                                        <div class="jFiler-item-thumb">\
                                            <div class="jFiler-item-status"></div>\
                                            <div class="jFiler-item-info">\
                                                <span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name | limitTo: 25}}</b></span>\
                                            </div>\
                                            {{fi-image}}\
                                        </div>\
                                        <div class="jFiler-item-assets jFiler-row">\
                                            <ul class="list-inline pull-left">\
                                                <span class="jFiler-item-others">{{fi-icon}} {{fi-size2}}</span>\
                                            </ul>\
                                            <ul class="list-inline pull-right">\
                                                <li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
                                            </ul>\
                                        </div>\
                                        <input type="text" style="width:158px;font-size:11px;margin-bottom:5px" placeholder="Số thứ tự" name="stt-multi-pic[]" class="stt-multi-pic" />\
                                        <br/>\
                                        <input type="text" style="width:158px;font-size:11px" placeholder="Tiêu đề" name="ten-multi-pic[]" class="ten-multi-pic" />\
                                    </div>\
                                </div>\
                            </li>',
                    progressBar: '<div class="bar"></div>',
                    itemAppendToEnd: true,
                    removeConfirmation: true,
                    _selectors: {
                        list: '.jFiler-item-list',
                        item: '.jFiler-item',
                        progressBar: '.bar',
                        remove: '.jFiler-item-trash-action',
                    }
                },
                addMore: true
            });
        });
    </script>

    <style>
        .file_input
        {
            display: inline-block;
            padding: 10px 16px;
            outline: none;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
            white-space: nowrap;
            font-family: sans-serif;
            font-size: 11px;
            font-weight: bold;
            border-radius: 3px;
            color: #008BFF;
            border: 1px solid #008BFF;
            vertical-align: middle;
            background-color: #fff;
            box-shadow: 0px 1px 5px rgba(0,0,0,0.05);
            -webkit-transition: all 0.2s;
            -moz-transition: all 0.2s;
            transition: all 0.2s;
        }
        .file_input:hover, .file_input:active 
        {
            background: #008BFF;
            color: #fff;
            text-decoration: none;
        }
    </style>
<?php } ?>