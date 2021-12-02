@php
 session_start();
 $coddocentex="";
 if(isset($_SESSION['coddocentex'])){
  $coddocentex=$_SESSION['coddocentex'];
 }
 
 function  vercursosalumnos($codcurso,$semestre)
  { 
      $sql='SELECT 
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
 function vercargahoraria($coddocente,$semestre)
  { 

    //session_start();

   // $coddocentex=$_SESSION['coddocentex'];
   // $semestre=semestreactual();

    $sql='
      SELECT
      seccion_horario.sec_iCodigo,
      seccion_horario.dia_vcCodigo,
      seccion_horario.sechor_iHoraInicio,
      seccion_horario.sechor_iHoraFinal,
      seccion_horario.sectip_cCodigo,
      docente.doc_vcDocumento,
      docente.doc_vcPaterno,
      docente.doc_vcMaterno,
      docente.doc_vcNombre,
      seccion.sem_iCodigo,
      seccion.cur_iCodigo,
      curso.cur_vcNombre,
      seccion.tur_cCodigo,
      seccion_horario.doc_iCodigo,
      seccion_horario.sechor_iCodigo,
      curso.escpla_iCodigo,
      escuela.esc_vcNombre,
      escuela.esc_vcCodigo,
      curso.cur_iSemestre,
      seccion.sec_iNumero,
      cursotipodictado.curdic_vcNombre AS tipodictado,
      seccion.sec_iCodigo,
      seccion_horario.aul_iCodigo,
      aula.loc_iCodigo,
      aula.aul_vcCodigo,
      `local`.loc_vcNombre,
      curso.cur_vcCodigo,
      cursohoras.curhor_iHoras,
      docentedepaca.depaca_vcNombre,
      docente.cateDocente,
      concat(docente.doc_vcPaterno," ",
      docente.doc_vcMaterno," ",
      docente.doc_vcNombre) as docente
      FROM
      seccion_horario
      INNER JOIN docente ON (seccion_horario.doc_iCodigo = docente.doc_iCodigo)
      INNER JOIN seccion ON (seccion_horario.sec_iCodigo = seccion.sec_iCodigo)
      INNER JOIN curso ON (seccion.cur_iCodigo = curso.cur_iCodigo)
      INNER JOIN escuelaplan ON (curso.escpla_iCodigo = escuelaplan.escpla_iCodigo)
      INNER JOIN escuela ON (escuelaplan.esc_vcCodigo = escuela.esc_vcCodigo)
      INNER JOIN cursotipodictado ON (seccion_horario.sectip_cCodigo = cursotipodictado.curdic_cCodigo)
      INNER JOIN aula ON (seccion_horario.aul_iCodigo = aula.aul_iCodigo)
      INNER JOIN `local` ON (aula.loc_iCodigo = `local`.loc_iCodigo)
      INNER JOIN cursohoras ON cursohoras.cur_iCodigo = curso.cur_iCodigo AND cursohoras.curdic_cCodigo = cursotipodictado.curdic_cCodigo
      INNER JOIN docentedepaca ON docente.depaca_iCodigo = docentedepaca.depaca_iCodigo
      WHERE
      seccion.sem_iCodigo = "'.$semestre.'" AND 
      seccion_horario.doc_iCodigo = "'.$coddocente.'"
      ORDER BY
      curso.cur_vcCodigo,  
      seccion_horario.dia_vcCodigo';
    
    $listahora=DB::select($sql);
    return $listahora;
   // return view("docente.completarasistencia", compact('listahora','coddocentex')); 
 }

 //use App\Http\Controllers\DocenteController; 
 //use App\Http\Controllers\AsistenciaController; 
 //$miasistencia=new DocenteController();  
// $listahora= $miasistencia->vercargahoraria($coddocentex,semestreactual());
$listahora= vercargahoraria($coddocentex,semestreactual());
 //dd($listahora);
 $dia=verdiaactualsemana();

 //asistenciaalumnodia($codcurso,$codalumno,$fecha,$tipo)
 function asistenciaalumnodia($codcurso,$codalumno,$fecha,$tipo)
   {$sql="SELECT 
    `seccion`.`sem_iCodigo`,
    `seccion`.`cur_iCodigo`,
    `seccion_horarioasistencia`.`dia_iNumero`,
    `seccion_horarioasistencia`.`dia_vcCodigo`,
    `seccion_horarioasistencia`.`sechorasi_iSemana`,
    `seccion_horarioalumno`.`alu_iCodigo`,
    `curso`.`cur_vcNombre`,
    `alumno`.`alu_vcPaterno`,
    `alumno`.`alu_vcMaterno`,
    `alumno`.`alu_vcNombre`,
    `alumno`.`alu_icodigo`,
    `seccion`.`tur_cCodigo`,
    `seccion_horario`.`sectip_cCodigo`,
    `seccion_horario`.`sec_iCodigo`,
    `seccion_horarioasistencia`.`sechorasi_dFecha`,
    `seccion_horarioalumno`.`sechoralu_bPresente`, 
    `seccion_horarioasistencia`.`sechorasi_iCodigo`
  FROM
    `seccion`
    INNER JOIN `seccion_horario` ON (`seccion`.`sec_iCodigo` = `seccion_horario`.`sec_iCodigo`)
    INNER JOIN `seccion_horarioasistencia` ON (`seccion_horarioasistencia`.`sechor_iCodigo` = `seccion_horario`.`sechor_iCodigo`)
    INNER JOIN `seccion_horarioalumno` ON (`seccion_horarioalumno`.`sechorasi_iCodigo` = `seccion_horarioasistencia`.`sechorasi_iCodigo`)
    INNER JOIN `curso` ON (`seccion`.`cur_iCodigo` = `curso`.`cur_iCodigo`)
    INNER JOIN `alumno` ON (`seccion_horarioalumno`.`alu_iCodigo` = `alumno`.`alu_iCodigo`)
  WHERE
    `seccion`.`cur_iCodigo` = '$codcurso' AND 
    `alumno`.`alu_icodigo` ='$codalumno' AND 
    `seccion_horario`.`sectip_cCodigo` LIKE '$tipo%' AND 
    `seccion_horarioasistencia`.`sechorasi_dFecha` = '$fecha'";
    $data1=DB::select($sql);    
     return $data1;
   }
   function nrosemanaasistencia($codcurso,$fecha,$tipo)
   {$sql="SELECT 
    `seccion`.`sem_iCodigo`,
    `seccion`.`cur_iCodigo`,
    `seccion_horarioasistencia`.`dia_iNumero`,
    `seccion_horarioasistencia`.`dia_vcCodigo`,
    `seccion_horarioasistencia`.`sechorasi_iSemana`,
    `curso`.`cur_vcNombre`,
    `seccion`.`tur_cCodigo`,
    `seccion_horario`.`sectip_cCodigo`,
    `seccion_horario`.`sec_iCodigo`,
    `seccion_horarioasistencia`.`sechorasi_dFecha`,
    `seccion_horarioasistencia`.`sechorasi_iCodigo`
  FROM
    `seccion`
    INNER JOIN `seccion_horario` ON (`seccion`.`sec_iCodigo` = `seccion_horario`.`sec_iCodigo`)
    INNER JOIN `seccion_horarioasistencia` ON (`seccion_horarioasistencia`.`sechor_iCodigo` = `seccion_horario`.`sechor_iCodigo`)
    INNER JOIN `curso` ON (`seccion`.`cur_iCodigo` = `curso`.`cur_iCodigo`)
  WHERE
    `seccion`.`cur_iCodigo` = '$codcurso' AND 
    `seccion_horario`.`sectip_cCodigo` LIKE '$tipo%' AND 
    `seccion_horarioasistencia`.`sechorasi_dFecha` = '$fecha'";
    $data1=DB::select($sql);    
     return $data1;
   }
   function totalasisdia($codcurso,$codalumno,$fecha,$tipo)
   {$sql="SELECT 
    count(*) as total
  FROM
    `seccion`
    INNER JOIN `seccion_horario` ON (`seccion`.`sec_iCodigo` = `seccion_horario`.`sec_iCodigo`)
    INNER JOIN `seccion_horarioasistencia` ON (`seccion_horarioasistencia`.`sechor_iCodigo` = `seccion_horario`.`sechor_iCodigo`)
    INNER JOIN `seccion_horarioalumno` ON (`seccion_horarioalumno`.`sechorasi_iCodigo` = `seccion_horarioasistencia`.`sechorasi_iCodigo`)
    INNER JOIN `curso` ON (`seccion`.`cur_iCodigo` = `curso`.`cur_iCodigo`)
    INNER JOIN `alumno` ON (`seccion_horarioalumno`.`alu_iCodigo` = `alumno`.`alu_iCodigo`)
  WHERE
    `seccion`.`cur_iCodigo` = '$codcurso' AND 
   
    `seccion_horario`.`sectip_cCodigo` LIKE '$tipo%' AND 
    `seccion_horarioasistencia`.`sechorasi_dFecha` = '$fecha'";
    $data1=DB::select($sql);    
     return $data1;
   }
 function verdiaasis($codcurso,$codalumno,$fecha,$tipo)
    { $estado="";
    //   $diasis=new AsistenciaController();
  //  $rdiasis=$diasis->asistenciaalumnodia($codcurso,$codalumno,$fecha,$tipo);
    $rdiasis=asistenciaalumnodia($codcurso,$codalumno,$fecha,$tipo);
        foreach ($rdiasis as $asis) {
            $estado= $asis->sechoralu_bPresente;
        }
        return $estado;
    }
    function verdiahoracod($codcurso,$codalumno,$fecha,$tipo)
    { $estado="";
    //  $diasis=new AsistenciaController();
     // $rdiasis=$diasis->asistenciaalumnodia($codcurso,$codalumno,$fecha,$tipo);
     $rdiasis=asistenciaalumnodia($codcurso,$codalumno,$fecha,$tipo);
    //dd($rdiasis);
        foreach ($rdiasis as $asis) {
            $estado= $asis->sechorasi_iCodigo;
        }
   
    return $estado;
    }
    function verdianrosemana($codcurso,$fecha,$tipo)
    {  $estado="";
      // $diasis=new AsistenciaController();
       //nrosemanaasistencia($codcurso,$fecha,$tipo)
    //  $rdiasis=$diasis->nrosemanaasistencia($codcurso,$fecha,$tipo);
      $rdiasis=nrosemanaasistencia($codcurso,$fecha,$tipo);
      //dd($rdiasis);
       $semana="";
        foreach ($rdiasis as $asis) {
            $estado= $asis->sechorasi_iSemana;
        }
   
       return $estado;
    }
    function verdianrodia($codcurso,$fecha,$tipo)
    {  $estado="";
     //  $diasis=new AsistenciaController();
       //nrosemanaasistencia($codcurso,$fecha,$tipo)
   //   $rdiasis=$diasis->nrosemanaasistencia($codcurso,$fecha,$tipo);
      $rdiasis=nrosemanaasistencia($codcurso,$fecha,$tipo);
      //dd($rdiasis);
       $semana="";
        foreach ($rdiasis as $asis) {
            $estado= $asis->dia_vcCodigo;
        }
   
       return $estado;
    }

    function cantidadasis($codcurso,$codalumno,$fecha,$tipo)
    { $estado="";
       // $diasis=new AsistenciaController();
    //$rdiasis=$diasis->totalasisdia($codcurso,$codalumno,$fecha,$tipo);
    $rdiasis=totalasisdia($codcurso,$codalumno,$fecha,$tipo);
    //dd($rdiasis);
        foreach ($rdiasis as $asis) {
            $estado= $asis->total;
        }
        
    return $estado;
    }

    
 
 //verdiaasis(2,447,'2021-09-01','');
 function veralumnomatriculados($codcur,$semestre,$teoria,$fecha)
 {//$miasistencia=new DocenteController(); 

   echo "<table class='table table-striped table-hover'>
    <thead>
       <tr style='background-color:navy;color:white;'>
    <td>Nro</td> <td>Codigo</td> <td>Nombre</td><td>Operacion</td><td>Estado</td>
  </tr>
  <thead>
    <tbody>
  ";
   //$misalumnos=$miasistencia->vercursosalumnos($codcur,$semestre);
   $misalumnos=vercursosalumnos($codcur,$semestre);
   $rcodhora="";
    $nro=0;
    //dd($misalumnos);
    foreach ($misalumnos as $alumno) {
      $nro++;
      $cod=$alumno->alu_vcCodigo;
      $cod1=$alumno->alu_iCodigo;
      $estudiante=$alumno->alumno;
      $email=$alumno->alu_vcEmail;
      $rcodhora=verdiahoracod($codcur,$cod1,$fecha,$teoria);
     echo "<tr style='color:black'>
          <td>$nro</td>
          <td>$cod</td>
         <td>$estudiante</td>
         <td>
            <button type='button' class='btn btn-success ' onclick='marcarasistencia( \"tnx$nro\",\"Presente\");
            editarasis(\"".$rcodhora."\",\"".$cod1."\",\"PRESENTE\");'>
                         Presente
                                      
                                    </button>
            <button type='button'  class='btn btn-danger ' onclick='marcarasistencia( \"tnx$nro\",\"FALTA\");
            editarasis(\"".$rcodhora."\",\"".$cod1."\",\"FALTA\");'>
                                      
                                        <span class='text'>Falta</span>
                                    </button>
            </td>
            <td id='tnx$nro'>";
               echo '<span class="badge badge-pill badge-info" style="font-size: 14px;">'; 
                $miestado=strtoupper(left(verdiaasis($codcur,$cod1,$fecha,$teoria),1));//captura estad p O f
              //  echo  $miestado;
                if($miestado=="P" or $miestado=="")
                echo "PRESENTE";
                if($miestado=="F")
                echo "FALTA";
                if($miestado=="J")
                echo "JUSTIFICADO";
           //    echo $rcodhora;
                
              //   echo $fecha;
               /* echo "--".$miestado.$cod1;
                echo $teoria;*/
             //   echo"   <select name='".$rcodestado."' id='".$rcodestado."' value='".$verasis->estado."' onchange='editarasis(this,\"".$rcodhora."\",\"".$xcodalu."\",\"".$rcodestado."\")'  ".$ocultar."><option value='P'>P</option><option value='F'>F</option><option value='J'>J</option></select>
             //<input type='hidden' name='".$rcodhora."' id='".$rcodhora."'  value='".$verasis->sechorasi_iCodigo."'>
             //<input type='hidden' name='".$rcodalu."' id='".$rcodalu."'  value='".$verasis->alu_iCodigo."'>
            echo "</span>";
               echo  "</td>
        </tr>";
    }
echo "  </tbody></table>";
echo "<script>
document.getElementById('mialumno').innerHTML='".$nro."'
</script>";
//fin de la funcion
}  
@endphp

<script>
    function marcarasistencia(id,estado)
    { document.getElementById(id).innerHTML =estado;
       }
  </script>
    @php
    $nn=0;

@endphp
@foreach($listahora as $listacur)
@php
$nn++;
@endphp
                 
@endforeach

@php
//inicio  mostrar
$nn=0;
$activarclase=0;

$mytime = Carbon\Carbon::now();
$comparahora=$mytime->toDateTimeString();
//echo "<br>".$comparahora;
$hora=left(right($comparahora,8),5);
$fecha=left($comparahora,10);
$horac=left($hora,2);
$minutoc=right(left($hora,5),2);
$horacc=$horac.$minutoc;
$teoria="";
$micodcurso="";
//echo "<br>".$fecha;
//    echo "$hora<br>sss";

//dd($listahora);
foreach($listahora as $listacur)
{if($listacur->dia_vcCodigo==$dia)
  { //echo "<pre>";
      
  $hora1=left($listacur->sechor_iHoraInicio,2);
  $hora2=left($listacur->sechor_iHoraFinal,2);
  $minuto1=right(left($listacur->sechor_iHoraInicio,5),2);
  $minuto2=right(left($listacur->sechor_iHoraFinal,5),2);
  
 
  $hora01= $hora1.$minuto1;
  $hora02= $hora2.$minuto2;
//echo "<br>".$horacc."--".$hora01;
//echo "<br>".$horacc."--".$hora02;
       if($horacc*1>=$hora01*1 && $horacc*1<=$hora02*1)
       { 
           $activarclase=1;
   /*     echo "<br><pre>Encontrado:";
        echo "<br>".$listacur->dia_vcCodigo;
        echo "<br>".$listacur->sechor_iHoraInicio;
        echo "<br>".$listacur->sechor_iHoraFinal;

        echo "<br>".$listacur->cur_vcNombre;
        echo "<br>".$listacur->tipodictado;
        echo "<br>".$listacur->sec_iNumero;
        echo "<br>".$listacur->depaca_vcNombre;
        echo "<br>".$listacur->cateDocente;
//   print_r($datetime1);
       echo "--</pre>"; */
       $teoria=$listacur->tipodictado;
       $micodcurso= $listacur->cur_iCodigo;
       $ttipodic=$listacur->tipodictado;
       echo "<script>
        document.getElementById('micurso').innerHTML='$listacur->cur_vcNombre';
        document.getElementById('mihoracurso').innerHTML='".($listacur->curhor_iHoras*16)." HORAS';
        document.getElementById('mientrada').innerHTML='".$listacur->sechor_iHoraInicio."-".$listacur->sechor_iHoraFinal."';
        document.getElementById('miteoria').innerHTML='".$ttipodic."';
        document.getElementById('miescuela').innerHTML='".$listacur->esc_vcNombre."';
        document.getElementById('midocente').innerHTML='".$listacur->docente." - ".$listacur->cateDocente."';
        document.getElementById('midepartamento').innerHTML='".$listacur->depaca_vcNombre."';
        </script>
        ";
           
       }
  }
}
/*    echo "<br>activando:".$activarclase;
echo "<br>xx". $fecha;
echo "<br>". $hora ;*/
/*         dd($listahora);
echo $dia;
echo "00000<br>" ;*/
//fin mostrar

@endphp

<div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">.::Control de Asistencia de Alumnos::.</h1>
                       
                    </div>
                    @php
                    if($activarclase==0)
                    {echo  '<div class="row">

                    <div class="alert alert-danger">
                    <strong>SISTEMA:</strong> En este momento no tiene cursos que dictar. No puede tomar asistencia.
                    </div>
                    </div>';
                    return "0";
                }
                @endphp
                    <div class="row">
<div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                CURSO EN CLASES</div>
                                            <div class="text-xs font-weight-bold text-dark-400" id="micurso">MATEMATICA </div>
                                            <div class="text-xs font-weight-bold text-dark-400" id="mihoracurso">-</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-dark-400"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                         <!-- Earnings (Annual) Card Example -->
                         <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                               HORARIO ACTIVO</div>
                                            <div class="text-xs font-weight-bold text-gray-800" id="mientrada">8:00 - 9:00</div>
                                            <div class="text-xs font-weight-bold text-gray-800" id="miteoria">TEO</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clock fa-2x text-dark-400"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tasks Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Escuela
                                            </div>
                                            <div class="text-xs font-weight-bold text-gray-800" id="miescuela">admin</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-dark-400"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                         <!-- Pending Requests Card Example -->
                         <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Alumnos</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="mialumno">10</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-border-all fa-2x text-dark-400"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-6 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-4">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1 text-dark">
                                                TEMA</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <input type="text" class="form-control bg-light border-0 small" placeholder="Ingresar tema..."
                                                aria-label="Search" aria-describedby="basic-addon2">
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-file-alt fa-2x text-dark-400"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-4">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1 ">
                                                DOCENTE</div>
                                            <div class="text-xs font-weight-bold text-gray-800" id="midocente">
                                                POCOY
                                            </div>
                                            <div class="text-xs font-weight-bold text-gray-800" id="midepartamento">
                                                DEPART
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user-tie fa-2x text-dark-400"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
</div>
<script src="{{ asset('vendor/jquery/jquery.min.js')}}"></script>
<script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>
<script src="{{ asset('js/panelasistencia.js')}}"></script>
@php
$xsemana="";
$xdia="";
 $rcantidad=cantidadasis($micodcurso,"",$fecha,left($ttipodic,1));
 $xsemana=verdianrosemana($micodcurso,$fecha,left($ttipodic,1));
 $xdia= verdianrodia($micodcurso,$fecha,left($ttipodic,1));
 if($rcantidad==0)
   {echo "<h5>CREANDO ASISTENCIA DEL DIA</h5>";
   echo "
    <script>
   //     alert(5)
     crearsemanaactual('$micodcurso', '$xsemana','$xdia')
     
    </script>";    
}

   //     dd($r);
  // echo $rcantidad;   

@endphp


            <div class="row">
                @php
                    //veralumnomatriculados(22,semestreactual(),left($teoria,1),$fecha);
                    veralumnomatriculados( $micodcurso,semestreactual(),left($teoria,1),$fecha);
                @endphp
            </div>
           
            <script>
    function editarasis(codhora,codalumno,estado)
  	{
  		//alert(idhora);
    /*	var hora=document.getElementById(idhora).value;
  		// var alumno=document.getElementById(idalumno).value;
  		var alumno=idalumno;
   		var estado=elemento.value;*/
   		//editar 
   	//	if(estado.substring(0, 1).toUpperCase().trim()=="P" || estado.substring(0, 1).toUpperCase().trim()=="F" || estado.substring(0, 1).toUpperCase().trim()=="J" )
     	{
     		//alert(hora.concat(":",alumno,":",estado.substring(0, 1)));
            // updateasistenciadia(hora,alumno,estado);
       		updateasistenciadia(codhora,codalumno,estado);
      	}
      	//else{}
   }
            </script>
         <div id="mimensajex">GRABANDO</div>
            <script>
                function alertagrabar(t) {
                  var x = document.getElementById("snackbar");
                  x.value=t;
                  x.className = "show";
                  setTimeout(function(){ x.className = x.className.replace("show", ""); }, 2000);
                }///mstar
                </script>
          