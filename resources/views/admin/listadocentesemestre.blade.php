@php
use App\Http\Controllers\AdminController; 
$listadocente=new AdminController();
$semestre=0;
if(isset($_REQUEST["semestre"]))
$semestre=$_REQUEST["semestre"];

$listadocentes=$listadocente->listadocentesemestre(semestreactual());
//dd($listadocentes);
@endphp
<h3>Lista de docentes del semestre actual</h3>
<table id="tabla-docentesemestre" class="table table-hover table-condensed">
<thead>
    <td>nro</td>
    <td>DNI</td>
    <td>PATERNO</td>
    <td>MATERNO</td>
    <td>NOMBRE</td>
  
</thead>
<tbody>
    @php
        $n=1;
    @endphp
    
@foreach ($listadocentes as $salon)

<tr>
    <td>{{ $n++ }}</td>
    <td>{{ $salon->doc_vcDocumento }}</td>
    <td>{{ $salon->doc_vcPaterno }}</td>
    <td>{{$salon->doc_vcMaterno}}</td>
    <td>{{$salon->doc_vcNombre}}</td>
    
  
   </tr>
@endforeach  
</tbody>
</table>

<script>
    $(document).ready(function() {
   
   $('#tabla-docentesemestre').DataTable();
} );
 
  
</script>