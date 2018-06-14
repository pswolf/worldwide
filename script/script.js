
function colorChange() {

htData = ["DE", "CO", "US", "FR", "US-3", "IT"]["1", "2", "3", "4", "5", "6"];

  for (var i = 0; i < htData.length; i++)
    var htNow = htData[i];
    console.log("aeußere For-Schleife: "+ htNow);

    for (var j = 0; j < htData[i].length; j++) {
      var htNow2 = htData[i][j];
      console.log("innere For-Schleife: "+ htNow2);

      $('#'+htNow).css({
        fill: "#ff0000",
        /*transition: "2s"*/
        });
    }

}
