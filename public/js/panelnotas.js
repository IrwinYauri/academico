$(document).ready(ini);
function ini()
{ //$("#bverhorario1").click(updateasistenciadia);
	

  }
//editarnota($semestre,$codcurso,$codalumno,$nota)
 function editarnotasjs(semestre,codcurso,codalumno,nota,unidad,nro)
 { //var n1=$("#codpro").val();
   var n1=semestre;
   var n2=codcurso;
   var n3=codalumno;
   var n4=nota;
   var n5=unidad;
   var n6=nro;
   var rurl="";
   //var bbuscar=$("#bbuscar").val();
     $.ajax({
		url:"notas/editarnotas",
	//rurl=urlExiste("../asistencia/updateasisalumno","/asistencia/updateasisalumno");
	//url:"../asistencia/updateasisalumno",
	//url:urlExiste("../asistencia/updateasisalumno","asistencia/updateasisalumno"),
	//url:"{{ route('asistencia.updateasisalumno') }}",
	success:function(result){
	//alert(result);
	//alertagrabarx(result);
	//toastr.success('asistencia editada','Actualizado',{timeOut:3000});
	$("#micontenidowww").html(result);
	console.log(semestre);
	console.log(codcurso);
	console.log(codalumno);
	console.log(nota);
	console.log(unidad);
	console.log(nro);
	 },
	data:{
	
		semestre:n1,
		codcurso:n2,
		codalumno:n3,
		nota:n4,
		unidad:n5,
		nro:n6
		//, bbuscar:bbuscar
	  },
		type:"GET"   
	 } );
	
}
function crearsemanaasisx(codcur,semana,dia,boton1,urlx)
 { //var n1=$("#codpro").val();
	/*var n1="";
	var n2="";
	var n3="";*/
	//var bbuscar=$("#bbuscar").val();
	//alert(urlx);
	  $.ajax({
	// url:"asistencia/updateasisalumno",
	 //url:"../asistencia/crearsemana2",
	//--- url:"asistencia/crearsemana02",
	
	url:urlx+"/crearsemana2",
	// url:"asistencia/updateasisalumno",
	 //url:"{{ route('asistencia.updateasisalumno') }}",
	 success:function(result){
		document.getElementById(boton1).style.display = "none";  //ocultarbotonasissemana
	//	alert("::SISTEMA:: \n SEMANA CREADA")
	alertagrabar('Semana Creada');
	 //alert(result);
	// $("#micontenidowww").html(result);
	  },
	 data:{
		codcur:codcur,
		semana:semana,
		dia:dia
		 //, bbuscar:bbuscar
	   },
		 type:"GET"   
	  } );
}
function crearasistenciadiaalumnox(codhora,codalumno,idocultar,idmostrar)
 { //var n1=$("#codpro").val();
   var n1=codhora;
   var n2=codalumno;
//var bbuscar=$("#bbuscar").val();
//alert(idocultar);
//alert(idmostrar);
document.getElementById(idocultar).style.display = "none";

     $.ajax({
	//	url:"asistencia/updateasisalumno",
	url:"../asistencia/crearasistenciadiaalumno",
	//url:"{{ route('asistencia.updateasisalumno') }}",
	success:function(result){
	//alert(result);

	document.getElementById(idmostrar).style.display = "block";
	document.getElementById(idmostrar).value = "P";
	$("#micontenidowww").html(result);
	 },
	data:{
		codhora:n1,
		codalumno:n2
	//	estado:n3
		//, bbuscar:bbuscar
	  },
		type:"GET"   
	 } );
	
}
 
