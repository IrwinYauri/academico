// JavaScript Document
$(document).ready(ini);
function ini()
{ $("#bbuscar").click(verlibro);
  $("#nbuscar").click(veralumno);
  $("#bgrabarp").click(addprestamo);
  $("#bdetalle").click(verhistorial);
  $("#bdevolver").click(devolver);
  
  //$("#n1").keypress(enviardatos)
  //$("#n1").keyup(enviardatos);
}
 function verlibro()
 { var n1=$("#n1").val();
   var bbuscar=$("#bbuscar").val();
     $.ajax({
		url:"leerlibro.php",
	success:function(result){
	//alert(result);
	$("#n2").html(result);
	 },
	data:{
		 n1:n1,
		 bbuscar:bbuscar
	  },
		type:"GET"   
	 } );
	
}
function veralumno()
 { var ndni=$("#ndni").val();
   var nbuscar=$("#nbuscar").val();
     $.ajax({
		url:"leeralumno.php",
	success:function(result){
	//alert(result);
	$("#ndni").html(result);
	 },
	data:{
		 ndni:ndni,
		 nbuscar:nbuscar
	  },
		type:"GET"   
	 } );
	
}
function verhistorial()
 { var n1=$("#n1").val();
   var bdetalle=$("#bdetalle").val();
     $.ajax({
		url:"historiallibro.php",
	success:function(result){
	//alert(result);
	$("#historial").html(result);
	 },
	data:{
		 n1:n1,
		 bdetalle:bdetalle
	  },
		type:"GET"   
	 } );
	
}
function devolver()
 { var n1=$("#n1").val();
 //capturando fecha
				var f2=new Date();
				var d2,m2,hh2,mm2,ss2,mife2;
				hh2=f2.getHours()
				if(hh2<10)
				{hh2="0"+hh2}
				mm2=f2.getMinutes()
				if(mm2<10)
				{mm2="0"+mm2}
				ss2=f2.getSeconds()
				if(ss2<10)
				{ss2="0"+ss2}
				cad1=hh2+":"+mm2+":"+ss2;
				d2= f2.getUTCDate()-1
				m2=f2.getMonth()+1
				if(d2<10)
				{d2="0"+d2}
				if(m2<10)
				{m2="0"+m2}
				mife2=f2.getFullYear()+"-"+(m2)+"-"+(d2);	  
//mihora.innerHTML=cad;
 //
   var fe=mife2;
   var ho=cad1;
   var bdevolver=$("#bdevolver").val();
     $.ajax({
		url:"devolverlibro.php",
	success:function(result){
//	alert(result);
	//$("#historial").html(result);
	$("#n5").val("Disponible");
	 },
	data:{
		 n1:n1,
		 fe:fe,
		 ho:ho,
		 bdevolver:bdevolver
	  },
		type:"GET"   
	 } );
	
}
function addprestamo()
 {
var ndni=$("#ndni").val();//dni
var nnombre=$("#nnombre").val();//usuario
var n1=$("#n1").val();//codlibro
var n4=$("#n4").val();//codinterno
var n2=$("#n2").val();//titulo
var nfecha=$("#nfecha").val();//fechasalida
var nhora=$("#nhora").val();//horasalida
   var bgrabarp=$("#bgrabarp").val();
     $.ajax({
		url:"registrarprestamo.php",
	success:function(result){
	//alert(result);
	$("#n5").html(result);
	 },
	data:{
		 bgrabarp:bgrabarp,
		 ndni:ndni,
		 nnombre:nnombre,
		 n1:n1,
		 n4:n4,
		 n2:n2,
		 nfecha:nfecha,
		 nhora:nhora
	  },
		type:"GET"   
	 } );
	
}
function comprobar()
{
  enviardatos;
	}