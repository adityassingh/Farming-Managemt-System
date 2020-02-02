<?php
session_start();
unset($_SESSION['farmerLoggedIn']);
unset($_SESSION['sellerLoggedIn']);
unset($_SESSION['adminloggedIn']);
unset($_SESSION['username']);
session_destroy();
header('Location:../');