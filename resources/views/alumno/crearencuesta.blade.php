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
docente.doc_iCodigo,
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
function buscarcodmatriculacurso($semestre,$codalumno,$codcurso)
{$sql="SELECT

matriculadetalle.matdet_iCodigo
FROM
alumno
INNER JOIN matricula ON matricula.alu_iCodigo = alumno.alu_iCodigo
INNER JOIN matriculadetalle ON matriculadetalle.mat_iCodigo = matricula.mat_iCodigo
INNER JOIN seccion ON matriculadetalle.sec_iCodigo = seccion.sec_iCodigo
where alumno.alu_iCodigo='$codalumno' and matricula.sem_iCodigo='$semestre'
and seccion.cur_iCodigo='$codcurso'
";
$data1=DB::select($sql);
    if( isset($data1[0]->matdet_iCodigo))
    return $data1[0]->matdet_iCodigo;
    else {
        return 0;
    }

}
function estadoencuesta($codmatricurso)
{$sql="SELECT
encuesta_horario.enchor_cActivo
FROM
encuesta_horario where
encuesta_horario.matdet_iCodigo='$codmatricurso'";

$data1=DB::select($sql);

$estado="Pendiente";
    if( isset($data1[0]->enchor_cActivo))
    {   if($data1[0]->enchor_cActivo=='S')
        $estado="Sin terminar";
        if($data1[0]->enchor_cActivo=='N')
        $estado="Completado";
    }
    
    return $estado;
   
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
                    <?php
                    $matcurso=buscarcodmatriculacurso($semestreactual,$codalumno,$data->cur_iCodigo);
                    $estadoencu=estadoencuesta($matcurso);
                     if($estadoencu=='Pendiente')
                    $estado="<span class='badge badge-pill badge-danger' style='font-size: 16px;'>Pendiente</span>";

                    if($estadoencu=='Sin terminar')
                    $estado="<span class='badge badge-pill badge-info' style='font-size: 16px;'>Sin terminar</span>";

                    if($estadoencu=="Completado")
                    $estado="<span class='badge badge-pill badge-success' style='font-size: 16px;'>Completado</span>";
                    ?>

                    <td>{{ $nn++ }}</td>
                    <td>{{ $data->cur_vcCodigo }}</td>
                    <td>{{ $data->cur_vcNombre }}</td>
                    <td>{{ nroromano($data->cur_iSemestre) }}</td>
                    <td>{{ $data->cur_fCredito }}</td>
                    <td rowspan="2">
                        <a type="button" class="btn btn-primary" href="#"
                        onclick="preguntas('{{  $data->cur_iCodigo }}','{{ $data->cur_vcNombre }}','{{ $data->cur_vcCodigo }}','{{$matcurso}}','{{$estadoencu}}','{{$data->doc_iCodigo}}')">ENCUESTAR</a>
                    </td>
                   
                    <td rowspan="2">
                     
                    
                     <?php
                    echo  $estado;
                     ?>
                
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
    function preguntas(codcurso,curso,codcursobas,codmatricurso,estado,coddocente) {
      /*  $("#micontenido").html(
            "<img src='img/cargar.gif'>"
        ); */
       // dire="docente/crearnotascurso?xcod="+coddocente+"&sem="+sem+"&codcurso="+codcurso+"&escuela="+escuela+"&curso="+curso
       // alert(dire)
       // $("#micontenido").load(dire);
            if(estado=="Pendiente")
                {   $("#micontenido").html(
                    "<img src='img/cargar.gif'>"
                                );

                        $.ajax({
                        url: "alumno/encuestalista",
                        
                            success: function(result) {
                            //   alert(result)
                                // $("#modaleditar").modal('show');
                                $("#micontenido").html(result);

                            },
                            data: {
                                codcurso:codcurso,
                                curso:curso,
                                codcursobas:codcursobas,
                                codmatricurso:codmatricurso,
                                coddocente:coddocente,
                                semestre:'{{$semestreactual}}',
                                codalumno:'{{$codalumno}}'
                            },
                            type: "GET"
                        });
                }else
                {//alert(estado)
                    alert('ENCUESTA DEL CURSO COMPLETADO')}
    }
</script>
