<?php
$servername = "sql110.epizy.com";
$username = "epiz_34295731";
$password = "218UmD9YdGnp";
$db = "epiz_34295731_goat_geofencing_db";

// Create connection
$conn = new mysqli($servername, $username, $password,$db);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully";

// var_dump($conn);
?>