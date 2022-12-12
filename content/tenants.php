<?php


//REQUIRES DEPENDENCIES
require_once('../functions/sessionHelper.php');
require_once('../database/settings.php');


//CHECKS IF USER IS AUTHENTICATED
session_start();
if (sessionHelper::check() == false){
    echo 'Please create an account or sign in to view our landlords.';
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
    ?>
    <h1>Welcome, here are your tenants! </h1>
    <a href="createtenant.php">
    <div class="row justify-content-center">
<button type="submit" class="btn btn-secondary"><h3>Create Tenant</h3></button>
</div></a>
    <?php




    $query = $connection->prepare('SELECT * FROM home WHERE user_ID = ?');
    $query->execute([$_SESSION['userID']]);
    $houses = array();
    while ($row= $query->fetch()){
        $houses[] = $row;   //STORES ALL HOME DATA
    }
    $house_IDs = array();
    foreach ($houses as $house){
        $house_IDs[] = $house['Home_ID'];   //STORES ALL THE HOME ID'S 
    }
 



    $tenants = array(); //STORES ALL TENANTS
    $query = $connection->prepare('SELECT * FROM tenants WHERE Home_ID = ?');
    for ($x = 0; $x < count($house_IDs); $x++){
        $query->execute([$house_IDs[$x]]);
        while ($row = $query->fetch()){
            $tenants[] = $row;
        }
    }
    $i = 1;
    foreach ($tenants as $tenant){
        ?>
        <style>
        p{text-align: center;}
        h6{text-align: center;}
        h3{text-align: center;
        color: tan;}
    
    
    </style>
    
     
    
    <div class="col d-flex justify-content-center">
    
     
    
    <div class="card" style="width: 18rem;">
    <div class="card-body">
    <p class="card-text">
    <h6>Tenant # <?php echo $i?></h6>
    <p>First Name: <?php echo $tenant['First_Name']?></p>
    <p>Last Name: <?php echo $tenant['Last_Name']?></p>
    <p>Email: <?php echo $tenant['Email']?></p>
    <p> Phone: <?php echo $tenant['Phone_Number']?></p>
    <a href="createbill.php?Tenant_ID=<?php echo $tenant['Tenant_ID']?>" class="btn btn-primary">Create Bill</a> <br><br>
    <a href="viewbill.php?Tenant_ID=<?php echo $tenant['Tenant_ID']?>" class="btn btn-primary">View Bills</a>  <br><br>
    <a href="modifytenant.php?Tenant_ID=<?php echo $tenant['Tenant_ID']?>" class="btn btn-primary">Modify Tenant</a>  <br><br>
    <a href="deletetenant.php?Tenant_ID=<?php echo $tenant['Tenant_ID']?>" class="btn btn-primary">Delete Tenant</a></p>   
    </div>
    </div>
    </div>
    <br>
    <?php
            $i++;
    
        }
    
     
    
    }
    
     
    
    
    //IF TENANT
    if ($result['Role'] == 1){
        require_once('tenantheader.php');
        ?>
    <h1>Welcome, here are our Landlords! </h1>
    <?php
    
     
    
        //ALL LANDLORDS
        $query = $connection->prepare('SELECT * FROM users WHERE role = ?');
        $query->execute(['0']);
        $landlords = array();
        while ($row= $query->fetch()){
            $landlords[] = $row;   //STORES ALL LANDLORD DATA
        }
    
     
    
        $i = 1;
        foreach ($landlords as $landlord){
    
     
    
            ?>
    <div class="col d-flex justify-content-center">
    
     
    
    <div class="card" style="width: 18rem;">
    <div class="card-body">
    <p class="card-text">
    <b><h6>Landlord # <?php echo $i?></h6></b>
    <p>First Name: <?php echo $landlord['First_Name']?></p>
    <p>Last Name: <?php echo $landlord['Last_Name']?></p>
    <p>Email: <?php echo $landlord['Email']?></p>
    <p> Phone: <?php echo $landlord['Phone_Number']?></p></p>
    </div>
    </div>
    </div>
    <br>
    <?php
            $i++;
        }
    
     
    
    }
    
     
    
    require_once('footer2.php');