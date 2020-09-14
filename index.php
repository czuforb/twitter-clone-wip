<?php
session_start();
  if(!$_SESSION['userId']){
    header('Location: welcome.php');
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Welcome in the admin panel, your email is
    <?php 
    echo $_SESSION['userId'];

    ?>
    </h1>
    <a href="action-logout.php">Log out</a>


    <button onclick="testApi(); return false;">TEST</button>

    <h2>Post a tweet</h2>
    <form id="formTweet" onsubmit="submitTweet(); return false;">
    <input type="hidden" name="userId" value="<?php echo $_SESSION['userId'] ?>">
    <input type="text" name="tweetTitle" placeholder=" tweet title" value="TITLE">
    <input type="text" name="tweetMessage" placeholder=" tweet message" value="MESSAGE">
    <button>tweet</button>

  </form>
  <div id="modal">
    
  </div>
  <h2>Your tweets</h2>
  <button onclick="getUserTweets('<?php echo $_SESSION['userId'] ?>'); return false;">Get tweets</button>
      <ul id="feed" data-byUser="<?php echo $_SESSION['userId'] ?>">
      </ul>
  <script src="app.js"></script>
</body>
</html>