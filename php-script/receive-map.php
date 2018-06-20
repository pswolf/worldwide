<?php
  include 'functions.php';
  $maptime = $_POST['maptime'];
  $mapid = $_POST['mapid'];
  $dbtime = getdatabestime($mapid);
  while ($dbtime <= $maptime) {
    sleep(5);
    $dbtime = getdatabestime($mapid);
  }
  $jsonclient = getCountrys($mapid);
  return json_encode(array($dbtime, $jsonclient));
?>
