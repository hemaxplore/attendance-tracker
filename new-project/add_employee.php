<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $emp_id = $_POST['emp_id'];
  $name = $_POST['name'];
  $address = $_POST['address'];

  // Upload photo
  $photo = $_FILES['photo']['name'];
  $target = "photos/" . basename($photo);
  move_uploaded_file($_FILES['photo']['tmp_name'], $target);

  // Insert with address
  $stmt = $conn->prepare("INSERT INTO employees (emp_id, name, address, photo) VALUES (?, ?, ?, ?)");
  $stmt->bind_param("ssss", $emp_id, $name, $address, $target);
  $stmt->execute();

  echo "<script>
    alert('Employee added successfully!');
    window.location.href = 'index.php?t=' + new Date().getTime();
  </script>";
  exit;
}
?>

<style>
  .form-container {
    width: 400px;
    margin: 30px auto;
    padding: 30px;
    background: #f8f9fa;
    border-radius: 12px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    font-family: Arial, sans-serif;
  }

  .form-container .header {
    font-size: 20px;
    font-weight: bold;
    color: #333;
    margin-bottom: 20px;
    text-align: center;
  }

  .form-container label {
    display: block;
    font-weight: bold;
    margin-top: 10px;
    margin-bottom: 5px;
    color: #555;
  }

  .form-container input[type="text"],
  .form-container input[type="file"],
  .form-container input[textarea="address"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 6px;
    box-sizing: border-box;
  }

  .form-container button {
    margin-top: 20px;
    width: 100%;
    padding: 12px;
    background-color: #28a745;
    border: none;
    color: white;
    font-size: 16px;
    font-weight: bold;
    border-radius: 8px;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }

  .form-container button:hover {
    background-color: #218838;
  }

  .back-btn {
    background-color: #6c757d;
    color: white;
    padding: 10px 16px;
    border: none;
    border-radius: 8px;
    font-size: 14px;
    font-weight: bold;
    text-decoration: none;
    display: inline-block;
    cursor: pointer;
    transition: background-color 0.3s ease;
    margin-bottom: 20px;
  }

  .back-btn:hover {
    background-color: #5a6268;
  }
</style>

<div class="form-container">
  <div class="header">Add New Employee</div>
  <form method="POST" enctype="multipart/form-data">
    <label>Employee ID:</label>
    <input type="text" name="emp_id" required><br>

    <label>Name:</label>
    <input type="text" name="name" required><br>

    <label>Address:</label>
    <textarea name="address" name="address" required></textarea><br>

    <label>Photo:</label>
    <input type="file" name="photo" accept="image/*" required><br>

    <button type="submit">Add Employee</button>
    <a href="index.php">
      <button type="button" class="btn back-btn">Back to Dashboard</button>
    </a>
  </form>
</div>
