<?php	
	if(!defined('_source')) die("Error");

	$type=$_REQUEST['type'];

	function IdentifyExport()
	{
		global $alphas, $array_file;

		$alphas = range('A','Z');
		$array_file = array(
			'stt'=>'STT',
			'id'=>'ID',
			'id_list'=>'Danh Mục Cấp 1',
			'id_cat'=>'Danh mục 2',
			'tenvi'=>'Tên Sản phẩm',
			'gia'=>'Giá bán',
			'giagiam'=>'Giá mới',
			'khuyenmaivi'=>'Khuyến mãi',
			'motavi'=>'Mô tả',
			'noidungvi'=>'Nội dung',
			'title'=>'Title',
			'keywords'=>'Keywords',
			'description'=>'Description',
		);
	}
	IdentifyExport();
	
	/** PHPExcel */
	include 'PHPExcel.php';

	/** PHPExcel_Writer_Excel */
	include 'PHPExcel/Writer/Excel5.php';
	
	// Create new PHPExcel object
	$objPHPExcel = new PHPExcel();
	
	// Set properties
	$objPHPExcel->getProperties()->setCreator("Diệp Phúc Tài");
	$objPHPExcel->getProperties()->setLastModifiedBy("Diệp Phúc Tài");
	$objPHPExcel->getProperties()->setTitle("Office 2007 XLSX Test Document");
	$objPHPExcel->getProperties()->setSubject("Office 2007 XLSX Test Document");
	$objPHPExcel->getProperties()->setDescription("Document for Office 2007 XLSX, generated using PHP classes.");

	// Add some data
	$objPHPExcel->setActiveSheetIndex(0);
	$objPHPExcel->setActiveSheetIndex( 0 )->mergeCells( 'A1:M1' );
	$objPHPExcel->getActiveSheet()->getRowDimension( '1' )->setRowHeight( 42 );
	$objPHPExcel->getActiveSheet()->getRowDimension( '2' )->setRowHeight( 25 );

	$objPHPExcel->getActiveSheet()->getStyle( 'A1' )->applyFromArray( array( 'font' => array( 'color' => array( 'rgb' => '1F2C48' ),'name' => 'Tahoma', 'bold' => true, 'italic' => false, 'size' => 17 ), 'alignment' => array( 'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => true ),'fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb'=>'c2def0'))));

	$i=0;
	foreach($array_file as $k=>$v)
	{
		if($i<2)
		{
			$objPHPExcel->getActiveSheet()->getColumnDimension( $alphas[$i] )->setWidth(10);
		}
		else
		{
			$objPHPExcel->getActiveSheet()->getColumnDimension( $alphas[$i] )->setWidth(25);
		}
		$i++;
	}

	$objPHPExcel->setActiveSheetIndex( 0 )->setCellValue('A1','DANH SÁCH SẢN PHẨM');

	$i=0;
	foreach($array_file as $k=>$v)
	{
		$objPHPExcel->setActiveSheetIndex( 0 )->setCellValue( $alphas[$i].'2', $v );
		$i++;
	}

	$i=0;
	foreach($array_file as $k=>$v)
	{
		$objPHPExcel->getActiveSheet()->getStyle( $alphas[$i].'2' )->applyFromArray( array( 'font' => array( 'color' => array( 'rgb' => 'c2def0' ), 'name' => 'Tahoma', 'bold' => false, 'italic' => false, 'size' => 12 ), 'alignment' => array( 'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => true ),'fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb'=>'1F2C48'))));
		$i++; 
	}

	$d->reset();
	$sql="SELECT * FROM table_product WHERE type='$type' ORDER BY stt,id DESC";
	$d->query($sql);
	$product=$d->result_array();

	$vitri=3;
	for($i=0;$i<count($product);$i++)
	{
		$j=0;
		foreach($array_file as $k=>$v)
		{
			$objPHPExcel->setActiveSheetIndex( 0 )->setCellValue($alphas[$j].$vitri,$product[$i][$k]);
			$j++;
		}
		$vitri++;
	}

	$vitri=3;
	for($i=0;$i<count($product);$i++)
	{
		$j=0;
		foreach($array_file as $k=>$v)
		{
			$objPHPExcel->getActiveSheet()->getStyle( $alphas[$j].$vitri )->applyFromArray(
				array( 
					'font' => array( 
						'color' => array( 'rgb' => '000000' ), 
						'name' => 'Arial', 
						'bold' => false, 
						'italic' => false, 
						'size' => 10 
					), 
					'alignment' => array( 
						'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 
						'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 
						'wrap' => true 
					)
				)
			);
			$objPHPExcel->getActiveSheet()->getStyle('F'.$vitri)->getNumberFormat()->setFormatCode("#,##0 _€");
			$objPHPExcel->getActiveSheet()->getStyle('G'.$vitri)->getNumberFormat()->setFormatCode("#,##0 _€");
			$j++;
		}
		$vitri++;
	}

	// Rename sheet
	$objPHPExcel->getActiveSheet()->setTitle('DANH SÁCH SẢN PHẨM');

	// Redirect output to a client’s web browser (Excel5)
	header( 'Content-Type: application/vnd.ms-excel' );
	header( 'Content-Disposition: attachment;filename="danhsachsanpham_'.date('d_m_Y').'.xls"' );
	header( 'Cache-Control: max-age=0' );

	$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
	$objWriter->save( 'php://output' );
?>