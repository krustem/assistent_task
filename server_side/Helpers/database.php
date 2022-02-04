<?php 

$servername = "assistenttaskdb";
$username = "admin";
$password = "177078pWWgg.";
$host = 'localhost';

// Create connection
$conn = new mysqli($host,$username, $password,$servername);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully";


?>