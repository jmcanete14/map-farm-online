<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification Sent</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
        >
    
</head>
<body>

    <div class="container">
        <?php if(isset($_GET['verification']) && $_GET['verification'] == true): ?>
        <div class="jumbotron mt-3">
            <h1 class="display-4 text-success"><i class="fa fa-check-circle" aria-hidden="true"></i> Email Verification Sent!</h1>
            <p class="lead">Please check your email for further instructions.</p>
            <hr class="my-4">
            <p>If you have any questions or concerns, please contact the admin.</p>
            <a class="btn btn-primary btn-lg" href="/" role="button">Return to Login</a>
        </div>
            <?php else:?>
                <div class="jumbotron mt-3 ">
                    <h1 class="display-4 text-danger"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Error during Email Verification</h1>
                    <p class="lead">Something went wrong during email verification. Please contact the admin.</p>
                    <hr class="my-4">
                    <p>If you have any questions or concerns, please contact the admin.</p>
                    <a class="btn btn-primary btn-lg" href="/" role="button">Return to Login</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"
        integrity="sha384-tpDQ9X+s4+4Z8KjZilxxrq61q3SkNHw3qzQs1k54sJblT9XPGTcIhZMILJj/nvEh"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+XjBbPRXaXhO5r12JwWlMjKzzUAwWO"
        crossorigin="anonymous"></script>
</body>
</html>
