<?php
	/* Sản phẩm */
	$config['product']['san-pham']['title_main']="Sản Phẩm";
	$config['product']['san-pham']['dropdown']=true;
	$config['product']['san-pham']['list']=true;
	$config['product']['san-pham']['cat']=true;
	$config['product']['san-pham']['tag_list']=true;
	$config['product']['san-pham']['check']=array("moi"=>"Mới","banchay"=>"Bán chạy","noibat"=>"Nổi bật");
	$config['product']['san-pham']['images']=true;
	$config['product']['san-pham']['show_images']=true;
	$config['product']['san-pham']['multipic_arr']=array
	(
		"san-pham"=>array
		(
        	"title_main_photo" => "Hình ảnh sản phẩm",
        	"title_sub_photo" => "Hình ảnh",
        	"images_photo" => true,
        	"avatar_photo" => true,
        	"width_photo" => 240*3,
        	"height_photo" => 190*3,
        	"thumb_width_photo" => 240,
        	"thumb_height_photo" => 190,
        	"thumb_ratio_photo" => 1,
        	"img_type_photo" => '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF'
     	)
	);	
	$config['product']['san-pham']['gia']=true;
	$config['product']['san-pham']['giamoi_set']=true;
	$config['product']['san-pham']['mota']=true;
	$config['product']['san-pham']['noidung']=true;
	$config['product']['san-pham']['noidung_cke']=true;
	$config['product']['san-pham']['seo']=true;
	$config['product']['san-pham']['width']=240*3;
	$config['product']['san-pham']['height']=190*3;
	$config['product']['san-pham']['thumb_width']=240;
	$config['product']['san-pham']['thumb_height']=190;
	$config['product']['san-pham']['thumb_ratio']=1;
	$config['product']['san-pham']['img_type']='.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

	/* Sản phẩm (List) */
	$config['product']['san-pham']['title_main_list']="Sản phẩm cấp 1";
	$config['product']['san-pham']['multipic_list_arr']=array
	(
		"san-pham"=>array
		(
        	"title_main_photo" => "Hình ảnh sản phẩm cấp 1",
        	"title_sub_photo" => "Hình ảnh",
        	"images_photo" => true,
        	"avatar_photo" => true,
        	"width_photo" => 585,
        	"height_photo" => 200,
        	"thumb_width_photo" => 585,
        	"thumb_height_photo" => 200,
        	"thumb_ratio_photo" => 1,
        	"img_type_photo" => '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF'
     	)
	);
	$config['product']['san-pham']['check_list']=array("noibat"=>"Nổi bật");
	$config['product']['san-pham']['seo_list']=true;

	/* Sản phẩm (Cat) */
	$config['product']['san-pham']['title_main_cat']="Sản phẩm cấp 2";
	$config['product']['san-pham']['check_cat']=array();
	$config['product']['san-pham']['seo_cat']=true;

	/* Sản phẩm */
	$config['tags_list']['san-pham']['title_main']="tags sản phẩm";
	$config['tags_list']['san-pham']['table']="product";
	$config['tags_list']['san-pham']['check']=array("noibat"=>"Nổi bật");
	$config['tags_list']['san-pham']['seo']=true;

	/* Đăng Ký Nhận Tin */
	$config['email_dk']['dangkynhantin']['title_main']="Đăng ký nhận tin";
	$config['email_dk']['dangkynhantin']['email']=true;
	$config['email_dk']['dangkynhantin']['guiemail']=true;
	$config['email_dk']['dangkynhantin']['tinhtrang']=array("1"=>"Đã xem", "2"=>"Đã liên hệ", "3"=>"Đã thông báo");
	$config['email_dk']['dangkynhantin']['showngaytao']=true;
	$config['email_dk']['dangkynhantin']['file_type']='doc|docx|pdf|rar|zip|ppt|pptx|DOC|DOCX|PDF|RAR|ZIP|PPT|PPTX|xls|jpg|png|gif|JPG|PNG|GIF|xls|XLS';

	/* Dịch vụ */
	$config['news']['dich-vu']['title_main']="Dịch vụ";
	$config['news']['dich-vu']['check']=array("noibat"=>"Nổi bật");
	$config['news']['dich-vu']['images']=true;
	$config['news']['dich-vu']['show_images']=true;
	$config['news']['dich-vu']['mota']=true;
	$config['news']['dich-vu']['noidung']=true;
	$config['news']['dich-vu']['noidung_cke']=true;
	$config['news']['dich-vu']['seo']=true;
	$config['news']['dich-vu']['width']=270;
	$config['news']['dich-vu']['height']=205;
	$config['news']['dich-vu']['thumb_width']=270;
	$config['news']['dich-vu']['thumb_height']=205;
	$config['news']['dich-vu']['thumb_ratio']=1;
	$config['news']['dich-vu']['img_type']='.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

	/* Tin tức */
	$config['news']['tin-tuc']['title_main']="Tin tức";
	$config['news']['tin-tuc']['check']=array("noibat"=>"Nổi bật");
	$config['news']['tin-tuc']['images']=true;
	$config['news']['tin-tuc']['show_images']=true;
	$config['news']['tin-tuc']['noidung']=true;
	$config['news']['tin-tuc']['noidung_cke']=true;
	$config['news']['tin-tuc']['seo']=true;
	$config['news']['tin-tuc']['width']=355;
	$config['news']['tin-tuc']['height']=220;
	$config['news']['tin-tuc']['thumb_width']=355;
	$config['news']['tin-tuc']['thumb_height']=220;
	$config['news']['tin-tuc']['thumb_ratio']=1;
	$config['news']['tin-tuc']['img_type']='.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

	/* Chính sách mua */
	$config['news']['chinh-sach-mua']['title_main']="Chính sách mua";
	$config['news']['chinh-sach-mua']['check']=array();
	$config['news']['chinh-sach-mua']['images']=true;
	$config['news']['chinh-sach-mua']['show_images']=true;
	$config['news']['chinh-sach-mua']['mota']=true;
	$config['news']['chinh-sach-mua']['noidung']=true;
	$config['news']['chinh-sach-mua']['noidung_cke']=true;
	$config['news']['chinh-sach-mua']['seo']=true;
	$config['news']['chinh-sach-mua']['width']=160*2;
	$config['news']['chinh-sach-mua']['height']=120*2;
	$config['news']['chinh-sach-mua']['thumb_width']=160;
	$config['news']['chinh-sach-mua']['thumb_height']=120;
	$config['news']['chinh-sach-mua']['thumb_ratio']=1;
	$config['news']['chinh-sach-mua']['img_type']='.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

	/* Công trình */
	$config['news']['cong-trinh']['title_main']="Công trình";
	$config['news']['cong-trinh']['check']=array();
	$config['news']['cong-trinh']['images']=true;
	$config['news']['cong-trinh']['show_images']=true;
	$config['news']['cong-trinh']['mota']=true;
	$config['news']['cong-trinh']['noidung']=true;
	$config['news']['cong-trinh']['noidung_cke']=true;
	$config['news']['cong-trinh']['seo']=true;
	$config['news']['cong-trinh']['width']=160*2;
	$config['news']['cong-trinh']['height']=120*2;
	$config['news']['cong-trinh']['thumb_width']=160;
	$config['news']['cong-trinh']['thumb_height']=120;
	$config['news']['cong-trinh']['thumb_ratio']=1;
	$config['news']['cong-trinh']['img_type']='.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

	/* Hỗ trợ online */
	$config['news']['ho-tro-online']['title_main']="Hỗ trợ online";
	$config['news']['ho-tro-online']['check']=array();
	$config['news']['ho-tro-online']['images']=true;
	$config['news']['ho-tro-online']['show_images']=true;
	$config['news']['ho-tro-online']['width']=30;
	$config['news']['ho-tro-online']['height']=30;
	$config['news']['ho-tro-online']['thumb_width']=30;
	$config['news']['ho-tro-online']['thumb_height']=30;
	$config['news']['ho-tro-online']['thumb_ratio']=1;
	$config['news']['ho-tro-online']['img_type']='.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

	/* Hỗ trợ mua hàng */
	$config['news']['ho-tro-mua-hang']['title_main']="Hỗ trợ mua hàng";
	$config['news']['ho-tro-mua-hang']['check']=array();
	$config['news']['ho-tro-mua-hang']['images']=true;
	$config['news']['ho-tro-mua-hang']['show_images']=true;
	$config['news']['ho-tro-mua-hang']['width']=30;
	$config['news']['ho-tro-mua-hang']['height']=30;
	$config['news']['ho-tro-mua-hang']['thumb_width']=30;
	$config['news']['ho-tro-mua-hang']['thumb_height']=30;
	$config['news']['ho-tro-mua-hang']['thumb_ratio']=1;
	$config['news']['ho-tro-mua-hang']['img_type']='.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

	/* Hình thức thanh toán */
	$config['news']['hinh-thuc-thanh-toan']['title_main']="Hình thức thanh toán";
	$config['news']['hinh-thuc-thanh-toan']['check']=array();
	$config['news']['hinh-thuc-thanh-toan']['mota']=true;

	/* Slogan dịch vụ */
	$config['news_static']['slogan-dich-vu']['title_main']="Slogan dịch vụ";
	$config['news_static']['slogan-dich-vu']['tieude']=true;

	/* Slogan intro */
	$config['news_static']['slogan-intro']['title_main']="Slogan intro";
	$config['news_static']['slogan-intro']['tieude']=true;

	/* Giao hàng miễn phí */
	$config['news_static']['giao-hang-mien-phi']['title_main']="Giao hàng miễn phí";
	$config['news_static']['giao-hang-mien-phi']['tieude']=true;

	/* Liên hệ */
	$config['news_static']['lienhe']['title_main']="Liên hệ";
	$config['news_static']['lienhe']['noidung']=true;
	$config['news_static']['lienhe']['noidung_cke']=true;
	$config['news_static']['lienhe']['seo']=true;

	/* Footer */
	$config['news_static']['footer']['title_main']="Footer";
	$config['news_static']['footer']['tieude']=true;
	$config['news_static']['footer']['noidung']=true;
	$config['news_static']['footer']['noidung_cke']=true;

	/* Footer form */
	$config['news_static']['footer_form']['title_main']="Footer form";
	$config['news_static']['footer_form']['tieude']=true;
	$config['news_static']['footer_form']['noidung']=true;

	/* Logo */
	$config['photo']['photo_static']['logo']['title_main']="Logo";
	$config['photo']['photo_static']['logo']['images']=true;
	$config['photo']['photo_static']['logo']['width']=280;
	$config['photo']['photo_static']['logo']['height']=80;
	$config['photo']['photo_static']['logo']['thumb_width']=280;
	$config['photo']['photo_static']['logo']['thumb_height']=80;
	$config['photo']['photo_static']['logo']['thumb_ratio']=1;
	$config['photo']['photo_static']['logo']['img_type']='.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

	/* Logo form */
	$config['photo']['photo_static']['logo_form']['title_main']="Logo form";
	$config['photo']['photo_static']['logo_form']['images']=true;
	$config['photo']['photo_static']['logo_form']['width']=280;
	$config['photo']['photo_static']['logo_form']['height']=80;
	$config['photo']['photo_static']['logo_form']['thumb_width']=280;
	$config['photo']['photo_static']['logo_form']['thumb_height']=80;
	$config['photo']['photo_static']['logo_form']['thumb_ratio']=1;
	$config['photo']['photo_static']['logo_form']['img_type']='.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

	/* Watermark */
	$config['photo']['photo_static']['watermark']['title_main']="Watermark";
	$config['photo']['photo_static']['watermark']['images']=true;
	$config['photo']['photo_static']['watermark']['width']=240;
	$config['photo']['photo_static']['watermark']['height']=190;
	$config['photo']['photo_static']['watermark']['thumb_width']=240;
	$config['photo']['photo_static']['watermark']['thumb_height']=190;
	$config['photo']['photo_static']['watermark']['thumb_ratio']=2;
	$config['photo']['photo_static']['watermark']['img_type']='.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

	/* Watermark chi tiết */
	$config['photo']['photo_static']['watermark-chitiet']['title_main']="Watermark chi tiết";
	$config['photo']['photo_static']['watermark-chitiet']['images']=true;
	$config['photo']['photo_static']['watermark-chitiet']['width']=240*3;
	$config['photo']['photo_static']['watermark-chitiet']['height']=190*3;
	$config['photo']['photo_static']['watermark-chitiet']['thumb_width']=240;
	$config['photo']['photo_static']['watermark-chitiet']['thumb_height']=190;
	$config['photo']['photo_static']['watermark-chitiet']['thumb_ratio']=2;
	$config['photo']['photo_static']['watermark-chitiet']['img_type']='.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

	/* Favicon */
	$config['photo']['photo_static']['favicon']['title_main']="Favicon";
	$config['photo']['photo_static']['favicon']['images']=true;
	$config['photo']['photo_static']['favicon']['width']=25;
	$config['photo']['photo_static']['favicon']['height']=25;
	$config['photo']['photo_static']['favicon']['thumb_width']=25;
	$config['photo']['photo_static']['favicon']['thumb_height']=25;
	$config['photo']['photo_static']['favicon']['thumb_ratio']=3;
	$config['photo']['photo_static']['favicon']['img_type']='.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

	/* Slide */
	$config['photo']['man_photo']['slide']['title_main_photo']="Slideshow";
	$config['photo']['man_photo']['slide']['check_photo']=array();
	$config['photo']['man_photo']['slide']['images_photo']=true;
	$config['photo']['man_photo']['slide']['avatar_photo']=true;
	$config['photo']['man_photo']['slide']['link_photo']=true;
	$config['photo']['man_photo']['slide']['width_photo']=915;
	$config['photo']['man_photo']['slide']['height_photo']=430;
	$config['photo']['man_photo']['slide']['thumb_width_photo']=915;
	$config['photo']['man_photo']['slide']['thumb_height_photo']=430;
	$config['photo']['man_photo']['slide']['thumb_ratio_photo']=1;
	$config['photo']['man_photo']['slide']['img_type_photo']='.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

	/* Mạng xã hội 1 */
	$config['photo']['man_photo']['mangxahoi1']['title_main_photo']="Mạng xã hội 1";
	$config['photo']['man_photo']['mangxahoi1']['check_photo']=array();
	$config['photo']['man_photo']['mangxahoi1']['images_photo']=true;
	$config['photo']['man_photo']['mangxahoi1']['avatar_photo']=true;
	$config['photo']['man_photo']['mangxahoi1']['link_photo']=true;
	$config['photo']['man_photo']['mangxahoi1']['width_photo']=16;
	$config['photo']['man_photo']['mangxahoi1']['height_photo']=16;
	$config['photo']['man_photo']['mangxahoi1']['thumb_width_photo']=16;
	$config['photo']['man_photo']['mangxahoi1']['thumb_height_photo']=16;
	$config['photo']['man_photo']['mangxahoi1']['thumb_ratio_photo']=1;
	$config['photo']['man_photo']['mangxahoi1']['img_type_photo']='.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

	/* Mạng xã hội 2 */
	$config['photo']['man_photo']['mangxahoi2']['title_main_photo']="Mạng xã hội 2";
	$config['photo']['man_photo']['mangxahoi2']['check_photo']=array();
	$config['photo']['man_photo']['mangxahoi2']['images_photo']=true;
	$config['photo']['man_photo']['mangxahoi2']['avatar_photo']=true;
	$config['photo']['man_photo']['mangxahoi2']['link_photo']=true;
	$config['photo']['man_photo']['mangxahoi2']['width_photo']=50;
	$config['photo']['man_photo']['mangxahoi2']['height_photo']=50;
	$config['photo']['man_photo']['mangxahoi2']['thumb_width_photo']=50;
	$config['photo']['man_photo']['mangxahoi2']['thumb_height_photo']=50;
	$config['photo']['man_photo']['mangxahoi2']['thumb_ratio_photo']=1;
	$config['photo']['man_photo']['mangxahoi2']['img_type_photo']='.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

	/* Mạng xã hội form */
	$config['photo']['man_photo']['mangxahoi_form']['title_main_photo']="Mạng xã hội form";
	$config['photo']['man_photo']['mangxahoi_form']['check_photo']=array();
	$config['photo']['man_photo']['mangxahoi_form']['images_photo']=true;
	$config['photo']['man_photo']['mangxahoi_form']['avatar_photo']=true;
	$config['photo']['man_photo']['mangxahoi_form']['link_photo']=true;
	$config['photo']['man_photo']['mangxahoi_form']['width_photo']=25;
	$config['photo']['man_photo']['mangxahoi_form']['height_photo']=25;
	$config['photo']['man_photo']['mangxahoi_form']['thumb_width_photo']=25;
	$config['photo']['man_photo']['mangxahoi_form']['thumb_height_photo']=25;
	$config['photo']['man_photo']['mangxahoi_form']['thumb_ratio_photo']=3;
	$config['photo']['man_photo']['mangxahoi_form']['img_type_photo']='.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

	/* Video */
	$config['photo']['man_photo']['video']['title_main_photo']="Video";
	$config['photo']['man_photo']['video']['check_photo']=array();
	$config['photo']['man_photo']['video']['video_photo']=true;
	$config['photo']['man_photo']['video']['tieude_photo']=true;

	/* Setting */
	$config['setting']['diachi']=true;
	$config['setting']['dienthoai']=true;
	$config['setting']['hotline']=true;
	$config['setting']['zalo']=true;
	$config['setting']['oaidzalo']=true;
	$config['setting']['email']=true;
	$config['setting']['website']=true;
	$config['setting']['fb_facebook']=true;
	$config['setting']['map_iframe']=true;
	$config['setting']['copyright']=true;

	/* Quản lý giỏ hàng */
	$order=true;
	$phiship=false;
	$phicoupon=false;
	$export_ex=false;
	$export_wo=false;

	/* Quản lý bài viết (Không cấp) */
	if(count($config['news']))
	{
		foreach ($config['news'] as $key => $value)
		{
			if($value['dropdown']==false)
			{ 
				$config_showpagenews=1;
				break;
			}
		}
	}

	/* Quản lý sản phẩm (Không cấp) */
	if(count($config['product']))
	{
		foreach ($config['product'] as $key => $value)
		{
			if($value['dropdown']==false)
			{ 
				$config_showpagepro=1;
				break;
			}
		}
	}
?>