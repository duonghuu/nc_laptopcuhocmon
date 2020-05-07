<div class="header">
	<div class="header-top">
		<div class="wrap-content">
			<div class="item-header-top"><i class="fa fa-map-marker"></i><span><?=$row_setting['diachi']?></span></div>
			<div class="item-header-top"><i class="fa fa-envelope"></i><span>Email: <?=$row_setting['email']?></span></div>
			<div class="item-header-top"><ul class="mxh mxh-header"><?php for($i=0;$i<count($mxh1);$i++) { ?><li><a href="<?=$mxh1[$i]['link']?>" target="_blank"><img class="lazy" src="assets/images/pixel.gif" data-src="<?=_upload_photo_l.$mxh1[$i]['photo']?>"></a></li><?php } ?></ul></div>
		</div>
	</div>
	<div class="header-bottom">
		<div class="wrap-content">
			<a class="logo-header-bottom" href=""><img class="lazy" src="assets/images/pixel.gif" data-src="<?=_upload_photo_l.$logo['photo']?>"/></a>
			<div class="search-header-bottom">
				<div class="tags-header-bottom text-hide w-clear">
					<a>Xu hướng tìm kiếm:</a>
					<?php foreach($tagsnb as $key => $value) { ?>
						<a class="transition" href="tags-san-pham/<?=$value['tenkhongdau']?>" title="<?=$value['ten'.$lang]?>"><?=$value['ten'.$lang]?></a><?php if($key<count($tagsnb)-1) echo ", "; ?>
            		<?php } ?>
				</div>
				<div class="search w-clear">
		            <input type="text" name="keyword" id="keyword" placeholder="Tìm sản phẩm của bạn..." onkeypress="doEnter(event,'keyword');"/>
		            <input type="hidden" name="category" id="category" value="0">
		            <div class="list-search">
		            	<p class="panel-search transition">
		            		<span>Tất cả</span>
		            		<i class="fa fa-caret-down"></i>
		            	</p>
		            	<ul class="ul-search">
		            		<?php foreach($splistmenu as $value) { ?>
								<li class="transition" data-id="<?=$value['id']?>"><?=$value['ten'.$lang]?></li>
		            		<?php } ?>
		            	</ul>
		            </div>
		            <a class="button-search transition" onclick="onSearch('keyword');" title="Tìm kiếm">Tìm kiếm</a>
		        </div>
			</div>
			<div class="item-header-bottom">
				<p>Hỗ trợ 24/7</p>
				<span><?=$row_setting['hotline']?></span>
			</div>
			<div class="item-header-bottom">
				<p>Giao hàng miễn phí</p>
				<span><?=$ghmp['ten'.$lang]?></span>
			</div>
		</div>
	</div>
</div>
<a id="btn-zalo" href="https://zalo.me/<?=preg_replace('/[^0-9]/','',$row_setting['zalo']);?> " target="_blank">
	<div class="animated infinite zoomIn kenit-alo-circle"></div>
	<div class="animated infinite pulse kenit-alo-circle-fill"></div>
	<i><img class="lazy" src="assets/images/pixel.gif" data-src="assets/images/zalo.png" alt="Zalo"></i>
</a>