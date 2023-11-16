<?php 
$succ = False;
include("includes/connection.php");

$output = "";

if (isset($_POST['update'])) {
	$License_no = $_POST['License_no'];
    $score = $_POST['result'];
	$duration = $_POST['duration'];
    $date = date("Y-m-d");
    if ($duration == 5){
        $newDate = date('Y-m-d', strtotime($date. ' + 5 years'));
    } else {
        $newDate = date('Y-m-d', strtotime($date. ' + 10 years'));
    }
    if ($score > 90){
        $result = 'Passed with distinction';
    } else if ($score > 70) {
        $result = 'Passed';
    }
    else {
        $result = "Failed";
    }
	
    $sql = "Select * from license where License_no = '$License_no';";
    $res = mysqli_query($connect, $sql);
    if (mysqli_num_rows($res) == 1) {
        $license_data = mysqli_fetch_array($res);
        $nid = $license_data[3];
        $sql = "UPDATE driver SET exam_score = '$score', exam_date = '$date' WHERE Driver_NID = '$nid';";
        $record_no = mysqli_fetch_array(mysqli_query($connect, 'Select Count(*) from exam_record;'))[0] + 101;
        $name = mysqli_fetch_array(mysqli_query($connect, "Select Name from driver where Driver_NID = '$nid';"))[0];
        $branch_id =  mysqli_fetch_array(mysqli_query($connect, "Select Branch_ID from driver where Driver_NID = '$nid';"))[0];
        $sql2 = "INSERT into exam_record VALUES ('$record_no','$name','$date','$result');";
        $sql3 = "INSERT keep VALUES ('$nid','$record_no','$branch_id');";
        $sql4 = "UPDATE license SET License_expiry = '$newDate' WHERE License_no = '$License_no';";
        if (mysqli_query($connect, $sql) && mysqli_query($connect,$sql2) && mysqli_query($connect,$sql3) && mysqli_query($connect,$sql4)){
            $succ = True;
        }
        else{
            echo "Error:" . mysqli_error($connect);
            $output = "<h3> <font color = red> An error occured </font></h3>";
        }
    }
    else {
        $output = "<h3> <font color = red> License number does not exist. Please try again. </font></h3>";
    }

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Marks</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            text-align: center;
            background-color: rgba(255, 255, 255, 0.7);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        }

        h1 {
            margin-bottom: 20px;
            color: #3333AA;
        }

        .input-group {
            margin-bottom: 20px;
            padding-right: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        input[type="text"],
        input[type="email"],
        input[type="number"],
        input[type="date"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: rgba(255, 255, 255, 0.2);
            color: #000;
        }

        .btn {
            padding: 15px 30px;
            font-size: 20px;
            border: 2px solid transparent;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s, border-color 0.3s;
            margin: 10px;
            background-color: transparent;
            color: #000;
        }

        .btn-register {
            border-color: #008CBA;
        }

        .btn-register:hover {
            background-color: rgba(0, 140, 186, 1);
            border-color: #008CBA;
            color: #fff;
        }
        a {
            text-decoration: none;
        }
        .custom-dropdown {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 2px solid #ddd;
            border-radius: 5px;
            outline: none;
            background-color: #fff; 
        }

        .custom-dropdown:hover,
        .custom-dropdown:focus {
            border-color: #007BFF;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5); /* Box shadow on hover/focus */
        }
    </style>
</head>

<body background = 'agentbg.jpg'>
    <div class="container">
        <h1>Register for Driving License System</h1>
        <?php 
            if ($succ) {
                echo "<h3 
                    <span> <p style='color: green;'class=text-center my-3;'> Update SUCCESSFUL!</p>
                </h3>";
            }
        ?>
            <!-- <h3 class="text-center my-3">Register</h3> -->

            <div class="text-center"><?php echo $output; ?>

        <form method="POST">
            <div class="input-group">
                <label for="License_no"><font color="#111166"><b>License No:</b></font></label>
                <input type="text" id="License_no" name="License_no" required>
            </div>
            <div class="input-group">
                <label for="result"><font color="#111166"><b>Marks (Out of 100):</b></font></label>
                <input type="text" id="result" name="result" required>
            </div>
            <button type="submit" name = "update" class="btn btn-register"><font color="#000066">Update Marks</font></button>
            <a href = 'agentDashboard.php' class="btn btn-register">Go Back</a>
            </div>
            <label for="result"><font color="#111166"><b>Duration (Default 5 Years)</b></font></label>
                <select id="license_type-dropdown" name = 'duration' class="custom-dropdown">
                    <option value= 5 > 5 years </option>
                    <option value= 10 > 10 years </option>
                </select>
            </div>
            

        </form>
    </div>
</body>

</html>
