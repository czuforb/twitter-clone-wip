<!-- 
0. Start session
1. Get data with POST 
2. Make password hash 
3. Get users database file
4. Add the signed up user 
5. Write data back to file
6. Add user ID to the session
7. Send user to the admin panel
-->

<?php 

session_start();

$sUserMail = $_POST['email'];
$sUserPassword = $_POST['password'];
$userId = uniqid();

$hashed_password = password_hash($sUserPassword, PASSWORD_DEFAULT);
$sUsers = file_get_contents('database.txt');
$aUsers = json_decode($sUsers);
$aUserTweets = [];
$aUser = [
    userId => uniqid(),
    email => $sUserMail,
    password => $hashed_password,
    tweets => $aUserTweets
];


array_push($aUsers, $aUser);

file_put_contents('database.txt', json_encode($aUsers));
$_SESSION["userId"] = $aUser['id'];
header('Location: index.php');
?>