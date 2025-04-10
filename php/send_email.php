<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

// Receive data from Firebase Cloud Function
$email = $_POST['email'];
$fullname = $_POST['fullname'];

$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';  // Use your mail server (e.g. Gmail, SendGrid, etc.)
    $mail->SMTPAuth = true;
    $mail->Username = 'hmij.foundation.pic98@gmail.com';  // Your email address
    $mail->Password = 'Richard_2024';  // Your email password (consider using OAuth for security)
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    //Recipients
    $mail->setFrom('hmij.foundation.pic98@gmail.com', 'HMIJ Foundation - PIC');
    $mail->addAddress($email, $fullname);  // Add the student's email

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'Thank you for your Pre-Registration!';
    $mail->Body    = "
        <h1>Thank you for registering!</h1>
        <p>Dear $fullname,</p>
        <p>Thank you for completing your pre-registration! We are processing your application.</p>
        <p>Please proceed with the <a href='https://yourdomain.com/pre-enlistment'>Pre-Enlistment</a>.</p>
        <p>Also, please print the <a href='https://yourdomain.com/receipt?email=$email'>Receipt</a> to pay for your subjects in the cashier.</p>
        <p>Best regards,<br> HMIJ Foundation - PIC</p>
    ";

    $mail->send();
    echo 'Email has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
