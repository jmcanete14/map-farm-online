<?php
$servername = "localhost";
$username = "mvsmcwms_admin_usr";
$password = "Rjfs,Oh90[~Z";
$db = "mvsmcwms_project";

// Create connection
$conn = new mysqli($servername, $username, $password,$db);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully";

// var_dump($conn);
?>