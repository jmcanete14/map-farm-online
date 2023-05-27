<?php

$servername = "localhost";
$username = "mvsmcwms_admin_usr";
$password = "Rjfs,Oh90[~Z";
$db = "mvsmcwms_project";

$conn = new mysqli($servername, $username, $password,$db);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . mysqli_connect_error());
}

if (!isset($_GET["WasteLevel"]) || empty($_GET["WasteLevel"]) ||
    !isset($_GET["locate"]) || empty($_GET["locate"])) {
    header('Location:404.html');
}else{
    
    date_default_timezone_set('Asia/Hong_Kong');

	$wlevel = $_GET["WasteLevel"];
	$loc = $_GET["locate"];
	//$api = $_GET['API'];
	$date = date("Y-m-d");
	$time = date("H:i:s");

	$query = "INSERT INTO `sensrdata`(`location`, `waste_level`, `Date`, `Time`) VALUES ('$loc','$wlevel','$date','$time')";
	$result = mysqli_query($conn,$query);
// 	var_dump($result);die();
    // return json_encode(true);

	echo "Success<br>";
	echo "<br>";
	echo $date;
	echo "<br>";
	echo $time;
    
}
