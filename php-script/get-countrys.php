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
  echo $hashtag.'</br>';
  $pdo = new PDO("mysql:host=localhost;dbname=worldwide","root","");
  $statement = $pdo->prepare("SELECT short, $hashtag FROM data ORDER BY $hashtag");
  $statement->execute(array('hashtag' => $hashtag));
  $request = $statement->fetchAll();
  $pdo = null;
  for($i = 0; $i < count($request); $i++){
    for($j=0; $j<2;$j++){
      $sendJson[$i][$j] = $request[$i][$j];
    }
  };
  json_encode($sendJson);
  echo $sendJson;
?>
