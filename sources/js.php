<!-- WOW JS -->
<script src="assets/js/wow.min.js"></script>  
<script type="text/javascript">
    $(document).ready(function(){new WOW().init();})
</script>

<!-- DDSmoothMenu -->
<script type="text/javascript" src="assets/ddsmoothmenu/ddsmoothmenu.js"></script>
<script type="text/javascript">
    ddsmoothmenu.init({mainmenuid: "smoothmenu1",orientation: 'h',classname: 'ddsmoothmenu',contentsource: "markup"})
    ddsmoothmenu.init({mainmenuid: "smoothmenu2",orientation: 'v',classname: 'ddsmoothmenu-v',contentsource: "markup"})
    ddsmoothmenu.init({mainmenuid: "smoothmenu3",orientation: 'v',classname: 'ddsmoothmenu-v',contentsource: "markup"})
</script>

<!-- Mmenu -->
<script type="text/javascript" src="assets/mmenu/jquery.mmenu.min.all.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('nav#menu').mmenu();
        $('.invi-loading').removeClass('invi-loading');
    });
</script>

<?php if($source=='index') { ?>
    <!-- Slider -->
    <script type="text/javascript" src="assets/nivoslider/js/jquery.nivo.slider.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#slider-main').nivoSlider({
                effect: 'random',
                slices: 15,
                boxCols: 8,
                boxRows: 4,
                animSpeed: 1000,
                pauseTime: 3500,
                startSlide: 0,
                directionNav: true,
                controlNav: false,
                controlNavThumbs: false,
                pauseOnHover: true,
                manualAdvance: false,
                prevText: 'Prev',
                nextText: 'Next',
                randomStart: false,
                beforeChange: function(){},
                afterChange: function(){},
                slideshowEnd: function(){},
                lastSlide: function(){},
                afterLoad: function(){}
            });
        });
    </script>

    <!-- Owl Carousel 2 -->
    <script src="assets/owlcarousel2/owl.carousel.js"></script>
    <script type="text/javascript">
        function owlproduct()
        {
            $('.owl-product-type').owlCarousel({
                items: 5,
                autoplay: true,
                loop: false,
                lazyLoad: true,
                mouseDrag: true,
                touchDrag: true,
                margin: 0,
                smartSpeed: 250,
                autoplaySpeed: 1000,
                nav: true,
                dots: false,
                responsiveClass:true,
                responsiveRefreshRate: 200,
                responsive: {
                    0: {
                        items: 1,
                        margin: 0
                    },
                    368: {
                        items: 2,
                        margin: 0
                    },
                    568: {
                        items: 3,
                        margin: 0
                    },
                    800: {
                        items: 4,
                        margin: 0
                    },
                    1000: {
                        items: 5,
                        margin: 0
                    }
                }
            })
        }
        owlproduct();
        $(document).ready(function(){
            $('.owl-product-list').owlCarousel({
                items: 2,
                autoplay: true,
                loop: false,
                lazyLoad: true,
                mouseDrag: true,
                touchDrag: true,
                margin: 30,
                smartSpeed: 250,
                autoplaySpeed: 1000,
                nav: false,
                dots: false
            })
            $('.owl-product-cat').owlCarousel({
                items: 1,
                autoplay: false,
                loop: false,
                lazyLoad: true,
                mouseDrag: true,
                touchDrag: true,
                margin: 30,
                autoWidth: true,
                smartSpeed: 250,
                autoplaySpeed: 1000,
                nav: false,
                dots: false
            })
            $('.owl-service').owlCarousel({
                items: 4,
                autoplay: true,
                loop: false,
                lazyLoad: true,
                mouseDrag: true,
                touchDrag: true,
                margin: 20,
                smartSpeed: 250,
                autoplaySpeed: 1000,
                nav: false,
                dots: false,
                responsiveClass:true,
                responsiveRefreshRate: 200,
                responsive: {
                    0: {
                        items: 1,
                        margin: 0
                    },
                    468: {
                        items: 2,
                        margin: 10
                    },
                    768: {
                        items: 3,
                        margin: 15
                    },
                    1000: {
                        items: 4,
                        margin: 20
                    }
                }
            })
            $('.owl-ttnb').owlCarousel({
                items: 2,
                autoplay: true,
                loop: false,
                lazyLoad: true,
                mouseDrag: true,
                touchDrag: true,
                margin: 16,
                smartSpeed: 250,
                autoplaySpeed: 1000,
                nav: false,
                dots: false,
                responsiveClass:true,
                responsiveRefreshRate: 200,
                responsive: {
                    0: {
                        items: 1,
                        margin: 0
                    },
                    640: {
                        items: 2,
                        margin: 16
                    }
                }
            })
        });
    </script>

    <!-- Ajax Owl Carousel 2 -->
    <script type="text/javascript">
        $(document).ready(function(){
            $(".title-product-type span.label-product").click(function(){
                if(!$(this).hasClass("active"))
                {
                    var tab = $(this).data("tab");
                    $(".title-product-type span.label-product").removeClass("active");
                    $(this).addClass("active");

                    $.ajax({
                        type: "POST",
                        url: "ajax/ajax_owlproduct.php",
                        data: {tab:tab},
                        async: false,
                        success: function(kq)
                        {
                            $(".content-product-type").html(kq);
                            owlproduct();
                        }
                    });
                }
            })
        })
    </script>

    <!-- Fotorama -->
    <script src="assets/fotorama/fotorama.js"></script>
<?php } ?>

<?php if($template=='product_detail') { ?>
    <!-- Magiczoomplus -->
    <script src="assets/magiczoomplus/magiczoomplus.js" type="text/javascript"></script>

    <!-- Easy Ressponsive Tab -->
    <script src="assets/tabs/easyResponsiveTabs.js"></script>

    <!-- Slick -->
    <script src="assets/slick/slick.js" type="text/javascript" charset="utf-8"></script>

    <!-- Fancybox 3 -->
    <script src="assets/fancybox3/jquery.fancybox.js"></script>
    <script type="text/javascript">
        function add_to_cart(id,kind)
        {
            var mau=0;
            var size=0;
            var qty=$(".qty-pro").val();

            $.ajax({
                url:'ajax/ajax_add_cart.php',
                type: "POST",
                dataType: 'json',
                data: {cmd:'addcart',id:id,mau:mau,size:size,qty:qty},
                success: function(kt){
                    if(kind=='addnow')
                    {
                        $('.count-cart').html(kt.count_cart);
                        $('a.fancy-cart').trigger('click');
                    }
                    else if(kind=='buynow')
                    {
                        window.location="<?=$config_url_http?>gio-hang.html";
                    }
                }
            });
        }
    </script>
    <a class="fancy-cart" data-fancybox data-type="ajax" data-src="ajax/ajax_popup_cart.php"></a>

    <script type="text/javascript">
        $(document).ready(function() 
        {
            /* Tabs Pro */
            $('#parentHorizontalTab').easyResponsiveTabs({
                type: 'default',
                width: 'auto',
                fit: true,
                tabidentify: 'hor_1',
                activate: function(event)
                {
                    var $tab = $(this);
                    var $info = $('#nested-tabInfo');
                    var $name = $('span', $info);
                    $name.text($tab.text());
                    $info.show();
                }
            });

            /* Thumb Pro */
            $(".slick-thumb-pro").slick({
                dots: false,
                autoplay: false,
                infinite: true,
                slidesToShow: 4,
                slidesToScroll: 1,
                swipeToSlide: true
            });

            /* Quantity */
            $(".quantity-pro-detail span").click(function(){
                var $button = $(this);
                var oldValue = $button.parent().find("input").val();
                if($button.text() == "+")
                {
                    var newVal = parseFloat(oldValue) + 1;
                }
                else
                {
                    if(oldValue > 1) var newVal = parseFloat(oldValue) - 1;
                    else var newVal = 1;
                }
                $button.parent().find("input").val(newVal);
            });
        });
    </script>
<?php } ?>

<!-- Search -->
<script type="text/javascript">
    function doEnter(evt,obj)
    {
        var key;
        if(evt.keyCode == 13 || evt.which == 13)
        {
            onSearch(obj);
        }
    }
    function onSearch(obj) 
    {           
        var keyword = $("#"+obj).val();
        var cate = $("#category").val();
        var url = "tim-kiem.html/";
        
        if(keyword=='' && cate==0)
        {
            alert('Bạn chưa nhập điều kiện tìm kiếm !');
            return false;
        }

        location.href = "tim-kiem.html/cate="+cate+"&keyword="+keyword;
        loadPage(document.location);
    }
    $(document).ready(function(){
        $(".panel-search").click(function(){
            $(".ul-search").stop(true,true).slideToggle("fast");
        })
        $(".ul-search li").click(function(){
            var txt = $(this).html();
            var id = $(this).attr("data-id");
            if(!$(".panel-search").hasClass("panel-searched"))
            {
                $(".panel-search").addClass("panel-searched");
            }
            $("#category").val(id);
            $(".panel-search span").html("<b class='text-hide'>"+txt+"</b>");
            $(".ul-search").stop(true,true).slideToggle("fast");
        })
    });
</script>

<!-- Scroll-Top -->
<div class="scrollToTop"><img src="assets/images/top.png" alt="Go Top"/></div>
<script type="text/javascript">
    $(document).ready(function() {
        $(window).scroll(function() {
            if ($(this).scrollTop() > 100) { $('.scrollToTop').fadeIn(); } 
            else { $('.scrollToTop').fadeOut(); }
        });
        $('.scrollToTop').click(function() {
            $('html, body').animate({scrollTop : 0},800);
            return false; 
        });
    })
</script>

<!-- Thêm alt cho hình ảnh -->
<script type="text/javascript">
    $(document).ready(function(e) {
        $('img').each(function(index, element) {
            if(!$(this).attr('alt') || $(this).attr('alt')=='')
            {
                $(this).attr('alt','<?=$row_setting['ten'.$lang]?>');
            }
        });
    });
</script>

<!-- Combo Phone -->
<script type="text/javascript">
    $(document).ready(function () {
        $(document).ready(function () {
            $('.support-content').hide();
            $('a.btn-support').click(function (e) {
                e.stopPropagation();
                $('.support-content').slideToggle();
            });
            $('.support-content').click(function (e) {
                e.stopPropagation();
            });
            $(document).click(function () {
                $('.support-content').slideUp();
            });
        });
    });
</script>

<!-- SDK Facebook -->
<script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id; js.async=true;
    js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.6";
    fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>

<?php if($template=='tintuc_tinh' || $template=='tintuc_detail' || $template=='product_detail') { ?>
    <!-- Like Share + Zalo Share -->
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-55e11040eb7c994c" async="async"></script>
    <style type="text/css">#at4-share{display: none !important;opacity: 0 !important;visibility: hidden !important;}</style>
    <script src="https://sp.zalo.me/plugins/sdk.js"></script>
<?php } ?>

<!-- Chat Messenger 2 -->
<script type="text/javascript">
    $(document).ready(function() {
        var t = {
            delay: 125,
            overlay: $(".fb-overlay"),
            widget: $(".fb-widget"),
            button: $(".fb-button")
        };
        setTimeout(function() {
            $("div.fb-livechat").fadeIn()
        }, 8 * t.delay);
        $(".ctrlq").on("click", function(e) {
            e.preventDefault(), t.overlay.is(":visible") ? (t.overlay.fadeOut(t.delay), t.widget.stop().animate({
                bottom: 0,
                opacity: 0
            }, 2 * t.delay, function() {
                $(this).hide("slow"), t.button.show()
            })) : t.button.fadeOut("medium", function() {
                t.widget.stop().show().animate({
                    bottom: "30px",
                    opacity: 1
                }, 2 * t.delay), t.overlay.fadeIn(t.delay)
            })
        })
    });
</script>

<?php if($source=='contact') { ?>
    <!-- Contact -->
    <script type="text/javascript">
        $(document).ready(function(e) {
            $(".open-file-contact").click(function(){
                $("#input-file-contact").trigger("click");
            })
            $("#input-file-contact").change(function(){
                $(".open-file-contact b").html($(this)[0].files[0].name);
            })
        });
    </script>
<?php } ?>

<!-- Body JS -->
<?=$row_setting['bodyjs']?>