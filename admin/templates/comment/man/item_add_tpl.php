<!-- Begin Bảng Điều Khiển -->
<div class="breadcrumbwidget">
    <ul class="breadcrumb">
        <li><a href="index.php">Bảng điều khiển</a> <span class="divider">/</span></li>
        <li><a href="index.php?com=comment&act=man">Quản lý bình luận</a> <span class="divider">/</span></li>
        <li class="active">Trả lời bình luận</li>
    </ul>
</div>
<!-- End Bảng Điều Khiển -->

<div class="pagetitle">
    <h1>Thông tin bình luận</h1>
</div>

<div class="maincontent">
    <div class="contentinner">
        <div class="row-fluid">
            <div class="span12">
                <h4 class="widgettitle nomargin shadowed"></h4>
                <div class="widgetcontent bordered shadowed nopadding">
                    <form name="frm" method="post" action="index.php?com=comment&act=save" enctype="multipart/form-data" class="stdform stdform2">

                        <p><label>Họ tên:</label><span class="field"><?=@$item['hoten']?></span></p>
                        <p><label>Email:</label><span class="field"><?=@$item['email']?></span></p>
                        <p><label>Nội dung:</label><span class="field"><?=@$item['noidung']?></span></p>

                        <!-- Begin Tab -->
                        <div id="tabs">
                            <ul>
                                <li><a href="#tabs-0">Trả lời bình luận</a></li>
                                <li><a href="#tabs-1">Danh sách câu trả lời</a></li>
                            </ul>
                            <div class="clear"></div>
                            <div id="tabs-0">
                                <p><label>Họ tên:</label><span class="field"><input type="text" name="hoten" class="input-xxlarge" placeholder="Họ tên" value="Admin" /></span></p>
                                <p><label>Nội dung:</label></p></br></br>
                                <p><textarea name="noidung" id="noidung" rows="10" cols="80" style="width: 100%; box-sizing: border-box" class="tinymce"></textarea></p>
                            </div>
                            <div id="tabs-1">
                                <?php 
                                    $d->reset();
                                    $sql="select hoten,noidung,id from #_comment where pid='".$item['id']."'  order by ngaydang desc";
                                    $d->query($sql);
                                    $comment_result=$d->result_array();
                                ?>
                                <div class="wrap-cm-result">
                                    <?php for($i=0;$i<count($comment_result);$i++) { ?>
                                        <p class="item-comment-child" id="cm-child<?=$comment_result[$i]['id']?>">
                                            <a class="del-comment" rel="<?=$comment_result[$i]['id']?>" title="Xóa">Xóa</a>
                                            <label <?php if(strtolower($comment_result[$i]['typereply'])=='admin'){echo 'style="color:red"';}?>>
                                                <?=$comment_result[$i]['hoten']?>:
                                            </label>
                                            <span class="field"><?=$comment_result[$i]['noidung']?></span>
                                        </p>
                                    <?php } ?>
                                </div>

                                <script type="text/javascript">
                                    jQuery(document).ready(function() {
                                        jQuery("a.del-comment").click(function(event) {
                                            var r = confirm("Bạn có chắc muốn xóa bình luận này ?");
                                            if (r == true) {
                                                var id=jQuery(this).attr("rel");
                                                jQuery.ajax({
                                                    type: 'POST',
                                                    url: 'ajax/ajax_del_comment.php',
                                                    data: {'id':id,'tbl':'comment'},
                                                    success: function(data) {
                                                      jQuery('p#cm-child'+id).remove();
                                                    }
                                                });
                                            } else {
                                              return false;
                                            } 
                                        });
                                    });
                                </script>

                            </div>
                        </div>
                        <!-- End Tab -->
                        
                        <p class="stdformbutton">
                            <input type="hidden" name="url" id="url" value="<?=@$item['url']?>" />
                            <input type="hidden" name="email" id="email" value="<?=@$item['email']?>" />
                            <input type="hidden" name="pid" id="pid" value="<?=@$item['id']?>" />
                            <input type="hidden" name="typereply" id="typereply" value="admin" />
                            <button type="submit" class="btn btn-primary"><span class="iconfa-save"></span> Trả lời</button>
                            <button type="button" onclick="javascript:window.location='index.php?com=comment&act=man'" class="btn"><span class="iconfa-off"></span> Thoát</button>
                        </p>    
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>