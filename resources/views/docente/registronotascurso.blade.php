@php

function sqlverregistronotas($codprofe, $semestre, $codcur)
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
        `seccion`.`doc_iCodigo` = '$codprofe' AND 
        `seccion`.`sem_iCodigo` = '$semestre' AND 
        `seccion`.`cur_iCodigo` = '$codcur'
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

function vercursonotas($coddocentex, $sem, $codcurso, $nro, $curso, $escuela)
{
    // $notas=new DocenteController();
    // $vernotas=$notas->verregistronotas($coddocentex,$sem,$codcurso,$curso);
    $vernotas = sqlverregistronotas($coddocentex, $sem, $codcurso, $curso);
    //--  $ttunidad=totalnrounidad($sem,$codcurso);
    $ttunidad = verunidad($sem, $codcurso);

    echo ' <div class="card-body " style="overflow: scroll;">
        <div class="card-header py-3" style="background-color:navy)">
            <h6 class="m-0 font-weight-bold text-dark-400">
              <table>
                <tr>
                  <td class="fondocol"><i class="fa fa-book " ></i></td>
                  <td class="fondocol">
              CURSO</td><td>' .
        $curso .
        ' 
              </td>
              </tr> 
              <tr><td class="fondocol">
                <i class="fa fa-award " ></i>
                </td>
                <td class="fondocol">
              ESCUELA</td><td>' .
        $escuela .
        //$notas->nescuela($escuela)
        '
              </td>
            </tr>
            <tr>
              <td class="fondocol">
                <i class="fa fa-cog " ></i></td>
              <td class="fondocol">TOTAL DE UNIDADES</td><td> &nbsp;&nbsp;';
    if ($ttunidad < 1) {
        echo "<div style='background-color:red'>NO CRITERIOS DE EVALUACION</div>";
    } else {
        echo $ttunidad;
    }
    echo '</td>
              </tr>
              </table>
              </h6>
           </div>
        <table  class="table table-striped table-hover table-responsive-md text-dark-400 table-condensed">
           <thead>
            ';
    echo "<tr style='background-color:black;color:white'>
              <td></td>
              <td></td>
              <td></td>";
    $estadover = '';
    $oculprom = ['', '', '', '', ''];
    $oculpromx = ['', '', '', '', ''];
    for ($x = 1; $x < 6; $x++) {
        if ($ttunidad < $x) {
            $estadover = "style='display:none;'";
        }
        ///versilabusnroeval($nota->sem_iCodigo,$nota->cur_iCodigo,$x)
        echo "<td colspan='4' $estadover>Nro Ev: " . versilabusnroeval($sem, $codcurso, $x) . '</td>';
        if (versilabusnroeval($sem, $codcurso, $x) < 1) {
            $oculprom[$x - 1] = "style='display:none;'";
            $oculpromx[$x - 1] = "class='ocultarnota'";
        }
        echo " <td  $estadover ></td>";
    }
    echo ' <td>' . formulapf($sem, $codcurso, 1) . formulapf($sem, $codcurso, 2) . ' </td>';
    echo '</tr>';
    echo '<tr style="background-color:black;color:white">
                <td>NRO</td>
                <td>Codigo</td>
                <td>Alumno</td>';
    $estadover = '';
    for ($x = 1; $x < 6; $x++) {
        if ($ttunidad < $x) {
            $estadover = "style='display:none;'";
        }
        for ($n = 1; $n < 5; $n++) {
            echo "<td  $estadover> CE$n</td>";
        }
        echo " <td  $estadover> PU$x</td>";
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
        if ($n < 3) {
            echo "<tr>
                <td>$n</td>
                <td>$nota->alu_vcCodigo</td>
                <td>" .
                $nota->alu_vcPaterno .
                ' ' .
                $nota->alu_vcMaterno .
                ' ' .
                $nota->alu_vcNombre .
                "</td>
                <td " .
                cambiarcolornotas($nota->CE11) .
                " $oculpromx[0]>" .
                $nota->CE11 .
                " </td>
                <td " .
                cambiarcolornotas($nota->CE12) .
                " $oculpromx[0]>" .
                $nota->CE12 .
                "  </td>
                <td " .
                cambiarcolornotas($nota->CE13) .
                " $oculpromx[0]>" .
                $nota->CE13 .
                "  </td>
                <td " .
                cambiarcolornotas($nota->CE14) .
                " $oculpromx[0]>" .
                $nota->CE14 .
                " </td>
                <td class='columpro'  $oculprom[0]>";
            $prome = 0;
            if (versilabuscriterio($nota->sem_iCodigo, $nota->cur_iCodigo, 1) == 'PA') {
                $prome = (sinnota($nota->CE11) + sinnota($nota->CE12) + sinnota($nota->CE13) + sinnota($nota->CE14)) / versilabusnroeval($nota->sem_iCodigo, $nota->cur_iCodigo, 1);
            } else {
                $xpp1 = 0;
                $xpp2 = 0;
                $xpp3 = 0;
                $xpp4 = 0;
                $pesox = versilabusformula($nota->sem_iCodigo, $nota->cur_iCodigo, 1);
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
                <td " .
                cambiarcolornotas($nota->CE21) .
                " $oculpromx[1]>" .
                $nota->CE21 .
                " </td>
                <td " .
                cambiarcolornotas($nota->CE22) .
                " $oculpromx[1]>" .
                $nota->CE22 .
                " </td>
                <td " .
                cambiarcolornotas($nota->CE23) .
                " $oculpromx[1]>" .
                $nota->CE23 .
                " </td>
                <td " .
                cambiarcolornotas($nota->CE24) .
                " $oculpromx[1]>" .
                $nota->CE24 .
                " </td>
                <td class='columpro' $oculprom[1]>";
            $prome = 0;
            if (versilabuscriterio($nota->sem_iCodigo, $nota->cur_iCodigo, 2) == 'PA') {
                $prome = (sinnota($nota->CE21) + sinnota($nota->CE22) + sinnota($nota->CE23) + sinnota($nota->CE24)) / versilabusnroeval($nota->sem_iCodigo, $nota->cur_iCodigo, 2);
            } else {
                $xpp1 = 0.0;
                $xpp2 = 0.0;
                $xpp3 = 0.0;
                $xpp4 = 0.0;
                $pesox = versilabusformula($nota->sem_iCodigo, $nota->cur_iCodigo, 2);
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
                <td " .
                cambiarcolornotas($nota->CE31) .
                " $oculpromx[2]>" .
                $nota->CE31 .
                "</td>
                <td " .
                cambiarcolornotas($nota->CE32) .
                " $oculpromx[2]>" .
                $nota->CE32 .
                "</td>
                <td " .
                cambiarcolornotas($nota->CE33) .
                " $oculpromx[2]>" .
                $nota->CE33 .
                "</td>
                <td " .
                cambiarcolornotas($nota->CE34) .
                " $oculpromx[2]>" .
                $nota->CE34 .
                "</td>
                <td class='columpro' $oculprom[2]>";
            $prome = 0;
            if (versilabuscriterio($nota->sem_iCodigo, $nota->cur_iCodigo, 3) == 'PA') {
                $prome = (sinnota($nota->CE31) + sinnota($nota->CE32) + sinnota($nota->CE33) + sinnota($nota->CE34)) / versilabusnroeval($nota->sem_iCodigo, $nota->cur_iCodigo, 3);
            } else {
                $xpp1 = 0.0;
                $xpp2 = 0.0;
                $xpp3 = 0.0;
                $xpp4 = 0.0;
                $pesox = versilabusformula($nota->sem_iCodigo, $nota->cur_iCodigo, 3);
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
                <td " .
                cambiarcolornotas($nota->CE41) .
                " $oculpromx[3]>" .
                $nota->CE41 .
                " </td>
                <td " .
                cambiarcolornotas($nota->CE42) .
                " $oculpromx[3]>" .
                $nota->CE42 .
                "  </td>
                <td " .
                cambiarcolornotas($nota->CE43) .
                " $oculpromx[3]>" .
                $nota->CE43 .
                "  </td>
                <td " .
                cambiarcolornotas($nota->CE44) .
                " $oculpromx[3]>" .
                $nota->CE44 .
                "  </td>
                <td class='columpro' $oculprom[3]>";
            $prome = 0;
            if (versilabuscriterio($nota->sem_iCodigo, $nota->cur_iCodigo, 4) == 'PA') {
                $prome = (sinnota($nota->CE41) + sinnota($nota->CE42) + sinnota($nota->CE43) + sinnota($nota->CE44)) / versilabusnroeval($nota->sem_iCodigo, $nota->cur_iCodigo, 4);
            } else {
                $xpp1 = 0.0;
                $xpp2 = 0.0;
                $xpp3 = 0.0;
                $xpp4 = 0.0;
                $pesox = versilabusformula($nota->sem_iCodigo, $nota->cur_iCodigo, 4);
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
                <td " .
                cambiarcolornotas($nota->CE51) .
                " $oculpromx[4]>" .
                $nota->CE51 .
                "  </td>
                <td " .
                cambiarcolornotas($nota->CE52) .
                " $oculpromx[4]>" .
                $nota->CE52 .
                "  </td>
                <td " .
                cambiarcolornotas($nota->CE53) .
                " $oculpromx[4]>" .
                $nota->CE53 .
                " </td>
                <td " .
                cambiarcolornotas($nota->CE54) .
                " $oculpromx[4]>" .
                $nota->CE54 .
                "  </td>
                <td class='columpro' $oculprom[4]>";
            $prome = 0;
            if (versilabuscriterio($nota->sem_iCodigo, $nota->cur_iCodigo, 5) == 'PA') {
                $prome = (sinnota($nota->CE51) + sinnota($nota->CE52) + sinnota($nota->CE53) + sinnota($nota->CE54)) / versilabusnroeval($nota->sem_iCodigo, $nota->cur_iCodigo, 5);
            } else {
                $xpp1 = 0.0;
                $xpp2 = 0.0;
                $xpp3 = 0.0;
                $xpp4 = 0.0;
                $pesox = versilabusformula($nota->sem_iCodigo, $nota->cur_iCodigo, 5);
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
            echo " <td class='columprof'>--";
            $tpro = 0;
            if (formulapf($sem, $codcurso, 1) == 'PA') {
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
                $pesox = formulapf($sem, $codcurso, 2);
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
            echo '</tr>';
        } //fin del if
    } //fin foreach
    echo " </table>
               </div>";
}

//vercursonotas($coddocentex,$sem,$codcurso,$nro,$curso,$escuela);
vercursonotas(51, 20212, 2, 1, 'MATEMATICA BASICA', 'AN');
@endphp


<link rel="stylesheet" href="{{ asset('bootstrap5/css/bootstrap.min.css') }}">
<script src="{{ asset('bootstrap5/js/bootstrap.js') }}"></script>
