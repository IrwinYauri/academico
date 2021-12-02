@php
//namespace App\Http\Controllers;
//use App\Http\Controllers\AdminController;
//$encuesta=new AdminController();
//$encuestax=$encuesta->verlistaencuesta();

use App\Models\Semestre;
use App\Models\Encuesta;

$semestre = Semestre::select('sem_iCodigo')->get();
$encuestax = Encuesta::all();
@endphp

<h3>LISTA DE ENCUESTAS</h3>
<table class='table table-striped table-hover table-responsive-md table-condensed' border="1">
    <thead>
        <tr style="background-color: navy; color:white;">
            <td>Semestre</td>
            <td>Puntaje</td>
            <td>Detalle</td>
            <td>ESTADO</td>
            <td>OP</td>
        </tr>
        <tr style="background-color:navy;">
            <td><select name="sem_iCodigo" id="sem_iCodigo">
                    @foreach ($semestre as $item)
                        <option>{{ $item->sem_iCodigo }}</option>
                    @endforeach

                </select>

            </td>
            <td><input type="text" name="enc_iPuntaje" id="enc_iPuntaje" class="form-control"></td>
            <td><textarea name="enc_vcObservacion" id="enc_vcObservacion" spellcheck="false"
                    class="form-control"></textarea></td>
            <td><input type="text" name="enc_cActivo" id="enc_cActivo" value="N" disabled class="form-control"></td>
            <td><button type="button" name="" id="" class="btn btn-primary"
                    onclick="registrarencuesta()">REGISTRAR</button></td>
        </tr>

    </thead>
    <tbody>
        @foreach ($encuestax as $encu)
            <tr>
                <td>{{ $encu->sem_iCodigo }}</td>
                <td>{{ $encu->enc_iPuntaje }}</td>
                <td>{{ $encu->enc_vcObservacion }}</td>
               
                  @if($encu->enc_cActivo=='S')
                   <td><span class="badge badge-pill badge-info" style="font-size: 11px;">
                        {{ $encu->enc_cActivo }}</span></td>   
                 @else
                    <td>{{ $encu->enc_cActivo }}</td>   
                 @endif
               
                

                <td>
                    <a href="javascript:void(0)" onclick="activarencuesta('{{ $encu->sem_iCodigo }}'); "
                        class="btn btn-success btn-sm  btn-block"> ACTIVAR</a>
                    <a href="javascript:void(0)" onclick="editarAnimal('.$animales->id.')"
                        class="btn btn-primary btn-sm  btn-block"> MODIFICAR </a>
                    <button type="button" name="delete" id="'.$animales->id.'"
                        class="delete btn btn-danger btn-sm btn-block " onclick="eliminarencuesta('{{ $encu->sem_iCodigo }}')"> Eliminar </button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div id="mimensajex">GRABANDO</div>

<script>
  

     function registrarencuesta() {


var sem_iCodigo = $("#sem_iCodigo").val();
var enc_iPuntaje = $("#enc_iPuntaje").val();
var enc_cActivo = $("#enc_cActivo").val();
var enc_vcObservacion = $("#enc_vcObservacion").val();
$.ajax({
    url: "encuesta/nuevaencuesta",
    success: function(result) {
        //       alert(result);

        alertagrabarx("ENCUESTA REGISTRADA", "navy");
        // $("#modaleditar").modal('show');

        $("#home").load('admin/encuestalista');

    },
    data: {
        sem_iCodigo: sem_iCodigo,
        enc_iPuntaje: enc_iPuntaje,
        enc_cActivo: enc_cActivo,
        enc_vcObservacion: enc_vcObservacion
    },
    type: "GET"
});

}

    function eliminarencuesta(codigo) {


        var sem_iCodigo = codigo;

        $.ajax({
            url: "encuesta/eliminarencuesta",
            success: function(result) {
                //       alert(result);

                alertagrabarx("ENCUESTA ELIMINADA", "orange");
                // $("#modaleditar").modal('show');
                $("#home").load('admin/encuestalista');

            },
            data: {
                sem_iCodigo: sem_iCodigo

            },
            type: "GET"
        });

    }

    function activarencuesta(codigo) {


var sem_iCodigo = codigo;

$.ajax({
    url: "encuesta/activarencuesta",
    success: function(result) {
        //       alert(result);

        alertagrabarx("ENCUESTA ACTIVADA", "purple");
        // $("#modaleditar").modal('show');
        $("#home").load('admin/encuestalista');

    },
    data: {
        sem_iCodigo: sem_iCodigo

    },
    type: "GET"
});

}
</script>
