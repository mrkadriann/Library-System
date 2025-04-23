<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Library System</title>
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <script defer src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-light">
  
  <div class="container mt-5">
    <div class="card shadow mx-auto" style="max-width: 500px;">
      <div class="card-header text-center">
        <ul class="nav nav-tabs card-header-tabs" id="formTabs" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="login-tab" data-bs-toggle="tab" data-bs-target="#login" type="button" role="tab">Login</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="signup-tab" data-bs-toggle="tab" data-bs-target="#signup" type="button" role="tab">Signup</button>
          </li>
        </ul>
      </div>
      <div class="card-body">
        <div class="tab-content" id="formTabsContent">
          <!-- Login Form -->
          <div class="tab-pane fade show active" id="login" role="tabpanel">
            <form action="login_action.php" method="POST">
              <div class="mb-3">
                <label for="loginUsername" class="form-label">Username</label>
                <input type="text" class="form-control" id="loginUsername" name="username" required>
              </div>
              <div class="mb-3 position-relative">
                <label for="loginPassword" class="form-label">Password</label>
                <input type="password" class="form-control" id="loginPassword" name="password" required>
                <button type="button" class="btn btn-sm btn-outline-secondary position-absolute top-50 end-0 translate-middle-y me-2" onclick="togglePassword()" style="z-index: 10;">
                  Show
                </button>
              </div>
              <button type="submit" class="btn btn-primary w-100">Login</button>
              <div class="text-center mt-2">
                <a href="forgot_password.php">Forgot Password?</a>
              </div>
            </form>
          </div>

          <!-- Signup Form -->
          <div class="tab-pane fade" id="signup" role="tabpanel">
            <form action="send_otp.php" method="POST">
              <div class="mb-3">
                <label for="firstName" class="form-label">First Name</label>
                <input type="text" class="form-control" id="firstName" name="firstName" required>
              </div>
              <div class="mb-3">
                <label for="lastName" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="lastName" name="lastName" required>
              </div>
              <div class="mb-3">
                <label for="signupUsername" class="form-label">Username</label>
                <input type="text" class="form-control" id="signupUsername" name="username" required>
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
              </div>
              <div class="mb-3">
                <label for="signupPassword" class="form-label">Password</label>
                <input type="password" class="form-control" id="signupPassword" name="password" required>
              </div>
              <div class="mb-3">
                <label for="confirmPassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
              </div>

              <button type="submit" class="btn btn-success w-100">Sign Up</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>
</html>
