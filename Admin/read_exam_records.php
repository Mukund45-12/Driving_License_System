<?php
//session_start();
include("connect.php"); // Include your database connection code

// Check if admin is logged in
if (!isset($_SESSION["admin_logged_in"]) || $_SESSION["admin_logged_in"] !== true) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit();
}

// Fetch exam records from the database
$sql = "SELECT * FROM exam record";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin - Read Exam Records</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="admin-panel">
        <h2>Admin - Read Exam Records</h2>

        <table>
            <tr>
                <th>Record Number</th>
                <th>Number of Examinee</th>
                <th> Date</th>
                <th> Students Passed</th>
                
            </tr>
            <?php
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["record_number"] . "</td>";
                echo "<td>" . $row["nunm_of_examinee"] . "</td>";
                echo "<td>" . $row["Date"] . "</td>";
                echo "<td>" . $row["Students Passed"] . "</td>";
                
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>
