@php

function sqlverregistronotas($semestre, $codcurso,$codlumno)
{
    $sql = "SELECT 
        `matricula`.`alu_iCodigo`,
        `matricula`.`sem_iCodigo`,
        `matriculadetalle`.`matdet_iCodigo`,
        `registroeval`.`matdet_iCodigo`,
        `registroeval`.`CE11`,
        `registroeval`.`CE12`,
        `registroeval`.`CE13`,
        `registroeval`.`CE14`,
        `registroeval`.`CE21`,
        `registroeval`.`CE22`,
        `registroeval`.`CE23`,
        `registroeval`.`CE24`,
        `registroeval`.`CE31`,
        `registroeval`.`CE32`,
        `registroeval`.`CE33`,
        `registroeval`.`CE34`,
        `registroeval`.`CE41`,
        `registroeval`.`CE42`,
        `registroeval`.`CE43`,
        `registroeval`.`CE44`,
        `registroeval`.`CE51`,
        `registroeval`.`CE52`,
        `registroeval`.`CE53`,
        `registroeval`.`CE54`,
        `registroeval`.`prom`,
        `registroeval`.`sust`,
        `registroeval`.`aplaz`,
        `registroeval`.`PF`,
        `matriculadetalle`.`mat_iCodigo`,
        `seccion`.`cur_iCodigo`,
        `curso`.`cur_vcNombre`,
        `seccion`.`doc_iCodigo`,
        `docente`.`doc_vcPaterno`,
        `docente`.`doc_vcMaterno`,
        `docente`.`doc_vcNombre`,
        `seccion`.`sem_iCodigo`,
        `alumno`.`alu_vcDocumento`,
        `alumno`.`alu_vcPaterno`,
        `alumno`.`alu_vcMaterno`,
        `alumno`.`alu_vcNombre`,
        `alumno`.`alu_vcCodigo`,
        `seccion`.`sec_iCodigo`
      FROM
        `matriculadetalle`
        INNER JOIN `registroeval` ON (`matriculadetalle`.`matdet_iCodigo` = `registroeval`.`matdet_iCodigo`)
        INNER JOIN `matricula` ON (`matricula`.`mat_iCodigo` = `matriculadetalle`.`mat_iCodigo`)
        INNER JOIN `seccion` ON (`matriculadetalle`.`sec_iCodigo` = `seccion`.`sec_iCodigo`)
        INNER JOIN `curso` ON (`seccion`.`cur_iCodigo` = `curso`.`cur_iCodigo`)
        INNER JOIN `docente` ON (`seccion`.`doc_iCodigo` = `docente`.`doc_iCodigo`)
        INNER JOIN `alumno` ON (`matricula`.`alu_iCodigo` = `alumno`.`alu_iCodigo`)
      WHERE
       
        `seccion`.`sem_iCodigo` = '$semestre' AND 
        `seccion`.`cur_iCodigo` = '$codcurso' AND
`matricula`.`alu_iCodigo` ='$codlumno'
        order by `alumno`.`alu_vcPaterno`
        ";
    $data1 = DB::select($sql);
    return $data1;
}

function verunidad($semestre, $codcur)
{
    $uni = 0;
    $r = DB::table('curso')
        ->select('silabus.unidades')
        ->join('seccion', 'seccion.cur_iCodigo', '=', 'curso.cur_iCodigo')
        ->join('silabus', 'silabus.sec_iCodigo', '=', 'seccion.sec_iCodigo')
        ->where(['seccion.sem_iCodigo' => $semestre, 'curso.cur_iCodigo' => $codcur])
        ->get();
    foreach ($r as $rp) {
        $uni = $rp->unidades;
    }
    return $uni;
}

function versilabusnroeval($sem, $codcurso, $x)
{
    ///revisar
    $ev = '';
    $r = DB::table('curso')
        ->select('silabus.nro_evalPU1', 'silabus.nro_evalPU2', 'silabus.nro_evalPU3', 'silabus.nro_evalPU4', 'silabus.nro_evalPU5')
        ->join('seccion', 'seccion.cur_iCodigo', '=', 'curso.cur_iCodigo')
        ->join('silabus', 'silabus.sec_iCodigo', '=', 'seccion.sec_iCodigo')
        ->where(['seccion.sem_iCodigo' => $sem, 'curso.cur_iCodigo' => $codcurso])
        ->get();
    foreach ($r as $neva) {
        $n1 = $neva->nro_evalPU1;
        $n2 = $neva->nro_evalPU2;
        $n3 = $neva->nro_evalPU3;
        $n4 = $neva->nro_evalPU4;
        $n5 = $neva->nro_evalPU5;
    }
    switch ($x) {
        case 1:
            $ev = $n1;
            break;
        case 2:
            $ev = $n2;
            break;
        case 3:
            $ev = $n3;
            break;
        case 4:
            $ev = $n4;
            break;
        case 5:
            $ev = $n5;
            break;

        default:
            $ev = '0';
            break;
    }
    return $ev;
}
function formulapf($sem, $codcurso, $x)
{
    $ev = '';
    $r = DB::table('curso')
        ->select('silabus.formulaPF', 'silabus.tipoPF')
        ->join('seccion', 'seccion.cur_iCodigo', '=', 'curso.cur_iCodigo')
        ->join('silabus', 'silabus.sec_iCodigo', '=', 'seccion.sec_iCodigo')
        ->where(['seccion.sem_iCodigo' => $sem, 'curso.cur_iCodigo' => $codcurso])
        ->get();
    foreach ($r as $neva) {
        $n1 = $neva->tipoPF;
        $n2 = $neva->formulaPF;
    }
    switch ($x) {
        case 1:
            $ev = $n1;
            break;
        case 2:
            $ev = $n2;
            break;
        default:
            $ev = '0';
            break;
    }
    return $ev;
}
function versilabuscriterio($sem, $codcurso, $x)
{
    $ev = '';
    $r = DB::table('curso')
        ->select('silabus.tipoPU1', 'silabus.tipoPU2', 'silabus.tipoPU3', 'silabus.tipoPU4', 'silabus.tipoPU5')
        ->join('seccion', 'seccion.cur_iCodigo', '=', 'curso.cur_iCodigo')
        ->join('silabus', 'silabus.sec_iCodigo', '=', 'seccion.sec_iCodigo')
        ->where(['seccion.sem_iCodigo' => $sem, 'curso.cur_iCodigo' => $codcurso])
        ->get();
    foreach ($r as $neva) {
        $n1 = $neva->tipoPU1;
        $n2 = $neva->tipoPU2;
        $n3 = $neva->tipoPU3;
        $n4 = $neva->tipoPU4;
        $n5 = $neva->tipoPU5;
    }
    switch ($x) {
        case 1:
            $ev = $n1;
            break;
        case 2:
            $ev = $n2;
            break;
        case 3:
            $ev = $n3;
            break;
        case 4:
            $ev = $n4;
            break;
        case 5:
            $ev = $n5;
            break;

        default:
            $ev = '0';
            break;
    }
    return $ev;
}
//versilabusformula()
function versilabusformula($sem, $codcurso, $x)
{
    $ev = '';
    $r = DB::table('curso')
        ->select('silabus.formulaPU1', 'silabus.formulaPU2', 'silabus.formulaPU3', 'silabus.formulaPU4', 'silabus.formulaPU5')
        ->join('seccion', 'seccion.cur_iCodigo', '=', 'curso.cur_iCodigo')
        ->join('silabus', 'silabus.sec_iCodigo', '=', 'seccion.sec_iCodigo')
        ->where(['seccion.sem_iCodigo' => $sem, 'curso.cur_iCodigo' => $codcurso])
        ->get();
    foreach ($r as $neva) {
        $n1 = $neva->formulaPU1;
        $n2 = $neva->formulaPU2;
        $n3 = $neva->formulaPU3;
        $n4 = $neva->formulaPU4;
        $n5 = $neva->formulaPU5;
    }
    switch ($x) {
        case 1:
            $ev = $n1;
            break;
        case 2:
            $ev = $n2;
            break;
        case 3:
            $ev = $n3;
            break;
        case 4:
            $ev = $n4;
            break;
        case 5:
            $ev = $n5;
            break;

        default:
            $ev = '0';
            break;
    }
    return $ev;
}

$coddocentex = 0;
$sem = 0;
$codcurso = 0;
$escuela = 'AN';
$curso = '';
if (isset($_REQUEST['codalumno'])) {
    $codalumno = $_REQUEST['codalumno'];
    $sem = $_REQUEST['sem'];
    $codcurso = $_REQUEST['codcurso'];
    $escuela = $_REQUEST['escuela'];
    $curso = $_REQUEST['curso'];
} else {
    echo 'NO REALIZO CONSULTA';
    //return '';
}
// $notas=new DocenteController();
// $vernotas=$notas->verregistronotas($coddocentex,$sem,$codcurso,$curso);
//$vernotas = sqlverregistronotas($semestre, $codcur,$codlumno)
$vernotas = sqlverregistronotas($sem, $codcurso,$codalumno );
if (count($vernotas) < 1) {
    return 'NO EXISTEN DATOS';
}
//--  $ttunidad=totalnrounidad($sem,$codcurso);
$ttunidad = verunidad($sem, $codcurso);

$cri01 = versilabuscriterio($sem, $codcurso, 1);

$cri02 = versilabuscriterio($sem, $codcurso, 2);
$cri03 = versilabuscriterio($sem, $codcurso, 3);
$cri04 = versilabuscriterio($sem, $codcurso, 4);
$cri05 = versilabuscriterio($sem, $codcurso, 5);

$xnroev01 = versilabusnroeval($sem, $codcurso, 1);
$xnroev02 = versilabusnroeval($sem, $codcurso, 2);
$xnroev03 = versilabusnroeval($sem, $codcurso, 3);
$xnroev04 = versilabusnroeval($sem, $codcurso, 4);
$xnroev05 = versilabusnroeval($sem, $codcurso, 5);

$oculunidad01 = ['style="display:none;"', 'style="display:none;"', 'style="display:none;"', 'style="display:none;"', 'style="display:none;"'];
$oculunidad02 = ['style="display:none;"', 'style="display:none;"', 'style="display:none;"', 'style="display:none;"', 'style="display:none;"'];
$oculunidad03 = ['style="display:none;"', 'style="display:none;"', 'style="display:none;"', 'style="display:none;"', 'style="display:none;"'];
$oculunidad04 = ['style="display:none;"', 'style="display:none;"', 'style="display:none;"', 'style="display:none;"', 'style="display:none;"'];
$oculunidad05 = ['style="display:none;"', 'style="display:none;"', 'style="display:none;"', 'style="display:none;"', 'style="display:none;"'];
//  $oculpromx = ['', '', '', '', ''];
//$oculpromx = ['', '', '', '', ''];

///eva01

if ($xnroev01 == 1) {
    $oculunidad01[0] = '';
}
if ($xnroev01 == 2) {
    $oculunidad01[0] = '';
    $oculunidad01[1] = '';
}
if ($xnroev01 == 3) {
    $oculunidad01[0] = '';
    $oculunidad01[1] = '';
    $oculunidad01[2] = '';
}
if ($xnroev01 == 4) {
    $oculunidad01[0] = '';
    $oculunidad01[1] = '';
    $oculunidad01[2] = '';
    $oculunidad01[3] = '';
}

///eva02
if ($xnroev02 == 1) {
    $oculunidad02[0] = '';
}
if ($xnroev02 == 2) {
    $oculunidad02[0] = '';
    $oculunidad02[1] = '';
}
if ($xnroev02 == 3) {
    $oculunidad02[0] = '';
    $oculunidad02[1] = '';
    $oculunidad02[2] = '';
}
if ($xnroev02 == 4) {
    $oculunidad02[0] = '';
    $oculunidad02[1] = '';
    $oculunidad02[2] = '';
    $oculunidad02[3] = '';
}

///eva03
if ($xnroev03 == 1) {
    $oculunidad03[0] = '';
}
if ($xnroev03 == 2) {
    $oculunidad03[0] = '';
    $oculunidad03[1] = '';
}
if ($xnroev03 == 3) {
    $oculunidad03[0] = '';
    $oculunidad03[1] = '';
    $oculunidad03[2] = '';
}
if ($xnroev03 == 4) {
    $oculunidad03[0] = '';
    $oculunidad03[1] = '';
    $oculunidad03[2] = '';
    $oculunidad03[3] = '';
}
///eva04
if ($xnroev04 == 1) {
    $oculunidad04[0] = '';
}
if ($xnroev04 == 2) {
    $oculunidad04[0] = '';
    $oculunidad04[1] = '';
}
if ($xnroev04 == 3) {
    $oculunidad04[0] = '';
    $oculunidad04[1] = '';
    $oculunidad04[2] = '';
}
if ($xnroev04 == 4) {
    $oculunidad04[0] = '';
    $oculunidad04[1] = '';
    $oculunidad04[2] = '';
    $oculunidad04[3] = '';
}
///eva05
if ($xnroev05 == 1) {
    $oculunidad05[0] = '';
}
if ($xnroev05 == 2) {
    $oculunidad05[0] = '';
    $oculunidad05[1] = '';
}
if ($xnroev05 == 3) {
    $oculunidad05[0] = '';
    $oculunidad05[1] = '';
    $oculunidad05[2] = '';
}
if ($xnroev05 == 4) {
    $oculunidad05[0] = '';
    $oculunidad05[1] = '';
    $oculunidad05[2] = '';
    $oculunidad05[3] = '';
}

$xfomula01 = formulapf($sem, $codcurso, 1); //tipo  arit o pesos
$xfomula02 = formulapf($sem, $codcurso, 2); //fomular

$xfomulaunidad01 = versilabusformula($sem, $codcurso, 1);
$xfomulaunidad02 = versilabusformula($sem, $codcurso, 2);
$xfomulaunidad03 = versilabusformula($sem, $codcurso, 3);
$xfomulaunidad04 = versilabusformula($sem, $codcurso, 4);
$xfomulaunidad05 = versilabusformula($sem, $codcurso, 5);
//  $nro=1;
//vercursonotas($coddocentex,$sem,$codcurso,$nro,$curso,$escuela);
//vercursonotas(51, 20212, 2, 1, 'MATEMATICA BASICA', 'AN');
@endphp
<style>
    .fondocol {
        background-color: navy;
        color: white;
        width:250px;

    }

    .table-condensed {
        font-size: 11px;
        color: black;
    }

</style>
<div class="container">
    <div class="card">
        <!-- <div class="card-body " style="overflow: scroll;"> //-->
        <div class="card-header ">
           
NOTAS REGISTRADAS
        </div>
        <div class="card-body ">

          <table>
            <tr>

                <td class="fondocol"><i class="fa fa-book "></i></td>
                <td class="fondocol" width="300px">CURSO</td>
                    
                <td width="100%">
                    {{ $curso }}

                </td>
               
            </tr>
        
            <tr>
                <td class="fondocol">
                    <i class="fa fa-cog "></i>
                </td>
                <td class="fondocol">TOTAL DE UNIDADES</td>
                <td> &nbsp;&nbsp;
                    @if ($ttunidad < 1)
                        <div style='background-color:red'>NO CRITERIOS DE EVALUACION</div>

                    @else
                        {{ $ttunidad }}
                    @endif
                    @php
                        $prover01 = "style='display:none'";
                        $prover02 = "style='display:none'";
                        $prover03 = "style='display:none'";
                        $prover04 = "style='display:none'";
                        $prover05 = "style='display:none'";
                        if ($ttunidad == 1) {
                            $prover01 = '';
                        }
                        if ($ttunidad == 2) {
                            $prover01 = '';
                            $prover02 = '';
                        }
                        if ($ttunidad == 3) {
                            $prover01 = '';
                            $prover02 = '';
                            $prover03 = '';
                        }
                        if ($ttunidad == 4) {
                            $prover01 = '';
                            $prover02 = '';
                            $prover03 = '';
                            $prover04 = '';
                        }
                        if ($ttunidad == 5) {
                            $prover01 = '';
                            $prover02 = '';
                            $prover03 = '';
                            $prover04 = '';
                            $prover05 = '';
                        }
                    @endphp
                </td>
            </tr>

            <tr>

              <td class="fondocol"><i class="fa fa-book "></i></td>
              <td class="fondocol"> DOCENTE</td>
                
              <td width="100%">
                  {{ $vernotas[0]->doc_vcPaterno }}  {{ $vernotas[0]->doc_vcMaterno }}  {{ $vernotas[0]->doc_vcNombre }}

              </td>
             
          </tr>

        </table>
          
            <table class="table table-striped table-hover table-responsive-md text-dark-400 table-condensed" border="1">
                <thead>

                    <tr style='background-color:black;color:white'>
                        
                        @php
                            $estadover = '';
                            
                            for ($x = 1; $x < 6; $x++) {
                                /*  if ($ttunidad < $x) {
                                                                                                                                                        $estadover = "style='display:none;'";
                                                                                                                                                    }*/
                                ///versilabusnroeval($nota->sem_iCodigo,$nota->cur_iCodigo,$x)
                                if ($x == 1) {
                                    echo "<td colspan='" . ($xnroev01 + 1) . "' $prover01>UN-0$x Ev: " . $xnroev01 . '</td>';
                                }
                                if ($x == 2) {
                                    echo "<td colspan='" . ($xnroev02 + 1) . "' $prover02>UN-0$x Ev: " . $xnroev02 . '</td>';
                                }
                                if ($x == 3) {
                                    echo "<td colspan='" . ($xnroev03 + 1) . "' $prover03>UN-0$x Ev: " . $xnroev03 . '</td>';
                                }
                                if ($x == 4) {
                                    echo "<td colspan='" . ($xnroev04 + 1) . "' $prover04>UN-0$x Ev: " . $xnroev04 . '</td>';
                                }
                                if ($x == 5) {
                                    echo "<td colspan='" . ($xnroev05 + 1) . "' $prover05>UN-0$x Ev: " . $xnroev05 . '</td>';
                                }
                            
                                /*  if (versilabusnroeval($sem, $codcurso, $x) < 1) {
                                                                                                                                                            $oculprom[$x - 1] = "style='display:none;'";
                                                                                                                                                            $oculpromx[$x - 1] = "class='ocultarnota'";
                                                                                                                                                        }*/
                                //echo " <td  $estadover ></td>";
                            }
                            echo ' <td>' . $xfomula01 . $xfomula02 . ' </td>';
                            echo '</tr>';
                            echo '<tr style="background-color:black;color:white">';
                            $estadover = '';
                            for ($x = 1; $x < 6; $x++) {
                                //  if ($ttunidad < $x) {
                                //     $estadover = "style='display:none;'";
                                //   }
                                for ($n = 1; $n < 5; $n++) {
                                    if ($x == 1) {
                                        echo '<td ' . $oculunidad01[$n - 1] . "> CE$n</td>";
                                    }
                                    if ($x == 2) {
                                        echo '<td ' . $oculunidad02[$n - 1] . "> CE$n</td>";
                                    }
                                    if ($x == 3) {
                                        echo '<td ' . $oculunidad03[$n - 1] . "> CE$n</td>";
                                    }
                                    if ($x == 4) {
                                        echo '<td ' . $oculunidad04[$n - 1] . "> CE$n</td>";
                                    }
                                    if ($x == 5) {
                                        echo '<td ' . $oculunidad05[$n - 1] . "> CE$n</td>";
                                    }
                                }
                                if ($x == 1) {
                                    echo " <td  $prover01> PU$x</td>";
                                }
                                if ($x == 2) {
                                    echo " <td  $prover02> PU$x</td>";
                                }
                                if ($x == 3) {
                                    echo " <td  $prover03> PU$x</td>";
                                }
                                if ($x == 4) {
                                    echo " <td  $prover04> PU$x</td>";
                                }
                                if ($x == 5) {
                                    echo " <td  $prover05> PU$x</td>";
                                }
                            }
                            echo ' <td> PF</td>';
                            echo "    </tr>
                                                                                                                                                        </thead>";
                            
                            $promediox1 = 0;
                            $promediox2 = 0;
                            $promediox3 = 0;
                            $promediox4 = 0;
                            $promediox5 = 0;
                            $n = 0;
                            // dd($vernotas);
                            foreach ($vernotas as $nota) {
                                $n++;
                                //if ($n < 10)
                                echo "<tr>
                                  <td  $oculunidad01[0]>" .
                                    $nota->CE11 .
                                    " </td>
                                                                                                                                                                <td $oculunidad01[1]>" .
                                    $nota->CE12 .
                                    "  </td>
                                                                                                                                                                <td $oculunidad01[2]>" .
                                    $nota->CE13 .
                                    "  </td>
                                                                                                                                                                <td $oculunidad01[3]>" .
                                    $nota->CE14 .
                                    " </td>
                                                                                                                                                                <td class='columpro'  $prover01>";
                                $prome = 0;
                                if ($cri01 == 'PA') {
                                    $prome = (sinnota($nota->CE11) + sinnota($nota->CE12) + sinnota($nota->CE13) + sinnota($nota->CE14)) / $xnroev01;
                                } else {
                                    $xpp1 = 0;
                                    $xpp2 = 0;
                                    $xpp3 = 0;
                                    $xpp4 = 0;
                                    $pesox = $xfomulaunidad01;
                                    $npeso = explode('-', $pesox);
                                    //     echo "xx".$npeso[0]."xx";
                                    if (isset($npeso[0])) {
                                        $xpp1 = $npeso[0];
                                    }
                                    if (isset($npeso[1])) {
                                        $xpp2 = $npeso[1];
                                    }
                                    if (isset($npeso[2])) {
                                        $xpp3 = $npeso[2];
                                    }
                                    if (isset($npeso[3])) {
                                        $xpp4 = $npeso[3];
                                    }
                                    $prome = sinnota($nota->CE11) * sinnota($xpp1) + sinnota($nota->CE12) * sinnota($xpp2) + sinnota($nota->CE13) * sinnota($xpp3) + sinnota($nota->CE14) * sinnota($xpp4);
                                }
                                $promediox1 = $prome;
                                echo cambiarcolorpromedio($prome);
                                // echo "--".versilabusnroeval($nota->sem_iCodigo,$nota->cur_iCodigo,1);
                                /*.versilabuscriterio($nota->sem_iCodigo,$nota->cur_iCodigo,1)
                                                                                                                                                                     ."--".versilabusformula($nota->sem_iCodigo,$nota->cur_iCodigo,1)."--"
                                                                                                                                                                  .versilabusnroeval($nota->sem_iCodigo,$nota->cur_iCodigo,1)
                                                                                                                                                                  .*/
                                echo "</td>
                                                                                                                                                                <td $oculunidad02[0]>" .
                                    $nota->CE21 .
                                    " </td>
                                                                                                                                                                <td $oculunidad02[1]>" .
                                    $nota->CE22 .
                                    " </td>
                                                                                                                                                                <td $oculunidad02[2]>" .
                                    $nota->CE23 .
                                    " </td>
                                                                                                                                                                <td $oculunidad02[3]>" .
                                    $nota->CE24 .
                                    " </td>
                                                                                                                                                                <td class='columpro' $prover02>";
                                $prome = 0;
                                if ($cri02 == 'PA') {
                                    $prome = (sinnota($nota->CE21) + sinnota($nota->CE22) + sinnota($nota->CE23) + sinnota($nota->CE24)) / $xnroev02;
                                } else {
                                    $xpp1 = 0.0;
                                    $xpp2 = 0.0;
                                    $xpp3 = 0.0;
                                    $xpp4 = 0.0;
                                    $pesox = $xfomulaunidad02;
                                    $npeso = explode('-', $pesox);
                                    //  echo "xx".$npeso[0]."xx";
                                    if (isset($npeso[0])) {
                                        $xpp1 = $npeso[0];
                                    }
                                    if (isset($npeso[1])) {
                                        $xpp2 = $npeso[1];
                                    }
                                    if (isset($npeso[2])) {
                                        $xpp3 = $npeso[2];
                                    }
                                    if (isset($npeso[3])) {
                                        $xpp4 = $npeso[3];
                                    }
                                    $prome = sinnota($nota->CE21) * sinnota($xpp1) + sinnota($nota->CE22) * sinnota($xpp2) + sinnota($nota->CE23) * sinnota($xpp3) + sinnota($nota->CE24) * sinnota($xpp4);
                            
                                    //     sinnota($nota->CE23)*$xpp3+
                                    //       sinnota($nota->CE24)*$xpp4;
                                    //+ $nota->CE22*$xpp2 + $nota->CE23*$xpp3 + $nota->CE24*$xpp4);
                                }
                                $promediox2 = $prome;
                                echo cambiarcolorpromedio($prome);
                                /*.versilabuscriterio($nota->sem_iCodigo,$nota->cur_iCodigo,2)
                                                                                                                                                                  .versilabusformula($nota->sem_iCodigo,$nota->cur_iCodigo,2)."--"
                                                                                                                                                                  .versilabusnroeval($nota->sem_iCodigo,$nota->cur_iCodigo,2)
                                                                                                                                                                  .*/
                                echo "</td>
                                                                                                                                                                <td $oculunidad03[0]>" .
                                    $nota->CE31 .
                                    "</td>
                                                                                                                                                                <td $oculunidad03[1]>" .
                                    $nota->CE32 .
                                    "</td>
                                                                                                                                                                <td $oculunidad03[2]>" .
                                    $nota->CE33 .
                                    "</td>
                                                                                                                                                                <td $oculunidad03[3]>" .
                                    $nota->CE34 .
                                    "</td>
                                                                                                                                                                <td class='columpro' $prover03>";
                                $prome = 0;
                                if ($cri03 == 'PA') {
                                    $prome = (sinnota($nota->CE31) + sinnota($nota->CE32) + sinnota($nota->CE33) + sinnota($nota->CE34)) / $xnroev03;
                                } else {
                                    $xpp1 = 0.0;
                                    $xpp2 = 0.0;
                                    $xpp3 = 0.0;
                                    $xpp4 = 0.0;
                                    $pesox = $xfomulaunidad03;
                                    $npeso = explode('-', $pesox);
                                    //    echo "xx".$npeso[0]."xx";
                                    if (isset($npeso[0])) {
                                        $xpp1 = $npeso[0];
                                    }
                                    if (isset($npeso[1])) {
                                        $xpp2 = $npeso[1];
                                    }
                                    if (isset($npeso[2])) {
                                        $xpp3 = $npeso[2];
                                    }
                                    if (isset($npeso[3])) {
                                        $xpp4 = $npeso[3];
                                    }
                                    $prome = sinnota($nota->CE31) * sinnota($xpp1) + sinnota($nota->CE32) * sinnota($xpp2) + sinnota($nota->CE33) * sinnota($xpp3) + sinnota($nota->CE34) * sinnota($xpp4);
                                }
                                $promediox3 = $prome;
                                echo cambiarcolorpromedio($prome);
                                /*  .versilabuscriterio($nota->sem_iCodigo,$nota->cur_iCodigo,3)
                                                                                                                                                                  .versilabusformula($nota->sem_iCodigo,$nota->cur_iCodigo,3)."--"
                                                                                                                                                                  .versilabusnroeval($nota->sem_iCodigo,$nota->cur_iCodigo,3)
                                                                                                                                                                  .*/
                                echo "</td>
                                                                                                                                                                <td $oculunidad04[0]>" .
                                    $nota->CE41 .
                                    " </td>
                                                                                                                                                                <td $oculunidad04[1]>" .
                                    $nota->CE42 .
                                    "  </td>
                                                                                                                                                                <td $oculunidad04[2]>" .
                                    $nota->CE43 .
                                    "  </td>
                                                                                                                                                                <td $oculunidad04[3]>" .
                                    $nota->CE44 .
                                    "  </td>
                                                                                                                                                                <td class='columpro' $prover04>";
                                $prome = 0;
                                if ($cri04 == 'PA') {
                                    $prome = (sinnota($nota->CE41) + sinnota($nota->CE42) + sinnota($nota->CE43) + sinnota($nota->CE44)) / $xnroev04;
                                } else {
                                    $xpp1 = 0.0;
                                    $xpp2 = 0.0;
                                    $xpp3 = 0.0;
                                    $xpp4 = 0.0;
                                    $pesox = $xfomulaunidad04;
                                    $npeso = explode('-', $pesox);
                                    //    echo "xx".$npeso[0]."xx";
                                    if (isset($npeso[0])) {
                                        $xpp1 = $npeso[0];
                                    }
                                    if (isset($npeso[1])) {
                                        $xpp2 = $npeso[1];
                                    }
                                    if (isset($npeso[2])) {
                                        $xpp3 = $npeso[2];
                                    }
                                    if (isset($npeso[3])) {
                                        $xpp4 = $npeso[3];
                                    }
                                    $prome = sinnota($nota->CE41) * sinnota($xpp1) + sinnota($nota->CE42) * sinnota($xpp2) + sinnota($nota->CE43) * sinnota($xpp3) + sinnota($nota->CE44) * sinnota($xpp4);
                                }
                                $promediox4 = $prome;
                                echo cambiarcolorpromedio($prome);
                                /*.versilabuscriterio($nota->sem_iCodigo,$nota->cur_iCodigo,4)
                                                                                                                                                                  .versilabusformula($nota->sem_iCodigo,$nota->cur_iCodigo,4)."--"
                                                                                                                                                                  .versilabusnroeval($nota->sem_iCodigo,$nota->cur_iCodigo,4)
                                                                                                                                                                  .*/
                                echo "</td>
                                                                                                                                                                <td $oculunidad05[0]>" .
                                    $nota->CE51 .
                                    "  </td>
                                                                                                                                                                <td $oculunidad05[1]>" .
                                    $nota->CE52 .
                                    "  </td>
                                                                                                                                                                <td $oculunidad05[2]>" .
                                    $nota->CE53 .
                                    " </td>
                                                                                                                                                                <td $oculunidad05[3]>" .
                                    $nota->CE54 .
                                    "  </td>
                                                                                                                                                                <td class='columpro' $prover05>";
                                $prome = 0;
                                if ($cri05 == 'PA') {
                                    $prome = (sinnota($nota->CE51) + sinnota($nota->CE52) + sinnota($nota->CE53) + sinnota($nota->CE54)) / $xnroev05;
                                } else {
                                    $xpp1 = 0.0;
                                    $xpp2 = 0.0;
                                    $xpp3 = 0.0;
                                    $xpp4 = 0.0;
                                    $pesox = $xfomulaunidad05;
                                    $npeso = explode('-', $pesox);
                                    //  echo "xx".$npeso[0]."xx";
                                    if (isset($npeso[0])) {
                                        $xpp1 = $npeso[0];
                                    }
                                    if (isset($npeso[1])) {
                                        $xpp2 = $npeso[1];
                                    }
                                    if (isset($npeso[2])) {
                                        $xpp3 = $npeso[2];
                                    }
                                    if (isset($npeso[3])) {
                                        $xpp4 = $npeso[3];
                                    }
                                    $prome = sinnota($nota->CE51) * sinnota($xpp1) + sinnota($nota->CE52) * sinnota($xpp2) + sinnota($nota->CE53) * sinnota($xpp3) + sinnota($nota->CE54) * sinnota($xpp4);
                                }
                                $promediox5 = $prome;
                                echo cambiarcolorpromedio($prome);
                                /*.versilabuscriterio($nota->sem_iCodigo,$nota->cur_iCodigo,4)
                                                                                                                                                                  .versilabusformula($nota->sem_iCodigo,$nota->cur_iCodigo,5)."--"
                                                                                                                                                                  .versilabusnroeval($nota->sem_iCodigo,$nota->cur_iCodigo,5)
                                                                                                                                                                  .*/
                                echo '</td>';
                                echo " <td class='columprof'>";
                                $tpro = 0;
                                if ($xfomula01 == 'PA') {
                                    if ($ttunidad > 0) {
                                        $tpro = (sinnota($promediox1) + sinnota($promediox2) + sinnota($promediox3) + sinnota($promediox4) + sinnota($promediox5)) / $ttunidad;
                                    }
                                    // echo cambiarcolorpromedio($tpro);
                                } else {
                                    $ps1 = 0.0;
                                    $ps2 = 0.0;
                                    $ps3 = 0.0;
                                    $ps4 = 0.0;
                                    $ps5 = 0.0;
                                    $pesox = $xfomula02;
                                    $npeso = explode('-', $pesox);
                                    if (isset($npeso[0])) {
                                        $ps1 = $npeso[0];
                                    }
                                    if (isset($npeso[1])) {
                                        $ps2 = $npeso[1];
                                    }
                                    if (isset($npeso[2])) {
                                        $ps3 = $npeso[2];
                                    }
                                    if (isset($npeso[3])) {
                                        $ps4 = $npeso[3];
                                    }
                                    if (isset($npeso[4])) {
                                        $ps5 = $npeso[4];
                                    }
                                    $tpro = sinnota($promediox1) * sinnota($ps1) + sinnota($promediox2) * sinnota($ps2) + sinnota($promediox3) * sinnota($ps3) + sinnota($promediox4) * sinnota($ps4) + sinnota($promediox5) * sinnota($ps5);
                                }
                            
                                echo cambiarcolorpromedio($tpro);
                                echo '</td>';
                                echo '</tr>'; //fin del if
                            } //fin foreach
                            echo ' </table> ';
                            
                        @endphp
        </div>

    </div>
</div>

<script>
    function vercursoreg() {
        $("#micontenido").html(
            "<img src='img/cargar.gif'>"
        );
        $("#micontenido").load('docente/registronotas');

    }

    function xverregistro(codcurso,semestre,coddocente) { //actas/veractas?xcod=2
        $("#micontenido").html(
            "<img src='img/cargar.gif'>"
        );
      
        $.ajax({
            url: "actas/veractas",
            success: function(result) {
                //   alert(result)
                // $("#modaleditar").modal('show');
                $("#micontenido").html(result);

            },
            data: {
                xcod: codcurso,
                semestre: semestre,
                coddocente:coddocente
            },
            type: "GET"
        });
    }
</script>


<link rel="stylesheet" href="{{ asset('bootstrap5/css/bootstrap.min.css') }}">

