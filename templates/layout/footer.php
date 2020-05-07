<div class="footer">
    <div class="wrap-content">
        <div class="footer-top">
            <div class="footer-top-left">
                <p class="footer-top-left-title">MUA HÀNG (08:30 - 20:30)</p>
                <p class="footer-top-left-hotline"><?=$row_setting['hotline']?></p>
                <p class="footer-top-left-slogan">Tất cả các ngày trong tuần</p>
            </div>
            <div class="footer-top-right">
                <div class="footer-top-right-text">
                    <p class="footer-top-right-title">ĐĂNG KÝ LÀM THÀNH VIÊN CỦA LAPTOP NGUYỄN CƯỜNG ĐỂ NHẬN THÊM NHIỀU ƯU ĐÃI</p>
                    <p class="footer-top-right-slogan">Đừng bỏ lỡ các chương trình khuyến mãi</p>
                </div>
                <div class="footer-top-right-newsletter">
                    <form class="form-footer" method="post" action="" enctype="multipart/form-data">
                        <input type="email" name="email-newsletter" placeholder="Nhập email của bạn để nhận tin mới ..." required>
                        <input type="submit" class="transition" name="submit-newsletter" value="Đăng ký">
                        <input type="hidden" name="recaptcha_response_newsletter" id="recaptchaResponseNewsletter">
                    </form>
                    <ul class="mxh mxh-footer"><?php for($i=0;$i<count($mxh2);$i++) { ?><li><a href="<?=$mxh2[$i]['link']?>" target="_blank"><img class="lazy" src="assets/images/pixel.gif" data-src="<?=_upload_photo_l.$mxh2[$i]['photo']?>"></a></li><?php } ?></ul>
                </div>
            </div>
        </div>
        <div class="footer-center">
            <div class="footer-news">
                <p class="title-footer"><?=$footer['ten'.$lang]?></p>
                <div class="info-footer"><?=$footer['noidung'.$lang]?></div>
            </div>
            <div class="footer-news">
                <p class="title-footer">Bản đồ</p>
                <div class="map-footer"><?=$row_setting['toado_iframe']?></div>
            </div>
            <div class="footer-news">
                <p class="title-footer">Thống kê truy cập</p>
                <div class="thongke-footer">
                    <div class="item-tk"><span>Đang online:</span><?=$count_user_online+375?></div>
                    <!-- <div class="item-tk"><span>Trong tuần:</span><?=$week_visitors?></div> -->
                    <!-- <div class="item-tk"><span>Trong tháng:</span><?=$month_visitors?></div> -->
                    <div class="item-tk"><span>Tổng truy cập:</span><?=$all_visitors?></div>
                </div>
            </div>
        </div>
        <div class="footer-bottom"><?=$row_setting['copyright']?>. Web Design by Nina.vn</div>
    </div>
</div>
<?php if($com!='gio-hang') { ?>
    <a class="cart-fixed" href="gio-hang.html" title="Giỏ hàng">
        <i class="fa fa-shopping-bag"></i>
        <span class="count-cart"><?=count($_SESSION['cart'])?></span>
    </a>
<?php } ?>