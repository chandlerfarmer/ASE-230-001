<?php

require('classes.php');
session_start();

if (AuthHelper::check() == true){
    echo 'You\'re already logged in!';
}

if (count($_POST) > 0){
    AuthHelper::signIn($_POST['email'], $_POST['password']);
}



?>






<br>
<a href = "test_AUTHHELPER.php">Sign Up Here</a>
<br>
<a href="test_signout.php">Sign Out Here</a>
<br>
<a href="test_getData.php">Get Data</a>
<h1>Sign In Here:</h1>
<form method="POST">
    <input type="email" name="email" placeholder="Email" />
    <input type="password" name="password" placeholder="password" />
    <button type="submit">Sign In </button>
</form>