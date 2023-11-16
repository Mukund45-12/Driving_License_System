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
    <title>Login - Driving License Website</title>
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
    <h1> Select Branch </h1>
        <form method="POST">
            <select id="license_type-dropdown" name = branch class="custom-dropdown">
                <option value="1111">BRTA Mohakhali Branch</option>
                <option value="2222">BRTA Mirpur Pallabi Branch</option>
                <option value="3333">BRTA Mohammadpur Branch</option>
                <option value="4444">BRTA Khulna Branch</option>
                <option value="5555">BRTA Chattogram Branch</option>
                <!-- Add more options as needed -->
            </select>
            <button type="submit" name = submit class="btn btn-login"><font color = "#000066">Submit</font></button>
            <a href = "Dashboard.php" class="btn btn-login"><font color = "#000066">Go Back</font></a>
                </script>
        </form>
    </div>
</body>

</html>
