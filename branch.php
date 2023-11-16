<?php 
$succ = False;
include("includes/connection.php");
$output = "";

if (isset($_POST['submit'])) {
    $license_no = $_POST['license_no'];
    $license_class = $_POST['license_class'];
    $license_expiry = $_POST['license_expiry'];
    $driver_nid = $_POST['driver_nid'];
    $branch_id = $_POST['branch_id'];

    $error = array();
    if (empty($license_no)) {
        $error['error'] = "License No is empty";
    }
    if (empty($license_class)) {
        $error['error'] = "License Class is empty";
    }
    if (empty($license_expiry)) {
        $error['error'] = "License Expiry is empty";
    }
    if (empty($driver_nid)) {
        $error['error'] = "Driver nid is empty";
    }
    if (empty($branch_id)) {
        $error['error'] = "Branch ID is empty";
    }
    if (isset($error['error'])) {
		$output .= $error['error'];
	}else{
		$output .= "";
	}
    if (count($error) < 1) {
        $sql = "INSERT INTO `license` (`License_no`, `License_class`, `License_expiry`, `Driver_NID`, `Branch_ID`) VALUES ('$license_no', '$license_class', '$license_expiry', '$driver_nid', '$branch_id')";
        if (mysqli_query($connect, $sql)) {
            $succ = True;
        }
        else {
            $output = "AN ERROR OCCURED. Please try again";
        }
    }

}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>License Application - Driving License Website</title>
    <style>
        /* Existing styles here... */

        /* Additional styles for the new form elements */
        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        input[type="text"] {
            /* Customize styles as needed */
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>License Application</h1>
        <?php 
            if ($succ) {
                echo "<h2> <font color = 'green'> SUBMISSION SUCCESSFUL </font> </h2>";
            } 
            else {
                echo "<h2> <font color = 'red'>$output</font> </h2>";
            }
        ?>
        <form method="POST">
            <div class="form-group">
                <label for="license_no"><font color="#111166"><b>License Number:</b></font></label>
                <input type="text" id="license_no" name="license_no">
            </div>
            <div class="form-group">
                <label for="license_class"><font color="#111166"><b>License Class:</b></font></label>
                <input type="text" id="license_class" name="license_class">
            </div>
            <div class="form-group">
                <label for="license_expiry"><font color="#111166"><b>License Expiry:</b></font></label>
                <input type="text" id="license_expiry" name="license_expiry">
            </div>
            <div class="form-group">
                <label for="driver_nid"><font color="#111166"><b>Driver NID:</b></font></label>
                <input type="text" id="driver_nid" name="driver_nid">
            </div>
            <div class="form-group">
                <label for="branch_id"><font color="#111166"><b>Branch ID:</b></font></label>
                <input type="text" id="branch_id" name="branch_id">
            </div>
            <button type="submit" name="submit" class="btn btn-login"><font color="#000066">Submit</font></button>
            <button type="button" class="btn btn-login" onclick="goBack()"><font color="#000066">Go Back</font></button>
        </form>
    </div>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</body>

</html>