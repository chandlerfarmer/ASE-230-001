<?php

//REQUIRES DEPENDENCIES
require_once('../functions/sessionHelper.php');
require_once('../database/settings.php');


//CHECKS IF USER IS AUTHENTICATED
session_start();
if (sessionHelper::check() == false){
    echo 'Please sign in.';
    header('../login/signin.php');
    die();
}

// CHECKS ROLE.
$query = $connection->prepare('SELECT Role FROM users WHERE User_ID = ?');                        
$query->execute([$_SESSION['userID']]);
$result = $query->fetch();



// IF Landlord
if ($result['Role'] == 0 || $result['Role'] == 3){

    $query = $connection->prepare('DELETE FROM home WHERE Home_ID = ?');
    $query->execute([$_GET['Home_ID']]);
    $result = $query->fetch();
    header('location:index.php');

}