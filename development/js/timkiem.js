function doEnter(evt){
    var key;
    if(evt.keyCode == 13 || evt.which == 13){
     onSearch(evt);
   }
 }
 function onSearch(evt) {
   var keyword1 = $('.keyword:eq(0)').val();
   var keyword2 = $('.keyword:eq(1)').val();
   if(keyword1==lang_nhaptukhoatimkiem)
   {
    keyword = keyword2;
  }
  else
  {
    keyword = keyword1;
  }
  if(keyword=='' || keyword==lang_nhaptukhoatimkiem)
  {
    alert(lang_chuanhaptukhoa);
  }
  else{
    location.href = "tim-kiem/keyword="+keyword;
  }
}
 function onSearch2(evt) {
   var id_huong = $('#id_huong').val();
   var id_danhmuc = $('#id_danhmuc').val();
   var id_dientich = $('#id_dientich').val();
   var id_khoangia = $('#id_khoangia').val();
  location.href = "tim-kiem/id_huong="+id_huong+"&id_danhmuc="+id_danhmuc+"&id_dientich="+id_dientich+"&id_khoangia="+id_khoangia;
}
$(document).ready(function() {
  $('.timkiem_icon').click(function(event) {
    if($('#search').hasClass('hien')){
      $('#search').removeClass('hien');
    }else{
      $('#search').addClass('hien');
    }
  });
});