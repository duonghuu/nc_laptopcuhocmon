$('.way-wow').addClass('hidden');
$('.way-wow').waypoint(function(direction) {
  myfunc_zoomIn(this.element, direction);
},{offset:'80%'});

function scrollTO_ex(id){
    $("html, body").animate({ scrollTop: $(id).offset().top  }, 900);
}
$(document).ready(function() {
  $(".widget-toc a").each(function(){
    $(this).attr("href",_curl+$(this).attr("href"));
  })
  $('.hoverhori').hover(function() {
      var vitri = $(this).position().top;
      $('.hoverhori> ul').css({
        'top': vitri + 'px'
      })
    });
  setTimeout(function(){
    $(".wap_load").fadeOut(1000);
  },1000);
});