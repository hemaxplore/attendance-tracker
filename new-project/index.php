<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
      height: 100vh;
      display: flex;
      flex-direction: column;
      background-color: #f4f7fa;
    }

    .main-wrapper {
      flex: 1;
      display: flex;
      overflow: hidden;
    }

    .sidebar {
      width: 250px;
      background-color: #2f4050;
      color: white;
      padding: 20px;
    }

    .sidebar h2 {
      font-size: 22px;
      margin-bottom: 30px;
	  color:#FFFFCC;
    }

    .sidebar ul {
      list-style: none;
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

    .sidebar ul li a:hover,
    .sidebar ul li a.active {
      background-color: #1ab394;
    }

    .content-area {
      flex: 1;
      display: flex;
      flex-direction: column;
    }

    .header {
      background-color: #ffffff;
      padding: 20px;
      border-bottom: 1px solid #ddd;
      font-size: 20px;
      font-weight: bold;
      color: #333;
      text-align: center;
    }

    .main-content {
      flex: 1;
      padding: 30px;
      overflow-y: auto;
      backdrop-filter: brightness(0.95);
    }

    .footer {
      background-color: #2f4050;
      color: white;
      padding: 10px 20px;
      text-align: center;
    }

    .footer a {
      color: #1ab394;
      margin: 0 10px;
      text-decoration: none;
    }

    .footer a:hover {
      color: #ffffff;
    }

  /* ========== RESPONSIVE DESIGN START ========== */

  @media (max-width: 768px) {
    .main-wrapper {
      flex-direction: column;
    }

    .sidebar {
      width: 100%;
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
    }

    .sidebar h2 {
      width: 100%;
      text-align: center;
    }

    .sidebar ul {
      width: 100%;
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
    }

    .sidebar ul li {
      margin: 5px;
    }

    .sidebar ul li a {
      flex-direction: column;
      align-items: center;
      font-size: 14px;
    }

    .main-content {
      padding: 15px;
    }

    .header {
      font-size: 18px;
      padding: 10px;
    }
  }

  @media (max-width: 480px) {
    .sidebar ul li a {
      font-size: 12px;
      padding: 8px;
    }

    .footer {
      font-size: 12px;
    }
  }
  @media (max-width: 480px) {
  .header {
    font-size: 16px;
  }

  .sidebar h2 {
    font-size: 18px;
  }

  .footer {
    font-size: 12px;
    padding: 5px;
  }
}


  /* ========== RESPONSIVE DESIGN END ========== */

  </style>
</head>
<body>

<!-- Top-level container -->
<div class="main-wrapper">
 <button class="btn btn-primary d-md-none" onclick="toggleSidebar()" style="position: fixed; top: 10px; left: 10px; z-index: 1000;">
  <i class="fas fa-bars"></i>
</button>

  <!-- Sidebar -->
  <div class="sidebar">
    <h2>Admin Panel</h2>
    <ul>
      <li><a href="javascript:void(0)" onClick="loadPage('dashboard_content.php')"><i class="fas fa-home"></i> Dashboard</a></li>
      <li><a href="javascript:void(0)" onClick="loadPage('employees.php')"><i class="fas fa-users"></i> Employee List</a></li>
      <li><a href="javascript:void(0)" onClick="loadPage('mark_attendance.php')"><i class="fas fa-calendar-check"></i> Mark Attendance</a></li>
      <li><a href="javascript:void(0)" onClick="loadPage('attendance_report.php')"><i class="fas fa-chart-line"></i> Reports</a></li>
      <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
    </ul>
  </div>

  <!-- Content -->
  <div class="content-area">
    <!-- Header -->
    <div class="header">Attendance Tracker</div>

    <!-- Dynamic Content Area -->
    <div class="main-content" id="main-content">
      <p>Loading dashboard...</p>
    </div>
  </div>

</div>

<!-- Footer -->
<div class="footer">
  Follow us:
  <a href="https://facebook.com" target="_blank"><i class="fab fa-facebook"></i></a>
  <a href="mailto:darshinihema2102@gmail.com"><i class="fas fa-envelope"></i></a>
  <a href="https://linkedin.com" target="_blank"><i class="fab fa-linkedin"></i></a>
  <a href="https://instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
</div>

<!-- JavaScript -->
<script>
  function loadPage(page) {
    fetch(page)
      .then(res => res.text())
      .then(data => {
        document.getElementById("main-content").innerHTML = data;

        // Highlight active menu
        document.querySelectorAll(".sidebar ul li a").forEach(link => {
          link.classList.remove("active");
          if (link.getAttribute("onclick")?.includes(page)) {
            link.classList.add("active");
          }
        });

        if (typeof drawAttendanceChart === "function") {
          drawAttendanceChart();
        }
      });
  }

  // Load dashboard by default
  window.onload = () => loadPage('dashboard_content.php');
</script>

<!-- Additional Script for Pagination Support -->
<script>
  // Global event listener for dynamic pagination buttons
  document.addEventListener("click", function(e) {
    if (e.target.classList.contains("page-btn")) {
      e.preventDefault();
      const page = e.target.getAttribute('data-page');
      loadPage('employees.php?page=' + page);
    }
  });
  
  function toggleSidebar() {
  const sidebar = document.querySelector('.sidebar');
  sidebar.classList.toggle('d-none');
}

</script>

</body>
</html>
