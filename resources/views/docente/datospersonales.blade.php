@php
 session_start();
 $coddocentex="";
 if(isset($_SESSION['coddocentex'])){
  $coddocentex=$_SESSION['coddocentex'];
 }

use App\Http\Controllers\DocenteController; 
$datodoc=new DocenteController();
$verdocente=$datodoc->verdatosdocente($coddocentex);
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
foreach ($verdocente as $vdocente) {
    $dni=$vdocente->doc_vcDocumento;
    $paterno= $vdocente->doc_vcPaterno;
    $materno=$vdocente->doc_vcMaterno;
    $nombre=$vdocente->doc_vcNombre;
    $categoria=$vdocente->doccat_vcNombre;
    $clase=$vdocente->doccla_vcNombre;
    $departamento=$vdocente->depaca_vcNombre;
    $correo1=$vdocente->doc_vcEmail1;
$correo2=$vdocente->doc_vcEmail2;
$cell=$vdocente->doc_vcTelefonoCelular;
$tef=$vdocente->doc_vcTelefonoFijo;
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
    <i class="fas fa-list-alt fa-2x " style="color: black"></i> Datos del docente
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
<td class='titulo1'>Categoria</td>
<td colspan="2">{{$categoria}}</td>
<td rowspan="3">  {{fotodocente($dni,6);}}</td>
</tr>
<tr>
<td class='titulo1'>Clase</td>
<td colspan="2">{{$clase}}</td>

</tr>
<tr>
<td class='titulo1'>Dep Academico</td>
<td colspan="2">{{$departamento}}</td>
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
<button type="button" class="btn btn-primary " onclick="modificar('{{$coddocentex}}','correo1x','correo2x','cellx','tefx')"> 
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

        updatedocentecorreo(xcod,correo1,correo2,cell,tef);
    }
</script>
@php
   // dd($verdocente);
@endphp
