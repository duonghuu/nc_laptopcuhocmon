<?php	
	if(!defined('_source')) die("Error");

	$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
	switch($act)
	{
		case "capnhat":		
			$template = "import/man/item_add";
			break;
		default:
			$template = "index";
	}
?>