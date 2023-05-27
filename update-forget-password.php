<?php
if(isset($_POST['id']))
{
  include('db_connect.php');

  // Create connection
  $conn = new mysqli($servername, $username, $password,$db);
   
  $id = $_POST['id'];
 
//   $token = $_POST['reset_link_token'];
   
  $password = md5($_POST['password']);
 
  $query = mysqli_query($conn,"SELECT * FROM `users` WHERE id=$id");
 
   $row = mysqli_num_rows($query);
//  var_dump($row).die();
   if($row){
 
       mysqli_query($conn,"UPDATE users set password='" . $password . "', reset_link_token='" . NULL . "' ,exp_date='" . NULL . "' WHERE id=$id");
 
       echo '<p>Congratulations! Your password has been updated successfully.</p>';
   }else{
      echo "<p>Something goes wrong. Please try again</p>";
   }
}
?>