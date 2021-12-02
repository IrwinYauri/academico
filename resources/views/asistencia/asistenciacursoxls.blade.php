<button class='btn btn-primary' onclick="$('#micontenido').load('docente/reporteasistencia')"> 
    ver cursos</button> <br>
@php
//use App\Http\Controllers\AsistenciaController; 
//use App\Http\Controllers\DocenteController; 
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$semestreactual=semestreactual();
$gcodcurso="0";
if(isset($_REQUEST["xcod"]))
{$gcodcurso=$_REQUEST["xcod"];}
else {
    return 0;
}
//preparando lista


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

function veralumnomatriculadostotal($codcur,$semestre)
 {$sql =
        "SELECT
count(matricula.alu_iCodigo) as total
FROM
seccion
INNER JOIN matriculadetalle ON matriculadetalle.sec_iCodigo = seccion.sec_iCodigo
INNER JOIN matricula ON matriculadetalle.mat_iCodigo = matricula.mat_iCodigo
WHERE seccion.cur_iCodigo='$codcur' and seccion.sem_iCodigo='$semestre'";
    $data1 = DB::select($sql);
    //  return $data1;
    return $data1[0]->total;
} 
function extraeasistencia($codcurso,$semestre)
{$sql="SELECT
matricula.alu_iCodigo,
seccion_horarioasistencia.sechorasi_dFecha,
seccion.sem_iCodigo,
seccion_horario.sec_iCodigo,
seccion_horarioasistencia.sechor_iCodigo,
seccion_horarioasistencia.dia_vcCodigo,
seccion_horarioasistencia.sechorasi_iCodigo,
seccion_horarioasistencia.sechorasi_iSemana,

seccion_horario.sectip_cCodigo,
matriculadetalle.mat_iCodigo,

(
SELECT
     sechoralu_bPresente
FROM
seccion_horarioalumno
WHERE
        seccion_horarioalumno.sechorasi_iCodigo=seccion_horarioasistencia.sechorasi_iCodigo


     and seccion_horarioalumno.alu_iCodigo=matricula.alu_iCodigo
) AS estado
FROM
seccion_horario
INNER JOIN seccion_horarioasistencia ON (seccion_horario.sechor_iCodigo = seccion_horarioasistencia.sechor_iCodigo)
INNER JOIN seccion ON (seccion_horario.sec_iCodigo = seccion.sec_iCodigo)
INNER JOIN matriculadetalle ON matriculadetalle.sec_iCodigo = seccion.sec_iCodigo
INNER JOIN matricula ON matriculadetalle.mat_iCodigo = matricula.mat_iCodigo
WHERE
            seccion.cur_iCodigo = '$codcurso' AND
            seccion.sem_iCodigo = '$semestre' 
					
ORDER BY
            seccion_horarioasistencia.sechorasi_dFecha ASC";

            $data1=DB::select($sql);  
            return $data1;
}


$listaasis=extraeasistencia($gcodcurso,$semestreactual);
foreach ($listaasis as $nasis) {
  //////////
///
///////
///
///
//preparamos las asistencias

$miasis["$nasis->alu_iCodigo"]["$nasis->sechorasi_dFecha"] =$nasis->estado;
///
  
}

/////------------------------- 
function buscarasistenciafecha($semestre,$codcurso,$fecha,$codalumno){
     $sql="SELECT
     sechoralu_bPresente
FROM
seccion_horario
INNER JOIN seccion_horarioasistencia ON (seccion_horario.sechor_iCodigo = seccion_horarioasistencia.sechor_iCodigo)
INNER JOIN seccion ON (seccion_horario.sec_iCodigo = seccion.sec_iCodigo)
INNER JOIN seccion_horarioalumno ON seccion_horarioalumno.sechorasi_iCodigo = seccion_horarioasistencia.sechorasi_iCodigo
WHERE
     seccion.cur_iCodigo = '$codcurso' AND
     seccion.sem_iCodigo = '$semestre' 
     and seccion_horarioasistencia.sechorasi_dFecha='$fecha'
     and seccion_horarioalumno.alu_iCodigo='$codalumno'
     ";
      $data1=DB::select($sql);  
      if(count($data1)<1)
      return "";
      else
      return $data1[0]->sechoralu_bPresente;
   }
   function fechacursoasistencia($codcurso,$semestre)
           {/*$semana=$cur->sechorasi_iSemana;
    $fecha1=$cur->sechorasi_dFecha;
    $xtipo=$cur->sectip_cCodigo;
    if($semana==1)
    {  $ndia1++;
        if($ndia1==1)
      { $worksheet->getCell('K13')->setValue($fecha1);
        $worksheet->getCell('K16')->setValue($xtipo);
       }*/
               
            $sql="SELECT
            seccion.sem_iCodigo,
            seccion_horario.sec_iCodigo,
            seccion_horarioasistencia.sechor_iCodigo,
            seccion_horarioasistencia.dia_vcCodigo,
            seccion_horarioasistencia.sechorasi_iCodigo,
            seccion_horarioasistencia.sechorasi_iSemana,
            seccion_horarioasistencia.sechorasi_dFecha,
            seccion_horario.sectip_cCodigo
FROM
seccion_horario
INNER JOIN seccion_horarioasistencia ON (seccion_horario.sechor_iCodigo = seccion_horarioasistencia.sechor_iCodigo)
INNER JOIN seccion ON (seccion_horario.sec_iCodigo = seccion.sec_iCodigo)
WHERE
            seccion.cur_iCodigo = '$codcurso' AND
            seccion.sem_iCodigo = '$semestre'
ORDER BY
            seccion_horarioasistencia.sechorasi_dFecha ASC";
                $data1=DB::select($sql); 
                return $data1;

           }

           function buscarcursoescuela($codcurso,$semestre)
   {$sql="SELECT
    seccion.sem_iCodigo,
    seccion.cur_iCodigo,
    curso.cur_vcNombre,
    seccion.tur_cCodigo,
    docente.doc_vcDocumento,
    docente.doc_vcPaterno,
    docente.doc_vcMaterno,
    docente.doc_vcNombre,
    curso.cur_vcCodigo,
    escuelaplan.escpla_iCodigo,
    curso.cur_iSemestre,
    (SELECT `escuela`.`esc_vcNombre` FROM `escuela` where `escuela`.`esc_vcCodigo`=left(curso.cur_vcCodigo,2)) AS escuela,
    turno.tur_vcNombre
    FROM
    seccion
    INNER JOIN curso ON (seccion.cur_iCodigo = curso.cur_iCodigo)
    INNER JOIN docente ON seccion.doc_iCodigo = docente.doc_iCodigo
    INNER JOIN escuelaplan ON curso.escpla_iCodigo = escuelaplan.escpla_iCodigo
    INNER JOIN turno ON seccion.tur_cCodigo = turno.tur_cCodigo
    WHERE
        seccion.cur_iCodigo = '$codcurso' AND
        seccion.sem_iCodigo = '$semestre'";
     $data1=DB::select($sql);    
     return $data1;

   }
//-----------------------------------
/* function verestadoasis($semestre,$codcurso,$fecha,$codalumno){
   // $miasistencia=new AsistenciaController(); 
    //buscarasistenciafecha($semestre,$codcurso,$fecha,$codalumno)
    $estado="";
 //   $asis1=$miasistencia->buscarasistenciafecha($semestre,$codcurso,$fecha,$codalumno);
 $asis1=buscarasistenciafecha($semestre,$codcurso,$fecha,$codalumno);
   // dd($asis1);
    foreach ($asis1 as $asis) {
        $estado=$asis->sechoralu_bPresente;
    }
    return $estado;
  } */

////capturar datos del curso
$xcurso="";
$xescuela="";
$xdocente="";
$xciclo="";
$xturno="";
//$miasistencia=new AsistenciaController(); 
$micursox=buscarcursoescuela($gcodcurso,$semestreactual);

foreach ($micursox as $micurso) {
    $xcurso=$micurso->cur_vcNombre;
    $xescuela=$micurso->escuela;
    $xdocente=$micurso->doc_vcPaterno." ".$micurso->doc_vcMaterno." ".$micurso->doc_vcNombre;
    $xciclo=$micurso->cur_iSemestre;
    $xturno=$micurso->tur_vcNombre;
}
///


//echo verestadoasis(20212,2,'2021-10-25',383);
$tt=0;


//veralumnomatriculados($gcodcurso,$semestreactual);
$tt=veralumnomatriculadostotal($gcodcurso,$semestreactual);
echo "Procesados:".$tt;
//

$spreadsheet = new Spreadsheet();

if($tt<26)
$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load('platillasxls/Plantilla _de_asistencia25.xlsx');

if($tt>25 &&  $tt<51)
$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load('platillasxls/Plantilla _de_asistencia50.xlsx');

if($tt>50)
$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load('platillasxls/Plantilla _de_asistencia75.xlsx');



$worksheet = $spreadsheet->getActiveSheet();

$misemestre=left($semestreactual,4)."-".right($semestreactual,1);



$worksheet->getCell('A9')->setValue($xdocente);
$worksheet->getCell('Q9')->setValue($xescuela);
$worksheet->getCell('AA9')->setValue($xcurso);
$worksheet->getCell('AT9')->setValue(nroromano($xciclo));
$worksheet->getCell('Ax9')->setValue($xturno);
$worksheet->getCell('BC9')->setValue($misemestre);

$letra=array("k","l",	"m",	"n",	"o",	"p",	"q",	"r",	"s",	"t",	"u",	"v",	"w",	"x",	"y",	"z",	"aa",	"ab",	"ac",	"ad",	"ae",	"af",	"ag",	"ah",	"ai",	"aj",	"ak",	"al",	"am",	"an",	"ao",	"ap",	"aq",	"ar",	"as",	"at",	"au",	"av",	"aw",	"ax",	"ay",	"az",	"ba",	"bb",	"bc",	"bd",	"be",	"bf");
//preparamos las lista de alumnmos
$ndia1=0;$ndia2=0;$ndia3=0;$ndia4=0;$ndia5=0;$ndia6=0;$ndia7=0;$ndia8=0;$ndia9=0;$ndia10=0;
$ndia11=0;$ndia12=0;$ndia13=0;$ndia14=0;$ndia15=0;$ndia16=0;
//$miasistencia=new DocenteController(); 
//$misalumnos=$miasistencia->vercursosalumnos($gcodcurso,$semestreactual);
$misalumnos=vercursosalumnos($gcodcurso,$semestreactual);

//$curso=$miasistencia->fechacursoasistencia($gcodcurso,s$semestreactual);
$curso=fechacursoasistencia($gcodcurso,$semestreactual);
$contseman=0;
$apag=0;
/*
$verx1=$worksheet->getCell('BC9')->getValue();
echo "
<script>
    alert('$verx1');
</script>
";  */
//$tletra=count($letra);
foreach ($curso as $cur) {
    
    $semana=$cur->sechorasi_iSemana;
    $fecha1=$cur->sechorasi_dFecha;
    $xtipo=$cur->sectip_cCodigo;
    if($semana==1)
    {  $ndia1++;
        if($ndia1==1)
      { $worksheet->getCell('K13')->setValue($fecha1);
        $worksheet->getCell('K16')->setValue($xtipo);
       }
       if($ndia1==2)
      { $worksheet->getCell('L13')->setValue($fecha1);
        $worksheet->getCell('L16')->setValue($xtipo);}
        if($ndia1==3)
       {$worksheet->getCell('M13')->setValue($fecha1);
       $worksheet->getCell('M16')->setValue($xtipo);
       }
    }
    if($semana==2)
    {$ndia2++;
        if($ndia2==1)
        {$worksheet->getCell('N13')->setValue($fecha1); 
         $worksheet->getCell('N16')->setValue($xtipo); }
        if($ndia2==2)
        {$worksheet->getCell('O13')->setValue($fecha1); 
         $worksheet->getCell('O16')->setValue($xtipo); }   
        if($ndia2==3)
       { $worksheet->getCell('P13')->setValue($fecha1); 
         $worksheet->getCell('P16')->setValue($xtipo);  }     
    }
    if($semana==3)
    {$ndia3++;
        if($ndia3==1)
        {$worksheet->getCell('Q13')->setValue($fecha1); 
        $worksheet->getCell('Q16')->setValue($xtipo);}
        if($ndia3==2)
        {$worksheet->getCell('R13')->setValue($fecha1); 
        $worksheet->getCell('R16')->setValue($xtipo);}
        if($ndia3==3)
        {$worksheet->getCell('S13')->setValue($fecha1); 
        $worksheet->getCell('S16')->setValue($xtipo);}   
    }
    if($semana==4)
    {   $ndia4++;
        if($ndia4==1)
        { $worksheet->getCell('T13')->setValue($fecha1);   
          $worksheet->getCell('T16')->setValue($xtipo);}
        if($ndia4==2)
        {$worksheet->getCell('U13')->setValue($fecha1);  
        $worksheet->getCell('U16')->setValue($xtipo);}
        if($ndia4==3)
        {$worksheet->getCell('V13')->setValue($fecha1);
        $worksheet->getCell('V16')->setValue($xtipo);}   
    }
    if($semana==5)
    {   $ndia5++;
        if($ndia5==1)
        {$worksheet->getCell('W13')->setValue($fecha1); 
         $worksheet->getCell('W16')->setValue($xtipo);}   
        if($ndia5==2)
       {$worksheet->getCell('X13')->setValue($fecha1); 
        $worksheet->getCell('X16')->setValue($xtipo);}   
        if($ndia5==3)
       {$worksheet->getCell('Y13')->setValue($fecha1); 
        $worksheet->getCell('Y16')->setValue($xtipo);}   
    }
    if($semana==6)
    {   $ndia6++;
        if($ndia6==1)
        {$worksheet->getCell('Z13')->setValue($fecha1); 
        $worksheet->getCell('Z16')->setValue($xtipo);}   
        if($ndia6==2)
       { $worksheet->getCell('AA13')->setValue($fecha1); 
        $worksheet->getCell('AA16')->setValue($xtipo);}   
        if($ndia6==3)
       {$worksheet->getCell('AB13')->setValue($fecha1);
        $worksheet->getCell('AB16')->setValue($xtipo);}    
    }
    if($semana==7)
    {   $ndia7++;
        if($ndia7==1)
       {$worksheet->getCell('AC13')->setValue($fecha1); 
        $worksheet->getCell('AC16')->setValue($xtipo);}   
        if($ndia7==2)
        {$worksheet->getCell('AD13')->setValue($fecha1); 
        $worksheet->getCell('AD16')->setValue($xtipo);}   
        if($ndia7==3)
        {$worksheet->getCell('AE13')->setValue($fecha1);
        $worksheet->getCell('AE16')->setValue($xtipo);}    
    }
    if($semana==8)
    {   $ndia8++;
        if($ndia8==1)
       {$worksheet->getCell('AF13')->setValue($fecha1);
        $worksheet->getCell('AF16')->setValue($xtipo);} 
        if($ndia8==2)
       {$worksheet->getCell('AG13')->setValue($fecha1); 
        $worksheet->getCell('AG16')->setValue($xtipo);}
        if($ndia8==3)
        {$worksheet->getCell('AH13')->setValue($fecha1);  
        $worksheet->getCell('AH16')->setValue($xtipo);}  
    }
    if($semana==9)
    {   $ndia9++;
        if($ndia9==1)
       {$worksheet->getCell('AI13')->setValue($fecha1);
        $worksheet->getCell('AI16')->setValue($xtipo);}
       if($ndia9==2)
       {$worksheet->getCell('AJ13')->setValue($fecha1);
        $worksheet->getCell('AJ16')->setValue($xtipo);}
        if($ndia9==3)
        {$worksheet->getCell('AK13')->setValue($fecha1); 
        $worksheet->getCell('AK16')->setValue($xtipo);}   
    }
    if($semana==10)
    {   $ndia10++;
        if($ndia10==1)
       { $worksheet->getCell('AL13')->setValue($fecha1);
         $worksheet->getCell('AL16')->setValue($xtipo);}
        if($ndia10==2)
       {$worksheet->getCell('AM13')->setValue($fecha1);
        $worksheet->getCell('AM16')->setValue($xtipo);}
        if($ndia10==3)
      { $worksheet->getCell('AN13')->setValue($fecha1);  
        $worksheet->getCell('AN16')->setValue($xtipo);}  
    }
    if($semana==11)
    {   $ndia11++;
        if($ndia11==1)
       {$worksheet->getCell('AO13')->setValue($fecha1); 
        $worksheet->getCell('AO16')->setValue($xtipo);}   
        if($ndia11==2)
       {$worksheet->getCell('AP13')->setValue($fecha1);  
        $worksheet->getCell('AP16')->setValue($xtipo);}
        if($ndia11==3)
       {$worksheet->getCell('AQ13')->setValue($fecha1); 
        $worksheet->getCell('AQ16')->setValue($xtipo);}   
    }
    if($semana==12)
    {   $ndia12++;
        if($ndia12==1)
       {$worksheet->getCell('AR13')->setValue($fecha1);  
        $worksheet->getCell('AR16')->setValue($xtipo);}
        if($ndia12==2)
       {$worksheet->getCell('AS13')->setValue($fecha1);
        $worksheet->getCell('AS16')->setValue($xtipo);}  
        if($ndia12==3)
        {$worksheet->getCell('AT13')->setValue($fecha1); 
        $worksheet->getCell('AT16')->setValue($xtipo);}   
    }
    if($semana==13)
    {   $ndia13++;
        if($ndia13==1)
       {$worksheet->getCell('AU13')->setValue($fecha1); 
        $worksheet->getCell('AU16')->setValue($xtipo);}  
        if($ndia13==2)
       {$worksheet->getCell('AV13')->setValue($fecha1);
        $worksheet->getCell('AV16')->setValue($xtipo);}
        if($ndia13==3)
       {$worksheet->getCell('AW13')->setValue($fecha1);
        $worksheet->getCell('AW16')->setValue($xtipo);} 
    }
    if($semana==14)
    {   $ndia14++;
        if($ndia14==1)
       {$worksheet->getCell('AX13')->setValue($fecha1); 
        $worksheet->getCell('AX16')->setValue($xtipo);} 
        if($ndia14==2)
       { $worksheet->getCell('AY13')->setValue($fecha1);  
        $worksheet->getCell('AY16')->setValue($xtipo);}
        if($ndia14==3)
       {$worksheet->getCell('AZ13')->setValue($fecha1); 
        $worksheet->getCell('AZ16')->setValue($xtipo);}

    }
    if($semana==15)
    {   $ndia15++;
        if($ndia15==1)
       {$worksheet->getCell('BA13')->setValue($fecha1);  
        $worksheet->getCell('BA16')->setValue($xtipo);}
        if($ndia15==2)
        {$worksheet->getCell('BB13')->setValue($fecha1); 
        $worksheet->getCell('BB16')->setValue($xtipo);} 
        if($ndia15==3)
       { $worksheet->getCell('BC13')->setValue($fecha1); 
        $worksheet->getCell('BC16')->setValue($xtipo);}   
    }
    if($semana==16)
    {   $ndia16++;
        if($ndia16==1)
       { $worksheet->getCell('BD13')->setValue($fecha1); 
        $worksheet->getCell('BD16')->setValue($xtipo);} 
        if($ndia16==2)
       {$worksheet->getCell('BE13')->setValue($fecha1);
        $worksheet->getCell('BE16')->setValue($xtipo);} 
        if($ndia16==3)
       { $worksheet->getCell('BF13')->setValue($fecha1);
        $worksheet->getCell('BF16')->setValue($xtipo);}   
    }
    

}





$nn=0;
$nro=16;
    foreach ($misalumnos as $alumno) {
      $nro++;
      $nn++;
     // if($nn<3)
      {
      $cod=$alumno->alu_vcCodigo;
      $xcodalu=$alumno->alu_iCodigo;
      $estudiante=$alumno->alumno;
      $email=$alumno->alu_vcEmail;
 /*    echo "<tr style='color:black'>
          <td>$nro</td>
          <td>$cod</td>
         <td>$estudiante</td>
         <td>$email</td>
        </tr>"; */
        $worksheet->getCell('A'.$nro)->setValue($nn);
        $worksheet->getCell('B'.$nro)->setValue($cod);
        $worksheet->getCell('E'.$nro)->setValue($estudiante);


        $xletra="";
        $xlfecha="";
        $buscfecha="";
        for($x=0;$x<count($letra);$x++)
        { $xletra=strtoupper($letra[$x].$nro);
          $xlfecha=strtoupper($letra[$x]."13");
          $buscfecha= $worksheet->getCell($xlfecha)->getValue();
         // echo "<br>*".$buscfecha;
          
         //xxxx $xestado=verestadoasis(semestreactual(),$gcodcurso,$buscfecha, $xcod);
         $xestado="";
   // $xestado=buscarasistenciafecha($semestreactual,$gcodcurso,$buscfecha,$xcodalu);
         // echo "<br>*".$xestado;
         //prueb
      if(isset($miasis["$xcodalu"]["$buscfecha"]))
        { $xestado= $miasis["$xcodalu"]["$buscfecha"] ;

    } 
   
          if(strlen($xestado)>0)
         $xestado=left($xestado,1);

          $worksheet->getCell($xletra)->setValue($xestado);
         }

     
       /* $xestado=verestadoasis(semestreactual(),2,'2021-10-25', $xcod);
        if(strlen($xestado)>0)
         $xestado=left($xestado,1); */
                 // buscarasistenciafecha($semestre,$codcurso,$fecha,$codalumno)
       // $worksheet->getCell('k'.$nro)->setValue($xestado);

       //echo "<br>".count($letra);
       
        if($nn==25)
        $nro=67;
        if($nn==50)
        $nro=118;

        }
      
    }
//$worksheet->getCell('E17')->setValue('fer');
//$worksheet->getCell('E18')->setValue('carlos');



$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xls');
$writer->save('rptplatillasxls/Plantilla _de_asistencia25.xls');
//readfile('rptplatillasxls/Plantilla _de_asistencia25.xls');


echo "<script>
  //  window.open('../rptplatillasxls/Plantilla _de_asistencia25.xls').focus();
    //location.href='../rptplatillasxls/Plantilla _de_asistencia25.xls' 
    location.href='rptplatillasxls/Plantilla _de_asistencia25.xls' 
</script>";



@endphp

 <!-- Bootstrap core JavaScript-->
 <script src="{{ asset('vendor/jquery/jquery.min.js')}}"></script>
 <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

 <!-- Core plugin JavaScript-->
 <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

 <!-- Custom scripts for all pages-->
 <script src="{{ asset('js/sb-admin-2.min.js')}}"></script>

 <!-- Page level plugins -->
 <script src="{{ asset('vendor/chart.js/Chart.min.js')}}"></script>

 <!-- Page level custom scripts -->
 <script src="{{ asset('js/demo/chart-area-demo.js')}}"></script>
 <script src="{{ asset('js/demo/chart-pie-demo.js')}}"></script>