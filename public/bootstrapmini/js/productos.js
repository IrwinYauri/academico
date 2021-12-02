// JavaScript Document
$(document).ready(ini);
function ini()
{ $("#bagregar").click(addpro);
  //$("#n1").keypress(enviardatos)
  $("#n1").keyup(buscarpro);
}
 function buscarpro()
 { var n1=$("#n1").val();
   var bagregar=$("#bagregar").val();
     $.ajax({
		url:"reproducto.php",
	success:function(result){
	//alert(result);
	$("#resultado").html(result);
	 },
	data:{
		 n1:n1,
		 bagregar:bagregar
	  },
		type:"GET"   
	 } );
	
}
function addpro()
 { var n1=$("#n1").val();
   var n2=$("#n2").val();
   var n3=$("#n3").val();
   var bagregar=$("#bagregar").val();
     $.ajax({
		url:"addproducto.php",
	success:function(result){
	//alert(result);
	$("#resultado").html(result);
	$("#n1").val("");
	$("#n2").val("");
	$("#n3").val("");
	 },
	data:{
		 n1:n1,
		 n2:n2,
		 n3:n3,
		 bagregar:bagregar
	  },
		type:"GET"   
	 } );
	
}

