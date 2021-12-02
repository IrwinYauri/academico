@php
function mostrarbotonx($codboton)
{     echo "<td>";
    //   $mmcod=$codcur.$dia."2";
    $mmcod=$codboton;
       echo "<script>"; 
       echo " mostrarboton1('".$mmcod."')";
       echo "</script>";
      echo "</td>";
}

function asistenciaalumno($codalumno,$codcursosec,$s1,$s16,$dia)
   {// echo "Semestre";
   // return "Proceso completado";
   $sql="select 
   concat( sh.sectip_cCodigo, sha.sechorasi_iCodigo ) as pk,
  
   al.alu_iCodigo,
   al.alu_vcCodigo,    
   sha.sechorasi_iSemana,

   sha.sechorasi_dFecha,
   sh.sectip_cCodigo,    
   IF(shal.sechoralu_bPresente = 'Presente', 'P',IF(shal.sechoralu_bPresente = 'Falta','F',IFNULL(shal.sechoralu_bPresente,'F') )) as estado
   ,concat(al.alu_vcMaterno,' ',al.alu_vcMaterno,' ',al.alu_vcNombre) as alumno
   ,sh.dia_vcCodigo
   ,shal.sechorasi_iCodigo
    ,shal.sechoralu_iCodigo

from 
   seccion  as sc 
   inner join matriculadetalle as matd
   on(sc.sec_iCodigo=matd.sec_iCodigo)
   inner join matricula as mat 
   on(matd.mat_iCodigo=mat.mat_iCodigo and mat.estado<>'R')
   inner join alumno as al
   on(mat.alu_iCodigo=al.alu_iCodigo)
   inner join seccion_horario as sh
   on(sc.sec_iCodigo=sh.sec_iCodigo)
   inner join seccion_horarioasistencia as sha 
   on(sh.sechor_iCodigo=sha.sechor_iCodigo)
   left join seccion_horarioalumno as shal
   on(sha.sechorasi_iCodigo=shal.sechorasi_iCodigo and al.alu_iCodigo=shal.alu_iCodigo)

where sc.sec_iCodigo='$codcursosec' and (sha.sechorasi_iSemana>='$s1' and sha.sechorasi_iSemana<='$s16')
and al.alu_iCodigo='$codalumno'
and sh.dia_vcCodigo like '".$dia."%'
";
    $data1=DB::select($sql);    
    return $data1;
   }
function sqlvercursosalumnos($codcurso,$semestre)
{ $sql='SELECT 
      concat(alumno.alu_vcPaterno," ",
      alumno.alu_vcMaterno," ",
      alumno.alu_vcNombre) as alumno,
      curso.cur_vcNombre,
      curso.cur_vcCodigo,
      curso.cur_iCodigo,
      seccion.sem_iCodigo,
      seccion.sec_iCodigo,
      matriculadetalle.mat_iCodigo,
      matriculadetalle.matdet_iCodigo,
      matricula.alu_iCodigo,
      matricula.sem_iCodigo,
  alumno.alu_vcEmail,
   alumno.alu_vcCodigo
    FROM
      alumno
      INNER JOIN matricula ON (alumno.alu_iCodigo = matricula.alu_iCodigo)
      INNER JOIN matriculadetalle ON (matricula.mat_iCodigo = matriculadetalle.mat_iCodigo)
      INNER JOIN seccion ON (seccion.sec_iCodigo = matriculadetalle.sec_iCodigo)
      INNER JOIN curso ON (curso.cur_iCodigo = seccion.cur_iCodigo)
    WHERE
      curso.cur_iCodigo = "'.$codcurso.'" AND 
      seccion.sem_iCodigo = "'.$semestre.'"
      order by alumno.alu_vcPaterno';
  $data1=DB::select($sql);
 return $data1;

}
function verasis1($codalumno, $codseccion, $s1, $s2, $dia, $codcur, $xhora)
{
   // $asistencias = new AsistenciaController();
   // $asistencia = $asistencias->asistenciaalumno($codalumno, $codseccion, $s1, $s2, $dia);
   $asistencia = asistenciaalumno($codalumno, $codseccion, $s1, $s2, $dia);
    $sm1 = 0;
    $sm2 = 0;
    $sm3 = 0;
    $sm4 = 0;
    $sm5 = 0;
    $sm6 = 0;
    $sm7 = 0;
    $sm8 = 0;
    $sm9 = 0;
    $sm10 = 0;
    $sm11 = 0;
    $sm12 = 0;
    $sm13 = 0;
    $sm14 = 0;
    $sm15 = 0;
    $sm16 = 0;
    $mixhora = [];
    foreach ($asistencia as $verasis) {
        $semana = $verasis->sechorasi_iSemana;
        $rcodestado = $dia . $semana . 'estado' . $codseccion;
        $rcodhora = $dia . $semana . 'codhora' . $codseccion;
        $rcodalu = $dia . $semana . 'codalu' . $codseccion;
        $xcodalu = $codalumno;
        $ocultar = '';
        $ocultarbot = '';

        echo '<td>';
        /*echo  ":".$dia;
           echo  ":".$verasis->estado;
           echo  ":".$verasis->sechorasi_dFecha;
           echo ":".$verasis->alu_iCodigo;
           echo ":".$verasis->sechorasi_iCodigo;
           echo ":".$verasis->sechoralu_iCodigo;
           echo ":".$codalumno; */
        //hora de la semana
        //--dd($xhora);
        //--         $mixhora[($semana-1)]= $xhora[0];    //cambiar por array
        //hora defin
        if ($semana == 1 && $verasis->sechorasi_iCodigo * 1 < 1) {
            $sm1++;
        }
        if ($semana == 2 && $verasis->sechorasi_iCodigo * 1 < 1) {
            $sm2++;
        }
        if ($semana == 3 && $verasis->sechorasi_iCodigo * 1 < 1) {
            $sm3++;
        }
        if ($semana == 4 && $verasis->sechorasi_iCodigo * 1 < 1) {
            $sm4++;
        }
        if ($semana == 5 && $verasis->sechorasi_iCodigo * 1 < 1) {
            $sm5++;
        }
        if ($semana == 6 && $verasis->sechorasi_iCodigo * 1 < 1) {
            $sm6++;
        }
        if ($semana == 7 && $verasis->sechorasi_iCodigo * 1 < 1) {
            $sm7++;
        }
        if ($semana == 8 && $verasis->sechorasi_iCodigo * 1 < 1) {
            $sm8++;
        }
        if ($semana == 9 && $verasis->sechorasi_iCodigo * 1 < 1) {
            $sm9++;
        }
        if ($semana == 10 && $verasis->sechorasi_iCodigo * 1 < 1) {
            $sm10++;
        }
        if ($semana == 11 && $verasis->sechorasi_iCodigo * 1 < 1) {
            $sm11++;
        }
        if ($semana == 12 && $verasis->sechorasi_iCodigo * 1 < 1) {
            $sm12++;
        }
        if ($semana == 13 && $verasis->sechorasi_iCodigo * 1 < 1) {
            $sm13++;
        }
        if ($semana == 14 && $verasis->sechorasi_iCodigo * 1 < 1) {
            $sm14++;
        }
        if ($semana == 15 && $verasis->sechorasi_iCodigo * 1 < 1) {
            $sm15++;
        }
        if ($semana == 16 && $verasis->sechorasi_iCodigo * 1 < 1) {
            $sm16++;
        }

        if ($verasis->sechorasi_iCodigo * 1 > 0) {
            $ocultar = "style='display:block'";
        } else {
            $ocultar = "style='display:none'";
        }

        if ($verasis->sechorasi_iCodigo * 1 > 0) {
            $ocultarbot = "style='display:none'";
        } else {
            $ocultarbot = "style='display:block'";
        }
        // dd($xhora);
        //   echo "--".$xhora[($semana-1)];
        //   echo "--".$mixhora[($semana-1)];
        // echo "-:-".$xhora[$semana]."**";
        $testadop = '';
        $testadof = '';
        $testadoj = '';

        if (strtoupper(left($verasis->estado, 1)) == 'P') {
            $testadop = 'selected';
        }
        if (strtoupper(left($verasis->estado, 1)) == 'J') {
            $testadoj = 'selected';
        }
        if (strtoupper(left($verasis->estado, 1)) == 'F' || strtoupper(left($verasis->estado, 1)) == '') {
            $testadof = 'selected';
        }

        echo "   <select name='" .
            $rcodestado .
            "' id='" .
            $rcodestado .
            "' value='" .
            left($verasis->estado, 1) .
            "' onchange='editarasis(this,\"" .
            $rcodhora .
            "\",\"" .
            $xcodalu .
            "\",\"" .
            $rcodestado .
            "\")'  " .
            $ocultar .
            ">
            <option value='P' $testadop>P</option>
            <option value='F' $testadof>F</option>
            <option value='J' $testadoj>J</option></select>
             <input type='hidden' name='" .
            $rcodhora .
            "' id='" .
            $rcodhora .
            "'  value='" .
            $verasis->sechorasi_iCodigo .
            "'>
             <input type='hidden' name='" .
            $rcodalu .
            "' id='" .
            $rcodalu .
            "'  value='" .
            $verasis->alu_iCodigo .
            "'>
                   ";

        echo " <button type='button'  class='btn btn-secondary table-condensed' href='#'
            onclick='crearasistenciadiaalumno(\"" .
            $xhora[$semana] .
            "\",\"" .
            $codalumno .
            "\"
            ,\"" .
            $rcodhora .
            $semana .
            $codalumno .
            "\",\"" .
            $rcodestado .
            "\")' 
            name='" .
            $rcodhora .
            $semana .
            $codalumno .
            "' id='" .
            $rcodhora .
            $semana .
            $codalumno .
            "' $ocultarbot>creardia
            </button> ";
        echo '</td>';
    }

    // dd($asistencia);
    if ($sm1 < 1) {
        $mmcod = $codcur . $dia . '1';
        mostrarbotonx($mmcod);
    }
    if ($sm2 < 1) {
        $mmcod = $codcur . $dia . '2';
        mostrarbotonx($mmcod);
    }
    if ($sm3 < 1) {
        $mmcod = $codcur . $dia . '3';
        mostrarbotonx($mmcod);
    }
    if ($sm4 < 1) {
        $mmcod = $codcur . $dia . '4';
        mostrarbotonx($mmcod);
    }
    if ($sm5 < 1) {
        $mmcod = $codcur . $dia . '5';
        mostrarbotonx($mmcod);
    }
    if ($sm6 < 1) {
        $mmcod = $codcur . $dia . '6';
        mostrarbotonx($mmcod);
    }
    if ($sm7 < 1) {
        $mmcod = $codcur . $dia . '7';
        mostrarbotonx($mmcod);
    }
    if ($sm8 < 1) {
        $mmcod = $codcur . $dia . '8';
        mostrarbotonx($mmcod);
    }
    if ($sm9 < 1) {
        $mmcod = $codcur . $dia . '9';
        mostrarbotonx($mmcod);
    }
    if ($sm10 < 1) {
        $mmcod = $codcur . $dia . '10';
        mostrarbotonx($mmcod);
    }
    if ($sm11 < 1) {
        $mmcod = $codcur . $dia . '11';
        mostrarbotonx($mmcod);
    }
    if ($sm12 < 1) {
        $mmcod = $codcur . $dia . '12';
        mostrarbotonx($mmcod);
    }
    if ($sm13 < 1) {
        $mmcod = $codcur . $dia . '13';
        mostrarbotonx($mmcod);
    }
    if ($sm14 < 1) {
        $mmcod = $codcur . $dia . '14';
        mostrarbotonx($mmcod);
    }
    if ($sm15 < 1) {
        $mmcod = $codcur . $dia . '15';
        mostrarbotonx($mmcod);
    }
    if ($sm16 < 1) {
        $mmcod = $codcur . $dia . '16';
        mostrarbotonx($mmcod);
    }
    ///---revisar
    // dd($asistencia);
}
function sqlverasistenciacurso($codcurso, $semestre, $dia, $semana)
{
    $sql = "SELECT 
   `seccion`.`sem_iCodigo`,
   `seccion_horario`.`sec_iCodigo`,
   `seccion_horarioasistencia`.`sechor_iCodigo`,
   `seccion`.`cur_iCodigo`,
   `curso`.`cur_vcNombre`,
   `seccion`.`tur_cCodigo`,
   `seccion_horarioasistencia`.`sechorasi_iHoraFinal`,
   `seccion_horarioasistencia`.`sechorasi_iHoraInicio`,
   `seccion_horarioasistencia`.`dia_vcCodigo`,
   `seccion_horarioasistencia`.`sechorasi_iCodigo`,
   `seccion_horarioasistencia`.`sechorasi_iSemana`,
   `seccion_horarioasistencia`.`sechorasi_dFecha`
 FROM
   `seccion_horario`
   INNER JOIN `seccion_horarioasistencia` ON (`seccion_horario`.`sechor_iCodigo` = `seccion_horarioasistencia`.`sechor_iCodigo`)
   INNER JOIN `seccion` ON (`seccion_horario`.`sec_iCodigo` = `seccion`.`sec_iCodigo`)
   INNER JOIN `curso` ON (`seccion`.`cur_iCodigo` = `curso`.`cur_iCodigo`)
 WHERE
   `seccion`.`cur_iCodigo` = $codcurso AND 
   `seccion`.`sem_iCodigo` = $semestre AND 
   `seccion_horarioasistencia`.`dia_vcCodigo` = '$dia' AND 
   `seccion_horarioasistencia`.`sechorasi_iSemana` = $semana ";

    $data1 = DB::select($sql);
    return $data1;
}
@endphp
<style>
    .table-responsive { 
  height:200px;
  overflow:scroll;
}
    </style>

<div class='card' style='overflow: scroll;'>
  <!--  <div class='card-body tableFixHead table-responsive table-condensed'
        style='height: 600px; width:940px; overflow: scroll;'>
        //-->
        <div class='card-body '>

        <table class='table table-responsive table-condensed '>
            <thead style='background-color:black;color:white;'>
                <tr style='background-color:black;color:white;'>
                    <th>Nro</th>
                    <th>Codigo</th>
                    <th>Nombre</th>
                    @php
                        $codcur=2;
                        $semestreactual=semestreactual();
                        $mixhoras = [];
                        $diax="LUN";
                        for ($x = 1; $x <= 16; $x++) {
                            /// prepara boton de semana
                            $xhora = '';
                            $xdia = '';
                            $fechax1 = '';
                           // $rtphora = sqlverasistenciacurso($codcur, semestreactual(), $diax, $x); //$asistencias->verasistenciacurso($codcur,semestreactual(),$diax,$x);
                           $rtphora = sqlverasistenciacurso($codcur, $semestreactual,"LUN", $x); //$asistencias->verasistenciacurso($codcur,semestreactual(),$diax,$x);
                            foreach ($rtphora as $horaasistencia) {
                                $xhora = $horaasistencia->sechorasi_iCodigo;
                                $xdia = $horaasistencia->dia_vcCodigo;
                                $fechax1 = $horaasistencia->sechorasi_dFecha;
                            }
                            $mixhoras[$x] = $xhora;
                            ///fin semana-- crearsemana(codcur,semana,dia)
                            //  dd($rtphora);
                            echo '<th >
                                   
                                   S' .
                                $x .
                                '
                                 <button type="button"  class="btn btn-secondary table-condensed" href="#"
                                   onclick="crearsemanaasis(\'' .
                                $codcur .
                                '\',\'' .
                                $x .
                                '\',\'' .
                                $diax .
                                '\',\'' .
                                $codcur .
                                $diax .
                                $x .
                                '\',\'' .
                                asset('asistencia') .
                                '\')" 
                                   name="' .
                                $codcur .
                                $diax .
                                $x .
                                '" id="' .
                                $codcur .
                                $diax .
                                $x .
                                '" >+ sem
                                </button>  
                                <input type="hidden" name="" value="' .
                                $x .
                                '">
                                <input type="hidden" name="" value="' .
                                $codcur .
                                '">
                                <input type="hidden" name="" value="' .
                                $diax .
                                '">
                                <input type="hidden" name="" value="' .
                                $xhora .
                                '">';
                            echo $fechax1;
                        
                            //  $mixhoras=$xhora;
                            // echo $mixhoras[$x];
                            echo ' &nbsp;  &nbsp; 
                              
                               </th>';
                        }
                        echo "</tr>
                             </thead>";
                        $misalumnos = sqlvercursosalumnos(trim($codcur), $semestreactual); //$miasistencia->vercursosalumnos(trim($codcur),$semestre);
                        //dd($misalumnos);
                        $nro = 0;
                        foreach ($misalumnos as $alumno) {
                            $nro++;
                            $cod = $alumno->alu_vcCodigo;
                            $estudiante = $alumno->alumno;
                            $email = $alumno->alu_vcEmail;
                            echo "<tr style='color:black'>";
                        
                            echo "<td class='fix1'>$nro</td>
                                 <td class='fix1'>$cod</td>
                                <td class='fix1'>$estudiante</td>
                                
                                 ";
                            // dd($mixhoras);
                            verasis1($alumno->alu_iCodigo, $alumno->sec_iCodigo, 1, 16, $diax, $codcur, $mixhoras);
                            //verasis1($alumno->alu_iCodigo,$alumno->sec_iCodigo,1,16,"LUN");
                            /*  for($x=1;$x<=16;$x++)
                               { echo '<td>
                                           <input type="text" name="" id="" size="2">
                                        </td>';
                                   }
                                 echo "</tr>";*/
                            echo '</tr>';
                        }
                        echo "</table>
                       ";
                    @endphp
 </div>
</div>