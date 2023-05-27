<?php
// Database connection parameters
include './../db_connect.php';



// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL file path
$sqlFile = "./../database/goat_geofencing_db.sql";

// Read the SQL file contents
$sql = file_get_contents($sqlFile);

// Execute the SQL queries
if ($conn->multi_query($sql) === TRUE) {
    echo "SQL file executed successfully.";
} else {
    echo "Error executing SQL file: " . $conn->error;
}

// Close the database connection
$conn->close();



?>