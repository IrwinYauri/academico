@php
//use App\Http\Controllers\AdminController;
//$encuesta=new AdminController();
use App\Models\Encuesta;
use App\Models\Encuesta_categoria;
$listasemestre = Encuesta::select('sem_iCodigo', 'enc_iCodigo')->get();
$listacategoria = Encuesta_categoria::select('enccat_iCodigo', 'enccat_vcNombre')->get();

//$encuestax=$encuesta->verlistaencuestapreguntasemestre($semestre);
function listarcategoria($semestre)
{$sql="SELECT
encuesta_pregunta.enccat_iCodigo,
encuesta_categoria.enccat_vcNombre
FROM
encuesta
INNER JOIN encuesta_pregunta ON encuesta_pregunta.enc_iCodigo = encuesta.enc_iCodigo
INNER JOIN encuesta_categoria ON encuesta_pregunta.enccat_iCodigo = encuesta_categoria.enccat_iCodigo
where encuesta.sem_iCodigo='$semestre'
group by encuesta_pregunta.enccat_iCodigo,encuesta_categoria.enccat_vcNombre";
$data1=DB::select($sql);
return $data1;
}
function tituloescuesta($semestre)
{$sql="SELECT
encuesta.enc_vcObservacion,
encuesta.enc_iCodigo

from encuesta
where encuesta.sem_iCodigo='$semestre'";
$data1=DB::select($sql);
return $data1;

}
function mispreguntas($id)
{
    $preguntas = DB::table('encuesta')
        ->join('encuesta_pregunta', 'encuesta.enc_iCodigo', '=', 'encuesta_pregunta.enc_iCodigo')
        ->join('encuesta_categoria', 'encuesta_pregunta.enccat_iCodigo', '=', 'encuesta_categoria.enccat_iCodigo')
        ->select('encuesta.enc_iCodigo', 'encuesta.enc_vcObservacion', 'encuesta_pregunta.encpre_vcPregunta','encuesta_pregunta.enccat_iCodigo', 'encuesta_pregunta.encpre_iPuntaje', 'encuesta_pregunta.encpre_iPeso', 'encuesta_categoria.enccat_vcNombre', 'encuesta.sem_iCodigo', 'encuesta_pregunta.encpre_iNumero', 'encuesta_pregunta.encpre_iCodigo')
        ->where('encuesta.sem_iCodigo', '=', $id)
        ->get();
    return $preguntas;
}

//$encuestax = mispreguntas($semestre);
$semestreactual=semestreactual();
$nencuesta=tituloescuesta($semestreactual);
$categoria=listarcategoria($semestreactual);
$encuestax = mispreguntas($semestreactual);

@endphp
<style>
    h2,li{
        font-size:18px !important;
        color: navy;
    }
    h4{
        color: maroon;
    }
  
</style>
<div class="container">
    <div class="card">
    @php
        echo $nencuesta[0]->enc_vcObservacion;
        $codencuesta=$nencuesta[0]->enc_iCodigo;
    @endphp
    </div>
    <h3>Lista de Preguntas</h3>
    <table class='table  table-responsive-md table-condensed' id="tablalistapregunta">
    
       
        <tbody>
            @php
                $n=0;
            @endphp
            @foreach($categoria as $cate)
            <tr><td colspan="4">
                <span class="badge badge-pill badge-dark" style="font-size: 13px;">  CATEGORIA: </span> {{$cate->enccat_vcNombre}}
            </td></tr>
            @foreach ($encuestax as $encu)
           
             @if($cate->enccat_iCodigo==$encu->enccat_iCodigo)
                 
             @php
             $n++;
         @endphp
                <tr>
                    <td><div class="btn btn-primary btn-circle" style="background-color: indigo; border-color:white" disabled>{{ $n }} </div></td>
                    <td>{{ $encu->encpre_iCodigo }}</td>
                    <td>{{ $encu->encpre_iNumero }}</td>
                    <td>{{ $encu->encpre_vcPregunta }}</td>
                    
                    <td>{{ $encu->encpre_iPeso }}</td>
                    <td>{{ $encu->encpre_iPuntaje }}</td>
                    <td>{{ $semestreactual }}</td>
                    
                    </tr>
             <tr>
             
                    <td colspan="6" align="right">
                     
                      
                        <button type="button"  class="btn btn-danger btn-sm  "
                            onclick="marcarpregunta('{{$n}}','Por mejorar','1')">
                            Por mejorar </button>
                            <button type="button"  class=" btn btn-info btn-sm   "
                            onclick=" marcarpregunta('{{$n}}','Regular','2')">
                            Regular</button>
                            <button type="button"  class=" btn btn-primary btn-sm   "
                            onclick="marcarpregunta('{{$n}}','Bueno','3') ">
                            Bueno </button>
                            <button type="button"  class=" btn btn-success btn-sm  "
                            onclick="marcarpregunta('{{$n}}','Muy bueno','4')">
                            Muy bueno </button>
                            <label for="">RESPUESTA</label> 
                            <input type="text" name="t{{$n}}" id="t{{$n}}" value=""  style="background-color:  #fbf7c0;" disabled>
                            <input type="hidden" name="rt{{$n}}" id="rt{{$n}}" value=""  style="background-color:  #fbf7c0;" disabled >
                      
                    
                    </td>
                </tr>
                @endif   
            @endforeach
            @endforeach
        </tbody>
    </table>

    <div id="mimensajex">GRABANDO</div>
    <div id="resultado1"> </div>

</div>
<script>
    //  $("#enc_iCodigo").val("");
    //   $("#enc_iCodigo").val("<?php echo $semestreactual; ?>");
    //  $("div.id_100 select").val("val2");
    function marcarpregunta(control,punto,valor) {
        r1="t"+control.toString();
        r2="rt"+control.toString();
       // alert(r1)
        //alert(punto)
        document.getElementById(r1).value = punto; 
        document.getElementById(r2).value = valor; 

       // document.getElementById(r2).value=valor;
     

    }
    

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
   
</script>


<link rel="stylesheet" href="{{ asset('bootstrap5/css/bootstrap.min.css') }}">
<script src="{{ asset('bootstrap5/js/bootstrap.js') }}"></script>
