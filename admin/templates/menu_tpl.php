<!-- Begin Logo Admin -->
<div class="logopanel">
    <h1 style="padding: 5px 10px;text-align: center;font-size: 15px;line-height: normal;display: flex;align-items: center;justify-content: center;height: 40px;"><a href="index.php" title="Dashboard" style="padding: 0px;"><?=$config_title_menu?></a></h1>
</div>
<!-- End Logo Admin -->

<!-- Begin Time Admin -->
<div class="datewidget">
    <?=date('l',time())?>, <?=date('F',time())?> <?=date('j',time())?>, <?=date('Y',time())?>
</div>
<!-- End Time Admin -->

<!-- Begin Menu Left -->
<div class="leftmenu">        
    <ul class="nav nav-tabs nav-stacked">
        <li class="nav-header">Menu</li>
        <!-- BẢNG ĐIỀU KHIỂN -->
        <li<?=($template == 'index')?' class="active"':''?>>
            <a href="index.php" title="Bảng điều khiển">
                <span class="icon-th"></span>
                Bảng điều khiển
            </a>
        </li>

        <!-- MENU: SẢN PHẨM -->
        <?php if(count($config['product'])>0) { ?>
            <?php foreach($config['product'] as $key => $value) { if($value['dropdown']==true) { ?>
                <li<?php if(isset($kiemtra)) { if(
                        check_access('product','man_list',$key) &&
                        check_access('product','man_cat',$key) &&
                        check_access('product','man_item',$key) &&
                        check_access('product','man_capbon',$key) &&
                        check_access('product','man_nhanhieu',$key) &&
                        check_access('product','man',$key) &&
                        check_access('import','capnhat',$key) &&
                        check_access('export','',$key) &&
                        check_access('order','man',$key)
                        ) echo ' class="hidden"'; } ?> class="dropdown<?=((
                        $com=='product' || 
                        $com=='import' || 
                        $com=='export' ||
                        $com=='order') && 
                        ($key==$_GET['type']))?' active':''?>">
                    <a href="" title="<?=$value['title_main']?>">
                        <span class="icon-print"></span> Quản lý <?=$value['title_main']?>
                    </a>
                    <ul<?=((
                        $com=='product' || 
                        $com=='import' || 
                        $com=='export' ||
                        $com=='order') && 
                        ($key==$_GET['type']))?' style="display: block"':''?>>
                        <?php if($value['list']=='true') { ?>
                        <li<?php if(isset($kiemtra)){ if(check_access('product','man_list',$key)) echo ' class="hidden"'; } ?>>
                            <a href="index.php?com=product&act=man_list&type=<?=$key?>">
                                Danh sách cấp 1
                            </a>
                        </li>
                        <?php } ?>
                        <?php if($value['cat']=='true') { ?>
                        <li<?php if(isset($kiemtra)){ if(check_access('product','man_cat',$key)) echo ' class="hidden"'; } ?>>
                            <a href="index.php?com=product&act=man_cat&type=<?=$key?>">
                                Danh sách cấp 2
                            </a>
                        </li>
                        <?php } ?>
                        <?php if($value['item']=='true') { ?>
                        <li<?php if(isset($kiemtra)){ if(check_access('product','man_item',$key)) echo ' class="hidden"'; } ?>>
                            <a href="index.php?com=product&act=man_item&type=<?=$key?>">
                                Danh sách cấp 3
                            </a>
                        </li>
                        <?php } ?>
                        <?php if($value['capbon']=='true') { ?>
                        <li<?php if(isset($kiemtra)){ if(check_access('product','man_capbon',$key)) echo ' class="hidden"'; } ?>>
                            <a href="index.php?com=product&act=man_capbon&type=<?=$key?>">
                                Danh sách cấp 4
                            </a>
                        </li>
                        <?php } ?>
                        <?php if($value['nhanhieu_list']=='true') { ?>
                        <li<?php if(isset($kiemtra)){ if(check_access('product','man_nhanhieu',$key)) echo ' class="hidden"'; } ?>>
                            <a href="index.php?com=product&act=man_nhanhieu&type=<?=$key?>">
                                Danh sách thương hiệu
                            </a>
                        </li>
                        <?php } ?>
                        <?php if($value['mau']=='true') { ?>
                        <li<?php if(isset($kiemtra)){ if(check_access('product','man_mau',$key)) echo ' class="hidden"'; } ?>><a href="index.php?com=product&act=man_mau&type=<?=$key?>">Danh mục màu</a></li>
                        <?php } ?>
                        <?php if($value['size']=='true') { ?>
                        <li<?php if(isset($kiemtra)){ if(check_access('product','man_size',$key)) echo ' class="hidden"'; } ?>><a href="index.php?com=product&act=man_size&type=<?=$key?>">Danh mục size</a></li>
                        <?php } ?>
                        <li<?php if(isset($kiemtra)){ if(check_access('product','man',$key)) echo ' class="hidden"'; } ?>>
                            <a href="index.php?com=product&act=man&type=<?=$key?>">
                                <?=$value['title_main']?>
                            </a>
                        </li>
                        <?php if($value['import']=='true') { ?>
                        <li<?php if(isset($kiemtra)){ if(check_access('import','capnhat',$key)) echo ' class="hidden"'; } ?>>
                            <a href="index.php?com=import&act=capnhat&type=<?=$key?>">
                                Import <?=$value['title_main']?>
                            </a>
                        </li>
                        <?php } ?>
                        <?php if($value['export']=='true') { ?>
                        <li<?php if(isset($kiemtra)){ if(check_access('export','',$key)) echo ' class="hidden"'; } ?>>
                            <a href="index.php?com=export&type=<?=$key?>">
                                Export <?=$value['title_main']?>
                            </a>
                        </li>
                        <?php } ?>
                    </ul>
                </li>
            <?php } } ?>
        <?php } ?>

        <!-- MENU: SẢN PHẨM KHÔNG CẤP -->
        <?php if($config_showpagepro>0) { ?>
            <?php foreach($config['product'] as $key => $value) { if($value['dropdown']==false) { ?>
                <li <?php if(isset($kiemtra)) { if(
                        check_access('product','man',$key)) 
                        echo ' class="hidden"'; } ?> class="dropdown<?=((
                        $com=='product' || 
                        $com=='import' || 
                        $com=='export' ||
                        $com=='order') && 
                        ($key==$_GET['type']))?' active':''?>">
                    <a href="index.php?com=product&act=man&type=<?=$key?>">
                        <span class="icon-print"></span> Quản lý <?=$value['title_main']?>
                    </a>
                    <ul<?=((
                        $com=='product' || 
                        $com=='import' || 
                        $com=='export' ||
                        $com=='order') && 
                        ($key==$_GET['type']))?' style="display: block"':''?>>
                        <?php if($value['mau']=='true') { ?>
                            <li<?php if(isset($kiemtra)){ if(check_access('product','man_mau',$key)) echo ' class="hidden"'; } ?>><a href="index.php?com=product&act=man_mau&type=<?=$key?>">Danh mục màu</a></li>
                        <?php } ?>
                        <?php if($value['size']=='true') { ?>
                        <li<?php if(isset($kiemtra)){ if(check_access('product','man_size',$key)) echo ' class="hidden"'; } ?>><a href="index.php?com=product&act=man_size&type=<?=$key?>">Danh mục size</a></li>
                        <?php } ?>
                        <li<?php if(isset($kiemtra)){ if(check_access('product','man',$key)) echo ' class="hidden"'; } ?>>
                            <a href="index.php?com=product&act=man&type=<?=$key?>">
                                <?=$value['title_main']?>
                            </a>
                        </li>
                        <?php if($value['import']=='true') { ?>
                        <li<?php if(isset($kiemtra)){ if(check_access('import','capnhat',$key)) echo ' class="hidden"'; } ?>>
                            <a href="index.php?com=import&act=capnhat&type=<?=$key?>">
                                Import <?=$value['title_main']?>
                            </a>
                        </li>
                        <?php } ?>
                        <?php if($value['export']=='true') { ?>
                        <li<?php if(isset($kiemtra)){ if(check_access('export','',$key)) echo ' class="hidden"'; } ?>>
                            <a href="index.php?com=export&type=<?=$key?>">
                                Export <?=$value['title_main']?>
                            </a>
                        </li>
                        <?php } ?>
                    </ul>
                </li>
            <?php } } ?>
        <?php } ?>

        <!-- MENU: CART -->
        <?php if($order==true) { ?>
            <li<?php if(isset($kiemtra)) { if(
                    check_access('order','man','')
                    ) echo ' class="hidden"'; } ?> class="<?=((
                    $com=='order'))?'active':''?>">
                <a href="index.php?com=order&act=man" title="Quản lý giỏ hàng">
                    <span class="icon-shopping-cart"></span> Quản lý giỏ hàng
                </a>
            </li>
        <?php } ?>           

        <!-- MENU: COUPON -->
        <?php if($coupon==true) { ?>
            <li<?php if(isset($kiemtra)) { if(
                    check_access('coupon','man','')
                    ) echo ' class="hidden"'; } ?> class="<?=((
                    $com=='coupon'))?'active':''?>">
                <a href="index.php?com=coupon&act=man" title="Quản lý mã ưu đãi">
                    <span class="icon-qrcode"></span> Quản lý mã ưu đãi
                </a>
            </li>
        <?php } ?>

        <!-- MENU: TAGS -->
        <?php if(count($config['tags_list'])>0) { ?>
            <li<?php if(isset($kiemtra)) { if(
                check_access2('tags_list','man',$config['tags_list'])
                ) echo ' class="hidden"'; } ?> class="dropdown<?php if($com=='tags_list') echo ' active'; ?>">
                <a href="" title="Quản lý tag">
                    <span class="icon-tag"></span> Quản lý tag
                </a>
                <ul<?php if($com=='tags_list') echo ' style="display: block;"'; ?>>
                    <?php foreach($config['tags_list'] as $key => $value) { ?>
                        <li<?php if(isset($kiemtra)){ if(check_access('tags_list','man',$key)) echo ' class="hidden"'; } ?>>
                            <a href="index.php?com=tags_list&act=man&type=<?=$key?>"><?=$value['title_main']?></a>
                        </li>
                    <?php } ?>
                </ul>
            </li>
        <?php } ?>

        <!-- MENU: BÌNH LUẬN -->
        <?php if($binhluan==true) { ?>
            <li<?php if(isset($kiemtra)) { if(
                    check_access('comment','man','')
                    ) echo ' class="hidden"'; } ?> class="<?=((
                    $com=='comment'))?'active':''?>">
                <a href="index.php?com=comment&act=man" title="Quản lý bình luận">
                    <span class="icon-comment"></span> Quản lý bình luận
                </a>
            </li>
        <?php } ?>

        <!-- MENU: ALBUM -->
        <?php if(count($config['album'])>0) { ?>
            <li<?php if(isset($kiemtra)) { if(
                check_access2('album','man',$config['album'])
                ) echo ' class="hidden"'; } ?> class="dropdown<?php if($com=='album') echo ' active'; ?>">
                <a href="" title="Quản lý album">
                    <span class="icon-camera"></span> Quản lý album
                </a>
                <ul<?php if($com=='album') echo ' style="display: block;"'; ?>>
                    <?php foreach($config['album'] as $key => $value) { ?>
                        <li<?php if(isset($kiemtra)){ if(check_access('album','man',$key)) echo ' class="hidden"'; } ?>>
                            <a href="index.php?com=album&act=man&type=<?=$key?>"><?=$value['title_main']?></a>
                        </li>
                    <?php } ?>
                </ul>
            </li>
        <?php } ?>

        <!-- MENU: FILE -->
        <?php if(count($config['download'])>0) { ?>
            <li<?php if(isset($kiemtra)) { if(
                check_access2('download','man',$config['download'])
                ) echo ' class="hidden"'; } ?> class="dropdown<?php if($com=='download') echo ' active'; ?>">
                <a href="" title="Quản lý file">
                    <span class="icon-file"></span> Quản lý file
                </a>
                <ul<?php if($com=='download') echo ' style="display: block;"'; ?>>
                    <?php foreach($config['download'] as $key => $value) { ?>
                        <li<?php if(isset($kiemtra)){ if(check_access('download','man',$key)) echo ' class="hidden"'; } ?>>
                            <a href="index.php?com=download&act=man&type=<?=$key?>"><?=$value['title_main']?></a>
                        </li>
                    <?php } ?>
                </ul>
            </li>
        <?php } ?>

        <!-- MENU: EMAIL -->
        <?php if(count($config['email_dk'])>0) { ?>
            <li<?php if(isset($kiemtra)) { if(
                check_access2('email_dk','man',$config['email_dk'])
                ) echo ' class="hidden"'; } ?> class="dropdown<?php if($com=='email_dk') echo ' active'; ?>">
                <a href="" title="Quản lý email">
                    <span class="icon-envelope"></span> Quản lý email
                </a>
                <ul<?php if($com=='email_dk') echo ' style="display: block;"'; ?>>
                    <?php foreach($config['email_dk'] as $key => $value) { ?>
                        <li<?php if(isset($kiemtra)){ if(check_access('email_dk','man',$key)) echo ' class="hidden"'; } ?>>
                            <a href="index.php?com=email_dk&act=man&type=<?=$key?>"><?=$value['title_main']?></a>
                        </li>
                    <?php } ?>
                </ul>
            </li>
        <?php } ?>

        <!-- MENU: LIÊN KẾT -->
        <?php if(count($config['lienket'])>0) { ?>
            <li<?php if(isset($kiemtra)) { if(
                check_access2('lienket','man',$config['lienket'])
                ) echo ' class="hidden"'; } ?> class="dropdown<?php if($com=='lienket') echo ' active'; ?>">
                <a href="" title="Quản lý liên kết">
                    <span class="icon-bell"></span> Quản lý liên kết
                </a>
                <ul<?php if($com=='lienket') echo ' style="display: block;"'; ?>>
                    <?php foreach($config['lienket'] as $key => $value) { ?>
                        <li<?php if(isset($kiemtra)){ if(check_access('lienket','man',$key)) echo ' class="hidden"'; } ?>>
                            <a href="index.php?com=lienket&act=man&type=<?=$key?>"><?=$value['title_main']?></a>
                        </li>
                    <?php } ?>
                </ul>
            </li>
        <?php } ?>

        <!-- MENU: BÀI VIẾT CÓ CẤP -->
        <?php if(count($config['news'])>0) { ?>
            <?php foreach($config['news'] as $key => $value) { if($value['dropdown']==true) { ?>
                <li<?php if(isset($kiemtra)) { if(
                    check_access('news','man_list',$key) &&
                    check_access('news','man_cat',$key) &&
                    check_access('news','man_item',$key) &&
                    check_access('news','man',$key))
                    echo ' class="hidden"'; } ?> 
                    class="dropdown<?=(($com=='news') && ($key==$_GET['type']))?' active':''?>">
                    <a href="" title="Quản lý <?=$value['title_main']?>">
                        <span class="icon-list"></span> Quản lý <?=$value['title_main']?>
                    </a>
                    <ul<?=(($com=='news') && ($key==$_GET['type']))?' style="display: block"':''?>>
                        <?php if($value['list']=='true') { ?>                        
                            <li<?php if(isset($kiemtra)){ if(check_access('news','man_list',$key)) echo ' class="hidden"'; } ?>><a href="index.php?com=news&act=man_list&type=<?=$key?>">Danh mục cấp 1</a></li>
                        <?php } ?>
                        <?php if($value['cat']=='true') { ?>
                            <li<?php if(isset($kiemtra)){ if(check_access('news','man_cat',$key)) echo ' class="hidden"'; } ?>><a href="index.php?com=news&act=man_cat&type=<?=$key?>">Danh mục cấp 2</a></li>
                        <?php } ?>
                        <?php if($value['item']=='true') { ?>
                            <li<?php if(isset($kiemtra)){ if(check_access('news','man_item',$key)) echo ' class="hidden"'; } ?>><a href="index.php?com=news&act=man_item&type=<?=$key?>">Danh mục cấp 3</a></li>
                        <?php } ?>
                        <li<?php if(isset($kiemtra)){ if(check_access('news','man',$key)) echo ' class="hidden"'; } ?>><a href="index.php?com=news&act=man&type=<?=$key?>"><?=$value['title_main']?></a></li>
                    </ul>
                </li>
            <?php } } ?>
        <?php } ?>

        <!-- MENU: BÀI VIẾT KHÔNG CẤP -->
        <?php if($config_showpagenews>0) { ?>
            <li<?php if(isset($kiemtra)) { if(
                check_access2('news','man',$config['news'])
                ) echo ' class="hidden"'; } ?> class="dropdown<?php if(
                $com=='news' && $config['news'][$_GET['type']]['dropdown']==false
                ) echo ' active'; ?>">
                <a href="" title="Quản lý bài viết">
                    <span class="icon-pencil"></span> Quản lý bài viết
                </a>
                <ul<?php if(
                    $com=='news' && $config['news'][$_GET['type']]['dropdown']==false
                    ) echo ' style="display: block;"'; ?>>
                    <?php foreach($config['news'] as $key => $value) { if($value['dropdown']==false) { ?>
                        <li<?php if(isset($kiemtra)){ if(check_access('news','man',$key)) echo ' class="hidden"'; } ?>>
                            <a href="index.php?com=news&act=man&type=<?=$key?>"><?=$value['title_main']?></a>
                        </li>
                    <?php } } ?>
                </ul>
            </li>
        <?php } ?>

        <!-- MENU: TRANG TĨNH -->
        <?php if(count($config['news_static'])>0) { ?>
            <li<?php if(isset($kiemtra)) { if(
                check_access2('news_static','capnhat',$config['news_static'])
                ) echo ' class="hidden"'; } ?> class="dropdown<?php if($com=='news_static') echo ' active'; ?>">
                <a href="" title="Quản lý trang tĩnh">
                    <span class="icon-bookmark"></span> Quản lý trang tĩnh
                </a>
                <ul<?php if($com=='news_static') echo ' style="display: block;"'; ?>>
                    <?php foreach($config['news_static'] as $key => $value) { ?>
                        <li<?php if(isset($kiemtra)){ if(check_access('news_static','capnhat',$key)) echo ' class="hidden"'; } ?>>
                            <a href="index.php?com=news_static&act=capnhat&type=<?=$key?>"><?=$value['title_main']?></a>
                        </li>
                    <?php } ?>
                </ul>
            </li>
        <?php } ?>

        <!-- MENU: HÌNH ẢNH - VIDEO -->
        <?php if(count($config['photo'])>0) { ?>
            <li<?php if(isset($kiemtra)) { if(
                    check_access2('photo','photo_background',$config['photo']['photo_background']) &&
                    check_access2('photo','photo_static',$config['photo']['photo_static']) &&
                    check_access2('photo','man_photo',$config['photo']['man_photo'])
                    ) echo ' class="hidden"'; } ?> class="dropdown<?php if($com=='photo') echo ' active'; ?>">
                <a href="" title="Quản lý hình ảnh">
                    <span class="icon-picture"></span> Quản lý hình ảnh - video
                </a>
                <ul<?php if($com=='photo') echo ' style="display: block;"'; ?>>
                    <?php if(count($config['photo']['photo_background'])>0) { ?>
                        <?php foreach($config['photo']['photo_background'] as $key => $value) { ?>
                            <li<?php if(isset($kiemtra)){ if(check_access('photo','photo_background',$key)) echo ' class="hidden"'; } ?>>
                                <a href="index.php?com=photo&act=photo_background&type=<?=$key?>"><?=$value['title_main']?></a>
                            </li>
                        <?php } ?>
                    <?php } ?>

                    <?php if(count($config['photo']['photo_static'])>0) { ?>
                        <?php foreach($config['photo']['photo_static'] as $key => $value) { ?>
                            <li<?php if(isset($kiemtra)){ if(check_access('photo','photo_static',$key)) echo ' class="hidden"'; } ?>>
                                <a href="index.php?com=photo&act=photo_static&type=<?=$key?>"><?=$value['title_main']?></a>
                            </li>
                        <?php } ?>
                    <?php } ?>
                    
                    <?php if(count($config['photo']['man_photo'])>0) { ?>
                        <?php foreach($config['photo']['man_photo'] as $key => $value) { ?>
                            <li<?php if(isset($kiemtra)){ if(check_access('photo','man_photo',$key)) echo ' class="hidden"'; } ?>>
                                <a href="index.php?com=photo&act=man_photo&type=<?=$key?>"><?=$value['title_main_photo']?></a>
                            </li>
                        <?php } ?>
                    <?php } ?>
                </ul>
            </li>   
        <?php } ?>

        <!-- MENU: BẢN ĐỒ -->
        <?php if(count($config['map'])>0) { ?>
            <li<?php if(isset($kiemtra)) { if(
                    check_access('map','man','')
                    ) echo ' class="hidden"'; } ?> class="<?=((
                    $com=='map'))?'active':''?>">
                <a href="index.php?com=map&act=man" title="Bản đồ">
                    <span class="icon-globe"></span> Quản lý Bản đồ
                </a>
            </li>
        <?php } ?>

        <!-- MENU: TỈNH THÀNH - QUẬN HUYỆN - CHI NHÁNH -->
        <?php if(count($config['tinhthanh_quanhuyen'])>0) { ?>
            <li<?php if(isset($kiemtra)) { if(
                    check_access('tinhthanh_quanhuyen','man_list','') &&
                    check_access('tinhthanh_quanhuyen','man_cat','') &&
                    check_access('tinhthanh_quanhuyen','man_item','') &&
                    check_access('tinhthanh_quanhuyen','man','')
                    ) echo ' class="hidden"'; } ?> class="dropdown<?=((
                    $com=='tinhthanh_quanhuyen'))?' active':''?>">
                <a href="" title="Quản lý <?=$config['tinhthanh_quanhuyen']['title_main']?>">
                    <span class="icon-map-marker"></span> Quản lý <?=$config['tinhthanh_quanhuyen']['title_main']?>
                </a>
                <ul<?=(($com=='tinhthanh_quanhuyen'))?' style="display: block"':''?>>
                    <?php if($config['tinhthanh_quanhuyen']['list']==true) { ?>
                        <li<?php if(isset($kiemtra)){ if(check_access('tinhthanh_quanhuyen','man_list','')) echo ' class="hidden"'; } ?>>
                            <a href="index.php?com=tinhthanh_quanhuyen&act=man_list">Tỉnh thành</a>
                        </li>
                    <?php } ?>
                    <?php if($config['tinhthanh_quanhuyen']['cat']==true) { ?>
                        <li<?php if(isset($kiemtra)){ if(check_access('tinhthanh_quanhuyen','man_cat','')) echo ' class="hidden"'; } ?>>
                            <a href="index.php?com=tinhthanh_quanhuyen&act=man_cat">Quận huyện</a>
                        </li>
                    <?php } ?>
                    <?php if($config['tinhthanh_quanhuyen']['item']==true) { ?>
                        <li<?php if(isset($kiemtra)){ if(check_access('tinhthanh_quanhuyen','man_item','')) echo ' class="hidden"'; } ?>>
                            <a href="index.php?com=tinhthanh_quanhuyen&act=man_item">Phường xã</a>
                        </li>
                    <?php } ?>
                    <?php if($config['tinhthanh_quanhuyen']['man']==true) { ?>
                        <li<?php if(isset($kiemtra)){ if(check_access('tinhthanh_quanhuyen','man','')) echo ' class="hidden"'; } ?>>
                            <a href="index.php?com=tinhthanh_quanhuyen&act=man">Chi nhánh</a>
                        </li>
                    <?php } ?>
                </ul>
            </li>
        <?php } ?> 

        <!-- MENU: HỔ TRỢ TRỰC TUYẾN -->
        <?php if(count($config['yahoo'])>0) { ?>
            <li<?php if(isset($kiemtra)) { if(
                    check_access('yahoo','man','')
                    ) echo ' class="hidden"'; } ?> class="<?=((
                    $com=='yahoo'))?'active':''?>">
                <a href="index.php?com=yahoo&act=man" title="Hỗ trợ trực tuyến">
                    <span class="icon-globe"></span> Hỗ trợ trực tuyến
                </a>
            </li>
        <?php } ?>        

        <!-- MENU: USER -->
        <?php if($config_user==true) { ?>
            <?php if(!check_access3()) { ?>
                <li class="dropdown<?=($com=='user')?' active':''?>">
                    <a href="" title="User"><span class="icon-user"></span> Quản lý User</a>
                    <ul<?=($com=='user')?' style="display: block"':''?>>
                        <?php if($config_user_admin==true) { ?>
                            <li><a href="index.php?com=user&act=man_admin">Tài khoản admin</a></li>
                        <?php } ?>
                        <?php if($config_user_khach==true) { ?>
                            <li><a href="index.php?com=user&act=man">Tài khoản người dùng</a></li>
                        <?php } ?>
                    </ul>
                </li>
            <?php } ?>
        <?php } ?>

        <!-- MENU: Thông báo đẩy tin -->
        <?php if($thongbaoday==true) { ?>
            <li<?php if(isset($kiemtra)) { if(
                    check_access('pushOnesignal','man','')
                    ) echo ' class="hidden"'; } ?> class="<?=((
                    $com=='pushOnesignal'))?'active':''?>">
                <a href="index.php?com=pushOnesignal&act=man" title="Quản lý thông báo đẩy">
                    <span class="icon-flag"></span> Quản lý thông báo đẩy
                </a>
            </li>
        <?php } ?>

        <!-- MENU: Thiết lập thông tin -->
        <li<?php if(isset($kiemtra)) { if(
                check_access('setting','capnhat','')
                ) echo ' class="hidden"'; } ?> class="<?=((
                $com=='setting'))?'active':''?>">
            <a href="index.php?com=setting&act=capnhat" title="Thiết lập thông tin">
                <span class="icon-asterisk"></span> Thiết lập thông tin
            </a>
        </li>
    </ul>
</div>
<!-- End Menu Left -->