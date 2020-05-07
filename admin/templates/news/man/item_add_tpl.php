<?php
	function get_main_list()
	{
		$sql="select * from table_news_list where type='".$_GET['type']."' order by stt";
		$stmt=mysql_query($sql);
		$str='
		<select id="id_list" name="id_list" onchange="select_onchange_1()" class="chzn-select">
		<option value="">Danh mục cấp 1</option>			
		';
		while ($row=@mysql_fetch_array($stmt)) 
		{
			if($row["id"]==(int)@$_REQUEST["id_list"])
				$selected="selected";
			else 
				$selected="";
			$str.='<option value='.$row["id"].' '.$selected.'>'.$row["tenvi"].'</option>';			
		}
		$str.='</select>';
		return $str;
	}			
	function get_main_cat()
	{
		$sql="select tenvi,id from table_news_cat where id_list='".$_REQUEST['id_list']."' and type='".$_GET['type']."' order by stt asc";
		$stmt=mysql_query($sql);
		$str='
		<select id="id_cat" name="id_cat" onchange="select_onchange_2()" class="chzn-select">
		<option value="">Danh mục cấp 2</option>			
		';
		while ($row=@mysql_fetch_array($stmt)) 
		{
			if($row["id"]==$_REQUEST['id_cat'])
				$selected="selected";
			else 
				$selected="";
			$str.='<option value='.$row["id"].' '.$selected.'>'.$row["tenvi"].'</option>';			
		}
		$str.='</select>';
		return $str;
	}
	function get_main_item()
	{
		$sql="select tenvi,id from table_news_item where id_cat='".$_REQUEST['id_cat']."' and id_list='".$_REQUEST['id_list']."' and type='".$_GET['type']."' order by stt asc";
		$stmt=mysql_query($sql);
		$str='
		<select id="id_item" name="id_item" class="chzn-select">
		<option value="">Danh mục cấp 3</option>			
		';
		while ($row=@mysql_fetch_array($stmt)) 
		{
			if($row["id"]==$_REQUEST['id_item'])
				$selected="selected";
			else 
				$selected="";
			$str.='<option value='.$row["id"].' '.$selected.'>'.$row["tenvi"].'</option>';			
		}
		$str.='</select>';
		return $str;
	}
	function get_tags($id=0)
	{
		global $d;
		if($id)
		{
			$d->reset();
			$sql="select id_tags from table_tags_group where id_pro = $id and type='".$_GET['type']."'";
			$d->query($sql);
			$temps = $d->result_array();
			
			for($i=0;$i<count($temps);$i++){
				$temp[$i]=$temps[$i]['id_tags'];	
			}
		}
		$d->reset();
		$sql="select tenvi, id from table_tags_list where type='".$_GET['type']."' order by stt,id desc";
		$d->query($sql);
		$row_list = $d->result_array();

		$str='<select id="tags_group" name="tags_group[]" class="select multiselect input" multiple="multiple" >';
		for($i=0;$i<count($row_list);$i++)
		{
			if($temp){	
				if(in_array($row_list[$i]['id'],$temp)){ $select = 'selected="selected"'; }else{ $select='';}
			}
			$str.='<option value="'.$row_list[$i]["id"].'" '.$select.' /> '.$row_list[$i]["tenvi"].'</option>';

		}
		$str .='</select>';
		return $str;
	}
?>

<!-- Begin Bảng Điều Khiển -->
<div class="breadcrumbwidget">
    <ul class="breadcrumb">
        <li><a href="index.php">Bảng điều khiển</a> <span class="divider">/</span></li>
        <li class="active">Quản lý <?=$config['news'][$type]['title_main']?></li>
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
					<form name="frm" method="post" action="index.php?com=news&act=save&type=<?=$_GET['type']?>" enctype="multipart/form-data" class="stdform stdform2">
						
						<?php if($config['news'][$type]['list']=='true') { ?>
					    	<p><label>Danh mục cấp 1:</label><span class="field"><?=get_main_list();?></span></p>
					    <?php } ?>
					    <?php if($config['news'][$type]['cat']=='true') { ?>
					    	<p><label>Danh mục cấp 2:</label><span class="field"><?=get_main_cat();?></span></p>
					    <?php } ?>
					    <?php if($config['news'][$type]['item']=='true') { ?>
					    	<p><label>Danh mục cấp 3:</label><span class="field"><?=get_main_item();?></span></p>
					    <?php } ?>
					    <?php if($config['news'][$type]['tag_list']=='true') { ?>
					    	<p><label>Danh mục tags:</label><span class="field"><?=get_tags($item['id']);?></span></p>
					    <?php } ?>

					    <?php if($config['news'][$type]['images']=='true') { ?>
						    <?php if($_GET['act']=='edit') { ?>
						    	<p><label>Hình hiện tại:</label><span class="field"><img src="<?=_upload_news.$item['photo']?>" onerror="src='img/noimage.png'" alt="NO PHOTO" style="max-width: 150px"/></span></p>
						    <?php } ?>
						    <p><label>Upload hình ảnh:</label><span class="field"><input type="file" name="file" class="uniform-file" /> <strong><?php echo $config['news'][$type]['img_type']." - Width: ".$config['news'][$type]['width']." px - Height: ".$config['news'][$type]['height']." px"?></strong></span></p>
						<?php } ?>
					    
                        <?php if($config['news'][$type]['file']=='true') { ?>
                            <?php if($_GET['act']=='edit' && $item['taptin']!='') { ?>
                                <p><label>File hiện tại:</label><span class="field"><a href="<?=_upload_file.$item['taptin']?>" title="Tập tin hiện tại"><span class="icon-download"></span> Download file</a> (<?=$item['taptin']?>)</span></p>
                            <?php } ?>
                            <p><label>Upload file:</label><span class="field"><input type="file" name="file_2" class="uniform-file" /> <strong><?=$config['news'][$type]['file_type']?></strong></span></p>
                        <?php } ?>

					    <!-- Kiểm tra nhiều hình ảnh -->
						<?php if(count($config['news'][$type]['multipic_arr'])>0) { foreach ($config['news'][$type]['multipic_arr'] as $key => $value) {
				        	if($key==$type) { $flag_multipic=true; break; }
				        } } ?>
					    
					    <?php if($flag_multipic=='true') { ?>
						    <p>
						    	<label>Album:</label>
	                            <span class="field">
	                                <a class="file_input" style="padding:3px 16px;" data-jfiler-name="files" data-jfiler-extensions="jpg, jpeg, png, gif"><i class="fa fa-paperclip"></i> Thêm hình ảnh</a>
	                            </span>
	                        </p>
	                        <?php if($_GET['act']=='edit') { ?>
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
                        <?php } ?>

                        <?php if($config['news'][$type]['mausac']=='true') { ?>
                            <!-- ColorPicker -->
                            <script type="text/javascript" src="plugin/bootstrap-colorpicker-master/js/bootstrap-colorpicker.js"></script>
                            <link type="text/css" rel="stylesheet" href="plugin/bootstrap-colorpicker-master/css/bootstrap-colorpicker.css" />

                            <style type="text/css">
                                .colorpicker 
                                {
                                    width: 140px !important;
                                    height: 115px !important;
                                    background: white !important; 
                                }
                                .colorpicker.colorpicker-visible 
                                {
                                    margin-top: 10px;
                                    margin-left: -20px;
                                }
                            </style>

                            <script>
                                jQuery(function(){
                                    jQuery('.mau_color_picker').colorpicker();
                                });
                            </script>
    					    <p><label>Màu sắc (Title):</label>
    					    	<span class="field mau_color_picker">
    					    		<input type="text" id="mau" maxlength="7" style="width:60px" name="mau" value="<?=$item['mau']?>"/>
    								<span class="input-group-addon"><i></i></span>
    							</span>
    						</p>
                        <?php } ?>

                        <?php if($config['news'][$type]['video']=='true') { ?>
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
	                                <p><label>Tên (<?=$key?>):</label><span class="field"><input type="text" name="ten<?=$key?>" value="<?=@$item['ten'.$key]?>" class="input-xxlarge" placeholder="Tên (<?=$key?>)"/></span></p>
	                                <?php if($config['news'][$type]['mota']=='true') { ?>
	    								<p><label>Mô tả (<?=$key?>):</label></p></br></br>
	    								<p><textarea name="mota<?=$key?>" id="mota<?=$key?>" rows="5" cols="80" style="width: 100%; box-sizing: border-box;" class="tinymce"><?=@$item['mota'.$key]?></textarea></p>
	                                    <?php if($config['news'][$type]['mota_cke']=='true') { ?>
	                                        <script type="text/javascript">
	                                            var mota<?=$key?> = CKEDITOR.replace('mota<?=$key?>');
	                                        </script>
	                                    <?php } ?>
	                                <?php } ?>
	                                <?php if($config['news'][$type]['noidung']=='true') { ?>
	    								<p><label>Nội dung (<?=$key?>):</label></p></br></br>
	    								<p><textarea name="noidung<?=$key?>" id="noidung<?=$key?>" rows="5" cols="80" style="width: 100%; box-sizing: border-box;" class="tinymce"><?=@$item['noidung'.$key]?></textarea></p>
	                                    <?php if($config['news'][$type]['noidung_cke']=='true') { ?>
	                                        <script type="text/javascript">
	                                            var noidung<?=$key?> = CKEDITOR.replace('noidung<?=$key?>');
	                                        </script>
	                                    <?php } ?>
	                                <?php } ?>
								</div>
							<?php } ?>
						</div>
						<!-- End Tab -->

                        <?php if($config['news'][$type]['seo']=='true') { ?>
					    <!-- Thông Tin SEO -->
                        <p><label>SEO H1:</label> <span class="field"><textarea name="seo_h1" id="seo_h1" style="height: 100px" class="input-xxlarge" placeholder="SEO H1"><?=$item['seo_h1']?></textarea></span></p>
                        <p><label>SEO H2:</label> <span class="field"><textarea name="seo_h2" id="seo_h2" style="height: 100px" class="input-xxlarge" placeholder="SEO h2"><?=$item['seo_h2']?></textarea></span></p>
                        <p><label>SEO H3:</label> <span class="field"><textarea name="seo_h3" id="seo_h3" style="height: 100px" class="input-xxlarge" placeholder="SEO h3"><?=$item['seo_h3']?></textarea></span></p>
					    <p><label>SEO Title:</label> <span class="field"><textarea name="title" id="title" style="height: 100px" class="input-xxlarge" placeholder="SEO Title"><?=$item['title']?></textarea></span></p>
					    <p><label>SEO Keywords:</label> <span class="field"><textarea name="keywords" id="keywords" style="height: 100px" class="input-xxlarge" placeholder="SEO Keywords"><?=$item['keywords']?></textarea></span></p>
					    <p><label>SEO Description:</label><span class="field"> <textarea name="description" id="description" style="height: 100px" class="input-xxlarge" placeholder="SEO Description"><?=$item['description']?></textarea></span></p>
					    <!-- Thông Tin SEO -->
                        <?php } ?>

					    <p><label>STT:</label> <span class="field"><input type="number" min="0" name="stt" value="<?=isset($item['stt'])?$item['stt']:1?>" style="width:30px"></span></p>

						<p><label>Hiển thị:</label><span class="field"><input type="checkbox" name="hienthi" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?>></span></p>
						
						<p class="stdformbutton">
							<input type="hidden" name="id" id="id" value="<?=@$item['id']?>" />
							<button type="submit" class="btn btn-primary"><span class="iconfa-save"></span> Lưu</button>
							<button type="reset" class="btn"><span class="iconfa-refresh"></span> Làm lại</button>
							<button type="button" onclick="javascript:window.location='index.php?com=news&act=man&type=<?=$_GET['type']?>'" class="btn"><span class="iconfa-off"></span> Thoát</button>
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
		var url = "index.php?com=news&act=<?php if($_REQUEST['act']=='edit') echo 'edit'; else echo 'add';?><?php if($_REQUEST['id']!='') echo"&id=".$_REQUEST['id']; ?>&type=<?=$_GET['type']?>";

		if(list > 0) url += "&id_list="+list;

		window.location = url;
	}
	function select_onchange_2()
	{				
		var list = jQuery("#id_list").val();
		var cat = jQuery("#id_cat").val();
		var url = "index.php?com=news&act=<?php if($_REQUEST['act']=='edit') echo 'edit'; else echo 'add';?><?php if($_REQUEST['id']!='') echo"&id=".$_REQUEST['id']; ?>&type=<?=$_GET['type']?>";

		if(list > 0) url += "&id_list="+list;
		if(cat > 0) url += "&id_cat="+cat;

		window.location = url;
	}
</script>

<?php if($config['news'][$type]['tag_list']=='true') { 
	$d->reset();
	$sql="select id from table_tags_list where type='".$_GET['type']."'";
	$d->query($sql);
	$row_tags = $d->result_array();
	?>
	<script type="text/javascript">
	    jQuery(document).ready(function () {
	        window.asd = jQuery('.multiselect').SumoSelect({ csvDispCount: <?=count($row_tags)?>, placeholder: 'Danh mục Tags'});
	    });
	</script>
<?php } ?>

<?php if($flag_multipic=='true') { ?>
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
	                    data: {'id':id,'tbl':'news_hinhanh','const':'news'},
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