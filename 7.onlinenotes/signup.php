<?php
//echo "success";
session_start();
include('connection.php');
$missingUsername = '<p><b>Please Enter your Username.</b></p>';
$missingEmail = '<p><b>Please Enter your Email.</b></p>';
$missingPassword = '<p><b>Please Enter your Password.</b></p>';
$invalidEmail = '<p><b>Please Enter a valid Email address.</b></p>';
$invalidPassword = '<p><b>Your Password must contain 6 characters,a capital letter and a number.</b></p>';
$missingPassword2 = '<p><b>Please Confirm your Password.</b></p>';
$differentPassword = '<p><b>Passwords mismatch.</b></p>';

if(empty($_POST["username"])){
    $errors .= $missingUsername;
}else{
    $username = filter_var($_POST["username"],FILTER_SANITIZE_STRING);
}
if(empty($_POST["email"])){
    $errors .= $missingEmail;
}else{
    $email = filter_var($_POST["email"],FILTER_SANITIZE_EMAIL);
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $errors .= $invalidEmail; 
    }
}
if(empty($_POST["password"])){
    $errors .= $missingPassword;
}elseif(!(strlen($_POST["password"])>6 and preg_match('/[A-Z]/',$_POST["password"]) and preg_match('/[0-9]/',$_POST["password"]))){
        $errors .= $invalidPassword;
    }else{
    $password = filter_var($_POST["password"],FILTER_SANITIZE_STRING);
    if(empty($_POST["password2"])){
        $errors .= $missingPassword2;
    }else{
        $password2 = filter_var($_POST["password2"],FILTER_SANITIZE_STRING);
        if($password !== $password2){
            $errors .= $differentPassword;
        }
    }
         }
if($errors){
    $resultMessage = '<div class="alert alert-danger">'.$errors.'</div>';
    echo $resultMessage;
    exit;
}

$username = mysqli_real_escape_string($link,$username);
$email = mysqli_real_escape_string($link,$email);
$password = mysqli_real_escape_string($link,$password);
//$password = md5($password);
$password = hash('sha256',$password);

$sql = "SELECT * FROM users WHERE username= '$username'";
$result = mysqli_query($link,$sql);
if(!$result){
    echo '<div class="alert alert-danger">Error running query!</div>';
    exit;
}
$results = mysqli_num_rows($result);
if($results){
    echo '<div class="alert alert-danger">Username already taken!</div>';
    exit;
}

$sql = "SELECT * FROM users WHERE email= '$email'";
$result = mysqli_query($link,$sql);
if(!$result){
    echo '<div class="alert alert-danger">Error running query!</div>';
    exit;
}
$results = mysqli_num_rows($result);
if($results){
    echo '<div class="alert alert-danger">Email already taken!</div>';
    exit;
}

$activationkey = bin2hex(openssl_random_pseudo_bytes(16));
//16*8bits=128/4=32
//$sql = "INSERT INTO users('username','email','password','activation') VALUES ('$username','$email','$password','$activationkey')";
$sql = "INSERT INTO users (`username`, `email`, `password`, `activation`) VALUES ('$username', '$email', '$password', '$activationkey')";

$result = mysqli_query($link,$sql);
if(!$result){
    echo '<div class="alert alert-danger">Error inserting user details into database!'.mysqli_error($link).'</div>';
    exit;
}
$message = "Click on link to activate account:\n\n";
$message .= "http://cwdcourse1.thecompletewebhosting.com/onlinenotes/activate.php?email=".urlencode($email)."&key=$activationkey";
if(mail($email,'Confirm your account',$message,'From:'.'rakeshdhfm1@gmail.com')){
    echo '<div class="alert alert-success">Thanks for registering! An email has sent to '.$email.'.Click on it for activation.</div>';
}


?>