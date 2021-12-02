@php
$codcurso = '';
$semestre = '';
$horax = '';
$tema = '';

if ($_REQUEST['tema']) {
  $tema = $_REQUEST['tema'];
}

if ($_REQUEST['codcurso']) {
    $codcurso = $_REQUEST['codcurso'];
}
if ($_REQUEST['semestre']) {
    $semestre = $_REQUEST['semestre'];
}
if ($_REQUEST['horax']) {
    $horax = $_REQUEST['horax'];
}

if (strlen($codcurso) < 1 && strlen($semestre) < 1 && strlen($horax) < 1) {
    return 0;
}

$sql = "SELECT
                     (select count(*)
              from seccion_horarioalumno where seccion_horarioalumno.sechorasi_iCodigo= 
              seccion_horarioasistencia.sechorasi_iCodigo) as asis
FROM
seccion_horario
INNER JOIN seccion_horarioasistencia ON (seccion_horario.sechor_iCodigo = seccion_horarioasistencia.sechor_iCodigo)
INNER JOIN seccion ON (seccion_horario.sec_iCodigo = seccion.sec_iCodigo)
WHERE
          seccion_horarioasistencia.sechorasi_iCodigo='$horax'";
$data1 = DB::select($sql); //calcular si hay registros
$tt = $data1[0]->asis;
if ($tt < 1) {
    $sql = "insert into seccion_horarioalumno(sechorasi_iCodigo,alu_iCodigo)
SELECT
'$horax' as horax,matricula.alu_iCodigo
FROM
seccion
INNER JOIN matriculadetalle ON matriculadetalle.sec_iCodigo = seccion.sec_iCodigo
INNER JOIN matricula ON matriculadetalle.mat_iCodigo = matricula.mat_iCodigo
WHERE seccion.cur_iCodigo='$codcurso' and seccion.sem_iCodigo='$semestre'";
    $data1 = DB::select($sql);
}
//actualizando tema
$sql = "update seccion_horarioasistencia set
       seccion_horarioasistencia.sechorasi_vcTema='$tema'
where  seccion_horarioasistencia.sechorasi_iCodigo='$horax'";
$data1 = DB::select($sql);
@endphp
