<?php 
$succ = False;
include("includes/connection.php");

$output = "";

if (isset($_POST['register'])) {
	$nid = $_POST['nid'];
	$uname = $_POST['username'];
    $name = $_POST['name'];
	$email = $_POST['email'];
    $dob = $_POST['dob'];
    $phone = $_POST['phone'];
    $city = $_POST['city'];
    $postal_code = $_POST['postal_code'];
	$pass = $_POST['password'];
	$c_pass = $_POST['confirm_password'];
	
	$error = array();

	if (empty($nid)) {
		$error['error'] = "NID is Empty";
	}if(empty($uname)){
		$error['error'] = "username is empty";
	}if(empty($pass)){
		$error['error'] = "Enter Password";
	}if(empty($c_pass)){
		$error['error'] = "Confirm Password";
	}if($pass != $c_pass){
		$error['error'] = "Both password do not match";
	}



	if (isset($error['error'])) {
		$output .= $error['error'];
	}else{
		$output .= "";
	}

	if (count($error) < 1) {
		
		
		$license_no = rand(0,1000000000);
        
		$query1 =  "INSERT INTO user(Username,Email,Password,NID,Type) VALUES('$uname', '$email','$pass','$nid','Driver');";
		$query2 = "INSERT INTO `driver` (`Driver_NID`, `Name`, `Date of Birth`, `Phone_no`, `City`, `Postal_Code`, `License_no`, `exam_score`, `exam_date`, `exam_type`, `Branch_ID`) VALUES ('$nid', '$name', '$dob', '$phone', '$city', $postal_code, $license_no, -1, '1970-01-01', '', 0);";
        $query3 = "INSERT INTO `license` (`License_no`, `License_class`, `License_expiry`, `Driver_NID`, `Branch_ID`) VALUES ($license_no, '', '1970-01-01', $nid, 0);";
		if (mysqli_query($connect, $query1) && mysqli_query($connect, $query2) && mysqli_query($connect, $query3)) {
			// echo "New record created successfully";
			$succ = True;
            header("Location: login.php");
		  } else {
			echo "Error: " . $query1 . "<br>" . mysqli_error($connect);
		  }
	}
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration - Driving License Website</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('registerbg.jpg');
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
    </style>
</head>

<body>
    <div class="container">
        <h1>Register for Driving License System</h1>
        <?php 
            if ($succ) {
                echo "<h3 
                    <span> <p style='color: green;'class=text-center my-3;'> REGISTRATION SUCCESSFUL!</p>
                </h3>";
            }
        ?>
            <!-- <h3 class="text-center my-3">Register</h3> -->

            <div class="text-center"><?php echo $output; ?>

        <form method="POST">
            <div class="input-group">
                <label for="username"><font color="#111166"><b>Username:</b></font></label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="input-group">
                <label for="fullname"><font color="#111166"><b>Full Name:</b></font></label>
                <input type="text" id="fullname" name="name" required>
            </div>
            <div class="input-group">
                <label for="email"><font color="#111166"><b>Email:</b></font></label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="input-group">
                <label for="nid"><font color="#111166"><b>NID No:</b></font></label>
                <input type="number" id="nid" name="nid" required>
            </div>
            <div class="input-group">
                <label for="dob"><font color="#111166"><b>Date of Birth:</b></font></label>
                <input type="date" id="dob" name="dob" required>
            </div>
            <div class="input-group">
                <label for="phone"><font color="#111166"><b>Phone:</b></font></label>
                <input type="number" id="phone" name="phone" required>
            </div>
            <div class="input-group">
                <label for="city"><font color="#111166"><b>City:</b></font></label>
                <input type="text" id="city" name="city" required>
            </div>
            <div class="input-group">
                <label for="postal_code"><font color="#111166"><b>Postal Code:</b></font></label>
                <input type="text" id="postal_code" name="postal_code" required>
            </div>
            <div class="input-group">
                <label for="password"><font color="#111166"><b>Password:</b></font></label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="input-group">
                <label for="confirm_password"><font color="#111166"><b>Confirm Password:</b></font></label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
            <button type="submit" name = "register" class="btn btn-register"><font color="#000066">Register</font></button>
            <a href = 'index.html' class="btn btn-register">Go Back</a>

        </form>
    </div>
</body>

</html>
