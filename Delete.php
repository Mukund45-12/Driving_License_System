<?php 
session_start();
include("includes/connection.php");
$output = "";
if (isset($_POST['submit'])) {
  	$uname = $_SESSION['user'];
    $cpass = $_POST['pass'];
    $email = $_POST['email'];
    $nid = $_POST['nid'];


    $query = "SELECT * FROM user WHERE Username ='$uname' AND Password='$cpass' AND Email ='$email' AND NID = '$nid';";
    $res = mysqli_query($connect,$query);
    if (mysqli_num_rows($res) == 1) {
        $r_no = mysqli_fetch_array(mysqli_query($connect, "SELECT Record_no from keep WHERE Driver_NID = '$nid';"))[0];
        $sql1 = "DELETE FROM exam_record WHERE RECORD_no = '$r_no';";
        $sql2 = "DELETE FROM keep WHERE Driver_NID = '$nid' and Record_no = '$r_no';";
        $sql3 = "DELETE FROM driver WHERE Driver_NID = '$nid';";
        $sql4 = "DELETE FROM license WHERE Driver_NID = '$nid'";
        $sql5 = "DELETE FROM user WHERE NID = '$nid'";
        if (mysqli_query($connect,$sql1) && mysqli_query($connect,$sql2) && mysqli_query($connect,$sql3) && mysqli_query($connect,$sql4) && mysqli_query($connect,$sql5)) {
            header("Location: Logout.php");
        }
        else {
            $output = "<h2> <font color = red> An error occured </font></h2>";
        }

    }else{
        $output = "<h2> <font color = red> Wrong Credential. Try again </font></h2>";
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete- Driving License Website</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('Delete.jpg');
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
        .btn-delete {
            border-color: #FF0000;
        }

        .btn-delete:hover {
            background-color: rgba(255, 0, 0, 1);
            border-color: #FF0000;
            color: #fff;
        }
        a {
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2> <font color = red>Are you sure? All of your information will be removed</font></h2>
        <?php echo $output ?>
        <form method="POST">
            <div class="input-group">
                <label for="username"><font color = "#111166"><b>Enter your current password:</b></font></label>
                <input type="password" id="username" name="pass" required>
            </div>
            <div class="input-group">
                <label for="username"><font color = "#111166"><b>Enter your email:</b></font></label>
                <input type="text" id="username" name="email" required>
            </div>
            <div class="input-group">
                <label for="username"><font color = "#111166"><b>Enter your NID:</b></font></label>
                <input type="text" id="username" name="nid" required>
    </div>
            <button type="submit" name = submit class="btn btn-delete"><font color = "#000066">Delete my ID</font></button>
            <a href = "Dashboard.php" class="btn btn-login"><font color = "#000066">No, I changed my mind</font></a>
        </form>
    </div>
</body>

</html>
