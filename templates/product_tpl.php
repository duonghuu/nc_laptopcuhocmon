<div class="title-main"><span><?=$title_tcat?></span></div>
<div class="content-main w-clear">
    <?php if(count($product)>0) {
        echo '<div class="product-grid">';
     for($i=0;$i<count($product);$i++) { 
        showProduct($product[$i]);
        ?>
        <?php /* 
        <div class="pr-box">
                    <a class="sp" href="san-pham/<?=$product[$i]['tenkhongdau']?>-<?=$product[$i]['id']?>.html" title="<?=$product[$i]['ten'.$lang]?>">
                        <div class="info-sp">
                            <div class="pic-sp scale-img">
                                <img src="270x245x2/100/100/0/0/product/<?=_upload_product_l.$product[$i]['photo']?>" alt="<?=$product[$i]['ten'.$lang]?>"/>
                                <div class="desc-sp scroll-maded transition"><?=str_replace("\n","<br>",$product[$i]['mota'.$lang])?></div>
                            </div>
                            <h3 class="name-sp transition"><?=$product[$i]['ten'.$lang]?></h3>
                        </div>
                        <div class="price-sp">
                            <?php if($product[$i]['giagiam']) { ?>
                                <p class="price-old-sp"><?=number_format($product[$i]['gia'],0, ',', '.')?><b>đ</b></p>
                                <p class="price-new-sp"><?=number_format($product[$i]['giagiam'],0, ',', '.')?><b>đ</b></p>
                            <?php } else { ?>
                                <p class="price-new-sp"><?=($product[$i]['gia'])?number_format($product[$i]['gia'],0, ',', '.')."<b>đ</b>":_lienhe?></p>
                            <?php } ?>
                        </div>
                    </a>
                </div> 
        */?>
    <?php } 
    echo '</div>';
} else { ?>
        <div class="notice_pro"><h4><?=_khongtimthayketqua?></h4></div>
    <?php } ?>
    <div class="clear"></div>
    <div class="pagination"><ul><?=$paging['paging']?></ul></div>
</div>