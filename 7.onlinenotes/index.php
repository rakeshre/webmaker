<?php
session_start();
include('connection.php');
include('logout.php');
include('remember.php');
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title> Online notes</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="styling.css" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    
  </head>
  <body>
    <nav role="navigation" class="navbar navbar-custom navbar-fixed-top">
        <div class="container-fluid">
                <div class="navbar-header">
                <a href="#" class="navbar-brand"><img src="images/logo.png" class="image" style="display:inline-block;margin-top:-5px">
                    Onotes</a>
                <button type="button" class="navbar-toggle" data-target="#dataCollapse" data-toggle="collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                </button>    
                </div>
            <div class="navbar-collapse collapse" id="dataCollapse">
                <ul class="navbar-nav nav">
                <li class="active"><a href="#">Home</a></li>
                <li><a href="#">Help</a></li>
                <li><a href="#">Contact</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                <li><a href="#loginmodal" data-toggle="modal">Login</a></li>
                </ul>
            </div>
        </div>
      
      </nav>
      
      <div class="jumbotron">
          <h1>Online Notes App</h1>
          <p>Your Notes with you wherever you go.</p>
          <p>Easy to use,protects all your notes!</p>
          <button class="btn btn-lg signup grey" type="button" data-target="#signupmodal" data-toggle="modal">Sign up for free</button>
      
      </div>
      <div class="footer">
      <div class="container">
          <p>Rakesh Copyright &copy;2017- <?php $today = date("Y"); echo $today;?></p>
          </div>
      </div>
      <form method="post" id="signupform">
         <div class="modal" id="signupmodal" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal">&times;</button>
                    <h4 id="modalLabel">Sign up today and Start using our Online Notes App! </h4>
                    </div>
                    <div class="modal-body">
                        <div id="signupmessage"></div>
                        <div class="form-group">
                            <label for="username" class="sr-only">Username:</label>
                        <input type="text" class="form-control" placeholder="Username" name="username" id="username" maxlength="30">
                        </div>
                        <div class="form-group">
                            <label for="email" class="sr-only">Email:</label>
                        <input type="email" class="form-control" placeholder="Email Address" name="email" id="email" maxlength="40">
                        </div>
                        <div class="form-group">
                            <label for="password" class="sr-only">Password:</label>
                        <input type="password" class="form-control" placeholder="Choose a password" name="password" id="password" maxlength="40">
                        </div>
                        <div class="form-group">
                            <label for="password2" class="sr-only">Confirm Password:</label>
                        <input type="password" class="form-control" placeholder="Confirm password" name="password2" id="password2" maxlength="40">
                        </div>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" name="signup" value="Sign up" class="btn grey">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        </div>
                
                </div>
            </div>
        </div>
      
      </form>
      
      
      <form method="post" id="loginform">
         <div class="modal" id="loginmodal" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal">&times;</button>
                    <h4 id="modalLabel">Login: </h4>
                    </div>
                    <div class="modal-body">
                        <div id ="loginmessage"></div>
                        
                        <div class="form-group">
                            <label for="email" class="sr-only">Email:</label>
                        <input type="email" class="form-control" placeholder="Email Address" name="loginemail" id="loginemail" maxlength="40">
                        </div>
                        <div class="form-group">
                            <label for="loginpassword" class="sr-only">Password:</label>
                        <input type="password" class="form-control" placeholder="password" name="loginpassword" id="loginpassword" maxlength="40">
                        </div>
                        <div class="checkbox">
                            <label for="rememberme"><input  type="checkbox" class="checkbox" name="rememberme" id="rememberme">Remember me</label>
                            <a href="#forgotmodal" data-dismiss="modal" data-toggle="modal" style="cursor:pointer" class="pull-right">Forgot Password?</a>
                        </div>
                        
                        </div>
                        <div class="modal-footer">
                            <input type="submit" name="login" value="Log in" class="btn grey">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-default pull-left" data-target="#signupmodal" data-toggle="modal" data-dismiss="modal">Register</button>
                        </div>
                
                </div>
            </div>
        </div>
      
      </form>
      
      
      <form method="post" id="forgotform">
         <div class="modal" id="forgotmodal" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal">&times;</button>
                    <h4 id="modalLabel">forgot password?Don't worry. </h4>
                    </div>
                    <div class="modal-body">
                        <div id="forgotmessage"></div>
                        
                        <div class="form-group">
                            <label for="forgotemail" class="sr-only">Email:</label>
                        <input type="email" class="form-control" placeholder="Enter email Address" name="forgotemail" id="forgotemail" maxlength="40">
                        </div>
                        
                        
                        </div>
                        <div class="modal-footer">
                            <input type="submit" name="forgotsubmit" value="Submit" class="btn grey">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-default pull-left" data-target="#signupmodal" data-toggle="modal" data-dismiss="modal">Register</button>
                        </div>
                
                </div>
            </div>
        </div>
      
      </form>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
      <script src="index.js"></script>
  </body>
</html>