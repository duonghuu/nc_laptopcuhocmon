function UGTheme_tiles(){function o(a,h){b=a,l=jQuery.extend(l,m),l=jQuery.extend(l,h),p(),b.setOptions(l),b.setFreestyleMode(),d=a.getObjects(),c=jQuery(a),e=d.g_objWrapper,f.init(a,l),g.init(a,l),k=f.getObjTileDesign()}function p(){switch(1==l.theme_enable_preloader&&(n.showPreloader=!0),l.theme_appearance_order){default:case"normal":break;case"shuffle":b.shuffleItems();break;case"keep":l.tiles_keep_order=!0}}function q(){e.addClass("ug-theme-tiles"),e.append("<div class='ug-tiles-wrapper' style='position:relative'></div>"),1==n.showPreloader&&(e.append("<div class='ug-tiles-preloader ug-preloader-trans'></div>"),h=e.children(".ug-tiles-preloader"),h.fadeTo(0,0)),i=e.children(".ug-tiles-wrapper"),l.theme_gallery_padding&&e.css({"padding-left":l.theme_gallery_padding+"px","padding-right":l.theme_gallery_padding+"px"}),f.setHtml(i),g.putHtml()}function r(){h&&(h.fadeTo(0,1),e.height(l.theme_preloading_height),j.placeElement(h,"center",l.theme_preloader_vertpos)),x(),f.run(),g.run()}function s(){q(),r()}function u(a,b){b=jQuery(b);var c=k.getItemByTile(b),d=c.index;g.open(d)}function v(){if(i.hide(),h){h.show();var a=j.getElementSize(h),b=a.bottom+30;e.height(b)}}function w(){null!==l.theme_auto_open&&(g.open(l.theme_auto_open),l.theme_auto_open=null)}function x(){h&&jQuery(f).on(f.events.TILES_FIRST_PLACED,function(){e.height("auto"),h.hide()}),jQuery(k).on(k.events.TILE_CLICK,u),c.on(b.events.GALLERY_BEFORE_REQUEST_ITEMS,v),jQuery(g).on(g.events.LIGHTBOX_INIT,w)}var c,d,e,h,i,b=new UniteGalleryMain,f=new UGTiles,g=new UGLightbox,j=new UGFunctions,k=new UGTileDesign,l={theme_enable_preloader:!0,theme_preloading_height:200,theme_preloader_vertpos:100,theme_gallery_padding:0,theme_appearance_order:"normal",theme_auto_open:null},m={gallery_width:"100%"},n={showPreloader:!1};this.destroy=function(){jQuery(k).off(k.events.TILE_CLICK),jQuery(f).off(f.events.TILES_FIRST_PLACED),c.off(b.events.GALLERY_BEFORE_REQUEST_ITEMS),jQuery(g).off(g.events.LIGHTBOX_INIT),f.destroy(),g.destroy()},this.run=function(){s()},this.init=function(a,b){o(a,b)}}"undefined"!=typeof g_ugFunctions?g_ugFunctions.registerTheme("tiles"):jQuery(document).ready(function(){g_ugFunctions.registerTheme("tiles")});