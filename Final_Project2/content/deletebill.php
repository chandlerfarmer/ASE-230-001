<?php
//REQUIRES DEPENDENCIES
require_once('../functions/sessionHelper.php');
require_once('../database/settings.php');


//CHECKS IF USER IS AUTHENTICATED
session_start();
if (sessionHelper::check() == false){
    echo 'Please create an account or sign in to delete bills.';
    require_once('publicheader.php');
    die();

}

// CHECKS ROLE.
$query = $connection->prepare('SELECT Role FROM users WHERE User_ID = ?');                        
$query->execute([$_SESSION['userID']]);
$result = $query->fetch();



// IF Landlord
if ($result['Role'] == 0 || $result['Role'] == 3){
    $query = $connection->prepare('DELETE FROM `docs/bills` WHERE `docs/bills`.`Doc_ID` = ? ');
    $query->execute([$_GET['Doc_ID']]);
    $query->fetch();
    if ($result['Role'] == 0){
        header('location:tenants.php');

    }
    if ($result['Role'] == 3){
        header('location:index.php');
    }
}