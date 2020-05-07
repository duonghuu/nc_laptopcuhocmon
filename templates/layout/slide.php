<div class="slideshow">
    <div class="wrap-content">
    	<div class="box-slide-left">
	    	<div class="box-menu-left">
	            <div id="smoothmenu3" class="ddsmoothmenu-v w-clear">
	                <ul>
	                    <?php for($i=0;$i<count($splistfix); $i++) { 
	                        $d->reset();
	                        $sql = "select ten$lang, tenkhongdau,id from #_product_cat where hienthi=1 and id_list='".$splistfix[$i]['id']."' order by stt,id desc";
	                        $d->query($sql);
	                        $spcatfix = $d->result_array(); ?>
	                        <li>
	                            <a class="transition" title="<?=$splistfix[$i]['ten'.$lang]?>" href="san-pham/<?=$splistfix[$i]['tenkhongdau']?>-<?=$splistfix[$i]['id']?>/"><span class="text-hide"><?=$splistfix[$i]['ten'.$lang]?></span><i class="fa fa-chevron-right"></i></a>
	                            <?php if(count($spcatfix)>0) { ?>
	                                <ul>
	                                    <?php for($j=0;$j<count($spcatfix);$j++) { ?>
	                                        <li><a title="<?=$spcatfix[$j]['ten'.$lang]?>" href="san-pham/<?=$splistfix[$i]['tenkhongdau']?>/<?=$spcatfix[$j]['tenkhongdau']?>-<?=$spcatfix[$j]['id']?>/"><span class="text-hide"><?=$spcatfix[$j]['ten'.$lang]?></span></a></li>
	                                    <?php } ?>
	                                </ul>
	                            <?php } ?>
	                        </li>
	                    <?php } ?>
	                </ul>
	            </div>
	        </div>
	    </div>
	    <div class="box-slide-right">
	        <div class="slider-wrapper theme-default">
	            <div id="slider-main" class="nivoSlider">
	                <?php for($i=0;$i<count($slider);$i++){ ?>
	                    <a href="<?=$slider[$i]['link']?>" target="_blank" title="<?=$slider[$i]['ten'.$lang]?>"><img src="<?=_upload_photo_l?>915x430x1/<?=$slider[$i]['photo']?>"/></a>
	                <?php } ?>
	            </div>
	        </div>
	    </div>
    </div>
</div>