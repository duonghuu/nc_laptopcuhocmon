jQuery(document).ready(function(){
	jQuery("#gallery").unitegallery({
		//theme options:
		theme_enable_preloader: true,		//enable preloader circle
		theme_preloading_height: 200,		//the height of the preloading div, it show before the gallery
		theme_preloader_vertpos: 100,		//the vertical position of the preloader
		theme_gallery_padding: 0,			//the horizontal padding of the gallery from the sides
		theme_auto_open:null,				//auto open lightbox at start - if some number gived, like 0
		
		//gallery options:
		gallery_theme: "tiles"				//choose gallery theme (if more then one themes includes)
		gallery_width:"100%",				//gallery width
		gallery_min_width: 150,				//gallery minimal width when resizing
		gallery_background_color: "",		//set custom background color. If not set it will be taken from css.
				
		//tiles options:
		tiles_type: "nested",					//must option for the tiles - justified type
		tiles_enable_transition: true,			//enable transition when screen width change
		tiles_space_between_cols: 3,			//space between images
		tiles_space_between_cols_mobile: 3,     //space between cols for mobile type
		tiles_nested_optimal_tile_width: 250,	// tiles optimal width
		tiles_min_columns: 2,					//min columns - for mobile size, for 1 column, type 1
			
			
		//tile design options:									
		tile_enable_border:false,			//enable border of the tile
		tile_border_width:3,				//tile border width
		tile_border_color:"#F0F0F0",		//tile border color
		tile_border_radius:0,				//tile border radius (applied to border only, not to outline)
		tile_enable_outline: false,			//enable outline of the tile (works only together with the border)
		tile_outline_color: "#8B8B8B",		//tile outline color
		tile_enable_shadow:true,			//enable shadow of the tile
		tile_shadow_h:1,					//position of horizontal shadow
		tile_shadow_v:1,					//position of vertical shadow
		tile_shadow_blur:3,					//shadow blur
		tile_shadow_spread:2,				//shadow spread
		tile_shadow_color:"#8B8B8B",		//shadow color
		tile_enable_action:	true,			//enable tile action on click like lightbox
		tile_as_link: false,				//act the tile as link, no lightbox will appear
		tile_link_newpage: true,			//open the tile link in new page
		tile_enable_overlay: true,			//enable tile color overlay (on mouseover)
		tile_overlay_opacity: 0.4,			//tile overlay opacity
		tile_overlay_color: "#000000",		//tile overlay color
		tile_enable_icons: true,			//enable icons in mouseover mode
		tile_show_link_icon: false,			//show link icon (if the tile has a link). In case of tile_as_link this option not enabled
		tile_space_between_icons: 26,		//initial space between icons, (on small tiles it may change)
		tile_enable_image_effect:false,		//enable tile image effect
		tile_image_effect_type: "bw",		//bw, blur, sepia - tile effect type
		tile_image_effect_reverse: false,	//reverce the image, set only on mouseover state
		
		//tile text panel options:
		tile_enable_textpanel: false,		 	//enable textpanel
		tile_textpanel_source: "title",		 	//title,desc,desc_title. source of the textpanel. desc_title - if description empty, put title
		tile_textpanel_always_on: false,	 	//textpanel always visible
		tile_textpanel_appear_type: "slide", 	//slide, fade - appear type of the textpanel on mouseover
		tile_textpanel_position:"inside_bottom", //inside_bottom, inside_top, inside_center, top, bottom the position of the textpanel
		tile_textpanel_offset:0,			    //vertical offset of the textpanel
		tile_textpanel_padding_top:8,		 	//textpanel padding top 
		tile_textpanel_padding_bottom:8,	 	//textpanel padding bottom
		tile_textpanel_padding_right: 11,	 	//cut some space for text from right
		tile_textpanel_padding_left: 11,	 	//cut some space for text from left
		tile_textpanel_bg_opacity: 0.4,		 	//textpanel background opacity
		tile_textpanel_bg_color:"#000000",	 	//textpanel background color
		tile_textpanel_bg_css:{},			 	//textpanel background css
		tile_textpanel_title_color:null,		 //textpanel title color. if null - take from css
		tile_textpanel_title_font_family:null,	 //textpanel title font family. if null - take from css
		tile_textpanel_title_text_align:null,	 //textpanel title text align. if null - take from css
		tile_textpanel_title_font_size:null,	 //textpanel title font size. if null - take from css
		tile_textpanel_title_bold:null,			 //textpanel title bold. if null - take from css
		tile_textpanel_css_title:{},			 //textpanel additional css of the title
		tile_textpanel_desc_color:null,			 //textpanel description font family. if null - take from css
		tile_textpanel_desc_font_family:null,	 //textpanel description font family. if null - take from css
		tile_textpanel_desc_text_align:null,	 //textpanel description text align. if null - take from css
		tile_textpanel_desc_font_size:null,		 //textpanel description font size. if null - take from css
		tile_textpanel_desc_bold:null,			 //textpanel description bold. if null - take from css
		tile_textpanel_css_description:{},		 //textpanel additional css of the description
		
		//lightbox options:
		lightbox_type: "wide",							//compact / wide - lightbox type			
		lightbox_hide_arrows_onvideoplay: true,			//hide the arrows when video start playing and show when stop
		lightbox_arrows_position: "sides",				//sides, inside: position of the arrows, used on compact type			
		lightbox_arrows_offset: 10,						//The horizontal offset of the arrows
		lightbox_arrows_inside_offset: 10,				//The offset from the image border if the arrows placed inside
		lightbox_arrows_inside_alwayson: false,			//Show the arrows on mouseover, or always on.
		lightbox_overlay_color:null,					//the color of the overlay. if null - will take from css
		lightbox_overlay_opacity:1,						//the opacity of the overlay. for compact type - 0.6
		lightbox_top_panel_opacity: null,				//the opacity of the top panel
		lightbox_close_on_emptyspace:true,				//close the lightbox on empty space
		lightbox_show_numbers: true,					//show numbers on the right side
		lightbox_numbers_size: null,					//the size of the numbers string
		lightbox_numbers_color: null,					//the color of the numbers
		lightbox_numbers_padding_top:null,				//the top padding of the numbers (used in compact mode)
		lightbox_numbers_padding_right:null,			//the right padding of the numbers (used in compact mode)
	    lightbox_slider_image_border: true,				//enable border around the image (for compact type only)
	    lightbox_slider_image_border_width: 10,			//image border width
	    lightbox_slider_image_border_color: "#ffffff",	//image border color
	    lightbox_slider_image_border_radius: 0,			//image border radius
	    lightbox_slider_image_shadow: true,				//enable border shadow the image
	    lightbox_slider_control_swipe:true,				//true,false - enable swiping control
	    lightbox_slider_control_zoom:true,				//true, false - enable zooming control
	    
		//lightbox text panel:
		lightbox_show_textpanel: true,						//show the text panel
		lightbox_textpanel_width: 550,						//the width of the text panel. wide type only
		lightbox_textpanel_enable_title: true,				//enable the title text
		lightbox_textpanel_enable_description: false,		//enable the description text
		lightbox_textpanel_padding_top:5,					//textpanel padding top 
		lightbox_textpanel_padding_bottom:5,				//textpanel padding bottom
		lightbox_textpanel_padding_right: 11,				//cut some space for text from right
		lightbox_textpanel_padding_left: 11,				//cut some space for text from left
		lightbox_textpanel_title_color:null,				//textpanel title color. if null - take from css
		lightbox_textpanel_title_font_family:null,			//textpanel title font family. if null - take from css
		lightbox_textpanel_title_text_align:null,			//textpanel title text align. if null - take from css
		lightbox_textpanel_title_font_size:null,			//textpanel title font size. if null - take from css
		lightbox_textpanel_title_bold:null,					//textpanel title bold. if null - take from css
		lightbox_textpanel_css_title:{},					//textpanel additional css of the title
		lightbox_textpanel_desc_color:null,					//textpanel description font family. if null - take from css
		lightbox_textpanel_desc_font_family:null,			//textpanel description font family. if null - take from css
		lightbox_textpanel_desc_text_align:null,			//textpanel description text align. if null - take from css
		lightbox_textpanel_desc_font_size:null,				//textpanel description font size. if null - take from css
		lightbox_textpanel_desc_bold:null,					//textpanel description bold. if null - take from css
		lightbox_textpanel_css_description:{},				//textpanel additional css of the description
	});
});