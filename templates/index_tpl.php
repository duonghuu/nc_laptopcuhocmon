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
			<?php /* 
      <a class="view-product" href="san-pham.html"><b>Xem tất cả <?=count($proall)?> SP</b></a> 
      */?>
		</div>
		<div class="content-product-type">
      <div class="spnoibat-main">
        <?php for($i=0;$i<count($prom);$i++) { 
          showProduct($prom[$i],["slick"=>true]);
        } ?>
      </div>
			<?php /* 
      <div class="owl-carousel owl-theme owl-product-type">
              <?php for($i=0;$i<count($prom);$i++) { ?>
                <div>
                  <div class="pr-box">
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
                </div>
              <?php } ?>
            </div> 
      */?>
		</div>
	</div>
</div>
<?php /* 
<?php foreach($splistnb as $keylist => $valuelist) { ?>
<div class="spnoibat">
  <div class="wrap-content">
    <div class="idx-tit">
      <h4><a href=""></a></h4>
    </div>
    <!-- Tab links -->
    <div class="tab">
      <button class="tablinks" onclick="openCity(event, 'London')">London</button>
      <button class="tablinks" onclick="openCity(event, 'Paris')">Paris</button>
      <button class="tablinks" onclick="openCity(event, 'Tokyo')">Tokyo</button>
    </div>

    <!-- Tab content -->
    <div id="London" class="tabcontent">
      <h3>London</h3>
      <p>London is the capital city of England.</p>
    </div>

    <div id="Paris" class="tabcontent">
      <h3>Paris</h3>
      <p>Paris is the capital of France.</p>
    </div>

    <div id="Tokyo" class="tabcontent">
      <h3>Tokyo</h3>
      <p>Tokyo is the capital of Japan.</p>
    </div>
  </div>
</div>
<?php } ?> 
*/?>

<?php foreach($splistnb as $keylist => $valuelist) {
  $idlist = $valuelist['id'];
  $spcat = get_result_array("SELECT ten$lang, tenkhongdau, id FROM table_product_cat WHERE 
    hienthi>0 AND id_list=$idlist AND type='san-pham' ORDER BY stt,id DESC");
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
      <div class="idx-tit">
        <h4><span><?=$valuelist['ten'.$lang]?></span></h4>
      </div>
      <div class="title-product title-product-list">
        <?php /* 
        <span class="label-product"><?=$valuelist['ten'.$lang]?></span> 
        */?>
       
        <?php if(count($spcat)) { ?>
          <div class="box-product-cat">
            <div class="my-product-cat">
                          <?php foreach($spcat as $keycat => $valuecat) { ?>
                            <h3 class="name-product-cat name-product-list-<?=$idlist?> 
                            name-product-cat-<?=$valuecat['id']?> <?=($keycat==0)?'active':''?> transition" 
                            data-idlist="<?=$idlist?>" data-idcat="<?=$valuecat['id']?>" 
                            data-idcatold="<?=$spcat[0]['id']?>"><?=$valuecat['ten'.$lang]?></h3>
                          <?php } ?>
                        </div>
            <?php /* 
            <div class="owl-carousel owl-theme owl-product-cat">
                          <?php foreach($spcat as $keycat => $valuecat) { ?>
                            <div><h3 class="name-product-cat name-product-list-<?=$idlist?> name-product-cat-<?=$valuecat['id']?> <?=($keycat==0)?'active':''?> transition" data-idlist="<?=$idlist?>" data-idcat="<?=$valuecat['id']?>" data-idcatold="<?=$spcat[0]['id']?>"><?=$valuecat['ten'.$lang]?></h3></div>
                          <?php } ?>
                        </div> 
            */?>
          </div>
        <?php } ?>
        <?php /* 
        <a class="view-product" href="san-pham/<?=$valuelist['tenkhongdau']?>-<?=$idlist?>/"><b>Xem tất cả <?=count($spnb)?> SP</b></a> 
        */?>
      </div>
      <div class="load-page-product-<?=$spcat[0]['id']?> w-clear" data-rel="<?=$spcat[0]['id']?>"></div>
            <script type="text/javascript">
                LoadProductList(1,".load-page-product-<?=$spcat[0]['id']?>","product",<?=$spcat[0]['id']?>,15,".wrap-product-list-<?=$idlist?>");
            </script>
    </div>
  </div>
<?php } } ?> 
<?php /* 
*/?>

<div class="wrap-service">
	<div class="wrap-content">
		<?php /* 
    <div class="title-main">
          <span>Dịch vụ của laptop nguyễn cường</span>
          <p><?=$slogandv['ten'.$lang]?></p>
        </div> 
    */?>
    <div class="idx-tit"><h4><span>Dịch vụ của laptop nguyễn cường</span></h4></div>
    <div class="dichvu-main">
      <?php foreach($dvnb as $k=>$value) { ?>
    <div class="dichvu-item"><a href="dich-vu/<?=$value['tenkhongdau']?>-<?=$value['id']?>.html">
        <figure><img src="<?=_upload_news_l?>270x205x1/<?=$value['photo']?>" alt="<?=$value["ten$lang"]?>"></figure>
        <div class="dichvu-item__info">
          <h5><?=$value["ten$lang"]?></h5>
          <div class="dichvu-item__desc"><?=catchuoi($value["mota$lang"],100)?></div>
        </div>
      </a></div>
      <?php } ?>
    </div>
		<?php /* 
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
    */?>
	</div>
</div>
<div class="formdathang">
	<div class="wrap-content">
    <div class="idx-tit"><h4><span>Liên Hệ Đặt Hàng</span></h4></div>
    <form action="" method="post">
      <div class="formdathang__top">
        <div class="formdathang__top-left">
          <div class="form-group">
            <input type="text" name="" placeholder="Họ &amp; tên">
            <input type="text" name="" placeholder="Điện thoại">
          </div>
          <div class="form-group">
            <input type="text" name="" placeholder="Email">
            <input type="text" name="" placeholder="Địa chỉ">
          </div>
        </div>
        <div class="form-group formdathang__top-right">
          <textarea name="" placeholder="Nội dung" ></textarea>
        </div>
      </div>
      <div class="formdathang__bot">
        <button type="submit">Đăng ký ngay</button>
      </div>
    </form>
  </div>
</div>
<div class="wrap-intro">
  <div class="wrap-content">
		<?php /* 
    <div class="title-main">
          <span>Tin tức và video clip</span>
          <p><?=$sloganintro['ten'.$lang]?></p>
        </div> 
    */?>
		<div class="box-intro">
			<div class="left-intro">
        <div class="title">Tin tức</div>
        <div class="ttnb">
          
        <?php if($ttnb){ ?>
        <div class="first-news">
          <a href="tin-tuc/<?=$ttnb[0]['tenkhongdau']?>-<?=$ttnb[0]['id']?>.html">
            <figure><img src="<?=_upload_news_l.$ttnb[0]['photo']?>" 
              alt="<?=$ttnb[0]['ten'.$lang]?>"></figure>
            <h5><?=$ttnb[0]['ten'.$lang]?></h5>
            <div class="desc">
              <?=catchuoi($ttnb[0]['mota'.$lang], 50)?>Có rất nhiều biến thể của Lorem Ipsum mà bạn có thể tìm thấy...
            </div>
          </a>
        </div>
        <div class="tinnb-main">
          <?php foreach($ttnb as $k=>$v) { ?>
          <div class="tinnb-item">
            <a href="tin-tuc/<?=$v['tenkhongdau']?>-<?=$v['id']?>.html">
              <figure><img src="<?=_upload_news_l.$v['photo']?>" alt="<?= $v['ten'.$lang] ?>"></figure>
              <div class="info">
                <h5 title="<?= $v['ten'.$lang] ?>"><?= catchuoi($v['ten'.$lang],50) ?></h5>
                <div class="desc"><?= catchuoi($v['mota'.$lang],50) ?>Có rất nhiều biến thể của Lorem Ipsum mà bạn có thể tìm thấy...</div>
              </div>
            </a>
          </div>
          <?php } ?>
        </div>
        <?php } ?>
        </div>
				<?php /* 
        <div class="owl-carousel owl-theme owl-ttnb">
                  <div>
                    <?php for($i=0;$i<count($ttnb);$i++) { ?>
                      <a class="ttnb scale-img" href="tin-tuc/<?=$ttnb[$i]['tenkhongdau']?>-<?=$ttnb[$i]['id']?>.html" 
                      title="<?=$ttnb[$i]['ten'.$lang]?>">
                        <img class="lazy" src="assets/images/pixel.gif" 
                        data-src="<?=_upload_news_l?>355x220x1/<?=$ttnb[$i]['photo']?>" alt="<?=$ttnb[$i]['ten'.$lang]?>"/>
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
        */?>
			</div>
			<div class="right-intro">
        <div class="title">Video clip</div>
        <div id="video-idx">
          <iframe id="iframe" src="//www.youtube.com/embed/<?= getYoutubeIdFromUrl($videohome[0]["link_video"]) ?>" frameborder="0" allowfullscreen></iframe>
        </div>
        <select class="form-control" id="lstvideo" name="lstvideo">
          <option value="">Video ...</option>
          <?php foreach($videohome as $k=>$v) { ?>
          <option value="<?= getYoutubeIdFromUrl($v["link_video"]) ?>">
            <?= (!empty($v["ten$lang"]))?$v["ten$lang"]:'Video '.($k+1) ?>
              
            </option>
          <?php } ?>
        </select>
				<?php /* 
        <div class="fotorama" data-width="100%" data-thumbmargin="10" data-height="362" data-fit="cover" 
        data-thumbwidth="105" data-thumbheight="85" data-allowfullscreen="true" data-nav="thumbs">
                          <?php for($i=0;$i<count($videohome);$i++) { ?>
                              <a href="http://youtube.com/watch?v=<?=getYoutubeIdFromUrl($videohome[$i]['link_video'])?>" 
                              title="<?=$videohome[$i]['ten'.$lang]?>"></a>
                          <?php } ?>
                      </div> 
        */?>
			</div>
		</div>
	</div>
</div>