  function blau(){
    document.getElementById("DE").setAttribute("style","fill: blue");
  }

function colorChange() {
  var htData = new Array(3);
  htData = ["DE", "CO", "US", "FR", "", "IT"];

    for (var i = 0; i < htData.length; i++) {

        var htNow = htData[i];
        console.log("aeußere For-Schleife: "+htNow);

        $('#'+htNow).css({
          fill: "#ff0000",
          transition: "2s"
          });
      }

}
