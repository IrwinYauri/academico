@php
session_start();
$codalumno = '';
if (isset($_SESSION['codalumnox'])) {
  $codalumno = $_SESSION['codalumnox'];
}
$semestreactual=semestreactual();
function cursosolocod($codalumno, $semestre)
{$sql="SELECT

curso.cur_vcCodigo

FROM
matricula
INNER JOIN matriculadetalle ON matriculadetalle.mat_iCodigo = matricula.mat_iCodigo
INNER JOIN seccion ON matriculadetalle.sec_iCodigo = seccion.sec_iCodigo
INNER JOIN curso ON seccion.cur_iCodigo = curso.cur_iCodigo
WHERE matricula.alu_iCodigo='$codalumno' and
seccion.sem_iCodigo='$semestre'
";
$data1 = DB::select($sql);
    return $data1;
}
function verhora($codalumno, $semestre)
{
    $sql = "SELECT
curso.cur_vcCodigo,
seccion_horario.sectip_cCodigo,
seccion_horario.sechor_iHoraInicio,
seccion_horario.sechor_iHoraFinal,
seccion_horario.dia_vcCodigo,
curso.cur_vcNombre,
seccion_horario.doc_iCodigo,
(SELECT
concat(
docente.doc_vcPaterno,' ',
docente.doc_vcMaterno,' ',
docente.doc_vcNombre) 
FROM
docente
where docente.doc_iCodigo=seccion_horario.doc_iCodigo
) as docente
FROM
matricula
INNER JOIN matriculadetalle ON matriculadetalle.mat_iCodigo = matricula.mat_iCodigo
INNER JOIN seccion ON matriculadetalle.sec_iCodigo = seccion.sec_iCodigo
INNER JOIN seccion_horario ON seccion_horario.sec_iCodigo = seccion.sec_iCodigo
INNER JOIN curso ON seccion.cur_iCodigo = curso.cur_iCodigo
WHERE matricula.alu_iCodigo='$codalumno' AND
seccion.sem_iCodigo='$semestre'
order by seccion_horario.dia_vcCodigo,seccion_horario.sechor_iHoraInicio
";
    $data1 = DB::select($sql);
    return $data1;
}
$color=array("#E3FF00","#FF00FF","#e1b0f9 ","#FFBF00","#0096d2","#00FF99","#d2f0f9","#ee9480","#e5cff3","#d1d3d6");
$nnc=0;
$pintar=cursosolocod($codalumno, $semestreactual);
foreach ($pintar as $data) {
  $ncolor["$data->cur_vcCodigo"]=$color[$nnc];
  $nnc++;
  if($nnc>=10)
  $nnc=0;
}

$horario = verhora($codalumno , $semestreactual);
//dd($horario);
$dlu = 0;
$dma = 0;
$dmi = 0;
$dju = 0;
$dvi = 0;
foreach ($horario as $data) {
    if ($data->dia_vcCodigo == 'LUN') {
        $curso['LUN'][] = $data->cur_vcNombre;
        $docente['LUN'][] = $data->docente;
        $dictado['LUN'][] = $data->sectip_cCodigo;
        $hinicio['LUN'][] = $data->sechor_iHoraInicio . '-' . $data->sechor_iHoraFinal;
        $colorcurso['LUN'][]=$data->cur_vcCodigo ;
        $dlu++;
    }
    if ($data->dia_vcCodigo == 'MAR') {
        $curso['MAR'][] = $data->cur_vcNombre;
        $docente['MAR'][] = $data->docente;
        $dictado['MAR'][] = $data->sectip_cCodigo;
        $hinicio['MAR'][] = $data->sechor_iHoraInicio . '-' . $data->sechor_iHoraFinal;
        $colorcurso['MAR'][]=$data->cur_vcCodigo ;
        $dma++;
    }
    if ($data->dia_vcCodigo == 'MIE') {
        $curso['MIE'][] = $data->cur_vcNombre;
        $docente['MIE'][] = $data->docente;
        $dictado['MIE'][] = $data->sectip_cCodigo;
        $hinicio['MIE'][] = $data->sechor_iHoraInicio . '-' . $data->sechor_iHoraFinal;
        $colorcurso['MIE'][]=$data->cur_vcCodigo ;
        $dmi++;
    }
    if ($data->dia_vcCodigo == 'JUE') {
        $curso['JUE'][] = $data->cur_vcNombre;
        $docente['JUE'][] = $data->docente;
        $dictado['JUE'][] = $data->sectip_cCodigo;
        $hinicio['JUE'][] = $data->sechor_iHoraInicio . '-' . $data->sechor_iHoraFinal;
        $colorcurso['JUE'][]=$data->cur_vcCodigo ;
        $dju++;
    }
    if ($data->dia_vcCodigo == 'VIE') {
        $curso['VIE'][] = $data->cur_vcNombre;
        $docente['VIE'][] = $data->docente;
        $dictado['VIE'][] = $data->sectip_cCodigo;
        $hinicio['VIE'][] = $data->sechor_iHoraInicio . '-' . $data->sechor_iHoraFinal;
        $colorcurso['VIE'][]=$data->cur_vcCodigo ;
        $dvi++;
    }
}
@endphp

<style>
  .table {
    color:black;
  }
</style>




<head>
    <title>Horarios</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>

<style>
    .table-condensed {
        font-size: 10px;
        color: black;
    }

</style>


<div class="card shadow mb-4">
    <div class="card-header py-3" style="background-color:navy)">
        <h6 class="m-0 font-weight-bold text-dark-400">
            <i class="fa fa-calendar fa-2x"></i> HORARIO DE CLASES {{left($semestreactual,4)}}-{{right($semestreactual,1)}}
            <a href="#" onclick="printDiv('imprimir')" class="btn btn-dark">IMPRIMIR</a>
        </h6>
    </div>


    <div class="card-body " id="imprimir" >
      <table class="table border border-dark">
        <tr style="background-color: navy;color:white;">
            <td>LUNES</td>
            <td>MARTES</td>
            <td>MIERCOLES</td>
            <td>JUEVES</td>
            <td>VIERNES</td>
        </tr>
        <tr>
            <td class="border border-dark">
                @php
                    for ($x = 0; $x < $dlu; $x++) {
                      $coolor=$colorcurso['LUN'][$x];
                      $ppcolor=$ncolor["$coolor"];
                      echo "<div style='background-color:$ppcolor;'>";
                        echo $curso['LUN'][$x] . '<br>';
                        echo $docente['LUN'][$x] . '<br>';
                        if ($dictado['LUN'][$x] == 'P') {
                            echo 'PRÁCTICA<br>';
                        }
                        if ($dictado['LUN'][$x] == 'T') {
                            echo 'TEORIA<br>';
                        }
                        echo '<span class="badge badge-pill badge-dark" style="font-size: 13px;">'.$hinicio['LUN'][$x] .'</span><br><br>';
                        echo "</div>";
                    }
                @endphp
            </td>
            <td class="border border-dark">
                @php
                    for ($x = 0; $x < $dma; $x++) {
                      $coolor=$colorcurso['MAR'][$x];
                      $ppcolor=$ncolor["$coolor"];
                      echo "<div style='background-color:$ppcolor;'>";

                        echo $curso['MAR'][$x] . '<br>';
                        echo $docente['MAR'][$x] . '<br>';
                        if ($dictado['MAR'][$x] == 'P') {
                            echo 'PRÁCTICA<br>';
                        }
                        if ($dictado['MAR'][$x] == 'T') {
                            echo 'TEORIA<br>';
                        }
                        echo '<span class="badge badge-pill badge-dark" style="font-size: 13px;">'.$hinicio['MAR'][$x] . '</span><br><br>';
                        echo "</div>";
                    }
                @endphp
            </td>
            <td class="border border-dark">
                @php
                    for ($x = 0; $x < $dmi; $x++) {
                      $coolor=$colorcurso['MIE'][$x];
                      $ppcolor=$ncolor["$coolor"];
                      echo "<div style='background-color:$ppcolor;'>";
                        echo $curso['MIE'][$x] . '<br>';
                        echo $docente['MIE'][$x] . '<br>';
                        if ($dictado['MIE'][$x] == 'P') {
                            echo 'PRÁCTICA<br>';
                        }
                        if ($dictado['MIE'][$x] == 'T') {
                            echo 'TEORIA<br>';
                        }
                        echo '<span class="badge badge-pill badge-dark" style="font-size: 13px;">'.$hinicio['MIE'][$x] . '</span><br><br>';
                        echo "</div>";
                    }
                @endphp
            </td>
            <td class="border border-dark">
                @php
                    for ($x = 0; $x < $dju; $x++) {
                      $coolor=$colorcurso['JUE'][$x];
                      $ppcolor=$ncolor["$coolor"];
                      echo "<div style='background-color:$ppcolor;'>";
                        echo $curso['JUE'][$x] . '<br>';
                        echo $docente['JUE'][$x] . '<br>';
                        if ($dictado['JUE'][$x] == 'P') {
                            echo 'PRÁCTICA<br>';
                        }
                        if ($dictado['JUE'][$x] == 'T') {
                            echo 'TEORIA<br>';
                        }
                        echo '<span class="badge badge-pill badge-dark" style="font-size: 13px;">'.$hinicio['JUE'][$x] . '</span><br><br>';
                        echo "</div>";
                    }
                @endphp
            </td>
            <td class="border border-dark">
                @php
                    for ($x = 0; $x < $dvi; $x++) {
                      $coolor=$colorcurso['VIE'][$x];
                      $ppcolor=$ncolor["$coolor"];
                      echo "<div style='background-color:$ppcolor;'>";
                        echo $curso['VIE'][$x] . '<br>';
                        echo $docente['VIE'][$x] . '<br>';
                        if ($dictado['VIE'][$x] == 'P') {
                            echo 'PRÁCTICA<br>';
                        }
                        if ($dictado['VIE'][$x] == 'T') {
                            echo 'TEORIA<br>';
                        }
                        echo '<span class="badge badge-pill badge-dark" style="font-size: 13px;">'.$hinicio['VIE'][$x] . '</span><br><br>';
                        echo "</div>";
                    }
                @endphp
            </td>
        </tr>
    </table>
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


