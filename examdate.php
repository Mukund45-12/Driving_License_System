<!DOCTYPE html>
<html lang="en">
<?php 
$succ = False;
include("includes/connection.php");
session_start();
$output = "";
if (isset($_POST['submit'])) {
    $uname = $_SESSION['user'];
    $nid = mysqli_fetch_array(mysqli_query($connect, "SELECT NID from user WHERE Username = '$uname';"))[0];
    $date = $_POST['date'];
    $type = $_POST['license_type'];
    $sql = "UPDATE driver SET exam_date = '$date', exam_type = 'Written Exam' WHERE Driver_NID = '$nid';";
    $sql1 = "UPDATE license SET License_class = '$type' WHERE Driver_NID = '$nid';";
    if (mysqli_query($connect,$sql) && mysqli_query($connect,$sql1)) {
        header("Location: Dashboard.php");
    }
    else {
        $output = "<h3> <font color = red> An error occured </font></h3>";
    }
}
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Exam Date - Driving License Website</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('loginbg.jpg');
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
            padding: 70px;
            border-radius: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        }

        h1 {
            margin-bottom: 15px;
            color: #3333AA;
        }
        h2 {
            color: #111199;
        }

        .input-group {
            margin-bottom: 40px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #555;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: rgba(255, 255, 255, 0.2); /* Transparent background */
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

        .btn-login {
            border-color: #008CBA;
        }

        .btn-login:hover {
            background-color: rgba(0, 140, 186, 1);
            border-color: #008CBA;
            color: #fff;
        }
        .date-input-container {
            display: flex;
            margin: 20px;
        }

        .date-input {
            border: 2px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            font-size: 16px;
            outline: none;
            align-self: center;
        }

        /* Additional styles for the date input to make it visually appealing */
        .date-input:hover,
        .date-input:focus {
            border-color: #007BFF;
        }
        .custom-dropdown {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 2px solid #ddd;
            border-radius: 5px;
            outline: none;
            background-color: #fff; /* Background color when not focused */
        }

        .custom-dropdown:hover,
        .custom-dropdown:focus {
            border-color: #007BFF;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5); /* Box shadow on hover/focus */
        }
        a {
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="container">
    <h1> Select Exam Date and License Type </h1>
    <?php echo $output ?>
    <h2>Select Date:</h2>
        <form method="POST">
            <input type="date" id="date-selector" name = "date" class="date-input" min="<?php echo date('Y-m-d', strtotime('+1 month')); ?>" required>
        
        <h2>Select License Type:</h2>
            <select id="license_type-dropdown" class="custom-dropdown" name = "license_type" required>
                <option value="Driver License">Driver License</option>
                <option value="MotorCycle License">MotorCycle License</option>
                <option value="Heavy Trailer Endorsement">Heavy Trailer Endorsement</option>
                <option value="Commercial License">Commercial License</option>
                <!-- Add more options as needed -->
            </select>
        <br>
            <button type="submit" name = 'submit' class="btn btn-login"><font color = "#000066">Submit</font></button>
            <a href = "Dashboard.php" class="btn btn-login"><font color = "#000066">Go Back</font></a>
        </form>
    </div>
</body>

</html>
