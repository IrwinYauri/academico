

@php
use App\Models\Silabus;
use App\Models\Escuela;

//use App\Http\Controllers\AsistenciaController;
//use App\Http\Controllers\DocenteController;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$gcodcurso=0;
$semestre=0;

$tt = 0;

if(isset($_REQUEST["semestre"]))
{$semestre=$_REQUEST["semestre"];
}else {
    echo "NO EXISTE semestre"; 
    return "";
    }
if(isset($_REQUEST["xcod"]))
{$gcodcurso=$_REQUEST["xcod"];
}
else {
    echo "NO EXISTE curso";
    return "";
    }
    if(isset($_REQUEST["coddocente"]))
{ $coddocente=$_REQUEST["coddocente"];
}
else {
    echo "NO EXISTE docente";
    return "";
    }
   
//preparando lista
function sqltotalfecha($codcurso,$semestre)
{$sql="
SELECT
count(seccion_horarioasistencia.sechorasi_dFecha) as totaldia
FROM
seccion_horario
INNER JOIN seccion_horarioasistencia ON (seccion_horario.sechor_iCodigo = seccion_horarioasistencia.sechor_iCodigo)
INNER JOIN seccion ON (seccion_horario.sec_iCodigo = seccion.sec_iCodigo)
WHERE
seccion.cur_iCodigo = '$codcurso' AND
seccion.sem_iCodigo = '$semestre'";
$data1=DB::select($sql); 
return $data1[0]->totaldia;
}

function verndia($codcurso,$semestre,$codalumno)
{$sql="SELECT


count(seccion_horarioalumno.alu_iCodigo) as nrodia


FROM
     seccion_horario
     INNER JOIN seccion_horarioasistencia ON (seccion_horario.sechor_iCodigo = seccion_horarioasistencia.sechor_iCodigo)
     INNER JOIN seccion ON (seccion_horario.sec_iCodigo = seccion.sec_iCodigo)
     INNER JOIN curso ON (seccion.cur_iCodigo = curso.cur_iCodigo)
     INNER JOIN seccion_horarioalumno ON seccion_horarioalumno.sechorasi_iCodigo = seccion_horarioasistencia.sechorasi_iCodigo
     INNER JOIN alumno ON alumno.alu_iCodigo = seccion_horarioalumno.alu_iCodigo
WHERE
     seccion.cur_iCodigo = '$codcurso' AND
     seccion.sem_iCodigo = '$semestre' 
 and (left(seccion_horarioalumno.sechoralu_bPresente,1)='P' OR left(seccion_horarioalumno.sechoralu_bPresente,1)='J')
 and seccion_horarioalumno.alu_iCodigo='$codalumno'";
 $data1=DB::select($sql); 
return $data1[0]->nrodia;
}


function sqlvercursosalumnos($codcur, $semestre,$coddocente)
{
   $sql =
      'SELECT 
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
        seccion.doc_iCodigo = "'.$coddocente.'" AND  seccion.sem_iCodigo = "'.$semestre.'" AND 
        `seccion`.`cur_iCodigo` = "'.$codcur.'"
        order by `alumno`.`alu_vcPaterno`';
      

    $data1 = DB::select($sql);

    return $data1;
}

///-fin
function sqlbuscarcursoescuela($codcurso,$semestre)
   {$sql="SELECT
    seccion.sem_iCodigo,
    seccion.cur_iCodigo,
    seccion.sec_iCodigo,
    curso.cur_vcNombre,
    seccion.tur_cCodigo,
    docente.doc_vcDocumento,
    docente.doc_vcPaterno,
    docente.doc_vcMaterno,
    docente.doc_vcNombre,
    curso.cur_vcCodigo,
    escuelaplan.escpla_iCodigo,
    escuelaplan.esc_vcCodigo,
    curso.cur_iSemestre,
    (SELECT `escuela`.`esc_vcNombre` FROM `escuela` where `escuela`.`esc_vcCodigo`=left(curso.cur_vcCodigo,2)) AS escuela,
    turno.tur_vcNombre,
    cur_fCredito
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
   //--
  
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
        if(count($r)<1)
      {  echo "no hay datos revisar semestre,curso";
          return "";} 
      
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

        
        if(count($r)<1)
      {  echo "no hay datos revisar semestre,curso";
          return "";} 

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
    $r =DB::table('curso')
        ->select('silabus.tipoPU1', 'silabus.tipoPU2', 'silabus.tipoPU3', 'silabus.tipoPU4', 'silabus.tipoPU5')
        ->join('seccion', 'seccion.cur_iCodigo', '=', 'curso.cur_iCodigo')
        ->join('silabus', 'silabus.sec_iCodigo', '=', 'seccion.sec_iCodigo')
        ->where(['seccion.sem_iCodigo' => $sem, 'curso.cur_iCodigo' => $codcurso])
        ->get();
       
        if(count($r)<1)
      {  echo "no hay datos revisar semestre,curso";
          return "";} 

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
//////

////capturar datos del curso

$xcurso = '';
$xescuela = '';
$xdocente = '';
$xciclo = '';
$xturno = '';
$codcursox='';
$creditos='';
$planestudio='';
$seccioncod='';

//$miasistencia = new AsistenciaController();
//$micursox = $miasistencia->buscarcursoescuela($gcodcurso, semestreactual());
//$tt = 0;
//$semestreactual=semestreactual();
$semestreactual=$semestre;
$sem=$semestreactual;
$codcurso=$gcodcurso;
//$coddocente=$coddocente;

$micursox =sqlbuscarcursoescuela($gcodcurso, $semestreactual,$coddocente); //cargando datos del curso codigo docente

$ttunidad = verunidad($semestreactual, $gcodcurso);


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


$xfomula01 = formulapf($sem, $codcurso, 1); //tipo  arit o pesos
$xfomula02 = formulapf($sem, $codcurso, 2); //fomular

$xfomulaunidad01 = versilabusformula($sem, $codcurso, 1);
$xfomulaunidad02 = versilabusformula($sem, $codcurso, 2);
$xfomulaunidad03 = versilabusformula($sem, $codcurso, 3);
$xfomulaunidad04 = versilabusformula($sem, $codcurso, 4);
$xfomulaunidad05 = versilabusformula($sem, $codcurso, 5);


        $promediox1 = 0;
         $promediox2 = 0;
         $promediox3 = 0;
        $promediox4 = 0;
        $promediox5 = 0;
         $n = 0;

/////        INICIO DE PROGRAMA MOSTRANDO LO ALUMNOS
foreach ($micursox as $micurso) {
    $xcurso = $micurso->cur_vcNombre;
    $xescuela = $micurso->escuela;
    $xdocente = $micurso->doc_vcPaterno . ' ' . $micurso->doc_vcMaterno . ' ' . $micurso->doc_vcNombre;
    $xciclo = $micurso->cur_iSemestre;
    $xturno = $micurso->tur_vcNombre;
    $codcursox=$micurso->cur_vcCodigo;
    $creditos=$micurso->cur_fCredito;
    $planestudio=$micurso->esc_vcCodigo;//plan estudio
    $seccioncod=$micurso->sec_iCodigo;
}

$totalfecha=sqltotalfecha($gcodcurso,$semestreactual);  //total de clases

///
//echo verestadoasis(20212,2,'2021-10-25',383);

//veralumnomatriculados($gcodcurso, semestreactual());
//$tt = veralumnomatriculadostotal($gcodcurso, semestreactual());
//
@endphp



@php
$misalumnos=sqlvercursosalumnos($gcodcurso,$semestre,$coddocente);
//dd($misalumnos);
$tt=count($misalumnos);
if($tt<1)
{echo "No coniene alumnos";
    return "No coniene alumnos";
}
echo "Alumnos Procesados:".$tt;

    $spreadsheet = new Spreadsheet();

if ($tt*1 > 0  && $tt*1 < 26 ) {
    $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load('platillasxls/Acta25_unaat.xls');
}

if ($tt*1 > 25 && $tt*1 < 51) {
    $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load('platillasxls/Acta50_unaat.xls');
}

if ($tt > 50) {
    $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load('platillasxls/Acta75_unaat.xls');
}



$worksheet = $spreadsheet->getActiveSheet();
$Xsem=semestreactual();
$misemestre = left($Xsem, 4) . '-' . right($Xsem, 1);

//$worksheet->getCell('J11')->setValue('fer');
//$worksheet->getCell('P15')->setValue('10');
$nsilabus=Silabus::where('sec_iCodigo',$seccioncod)->get();

$nescuela=Escuela::where('esc_vcCodigo',left($codcursox,2))->get();


if(count($nescuela)<1)
return "no contiene datos";
foreach ($nescuela as $xescue) {
    $facultad=$xescue->facultad;
}



$worksheet->getCell('E8')->setValue($xdocente);

//$worksheet->getCell('Q9')->setValue($xescuela);
$worksheet->setCellValue("B4","ESCUELA PROFESIONAL DE ".$xescuela);
$worksheet->setCellValue("B3",$facultad);
$worksheet->getCell('E7')->setValue($xcurso);
$worksheet->getCell('Y11')->setValue($codcursox);
$worksheet->getCell('AE11')->setValue($creditos);
$worksheet->getCell('J11')->setValue(nroromano($xciclo));
$worksheet->getCell('P11')->setValue($planestudio);
$worksheet->getCell('L11')->setValue(modalidadclase());
//$worksheet->getCell('Ax9')->setValue($xturno);
$worksheet->getCell('T11')->setValue($misemestre); 

$worksheet->getCell('B46')->setValue('PU1'); 


$nunidad="";
$nev1="";
    $nev2="";
    $nev3="";
    $nev4="";
    $nev5="";
//echo $nsilabus->unidades;
foreach ($nsilabus as $sila) {
    $nunidad=$sila->unidades;
    $nev1=$sila->nro_evalPU1;
    $nev2=$sila->nro_evalPU2;
    $nev3=$sila->nro_evalPU3;
    $nev4=$sila->nro_evalPU4;
    $nev5=$sila->nro_evalPU5;
}

switch ($nunidad) 
        {
            case 1:
                   $worksheet->setCellValue("B46","PU1");                   
                   $worksheet->setCellValue("E46",$nev1);
              
                break;
            case 2:
                   $worksheet->setCellValue("B46","PU1");                   
                   $worksheet->setCellValue("E46",$nev1);

                   $worksheet->setCellValue("F46","PU2");                   
                   $worksheet->setCellValue("I46",$nev2);                   


                break;
            case 3:
                   $worksheet->setCellValue("B46","PU1");                   
                   $worksheet->setCellValue("E46",$nev1);

                   $worksheet->setCellValue("F46","PU2");                   
                   $worksheet->setCellValue("I46",$nev2);

                   $worksheet->setCellValue("J46","PU3");                   
                   $worksheet->setCellValue("M46",$nev3);
                break;

            case 4:
                   $worksheet->setCellValue("B46","PU1");                   
                   $worksheet->setCellValue("E46",$nev1);

                   $worksheet->setCellValue("F46","PU2");                   
                   $worksheet->setCellValue("I46",$nev2);

                   $worksheet->setCellValue("J46","PU3");                   
                   $worksheet->setCellValue("M46",$nev3);

                   $worksheet->setCellValue("N46","PU4");                   
                   $worksheet->setCellValue("P46",$nev4);

                break;

            case 5:
                  $worksheet->setCellValue("B46","PU1");                   
                   $worksheet->setCellValue("E46",$nev1);

                   $worksheet->setCellValue("F46","PU2");                   
                   $worksheet->setCellValue("I46",$nev2);

                   $worksheet->setCellValue("J46","PU3");                   
                   $worksheet->setCellValue("M46",$nev3);

                   $worksheet->setCellValue("N46","PU4");                   
                   $worksheet->setCellValue("Q46",$nev4);

                   $worksheet->setCellValue("R46","PU5");                   
                   $worksheet->setCellValue("U46",$nev5);
                   
                break;

            
            default:
                # code...
                break;
        }

/*
$letra=array("k","l",	"m",	"n",	"o",	"p",	"q",	"r",	"s",	"t",	"u",	"v",	"w",	"x",	"y",	"z",	"aa",	"ab",	"ac",	"ad",	"ae",	"af",	"ag",	"ah",	"ai",	"aj",	"ak",	"al",	"am",	"an",	"ao",	"ap",	"aq",	"ar",	"as",	"at",	"au",	"av",	"aw",	"ax",	"ay",	"az",	"ba",	"bb",	"bc",	"bd",	"be",	"bf");
//preparamos las lista de alumnmos
$ndia1=0;$ndia2=0;$ndia3=0;$ndia4=0;$ndia5=0;$ndia6=0;$ndia7=0;$ndia8=0;$ndia9=0;$ndia10=0;
$ndia11=0;$ndia12=0;$ndia13=0;$ndia14=0;$ndia15=0;$ndia16=0;*/
//$miasistencia=new DocenteController(); 
//$misalumnos=$miasistencia->vercursosalumnos($gcodcurso,semestreactual());


//$curso=$miasistencia->fechacursoasistencia($gcodcurso,semestreactual());
//$curso=sqlfechacursoasistencia($gcodcurso,semestreactual());

$contseman=0;
$apag=0; 


$nn=0;
$nro=14;
    foreach ($misalumnos as $alumno) {
      $nro++;
      $nn++;
      $cod=$alumno->alu_vcCodigo;
      $xcod=$alumno->alu_iCodigo;
      $estudiante=$alumno->alu_vcPaterno." ".$alumno->alu_vcMaterno." ".$alumno->alu_vcNombre ;
  //    $email=$alumno->alu_vcEmail;   
/*    echo "<tr style='color:black'>
          <td>$nro</td>
          <td>$cod</td>
         <td>$estudiante</td>
         <td>$email</td>
        </tr>"; */

        $worksheet->getCell('B'.$nro)->setValue($nn);
        $worksheet->getCell('C'.$nro)->setValue($cod);
        $worksheet->getCell('F'.$nro)->setValue($estudiante);

        
        $worksheet->getCell('P'.$nro)->setValue($alumno->CE11);
        $worksheet->getCell('Q'.$nro)->setValue($alumno->CE12);
        $worksheet->getCell('R'.$nro)->setValue($alumno->CE13);
        $worksheet->getCell('S'.$nro)->setValue($alumno->CE14);
        $worksheet->getCell('T'.$nro)->setValue('0');
        $xpp1 = 0;
                                    $xpp2 = 0;
                                    $xpp3 = 0;
                                    $xpp4 = 0;
        $prome = 0;
                                if ($cri01 == 'PA') {
                                    $prome = (sinnota($alumno->CE11) + sinnota($alumno->CE12) + sinnota($alumno->CE13) + sinnota($alumno->CE14)) / $xnroev01;
                                } else {
                                    
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
                                    $prome = sinnota($alumno->CE11) * sinnota($xpp1) + sinnota($alumno->CE12) * sinnota($xpp2) + sinnota($alumno->CE13) * sinnota($xpp3) + sinnota($alumno->CE14) * sinnota($xpp4);
                                }
                                $promediox1 = $prome;
                           
                                $worksheet->getCell('T'.$nro)->setValue($promediox1);

        $worksheet->getCell('U'.$nro)->setValue($alumno->CE21);
        $worksheet->getCell('V'.$nro)->setValue($alumno->CE22);
        $worksheet->getCell('W'.$nro)->setValue($alumno->CE23);
        $worksheet->getCell('X'.$nro)->setValue($alumno->CE24);
        $worksheet->getCell('Y'.$nro)->setValue('0');

        $xpp1 = 0.0;
                                    $xpp2 = 0.0;
                                    $xpp3 = 0.0;
                                    $xpp4 = 0.0;
        $prome = 0;
                                if ($cri02 == 'PA') {
                                    $prome = (sinnota($alumno->CE21) + sinnota($alumno->CE22) + sinnota($alumno->CE23) + sinnota($alumno->CE24)) / $xnroev02;
                                } else {
                                    
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
                                }
                                $promediox2 = $prome;
                                    $prome = sinnota($alumno->CE21) * sinnota($xpp1) + sinnota($alumno->CE22) * sinnota($xpp2) + sinnota($alumno->CE23) * sinnota($xpp3) + sinnota($alumno->CE24) * sinnota($xpp4);
                                    $worksheet->getCell('Y'.$nro)->setValue($promediox2);

        $worksheet->getCell('Z'.$nro)->setValue($alumno->CE31);
        $worksheet->getCell('AA'.$nro)->setValue($alumno->CE32);
        $worksheet->getCell('AB'.$nro)->setValue($alumno->CE33);
        $worksheet->getCell('AC'.$nro)->setValue($alumno->CE34);
        $worksheet->getCell('AD'.$nro)->setValue('0');

        $xpp1 = 0.0;
                                    $xpp2 = 0.0;
                                    $xpp3 = 0.0;
                                    $xpp4 = 0.0;
        $prome = 0;
                                if ($cri03 == 'PA') {
                                    $prome = (sinnota($alumno->CE31) + sinnota($alumno->CE32) + sinnota($alumno->CE33) + sinnota($alumno->CE34)) / $xnroev03;
                                } else {
                                   
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
                                    $prome = sinnota($alumno->CE31) * sinnota($xpp1) + sinnota($alumno->CE32) * sinnota($xpp2) + sinnota($alumno->CE33) * sinnota($xpp3) + sinnota($alumno->CE34) * sinnota($xpp4);
                                }
                                $promediox3 = $prome;
                    $worksheet->getCell('AD'.$nro)->setValue($promediox3);            


        $worksheet->getCell('AE'.$nro)->setValue($alumno->CE41);
        $worksheet->getCell('AF'.$nro)->setValue($alumno->CE42);
        $worksheet->getCell('AG'.$nro)->setValue($alumno->CE43);
        $worksheet->getCell('AH'.$nro)->setValue($alumno->CE44);
        $worksheet->getCell('AI'.$nro)->setValue('0');
        $xpp1 = 0.0;
                                    $xpp2 = 0.0;
                                    $xpp3 = 0.0;
                                    $xpp4 = 0.0;
        $prome = 0;
                                if ($cri04 == 'PA') {
                                    $prome = (sinnota($alumno->CE41) + sinnota($alumno->CE42) + sinnota($alumno->CE43) + sinnota($alumno->CE44)) / $xnroev04;
                                } else {
                                   
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
                                    $prome = sinnota($alumno->CE41) * sinnota($xpp1) + sinnota($alumno->CE42) * sinnota($xpp2) + sinnota($alumno->CE43) * sinnota($xpp3) + sinnota($alumno->CE44) * sinnota($xpp4);
                                }
                                $promediox4 = $prome;
                                $worksheet->getCell('AI'.$nro)->setValue($promediox4 );


        $worksheet->getCell('AJ'.$nro)->setValue($alumno->CE51);
        $worksheet->getCell('AK'.$nro)->setValue($alumno->CE52);
        $worksheet->getCell('AL'.$nro)->setValue($alumno->CE53);
        $worksheet->getCell('AM'.$nro)->setValue($alumno->CE54);
        $worksheet->getCell('AN'.$nro)->setValue('0');

        $xpp1 = 0.0;
                                    $xpp2 = 0.0;
                                    $xpp3 = 0.0;
                                    $xpp4 = 0.0;
        $prome = 0;
                                if ($cri05 == 'PA') {
                                    $prome = (sinnota($alumno->CE51) + sinnota($alumno->CE52) + sinnota($alumno->CE53) + sinnota($alumno->CE54)) / $xnroev05;
                                } else {
                                    
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
                                    $prome = sinnota($alumno->CE51) * sinnota($xpp1) + sinnota($alumno->CE52) * sinnota($xpp2) + sinnota($alumno->CE53) * sinnota($xpp3) + sinnota($alumno->CE54) * sinnota($xpp4);
                                }
                                $promediox5 = $prome;
                                $worksheet->getCell('AN'.$nro)->setValue($promediox5);


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
                                 
                                $worksheet->getCell('AO'.$nro)->setValue($tpro);
                                 if($tpro>=10.5)
                                 $worksheet->getStyle('AO'.$nro)->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLUE);
                                 if($tpro<10.5)
                                 $worksheet->getStyle('AO'.$nro)->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);

        $nndia=verndia($gcodcurso,$semestreactual,$xcod);
        $asispor=$nndia/$totalfecha;
        $worksheet->getCell('AP'.$nro)->setValue($asispor);

        $worksheet->getCell('G'.($nro+36))->setValue($alumno->sust);
        $worksheet->getCell('I'.($nro+36))->setValue($alumno->aplaz);

       // sust

        if($nn==25)
        $nro=94;
        if($nn==50)
        $nro=163;
    
        
        
    }
//$worksheet->getCell('E17')->setValue('fer');
//$worksheet->getCell('E18')->setValue('carlos');



$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xls');
$writer->save('rptplatillasxls/ACTADENOTAS.xls');
//readfile('rptplatillasxls/Plantilla _de_asistencia25.xls');
echo "<script>
    //  window.open('../rptplatillasxls/Plantilla _de_asistencia25.xls').focus();
  //  location.href = '../rptplatillasxls/ACTADENOTAS.xls'
  location.href = 'rptplatillasxls/ACTADENOTAS.xls'
    $('#retonarx').show();
   </script>";
echo "<br>PROCESO COMPLETADO";
@endphp

<!-- Bootstrap core JavaScript-->
<!-- Core plugin JavaScript-->
<!-- Custom scripts for all pages-->
<!-- 
<script src="{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>


<script src="{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>


<script src="{ asset('js/sb-admin-2.min.js') }}"></script>
 -->
<!-- Page level plugins -->

