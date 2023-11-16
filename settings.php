<?php 
session_start();
include("includes/connection.php");
$output = "";



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
            padding: 100px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        }

        h1 {
            margin-bottom: 30px;
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
        <h1>Settings</h1>
        <br>
        <br>
            <a href = "changeEmail.php" class="btn btn-login"><font color = "#000066">Change Email</font></a>
            <br>
            <br>
            <br>
            <br>
            <a href = "changePassword.php" class="btn btn-login"><font color = "#000066">Change Password</font></a>
            <br>
            <br>
            <br>
            <br>
            <a href = "Delete.php" class="btn btn-delete"><font color = "#000066">Delete this account</font></a>
            <br>
            <br>
            <br>
            <br>
            <a href = "Dashboard.php" class="btn btn-login"><font color = "#000066">Go Back</font></a>
        <br>
        <br>
    </div>
</body>

</html>
