<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Http;

use Illuminate\Support\Facades\DB; //uso base datos
use Illuminate\Http\Request;//capturar datos

use Illuminate\Support\Facades\File; 
use Illuminate\Support\Facades\Storage;
use DataTables;
use Barryvdh\DomPDF\Facade as PDF;
use View;

use App\Http\Controllers\SilabusemestreController;
use App\Http\Controllers\VerasistenciaController;


class AlumnoController extends Controller
{
   public function index(Request $request)
   {/* if($request->ajax()){
       $animales=DB::select('CALL spsel_animal()');
       return DataTables::of($animales)
       ->addColumn('action',function($animales){
           $acciones='<a href="javascript:void(0)" onclick="editarAnimal('.$animales->id.')" class="btn btn-info btn-sm"> Editar </a>';
           $acciones.='&nbsp;&nbsp;<button type="button" name="delete" id="'.$animales->id.'" class="delete btn btn-danger btn-sm"> Eliminar </button>';
        return $acciones;
           })
           ->rawColumns(['action'])
           ->make(true); 
            }
  */
  $areas=DB::select('SELECT nrohora,hora,turno from horarioturno order by nrohora,turno');
  $misdatos['misareas']=$areas;
  return view('alumno.index',$misdatos);
      
   }
   public function store(Request $request)
    { 
     //   $mifecha=date("Y-m-d");
        $coddoc=request('codalumno');
      //  $semestre=request('semestre');
     //   $nro=request('nro');
        $file=$request->file('file') ;
       $extension = $request->file('file')->extension();
        // $extension="";
        echo $extension ; 
        if(strtoupper($extension)!="JPG")
         {echo "NO ES UN JPG";
            $menu="ALUMNO";
            // return view('docente.index',['menu' => $menu]);
             return redirect()->route('alumno.index', ['menu' => $menu]);
         }
        //   $fecha=$mifecha;
        $filenom="1_".$coddoc;
        echo $filenom;
          //   if($request->hasFile('file'))
          { $file=$request->file('file')->store('fotos','public');
            if (!File::exists('public/fotos/'.$filenom.'.jpg'))
            Storage::delete('public/fotos/'.$filenom.'.jpg');
            }
          Storage::move('public/'.$file, 'public/fotos/'.$filenom.'.jpg');
          
            $addsilabu=new PlanactividadController();
                $menu="ALUMNO";
         return redirect()->route('alumno.index', ['menu' => $menu]);
           //   return view('docente.index',['menu' => $menu]);
      }

   public function show($mivistas)
   {return view("alumno.".$mivistas."");
    
   }
   public function reportepdf()
   { 
    $pdf=PDF::loadView('alumno.verasistencia');
    return $pdf->download('reporte.pdf');

   }
   public function menu(){
    // llamar procedimiento
   //$animal=DB::select('call spcre_animal(?,?,?)',
  // [$request->nombre,$request->especie,$request->genero]);
  $areas=DB::select('select * from area');
  $misdatos['misareas']=$areas;
 // $datos['empleados']=Empleado::paginate(5);
 //return $areas;
 return view('alumno.index',$misdatos);
  //$animal=DB::select('select * from area');
  //return response()->json($animal);

  }
  public function horario(){
  $data1=DB::select('SELECT nrohora,hora,turno from horarioturno order by nrohora,turno');
  $misdatos['misareas']=$data1;
  $data2=DB::select('
  SELECT  c.cur_iCodigo,c.cur_vcCodigo,
         c.cur_vcNombre,c.cur_fCredito,
c.cur_iSemestre,r.prom, r.PF,
r.sust,r.aplaz,s.sec_iNumero,sh.dia_vcCodigo,
sh.sechor_iHoraInicio,sh.sechor_iHoraFinal,sh.sectip_cCodigo 
FROM registroeval as r inner join `matriculadetalle` as md 
on r.matdet_iCodigo=md.matdet_iCodigo inner join seccion as s 
on md.sec_iCodigo=s.sec_iCodigo inner join curso as c 
on s.cur_iCodigo=c.cur_iCodigo inner join matricula as m 
on md.mat_iCodigo=m.mat_iCodigo inner join alumno as a 
on m.alu_iCodigo=a.alu_iCodigo inner join escuelaplan as ep 
on a.escpla_iCodigo=ep.escpla_iCodigo inner join escuela as e on ep.esc_vcCodigo=e.esc_vcCodigo 
 inner join seccion_horario as sh on s.sec_iCodigo=sh.sec_iCodigo where a.alu_iCodigo="198" and m.sem_iCodigo="20212"');
  $misdatos2['misareas2']=$data2;
  return view('alumno.horario',$misdatos,$misdatos2);
   }
   public function notascurso()
   {$data1=DB::select('SELECT
    c.cur_vcCodigo AS codigo,
    c.cur_vcNombre AS curso,
    c.cur_fCredito AS credito,
    c.cur_iSemestre AS ciclo,
    s.sec_iNumero AS secc,
    concat(docente.doc_vcPaterno," ",
        docente.doc_vcMaterno," ",
        docente.doc_vcNombre) AS docente,
    s.tur_cCodigo AS turno,
    a.alu_vcCodigo,
    a.alu_iCodigo,
    m.sem_iCodigo
    FROM
        alumno AS a
        INNER JOIN matricula AS m ON a.alu_iCodigo = m.alu_iCodigo
        INNER JOIN matriculadetalle AS md ON m.mat_iCodigo = md.mat_iCodigo
        INNER JOIN seccion AS s ON md.sec_iCodigo = s.sec_iCodigo
        INNER JOIN curso AS c ON s.cur_iCodigo = c.cur_iCodigo
        INNER JOIN docente ON s.doc_iCodigo = docente.doc_iCodigo
    WHERE a.alu_iCodigo="447" and m.sem_iCodigo="20212"');
    $misdatos['miscursos']=$data1;
  //  return $misdatos;
    $data2=DB::select('SELECT
curso.cur_iCodigo,
curso.cur_vcCodigo,
curso.cur_vcNombre,
silabus.sec_iCodigo,
silabus.unidades,
silabus.tipoPF,
silabus.formulaPF,
seccion.sem_iCodigo,
silabus.formulaPU1,
silabus.formulaPU2,
silabus.formulaPU3,
silabus.formulaPU4,
silabus.formulaPU5
FROM
curso
INNER JOIN seccion ON seccion.cur_iCodigo = curso.cur_iCodigo
INNER JOIN silabus ON seccion.sec_iCodigo = silabus.sec_iCodigo
where seccion.sem_iCodigo="20212"');
    $silabu["silabus"]=$data2;
    return view('alumno.notascurso',$misdatos,$silabu);
   }
   public function notascursodetalle(Request $request)
   {$codcur=$request->input('codcurso');
    $codalumno=$request->input('codalumno');
    $semestre=$request->input('semestre');
       $sql='SELECT
    matriculadetalle.matdet_iCodigo,
    matriculadetalle.mat_iCodigo,
    matriculadetalle.sec_iCodigo,
    matriculadetalle.matdet_fNota,
    matriculadetalle.matdet_fNota01,
    matriculadetalle.matdet_fNota02,
    matriculadetalle.matdet_fNota03,
    matriculadetalle.matdet_fNota04,
    matriculadetalle.matdet_fNota05,
    matriculadetalle.matdet_fNota06,
    matriculadetalle.matdet_fNota07,
    matriculadetalle.matdet_fNota08,
    matriculadetalle.matdet_fNota09,
    matriculadetalle.matdet_fAplazado,
    matriculadetalle.matdet_fPromedio,
    registroeval.CE11,
    registroeval.CE12,
    registroeval.CE13,
    registroeval.CE14,
    registroeval.CE21,
    registroeval.CE22,
    registroeval.CE23,
    registroeval.CE54,
    registroeval.CE53,
    registroeval.CE52,
    registroeval.CE51,
    registroeval.CE44,
    registroeval.CE42,
    registroeval.CE41,
    registroeval.CE34,
    registroeval.CE43,
    registroeval.CE33,
    registroeval.CE32,
    registroeval.CE31,
    registroeval.CE24,
    registroeval.prom,
    registroeval.sust,
    registroeval.aplaz,
    alumno.alu_iCodigo,
    seccion.sem_iCodigo,
    curso.cur_vcNombre,
    curso.cur_vcCodigo,
    concat(
    alumno.alu_vcPaterno," ",
    alumno.alu_vcMaterno," ",
    alumno.alu_vcNombre) AS alumno
    
    FROM
    matriculadetalle
    INNER JOIN matricula ON matricula.mat_iCodigo = matriculadetalle.mat_iCodigo
    INNER JOIN alumno ON alumno.alu_iCodigo = matricula.alu_iCodigo
    INNER JOIN seccion ON seccion.sec_iCodigo = matriculadetalle.sec_iCodigo
    INNER JOIN curso ON curso.cur_iCodigo = seccion.cur_iCodigo
    INNER JOIN registroeval ON matriculadetalle.matdet_iCodigo = registroeval.matdet_iCodigo
     where seccion.sem_iCodigo="'.$semestre.'" and alumno.alu_iCodigo="'.$codalumno.'" and curso.cur_vcCodigo="'.$codcur.'"';
     //where seccion.sem_iCodigo="20212" and alumno.alu_iCodigo="447" and curso.cur_vcCodigo like "%"';
    $data1=DB::select($sql);
    $misnotas=$data1;
    //return $misnotas;
   //$misilabus['misilabu']=HTTP::get(asset('silabusemestre'));
   //$dataalumno=HTTP::get($miurl."/../../alumnodatos1");
   $xsi= new SilabusemestreController();
   $miurl=URL::current();
  $misilabus=HTTP::get(asset('silabusemestre'));
  $misilabus=$xsi->index("20212");
  // return $misilabus;
 // return view('alumno.notascursodetalle',$misdatos,$misilabus);
  return view('alumno.notascursodetalle',["misnotas"=>$misnotas,"misilabus"=>$misilabus]);
   }
 //opcional consumiendo
  public function consumirmenu(){
  $animal=DB::select('select * from area');
  return response()->json($animal);
  }
   public function registrar(Request $request){
       // llamar procedimiento
      $animal=DB::select('call spcre_animal(?,?,?)',
      [$request->nombre,$request->especie,$request->genero]);
       return back();
   }
   public function eliminar($id){
    $animal=DB::select('call spdel_animal(?)',[$id]);
    return back();
    }
    public function editar($id){
       $animal=DB::select('call spseledit_animal(?)',[$id]);
        return response()->json($animal);
    }
    
    public function actualizar(Request $request){
        $animal=DB::select('call spupd_animal(?,?,?,?)',
        [$request->id,$request->nombre,$request->especie,$request->genero]);
        return back();
    }
    public function verasistencia(){
        $buscarasistencia= new VerasistenciaController();
      $xasis=$buscarasistencia->verasistenciasemanal("20212","447");
      $codcur="AN.EG.17.101";
     // $xasisdia=$buscarasistencia->verasistenciasemanaldia( 17 ,439  ,20212 , 1);
      
         return view('alumno.verasistencia',["xasis"=>$xasis,"codcur"=>$codcur]);
    }

    public function verboleta($codalum,$sem)
    {$sql="SELECT 
        `c`.`cur_iCodigo`,
        `c`.`cur_vcCodigo`,
        `c`.`cur_vcNombre`,
        `c`.`cur_fCredito`,
        `c`.`cur_iSemestre`,
        `r`.`prom`,
        `r`.`PF`,
        `r`.`sust`,
        `r`.`aplaz`,
        `s`.`sec_iNumero`
      FROM
        `registroeval` `r`
        INNER JOIN `matriculadetalle` `md` ON (`r`.`matdet_iCodigo` = `md`.`matdet_iCodigo`)
        INNER JOIN `seccion` `s` ON (`md`.`sec_iCodigo` = `s`.`sec_iCodigo`)
        INNER JOIN `curso` `c` ON (`s`.`cur_iCodigo` = `c`.`cur_iCodigo`)
        INNER JOIN `matricula` `m` ON (`md`.`mat_iCodigo` = `m`.`mat_iCodigo`)
        INNER JOIN `alumno` `a` ON (`m`.`alu_iCodigo` = `a`.`alu_iCodigo`)
        INNER JOIN `escuelaplan` `ep` ON (`a`.`escpla_iCodigo` = `ep`.`escpla_iCodigo`)
        INNER JOIN `escuela` `e` ON (`ep`.`esc_vcCodigo` = `e`.`esc_vcCodigo`)
      WHERE
        `a`.`alu_iCodigo` = '447' AND 
        `m`.`sem_iCodigo` = 20212";
        $data1=DB::select($sql);
        return $data1;

     }
     
     
     public function vernotas($codalum,$sem)
     {$sql="
     SELECT 
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
  `docente`.`doc_vcNombre`
FROM
  `matriculadetalle`
  INNER JOIN `registroeval` ON (`matriculadetalle`.`matdet_iCodigo` = `registroeval`.`matdet_iCodigo`)
  INNER JOIN `matricula` ON (`matricula`.`mat_iCodigo` = `matriculadetalle`.`mat_iCodigo`)
  INNER JOIN `seccion` ON (`matriculadetalle`.`sec_iCodigo` = `seccion`.`sec_iCodigo`)
  INNER JOIN `curso` ON (`seccion`.`cur_iCodigo` = `curso`.`cur_iCodigo`)
  INNER JOIN `docente` ON (`seccion`.`doc_iCodigo` = `docente`.`doc_iCodigo`)
WHERE
  `matricula`.`alu_iCodigo` = 447
  and `seccion`.`sem_iCodigo` = 20212
  ";
        $data1=DB::select($sql);
        return $data1;
     }
     ///
   public function  buscaralumno($dni)
   { 
       $sql='SELECT 
          *
         FROM
         alumno
        WHERE
     alumno.alu_vcDocumento = "'.$dni.'"';
   $data1=DB::select($sql);
  return $data1;
  }
  public function validaralumno(Request $request)
  {
    return view('alumno.validaralumno');
  }
}