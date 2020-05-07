<?php
	$d->reset();
    $sql = "select * from #_lang";
    $d->query($sql);
    $result_lang = $d->result_array();

	for($i=0;$i<count($result_lang);$i++)
	{
		@define($result_lang[$i]['giatri'],$result_lang[$i]['lang'.$lang]);
	}
?>