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


use DataTables;

class SilabusemestreController extends Controller
{
    public function index($semestre)
   {

   // return $alumno;
    $sales=DB::table('silabus')->get();
    $data1=DB::select('SELECT
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
    silabus.formulaPU5,
    silabus.tipoPU1,
    silabus.tipoPU2,
    silabus.tipoPU3,
    silabus.tipoPU4,
    silabus.tipoPU5,
    silabus.nro_evalPU1,
    silabus.nro_evalPU2,
    silabus.nro_evalPU3,
    silabus.nro_evalPU4,
    silabus.nro_evalPU5
    FROM
    curso
    INNER JOIN seccion ON seccion.cur_iCodigo = curso.cur_iCodigo
    INNER JOIN silabus ON seccion.sec_iCodigo = silabus.sec_iCodigo
    where seccion.sem_iCodigo="'.$semestre.'"');    
    return $data1;
   }

   public function buscarcriteriosilabo($semestre,$codcurso)
   {

   // return $alumno;

    $data1=DB::select("SELECT 
    `seccion`.`sem_iCodigo`,
    `curso`.`cur_vcCodigo`,
    `seccion`.`cur_iCodigo`,
    `curso`.`cur_vcNombre`,
    `silabus`.`sil_iCodigo`,
    `silabus`.`sec_iCodigo`,
    `silabus`.`unidades`,
    `silabus`.`tipoPF`,
    `silabus`.`formulaPF`,
    `silabus`.`tipoPU1`,
    `silabus`.`formulaPU1`,
    `silabus`.`nro_evalPU1`,
    `silabus`.`tipoPU2`,
    `silabus`.`formulaPU2`,
    `silabus`.`nro_evalPU2`,
    `silabus`.`tipoPU3`,
    `silabus`.`formulaPU3`,
    `silabus`.`nro_evalPU3`,
    `silabus`.`tipoPU4`,
    `silabus`.`formulaPU4`,
    `silabus`.`nro_evalPU4`,
    `silabus`.`tipoPU5`,
    `silabus`.`formulaPU5`,
    `silabus`.`nro_evalPU5`,
    `silabus`.`fech_ent1_ini`,
    `silabus`.`fech_ent1_fin`,
    `silabus`.`fech_ent2_ini`,
    `silabus`.`fech_ent2_fin`,
    `silabus`.`fech_ent3_ini`,
    `silabus`.`fech_ent3_fin`,
    `silabus`.`fech_ent4_ini`,
    `silabus`.`fech_ent4_fin`
  FROM
    `seccion`
    INNER JOIN `silabus` ON (`seccion`.`sec_iCodigo` = `silabus`.`sec_iCodigo`)
    INNER JOIN `curso` ON (`seccion`.`cur_iCodigo` = `curso`.`cur_iCodigo`)
  WHERE
    `curso`.`cur_iCodigo` = '$codcurso' AND 
    `seccion`.`sem_iCodigo` = $semestre");    
    return $data1;
   }

   public function registrarsilabus($seccion,
                            $unidades,
                            $tipoPF,
                            $formulaPF,
                            $tipoPU1,
                            $formulaPU1,
                            $nro_evalPU1,
                            $tipoPU2,
                            $formulaPU2,
                            $nro_evalPU2,
                            $tipoPU3,
                            $formulaPU3,
                            $nro_evalPU3,
                            $tipoPU4,
                            $formulaPU4,
                            $nro_evalPU4,
                            $tipoPU5,
                            $formulaPU5,
                            $nro_evalPU5,
                            $fech_ent1_ini,
                            $fech_ent1_fin,
                            $fech_ent2_ini,
                            $fech_ent2_fin,
                            $fech_ent3_ini,
                            $fech_ent3_fin,
                            $fech_ent4_ini,
                            $fech_ent4_fin,
                            $fech_ent5_ini,
                            $fech_ent5_fin )
         {

   // return $alumno;

  $sql="select * from silabus where sec_iCodigo='$seccion'";
    $data1=DB::select($sql);
    $tbuscado=count($data1);
   // return $data1;
    if($tbuscado<1)
    {$sql="insert into silabus(sec_iCodigo) values('$seccion')";
     $data1=DB::select($sql);
    }

    $sql="update silabus set unidades='$unidades' where sec_iCodigo='$seccion'";
    $data1=DB::select($sql);
    
    $sql="update silabus set tipoPF='$tipoPF' where sec_iCodigo='$seccion'";
    $data1=DB::select($sql);
    
    $sql="update silabus set formulaPF='$formulaPF' where sec_iCodigo='$seccion'";
    $data1=DB::select($sql);

    //reiniciar uni1,uni2,uni3
    $sql="update silabus set
    tipoPU1='',
    formulaPU1='',
	nro_evalPU1=0,
	tipoPU2='',
	formulaPU2='',
	nro_evalPU2=0,
	tipoPU3='',
	formulaPU3='',
	nro_evalPU3=0,
	tipoPU4='',
	formulaPU4='',
	nro_evalPU4=0,
	tipoPU5='',
	formulaPU5='',
	nro_evalPU5=0
    where sec_iCodigo='$seccion'";
    $data1=DB::select($sql);
    
    if($unidades>=1)
    {
    $sql="update silabus set tipoPU1='$tipoPU1' where sec_iCodigo='$seccion'";
    $data1=DB::select($sql);
    $sql="update silabus set formulaPU1='$formulaPU1' where sec_iCodigo='$seccion'";
    $data1=DB::select($sql);
    $sql="update silabus set  nro_evalPU1='$nro_evalPU1' where sec_iCodigo='$seccion'";
    $data1=DB::select($sql);}
    
    if($unidades>=2)
    {
    $sql="update silabus set  tipoPU2='$tipoPU2' where sec_iCodigo='$seccion'";
    $data1=DB::select($sql);
    $sql="update silabus set  formulaPU2='$formulaPU2' where sec_iCodigo='$seccion'";
    $data1=DB::select($sql);
    $sql="update silabus set  nro_evalPU2='$nro_evalPU2' where sec_iCodigo='$seccion'";
    $data1=DB::select($sql);
    }
    if($unidades>=3)
    {
    $sql="update silabus set  tipoPU3='$tipoPU3' where sec_iCodigo='$seccion'";
    $data1=DB::select($sql);
    $sql="update silabus set  formulaPU3='$formulaPU3' where sec_iCodigo='$seccion'";
    $data1=DB::select($sql);
    $sql="update silabus set  nro_evalPU3='$nro_evalPU3' where sec_iCodigo='$seccion'";
    $data1=DB::select($sql);
    }
    if($unidades>=4)
    {
    $sql="update silabus set  tipoPU4='$tipoPU4' where sec_iCodigo='$seccion'";
    $data1=DB::select($sql);
    $sql="update silabus set  formulaPU4='$formulaPU4' where sec_iCodigo='$seccion'";
    $data1=DB::select($sql);
    $sql="update silabus set  nro_evalPU4='$nro_evalPU4' where sec_iCodigo='$seccion'";
    $data1=DB::select($sql);
    }
    if($unidades>=5)
    {
    $sql="update silabus set tipoPU5='$tipoPU5' where sec_iCodigo='$seccion'";
    $data1=DB::select($sql);
    $sql="update silabus set formulaPU5='$formulaPU5' where sec_iCodigo='$seccion'";
    $data1=DB::select($sql);
    $sql="update silabus set nro_evalPU5='$nro_evalPU5' where sec_iCodigo='$seccion'";
    $data1=DB::select($sql);
    }

    $sql="update silabus set fech_ent1_ini='$fech_ent1_ini' where sec_iCodigo='$seccion'";
    $data1=DB::select($sql);
    $sql="update silabus set fech_ent1_fin='$fech_ent1_fin' where sec_iCodigo='$seccion'";
    $data1=DB::select($sql);
    $sql="update silabus set fech_ent2_ini='$fech_ent2_ini' where sec_iCodigo='$seccion'";
    $data1=DB::select($sql);
    $sql="update silabus set fech_ent2_fin='$fech_ent2_fin' where sec_iCodigo='$seccion'";
    $data1=DB::select($sql);
    $sql="update silabus set fech_ent3_ini='$fech_ent3_ini' where sec_iCodigo='$seccion'";
    $data1=DB::select($sql);
    $sql="update silabus set fech_ent3_fin='$fech_ent3_fin' where sec_iCodigo='$seccion'";
    $data1=DB::select($sql);
    $sql="update silabus set fech_ent4_ini='$fech_ent4_ini' where sec_iCodigo='$seccion'";
    $data1=DB::select($sql);
    $sql="update silabus set fech_ent4_fin='$fech_ent4_fin' where sec_iCodigo='$seccion'";
    $data1=DB::select($sql);
    try{
    $sql="update silabus set fech_ent5_ini='$fech_ent5_ini' where sec_iCodigo='$seccion'";
    $data1=DB::select($sql);
    $sql="update silabus set fech_ent5_fin='$fech_ent5_fin' where sec_iCodigo='$seccion'";
    $data1=DB::select($sql);
    } catch(\Illuminate\Database\QueryException $ex){  }
    
    return $data1;
   
   }

    public function store(Request $request)
    { 
        $mifecha=date("Y-m-d");
        $codcurso=request('codcurso');
        $semestre=request('semestre');
        $file=$request->file('file') ;
        $extension = $request->file('file')->extension();

        echo $extension ; 
        if(strtoupper($extension)!="PDF")
         {echo "NO ES UN PDF";
              
              $menu="SILABUS";
            // return view('docente.index',['menu' => $menu]);
            // return redirect('/docente')->with('menu', $menu);
            return redirect()->route('docente.index', ['menu' => $menu]);
         }
        $fecha=$mifecha;
        $filenom="cur".$codcurso."sem".$semestre."fe".$fecha;
        echo $filenom;
      //   if($request->hasFile('file'))
          { $file=$request->file('file')->store('silabus','public');

            // if (!File::exists('public/silabus/otro.jpg'))
            if (!File::exists('public/silabus/'.$filenom.'.pdf'))
            Storage::delete('public/silabus/'.$filenom.'.pdf');
              //Storage::putFileAs('photos', new File('/path/to/photo'), 'photo.jpg');
          }
          Storage::move('public/'.$file, 'public/silabus/'.$filenom.'.pdf');
          
            $addsilabu=new SilabusemestreController();
    //   $addsilabu->registrarsilabusfile($codcurso,$semestre,$fecha,$file);//graba
             $addsilabu->registrarsilabusfile($codcurso,$semestre,$fecha,"silabus/".$filenom.'.pdf');//graba
              $menu="SILABUS";
          return redirect()->route('docente.index', ['menu' => $menu]);
           //   return view('docente.index',['menu' => $menu]);
           }

        public function destroy( Request $request)
        {
       /*   unlink(dirname(__FILE__) .'public/'."silabus/sIoPeoMfMIUgpVrkInkLrvfRu9McS1Pf5xqr7yUB.png");*/
       $midel=new SilabusemestreController();
       $nomfile= request('arch');
       $codcurso= request('codcurso');
       $semestre= request('semestre');
      
    //   echo "eliminando";
          if(Storage::delete('public/'.$nomfile))
          { echo "completado";

          }
          $midel->deletesilabusfile($codcurso,$semestre);
      //    echo $nomfile;
      $menu="SILABUS";
   //  return view('docente.index',['menu' => $menu]);
  return redirect('/docente')->with('menu', $menu);
 //  return redirect()->route('/docente', ['menu' => $menu]);

//request('codcurso');
       //   echo $nomfile;
        //  echo "eliminando";
        }

    public function registrarsilabusfile($codcurso,$semestre,$fecha,$archivo)
    { $reg=new SilabusemestreController();
      $reg->deletesilabusfile($codcurso,$semestre);
      $sql="insert into silabusfile(cur_iCodigo,sem_iCodigo,fecha,archivo) 
      values('$codcurso','$semestre','$fecha','$archivo')";
      $data1=DB::select($sql);
       return "Silabus registrado";
    }

    public function deletesilabusfile($codcurso,$semestre)
    {$sql="delete from silabusfile where cur_iCodigo='$codcurso' and sem_iCodigo='$semestre' 
       ";
      $data1=DB::select($sql);
      // return "Eliminar registrado";
     //  $menu="SILABUS";
   //    return view('docente.index',['menu' => $menu]);
     //  Storage::delete('public/silabus/'.$filenom.'.pdf');

    }

    public function estadosilasbufile($semestre,$codcurso)
   {

      // return $alumno;
      $t=0;
        $sql="select 
        count(cur_iCodigo) as total
        FROM silabusfile where
        sem_iCodigo='$semestre' and cur_iCodigo='$codcurso'
        ";
        $data1=DB::select($sql);
      // return $data1;
        foreach($data1 as $dato)
        {$t=$dato->total;
        }    
        if($t>0)
        return "COMPLETADO";
        else
        return "PENDIENTE";
   }

   public function silabusfilenombre($semestre,$codcurso)
   {
    $r="";
    $sql="select 
    *
    FROM silabusfile where
    sem_iCodigo='$semestre' and cur_iCodigo='$codcurso'
    ";
    $data1=DB::select($sql);
   // return $data1;
    foreach($data1 as $dato)
    {$r=$dato->archivo;
    }    
    return $r;
   
   }
   public function silabusseccion($seccion)
   {$sql="select * from
    silabus where sec_iCodigo='$seccion'";
    $data=DB::select($sql);
    return $data;
   }
}
