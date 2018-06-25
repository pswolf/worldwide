<?php
  include 'functions.php';
  $maptime = $_POST['maptime'];
  $mapid = $_POST['mapid'];
  $dbtime = getdatabestime($mapid);
  while ($dbtime <= $maptime) {
    sleep(2);
    $dbtime = getdatabestime($mapid);
    set_time_limit(0);
  }
  $jsonclient = getCountrys($mapid);
  echo $jsonclient;
?>
