$(document).ready(function() {
  $('#scroll').on('swipeup', function(e){
    if($('#active').is('#scroll ul li:last-child')){
      console.log('Nein');
    }else {
      c = $('#scroll ul li').height();
      var elem = $('#active');
      elem.attr('id', 'co');
      elem.next().attr('id', 'active');
      var f = parseInt($('#scroll ul').css('margin-top').replace('px', ''));
      $("#scroll ul").animate({
        'margin-top': f-c,
      });
      $('#active').next().attr('id', 'co');
      setTimeout(function(){
        elem.prev().attr('id', 'hideup');
      }, 200);
    };
  });
});
$(document).ready(function() {
  $('#scroll').on('swipedown', function(e){
    if($('#active').is('#scroll ul li:first-child')){
      console.log('Nein');
    }else {
      c = $('#scroll ul li').height();
      var x = parseInt($('#scroll').css('height').replace('px', ''));
      var f = parseInt($('#scroll ul').css('margin-top').replace('px', ''));
      var y = 0;
      $("#scroll ul").animate({
        'margin-top': f+c
      });
      var elem = $('#active');
      elem.attr('id', 'co');
      elem.prev().attr('id', 'active');
      $('#active').prev().attr('id', 'co');
      setTimeout(function(){
        elem.next().attr('id', 'hidden');
      }, 200);
    };
  });
});
