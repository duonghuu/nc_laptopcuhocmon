<?php
	/* Sản phẩm */
	$config['product']['san-pham']['title_main']="Sản Phẩm";
	$config['product']['san-pham']['dropdown']=true;
	$config['product']['san-pham']['list']=true;
	$config['product']['san-pham']['cat']=true;
	$config['product']['san-pham']['item']=true;
	$config['product']['san-pham']['capbon']=true;
	$config['product']['san-pham']['nhanhieu_list']=true;
	$config['product']['san-pham']['mau']=true;
	$config['product']['san-pham']['mausac']=true;
	$config['product']['san-pham']['size']=true;
	$config['product']['san-pham']['tag_list']=true;
	$config['product']['san-pham']['import']=true;
	$config['product']['san-pham']['export']=true;
	$config['product']['san-pham']['check']=array("moi"=>"Mới","noibat"=>"Nổi bật");
	$config['product']['san-pham']['images']=true;
	$config['product']['san-pham']['show_images']=true;
	$config['product']['san-pham']['file']=true;
	$config['product']['san-pham']['multipic']=true;
	$config['product']['san-pham']['multipic_arr']=array
	(
		"san-pham"=>array
			(
            	"title_main_photo" => "Hình ảnh sản phẩm",
            	"title_sub_photo" => "Hình ảnh",
            	"images_photo" => true,
            	"cart_photo" => true,
            	"file_photo" => false,
            	"avatar_photo" => true,
            	"mausac_photo" => false,
            	"video_photo" => false,
            	"link_photo" => false,
            	"mota_photo" => false,
            	"mota_cke_photo" => false,
            	"tieude_photo" => false,
            	"noidung_photo" => false,
            	"noidung_cke_photo" => false,
            	"width_photo" => 500,
            	"height_photo" => 500,
            	"thumb_width_photo" => 500,
            	"thumb_height_photo" => 500,
            	"thumb_ratio_photo" => 1,
            	"img_type_photo" => '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF'
         	),
		"video"=>array
			(
            	"title_main_photo" => "Video sản phẩm",
            	"title_sub_photo" => "Video",
            	"images_photo" => false,
            	"file_photo" => false,
            	"avatar_photo" => false,
            	"mausac_photo" => false,
            	"video_photo" => true,
            	"link_photo" => true,
            	"mota_photo" => false,
            	"mota_cke_photo" => false,
            	"tieude_photo" => true,
            	"noidung_photo" => false,
            	"noidung_cke_photo" => false,
            	"width_photo" => 500,
            	"height_photo" => 500,
            	"thumb_width_photo" => 500,
            	"thumb_height_photo" => 500,
            	"thumb_ratio_photo" => 1,
            	"img_type_photo" => '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF'
         	),
		"taptin"=>array
			(
            	"title_main_photo" => "Tập tin sản phẩm",
            	"title_sub_photo" => "Tập tin",
            	"images_photo" => false,
            	"file_photo" => true,
            	"avatar_photo" => false,
            	"mausac_photo" => false,
            	"video_photo" => false,
            	"link_photo" => false,
            	"mota_photo" => false,
            	"mota_cke_photo" => false,
            	"tieude_photo" => true,
            	"noidung_photo" => false,
            	"noidung_cke_photo" => false,
            	"width_photo" => 500,
            	"height_photo" => 500,
            	"thumb_width_photo" => 500,
            	"thumb_height_photo" => 500,
            	"thumb_ratio_photo" => 1,
            	"img_type_photo" => '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF',
            	"file_type_photo" => 'doc|docx|pdf|rar|zip|ppt|pptx|DOC|DOCX|PDF|RAR|ZIP|PPT|PPTX|xls|jpg|png|gif|JPG|PNG|GIF|xls|XLS'
         	)
	);
	$config['product']['san-pham']['video']=true;
	$config['product']['san-pham']['gia']=true;
	$config['product']['san-pham']['giakm']=true;
	$config['product']['san-pham']['giamoi_auto']=true;
	$config['product']['san-pham']['giamoi_set']=true;
	$config['product']['san-pham']['mota']=true;
	$config['product']['san-pham']['noidung']=true;
	$config['product']['san-pham']['noidung_cke']=true;
	$config['product']['san-pham']['khuyenmai']=true;
	$config['product']['san-pham']['thongsokythuat']=true;
	$config['product']['san-pham']['thongsokythuat_cke']=true;
	$config['product']['san-pham']['seo']=true;
	$config['product']['san-pham']['width']=500;
	$config['product']['san-pham']['height']=500;
	$config['product']['san-pham']['thumb_width']=210;
	$config['product']['san-pham']['thumb_height']=150;
	$config['product']['san-pham']['thumb_ratio']=2;
	$config['product']['san-pham']['img_type']='.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';
	$config['product']['san-pham']['file_type']='doc|docx|pdf|rar|zip|ppt|pptx|DOC|DOCX|PDF|RAR|ZIP|PPT|PPTX|xls|jpg|png|gif|JPG|PNG|GIF|xls|XLS';

	/* Sản phẩm (Size) */
	$config['product']['san-pham']['size_gia']=true;

	/* Sản phẩm (Màu) */
	$config['product']['san-pham']['mau_gia']=true;
	$config['product']['san-pham']['mau_mau']=true;
	$config['product']['san-pham']['mau_images']=false;
	$config['product']['san-pham']['width_mau']=30;
	$config['product']['san-pham']['height_mau']=30;
	$config['product']['san-pham']['thumb_width_mau']=30;
	$config['product']['san-pham']['thumb_height_mau']=30;
	$config['product']['san-pham']['thumb_ratio_mau']=1;
	$config['product']['san-pham']['img_type_mau']='.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

	/* Sản phẩm (List) */
	$config['product']['san-pham']['title_main_list']="Sản phẩm cấp 1";
	$config['product']['san-pham']['images_list']=true;
	$config['product']['san-pham']['show_images_list']=true;
	$config['product']['san-pham']['multipic_list']=true;
	$config['product']['san-pham']['multipic_list_arr']=array
	(
		"san-pham"=>array
			(
            	"title_main_photo" => "Hình ảnh sản phẩm cấp 1",
            	"title_sub_photo" => "Hình ảnh",
            	"images_photo" => true,
            	"avatar_photo" => true,
            	"width_photo" => 270,
            	"height_photo" => 590,
            	"thumb_width_photo" => 270,
            	"thumb_height_photo" => 590,
            	"thumb_ratio_photo" => 1,
            	"img_type_photo" => '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF'
         	),
		"video"=>array
			(
            	"title_main_photo" => "Video sản phẩm cấp 1",
            	"title_sub_photo" => "Video",
            	"video_photo" => true,
            	"link_photo" => true,
            	"tieude_photo" => true,
            	"width_photo" => 500,
            	"height_photo" => 500,
            	"thumb_width_photo" => 500,
            	"thumb_height_photo" => 500,
            	"thumb_ratio_photo" => 1,
            	"img_type_photo" => '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF'
         	)
	);
	$config['product']['san-pham']['mota_list']=true;
	$config['product']['san-pham']['mota_cke_list']=true;
	$config['product']['san-pham']['noidung_list']=true;
	$config['product']['san-pham']['noidung_cke_list']=true;
	$config['product']['san-pham']['mausac_list']=true;
	$config['product']['san-pham']['check_list']=array("noibat"=>"Nổi bật");
	$config['product']['san-pham']['seo_list']=true;
	$config['product']['san-pham']['width_list']=500;
	$config['product']['san-pham']['height_list']=500;
	$config['product']['san-pham']['thumb_width_list']=250;
	$config['product']['san-pham']['thumb_height_list']=150;
	$config['product']['san-pham']['thumb_ratio_list']=3;
	$config['product']['san-pham']['img_type_list']='.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

	/* Sản phẩm (Cat) */
	$config['product']['san-pham']['title_main_cat']="Sản phẩm cấp 2";
	$config['product']['san-pham']['images_cat']=true;
	$config['product']['san-pham']['show_images_cat']=true;
	$config['product']['san-pham']['mota_cat']=true;
	$config['product']['san-pham']['mota_cke_cat']=true;
	$config['product']['san-pham']['noidung_cat']=true;
	$config['product']['san-pham']['noidung_cke_cat']=true;
	$config['product']['san-pham']['check_cat']=array("noibat"=>"Nổi bật");
	$config['product']['san-pham']['seo_cat']=true;
	$config['product']['san-pham']['width_cat']=500;
	$config['product']['san-pham']['height_cat']=500;
	$config['product']['san-pham']['thumb_width_cat']=250;
	$config['product']['san-pham']['thumb_height_cat']=150;
	$config['product']['san-pham']['thumb_ratio_cat']=3;
	$config['product']['san-pham']['img_type_cat']='.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

	/* Sản phẩm (Item) */
	$config['product']['san-pham']['title_main_item']="Sản phẩm cấp 3";
	$config['product']['san-pham']['images_item']=true;
	$config['product']['san-pham']['show_images_item']=true;
	$config['product']['san-pham']['mota_item']=true;
	$config['product']['san-pham']['mota_cke_item']=true;
	$config['product']['san-pham']['noidung_item']=true;
	$config['product']['san-pham']['noidung_cke_item']=true;
	$config['product']['san-pham']['seo_item']=true;
	$config['product']['san-pham']['width_item']=500;
	$config['product']['san-pham']['height_item']=500;
	$config['product']['san-pham']['thumb_width_item']=250;
	$config['product']['san-pham']['thumb_height_item']=150;
	$config['product']['san-pham']['thumb_ratio_item']=3;
	$config['product']['san-pham']['img_type_item']='.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

	/* Sản phẩm (Cấp 4) */
	$config['product']['san-pham']['title_main_capbon']="Sản phẩm cấp 4";
	$config['product']['san-pham']['images_capbon']=true;
	$config['product']['san-pham']['show_images_capbon']=true;
	$config['product']['san-pham']['mota_capbon']=true;
	$config['product']['san-pham']['mota_cke_capbon']=true;
	$config['product']['san-pham']['noidung_capbon']=true;
	$config['product']['san-pham']['noidung_cke_capbon']=true;
	$config['product']['san-pham']['seo_capbon']=true;
	$config['product']['san-pham']['width_capbon']=500;
	$config['product']['san-pham']['height_capbon']=500;
	$config['product']['san-pham']['thumb_width_capbon']=250;
	$config['product']['san-pham']['thumb_height_capbon']=150;
	$config['product']['san-pham']['thumb_ratio_capbon']=3;
	$config['product']['san-pham']['img_type_capbon']='.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

	/* Sản phẩm (Nhãn hiệu) */
	$config['product']['san-pham']['title_main_nhanhieu']="Nhãn hiệu sản phẩm";
	$config['product']['san-pham']['images_nhanhieu']=true;
	$config['product']['san-pham']['show_images_nhanhieu']=true;
	$config['product']['san-pham']['mota_nhanhieu']=true;
	$config['product']['san-pham']['mota_cke_nhanhieu']=true;
	$config['product']['san-pham']['noidung_nhanhieu']=true;
	$config['product']['san-pham']['noidung_cke_nhanhieu']=true;
	$config['product']['san-pham']['seo_nhanhieu']=true;
	$config['product']['san-pham']['width_nhanhieu']=500;
	$config['product']['san-pham']['height_nhanhieu']=500;
	$config['product']['san-pham']['thumb_width_nhanhieu']=250;
	$config['product']['san-pham']['thumb_height_nhanhieu']=150;
	$config['product']['san-pham']['thumb_ratio_nhanhieu']=3;
	$config['product']['san-pham']['img_type_nhanhieu']='.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

	/* Sản phẩm */
	$config['tags_list']['san-pham']['title_main']="tags sản phẩm";
	$config['tags_list']['san-pham']['table']="product";
	$config['tags_list']['san-pham']['images']=true;
	$config['tags_list']['san-pham']['show_images']=true;
	$config['tags_list']['san-pham']['check']=array("noibat"=>"Nổi bật");
	$config['tags_list']['san-pham']['mota']=true;
	$config['tags_list']['san-pham']['mota_cke']=true;
	$config['tags_list']['san-pham']['noidung']=true;
	$config['tags_list']['san-pham']['noidung_cke']=true;
	$config['tags_list']['san-pham']['seo']=true;
	$config['tags_list']['san-pham']['width']=500;
	$config['tags_list']['san-pham']['height']=500;
	$config['tags_list']['san-pham']['thumb_width']=250;
	$config['tags_list']['san-pham']['thumb_height']=150;
	$config['tags_list']['san-pham']['thumb_ratio']=3;
	$config['tags_list']['san-pham']['img_type']='.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

	/* Tin tức */
	$config['tags_list']['tin-tuc']['title_main']="tags Tin tức";
	$config['tags_list']['tin-tuc']['table']="news";
	$config['tags_list']['tin-tuc']['images']=true;
	$config['tags_list']['tin-tuc']['check']=array("noibat"=>"Nổi bật");
	$config['tags_list']['tin-tuc']['mota']=true;
	$config['tags_list']['tin-tuc']['mota_cke']=true;
	$config['tags_list']['tin-tuc']['noidung']=true;
	$config['tags_list']['tin-tuc']['noidung_cke']=true;
	$config['tags_list']['tin-tuc']['seo']=true;
	$config['tags_list']['tin-tuc']['width']=500;
	$config['tags_list']['tin-tuc']['height']=500;
	$config['tags_list']['tin-tuc']['thumb_width']=250;
	$config['tags_list']['tin-tuc']['thumb_height']=150;
	$config['tags_list']['tin-tuc']['thumb_ratio']=3;
	$config['tags_list']['tin-tuc']['img_type']='.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

	/* Đăng Ký Nhận Tin */
	$config['email_dk']['dangkynhantin']['title_main']="Đăng ký nhận tin";
	$config['email_dk']['dangkynhantin']['email']=true;
	$config['email_dk']['dangkynhantin']['guiemail']=true;
	$config['email_dk']['dangkynhantin']['tinhtrang']=array("1"=>"Đã xem", "2"=>"Đã liên hệ", "3"=>"Đã thông báo");
	$config['email_dk']['dangkynhantin']['showngaytao']=true;
	$config['email_dk']['dangkynhantin']['file_type']='doc|docx|pdf|rar|zip|ppt|pptx|DOC|DOCX|PDF|RAR|ZIP|PPT|PPTX|xls|jpg|png|gif|JPG|PNG|GIF|xls|XLS';

	/* Đăng Ký báo giá */
	$config['email_dk']['dangkybaogia']['title_main']="Đăng ký báo giá";
	$config['email_dk']['dangkybaogia']['email']=true;
	$config['email_dk']['dangkybaogia']['guiemail']=true;
	$config['email_dk']['dangkybaogia']['file']=true;
	$config['email_dk']['dangkybaogia']['tinhtrang']=array("1"=>"Đã xem", "2"=>"Đã liên hệ", "3"=>"Đã thông báo");
	$config['email_dk']['dangkybaogia']['showtieude']=true;
	$config['email_dk']['dangkybaogia']['showngaytao']=true;
	$config['email_dk']['dangkybaogia']['file_type']='doc|docx|pdf|rar|zip|ppt|pptx|DOC|DOCX|PDF|RAR|ZIP|PPT|PPTX|xls|jpg|png|gif|JPG|PNG|GIF|xls|XLS';

	/* Thư viện ảnh */
	$config['album']['thu-vien-anh']['title_main']="Album";
	$config['album']['thu-vien-anh']['images']=true;
	$config['album']['thu-vien-anh']['show_images']=true;
	$config['album']['thu-vien-anh']['check']=array("noibat"=>"Nổi bật");
	$config['album']['thu-vien-anh']['mota']=true;
	$config['album']['thu-vien-anh']['mota_cke']=true;
	$config['album']['thu-vien-anh']['noidung']=true;
	$config['album']['thu-vien-anh']['noidung_cke']=true;
	$config['album']['thu-vien-anh']['seo']=true;
	$config['album']['thu-vien-anh']['width']=500;
	$config['album']['thu-vien-anh']['height']=500;
	$config['album']['thu-vien-anh']['thumb_width']=250;
	$config['album']['thu-vien-anh']['thumb_height']=150;
	$config['album']['thu-vien-anh']['thumb_ratio']=3;
	$config['album']['thu-vien-anh']['img_type']='.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

	/* Thư viện ảnh (Photo) */
	$config['album']['thu-vien-anh']['title_main_photo']="Hình ảnh album";
	$config['album']['thu-vien-anh']['images_photo']=true;
	$config['album']['thu-vien-anh']['avatar_photo']=true;
	$config['album']['thu-vien-anh']['mausac_photo']=true;
	$config['album']['thu-vien-anh']['mota_photo']=true;
	$config['album']['thu-vien-anh']['mota_cke_photo']=true;
	$config['album']['thu-vien-anh']['tieude_photo']=true;
	$config['album']['thu-vien-anh']['noidung_photo']=true;
	$config['album']['thu-vien-anh']['noidung_cke_photo']=true;
	$config['album']['thu-vien-anh']['width_photo']=500;
	$config['album']['thu-vien-anh']['height_photo']=500;
	$config['album']['thu-vien-anh']['thumb_width_photo']=250;
	$config['album']['thu-vien-anh']['thumb_height_photo']=150;
	$config['album']['thu-vien-anh']['thumb_ratio_photo']=3;
	$config['album']['thu-vien-anh']['img_type_photo']='.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

	/* Tập tin */
	$config['download']['taptin']['title_main']="Tập tin";
	$config['download']['taptin']['images']=true;
	$config['download']['taptin']['show_images']=true;
	$config['download']['taptin']['check']=array("noibat"=>"Nổi bật");
	$config['download']['taptin']['mota']=true;
	$config['download']['taptin']['mota_cke']=true;
	$config['download']['taptin']['noidung']=true;
	$config['download']['taptin']['noidung_cke']=true;
	$config['download']['taptin']['seo']=true;
	$config['download']['taptin']['width']=500;
	$config['download']['taptin']['height']=500;
	$config['download']['taptin']['thumb_width']=250;
	$config['download']['taptin']['thumb_height']=150;
	$config['download']['taptin']['thumb_ratio']=3;
	$config['download']['taptin']['img_type']='.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';
	$config['download']['taptin']['file_type']='doc|docx|pdf|rar|zip|ppt|pptx|DOC|DOCX|PDF|RAR|ZIP|PPT|PPTX|xls|jpg|png|gif|JPG|PNG|GIF|xls|XLS';

	/* Link */
	$config['lienket']['link']['title_main']="Liên kết nhanh";
	$config['lienket']['link']['images']=true;
	$config['lienket']['link']['show_images']=true;
	$config['lienket']['link']['check']=array("noibat"=>"Nổi bật");
	$config['lienket']['link']['tieude']=true;
	$config['lienket']['link']['mota']=true;
	$config['lienket']['link']['mota_cke']=true;
	$config['lienket']['link']['noidung']=true;
	$config['lienket']['link']['noidung_cke']=true;
	$config['lienket']['link']['seo']=true;
	$config['lienket']['link']['width']=500;
	$config['lienket']['link']['height']=500;
	$config['lienket']['link']['thumb_width']=250;
	$config['lienket']['link']['thumb_height']=150;
	$config['lienket']['link']['thumb_ratio']=3;
	$config['lienket']['link']['img_type']='.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

	/* Tin tức */
	$config['news']['tin-tuc']['title_main']="Tin tức";
	$config['news']['tin-tuc']['dropdown']=true;
	$config['news']['tin-tuc']['list']=true;
	$config['news']['tin-tuc']['cat']=true;
	$config['news']['tin-tuc']['item']=true;
	$config['news']['tin-tuc']['tag_list']=true;
	$config['news']['tin-tuc']['check']=array("noibat"=>"Nổi bật");
	$config['news']['tin-tuc']['images']=true;
	$config['news']['tin-tuc']['show_images']=true;
	$config['news']['tin-tuc']['mausac']=true;
	$config['news']['tin-tuc']['file']=true;
	$config['news']['tin-tuc']['video']=true;
	$config['news']['tin-tuc']['multipic']=true;
	$config['news']['tin-tuc']['multipic_arr']=array
	(
		"tin-tuc"=>array
			(
            	"title_main_photo" => "Hình ảnh tin tức",
            	"title_sub_photo" => "Hình ảnh",
            	"images_photo" => true,
            	"avatar_photo" => true,
            	"mausac_photo" => false,
            	"video_photo" => false,
            	"link_photo" => false,
            	"mota_photo" => false,
            	"mota_cke_photo" => false,
            	"tieude_photo" => false,
            	"noidung_photo" => false,
            	"noidung_cke_photo" => false,
            	"width_photo" => 500,
            	"height_photo" => 500,
            	"thumb_width_photo" => 500,
            	"thumb_height_photo" => 500,
            	"thumb_ratio_photo" => 1,
            	"img_type_photo" => '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF'
         	),
		"video"=>array
			(
            	"title_main_photo" => "Video tin tức",
            	"title_sub_photo" => "Video",
            	"images_photo" => false,
            	"avatar_photo" => false,
            	"mausac_photo" => false,
            	"video_photo" => true,
            	"link_photo" => true,
            	"mota_photo" => false,
            	"mota_cke_photo" => false,
            	"tieude_photo" => true,
            	"noidung_photo" => false,
            	"noidung_cke_photo" => false,
            	"width_photo" => 500,
            	"height_photo" => 500,
            	"thumb_width_photo" => 500,
            	"thumb_height_photo" => 500,
            	"thumb_ratio_photo" => 1,
            	"img_type_photo" => '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF'
         	),
		"taptin"=>array
			(
            	"title_main_photo" => "Tập tin tin tức",
            	"title_sub_photo" => "Tập tin",
            	"images_photo" => false,
            	"file_photo" => true,
            	"avatar_photo" => false,
            	"mausac_photo" => false,
            	"video_photo" => false,
            	"link_photo" => false,
            	"mota_photo" => false,
            	"mota_cke_photo" => false,
            	"tieude_photo" => true,
            	"noidung_photo" => false,
            	"noidung_cke_photo" => false,
            	"width_photo" => 500,
            	"height_photo" => 500,
            	"thumb_width_photo" => 500,
            	"thumb_height_photo" => 500,
            	"thumb_ratio_photo" => 1,
            	"img_type_photo" => '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF',
            	"file_type_photo" => 'doc|docx|pdf|rar|zip|ppt|pptx|DOC|DOCX|PDF|RAR|ZIP|PPT|PPTX|xls|jpg|png|gif|JPG|PNG|GIF|xls|XLS'
         	)
	);
	$config['news']['tin-tuc']['mota']=true;
	$config['news']['tin-tuc']['mota_cke']=true;
	$config['news']['tin-tuc']['noidung']=true;
	$config['news']['tin-tuc']['noidung_cke']=true;
	$config['news']['tin-tuc']['seo']=true;
	$config['news']['tin-tuc']['width']=500;
	$config['news']['tin-tuc']['height']=500;
	$config['news']['tin-tuc']['thumb_width']=150;
	$config['news']['tin-tuc']['thumb_height']=110;
	$config['news']['tin-tuc']['thumb_ratio']=1;
	$config['news']['tin-tuc']['img_type']='.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';
	$config['news']['tin-tuc']['file_type']='doc|docx|pdf|rar|zip|ppt|pptx|DOC|DOCX|PDF|RAR|ZIP|PPT|PPTX|xls|jpg|png|gif|JPG|PNG|GIF|xls|XLS';

	/* Tin tức (List) */
	$config['news']['tin-tuc']['title_main_list']="Tin tức cấp 1";
	$config['news']['tin-tuc']['images_list']=true;
	$config['news']['tin-tuc']['show_images_list']=true;
	$config['news']['tin-tuc']['multipic_list']=true;
	$config['news']['tin-tuc']['multipic_list_arr']=array
	(
		"tin-tuc"=>array
			(
            	"title_main_photo" => "Hình ảnh sản phẩm cấp 1",
            	"title_sub_photo" => "Hình ảnh",
            	"images_photo" => true,
            	"avatar_photo" => true,
            	"width_photo" => 270,
            	"height_photo" => 590,
            	"thumb_width_photo" => 270,
            	"thumb_height_photo" => 590,
            	"thumb_ratio_photo" => 1,
            	"img_type_photo" => '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF'
         	),
		"video"=>array
			(
            	"title_main_photo" => "Video sản phẩm cấp 1",
            	"title_sub_photo" => "Video",
            	"video_photo" => true,
            	"link_photo" => true,
            	"tieude_photo" => true,
            	"width_photo" => 500,
            	"height_photo" => 500,
            	"thumb_width_photo" => 500,
            	"thumb_height_photo" => 500,
            	"thumb_ratio_photo" => 1,
            	"img_type_photo" => '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF'
         	)
	);
	$config['news']['tin-tuc']['mota_list']=true;
	$config['news']['tin-tuc']['mota_cke_list']=true;
	$config['news']['tin-tuc']['noidung_list']=true;
	$config['news']['tin-tuc']['noidung_cke_list']=true;
	$config['news']['tin-tuc']['mausac_list']=true;
	$config['news']['tin-tuc']['check_list']=array("noibat"=>"Nổi bật");
	$config['news']['tin-tuc']['seo_list']=true;
	$config['news']['tin-tuc']['width_list']=500;
	$config['news']['tin-tuc']['height_list']=500;
	$config['news']['tin-tuc']['thumb_width_list']=250;
	$config['news']['tin-tuc']['thumb_height_list']=150;
	$config['news']['tin-tuc']['thumb_ratio_list']=3;
	$config['news']['tin-tuc']['img_type_list']='.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

	/* Tin tức (Cat) */
	$config['news']['tin-tuc']['title_main_cat']="Tin tức cấp 2";
	$config['news']['tin-tuc']['images_cat']=true;
	$config['news']['tin-tuc']['show_images_cat']=true;
	$config['news']['tin-tuc']['mota_cat']=true;
	$config['news']['tin-tuc']['mota_cke_cat']=true;
	$config['news']['tin-tuc']['noidung_cat']=true;
	$config['news']['tin-tuc']['noidung_cke_cat']=true;
	$config['news']['tin-tuc']['check_cat']=array("noibat"=>"Nổi bật");
	$config['news']['tin-tuc']['seo_cat']=true;
	$config['news']['tin-tuc']['width_cat']=500;
	$config['news']['tin-tuc']['height_cat']=500;
	$config['news']['tin-tuc']['thumb_width_cat']=250;
	$config['news']['tin-tuc']['thumb_height_cat']=150;
	$config['news']['tin-tuc']['thumb_ratio_cat']=3;
	$config['news']['tin-tuc']['img_type_cat']='.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

	/* Tin tức (Item) */
	$config['news']['tin-tuc']['title_main_item']="Tin tức cấp 3";
	$config['news']['tin-tuc']['images_item']=true;
	$config['news']['tin-tuc']['show_images_item']=true;
	$config['news']['tin-tuc']['mota_item']=true;
	$config['news']['tin-tuc']['mota_cke_item']=true;
	$config['news']['tin-tuc']['noidung_item']=true;
	$config['news']['tin-tuc']['noidung_cke_item']=true;
	$config['news']['tin-tuc']['seo_item']=true;
	$config['news']['tin-tuc']['width_item']=500;
	$config['news']['tin-tuc']['height_item']=500;
	$config['news']['tin-tuc']['thumb_width_item']=250;
	$config['news']['tin-tuc']['thumb_height_item']=150;
	$config['news']['tin-tuc']['thumb_ratio_item']=3;
	$config['news']['tin-tuc']['img_type_item']='.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

	/* Dịch vụ */
	$config['news']['dich-vu']['title_main']="Dịch vụ";
	$config['news']['dich-vu']['dropdown']=false;
	$config['news']['dich-vu']['check']=array();
	$config['news']['dich-vu']['multipic_arr']=array();
	$config['news']['dich-vu']['images']=true;
	$config['news']['dich-vu']['mota']=true;
	$config['news']['dich-vu']['noidung']=true;
	$config['news']['dich-vu']['noidung_cke']=true;
	$config['news']['dich-vu']['seo']=true;
	$config['news']['dich-vu']['width']=400;
	$config['news']['dich-vu']['height']=350;
	$config['news']['dich-vu']['thumb_width']=150;
	$config['news']['dich-vu']['thumb_height']=110;
	$config['news']['dich-vu']['thumb_ratio']=1;
	$config['news']['dich-vu']['img_type']='.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

	/* Tuyển dụng */
	$config['news']['tuyen-dung']['title_main']="Tuyển dụng";
	$config['news']['tuyen-dung']['dropdown']=false;
	$config['news']['tuyen-dung']['check']=array();
	$config['news']['tuyen-dung']['multipic_arr']=array();
	$config['news']['tuyen-dung']['images']=true;
	$config['news']['tuyen-dung']['mota']=true;
	$config['news']['tuyen-dung']['noidung']=true;
	$config['news']['tuyen-dung']['noidung_cke']=true;
	$config['news']['tuyen-dung']['seo']=true;
	$config['news']['tuyen-dung']['width']=400;
	$config['news']['tuyen-dung']['height']=350;
	$config['news']['tuyen-dung']['thumb_width']=150;
	$config['news']['tuyen-dung']['thumb_height']=110;
	$config['news']['tuyen-dung']['thumb_ratio']=1;
	$config['news']['tuyen-dung']['img_type']='.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

	/* Chính sách */
	$config['news']['chinh-sach']['title_main']="Chính sách";
	$config['news']['chinh-sach']['check']=array();
	$config['news']['chinh-sach']['noidung']=true;
	$config['news']['chinh-sach']['noidung_cke']=true;
	$config['news']['chinh-sach']['seo']=true;

	/* Giới thiệu */
	$config['news_static']['gioi-thieu']['title_main']="Giới thiệu";
	$config['news_static']['gioi-thieu']['images']=true;
	$config['news_static']['gioi-thieu']['multipic']=true;
	$config['news_static']['gioi-thieu']['video']=true;
	$config['news_static']['gioi-thieu']['tieude']=true;
	$config['news_static']['gioi-thieu']['mota']=false;
	$config['news_static']['gioi-thieu']['mota_cke']=false;
	$config['news_static']['gioi-thieu']['noidung']=true;
	$config['news_static']['gioi-thieu']['noidung_cke']=true;
	$config['news_static']['gioi-thieu']['seo']=true;
	$config['news_static']['gioi-thieu']['width']=500;
	$config['news_static']['gioi-thieu']['height']=500;
	$config['news_static']['gioi-thieu']['thumb_width']=250;
	$config['news_static']['gioi-thieu']['thumb_height']=250;
	$config['news_static']['gioi-thieu']['thumb_ratio']=1;
	$config['news_static']['gioi-thieu']['img_type']='.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

	/* Giới thiệu (Photo) */
	$config['news_static']['gioi-thieu']['title_main_photo']="Hình ảnh giới thiệu";
	$config['news_static']['gioi-thieu']['images_photo']=true;
	$config['news_static']['gioi-thieu']['avatar_photo']=true;
	$config['news_static']['gioi-thieu']['mausac_photo']=true;
	$config['news_static']['gioi-thieu']['tieude_photo']=true;
	$config['news_static']['gioi-thieu']['mota_photo']=true;
	$config['news_static']['gioi-thieu']['mota_cke_photo']=false;
	$config['news_static']['gioi-thieu']['noidung_photo']=true;
	$config['news_static']['gioi-thieu']['noidung_cke_photo']=false;
	$config['news_static']['gioi-thieu']['width_photo']=500;
	$config['news_static']['gioi-thieu']['height_photo']=500;
	$config['news_static']['gioi-thieu']['thumb_width_photo']=250;
	$config['news_static']['gioi-thieu']['thumb_height_photo']=150;
	$config['news_static']['gioi-thieu']['thumb_ratio_photo']=3;
	$config['news_static']['gioi-thieu']['img_type_photo']='.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

	/* Liên hệ */
	$config['news_static']['lienhe']['title_main']="Liên hệ";
	$config['news_static']['lienhe']['noidung']=true;
	$config['news_static']['lienhe']['noidung_cke']=true;
	$config['news_static']['lienhe']['seo']=true;

	/* Footer */
	$config['news_static']['footer']['title_main']="Footer";
	$config['news_static']['footer']['noidung']=true;
	$config['news_static']['footer']['noidung_cke']=true;

	/* Footer form */
	$config['news_static']['footer_form']['title_main']="Footer form";
	$config['news_static']['footer_form']['tieude']=true;
	$config['news_static']['footer_form']['noidung']=true;
	$config['news_static']['footer_form']['noidung_cke']=true;

	/* Background */
	$config['photo']['photo_background']['background']['title_main']="Background";
	$config['photo']['photo_background']['background']['mausac']=true;
	$config['photo']['photo_background']['background']['background']=true;
	$config['photo']['photo_background']['background']['img_type']='.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

	/* Banner */
	$config['photo']['photo_static']['banner']['title_main']="Banner";
	$config['photo']['photo_static']['banner']['images']=true;
	$config['photo']['photo_static']['banner']['flash']=false;
	$config['photo']['photo_static']['banner']['link']=false;
	$config['photo']['photo_static']['banner']['width']=1366;
	$config['photo']['photo_static']['banner']['height']=155;
	$config['photo']['photo_static']['banner']['thumb_width']=1366;
	$config['photo']['photo_static']['banner']['thumb_height']=150;
	$config['photo']['photo_static']['banner']['thumb_ratio']=3;
	$config['photo']['photo_static']['banner']['img_type']='.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

	/* Logo */
	$config['photo']['photo_static']['logo']['title_main']="Logo";
	$config['photo']['photo_static']['logo']['images']=true;
	$config['photo']['photo_static']['logo']['width']=130;
	$config['photo']['photo_static']['logo']['height']=110;
	$config['photo']['photo_static']['logo']['thumb_width']=130;
	$config['photo']['photo_static']['logo']['thumb_height']=110;
	$config['photo']['photo_static']['logo']['thumb_ratio']=3;
	$config['photo']['photo_static']['logo']['img_type']='.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

	/* Logo form */
	$config['photo']['photo_static']['logo_form']['title_main']="Logo form";
	$config['photo']['photo_static']['logo_form']['images']=true;
	$config['photo']['photo_static']['logo_form']['width']=130;
	$config['photo']['photo_static']['logo_form']['height']=110;
	$config['photo']['photo_static']['logo_form']['thumb_width']=130;
	$config['photo']['photo_static']['logo_form']['thumb_height']=110;
	$config['photo']['photo_static']['logo_form']['thumb_ratio']=1;
	$config['photo']['photo_static']['logo_form']['img_type']='.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

	/* Watermark */
	$config['photo']['photo_static']['watermark']['title_main']="Watermark";
	$config['photo']['photo_static']['watermark']['images']=true;
	$config['photo']['photo_static']['watermark']['width']=160;
	$config['photo']['photo_static']['watermark']['height']=30;
	$config['photo']['photo_static']['watermark']['thumb_width']=160;
	$config['photo']['photo_static']['watermark']['thumb_height']=30;
	$config['photo']['photo_static']['watermark']['thumb_ratio']=2;
	$config['photo']['photo_static']['watermark']['img_type']='.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

	/* Watermark chi tiết */
	$config['photo']['photo_static']['watermark-chitiet']['title_main']="Watermark chi tiết";
	$config['photo']['photo_static']['watermark-chitiet']['images']=true;
	$config['photo']['photo_static']['watermark-chitiet']['width']=160;
	$config['photo']['photo_static']['watermark-chitiet']['height']=30;
	$config['photo']['photo_static']['watermark-chitiet']['thumb_width']=160;
	$config['photo']['photo_static']['watermark-chitiet']['thumb_height']=30;
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

	/* Bộ công thương */
	$config['photo']['photo_static']['bct']['title_main']="Bộ công thương";
	$config['photo']['photo_static']['bct']['images']=true;
	$config['photo']['photo_static']['bct']['link']=true;
	$config['photo']['photo_static']['bct']['width']=135;
	$config['photo']['photo_static']['bct']['height']=45;
	$config['photo']['photo_static']['bct']['thumb_width']=135;
	$config['photo']['photo_static']['bct']['thumb_height']=45;
	$config['photo']['photo_static']['bct']['thumb_ratio']=3;
	$config['photo']['photo_static']['bct']['img_type']='.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

	/* Popup */
	$config['photo']['photo_static']['popup']['title_main']="Popup";
	$config['photo']['photo_static']['popup']['images']=true;
	$config['photo']['photo_static']['popup']['width']=500;
	$config['photo']['photo_static']['popup']['height']=350;
	$config['photo']['photo_static']['popup']['thumb_width']=500;
	$config['photo']['photo_static']['popup']['thumb_height']=350;
	$config['photo']['photo_static']['popup']['thumb_ratio']=1;
	$config['photo']['photo_static']['popup']['img_type']='.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

	/* Quảng cáo */
	$config['photo']['photo_static']['quangcao']['title_main']="Quảng cáo";
	$config['photo']['photo_static']['quangcao']['images']=true;
	$config['photo']['photo_static']['quangcao']['video']=true;
	$config['photo']['photo_static']['quangcao']['tieude']=true;
	$config['photo']['photo_static']['quangcao']['mota']=true;
	$config['photo']['photo_static']['quangcao']['mota_cke']=true;
	$config['photo']['photo_static']['quangcao']['noidung']=true;
	$config['photo']['photo_static']['quangcao']['noidung_cke']=true;
	$config['photo']['photo_static']['quangcao']['width']=25;
	$config['photo']['photo_static']['quangcao']['height']=25;
	$config['photo']['photo_static']['quangcao']['thumb_width']=25;
	$config['photo']['photo_static']['quangcao']['thumb_height']=25;
	$config['photo']['photo_static']['quangcao']['thumb_ratio']=3;
	$config['photo']['photo_static']['quangcao']['img_type']='.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

	/* Slide */
	$config['photo']['man_photo']['slide']['title_main_photo']="Slideshow";
	$config['photo']['man_photo']['slide']['check_photo']=array();
	$config['photo']['man_photo']['slide']['images_photo']=true;
	$config['photo']['man_photo']['slide']['avatar_photo']=true;
	$config['photo']['man_photo']['slide']['mausac_photo']=false;
	$config['photo']['man_photo']['slide']['link_photo']=true;
	$config['photo']['man_photo']['slide']['video_photo']=false;
	$config['photo']['man_photo']['slide']['tieude_photo']=false;
	$config['photo']['man_photo']['slide']['mota_photo']=false;
	$config['photo']['man_photo']['slide']['mota_cke_photo']=false;
	$config['photo']['man_photo']['slide']['noidung_photo']=false;
	$config['photo']['man_photo']['slide']['noidung_cke_photo']=false;
	$config['photo']['man_photo']['slide']['width_photo']=1366;
	$config['photo']['man_photo']['slide']['height_photo']=470;
	$config['photo']['man_photo']['slide']['thumb_width_photo']=250;
	$config['photo']['man_photo']['slide']['thumb_height_photo']=150;
	$config['photo']['man_photo']['slide']['thumb_ratio_photo']=3;
	$config['photo']['man_photo']['slide']['img_type_photo']='.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

	/* Mạng xã hội */
	$config['photo']['man_photo']['mangxahoi']['title_main_photo']="Mạng xã hội";
	$config['photo']['man_photo']['mangxahoi']['check_photo']=array();
	$config['photo']['man_photo']['mangxahoi']['images_photo']=true;
	$config['photo']['man_photo']['mangxahoi']['avatar_photo']=true;
	$config['photo']['man_photo']['mangxahoi']['mausac_photo']=false;
	$config['photo']['man_photo']['mangxahoi']['link_photo']=true;
	$config['photo']['man_photo']['mangxahoi']['video_photo']=false;
	$config['photo']['man_photo']['mangxahoi']['tieude_photo']=false;
	$config['photo']['man_photo']['mangxahoi']['mota_photo']=false;
	$config['photo']['man_photo']['mangxahoi']['mota_cke_photo']=false;
	$config['photo']['man_photo']['mangxahoi']['noidung_photo']=false;
	$config['photo']['man_photo']['mangxahoi']['noidung_cke_photo']=false;
	$config['photo']['man_photo']['mangxahoi']['width_photo']=35;
	$config['photo']['man_photo']['mangxahoi']['height_photo']=35;
	$config['photo']['man_photo']['mangxahoi']['thumb_width_photo']=35;
	$config['photo']['man_photo']['mangxahoi']['thumb_height_photo']=35;
	$config['photo']['man_photo']['mangxahoi']['thumb_ratio_photo']=3;
	$config['photo']['man_photo']['mangxahoi']['img_type_photo']='.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

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
	$config['photo']['man_photo']['video']['check_photo']=array("noibat"=>"Nổi bật");
	$config['photo']['man_photo']['video']['images_photo']=false;
	$config['photo']['man_photo']['video']['avatar_photo']=false;
	$config['photo']['man_photo']['video']['mausac_photo']=false;
	$config['photo']['man_photo']['video']['link_photo']=false;
	$config['photo']['man_photo']['video']['video_photo']=true;
	$config['photo']['man_photo']['video']['tieude_photo']=true;
	$config['photo']['man_photo']['video']['mota_photo']=false;
	$config['photo']['man_photo']['video']['mota_cke_photo']=false;
	$config['photo']['man_photo']['video']['noidung_photo']=false;
	$config['photo']['man_photo']['video']['noidung_cke_photo']=false;
	$config['photo']['man_photo']['video']['width_photo']=500;
	$config['photo']['man_photo']['video']['height_photo']=500;
	$config['photo']['man_photo']['video']['thumb_width_photo']=250;
	$config['photo']['man_photo']['video']['thumb_height_photo']=150;
	$config['photo']['man_photo']['video']['thumb_ratio_photo']=3;
	$config['photo']['man_photo']['video']['img_type_photo']='.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

	/* Đối tác */
	$config['photo']['man_photo']['doitac']['title_main_photo']="Đối tác";
	$config['photo']['man_photo']['doitac']['check_photo']=array();
	$config['photo']['man_photo']['doitac']['images_photo']=true;
	$config['photo']['man_photo']['doitac']['avatar_photo']=true;
	$config['photo']['man_photo']['doitac']['mausac_photo']=false;
	$config['photo']['man_photo']['doitac']['link_photo']=true;
	$config['photo']['man_photo']['doitac']['video_photo']=false;
	$config['photo']['man_photo']['doitac']['tieude_photo']=false;
	$config['photo']['man_photo']['doitac']['mota_photo']=false;
	$config['photo']['man_photo']['doitac']['mota_cke_photo']=false;
	$config['photo']['man_photo']['doitac']['noidung_photo']=false;
	$config['photo']['man_photo']['doitac']['noidung_cke_photo']=false;
	$config['photo']['man_photo']['doitac']['width_photo']=130;
	$config['photo']['man_photo']['doitac']['height_photo']=90;
	$config['photo']['man_photo']['doitac']['thumb_width_photo']=130;
	$config['photo']['man_photo']['doitac']['thumb_height_photo']=90;
	$config['photo']['man_photo']['doitac']['thumb_ratio_photo']=2;
	$config['photo']['man_photo']['doitac']['img_type_photo']='.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

	/* Setting */
	$config['setting']['vchat']=true;
	$config['setting']['diachi']=true;
	$config['setting']['dienthoai']=true;
	$config['setting']['fax']=true;
	$config['setting']['slogan']=true;
	$config['setting']['hotline']=true;
	$config['setting']['zalo']=true;
	$config['setting']['oaidzalo']=true;
	$config['setting']['skype']=true;
	$config['setting']['facebook']=true;
	$config['setting']['youtube']=true;
	$config['setting']['twitter']=true;
	$config['setting']['pinterest']=true;
	$config['setting']['viber']=true;
	$config['setting']['email']=true;
	$config['setting']['website']=true;
	$config['setting']['fb_facebook']=true;
	$config['setting']['fb_google']=true;
	$config['setting']['map']=true;
	$config['setting']['map_iframe']=true;
	$config['setting']['copyright']=true;
	$config['setting']['mota']=true;
	$config['setting']['mota_cke']=true;
	$config['setting']['noidung']=true;
	$config['setting']['noidung_cke']=true;

	/* Tỉnh thành */
	$config['tinhthanh_quanhuyen']['title_main']='Tỉnh thành';
	$config['tinhthanh_quanhuyen']['title_sub']='Chi nhánh';
	$config['tinhthanh_quanhuyen']['list']=true;
	$config['tinhthanh_quanhuyen']['cat']=true;
	$config['tinhthanh_quanhuyen']['item']=true;
	$config['tinhthanh_quanhuyen']['man']=true;
	$config['tinhthanh_quanhuyen']['giaship']=true;
	$config['tinhthanh_quanhuyen']['check']=array("noibat"=>"Nổi bật");
	$config['tinhthanh_quanhuyen']['dienthoai']=true;
	$config['tinhthanh_quanhuyen']['phanloai']=true;
	$config['tinhthanh_quanhuyen']['images']=true;
	$config['tinhthanh_quanhuyen']['map']=true;
	$config['tinhthanh_quanhuyen']['map_iframe']=true;
	$config['tinhthanh_quanhuyen']['mota']=true;
	$config['tinhthanh_quanhuyen']['mota_cke']=true;
	$config['tinhthanh_quanhuyen']['noidung']=true;
	$config['tinhthanh_quanhuyen']['noidung_cke']=true;
	$config['tinhthanh_quanhuyen']['width']=500;
	$config['tinhthanh_quanhuyen']['height']=500;
	$config['tinhthanh_quanhuyen']['thumb_width']=250;
	$config['tinhthanh_quanhuyen']['thumb_height']=150;
	$config['tinhthanh_quanhuyen']['thumb_ratio']=3;
	$config['tinhthanh_quanhuyen']['img_type']='.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

	/* Hổ trợ trực tuyến */
	$config['yahoo']['email']=true;
	$config['yahoo']['images']=true;
	$config['yahoo']['check']=array("noibat"=>"Nổi bật");
	$config['yahoo']['dienthoai']=true;
	$config['yahoo']['skype']=true;
	$config['yahoo']['zalo']=true;
	$config['yahoo']['viber']=true;
	$config['yahoo']['map_iframe']=true;
	$config['yahoo']['width']=500;
	$config['yahoo']['height']=500;
	$config['yahoo']['thumb_width']=250;
	$config['yahoo']['thumb_height']=150;
	$config['yahoo']['thumb_ratio']=3;
	$config['yahoo']['img_type']='.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

	/* Bản đồ */
	$config['map']['email']=true;
	$config['map']['images']=true;
	$config['map']['dienthoai']=true;
	$config['map']['width']=500;
	$config['map']['height']=500;
	$config['map']['thumb_width']=250;
	$config['map']['thumb_height']=150;
	$config['map']['thumb_ratio']=3;
	$config['map']['img_type']='.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

	/* Quản lý tài khoản */
	$config_user=true;
	$config_user_admin=true;
	$config_user_khach=true;

	/* Quản lý Phân quyền */
	$config_phanquyen=true;

	/* Quản lý giỏ hàng */
	$order=true;
	$phiship=true;
	$phicoupon=true;
	$export_ex=true;
	$export_wo=true;

	/* Quản lý mã ưu đãi */
	$coupon=true;

	/* Quản lý bình luận */
	$binhluan=true;

	/* Quản lý bài viết (Không cấp) */
	if(count($config['news'])) {
		foreach ($config['news'] as $key => $value) {
			if($value['dropdown']==false) { 
				$config_showpagenews=1; break; }
		}
	}

	/* Quản lý sản phẩm (Không cấp) */
	if(count($config['product'])) {
		foreach ($config['product'] as $key => $value) {
			if($value['dropdown']==false) { 
				$config_showpagepro=1; break; }
		}
	}
?>