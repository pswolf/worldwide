<?php
  session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <title>m.worldwide</title>
    <link rel="shortcut icon" href="../icons/fav-icon.ico">
    <link rel="stylesheet" type="text/css" href="../styles/mobile.css"/>
    <script src="../script/jquery-3.3.1.min.js"></script>
    <script src="../script/hammer.js"></script>
    <script src="../script/jquery.hammer.js"></script>
    <script src="../script/mobile.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="theme-color" content="#000000">
  </head>
  <body>
    <div id="container">
      <div id="info" class="grid-item">
        &#9432;
      </div>
      <div class="grid-item" id="sid">
        <?php
          if(isset($_GET['sid'])){
            $id = $_GET['sid'];
            $_SESSION['s_id'] = $id;
            echo '<p>ID='.$id.'</p>';
          }
          else{
            echo 'error';
          }
        ?>
      </div>
      <div class="grid-item" id="connect">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 30 30"><path d="M15.655 16.639c-.757.739-.736 1.936.04 2.604-.92 1.8-2.16 3.41-3.643 4.757-5.812.038-10.804-4.137-11.852-9.806 1.059-1.779 2.441-3.344 4.064-4.614.729.493 1.732.353 2.334-.328 3.835 1.292 7.046 3.947 9.057 7.387zm-15.108-8.233c-.396 1.265-.58 2.586-.542 3.941 1.001-1.398 2.195-2.646 3.575-3.722l-.02-.083c-1.033-.141-2.019-.181-3.013-.136zm23.012.365c-1.469-.964-3.099-1.702-4.841-2.162-.14.257-.354.467-.618.611.784 3.021.761 6.233-.072 9.248.859.659.901 1.94.078 2.701.305.881.539 1.788.702 2.713 4.323-2.984 6.095-8.288 4.751-13.111zm-8.333-2.696c-2.851-.128-5.655.471-8.186 1.745.019.135.019.242.013.348 4.208 1.432 7.593 4.373 9.662 7.955l.199-.015c.78-2.834.791-5.845.028-8.689-.802-.11-1.469-.662-1.716-1.344zm1.671-2.122c.917.044 1.708.679 1.936 1.476 1.426.358 2.796.892 4.086 1.59-1.559-3.412-4.668-5.965-8.428-6.76.962 1.138 1.767 2.378 2.406 3.694zm-15.91 3.274c.901-.016 1.787.032 2.713.156.523-1.073 1.92-1.375 2.788-.602 2.766-1.396 5.784-2 8.752-1.872.107-.254.282-.47.506-.632-.794-1.58-1.833-3.016-3.067-4.259-5.189-.289-9.752 2.738-11.692 7.209zm15.812 12.438c-.76 1.514-1.742 2.925-2.929 4.19 1.38-.216 2.682-.667 3.863-1.311-.148-.994-.384-1.96-.7-2.889l-.234.01z"/>
        </svg>
      </div>
      <div class="grid-item" id="logo">
          <img id="p" src="../icons/logo.png" alt="w#orldwide"/>
      </div>
      <div class="grid-item" id="auswahl">
        <div class="scroll">
          <?php
            $pdo = new PDO("mysql:host=localhost;dbname=worldwide","root","");
            $statement = $pdo->prepare("SHOW COLUMNS FROM data");
            $statement->execute();
            $result = $statement->fetchAll();
            $pdo = null;
            $j = 0;
            for($i=3; $i<count($result);$i++){
              $hashtaglist[$j] = $result[$i][0];
              $j = $j+1;
            }
            echo '<ul>';
            echo '<li><div><p>&#8657;</p></div></li>';
            for($i = 0; $i < count($hashtaglist) ; $i++){
              echo '<li id="s'.$i.'"><p>'.$hashtaglist[$i].'</p></li>';
            }
            echo '</ul>';
          ?>
        </div>
      </div>
      <div class="grid-item" id="button1">
        <div class="button">
          <p>Random</p>
        </div>
      </div>
      <div class="grid-item" id="button2">
        <div class="button">
          <p>Echtzeit</p>
        </div>
      </div>
    </div>
    <script>
      $('.button').click(function(){
        var i = $(this).find('p').html();
        setTimeout(function() {
          alert(i);
        }, 200);
      });
      $(document).ready(function(){
        var objects = [];
        for(var i=0; i < 6; i++){
            var x = $("#s"+i+" p").offset();
            objects[i] = x.top;
        };
        for(var j = 0; j<objects.length; j++){
          var x = objects[j];
          if(x <= objects[j+1]){
            var k = j+1;
            $("#s"+k).css(
              "background-color", "grey"
            );
            console.log('1')
          }
        }
      });
      $('.scroll li').click(function(){
        var x = $(this).find('p').html();
        var session = $('#sid').find('p').html();
        console.log(x);
        $.ajax({
          type: "POST",
          url: "../php-script/receive.php",
          data: {click: x, sid: session},
          success: function(data){
            console.log(data);
          }
        });
      });
    </script>
  </body>
</html>
