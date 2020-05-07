<link href="css/style_par.css" type="text/css" rel="stylesheet" />
<div id="particles-js"></div>
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
<div class="footer-login">
	<svg version="1.1" id="Layer_intro" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 width="300px" height="178px" viewBox="0 0 108.833 64.833"
	 xml:space="preserve">
		<g>
			<g>
				<path style="fill:#BF2026;stroke:#000;stroke-width:0.15;" id="Draw-text1" class="Animate-Draw" d="M2.502,62.439V22.01h14.292l15.608,15.231V22.198h15.232l14.291,14.855l0.188-14.855h14.479v40.242
					H58.54v-2.068c0,0,3.762,0,3.762-4.514c0-4.513,0-12.787,0-12.787l-14.48-15.607v34.789H27.889v-1.881
					c0,0,4.325,0.376,4.325-5.642c0-6.017,0.188-10.53,0.188-10.53L16.23,27.651v34.601L2.502,62.439z"/>
				<path style="fill:#BF2026;stroke:#000;stroke-width:0.15;" id="Draw-text2" class="Animate-Draw" d="M77.659,22.26v20.121h0.877V23.999c0,0,14.542,3.602,14.542,8.694c0,3.229-0.877,3.851-2.632,3.851
					c-1.756,0-9.528,0-9.528,0v3.478h5.642c0,0,6.268,0,6.268,6.583s0,8.942,0,8.942s-0.877,4.223-5.265,4.969
					c0.125,1.117,0,1.986,0,1.986h18.805V36.171c0,0-0.126-13.911-18.052-13.911C80.793,22.26,77.659,22.26,77.659,22.26z"/>
			</g>
			<g>
				<path style="fill:#FBE805;stroke:#000;stroke-width:0.15;" id="Draw-halfstar1" class="Animate-Draw" d="M32.402,21.069c0,0,5.735-14.479,21.155-16.642c-5.547,4.607-7.71,6.488-7.71,6.488
					s0.376,7.804-0.282,10.342c-2.163-2.444-4.983-5.547-5.265-6.206C37.761,17.12,32.402,21.069,32.402,21.069z"/>
				<path style="fill:#2FAAE1;stroke:#000;stroke-width:0.15;" id="Draw-halfstar2" class="Animate-Draw" d="M44.86,6.167c0,0-4.325,1.551-9.12,7.475c-1.175-2.68-2.351-4.372-3.526-4.701
					c2.868-0.705,6.487-1.27,6.911-0.705c0.658-2.398,2.116-5.783,3.385-6.817C42.697,2.782,43.638,5.32,44.86,6.167z"/>
			</g>
		</g>
	</svg>
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
<script src="js/login-animation/particles.js"></script>
<script src="js/login-animation/app.js"></script>
<script src="js/login-animation/stats.js"></script>