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
  var arr = new Array();
  for(var i=0; i<24; i++){
    arr[i] = data.filter(function(el) {
      return el.zeit == i;
    })
  };
  console.log(arr);
  var timer = 0;
  var i = 0;
  $.each(arr, function (index, value) {
    setTimeout(function() {
      /*if(index > 0){
        for(var i = 0; i<arr[index-1].length; i++){
          var elem = arr[index-1][i].land;
          $('#'+elem+' rect').css('fill', 'rgb(30, 58, 180)');
        };
      };*/
      for(var i = 0; i<arr[index].length; i++){
        var elem = arr[index][i].land;
        var zeit = arr[index][i].zeit;
        $('#'+elem+' rect').css('animation', 'mymove 5s');
        $('#uhrZeit').html(zeit+':00 Uhr');
      }
    }, timer);
    timer += 1000;
  });
}
