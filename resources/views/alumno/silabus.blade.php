@php
 session_start(); 
    $codalumno="";
if(isset($_SESSION['alumnox'])){
   $codalumno=$_SESSION['codalumnox'];
 
}
$semestreactual=semestreactual();
function silabusfilenombre($semestre,$codcurso)
   {
    $r="#";
    $sql="select 
    *
    FROM silabusfile where
    sem_iCodigo='$semestre' and cur_iCodigo='$codcurso'
    ";
    $data1=DB::select($sql);
   
    if(isset($data1[0]->archivo))
    $r="storage/".$data1[0]->archivo;
    return $r;
   
   }
   function estadosilasbufile($semestre,$codcurso)
   {

      // return $alumno;
      $t=0;
        $sql="select 
        count(cur_iCodigo) as total
        FROM silabusfile where
        sem_iCodigo='$semestre' and cur_iCodigo='$codcurso'
        ";
        $data1=DB::select($sql);
        if(isset($data1[0]->total))
        $t=$data1[0]->total;
        if($t>0)
        return '<span class="badge badge-pill badge-success" style="font-size: 13px;">DISPONIBLE</span>';
        else
        return '<span class="badge badge-pill badge-danger" style="font-size: 13px;">PENDIENTE</span>';
   }
    function sqlvercursosalu($semestre, $codalu)
{
    $sql =
        "SELECT
matricula.alu_iCodigo,
matriculadetalle.sec_iCodigo,
seccion.cur_iCodigo,
curso.cur_vcCodigo,
curso.cur_vcNombre,
curso.cur_fCredito,
seccion.sem_iCodigo,
curso.cur_iSemestre

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

$cursos=sqlvercursosalu($semestreactual, $codalumno);
@endphp
<style>
   .table{
       color: black;
   }
</style>

<div class="card mb-4">
    <div class="card-header bg-primary text-white">
        SILABUS DE ASIGNATURAS
    </div>
    <div class="card-body">
       

            <h5>SEMESTRE ACADEMICO {{left($semestreactual,4)}}-{{right($semestreactual,1)}}</h5>
            <table class="table table-striped table-bordered table-sm " cellspacing="0" id="dataTable">
                <tr style="color:white;background-color:black;">
                    <td>N°</td>
                    <td>Cod.Curso</td>
                    <td>Curso</td>
                    <td>Sem.</td>
                    <td>Cred.</td>
                    <td>OPERACION</td>
                    <td>ESTADO</td>
                </tr>
              
                @php
                    $nn=1;
                @endphp
                @foreach ($cursos as $data)
                 <tr>
                    <td>{{$nn++}}</td>
                    <td>{{$data->cur_vcCodigo}}</td>
                    <td>{{$data->cur_vcNombre}}</td>
                    <td>{{nroromano($data->cur_iSemestre)}}</td>
                    <td>{{$data->cur_fCredito}}</td>
                    <td>
                        <a type="button" class="btn btn-primary"
                        href="{{silabusfilenombre($semestreactual,$data->cur_iCodigo)}}" target="_BLANK"
                        >Descargar</a>
                    </td>
                    <td>
                       @php
                     echo estadosilasbufile($semestreactual,$data->cur_iCodigo);
                       @endphp
                     
                    </td>
                </tr>
                @endforeach
            </table>
        
    </div>
</div>

