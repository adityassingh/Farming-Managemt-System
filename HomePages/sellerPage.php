<?php
session_start();

#if no user login and going without login then rdirect to main homepage
if (!isset($_SESSION['username'])) {
  # code...
  header('Location:../index.php?error=You have to login First!');
  exit();
}


include_once '../includes/dbhsell.inc.php';
include_once '../includes/dbhadv.inc.php';

if (isset($_POST['updateSup'])) {

  $fname = $_POST['sname'];
  $femail = $_POST['semail'];
  $funame = $_POST['suname'];
  $sphone = $_POST['sphone'];
  
  $id = $_POST['sid'];
 


  // Create connection
$conn = new mysqli('localhost', 'root', 'mysql', 'farmers');
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// sql to update a record
$sql = "UPDATE sellers_details SET name='$fname',email='$femail',uname='$funame',phone='$sphone' WHERE id = '$id'";

if ($conn->query($sql) === TRUE) {
    header('Location:sellerPage.php?success=Profile  Updated!');
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
  # code...
}


?>


<?php  
if (isset($_POST['postadv'])) {
 $supemail = $_POST['sup_email'];
 $crpname = $_POST['crpname'];
 $qty = $_POST['qty'];
 $mob = $_POST['mob'];
 


  # Handle Empty Fields
 if (empty($crpname) || empty($qty)) {
   header('Location:sellerPage.php?error=Fields Empty!');
   exit();
 }
 else
 {
 
    # check for username aviliable or not
    
   #echo 'working!';
  $status = "Pending";
        // Attempt insert query execution
$sql = "INSERT INTO advertise (cp_name,cp_qty,sup_email,sup_mob,status) VALUES ('$crpname', '$qty', '$supemail','$mob','$status')";
if(mysqli_query($connection, $sql)){
   header('Location:sellerPage.php?success=Advertise Posted!');
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($connection);
}
 
// Close connection
mysqli_close($connection);
    
  }
}

if (isset($_POST['aptcrop'])) {
  # code...
  $key = $_POST['key'];
  $buyer_email=$_POST['buyer_email'];
        // Attempt insert query execution
$sql = "UPDATE advertise set status ='Accepted',buyer_email='$buyer_email' WHERE id='$key'";
if(mysqli_query($connection, $sql)){
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($connection);
}
 




$status = "Accepted";
        // Attempt insert query execution
$sql = "UPDATE cropd_details set status ='$status' WHERE cropd_id='$key'";
if(mysqli_query($connection, $sql)){
   header('Location:sellerPage.php?success=Crop Successfully Accepted!');
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
      <title>Sellers-Dashboard</title>
      <!--Google Fonts-->
      <link href="https://fonts.googleapis.com/css?family=Staatliches&display=swap" rel="stylesheet">
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="../css/materialize.min.css"  media="screen,projection"/>

      <!--Sweetalert-->
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>

    <body>

      <!--Navbar-->
      <div class="navbar-fixed">
      <nav class="amber">
    <div class="nav-wrapper container">
      <a href="../" class="brand-logo">FM</a>
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
         
    <li><a href="../SellerAuth/index.php">LogIn</a></li>';
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
         
    <li><a href="../SellerAuth/index.php">LogIn</a></li>';
   }

    ?>
    
  </ul>

      <div class="container">
        <div class="row">
         <div class="col s12">
          <br><br><br>
      
             <?php

             $selleremail = $_SESSION['username'];


    $sql = "SELECT * FROM sellers_details WHERE email='$selleremail'";
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
        echo '<center><a href="#modal';echo $row['id'];echo'" class="btn btn-floating purple modal-trigger"><i class="material-icons">edit</i></a></center>';
      }
    }

    ?>
          
         
         </div>
       </div>
      </div>


      <!--triggers for messages & errors-->


       <div class="container">
         


        <ul class="collapsible">
    <li>
      <div class="collapsible-header"><i class="material-icons">star</i>Post Advertise</div>
      <div class="collapsible-body">
        <div class="row">
    <form class="col s12" action="" method="POST">
      <div class="row">
        <div class="input-field col s6">
          <?php

             $selleremail = $_SESSION['username'];


    $sql = "SELECT email FROM sellers_details WHERE email='$selleremail'";
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
        echo '<input id="suppemail" type="text" class="validate"  readonly value="';
        echo $row['email'];
        echo '" name="sup_email">';
      }
    }

    ?>
          
          <label for="suppemail">Supplier Email</label>
        </div>
         <div class="input-field col s6">
          <input id="crpname" type="text" class="validate" name="crpname">
          <label for="crpname">Crop Name</label>
        </div>
      </div>
     
      <div class="row">
        <div class="input-field col s6">
          <input id="qty" type="text" class="validate" name="qty">
          <label for="qty">Required Quantity</label>
        </div>
        <div class="input-field col s6">
          <?php

             $selleremail = $_SESSION['username'];


    $sql = "SELECT phone FROM sellers_details WHERE email='$selleremail'";
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
        echo '<input id="mob" type="text" class="validate"  readonly value="';
        echo $row['phone'];
        echo '" name="mob">';
      }
    }

    ?>
          <label for="mob">Supplier Mobile No.</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input name="postadv" type="submit" value="POST" class="btn btn-small red">
         
        </div>
      </div>
    </form>
   
  </div>
      </div>
    </li>
    <li>
      <div class="collapsible-header"><i class="material-icons">star</i>Crops Recived</div>
      <div class="collapsible-body">
        <form action="" method="POST">
        <table>
        <thead>
          <tr>
              
              <th>Crop Id</th>
              <th>Farmer Id</th>
              <th>Farmer Name</th>
              <th>Crop Name</th>
              <th>Quantity</th>
              <th>Amount</th>
              <th>Current Status</th>
              <th>Farmer Email</th>
              <th>Action</th>
          </tr>
        </thead>
        <tbody>
            <?php

            $status="In Progress";
            $email=$_SESSION['username'];


    $sql = "SELECT * FROM cropd_details WHERE sup_email='$email'";
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
        echo '<tr><td><input type="text" value="';echo $row['cropd_id'];echo'" name="key" readonly></td>';
        echo '<td>'.$row['farmer_id'].'</td>';
        echo '<td>'.$row['farmer_name'].'</td>';
        echo '<td>'.$row['crop_name'].'</td>';
        echo '<td>'.$row['req_qty'].'</td>';
        echo '<td>'.$row['amount'].'</td>';
        echo '<td>'.$row['status'].'</td>';
        echo '<td><input type="text" value="';echo $row['buyer_email'];echo'" name="buyer_email" readonly></td>';
         echo '<td><input type="submit" class="btn btn-small indigo" name="aptcrop" value="YES"></td></tr>';
          
          
        
      }
    }

    ?>
  </tbody>
</table>
</form>
      </div>
    </li>
   
  </ul>
      </div>




      <!--SUPPLIER PROFILE UPDATE-->

      <?php

      $useremail=$_SESSION['username'];


    $sql = "SELECT * FROM sellers_details WHERE email='$useremail'";
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
       echo '<div id="modal';echo $row['id'];
       echo'" class="modal">
    <div class="modal-content">
      <div class="row">
    <form class="col s12" action="" method="POST">
      <div class="row">

      <div class="input-field col s6">
          <input placeholder="Placeholder" id="farmer_id" type="text" class="validate" name="sid" value="';echo $row['id'];echo'" readonly>
          <label for="sup_id">Id</label>
        </div>
        <div class="input-field col s6">
          <input placeholder="Placeholder" id="farmer_name" type="text" class="validate" name="sname" value="';echo $row['name'];echo'">
          <label for="sup_name">Name</label>
        </div>
        
      </div>
      <div class="row">
        <div class="input-field col s4">
          <input id="sup_email" type="text" class="validate" name="semail" value="';echo $row['email'];echo'" readonly>
          <label for="sup_email">Email</label>
        </div>
        <div class="input-field col s4">
          <input id="sup_username" type="text" class="validate" name="suname" value="';echo $row['uname'];echo'">
          <label for="sup_username">Username</label>
        </div>
        <div class="input-field col s4">
          <input id="farm_username" type="text" class="validate" name="sphone" value="';echo $row['phone'];echo'">
          <label for="farm_username">Phone</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <input name="updateSup" type="submit" class="btn btn-small indigo" value="UPDATE">
         
        </div>
      </div>
    </form>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
    </div>
  </div>';
      }
    }

    ?>
  





      


      <!--jquery-->
      <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

      <!--JavaScript at end of body for optimized loading-->
      <script type="text/javascript" src="../js/materialize.min.js"></script>


      <script type="text/javascript">
         $(document).ready(function(){
    $('.sidenav').sidenav();
     $('.collapsible').collapsible();
     $('.modal').modal();
  });
      </script>


      <?php if (isset($_GET['error'])) {
      $error = $_GET['error'];
       echo '<script type="text/javascript">
        swal("Invalid!",';echo $error;echo', "error");
      </script>';
     } ?>

     <?php if (isset($_GET['success'])) {
      $message = $_GET['success'];
       echo '<script type="text/javascript">
        swal("success!","';echo $message;echo'", "success");
      </script>';
     } ?>

    </body>
  </html>