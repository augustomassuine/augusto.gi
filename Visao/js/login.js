function fctLogin(){
   
$.post('ph/jpLogin.php',
{
   email:$('#email').val(),
   senha:$('#senha').val()
},function(res){
      
    if(res==1){
         location.href='index.php';
     
    }
    else{
          $('spam').html(res).css({color:'#f00'});
    }
       
});   
   
}


