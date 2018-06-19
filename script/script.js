
function colorAnimation() {
  var htData = [
      ["DE", "00:00"],
      ["CO", "01:00"],
      ["US-3", "02:00"],
      ["IT", "03:00"]
  ];

  for (var i = 0; i < htData.length; i++){
    var htNow = htData[i][0];
    console.log("aeussere For-Schleife: "+ htNow);

      $('#'+htNow).delay( 800 ).addClass('animated flash');
      //https://www.youtube.com/watch?v=S2KCXKAView
  }

};



function colorChange() {
  var id = "";
  id.css({
    fill: "#ff0000",
    transition: "2s"
    });
}


//for (var i = 0; i < htData.length; i++){
//  var htNow = htData[i][0];
//console.log("aeussere For-Schleife: "+ htNow);

  //for (var j = 1; j < htData[i].length; j++) {
    //var htNow2 = htData[i][j];
    //console.log("innere For-Schleife: "+ htNow2);

    //$('#'+htNow).addClass('animated flash');
    //https://www.youtube.com/watch?v=S2KCXKAView
    //$('#'+htNow).css('animation-duration','50');
  //}
//}
