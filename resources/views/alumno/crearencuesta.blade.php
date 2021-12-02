@php
session_start();
$codalumno = '';
if (isset($_SESSION['alumnox'])) {
    $codalumno = $_SESSION['codalumnox'];
}
$semestreactual = semestreactual();
function sqlvercursosalu($semestre, $codalu)
{
    $sql = "SELECT
matricula.alu_iCodigo,
matriculadetalle.sec_iCodigo,
seccion.cur_iCodigo,
curso.cur_vcCodigo,
curso.cur_vcNombre,
curso.cur_fCredito,
seccion.sem_iCodigo,
curso.cur_iSemestre,
docente.doc_vcPaterno,
docente.doc_vcMaterno,
docente.doc_vcNombre
FROM
matricula
INNER JOIN matriculadetalle ON matriculadetalle.mat_iCodigo = matricula.mat_iCodigo
INNER JOIN seccion ON matriculadetalle.sec_iCodigo = seccion.sec_iCodigo
INNER JOIN curso ON seccion.cur_iCodigo = curso.cur_iCodigo
INNER JOIN docente ON seccion.doc_iCodigo = docente.doc_iCodigo
WHERE matricula.alu_iCodigo='$codalu' AND
seccion.sem_iCodigo='$semestre'";
    $data1 = DB::select($sql);
    return $data1;
}
$cursos = sqlvercursosalu($semestreactual, $codalumno);
@endphp
<style>
    .table {
        color: black;
    }

</style>
<div class="card mb-4">
    <div class="card-header bg-primary text-white">
      <i class="fa fa-id-card fa-2x" ></i>
  ENCUESTA DE VALORACIÓN DEL DESEMPEÑO DOCENTE {{left($semestreactual,4)}}-{{right($semestreactual,1)}}
    </div>
    <div class="card-body">

        <table class="table table-striped table-bordered table-sm " cellspacing="0" id="dataTable">
            <thead>
                <tr style="background-color: navy;color:white;">
                    <td>NRO</td>
                    <td>codigo</td>
                    <td>Curso</td>
                    <td>Ciclo</td>
                    <td>Creditos</td>
                    <td>OPERACION</td>
                    <td>Estado</td>
                </tr>
            </thead>

            @php
                $nn = 1;
            @endphp
            @foreach ($cursos as $data)
                <tr>
                    <td>{{ $nn++ }}</td>
                    <td>{{ $data->cur_vcCodigo }}</td>
                    <td>{{ $data->cur_vcNombre }}</td>
                    <td>{{ nroromano($data->cur_iSemestre) }}</td>
                    <td>{{ $data->cur_fCredito }}</td>
                    <td rowspan="2">
                        <a type="button" class="btn btn-primary" href="#"
                        onclick="preguntas()">ENCUESTAR</a>
                    </td>
                    <td rowspan="2">
                     <span class="badge badge-pill badge-warning" style="font-size: 13px;">  
                     Pendiente
                     </span>
                  </td>

                </tr>
                <tr>
                    <td colspan="5">
                     <i class="fas fa-user-tie fa-2x"></i> DOCENTE: {{ $data->doc_vcPaterno }} {{ $data->doc_vcMaterno }} {{ $data->doc_vcNombre }}
                    </td>
                </tr>
            @endforeach
        </table>


    </div>
</div>

<script>
    function preguntas() {
      /*  $("#micontenido").html(
            "<img src='img/carga01.gif'>"
        ); */
       // dire="docente/crearnotascurso?xcod="+coddocente+"&sem="+sem+"&codcurso="+codcurso+"&escuela="+escuela+"&curso="+curso
       // alert(dire)
       // $("#micontenido").load(dire);
       $("#micontenido").html(
       "<img src='img/carga01.gif'>"
     );

        $.ajax({
           url: "alumno/encuestalista",
        
            success: function(result) {
             //   alert(result)
                // $("#modaleditar").modal('show');
                 $("#micontenido").html(result);

            },
            data: {
            
            },
            type: "GET"
        });

    }
</script>
