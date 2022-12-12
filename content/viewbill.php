<?php

//REQUIRES DEPENDENCIES
require_once('../functions/sessionHelper.php');
require_once('../database/settings.php');


//CHECKS IF USER IS AUTHENTICATED
session_start();
if (sessionHelper::check() == false){
    echo 'Please create an account or sign in to view bills.';
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
    <?php

    $query = $connection->prepare('SELECT * FROM `docs/bills` WHERE Tenant_ID = ?');
    $query->execute([$_GET['Tenant_ID']]);
    $bills = array();
  while ($row = $query->fetch()){
      $bills[] = $row;
  }

  $i = 1;
  foreach ($bills as $bill){
    ?>
    <style>
    p{text-align: center;}
    h6{text-align: center;}

</style>
<div class="col d-flex justify-content-center">

 

<div class="card" style="width: 18rem;">
<div class="card-body">

<p class="card-text">

 

<b><h6>Bill # <?php echo $i?></h6></b>
<p>Document Data: <?php echo $bill['Doc_Data']?></p>
<p>Price: <?php echo $bill['Price']?></p>
<p>Due Date: <?php echo $bill['Due_Date']?></p>
<p>Bill Status: <?php echo $bill['Status']?></p>
<a href="modifybill.php?Doc_ID=<?php echo$bill['Doc_ID']?>" class="btn btn-primary">Modify Bill</a><br><br>
<a href="deletebill.php?Doc_ID=<?php echo$bill['Doc_ID']?>" class="btn btn-primary">Delete Bill</a></p>
</div>
</div>
</div>
   
    <br>
    <br>
    <?php

    $i++;
  }




}