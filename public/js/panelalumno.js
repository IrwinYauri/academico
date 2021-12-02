$(document).ready(ini);
function ini()
{ $("#bverhorario1").click(mostrarhorario);//activo
$("#bcrearmatricula").click(crearmatricula);//activo
$("#bmatriculaconstancia").click(vermatriculaconstancia);//acticvo
$("#bboletanotas").click(verboletanotas);
$("#bsilabus").click(versilabus);//activo
$("#bvernotas").click(vernotas);
$("#bverasistencia").click(verasistencia);//activo
$("#brecordacademico").click(verrecordacademico);
$("#bpromedioponderado").click(verpromedioponderado);
$("#bsubirfoto").click(subirfoto);
$("#bdatospersonales").click(datospersonales);
$("#bpassword").click(cambiarpassword);
$("#bvermensaje").click(vermensaje);
$("#bcrearencuesta").click(crearencuesta);
  }

 function mostrarhorario()
 {  $("#micontenido").html(
	"<img src='img/cargar.gif'>"
  );
	 var n1=$("#n1").val();
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
 { $("#micontenido").html(
	"<img src='img/cargar.gif'>"
  );
	 var n1=$("#n1").val();
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
 { $("#micontenido").html(
	"<img src='img/cargar.gif'>"
  );
	 var n1=$("#n1").val();
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

function verboletanotas()
 { var n1=$("#n1").val();
   var bbuscar=$("#bbuscar").val();
     $.ajax({
		url:"alumno/boletanotas",
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
 { $("#micontenido").html(
	"<img src='img/cargar.gif'>"
  );
	 var n1=$("#n1").val();
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
 {  $("#micontenido").html(
	"<img src='img/cargar.gif'>"
  );
	 var n1=$("#n1").val();
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
 {  $("#micontenido").html(
	"<img src='img/cargar.gif'>"  );
	 
	var n1=$("#n1").val();
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
 { $("#micontenido").html(
	"<img src='img/cargar.gif'>"  );
	 var n1=$("#n1").val();
   var bbuscar=$("#bbuscar").val();
     $.ajax({
		url:"alumno/recordacademico",
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
 { $("#micontenido").html(
	"<img src='img/cargar.gif'>"  );
	 var n1=$("#n1").val();
   var bbuscar=$("#bbuscar").val();
     $.ajax({
		url:"alumno/promedioponderado",
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
 { $("#micontenido").html(
	"<img src='img/cargar.gif'>"  );
	 var n1=$("#n1").val();
   var bbuscar=$("#bbuscar").val();
     $.ajax({
		url:"alumno/datospersonales",
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
 { $("#micontenido").html(
	"<img src='img/cargar.gif'>"  );
	 var n1=$("#n1").val();
   var bbuscar=$("#bbuscar").val();
     $.ajax({
		url:"alumno/password",
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
		url:"alumno/crearencuesta",
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