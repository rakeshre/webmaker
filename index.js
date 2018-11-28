$("#signupform").submit(function(event){
    event.preventDefault();
    var datatopost = $(this).serializeArray();
//    console.log(datatopost);
    $.ajax({
        url: "signup.php",
        type:"POST",
        data: datatopost,
        success: function(data){
            if(data){
                $("#signupmessage").html(data);
            }
        },
        error: function(){
            $("#signupmessage").html("<div class='alert alert-danger'> Problem calling ajax call</div>");
        }
        
        
    });
    
    
});
$("#loginform").submit(function(event){
    event.preventDefault();
    var datatopost = $(this).serializeArray();
//    console.log(datatopost);
    $.ajax({
        url: "login.php",
        type:"POST",
        data: datatopost,
        success: function(data){
            if(data == "success"){
                window.location = "mainpage.php";
            }else{
                $("#loginmessage").html(data);
            }
        },
        error: function(){
            $("#loginmessage").html("<div class='alert alert-danger'> Problem calling ajax call</div>");
        }
        
        
    });
    
    
});
