<?php
  $hashtag = $_POST["select"];
  $sid = $_POST["sid"];
  if($hashtag != 'realtime' && $hashtag != 'random'){
    $sid = preg_replace("/[^0-9]/","", $sid);
    $timestamp = time();
    $md = '0';
    $pw = include('pw.php');
    $pdo = new PDO("mysql:host=dd28600.kasserver.com;dbname=d02a5e56","d02a5e56",$pw);
    $statement = $pdo->prepare("UPDATE sessions SET Option1 = :opt1, zeit = :zt, modus = :md WHERE mapid=:session");
    $statement->execute(array('opt1' => $hashtag, 'zt' => $timestamp,'md' => $md, 'session' => $sid));
    $pdo = null;
    echo $timestamp;
  }
  if($hashtag == 'realtime') {
    $hashtag = 1;
    $timestamp = time();
    $pw = include('pw.php');
    $sid = preg_replace("/[^0-9]/","", $sid);
    $pdo = new PDO("mysql:host=dd28600.kasserver.com;dbname=d02a5e56","d02a5e56",$pw);
    $statement = $pdo->prepare("UPDATE sessions SET modus = :mode, zeit = :zt WHERE mapid=:session");
    $statement->execute(array('mode' => $hashtag, 'zt' => $timestamp, 'session' => $sid));
    $pdo = null;
    echo $hashtag;
  }
  if($hashtag == 'random') {
    $hashtag = 2;
    $timestamp = time();
    $pw = include('pw.php');
    $sid = preg_replace("/[^0-9]/","", $sid);
    $pdo = new PDO("mysql:host=dd28600.kasserver.com;dbname=d02a5e56","d02a5e56",$pw);
    $statement = $pdo->prepare("UPDATE sessions SET modus = :mode, zeit = :zt WHERE mapid=:session");
    $statement->execute(array('mode' => $hashtag, 'zt' => $timestamp, 'session' => $sid));
    $pdo = null;
  }
?>
