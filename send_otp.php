<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Make sure PHPMailer is installed via Composer

session_start();
include('connection.php'); // Your Oracle DB connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get user input from signup form
    $email = $_POST['email'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    // Validations
    if ($password !== $confirmPassword) {
        die("❌ Passwords do not match.");
    }
    if (strlen($password) < 8) {
        die("❌ Password must be at least 8 characters.");
    }

    // Store all signup data in one session array
    $_SESSION['signup'] = [
        'firstName' => $firstName,
        'lastName' => $lastName,
        'username' => $username,
        'email' => $email,
        'password' => password_hash($password, PASSWORD_DEFAULT) // Secure hashed password
    ];

    // Generate OTP
    $otp = rand(100000, 999999);
    $_SESSION['otp'] = $otp;

    // Send Email with PHPMailer
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'delimachristianmabutol@gmail.com'; // Gmail account with App Password
        $mail->Password   = 'uabkygitvypevisn';                  // App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        // Recipients
        $mail->setFrom('delimachristianmabutol@gmail.com', 'Library System');
        $mail->addAddress($email, $firstName . ' ' . $lastName);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Your OTP Code - Library System';
        $mail->Body    = "<h3>Hi $firstName,</h3><p>Your verification OTP code is:</p><h2>$otp</h2><br><p>Use this code to complete your signup.</p>";
        $mail->AltBody = "Hi $firstName, your OTP is $otp";

        $mail->send();
        header("Location: otp_verify.php");
        exit;

    } catch (Exception $e) {
        echo "❌ Email could not be sent. Error: {$mail->ErrorInfo}";
    }
}
?>
