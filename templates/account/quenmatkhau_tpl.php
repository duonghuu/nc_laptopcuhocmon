<div class="wrap-user login-user">
    <div class="title-user"><span><?=_quenmatkhau?></span></div>
    <form class="frm-user" action="account/quen-mat-khau.html" method="post" enctype="multipart/form-data">
        <div class="item-user">
            <i class="fa fa-user"></i>
            <input type="text" name="username" placeholder="<?=_taikhoan?>" required>
        </div>
        <div class="item-user">
            <i class="fa fa-envelope"></i>
            <input type="email" name="email" placeholder="Email" required>
        </div>
        <input type="submit" class="sm-user sm-login-user" name="quenmatkhau" value="<?=_laymatkhau?>">
    </form>
</div>