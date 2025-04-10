<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $fullname = $_POST['fullname'];

    // Send email using PHPMailer
    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'hmij.foundation.pic98@gmail.com';
        $mail->Password = 'Richard_2024';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        //Recipients
        $mail->setFrom('hmij.foundation.pic98@gmail.com', 'HMIJ Foundation - PIC');
        $mail->addAddress($email, $fullname);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Thank you for your Pre-Registration!';
        $mail->Body    = "
            <h1>Thank you for registering!</h1>
            <p>Dear $fullname,</p>
            <p>Thank you for completing your pre-registration! We are processing your application.</p>
            <p>Please proceed with the <a href='https://hmij.github.io/earlyregistration/dashboard.html'>Pre-Enlistment</a>.</p>
            <p>Also, please print the <a href='https://yourdomain.com/receipt?email=$email'>Receipt</a> to pay for your subjects in the cashier.</p>
            <p>Best regards,<br> Your School</p>
        ";

        $mail->send();
        echo 'Email has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
