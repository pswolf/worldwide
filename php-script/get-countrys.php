<?php
  $sid = 111111;//$_POST["sid"];
  $timestamp = 1528886737; //$_POST["timestamp"];
  $pdo = new PDO("mysql:host=localhost;dbname=worldwide","root","");
  $statement = $pdo->prepare("SELECT zeit, Option1 FROM sessions WHERE SessionID = :id");
  $statement->execute(array('id' => $sid));
  $result = $statement->fetchAll();
  $pdo = null;
  $remotetime = $result[0][0].'</br>';
  $hashtag = $result[0][1];
  $hashtag = str_replace('#','',$hashtag);
  $pdo = new PDO("mysql:host=localhost;dbname=worldwide","root","");
  $statement = $pdo->prepare("SELECT short, $hashtag FROM data ORDER BY $hashtag");
  $statement->execute();
  $request = $statement->fetchAll();
  $pdo = null;
  $ar = array();
  for($i = 0; $i < count($request); $i++){
    $ar[$i]['a'] = $request[$i][0];
    $ar[$i]['b'] = $request[$i][1];
  };
  json_encode($ar);
  print_r($ar);
?>
