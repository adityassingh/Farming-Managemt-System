<?php
session_start();

#if no user login and going without login then rdirect to main homepage
if (!isset($_SESSION['username'])) {
  # code...
  header('Location:../index.php?error=You have to login First!');
  exit();
}
include_once '../includes/dbhfarm.inc.php';

$cp_name = $_GET['crop_name'];
$crop_id = $_GET['id'];
$qty = $_GET['qty'];




if (isset($_POST['sell_crp'])) {
  # code...
  $crp_id = $_POST['crp_id'];
  $farmerid = $_POST['farmerid'];
  $farmername = $_POST['farmername'];
  $crp_name = $_POST['crp_name'];
  $crp_qty = $_POST['crp_qty'];
  $crp_amount = $_POST['crp_amount'];

  # first update adverisement table

  $message = 'In Progress';
      
   $sql = "UPDATE advertise set status = '$message' WHERE id = '$crp_id'";
if(mysqli_query($connection, $sql)){
   #header('Location:sell_crop.php?success=Your Crop Sell Request Submitted Wait for Supplier Response');
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($connection);
}
 
// Close connection
$status = "In Progress";
      $sql = "INSERT INTO cropd_details (cropd_id,farmer_id,farmer_name,crop_name,req_qty,amount,status) VALUES ('$crp_id','$farmerid','$farmername','$crp_name','$crp_qty','$crp_amount','$status')";
if(mysqli_query($connection, $sql)){
   header('Location:sell_crop.php?success=Your Crop sell Request is submited wait for Supplier!');
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($connection);
}
 
// Close connection
mysqli_close($connection);



}


?>
<!DOCTYPE html>
  <html>
    <head>
      <title>Sell-Crop</title>
      <!--Google Fonts-->
      <link href="https://fonts.googleapis.com/css?family=Staatliches&display=swap" rel="stylesheet">
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="../css/materialize.min.css"  media="screen,projection"/>
      

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

       <style type="text/css">
        body
        {
          margin: 0;
          padding: 0;
        }
        
      </style>
    </head>

    <body>

      <!--Navbar-->
      <div class="navbar-fixed">
      <nav class="amber">
    <div class="nav-wrapper container">
      <a href="FarmerPage.php" class="brand-logo"><i class="material-icons">arrow_backward</i></a>
      <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
     <?php 

     if (isset($_SESSION['username'])) {
       echo  '<ul class="right hide-on-med-and-down">
         <li><a href="#">';echo $_SESSION['username'];
         echo'</a></li>
    <li><a href="logout.php">Logout</a></li>
     ';
   }

   else
   {
    echo  '<ul class="right hide-on-med-and-down">
         
    <li><a href="../FarmerAuth/index.php">LogIn</a></li>';
   }

    ?>
    
        
      </ul>
    </div>
  </nav>
</div>


 <!--Side Nav-->

  <?php 

     if (isset($_SESSION['username'])) {
       echo  '<ul class="sidenav" id="mobile-demo">
         <li><a href="#">';echo $_SESSION['username'];
         echo'</a></li>
    <li><a href="logout.php">Logout</a></li>
     ';
   }

   else
   {
    echo  '<ul class="sidenav" id="mobile-demo">
         
    <li><a href="../FarmerAuth/index.php">LogIn</a></li>';
   }

    ?>
    
  </ul>

      <div class="container">

       <div class="row">
         <div class="col s12">
          <br><br><br>
          
           <?php

             $selleremail = $_SESSION['username'];


    $sql = "SELECT * FROM farmers_details WHERE email='$selleremail'";
    $stmt = mysqli_stmt_init($connection);
    if (!mysqli_stmt_prepare($stmt,$sql)) {
    echo 'There is An Error while Fetching Data!';
    exit();
    }
    else {
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);

      while($row=mysqli_fetch_assoc($result))
      {
        echo '<h3 class="center">'.$row['name'].'</h3>';
      }
    }?>

           <center><a href="logout.php" class="btn btn-floating purple"><i class="material-icons">exit_to_app</i></a></center>
         </div>
       </div>
      </div>


      <div class="container">
        <?php if (isset($_GET['success'])) {
          # code...
          echo '<p class="red-text" align="center">'.$_GET['success'].'</p>';
        } ?>
        <div class="row">
    <form class="col s12" action="" method="POST">
      <div class="row">
        <div class="input-field col s6">
          <input id="crp_id" type="text" class="validate" value="<?php echo $crop_id; ?>" readonly name="crp_id">
          <label for="crp_id">Crop Id</label>
        </div>
        <div class="input-field col s6">
          <?php

             $selleremail = $_SESSION['username'];


    $sql = "SELECT id FROM farmers_details WHERE email='$selleremail'";
    $stmt = mysqli_stmt_init($connection);
    if (!mysqli_stmt_prepare($stmt,$sql)) {
    echo 'There is An Error while Fetching Data!';
    exit();
    }
    else {
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);

      while($row=mysqli_fetch_assoc($result))
      {
        echo '<input id="farmerid" type="text" class="validate"  readonly value="';
        echo $row['id'];
        echo '" name="farmerid">';
      }
    }

    ?>
          <label for="farmerid">Farmer Id</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <?php

             $selleremail = $_SESSION['username'];


    $sql = "SELECT name FROM farmers_details WHERE email='$selleremail'";
    $stmt = mysqli_stmt_init($connection);
    if (!mysqli_stmt_prepare($stmt,$sql)) {
    echo 'There is An Error while Fetching Data!';
    exit();
    }
    else {
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);

      while($row=mysqli_fetch_assoc($result))
      {
        echo '<input id="farmername" type="text" class="validate"  readonly value="';
        echo $row['name'];
        echo '" name="farmername">';
      }
    }

    ?>
          <label for="fname">Farmer Name</label>
        </div>
        <div class="input-field col s6">
          <input id="crp_name" type="text" class="validate" readonly value="<?php echo $cp_name; ?>" name="crp_name">
          <label for="crp_name">Crop Name</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <input id="crp_qty" type="text" class="validate" value="<?php echo $qty; ?>" readonly name="crp_qty">
          <label for="crp_qty">Required Quantity</label>
        </div>

       <div class="input-field col s6">
          <input id="crp_amount" type="text" class="validate" name="crp_amount">
          <label for="crp_amount">Rupees</label>
        </div>
      </div>
      <div class="row">
        
         <div class="input-field col s6">
          <input type="submit" class="btn btn-small indigo" value="Sell" name="sell_crp">
          
        </div>
      </div>
    </form>
  </div>
        

      </div>


      

      


      <!--jquery-->
      <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

      <!--JavaScript at end of body for optimized loading-->
      <script type="text/javascript" src="../js/materialize.min.js"></script>


      <script type="text/javascript">
         $(document).ready(function(){
    $('.sidenav').sidenav();
     $('.collapsible').collapsible();
  });
      </script>
    </body>
  </html>