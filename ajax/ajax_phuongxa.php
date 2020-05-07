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
	
	$id_quanhuyen = sanitize($_POST['id_quanhuyen']);
	if($id_quanhuyen) $phuongxa = get_result_array("SELECT ten,id FROM table_phuongxa WHERE id_cat=$id_quanhuyen ORDER BY id ASC");

	if(count($phuongxa)>0)
	{ ?>  
		<option value=""><?=_phuongxa?></option>
		<?php for($i=0;$i<count($phuongxa);$i++) { ?>
			<option value="<?=$phuongxa[$i]['id']?>"><?=$phuongxa[$i]['ten']?></option>
		<?php }
	}
	else
	{ ?>
		<option value=""><?=_phuongxa?></option>
	<?php }
?>