<?php
$semestre=0;
if(isset($_REQUEST["semestre"]))
$semestre=$_REQUEST["semestre"];
function verpagosok($semestre)
{$sql="SELECT
pagos.codPago,
pagos.alu_iCodigo,
pagos.sem_iCodigo,
pagos.recibo_path,
pagos.fechaUpload,
pagos.fechaUpdate,
pagos.estado,
pagos.observacion,
pagos.nomConcepto,
pagos.costoConcepto,
pagos.caja,
pagos.fecCre,
alumno.alu_vcCodigo,
alumno.alu_vcDocumento,
concat(alumno.alu_vcPaterno,' ',
alumno.alu_vcMaterno,' ',
alumno.alu_vcNombre) as alumno,
alumno.alu_vcCelular


FROM
pagos
INNER JOIN alumno ON pagos.alu_iCodigo = alumno.alu_iCodigo
where sem_iCodigo='$semestre' and pagos.estado='P'";
$data=DB::select($sql);
return $data;

}

$pagos=verpagosok($semestre);
$n=1;
?>
<style>
      .table{
        color:black;
    }
</style>

<table class="table">
    <thead>
    <tr class='colorcab'>
        <td>NRO</td>
        <td>COD ALU.</td>
        <td>DNI</td>
        <td>ESTUDIANTE</td>
        <td>CONCEPTO</td>
        <td>MONTO</td>
        <td>REVISADO</td>
        <td>COD.CAJA</td>
    </tr>
</thead>
    @foreach ($pagos as $data)
    <tr>
        <td>{{$n++}}</td>
        <td>{{$data->alu_vcCodigo}}</td>
        <td>{{$data->alu_vcDocumento}}</td>
        <td>{{$data->alumno}}</td>
        <td>{{$data->nomConcepto}}</td>
        <td>{{$data->costoConcepto}}</td>
        <td>{{$data->fechaUpdate}}</td>
        <td>{{$data->caja}}</td>
    </tr> 
    @endforeach
    
</table>


