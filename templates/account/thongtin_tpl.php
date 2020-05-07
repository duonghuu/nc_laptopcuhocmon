<div class="wrap-user signup-user">
    <div class="title-user"><span><?=_thongtincanhan?></span></div>
    <form class="frm-user" action="account/thong-tin.html" method="post" enctype="multipart/form-data">
        <div class="double-item-user">
            <p class="label-item-user"><?=_hoten?><span>*</span></p>
            <div class="input-item-user">
                <div class="item-user">
                    <i class="fa fa-user"></i>
                    <input type="text" name="ten" placeholder="<?=_nhaphoten?>" value="<?=$row_detail['ten']?>" required>
                </div>
            </div>
        </div>
        <div class="double-item-user">
            <p class="label-item-user"><?=_taikhoan?><span>*</span></p>
            <div class="input-item-user">
                <div class="item-user">
                    <i class="fa fa-user"></i>
                    <input type="text" name="username" readonly placeholder="<?=_nhaptaikhoan?>" value="<?=$row_detail['username']?>" required>
                </div>
            </div>
        </div>
        <div class="double-item-user">
            <p class="label-item-user"><?=_matkhaucu?><span>*</span></p>
            <div class="input-item-user">
                <div class="item-user">
                    <i class="fa fa-lock"></i>
                    <input type="password" name="password" placeholder="<?=_nhapmatkhaucu?>">
                </div>
            </div>
        </div>
        <div class="double-item-user">
            <p class="label-item-user"><?=_matkhaumoi?><span>*</span></p>
            <div class="input-item-user">
                <div class="item-user">
                    <i class="fa fa-lock"></i>
                    <input type="password" name="new-password" placeholder="<?=_nhapmatkhaumoi?>">
                </div>
            </div>
        </div>
        <div class="double-item-user">
            <p class="label-item-user"><?=_nhaplaimatkhaumoi?><span>*</span></p>
            <div class="input-item-user">
                <div class="item-user">
                    <i class="fa fa-lock"></i>
                    <input type="password" name="new-password-confirm" placeholder="<?=_nhaplaimatkhaumoi?>">
                </div>
            </div>
        </div>
        <div class="double-item-user checkbox-item-user">
            <p class="label-item-user"><?=_gioitinh?><span>*</span></p>
            <div class="input-item-user">
                <label><input type="radio" name="sex" <?=($row_detail['sex']==1)?'checked':''?> value="1"><span><?=_nam?></span></label>
                <label><input type="radio" name="sex" <?=($row_detail['sex']==0)?'checked':''?> value="0"><span><?=_nu?></span></label>
            </div>
        </div>
        <div class="double-item-user">
            <p class="label-item-user">Ngày sinh</p>
            <div class="input-item-user">
                <div class="item-user">
                    <i class="fa fa-lock"></i>
                    <input type="text" readonly name="ngaysinh" id="ngaysinh" placeholder="<?=_nhapngaysinh?>" value="<?=date("d/m/Y",$row_detail['ngaysinh'])?>" required>
                </div>
            </div>
        </div>
        <div class="double-item-user">
            <p class="label-item-user">Email<span>*</span></p>
            <div class="input-item-user">
                <div class="item-user">
                    <i class="fa fa-envelope"></i>
                    <input type="email" name="email" placeholder="<?=_nhapemail?>" value="<?=$row_detail['email']?>" required>
                </div>
            </div>
        </div>
        <div class="double-item-user">
            <p class="label-item-user"><?=_dienthoai?></p>
            <div class="input-item-user">
                <div class="item-user">
                    <i class="fa fa-phone-square"></i>
                    <input type="number" name="dienthoai" placeholder="<?=_nhapdienthoai?>" value="<?=$row_detail['dienthoai']?>">
                </div>
            </div>
        </div>
        <div class="double-item-user">
            <p class="label-item-user"><?=_diachi?></p>
            <div class="input-item-user">
                <div class="item-user">
                    <i class="fa fa-map"></i>
                    <input type="text" name="diachi" placeholder="<?=_nhapdiachi?>" value="<?=$row_detail['diachi']?>">
                </div>
            </div>
        </div>
        <div class="double-item-user">
            <p class="label-item-user"></p>
            <div class="input-item-user">
                <input type="submit" class="sm-user sm-login-user" name="capnhatthongtin" value="<?=_capnhat?>">
            </div>
        </div>
    </form>
</div>