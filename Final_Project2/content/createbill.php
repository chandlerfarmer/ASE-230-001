<?php

//REQUIRES DEPENDENCIES
require_once('../functions/sessionHelper.php');
require_once('../database/settings.php');


//CHECKS IF USER IS AUTHENTICATED
session_start();
if (sessionHelper::check() == false){
    echo 'Please create an account or sign in to create bills.';
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



    if (!empty($_POST['data']) && !empty($_POST['price']) && !empty($_POST['date']) && !empty($_POST['status'])){

        $query = $connection->prepare('INSERT INTO `docs/bills` (`Doc_ID`, `Tenant_ID`, `Doc_Data`, `Price`, `Status`, `Due_Date`) VALUES (NULL, ?, ?, ?, ?, ?)');
        $query->execute([$_GET['Tenant_ID'], $_POST['data'], $_POST['price'], $_POST['status'], $_POST['date']]);
        $query->fetch();
        header('location:tenants.php');




}




?>


<h1>Create a Bill</h1>
<style>
    form {
        text-align: center;
    }
</style>
<form method="POST">
    <input type="text" name="data" placeholder="Bill Information" />
    <br>
    <input type="text" name="price" placeholder="Price" />
    <br>
    <input type="text" name="date" placeholder="Due Date" />
    <br>
    <input type="tel" name="status" placeholder="Status" />
    <br>
    <button type="submit">Create </button>
</form>

    <?php
}