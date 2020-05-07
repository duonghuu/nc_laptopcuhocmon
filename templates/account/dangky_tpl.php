<div class="wrap-user signup-user">
    <div class="title-user"><span><?=_dangky?></span></div>
    <form class="frm-user" action="account/dang-ky.html" method="post" enctype="multipart/form-data">
        <div class="double-item-user">
            <p class="label-item-user"><?=_hoten?><span>*</span></p>
            <div class="input-item-user">
                <div class="item-user">
                    <i class="fa fa-user"></i>
                    <input type="text" name="ten" placeholder="<?=_nhaphoten?>" required>
                </div>
            </div>
        </div>
        <div class="double-item-user">
            <p class="label-item-user"><?=_taikhoan?><span>*</span></p>
            <div class="input-item-user">
                <div class="item-user">
                    <i class="fa fa-user"></i>
                    <input type="text" name="username" placeholder="<?=_nhaptaikhoan?>" required>
                </div>
            </div>
        </div>
        <div class="double-item-user">
            <p class="label-item-user"><?=_matkhau?><span>*</span></p>
            <div class="input-item-user">
                <div class="item-user">
                    <i class="fa fa-lock"></i>
                    <input type="password" name="password" placeholder="<?=_nhapmatkhau?>" required>
                </div>
            </div>
        </div>
        <div class="double-item-user">
            <p class="label-item-user"><?=_nhaplaimatkhau?><span>*</span></p>
            <div class="input-item-user">
                <div class="item-user">
                    <i class="fa fa-lock"></i>
                    <input type="password" name="password_2" placeholder="<?=_nhaplaimatkhau?>" required>
                </div>
            </div>
        </div>
        <div class="double-item-user checkbox-item-user">
            <p class="label-item-user"><?=_gioitinh?><span>*</span></p>
            <div class="input-item-user">
                <label><input type="radio" name="sex" value="1"><span><?=_nam?></span></label>
                <label><input type="radio" name="sex" value="1"><span><?=_nu?></span></label>
            </div>
        </div>
        <div class="double-item-user">
            <p class="label-item-user">Ngày sinh</p>
            <div class="input-item-user">
                <div class="item-user">
                    <i class="fa fa-lock"></i>
                    <input type="text" readonly name="ngaysinh" id="ngaysinh" placeholder="<?=_nhapngaysinh?>" required>
                </div>
            </div>
        </div>
        <div class="double-item-user">
            <p class="label-item-user">Email<span>*</span></p>
            <div class="input-item-user">
                <div class="item-user">
                    <i class="fa fa-envelope"></i>
                    <input type="email" name="email" placeholder="<?=_nhapemail?>" required>
                </div>
            </div>
        </div>
        <div class="double-item-user">
            <p class="label-item-user"><?=_dienthoai?></p>
            <div class="input-item-user">
                <div class="item-user">
                    <i class="fa fa-phone-square"></i>
                    <input type="number" name="dienthoai" placeholder="<?=_nhapdienthoai?>">
                </div>
            </div>
        </div>
        <div class="double-item-user">
            <p class="label-item-user"><?=_diachi?></p>
            <div class="input-item-user">
                <div class="item-user">
                    <i class="fa fa-map"></i>
                    <input type="text" name="diachi" placeholder="<?=_nhapdiachi?>">
                </div>
            </div>
        </div>
        <div class="double-item-user">
            <p class="label-item-user"></p>
            <div class="input-item-user">
                <input type="submit" class="sm-user sm-signup-user" name="dangky" value="<?=_dangky?>">
            </div>
        </div>
    </form>
</div>