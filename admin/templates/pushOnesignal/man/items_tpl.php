<!-- Begin Bảng Điều Khiển -->
<div class="breadcrumbwidget">
    <ul class="breadcrumb">
        <li><a href="index.php">Bảng điều khiển</a> <span class="divider">/</span></li>
        <li class="active">Danh sách thông báo đẩy</li>
    </ul>
</div>
<!-- End Bảng Điều Khiển -->

<div class="pagetitle">
    <h1>Danh sách thông báo đẩy</h1>
</div>

<div class="maincontent">
    <div class="contentinner">
        <div class="row-fluid">
            <div class="span12">
                <!-- Begin Search -->
                <div class="input-append">
                    <input name="keyword" id="keyword" type="text" placeholder="Tìm kiếm danh mục ..." onkeypress="doEnter(event,'keyword')"/>
                    <button type="button" class="btn" onclick="onSearch()"><span class="icon-search"></span></button>
                </div>
                <!-- End Search -->

                <form action="index.php?com=pushOnesignal&act=man" method="POST" name="update_position">
                    <table class="table table-bordered" <?=(count($items))?'id="dyntable"':''?>>
                        <thead>
                            <tr>
                                <th style="width:3%" align="center"><input type="checkbox" name="selectall" id="selectall" class="checkall" /></th>
                                <th>STT</th>
                                <th>Hình đại diện</th>
                                <th>Tiêu đề</th>
                                <th>Đẩy tin</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>

                        <?php if(empty($items)) echo "<tr><td colspan='15'>Không có mục nào ...</td></tr>";

                        else { for($i=0, $count=count($items); $i<$count; $i++) { ?>

                        <tr><input type="hidden" name="stt[id][]" value="<?=$items[$i]["id"]?>">
                            <td style="width:3%;" align="center"><input type="checkbox" name="chose" id="chose" value="<?=$items[$i]['id']?>" class="chon" /></td>  
                            <td style="width:5%;"><input type="number" min="0" name="stt[stt][]" id="stt" value="<?=$items[$i]['stt']?>" data-id="<?=$items[$i]['id']?>" data-table="pushonesignal" class="selectinput update_stt" /></td>
                            <td style="width:3%;">
                                <a href="index.php?com=pushOnesignal&act=edit&id=<?=$items[$i]['id']?>" title="Cập nhật"><img style="max-width: 60px;max-height: 60px;margin: auto;" onerror="src='img/noimage.png'" src="<?=_upload_sync?><?=$items[$i]['photo']?>" alt="<?=$items[$i]['name']?>"></a>
                            </td>
                            <td style="width:10%;">
                                <a href="index.php?com=pushOnesignal&act=edit&id=<?=$items[$i]['id']?>" title="Cập nhật"><?=$items[$i]['name']?></a>
                            </td>
                            <td style="width:2%;">
                                <a href="index.php?com=pushOnesignal&act=sync&id=<?=$items[$i]['id']?>"><img style="max-width: 40px;margin: auto;" src="img/loa.png"/></a>
                            </td>
                            <td style="width:2%;" class="action">
                                <a href="index.php?com=pushOnesignal&act=delete&id=<?=$items[$i]['id']?>" onClick="if(!confirm('Bạn có chắc muốn xóa mục này ?')) return false;" title="Xóa"><span class="iconfa-trash"></span></a>
                            </td>
                        </tr>

                        <?php } } ?>
                    </table>
                </form>

                <!-- Begin Paging -->
                <div class="pagination pagination-centered" <?=($paging['paging'] == "<ul></ul>")?'style="height: 0px; margin: 0px;"':''?>><?=$paging['paging']?></div>
                <!-- End Paging -->

                <!-- Begin Button Action -->
                <div class="actionfull">
                    <a href="index.php?com=pushOnesignal&act=add" class="btn btn-rounded"><icon class="icon-plus"></icon> Thêm mới</a>
                    <button class="btn btn-rounded" id="delall"><span class="icon-trash"></span> Xóa nhiều</button>
                </div>
                <!-- End Button Action -->
            </div>
        </div>
    </div>
</div>

<script>
    jQuery('.checkall').click(function(){
        var parentTable = jQuery(this).parents('table');                                           
        var ch = parentTable.find('tbody input[type=checkbox]');
        if(jQuery(this).is(':checked')) {           
            ch.each(function(){ 
                jQuery(this).attr('checked',true);
                jQuery(this).parent().addClass('checked');
                jQuery(this).parents('tr').addClass('selected');
            });         
        } 
        else 
        {       
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
            if (hoi==true) document.location = "index.php?com=pushOnesignal&act=delete&listid=" + listid;
        });
    }

    jQuery("#update").click(function(){
        update_position.submit();
    });

    function doEnter(evt){
        var key;
        if(evt.keyCode == 13 || evt.which == 13){
            onSearch(evt);
        }
    }
    
    function onSearch(evt){ 
        var keyword = document.getElementById("keyword").value;     
            location.href = "index.php?com=pushOnesignal&act=man&keyword="+keyword;
            loadPage(document.location);
    }
</script>