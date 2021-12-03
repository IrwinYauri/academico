@php
session_start();
$codalumno = '';
if (isset($_SESSION['alumnox'])) {
    $codalumno = $_SESSION['codalumnox'];
}

$semestreactual = semestreactual();

function queciclo($codalumno, $semestre)
{
    $sql = "select quesemestreesta('$codalumno','$semestre') as ciclo";
    $data = DB::select($sql);
    return $data[0]->ciclo;
}
function calcularponderado($semestre, $codalumno, $escuela, $ciclo)
{
    $sql = "SELECT 
sum(r.prom * c.cur_fCredito)/sum(c.cur_fCredito) as rn 
FROM 
registroeval as r 
inner join matriculadetalle as md on r.matdet_iCodigo=md.matdet_iCodigo 
inner join matricula as m on md.mat_iCodigo=m.mat_iCodigo 
inner join alumno as a on m.alu_iCodigo=a.alu_iCodigo 
inner join escuelaplan as ep on a.escpla_iCodigo=ep.escpla_iCodigo 
inner join escuela as e on ep.esc_vcCodigo=e.esc_vcCodigo 
inner join seccion as s on md.sec_iCodigo = s.sec_iCodigo 
inner join curso as c on s.cur_iCodigo=c.cur_iCodigo 
where e.esc_vcCodigo='$escuela' and m.sem_iCodigo='$semestre' 
and quesemestreesta(a.alu_vcCodigo,m.sem_iCodigo) in('$ciclo') 
and a.alu_iCodigo = '$codalumno' and c.cur_iCodigo NOT IN(131,189)";
    $data = DB::select($sql);
    return $data[0]->rn;
}

function datosalumno($codalumno)
{
    $sql = "SELECT
alumno.alu_iCodigo,
alumno.alu_vcCodigo,
alumno.alu_vcDocumento,
alumno.alu_vcPaterno,
alumno.alu_vcMaterno,
alumno.alu_vcNombre,
alumno.escpla_iCodigo,
escuelaplan.escpla_vcCodigo,
escuela.esc_vcNombre
FROM
alumno
INNER JOIN escuelaplan ON alumno.escpla_iCodigo = escuelaplan.escpla_iCodigo
INNER JOIN escuela ON escuelaplan.esc_vcCodigo = escuela.esc_vcCodigo
WHERE alumno.alu_iCodigo='$codalumno'";
    $data = DB::select($sql);
    return $data;
}
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
seccion.sec_iNumero
FROM
matricula
INNER JOIN matriculadetalle ON matriculadetalle.mat_iCodigo = matricula.mat_iCodigo
INNER JOIN seccion ON matriculadetalle.sec_iCodigo = seccion.sec_iCodigo
INNER JOIN curso ON seccion.cur_iCodigo = curso.cur_iCodigo
WHERE matricula.alu_iCodigo='$codalu' AND
seccion.sem_iCodigo='$semestre'";
    $data1 = DB::select($sql);
    return $data1;
}

$cursos = sqlvercursosalu($semestreactual, $codalumno);
$alumno = datosalumno($codalumno);
//dd($alumno);
$miciclo = queciclo($alumno[0]->alu_vcCodigo, $semestreactual);
$miprome = calcularponderado($semestreactual, $codalumno, $alumno[0]->escpla_vcCodigo, $miciclo);
$xn = 0;
foreach ($cursos as $data) {
    $cur['curso'][] = $data->cur_vcNombre;
    $cur['nota'][] = 10;
    $xn++;
}
@endphp

<style>
    .table {
        color: black;
    }
    .micolor{
      background-color: cadetblue;
    }

</style>
<div class="row">
    <div class="col-md-12 text-right text-black">
        <a href="#" onclick="printDiv('imprimir')" class="btn btn-primary">IMPRIMIR</a>
    </div>
</div>
<div id="imprimir">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                ALUMNO
            </h6>
        </div>
        <div class="card-body">

            <table class="table table-bordered  border-dark table-sm " cellspacing="0" id="dataTable">
                <tr>
                    <td class="micolor">codigo:</td><td>{{ $alumno[0]->alu_vcCodigo }}</td>
                    <td class="micolor">Escuela Profesional:</td><td>{{ $alumno[0]->esc_vcNombre }}</td>
                </tr>
                <tr>
                    <td class="micolor">Ape. y Nombre:</td><td>{{ $alumno[0]->alu_vcPaterno }} {{ $alumno[0]->alu_vcMaterno }}
                        {{ $alumno[0]->alu_vcNombre }}</td>
                    <td class="micolor">Plan:</td><td>RR-{{ $alumno[0]->escpla_vcCodigo }}</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                PROMEDIO PONDERADO</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $miprome }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                CREDITOS ACUMULADOS</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">25</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                CICLO ACTUAL</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ nroromano($miciclo) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }
</script>
