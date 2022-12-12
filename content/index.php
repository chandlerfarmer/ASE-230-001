
<?php
require_once('../functions/sessionHelper.php');
require_once('../database/settings.php');
//require_once('header2.php');


//CHECKS IF USER IS AUTHENTICATED (PUBLIC INTERFACE IF USER ISNT AUTHENTICATED)
session_start();
if (sessionHelper::check() == false){

  require_once('publicheader.php')
  ?>
  <h1> Available Houses:</h1>
  <?php
  
  $query = $connection->prepare('SELECT * FROM home WHERE is_available = ?');
  $query->execute(['0']);
  $houses = array();
  while ($row = $query->fetch()){
      $houses[] = $row;
  }
  
  foreach ($houses as $house){
    echo "<br>";
?>
      <!--cards-->
  <div class="card" style="width: 18rem;">
  <img class="card-img-top" src="<?php echo $house['Picture']?>" alt="Card image cap">
  <div class="card-body">
  <h5 class="card-title"><?php echo $house['street']." ".$house['city']." ".$house['state']?></h5>
  <p class="card-text">Bedrooms: <?php echo $house['Bedrooms']?><br>Bathrooms: <?php echo $house['Baths']?><br>sqft: <?php echo $house['Sq_Feet']?></p>
  <a href="detail.php?Home_ID=<?php echo$house['Home_ID']?>" class="btn btn-primary">More Info</a>
  </div>
  </div>
  <?php
  }  

  die();
}


// CHECKS ROLE.
$query = $connection->prepare('SELECT Role FROM users WHERE User_ID = ?');                        
$query->execute([$_SESSION['userID']]);
$result = $query->fetch();



//IF Landlord
if ($result['Role'] == 0){
  require_once('header2.php');
  ?>
  <h1>Welcome, here is your portfolio! </h1>
  <?php

    $query = $connection->prepare('SELECT * FROM home WHERE user_ID = ?');
    $query->execute([$_SESSION['userID']]);
    $houses = array();
    while ($row= $query->fetch()){
        $houses[] = $row;
    }
    foreach ($houses as $house){
        echo "<br>";
?>
        <!--cards-->
<div class="card" style="width: 18rem;">
  <img class="card-img-top" src="<?php echo $house['Picture']?>" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title"><?php echo $house['street']." ".$house['city']." ".$house['state']?></h5>
    <p class="card-text">Bedrooms: <?php echo $house['Bedrooms']?><br>Bathrooms: <?php echo $house['Baths']?><br>sqft: <?php echo $house['Sq_Feet']?></p>
    <a href="detail.php?Home_ID=<?php echo$house['Home_ID']?>" class="btn btn-primary">More Info</a>
  </div>
</div>
<?php
    }
 
}   


//IF TENANT
if ($result['Role'] == 1){
  require_once('tenantheader.php');
  ?>
  <h1> Available Houses:</h1>
  <?php

  $query = $connection->prepare('SELECT * FROM home WHERE is_available = ?');
  $query->execute(['0']);
  $houses = array();
  while ($row = $query->fetch()){
      $houses[] = $row;
  }

  foreach ($houses as $house){
    echo "<br>";
?>
    <!--cards-->
<div class="card" style="width: 18rem;">
<img class="card-img-top" src="<?php echo $house['Picture']?>" alt="Card image cap">
<div class="card-body">
<h5 class="card-title"><?php echo $house['street']." ".$house['city']." ".$house['state']?></h5>
<p class="card-text">Bedrooms: <?php echo $house['Bedrooms']?><br>Bathrooms: <?php echo $house['Baths']?><br>sqft: <?php echo $house['Sq_Feet']?></p>
<a href="detail.php?Home_ID=<?php echo$house['Home_ID']?>" class="btn btn-primary">More Info</a>
</div>
</div>
<?php
}  
}

//IF ADMIN
if ($result['Role'] == 3){






  ?>
  <a href="createhouse.php" class="btn btn-primary">Create House</a>
  <a href="createtenant.php" class="btn btn-primary">Create Tenant</a>
  <a href="../login/signup.php" class="btn btn-primary">Create User</a>
   <h1> All Houses</h1>
  <?php
  require_once('adminheader.php');


  //HOUSE INFORMATION
  $houses = array();
  $query = $connection->query('SELECT * FROM home');
  while ($row = $query->fetch()){
    $houses[] = $row;
  }
  


  foreach ($houses as $house){



    ?>

       <!--cards-->
<div class="card" style="width: 18rem;">
<img class="card-img-top" src="<?php echo $house['Picture']?>" alt="Card image cap">
<div class="card-body">
<h5 class="card-title"><?php echo $house['street']." ".$house['city']." ".$house['state']?></h5>
<p class="card-text">Bedrooms: <?php echo $house['Bedrooms']?><br>Bathrooms: <?php echo $house['Baths']?><br>sqft: <?php echo $house['Sq_Feet']?></p>
<a href="deletehouse.php?Home_ID=<?php echo$house['Home_ID']?>" class="btn btn-primary">Delete</a>
<a href="modifyHouse.php?Home_ID=<?php echo$house['Home_ID']?>" class="btn btn-primary">Modify</a>
</div>
</div>
<br>
<br>
<br>
<?php
  }


  //USER INFORMATION
  $users = array();
  $query = $connection->query('SELECT * FROM users');
  while ($row = $query->fetch()){
    $users[] = $row;
  }
?>
<h1>All Users</h1>
<?php
  foreach ($users as $user){

    ?>

<div class="card" style="width: 18rem;">
<div class="card-body">
<p>First Name: <?php echo $user['First_Name']?></p>
<p>Last Name: <?php echo $user['Last_Name']?></p>
<a href="deleteuser.php?User_ID=<?php echo $user['User_ID']?>" class="btn btn-primary">Delete</a>
<a href="modifyuser.php?User_ID=<?php echo $user['User_ID']?>" class="btn btn-primary">Modify</a>

</div>
</div>
<br>
<?php
  }


  //ALL OF THE LANDLORDS TENANTS
  ?>
  <br><br>
  <h1>Landlords Tenants</h1>
  <?php

  $tenants = array();
  $query = $connection->query('SELECT * FROM tenants');
  while ($row = $query->fetch()){
    $tenants[] = $row;
  }



  foreach ($tenants as $tenant){
    ?>

<div class="card" style="width: 18rem;">
<div class="card-body">
<p>First Name: <?php echo $tenant['First_Name']?></p>
<p>Last Name: <?php echo $tenant['Last_Name']?></p>

<a href="deletetenant.php?Tenant_ID=<?php echo $tenant['Tenant_ID']?>" class="btn btn-primary">Delete</a>
<a href="modifytenant.php?Tenant_ID=<?php echo $tenant['Tenant_ID']?>" class="btn btn-primary">Modify</a>
</div>
</div>
<br>




<?php
  }
  ?>
  <h1>All Bills</h1>
  <?php

  //BILLING INFORMATION
  $bills = array();
  $query = $connection->query('SELECT * FROM `docs/bills`');
  while ($row = $query->fetch()){
    $bills[] = $row;
  }


  foreach ($bills as $bill){
    ?>

<div class="card" style="width: 18rem;">
<div class="card-body">
<p>Bill Data: <?php echo $bill['Doc_Data']?></p>

<a href="deletebill.php?Doc_ID=<?php echo $bill['Doc_ID']?>" class="btn btn-primary">Delete</a>
<a href="modifybill.php?Doc_ID=<?php echo $bill['Doc_ID']?>" class="btn btn-primary">Modify</a>
</div>
</div>
<br>

<?php
  }



















}









?>
<br>
<?php
require_once('footer2.php');
?>