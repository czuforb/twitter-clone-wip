<!-- 

0. Start session
1. Get data from the form $_POST
3. Get data from DB file
4. Check if email and password match, if no match => return to login page  
5. If check, write userId to session and go to main page

 -->




<?php

session_start();
$sUserMail = $_POST['email'];
$sUserPassword = $_POST['password'];
$hashed_password = password_hash($sUserPassword, PASSWORD_DEFAULT);


$sUsers = file_get_contents('database.txt');
$aUsers = json_decode($sUsers, true);

foreach($aUsers as $aUser){
    if($sUserMail === $aUser['email']){
        $isPasswordCorrect = password_verify($_POST['password'], $aUser['password']);
        if($isPasswordCorrect){
            $_SESSION["userId"] = $aUser['userId'];
            header('Location: index.php');
            exit();
        }
        echo 'sorry, wrong password';
        exit();
    }
}
echo "couldn't find your email maaan!";
exit();
?>



