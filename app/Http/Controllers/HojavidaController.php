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

class HojavidaController extends Controller
{
    public function index()
   { 
    //return view('admin.index');
   }
   public function store(Request $request)
    { 
        $mifecha=date("Y-m-d");
        $dni=request('dni');
        //$semestre=request('semestre');
        $file=$request->file('file') ;
        $extension = $request->file('file')->extension();

        echo $extension ; 
        if(strtoupper($extension)!="PDF")
         {echo "NO ES UN PDF";
              
              $menu="HOJAVIDA";
            // return view('docente.index',['menu' => $menu]);
            // return redirect('/docente')->with('menu', $menu);
            return redirect()->route('docente.index', ['menu' => $menu]);
         }
        $fecha=$mifecha;
        $filenom=$dni;
        echo $filenom;
      //   if($request->hasFile('file'))
          { $file=$request->file('file')->store('hojavida','public');

            // if (!File::exists('public/silabus/otro.jpg'))
            if (!File::exists('public/hojavida/'.$filenom.'.pdf'))
            Storage::delete('public/hojavida/'.$filenom.'.pdf');
              //Storage::putFileAs('photos', new File('/path/to/photo'), 'photo.jpg');
          }
          Storage::move('public/'.$file, 'public/hojavida/'.$filenom.'.pdf');
          
           // $addsilabu=new SilabusemestreController();
    //   $addsilabu->registrarsilabusfile($codcurso,$semestre,$fecha,$file);//graba
           //  $addsilabu->registrarsilabusfile($codcurso,$semestre,$fecha,"hojavida/".$filenom.'.pdf');//graba
              $menu="HOJAVIDA";
          return redirect()->route('docente.index', ['menu' => $menu]);
           //   return view('docente.index',['menu' => $menu]);
           }
    
}