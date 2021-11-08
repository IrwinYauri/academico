<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Support\Facades\DB; //uso base datos
use Illuminate\Http\Request;//capturar datos

use DataTables;

class SemestreController extends Controller
{
    public function index()
   { 
    //return view('admin.index');
   }
   public function semestreactivo()
   {// echo "Semestre";
   // return "Proceso completado";
   $sql='SELECT
   *
   FROM
   semestre
   where
   sem_cActivo="S" ';
    $data1=DB::select($sql);    
    return $data1;
   }
    
}
