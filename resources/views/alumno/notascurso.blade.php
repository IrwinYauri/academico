@php
    session_start(); 
    $codalumno="";
if(isset($_SESSION['alumnox'])){
   $codalumno=$_SESSION['codalumnox'];
 
}
$semestreactual=semestreactual(); 

function sqlvercursosalu($semestre, $codalu)
{
    $sql =
        "SELECT
matricula.alu_iCodigo,
matriculadetalle.sec_iCodigo,
seccion.cur_iCodigo,
curso.cur_iCodigo,
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
<div class="container">
<div class="card mb-4">
    <div class="card-header bg-primary text-white">
        CONSULTA DE NOTAS
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
                  
                </tr>
              
                @php
                    $nn=1;
                @endphp
                @foreach ($cursos as $data)
                 <tr>
                    <td>{{$nn++}}</td>
                    <td>{{$data->cur_vcCodigo}}</td>
                    <td>{{$xcurso=$xcurso=$data->cur_vcNombre}}</td>
                    <td>{{nroromano($data->cur_iSemestre)}}</td>
                    <td>{{$data->cur_fCredito}}</td>
                    <td>
                        <a type="button" class="btn btn-primary"
                        href="#" 
                        onclick="vernotasx('{{$codalumno}}','{{$semestreactual}}','{{$data->cur_iCodigo}}','{{$xcurso}}','escuela')">
                        CONSULTAR NOTAS</a>
                    </td>
                  
                </tr>
                @endforeach
            </table>
        
    </div>
</div>

<!---  inicio de modal //-->
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog  modal-xl" >
  
    <div class="modal-content">
        <div class="modal-header" style="background-color: navy;color:white;">
            <h5 class="modal-title" id="exampleModalLabel">CONSULTA DE NOTAS</h5>
            <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close"
                onclick="$('#confirmModal').modal('hide');">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body" id="misnotas">
             <div  id="misnotas">

             </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal"
                onclick="$('#confirmModal').modal('hide');">SALIR</button>
            
        </div>
    </div>
</div>
</div>
<!-- Modal cursos -->
</div>

<script>
  function vernotasx(codalumno,semestre,codcurso,curso,escuela)
  {$("#confirmModal").modal("show");
  $("#misnotas").html(
       "<img src='img/cargar.gif'>"
     );

        $.ajax({
           url: "alumno/notascursodetalle",
        
            success: function(result) {
             //   alert(result)
                // $("#modaleditar").modal('show');
                 $("#misnotas").html(result);

            },
            data: {
              codalumno:codalumno,
            sem:semestre,
    codcurso:codcurso,
    curso:curso,
    escuela:escuela
    
            },
            type: "GET"
        });
  }
  </script>