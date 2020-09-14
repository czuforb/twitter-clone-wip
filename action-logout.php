<!-- 

0. Start session
1. Destroy session
2. Redirect to login.php

 -->

<?php
session_start();
session_destroy();
header('Location: welcome.php');
