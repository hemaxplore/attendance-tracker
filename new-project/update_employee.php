<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $emp_id = $_POST['emp_id'];
    $name = $_POST['name'];
	$address = $_POST['address'];
    $photo = $_FILES['photo']['name'];

    if (!empty($photo)) {
        $target = "photos/" . basename($photo);
        if (move_uploaded_file($_FILES['photo']['tmp_name'], $target)) {
            // Update with new photo
            $stmt = $conn->prepare("UPDATE employees SET name=?, address=?, photo=? WHERE emp_id=?");
            $stmt->bind_param("ssss", $name, $address, $target, $emp_id);
        } else {
            echo "Failed to upload new photo.";
            exit;
        }
    } else {
        // Update name, address only
        $stmt = $conn->prepare("UPDATE employees SET name=?, address=? WHERE emp_id=?");
        $stmt->bind_param("sss", $name, $address, $emp_id);
    }

    if ($stmt->execute()) {
    echo "<script>
        alert('Employee updated successfully!');
        window.location.href = 'employees.php';
    </script>";
    exit;

    } else {
        echo "Error updating employee.";
    }
}
?>


