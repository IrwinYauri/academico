<?php
$semestre='0';
if(isset($_REQUEST["semestre"]))
$semestre=$_REQUEST["semestre"];

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
$n=0;
$matriculados=vermatriculados($semestre);
?> 
<table class="table" id="tmatriculados">
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
<link rel="stylesheet" href="{{ asset('datatable/css/jquery.dataTables.min.css') }}">
<script src="{{ asset('datatable/js/jquery.dataTables.min.js') }}"></script> 
<!--script type="text/javascript" src="../js/datatable.js"></script-->

<script type="text/javascript">
    
    $('#tmatriculados').DataTable({
        "columnDefs": [{
            "targets": 0
        }],
        language: {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ resultados",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando resultados _START_-_END_ de  _TOTAL_",
            "sInfoEmpty": "Mostrando resultados del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
        }
    });

    </script>
    <link rel="stylesheet" href="{{ asset('bootstrap5/css/bootstrap.min.css') }}">
    <script src="{{ asset('bootstrap5/js/bootstrap.js') }}"></script>