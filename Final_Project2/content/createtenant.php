

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
    $tempRole = $result['Role']; //USED FOR REDIRECTION AFTER CREATION IS MADE
    

    //WORKING ON DISPLAYING THE AVAILABLE HOUSES INSIDE THE FORM
    $query = $connection->prepare('SELECT * FROM home where User_ID = ?');
    $query->execute([$_SESSION['userID']]);
    $houses = array();
    while ($row= $query->fetch()){
        $houses[] = $row;
    }
}

if (!empty($_POST['fn']) && !empty($_POST['ln']) && !empty($_POST['email']) && !empty($_POST['Phone'])){
    
    //OBTAINS THE HOME ID 
    $query= $connection->prepare('SELECT Home_ID FROM home WHERE street = ?');
    $query->execute([$_POST['role']]);
    $result = $query->fetch();
    $homeID = $result['Home_ID'];

    //CREATES TENANT
    $query = $connection->prepare('INSERT INTO `tenants` (`Tenant_ID`, `Home_ID`, `First_Name`, `Last_Name`, `Email`, `Phone_Number`) VALUES (NULL, ?, ?, ?, ?, ?)');
    $query->execute([$homeID, $_POST['fn'], $_POST['ln'], $_POST['email'], $_POST['Phone']]);
    $result = $query->fetch();
    echo 'Your Tenant was created!';

    //MARKS HOUSE AS UNAVAILABLE IF NOT ALREADY
    $query = $connection->prepare('UPDATE `home` SET `is_available` = ? WHERE `home`.`Home_ID` = ?');
    $query->execute([1, $homeID]);
    $query->fetch();
    if ($tempRole == 3){
        header('location:index.php');
    }
    if ($tempRole == 0){
        header('location:tenants.php');
    }


}



?>
<style>
    form {
        text-align: center;
    }
</style>

<h1>Create a Tenant</h1>
<form method="POST">
    <input type="text" name="fn" placeholder="First Name" />
    <br>
    <input type="text" name="ln" placeholder="Last Name" />
    <br>
    <input type="email" name="email" placeholder="Email" />
    <br>
    <input type="tel" name="Phone" placeholder="Phone" />
    <br>
    <label for="role">House Renting:</label>
    <select name="role" id="role">
        <?php foreach ($houses as $house){  
            ?>
            <option value="<?php echo $house['street']?>"><?php echo $house['street']?></option>
            <?php
        }
        ?>
    </select>
    <br>
    <button type="submit">Create </button>
</form>

<?php
require_once('footer2.php');
?>