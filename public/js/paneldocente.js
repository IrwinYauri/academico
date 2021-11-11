$(document).ready(ini);
function ini()
{ 
	$("#bhorario1").click(mostrarhorario);//activo
	$("#blistalumnomatriculado").click(mostrarmatriculados);//activo
	$("#basistencia1").click(mostrarasistenciaactual);//activo
	$("#basistencia2").click(mostrarasistenciacompletar);// activo
	$("#bsilabus1").click(mostrarsilabus);//activo
	$("#bsilabus2").click(mostrarsilabusconfigurar);//activo
	$("#bplanactividad").click(mostrarplanactividad);
	$("#bcrearnotas").click(crearnotas);//activo
	$("#breporteasistencia1").click(reporteasistencia);
	$("#breportenotas").click(reportenotas);//activo
	$("#breportenotasg").click(reportenotasg);
	$("#breporterecordacademico").click(reporterecordacademico);
	$("#bnotassustitorio").click(notassustitorio);
	$("#bnotassustitoriocurso").click(notassustitoriocurso);
	$("#bnotasaplazados").click(notasaplazados);
	$("#bsubirfoto").click(subirfoto);
	$("#bdatospersonal").click(datospersonales);
	$("#bverpassword").click(verpassword);
	$("#bsubirhojadevida").click(subirhojadevida);
	$("#brespuestaencuesta").click(respuestaencuesta);
	$("#bvermensaje").click(vermensaje);
}
 
 function mostrarhorario() //activado
 { var n1=$("#n1").val();
   var bbuscar=$("#bbuscar").val();

   $( "#micontenido" ).load( "docente/cargando" );
   $("#cargando").show();
   
     $.ajax({
		url:"docente/horario",
	success:function(result){
	$("#micontenido").html(result);
	$("#cargando").hide();
	},
	data:{
		 n1:n1,
		 bbuscar:bbuscar
	  },
		type:"GET"   
	 } );
	
}
function mostrarasistenciaactual() //activado
 { 
	 var n1=$("#n1").val();
   var bbuscar=$("#bbuscar").val();

   $( "#micontenido" ).load( "docente/cargando" );
   $("#cargando").show();

     $.ajax({
		url:"docente/asistencia21",
	success:function(result){
	//alert(result);
	$("#micontenido").html(result);
	$("#cargando").hide();
	 },
	data:{
		 n1:n1,
		 bbuscar:bbuscar
	  },
		type:"GET"   
	 } );
	
}
function mostrarmatriculados()  //activado
 { 	 var n1=$("#n1").val();
   var bbuscar=$("#bbuscar").val();
   $( "#micontenido" ).load( "docente/cargando" );
 	$("#cargando").show();
     $.ajax({
		url:"docente/matriculados",
	success:function(result){

	$("#micontenido").html(result);
	$("#cargando").hide();
	 },
	data:{
		 n1:n1,
		 bbuscar:bbuscar
	  },
		type:"GET"   
	 } );
	
}
function mostrarasistenciacompletar()//Activado
<<<<<<< HEAD
 { var n1=$("#n1").val();
   var bbuscar=$("#bbuscar").val();

   $("#micontenido").load("docente/cargando" );
   $("#cargando").show();

     $.ajax({
		url:"docente/completarasistencia",
	success:function(result){
	//alert(result);
	$("#micontenido").html(result);
	$("#cargando").hide();
	 },
	data:{
		 n1:n1,
		 bbuscar:bbuscar
	  },
=======
{ 
	//var n1=$("#n1").val();
    //var bbuscar=$("#bbuscar").val();
    $("#cargando").show();
    $.ajax({
		url:"vercargahoraria",
		success:function(result)
		{
			$("#micontenido").html(result);
			$("#cargando").hide();
		}/*,
		data:
		{
			n1:n1,
			bbuscar:bbuscar
	  	}*/,
>>>>>>> b04e08dba1f940c51b39e75a80d864461acee128
		type:"GET"   
	});	
}
function mostrarsilabus() //activado
 { var n1=$("#n1").val();
   var bbuscar=$("#bbuscar").val();
   
   $("#micontenido").load("docente/cargando" );
   $("#cargando").show();

     $.ajax({
		url:"docente/silabus1",
	success:function(result){
	//alert(result);
	$("#micontenido").html(result);
	$("#cargando").hide();
	 },
	data:{
		 n1:n1,
		 bbuscar:bbuscar
	  },
		type:"GET"   
	 } );
	
}
function mostrarsilabusconfigurar() //activado
 { var n1=$("#n1").val();
   var bbuscar=$("#bbuscar").val();

   $( "#micontenido" ).load( "docente/cargando" );
   $("#cargando").show();

     $.ajax({
		url:"docente/silabusevaluacion1",
	success:function(result){
	//alert(result);
	$("#micontenido").html(result);
	$("#cargando").hide();
	 },
	data:{
		 n1:n1,
		 bbuscar:bbuscar
	  },
		type:"GET"   
	 } );
	
}
function crearsilabus(seccion,unidades,
	tipoPF,
	formulaPF,
	tipoPU1,
	formulaPU1,
	nro_evalPU1,
	tipoPU2,
	formulaPU2,
	nro_evalPU2,
	tipoPU3,
	formulaPU3,
	nro_evalPU3,
	tipoPU4,
	formulaPU4,
	nro_evalPU4,
	tipoPU5,
	formulaPU5,
	nro_evalPU5,
	fech_ent1_ini,
	fech_ent1_fin,
	fech_ent2_ini,
	fech_ent2_fin,
	fech_ent3_ini,
	fech_ent3_fin,
	fech_ent4_ini,
	fech_ent4_fin,
	fech_ent5_ini,
	fech_ent5_fin) //activado
 { var n1=$("#n1").val();
   var bbuscar=$("#bbuscar").val();
     $.ajax({
		url:"docente/registrarsilabus",
	success:function(result){
	//alert(result);
	//alert("revx:"+tipoPU1);//-- verificar valores
	//alertagrabarx("CRITERIO DE EVALUACION ACTUALIZADO","#301934");
	$("#miresultadoxy").html(result);
	//console.log(url)
	
	mostrarsilabusconfigurar();
	 },
	data:{
		seccion:seccion,
		unidades:unidades,
		tipoPF:tipoPF,
		formulaPF:formulaPF,
		tipoPU1:tipoPU1,
		formulaPU1:formulaPU1,
		nro_evalPU1:nro_evalPU1,
		tipoPU2:tipoPU2,
		formulaPU2:formulaPU2,
		nro_evalPU2:nro_evalPU2,
		tipoPU3:tipoPU3,
		formulaPU3:formulaPU3,
		nro_evalPU3:nro_evalPU3,
		tipoPU4:tipoPU4,
		formulaPU4:formulaPU4,
		nro_evalPU4:nro_evalPU4,
		tipoPU5:tipoPU5,
		formulaPU5:formulaPU5,
		nro_evalPU5:nro_evalPU5,
		fech_ent1_ini:fech_ent1_ini,
		fech_ent1_fin:fech_ent1_fin,
		fech_ent2_ini:fech_ent2_ini,
		fech_ent2_fin:fech_ent2_fin,
		fech_ent3_ini:fech_ent3_ini,
		fech_ent3_fin:fech_ent3_fin,
		fech_ent4_ini:fech_ent4_ini,
		fech_ent4_fin:fech_ent4_fin,
		fech_ent5_ini:fech_ent5_ini,
		fech_ent5_fin:fech_ent5_fin
	  },
		type:"GET"   
	 } );
	
}
function mostrarplanactividad()
 { var n1=$("#n1").val();
   var bbuscar=$("#bbuscar").val();

   $( "#micontenido" ).load( "docente/cargando" );
   $("#cargando").show();

     $.ajax({
		url:"docente/planactividad",
	success:function(result){
	//alert(result);
	$("#micontenido").html(result);
	$("#cargando").hide();

	 },
	data:{
		 n1:n1,
		 bbuscar:bbuscar
	  },
		type:"GET"   
	 } );
	
}
function crearnotas()
 { var n1=$("#n1").val();
   var bbuscar=$("#bbuscar").val();
   $("#micontenido" ).load( "docente/cargando" );
   $("#cargando").show();
     $.ajax({
		url:"docente/crearnotas",
	success:function(result){
	//alert(result);
	$("#micontenido").html(result);
	$("#cargando").hide();
	 },
	data:{
		 n1:n1,
		 bbuscar:bbuscar
	  },
		type:"GET"   
	 } );
	
}
function reporteasistencia()
 { $( "#micontenido" ).load( "docente/cargando" );
 $("#cargando").show();
	  $.ajax({
		url:"docente/reporteasistencia",
	success:function(result){
	//alert(result);
	$("#micontenido").html(result);
	$("#cargando").hide();
	 },
	data:{  },
		type:"GET"   
	 } );
	
}
function reportenotasg() //pediente
 {$( "#micontenido" ).load( "docente/cargando" );
 $("#cargando").show();
	   $.ajax({
		url:"docente/crearnotas",
	success:function(result){
//	alert(result);
	$("#micontenido").html(result);
	$("#cargando").hide();
	 },
	data:{  },
		type:"GET"   
	 } );
	
}
function reportenotas()//activo
 {  $( "#micontenido" ).load( "docente/cargando" );
 	$("#cargando").show();
	 $.ajax({
		url:"docente/registronotas",
	success:function(result){
	//alert(result);
	$("#micontenido").html(result);
	$("#cargando").hide();
	 },
	data:{  },
		type:"GET"   
	 } );
	
}
function reporterecordacademico()//activo
 {   $( "#micontenido" ).load( "docente/cargando" );
 	 $("#cargando").show();

	 $.ajax({
		url:"docente/recordacademico",
	success:function(result){
	//alert(result);
	$("#micontenido").html(result);
	$("#cargando").hide();
	 },
	data:{  },
		type:"GET"   
	 } );
	
}
function buscarfechasemestre(semestre)//activo
 {  $.ajax({
		url:"docente/verfechasemestre",
	success:function(result){
	//alert(result);
	$("#micontenidoxyx").html(result);
	 },
	data:{ semestre:semestre },
		type:"GET"   
	 } );
	
}
function versemestrecriterios(seccion)//activo
 {  $.ajax({
		url:"docente/versilabuscriterios",
	success:function(result){
	//alert(result);
	$("#micontenidoxyx").html(result);
	 },
	data:{ seccion:seccion },
		type:"GET"   
	 } );
	
}
	function notassustitorio()
	{// $("#cargando").show();
	$( "#micontenido" ).load( "docente/cargando" );
	$("#cargando").show();
		$.ajax({
			url:"docente/crearnotassustitutoria",
		success:function(result){
		//alert(result);
		$("#micontenido").html(result);
		$("#cargando").hide();
		},
		data:{  },
			type:"GET"   
		} );
		
	}
function notassustitoriocurso()//pendinte revisar
 {  $.ajax({
	//	url:"notassustitoriocurso.php",
	url:"notassustitoriocurso.php",
	success:function(result){
	//alert(result);
	$("#micontenido").html(result);
	 },
	data:{  },
		type:"GET"   
	 } );
	
}
function notasaplazados()
 {  $( "#micontenido" ).load( "docente/cargando" );
 	$("#cargando").show();
	 $.ajax({
	//	url:"notasaplazados.php",
	url:"docente/crearnotasaplazados",
	success:function(result){
	//alert(result);
	$("#micontenido").html(result);
	$("#cargando").hide();
	 },
	data:{  },
		type:"GET"   
	 } );
	
}
function notasaplazadoscurso()
 {  $.ajax({
		url:"notasaplazadoscurso.php",
	success:function(result){
	//alert(result);
	$("#micontenido").html(result);
	 },
	data:{  },
		type:"GET"   
	 } );
	
}
function subirfoto()
 {   $( "#micontenido" ).load( "docente/cargando" );
 	 $("#cargando").show();
	 $.ajax({
		url:"docente/subirfoto",
	success:function(result){
	//alert(result);
	$("#micontenido").html(result);
	$("#cargando").hide();
	 },
	data:{  },
		type:"GET"   
	 } );
	
}
function datospersonales()
 {  $("#micontenido" ).load( "docente/cargando" );
 	$("#cargando").show();
	 $.ajax({
		url:"docente/datospersonales",
	success:function(result){
	//alert(result);
	$("#micontenido").html(result);
	$("#cargando").hide();
	 },
	data:{  },
		type:"GET"   
	 } );
	
}
function verpassword() //activo
 { //$("#micontenido" ).load( "docente/cargando" );
 //  $("#cargando").show();
	  $.ajax({
		url:"docente/password",
	success:function(result){
	//alert(result);
	$("#micontenido").html(result);
	//$("#cargando").hide();
	 },
	data:{  },
		type:"GET"   
	 } );
	
}
function buscarpassword(n1,n2,n3)//activo
 {  $.ajax({
		url:"docente/buscarpassword",
	success:function(result){
//	alert(result);
	$("#micontenido11").html(result);
	 },
	data:{xcod:n1,
		  xpass:n2,
		  nuevapass:n3  },
		type:"GET"   
	 } );
	
}
function cambiarpassworddocente(n1,n2)//activo
 {  $.ajax({
		url:"docente/cambiarpassworddocente",
	success:function(result){
	//alert(result);
	vermensaje();
	$("#micontenido11").html(result);
	 },
	data:{xcod:n1,
		xnuevaclave:n2  },
		type:"GET"   
	 } );
	
}
function subirhojadevida()
{  $("#micontenido" ).load( "docente/cargando" );
   $("#cargando").show();
	$.ajax({
	   url:"docente/subirhojadevida",
   success:function(result){
   //alert(result);
   $("#micontenido").html(result);
   $("#cargando").hide();
	},
   data:{  },
	   type:"GET"   
	} );
   
}
function respuestaencuesta()
{  $.ajax({
	   url:"docente/respuestaencuesta",
   success:function(result){
   //alert(result);
   $("#micontenido").html(result);
	},
   data:{  },
	   type:"GET"   
	} );
   
}
function vermensaje()
{  $.ajax({
	   url:"mensajes.php",
   success:function(result){
   //alert(result);
   $("#micontenido").html(result);
	},
   data:{  },
	   type:"GET"   
	} );
   
}
function mostrarperdidos()
 { var n1=3;
   var bbuscar=$("#bbuscar").val();
     $.ajax({
		url:"resultadolibroprestado.php",
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

function updatedocentecorreo(xcod,correo1,correo2,cell,tef)//activado
 { //var n1=3;
  // var bbuscar=$("#bbuscar").val();
     $.ajax({
		url:"docente/updatedocentecorreo",
	success:function(result){
	//alert(result);
	alertagrabarx("DATOS ACTUALIZADOS","navy");
//	$("#resultado").html(result);
	 },
	data:{
		xcod:xcod,
		correo1:correo1,
		correo2:correo2,
		cell:cell,
		tef:tef
	  },
		type:"GET"   
	 } );
	
}

var urlExiste = function(urlx,urly){
    //When I call the function, code is still executing here.
    $.ajax({
        type: 'HEAD',
        url: urlx,
        success: function() {
            //return true;
			return urlx;
        },
        error: function() {
			return urly;
            //return false;
        }            
    });
    //But not here...
}