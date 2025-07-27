 <?php
session_start();
include 'db.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}

$today = date('Y-m-d');
?>

<!DOCTYPE html>
<html>
<head>
  <title>Mark Attendance</title>
  <style>
    body { font-family: Arial; background: #f0f0f0; padding: 20px; }
    h2 { color: #2d6a4f; }
    table { background: white; width: 100%; border-collapse: collapse; }
    th, td { padding: 12px; text-align: center; border: 1px solid #ccc; }
    .button-wrapper {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-top: 20px;
    }
    .left-button,
    .right-button {
      padding: 12px 24px;
      font-size: 16px;
      background-color: #28a745;
      color: white;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      width: 200px;
      font-weight: bold;
    }
    .left-button:hover,
    .right-button:hover {
      background-color: #218838;
    }
  </style>
</head>
<body>


  <h2>Mark Attendance - <?php echo $today; ?></h2>
  <form action="submit_attendance.php" method="POST">
    <table>
      <tr>
        <th>Emp ID</th>
        <th>Name</th>
        <th>Present</th>
        <th>Absent</th>
      </tr>

      <?php
      $query = "SELECT * FROM employees ORDER BY emp_id ASC";
      $result = $conn->query($query);

      if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              $emp_id = $row['emp_id'];
              $name = $row['name'];

              echo "<tr>
                      <td>$emp_id</td>
                      <td>$name</td>
                      <td>
					  <input type='radio' name='attendance[$emp_id]' value='Present' required></td>
                      <td><input type='radio' name='attendance[$emp_id]' value='Absent'></td>
                    </tr>";
          }
      } else {
          echo "<tr><td colspan='4'>No employees found.</td></tr>";
      }
      ?>
    </table>

    <div class="button-wrapper">
      <button type="submit" class="left-button">Submit Attendance</button>
      <a href="index.php">
        <button type="button" class="right-button">Back to Dashboard</button>
      </a>
    </div>
  </form>
</body>
</html>
