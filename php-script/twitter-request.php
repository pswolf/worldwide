<?php
  function UpdateTwitter(){
    require_once('../libs/twitter-api-php-master/TwitterAPIExchange.php');
    $data = include('worlddata.php');
    $y = array();
    for($i = 0; $i<50; $i++){
      $rand = rand(0, count($data)-1);
      $y[$i]['woeid'] = $data[$rand]['ID'];
      $y[$i]['short'] = $data[$rand]['Short'];
      $y[$i]['land'] = $data[$rand]['Land'];
    };
    $pw = include('fkdkswkek.php');
    $settings = array(
      'oauth_access_token' => $pw['one'],
      'oauth_access_token_secret' => $pw['two'],
      'consumer_key' => $pw['three'],
      'consumer_secret' => $pw['four']
    );
    $url = "https://api.twitter.com/1.1/trends/place.json";
    for($i = 0; $i<count($y);$i++){
      $requestMethod = "GET";
      $woeid = $y[$i]['woeid'];
      $getfield = '?id='.$woeid;
      $twitter = new TwitterAPIExchange($settings);
      $string = json_decode($twitter->setGetfield($getfield)
                ->buildOauth($url, $requestMethod)
                ->performRequest(),$assoc = TRUE);
      if(array_key_exists('errors', $string))
      {
        $y[$i]['error'] = 'Not supported';
      }else {
        $y[$i]['hashtag'] = $string[0]['trends'][$i]['name'];
        $y[$i]['volume'] = $string[0]['trends'][$i]['tweet_volume'];
      }
    };
    $timestamp = time();
    $mod = '1';
    $ar = array('update' => $timestamp, 'data' => $y, 'modus' => $mod);
    file_put_contents("twitterdata.json",json_encode($ar));
  }
?>
