<?php
function vermatriculados($semestre)
{$sql="select               
aa.alu_vcCodigo, 
 concat_ws( ' ', aa.alu_vcPaterno, aa.alu_vcMaterno, aa.alu_vcNombre ) as alu_vcNombres
,aa.alu_vcDOcumento,ep.escpla_vcCodigo,ep.escpla_vcRR,
ee.esc_vcCodigo,   ee.esc_vcNombre,(select sum(c.cur_fCredito)   
  from matriculadetalle md join seccion s 
on md.sec_iCodigo = s.sec_iCodigo                  
join curso c on s.cur_iCodigo = c.cur_iCodigo  
where md.mat_iCodigo = m.mat_iCodigo) as cur_fCreditos from matricula as m   
 join alumno as aa  on aa.alu_iCodigo = m.alu_iCodigo
 join escuelaplan as ep  on aa.escpla_iCodigo = ep.escpla_iCodigo  
 join escuela ee on ep.esc_vcCodigo = ee.esc_vcCodigo   
  where      m.sem_iCodigo = '$semestre'    
order by ee.esc_vcNombre, ep.escpla_vcRR,  concat_ws( ' ', aa.alu_vcPaterno, aa.alu_vcMaterno, aa.alu_vcNombre )";
$data=DB::select($sql);
return $data;
}
$semestre='20212';
$matriculados=vermatriculados($semestre);
$n=0;
?>
<style>
    .colorcab
    {color:white;
    background-color: navy;}
  
</style>
<table class="table">
    <thead>
 <tr class="colorcab">
    <td>NRO</td>
    <td>CODIGO</td>
    <td>DNI</td>
    <td>APELLIDOS Y NOMBRES</td>
    <td>EP</td>
    <td>CREDITOS</td>
</tr>
</thead>
@foreach ($matriculados as $data)
<?php    
$n++;
?>
<tr >
        <td>{{$n}}</td>
        <td>{{$data->alu_vcCodigo}}</td>
        <td>{{$data->alu_vcDOcumento}}</td>
        <td>{{$data->alu_vcNombres}}</td>
        <td>{{$data->esc_vcCodigo}}</td>
        <td>{{$data->cur_fCreditos}}</td>
    </tr>
@endforeach
</table>