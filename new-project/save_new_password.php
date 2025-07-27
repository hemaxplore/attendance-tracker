<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
   .btn {
  display: inline-block;
  background-color: #007bff;
  color: white;
  padding: 10px 16px;
  text-decoration: none;
  border-radius: 6px;
  font-size: 16px;
  transition: background-color 0.3s ease;
}

.btn i {
  margin-right: 8px;
}

.btn:hover {
  background-color: #0056b3;
}
</style>
<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['token'];
    $newPassword = $_POST['new_password'];

    // Step 1: Validate token
    $stmt = $conn->prepare("SELECT * FROM users WHERE reset_token = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        $username = $user['username'];

        // ? Step 2: Update password and clear token
        $update = $conn->prepare("UPDATE users SET password = ?, reset_token = NULL WHERE username = ?");
        $update->bind_param("ss", $newPassword, $username);
        $update->execute();

        echo "<h3 style='color:green;'>Password updated successfully!</h3>";
        echo "<a href='login.php' class='btn'><i class='fas fa-sign-in-alt'></i> Go to Login</a>";

    } else {
        echo "<h3 style='color:red;'>Invalid or expired reset token.</h3>";
    }
}
?>
