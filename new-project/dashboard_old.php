<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}
$page = $_GET['page'] ?? 'home';  // Default to home
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', sans-serif;
    }
    body {
      background-color: #f4f7fa;
      display: flex;
      height: 100vh;
    }
    .sidebar {
      width: 250px;
      background-color: #2f4050;
      color: white;
	  height: 100vh;
      padding: 20px;
	  box-sizing: border-box;
    }
    .sidebar h2 {
      font-size: 22px;
      margin-bottom: 30px;
    }
    .sidebar ul {
      list-style: none;
	  padding: 0;
    }
    .sidebar ul li {
      margin-bottom: 15px;
    }
    .sidebar ul li a {
      text-decoration: none;
      color: white;
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 10px;
      border-radius: 8px;
      transition: background 0.3s;
    }
    .sidebar ul li a:hover, .sidebar ul li a.active {
      background-color: #1ab394;
    }
    .main-content {
      flex: 1;
      padding: 30px;
      overflow-y: auto;
	  background: url('photos/dash.jpg') no-repeat center center;
 	  background-size: cover; /* Make sure image covers the full content area */
      backdrop-filter: brightness(0.95); /* Optional: adds slight dim effect for readability */
    }
    .header {
      background-color: #3498db;
      color: white;
      padding: 20px;
      border-radius: 10px;
      font-size: 20px;
      margin-bottom: 20px;
    }
    .card {
      background: white;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      padding: 20px;
      margin-bottom: 20px;
    }
    .card h3 {
      margin-bottom: 10px;
    }
    .flex-cards {
      display: flex;
      gap: 20px;
      flex-wrap: wrap;
    }
    .flex-cards .card {
      flex: 1;
      min-width: 200px;
      text-align: center;
    }
    .analysis-report {
      background: white;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      padding: 20px;
    }
    .analysis-report h3 {
      margin-bottom: 20px;
    }
    .chart-container {
      max-width: 600px;
      margin: auto;
    }
  </style>
</head>
<body>
  <div class="sidebar">
    <h2>Admin Panel</h2>
    <ul>
      <li><a href="dashboard.php" class="active"><i class="fas fa-home"></i> Dashboard</a></li>
      <li><a href="employees.php"><i class="fas fa-users"></i> Employee List</a></li>
      <li><a href="mark_attendance.php"><i class="fas fa-calendar-check"></i> Mark Attendance</a></li>
      <li><a href="attendance_report.php"><i class="fas fa-chart-line"></i> Reports</a></li>
      <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
    </ul>
  </div>

  <div class="main-content">
    <div class="header">Employee Attendance Dashboard</div>
    <div class="card">
      <h3>Welcome, Yugan 👋</h3>
      <p>Select an option from the left sidebar to manage the system.</p>
    </div>

    <div class="flex-cards">
      <div class="card">
        <h3>Total Employees</h3>
        <p>15</p>
      </div>
      <div class="card">
        <h3>Present Today</h3>
        <p>13</p>
      </div>
      <div class="card">
        <h3>Absent Today</h3>
        <p>2</p>
      </div>
      <div class="card">
        <h3>Monthly Attendance</h3>
        <p>88%</p>
      </div>
    </div>

    <div class="analysis-report">
      <h3><i class="fas fa-chart-pie"></i> Attendance Analysis Report</h3>
      <div class="chart-container">
        <canvas id="attendancePieChart"></canvas>
      </div>
    </div>
  </div>

  <script>
    const ctx = document.getElementById('attendancePieChart').getContext('2d');
    new Chart(ctx, {
      type: 'pie',
      data: {
        labels: ['Present', 'Absent', 'Leave'],
        datasets: [{
          label: 'Attendance Breakdown',
          data: [65, 20, 15], // Example data
          backgroundColor: [
            '#1abc9c', // Present
            '#e74c3c', // Absent
            '#f1c40f'  // Leave
          ],
          borderColor: '#fff',
          borderWidth: 2
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: {
            position: 'bottom'
          },
          title: {
            display: true,
            text: 'Monthly Attendance Overview'
          }
        }
      }
    });
  </script>
</body>
</html>
