<?php

$connect = mysqli_connect("localhost","root","","driving_license");
if(!$connect){
    die(mysqli_error($con));
}
?>