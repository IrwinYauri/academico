@php
session_start();
 $coddocentex="";
 if(isset($_SESSION['coddocentex'])){
  $coddocentex=$_SESSION['coddocentex'];
 }

 use App\Http\Controllers\DocenteController; 
 $docente=new DocenteController();  
$listacur=$docente->verrecord( $coddocentex);
$semestre=$docente->verrecordgrupo( $coddocentex);
$docentex=$docente->verprofe($coddocentex);

$datodoc=new DocenteController();
$verdocente=$datodoc->verdatosdocente($coddocentex);
$dni="";
foreach ($verdocente as $vdocente) {
    $dni=$vdocente->doc_vcDocumento;
}

@endphp

    <div class="row">
   <!-- Border Left Utilities -->
            <h3>  Record Académico </h3>
                
                             @foreach ($docentex as $profe)
                                 <table>
                                     <tr>
                                         <td>
                                             @php
                                            echo "DOCENTE:".$profe->doc_vcPaterno." ".$profe->doc_vcMaterno." ".$profe->doc_vcNombre ;
                                            echo "<br>DNI:".$profe->doc_vcDocumento;
                                             @endphp
                                            
                                         </td>
                                         
                                         <td> <!--   fotodocente($dni,6); //-->
                                             </td>
                                           
                                     </tr>
                                 </table>
                             @endforeach
                               
                    </div>
               


<div class="row">
 
    @foreach ($semestre as $sem)
<div class="card-header">
Semestre: {{ left($sem->sem_iCodigo,4) }}-{{ right($sem->sem_iCodigo,1) }}
</div>
<div class="card-body">
<div style="overflow: scroll;">                               
<table class="table table-striped table-bordered table-sm text-dark" cellspacing="0"
   id="dataTable"   >
<thead>
<tr style='background-color:navy;color:white;'>
<td>#</td>
<td>codigo</td>
<td>curso</td>
<td>EP</td>
<td>Escuela</td>
</tr>
</thead>
<tbody>
@php
    $n=1;
@endphp
@foreach ($listacur as $cursos)
@if ($cursos->sem_iCodigo==$sem->sem_iCodigo)
<tr>
    <td>{{$n++}}</td>
    <td>{{$cursos->cur_vcCodigo}}</td>
    <td>{{$cursos->cur_vcNombre}}</td>
    <td>{{left($cursos->cur_vcCodigo,2)}}</td>
    <td>{{$cursos->escuela}}</td>
    </tr>  
@endif

@endforeach

</tbody>
</table>

</div>
</div>

@endforeach
</div>