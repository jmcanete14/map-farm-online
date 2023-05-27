<!-- <?php include('db_connect.php') ?> -->
<?php 
$twhere ="";
if($_SESSION['login_type'] != 1)
  $twhere = "  ";
?>
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
    <link rel="stylesheet" type="text/css" href="style_home.css">
    <style>
    /*  @media (min-width: 1280px)  {
        #feedbackqr {
          height: 50%!important;
        }
      }

      @media (min-width: 700px)  {
        #feedbackqr {
          height: 40%!important;
        }
      }

      @media (min-width: 400px)  {
        #feedbackqr {
          height: 50%!important;
        }
      }*/
      
      div.qr-child{
          display: flex;
  justify-content: center;
  align-items: center;
      }
    </style>
  </head>
 <body>
    <!-- <div class="row"> -->
          <div class="card-body p-0">
            
              <div class="col-md-12">
                <div class="row qr-child">
                  <div class="">
                    <div class="">
                      <img src="image/feedback.webp?v=<?php echo time(); ?>" id="feedbackqr" class="img-fluid img-thumbnail" style="max-width: 100%;">
                    </div>
                    <div class="">
                        <br/>
                      <p>
                        or simply tap here: <a href="https://docs.google.com/forms/d/e/1FAIpQLSfpOLbB5oKv_vduSdYq3K0GMGgro1KOMJNkSamhmhA6Jw9zJA/viewform?fbclid=IwAR1-QyDSA3dhNBW-UR_4KO4wqsCzFJE-BBFA6HDqoB6lkJQKAM5yShnBQXQ">
                        <img border="0" alt="link" src="image/click.png" width="70" height="40">
                        </a>
                        </p>
                    </div>
                  </div>
                  
                </div>
              </div>
          </div>
    <!-- </div> -->
</body>
</html>

