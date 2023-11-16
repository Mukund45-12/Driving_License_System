<?php
session_start();
include("connect.php");

// Replace these values with your actual admin credentials
$validAdminName = "Mukund";
$validAdminPassword = "muku22%";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $password = $_POST["password"];

    if ($name == $validAdminName && $password == $validAdminPassword) {
        $_SESSION["admin_logged_in"] = true;
        header("Location: admin_dashboard.php"); // Redirect to admin dashboard
        exit();
    } else {
        $error = "Invalid credentials";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="login-container">
        <h2>Admin Login</h2>
        <form action="login.php" method="POST">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br>

            <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>

            <input type="submit" value="Login">
        </form>
    </div>
</body>
</html>
