@php
namespace App\Http\Controllers;

use App\Models\Docente;

$listadocentes=Docente::select('doc_iCodigo','doc_vcDocumento','doc_vcPaterno','doc_vcMaterno','doc_vcNombre')->get();
@endphp




<table id="tabla-docente1" class="table">
    <thead>
        <tr style="background-color: navy;color:white">
        <td>ID</td>
        <td>DNI</td>
        <td>Apellido Paterno</td>
        <td>Apellido Materno</td>
        <td>Nombres</td>
        <td>foto</td>
        <td>ACCIONES</td>
      </tr>
    </thead>
        <tbody>
            @foreach ($listadocentes as $profe)

         <tr>
            <td>{{ $profe->doc_iCodigo }}</td>
            <td>{{$foto=$profe->doc_vcDocumento }}</td>
            <td>{{$profe->doc_vcPaterno}}</td>
            <td>{{$profe->doc_vcMaterno}}</td>
            <td>{{$profe->doc_vcNombre}}</td>
           
            <td><img src="storage/fotosdocen/{{$foto}}.jpg" alt="" width="50px"></td>
            <td>
            <a name="bclave" id="x1" class="btn btn-primary btn-sm table-condensed" href="#openModal" 
            onclick="verclave('{{ $profe->doc_iCodigo }}','{{ $profe->doc_vcPaterno}} {{$profe->doc_vcMaterno }} {{$profe->doc_vcNombre }}')">Cambiar clave </a>
            <a href="#profile" onclick="nbuscardocente('{{ $profe->doc_iCodigo }}')" 
                        class="btn btn-info btn-sm table-condensed"> Editar </a>
                &nbsp;&nbsp;<button type="button" name="delete" id="'botonelim'"
                onclick="$('#confirmModal').modal('show'); vereliminarx('{{ $profe->doc_iCodigo }}','{{ $profe->doc_vcPaterno}} {{$profe->doc_vcMaterno }} {{$profe->doc_vcNombre }}')"
                 class="delete btn btn-danger btn-sm table-condensed"> Eliminar </button>
            </td>
        </tr>
        @endforeach  
        </tbody>
    </table>


    

<!--  <script src="js/jquery.dataTables.min.js"></script> //-->

<script>
	$(document).ready(function() {
    $('#tabla-docente1').DataTable( {
        "pagingType": "full_numbers"
    } );
} );
	</script>
 



<link rel="stylesheet" href="{{ asset('datatable/css/jquery.dataTables.min.css')}}"> 
<script src="{{ asset('datatable/js/jquery.dataTables.min.js')}}"></script>


<link rel="stylesheet" href="{{ asset('bootstrap5/css/bootstrap.min.css') }}">
<script src="{{ asset('bootstrap5/js/bootstrap.js') }}"></script>






