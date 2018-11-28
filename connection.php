<?php
$link = mysqli_connect("localhost","root","","courier");
if(mysqli_connect_error()){
    die("Error:Unable to connect:".mysqli_connect_error());
}
?>