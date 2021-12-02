$(document).ready(ini);
function ini()
{ //$("#b1").click(enviardatos2);
  //$("#n1").keypress(enviardatos)
  $("#n1").keyup(buscardata);
  $("#n2").keyup(buscardata);
}
 function buscardata()
 { var n1=$("#n1").val();
   var n2=$("#n2").val();
   var b2=$("#b2").val();

     $.ajax({
		url:"lib/libbuscar.php",
	success:function(result){
	//alert(result);
	$("#res").html(result);
	 },
	data:{
		 n1:n1,
		 n2:n2,
		 b2:b2
	  },
		type:"GET"   
	 } );
	
}
function enviardatos2()
 { var n1=$("#n1").val();
   var n2=$("#n2").val();
   var n3=$("#n3").val();
   var b1=$("#b1").val();
     $.ajax({
		url:"agregarpro.php",
	success:function(result){
	//alert(result);
	$("#res").html(result);
	 },
	data:{
		 n1:n1,
		 n2:n2,
		 n3:n3,
		 b2:b2
	  },
		type:"GET"   
	 } );
	
}
function comprobar()
{
  enviardatos;
	}