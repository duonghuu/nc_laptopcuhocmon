<!-- Begin Bảng Điều Khiển -->
<div class="breadcrumbwidget">
    <ul class="breadcrumb">
        <li><a href="index.php">Bảng điều khiển</a> <span class="divider">/</span></li>
        <li class="active">Quản lý tài khoản admin</li>
    </ul>
</div>
<!-- End Bảng Điều Khiển -->

<div class="pagetitle">
	<h1>Danh sách tài khoản admin</h1>
</div>

<div class="maincontent">
	<div class="contentinner">
		<div class="row-fluid">
			<div class="span12">
				<table class="table table-bordered" <?=(count($items))?'id="dyntable"':''?>>
					<thead>
						<tr>
							<th>STT</th>
							<th>Tài khoản</th>
							<th>Email</th>
							<th>Kích hoạt</th>
							<?php if($config_phanquyen=='true') { ?>
								<th>Phân quyền</th>
							<?php } ?>
							<th>Thao tác</th>
						</tr>
					</thead>

					<?php for($i=0, $count=count($items); $i<$count; $i++) { ?>

					<tr>
						<td style="width:6%;"><?=$i+1?></td>
						<td style="width:30%;"><a href="index.php?com=user&act=edit_admin&id=<?=$items[$i]['id']?>" title="Cập nhật"><?=$items[$i]['username']?></a></td>
						<td style="width:20%;"><?=$items[$i]['email']?></td>
						<td style="width:5%;" class="action">
							<a data-table="user" data-id="<?=$items[$i]['id']?>" data-loai="hienthi" class="show_ajax" title="Hiển thị">
								<?php if($items[$i]['hienthi']>0) { ?>
									<span class="iconfa-ok-circle text-success"></span>
								<?php } else { ?>
									<span class="iconfa-ban-circle "></span>
								<?php } ?>
							</a>
						</td>
						<?php if($config_phanquyen=='true') { ?>
							<td style="width:10%;"><a href="index.php?com=user&act=phanquyen&id=<?=$items[$i]['id']?>" title="Phân quyền">Phân quyền</a></td>
						<?php } ?>
						<td style="width:6%;" class="action">
							<a href="index.php?com=user&act=edit_admin&id=<?=$items[$i]['id']?>" title="Cập nhật"><span class="iconfa-edit"></span></a>&nbsp
							<a href="index.php?com=user&act=delete_admin&id=<?=$items[$i]['id']?>" onClick="if(!confirm('Bạn có chắc muốn xóa tài khoản này?')) return false;" title="Xóa tài khoản"><span class="iconfa-trash"></span></a>
						</td>
					</tr>
					<?php } ?>
				</table>

				<div class="pagination pagination-centered" <?=($paging['paging'] == "<ul></ul>")?'style="height: 0px; margin: 0px;"':''?>><?=$paging['paging']?></div>

				<div class="actionfull">
					<a href="index.php?com=user&act=add_admin" class="btn btn-rounded"><icon class="icon-plus"></icon> Thêm mới</a>
				</div>
			</div>
		</div>
	</div>
</div>