<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Login - Attendance System</title>
  <link rel="stylesheet" href="style.css">

  <!-- Font Awesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
 <style>
.forgot-password {
  margin-top: 15px;
  text-align: right;
}

.forgot-password a {
  color: #007bff;
  text-decoration: none;
  font-size: 14px;
}

.forgot-password a:hover {
  text-decoration: underline;
}
 </style>
</head>
<body>

  <center>
  <div class="login-container">
    <h2><i class="fas fa-user-shield"></i> Admin Login</h2>
    <form action="check_login.php" method="POST">
      <div class="input-box">
        <i class="fas fa-user"></i>
        <input type="text" name="username" placeholder="Username" required>
      </div>

      <div class="input-box">
        <i class="fas fa-lock"></i>
        <input type="password" name="password" placeholder="Password" required>
      </div>

      <button type="submit" class="login-btn">Login</button>
	  
	  <!--  Forgot password link -->
  <div class="forgot-password">
    <a href="forgot_password.php">Forgot Password</a>
  </div>
    </form>
  </div>
  </center>
</body>
</html>
