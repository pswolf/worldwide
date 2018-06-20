<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="de" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/mobile_scroll.css">
    <link rel="shortcut icon" href="../pics/fav-icon.ico">
    <script src="../script/jquery-3.3.1.min.js" charset="utf-8"></script>
    <script src="../script/scroll.js" charset="utf-8"></script>
    <script src="../script/jquery.mobile-events.min.js" charset="utf-8"></script>
    <meta name="theme-color" content="#2e2d2d">
    <title>Scroll-Vertikal-Mobile</title>
  </head>
  <body>
    <div id="container">
      <div id="connect">
        <?php
          $mapid = $_GET['id'];
          if(isset($_SESSION['deviceid'])){
            $deviceid = $_SESSION['deviceid'];
          }else {
            $_SESSION['deviceid'] = rand(100, 999);
            $deviceid = $_SESSION['deviceid'];
          }
          $pw = include('../php-script/pw.php');
          $pdo = new PDO("mysql:host=dd28600.kasserver.com;dbname=d02a5e56","d02a5e56",$pw);
          $statement = $pdo->prepare("SELECT deviceid, starttime FROM sessions WHERE mapid = :map");
          $statement->bindParam(':map', $mapid);
          $statement->execute();
          $result = $statement->fetchAll();
          $timestamp = time();
          if($result[0][0]==0){
            $statement = $pdo->prepare("UPDATE sessions SET deviceid=:device, starttime=:stamp WHERE mapid = :map");
            $statement->execute(array('device' => $deviceid, 'stamp' => $timestamp, 'map' => $mapid));
            $statement->execute();
            echo 'Success';
          }else {
            $diff = $timestamp - $result[0][1];
            if ($diff > 300) {
              $statement = $pdo->prepare("UPDATE sessions SET deviceid=:device, starttime=:stamp WHERE mapid = :map");
              $statement->execute(array('device' => $deviceid, 'stamp' => $timestamp, 'map' => $mapid));
              $statement->execute();
              $pdo = null;
              echo 'Update';
            }if ($diff < 300) {
              echo 'Wait';
            }
          }
        ?>
      </div>
      <div id="device">
        <?php
          echo $_SESSION['deviceid'];
        ?>
      </div>
      <div id="countdown">Verbindszeit<br><p></p>
      </div>
      <div id="logo">
        <img src="../pics/worldwide-white.png" alt="W#RLDWIDE"/>
      </div>
      <div id="scroll">
        <ul>
          <?php
          $pw = include('../php-script/pw.php');
          $pdo = new PDO("mysql:host=dd28600.kasserver.com;dbname=d02a5e56","d02a5e56",$pw);
          $statement = $pdo->prepare("SHOW COLUMNS FROM data");
          $statement->execute();
          $result = $statement->fetchAll();
          $pdo = null;
          $j = 0;
          for($i=3; $i<count($result);$i++){
            $hashtaglist[$j] = $result[$i][0];
            $j = $j+1;
          }
          for($i = 0; $i < count($hashtaglist) ; $i++){
            if($i == 0 || $i == 2){
              echo '<li id="co"><h1>'.$hashtaglist[$i].'</h1></li>';
            }
            if($i == 1){
              echo '<li id="active"><h1>'.$hashtaglist[$i].'</h1></li>';
            }
            if($i >= 3){
              echo '<li id="hidden"><h1>'.$hashtaglist[$i].'</h1></li>';
            }
          };
          ?>
        </ul>
      </div>
      <div id="but1">
          <button class="mode">RANDOM</button>
      </div>
      <div id="but2">
          <button class="mode">ECHTZEIT</button>
      </div>
    </div>
  </body>
</html>
