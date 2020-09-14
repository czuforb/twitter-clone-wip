<?php
 $sUsers = file_get_contents('database.txt');
 $aUsers = json_decode($sUsers, true);
 
 if(!empty($_GET['userId'])){
    foreach($aUsers as $key=>$user){
        if($user['userId'] === $_GET['userId']){
            //  echo json_encode($aUsers[$key]['tweets']);
            foreach($aUsers[$key]['tweets'] as $i=>$tweet){
                if($tweet['id'] === $_GET['postId']){
                    header('Content-Type: application/json');
                    echo json_encode($aUsers[$key]['tweets'][$i]);
                    exit();
                }
            }
        }
    }
}
if(!empty($_POST['tweetId'])){
    foreach($aUsers as $key=>$user){
        if($user['userId'] === $_POST['postedBy']){
            foreach($aUsers[$key]['tweets'] as $i=>$tweet){
                if($tweet['id'] === $_POST['tweetId']){
                    $aUsers[$key]['tweets'][$i]['title'] = $_POST['newTweetTitle'];
                    $aUsers[$key]['tweets'][$i]['message'] = $_POST['newTweetMessage'];
                    $sUsers = json_encode($aUsers);
                    file_put_contents('database.txt', $sUsers);
                    header('Content-Type: application/json');
                    echo var_dump($sUsers);
                    exit();
                }
            }
        }

    }
}
        
        // }
// try {
//  if (!isset($_GET['postId'])) {
//  http_response_code(400);
//  header('Content-Type: application/json');
//  echo '{"error":"missing id"}';
//  exit();
//  }
 
//  if (strlen($_GET['postId']) != 13) {
//  http_response_code(400);
//  header('Content-Type: application/json');
//  echo '{"error":"id is not valid"}';
//  exit();
//  }
//  if (!isset($_POST['newTitle'])) {
// //  http_response_code(400);
// //  header('Content-Type: application/json');
// //  echo '{"error":"missing title"}';
// //  exit();
//  }
 
//  if (strlen($_POST['newTitle']) < 2) {
// //  http_response_code(400);
// //  header('Content-Type: application/json');
// //  echo '{"error":"title must be at least 2 characters"}';
// //  exit();
//  }
//  if (strlen($_POST['newTitle']) > 100) {
// //  http_response_code(400);
// //  header('Content-Type: application/json');
// //  echo '{"error":"title cannot be longer than 100 characters"}';
// //  exit();
//  }
 
//  // connect to the db
//  $sUsers = file_get_contents('database.txt');
//  $aUsers = json_decode($sUsers, true);
 
// foreach($sUsers as $key=>$user){
//     if ($_GET['userId'] == $user[$i]['id']) {
//         echo "geci";
//   //   $aTweets[$i]['title'] = $_POST['newTitle'];
//   //   // $aTweets[$i]->title-test = $_POST['newTitle'];
//   //   header('Content-Type: application/json');
//   //   echo '{"message":"tweet has been updated"}';
    
//   //   $sTweets = json_encode($aTweets);
//   //   file_put_contents('database.txt', $sTweets);
//     exit();
//    }
// }
//  }
//  header('Content-Type: application/json');
//  http_response_code(400);
//  echo '{"message" :"tweet not found"}';
// } catch (Exception $ex) {
//  http_response_code(500);
//  header('Content-Type: application/json');
//  echo '{"message":"error ' . __LINE__ . '"}';
// }