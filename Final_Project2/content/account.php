<?php

//REQUIRES DEPENDENCIES
require_once('../functions/sessionHelper.php');
require_once('../database/settings.php');


//CHECKS IF USER IS AUTHENTICATED
session_start();
if (sessionHelper::check() == false){
    echo 'Please create an account or sign in to view account details.';
    require_once('publicheader.php');
    die();
}

// CHECKS ROLE.
$query = $connection->prepare('SELECT Role FROM users WHERE User_ID = ?');                        
$query->execute([$_SESSION['userID']]);
$result = $query->fetch();



// IF Landlord
if ($result['Role'] == 0){
    require_once('header2.php');
    ?>
<h1> Account Information </h1>
    <?php

    //DISPLAY INFORMATION 
    $query = $connection->prepare('SELECT * FROM users WHERE User_ID = ?');
    $query->execute([$_SESSION['userID']]);
    $result = $query->fetch();



    //DELETE ACCOUNT
    if (!empty($_POST['delete'])){

        if ($_POST['delete'] == 'DELETE'){
            $query = $connection->prepare('DELETE FROM users WHERE `users`.`User_ID` = ?');
            $query->execute([$_SESSION['userID']]);
            $query->fetch();
            sessionHelper::signOut();
            header('location:../login/signup.php');

        }
        else{
            echo 'Please type "DELETE".';   //IDEALLY MAKE THIS AN ALERT FOR THE USER
        }
    }
}


// IF TENANT
if ($result['Role'] == 1){
    ?>
<h1> Account Information </h1>
    <?php

    require_once('tenantheader.php');

    //DISPLAY INFORMATION 
    $query = $connection->prepare('SELECT * FROM users WHERE User_ID = ?');
    $query->execute([$_SESSION['userID']]);
    $result = $query->fetch();



    //DELETE ACCOUNT
    if (!empty($_POST['delete'])){

        if ($_POST['delete'] == 'DELETE'){
            $query = $connection->prepare('DELETE FROM users WHERE `users`.`User_ID` = ?');
            $query->execute([$_SESSION['userID']]);
            $query->fetch();
            sessionHelper::signOut();
            header('location:../login/signup.php');

        }
        else{
            echo 'Please type "DELETE".';   //IDEALLY MAKE THIS AN ALERT FOR THE USER
        }
    }
}



// IF ADMIN
if ($result['Role'] == 3){
    require_once('adminheader.php');
    ?>
<h1> Account Information </h1>
    <?php

    //DISPLAY INFORMATION 
    $query = $connection->prepare('SELECT * FROM users WHERE User_ID = ?');
    $query->execute([$_SESSION['userID']]);
    $result = $query->fetch();



    //DELETE ACCOUNT
    if (!empty($_POST['delete'])){

        if ($_POST['delete'] == 'DELETE'){
            $query = $connection->prepare('DELETE FROM users WHERE `users`.`User_ID` = ?');
            $query->execute([$_SESSION['userID']]);
            $query->fetch();
            sessionHelper::signOut();
            header('location:../login/signup.php');

        }
        else{
            echo 'Please type "DELETE".';   //IDEALLY MAKE THIS AN ALERT FOR THE USER
        }
    }
}
?>
<style>
    form {
        text-align: center;
    }
    h4 {
        text-align: center;
    }
</style>
<div class="card">
  <h5 class="card-header"><?php echo $result['First_Name']." ".$result['Last_Name']?></h5>
  <div class="card-body">
    <p class="card-text">Email: <?php echo $result['Email']?></p>
    <p class="card-text">Phone Number: <?php echo $result['Phone_Number']?></p>
    <p class="card-text">Encrypted Password: <?php echo $result['Password']?></p>
  </div>
</div>
<br>
<br>
<br>
<br>

<h4>Delete Account</h4>
<form method="POST">
    <input type="text" name="delete" placeholder="type 'DELETE'" />
    <br>
    <br>
    <button type="submit">Delete </button>
</form>

<?php
require_once('footer2.php');
?>