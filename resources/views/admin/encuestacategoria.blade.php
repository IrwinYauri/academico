@php
use App\Http\Controllers\AdminController; 
$encuesta=new AdminController();
$encuestax=$encuesta->verlistaencuestacategoria();
@endphp
<h3>LISTA CATEGORIA</h3>
<table class='table table-striped table-hover table-responsive-md table-condensed'>
    <thead>
    <tr style="background-color: navy; color:white">
        <td>id</td>
        <td>DETALLE</td>
        <td>OP</td>
    </tr>
</thead>
    @foreach ($encuestax as $encu)
    <tr>
        <td>{{ $encu->enccat_iCodigo }}</td>
        <td>{{ $encu->enccat_vcNombre }}</td>
        
        <td>
            <a href="javascript:void(0)" onclick="activarsemestre('{{$encu->enccat_iCodigo}}'); " class="btn btn-success btn-sm table-condensed "> ACTIVAR</a>
            <a href="javascript:void(0)" onclick="editarAnimal('.$animales->id.')" class="btn btn-info btn-sm table-condensed "> Editar </a>
              &nbsp;&nbsp;<button type="button" name="delete" id="'.$animales->id.'" class="delete btn btn-danger btn-sm table-condensed "> Eliminar </button>
        </td>
    </tr>
    @endforeach  
</table>