<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "de_more";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
else if ($conn){
	
	echo "";
}


$connection = new PDO( 'mysql:host=localhost;dbname=de_more', $username, $password );

?>