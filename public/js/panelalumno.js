$(document).ready(ini);
function ini()
{ $("#bverhorario1").click(mostrarhorario);//activo
$("#bcrearmatricula").click(crearmatricula);//activo
$("#bmatriculaconstancia").click(vermatriculaconstancia);//acticvo
$("#bboletanotas").click(verboletanotas);
$("#bsilabus").click(versilabus);//activo
$("#bvernotas").click(vernotas);
$("#bverasistencia").click(verasistencia);
$("#brecordacademico").click(verrecordacademico);
$("#bpromedioponderado").click(verpromedioponderado);
$("#bsubirfoto").click(subirfoto);
$("#bdatospersonales").click(datospersonales);
$("#bpassword").click(cambiarpassword);
$("#bvermensaje").click(vermensaje);
$("#bcrearencuesta").click(crearencuesta);
  }

 function mostrarhorario()
 { var n1=$("#n1").val();
   var bbuscar=$("#bbuscar").val();
     $.ajax({
		url:"alumno/horario",
	success:function(result){
	//alert(result);
	$("#micontenido").html(result);
	 },
	data:{
		 n1:n1,
		 bbuscar:bbuscar
	  },
		type:"GET"   
	 } );
	
}
function crearmatricula()
 { var n1=$("#n1").val();
   var bbuscar=$("#bbuscar").val();
     $.ajax({
		url:"alumno/crearmatricula",
	success:function(result){
	//alert(result);
	$("#micontenido").html(result);
	 },
	data:{
		 n1:n1,
		 bbuscar:bbuscar
	  },
		type:"GET"   
	 } );
	
}
 function vermatriculaconstancia()
 { var n1=$("#n1").val();
   var bbuscar=$("#bbuscar").val();
     $.ajax({
		url:"alumno/matriculaconstancia",
	success:function(result){
	//alert(result);
	$("#micontenido").html(result);
	 },
	data:{
		 n1:n1,
		 bbuscar:bbuscar
	  },
		type:"GET"   
	 } );
	
}
function verhorario()
 { var n1=$("#n1").val();
   var bbuscar=$("#bbuscar").val();
     $.ajax({
		url:"horario.html",
	success:function(result){
	//alert(result);
	$("#micontenido").html(result);
	 },
	data:{
		 n1:n1,
		 bbuscar:bbuscar
	  },
		type:"GET"   
	 } );
	
}
function verboletanotas()
 { var n1=$("#n1").val();
   var bbuscar=$("#bbuscar").val();
     $.ajax({
		url:"boletanotas.php",
	success:function(result){
	//alert(result);
	$("#micontenido").html(result);
	 },
	data:{
		 n1:n1,
		 bbuscar:bbuscar
	  },
		type:"GET"   
	 } );
	
}

function versilabus()
 { var n1=$("#n1").val();
   var bbuscar=$("#bbuscar").val();
     $.ajax({
		url:"alumno/silabus",
	success:function(result){
	//alert(result);
	$("#micontenido").html(result);
	 },
	data:{
		 n1:n1,
		 bbuscar:bbuscar
	  },
		type:"GET"   
	 } );
	
}

function vernotas()
 { var n1=$("#n1").val();
   var bbuscar=$("#bbuscar").val();
     $.ajax({
		url:"alumno/notascurso",
	success:function(result){
	//alert(result);
	$("#micontenido").html(result);
	 },
	data:{
		 n1:n1,
		 bbuscar:bbuscar
	  },
		type:"GET"   
	 } );
	
}
function vernotasdetalle(n1,semestre,codcurso,codalumno) //usar dentro blade
 { /*alert(n1)
	  var n1;
	var semestre;
	var codcurso;
	var codalumno;*/
   var bbuscar=$("#bbuscar").val();
     $.ajax({
		url:"alumno/notascursodetalle",
	success:function(result){
	
	   $("#micontenido").html(result);
	 },
	data:{
		 n1:n1,
		 semestre:semestre,
		 codcurso:codcurso,
		 codalumno:codalumno,
		 bbuscar:bbuscar
	  },
		type:"GET"   
	 } );
	 
	
}
function verasistencia()
 { var n1=$("#n1").val();
   var bbuscar=$("#bbuscar").val();
     $.ajax({
		url:"alumno/verasistencia",
	success:function(result){
	//alert(result);
	$("#micontenido").html(result);
	 },
	data:{
		 n1:n1,
		 bbuscar:bbuscar
	  },
		type:"GET"   
	 } );
	
}
function verrecordacademico()
 { var n1=$("#n1").val();
   var bbuscar=$("#bbuscar").val();
     $.ajax({
		url:"recordacademico.php",
	success:function(result){
	//alert(result);
	$("#micontenido").html(result);
	 },
	data:{
		 n1:n1,
		 bbuscar:bbuscar
	  },
		type:"GET"   
	 } );
	
}

function verpromedioponderado()
 { var n1=$("#n1").val();
   var bbuscar=$("#bbuscar").val();
     $.ajax({
		url:"promedioponderado.php",
	success:function(result){
	//alert(result);
	$("#micontenido").html(result);
	 },
	data:{
		 n1:n1,
		 bbuscar:bbuscar
	  },
		type:"GET"   
	 } );
	
}

function subirfoto()
 { var n1=$("#n1").val();
   var bbuscar=$("#bbuscar").val();
     $.ajax({
		url:"subirfoto.php",
	success:function(result){
	//alert(result);
	$("#micontenido").html(result);
	 },
	data:{
		 n1:n1,
		 bbuscar:bbuscar
	  },
		type:"GET"   
	 } );
	
}
function datospersonales()
 { var n1=$("#n1").val();
   var bbuscar=$("#bbuscar").val();
     $.ajax({
		url:"datospersonales.php",
	success:function(result){
	//alert(result);
	$("#micontenido").html(result);
	 },
	data:{
		 n1:n1,
		 bbuscar:bbuscar
	  },
		type:"GET"   
	 } );
	
}
function cambiarpassword()
 { var n1=$("#n1").val();
   var bbuscar=$("#bbuscar").val();
     $.ajax({
		url:"password.php",
	success:function(result){
	//alert(result);
	$("#micontenido").html(result);
	 },
	data:{
		 n1:n1,
		 bbuscar:bbuscar
	  },
		type:"GET"   
	 } );
	
}
function vermensaje()
 { var n1=$("#n1").val();
   var bbuscar=$("#bbuscar").val();
     $.ajax({
		url:"mensajes.php",
	success:function(result){
	//alert(result);
	$("#micontenido").html(result);
	 },
	data:{
		 n1:n1,
		 bbuscar:bbuscar
	  },
		type:"GET"   
	 } );
	
}

function crearencuesta()
 { var n1=$("#n1").val();
   var bbuscar=$("#bbuscar").val();
     $.ajax({
		url:"crearencuesta.php",
	success:function(result){
	//alert(result);
	$("#micontenido").html(result);
	 },
	data:{
		 n1:n1,
		 bbuscar:bbuscar
	  },
		type:"GET"   
	 } );
	
}