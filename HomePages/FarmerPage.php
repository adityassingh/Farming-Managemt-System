<?php

session_start();
#if no user login and going without login then rdirect to main homepage
if (!isset($_SESSION['username'])) {
  # code...
  header('Location:../index.php?error=You have to login First!');
  exit();
}
include_once '../includes/dbhfarm.inc.php';

if (isset($_POST['updateFarm'])) {

  $fname = $_POST['fname'];
  $femail = $_POST['femail'];
  $funame = $_POST['funame'];
  
  $id = $_POST['fid'];


  // Create connection
$conn = new mysqli('localhost', 'root', 'mysql', 'farmers');
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// sql to delete a record
$sql = "UPDATE farmers_details SET name='$fname',email='$femail',uname='$funame'  WHERE id = '$id'";

if ($conn->query($sql) === TRUE) {
    header('Location:FarmerPage.php?success=Farmer Details Updated!');
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
  # code...
}


#send complaint
if (isset($_POST['sendcp'])) {
  # code...
  $fid =$_POST['fid'];
  $type = $_POST['type'];
  $cp =$_POST['cp'];
  echo $fid;
  echo $type;
  echo $cp;

    // Create connection
$conn = new mysqli('localhost', 'root', 'mysql', 'farmers');
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// sql to delete a record
$sql = "INSERT INTO complains (farmer_id,c_type,d_decription,status)VALUES('$fid','$type','$cp','Unsolved')";

if ($conn->query($sql) === TRUE) {
    header('Location:FarmerPage.php?success=Complain Posted!');
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
}

?>
<!DOCTYPE html>
  <html>
    <head>
      <title>Farmers-Dashboard</title>
      <!--Google Fonts-->
      <link href="https://fonts.googleapis.com/css?family=Staatliches&display=swap" rel="stylesheet">
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="../css/materialize.min.css"  media="screen,projection"/>

      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      

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
        echo '<center><a href="#modal';echo $row['id'];echo'" class="btn btn-floating purple modal-trigger"><i class="material-icons">edit</i></a></center>';
      }
    }?>

           
         </div>
       </div>
      </div>


      <div class="container">
        <?php if (isset($_GET['success'])) {
          # code...
          echo '<p class="teal-text" align="center">'.$_GET['success'].'</p>';
        } ?>
        <ul class="collapsible">
    <li>
      <div class="collapsible-header"><i class="material-icons">star</i>Send Complaint</div>
      <div class="collapsible-body">
        
        <div class="row">
    <form class="col s12" action="" method="POST">
      <div class="row">
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
        echo '<input type="text" class="validate" name="fid" value="';
        echo $row['id'];
        echo'" readonly>';
      }
    }?>
          <label for="fid">Farmer Id</label>
        </div>
        
      </div>
      <div class="row">
        <div class="input-field col s6">
          <select name="type">
      <option value="Uknown" disabled selected>Choose your option</option>
      <option value="Crop Related">Crop Related</option>
      <option value="About Supplier">About Supplier</option>
      <option value="Technical Issue">Technical Issue</option>
    </select>
    <label>Complaint Type</label>
        </div>
        <div class="input-field col s6">
          <input id="cp" type="text" class="validate" name="cp">
          <label for="cp">Comaplain Description</label>
        </div>
      </div>
     
      <div class="row">
        <div class="input-field col s12">
          <button type="submit" class="btn btn-floating" name="sendcp"><i class="material-icons">send</i>
          
        </div>
      </div>
     
    </form>
  </div>
       
      </div>
    </li>
    <li>
      <div class="collapsible-header"><i class="material-icons">star</i>Complain Status</div>
      <div class="collapsible-body">
        <table>
          <thead>
            <tr>
              <th>Complain Id</th>
              <th>Farmer Id</th>
              <th>Type</th>
              <th>Complain</th>
              <th>Status</th>
              
          </tr>
          </thead>
          <tbody>
            <?php


    $sql = "SELECT * FROM complains WHERE status ='Solved' OR status='Unsolved'";
    #something to update here->
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
         echo '<tr><td>'.$row['farmer_id'].'</td>';
        echo '<td>'.$row['farmer_id'].'</td>';
        echo '<td>'.$row['c_type'].'</td>';
        echo '<td>'.$row['d_decription'].'</td>';
        echo '<td>'.$row['status'].'</td></tr>';
        

        
      
      }
    }

    ?>
  </tbody>
</table>
      </div>
    </li>
    <li>
      <div class="collapsible-header"><i class="material-icons">star</i>Farming Tips</div>
      <div class="collapsible-body">

        <?php
    $sql = "SELECT * FROM farmtips";
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
        echo '<p align="center">'.$row['message'].' Posted on '.$row['Dates'].'</p>';
      }
    }?>

      </div>
    </li>
    <li>
      <div class="collapsible-header"><i class="material-icons">star</i> Pending Crop Advertisements</div>
      <div class="collapsible-body">
        <table>
        <thead>
          <tr>
              <th>Action</th>
              <th>Crop Id</th>
              <th>Crop Name</th>
              <th>Quantity</th>
              <th>Supplier Id</th>
              <th>Supplier Contact</th>
              <th>Status</th>
          </tr>
        </thead>
        <tbody>
            <?php

            $status="Pending";

            $farmer_email=$_SESSION['username'];


    $sql = "SELECT * FROM advertise WHERE status ='$status'";
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
        echo '<tr><td><a href="sell_crop.php?id=';echo $row['id'];echo '&crop_name=';
        echo $row['cp_name'];
        echo '&qty=';
        echo $row['cp_qty'];
        echo '&sup_email=';
        echo $row['sup_email'];

        echo '&buyer_email=';
        echo $farmer_email;

        echo '" class="btn btn-small indigo">SELL</a></td>';
        echo '<td>'.$row['id'].'</td>';
        echo '<td>'.$row['cp_name'].'</td>';
        echo '<td>'.$row['cp_qty'].'</td>';
         echo '<td>'.$row['sup_email'].'</td>';
          echo '<td>'.$row['sup_mob'].'</td>';
           echo '<td>'.$row['status'].'</td></tr>';
        
      }
    }

    ?>
  </tbody>
</table>
      </div>
    </li>
    <li>
      <div class="collapsible-header"><i class="material-icons">star</i>Crop Accepted</div>
      <div class="collapsible-body">
        <table>
        <thead>
          <tr>
              
              <th>Crop Id</th>
              <th>Crop Name</th>
              <th>Quantity</th>
              <th>Supplier Email</th>
              <th>Supplier Contact</th>
              <th>Status</th>
          </tr>
        </thead>
        <tbody>
            <?php

            $status="Accepted";
            $femail = $_SESSION['username'];


    $sql = "SELECT * FROM advertise WHERE status ='$status' AND buyer_email = '$femail'";
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
        
        echo '<tr><td>'.$row['id'].'</td>';
        echo '<td>'.$row['cp_name'].'</td>';
        echo '<td>'.$row['cp_qty'].'</td>';
         echo '<td>'.$row['sup_email'].'</td>';
          echo '<td>'.$row['sup_mob'].'</td>';
           echo '<td>'.$row['status'].'</td></tr>';
        
      }
    }

    ?>
  </tbody>
</table>
      </div>
    </li>
  </ul>
      </div>


      <!--EDIT FARMER MODALS-->

      <!-- Modal Structure -->
      <?php

      $useremail=$_SESSION['username'];


    $sql = "SELECT * FROM farmers_details WHERE email='$useremail'";
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
          <input placeholder="Placeholder" id="farmer_id" type="text" class="validate" name="fid" value="';echo $row['id'];echo'" readonly>
          <label for="farmer_id">Farmer Id</label>
        </div>
        <div class="input-field col s6">
          <input placeholder="Placeholder" id="farmer_name" type="text" class="validate" name="fname" value="';echo $row['name'];echo'">
          <label for="farmer_name">Farmer Name</label>
        </div>
        
      </div>
      <div class="row">
        <div class="input-field col s6">
          <input id="farmer_email" type="text" class="validate" name="femail" value="';echo $row['email'];echo'" readonly>
          <label for="farmer_email">Farmer Email</label>
        </div>
        <div class="input-field col s6">
          <input id="farm_username" type="text" class="validate" name="funame" value="';echo $row['uname'];echo'">
          <label for="farm_username">Farmer Username</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <input name="updateFarm" type="submit" class="btn btn-small indigo" value="UPDATE">
         
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
     $('select').formSelect();
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