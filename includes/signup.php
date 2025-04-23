<?php
require_once '../model/connection.php'; // Include your DB connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    // Validate form data
    if ($password !== $confirmPassword) {
        die("❌ Passwords do not match.");
    }

    if (strlen($password) < 8) {
        die("❌ Password must be at least 8 characters long.");
    }

    // Hash password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Check if username or email already exists
    $checkSql = "SELECT COUNT(*) AS count FROM users WHERE username = :username OR email = :email";
    $checkStmt = oci_parse($conn, $checkSql);
    oci_bind_by_name($checkStmt, ':username', $username);
    oci_bind_by_name($checkStmt, ':email', $email);
    oci_execute($checkStmt);
    $row = oci_fetch_assoc($checkStmt);

    if ($row['COUNT'] > 0) {
        die("❌ Username or email already exists.");
    }

    // Generate OTP
    $otp = rand(100000, 999999); // Generate a 6-digit OTP

    // Store OTP in session
    session_start();
    $_SESSION['otp'] = $otp;
    $_SESSION['email'] = $email;

    // Send OTP via email
    $subject = "Your OTP Code";
    $message = "Your OTP code is: " . $otp;
    $headers = "From: no-reply@yourdomain.com";

    if (mail($email, $subject, $message, $headers)) {
        // Redirect to OTP verification page
        header("Location: verify_otp.php");
        exit;
    } else {
        die("❌ Failed to send OTP email.");
    }
}
?>

<!-- Signup form -->
<form action="signup.php" method="POST">
    <input type="text" name="firstName" placeholder="First Name" required>
    <input type="text" name="lastName" placeholder="Last Name" required>
    <input type="text" name="username" placeholder="Username" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="password" name="confirmPassword" placeholder="Confirm Password" required>
    <input type="submit" value="Sign Up">
</form>
