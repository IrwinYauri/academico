<?php
namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Support\Facades\DB; //uso base datos
use Illuminate\Http\Request;//capturar datos

use Illuminate\Support\Facades\File; 
use Illuminate\Support\Facades\Storage;

use Barryvdh\DomPDF\Facade as PDF;
use View;

use DataTables;

class DocenteController extends Controller
{
    public function index()
   {return view('docente.index');
    
   }
   public function tomasasistencia()
   {return view('docente.asistencias');
     }
   public function vermatriculados()
     {return view('docente.matriculados');
       }
   public function show($mivistas)
   {
    return view("docente.".$mivistas."");
    
   }
   public function  vercursos($semestre,$coddocente)
   { 
       $sql='SELECT 
       seccion_horario.doc_iCodigo,
       seccion.cur_iCodigo,
       docente.doc_vcPaterno,
       docente.doc_vcMaterno,
       docente.doc_vcNombre,
       seccion.sem_iCodigo,
       curso.cur_vcNombre,
       curso.cur_iSemestre,
       curso.cur_iCodigo,
       curso.cur_vcCodigo,
       seccion.sec_iNumero,
       curso.escpla_iCodigo,
       escuelaplan.escpla_vcCodigo,
       seccion.sec_iCodigo
     FROM
       seccion_horario
       INNER JOIN docente ON (seccion_horario.doc_iCodigo = docente.doc_iCodigo)
       INNER JOIN seccion ON (seccion_horario.sec_iCodigo = seccion.sec_iCodigo)
       INNER JOIN curso ON (seccion.cur_iCodigo = curso.cur_iCodigo)
       INNER JOIN escuelaplan ON (curso.escpla_iCodigo = escuelaplan.escpla_iCodigo)
     WHERE
  `seccion`.`sem_iCodigo` = "'.$semestre.'" AND 
  `seccion_horario`.`doc_iCodigo` ="'.$coddocente.'"
  order by curso.cur_vcCodigo,curso.cur_iCodigo
  ';
   $data1=DB::select($sql);
  return $data1;
  }
  public function  vercursosalumnos($codcurso,$semestre)
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
  

  public function vercargahoraria()
  { 

    //session_start();

    $coddocentex=51;//$_SESSION['coddocentex'];
    $semestre=semestreactual();

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
      seccion_horario.doc_iCodigo = "'.$coddocentex.'"
      ORDER BY
      curso.cur_vcCodigo,  
      seccion_horario.dia_vcCodigo';
    
    $listahora=DB::select($sql);

    return view("docente.completarasistencia", compact('listahora','coddocentex')); 
 }
/*
  public function login()
  {
    return view('docente.login');
  }*/
  public function validardocente(Request $request)
  {
    return view('docente.validardocente');
  }
  public function  buscardocente($dni)
   { 
       $sql='SELECT 
          *
         FROM
         docente
        WHERE
     docente.doc_vcDocumento = "'.$dni.'"';
   $data1=DB::select($sql);
  return $data1;
  }
  public function  buscardocentecod($cod)
  { 
      $sql='SELECT 
         *
        FROM
        docente
       WHERE
    docente.doc_iCodigo = "'.$cod.'"';
  $data1=DB::select($sql);
 return $data1;
 }


public function  verrecord($codprofe)
    { 
        $sql='SELECT 
        `curso`.`cur_vcNombre`,
        `curso`.`cur_vcCodigo`,
        `seccion`.`sem_iCodigo`,
        `seccion_horario`.`doc_iCodigo`,
        `seccion_horario`.`sectip_cCodigo`,
        (SELECT `escuela`.`esc_vcNombre` FROM escuela where `escuela`.`esc_vcCodigo`=left(`curso`.`cur_vcCodigo`,2) )
        as escuela
      FROM
        `seccion`
        INNER JOIN `seccion_horario` ON (`seccion`.`sec_iCodigo` = `seccion_horario`.`sec_iCodigo`)
        INNER JOIN `curso` ON (`seccion`.`cur_iCodigo` = `curso`.`cur_iCodigo`)
      WHERE
        `seccion_horario`.`doc_iCodigo` ='.$codprofe.'
      ORDER BY
        `seccion`.`sem_iCodigo`,
        `curso`.`cur_vcCodigo`';
    $data1=DB::select($sql);
    return $data1;
    }
    public function  verrecordgrupo($codprofe)
    { 
        $sql='SELECT 
        `seccion`.`sem_iCodigo`
      FROM
        `seccion`
        INNER JOIN `seccion_horario` ON (`seccion`.`sec_iCodigo` = `seccion_horario`.`sec_iCodigo`)
        INNER JOIN `curso` ON (`seccion`.`cur_iCodigo` = `curso`.`cur_iCodigo`)
      WHERE
        `seccion_horario`.`doc_iCodigo` = '.$codprofe.'
      GROUP BY
        seccion.sem_iCodigo';
    $data1=DB::select($sql);
    return $data1;
    }
    public function vercursosagrupado($semetre,$coddocente)
    {$sql="SELECT 
      `curso`.`cur_vcNombre`,
      `curso`.`cur_vcCodigo`,
      `seccion`.`sem_iCodigo`,
      `seccion_horario`.`doc_iCodigo`,
      `seccion`.`sec_iCodigo`,
      `escuelaplan`.`escpla_vcCodigo`,
      `seccion`.`sec_iNumero`,  
      `curso`.`cur_iCodigo`
    FROM
      `seccion`
      INNER JOIN `seccion_horario` ON (`seccion`.`sec_iCodigo` = `seccion_horario`.`sec_iCodigo`)
      INNER JOIN `curso` ON (`seccion`.`cur_iCodigo` = `curso`.`cur_iCodigo`)
      INNER JOIN `escuelaplan` ON (`curso`.`escpla_iCodigo` = `escuelaplan`.`escpla_iCodigo`)
    WHERE
      `seccion_horario`.`doc_iCodigo` = '$coddocente' AND 
      `seccion`.`sem_iCodigo` = '$semetre'
    
    ";
       $data1=DB::select($sql);
      // return $data1;
                  $milista = array();
            $milistadata = array();
            $micc=0;
          //  foreach ( $miscursos as $value ) {
            foreach ( $data1 as $value ) {
            $t=count($milista);

            $b=0;
            if($t>0)
            { for($x=0;$x<$t;$x++)
              {if(trim($milista[$x])==trim($value->cur_vcCodigo))
              $b=1;
            // echo '<br>'.$milista[$x];
            //echo  '--'.$value->cur_vcCodigo;
              }
            }
              if($b==0)
            { $milista[]=$value->cur_vcCodigo; 
              $milistadata[]=["cur_vcCodigo"=>$value->cur_vcCodigo,
                              "cur_vcNombre"=>$value->cur_vcNombre,
                              "sec_iNumero"=>$value->sec_iNumero,
                              "escpla_vcCodigo"=>$value->escpla_vcCodigo,
                              "escuela"=>left($value->cur_vcCodigo,2),
                              "cur_iCodigo"=>$value->cur_iCodigo                   
                              ];
            }
              
            //echo "xxx--".$milista[$t]."<br><br>";
            }
     // foreach($data1 as $value)

         //   $rpt[]
          //  dd(  json_encode($milista));
        //    dd($milistadata) ; 
        return $milistadata;

    }
    public function  verprofe($codprofe)
    { 
        $sql='SELECT 
        *
      FROM
       docente
       where
        `docente`.`doc_iCodigo` = '.$codprofe.'
      ';
    $data1=DB::select($sql);
    return $data1;
    }

    public function  verregistronotas($codprofe,$semestre,$codcur)
    { 
        $sql="SELECT 
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
    $data1=DB::select($sql);
    return $data1;
    }

    function editarnota($semestre,$curso,$codalumno,$nota)
    {$sql="update
      `matriculadetalle`
      INNER JOIN `registroeval` ON (`matriculadetalle`.`matdet_iCodigo` = `registroeval`.`matdet_iCodigo`)
      INNER JOIN `seccion` ON (`matriculadetalle`.`sec_iCodigo` = `seccion`.`sec_iCodigo`)
      INNER JOIN `seccion_horario` ON (`seccion`.`sec_iCodigo` = `seccion_horario`.`sec_iCodigo`)
      INNER JOIN `matricula` ON (`matriculadetalle`.`mat_iCodigo` = `matricula`.`mat_iCodigo`)
    set 
    `registroeval`.`CE11`=$nota
    WHERE
      `matricula`.`sem_iCodigo` = $semestre AND 
      `seccion`.`cur_iCodigo` = $curso AND 
      `matricula`.`alu_iCodigo` = $codalumno";

    }

    ///fotos docente
    public function store(Request $request)
    { 
     //   $mifecha=date("Y-m-d");
        $coddoc=request('coddoc');
      //  $semestre=request('semestre');
     //   $nro=request('nro');
        $file=$request->file('file') ;
       $extension = $request->file('file')->extension();
        // $extension="";
        echo $extension ; 
        if(strtoupper($extension)!="JPG")
         {echo "NO ES UN JPG";
            $menu="DOCENTE";
            // return view('docente.index',['menu' => $menu]);
             return redirect()->route('docente.index', ['menu' => $menu]);
         }
        //   $fecha=$mifecha;
        $filenom=$coddoc;
        echo $filenom;
          //   if($request->hasFile('file'))
          { $file=$request->file('file')->store('fotosdocen','public');
            if (!File::exists('public/fotosdocen/'.$filenom.'.jpg'))
            Storage::delete('public/fotosdocen/'.$filenom.'.jpg');
            }
          Storage::move('public/'.$file, 'public/fotosdocen/'.$filenom.'.jpg');
          
            $addsilabu=new PlanactividadController();
                $menu="DOCENTE";
          return redirect()->route('docente.index', ['menu' => $menu]);
           //   return view('docente.index',['menu' => $menu]);
           }
          public function verdatosdocente($coddoc)
           {$r=0;
               $sql="SELECT 
               `docente`.`doc_iCodigo`,
               `docente`.`doc_vcDocumento`,
               `docente`.`doc_vcPaterno`,
               `docente`.`doc_vcMaterno`,
               `docente`.`doc_vcNombre`,
               `docente`.`doc_cActivo`,
               `docente`.`depaca_iCodigo`,
               `docente`.`doccat_iCodigo`,
               `docente`.`doccla_iCodigo`,
               `docente`.`doc_vcPassword`,
               `docente`.`doc_iPasswordCambiar`,
               `docente`.`doc_vcTelefonoFijo`,
               `docente`.`doc_vcTelefonoCelular`,
               `docente`.`doc_vcEmail1`,
               `docente`.`doc_vcEmail2`,
               `docente`.`condDocente`,
               `docente`.`cateDocente`,
               `docente_clase`.`doccla_vcNombre`,
               `docente_categoria`.`doccat_vcNombre`,
               `docentedepaca`.`depaca_vcNombre`
             FROM
               `docente`
               INNER JOIN `docente_clase` ON (`docente`.`doccla_iCodigo` = `docente_clase`.`doccla_iCodigo`)
               INNER JOIN `docente_categoria` ON (`docente`.`doccat_iCodigo` = `docente_categoria`.`doccat_iCodigo`)
               INNER JOIN `docentedepaca` ON (`docente`.`depaca_iCodigo` = `docentedepaca`.`depaca_iCodigo`)
               WHERE
                `docente`.`doc_iCodigo`='$coddoc' ";
               $data1=DB::select($sql); 
              return $data1;
           }
           public function updatedocentecorreo($coddoc,$email1,$email2,$cell,$tef)
           {$sql="update docente 
                set doc_vcEmail1='$email1',doc_vcEmail2='$email2',
                doc_vcTelefonoCelular='$cell',doc_vcTelefonoFijo='$tef'
                where
                doc_iCodigo='$coddoc'";
                $data1=DB::select($sql); 
                return $data1;

           }
           public function fechacursoasistencia($codcurso,$semestre)
           {$sql="SELECT
            seccion.sem_iCodigo,
            seccion_horario.sec_iCodigo,
            seccion_horarioasistencia.sechor_iCodigo,
            seccion.cur_iCodigo,
            curso.cur_vcNombre,
            seccion.tur_cCodigo,
            seccion_horarioasistencia.sechorasi_iHoraFinal,
            seccion_horarioasistencia.sechorasi_iHoraInicio,
            seccion_horarioasistencia.dia_vcCodigo,
            seccion_horarioasistencia.sechorasi_iCodigo,
            seccion_horarioasistencia.sechorasi_iSemana,
            seccion_horarioasistencia.sechorasi_dFecha,
            seccion_horario.sectip_cCodigo
            FROM
            seccion_horario
            INNER JOIN seccion_horarioasistencia ON (seccion_horario.sechor_iCodigo = seccion_horarioasistencia.sechor_iCodigo)
            INNER JOIN seccion ON (seccion_horario.sec_iCodigo = seccion.sec_iCodigo)
            INNER JOIN curso ON (seccion.cur_iCodigo = curso.cur_iCodigo)
            WHERE
            seccion.cur_iCodigo = '$codcurso' AND
            seccion.sem_iCodigo = '$semestre' AND
            seccion_horarioasistencia.dia_vcCodigo LIKE '%' 
            
            ORDER BY
            seccion_horarioasistencia.sechorasi_dFecha ASC";
                $data1=DB::select($sql); 
                return $data1;

           }
           public function nescuela($cod)
           {$sql="select * from escuela
            where esc_vcCodigo='$cod'";
            $nom="";
                $data1=DB::select($sql); 
                foreach($data1 as $dat)
                {$nom=$dat->esc_vcNombre;

                }
                return $nom;

           }
          public function rptmatriculados()
           { 
            $pdf=PDF::loadView('docente.pdfmatriculados');
           return $pdf->download('reporte.pdf');
           /* return $pdf->download('reporte.pdf')
              ->setPaper('a4', 'landscape')
              ->download('archivo.pdf');*/
           }

           public function rptcargahorario()
           { 
            $pdf=PDF::loadView('docente.pdfcargahorario')
            ->setPaper('a4', 'landscape');
           return $pdf->download('reportex.pdf');
           
           }
           public function rptrecordacademico()
           { 
            $pdf=PDF::loadView('docente.pdfrecordacademico');
                       return $pdf->download('reporten.pdf');
           
           }


}