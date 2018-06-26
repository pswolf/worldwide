<?php
  $mapid = 111111;
  include 'functions.php';
  $x = getTwitter($mapid);
  $x = $x[0];
  print "<pre>";
  print_r($x);
  print "</pre>";
?>
