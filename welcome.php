<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


    <h2>Log in</h2>
    <form action="action-login.php" method="post">
    
    <input type="text" name="email" value="a@a.com">
    <input type="text"  name="password" value="admin">

    <button>Submit</button>
    
    <h2>Sign up</h2>


    </form>
    <form action="action-signup.php" method="post">
    
    <input type="text" name="email" value="a@a.com">
    <input type="text"  name="password" value="admin">

    <button>Sign up</button>
    
    </form>


</body>
</html>

