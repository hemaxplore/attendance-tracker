<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['attendance'])) {
    $attendance = $_POST['attendance'];
    $date = date('Y-m-d');

    foreach ($attendance as $emp_id => $status) {
        // Check if already marked
        $check = $conn->prepare("SELECT * FROM attendance WHERE emp_id = ? AND date = ?");
        $check->bind_param("ss", $emp_id, $date);
        $check->execute();
        $result = $check->get_result();

        if ($result->num_rows == 0) {
            $stmt = $conn->prepare("INSERT INTO attendance (emp_id, date, status) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $emp_id, $date, $status);
            $stmt->execute();
        }
    }

    echo "<script>alert('Attendance marked successfully!'); window.location='index.php';</script>";
} else {
    echo "<script>alert('No attendance data received.'); window.location='mark_attendance.php';</script>";
}
?>