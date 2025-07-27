<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}
include 'db.php';
?>

<!DOCTYPE html>
<html>
<head>
  <title>Attendance Report</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f4f4;
      margin: 0;
      padding: 0;
    }

    .container {
      /*margin-left: 220px;*/
      padding: 20px;
    }

    h2 {
      color: #2c3e50;
      margin-bottom: 20px;
    }

    table {
      width: 100%;
      background-color: white;
      border-collapse: collapse;
      margin-bottom: 20px;
    }

    th, td {
      padding: 10px;
      text-align: center;
      border: 1px solid #ccc;
    }

    th {
      background-color: #007bff;
      color: white;
    }

    tr:nth-child(even) {
      background-color: #f9f9f9;
    }

    .back-link {
      text-decoration: none;
      background: #007bff;
      color: white;
      padding: 10px 15px;
      border-radius: 5px;
    }
  </style>
</head>
<body>

<div class="container">
  <h2>Attendance Report</h2>
  <table>
    <tr>
      <th>Emp ID</th>
      <th>Date</th>
      <th>Status</th>
    </tr>

    <?php
    $sql = "SELECT emp_id, date, status FROM attendance ORDER BY date DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['emp_id']}</td>
                    <td>{$row['date']}</td>
                    <td>{$row['status']}</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='3'>No attendance data found</td></tr>";
    }
    ?>
  </table>
  <a href="index.php" class="back-link">Back to Dashboard</a>
</div>

</body>
</html>
