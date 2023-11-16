<?php
session_start();
//include("read_exam_records.php"); 
//include("update_exam_records.php");

if (!isset($_SESSION["admin_logged_in"]) || $_SESSION["admin_logged_in"] !== true) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <!-- Add any dashboard-specific styles or scripts here -->
</head>
<body class="bg-secondary text-light" background="admin.jpg">
    <h1>Welcome  Admin </h1>
    <p>You are logged in as an admin.</p>


    <a href="logout.php">Logout</a> 
</body>
</html>
