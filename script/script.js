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

$(document).ready(function() {
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
    data: {maptime: time, mapid: id},
    success: function (json){
      var data = JSON.parse(json);
      var xx = data[1][0][1];
      console.log(xx);
    }
  });
});
