$(document).ready(function() {
  $('#testButton').click(function(){
    var land = ['DE', 'US', 'FR'];
    var time = 0;
    $.each(land, function (index, value) {
      setTimeout(function() {
        $('#'+value+" rect").css("fill", "red");
    }, time);
    time += 500;
    });
  });
});
//--------------------------------------------------------------//
$(document).ready(function() {
  longpolling();
});
//--------------------------------------------------------------//
function longpolling(){
  console.log('Start Long Polling');
  var id = $('#mapid p').html();
  var time = new Date();
  time = time.getTime();
  time /= 1000;
  time = parseInt(time,10)
  console.log(id, time);
  $.ajax({
    url: 'php-script/receive-map.php',
    type: 'POST',
    async: true,
    data: {maptime: time, mapid: id},
    success: function (json){
      animateData(json);
      longpolling();
    },
    timeout: 0,
  });
}
//--------------------------------------------------------------//
function animateData(json){
  console.log('Success');
  var data = JSON.parse(json);
  var hashtag = data[0];
  $('#hashTag').html("#"+hashtag);
  var countrys = data[1];
  var timer = 0;
  $.each(countrys, function (index, value) {
    setTimeout(function() {
      $('#'+value[0]+" rect").css("fill", "red");
      $('#uhrZeit').html(countrys[index][1]+" Uhr");
  }, timer);
  timer += 100;
  });
}
