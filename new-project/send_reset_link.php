<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    // Check if email exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Generate random reset token
        $token = bin2hex(random_bytes(16));

        // Save the token in DB
        $update = $conn->prepare("UPDATE users SET reset_token = ? WHERE email = ?");
        $update->bind_param("ss", $token, $email);
        $update->execute();

        // Create reset link using correct folder name
        $resetLink = "http://localhost/new-project/reset_password.php?token=$token";

        echo "<h3>Reset link generated successfully!</h3>";
        echo "<p>Since email is not configured, here is your reset link:</p>";
        echo "<a href='$resetLink'>$resetLink</a>";
    } else {
        echo "<h3 style='color:red;'>Email not found in the system.</h3>";
    }
}
?>
