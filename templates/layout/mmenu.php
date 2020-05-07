<div class="menu-res">
    <div id="mobilemenu">
        <a href="#menu" title="Menu" id="hamburger"><b>Menu</b><span></span></a>
        <nav class="invi-loading" id="menu">
            <ul>
                <li><a href="" title="<?=_trangchu?>"><?=_trangchu?></a></li>
                <li>
                    <a href="san-pham.html" title="<?=_sanpham?>"><?=_sanpham?></a>
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
                <li>
                    <a href="dich-vu.html" title="<?=_dichvu?>"><?=_dichvu?></a>
                    <ul>
                        <?php for($i=0;$i<count($dvmenu); $i++) { ?>
                            <li><a title="<?=$dvmenu[$i]['ten'.$lang]?>" href="dich-vu/<?=$dvmenu[$i]['tenkhongdau']?>-<?=$dvmenu[$i]['id']?>.html"><?=$dvmenu[$i]['ten'.$lang]?></a></li>
                        <?php } ?>
                    </ul>
                </li>
                <li>
                    <a href="chinh-sach-mua.html" title="Chính sách mua">Chính sách mua</a>
                    <ul>
                        <?php for($i=0;$i<count($csmmenu); $i++) { ?>
                            <li><a title="<?=$csmmenu[$i]['ten'.$lang]?>" href="chinh-sach-mua/<?=$csmmenu[$i]['tenkhongdau']?>-<?=$csmmenu[$i]['id']?>.html"><?=$csmmenu[$i]['ten'.$lang]?></a></li>
                        <?php } ?>
                    </ul>
                </li>
                <li><a href="cong-trinh.html" title="Công trình đã thi công">Công trình đã thi công</a></li>
                <li><a href="lien-he.html" title="<?=_lienhe?>"><?=_lienhe?></a></li>
            </ul>
        </nav>
    </div>
</div>