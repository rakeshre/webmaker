<?php
session_start();
include('connection.php');
$id = $_POST['id'];
$note = $_POST['note'];
$note = mysqli_real_escape_string($link,$note);
$note = filter_var($note,FILTER_SANITIZE_STRING);
$time = time();
$sql = "UPDATE notes SET note='$note',time = '$time' WHERE id='$id'";
$result = mysqli_query($link,$sql);
if(!$result){
    echo "error";
}
?>