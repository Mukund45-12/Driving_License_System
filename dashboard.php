<?php 
session_start();
include("includes/connection.php");
$uname = $_SESSION['user'];
// Retriving data from user table
$sql = "SELECT * from user WHERE username = '$uname' ";
$res = mysqli_query($connect,$sql);
$userData = mysqli_fetch_array($res);

$email = $userData[1];
$nid = $userData[3];
$type = $userData[4];

// Retriving data from Driver table
$sql = "SELECT * from driver  WHERE Driver_NID= '$nid' ";
$res = mysqli_query($connect,$sql);
$driverData = mysqli_fetch_array($res);

$fullname = $driverData[1];
$doB = $driverData[2];
$Phn_no = $driverData[3];
$city = $driverData[4];
$postal_code = $driverData[5];
$license = $driverData[6];
$exam_date = $driverData[8];

// Retriving data from License
$sql = "SELECT * from license  WHERE License_no = '$license' ";
$res = mysqli_query($connect,$sql);
$licenseData = mysqli_fetch_array($res);

$License_class = $licenseData[1];
$License_Expiry = $licenseData[2];

// for license status update
if ( $License_class == '') { 
    $License_status = "Not Applied Yet";}
else if ($License_class != '' && $License_Expiry <=2000_01_01) {
    $License_status = "Waiting for Exam";}
else if ($License_class != '' && $License_Expiry <=2000_01_01 &&  $exam_date < date('Y-m-d')) {
    $License_status = "Waiting for Approval";}
else if ($License_Expiry > date('Y-m-d')) {
    $License_status = "Active";}
else { $License_status = "Expired";}

if ($License_Expiry < date('2000-01-01 00:00:00')) {
    $License_Expiry = "Not available";
}
else if ($License_Expiry < date('Y-m-d')) {
    $License_Expiry = "Expired";
}
else {}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .header {
            background-color: #02004b8e;
            color: #fff;
            padding: 15px;
            text-align: right;
        }

        .dashboard {
            display: flex;
            justify-content: space-between;
            padding: 20px;
        }

        .info-panel {
            background-color: #f2f2f29b;
            border: 1px solid #dddddd9b;
            border-radius: 5px;
            padding: 20px;
            margin: 10px;
            flex: 1;
            text-align: left;
        }

        h2 {
            color: #000000;
        }

        p {
            color: #000000;
        }

        .logout-btn {
            background-color: #f44336;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 5px 10px;
            cursor: pointer;
        }

        .logout-btn:hover {
            background-color: #d32f2f;
        }
        .btn {
            padding: 15px 30px;
            font-size: 20px;
            border: 2px solid transparent;
            /* Set border to transparent */
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s, border-color 0.3s;
            margin: 10px;
            background-color: transparent;
            /* Set background color to transparent */
            color: #000;
            /* Button text color */
        }

        .btn-login {
            border-color: #008CBA;
            /* Set border color on normal state */
        }

        .btn-login:hover {
            background-color: rgba(0, 140, 186, 1);
            /* Semi-transparent color on hover */
            border-color: #008CBA;
            /* Set border color on hover */
            color: #fff;
            /* Text color on hover */
        }

        .btn-register {
            border-color: #f44336;
            /* Set border color on normal state */
        }

        .btn-register:hover {
            background-color: rgba(244, 67, 54, 1);
            /* Semi-transparent color on hover */
            border-color: #f44336;
            /* Set border color on hover */
            color: #fff;
            /* Text color on hover */
        }
        a {
            text-decoration: none;
        }
    </style>
</head>

<body background = 'loginbg.jpg'>
    <div class="header">
        
        <span>Welcome, <?php echo $fullname ?>   </span>
        <a href = 'logout.php' class="logout-btn"> Logout </a>
        
    </div>
    
    <h2 align = center> <font color = #fff>  Driving License System User Dashboard </font> </h2>
    <div class="dashboard">
        <div class="info-panel">
            <h2>User Information</h2>
            <p>Name: <?php echo $fullname ?></p>
            <p>Date of Birth: <?php echo $doB ?></p>
            <p>Phone: <?php echo  $Phn_no ?> </p>
            <p>City: <?php echo $city ?></p>
            <p>Email: <?php echo $email ?> </p>
            <p>Posta Code: <?php echo $postal_code ?></p>
            <p>NID: <?php echo $nid ?> </p>
            <p>User Type: <?php echo $type ?></p>
        </div>

        <div class="info-panel">
            <h2>License Information</h2>
            <p>License No: <?php echo $license ?> </p>
            <p>License Class: <?php echo $License_class ?> </p>
            <p>License Expiry: <?php echo $License_Expiry ?></p>
            <P>License Status: <?php echo $License_status ?> </P>

        </div>

        <div class="info-panel">
            <h2> Select Exam Date and Branch </h2>
            <a href="examdate.php" class="btn btn-login button2">Exam Date</a>
            <a href="BranchSelect.php" class="btn btn-register button3">Branch</a>
            <br>
            <br>
            <h2> Update email or password here:</h2>
            <a href="settings.php" class="btn btn-login button2">Settings</a>
        </div>
    </div>
</body>

</html>
