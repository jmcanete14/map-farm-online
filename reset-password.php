<!doctype html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   
      <title>Reset Password In PHP MySQL</title>
       <!-- CSS -->
       <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   </head>
   <body>
 
      <div class="container">
          <div class="card">
            <div class="card-header text-center">
              Reset Password In PHP MySQL
            </div>
            <div class="card-body">
            <?php
              include('db_connect.php');

              // Create connection
              $conn = new mysqli($servername, $username, $password,$db);
               
              $id = $_GET['id'];
 
              $token = $_GET['token'];
 
              $query = mysqli_query($conn,
              "SELECT * FROM `users` WHERE reset_link_token='".$token."' and id=$id;"
              );
              
              
 
              $curDate = date("Y-m-d H:i:s");
 
            ?>
            
            <?php
                if(isset($token) && (mysqli_num_rows($query) > 0)) {
            ?>
              <form action="update-forget-password.php" method="post">
                <input type="hidden" name="id" value="<?php echo $id;?>">
                <!--<input type="hidden" name="reset_link_token" value="<?php echo $token;?>">-->
                <div class="form-group">
                  <label for="exampleInputEmail1">Password</label>
                  <input type="password" name='password' class="form-control">
                </div>                
 
                <div class="form-group">
                  <label for="exampleInputEmail1">Confirm Password</label>
                  <input type="password" name='cpassword' class="form-control">
                </div>
                <input type="submit" name="new-password" class="btn btn-primary">
              </form>
            <?php
                } else {
                    echo "<p>Token is expired or not valid. Check your email for latest password reset link.</p>";
                    
                }
            ?>
            </div>
          </div>
      </div>
 
   </body>
</html>