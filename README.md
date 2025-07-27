 #attendance-tracker
✅ A secure web-based Employee Attendance Tracking System using PHP, MySQL, and JavaScript
# 🧑‍💼 Employee Attendance Tracking System

This is a web-based Employee Attendance Tracking System developed using PHP, MySQL, HTML, CSS, JavaScript, and Chart.js. It enables an admin to manage employees, track attendance, and generate monthly reports. Employees can log in to view their own attendance status.

---

## 🚀 Features

### 👨‍💼 Admin
- Secure admin login
- Add/edit/delete employee records
- Mark employee attendance (Present/Absent)
- View employee details and photo
- View daily and monthly attendance records
- View attendance summary chart using Chart.js
- Send monthly attendance reports via email

### 👨‍🔧 Employee
- Secure employee login
- View personal attendance record

---

## 🛠️ Technologies Used

- **Frontend**: HTML, CSS, JavaScript
- **Backend**: PHP (Procedural)
- **Database**: MySQL
- **Charting**: Chart.js
- **Emailing**: PHP `mail()` or PHPMailer

---

## 📁 Project Structure

employee-attendance/
├── index.php # Admin login
├── dashboard.php # Admin dashboard
├── employee_home.php # Employee dashboard
├── db.php # Database connection
├── add_employee.php
├── edit_employee.php
├── delete_employee.php
├── mark_attendance.php
├── view_attendance.php
├── monthly_chart.php
├── send_email.php
├── logout.php
├── /css # Stylesheets
├── /js # JavaScript files
└── /database
└── attendance_system.sql # SQL export of database

## 🧪 Setup Instructions

### 1. Clone the Repository

```bash
git clone https://github.com/your-github-username/employee-attendance.git
cd employee-attendance
Replace [your-github-username] with your actual GitHub username. 

2. Import the Database
Open phpMyAdmin

Create a new database (e.g., attendance_system)

Go to the Import tab

Select the file: database/attendance_system.sql

Click Go

3. Configure Database Connection
Open db.php and update with your MySQL credentials:

php
Copy code
$conn = new mysqli("localhost", "root", "", "attendance_system");
4. Run the Project
Start your local server (XAMPP/WAMP)

Go to http://localhost/employee-attendance/index.php

🔐 Default Login Credentials
Role	Username	Password
Admin 	hema	     12345
Admin 	Kishore 	 67890

👩‍💻 Developer
Name: R. Hemadharshini
Email: darshinihema2102@gmail.com
College: Dhanalakshmi Srinivasan Engineering College (MCA)

📜 License
This project is for academic and learning purposes. Free to use with attribution. Contributions are welcome.

🌟 Show Your Support
If you like this project, consider ⭐ starring the repo and sharing it with others!


---

### 📦 How to Generate `attendance_system.sql`

1. Open **phpMyAdmin**
2. Select your **attendance system database**
3. Click the **Export** tab
4. Choose:
   - Export method: `Quick`
   - Format: `SQL`
5. Click **Go** – it will download a file named like `attendance_system.sql`
6. Place this file in:





