@php
session_start();
$coddocentex = '';
if (isset($_SESSION['coddocentex'])) {
    $coddocentex = $_SESSION['coddocentex'];
} else {
    echo 'No tiene permiso';
    return 0;
}
$semestreactual = semestreactual();
///-----------
function sqlvercursos($semestre, $coddocente)
{
    $sql =
        'SELECT 
        seccion_horario.doc_iCodigo,
seccion.cur_iCodigo,
seccion.sem_iCodigo,
curso.cur_vcNombre,
curso.cur_iSemestre,
curso.cur_vcCodigo,
seccion.sec_iNumero,
curso.escpla_iCodigo,
escuelaplan.escpla_vcCodigo,
seccion.sec_iCodigo,
escuela.esc_vcNombre
     FROM
     seccion_horario
INNER JOIN seccion ON (seccion_horario.sec_iCodigo = seccion.sec_iCodigo)
INNER JOIN curso ON (seccion.cur_iCodigo = curso.cur_iCodigo)
INNER JOIN escuelaplan ON (curso.escpla_iCodigo = escuelaplan.escpla_iCodigo)
INNER JOIN escuela ON escuelaplan.esc_vcCodigo = escuela.esc_vcCodigo
     WHERE
  `seccion`.`sem_iCodigo` = "' .
        $semestre .
        '" AND 
  `seccion_horario`.`doc_iCodigo` ="' .
        $coddocente .
        '"
  GROUP BY
  seccion_horario.doc_iCodigo,
seccion.cur_iCodigo,
seccion.sem_iCodigo,
curso.cur_vcNombre,
curso.cur_iSemestre,
curso.cur_vcCodigo,
seccion.sec_iNumero,
curso.escpla_iCodigo,
escuelaplan.escpla_vcCodigo,
seccion.sec_iCodigo,
escuela.esc_vcNombre

  order by curso.cur_vcCodigo,curso.cur_iCodigo
  ';
    $data1 = DB::select($sql);
    return $data1;
}
function totalalumno($semestre, $seccion)
{
    $sql =
        'SELECT
count(
matricula.alu_iCodigo) as total
FROM
seccion
INNER JOIN matriculadetalle ON matriculadetalle.sec_iCodigo = seccion.sec_iCodigo
INNER JOIN matricula ON matriculadetalle.mat_iCodigo = matricula.mat_iCodigo
where seccion.sem_iCodigo="' .
        $semestre .
        '" and seccion.sec_iCodigo="' .
        $seccion .
        '"
';
    $data1 = DB::select($sql);
    //  return $data1;
    return $data1[0]->total;
}
$miscursosgrupo = sqlvercursos($semestreactual, $coddocentex);
//dd($miscursosgrupo);
@endphp

<div class="card shadow mb-4">
  <div class="card-header py-3" style="background-color:navy)">
    <h6 class="m-0 font-weight-bold text-dark-400">
       <i class="fa fa-calendar fa-2x" ></i> COMPLETAR ASISTENCIA
      </h6>
   </div>

  
    <div class="card-body " style="overflow: scroll;">
      <table class="table table-striped">
        <thead>
          <tr style="background-color: #0d8dc0;color:white">
              <td></td>
              <td>COD-CURSO</td>
              <td>CURSO</td>
              <td>SECCION</td>
              <td>PLAN </td>
              <td> ES</td>
      
              <td>ALUMNOS</td>
            </thead>
          </tr>
      
      
          @php
              $nn = 0;
              //    dd($miscursos);
              //$milistadata
              //foreach($miscursos as $listacur)
          @endphp
          @foreach ($miscursosgrupo as $listacur)
              @php
                  $nn++;
              @endphp
              <tr>
                  <td><button type="button" class="btn btn-info" onclick="mostrarcursox('{{ $coddocentex }}',
                                '{{ $semestreactual }}','{{ $listacur->cur_iCodigo }}'
                                ,'{{ $listacur->cur_vcNombre }}','{{ $listacur->esc_vcNombre }}')">COMPLETAR
                      </button>
                  </td>
                  <td> {{ $listacur->cur_vcCodigo }} </td>
                  <td> {{ $listacur->cur_vcNombre }} </td>
                  <td> {{ $listacur->sec_iNumero }}</td>
                  <td>{{ $listacur->escpla_vcCodigo }}</td>
                  <td>{{ left($listacur->cur_vcCodigo, 2) }}</td>
                  <td>{{ totalalumno($semestreactual, $listacur->sec_iCodigo) }}</td>
      
              </tr>
      
      
              </td>
              </tr>
          @endforeach
      
      </table>
      </div>
</div>
      
      
      <script>
          function mostrarcursox(coddocente, semestre, codcurso, curso, escuela) {
           //alert(4)
           //$("#micontenido").load('docente/registronotascurso2');
           $("#micontenido").html(
             "<img src='img/cargar.gif'>"
           );
            $.ajax({
                  url: "docente/completarasistenciacurso2",
                  success: function(result) {
                   //   alert(result)
                      // $("#modaleditar").modal('show');
                       $("#micontenido").html(result);
      
                  },
                  data: {
                    xcod:codcurso, 
                    coddocente:coddocente,
            sem:semestre, 
            codcurso:codcurso, 
            curso:curso, 
            escuela:escuela
                  },
                  type: "GET"
              });
      
         /*   $coddocentex = 51;
      $sem = 20212;
      $codcurso = 2;
      $escuela = 'AN';
      $curso = 'mate';
      
      $vernotas = sqlverregistronotas($coddocentex, $sem, $codcurso, $curso);*/
          }
      </script>
      <link rel="stylesheet" href="{{ asset('datatable/css/jquery.dataTables.min.css') }}">
      <script src="{{ asset('datatable/js/jquery.dataTables.min.js') }}"></script>
      
      
      <link rel="stylesheet" href="{{ asset('bootstrap5/css/bootstrap.min.css') }}">
      <script src="{{ asset('bootstrap5/js/bootstrap.js') }}"></script>