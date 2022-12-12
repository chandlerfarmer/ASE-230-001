
<?php
//signup
require_once('../database/settings.php');
require_once('../functions/sessionHelper.php');
require_once('../header3.php');

session_start();

if (sessionHelper::check() == true){
    // CHECKS ROLE.
    $query = $connection->prepare('SELECT Role FROM users WHERE User_ID = ?');                        
    $query->execute([$_SESSION['userID']]);
    $result = $query->fetch();
    if ($result['Role'] != 3){
        header('location: ../content/index.php');
    }
}

// CHECKS TO SEE IF THE USER ENTERED EVERYTHING
if (!empty($_POST['fn']) && !empty($_POST['ln']) && !empty($_POST['phone']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['role'])){
    
    // CHECKS TO SEE IF THE EMAIL IS ALREADY BEING USED
    $query = $connection->prepare('SELECT Email FROM users WHERE Email = ?');  
    $query->execute([$_POST['email']]);                            
    $result = $query->fetch();  

    // THE EMAIL IS AVAILABLE.
    if ($result == ''){ 

        if ($_POST['role'] == 'Landlord'){  // THE USER IS A LANDLORD
            $role = 0;
        }
        if ($_POST['role'] == 'Tenant'){    // THE USER IS A TENANT
            $role = 1;
        }

        $hash_passwd = password_hash($_POST['password'], PASSWORD_DEFAULT); // HASH THE USERS PASSWORD

        // CREATES A NEW USER
        $query = $connection->prepare(' INSERT INTO `users` (`User_ID`, `First_Name`, `Last_Name`, `Password`, `Email`, `Phone_Number`, `Role`) VALUES ( NULL, ?, ?, ?, ?, ?, ?)');
        $query->execute([$_POST['fn'], $_POST['ln'], $hash_passwd, $_POST['email'], $_POST['phone'], $role]);
        echo 'Hi '.$_POST['fn']. ', your account was successfully created!';
    }
    

    // DONT CREATE THE ACCOUNT IF THE EMAIL IS TAKEN
    else{               
        echo 'The email entered is already associated with an acccount.';
    }
}
?>
<style>
    form {
        text-align: center;
    }


</style>

<h1>Sign Up Here!</h1>
<form method="POST">
    <input type="text" name="fn" placeholder="First Name"/>
    <br>
    <input type="text" name="ln" placeholder="Last Name" />
    <br>
    <input type="text" name="phone" placeholder="Phone Number" />
    <br>
    <input type="email" name="email" placeholder="Email" />
    <br>
    <input type="password" name="password" placeholder="password" />
    <br>
    <label for="role">Choose a Role:</label><br>
    <select name="role" id="role">
        <option value="Landlord">Landlord</option>
        <option value="Tenant">Tenant</option>
    </select>
    <br><br>
    <button type="submit">Sign Up </button>
</form>

<?php 
require_once('../footer.php');
?>
