<?php session_start(); ?>
<!DOCTYPE html>
  <html>
    <head>
      <!--Google Fonts-->
      <link href="https://fonts.googleapis.com/css?family=Staatliches&display=swap" rel="stylesheet">
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
      <link rel="stylesheet" type="text/css" href="css/custom.css">

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>

    <body>

      <!--Navbar-->
      <div class="navbar-fixed">
      <nav class="amber">
    <div class="nav-wrapper container">
      <a href="#!" class="brand-logo">FM</a>
      <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
      <ul class="right hide-on-med-and-down">
        <?php if (isset($_SESSION['username']))
          {
            echo '<li>';
            echo $_SESSION['username'];
            echo'</li>
        <li><a href="HomePages/logout.php">Logout</a></li>
        ';
          
          # code...
        }

        else
        {
          echo '<li><a href="AdminAuth/">Admin</a></li>
        <li><a href="FarmerAuth/">Farmer Login</a></li>
        <li><a href="SellerAuth/">Seller Login</a></li>';
        }

         ?>
        
      </ul>
    </div>
  </nav>
</div>


 <!--Side Nav-->

  <ul class="sidenav" id="mobile-demo">
    <li><a href="AdminAuth">Admin Login</a></li>
    <li><a href="FarmerAuth/">Farmer Login</a></li>
    <li><a href="SellerAuth/">Seller Login</a></li>
    
  </ul>

      <div class="container custom">
        <div class="mycenter">
          <h1>FARMING MANAGMENT</h1>
          <!-- <a href="#" class="waves-effect waves-light btn amber btn-large">About</a> -->
        </div>
      </div>


      <!--Footer-->

      <footer class="page-footer amber">
          <div class="container">
            <div class="row">
              <div class="col l6 s12">
                <h5 class="white-text">Farming Management</h5>
                <p class="grey-text text-lighten-4">Farm management, making and implementing of the decisions involved in organizing and operating a farm for maximum production and profit. Farm management draws on agricultural economics for information on prices, markets, agricultural policy, and economic institutions such as leasing and credit.</p>
              </div>
              <div class="col l4 offset-l2 s12">
                <h5 class="white-text">Social Links</h5>
                <ul>
                  <li><a class="grey-text text-lighten-3" href="#!">Facebook</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Twitter</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">LinkedIn</a></li>
                  
                </ul>
              </div>
            </div>
          </div>
          <div class="footer-copyright">
            <div class="container">
            © 2019 By ADITYA SINGH
            
            </div>
          </div>
        </footer>


      <!--jquery-->
      <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

      <!--JavaScript at end of body for optimized loading-->
      <script type="text/javascript" src="js/materialize.min.js"></script>


      <script type="text/javascript">
         $(document).ready(function(){
    $('.sidenav').sidenav();
  });
      </script>
    </body>
  </html>