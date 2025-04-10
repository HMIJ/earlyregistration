<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $fullname = $_POST['fullname'];
    $phonenumber = $_POST['phonenumber'];
    $dob = $_POST['dob'];
    $pob = $_POST['pob'];
    $gender = $_POST['gender'];
    $civilStatus = $_POST['civilStatus'];
    $nationality = $_POST['nationality'];
    $religion = $_POST['religion'];
    $address = $_POST['address'];
    $applicationType = $_POST['applicationType'];

    $subject = "Thank you for Pre-Registering";

    $body = "<h2>Student Pre-registration Details</h2>";
    $body .= "<p><strong>Full Name:</strong> $fullname</p>";
    $body .= "<p><strong>Email:</strong> $email</p>";
    $body .= "<p><strong>Phone Number:</strong> $phonenumber</p>";
    $body .= "<p><strong>Date of Birth:</strong> $dob</p>";
    $body .= "<p><strong>Place of Birth:</strong> $pob</p>";
    $body .= "<p><strong>Gender:</strong> $gender</p>";
    $body .= "<p><strong>Civil Status:</strong> $civilStatus</p>";
    $body .= "<p><strong>Nationality:</strong> $nationality</p>";
    $body .= "<p><strong>Religion:</strong> $religion</p>";
    $body .= "<p><strong>Address:</strong> $address</p>";
    $body .= "<p><strong>Application Type:</strong> $applicationType</p>";
    $body .= "<p>Thank you for your registration. Please proceed to the <a href='../dashboard.html'>Pre-Enlistment</a> to select your subjects.</p>";
    $body .= "<p>Also, visit the cashier to print your receipt for payment.</p>";

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Set your SMTP server address
        $mail->SMTPAuth = true;
        $mail->Username = 'hmij.foundation.pic98@gmail.com'; // SMTP username
        $mail->Password = 'Richard_2024'; // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('hmij.foundation.pic98@gmail.com', 'HMIJ Foundation - PIC');
        $mail->addAddress($email, $fullname);

        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;

        $mail->send();
        echo 'Message has been sent to ' . $email;
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
