<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}

// Get current month and year
$currentMonth = date('m');
$currentYear = date('Y');

// Fetch employee list
$employees = [];
$emp_result = $conn->query("SELECT emp_id, name FROM employees ORDER BY emp_id ASC");
while ($row = $emp_result->fetch_assoc()) {
    $employees[$row['emp_id']] = $row['name'];
}

// Initialize arrays
$presentData = [];
$absentData = [];
$labels = [];

// Get present/absent counts for each employee
foreach ($employees as $emp_id => $name) {
    $query = "SELECT status FROM attendance 
              WHERE emp_id = '$emp_id' 
              AND MONTH(date) = '$currentMonth' 
              AND YEAR(date) = '$currentYear'";

    $result = $conn->query($query);

    $present = 0;
    $absent = 0;

    while ($row = $result->fetch_assoc()) {
        if ($row['status'] == 'Present') $present++;
        if ($row['status'] == 'Absent') $absent++;
    }

    $labels[] = $name;
    $presentData[] = $present;
    $absentData[] = $absent;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Monthly Attendance Chart</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        h2 { text-align: center; color: #2d6a4f; }
        #chart-container { width: 90%; margin: auto; }
        .back-button {
            margin-top: 30px;
            display: block;
            width: fit-content;
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
        }
        .back-button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

<h2>Monthly Attendance Report (<?php echo date('F Y'); ?>)</h2>
<center>
<div id="chart-container">
    <canvas id="attendanceChart"></canvas>
</div>
<a href="index.php" class="back-button">Back to Dashboard</a>
</center>

<script>
const ctx = document.getElementById('attendanceChart').getContext('2d');

const data = {
    labels: <?php echo json_encode($labels); ?>,
    datasets: [
        {
            label: 'Present',
            data: <?php echo json_encode($presentData); ?>,
            backgroundColor: '#28a745'
        },
        {
            label: 'Absent',
            data: <?php echo json_encode($absentData); ?>,
            backgroundColor: '#dc3545'
        }
    ]
};

const config = {
    type: 'bar',
    data: data,
    options: {
        responsive: true,
        plugins: {
            tooltip: {
                callbacks: {
                    label: function(context) {
                        const total = data.datasets[0].data[context.dataIndex] + data.datasets[1].data[context.dataIndex];
                        const count = context.raw;
                        const percentage = total > 0 ? ((count / total) * 100).toFixed(1) : 0;
                        return `${context.dataset.label}: ${count} (${percentage}%)`;
                    }
                }
            },
            title: {
                display: true,
                text: 'Employee Monthly Attendance'
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                title: {
                    display: true,
                    text: 'Days'
                }
            },
            x: {
                title: {
                    display: true,
                    text: 'Employee'
                }
            }
        }
    }
};

const attendanceChart = new Chart(ctx, config);
</script>

</body>
</html>
