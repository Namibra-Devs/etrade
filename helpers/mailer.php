<?php

require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';
require './PHPMailer/src/Exception.php';

class Mailer {
    private $mail;

    public function __construct() {
        $this->mail = new PHPMailer();
        $this->mail->isSMTP();
        $this->mail->Host = 'smtp.itpapp.site';
        $this->mail->SMTPAuth = true;
        $this->mail->Username = 'support@itpapp.site';
        $this->mail->Password = 'aminmohammed98';
        $this->mail->SMTPSecure = 'tls';
        $this->mail->Port = 465;
        $this->mail->setFrom('support@itpapp.site', 'International Trade Properties');
        $this->mail->isHTML(true);
    }

    public function send_mail($recipient, $subject, $body) {
        try {
            $this->mail->clearAddresses();
            $this->mail->addAddress($recipient);
            $this->mail->Subject = $subject;
            $this->mail->Body = $body;
            
            $this->mail->send();
            return true;
        } catch (Exception $e) {
            return 'Email could not be sent. Error: ' . $this->mail->ErrorInfo;
        }
    }

    public function send_client($client_name, $client_email){
        $subject = "Client Account Registration";
        $body = '<html>
        <head>
            <title>Account Registration</title>
            <style>
                body {
                    background-color: #f6f6f6;
                    font-family: Arial, sans-serif;
                }
                .container {
                    background-color: #ffffff;
                    border-radius: 10px;
                    padding: 20px;
                    margin: 20px auto;
                    max-width: 400px;
                    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
                }
                h2 {
                    color: #333333;
                    text-align: center;
                    margin-top: 0;
                    padding-top: 10px;
                    border-top: 2px solid #007bff;
                }
                p {
                    color: #555555;
                    line-height: 1.5;
                    margin-bottom: 20px;
                }
                .button {
                    display: inline-block;
                    padding: 10px 20px;
                    background-color: #007bff;
                    color: #ffffff;
                    text-decoration: none;
                    border-radius: 5px;
                }
                .button:hover {
                    background-color: #0056b3;
                }
                .footer {
                    text-align: center;
                    color: #777777;
                    font-size: 12px;
                    margin-top: 20px;
                }
            </style>
        </head>
        <body>
            <div class="container">
                <h2>Account Registration</h2>
                <p>Dear '.$client_name.',</p>
                <p>Congratulations! Your account has been successfully registered.</p>
                <p>You can now start using our services and enjoy the benefits we offer.</p>
                <p>Should you have any questions or need any assistance, please feel free to reach out to our support team.</p>
                <p>
                    Thank you for choosing our platform. We look forward to serving you!
                </p>
                <p>
                    Best Regards,<br>
                    International Trade Properties (ITP)
                </p>
                <div class="footer">
                    This email is automatically generated. Please do not reply.
                </div>
            </div>
        </body>
        </html>
        ';

        $this->send_mail($client_email, $subject, $body);
    }

    public function send_vendor($vendor_name, $vendor_email){
        $subject = "Vendor Account Registration";
        $body = '<html>
        <head>
            <title>Vendor Account Registration</title>
            <style>
                body {
                    background-color: #f6f6f6;
                    font-family: Arial, sans-serif;
                }
                .container {
                    background-color: #ffffff;
                    border-radius: 10px;
                    padding: 20px;
                    margin: 20px auto;
                    max-width: 400px;
                    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
                }
                h2 {
                    color: #333333;
                    text-align: center;
                    margin-top: 0;
                    padding-top: 10px;
                    border-top: 2px solid #007bff;
                }
                p {
                    color: #555555;
                    line-height: 1.5;
                    margin-bottom: 20px;
                }
                .button {
                    display: inline-block;
                    padding: 10px 20px;
                    background-color: #007bff;
                    color: #ffffff;
                    text-decoration: none;
                    border-radius: 5px;
                }
                .button:hover {
                    background-color: #0056b3;
                }
                .footer {
                    text-align: center;
                    color: #777777;
                    font-size: 12px;
                    margin-top: 20px;
                }
            </style>
        </head>
        <body>
            <div class="container">
                <h2>Vendor Account Registration</h2>
                <p>Dear '.$vendor_name.',</p>
                <p>Congratulations! Your vendor account has been successfully created.</p>
                <p>You are now part of our e-commerce platform, where you can showcase and sell your products to a wide audience.</p>
                <p>Start exploring the vendor dashboard and take advantage of the various features we provide to manage your products, orders, and more.</p>
                <p>If you have any questions or need assistance, please feel free to reach out to our dedicated vendor support team.</p>
                <p>
                    We wish you success and look forward to a fruitful partnership!
                </p>
                <p>
                    Best Regards,<br>
                    International Trade Properties (ITP)
                </p>
                <div class="footer">
                    This email is automatically generated. Please do not reply.
                </div>
            </div>
        </body>
        </html>
        ';

        $this->send_mail($vendor_email, $subject, $body);

    }

    public function send_forgot_password($name, $email, $reset_link){
        $subject = "Password Reset";
        $body = '<!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <title>Password Reset</title>
            <style>
                /* Add some styles to make the email visually appealing */
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f6f6f6;
                }
                .container {
                    max-width: 600px;
                    margin: 0 auto;
                    padding: 20px;
                    background-color: #fff;
                    border-radius: 4px;
                    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                }
                h1 {
                    font-size: 24px;
                    margin-bottom: 20px;
                    text-align: center;
                }
                p {
                    margin-bottom: 20px;
                }
                .button {
                    display: inline-block;
                    background-color: #4CAF50;
                    color: #ffffff;
                    text-decoration: none;
                    padding: 10px 20px;
                    border-radius: 4px;
                }
            </style>
        </head>
        <body>
            <div class="container">
                <h1>Password Reset</h1>
                <p>Dear '.$name.',</p>
                <p>We received a request to reset your password. To reset your password, please click the button below:</p>
                <p>
                    <a class="button" href="'.$reset_link.'">Reset Password</a>
                </p>
                <p>If you did not request a password reset, please ignore this email.</p>
                <p>Best regards,<br>International Trade Properties (ITP)</p>
            </div>
        </body>
        </html>
        ';

        $this->send_mail($email, $subject, $body);
         
    }
}

// Create Mailer Instance
$mailer = new Mailer();
$recipient = 'abdulsamadbalogun25@gmail.com';
$subject = 'Test HTML Email';

$body = '
    <html>
    <head>
        <title>Test HTML Email</title>
        <style>
            body {
                background-color: #f6f6f6;
                font-family: Arial, sans-serif;
            }
            .container {
                background-color: #ffffff;
                border-radius: 10px;
                padding: 20px;
                margin: 20px auto;
                max-width: 400px;
            }
            h2 {
                color: #333333;
                text-align: center;
            }
            p {
                color: #555555;
                line-height: 1.5;
                margin-bottom: 20px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h2>Test HTML Email</h2>
            <p>This is a test email with HTML content and CSS styling.</p>
            <p>You can customize the email template further to meet your requirements.</p>
        </div>
    </body>
    </html>
';

$result = $mailer->send_mail($recipient, $subject, $body);
if ($result === true) {
    echo 'Email sent successfully!';
} else {
    echo $result;
}


// <!DOCTYPE html>
// <html>
// <head>
//     <meta charset="UTF-8">
//     <title>Password Reset</title>
//     <style>
//         /* Add some styles to make the email visually appealing */
//         body {
//             font-family: Arial, sans-serif;
//             background-color: #f6f6f6;
//         }
//         .container {
//             max-width: 600px;
//             margin: 0 auto;
//             padding: 20px;
//             background-color: #fff;
//             border-radius: 4px;
//             box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
//         }
//         h1 {
//             font-size: 24px;
//             margin-bottom: 20px;
//             text-align: center;
//         }
//         p {
//             margin-bottom: 20px;
//         }
//         .button {
//             display: inline-block;
//             background-color: #4CAF50;
//             color: #ffffff;
//             text-decoration: none;
//             padding: 10px 20px;
//             border-radius: 4px;
//         }
//     </style>
// </head>
// <body>
//     <div class="container">
//         <h1>Password Reset</h1>
//         <p>Dear [User],</p>
//         <p>We received a request to reset your password. To reset your password, please click the button below:</p>
//         <p>
//             <a class="button" href="[ResetLink]">Reset Password</a>
//         </p>
//         <p>If you did not request a password reset, please ignore this email.</p>
//         <p>Best regards,<br>Your Company Name</p>
//     </div>
// </body>
// </html>
