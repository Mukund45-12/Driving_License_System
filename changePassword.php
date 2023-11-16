<?php 
session_start();
include("includes/connection.php");
$output = "";
if (isset($_POST['submit'])) {
  	$uname = $_SESSION['user'];
    $cpass = $_POST['pass'];
    $npass1 = $_POST['new_pass1'];
    $npass2 = $_POST['new_pass2'];


    $query = "SELECT * FROM user WHERE Username ='$uname' AND Password='$cpass'";
    $res = mysqli_query($connect,$query);
    if ($npass1 != $npass2) {
        $output = "<h2> <font color = red> Unmatched password. Check your new passwords </font></h2>";
    }else if (mysqli_num_rows($res) == 1) {
        $sql = "UPDATE user SET Password = $npass1 WHERE Username = '$uname';";
        if (mysqli_query($connect,$sql)) {
            header("Location: Logout.php");
        }
        else {
            $output = "<h2> <font color = red> An error occured </font></h2>";
        }

    }else{
        $output = "<h2> <font color = red> Wrong Password. Try again </font></h2>";
    }
}


?>

<!DOCTYPE html>
<html lang="en">

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
        a {
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Change Password</h1>
        <?php echo $output ?>
        <form method="POST">
            <div class="input-group">
                <label for="username"><font color = "#111166"><b>Enter your current password:</b></font></label>
                <input type="password" id="username" name="pass" required>
            </div>
            <div class="input-group">
                <label for="username"><font color = "#111166"><b>Enter your new password:</b></font></label>
                <input type="password" id="username" name="new_pass1" required>
            </div>
            <div class="input-group">
                <label for="username"><font color = "#111166"><b>Enter your new password again:</b></font></label>
                <input type="password" id="username" name="new_pass2" required>
    </div>
            <button type="submit" name = submit class="btn btn-login"><font color = "#000066">Update Password</font></button>
            <a href = "Dashboard.php" class="btn btn-login"><font color = "#000066">Go Back</font></a>
        </form>
    </div>
</body>

</html>
