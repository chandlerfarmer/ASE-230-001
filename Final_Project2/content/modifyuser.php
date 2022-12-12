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



// IF ADMIN
if ($result['Role'] == 3){

    $query = $connection->prepare('SELECT * FROM users WHERE User_ID = ?');
    $query->execute([$_GET['User_ID']]);
    $userInfo = $query->fetch();


    //USER IS LANDLORD
    if ($userInfo['Role'] == 0){
        $status = 'Landlord';
        $status2 = 'Tenant';
    }

    //USER IS TENANT
    if ($userInfo['Role'] == 1){
        $status = 'Tenant';
        $status2 = 'Landlord';
    }



    if (count($_POST) > 0){

        if ($_POST['role'] == "Landlord"){
            $roleValue = 0;
        }
        if ($_POST['role'] == 'Tenant'){
            $roleValue = 1;
        }

        $query = $connection->prepare('UPDATE `users` SET `First_Name` = ?, `Last_Name` = ?, `Email` = ?, `Phone_Number` = ?, `Role` = ? WHERE `users`.`User_ID` = ?');
        $query->execute([$_POST['fn'], $_POST['ln'], $_POST['email'], $_POST['phone'], $roleValue, $_GET['User_ID']]);
        $query->fetch();
        header('location:index.php');

    }


}



?>


<h1>Modify User</h1>
<form method="POST">
    <input type="text" name="fn" value="<?php echo $userInfo['First_Name']?>"/>
    <br>
    <input type="text" name="ln" value="<?php echo $userInfo['Last_Name']?>" />
    <br>
    <input type="text" name="phone" value="<?php echo $userInfo['Phone_Number']?>" />
    <br>
    <input type="email" name="email" value="<?php echo $userInfo['Email']?>" />
    <br>
    <label for="role">Choose a Role:</label><br>
    <select name="role" id="role">
        <option value="<?php echo $status?>"><?php echo $status?></option>
        <option value="<?php echo $status2?>"><?php echo $status2?></option>
    </select>
    <br><br>
    <button type="submit">Modify </button>
</form>