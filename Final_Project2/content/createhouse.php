<?php

//REQUIRES DEPENDENCIES
require_once('../functions/sessionHelper.php');
require_once('../database/settings.php');
require_once('header2.php');


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

    
    // CHECKS TO SEE IF THE USER ENTERED EVERYTHING
    if (!empty($_POST['sqft']) && !empty($_POST['bedrooms']) && !empty($_POST['bathrooms']) && !empty($_POST['school']) && !empty($_POST['yearBuilt']) && !empty($_POST['street']) && !empty($_POST['city']) && !empty($_POST['state']) && !empty($_POST['zip']) && !empty($_POST['bio']) && !empty($_POST['pic']) && !empty($_POST['role'])){
            $query = $connection->prepare('INSERT INTO `home` (`Home_ID`, `user_ID`, `Bio`, `Picture`, `Sq_Feet`, `Bedrooms`, `Baths`, `Year_Built`, `School_District`, `is_available`, `street`, `city`, `state`, `zip`) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)');
            if ($_POST['role'] == 'Rented'){
                $_POST['role'] = '1';
            }
            $query->execute([$_SESSION['userID'], $_POST['bio'], $_POST['pic'], $_POST['sqft'], $_POST['bedrooms'], $_POST['bathrooms'], $_POST['yearBuilt'], $_POST['school'], $_POST['role'], $_POST['street'], $_POST['city'], $_POST['state'], $_POST['zip']]);
            $result = $query->fetch();
            header('location:index.php');
    }
}   
?>

<br>
<style>
    form {
        text-align: center;
    }
</style>
<h1>Create a House</h1>
<form method="POST">
    <input type="text" name="sqft" placeholder="Square Feet" />
    <br>
    <input type="number" name="bedrooms" placeholder="# of Bedrooms" />
    <br>
    <input type="number" name="bathrooms" placeholder="# of Bathrooms" />
    <br>
    <input type="text" name="school" placeholder="School District" />
    <br>
    <input type="number" name="yearBuilt" placeholder="e.g. 2022" />
    <br>
    <input type="text" name="street" placeholder="Street" />
    <br>
    <input type="text" name="city" placeholder="City" />
    <br>
    <input type="text" name="state" placeholder="State" />
    <br>
    <input type="number" name="zip" placeholder="Zip" />
    <br>
    <input type="text" name="bio" placeholder="Bio" />
    <br>
    <input type="url" name="pic" placeholder="Pic Link" />
    <br>
    <label for="role">Choose a Role:</label>
    <select name="role" id="role">
        <option value="Available">Available</option>
        <option value="Rented">Rented</option>
    </select>
    <br>
    <button type="submit">Create </button>
</form>

<?php
require_once('footer2.php');
?>