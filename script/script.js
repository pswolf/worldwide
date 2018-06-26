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
      setTimeout(function(){
        longpolling();
      }, 20000);

    },
    timeout: 0,
  });
}
//--------------------------------------------------------------//
function animateData(json){
  console.log('Success');
  var data1 = JSON.parse(json);
  if(data1['modus'] == 'std') {
    $('#Ebene_1 rect').css('animation', '');
    var data = data1['data'];
    var hashtag = data1['hashtag'];
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
        for(var i = 0; i<arr[index].length; i++){
          console.log(Math.floor(Math.random() * arr[index].length));
          var elem = arr[index][i].land;
          var zeit = arr[index][i].zeit;
          $('#'+elem+' rect').css('animation', 'mymove 5s');
        }
        $('#uhrZeit').html(index+':00 Uhr');
        $('#hashTag').html('#'+hashtag);
      }, timer);
      timer += 1000;
    });
  }
  if(data1['modus'] == '1'){
    $('#Ebene_1 rect').css('animation', '');
    console.log('Echtzeit');
    console.log(data1);
    var arr = data1['data'];
    var timer = 0;
    $.each(arr, function (index, value){
      var elem = arr[index].short;
      var hashtag = arr[index].hashtag;
      var l = arr[index].land;
      setTimeout(function() {
        $('#'+elem+' rect').css('animation', 'mymove 5s');
        $('#uhrZeit').html(l);
        $('#hashTag').html('#'+hashtag);
      }, timer);
      timer += 1000;
    });
  }
  if(data1['modus'] == '2'){
    $('#Ebene_1 rect').css('animation', '');
    console.log('Random');
    console.log(data1);
    var ab = data1['data'];
    arr = shuffle(ab);
    var timer = 0;
    $.each(arr, function (index, value){
      var elem = arr[index].short;
      var l = arr[index].land;
      setTimeout(function() {
        $('#'+elem+' rect').css('animation', 'mymove 5s');
        $('#uhrZeit').html('#'+l);
        $('#hashTag').html('Random');
      }, timer);
      timer += 1000;
    });
  }
}
function shuffle(a) {
    var j, x, i;
    for (i = a.length - 1; i > 0; i--) {
        j = Math.floor(Math.random() * (i + 1));
        x = a[i];
        a[i] = a[j];
        a[j] = x;
    }
    return a;
}
