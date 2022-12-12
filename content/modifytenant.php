
<br>
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

    //OBTAINS ADDRESSES 
    $query = $connection->prepare('SELECT street FROM home WHERE user_ID = ?');
    $query->execute([$_SESSION['userID']]);
    $streets = array();
    while ($row = $query->fetch()){
        $streets[] = $row;
    }

    //OBTAINS TENANT INFORMATION
    $query = $connection->prepare('SELECT * FROM tenants WHERE Tenant_ID = ?');
    $query->execute([$_GET['Tenant_ID']]);
    $result = $query->fetch();

    //OBTAINS TENANTS CURRENT STREET NAME
    $query = $connection->prepare('SELECT street FROM home WHERE HOME_ID = ?');
    $query->execute([$result['Home_ID']]);
    $tenantsCurrentStreet = $query->fetch();


    //REMOVES TENANTS CURRENT STREET NAME FROM THE LIST OF STREETS
    for ($i = 0; $i < count($streets); $i++){
        if ($streets[$i]['street'] == $tenantsCurrentStreet['street']){
            unset($streets[$i]['street']);
        }
    }
    $streets = array_filter($streets);

    if (count($_POST) > 0){

        $query = $connection->prepare('SELECT Home_ID FROM home WHERE street = ? ');
        $query->execute([$_POST['role']]);
        $result = $query->fetch();

        $homeID = $result['Home_ID'];

        $query = $connection->prepare('UPDATE `tenants` SET `Home_ID` = ?, `First_Name` = ?, `Last_Name` = ?, `Email` = ?, `Phone_Number` = ? WHERE `tenants`.`Tenant_ID` = ?');
        $query->execute([$homeID, $_POST['fn'], $_POST['ln'], $_POST['email'], $_POST['Phone'], $_GET['Tenant_ID']]);
        $query->fetch();
        header('location:tenants.php');
    }
    







?>

<h1>Modify Tenant</h1>
<form method="POST">
    <input type="text" name="fn" value="<?=$result['First_Name']?>" />
    <br>
    <input type="text" name="ln" value="<?=$result['Last_Name']?>" />
    <br>
    <input type="email" name="email" value="<?=$result['Email']?>" />
    <br>
    <input type="tel" name="Phone" value="<?=$result['Phone_Number']?>" />
    <br>
    <label for="role">House Renting:</label>
    <select name="role" id="role">
    <option value="<?php echo $tenantsCurrentStreet['street']?>"><?php echo $tenantsCurrentStreet['street']?></option>
        <?php foreach ($streets as $street){  
            ?>
            <option value="<?php echo $street['street']?>"><?php echo $street['street']?></option>
            <?php
            

        }
        ?>
    </select>
    <br>
    <button type="submit">Modify </button>
</form>
</form>
<style>
    form {
        text-align: center;
    }
    </style>
<?php
}
require_once('footer2.php');

