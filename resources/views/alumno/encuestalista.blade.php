@php
//use App\Http\Controllers\AdminController;
//$encuesta=new AdminController();
$codcurso='';
$curso='';
$codcursobas='';
$codmatricurso='';
$coddocente='';
$semestre='';

if(isset($_REQUEST["codcurso"]))
{$codcurso=$_REQUEST["codcurso"]; }

if(isset($_REQUEST["curso"]))
{$curso=$_REQUEST["curso"]; }

if(isset($_REQUEST["codcursobas"]))
{$codcursobas=$_REQUEST["codcursobas"]; }

if(isset($_REQUEST["codmatricurso"]))
{$codmatricurso=$_REQUEST["codmatricurso"]; }

if(isset($_REQUEST["coddocente"]))
{$coddocente=$_REQUEST["coddocente"]; }

if(isset($_REQUEST["semestre"]))
{$semestre=$_REQUEST["semestre"]; }

if(isset($_REQUEST["codalumno"]))
{$codalumno=$_REQUEST["codalumno"]; }

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
$semestreactual=$semestre;
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
    <div id="row " >
     <div class="col-md-12 text-right bg-primary text-white">
        CODIGO:{{$codcursobas}}<br>
        CURSO:{{$curso}}
       </div>
       
    </div>
    <div class="card">
    @php
        echo $nencuesta[0]->enc_vcObservacion;
        $codencuesta=$nencuesta[0]->enc_iCodigo;
    @endphp
    </div>
    <form action="alumno/encuestalistagrabar" method="GET" id="formencuesta">
    <div class="col-md-12 text-right bg-dark text-white">

        <input type="text" id="codmatricurso" name="codmatricurso" value="{{$codmatricurso}}" style="display: none;">
        <input type="text" id="codcurso" name="codcurso" value="{{$codcurso}}" style="display: none;">
        <input type="text" id="coddocente" name="coddocente" value="{{$coddocente}}" style="display: none;">
        <input type="text" id="semestre" name="semestre" value="{{$semestre}}" style="display: none;">
        <input type="text" id="codalumno" name="codalumno" value="{{$codalumno}}" style="display: none;">
      

        <a href="#" class="btn btn-primary" onclick="verificar()">
            <i class="fas fa-save" aria-hidden="true"></i>
            GRABAR ENCUESTA</a>
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
                    <td><input type="text" name="pcod{{$n}}" value="{{ $codpre=$encu->encpre_iCodigo }}" style="display: none;"></td>
                    <td style="display: none;">{{ $encu->encpre_iNumero }}</td>
                    <td>{{ $encu->encpre_vcPregunta }}</td>
                    
                    <td style="display: none;">{{ $encu->encpre_iPeso }}</td>
                    <td style="display: none;">{{ $encu->encpre_iPuntaje }}</td>
                    <td style="display: none;">{{ $semestreactual }}</td>
                    
                    </tr>
             <tr>
             
                    <td colspan="6" align="right">
                     
                      
                        <button type="button"  class="btn btn-dark btn-sm  "
                            onclick="marcarpregunta('{{$n}}','Por mejorar','1')">
                            Por mejorar </button>&nbsp; &nbsp;
                            <button type="button"  class=" btn btn-primary btn-sm   "
                            onclick=" marcarpregunta('{{$n}}','Regular','2')">
                            Regular</button>&nbsp;&nbsp;
                            <button type="button"  class=" btn btn-dark btn-sm   "
                            onclick="marcarpregunta('{{$n}}','Bueno','3') ">
                            Bueno </button>&nbsp;&nbsp;
                            <button type="button"  class=" btn btn-primary btn-sm  "
                            onclick="marcarpregunta('{{$n}}','Muy bueno','4')">
                            Muy bueno </button>&nbsp;&nbsp;&nbsp;
                            <label for="">RESPUESTA</label> 
                            <input type="text" name="t{{$n}}" id="t{{$n}}" value=""  style="background-color:  #fbf7c0;" readonly required>
                            <input type="hidden" name="rt{{$n}}" id="rt{{$n}}" value=""  style="background-color:  #fbf7c0;" readonly  required>
                      
                    
                    </td>
                </tr>
                @endif   
            @endforeach
            @endforeach
            <input type="hidden" name="ntotal" id="ntotal" value={{$n}}>
        </tbody>
    </table>
 </form>
    <div id="row " >
        <div class="col-md-12 text-right bg-dark text-white">
            <a href="#" class="btn btn-primary" onclick="verificar()">
                <i class="fas fa-save" aria-hidden="true"></i>
                GRABAR ENCUESTA</a>
        </div>

    <div id="mimensajex">GRABANDO</div>
    <div id="resultado1"> </div>

</div>
<script>
    function verificar()
    { estado=0
        for(n=1;n<={{$n}};n++)
       { //rp=$("#rt").val();
       rp=""
       rp2=""
         rp=rp.concat("rt",n)//valor pregunta
         rp2=rp2.concat("t",n)
       //  alert(rp)
       elem=document.getElementById(rp);
       elem2=document.getElementById(rp2);
       elem2.style.backgroundColor = "white";
                if(elem.value<1)
                {  estado++
                    elem2.style.backgroundColor = "red";}
        }
        if(estado<1)
        {alert("GRABANDO ENCUESTA")
        document.getElementById("formencuesta").submit();    
        }
        else
        alert("TE FALTAN REPONDER:"+estado)
    }
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
