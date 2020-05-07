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
	
	$id_wrap = sanitize($_POST['id_wrap']);
	$ccm_ajax = get_result_array("SELECT * FROM table_comment WHERE pid=$id_wrap ORDER BY ngaydang DESC");
?>

<?php for($b=5;$b<count($ccm_ajax);$b++) { ?>
   	<div class="box-cm">
        <div class="w-clear">
            <div class="box-cm-c">
                <?=split_name($ccm_ajax[$b]['hoten']);?>
            </div>
            <div class="box-cm-name <?php if(strtolower($ccm_ajax[$b]['typereply'])=='admin'){echo ' box-cm-namead';}?>">
                <?=$ccm_ajax[$b]['hoten']?>
            </div>
        </div>
        <div class="box-cm-info">
            <div><?=$ccm_ajax[$b]['noidung']?></div>
            <div class="clear"></div>
        </div>
    </div>
<?php } ?>