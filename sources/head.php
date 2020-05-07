<!-- UTF-8 -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<!-- Base Href -->
<base href="<?=$config_url_http?>"/>

<!-- Title, Keywords, Description -->
<title><?=($title_custom!='')?$title_custom:$title_bar.$row_setting['title']?></title>
<meta name="keywords" content="<?php if(!empty($keywords_custom)) echo $keywords_custom; else echo $row_setting['keywords']; ?>"/>
<meta name="description" content="<?php if(!empty($description_custom)) echo $description_custom; else echo $row_setting['description']; ?>"/>

<!-- Robots -->
<meta name="robots" content="index,follow" />

<!-- Favicon -->
<link href="<?=_upload_photo_l.$favicon['photo']?>" rel="shortcut icon" type="image/x-icon" />

<!-- Google Webmaster Tool -->
<?=$row_setting['mastertool']?>

<!-- GEO meta -->
<meta name="geo.region" content="VN" />
<meta name="geo.placename" content="Hồ Chí Minh" />
<meta name="geo.position" content="10.823099;106.629664" />
<meta name="ICBM" content="10.823099, 106.629664" />

<!-- Dublin Core -->
<link rel="schema.DC" href="https://purl.org/dc/elements/1.1/">
<meta itemscope itemtype="https://schema.org/Product">
<meta name="DC.title" content="<?php if(!empty($ten_share)) echo $ten_share; else echo $row_setting['title']; ?>">
<meta name="DC.identifier" content="<?=$row_setting['website']?>">
<meta name="DC.description" content="<?php if(!empty($description_share)) echo $description_share; else echo $row_setting['description']; ?>">
<meta name="DC.subject" content="<?php if(!empty($ten_share)) echo $ten_share; else echo $row_setting['title']; ?>">
<meta name="DC.language" scheme="UTF-8" content="vi">

<!-- Author - Copyright -->
<meta name='revisit-after' content='1 days' />
<meta name="author" content="<?=$row_setting['ten'.$lang]?>" />
<meta name="copyright" content="<?=$row_setting['ten'.$lang]." [".$row_setting['email']."]"?>" />

<!-- Facebook - Google Plus -->
<meta property="og:type" content="website" />
<meta property="og:image" content="<?php if(!empty($img_share)) echo $img_share; else echo $config_url_http._upload_photo_l.$logo['photo']; ?>" />
<meta property="og:title" content="<?php if(!empty($ten_share)) echo $ten_share; else echo $row_setting['title']; ?>" />
<meta property="og:site_name" content="<?=$row_setting['ten'.$lang]?>" />
<meta property="og:url" content="<?php if(!empty($url_share)) echo $url_share; else echo $row_setting['website']; ?>" />
<meta property="og:description" content="<?php if(!empty($description_share)) echo $description_share; else echo $row_setting['description']; ?>" />

<!-- Share Image Facebook -->
<meta property="og:image:width" content="675" />
<meta property="og:image:height" content="1000" />

<!-- Google Plus -->
<meta itemprop="name" content="<?php if(!empty($ten_share)) echo $ten_share; else echo $row_setting['title']; ?>">
<meta itemprop="description" content="<?php if(!empty($description_share)) echo $description_share; else echo $row_setting['description']; ?>">
<meta itemprop="image" content="<?php if(!empty($img_share)) echo $img_share; else echo $config_url_http._upload_photo_l.$logo['photo']; ?>"/>

<!-- Twitter Card -->
<meta name="twitter:card" content="summary" />
<meta name="twitter:title" content="<?php if(!empty($ten_share)) echo $ten_share; else echo $row_setting['title']; ?>" />
<meta name="twitter:description" content="<?php if(!empty($description_share)) echo $description_share; else echo $row_setting['description']; ?>" />

<!-- Canonical -->
<link rel="canonical" href="<?=getCurrentPageURL()?>" />

<!-- Chống đổi màu trên IOS -->
<meta name="format-detection" content="telephone=no">