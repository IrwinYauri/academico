$(document).ready(ini);
function ini()
{ //$("#bverhorario1").click(updateasistenciadia);
	

  }

 function updateasistenciadia(codhora,codalumno,estado)
 { //var n1=$("#codpro").val();
   var n1=codhora;
   var n2=codalumno;
   var n3=estado;
   var rurl="";
   //var bbuscar=$("#bbuscar").val();
     $.ajax({
		url:"asistencia/updateasisalumno",
	//rurl=urlExiste("../asistencia/updateasisalumno","/asistencia/updateasisalumno");
	//url:"../asistencia/updateasisalumno",
	//url:urlExiste("../asistencia/updateasisalumno","asistencia/updateasisalumno"),
	//url:"{{ route('asistencia.updateasisalumno') }}",
	success:function(result){
	
		men="GRABANDO:"+estado.toString()+"";
        alertagrabarx(men,"#301934");
	//alertagrabar('Grabado Asistencia');
	//toastr.success('asistencia editada','Actualizado',{timeOut:3000});
	//$("#micontenidowww").html(result);
	 },
	data:{
		codhora:n1,
		codalumno:n2,
		estado:n3
		//, bbuscar:bbuscar
	  },
		type:"GET"   
	 } );
	
}
function crearsemanaasis(codcur,semana,dia,boton1,urlx)//para verificar
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
function crearsemanaasisfinal(codcur,semestre,horax,tema)
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
	
	url:"asistencia/crearsemana22",
	// url:"asistencia/updateasisalumno",
	 //url:"{{ route('asistencia.updateasisalumno') }}",
	 success:function(result){
	//	document.getElementById(boton1).style.display = "none";  //ocultarbotonasissemana
	//	alert("::SISTEMA:: \n SEMANA CREADA")
	alertagrabarx('Semana Creada');
	//alert(result);
	// $("#micontenidowww").html(result);
	  },
	 data:{
		codcurso:codcur,
		semestre:semestre,
		horax:horax,
		tema:tema
		 //, bbuscar:bbuscar
	   },
		 type:"GET"   
	  } );
}
function crearsemanaactual(codcur,semana,dia)
 { //var n1=$("#codpro").val();
	/*var n1="";
	var n2="";
	var n3="";*/
	//var bbuscar=$("#bbuscar").val();
	//alert(dia);
	  $.ajax({
	// url:"asistencia/updateasisalumno",
	 //url:"../asistencia/crearsemana2",
	//--- url:"asistencia/crearsemana02",
	
	url:"asistencia/crearsemana3",
	// url:"asistencia/updateasisalumno",
	 //url:"{{ route('asistencia.updateasisalumno') }}",
	 success:function(result){
	//	document.getElementById(boton1).style.display = "none";  //ocultarbotonasissemana
	//	alert("::SISTEMA:: \n SEMANA CREADA")
	//alertagrabar('Semana Creada');
	alertagrabarx("ASISTENCIA CREADA","NAVY");
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
function editartemaserver(tema,horax)
 { //var n1=$("#codpro").val();
	/*var n1="";
	var n2="";
	var n3="";*/
	//var bbuscar=$("#bbuscar").val();
	//alert(dia);
	  $.ajax({
	// url:"asistencia/updateasisalumno",
	 //url:"../asistencia/crearsemana2",
	//--- url:"asistencia/crearsemana02",
	
	url:"asistencia/crearsemana3",
	// url:"asistencia/updateasisalumno",
	 //url:"{{ route('asistencia.updateasisalumno') }}",
	 success:function(result){
	//	document.getElementById(boton1).style.display = "none";  //ocultarbotonasissemana
		//alert(result)
	//alertagrabar('Semana Creada');
	alertagrabarx("TEMA ACTUALIZADO","NAVY");
	 //alert(result);
	// $("#micontenidowww").html(result);
	  },
	 data:{
		tema:tema,
		horax:horax
	
		 //, bbuscar:bbuscar
	   },
		 type:"GET"   
	  } );
}
function crearasistenciadiaalumno(codhora,codalumno,idocultar,idmostrar)
 { //var n1=$("#codpro").val();
   var n1=codhora;
   var n2=codalumno;
//var bbuscar=$("#bbuscar").val();
//alert(idocultar);
//alert(idmostrar);
document.getElementById(idocultar).style.display = "none";

     $.ajax({
	//	url:"asistencia/updateasisalumno",
//	url:"../asistencia/crearasistenciadiaalumno",
url:"asistencia/crearasistenciadiaalumno",
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
 
