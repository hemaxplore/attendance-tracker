<?php
include 'db.php';

// Today's date
$today = date('Y-m-d');

// Summary counts
$present_count = $conn->query("SELECT COUNT(*) AS total FROM attendance WHERE date = '$today' AND status = 'Present'")->fetch_assoc()['total'];
$total_employees = $conn->query("SELECT COUNT(*) AS total FROM employees")->fetch_assoc()['total'];
$absent_count = $conn->query("SELECT COUNT(*) AS total FROM attendance WHERE date = '$today' AND status = 'Absent'")->fetch_assoc()['total'];

// Chart Data
$monthly_labels = [];
$monthly_present = [];
$monthly_absent = [];

for ($i = 1; $i <= 12; $i++) {
    $label = date("F", mktime(0, 0, 0, $i, 10)); // January, February, ...
    $monthly_labels[] = $label;

    // Present count
    $present_query = "SELECT COUNT(*) AS total FROM attendance WHERE status = 'Present' AND MONTH(date) = $i AND YEAR(date) = YEAR(CURDATE())";
    $present_result = $conn->query($present_query);
    $present_count_month = $present_result->fetch_assoc()['total'];
    $monthly_present[] = $present_count_month;

    // Absent count
    $absent_query = "SELECT COUNT(*) AS total FROM attendance WHERE status = 'Absent' AND MONTH(date) = $i AND YEAR(date) = YEAR(CURDATE())";
    $absent_result = $conn->query($absent_query);
    $absent_count_month = $absent_result->fetch_assoc()['total'];
    $monthly_absent[] = $absent_count_month;
}
?>

<h1 style="text-align:center; text-decoration:underline; color:#FF00CC; margin-bottom: 20px;">Employee Attendance Dashboard</h1>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<div style="margin-bottom: 30px;">
  <h3><i class="fas fa-user-shield"></i> Welcome Admin</h3>
</div>

<!-- Summary Cards -->
<div style="display: flex; gap: 20px; flex-wrap: wrap;">
  <div style="flex: 1; min-width: 200px; background: #17a2b8; color: white; padding: 20px; border-radius: 10px;">
    <h3><i class="fas fa-users"></i> <?= $present_count ?></h3>
    <p>Present Employees</p>
    <a href="javascript:void(0)" onclick="loadPage('employees.php')" style="color: white; text-decoration: underline;">More info</a>
  </div>
  <div style="flex: 1; min-width: 200px; background: #28a745; color: white; padding: 20px; border-radius: 10px;">
    <h3><i class="fas fa-percentage"></i> <?= $total_employees > 0 ? round(($present_count / $total_employees) * 100, 2) : 0 ?>%</h3>
    <p>Attendance Rate</p>
  </div>
  <div style="flex: 1; min-width: 200px; background: #ffc107; color: white; padding: 20px; border-radius: 10px;">
    <h3><i class="fas fa-user-times"></i> <?= $absent_count ?></h3>
    <p>Leaves Today</p>
  </div>
  <div style="flex: 1; min-width: 200px; background: #6f42c1; color: white; padding: 20px; border-radius: 10px;">
    <h3><i class="fas fa-id-card"></i> <?= $total_employees ?></h3>
    <p>Total Employees</p>
  </div>
</div>

<!-- Load Chart.js 
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Chart Style -->
<style>
  body {
    font-family: Arial;
    background: #f0f2f5;
    padding: 40px;
    text-align: center;
  }
  h2 {
    color: #333;
    margin-bottom: 20px;
    margin-top: 40px;
  }
  canvas {
    background: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
  }
</style>

<h2>Monthly Attendance Bar Chart</h2>

<!-- Chart Button -->
<div style="display: flex; justify-content: center; margin-bottom: 30px;">
    <button onclick="window.location.href='monthly_chart.php'"
        style="
            display: flex;
            align-items: center;
            padding: 12px 20px;
            background-color: #28a745;
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            color: #fff;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        "
        onmouseover="this.style.backgroundColor='#218838'; this.style.transform='scale(1.05)'"
        onmouseout="this.style.backgroundColor='#28a745'; this.style.transform='scale(1)'"
    >
        <img src="bar_chart.png" alt="Chart Icon" width="24" height="24" style="margin-right: 10px;">
        View Full Chart
    </button>
</div>

<!-- Back to Dashboard Button -->
<!--<div style="display: flex; justify-content: center; margin-top: 40px;">
    <button onclick="window.location.href='index.php'"
        style="
            display: flex;
            align-items: center;
            padding: 12px 20px;
            background-color: #007bff;
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            color: #fff;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        "
        onmouseover="this.style.backgroundColor='#0069d9'; this.style.transform='scale(1.05)'"
        onmouseout="this.style.backgroundColor='#007bff'; this.style.transform='scale(1)'"
    >
        <img src="dashboard.png" alt="Dashboard Icon" width="24" height="24" style="margin-right: 10px;">
        Back to Dashboard
    </button>
</div>-->