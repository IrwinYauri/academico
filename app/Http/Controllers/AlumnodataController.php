<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Support\Facades\DB; //uso base datos
use Illuminate\Http\Request;//capturar datos

use DataTables;

class AlumnodataController extends Controller
{
    public function index()
   {
    $alumno="fer";
   // return $alumno;
    $sales=DB::table('area')->get();
    return $sales;
   }
    public function alumnodatos()
    { 
      //  $alumno="fersystem";
      //  return $alumno;
        $sales=DB::table('area')->get();
        return $sales;
    }
}
