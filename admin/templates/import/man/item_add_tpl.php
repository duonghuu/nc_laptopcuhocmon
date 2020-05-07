<?php
	global $d;

	$type=$_REQUEST['type'];

	if(isset($_POST['import_sub']))
	{
		$file_type=$_FILES['linkfile']['type'];
		if($file_type=="application/vnd.ms-excel" || $file_type=="application/x-ms-excel")
		{	
			$filename=changeTitle($_FILES["linkfile"]["name"]);
			move_uploaded_file($_FILES["linkfile"]["tmp_name"],$filename);			
			
			require 'PHPExcel.php';
			require_once 'PHPExcel/IOFactory.php';

			$objPHPExcel = PHPExcel_IOFactory::load($filename);
			$mess = '';
			foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) 
			{
				$worksheetTitle = $worksheet->getTitle();
				$highestRow = $worksheet->getHighestRow(); // e.g. 10
				$highestColumn = $worksheet->getHighestColumn(); // e.g 'F'
				$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);

				$nrColumns = ord($highestColumn) - 64;

				for ($row = 3; $row <= $highestRow; ++ $row) 
				{
					if($stt!="" && is_numeric($stt))
					{
						$cell = $worksheet->getCellByColumnAndRow(0, $row);
						$stt = $cell->getValue();

						$cell = $worksheet->getCellByColumnAndRow(1, $row);
						$id = $cell->getValue();

						$cell = $worksheet->getCellByColumnAndRow(2, $row);
						$id_list = $cell->getValue();

						$cell = $worksheet->getCellByColumnAndRow(3, $row);
						$id_cat = $cell->getValue();

						$cell = $worksheet->getCellByColumnAndRow(4, $row);
						$tenvi = $cell->getValue();

						$cell = $worksheet->getCellByColumnAndRow(5, $row);
						$gia = $cell->getValue();
						
						$cell = $worksheet->getCellByColumnAndRow(6, $row);
						$giagiam = $cell->getValue();

						$cell = $worksheet->getCellByColumnAndRow(7, $row);
						$khuyenmaivi = $cell->getValue();
						
						$cell = $worksheet->getCellByColumnAndRow(8, $row);
						$motavi = $cell->getValue();

						$cell = $worksheet->getCellByColumnAndRow(9, $row);
						$noidungvi = $cell->getValue();

						$cell = $worksheet->getCellByColumnAndRow(10, $row);
						$title = $cell->getValue();

						$cell = $worksheet->getCellByColumnAndRow(11, $row);
						$keywords = $cell->getValue();

						$cell = $worksheet->getCellByColumnAndRow(12, $row);
						$description = $cell->getValue();

						/* Lưu Tên Không Dấu */	
						$tenkhongdau = changeTitle($tenvi);

						$sql_import = "select * from table_product where id='".$id."'";
						$d->query($sql_import);

						$data['stt'] = $stt;
						$data['id_list'] = $id_list;
						$data['id_cat'] = $id_cat;
						$data['tenvi'] = $tenvi;
						$data['gia'] = $gia;
						$data['giagiam'] = $giagiam;
						$data['khuyenmaivi'] = $khuyenmaivi;
						$data['motavi'] = $motavi;
						$data['noidungvi'] = $noidungvi;
						$data['title'] = $title;
						$data['keywords'] = $keywords;
						$data['description'] = $description;
						$data['type'] = $type;

						if($d->num_rows()==0)
						{
							$d->reset();
							$d->setTable('product');
							if(!$d->insert($data)) { $mess.='Lỗi tại dòng: '.$row; }
						}
						else
						{
							$d->reset();
							$d->setTable('product');
							$d->setWhere('type', $type);
							$d->setWhere('id', $id);
							if(!$d->update($data)) { $mess.='Lỗi tại dòng: '.$row; }
						}
					}
				}
			}
			if($mess != '') { $mess=$mess; }
			else { $mess="Import danh sách thành công !"; }
			unlink($filename) or DIE("Không thể xóa $dir$file");
		} else { ?>
			<script language="javascript">
				alert("Không hỗ trợ kiểu file này");
			</script>
		<?php }
	}
?>

<!-- Begin Bảng Điều Khiển -->
<div class="breadcrumbwidget">
    <ul class="breadcrumb">
        <li><a href="index.php">Bảng điều khiển</a> <span class="divider">/</span></li>
        <li class="active">Import sản phẩm</li>
    </ul>
</div>
<!-- End Bảng Điều Khiển -->

<div class="pagetitle">
	<h1>Import sản phẩm</h1>
</div>

<div class="maincontent">
	<div class="contentinner">
		<div class="row-fluid">
			<div class="span12">
				<h4 class="widgettitle nomargin shadowed"></h4>
				<div class="widgetcontent bordered shadowed nopadding">
					<form name="form1" id="form1" method="post" action="" enctype="multipart/form-data" class="stdform stdform2">
						<p><label>Upload file:</label><span class="field"><input type="file" name="linkfile" class="uniform-file" /> <strong>Loại : .xls (Ms.Excel 2003)</strong></span></p>
						<p class="stdformbutton">
							<button type="submit" name="import_sub" class="btn btn-primary"><span class="iconfa-save"></span> Lưu</button>
							<strong><?php if(isset($_POST['import_sub'])) echo $mess ?></strong>
						</p>	
					</form>
				</div>
			</div>
		</div>
	</div>
</div>