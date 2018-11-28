<?php
session_start();
include('connection.php');
$missingEmail = '<p><b>Please Enter your Email.</b></p>';
$missingPassword = '<p><b>Please Enter your Password.</b></p>';
if(empty($_POST["loginemail"])){
    $errors .= $missingEmail;
}else{
    $email = filter_var($_POST["loginemail"],FILTER_SANITIZE_EMAIL);
    
}
if(empty($_POST["loginpassword"])){
    $errors .= $missingPassword;
}else{
    $password = filter_var($_POST["loginpassword"],FILTER_SANITIZE_STRING);
}
if($errors){
    $resultMessage = '<div class="alert alert-danger">'.$errors.'</div>';
    echo $resultMessage;
}else{
    
$email = mysqli_real_escape_string($link,$email);
$password = mysqli_real_escape_string($link,$password);
//$password = md5($password);
$password = hash('sha256',$password);
    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'AND activation = 'activated'";
    $result = mysqli_query($link,$sql);
    if(!$result){
        echo '<div class="alert alert-danger">Error running query!</div>';
    exit;
    }
    $count = mysqli_num_rows($result);
    if($count !==1){
        echo '<div class="alert alert-danger"><p><b>Invalid username or password</b></p></div>';
        echo $count;
    }else{
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['username']=$row['username'];
    $_SESSION['email']=$row['email'];

        if(empty($_POST["rememberme"])){
            echo "success";
        }else{
            $authentificator1 = bin2hex(openssl_random_pseudo_bytes(10));
            $authentificator2 = openssl_random_pseudo_bytes(20);
            function f1($a,$b){
                $c = $a ."," . bin2hex($b);
                return $c;
            }
            $cookieValue = f1($authentificator1,$authentificator2);
            setcookie(
                "rememberme",
                $cookieValue,
                time()+ 15*24*60*60
            );
            
            function f2($a){
                $b = hash('sha256',$a);
                return $b;
            }
            $f2authentificator2 = f2($authentificator1);
            $user_id = $_SESSION['user_id'];
            $expiration = date('Y-m-d H:i:s',time() + 15*24*60*60);
            $sql = "INSERT INTO rememberme2(`authentificator1`,`f2authentificator2`,`user_id`,`expires`)VALUES ('$authentificator1','$f2authentificator2','$user_id','$expiration')";
            $result = mysqli_query($link,$sql);
            if(!$result){
                echo '<div class="alert alert-danger">Problem loading data into rememberme table.</div>';
            }else{
                echo "success";
            }
            
        }
    }
}
?>