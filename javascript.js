 var playing = false;
        var score;
        var startbox = document.getElementById("start");
        function  end(){
               gameover.style.display="block";
               time.style.display= "none";
            document.getElementById("finalscore").innerHTML=score;
            
           } 
       function startgame(){
        if(playing==true){
            location.reload();
        }  else{
            playing=true;  
            questions();
            score = 0; 
            startbox.innerHTML= "Restart Game";
            document.getElementById("time").style.display = "block";
            document.getElementById("scorevalue").innerHTML= score;
            var x=60;
            var counter=setInterval(function(){
               x--;
               document.getElementById("sec").innerHTML = x;
            if(x==0){
                end();
            }
            },1000 );
            
           }
     
 }
     function questions(){
     var num1= Math.round(Math.random()*10);
     var num2= Math.round(Math.random()*10);
     
     document.getElementById("question").innerHTML= num1 +"*"+ num2;
     var a= Math.round(Math.random()*3);
      result= num1*num2;
         var answers=[];
      answersArray =  answers;
         answers[a]= result ;
     for(i=0;i<4;i++){
         if(answers[i]==null){
             answers[i]=Math.round(Math.random()*100);
}
     }
     option1.innerHTML=answers[0];
     option2.innerHTML=answers[1];
     option3.innerHTML=answers[2];
     option4.innerHTML=answers[3];
     
     } 
        
        
        
 function answered(i){
          if(answersArray[i]== result){
              show("correct")
              var crt=setTimeout(function(){
                  hide("correct")},1000);
              score+=1;
               document.getElementById("scorevalue").innerHTML= score;
              questions();
          }
     else{
          show("wrong")
              var wrg=setTimeout(function(){
                  hide("wrong")},1000);
              
     }
      }
        function hide(id){
          document.getElementById(id).style.display="none";
        }
        function show(id){
          document.getElementById(id).style.display="block";
        }