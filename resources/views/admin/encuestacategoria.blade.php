@php

use App\Models\Encuesta_categoria;


$encuestax=Encuesta_categoria::all();
@endphp
<h3>LISTA DE CATEGORIA</h3>
<table class='table table-striped table-hover table-responsive-md table-condensed'>
    <thead>
    <tr style="background-color: navy; color:white">
        <td>id</td>
        <td>DETALLE</td>
        <td>OPERACIONES</td>
    </tr>
    <tr style="background-color: navy; color:white">
        <td></td>
        <td><input type="text" name="encuetacategoriadet" id="encuetacategoriadet" class="form-control"></td>
        <td><button class="btn btn-primary btn-sm  btn-block" id="btbcategoria" onclick="registrarencuestacategoria()"> Registrar</button></td>
    </tr>
</thead>
    @foreach ($encuestax as $encu)
    <tr>
        <td>{{ $encu->enccat_iCodigo }}</td>
        <td>{{ $encu->enccat_vcNombre }}</td>
        
        <td>
            <a href="javascript:void(0)" onclick="" class="btn btn-info btn-sm  "> Editar </a>
             <button type="button" name="bdelete" id="btneliminar" class="delete btn btn-danger btn-sm "
              onclick="eliminarencuestacategoria('{{ $encu->enccat_iCodigo }}')"> Eliminar </button>
        </td>
    </tr>
    @endforeach  
</table>

<div id="mimensajex">GRABANDO</div>

<script>
      function registrarencuestacategoria() {
//alert(5)
var n1=$("#encuetacategoriadet").val();
$.ajax({
    url: "encuesta/registrarcategoriaencuesta",
    success: function(result) {
     //     alert(result);
      
     alertagrabarx("CATEGORIA REGISTRADA","navy"); 
       // $("#modaleditar").modal('show');

        $("#menu3").load('admin/encuestacategoria');

    },
    data: {
        encuetacategoriadet: n1.toUpperCase()
    },
    type: "GET"
});


}
function eliminarencuestacategoria(id) {

var n1=id;
$.ajax({
    url: "encuesta/eliminarcategoriaencuesta",
    success: function(result) {
     //     alert(result);
     alertagrabarx("CATEGORIA ELIMINADA","orange"); 
       // $("#modaleditar").modal('show');

        $("#menu3").load('admin/encuestacategoria');

    },
    data: {
        enccat_iCodigo: n1
    },
    type: "GET"
});


}
</script>

<link rel="stylesheet" href="{{ asset('datatable/css/jquery.dataTables.min.css') }}">
<script src="{{ asset('datatable/js/jquery.dataTables.min.js') }}"></script>


<link rel="stylesheet" href="{{ asset('bootstrap5/css/bootstrap.min.css') }}">
<script src="{{ asset('bootstrap5/js/bootstrap.js') }}"></script>

