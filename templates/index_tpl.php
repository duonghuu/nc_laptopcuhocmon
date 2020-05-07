<!-- Ajax Paging Product List -->
<script type="text/javascript">
    $(document).ready(function(){
        $(".name-product-cat").click(function(){
            var idlist = $(this).attr("data-idlist");
            var idcat = $(this).attr("data-idcat");
            var idcatold = $(this).attr("data-idcatold");

            if(idcat != idcatold)
            {
                $(".name-product-list-"+idlist+".name-product-cat").removeClass("active");
                $(".name-product-list-"+idlist+".name-product-cat-"+idcat).addClass("active");
                $(".name-product-list-"+idlist).attr("data-idcatold",idcat);
                $(".load-page-product-"+idcatold).addClass("load-page-product-"+idcat);
                $(".load-page-product-"+idcatold).removeClass("load-page-product-"+idcatold);
                $(".load-page-product-"+idcat).attr("data-rel",idcat);
                LoadProductList(1,".load-page-product-"+idcat,"product",idcat,15,".wrap-product-list-"+idlist);
            }
        })
    });
    function LoadProductList(page,id_tab,tab,idcat,per_page,scroll_page)
    {
        $.ajax({
            type: "POST",
            url: "ajax/ajax_paging.php",
            data: {page:page,idcat:idcat,per_page:per_page},
            success: function(msg)
            {
                $(id_tab).html(msg);
                $(id_tab+" .pagination-ajax li.active").click(function(){
                    var vitri=$(scroll_page).offset().top;
                    $("html, body").animate({ scrollTop: (vitri) }, 800);
                    var pager = $(this).attr("p");
                    var idcatr = $(this).parents().parents().parents().attr("data-rel");
                    LoadProductList(pager,".load-page-"+tab+"-"+idcatr,tab,idcatr,per_page,scroll_page);
                });
            }
        });
    }
</script>

<div class="wrap-product-type">
	<div class="wrap-content">
		<div class="title-product title-product-type">
			<span class="label-product active" data-tab="moi">Sản phẩm mới</span>
			<span class="label-product" data-tab="banchay">Sản phẩm bán chạy</span>
			<a class="view-product" href="san-pham.html"><b>Xem tất cả <?=count($proall)?> SP</b></a>
		</div>
		<div class="content-product-type">
			<div class="owl-carousel owl-theme owl-product-type">
				<?php for($i=0;$i<count($prom);$i++) { ?>
					<div>
						<a class="sp" href="san-pham/<?=$prom[$i]['tenkhongdau']?>-<?=$prom[$i]['id']?>.html" title="<?=$prom[$i]['ten'.$lang]?>">
							<div class="info-sp">
								<div class="pic-sp scale-img">
									<img src="270x205x2/100/100/0/0/product/<?=_upload_product_l.$prom[$i]['photo']?>" alt="<?=$prom[$i]['ten'.$lang]?>"/>
									<div class="desc-sp scroll-maded transition"><?=str_replace("\n","<br>",$prom[$i]['mota'.$lang])?></div>
								</div>
								<h3 class="name-sp transition"><?=$prom[$i]['ten'.$lang]?></h3>
							</div>
							<div class="price-sp">
								<?php if($prom[$i]['giagiam']) { ?>
									<p class="price-old-sp"><?=number_format($prom[$i]['gia'],0, ',', '.')?><b>đ</b></p>
									<p class="price-new-sp"><?=number_format($prom[$i]['giagiam'],0, ',', '.')?><b>đ</b></p>
								<?php } else { ?>
									<p class="price-new-sp"><?=($prom[$i]['gia'])?number_format($prom[$i]['gia'],0, ',', '.')."<b>đ</b>":_lienhe?></p>
								<?php } ?>
							</div>
						</a>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>

<?php foreach($splistnb as $keylist => $valuelist) {
	$idlist = $valuelist['id'];
	$spcat = get_result_array("SELECT ten$lang, tenkhongdau, id FROM table_product_cat WHERE hienthi>0 AND id_list=$idlist AND type='san-pham' AND type='san-pham' ORDER BY stt,id DESC");
	$splistphoto = get_result_array("SELECT photo FROM table_product_hinhanh WHERE hienthi>0 AND id_photo=$idlist AND type='san-pham' AND kind='man_list' AND val='san-pham' ORDER BY stt,id DESC");
	$spnb = get_result_array("SELECT id FROM table_product WHERE hienthi>0 AND id_list=$idlist AND type='san-pham' AND type='san-pham'"); if(count($spnb)) { ?>
	<div class="wrap-product-list wrap-product-list-<?=$idlist?> wrap-content">
		<?php if(count($splistphoto)) { ?>
			<div class="owl-carousel owl-theme owl-product-list">
				<?php foreach($splistphoto as $keyphoto => $valuephoto) { ?>
					<div><a href="san-pham/<?=$valuelist['tenkhongdau']?>-<?=$idlist?>/" title="<?=$valuelist['ten'.$lang]?>"><img src="<?=_upload_product_l?>585x200x1/<?=$valuephoto['photo']?>" alt="<?=$valuelist['ten'.$lang]?>"/></a></div>
				<?php } ?>
			</div>
		<?php } ?>
		<div class="box-product-list">
			<div class="title-product title-product-list">
				<span class="label-product"><?=$valuelist['ten'.$lang]?></span>
				<?php if(count($spcat)) { ?>
					<div class="box-product-cat">
						<div class="owl-carousel owl-theme owl-product-cat">
							<?php foreach($spcat as $keycat => $valuecat) { ?>
								<div><h3 class="name-product-cat name-product-list-<?=$idlist?> name-product-cat-<?=$valuecat['id']?> <?=($keycat==0)?'active':''?> transition" data-idlist="<?=$idlist?>" data-idcat="<?=$valuecat['id']?>" data-idcatold="<?=$spcat[0]['id']?>"><?=$valuecat['ten'.$lang]?></h3></div>
							<?php } ?>
						</div>
					</div>
				<?php } ?>
				<a class="view-product" href="san-pham/<?=$valuelist['tenkhongdau']?>-<?=$idlist?>/"><b>Xem tất cả <?=count($spnb)?> SP</b></a>
			</div>
			<div class="load-page-product-<?=$spcat[0]['id']?> w-clear" data-rel="<?=$spcat[0]['id']?>"></div>
            <script type="text/javascript">
                LoadProductList(1,".load-page-product-<?=$spcat[0]['id']?>","product",<?=$spcat[0]['id']?>,15,".wrap-product-list-<?=$idlist?>");
            </script>
		</div>
	</div>
<?php } } ?>

<div class="wrap-service">
	<div class="wrap-content">
		<div class="title-main">
			<span>Dịch vụ của laptop nguyễn cường</span>
			<p><?=$slogandv['ten'.$lang]?></p>
		</div>
		<div class="owl-carousel owl-theme owl-service">
			<?php for($i=0;$i<count($dvnb);$i++) { ?>
				<div>
					<a class="service" href="dich-vu/<?=$dvnb[$i]['tenkhongdau']?>-<?=$dvnb[$i]['id']?>.html" title="<?=$dvnb[$i]['ten'.$lang]?>">
						<p class="pic-service scale-img"><img src="<?=_upload_news_l?>270x205x1/<?=$dvnb[$i]['photo']?>" alt="<?=$dvnb[$i]['ten'.$lang]?>"/></p>
						<h3 class="name-service"><?=$dvnb[$i]['ten'.$lang]?></h3>
						<p class="desc-service text-hide"><?=$dvnb[$i]['mota'.$lang]?></p>
					</a>
				</div>
			<?php } ?>
		</div>
	</div>
</div>

<div class="wrap-intro">
	<div class="wrap-content">
		<div class="title-main">
			<span>Tin tức và video clip</span>
			<p><?=$sloganintro['ten'.$lang]?></p>
		</div>
		<div class="box-intro">
			<div class="left-intro">
				<div class="owl-carousel owl-theme owl-ttnb">
					<div>
						<?php for($i=0;$i<count($ttnb);$i++) { ?>
							<a class="ttnb scale-img" href="tin-tuc/<?=$ttnb[$i]['tenkhongdau']?>-<?=$ttnb[$i]['id']?>.html" title="<?=$ttnb[$i]['ten'.$lang]?>">
								<img class="lazy" src="assets/images/pixel.gif" data-src="<?=_upload_news_l?>355x220x1/<?=$ttnb[$i]['photo']?>" alt="<?=$ttnb[$i]['ten'.$lang]?>"/>
								<div class="info-ttnb">
									<p class="time-ttnb">
										<span>ADMIN</span>
										<b><?=date("F",$ttnb[$i]['ngaytao'])." ".date("d",$ttnb[$i]['ngaytao']).", ".date("Y",$ttnb[$i]['ngaytao'])?></b>
									</p>
									<h3 class="name-ttnb text-hide"><?=$ttnb[$i]['ten'.$lang]?></h3>
								</div>
							</a>
							<?php if((($i+1)%2==0) && ($i+1)<count($ttnb)) { ?></div><div><?php } ?>
						<?php } ?>
					</div>
				</div>
			</div>
			<div class="right-intro">
				<div class="fotorama" data-width="100%" data-thumbmargin="10" data-height="362" data-fit="cover" data-thumbwidth="105" data-thumbheight="85" data-allowfullscreen="true" data-nav="thumbs">
	                <?php for($i=0;$i<count($videohome);$i++) { ?>
	                    <a href="http://youtube.com/watch?v=<?=getYoutubeIdFromUrl($videohome[$i]['link_video'])?>" title="<?=$videohome[$i]['ten'.$lang]?>"></a>
	                <?php } ?>
	            </div>
			</div>
		</div>
	</div>
</div>