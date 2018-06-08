<?php
  session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Worldwide</title>
    <link rel="stylesheet" type="text/css" href="../styles/index.css"/>
    <script src="../script/jquery-3.3.1.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta charset="UTF-8"/>
  </head>
  <body>
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

      $return_success = 0;
      if($return_success==0){
        $return_init = session_init();
        $return_id = $return_init[0];
        $return_success = $return_init[1];
      }
      echo $return_id;
    ?>
    <div id="session">ID</div>
    <?php
      include('../libs/phpqrcode-master/qrlib.php');
      $url = 'http://localhost/worldwide/mobile/mobile.php?sid='.$return_id;
      QRcode::png($url, 'qr/code.png', QR_ECLEVEL_L, 4, 1);
    ?>
    <img src="qr/code.png"/>
    <div class="clear"></div>
    <div class="field" id="input1">
      <h1>Feld 1</h1>
    </div>
    <div class="field" id="input2">
      <h1>Feld 2</h1>
    </div>
    <div class="field" id="input3">
      <h1>Feld 3</h1>
    </div>
    <div class="field" id="input4">
      <h1>Feld 4</h1>
    </div>
  </body>
</html>
