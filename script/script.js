$(document).ready(function() {
  $('#testButton').click(function(){
    var land = ['DE', 'US', 'FR'];
    var time = 0;
    $.each(land, function (index, value) {
      setTimeout(function() {
        $('#'+value+" rect").css("fill", "red");
    }, time);
    time += 2000;
    });
  });
});
