<!-- Begin Bảng Điều Khiển -->
<div class="breadcrumbwidget">
  <ul class="breadcrumb">
    <li><a href="index.php">Bảng điều khiển</a> <span class="divider">/</span></li>
    <li class="active">Quản lý ngôn ngữ</li>
  </ul>
</div>
<!-- End Bảng Điều Khiển -->

<div class="pagetitle">
	<h1>Danh sách ngôn ngữ</h1>
</div>

<div class="maincontent">
	<div class="contentinner">
		<div class="row-fluid">
			<div class="span12">
        <form class="dataTables-tool" action="index.php?com=lang&act=man" method="POST" name="update_position">
          <table class="table table-bordered" <?=(count($items))?'id="dyntable"':''?>>
            <thead>
              <tr>
                <th style="width:3%" align="center"><input type="checkbox" name="selectall" id="selectall" class="checkall" /></th>
                <th class="text-left">Tên biến</th>
                <?php foreach($config['lang'] as $key => $value) { ?>
                  <th><?=$value?></a></th>
                <?php } ?>
                <th>Thao tác</th>
              </tr>
            </thead> 

            <?php if(empty($items)) echo "<tr><td colspan='10'>Không có mục nào ...</td></tr>";

              else { for($i=0, $count=count($items); $i<$count; $i++){?>

              <tr><input type="hidden" name="no[id][]" value="<?=$items[$i]["id"]?>">
                <td style="width:3%;" align="center"><input type="checkbox" name="chose" id="chose" value="<?=$items[$i]['id']?>" class="chon" /></td>
                <td style="width:15%;" class="text-left">
                  <a href="index.php?com=lang&act=edit&id=<?=$items[$i]['id']?>" title="Cập nhật"><?=$items[$i]['giatri']?></a>
                </td>
                <?php foreach($config['lang'] as $key => $value) { ?>
                  <td style="width:10%;" class="action"><?=$items[$i]['lang'.$key]?></td>
                <?php } ?>
                <td style="width:5%;" class="action">
                  <a href="index.php?com=lang&act=edit&id=<?=$items[$i]['id']?>" title="Sửa"><span class="iconfa-edit"></span></a>&nbsp
                  <?php if($_SESSION['login']['username']=="coder" && $_SESSION['login']['password']=="487b60d660404828de12de149518232c") { ?>
                    <a href="index.php?com=lang&act=delete&id=<?=$items[$i]['id']?>" onClick="if(!confirm('Bạn có chắc muốn xóa dữ liệu ?')) return false;" title="Xóa"><span class="iconfa-trash"></span></a>
                  <?php } ?>
                </td>
              </tr>

            <?php } }?>
          </table>
        </form>

        <div class="pagination pagination-centered" <?=($paging['paging'] == "<ul></ul>")?'style="height: 0px; margin: 0px;"':''?>><?=$paging['paging']?></div>

        <?php if($_SESSION['login']['username']=="coder" && $_SESSION['login']['password']=="487b60d660404828de12de149518232c") { ?>
          <div class="actionfull">
            <a href="index.php?com=lang&act=add" class="btn btn-rounded"><icon class="icon-plus"></icon> Thêm mới</a>
            <button class="btn btn-rounded" id="delall"><span class="icon-trash"></span> Xóa nhiều</button>
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
      ch.each(function(){ 
        jQuery(this).attr('checked',true);
        jQuery(this).parent().addClass('checked');
        jQuery(this).parents('tr').addClass('selected');
    });           
    } else {     
      ch.each(function(){ 
        jQuery(this).attr('checked',false); 
        jQuery(this).parent().removeClass('checked');  //used for the custom checkbox style
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
      if (hoi==true) document.location = "index.php?com=lang&act=delete&listid=" + listid;
    });
  }
</script>