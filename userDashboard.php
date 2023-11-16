<?php 
session_start();
include("includes/connection.php");
$uname = $_SESSION['user'];

?> 

<h1> Welcome <?php echo $uname ?> ! </h1>

<a href = 'logout.php'> Logout </a>