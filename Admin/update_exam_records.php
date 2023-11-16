<?php
//session_start();
include("connect.php"); // Include your database connection code

// Check if admin is logged in
if (!isset($_SESSION["admin_logged_in"]) || $_SESSION["admin_logged_in"] !== true) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $recordID = $_POST["record number"];
    $newExamDate = $_POST["new_exam_date"];
    // Add more fields as needed

    $updateSQL = "UPDATE exam record SET  new_exam_date = '$newExamDate' WHERE record number = $recordID";
    // Add more update queries as needed

    if ($conn->query($updateSQL) === TRUE) {
        $successMessage = "Exam record updated successfully!";
    } else {
        $errorMessage = "Error updating record: " . $conn->$error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin - Update Exam Records</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="admin-panel">
        <h2>Admin - Update Exam Records</h2>

        <?php if (isset($successMessage)) { echo "<p class='success'>$successMessage</p>"; } ?>
        <?php if (isset($errorMessage)) { echo "<p class='error'>$errorMessage</p>"; } ?>

        <form action="update_exam_records.php" method="POST">
            <label for="record_id">Record ID:</label>
            <input type="number" id="record_id" name="record_id" required><br>

            <label for="new_exam_date">New Exam Date:</label>
            <input type="date" id="new_exam_date" name="new_exam_date" required><br>
            
            <!-- Add more input fields as needed -->

            <input type="submit" value="Update">
        </form>
    </div>
</body>
</html>
