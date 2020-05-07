<!-- Begin Bảng Điều Khiển -->
<div class="breadcrumbwidget">
    <ul class="breadcrumb">
        <li><a href="index.php">Bảng điều khiển</a> <span class="divider">/</span></li>
        <li class="active">Quản lý bình luận</li>
    </ul>
</div>
<!-- End Bảng Điều Khiển -->

<div class="pagetitle">
    <h1>Quản lý bình luận</h1>
</div>

<div class="maincontent">
    <div class="contentinner">
        <div class="row-fluid">
            <div class="span12">
                <form action="index.php?com=comment&act=man" method="POST" name="update_position">
                    <table class="table table-bordered" <?=(count($items))?'id="dyntable"':''?>>
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Thông tin cá nhân</th>
                                <th>Thông tin bình luận</th>
                                <th>Thông tin khác</th>
                                <th>Hiển thị</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>

                        <?php if(empty($items)) echo "<tr><td colspan='10'>Không có mục nào ...</td></tr>";

                        else { for($i=0, $count=count($items); $i<$count; $i++) { ?>

                        <tr><input type="hidden" name="stt[id][]" value="<?=$items[$i]["id"]?>">
                            <td style="width:5%;"><input type="number" min="0" name="stt[stt][]" id="stt" value="<?=$items[$i]['stt']?>" data-id="<?=$items[$i]['id']?>" data-table="comment" class="selectinput update_stt" /></td>
                            <td style="width:20%;">
                                <div class="item-comment">
                                    <p>Họ tên: <strong><?=$items[$i]['hoten']?></strong></p>
                                    <p>Email: <strong><?=$items[$i]['email']?></strong></p>
                                </div>
                            </td>
                            <td style="width:20%;">
                                <?=$items[$i]['noidung']?>
                            </td>
                            <td style="width:20%;">
                                <?php 
                                    $d->reset();
                                    $sql="select id from #_comment where pid='".$items[$i]['id']."'";
                                    $d->query($sql);
                                    $count_comment=$d->result_array();
                                ?>
                                <div class="item-comment">
                                    <p>Trả lời (<?=count($count_comment)?>)</p>
                                    <p><a href="index.php?com=comment&act=edit&id=<?=$items[$i]['id']?>">Trả lời</a></p>
                                    <p><a href="<?=$items[$i]['url']?>" target="_blank">Xem tin</a></p>
                                </div>
                            </td>
                            <td style="width:5%;" class="action">
                                <a data-table="comment" data-id="<?=$items[$i]['id']?>" data-loai="hienthi" class="show_ajax" title="Hiển thị">
                                    <?php if($items[$i]['hienthi']>0) { ?>
                                        <span class="iconfa-ok-circle text-success"></span>
                                    <?php } else { ?>
                                        <span class="iconfa-ban-circle "></span>
                                    <?php } ?>
                                </a>
                            </td>
                            <td style="width:5%;" class="action">
                                <a href="index.php?com=comment&act=edit&id=<?=$items[$i]['id']?>" title="Chỉnh sửa"><span class="iconfa-edit"></span></a>&nbsp&nbsp
                                <a href="index.php?com=comment&act=delete&id=<?=$items[$i]['id']?>" title="Xóa" onClick="if(!confirm('Bạn có chắc muốn xóa mục này?')) return false;"><span class="iconfa-trash"></span></a>
                            </td>
                        </tr>

                        <?php } } ?>
                    </table>

                </form>

                <div class="pagination pagination-centered" <?=($paging['paging'] == "<ul></ul>")?'style="height: 0px; margin: 0px;"':''?>><?=$paging['paging']?></div>

                <!-- <div class="actionfull">
                    <button class="btn btn-rounded" id="update"><span class="icon-refresh"></span> Cập nhật STT</button>
                </div> -->
            </div>
        </div>
    </div>
</div>