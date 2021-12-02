// JavaScript Document
$(document).ready(ini);
function ini()
{ $("#b1").click(enviardatos2);
  $("#b2").click(actualizar2);
  //$("#n1").keypress(enviardatos)
  $("#n1").keyup(enviardatos1);
}
 function enviardatos1()
 { var n1=$("#n1").val();
   var n2=$("#n2").val();
   var n3=$("#n3").val();
   var b1=$("#b1").val();
     $.ajax({
		url:"libbuscar.php",
	success:function(result){
	//alert(result);
	$("#res").html(result);
	 },
	data:{
		 n1:n1,
		 n2:n2,
		 n3:n3,
		 b1:b1
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
		 b1:b1
	  },
		type:"GET"   
	 } );
	
}
function actualizar2()
 { var n0=$("#n0").val();
   var n1=$("#n1").val();
   var n2=$("#n2").val();
   var n3=$("#n3").val();
   var b2=$("#b2").val();
     $.ajax({
		url:"actualizar.php",
	success:function(result){
	//alert(result);
	$("#res").html(result);
	 },
	data:{
		 n0:n0,
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