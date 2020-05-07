<?php 
    $css_cache_file = '../nina@#cache/cssoptimized.css';
    $css_path = '';
    $css_files = array
    (
        "css/animate.min.css",
        "css/font-awesome-4.7.0/css/font-awesome.min.css",
        "ddsmoothmenu/ddsmoothmenu.css",
        // "ddsmoothmenu/ddsmoothmenu-v.css",
        "mmenu/jquery.mmenu.all.css",
        "mmenu/style_mmenu.css",
        // "comment/comment.css",
        "fancybox3/jquery.fancybox.css",
        "fancybox3/jquery.fancybox.style.css",
        // "login/login.css",
        "css/cart.css",
        // "photobox/photobox.css",
        "slick/slick.css",
        "slick/slick-theme.css",
        "slick/slick-style.css",
        // "simplyscroll/jquery.simplyscroll.css",
        // "simplyscroll/jquery.simplyscroll-style.css",
        "nivoslider/themes/default/default.css",
        "nivoslider/css/nivo-slider.css",
        "fotorama/fotorama.css",
        "fotorama/fotorama-style.css",
        // "css/map.css",
        // "unitegallery/css/unite-gallery.css",
        "magiczoomplus/magiczoomplus.css",
        "magiczoomplus/magiczoomplus-style.css",
        "tabs/easy-responsive-tabs.css",
        "tabs/easy-responsive-tabs-style.css",
        // "phone/css/widget.css",
        // "phone/css/widget-style.css",
        // "messenger/messenger.css",
        "messenger/messenger2.css",
        // "datepicker/jquery-ui.css",
        "owlcarousel2/owl.carousel.css",
        "owlcarousel2/owl.theme.default.css",
        "css/style.css"
    );

    function update() 
    {
        global $css_path, $css_cache_file, $css_files;
        if (file_exists($css_cache_file)) {
            $cache_time = filemtime($css_cache_file);
            foreach ($css_files as $file) {
                if (file_exists($css_path.$file)) {
                    $time = filemtime($css_path.$file);
                    if ($time > $cache_time) {
                        return joinCSSFiles();
                        break;
                    }
                }
            }
        } else {
            return joinCSSFiles();
        }
        return file_get_contents($css_cache_file);
    }

    function compressCSS($file) 
    {
        $filedata = file_get_contents($file);
        $filedata = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $filedata);
        $filedata = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $filedata);
        $filedata = str_replace('{ ', '{', $filedata);
        $filedata = str_replace(' }', '}', $filedata);
        $filedata = str_replace('; ', ';', $filedata);
        $filedata = str_replace(', ', ',', $filedata);
        $filedata = str_replace(' {', '{', $filedata);
        $filedata = str_replace('} ', '}', $filedata);
        $filedata = str_replace(': ', ':', $filedata);
        $filedata = str_replace(' ,', ',', $filedata);
        $filedata = str_replace(' ;', ';', $filedata);  
        return $filedata;
    }

    function joinCSSFiles() 
    {
        global $css_cache_file, $css_files, $css_path;
        $data = '';
        foreach ($css_files as $file) {
            if (file_exists($css_path.$file)) {
                $data .= compressCSS($css_path.$file);
            }
        }
        file_put_contents($css_cache_file, $data);
        return $data;
    }

    // ob_start ("ob_gzhandler");
    // ob_start("compress");
    header("Content-type: text/css;charset: UTF-8");
    echo update();
?>