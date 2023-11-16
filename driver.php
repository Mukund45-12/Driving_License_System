<?php
session_start();
include('../connect.php');
$data=$_SESSION['data']; // Include the database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Driver_NID = $_POST['Driver NID'];
    $Name = $_POST['Name'];
    $Date_of_Birth = $_POST['Date of Birth'];
    $Phone_no = $_POST['Phone no'];
    $City = $_POST['City'];
    $Postal_Code = $_POST['Postal Code'];
    $License_no = $_POST['License no'];
    $exam_score = $_POST['Exam Score'];
    $exam_date = $_POST['Exam Date'];
    $exam_type = $_POST['Exam Type'];
    $Branch_ID = $_POST['Branch_ID'];
    
    // Insert the data into the driver table
    $insertQuery = "INSERT INTO `driver` (`Driver_NID`, `Name`, `Date of Birth`, `Phone_no`, `City`, `Postal_Code`, `License_no`, `exam_score`, `exam_date`, `exam_type`, `Branch_ID`) VALUES ('$Driver_NID', '$Name', '$Date of Birth', '$Phone_no', '$City', '$Postal_Code', '$License_no', '$exam_score', '$exam_date', '$exam_type', '$Branch_ID')";
    $stmt = mysqli_prepare($con, $insertQuery);
    mysqli_stmt_bind_param($stmt, "iss", $Driver_NID, $Name, $Date_of_Birth, $Phone_no, $City, $Postal_Code, $License_no, $exam_score, $exam_date, $exam_type, $Branch_ID);
    mysqli_stmt_execute($stmt);

    // Redirect back to the dashboard or appropriate page
    header('Location:../'); // Update this with the actual dashboard file
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Insert driver</title>
</head>
<body>
    <h1>Insert driver</h1>
    <form action="driver.php" method="post">
        <label for="Driver_NID">Driver NID:</label>
        <input type="number" name="Driver_NID" required><br>

        <label for="Name">Name:</label>
        <input type="text" name="Name" required><br>

        <label for="Date of Birth">Date of Birth:</label>
        <input type="date" name="Date of Birth" required><br>

        <label for="Phone_no">Phone no:</label>
        <input type="number" name="Phone_no" required><br>

        <label for="City">City:</label>
        <input type="text" name="City" required><br>

        <label for="Postal_Code">Postal Code:</label>
        <input type="number" name="Postal_Code" required><br>

        <label for="License_no">License no:</label>
        <input type="number" name="License_no" required><br>

        <label for="exam_score">Exam Score:</label>
        <input type="number" name="exam_score" required><br>

        <label for="exam_date">Exam Date:</label>
        <input type="date" name="exam_date" required><br>

        <label for="exam_type">Exam Type:</label>
        <input type="text" name="exam_type" required><br>

        <label for="Branch_ID">Branch_ID:</label>
        <input type="number" name="Branch_ID" required><br>


        <input type="submit" value="Insert">
    </form>
</body>
</html>
