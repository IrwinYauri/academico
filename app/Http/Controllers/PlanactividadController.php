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

class PlanactividadController extends Controller
{
    public function index()
    { }
    public function consultasemestreplan($semestre,$coddoc)
    {$r=0;
        $sql="SELECT count(*) as total FROM 
    `docente_planactividades` 
    WHERE `doc_iCodigo`='$coddoc' AND `sem_iCodigo`='$semestre'";
        $data1=DB::select($sql); 
        foreach($data1 as $dat)
        {$r=$dat->total;}
        return $r; 
    }
    public function crearplansemestre($coddoc,$semestre)
    { $sql="insert into docente_planactividades(doc_iCodigo,sem_iCodigo,path_file) 
        values('$coddoc','$semestre','')";
        $data1=DB::select($sql);
        return "Plan Actividades Lectivas y no Lectivas Creadas";
    }
    public function store(Request $request)
    { 
        $mifecha=date("Y-m-d");
        $coddoc=request('coddoc');
        $semestre=request('semestre');
        $nro=request('nro');
        $file=$request->file('file') ;
       $extension = $request->file('file')->extension();
        // $extension="";
        echo $extension ; 
        if(strtoupper($extension)!="PDF")
         {echo "NO ES UN PDF";
            $menu="PLANACTIVIDAD";
            // return view('docente.index',['menu' => $menu]);
             return redirect()->route('docente.index', ['menu' => $menu]);
         }
        $fecha=$mifecha;
        $filenom="doc".$coddoc."sem".$semestre."fe".$fecha."_".$nro;
        echo $filenom;
      //   if($request->hasFile('file'))
          { $file=$request->file('file')->store('planactividad','public');

            // if (!File::exists('public/silabus/otro.jpg'))
            if (!File::exists('public/planactividad/'.$filenom.'.pdf'))
            Storage::delete('public/planactividad/'.$filenom.'.pdf');
              //Storage::putFileAs('photos', new File('/path/to/photo'), 'photo.jpg');
          }
          Storage::move('public/'.$file, 'public/planactividad/'.$filenom.'.pdf');
          
            $addsilabu=new PlanactividadController();
    //   $addsilabu->registrarsilabusfile($codcurso,$semestre,$fecha,$file);//graba
                //updateplanactividad($coddoc,$semestre,$file,$fecha,$nro);
             $addsilabu->updateplanactividad($coddoc,$semestre,"".$filenom.'.pdf',$fecha,$nro);//graba
        //     updateplanactividad($coddoc,$semestre,$file,$fecha,$nro)
              $menu="PLANACTIVIDAD";
          return redirect()->route('docente.index', ['menu' => $menu]);
           //   return view('docente.index',['menu' => $menu]);
           }
        public function updateplanactividad($coddoc,$semestre,$file,$fecha,$nro)
        {if($nro==0)
           {$cam="path_file";
            $fe="date_load";
            } 
         if($nro==1)
          { $cam="path_file1";
            $fe="load_date1";
            } 
         if($nro==2)
        {$cam="path_file2";
            $fe="load_date2";
            }     
         if($nro==3)
        {  $cam="path_file3";
            $fe="load_date3";
            }    
          if($nro==4)
        {$cam="path_file4";
            $fe="load_date4";
            }     
         if($nro==5)
         {$cam="path_file5";
            $fe="load_date5";
            }   

             $sql="update docente_planactividades set ".$cam."='$file',
             ".$fe."='$fecha' where doc_iCodigo='$coddoc' and
            sem_iCodigo='$semestre'
            ";
            $data1=DB::select($sql);
            return "Plan Actividades Lectivas y no Lectivas Editadas";

        }
        public function destroy( Request $request)
        {
       /*   unlink(dirname(__FILE__) .'public/'."silabus/sIoPeoMfMIUgpVrkInkLrvfRu9McS1Pf5xqr7yUB.png");*/
       $midel=new PlanactividadController();
       $nomfile= request('arch');
       $codcurso= request('codcurso');
       $semestre= request('semestre');
      
    //   echo "eliminando";
          if(Storage::delete('public/'.$nomfile))
          { echo "completado";

          }
          $midel->deletesilabusfile($codcurso,$semestre);
            //    echo $nomfile;
            $menu="PLANACTIVIDAD";
                //  return view('docente.index',['menu' => $menu]);
                return redirect('/docente')->with('menu', $menu);
            //  return redirect()->route('/docente', ['menu' => $menu]);

            //request('codcurso');

        }

    public function registrarplanactividad($codcurso,$semestre,$fecha,$archivo)
    { $reg=new SilabusemestreController();
      $reg->deleteplanactividad($codcurso,$semestre);
      $sql="insert into silabusfile(cur_iCodigo,sem_iCodigo,fecha,archivo) 
      values('$codcurso','$semestre','$fecha','$archivo')";
      $data1=DB::select($sql);
       return "Silabus registrado";
    }

    public function deleteplanactividad($codcurso,$semestre)
    {$sql="delete from silabusfile where cur_iCodigo='$codcurso' and sem_iCodigo='$semestre' 
       ";
      $data1=DB::select($sql);
      // return "Eliminar registrado";
     //  $menu="SILABUS";
   //    return view('docente.index',['menu' => $menu]);
     //  Storage::delete('public/silabus/'.$filenom.'.pdf');

    }

    public function estadoplanactividad($semestre,$codcurso)
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

   public function planactividadnombre($semestre,$codcurso,$nro)
   {$f0="";
    $f1="";
    $f2="";
    $f3="";
    $f4="";
    $f5="";

    $sql="select 
    *
    FROM docente_planactividades where
    sem_iCodigo='$semestre' and doc_iCodigo='$codcurso'
    ";
    $data1=DB::select($sql);
   // return $data1;
        foreach($data1 as $dato)
        {   $f0=$dato->path_file;
            $f1=$dato->path_file1;
            $f2=$dato->path_file2;
            $f3=$dato->path_file3;
            $f4=$dato->path_file4;
            $f5=$dato->path_file5;
        } 
        if($nro==0)   
        return $f0;
        if($nro==1)   
        return $f1;
        if($nro==2)   
        return $f2;
        if($nro==3)   
        return $f3;
        if($nro==4)   
        return $f4;
        if($nro==5)   
        return $f5;
   
   }
}