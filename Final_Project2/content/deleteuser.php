<?php
//REQUIRES DEPENDENCIES
require_once('../functions/sessionHelper.php');
require_once('../database/settings.php');


//CHECKS IF USER IS AUTHENTICATED
session_start();
if (sessionHelper::check() == false){
    echo 'Only admins can delete users.';
    require_once('publicheader.php');
    die();

}

// CHECKS ROLE.
$query = $connection->prepare('SELECT Role FROM users WHERE User_ID = ?');                        
$query->execute([$_SESSION['userID']]);
$result = $query->fetch();



// IF ADMIN
if ($result['Role'] == 3){

    $query = $connection->prepare('DELETE FROM users WHERE User_ID = ?');
    $query->execute([$_GET['User_ID']]);
    $query->fetch();
    header('location:index.php');
}