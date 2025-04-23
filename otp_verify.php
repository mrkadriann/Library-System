<?php
session_start();
if (!isset($_SESSION['otp'])) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Verify OTP</title>
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
</head>
<body class="bg-light">
  <div class="container mt-5">
    <div class="card shadow mx-auto" style="max-width: 400px;">
      <div class="card-body">
        <h4 class="text-center">Enter OTP</h4>
        <form method="POST" action="verify_otp_action.php">
          <div class="mb-3">
            <label for="otp" class="form-label">OTP Code</label>
            <input type="text" class="form-control" id="otp" name="otp" required>
          </div>
          <button type="submit" class="btn btn-primary w-100">Verify</button>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
