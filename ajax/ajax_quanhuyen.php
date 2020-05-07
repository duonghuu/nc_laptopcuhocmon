<?php
	session_start();
	error_reporting(0);

	@define ( '_lib' , '../admin/lib/');
	@define ( '_source' , '../sources/');
	
	if(!isset($_SESSION['lang'])) $_SESSION['lang']='vi';
    $lang=$_SESSION['lang'];

	include_once _lib."config.php";
	include_once _lib."constant.php";
	include_once _lib."functions.php";
	include_once _lib."functions_giohang.php";
	include_once _lib."class.database.php";
	$d = new database($config['database']);
	require_once _source."lang.php";
	
	$id_tinhthanh = sanitize($_POST['id_tinhthanh']);
	if($id_tinhthanh) $quanhuyen = get_result_array("SELECT ten,id FROM table_quanhuyen WHERE id_list=$id_tinhthanh ORDER BY id ASC");

	if(count($quanhuyen)>0)
	{ ?>  
		<option value=""><?=_quanhuyen?></option>
		<?php for($i=0;$i<count($quanhuyen);$i++) { ?>
			<option value="<?=$quanhuyen[$i]['id']?>"><?=$quanhuyen[$i]['ten']?></option>
		<?php }
	}
	else
	{ ?>
		<option value=""><?=_quanhuyen?></option>
	<?php }
?>