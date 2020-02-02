<?php
#if farmer is in session redirect to farmers homepage
session_start();
if (isset($_SESSION['farmerLoggedIn'])) {
  header('Location:../index.php');
  exit();
}
require '../includes/dbhfarm.inc.php';
if (isset($_POST['logFarm'])) {
  $email = $_POST['email'];
  $password = $_POST['pass'];
  #check for empty fields
  if (empty($username) || empty($password)) {
    header('Location:index.php?error=Empty Fields!');
    exit();
  }
  else
  {
    # make a sql request to compare is this user is present in database

$conn = new mysqli("localhost","root","mysql","farmers");

$data = $conn->query("SELECT id FROM farmers_details WHERE email = '$email' AND password = '$password'");

if ($data -> num_rows > 0) {
  # User Aviliable if yes start the session and redirect the farmer to their homepage

  $_SESSION['farmerLoggedIn']=1;
  $_SESSION['username']=$email;
  header('Location:../HomePages/FarmerPage.php');
  

}
else
{
# if not make an error
  header('Location:index.php?error=Wrong Credidentials!');
  exit();
}
  

}
}
?>
<!DOCTYPE html>
  <html>
    <head>
      <title>Farmer Login</title>
      <!--Google Fonts-->
      <link href="https://fonts.googleapis.com/css?family=Staatliches&display=swap" rel="stylesheet">
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="../css/materialize.min.css"  media="screen,projection"/>
      

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>

    <body>

      <!--Navbar-->
      <div class="navbar-fixed">
      <nav class="teal">
    <div class="nav-wrapper container">
      <a href="../" class="brand-logo">FM</a>
      <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
      <ul class="right hide-on-med-and-down">
        <li><a href="RegFarmer.php">SignUp</a></li>
        
        
      </ul>
    </div>
  </nav>
</div>


 <!--Side Nav-->

  <ul class="sidenav" id="mobile-demo">
    <li><a href="RegFarmer.php">SignUp</a></li>
    
    
  </ul>

      <div class="container">
       <!--Regisration start from here-->
       <br><br><br>
       <div class="row">
        <h4 class="center"> Farmer Login</h4>
    <form class="col s12 center" action="" method="POST">
      <div class="row">
        <div class="input-field col s6">
          <input id="fullname" type="email" class="validate" name="email">
          <label for="fullname">Email</label>
        </div>
        <div class="input-field col s6">
          <input id="pass" type="password" class="validate" name="pass">
          <label for="pass">Password</label>
        </div>
      </div>
    
      <div class="row">
        <div class="col s12">
         <center><input type="submit" name="logFarm" class="btn btn-large teal white-text" value="Login"></center>
         <?php if (isset($_GET['error'])) {
      $error = $_GET['error'];
       echo '<p style="color:red;text-align:center;font-size:20px;">'.$error.'</p>';
     } ?>
          
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
  });
      </script>
    </body>
  </html>