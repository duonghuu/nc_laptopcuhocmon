<div class="wrap-user login-user">
    <div class="title-user"><span><?=_kichhoat?></span></div>
    <form class="frm-user" action="account/kich-hoat.html/id=<?=$_GET['id']?>" method="post" enctype="multipart/form-data">
        <div class="item-user">
            <i class="fa fa-qrcode"></i>
            <input type="text" name="maxacnhan" placeholder="<?=_nhapmakichhoat?>" required>
        </div>
        <input type="submit" class="sm-user sm-signup-user" name="kichhoat" value="<?=_kichhoat?>">
    </form>
</div>