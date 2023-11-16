<?php error_reporting(0);
$server = "localhost";
$username = "root";
$password = "";
$database = "driving license";

$conn = mysqli_connect($server, $username, $password, $database);
if (!$conn){
    die("Error". mysqli_connect_error());
}

?>