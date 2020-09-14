<?php

if( ! isset($_GET['userId']) ){
  http_response_code(400);
  header('Content-Type: application/json');
  echo '{"error":"missing id"}';
  exit();
}
// if( strlen($_GET['userId']) !=  ){
//   http_response_code(400);
//   header('Content-Type: application/json');
//   echo '{"error":"id must be 13 characters"}';
//   exit();
// }

if( ! isset($_GET['postId']) ){
    http_response_code(400);
    header('Content-Type: application/json');
    echo '{"error":"missing id"}';
    exit();
  }


$sUsers = file_get_contents('database.txt');
$aUsers = json_decode($sUsers, true);

  foreach($aUsers as $key=>$user){
    if($user['userId'] === $_GET['userId']){
        $aTweets = $aUsers[$key]['tweets'];
        foreach($aTweets as $i=>$tweet){
            if($_GET['postId'] === $tweet['id']){
                array_splice($aUsers[$key]['tweets'], $i, 1);
                header('Content-Type: application/json');
                echo '{"id": "' . $_GET['postId'] . '", "message" :"tweet has been deleted"}';
                $sTweets = json_encode($aUsers);
                file_put_contents('database.txt', $sTweets);
                exit();
            }
        }
    }
  }

