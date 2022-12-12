<?php
//signin
require_once('../database/settings.php');
require_once('../functions/sessionHelper.php');
require_once('../header3.php');

session_start();

if (sessionHelper::check() == true){
    header('location: ../content/index.php');
}



if (!empty($_POST['email']) && !empty($_POST['password'])){

    $query = $connection->prepare('SELECT Password FROM users WHERE Email = ?');  
    $query->execute([$_POST['email']]);                            
    $result = $query->fetch();  

    if ($result == ''){
        echo 'Hmm we can\'t seem to find an account. Please reenter the email and try again';

    }
    else{

        if (password_verify($_POST['password'], $result['Password'])){
            $query = $connection->prepare('SELECT User_ID FROM users WHERE Email = ?');  
            $query->execute([$_POST['email']]);                            
            $result = $query->fetch();  
            sessionHelper::signIn($result['User_ID']);
            header('location: ../content/index.php');
            
        }
        else{
            echo 'Invalid Credentials. Please try again.';
        }
    }
}

?>
<style>
    form {
        text-align: center;
    }


</style>


<h1>Sign In Here!</h1>
<form method="POST">
    <input type="text" name="email" placeholder="Email" />
    <br>
    <input type="password" name="password" placeholder="Password" />
    <br><br>
    <button type="submit">Sign In </button>
</form>

<?php
require_once('../footer.php');
?>