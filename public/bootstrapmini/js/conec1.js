// JavaScript Document
$(document).ready(ini);
function ini()
{ $("#b3").click(enviardatos);
}
 function enviardatos()
 { var n1=$("#n1").val();
   var n2=$("#n2").val();
   var n3=$("#n3").val();
   var b3=$("#b3").val();
 $.ajax({
    url:"readd.php",
success:function(result){
alert(result);
 },
data:{
     n1:n1,
     n2:n2,
     n3:n3,
     b3:b3
  },
    type:"GET"   
 } );
}