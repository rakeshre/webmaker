<?php
session_start();
if(!array_key_exists('user_id',$_SESSION) && !empty($_COOKIE['rememberme'])){
    list($authentificator1,$a2) = explode(',',$_COOKIE['rememberme']);
    $authentificator2 = hex2bin($a2);
    $f2authentificator2 = hash('sha256',$authentificator2);
    $sql = "SELECT * FROM rememberme2 where authentificator1 = '$authentificator1'";
    $result = mysqli_query($link,$sql);
    if(!$result){
        echo '<div class="alert alert-danger">Error running query.</div>';
        exit;
    }
     $count = mysqli_num_rows($result);
    if($count !== 1){
        echo '<div class="alert alert-danger">Remember me process failed!</div>';
        exit;
    }

    
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    if(!hash_equals($row['f2authentificator2'],$f2authentificator2)){
        echo '<div class="alert alert-danger">hash_equals return false.</div>';
    }
    else{
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
                exit;
            }
        $_SESSION['user_id'] = $row['user_id'];
        header("location:mainpage.php");
        
    }
}
//else{
//    echo '<div class="alert alert-danger" style="margin-top:50px">'.$_SESSION['user_id'].'</div>';
//}
?>