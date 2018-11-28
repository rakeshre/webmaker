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
    
    <title>Reset Password </title>
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
       <h1>Reset your password:</h1>
           
        <?php
           if(!isset($_GET["user_id"])|| !isset($_GET["key"])){
    echo '<div class="alert alert-danger">Please click on  link you recieved by email!</div>';
    exit;
}
$user_id = $_GET["user_id"];
$key = $_GET["key"];
$time = time()-86400;
$user_id = mysqli_real_escape_string($link,$user_id);
$key = mysqli_real_escape_string($link,$key);
$sql = "SELECT user_id FROM forgotpassword WHERE rkey='$key' AND user_id='$user_id' AND time > '$time' AND status='pending'";
$result = mysqli_query($link,$sql);
if(!$result){
    echo '<div class="alert alert-danger">Error running the query!</div>';
    exit;
}
$count = mysqli_num_rows($result);
if($count !== 1){
    echo '<div class="alert alert-danger">Please try again.</div>';
    exit;
}
  echo "
  <form method= post id = 'passwordreset'>
  <input type=hidden name=key value=$key>
  <input type=hidden name=user_id value=$user_id>
  <div id='resetmessage'></div>
  <div class='form-group'>
  <label for='password'>Password:</label>
  <input type='password' class='form-control' name='password' id='password' placeholder='Enter new password'>
  </div>
  <div class='form-group'>
  <label for='password2'>Re-enter password:</label>
  <input type='password' class='form-control' name='password2' id='password2' placeholder='Re-enter password'>
  </div>
  <input type='submit' name='resetpassword' class='btn btn-lg btn-success value='Reset password'>
  </form>
  ";           

           ?>
       
       </div>
    
    </div>     
        
</div>
      
      
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
      <script>
      $("#passwordreset").submit(function(event){ 
                //prevent default php processing
                event.preventDefault();
                //collect user inputs
                var datatopost = $(this).serializeArray();
            //    console.log(datatopost);
                //send them to signup.php using AJAX
                $.ajax({
                    url: "storeresetpassword.php",
                    type: "POST",
                    data: datatopost,
                    success: function(data){

                        $('#resetmessage').html(data);
                    },
                    error: function(){
                        $("#resetmessage").html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later.</div>");

                    }

                });

            });     
      </script>
  </body>
</html>