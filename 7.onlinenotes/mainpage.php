<?php
session_start();
if(!isset($_SESSION['user_id'])){
header("location:index.php");
}
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
          #allnotes,#done,#notepad,.delete,#empty{
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
          .noteheader{
              border: 1px solid grey;
              border-radius:10px;
              margin-bottom:10px;
              cursor:pointer;
              padding : 0 10px;
              background:linear-gradient(#FFFFFF,#ECEAE7);
              
          }
          .text{
              font-size:22px;
              overflow: hidden;
              white-space:nowrap;
              text-overflow: ellipsis;
          }
          .timetext{
              overflow: hidden;
              white-space:nowrap;
              text-overflow: ellipsis;
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
                <li><a href="profile.php">Profile</a></li>
                <li><a href="#">Help</a></li>
                <li><a href="#">Contact us</a></li>
                <li class="active"><a href="#">My Notes</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                <li><a>logged in as <b><?php echo $_SESSION["username"] ?></b></a></li>    
                <li><a href="index.php?logout=1">Logout</a></li>
                </ul>
            </div>
        </div>
      
      </nav>
      
      <div class="container" id="container">
          <div id="alert" class="alert alert-danger collapse">
          <a class="close" data-dismiss="alert">&times;</a>
              <p id="alertContent"></p>
          </div>
          <div class="row">
           <div class="col-md-offset-3 col-md-6" >
              <div class="buttons">
               <button type="button" class="btn btn-lg btn-info" id="addnote" name="addnote">Add Note</button>
               <button type="button" class="btn btn-lg btn-info pull-right" id="edit" name="edit">Edit</button>
               <button type="button" class="btn btn-lg btn-success pull-right" id="done" name="done">Done</button>
               <button type="button" class="btn btn-lg btn-info" id="allnotes" name="allnotes">All notes</button>
               </div>
               <div>
               <textarea rows="10" id="notepad">
               
               </textarea>
               </div>
               <div id="empty" class="alert alert-warning">Your notes list is empty.</div>
               <div id="notes" class="notes">
               </div>
              </div>
          </div>
      
      </div>
      <div class="footer">
      <div class="container">
          <p>Rakesh Copyright &copy;2017- <?php $today = date("Y"); echo $today;?></p>
          </div>
      </div>
      


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
      <script src="mynotes.js"></script>
  </body>
</html>