<?php
require('classes.php');
session_start();
?>


<a href="test_signin.php"> Sign In Here</a>
<br>

<?php
if (AuthHelper::check() == false){
    echo 'Please Log In.';
    die();
}


$key = $_SESSION['email'];


AuthHelper::getData($key);

