<?php
session_start();
include('connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $inputOtp = $_POST['otp'];

    if ($inputOtp == $_SESSION['otp']) {
        // OTP correct - insert into DB
        if (isset($_SESSION['signup'])) {
            $data = $_SESSION['signup'];
            $firstName = $data['firstName'];
            $lastName = $data['lastName'];
            $username = $data['username'];
            $email = $data['email'];
            $password = $data['password'];

            $query = "INSERT INTO users (ID, FIRST_NAME, LAST_NAME, USERNAME, EMAIL, PASSWORD)
                      VALUES (USERS_SEQ.NEXTVAL, :fname, :lname, :username, :email, :password)";
            $stmt = oci_parse($conn, $query);
            oci_bind_by_name($stmt, ":fname", $firstName);
            oci_bind_by_name($stmt, ":lname", $lastName);
            oci_bind_by_name($stmt, ":username", $username);
            oci_bind_by_name($stmt, ":email", $email);
            oci_bind_by_name($stmt, ":password", $password);

            if (oci_execute($stmt)) {
                unset($_SESSION['signup'], $_SESSION['otp']);
                echo "✅ Account created successfully! You can now <a href='index.php'>login</a>.";
            } else {
                echo "❌ Error inserting user.";
            }
        } else {
            echo "❌ No signup data found.";
        }
    } else {
        echo "❌ Invalid OTP.";
    }
}
?>
