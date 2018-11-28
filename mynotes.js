$(function(){
    var activeNote = 0;
    var editMode = false;
 $.ajax({
     url:"loadnotes.php",
     success:function(data){
         $('#notes').html(data);
         clickNote();
         clickonDelete();
     },
     error:function(){
         $('#alertContent').text("Error calling ajax call");
                    $('#alert').fadeIn();
     }
 });
    $('#addnote').click(function(){
        $.ajax({
            url: "createnotes.php",
            success:function(data){
                if(data == 'error'){
                    $('#alertContent').text("Error inserting new note in database!");
                    $('#alert').fadeIn();
                }else{
                  activeNote = data;
                    $("textarea").val("");
                    showHide(["#notepad","#allnotes"],["#notes","#addnote","#edit","#done"]);
                    $("textarea").focus();
                }
            },error:function(){
            $('#alertContent').text("Error calling ajax call");
                    $('#alert').fadeIn();
        }
        });
    });
    
    $("textarea").keyup(function(){
       $.ajax({
           url: "updatenotes.php",
           type:"POST",
           data: {note:$(this).val(),id:activeNote},
           success:function(data){
               if(data=='error'){
           $('#alertContent').text("Error updating notes!");
                    $('#alert').fadeIn();
       }
                },
            error:function(){
            $('#alertContent').text("Error calling ajax call");
                    $('#alert').fadeIn();
        }
       }); 
    });
    $('#allnotes').click(function(){
        $.ajax({
            url: "loadnotes.php",
            success:function(data){
                $("#notes").html(data);
                showHide(["#addnote","#edit","#notes"],["#done","#notepad","#allnotes"]);
                clickNote();
                clickonDelete();
                },
            error:function(){
            $('#alertContent').text("Error calling ajax call");
                    $('#alert').fadeIn();
        }
        });
    });
    $("#edit").click(function(){
        //switch to edit mode
        showHide(["#done", ".delete"],[this]);
        editMode = true;
        //reduce the width of notes
        $(".noteheader").addClass("col-xs-7 col-sm-9");
        //show hide elements
        
        
    
    });
    $("#done").click(function(){
        showHide(["#edit"],[".delete","#done"]);
        editMode = false;
        $(".noteheader").removeClass("col-xs-7 col-sm-9");
         if($(".note").is(':empty')){
               $("#empty").show();
           }
    })
   
 
    
    function clickNote(){
       $(".noteheader").click(function(){
        if(!editMode){
            activeNote = $(this).attr("id");
            $("textarea").val($(this).find('.text').text());
            showHide(["#notepad","#allnotes"],["#notes","#addnote","#edit","#done"]);
                    $("textarea").focus();
            
        }
    });
        
    }
    
       function clickonDelete(){
        $(".delete").click(function(){
            var deleteButton = $(this);
            //send ajax call to delete note
            $.ajax({
                url: "deletenotes.php",
                type: "POST",
                //we need to send the id of the note to be deleted
                data: {id:deleteButton.next().attr("id")},
                success: function (data){
                    if(data == 'error'){
                        $('#alertContent').text("There was an issue delete the note from the database!");
                        $("#alert").fadeIn();
                    }else{
                        //remove containing div
                        deleteButton.parent().remove();
                    }
                },
                error: function(){
                    $('#alertContent').text("There was an error with the Ajax Call. Please try again later.");
                            $("#alert").fadeIn();
                }

            });
            
        });
          
           
        
    }

    
    
   function showHide(a1,a2){
       for(i=0;i<a1.length;i++){
           $(a1[i]).show();
       }
       for(i=0;i<a2.length;i++){
           $(a2[i]).hide();
       }
   }; 
});