<div class="title-main"><span>Chi tiết sản phẩm</span></div>
<div class="content-main w-clear">
    <div class="box-pro-detail">
        <div class="left-pro-detail w-clear">
            <a id="Zoom-1" class="MagicZoom" href="720x570x2/100/100/0/0/detail/<?=_upload_product_l.$row_detail['photo']?>" title="<?=$row_detail['ten'.$lang]?>"><img src="720x570x2/100/100/0/0/detail/<?=_upload_product_l.$row_detail['photo']?>" alt="<?=$row_detail['ten'.$lang]?>"></a>
            <?php if(count($hinhanhsp)>0) { ?>
                <div class="selectors slick-thumb-pro">
                    <div><a class="thumb-pro-detail" data-zoom-id="Zoom-1" href="720x570x2/100/100/0/0/detail/<?=_upload_product_l.$row_detail['photo']?>" title="<?=$row_detail['ten'.$lang]?>"><img src="720x570x2/100/100/0/0/detail/<?=_upload_product_l.$row_detail['photo']?>" alt="<?=$row_detail['ten'.$lang]?>"></a></div>
                    <?php for($i=0;$i<count($hinhanhsp);$i++) { ?>
                        <div><a class="thumb-pro-detail" data-zoom-id="Zoom-1" href="720x570x2/100/100/0/0/detail/<?=_upload_product_l.$hinhanhsp[$i]['photo']?>" title="<?=$row_detail['ten'.$lang]?>"><img src="720x570x2/100/100/0/0/detail/<?=_upload_product_l.$hinhanhsp[$i]['photo']?>" alt="<?=$row_detail['ten'.$lang]?>"></a></div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>

        <div class="center-pro-detail w-clear">
            <p class="title-pro-detail"><?=$row_detail['ten'.$lang]?></p>
            <div class="tbl-pro-detail">
                <div class="desc-pro-detail"><?=str_replace("\n","<br/>",$row_detail['mota'.$lang])?></div>
                <div class="tbl-pro-detail-child"> 
                    <span><?=_masp?>:</span>
                    <p><?=$row_detail['masp']?></p>
                </div>
                <?php if($row_detail['giagiam'] != '0' && $row_detail['giagiam'] != '') { ?>
                    <div class="tbl-pro-detail-child price-detail">
                        <span><?=_giamoi?>:</span>
                        <p><?=number_format($row_detail['giagiam'],0, ',', '.')?>đ</p>
                    </div>
                    <div class="tbl-pro-detail-child price-detail">
                        <span><?=_giacu?>:</span>
                        <p class='price-detail-old'><?=number_format($row_detail['gia'],0, ',', '.')?>đ</p>
                    </div>
                <?php } else { ?>
                    <div class="tbl-pro-detail-child price-detail">
                        <span><?=_gia?>:</span>
                        <?php
                            if($row_detail['gia'] != '0' && $row_detail['gia'] != '')
                                echo "<p>".number_format($row_detail['gia'],0, ',', '.')."đ</p>";
                            else
                                echo "<p>"._lienhe."</p>";
                        ?>
                    </div>
                <?php } ?>
                <div class="tbl-pro-detail-child"> 
                    <span><?=_luotxem?>:</span>
                    <p><?=$row_detail['luotxem']+1247?></p>
                </div>
                <div class="tbl-pro-detail-child"> 
                    <span><?=_soluong?>:</span>
                    <p>
                        <strong class="quantity-pro-detail">
                            <span class="quantity-minus-pro-detail">-</span>
                            <input type="number" class="qty-pro" min="1" value="1" readonly />
                            <span class="quantity-plus-pro-detail">+</span>
                        </strong>
                    </p>
                </div>
            </div>
            <div class="cart-pro-detail">
                <a class="transition addnow" onclick="add_to_cart(<?=$row_detail['id']?>,'addnow');" href="javascript:void(0)"><i class="fa fa-shopping-bag"></i><span>Thêm vào giỏ hàng</span></a>
                <a class="transition buynow" onclick="add_to_cart(<?=$row_detail['id']?>,'buynow');" href="javascript:void(0)"><i class="fa fa-shopping-bag"></i><span>Đặt hàng</span></a>
            </div>
            <div class="tags-pro-detail">
                <p>Tags:</p>
                <?php foreach ($tags as $key => $value) { ?>
                    <a class="transition" href="tags-san-pham/<?=$value['tenkhongdau']?>" title="<?=$value['ten'.$lang]?>"><?=$value['ten'.$lang]?></a>
                <?php } ?>
            </div>
            <div class="social-plugin w-clear">
                <div class="addthis_inline_share_toolbox_qj48"></div>
                <div class="zalo-share-button" data-href="<?=getCurrentPageURL()?>" data-oaid="<?=($row_setting['oaidzalo']!='')?$row_setting['oaidzalo']:'579745863508352884'?>" data-layout="3" data-color="blue" data-customize=false></div>
            </div>
        </div>

        <div class="right-pro-detail w-clear">
            <div class="artilce-pro-detail">
                <p class="artilce-title-pro-detail">Hỗ trợ online</p>
                <div class="artilce-content-pro-detail">
                    <ul class="artilce-ul-pro-detail">
                        <?php foreach ($hotroonline as $key => $value) { ?>
                            <li>
                                <a title="<?=$value['ten'.$lang]?>">
                                    <p><img src="<?=_upload_news_l.$value['photo']?>" alt="<?=$value['ten'.$lang]?>"></p>
                                    <p><?=$value['ten'.$lang]?></p>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <div class="artilce-pro-detail">
                <p class="artilce-title-pro-detail">Hỗ trợ mua hàng</p>
                <div class="artilce-content-pro-detail">
                    <ul class="artilce-ul-pro-detail">
                        <?php foreach ($hotromuahang as $key => $value) { ?>
                            <li>
                                <a title="<?=$value['ten'.$lang]?>">
                                    <p class="artilce-pic-ul-pro-detail"><img src="<?=_upload_news_l.$value['photo']?>" alt="<?=$value['ten'.$lang]?>"></p>
                                    <p class="artilce-title-ul-pro-detail"><?=$value['ten'.$lang]?></p>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="tabs-pro-detail w-clear">
        <div id="container">
            <div id="parentHorizontalTab">
                <ul class="resp-tabs-list hor_1">
                    <li><?=_thongtinsanpham?></li>
                    <li><?=_binhluan?></li>
                </ul>
                <div class="resp-tabs-container hor_1">
                    <div>
                        <?=check_ssl_content($row_detail['noidung'.$lang])?>
                        <div class="clear"></div>
                    </div>
                    <div>
                        <div class="fb-comments" data-href="<?=getCurrentPageURL()?>" data-numposts="3" data-colorscheme="light" data-width="100%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="title-main" style="margin-top:40px"><span><?=_sanphamcungloai?></span></div>
<div class="content-main w-clear">
    <?php if(count($product)>0) { for($i=0;$i<count($product);$i++) { ?>
        <a class="sp" href="san-pham/<?=$product[$i]['tenkhongdau']?>-<?=$product[$i]['id']?>.html" title="<?=$product[$i]['ten'.$lang]?>">
            <div class="info-sp">
                <div class="pic-sp scale-img">
                    <img src="270x205x2/100/100/0/0/product/<?=_upload_product_l.$product[$i]['photo']?>" alt="<?=$product[$i]['ten'.$lang]?>"/>
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
    <?php } } else { ?>
        <div class="notice_pro"><h4><?=_khongtimthayketqua?></h4></div>
    <?php } ?>
    <div class="clear"></div>
    <div class="pagination"><ul><?=$paging['paging']?></ul></div>
</div>