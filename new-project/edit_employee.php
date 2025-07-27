<?php
include 'db.php';

if (!isset($_GET['id'])) {
    echo "Employee ID is missing.";
    exit;
}

$emp_id = $_GET['id'];

// Fetch existing data
$stmt = $conn->prepare("SELECT name, photo, address FROM employees WHERE emp_id = ?");
$stmt->bind_param("s", $emp_id);
$stmt->execute();
$stmt->bind_result($name, $photo, $address);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Employee</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f2f2f2;
            padding: 40px;
        }

        .container {
            background-color: #fff;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            max-width: 500px;
            margin: auto;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-top: 15px;
            color: #555;
        }

        input[type="text"],
        input[type="file"] {
            width: 100%;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
            margin-top: 5px;
        }

        img {
            margin-top: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            width: 100px;
        }

        button {
            background-color: #28a745;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 20px;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #218838;
        }

        .back-btn {
            background-color: #28a745;
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
            background-color: #218838;
        }
    </style>
</head>
<body
<div class="container">

    <h2>Edit Employee</h2>

    <form action="Update_employee.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="emp_id" value="<?php echo $emp_id; ?>">

        <label>Name:</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
		
		<label for="address">Address:</label>
        <textarea name="address" rows="4" cols="50"><?php echo htmlspecialchars($address); ?></textarea>

        <label>Current Photo:</label>
        <img src="<?php echo $photo; ?>" alt="Current Photo">

        <label>Change Photo:</label>
        <input type="file" name="photo" accept="image/*">

        <button type="submit">Update Employee</button>
		<a href="index.php">
    <button type="button" class="btn back-btn">Back to Dashboard</button>
    </form>
</div>

</body>
</html>
