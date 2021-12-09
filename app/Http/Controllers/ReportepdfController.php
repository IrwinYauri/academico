<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Support\Facades\DB; //uso base datos
use Illuminate\Http\Request;//capturar datos
use Barryvdh\DomPDF\Facade as PDF;
use App\Http\Request\pdfFormRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;


class ReportepdfController extends  Controller
{
    public function boletasnotas ()
   {
       
 $current = Route::getFacadeRoot()->current();
 $uri = $current->uri();

$miurl=URL::current();
$dataalumno=HTTP::get($miurl."/../../alumnodatos1");
$sales=DB::table('area')->get();
    //return $sales;
    $alumno="ferfer";
 //   return $dataalumno;
 //$pdf =\PDF::loadView('reportepdf.boletasnotas',["sales"=>$sales,"dataalumno"->$dataalumno],compact('alumno'));  
 //   return $pdf; 
  // return $pdf->download('reporte.pdf');
    //$sales=DB::table('sales')->where('id','>',$d)->get();
return view('reportepdf.boletasnotas',["sales"=>$sales,"dataalumno"=>$dataalumno],compact('alumno'));
   }
   public function horariopdf()
   {
    //-----
   //$pdf=PDF::loadView('alumno.horario');
   //return $pdf->download('reporte.pdf');
   $data1=DB::select('SELECT nrohora,hora,turno from horarioturno order by nrohora,turno');
  // $misdatos['misareas']=$data1;
  
   //return view('reportepdf.horariopdf',$misdatos);
    $pdf=PDF::loadView('reportepdf.horariopdf',["misareas"=>$data1]);
   return $pdf->download('reporte.pdf');
   }
   
   public function recordalumno(Request $request)
   {/*
    $pdf=PDF::loadView('alumno/recordacademico');
    return $pdf->download('reporte.pdf');
    */
    $contenido="Sistema Academico<br>".$request->imprimirx;
    $pdf = app('dompdf.wrapper');
   // $pdf->loadView('alumno/recordacademico');
    //$pdf->loadHTML('<h1>Styde.net</h1>');
    $pdf->loadHTML($contenido)
    ->setPaper('a4', 'landscape')
    ->download('archivo.pdf');

    return $pdf->download('recordacademico.pdf');
   }
   public function boletaalumno(Request $request)
   {/*
    $pdf=PDF::loadView('alumno/recordacademico');
    return $pdf->download('reporte.pdf');
    */
    $contenido="Sistema Academico<br>".$request->imprimirx;
    $pdf = app('dompdf.wrapper');
   // $pdf->loadView('alumno/recordacademico');
    //$pdf->loadHTML('<h1>Styde.net</h1>');
    $pdf->loadHTML($contenido)
    ->setPaper('a4', 'landscape')
    ->download('archivo.pdf');

    return $pdf->download('boletanotas.pdf');
   }

   public function boletaalumno01(Request $request)
   {/*
    $pdf=PDF::loadView('alumno/recordacademico');
    return $pdf->download('reporte.pdf');
    */
    //$contenido="Sistema Academico<br>".$request->imprimirx;
    //$contenido="Boleta de prueba";
    $pdf = app('dompdf.wrapper');
    $pdf->loadView('alumno/boletanotas2')
    //$pdf->loadHTML('<h1>Styde.net</h1>');
    //$pdf->loadHTML($contenido)
    //->setPaper('a4', 'landscape')//horizontal
    ->setPaper('a4', 'portrait')
    ->download('archivo.pdf');

    return $pdf->download('boletanotas01.pdf');
   }
}
