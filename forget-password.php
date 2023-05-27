<!doctype html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   
      <title>Send Reset Password Link</title>
       <!-- CSS -->
       <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   </head>
   <body>
      <div class="container">
          <div class="card">
            <div class="card-header text-center">
              Send Reset Password Link
            </div>
            <div class="card-body">
              <form action="password-reset-token.php" method="POST">
                <div class="form-group">
                  <label for="exampleInputEmail1">Email address</label>
                  <input type="email" name="email123" class="form-control" id="email123" aria-describedby="emailHelp">
                  <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <input type="submit" name="" class="btn btn-primary">
              </form>
            </div>
          </div>
      </div>
 
   </body>
</html>