<?php
require __DIR__ . './../vendor/autoload.php'; // Load Composer autoloader
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'./../');
$dotenv->load();

function smtpVarENV(){

    // use $_ENV[] instead of getenv();
    $sender_app_key = $_ENV['SMTP_SERVER_APP_KEY'];
    $sender_email = $_ENV['SMTP_SERVER_EMAIL'];
    $sender_name = $_ENV['SMTP_SERVER_NAME'];

    return [$sender_app_key, $sender_email, $sender_name];
}


function generalVariableENV(){

    // use $_ENV[] instead of getenv();
    $host = $_ENV['HOST_DOMAIN'];

    return [$host];
}

?>