<?php
session_start(); // Make sure this is at the top of the script
include('connection.php'); // Include your database connection
include('helpers.php'); // Include the helper functions

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get POST data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if username or password is empty
    if (empty($username) || empty($password)) {
        handle_error('Username or Password cannot be empty.');
    }

    // Prepare query to fetch user from DB
    $query = "SELECT * FROM users WHERE username = :username";
    $stmt = oci_parse($conn, $query);

    if (!$stmt) {
        handle_error('Error preparing SQL query: ' . oci_error($conn)['message']);
    }

    // Bind the username
    oci_bind_by_name($stmt, ":username", $username);

    // Execute the query
    $executeResult = oci_execute($stmt);
    if (!$executeResult) {
        handle_error('Error executing query: ' . oci_error($stmt)['message']);
    }

    // Fetch the user data
    $user = oci_fetch_assoc($stmt);
    if (!$user) {
        handle_error('Username not found.');
    }

    // Verify the password if the user exists
    if (!password_verify($password, $user['PASSWORD'])) {
        handle_error('Incorrect password.');
    }

    // Successful login
    $_SESSION['user_id'] = $user['ID']; // Store user ID in session
    $_SESSION['username'] = $user['USERNAME']; // Store username in session\

    // Redirect to the dashboard
    header("Location: dashboard.php");
    exit;
} else {
    handle_error('Invalid request method.');
    
}
?>
