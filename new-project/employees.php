<?php
session_start();
if (!isset($_SESSION['username'])) {
    exit("Access denied.");
}
include 'db.php';

// --- Pagination Setup ---
// Set records per page
$limit = 5;

// Get the current page from URL, default is 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? intval($_GET['page']) : 1;
$start = ($page - 1) * $limit;

// Fetch employees with limit and offset
$result = $conn->query("SELECT * FROM employees ORDER BY emp_id ASC LIMIT $start, $limit");

// Count total employees
$total_result = $conn->query("SELECT COUNT(*) AS total FROM employees");
$total_employees = $total_result->fetch_assoc()['total'];
$total_pages = ceil($total_employees / $limit);
?>

<style>
  table {
    width: 100%;
    background: white;
    border-collapse: collapse;
    margin-top: 20px;
  }
  th, td {
    padding: 12px;
    border: 1px solid #ccc;
    text-align: center;
  }
  img {
    width: 70px;
    height: 70px;
    object-fit: cover;
    border-radius: 50%;
  }
  .btn {
  display: inline-block;
  padding: 10px 16px;
  margin: 2px;
  border: none;
  border-radius: 8px;
  font-size: 14px;
  font-weight: bold;
  text-decoration: none;
  color: white;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.edit-btn {
  background-color: #007bff; /* Blue */
}

.delete-btn {
  background-color: #dc3545; /* Red */
}

.btn:hover {
  opacity: 0.85;
}
.add-employee-btn {
    background-color: #28a745;
    color: white;
    padding: 12px 24px;
    margin-top: 20px;
	margin-bottom: 20px;
    font-weight: bold;
    border-radius: 8px;
    border: none;
    cursor: pointer;
}
.button-wrapper {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-top: 20px;
}
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
.right-button:hover {
  background-color: #218838;
} 
.pagination-wrapper {
  display: flex;
  justify-content: center;
  margin: 30px 0;
}

.rounded-pagination {
  display: flex;
  gap: 10px;
  list-style: none;
  padding: 0;
  margin: 0;
}

.rounded-pagination li a {
  display: inline-block;
  padding: 10px 18px;
  border-radius: 50px;
  background-color: #f0f0f0;
  color: #007bff;
  font-weight: bold;
  text-decoration: none;
  transition: all 0.3s ease;
  border: 2px solid transparent;
}

.rounded-pagination li a:hover {
  background-color: #007bff;
  color: white;
}

.rounded-pagination li a.active {
  background-color: #007bff;
  color: white;
  border: 2px solid #0056b3;
  pointer-events: none;
}

</style>

<!-- Add Employee Button -->
<center>
  <h1>Employee List</h1>
</center>  
<div style="width: 90%; margin: 10px auto 0; display: flex; justify-content: flex-start;">
</div>

<table>

  <thead style="background:#3498db; color:white;">
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Photo</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
  <?php while($row = $result->fetch_assoc()) { ?>
  <tr>
    <td><?= $row['emp_id'] ?></td>
    <td><?= $row['name'] ?></td>
    <td><img src="<?= $row['photo'] ?>" width="60" height="60" style="border-radius:50%; object-fit:cover;"></td>
    <td>
      <a href="edit_employee.php?id=<?= $row['emp_id'] ?>" class="btn edit-btn">Edit</a>
      <button onclick="deleteEmployee('<?= $row['emp_id'] ?>')" class="btn delete-btn">Delete</button>

    </td>
  </tr>
<?php 
}
?>

  </tbody>
</table>


<div class="button-wrapper">
    <a href="index.php">
    <button type="button" class="right-button">Back to Dashboard</button>
  </a>
    <a href="add_employee.php" class="add-employee-btn">Add New Employee</a>
</div>

<!-- Pagination -->
<div style="margin-top: 20px; text-align: center;">
  <?php if ($total_pages > 1): ?>
    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
      <a href="#" class="page-btn" data-page="<?= $i ?>" style="margin: 0 5px; padding: 5px 10px; background-color: <?= ($i == $page) ? '#1ab394' : '#ccc' ?>; color: white; border-radius: 5px; text-decoration: none;">
        <?= $i ?>
      </a>
    <?php endfor; ?>
  <?php endif; ?>
</div>


<!--Delete function-->
<script>
function deleteEmployee(emp_id) {
  if (confirm("Are you sure you want to delete this employee?")) {
    fetch('delete_employee.php?id=' + emp_id)
      .then(res => res.text())
      .then(data => {
        if (data.trim() === 'success') {
          alert("Employee deleted.");
          loadPage('employees.php');
        } else {
          alert('Delete failed: ' + data);
        }
      })
	  .catch(error => {
	       alert('Error: ' + error);
	  });   
  }
}
</script>
