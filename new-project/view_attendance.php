<?php
session_start();
if (!isset($_SESSION['username'])) {
    exit("Access denied.");
}

include 'db.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Attendance</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h2 {
            text-align: center;
            margin-top: 20px;
        }
        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            background: white;
        }
        th, td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ccc;
        }
        th {
            background-color: #3498db;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .back-button {
            display: block;
            margin: 20px auto;
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            font-weight: bold;
            border-radius: 6px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            width: fit-content;
        }
        .back-button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

<h2>Employee Attendance Records</h2>

<table>
    <thead>
        <tr>
            <th>Employee ID</th>
            <th>Name</th>
            <th>Date</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Fetch all attendance records with employee name
        $query = "
            SELECT a.employee_id, e.name, a.attendance_date, a.status
            FROM attendance a
            JOIN employees e ON a.employee_id = e.emp_id
            ORDER BY a.attendance_date DESC
        ";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                    <td>{$row['employee_id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['attendance_date']}</td>
                    <td>{$row['status']}</td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No attendance records found.</td></tr>";
        }
        ?>
    </tbody>
</table>

<a href="index.php" class="back-button">Back to Dashboard</a>

</body>
</html>
