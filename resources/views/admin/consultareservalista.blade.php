<?php
$semestre='';
$escuela='';
if(isset($_REQUEST["semestre"]))
$semestre=$_REQUEST["semestre"];

if(isset($_REQUEST["escuela"]))
$escuela=$_REQUEST["escuela"];

function consultareserva($semestre,$carrera)
{$sql="select *, 
       concat(a.alu_vcPaterno, a.alu_vcMaterno, a.alu_vcNombre ) 
       as alu_vcNombres 
       from alumno a join 
       alumno_condicionhistorico ach 
       on ach.alu_iCodigo = a.alu_iCodigo and ach.sem_iCodigo = 20212 
       join alumno_condicion 
       ac on 
       ac.alucon_iCodigo = ach.alucon_iCodigo 
       join escuelaplan ep 
       on a.escpla_iCodigo = ep.escpla_iCodigo 
       join escuela e 
       on e.esc_vcCodigo = ep.esc_vcCodigo 
       where ac.alucon_vcNombre = 'RESERVA' and ep.esc_vcCodigo like '$carrera%'";
       $data=DB::select($sql);
       return $data;
}

$reserva= consultareserva($semestre,$escuela);
$n=0;
?>
<div class="container">
    <table class="table">
        <thead>
        <tr class="colorcab">
        <td>NRO</td>
        <td>CODIGO</td>
        <td>APELLIDOS Y NOMBRES</td>
        <td>EP</td>
        <td>RESOLUCION</td>
    </thead>
    </tr>
    <tbody>
@foreach ($reserva as $data)
<?php
$n++;
    ?>
    <tr>
        <td>{{$n}}</td>
        <td>{{$data->alu_vcCodigo}}</td>
        <td>{{$data->alu_vcPaterno}} {{$data->alu_vcMaterno}} {{$data->alu_vcNombre}}</td>
        <td>{{$data->esc_vcCodigo}}</td>
        <td>{{$data->aluconhis_vcResolucion}}</td>
    </tr>

    @endforeach
    @if($n==0)
        <tr>
            <td colspan="5"> NO CONTIENE RETIRADOS</td>
        </tr>
    @endif
</tbody>
    </table>

</div>