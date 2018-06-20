<?php
  $hashtag = $_POST["select"];
  $sid = $_POST["sid"];
  $sid = preg_replace("/[^0-9]/","", $sid);
  $timestamp = time();
  $pw = include('../php-script/pw.php');
  $pdo = new PDO("mysql:host=dd28600.kasserver.com;dbname=worldwide","d02a5e56",$pw);
  $statement = $pdo->prepare("UPDATE sessions SET Option1 = :opt1, zeit = :zt WHERE SessionID=:session");
  $statement->execute(array('opt1' => $hashtag, 'zt' => $timestamp, 'session' => $sid));
  $pdo = null;
  echo $timestamp;
?>
