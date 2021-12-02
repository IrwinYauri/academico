// JavaScript Document
$(document).ready(ini);
function ini()
{ $("#bbuscar").click(mostrarlibro);
  }
 function mostrarlibro()
 { var n1=$("#n1").val();
   var bbuscar=$("#bbuscar").val();
     $.ajax({
		url:"resultadolibro.php",
	success:function(result){
	//alert(result);
	$("#resultado").html(result);
	 },
	data:{
		 n1:n1,
		 bbuscar:bbuscar
	  },
		type:"GET"   
	 } );
	
}
