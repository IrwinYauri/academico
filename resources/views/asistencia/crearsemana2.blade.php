@php

/////------
use App\Http\Controllers\DocenteController; 
  use App\Http\Controllers\AsistenciaController ;
  $mihoras=new DocenteController();
    $asistencias=new AsistenciaController();

    function veralumnomatriculados($codcur,$semestre,$codhora,$diax)
 {$miasistencia=new DocenteController(); 
  $asistencias=new AsistenciaController();
   echo "<table class='table table-striped table-responsive table-condensed'>
  <thead>     <tr style='background-color:black;color:white;'>
    <td>Nro</td> <td>Codigo</td> <td>Nombre</td>
    <td>ESTADO</td>
    ";
    
  echo "</tr>
      </thead>";
   $misalumnos=$miasistencia->vercursosalumnos(trim($codcur),$semestre);
//dd($misalumnos);
$nro=0;
    foreach ($misalumnos as $alumno) {
      $nro++;
      $codidalumno=$alumno->alu_iCodigo;
      $cod=$alumno->alu_vcCodigo;
      $estudiante=$alumno->alumno;
      $email=$alumno->alu_vcEmail;
    $x=$asistencias->crearasistenciasemana($codhora,$codidalumno);
     echo "<tr style='color:black'>
          <td>$nro</td>
          <td>$cod</td>
         <td>$estudiante</td>
         <td>Presente</td>
         <td>$codhora</td>
          ";
          //crearasistenciasemana($codhora,$codalumno);
       //   verasis1($alumno->alu_iCodigo,$alumno->sec_iCodigo,1,16,$diax);
          //verasis1($alumno->alu_iCodigo,$alumno->sec_iCodigo,1,16,"LUN");
      /*  for($x=1;$x<=16;$x++)
        { echo '<td><input type="text" name="" id="" size="2">
             </td>';
            }
          echo "</tr>";*/
          echo "</tr>";
    }
echo "</table>";


} 
//veralumnomatriculados($codcur,$semestre,$fila,$diax)



//$rtp=$asistencias->verasistenciacurso($codcurso,$semestre,$dia)
//$codcur,$semana,$dia
$codcur="";
$semana="";
$dia="";
if(isset($_GET["codcur"]) && isset($_GET["semana"]) && isset($_GET["dia"]))
 { $codcur=$_GET["codcur"];
   $semana=$_GET["semana"];
   $dia=$_GET["dia"];
}
else {
  return 0;
}

$rtp=$asistencias->verasistenciacurso($codcur,semestreactual(),$dia,$semana);


$codhora="";
$total="";
$fecha1="";
foreach ($rtp as $data) {
  $codhora=$data->sechorasi_iCodigo;
  $fecha1=$data->sechorasi_dFecha;
  echo $codhora;
  echo "<br>".$fecha1;
}
$rtp1=$asistencias->contarasistenciacurso($codhora);

foreach ($rtp1 as $data) {
  $total=$data->total;
}

if($total*1>0)
{ echo "<br>Ya cuenta con registros";
}
else {
  echo  "<br>NO CONTIENE ASISTENCIA";
  //veralumnomatriculados($codcur,$semestre,$codhora,$diax)
  veralumnomatriculados($codcur,semestreactual(),$codhora,$dia);
}
//dd($rtp);
//dd($rtp1);
@endphp

