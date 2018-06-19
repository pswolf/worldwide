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
      <div id="countdown">
        <button type="button" name="button" id="test">Test</button>
      </div>
      <div id="logo">
        <img src="../pics/worldwide-white.png" alt="W#RLDWIDE"/>
      </div>
      <div id="scroll">
        <ul>
          <?php
          $pdo = new PDO("mysql:host=dd28600.kasserver.com;dbname=d02a5e56","d02a5e56","ww!HFU2018");
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
