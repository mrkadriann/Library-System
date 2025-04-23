<?php
session_start();

// Example: Assuming user's name was saved during login/signup
if (!isset($_SESSION['username'])) {
    // Redirect to login if not logged in
    header("Location: index.php");
    exit();
}

$userName = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Library System</title>
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/main.css">
  <script defer src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-light">

  <div class="container text-center mt-5">
    <h1 class="display-4">Welcome to the Library System!, <?php echo htmlspecialchars($userName); ?></h1>
    <p class="lead">Explore our wide range of books and resources.</p>
    <a href="logout.php" class="btn btn-danger mt-3">Logout</a>
  </div>

</body>
</html>
