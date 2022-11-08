<?php
require('classes.php');
?>

<a href="test_signin.php">Sign In Here</a>
<br>

<?php

session_start();

if (count($_POST) > 0){
    AuthHelper::signUp($_POST['email'], $_POST['password']);
}

echo '<br>';
echo '<h1>Sign Up Here:</h1>';
?>

<form method="POST"> 
    <input type="email" name="email" placeholder="Email"/>
    <input type="password" name="password" placeholder="Password" />
    <button type="submit">Create Account</button>
</form>