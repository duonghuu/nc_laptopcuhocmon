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
?>
<form name="form1" class="frm-cart frm-fancycart" method="post">
    <script src="assets/handlecounter/js/handleCounter.js"></script>
    <script type="text/javascript">
        $(".mausize-procart select").change(function(){
            var idmausize=$(this).val();
            var pid=$(this).attr("data-pid");
            var mauold=$(this).attr("data-mauold");
            var sizeold=$(this).attr("data-sizeold");
            var kind=$(this).attr("data-kind");
            $.ajax({
                type: "POST",
                url: "ajax/ajax_mausize.php",
                dataType: 'html',
                data: {idmausize:idmausize,pid:pid,mauold:mauold,sizeold:sizeold,kind:kind},
                success: function(res){
                    window.location="<?=$config_url_http?>gio-hang.html";
                }
            });
        })
        $(".del-procart").click(function(){
            if(confirm('<?=_banmuonxoasanphamnay?>'))
            {
                var pid=$(this).data("pid");
                var mau=$(this).data("mau");
                var size=$(this).data("size");
                $.ajax({
                    type: "POST",
                    url:'ajax/delete_cart.php',
                    dataType: 'json',
                    data: {pid:pid,mau:mau,size:size},
                    success: function(kt){
                        if(kt.max>0)
                        {
                            $('.load-price-final').html(kt.tonggia);
                            $(".item-procart-"+pid+mau+size).remove();
                        }
                        else
                        {
                            $(".tool-cart").remove();
                            $(".wrap-cart").html('<a href="" class="empty-cart"><i class="fa fa-cart-arrow-down"></i><p><?=_khongtontaisanphamtronggiohang?></p><span><?=_vetrangchu?></span></a>');
                        }
                    }
                });
            }
        })

        function update_cart(pid,quantity,mau,size)
        {
            var pr_trans=$(".price-transport").val();
            $.ajax({
            type: "POST",
            url: "ajax/update_cart.php",
            dataType: 'json',
            data: {pid:pid,q:quantity,mau:mau,size:size,pr_trans:pr_trans},
            success: function(result){
                if(result){
                    $('.load-price'+pid+mau+size).html(result.giaban);
                    $('.load-price-km'+pid+mau+size).html(result.giakm);
                    $('.load-price-final').html(result.tonggia);
                    $('.load-price-coupon').html(result.tonggia_coupon);
                }
            }
            });
        }

        function thanhtoan_cart()
        {
            window.location="<?=$config_url_http?>gio-hang.html";
        }
    </script>
    <div class="wrap-cart">
        <div class="top-cart">
            <input type="hidden" name="pid" />
            <input type="hidden" name="mau" />
            <input type="hidden" name="size" />
            <input type="hidden" name="mauold" />
            <input type="hidden" name="sizeold" />
            <input type="hidden" name="coupon" />
            <input type="hidden" name="command" />
            <p class="title-cart"><?=_giohangcuaban?>:</p>
            <?php $max=count($_SESSION['cart']); for($i=0;$i<$max;$i++) {
                $pid=$_SESSION['cart'][$i]['productid'];
                $q=$_SESSION['cart'][$i]['qty'];
                $mau=($_SESSION['cart'][$i]['mau']=='')?0:$_SESSION['cart'][$i]['mau'];
                $size=($_SESSION['cart'][$i]['size']=='')?0:$_SESSION['cart'][$i]['size'];
                $proinfo=get_product_info($pid);
                $maucart=($proinfo['id_mau']!='')?explode(',',$proinfo['id_mau']):0;
                $sizecart=($proinfo['id_size']!='')?explode(',',$proinfo['id_size']):0; ?>
                <div class="item-procart item-procart-<?=$pid.$mau.$size?>">
                    <p class="pic-procart">
                        <a href="<?=$proinfo['type']?>/<?=$proinfo['tenkhongdau']?>-<?=$proinfo['id']?>.html" target="_blank" title="<?=$proinfo['ten'.$lang]?>"><img src="<?=_upload_product_l.$proinfo['photo']?>" alt="<?=$proinfo['ten'.$lang]?>"></a>
                        <a class="del-procart" data-pid="<?=$pid?>" data-mau="<?=$mau?>" data-size="<?=$size?>">
                            <i class="fa fa-times-circle"></i>
                            <span><?=_xoa?></span>
                        </a>
                    </p>
                    <div class="info-procart">
                        <div class="left-info-procart">
                            <h3 class="name-procart"><a href="<?=$proinfo['type']?>/<?=$proinfo['tenkhongdau']?>-<?=$proinfo['id']?>.html" target="_blank" title="<?=$proinfo['ten'.$lang]?>"><?=$proinfo['ten'.$lang]?></a></h3>
                            <div class="khuyenmai-procart"><?=str_replace("\n","<br/>",$proinfo['khuyenmai'.$lang])?></div>
                            <div class="mausize-procart">
                                <?php if($proinfo['id_mau']!='') { ?>
                                    <select data-pid="<?=$pid?>" data-mauold="<?=$mau?>" data-sizeold="<?=$size?>" data-kind="mau" class="sel-cart">
                                        <option value=""><?=_mausac?></option>
                                        <?php for($j=0;$j<count($maucart);$j++) {
                                            $selmau = get_fetch_array("SELECT ten$lang, id FROM table_product_mau WHERE type='".$proinfo['type']."' AND id='".$maucart[$j]."' ORDER BY stt,id DESC"); ?>
                                            <option <?=($mau==$selmau['id'])?'selected':''?> value="<?=$selmau['id']?>"><?=$selmau['ten'.$lang]?></option>
                                        <?php } ?>
                                    </select>
                                <?php } ?>
                                <?php if($proinfo['id_size']!='') { ?>
                                    <select data-pid="<?=$pid?>" data-mauold="<?=$mau?>" data-sizeold="<?=$size?>" data-kind="size" class="sel-cart">
                                        <option value=""><?=_kichthuoc?></option>
                                        <?php for($j=0;$j<count($sizecart);$j++) {
                                            $selsize = get_fetch_array("SELECT ten$lang, id FROM table_product_size WHERE type='".$proinfo['type']."' AND id='".$sizecart[$j]."' ORDER BY stt,id DESC"); ?>
                                            <option <?=($size==$selsize['id'])?'selected':''?> value="<?=$selsize['id']?>"><?=$selsize['ten'.$lang]?></option>
                                        <?php } ?>
                                    </select>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="right-info-procart">
                            <div class="price-procart">
                                <?php if(check_price($pid)) { ?>
                                    <p class="price-new-cart load-price-km<?=$pid.$mau.$size?>">
                                        <?=number_format(get_price_km($pid)*$q,0, ',', '.')."đ"?>
                                    </p>
                                    <p class="price-old-cart load-price<?=$pid.$mau.$size?>">
                                        <?=number_format(get_price($pid)*$q,0, ',', '.')."đ"?>
                                    </p>
                                <?php } else { ?>
                                    <p class="price-new-cart load-price<?=$pid.$mau.$size?>">
                                        <?=number_format(get_price($pid)*$q,0, ',', '.')."đ"?>
                                    </p>
                                <?php } ?>
                            </div>
                            <div class="handle-counter handle-counter-procart<?=$pid.$mau.$size?> w-clear">
                                <p class="counter-minus btn-hc-pri">-</p>
                                <input type="text" class="quantity-procat" value="<?=$q?>" />
                                <p class="counter-plus btn-hc-pri">+</p>
                            </div>
                            <script type="text/javascript">
                                $('.handle-counter-procart<?=$pid.$mau.$size?>').handleCounter({
                                    minimum: 1,
                                    maximize: 999,
                                    onChange: function(quantity){update_cart(<?=$pid?>,quantity,<?=$mau?>,<?=$size?>); },
                                });
                            </script>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <div class="total-procart">
                <p><?=_tong?>:</p>
                <p class="total-price load-price-final <?=(isset($_SESSION['coupon']['price']))?'price-line':''?>"><?=number_format(get_order_total(),0, ',', '.')?>đ</p>
            </div>
            <?php if(isset($_SESSION['coupon']['price'])) { ?>
                <div class="total-procart">
                    <p><?=_tong?> (<span class="price-coupon">-<?=get_price_coupon()?></span> <?=_uudai?>):</p>
                    <p class="total-price load-price-coupon"><?=number_format($_SESSION['coupon']['total'],0, ',', '.')?>đ</p>
                </div>
            <?php } ?>
            <input type="hidden" class="price-final" name="price-final">
            <input type="hidden" class="price-coupon" name="price-coupon">
        </div>
        <input type="button" class="thanhtoan bgcart" name="thanhtoan" onclick="thanhtoan_cart();" value="<?=_thanhtoan?>">
    </div>
</form>