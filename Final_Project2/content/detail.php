<h1>Home Details </h1>



<?php


//REQUIRES DEPENDENCIES
require_once('../functions/sessionHelper.php');
require_once('../database/settings.php');



//CHECKS IF USER IS AUTHENTICATED
session_start();
if (sessionHelper::check() == false){
    require_once('publicheader.php');
    echo 'Please create an account or sign in to view home details.';
    die();
}



// CHECKS ROLE.
$query = $connection->prepare('SELECT Role FROM users WHERE User_ID = ?');                        
$query->execute([$_SESSION['userID']]);
$result = $query->fetch();


// IF Landlord
if ($result['Role'] == 0){
    require_once('header2.php');

    $homeID = $_GET['Home_ID'];
    $query = $connection->prepare('SELECT * FROM home WHERE Home_ID = ?');
    $query->execute([$_GET['Home_ID']]);
    $result = $query->fetch();


    if ($result['is_available'] == '0'){
        $status = 'No';
    }
    if ($result['is_available'] == '1'){
        $status = 'Yes';
    }

?>
<style>
    p{text-align: center;}
    h6{text-align: center;}

</style>
<div class="col d-flex justify-content-center">

 

<div class="card" style="width: 18rem;">
<div class="card-body">

<p class="card-text"><h6> Square Feet: <?php echo $result['Sq_Feet']?></h6>
<h6> Bedrooms: <?php echo $result['Bedrooms']?></h6>
<h6> Bathrooms: <?php echo $result['Baths']?></h6>
<h6> Year-Built: <?php echo $result['Year_Built']?></h6>
<h6> School District: <?php echo $result['School_District']?></h6>
<h6> Street: <?php echo $result['street']?></h6>
<h6> City: <?php echo $result['city']?></h6>
<h6> State: <?php echo $result['state']?></h6>
<h6> Zip: <?php echo $result['zip']?></h6>
<h6> Bio: <?php echo $result['Bio']?></h6>
<h6>Rented: <?php echo $status?></h6> </p>
<a href="modifyHouse.php?Home_ID=<?php echo $_GET['Home_ID']?>" class="btn btn-primary">Modify Home</a>
<br><br>
<a href="deletehouse.php?Home_ID=<?php echo $_GET['Home_ID']?>" class="btn btn-primary">Delete Home</a>
</div>
</div>
</div>

 


<img class="card-img-top" src="<?php echo $result['Picture']?>" alt="Card image cap">

 

<?php

 

require_once('footer2.php');
die();
}

 

//IF TENANT
if ($result['Role'] == 1){
    require_once('tenantheader.php');

 

    $homeID = $_GET['Home_ID'];
    $query = $connection->prepare('SELECT * FROM home WHERE Home_ID = ?');
    $query->execute([$_GET['Home_ID']]);
    $result = $query->fetch();

 

?>

 

<div class="col d-flex justify-content-center">
<div class="card" style="width: 18rem;">
<div class="card-body">
<p class="card-text">
<h6> Square Feet: <?php echo $result['Sq_Feet']?></h6>
<h6> Bedrooms: <?php echo $result['Bedrooms']?></h6>
<h6> Bathrooms: <?php echo $result['Baths']?></h6>
<h6> Year-Built: <?php echo $result['Year_Built']?></h6>
<h6> School District: <?php echo $result['School_District']?></h6>
<h6> Street: <?php echo $result['street']?></h6>
<h6> City: <?php echo $result['city']?></h6>
<h6> State: <?php echo $result['state']?></h6>
<h6> Zip: <?php echo $result['zip']?></h6>
<h6> Bio: <?php echo $result['Bio']?></h6></p>
</div>
</div>
</div>
<img class="card-img-top" src="<?php echo $result['Picture']?>" alt="Card image cap">

 

<?php

 

}

 

 

require_once('footer2.php');
?>

 