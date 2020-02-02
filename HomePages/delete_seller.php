<?php
if (isset($_GET['id'])) {
 	# code...
 	$id = $_GET['id'];
$servername = "localhost";
$username = "root";
$password = "mysql";
$dbname = "farmers";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// sql to delete a record
$sql = "DELETE FROM sellers_details WHERE id = '$id'";

if ($conn->query($sql) === TRUE) {
    header('Location:adminPage.php?success=Seller Deleted!');
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();

 } 

 else
 {
 	header('Location:../index.php?error=Permission Required!');
 	exit();
 }
