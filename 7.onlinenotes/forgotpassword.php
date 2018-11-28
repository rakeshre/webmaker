<?php
session_start();
include('connection.php');
$missingEmail = '<p><b>Please Enter your Email.</b></p>';
$invalidEmail = '<p><b>Please Enter a valid Email address.</b></p>';
if(empty($_POST["forgotemail"])){
    $errors .= $missingEmail;
}else{
    $email = filter_var($_POST["forgotemail"],FILTER_SANITIZE_EMAIL);
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $errors .= $invalidEmail; 
    }
}
if($errors){
    $resultMessage = '<div class="alert alert-danger">'.$errors.'</div>';
    echo $resultMessage;
    exit;
}
$email = mysqli_real_escape_string($link,$email);
$sql = "SELECT*FROM users WHERE email= '$email'";
$result = mysqli_query($link,$sql);
if(!$result){
    echo '<div class="alert alert-danger">Error running query!</div>';
    echo '<div class="alert alert-danger">'.mysqli_error($link).'</div>';
    exit;
}
$count = mysqli_num_rows($result);
if(!$count){
    echo '<div class="alert alert-danger">Email does not exist!</div>';
    exit;
}

$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
$user_id = $row['user_id'];
$key = bin2hex(openssl_random_pseudo_bytes(16));
$time = time();
$status = "pending";
$sql = "INSERT INTO forgotpassword(`user_id`,`rkey`,`time`,`status`) VALUES ('$user_id','$key','$time','$status')";
$result = mysqli_query($link,$sql);
if(!$result){
     echo '<div class="alert alert-danger">Error inserting user details into database!'.mysqli_error($link).'</div>';
    exit;
}
$message = "Click on link to reset password:\n\n";
$message .= "http://cwdcourse1.thecompletewebhosting.com/onlinenotes/resetpassword.php?user_id=$user_id&key=$key";
if(mail($email,'Reset your password',$message,'From:'.'rakeshdhfm1@gmail.com')){
    echo '<div class="alert alert-success"> An email has sent to '.$email.'.Click on it to reset your password.</div>';
}

?>