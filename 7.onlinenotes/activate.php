<?php
session_start();
include('connection.php');

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Activation </title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
      <style>
          h1{
              color:blueviolet;
          } 
          .contact{
              margin-top: 50px;
              border: 1px solid #6706cf;
              border-radius:15px;
          }
      </style>
  </head>
  <body>
<div class="container-fluid">
   <div class="row">
       <div class="col-sm-offset-1 col-sm-10 contact">
       <h1>Account activation:</h1>
           
        <?php
           if(!isset($_GET["email"])|| !isset($_GET["key"])){
    echo '<div class="alert alert-danger">Please click on activation link you recieved by email!</div>';
    exit;
}
$email = $_GET["email"];
$key = $_GET["key"];
$email = mysqli_real_escape_string($link,$email);
$key = mysqli_real_escape_string($link,$key);
$sql = "UPDATE users SET activation = 'activated' WHERE (email = '$email' AND activation = '$key') LIMIT 1";
           $result = mysqli_query($link,$sql);
if(mysqli_affected_rows($link) == 1){
    echo '<div class="alert alert-success">Your account has been activated.</div>';
    echo '<a type="button" href="index.php" class="btn-lg btn-success">Log in</a>';
}else{
    echo'<div class="alert alert-danger">Your account could not be activated.</div>';
//    echo '<div class="alert alert-danger">' . mysqli_error($link) . '</div>';
 
}
           ?>
       
       </div>
    
    </div>     
        
</div>
      
      
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
      <script>
      
      </script>
  </body>
</html>