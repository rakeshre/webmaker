<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>My notes</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="styling.css" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
      <style>
          #container{
              margin-top:130px;
          }
          #allnotes,#done,#notepad{
              display:none;
          }
          .buttons{
              margin-bottom: 20px;
          }
          textarea{
              width:100%;
              max-width: 100%;
              font-size: 16px;
              line-height: 1.5em;
              border-left-width: 20px;
              border-color:darkgreen;
              color:darkgreen;
              padding: 10px;
          }
          #profile{
              color:#650ba2;
          }
          tr{
              cursor: pointer;
              color:#650ba2;
              background-color: goldenrod;
          }
      </style>
    
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
                <li class="active"><a href="#">Profile</a></li>
                <li><a href="#">Help</a></li>
                <li><a href="#">Contact us</a></li>
                <li><a href="mainpage.php">My Notes</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                <li><a>logged in as <b><?php echo $_SESSION["username"] ?></b></a></li>    
                <li><a href="index.php?logout=1">Logout</a></li>
                </ul>
            </div>
        </div>
      
      </nav>
      
      <div class="container" id="container">
          <div class="row">
           <div class="col-md-offset-3 col-md-6" >
               <h2 id="profile"><b>General Account Settings:</b></h2>
               <div class="table-responsive">
               <table class="table table-hover table-condensed table-bordered">
                <tr data-target="#updateusername" data-toggle="modal">
                   <td>Username</td>
                   <td><?php echo $_SESSION["username"] ?></td>
                   </tr> 
                   <tr data-target="#updateemail" data-toggle="modal">
                   <td>Email</td>
                   <td><?php echo $_SESSION["email"] ?></td>
                   </tr> 
                   <tr data-target="#updatepassword" data-toggle="modal">
                   <td>Password</td>
                   <td>hidden</td>
                   </tr> 
                   
                </table>
               </div>
              </div>
          </div>
      
      </div>
      <div class="footer">
      <div class="container">
          <p>Rakesh Copyright &copy;2017- <?php $today = date("Y"); echo $today;?></p>
          </div>
      </div>
      <form method="post" id="updateusernameform">
         <div class="modal" id="updateusername" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal">&times;</button>
                    <h4 id="modalLabel">Update username! </h4>
                    </div>
                    <div class="modal-body">
                        <div class="signupmessage"></div>
                        <div class="form-group">
                            <label for="username" >Username:</label>
                        <input type="text" class="form-control" name="username" id="username" maxlength="30" value="value">
                        </div>
                        
                        
                        </div>
                        <div class="modal-footer">
                            <input type="submit" name="submit" value="Submit" class="btn grey">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        </div>
                
                </div>
            </div>
        </div>
      
      </form>
      
      <form method="post" id="updateemailform">
         <div class="modal" id="updateemail" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal">&times;</button>
                    <h4 id="modalLabel">Update Email! </h4>
                    </div>
                    <div class="modal-body">
                        <div class="signupmessage"></div>
                        <div class="form-group">
                            <label for="email" >Email:</label>
                        <input type="email" class="form-control" name="email" id="email" maxlength="40" value="value">
                        </div>
                        
                        
                        </div>
                        <div class="modal-footer">
                            <input type="submit" name="submit" value="Submit" class="btn grey">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        </div>
                
                </div>
            </div>
        </div>
      
      </form>
      <form method="post" id="updatepasswordform">
         <div class="modal" id="updatepassword" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal">&times;</button>
                    <h4 id="modalLabel">Update password! </h4>
                    </div>
                    <div class="modal-body">
                        <div class="signupmessage"></div>
                        <div class="form-group">
                            <label for="cpassword" class="sr-only" >Enter current password:</label>
                        <input type="password" class="form-control" name="cpassword" id="cpassword" maxlength="40" placeholder="Enter current password">
                        </div>
                        
                        <div class="form-group">
                            <label for="password" class="sr-only" >Enter new password:</label>
                        <input type="password" class="form-control" name="password" id="password" maxlength="40" placeholder="Enter new password">
                        </div>
                        
                        <div class="form-group">
                            <label for="password2" class="sr-only" >Confirm new password:</label>
                        <input type="password" class="form-control" name="password2" id="password2" maxlength="40" placeholder="Confirm new password">
                        </div>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" name="submit" value="Submit" class="btn grey">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        </div>
                
                </div>
            </div>
        </div>
      
      </form>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>