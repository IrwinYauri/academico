// JavaScript Document
$(document).ready(ini);
function ini()
{ $("#b1").click(enviardatos);
  //$("#n1").keypress(enviardatos)
  $("#n1").keyup(enviardatos);
}
 function enviardatos()
 { var n1=$("#n1").val();
   var b1=$("#b1").val();
     $.ajax({
		url:"libbuscar.php",
	success:function(result){
	//alert(result);
	$("#res").html(result);
	 },
	data:{
		 n1:n1,
		 b1:b1
	  },
		type:"GET"   
	 } );
	
}
function comprobar()
{
  enviardatos;
	}