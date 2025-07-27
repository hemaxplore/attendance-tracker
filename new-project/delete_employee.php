<!--This will delete employee by emp_id-->

<?php
include 'db.php';

if (!isset($_GET['id'])) {
    echo "error: missing id";
    exit;
}

$emp_id = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM employees WHERE emp_id = ?");
$stmt->bind_param("s", $emp_id);

if ($stmt->execute()) {
     header("Location: employees.php"); // redirect to employee list
    exit;
} else {
     echo "Error deleting employee.";
}
?>


