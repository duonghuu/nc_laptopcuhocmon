<div class="menu">
    <div class="wrap-content">
        <div class="menu-left">
            <a class="title-menu-left" href="san-pham.html" title="Danh mục sản phẩm">
                <i class="fa fa-bars"></i>
                <span>Danh mục sản phẩm</span>
            </a>
            <div class="box-menu-left">
                <div id="smoothmenu2" class="ddsmoothmenu-v w-clear">
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
        <div class="menu-right">
            <div id="smoothmenu1" class="ddsmoothmenu">
                <ul class="w-clear">
                    <li class="first-li">
                        <a class="transition <?php if($com=='san-pham') echo 'active'; ?>" href="san-pham.html" title="<?=_sanpham?>"><?=_sanpham?><i class="fa fa-chevron-down"></i></a>
                        <ul>
                            <?php for($i=0;$i<count($splistmenu); $i++) { 
                                $d->reset();
                                $sql = "select ten$lang, tenkhongdau,id from #_product_cat where hienthi=1 and id_list='".$splistmenu[$i]['id']."' order by stt,id desc";
                                $d->query($sql);
                                $spcatmenu = $d->result_array(); ?>
                                <li>
                                    <a title="<?=$splistmenu[$i]['ten'.$lang]?>" href="san-pham/<?=$splistmenu[$i]['tenkhongdau']?>-<?=$splistmenu[$i]['id']?>/"><?=$splistmenu[$i]['ten'.$lang]?></a>
                                    <?php if(count($spcatmenu)>0) { ?>
                                        <ul>
                                            <?php for($j=0;$j<count($spcatmenu);$j++) { ?>
                                                <li><a title="<?=$spcatmenu[$j]['ten'.$lang]?>" href="san-pham/<?=$splistmenu[$i]['tenkhongdau']?>/<?=$spcatmenu[$j]['tenkhongdau']?>-<?=$spcatmenu[$j]['id']?>/"><?=$spcatmenu[$j]['ten'.$lang]?></a></li>
                                            <?php } ?>
                                        </ul>
                                    <?php } ?>
                                </li>
                            <?php } ?>
                        </ul>
                    </li>
                    <li class="first-li">
                        <a class="transition <?php if($com=='dich-vu') echo 'active'; ?>" href="dich-vu.html" title="<?=_dichvu?>"><?=_dichvu?><i class="fa fa-chevron-down"></i></a>
                        <ul>
                            <?php for($i=0;$i<count($dvmenu); $i++) { ?>
                                <li><a title="<?=$dvmenu[$i]['ten'.$lang]?>" href="dich-vu/<?=$dvmenu[$i]['tenkhongdau']?>-<?=$dvmenu[$i]['id']?>.html"><?=$dvmenu[$i]['ten'.$lang]?></a></li>
                            <?php } ?>
                        </ul>
                    </li>
                    <li class="first-li">
                        <a class="transition <?php if($com=='chinh-sach-mua') echo 'active'; ?>" href="chinh-sach-mua.html" title="Chính sách mua">Chính sách mua<i class="fa fa-chevron-down"></i></a>
                        <ul>
                            <?php for($i=0;$i<count($csmmenu); $i++) { ?>
                                <li><a title="<?=$csmmenu[$i]['ten'.$lang]?>" href="chinh-sach-mua/<?=$csmmenu[$i]['tenkhongdau']?>-<?=$csmmenu[$i]['id']?>.html"><?=$csmmenu[$i]['ten'.$lang]?></a></li>
                            <?php } ?>
                        </ul>
                    </li>
                    <li class="first-li"><a class="transition <?php if($com=='cong-trinh') echo 'active'; ?>" href="cong-trinh.html" title="Công trình đã thi công">Công trình đã thi công</a></li>
                    <li class="first-li"><a class="transition <?php if($com=='lien-he') echo 'active'; ?>" href="lien-he.html" title="<?=_lienhe?>"><?=_lienhe?></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>