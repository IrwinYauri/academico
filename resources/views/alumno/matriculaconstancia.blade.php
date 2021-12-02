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
$cursos = sqlvercursosalu($semestreactual, $codalumno);
$alumno = datosalumno($codalumno);
//dd($alumno);
@endphp
<style>
    .table {
        color: black;
    }

</style>
<div class="card mb-4">
    <div class="card-header bg-primary text-white">
        CONSTANCIA DE MATRICULA  <a href="#" onclick="printDiv('imprimir')" class="btn btn-dark">IMPRIMIR</a>
    </div>
    <div class="card-body" id="imprimir">
       
            <h5>
                <table class="table table-bordered table-sm " cellspacing="0">
                    <tr>
                        <td><img src=" {{ asset('img/escudo.png') }}" alt="" width="100"> </td>
                        <td><img src="http://app2.unaat.edu.pe/alumno/fotos/1_{{ $alumno[0]->alu_vcDocumento }}.jpg"
                                alt="" width="100"></td>
                    </tr>
                    <tr>
                        <td>FICHA DE MATRICULA</td>
                        <td>{{ $dni=$alumno[0]->alu_vcDocumento }}</td>
                    </tr>
                </table>
            </h5>
            <table class="table table-striped table-bordered table-sm border border-dark " cellspacing="0" id="dataTable">
                <tr>
                    <td>codigo:{{ $alumno[0]->alu_vcCodigo }}</td>
                    <td>Escuela Profesional:{{ $alumno[0]->esc_vcNombre }}</td>
                </tr>
                <tr>
                    <td>Ape. y Nombre:{{ $alumno[0]->alu_vcPaterno }} {{ $alumno[0]->alu_vcMaterno }}
                        {{ $alumno[0]->alu_vcNombre }}</td>
                    <td>Plan:RR-{{ $alumno[0]->escpla_vcCodigo }}</td>
                </tr>
            </table>
            <h2>SEMESTRES {{ left($semestreactual, 4) }}-{{ right($semestreactual, 1) }}</h2>
            <table class="table table-striped table-bordered table-sm " cellspacing="0" id="dataTable">
                <tr>
                    <td>N°</td>
                    <td>Cod.Curso</td>
                    <td>Sec.</td>
                    <td>Asignatura</td>
                    <td>Sem.</td>
                    <td>Cred.</td>

                </tr>
                @php
                    $nn = 1;
                @endphp
                @foreach ($cursos as $data)
                    <tr>
                        <td>{{ $nn++ }}</td>
                        <td>{{ $data->cur_vcCodigo }}</td>
                        <td>{{ $data->sec_iNumero }}</td>
                        <td>{{ $data->cur_vcNombre }}</td>
                        <td>{{ $data->cur_iSemestre }}</td>
                        <td>{{ $data->cur_fCredito }}</td>


                    </tr>
                @endforeach

            </table>
            
           <center>
            @php
            $dnif=$dni."-".$semestreactual."matricula";
               echo "<img src='phpqrcode/mibarra2.php?numero=$dnif' width='120'>";
            @endphp
            </center>
        
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
