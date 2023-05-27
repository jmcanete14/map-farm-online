<!-- <?php include('db_connect.php') ?> -->
<?php 
$twhere ="";
if($_SESSION['login_type'] != 1)
  $twhere = "  ";
?>
<!-- Info boxes -->
 <div class="col-12">
          <div class="card">
            <div class="card-body">
              Welcome <?php echo $_SESSION['login_name'] ?>!
            </div>
          </div>
  </div>
  <hr>
 <?php 

    $where = "";
    if($_SESSION['login_type'] == 2){
      $where = " where manager_id = '{$_SESSION['login_id']}' ";
    }elseif($_SESSION['login_type'] == 3){
      $where = " where concat('[',REPLACE(user_ids,',','],['),']') LIKE '%[{$_SESSION['login_id']}]%' ";
    }
     $where2 = "";
    if($_SESSION['login_type'] == 2){
      $where2 = " where p.manager_id = '{$_SESSION['login_id']}' ";
    }elseif($_SESSION['login_type'] == 3){
      $where2 = " where concat('[',REPLACE(p.user_ids,',','],['),']') LIKE '%[{$_SESSION['login_id']}]%' ";
    }
?>
  <!DOCTYPE html>
  <html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--<meta http-equiv="reload">-->
    <meta http-equiv="refresh" content="5">
    <link rel="stylesheet" type="text/css" href="style_home.css">
    <style>
    /*  @media (min-width: 1280px)  {
        #imgMap {
          height: 30%!important;
        }
      }

      @media (min-width: 700px)  {
        #imgMap {
          height: 40%!important;
        }
      }

      @media (min-width: 400px)  {
        #imgMap {
          height: 20%!important;
        }
      }*/
    </style>
  </head>
 <body>
    <!-- <div class="row"> -->
      <div class="col-md-12">
        <div class="card card-outline card-success">
          <div class="card-header">
            <b>Dashboard</b>
          </div>
          <div class="card-body p-0">
            
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-7">
                    <div class="">
                      <img src="image/map.jpeg?v=<?php echo time(); ?>" id="imgMap" class="img-fluid img-thumbnail" style="max-width: 100%;"> 
                    </div>
                  </div>
                  <div class="col-md-5">
                    <!-- <div id="chart"> -->
                     <table width="100%">
                      <tr>
                        <th align="center">Room</th>
                        <th align="center">Status</th>
                      </tr>
                      <tr>
                        <td>ER</td>
                        <?php

                        include('db_connect.php');


                        // Create connection
                        $conn = new mysqli($servername, $username, $password,$db);

                        // Check connection
                        if ($conn->connect_error) {
                          die("Connection failed: " . $conn->connect_error);
                        }

                        //error_reporting(0);

                        //$conn = mysqli_connect();

                        $sql = "SELECT * FROM sensrdata WHERE id = ( SELECT MAX(id) FROM sensrdata )";

                        // $result = $conn->query($sql);

                        // print_r($result);

                        // $query = "SELECT max ('wlevel') FROM 'test'"; 

                        // $query_result = mysqli_query($conn, $query);

                        if ($result = $conn->query($sql)) {
                           while ($row = $result->fetch_assoc()) {
                               $display = $row['waste_level'];
// var_dump();
                               if ($display <= "10") {
                                 echo '<td style="background-color:red;color:white;">Full</td>';
                               } elseif ($display >= "11" && $display <= "30") {
                                 echo '<td style="background-color:green;color:white;">Not full</td>';
                               } else {
                                 echo '<td style="background-color:yellow;color:black;">Maintaining</td>';
                               }
                            }
                            $result->free();
                        }

                        ?>
                      </tr>
                     </table>
                    <!-- </div> -->
                  </div>
                </div>
              </div>
          </div>
        </div>
      </div>
    <!-- </div> -->
</body>
</html>

