<?php
require_once("../config.php");
// require_once("./mailer_handler.php");
// $_mailer = new Mailer();
$name = trim($_POST['contact-name']);
$phone = trim($_POST['contact-phone']);
$email = trim($_POST['contact-email']);
$message = trim($_POST['contact-message']);
// $subject = "Contact Form (ITP)";
// $recipient  = "abdulsamadbalogun25@gmail.com";

if ($name == "") {
    $msg['err'] = "\n Name can not be empty!";
    $msg['field'] = "contact-name";
    $msg['code'] = FALSE;
} else if ($phone == "") {
    $msg['err'] = "\n Phone number can not be empty!";
    $msg['field'] = "contact-phone";
    $msg['code'] = FALSE;
} else if (!preg_match("/^[0-9 \\-\\+]{4,17}$/i", trim($phone))) {
    $msg['err'] = "\n Please put a valid phone number!";
    $msg['field'] = "contact-phone";
    $msg['code'] = FALSE;
} else if ($email == "") {
    $msg['err'] = "\n Email can not be empty!";
    $msg['field'] = "contact-email";
    $msg['code'] = FALSE;
} else if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
    $msg['err'] = "\n Please put a valid email address!";
    $msg['field'] = "contact-email";
    $msg['code'] = FALSE;
} else if ($message == "") {
    $msg['err'] = "\n Message can not be empty!";
    $msg['field'] = "contact-message";
    $msg['code'] = FALSE;
} else {
    $to = "abdulsamadbalogun25@gmail.com)";
    $subject = 'ITP Platform Enquiry';
    $_message = '<html><head></head><body>';
    $_message .= '<p>Name: ' . $name . '</p>';
    $_message .= '<p>Message: ' . $phone . '</p>';
    $_message .= '<p>Email: ' . $email . '</p>';
    $_message .= '<p>Message: ' . $message . '</p>';
    $_message .= '</body></html>';

    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .= 'From:  ITP <contact@example.com>' . "\r\n";
    $headers .= 'cc: contact@example.com' . "\r\n";
    $headers .= 'bcc: contact@example.com' . "\r\n";

    // $_mailer->send_mail($recipient, $subject, $_message);
    // mail($to, $subject, $_message, $headers, '-f contact@example.com');

    // if($_mailer->send_mail($recipient, $subject, $_message)){
        $msg['success'] = "\n Email has been sent successfully!";
        $msg['code'] = TRUE;

    //     $settings->set_flashdata('success', 'Email has been sent successfully.');
    // }

    $_settings->set_flashdata('success', 'Email has been sent successfully.');

    // $msg['success'] = "\n Email has been sent successfully!";
    // $msg['code'] = TRUE;
}
echo json_encode($msg);

?>
