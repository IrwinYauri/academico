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

class PagosController extends Controller
{
    public function index()
   {$sql="";
      $data=DB::select($sql);
      return $data;
   }


   public function registrarpago()
    {echo "cargando pagos";
   
     }

    public function store(Request $request)
    { 
        $mifecha=date("Y-m-d");
        $codalumno=request('codalumno');
        $semestre=request('semestre');
        $tipo=request('tipox');

 echo $mifecha."<br>";

         $file=$request->file('file') ;
         $extension = $request->file('file')->extension();

        echo $extension ; 
        echo "<br>";
        echo $file;
        echo "<br>";
     //   echo $_FILES["file"]["tmp_name"];

       
    //    $extension= $_FILES['file']['type'];
  //  $extension = $request->file('file')->extension();

       // echo $extension;
       $extension= $file->getClientOriginalExtension();

       echo $extension;
       echo "<br>";

        if(strtoupper($extension)!="PDF" && strtoupper($extension)!="GIF" && strtoupper($extension)!="PNG" && strtoupper($extension)!="BMP" && strtoupper($extension)!="JPG")
         {echo "<script>alert('NO ES UN ARCHIVO VALIDO') </script>";
              
              $menu="SILABUS";
            // return view('docente.index',['menu' => $menu]);
            // return redirect('/docente')->with('menu', $menu);
          //xx---  return redirect()->route('docente.index', ['menu' => $menu]);
         }
        $fecha=$mifecha;
       
       $filenom="PA_".$tipo."_".$codalumno."_".$semestre."_".$fecha;
        
      
        echo $filenom;
        echo "<br>";
      //   if($request->hasFile('file'))
          { $file=$request->file('file')->store('recibos/'.$semestre.'','public');
echo $file;
            // if (!File::exists('public/silabus/otro.jpg'))
            if (!File::exists('public/recibos/'.$semestre.'/'.$filenom.'.pdf'))
               Storage::delete('public/recibos/'.$semestre.'/'.$filenom.'.pdf');
              //Storage::putFileAs('photos', new File('/path/to/photo'), 'photo.jpg');
          }
          Storage::move('public/'.$file, 'public/recibos/'.$semestre.'/'.$filenom.'.pdf');

       $this->registrarpago();
          
       //xxxx     $addsilabu=new SilabusemestreController();
    //   $addsilabu->registrarsilabusfile($codcurso,$semestre,$fecha,$file);//graba
    //xxxx         $addsilabu->registrarsilabusfile($codcurso,$semestre,$fecha,"silabus/".$filenom.'.pdf');//graba
              $menu="MATRICULA";
    //xxxx      return redirect()->route('docente.index', ['menu' => $menu]);
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
