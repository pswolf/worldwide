<?php
  $hashtag = $_POST["click"];
  $sid = $_POST["sid"];
  $sid = preg_replace("/[^0-9]/","", $sid);
  $timestamp = time();
  $pdo = new PDO("mysql:host=localhost;dbname=worldwide","root","");
  $statement = $pdo->prepare("UPDATE sessions SET Option1 = :opt1, zeit = :zt WHERE SessionID=:session");
  $statement->execute(array('opt1' => $hashtag, 'zt' => $timestamp, 'session' => $sid));
  $pdo = null;
  echo ($timestamp);
  echo ($sid);
?>
