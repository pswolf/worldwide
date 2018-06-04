<?php
  function session_check($sessionid){   //Prüft ob diese SessionID bereits vergeben wurde
    $pdo = new PDO("mysql:host=localhost;dbname=worldwide","root","");
    $statement = $pdo->prepare("SELECT * FROM sessions WHERE SessionID = :sessionid");
    $statement->bindParam(':sessionid', $sessionid);
    $statement->execute();
    $anzahl = $statement->rowCount();
    $pdo = null;
    return $anzahl;
  }
  function session_new($sessionid){       //Registriert eine neue SessionID
    $pdo = new PDO("mysql:host=localhost;dbname=worldwide","root","");
    $new_session = array();
    $new_session['id'] = $sessionid;
    $statement = $pdo->prepare("INSERT INTO sessions (SessionID) VALUES (:id)");
    $statement->execute($new_session);
    $pdo = null;
    $_SESSION['s_id'] = $sessionid;
    return $sessionid;
  }
  function session_init(){    //Initiiert Session
    if(isset($_SESSION['s_id'])){
      $sessionid = $_SESSION['s_id'];
      return array($sessionid, $success=1);
    }
    else{
      $sessionid = rand(100000, 999999);
      $check = session_check($sessionid);
      if($check == 0){
        session_new($sessionid);
        return array($sessionid, 1);
      }
      else{
        return array(false, 0);
      }
    }
  }   //Ende session_init
?>
