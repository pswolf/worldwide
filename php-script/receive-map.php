<?php
  include 'functions.php';
  $maptime = $_POST['maptime'];
  $mapid = $_POST['mapid'];
  $dbdata = getdatabestime($mapid);
  $dbtime = $dbdata[0]['zeit'];
  while ($dbtime <= $maptime) {
    sleep(5);
    $dbdata = getdatabestime($mapid);
    $dbtime = $dbdata[0]['zeit'];
    set_time_limit(0);
  }
  $mode = $dbdata[0]['modus'];
  if($mode == 0){
    $jsonclient = getCountrys($mapid);
  }
  if($mode == 1){
    $jsonclient = getTwitter($mapid);
  }
  if($mode == 2){
    $jsonclient = getRandom();
  }
  echo $jsonclient;
?>
