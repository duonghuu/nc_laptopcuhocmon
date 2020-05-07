<!-- Begin Bảng Điều Khiển -->
<div class="breadcrumbwidget">
    <ul class="breadcrumb">
        <li><a href="index.php">Bảng điều khiển</a> <span class="divider">/</span></li>
        <li class="active">Chi tiết <?=$config['download'][$type]['title_main']?></li>
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
                    <form name="frm" method="post" action="index.php?com=download&act=save&type=<?=$_GET['type']?>" enctype="multipart/form-data" class="stdform stdform2">
                        
                        <?php if($config['download'][$type]['images']=='true') { ?>
                            <?php if($_GET['act']=='edit') { ?>
                                <p><label>Hình hiện tại:</label><span class="field"><img src="<?=_upload_photo.$item['photo']?>" onerror="src='img/noimage.png'" alt="NO PHOTO" style="max-width: 150px"/></span></p>
                            <?php } ?>
                            <p><label>Upload hình ảnh:</label><span class="field"><input type="file" name="file_hinh" class="uniform-file" /> <strong><?php echo $config['download'][$type]['img_type']." - Width: ".$config['download'][$type]['width']." px - Height: ".$config['download'][$type]['height']." px"?></strong></span></p>
                        <?php } ?>

                        <?php if($_GET['act']=='edit') { ?>
                            <p><label>File hiện tại:</label><span class="field"><a href="<?=_upload_file.$item['file']?>" title="Tập tin hiện tại"><span class="icon-download"></span> Download file</a> (<?=$item['file']?>)</span></p>
                        <?php } ?>
                        <p><label>Upload file:</label><span class="field"><input type="file" name="file" class="uniform-file" /> <strong><?=$config['download'][$type]['file_type']?></strong></span></p>
                        
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
                                    <?php if($config['download'][$type]['mota']=='true') { ?>
                                        <p><label>Mô tả (<?=$key?>):</label></p></br></br>
                                        <p><textarea name="mota<?=$key?>" id="mota<?=$key?>" rows="5" cols="80" style="width: 100%; box-sizing: border-box;" class="tinymce"><?=@$item['mota'.$key]?></textarea></p>
                                        <?php if($config['download'][$type]['mota_cke']=='true') { ?>
                                            <script type="text/javascript">
                                                var mota<?=$key?> = CKEDITOR.replace('mota<?=$key?>');
                                            </script>
                                        <?php } ?>
                                    <?php } ?>
                                    <?php if($config['download'][$type]['noidung']=='true') { ?>
                                        <p><label>Nội dung (<?=$key?>):</label></p></br></br>
                                        <p><textarea name="noidung<?=$key?>" id="noidung<?=$key?>" rows="5" cols="80" style="width: 100%; box-sizing: border-box;" class="tinymce"><?=@$item['noidung'.$key]?></textarea></p>
                                        <?php if($config['download'][$type]['noidung_cke']=='true') { ?>
                                            <script type="text/javascript">
                                                var noidung<?=$key?> = CKEDITOR.replace('noidung<?=$key?>');
                                            </script>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                        <!-- End Tab -->

                        <?php if($config['download'][$type]['seo']=='true') { ?>
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
                            <button type="button" onclick="javascript:window.location='index.php?com=download&act=man&type=<?=$_GET['type']?>'" class="btn"><span class="iconfa-off"></span> Thoát</button>
                        </p>    
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>