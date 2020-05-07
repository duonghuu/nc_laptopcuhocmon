<div class="wrap-user login-user">
    <div class="title-user">
        <span><?=_dangnhap?></span>
        <a href="account/quen-mat-khau.html" title="<?=_quenmatkhau?>"><?=_quenmatkhau?></a>
    </div>
    <form class="frm-user" action="account/dang-nhap.html" method="post" enctype="multipart/form-data">
        <div class="item-user">
            <i class="fa fa-user"></i>
            <input type="text" name="username" placeholder="<?=_taikhoan?>" required>
        </div>
        <div class="item-user">
            <i class="fa fa-lock"></i>
            <input type="password" name="password" placeholder="<?=_matkhau?>" required>
        </div>
        <div class="btn-user">
            <input type="submit" class="sm-user sm-login-user" name="dangnhap" value="<?=_dangnhap?>">
            <label class="remember-user">
                <input type="checkbox" name="remember-login" value="1">
                <span><?=_nhomatkhau?></span>
            </label>
        </div>
        <div class="checklogin-user">
            <span><?=_banchuacotaikhoan?> ! </span>
            <a href="account/dang-ky.html" title="<?=_dangkytaiday?>"><?=_dangkytaiday?></a>
        </div>
    </form>
</div>