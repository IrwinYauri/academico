@php
//use App\Http\Controllers\AdminController;
//$encuesta=new AdminController();
use App\Models\Encuesta;
use App\Models\Encuesta_categoria;
$listasemestre = Encuesta::select('sem_iCodigo', 'enc_iCodigo')->get();
$listacategoria = Encuesta_categoria::select('enccat_iCodigo', 'enccat_vcNombre')->get();
$semestre = 0;
if (isset($_GET['semestre'])) {
    $semestre = $_GET['semestre'];
}
//$encuestax=$encuesta->verlistaencuestapreguntasemestre($semestre);

function mispreguntas($id)
{
    $preguntas = DB::table('encuesta')
        ->join('encuesta_pregunta', 'encuesta.enc_iCodigo', '=', 'encuesta_pregunta.enc_iCodigo')
        ->join('encuesta_categoria', 'encuesta_pregunta.enccat_iCodigo', '=', 'encuesta_categoria.enccat_iCodigo')
        ->select('encuesta.enc_iCodigo', 'encuesta.enc_vcObservacion', 'encuesta_pregunta.encpre_vcPregunta', 'encuesta_pregunta.encpre_iPuntaje', 'encuesta_pregunta.encpre_iPeso', 'encuesta_categoria.enccat_vcNombre', 'encuesta.sem_iCodigo', 'encuesta_pregunta.encpre_iNumero', 'encuesta_pregunta.encpre_iCodigo')
        ->where('encuesta.sem_iCodigo', '=', $id)
        ->get();
    return $preguntas;
}

$encuestax = mispreguntas($semestre);

@endphp
<div class="container">
    <table class='table table-striped table-hover table-responsive-md table-condensed' id="tablalistapregunta">
        <thead>
            <tr style="background-color: navy; color:white">
                <td>id</td>
                <td>NRO PREGUNTA</td>
                <td style="width: 280px">PREGUNTA</td>
                <td>CATEGORIA</td>
                <td>PESO</td>
                <td>PUNTAJE</td>
                <td>SEMESTRE</td>
                <td>OP</td>
            </tr>

        </thead>
        <tr style="background-color: navy; color:white">
            <td></td>
            <td>
                <input type="text" name="" id="encpre_iNumero" class="form-control  w-20" size="10">
            </td>
            <td><textarea name="" id="encpre_vcPregunta" class="form-control" spellcheck="false"></textarea> </td>
            <td><select name="" id="enccat_iCodigo" class="form-control  w-30">
                    @foreach ($listacategoria as $item)
                        <option value="{{ $item->enccat_iCodigo }}">{{ $item->enccat_vcNombre }}</option>
                    @endforeach
                </select>
            </td>

            <td><input type="text" name="" id="encpre_iPeso" class="form-control" value="1"></td>
            <td>
                <input type="text" name="" id="encpre_iPuntaje" class="form-control" value="4">
            </td>
            <td><select name="enc_iCodigo" id="enc_iCodigo">
                    @foreach ($listasemestre as $item)
                        @if ($item->sem_iCodigo == $semestre)
                            <option value="{{ $item->enc_iCodigo }}" selected>{{ $item->sem_iCodigo }}</option>
                        @endif
                        <option value="{{ $item->enc_iCodigo }}">{{ $item->sem_iCodigo }}</option>
                    @endforeach

                </select>
            </td>
            <td><button class="btn btn-primary btn-sm  btn-block" onclick="registrarpreguntax()"> REGISTRAR</button></td>
        </tr>
        <tbody>
            @foreach ($encuestax as $encu)
                <tr>
                    <td>{{ $encu->encpre_iCodigo }}</td>
                    <td>{{ $encu->encpre_iNumero }}</td>
                    <td>{{ $encu->encpre_vcPregunta }}</td>
                    <td>{{ $encu->enccat_vcNombre }}</td>
                    <td>{{ $encu->encpre_iPeso }}</td>
                    <td>{{ $encu->encpre_iPuntaje }}</td>
                    <td>{{ $semestre }}</td>
                    <td>

                        <button type="button" name="delete" id="" class="delete btn btn-danger btn-sm  btn-block "
                            onclick="eliminarpreguntax('{{ $encu->encpre_iCodigo }}') ">
                            Eliminar </button>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>

    <div id="mimensajex">GRABANDO</div>
    <div id="resultado1"> </div>

</div>
<script>
    //  $("#enc_iCodigo").val("");
    //   $("#enc_iCodigo").val("<?php echo $semestre; ?>");
    //  $("div.id_100 select").val("val2");

    $(document).ready(function() {
        $('#tablalistapregunta').DataTable({
            "pagingType": "full_numbers"
        });
    });


    function registrarpreguntax() {
        $("#resultado1").html("");
        //$("#listacursos").html("...cargando");

        var encpre_iCodigo = $("#encpre_iCodigo").val();
        var enc_iCodigo = $("#enc_iCodigo").val();
        var encpre_iNumero = $("#encpre_iNumero").val();
        var enccat_iCodigo = $("#enccat_iCodigo").val();
        var encpre_vcPregunta = $("#encpre_vcPregunta").val();
        var encpre_iPuntaje = $("#encpre_iPuntaje").val();
        var encpre_iPeso = $("#encpre_iPeso").val();
        // alert(enccat_iCodigo);
        $.ajax({
            url: "encuesta/registrarpreguntaencuesta",
            success: function(result) {
                //     alert(result);

                $("#mimensajex").html(result)
                tt = $("#resultado1").html();
                //   alert($("#resultado1").html());
                if (tt * 1 < 1) {
                    alertagrabarx("Pregunta Registrada", "navy");
                    // $("#modaleditar").modal('show');
                    listaencuestapreguntasemestre($('#xxsemetre').val());
                } else {
                    alert('Ya Existe el numero de pregunta')

                }

                //  listaencuestapreguntasemestre(semestre)
                //  $("#menu3").load('admin/encuestapreguntasemestre');

            },
            data: {
                encpre_iCodigo: encpre_iCodigo,
                enc_iCodigo: enc_iCodigo,
                encpre_iNumero: encpre_iNumero,
                enccat_iCodigo: enccat_iCodigo,
                encpre_vcPregunta: encpre_vcPregunta,
                encpre_iPuntaje: encpre_iPuntaje,
                encpre_iPeso: encpre_iPeso
                //  encuetacategoriadet: n1.toUpperCase()
            },
            type: "GET"
        });


    }

    //////eliminado
    function eliminarpreguntax(id) {
        $("#resultado1").html("");

        $.ajax({
            url: "encuesta/eliminarencuestapreguntas",
            success: function(result) {
                alertagrabarx("PREGUNTA ELIMINADA", "orange");

                listaencuestapreguntasemestre($('#xxsemetre').val());
            },
            data: {
                // encpre_iCodigo: encpre_iCodigo,
                encpre_iCodigo: id

            },
            type: "GET"
        });


    }
</script>

<link rel="stylesheet" href="{{ asset('datatable/css/jquery.dataTables.min.css') }}">
<script src="{{ asset('datatable/js/jquery.dataTables.min.js') }}"></script>


<link rel="stylesheet" href="{{ asset('bootstrap5/css/bootstrap.min.css') }}">
<script src="{{ asset('bootstrap5/js/bootstrap.js') }}"></script>
