<!DOCTYPE html>
<html>
<head>
	
	<link rel="stylesheet" type="text/css" href="style_logs.css">

	<title> Sensor Data </title>

</head>
<!-- jQuery UI 1.11.4 -->
  <script src="assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- jQuery UI -->
  <script src="assets/plugins/jquery/jquery.min.js"></script>
<body>
<div id="content">

    <?php
    include('db_connect.php');



    // Create connection
    $conn = new mysqli($servername, $username, $password,$db);
    //check connection
    if ($conn->connect_error) {
    	die("Connection Failed: " . $conn->connect_error);
    }

    $sql = "SELECT id, `object_id`, `latitude`, `longitude`, `pulse_rate`, `battery_level`, datetime_recorded FROM `sensordata` WHERE 1 ORDER BY 'id' DESC limit 20"; /*select items to display from the database table*/

    echo '<table cellspacing="5" cellpadding="5">
    	  <tr>
    	  	<th>ID</th>
          <th>Object</th>
    	  	<th>Latitude</th>
          <th>Longitude</th>
    	  	<th>Pulse Rate</th>
            <th>Battery Level</th>
            <th>Date-Time</th>
    	  </tr>';
    if ($result = $conn->query($sql)) {
        while ($row = $result->fetch_assoc()) {
            
            // Uncomment to set timezone to - 1 hour (you can change 1 to any number)
           // $row_reading_time = date("Y-m-d H:i:s", strtotime("$row_reading_time - 1 hours"));
          
            // Uncomment to set timezone to + 4 hours (you can change 4 to any number)
            //$row_reading_time = date("Y-m-d H:i:s", strtotime("$row_reading_time + 4 hours"));
          
            echo '<tr> 
                    <td>' . $row['id'] . '</td> 
                    <td>' . $row['object_id'] . '</td> 
                    <td>' . $row['latitude'] . '</td>
                    <td>' . $row['longitude'] . '</td>  
                    <td>' . $row['pulse_rate'] . '</td>    
                    <td>' . $row['battery_level'] . '</td> 
                    <td>' . $row['datetime_recorded'] . '</td> 
                  </tr>';
        }
        $result->free();
    }

    $conn->close();
    ?>
</div>
</table>

</body>
</html>

	</body>
</html>
</body>
<!-- <!-- jQuery -->
<html>
<head> </head>
<body>

    <input type="button" id="button" value="refresh data">

    <script type="text/javascript" src="jquery.min.js"></script>
    <script type="text/javascript" src="custom.js"></script>
</body>
</html>
