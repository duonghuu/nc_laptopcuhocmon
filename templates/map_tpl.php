<?php
	$d->reset();
	$sql = "select ten$lang, diachi$lang, dienthoai, toado, photo, email from #_map where hienthi=1 order by stt asc";
	$d->query($sql);
	$multi_map = $d->result_array();
?>

<div class="title-main">
 	<span><?=$title_tcat?></span>
</div>
<div class="content-main w-clear">
	<div class="list_chinhanh w-clear">
		<ul class="title w-clear" id="list_location">
			<?php for($i=0;$i<count($multi_map);$i++) {?>
				<li onclick="moveToMaker(<?=$i+1?>,this.id)" id="lol<?=$i?>">
					<a><?=$multi_map[$i]['ten'.$lang]?></a>
				</li>
			<?php }?>
		</ul>
	</div>
	<div style="clear:both"></div>
	<div class="box_map w-clear">
		<div id="map_custom"></div>
	</div>
</div>