<?php 
if (isset($_GET['id'])) {
	# code...
	$id = $_GET['id']; 
	# Here we get that unique id using get method from the url to which we redirected
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
$sql = "DELETE FROM farmers_details WHERE id = '$id'";
# Delete one record from farmers_details WHERE id matches to the id we fetch using get method

if ($conn->query($sql) === TRUE) {
    header('Location:adminPage.php?success=Farmer Deleted!');
    # Redirect the user to the adminPage.php page back with some success message
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
}

else
{
	header('Location:../index.php?error=Permission required!');
	exit();
}
