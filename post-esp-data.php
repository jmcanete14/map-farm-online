<?php
$servername = "localhost";
$username = "u447968853_wms";
$password = "|CM~*MFLC2p";
$db = "u447968853_wms_db";

$api_key_value = "tPmAT5Ab3j7F9";

$api_key= $w_level = "";

if ($_SERVER["REQUEST_METHOD"] == "POST"){
	$api_key = test_input($_POST["api_key"]);
	if($api_key == $api_key_value){
		$w_level = test_input($_POST["waste_level"]);

		//Create Connection
		$conn = new mysqli($servername, $username, $password, $db);
		//check connection
		if ($conn->connect_error) {
			die("Could not connect to mysql: " . $conn->connect_error);
		}

		$sql = "INSERT INTO sensrdata (waste_level)
		VALUES ('" . $w_level . "')";

		if  ($conn->query($sql) === TRUE){
			echo "New record created successfully";
		}
		else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}

		$conn->close();
	}
	else {
		echo "Wrong API Key provided.";
	}
}
else{
	echo "No data posted with HTTP POST.";
}

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}