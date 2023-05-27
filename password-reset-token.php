<?php

include 'php/dotenv.php';

use PHPMailer\PHPMailer\PHPMailer;

use PHPMailer\PHPMailer\SMTP;

// if(isset($_POST['password-reset-token']) && $_POST['email'])

// {



    include 'db_connect.php';

     

    $emailId = $_POST['email123'];

 

    $result = mysqli_query($conn,"SELECT * FROM `users` WHERE email='" . $emailId . "'");

 

    if(mysqli_num_rows($result) > 0) {

        $row= mysqli_fetch_array($result);

        try{

            

            $env_var = generalVariableENV();

            $host_var = $env_var[0];



            $token = md5("test").rand(10,9999);

        

            $expFormat = mktime(

            date("H"), date("i"), date("s"), date("m") ,date("d")+1, date("Y")

            );

        

            $expDate = date("Y-m-d H:i:s",$expFormat);

        

            $update = mysqli_query($conn,"UPDATE `users` set  password='" . $password . "', reset_link_token='" . $token . "' ,exp_date='" . $expDate . "' WHERE email='" . $emailId . "'");

            

            if($update)

            {

                $link = "<a href='https://".$host_var."/reset-password.php?id=".$row['id']."&token=".$token."'>Click To Reset password</a>";

        

                $to = $emailId;

            

                $subject = 'Reset your password for your account to gain access';

            

                $message = '<p>We received a password reset request. The link to reset your password is below, if you did not make this request, you can ignore this email</p>';

                $message .= '<p>Here is your password reset link: <br>';

                $message .= '<a href = "' . $link . '">' . $link . '</a></p>';

            

                $headers = "From: ".$host_var;

                // $headers .= "Reply-To: mvsmc-wms@gmail.com\r\n";

                //$headers .= "Content-type: text/html";

                

                $res_json = send_email($to, $headers, $subject, $message);

                $obj = json_decode($res_json);

                if ($obj->bool)

                {

                    //header("Location: reset-password.php?reset=success&id=".$row['id']."&reset_link_token=".$token);

                    header("Location: email_verification.php?verification=".$obj->bool);

                }

                else{

                    header("Location: email_verification.php?verification=".$obj->bool);

                }

            } else{

                header("location: index.php");

            }



        }

        catch(Exception $error){

        echo ("Fatal error. Error: ".$error);

        }

    }

    else{

        echo ("Sorry. Email is not found from database.");

        echo ("<a href='/'> Return to Home</a>");

    }

?>





<?php









// $email_to => 'to_email@mail.com'; 

// $recipient => 'Juan dela cruz'; 

// $subject => Subject of the email;

// $message => body of the email;

function send_email($email_to, $recipient, $subject, $message){

		

    

    // ENV Array => $sender_app_key, $sender_email, $sender_name

    $env_array = smtpVarENV();



    $app_key = $env_array[0];

    $smtp_email = $env_array[1];

    $smtp_name = $env_array[2];

    

    





    $data = array();

    try{



        $mail = new PHPMailer(true);

        $mail->isSMTP();

        $mail->SMTPAuth = true;



        $mail->SMTPDebug = SMTP::DEBUG_SERVER;



        $mail->Host ="smtp.gmail.com";

        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

        $mail->Port = 587;



        $mail->Username = $smtp_email;

        $mail->Password = $app_key;

        $mail->setFrom($smtp_email, $smtp_name);

        $mail->addAddress($email_to, $recipient);



        $mail->Subject = $subject;

        $mail->Body = $message;



        // Add a custom header

        $mail->addCustomHeader('Content-type', 'text/html');



        $mail->send();

        

        $data["message_response"] = "Email sent!";

        $data["bool"] = true;

    }

    catch(Exception $e){

        $data["message_response"] = "Error while sending the email.";

        $data["bool"] = false;

    }

    



    return json_encode($data);



}





?>