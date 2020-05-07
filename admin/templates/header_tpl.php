<!-- Begin Header Panel -->
<div class="headerpanel">
    <a href="" class="showmenu"></a>
    <!-- Begin Header Right -->
    <div class="headerright">        
        <!-- Begin Dropdown -->
        <div class="dropdown notification">
            <a href="../" title="Xem website" target="_blank">
               <i class="fa fa-reply" aria-hidden="true"></i> <span>Xem website</span>
            </a>
        </div>
        <!-- End Dropdown -->
        <!-- Begin Sitemap -->
        <?php /*
        <div class="dropdown notification">
            <a href="../sitemap.php" title="Cập nhật Sitemap" target="_blank">
               <i class="fa fa-sitemap" aria-hidden="true"></i> <span>Cập nhật Sitemap</span>
            </a>
        </div>
        */ ?>
        <!-- End Sitemap -->
        <!-- Begin Dropdown Notify -->
        <?php
            $count_email=0;

            $d->reset();
            $sql="select id from #_contact where hienthi=0";
            $d->query($sql);
            $contact_result=$d->result_array();

            if(count($config['email_dk'])>0)
            {
                foreach($config['email_dk'] as $key => $value) 
                {
                    $d->reset();
                    $sql="select id from #_email_dk where hienthi=0 and type='".$key."'";
                    $d->query($sql);
                    $email_result=$d->result_array();
                    $count_email+=count($email_result);
                }
            }

            if($order==true)
            {
                $d->reset();
                $sql="select id from #_donhang where tinhtrang=1";
                $d->query($sql);
                $donhang_result=$d->result_array();
            }

            if($binhluan==true)
            {
                $d->reset();
                $sql="select id from #_comment where hienthi=0 and pid=0";
                $d->query($sql);
                $comment_result=$d->result_array();
            }
        ?>
        <div class="dropdown userinfo">
            <a class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="index.php">Thông báo <b class="number-contact"><?=$count_email + count($contact_result) + count($donhang_result) + count($comment_result)?></b><b class="caret"></b></a>
            <ul class="dropdown-menu dropdown-menu-notify">
                <?php if($order==true) { ?>
                    <li><a href="index.php?com=order&act=man">Đơn hàng <b class="number-contact"><?=count($donhang_result)?></b></a></li>
                    <li class="divider"></li>
                <?php } ?>
                <?php if($binhluan==true) { ?>
                    <li><a href="index.php?com=comment&act=man">Bình luận <b class="number-contact"><?=count($comment_result)?></b></a></li>
                    <li class="divider"></li>
                <?php } ?>
                <li><a href="index.php?com=contact&act=man">Liên hệ <b class="number-contact"><?=count($contact_result)?></b></a></li>
                <?php if(count($config['email_dk'])>0) { ?>
                    <li class="divider"></li>
                    <?php foreach($config['email_dk'] as $key => $value) { 
                        $d->reset();
                        $sql="select id from #_email_dk where type='".$key."' and hienthi=0";
                        $d->query($sql);
                        $email_item_result=$d->result_array();
                        ?>
                        <li><a href="index.php?com=email_dk&act=man&type=<?=$key?>"><?=$value['title_main']?> <b class="number-contact"><?=count($email_item_result)?></b></a></li>
                        <li class="divider"></li>
                    <?php } ?>
                <?php } ?>
            </ul>
        </div>
        <!-- End Dropdown Notify -->
        <!-- Begin Dropdown Menu -->
        <div class="dropdown userinfo">
            <a class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="index.php">Xin chào, <?=($_SESSION['login']['ten'])?$_SESSION['login']['ten']:$_SESSION['login']['username']?>! <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <?php if(count($config['lang'])>=2) { if($_SESSION['login']['username']=="admin" || ($_SESSION['login']['username']=='coder' && $_SESSION['login']['password']=='487b60d660404828de12de149518232c')) { ?>
                <li><a href="index.php?com=lang&act=man"><span class="icon-eye-open"></span> Quản lý ngôn ngữ</a></li>
                <li class="divider"></li>
                <?php } } ?>
                <?php if($_SESSION['login']['username']=='coder' && $_SESSION['login']['password']=='487b60d660404828de12de149518232c') { ?>
                <li><a href="manageuser.php?type=modify&username=admin"><span class="icon-wrench"></span> Đặt lại mật khẩu admin</a></li>
                <li class="divider"></li>
                <?php } ?>
                <li><a href="index.php?com=user&act=admin_edit"><span class="fa fa-user-circle-o"></span> Thông tin tài khoản</a></li>
                <li class="divider"></li>
                <li><a href="index.php?com=user&act=logout"><span class="icon-off"></span> Đăng xuất</a></li>
            </ul>
        </div>
        <!-- End Dropdown Menu -->
    </div>
    <!-- End Header Right -->
</div>
<!-- End Header Panel -->