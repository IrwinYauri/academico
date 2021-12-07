@php
 session_start();
 
$codalumno = '';
if (isset($_SESSION['alumnox'])) {
    $codalumno = $_SESSION['codalumnox'];
}
$semestreactual = semestreactual();

function datosalumno($codalumno)
{$sql="SELECT
alumno.alu_iCodigo,
alumno.alu_vcCodigo,
alumno.alu_vcDocumento,
alumno.alu_vcPaterno,
alumno.alu_vcMaterno,
alumno.alu_vcNombre,
alumno.escpla_iCodigo,

alumno.alu_vcTelefono,
alumno.alu_vcCelular,
alumno.alu_vcEmail,
alumno.alu_vcEmail_alt,
escuelaplan.escpla_vcRR,
escuela.esc_vcNombre
FROM
alumno
INNER JOIN escuelaplan ON alumno.escpla_iCodigo = escuelaplan.escpla_iCodigo
INNER JOIN escuela ON escuelaplan.esc_vcCodigo = escuela.esc_vcCodigo
where alumno.alu_iCodigo='$codalumno'";
$data=DB::select($sql);
return $data;
}
$veralumno= datosalumno($codalumno);
$dni="";
$paterno="";
$materno="";
$nombre="";
$categoria="";
$clase="";
$departamento="";
$correo1="";
$correo2="";
$cell="";
$tef="";
foreach ($veralumno as $valumno) {
    $dni=$valumno->alu_vcDocumento;
    $paterno= $valumno->alu_vcPaterno;
    $materno=$valumno->alu_vcMaterno;
    $nombre=$valumno->alu_vcNombre;
    $escuela=$valumno->esc_vcNombre;
    $plan=$valumno->escpla_vcRR;
      $correo1=$valumno->alu_vcEmail;
$correo2=$valumno->alu_vcEmail_alt;
$cell=$valumno->alu_vcCelular;
$tef=$valumno->alu_vcTelefono;
}
@endphp
<style>
    .table td,th{
color:black;
text-transform: uppercase;
    }
    .titulo1
    {background-color:lightgray;
    }
</style>
<div class="card mb-4">
<div class="card-header text-black" style="text-transform: uppercase;">
    <i class="fas fa-list-alt fa-2x " style="color: black"></i> DATOS DEL ESTUDIANTE
</div>
<div class="card-body">
<div style="overflow: scroll;">                               
<table class="table table-striped table-bordered table-sm " cellspacing="0"
   id="dataTable"   >
   <thead>
<tr>
<td colspan="4" style='background-color:navy;color:white;'>1:DATOS GENERALES</td>
</tr>

<tr>
<td class='titulo1'>Documento</td>
<td>{{$dni}}</td>
<td class='titulo1'>Nombres</td>
<td>{{$nombre}}</td>
</tr>
<tr>
<td class='titulo1'>Apellido Paterno</td>
<td>{{$paterno}}</td>
<td class='titulo1'>Apellido Materno</td>
<td>{{$materno}}</td>
</tr>
<tr>
<td colspan="4" class='titulo1' style='background-color:navy;color:white;'>2:Clasificacion</td>

</tr>
<tr>
<td class='titulo1'>Escuela</td>
<td colspan="2">{{$escuela}}</td>
<td rowspan="2">  {{fotoalumno($dni,6);}}</td>
</tr>
<tr>
<td class='titulo1'>Plan</td>
<td colspan="2">{{$plan}}</td>

</tr>

<tr>
<td colspan="4" style='background-color:navy;color:white;'>3: Datos de Contacto</td>
</tr>
<tr>
<td class='titulo1'>Telefono Fijo</td>
<td><input type="text" name="tefx" id="tefx"  value="{{$tef}}"></td>
<td class='titulo1'>Telefono Celular</td>
<td><input type="text" name="cellx" id="cellx"   value="{{$cell}}"></td>
</tr>
<tr>
<td class='titulo1'>Email</td>
<td><input type="text" name="correo1x" id="correo1x" value="{{$correo1}}"></td>
<td class='titulo1'>email 2</td>
<td><input type="text" name="correo2x" id="correo2x" value="{{$correo2}}"></td>
</tr>
<tr>
<td colspan="4" >
<button type="button" class="btn btn-primary " onclick="modificar('{{$codalumno}}','correo1x','correo2x','cellx','tefx')"> 
    <i class="fas fa-check"></i>ACTUALIZAR</button></td>

</tr>
</thead>
</tbody>
</table>
</div>
</div>
</div>

<div id="mimensajex">GRABANDO</div>
<script>
    function modificar(xcod0,correo10,correo20,cell0,tef0)
    {xcod=xcod0;
     correo1=document.getElementById(correo10).value;
     correo2=document.getElementById(correo20).value;
     cell=document.getElementById(cell0).value;
     tef=document.getElementById(tef0).value;

        updatealumnocorreo(xcod,correo1,correo2,cell,tef);
    }

    function updatealumnocorreo(xcod,correo1,correo2,cell,tef)//activado
 { //var n1=3;
  // var bbuscar=$("#bbuscar").val();
     $.ajax({
		url:"alumno/updatealumnocorreo",
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
</script>
@php
   // dd($verdocente);
@endphp
