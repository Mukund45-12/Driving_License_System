<?php 
session_start();
include("includes/connection.php");
$output = "";
if (isset($_POST['login'])) {
  	   
    $uname = $_POST['username'];
    $pass = $_POST['password'];

    if (empty($uname)) {
        $output = "Please enter your username";
    }else if(empty($pass)){
        $output = "Please enter your password";
    }else{

    $query = "SELECT * FROM user WHERE Username ='$uname' AND Password='$pass'";
    $res = mysqli_query($connect,$query);

    if (mysqli_num_rows($res) == 1) {
        $data = mysqli_fetch_array($res);
        $type = $data[4];
        if ($type == 'Driver') {
            $_SESSION['user'] = $uname;
            header("Location: Dashboard.php");
            
        } else if ($type == 'Agent'){
            $_SESSION['user'] = $uname;
            header("Location: agentDashboard.php");
        } else {
            $output = "Admin will be avaiable soon";
        }
    }else{
        $output .= "Failed to login";
    }

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
        <h1>Login to Driving License System</h1>
        <?php echo '<h2> <font color = "red">' . $output . '</h2>' ?>
        
        <form method="POST">
            <div class="input-group">
                <label for="username"><font color = "#111166"><b>Username:</b></font></label>
                <input type="text" id="username" name="username">
            </div>
            <div class="input-group">
                <label for="password"><font color = "#111166"><b>Password</b></font>:</label>
                <input type="password" id="password" name="password">
            </div>
            <button type="submit" name = login class="btn btn-login"><font color = "#000066">Login</font></button>
            <a href = 'index.html' class="btn btn-login">Go Back</a>
                
        </form>
    </div>
</body>

</html>
