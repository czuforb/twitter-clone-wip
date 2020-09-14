<!-- 
1. Get user id
2. Find user id in the database
3. Get data from the form 
4. Create tweet object 
5. Add to users TWEETS array as element 
6. Show new tweet in feed
-->

<?php
try{
  if( ! isset($_POST['tweetTitle']) ){
    http_response_code(400);
    header('Content-Type: application/json');
    echo '{"error":"missing title"}';
    exit();
  }
  if( strlen($_POST['tweetTitle']) < 2 ){
    http_response_code(400);
    header('Content-Type: application/json');
    echo '{"error":"title must be at least 2 characters"}';
    exit();
  }
  if( strlen($_POST['tweetTitle']) > 100 ){
    http_response_code(400);
    header('Content-Type: application/json');
    echo '{"error":"title cannot be longer than 100 characters"}';
    exit();
  }
  if( ! isset($_POST['tweetMessage']) ){
    http_response_code(400);
    header('Content-Type: application/json');
    echo '{"error":"missing message"}';
    exit();
  }
  if( strlen($_POST['tweetMessage']) < 2 ){
    http_response_code(400);
    header('Content-Type: application/json');
    echo '{"error":"message must be at least 2 characters"}';
    exit();
  }
  if( strlen($_POST['tweetMessage']) > 140 ){
    http_response_code(400);
    header('Content-Type: application/json');
    echo '{"error":"title cannot be longet than 140 characters"}';
    exit();
  }
  if( strlen($_POST['userId']) > 60){
    http_response_code(400);
    header('Content-Type: application/json');
    echo '{"error":"not valid user id"}';
    exit();
  }

  $jTweet          = new stdClass(); // {}
  $jTweet->id      = uniqid();
  $jTweet->title   = $_POST['tweetTitle'];
  $jTweet->message = $_POST['tweetMessage'];
  $jTweet->postedBy = $_POST['userId'];


  $sUsers = file_get_contents('database.txt');
  $aUsers = json_decode($sUsers, true);

    foreach($aUsers as $key=>$user){
      if($user['userId'] === $_POST['userId']){
          array_push($aUsers[$key]["tweets"], $jTweet);
        }
    }
    $sUsers = json_encode($aUsers);
    file_put_contents('database.txt', $sUsers);
    header('Content-Type: application/json');
    echo '{ "id":"'.$sTweetId.'"}';
}
catch(Exception $ex){
  http_response_code(500);
  header('Content-Type: application/json');
  echo '{"message":"error '.__LINE__.'"}';
}