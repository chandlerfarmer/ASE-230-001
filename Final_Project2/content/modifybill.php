<?php

//REQUIRES DEPENDENCIES
require_once('../functions/sessionHelper.php');
require_once('../database/settings.php');


//CHECKS IF USER IS AUTHENTICATED
session_start();
if (sessionHelper::check() == false){
    echo 'Please create an account or sign in to modify bills.';
    require_once('publicheader.php');
    die();

}

// CHECKS ROLE.
$query = $connection->prepare('SELECT Role FROM users WHERE User_ID = ?');                        
$query->execute([$_SESSION['userID']]);
$result = $query->fetch();



// IF Landlord
if ($result['Role'] == 0 || $result['Role'] == 3){

    $query = $connection->prepare('SELECT * FROM `docs/bills` WHERE Doc_ID = ?');
    $query->execute([$_GET['Doc_ID']]);
    $documentData = $query->fetch();

    require_once('header2.php');



    if (!empty($_POST['data']) && !empty($_POST['price']) && !empty($_POST['date']) && !empty($_POST['status'])){

        $query = $connection->prepare('UPDATE `docs/bills` SET `Doc_Data` = ?, `Price` = ?, `Status` = ?, `Due_Date` = ? WHERE `docs/bills`.`Doc_ID` = ?');
        $query->execute([$_POST['data'], $_POST['price'], $_POST['status'], $_POST['date'], $_GET['Doc_ID']]);
        $query->fetch();
        if ($result['Role'] == 0){
            header('location:tenants.php');
    
        }
        if ($result['Role'] == 3){
            header('location:index.php');
        }
    }

?>
<h1>Modify a Bill</h1>
<style>
    form {
        text-align: center;
    }
</style>
<form method="POST">
    <p>Bill Data:</p>
    <input type="text" name="data" value="<?php echo $documentData['Doc_Data']?>" />
    <br>
    <p>Price:</p>
    <input type="text" name="price" value="<?php echo $documentData['Price']?>" />
    <br>
    <p>Due Date:</p>
    <input type="text" name="date" value="<?php echo $documentData['Due_Date']?>" />
    <br>
    <p>Bill Status:</p>
    <input type="tel" name="status" value="<?php echo $documentData['Status']?>" />
    <br>
    <button type="submit">Modify </button>
</form>
<?php

}