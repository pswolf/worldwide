<?php
#Funktion 1: Abfrage der Zeit einer Hashtagänderung
function getdatabestime($id){
  $pw = include('../php-script/pw.php');
  $pdo = new PDO("mysql:host=dd28600.kasserver.com;dbname=d02a5e56","d02a5e56",$pw);
  $statement = $pdo->prepare("SELECT zeit FROM sessions WHERE mapid=:mid");
  $statement->bindParam(':mid', $id);
  $statement->execute();
  $result = $statement->fetchAll();
  $pdo = null;
  return $result[0][0];
}
#-------------------------------------------------------------------------------------------------
#Funktion 2: Abfrage der Länderkürzel mit Uhrzeit / Return in JSON
  function getCountrys($mapid){
    $pw = include('../php-script/pw.php');
    $pdo = new PDO("mysql:host=dd28600.kasserver.com;dbname=d02a5e56","d02a5e56",$pw);
    $statement = $pdo->prepare("SELECT zeit, Option1 FROM sessions WHERE mapid = :id");
    $statement->execute(array('id' => $mapid));
    $result = $statement->fetchAll();
    $pdo = null;
    $remotetime = $result[0][0];
    $hashtag = $result[0][1];
    $hashtag = str_replace('#','',$hashtag);
    $pdo = new PDO("mysql:host=dd28600.kasserver.com;dbname=d02a5e56","d02a5e56",$pw);
    $statement = $pdo->prepare("SELECT short, $hashtag FROM data ORDER BY $hashtag");
    $statement->execute(array('hashtag' => $hashtag));
    $request = $statement->fetchAll();
    $pdo = null;
    $ar = array();
    for($i = 0; $i < count($request); $i++){
      $ar[$i]['land'] = $request[$i][0];
      $ar[$i]['zeit'] = $request[$i][1];
    };
    $b = json_encode($ar);
    return $b;
  }//Ende get Countrys
#-------------------------------------------------------------------------------------------------
