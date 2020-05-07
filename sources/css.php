<!-- Viewport -->
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

<!-- CSS DESKTOP -->
<style type="text/css"><?php echo file_get_contents($config_url_http.'assets/cssoptimized.php'); ?></style>

<!-- JS DESKTOP -->
<script type="text/javascript" src="assets/js/jquery.min.js"></script>

<!-- Lazy Load -->
<script type="text/javascript" src="assets/js/jquery.lazy.js"></script>
<script type="text/javascript">
    window.addEventListener("load", function(event) {
        $(".lazy").lazy({
            threshold: 500,
            effect: "fadeIn",
            effectTime: 400
        });
    });
    $(document).ajaxStop(function(){
        $(".lazy").lazy({ 
            threshold: 500,
            effect: "fadeIn",
            effectTime: 400
        }).removeClass("lazy");
    });
</script>

<?php if($config_recaptcha==true) { ?>
    <!-- Google Recaptcha V3 -->
    <script src="https://www.google.com/recaptcha/api.js?render=<?=$config_sitekey?>"></script>
    <script type="text/javascript">
        grecaptcha.ready(function () {
            <?php if($source=='contact') { ?>
                grecaptcha.execute('<?=$config_sitekey?>', { action: 'contact' }).then(function (token) {
                    var recaptchaResponseContact = document.getElementById('recaptchaResponseContact');
                    recaptchaResponseContact.value = token;
                });
            <?php } ?>
            grecaptcha.execute('<?=$config_sitekey?>', { action: 'newsletter' }).then(function (token) {
                var recaptchaResponseNewsletter = document.getElementById('recaptchaResponseNewsletter');
                recaptchaResponseNewsletter.value = token;
            });
        });
    </script>
<?php } ?>

<?php if($config_onesignal==true) { ?>
	<!-- OneSignal --> 
	<script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
	<script type="text/javascript">
	    var OneSignal = window.OneSignal || [];
	    OneSignal.push(function() {
	        OneSignal.init({
	            appId: "<?=$config_onesignal_id?>"
	        });
	    });
	</script>
<?php } ?>

<!-- Google Analytic -->
<?=$row_setting['analytics']?>

<!-- Head JS -->
<?=$row_setting['headjs']?>