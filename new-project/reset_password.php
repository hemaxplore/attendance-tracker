<?php
include 'db.php';

// Step 1: Read token from URL
if (!isset($_GET['token'])) {
    die("Invalid reset link.");
}

$token = $_GET['token'];

// Step 2: Check if token exists in DB
$stmt = $conn->prepare("SELECT * FROM users WHERE reset_token = ?");
$stmt->bind_param("s", $token);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Invalid or expired token.");
}

$user = $result->fetch_assoc();
?>

<!-- Step 3: Show password reset form -->
<form method="POST" action="save_new_password.php">
  <input type="hidden" name="token" value="<?php echo $token; ?>">
  <input type="password" name="new_password" placeholder="Enter new password" required><br>
  <button type="submit">Save New Password</button>
</form>
