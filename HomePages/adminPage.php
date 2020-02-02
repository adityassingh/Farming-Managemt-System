<?php
session_start();
include_once '../includes/dbhfarm.inc.php';
include_once '../includes/dbhsell.inc.php';

#if no user login and going without login then rdirect to main homepage
if (!isset($_SESSION['username'])) {
  # code...
  header('Location:../index.php?error=You have to login First!');
  exit();
}

if (isset($_POST['sendtip'])) {
      
 
$datetime = new DateTime();
$date =$datetime->format('Y-m-d H:i:s');
      # code...
      $message = $_POST['tip'];
      if (empty($message)) {
        # code...
        header('Location:adminPage.php?error=Empty Farmer Tip Field!');
        exit();
      }
      else
      {
        $sql = "INSERT INTO farmtips (message,Dates) VALUES ('$message','$date')";
if(mysqli_query($connection, $sql)){
   header('Location:adminPage.php?success=Farming Tip Posted!');
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($connection);
}
 
// Close connection
mysqli_close($connection);
      }
    }


    if (isset($_POST['solvecp'])) {
      # code...
      $id = $_POST['key'];
       $sql = "UPDATE complains set status = 'Solved' WHERE id='$id'";
if(mysqli_query($connection, $sql)){
   header('Location:adminPage.php?success=Complaint Resolved!');
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
      <title>Admin-Dashboard</title>
      <!--Google Fonts-->
      <link href="https://fonts.googleapis.com/css?family=Staatliches&display=swap" rel="stylesheet">
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="../css/materialize.min.css"  media="screen,projection"/>

      <!--fontawesome-->

      <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

      <style type="text/css">
        body
        {
          margin: 0;
          padding: 0;
        }
        .avatar
        {
          width: 200px;
          height: 200px;
          background-image: url('../img/adi5.jpg');
          border-radius: 50%;
          background-size: cover;
          background-position: center;
        }
      </style>
    </head>

    <body>

      <!--Navbar-->
      
      <nav class="purple">
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
          <center>
           <div class="avatar">
             
           </div>
         </center>
           <h3 class="center">Aditya Singh</h3>
           <center><a href="logout.php" class="btn btn-floating purple"><i class="material-icons">exit_to_app</i></a></center>
         </div>
       </div>
      </div>

      <br>
      <br>

      <div class="container">
        <?php if (isset($_GET['error'])) {
          echo '<p align="center" style="color:red;">'.$_GET['error'].'</p>';
          # if we get an error message in url then print error message
        } 

        if (isset($_GET['success'])) {
          echo '<p align="center" style="color:green;">'.$_GET['success'].'</p>';
        }

        #if we get an success message in url the print that success message

        ?>
        <ul class="collapsible">
    <li>
      <div class="collapsible-header"><i class="material-icons">star</i>Farmers Details</div>
      <!--FARMERS DETAILS TABLE-->
      <div class="collapsible-body">
        <table>
          <thead>
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Username</th>
              <th>Actions</th>
          </tr>
          </thead>
          <tbody>
            <?php


    $sql = "SELECT * FROM farmers_details";
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
        echo '<tr><td>'.$row['name'].'</td>';
        echo '<td>'.$row['email'].'</td>';
        echo '<td>'.$row['uname'].'</td><td>';
        echo '<a href="delete_farmer.php?id=';
        # redirect the user on seperate page delete_farmer.php along with its unique id
        echo $row['id'];
        echo '" class="btn-floating btn-large waves-effect waves-light red"><i class="material-icons">delete</i></a></td></tr>';

        
      
      }
    }

    ?>
  </tbody>
</table>
      </div>
    </li>
    <li>
      <div class="collapsible-header"><i class="material-icons">star</i>Sellers Details</div>
      <div class="collapsible-body">
        <table class="highlight">
          <thead>
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Username</th>
              <th>Phone</th>
              <th>Actions</th>
          </tr>
          </thead>
          <tbody>
            <?php


    $sql = "SELECT * FROM sellers_details";
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
        echo '<tr><td>'.$row['name'].'</td>';
        echo '<td>'.$row['email'].'</td>';
        echo '<td>'.$row['uname'].'</td>';
        echo '<td>'.$row['phone'].'</td><td>';
        echo '<a href="delete_seller.php?id=';
        echo $row['id'];
        echo '" class="btn-floating btn-large waves-effect waves-light red"><i class="material-icons">delete</i></a></td></tr>';
        
      }
    }

    ?>
  </tbody>
</table>
      </div>
    </li>
    <li>
      <div class="collapsible-header"><i class="material-icons">star</i>Complaints</div>
      <div class="collapsible-body">
        <form action="" method="POST">
        <table>
          <thead>
            <tr>
              <th>Complain Id</th>
              <th>Farmer Id</th>
              <th>Type</th>
              <th>Complain</th>
              <th>Status</th>
              <th>Action</th>
          </tr>
          </thead>
          <tbody>
            <?php


    $sql = "SELECT * FROM complains WHERE status ='Unsolved'";
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
        echo '<tr><td><input type="text" value="';echo $row['id'];echo '" readonly name="key"></td>';
        echo '<td>'.$row['farmer_id'].'</td>';
        echo '<td>'.$row['c_type'].'</td>';
        echo '<td>'.$row['d_decription'].'</td>';
        echo '<td>'.$row['status'].'</td><td>';
        echo '<button type="submit" class="btn-floating btn-large waves-effect waves-light red" name="solvecp"><i class="material-icons">check</i></button></td></tr>';

        
      
      }
    }

    ?>
  </tbody>
</table>
</form>
      </div>
    </li>
    <li>
      <div class="collapsible-header"><i class="material-icons">star</i>Post a Farming Tip</div>
      <div class="collapsible-body">
        <form class="col s12" action="" method="POST">
      
        <div class="input-field col s12">
          <textarea id="tip" class="materialize-textarea" name="tip"></textarea>
          <label for="tip">Send a Farming Tip!</label>
        </div>
        <div class="input-field col s12">
          <button name="sendtip" type="submit" class="btn btn-floating amber"><i class="material-icons">send</i></button>
          
        </div>
      
    </form>
   
      </div>
    </li>

        <li>
      <div class="collapsible-header"><i class="material-icons">star</i>Users Log Details</div>
      <div class="collapsible-body">
        <table class="highlight">
          <thead>
            <tr>
              <th>id</th>
              <th>Email</th>
              <th>Status</th>
              <th>Recorded Date And Time</th>
          </tr>
          </thead>
          <tbody>
            <?php


    $sql = "SELECT * FROM logs";
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
        echo '<td>'.$row['email'].'</td>';
        echo '<td>'.$row['status'].'</td>';
        echo '<td>'.$row['cdate'].'</td></tr>';
        
        
      }
    }

    ?>
  </tbody>
</table>
      </div>
    </li>
  </ul>
      </div>


      

      

      


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