<?php
#Funktion 1: Abfrage der Zeit einer Hashtagänderung
  function getdatabestime($id){
    $pw = include('../php-script/pw.php');
    $pdo = new PDO("mysql:host=dd28600.kasserver.com;dbname=d02a5e56","d02a5e56",$pw);
    $statement = $pdo->prepare("SELECT zeit, modus FROM sessions WHERE mapid=:mid");
    $statement->bindParam(':mid', $id);
    $statement->execute();
    $result = $statement->fetchAll();
    $pdo = null;
    return $result;
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
    $b = array('hashtag' => $hashtag, 'data' => $ar, 'modus' => 'std');
    $b = json_encode($b);
    return $b;
  }//Ende get Countrys
#-------------------------------------------------------------------------------------------------
#Funktion 3: Abfrage der Echtzeitdaten von TwitterAPIExchange
  function getTwitter($mid){
    include 'twitter-request.php';
    $pw = include('../php-script/pw.php');
    $pdo = new PDO("mysql:host=dd28600.kasserver.com;dbname=d02a5e56","d02a5e56",$pw);
    $statement = $pdo->prepare("SELECT hashtag FROM twitter WHERE id = 0");
    $statement->execute();
    $result = $statement->fetchAll();
    $pdo = null;
    $lastupdate = $result[0]['hashtag'];
    $timestamp = time();
    if($lastupdate+3600 < $timestamp){    //Wenn Datenbankzeit + 1h kleiner als jetzt ist dann update Datenbank
      $ar = UpdateTwitter();
    }
    print_r($ar);

    /*
    $pdo = new PDO("mysql:host=dd28600.kasserver.com;dbname=d02a5e56","d02a5e56",$pw);
    $statement = $pdo->prepare("SELECT short, volume, hashtag FROM twitter");
    $statement->execute();
    $request = $statement->fetchAll();
    $pdo = null;
    return $request; */
  }
?>
