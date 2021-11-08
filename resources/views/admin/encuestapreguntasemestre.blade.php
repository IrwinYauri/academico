@php
use App\Http\Controllers\AdminController; 
$encuesta=new AdminController();
$semestre=0;
if(isset($_GET["semestre"]))
$semestre=$_GET["semestre"];
$encuestax=$encuesta->verlistaencuestapreguntasemestre($semestre);
@endphp

<table class='table table-striped table-hover table-responsive-md table-condensed'>
    <thead>
    <tr style="background-color: navy; color:white">
        <td>id</td>
        <td>NRO PREGUNTA</td>
        <td>PREGUNTA</td>
        <td>CATEGORIA</td>
        <td>PESO</td>
    </tr>
</thead>
    @foreach ($encuestax as $encu)
    <tr>
        <td>{{ $encu->encpre_iCodigo }}</td>
        <td>{{ $encu->encpre_iNumero }}</td>
        <td>{{ $encu->encpre_vcPregunta }}</td>
        <td>{{ $encu->encpre_vcPregunta }}</td>
        <td>{{ $encu->encpre_iPeso }}</td>
      <td>
            <a href="javascript:void(0)" onclick="activarsemestre('{{$encu->encpre_iCodigo}}'); " class="btn btn-success btn-sm table-condensed "> ACTIVAR</a>
            <a href="javascript:void(0)" onclick="editarAnimal('.$animales->id.')" class="btn btn-info btn-sm table-condensed "> Editar </a>
              &nbsp;&nbsp;<button type="button" name="delete" id="'.$animales->id.'" class="delete btn btn-danger btn-sm table-condensed "> Eliminar </button>
        </td>    
        
    </tr>
    @endforeach  
</table>