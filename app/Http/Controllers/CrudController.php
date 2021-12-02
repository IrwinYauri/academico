<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Support\Facades\DB; //uso base datos
use Illuminate\Http\Request;//capturar datos

use DataTables;

class CrudController extends Controller
{
    public function index()
   { 
    //return view('admin.index');
   }
   public function show($mivistas)
   {return view("crud.".$mivistas);
    
   }
    
}
