var htData = [
    ["DE", "00:00"],
    ["CO", "01:00"],
    ["US-3", "02:00"],
    ["IT", "03:00"]
];

function animateColor() {

    function parse (str) {
        return parseInt(str, 10);
    }

    function setAnimation (datum) {
        var parts = datum[1].split(':').map(parse);
        var time = parts[0] * 60 + parts[1];
        $('#'+ datum[0]).css({
            animation: "mymove 5s " + time + "s"
        });
        // On every browser that understands CSS animations
        // you can avoid the use of jQuery with
        // document.querySelector('#'+ datum[0]).style.animation = "mymove 5s " + time + "s";
    }

    htData.forEach(setAnimation);
}


/*
//test map method
var htData2 = ["DE", "CO", "US-3", "IT"];

function test() {
  var htAkt = 0;
  const land = htData2.map(x =>
    x
  );
  console.log("htAkt= "+land);
}

//animation functioniert, aber nicht nacheienander:
function animateColor() {
  //animation soll activiert werden
  //for schleife soll aufgerufen werden
  var j = -1;
  while(j < 3){
  j = getIds(j);
  console.log("animateColor: "+j);
  }
}

function getIds(elem) {
  //for-schleife soll durchlaufen werden
  for (var i = elem+1; i < htData.length; i++) {
    var htNow = htData[i][0];
    console.log("Daten For-Schleife: "+ htNow);
    $('#'+htNow).css({
        animation: "mymove 2s infinite"
      });
    return i;
  }
}



//Archiv:

/*function colorAnimation() {
  var htData = [
      ["DE", "00:00"],
      ["CO", "01:00"],
      ["US-3", "02:00"],
      ["IT", "03:00"]
  ];

  for (var i = 0; i < htData.length; i++){
    var htNow = htData[i][0];
    console.log("aeussere For-Schleife: "+ htNow);

      $('#'+htNow).css({
          animation: "mymove 5s infinite"
        });
      //https://www.youtube.com/watch?v=S2KCXKAView
  }

};*/



//for (var i = 0; i < htData.length; i++){
  //var htNow = htData[i][0];
  //console.log("aeussere For-Schleife: "+ htNow);

  //for (var j = 1; j < htData[i].length; j++) {
    //var htNow2 = htData[i][j];
    //console.log("innere For-Schleife: "+ htNow2);

    //$('#'+htNow).addClass('animated flash');
    //https://www.youtube.com/watch?v=S2KCXKAView
    //$('#'+htNow).css('animation-duration','50');
  //}
//}
