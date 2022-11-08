<?php
require('classes.php');
?>

<a href="test_signin.php">Sign In Here</a>


<?php
session_start();
AuthHelper::signOut();
