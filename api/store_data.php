<?php
header('Content-Type: application/json');

class procMain {
    public $link='';
    public $query_result='';

    function __construct($object_id, $latitude, $longitude, $pulse_rate, $battery_level){
      $this->connect();
      $this->insertInDB($object_id, $latitude, $longitude, $pulse_rate, $battery_level);
    }

    function connect(){
      include './../db_connect.php';

      $this->link = $conn ;

      // Check for errors
      if ($conn->connect_errno) {
        $this->query_result = "Failed to connect to MySQL: " . $conn->connect_error;
        exit();
      }
    }

    // this can be used only for stored-proc
    function storeInDB($object_id, $latitude, $longitude, $pulse_rate, $battery_level){

      // Sanitize the input values
      $object_id =mysqli_real_escape_string($this->link, $object_id); 
      $latitude = mysqli_real_escape_string($this->link, $latitude); 
      $longitude =mysqli_real_escape_string($this->link, $longitude);
      $pulse_rate =mysqli_real_escape_string($this->link, $pulse_rate);
      $battery_level =mysqli_real_escape_string($this->link, $battery_level);

      // Prepare the statement
      $stmt = mysqli_prepare($this->link, "CALL spStoreData(?, ?, ?, ?, ?)");

      // Bind the parameter; 'i'--> integer; 's'--> varchar;
      mysqli_stmt_bind_param($stmt, 'sssss', $object_id, $latitude, $longitude, $pulse_rate, $battery_level);

      // Execute the statement
      if (mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        $this->query_result = $row['result'];
      } else {
        $this->query_result = "Error: " . mysqli_error($this->link);
      }

      // Close the statement
      mysqli_stmt_close($stmt);
    }


      // this is for regular sql query
    function insertInDB($object_id, $latitude, $longitude, $pulse_rate, $battery_level){

      // Sanitize the input values
      $object_id =mysqli_real_escape_string($this->link, $object_id); 
      $latitude = mysqli_real_escape_string($this->link, $latitude); 
      $longitude =mysqli_real_escape_string($this->link, $longitude);
      $pulse_rate =mysqli_real_escape_string($this->link, $pulse_rate);
      $battery_level =mysqli_real_escape_string($this->link, $battery_level);

      
      $save = $this->db->query("INSERT INTO sensordata(object_id, latitude, longitude, pulse_rate, battery_level)
      VALUES($object_id, $latitude, $longitude, $pulse_rate, $battery_level)");
    }
}

$re = array();

try{

  // Check if the request method is POST
  if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    // Capture the JSON Post
    $json_data = file_get_contents('php://input'); // Read raw POST data
    $data = json_decode($json_data); // Convert JSON string to PHP object or array


    // Check if all object names are provided
    $requiredFields = ['object_id', 'latitude', 'longitude', 'pulse_rate', 'battery_level'];
    $missingFields = [];

    foreach ($requiredFields as $field) {
        if (!isset($data->$field)) {
            $missingFields[] = $field;
        }
    }

    if (!empty($missingFields)) {
        // Throw an error or handle the missing fields
        $re['status_code'] = "204";
        $re['message'] = "Missing variables: " . implode(', ', $missingFields);
    } else {
        // Process the data when all object names are present
        $result = new procMain(
            strval($data->object_id),
            strval($data->latitude),
            strval($data->longitude),
            strval($data->pulse_rate),
            strval($data->battery_level)
        );
      
        $re['status_code'] = "200";
        $re['message'] = json_decode($result->query_result);
    }
  }
  else{
    $re['status_code'] = "401";
    $re['message'] = "Use a post request method.";
  }
}
catch(Exception $error){
  $re['status_code'] = "500";
  $re['message'] = $error->getMessage();
}

echo json_encode($re);

?>