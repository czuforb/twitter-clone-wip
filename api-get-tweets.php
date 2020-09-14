<?php

if( ! isset($_GET['userId']) ){
  http_response_code(400);
  header('Content-Type: application/json');
  echo '{"error":"missing id"}';
  exit();
}
if( strlen($_GET['userId']) != 13 ){
  http_response_code(400);
  header('Content-Type: application/json');
  echo '{"error":"id must be 13 characters"}';
  exit();
}
$sUsers = file_get_contents('database.txt');
$aUsers = json_decode($sUsers, true);

  foreach($aUsers as $key=>$user){
    if($user['userId'] === $_GET['userId']){
        echo json_encode($aUsers[$key]['tweets']);
      }
  }

