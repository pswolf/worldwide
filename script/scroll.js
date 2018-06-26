$(document).ready(function() {
  $('#scroll').on('swipeup', function(){
    var content = scrollup();
    longpollmobile(content);
  });
  $('#scroll').on('swipedown', function(){
    var content = scrolldown();
    longpollmobile(content);
  });
  /*$('#realtime').click(function(){
    console.log('Log1');
    sendrealtime();
  });*/
});

function scrollup(){
  if($('#active').is('#scroll ul li:last-child')){
    console.log('Scroll-UP!');
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
    var content = $('#active h1').html();
    return content;
  };
};
function scrolldown(){
  if($('#active').is('#scroll ul li:first-child')){
    console.log('Scroll-Down!');
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
    var content = $('#active h1').html();
    return content;
  };
};
function longpollmobile(data){
  var mapid = $('#mapid p').html();
  $.ajax({
    url: '../php-script/receive-mobile.php',
    type: 'POST',
    data: {select: data, sid: mapid}
  })
  .done(function(result) {
    console.log(result);
  })
  .fail(function() {
    console.log("error");
  })
  .always(function() {
    console.log("complete");
  });
};

function sendrealtime(){
  var mapid = $('#mapid p').html();
  $.ajax({
    url: '../php-script/receive-mobile.php',
    type: 'POST',
    data: {select: 'realtime', sid: mapid}
  })
  .done(function() {
    console.log("success");
  })
  .fail(function() {
    console.log("error");
  })
  .always(function() {
    console.log("complete");
  });
}

$(document).ready(function() {
  $('#test').ready(function(){
    var time = 300;
    var counter = setInterval(countdown, 1000);
    function countdown(){
      time = time-1;
      if(time <= 0){
        clearInterval(counter);
      }
      var minutes = time/60;
      minutes = Math.floor(minutes);
      var secs = time%60;
      if(secs<10){
        secs = "0"+secs;
      }
      $("#countdown p").html(minutes+":"+secs);
    }
  });
});
