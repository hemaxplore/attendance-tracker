<!DOCTYPE html>
<html>
<head>
  <title>Forgot Password</title>
  <style>
    body {
      font-family: Arial;
      background-color: #f0f2f5;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .box {
      background: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    input {
      width: 100%;
      padding: 10px;
      margin-top: 10px;
    }
    button {
      margin-top: 15px;
      padding: 10px 20px;
      background: #007bff;
      color: white;
      border: none;
      border-radius: 5px;
    }
  </style>
</head>
<body>
  <div class="box">
    <h2>Forgot Password</h2>
    <form action="send_reset_link.php" method="POST">
      <label>Enter your email</label>
      <input type="email" name="email" required>
      <button type="submit">Send Reset Link</button>
    </form>
  </div>
</body>
</html>

