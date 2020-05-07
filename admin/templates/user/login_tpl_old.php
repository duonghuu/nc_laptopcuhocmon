<div class="loginwrapper">
	<div class="loginwrap zindex100">
	<h1 class="logintitle"><span class="iconfa-lock"></span><?=$config_title_log?> <span class="subtitle">Chào mừng đến với trang quản trị</span></h1>
        <div class="loginwrapperinner">
            <form id="loginform" action="index.php?com=user&act=login" method="post">
                <p><input type="text" id="username" name="username" placeholder="Tài khoản *" /></p>
                <p><input type="password" id="password" name="password" placeholder="Mật khẩu" /></p>
                <p><button class="btn btn-default btn-block">Đăng nhập</button></p>
            </form>
        </div>
    </div>
    <div class=""></div>
</div>

<script type="text/javascript">
	jQuery.noConflict();
	jQuery(document).ready(function(){
		var anievent = (jQuery.browser.webkit)? 'webkitAnimationEnd' : 'animationend';
		jQuery('.loginwrap').bind(anievent,function(){
			jQuery(this).removeClass('animate2 bounceInDown');
		});
		jQuery('#username,#password').focus(function(){
			if(jQuery(this).hasClass('error')) jQuery(this).removeClass('error');
		});
		jQuery('#loginform button').click(function(){
			if(!jQuery.browser.msie) {
				if(jQuery('#username').val() == '' || jQuery('#password').val() == '') {
					if(jQuery('#username').val() == '') jQuery('#username').addClass('error'); else jQuery('#username').removeClass('error');
					if(jQuery('#password').val() == '') jQuery('#password').addClass('error'); else jQuery('#password').removeClass('error');
					jQuery('.loginwrap').addClass('animate0 wobble').bind(anievent,function(){
						jQuery(this).removeClass('animate0 wobble');
					});
				} else {
					jQuery('.loginwrapper').addClass('animate0 fadeOutUp').bind(anievent,function(){
						jQuery('#loginform').submit();
					});
				}
				return false;
			}
		});
	});
</script>