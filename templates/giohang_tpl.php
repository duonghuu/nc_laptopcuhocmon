<script type="text/javascript">
    $(document).ready(function(){
        $(".mausize-procart select").change(function(){
            var idmausize=$(this).val();
            if(idmausize!='')
            {
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
            }
            else
            {
                alert('<?=_mauvakichthuockhongphuhop?>');
                return false;
            }
        })
        $(".del-procart").click(function(){
            if(confirm('<?=_banmuonxoasanphamnay?>'))
            {
                var pid=$(this).data("pid");
                var mau=$(this).data("mau");
                var size=$(this).data("size");
                $.ajax({
                    type: "POST",
                    url:'ajax/ajax_delete_cart.php',
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
        $(".item-httt").click(function(){
            var httt=$(this).find(".label-httt").data("httt");
            $(".item-httt .label-httt, .info-httt").removeClass("active");
            $(this).find(".label-httt").addClass("active");
            $(".info-httt-"+httt).addClass("active");
        });
        $("input.quantity-procat").change(function(){
        	var quantity=$(this).val();
        	var pid=$(this).data("pid");
            var mau=$(this).data("mau");
            var size=$(this).data("size");
        	update_cart(pid,quantity,mau,size);
        })
    })

    function update_cart(pid,quantity,mau,size)
    {
        var pr_trans=$(".price-transport").val();
        $.ajax({
        type: "POST",
        url: "ajax/ajax_update_cart.php",
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

    function quantity_cart(element,pid,quantity,mau,size)
    {
    	$(element+pid+mau+size+" span").click(function(){
            var $button = $(this);
            var oldValue = $button.parent().find("input").val();
            if($button.text() == "+")
            {
                quantity = parseFloat(oldValue) + 1;
            }
            else
            {
                if(oldValue > 1) quantity = parseFloat(oldValue) - 1;
            }
            $button.parent().find("input").val(quantity);
            update_cart(pid,quantity,mau,size);
        });
    }

    function xuly_coupon()
    {
        var code_coupon = document.getElementById('code-coupon').value;
        if(code_coupon!='')
        {
            document.form1.coupon.value='coupon';
            document.form1.submit(); 
        }
        else
        {
            alert("<?=_chuanhapmauudai?>");
        }
    }

    function load_quanhuyen(id)
    {
        $.ajax({
            type: 'post',
            url: 'ajax/ajax_quanhuyen.php',
            data: {id_tinhthanh:id},
            success: function (response) {
                $(".sel-quanhuyen").html(response);
                $(".sel-phuongxa").html('<option value=""><?=_phuongxa?></option>');
            }
        });
    }

    function load_phuongxa(id)
    {
        $.ajax({
            type: 'post',
            url: 'ajax/ajax_phuongxa.php',
            data: {id_quanhuyen:id},
            success: function (response) {
                $(".sel-phuongxa").html(response);
            }
        });
    }

    function load_giaship(id)
    {   
        // $.ajax({
        //     type: "POST",
        //     url: "ajax/ajax_giaship.php",
        //     dataType: 'json',
        //     data: {id:id},
        //     success: function(res) {
        //         if(res)
        //         {
        //             $('.load-price-transport').html(res.giaship+"đ");
        //             $('.load-price-final').html(res.tonggia+"đ");
        //             $('.load-price-coupon').html(res.tonggia_coupon+"đ");
        //             $('.price-transport').val(res.giaship_goc);
        //             $('.price-final').val(res.tonggia_goc);
        //             $('.price-coupon').val(res.tonggia_coupon_goc);
        //         }   
        //     }
        // }); 
    }
</script>

<form name="form1" class="frm-cart" method="post">
	<div class="wrap-cart">
		<?php if(isset($_SESSION['cart']) && count($_SESSION['cart'])>0) { ?>
			<div class="top-cart">
				<input type="hidden" name="pid" />
				<input type="hidden" name="mau" />
				<input type="hidden" name="size" />
				<input type="hidden" name="mauold" />
				<input type="hidden" name="sizeold" />
				<input type="hidden" name="coupon" />
				<input type="hidden" name="command" />
				<p class="title-cart"><?=_giohangcuaban?>:</p>
				<div class="list-procart">
					<div class="item-procart item-procart-label">
						<div class="pic-procart">Hình ảnh</div>
						<div class="info-procart">Tên sản phẩm</div>
						<div class="quantity-procart">
							<p>Số lượng</p>
							<p>Thành tiền</p>
						</div>
						<div class="price-procart">Thành tiền</div>
					</div>
					<?php $max=count($_SESSION['cart']); for($i=0;$i<$max;$i++) {
						$pid=$_SESSION['cart'][$i]['productid'];
						$q=$_SESSION['cart'][$i]['qty'];
						$mau=($_SESSION['cart'][$i]['mau']=='')?0:$_SESSION['cart'][$i]['mau'];
						$size=($_SESSION['cart'][$i]['size']=='')?0:$_SESSION['cart'][$i]['size'];
						$proinfo=get_product_info($pid);
						$mauarr=get_array_mausize($pid,"mau");
						$sizearr=get_array_mausize($pid,"size");
						$maucart=($proinfo['id_mau']!='')?explode(',',$proinfo['id_mau']):0;
						$sizecart=($proinfo['id_size']!='')?explode(',',$proinfo['id_size']):0; ?>
						<div class="item-procart item-procart-<?=$pid.$mau.$size?>">
							<div class="pic-procart">
								<a href="<?=$proinfo['type']?>/<?=$proinfo['tenkhongdau']?>-<?=$proinfo['id']?>.html" target="_blank" title="<?=$proinfo['ten'.$lang]?>"><img onerror="this.src='//placehold.it/85x85';" src="<?=_upload_product_l.$proinfo['photo']?>" alt="<?=$proinfo['ten'.$lang]?>"></a>
								<a class="del-procart" data-pid="<?=$pid?>" data-mau="<?=$mau?>" data-size="<?=$size?>">
									<i class="fa fa-times-circle"></i>
									<span><?=_xoa?></span>
								</a>
							</div>
							<div class="info-procart">
								<h3 class="name-procart"><a href="<?=$proinfo['type']?>/<?=$proinfo['tenkhongdau']?>-<?=$proinfo['id']?>.html" target="_blank" title="<?=$proinfo['ten'.$lang]?>"><?=$proinfo['ten'.$lang]?></a></h3>
								<div class="khuyenmai-procart"><?=str_replace("\n","<br/>",$proinfo['khuyenmai'.$lang])?></div>
							</div>
							<div class="quantity-procart">
								<div class="price-procart price-procart-rp">
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
				                <div class="quantity-counter-procart quantity-counter-procart<?=$pid.$mau.$size?> w-clear">
			                        <span class="counter-procart-minus counter-procart">-</span>
			                        <input type="number" class="quantity-procat" min="1" value="<?=$q?>" data-pid="<?=$pid?>" data-mau="<?=$mau?>" data-size="<?=$size?>"/>
			                        <span class="counter-procart-plus counter-procart">+</span>
			                    </div>
				                <div class="pic-procart pic-procart-rp">
									<a href="<?=$proinfo['type']?>/<?=$proinfo['tenkhongdau']?>-<?=$proinfo['id']?>.html" target="_blank" title="<?=$proinfo['ten'.$lang]?>"><img onerror="this.src='//placehold.it/85x85';" src="<?=_upload_product_l.$proinfo['photo']?>" alt="<?=$proinfo['ten'.$lang]?>"></a>
									<a class="del-procart" data-pid="<?=$pid?>" data-mau="<?=$mau?>" data-size="<?=$size?>">
										<i class="fa fa-times-circle"></i>
										<span><?=_xoa?></span>
									</a>
								</div>
				                <script type="text/javascript">
				                	quantity_cart(".quantity-counter-procart",<?=$pid?>,<?=$q?>,<?=$mau?>,<?=$size?>);
				                </script>
							</div>
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
						</div>
			        <?php } ?>
				</div>
		        <div class="money-procart">
		        	<?php /* ?>
		        	<div class="total-procart">
			        	<p><?=_phivanchuyen?>:</p>
			        	<p class="total-price load-price-transport">0đ</p>
			        </div>
		        	<?php */ ?>
			        <div class="total-procart">
			        	<p><?=_tong?>:</p>
			        	<p class="total-price load-price-final <?=(isset($_SESSION['coupon']['price']))?'price-line':''?>"><?=number_format(get_order_total(),0, ',', '.')?>đ</p>
			        </div>
	                <?php /* if(isset($_SESSION['coupon']['price'])) { ?>
	                	<div class="total-procart">
				        	<p><?=_tong?> (<span class="price-coupon">-<?=get_price_coupon()?></span> <?=_uudai?>):</p>
				        	<p class="total-price load-price-coupon"><?=number_format($_SESSION['coupon']['total'],0, ',', '.')?>đ</p>
				        </div>
		            <?php } ?>
		            <div class="total-procart coupon-procart">
			        	<p><?=_sudungmauudai?>:</p>
			        	<div class="inp-coupon-procart">
							<input type="text" class="inp-cart" name="code-coupon" id="code-coupon" placeholder="<?=_nhapmauudai?>">
							<input type="button" class="bgcart" value="<?=_apdungmauudai?>" onclick="xuly_coupon()">
						</div>
			        </div>
			        <?php */ ?>
			        <input type="hidden" class="price-transport" name="price-transport">
	                <input type="hidden" class="price-final" name="price-final">
	                <input type="hidden" class="price-coupon" name="price-coupon">
		        </div>
		    </div>
		    <div class="bottom-cart">
		    	<div class="section-cart">
		    		<p class="title-cart">Hình thức thanh toán:</p>
			    	<div class="information-cart list-httt">
			    		<?php foreach($httt as $key => $value) { ?>
			    			<div class="item-httt">
			    				<label class="label-httt" data-httt="<?=$value['id']?>">
				    				<input type="radio" name="httt" value="<?=$value['id']?>" required>
				    				<span><?=$value['ten'.$lang]?></span>
				    			</label>
				    			<div class="info-httt info-httt-<?=$value['id']?> transition"><?=str_replace("\n","<br>",$value['mota'.$lang])?></div>
			    			</div>
			    		<?php } ?>
			    	</div>
			    	<p class="title-cart"><?=_thongtingiaohang?>:</p>
			    	<div class="information-cart">
			    		<div class="input-cart">
				    		<input type="text" name="ten" placeholder="<?=_hotengiaohang?>" class="inp-cart" required>
							<input type="number" name="dienthoai" placeholder="<?=_dienthoaigiaohang?>" class="inp-cart" required>
							<input type="email" name="email" placeholder="<?=_emailgiaohang?>" class="inp-cart" required>
						</div>
						<div class="select-cart">
							<select required name="tinhthanh" onchange="load_quanhuyen(this.value);" class="sel-cart sel-tinhthanh">
								<option value=""><?=_tinhthanh?></option>
								<?php for($i=0;$i<count($tinhthanh);$i++) { ?>
									<option value="<?=$tinhthanh[$i]['id']?>"><?=$tinhthanh[$i]['ten']?></option>
								<?php } ?>
							</select>
							<select required name="quanhuyen" onchange="load_phuongxa(this.value);" class="sel-cart sel-quanhuyen">
								<option value=""><?=_quanhuyen?></option>
							</select>
							<select required name="phuongxa" onchange="load_giaship(this.value);" class="sel-cart sel-phuongxa">
								<option value=""><?=_phuongxa?></option>
							</select>
						</div>
						<textarea name="diachi" placeholder="<?=_diachigiaohang?>" required></textarea>
						<textarea name="noidung" placeholder="<?=_yeucaugiaohang?>"></textarea>
			    	</div>
		    		<input type="submit" class="thanhtoan bgcart" name="thanhtoan" value="<?=_thanhtoan?>">
			    </div>
		    </div>
		<?php } else { ?>
			<a href="" class="empty-cart">
				<i class="fa fa-cart-arrow-down"></i>
				<p><?=_khongtontaisanphamtronggiohang?></p>
				<span><?=_vetrangchu?></span>
			</a>
		<?php } ?>
	</div>
</form>