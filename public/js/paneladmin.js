$(document).ready(ini);
function ini()
{ //$("#bverhorario1").click(updateasistenciadia);
	$("#blistadocente").click(listadocente);//activo
	$("#blistaalumno").click(listaalumno);//activo
	$("#blistausuario").click(listausuario);//activo
	$("#blistasemestre").click(listasemestre);//activo
	$("#blistaaula").click(listaaula);//activo
	$("#bhorario").click(listahorario);//activo
	$("#bencuesta").click(listaencuesta);//activo
	$("#bordenmerito").click(listaordenmerito);
}
  
 

function listadocente() //activo
{ 
    var n1="";
    var n2="";
    var n3="";
    //var bbuscar=$("#bbuscar").val();
    $("#cargando").show();
    $.ajax({
	//	url:"asistencia/updateasisalumno",
	url:"admin/listadocente",
	//url:"{{ route('asistencia.updateasisalumno') }}",
	success:function(result){
		//alert(result);
		$("#micontenido").html(result);
		$("#cargando").hide();
	},
	complete: function () {
	//	$('#tabla-docente1').DataTable();
	},
	data:{
		codhora:n1,
		codalumno:n2,
		estado:n3
		//, bbuscar:bbuscar
	},
		type:"GET"   
	});
	
}
function listaalumno() //activo
 { //var n1=$("#codpro").val();
   var n1="";
   var n2="";
   var n3="";
   //var bbuscar=$("#bbuscar").val();
   $("#cargando").show();
     $.ajax({
	//	url:"asistencia/updateasisalumno",
	url:"admin/listaalumno",
	//url:"{{ route('asistencia.updateasisalumno') }}",
	success:function(result){
	//alert(result);
	$("#micontenido").html(result);
	$("#cargando").hide();
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
function listausuario() //activo
 { //var n1=$("#codpro").val();
   var n1="";
   var n2="";
   var n3="";
   //var bbuscar=$("#bbuscar").val();
   $("#cargando").show();
     $.ajax({
	//	url:"asistencia/updateasisalumno",
	url:"admin/listausuario",
	//url:"{{ route('asistencia.updateasisalumno') }}",
	success:function(result){
	//alert(result);
	$("#micontenido").html(result);
	$("#cargando").hide();
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
function listasemestre() //activo
 { //var n1=$("#codpro").val();
    var n1="";
    var n2="";
    var n3="";
    //var bbuscar=$("#bbuscar").val();
    $("#cargando").show();
    $.ajax({
	//	url:"asistencia/updateasisalumno",
	url:"admin/listasemestre",
	//url:"{{ route('asistencia.updateasisalumno') }}",
	success:function(result)
	{$("#cargando").hide();
		$("#micontenido").html(result);
		
	},
	data:
	{
		codhora:n1,
		codalumno:n2,
		estado:n3
		//, bbuscar:bbuscar
	},
		type:"GET"   
	});
	
}


function listaaula() //activo
 { //var n1=$("#codpro").val();
   var n1="";
   var n2="";
   var n3="";
   //var bbuscar=$("#bbuscar").val();
   $("#cargando").show();
     $.ajax({
	//	url:"asistencia/updateasisalumno",
	url:"admin/listaaula",
	//url:"{{ route('asistencia.updateasisalumno') }}",
	success:function(result){
	//alert(result);
	$("#micontenido").html(result);
	$("#cargando").hide();
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
function listahorario() //activo
 {  
    //var n1=$("#codpro").val();
    var n1="";
    var n2="";
    var n3="";
    //var bbuscar=$("#bbuscar").val();
    
    $("#cargando").show();
    $.ajax(
    {
		//	url:"asistencia/updateasisalumno",
		url:"admin/horario",
		//url:"{{ route('asistencia.updateasisalumno') }}",
		success:function(result)
		{
			//alert(result);
			$("#micontenido").html(result);
			$("#cargando").hide();
		},
		data:{
			codhora:n1,
			codalumno:n2,
			estado:n3
			//, bbuscar:bbuscar
		  },
			type:"GET"   
	});
	
}
function listaencuesta() //activo
 { 
   var n1="";
   var n2="";
   var n3="";
   //var bbuscar=$("#bbuscar").val();
   $("#cargando").show();
     $.ajax({
	//	url:"asistencia/updateasisalumno",
	url:"admin/editarencuesta",
	//url:"{{ route('asistencia.updateasisalumno') }}",
	success:function(result){
	//alert(result);
	$("#micontenido").html(result);
	$("#cargando").hide();
	},
	 complete: function () {
		//$('#tabla-docente1').DataTable();
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
function listaordenmerito() //activo
 { 
   var n1="";
   var n2="";
   var n3="";
   //var bbuscar=$("#bbuscar").val();
   $("#cargando").show();
     $.ajax({
	//	url:"asistencia/updateasisalumno",
	url:"admin/ordenmerito",
	//url:"{{ route('asistencia.updateasisalumno') }}",
	success:function(result){
	//alert(result);
	$("#micontenido").html(result);
	$("#cargando").hide();
	},
	 complete: function () {
		//$('#tabla-docente1').DataTable();
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
function listaencuestapreguntasemestre(semestre) //activo
 { 
   var n1=semestre;
 
   //var bbuscar=$("#bbuscar").val();
   $("#cargando").show();
     $.ajax({
	//	url:"asistencia/updateasisalumno",
	url:"admin/encuestapreguntasemestre",
	//url:"{{ route('asistencia.updateasisalumno') }}",
	success:function(result){
	//alert(result);
	$("#tcategoria").html(result);
	$("#cargando").hide();
	},
	 complete: function () {
		//$('#tabla-docente1').DataTable();
	   },
	data:{
		semestre:n1
		
	  },
		type:"GET"   
	 } );
	
}
 function updateasistenciadia()
 { //var n1=$("#codpro").val();
   var n1="";
   var n2="";
   var n3="";
   //var bbuscar=$("#bbuscar").val();
   $("#cargando").show();
     $.ajax({
	//	url:"asistencia/updateasisalumno",
	url:"../asistencia/updateasisalumno",
	//url:"{{ route('asistencia.updateasisalumno') }}",
	success:function(result){
	//alert(result);
	$("#micontenidowww").html(result);
	$("#cargando").hide();
	
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
function crearsemanaasis(codcur,semana,dia)
 { //var n1=$("#codpro").val();
	/*var n1="";
	var n2="";
	var n3="";*/
	//var bbuscar=$("#bbuscar").val();
	$("#cargando").show();
	  $.ajax({
	 //	url:"asistencia/updateasisalumno",
	 url:"../asistencia/crearsemana2",
	 //url:"{{ route('asistencia.updateasisalumno') }}",
	 success:function(result){
	// alert(result);
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
function creardocente()
 {
//alert("docentes");
}
 
function cambiarpassworddocente(n1,n2)//activo
 {  $.ajax({
		url:"admin/cambiarpassworddocente",
	success:function(result){
	//alert(result);
	$("#micontenido11").html(result);
	 },
	data:{xcod:n1,
		  xnuevaclave:n2  },
		type:"GET"   
	 } );
	
}
function cambiarpasswordalumno(n1,n2)//activo
 {  $.ajax({
		url:"admin/cambiarpasswordalumno",
	success:function(result){
	//alert(result);
	$("#micontenido11").html(result);
	 },
	data:{xcod:n1,
		  xnuevaclave:n2  },
		type:"GET"   
	 } );
	
}

function activarsemestre(semestre) //activo
 {var n1=semestre;
   
     $.ajax({
	//	url:"asistencia/updateasisalumno",
	url:"admin/activarsemestre",
	//url:"{{ route('asistencia.updateasisalumno') }}",
	success:function(result){
	//alert(result);
	$("#micontenidoxx").html(result);
	listasemestre();
	
	$('#tabla-semestre').DataTable();


	 },
	data:{
		semestre:n1
		//, bbuscar:bbuscar
	  },
		type:"GET"   
	 } );
	
}

function modificarfechasemetre() //activo
 {   var  nrosemestre =$("#nrosemestre").val();
	  var  sem_iMatriculaInicio =$("#sem_iMatriculaInicio").val();
	var sem_iMatriculaFinal =$("#sem_iMatriculaFinal").val();
	var sem_dEncuestaInicio=$("#sem_dEncuestaInicio").val();
	var sem_dEncuestaFinal =$("#sem_dEncuestaFinal").val();
	var sem_dInicioClases=$("#sem_dInicioClases").val();
   var sem_iSemanas=$("#sem_iSemanas").val();
   var sem_dActaInicio =$("#sem_dActaInicio").val();
   var  sem_dActaFinal=$("#sem_dActaFinal").val();
   var sem_iToleranciaInicio =$("#sem_iToleranciaInicio").val();
   var sem_iToleranciaFinal =$("#sem_iToleranciaFinal").val();
   var fech_ent1_ini =$("#fech_ent1_ini").val();
   var  fech_ent1_fin=$("#fech_ent1_fin").val();
   var fech_ent2_ini =$("#fech_ent2_ini").val();
   var  fech_ent2_fin =$("#fech_ent2_fin").val();
   var fech_ent3_ini =$("#fech_ent3_ini").val();
   var  fech_ent3_fin=$("#fech_ent3_fin").val();
   var fech_ent4_ini =$("#fech_ent4_ini").val();
   var  fech_ent4_fin =$("#fech_ent4_fin").val();
   var fech_ent5_ini =$("#fech_ent5_ini").val();
   var fech_ent5_fin=$("#fech_ent5_fin").val();
   var sem_dAplazadoInicio=$("#sem_dAplazadoInicio").val();
   var sem_dAplazadoFinal=$("#sem_dAplazadoFinal").val();
   var fecMatReg_ini=$("#fecMatReg_ini").val();
   var fecMatReg_fin=$("#fecMatReg_fin").val();
   var fecMatExt_ini=$("#fecMatExt_ini").val();
   var  fecMatExt_fin=$("#fecMatExt_fin").val();
	
   
     $.ajax({
	//	url:"asistencia/updateasisalumno",
	url:"admin/modificarfechasemestre",
	//url:"{{ route('asistencia.updateasisalumno') }}",
	success:function(result){
	//alert(result);
	$("#micontenidoxx").html(result);

	alertagrabarx("CRONOGRAMA ACTUALIZADO","#301934");

	//listasemestre();
	//$('#tabla-semestre').DataTable();

	 },
	data:{
		semestre: nrosemestre,
		sem_iMatriculaInicio:sem_iMatriculaInicio,
		sem_iMatriculaFinal:sem_iMatriculaFinal,
		sem_dEncuestaInicio:sem_dEncuestaInicio,
		sem_dEncuestaFinal:sem_dEncuestaFinal,
		sem_dInicioClases:sem_dInicioClases,
	   sem_iSemanas:sem_iSemanas,
	   sem_dActaInicio:sem_dActaInicio,
	   sem_dActaFinal:sem_dActaFinal,
	    sem_iToleranciaInicio:sem_iToleranciaInicio,
	    sem_iToleranciaFinal:sem_iToleranciaFinal,
	    fech_ent1_ini:fech_ent1_ini,
	     fech_ent1_fin :fech_ent1_fin,
	    fech_ent2_ini :fech_ent2_ini,
	     fech_ent2_fin:fech_ent2_fin,
	    fech_ent3_ini :fech_ent3_ini,
	     fech_ent3_fin:fech_ent3_fin,
	    fech_ent4_ini :fech_ent4_ini,
	     fech_ent4_fin:fech_ent4_fin,
	    fech_ent5_ini :fech_ent5_ini,
	     fech_ent5_fin:fech_ent5_fin,
	     sem_dAplazadoInicio:sem_dAplazadoInicio,
	    sem_dAplazadoFinal:sem_dAplazadoFinal,
	    fecMatReg_ini:fecMatReg_ini,
	    fecMatReg_fin:fecMatReg_fin,
	    fecMatExt_ini:fecMatExt_ini,
	     fecMatExt_fin:fecMatExt_fin
		 
		//, bbuscar:bbuscar
	  },
		type:"GET"   
	 } );
	
}

function verpagos()
{ $("#cargando").show();
	$.ajax({
	url:"admin/pagosdepositos",
success:function(result){
//alert(result);
$("#micontenido").html(result);
$("#cargando").hide();
 },
data:{ },
	type:"GET"   
 } );

}

function verpagos2()
{  $("#cargando").show();
	$.ajax({
	url:"admin/pagosdepositosrpt",
success:function(result){
//alert(result);
$("#micontenido").html(result);
$("#cargando").hide();
 },
data:{ },
	type:"GET"   
 } );

}

function verseguros()
{  $("#cargando").show();
	$.ajax({
	url:"admin/seguros",
success:function(result){
//alert(result);
$("#micontenido").html(result);
$("#cargando").hide();
 },
data:{ },
	type:"GET"   
 } );

}

function verreservasemestre()
{  $("#cargando").show();
	$.ajax({
	url:"admin/consultareserva",
success:function(result){
//alert(result);
$("#micontenido").html(result);
$("#cargando").hide();
 },
data:{ },
	type:"GET"   
 } );

}


function vermatriculados()
{  $("#cargando").show();
	$.ajax({
	url:"admin/consultamatriculados",
success:function(result){
//alert(result);
$("#micontenido").html(result);
$("#cargando").hide();
 },
data:{ },
	type:"GET"   
 } );

}