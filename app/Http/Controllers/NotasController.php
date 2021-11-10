<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Support\Facades\DB; //uso base datos
use Illuminate\Http\Request;//capturar datos

use DataTables;

class NotasController extends Controller
{
    public function index()
   { 
    //return view('admin.index');
   }
   function editarnota($semestre,$curso,$codalumno,$nota)
   {$sql="update
     `matriculadetalle`
     INNER JOIN `registroeval` ON (`matriculadetalle`.`matdet_iCodigo` = `registroeval`.`matdet_iCodigo`)
     INNER JOIN `seccion` ON (`matriculadetalle`.`sec_iCodigo` = `seccion`.`sec_iCodigo`)
     INNER JOIN `seccion_horario` ON (`seccion`.`sec_iCodigo` = `seccion_horario`.`sec_iCodigo`)
     INNER JOIN `matricula` ON (`matriculadetalle`.`mat_iCodigo` = `matricula`.`mat_iCodigo`)
   set 
   `registroeval`.`CE11`='$nota'
   WHERE
     `matricula`.`sem_iCodigo` = '$semestre' AND 
     `seccion`.`cur_iCodigo` = '$curso' AND 
     `matricula`.`alu_iCodigo` = '$codalumno'";
     $data1=DB::select($sql);
    return $data1;


   }
   function editarnotax($semestre,$curso,$codalumno,$nota,$unidad,$nro)
   {$sql="update
     `matriculadetalle`
     INNER JOIN `registroeval` ON (`matriculadetalle`.`matdet_iCodigo` = `registroeval`.`matdet_iCodigo`)
     INNER JOIN `seccion` ON (`matriculadetalle`.`sec_iCodigo` = `seccion`.`sec_iCodigo`)
     INNER JOIN `seccion_horario` ON (`seccion`.`sec_iCodigo` = `seccion_horario`.`sec_iCodigo`)
     INNER JOIN `matricula` ON (`matriculadetalle`.`mat_iCodigo` = `matricula`.`mat_iCodigo`)
   set 
   registroeval.CE".$unidad.$nro."='$nota'
   WHERE
     `matricula`.`sem_iCodigo` = '$semestre' AND 
     `seccion`.`cur_iCodigo` = '$curso' AND 
     `matricula`.`alu_iCodigo` = '$codalumno'";
     $data1=DB::select($sql);
    return $data1;


   }

   function editarnotasustitutorio($semestre,$curso,$codalumno,$nota)
   {$sql="update
     `matriculadetalle`
     INNER JOIN `registroeval` ON (`matriculadetalle`.`matdet_iCodigo` = `registroeval`.`matdet_iCodigo`)
     INNER JOIN `seccion` ON (`matriculadetalle`.`sec_iCodigo` = `seccion`.`sec_iCodigo`)
     INNER JOIN `seccion_horario` ON (`seccion`.`sec_iCodigo` = `seccion_horario`.`sec_iCodigo`)
     INNER JOIN `matricula` ON (`matriculadetalle`.`mat_iCodigo` = `matricula`.`mat_iCodigo`)
   set 
   sust='$nota'
   WHERE
     `matricula`.`sem_iCodigo` = '$semestre' AND 
     `seccion`.`cur_iCodigo` = '$curso' AND 
     `matricula`.`alu_iCodigo` = '$codalumno'";
     $data1=DB::select($sql);
    return $data1;
   }

   function editarnotaaplazado($semestre,$curso,$codalumno,$nota)
   {$sql="update
     `matriculadetalle`
     INNER JOIN `registroeval` ON (`matriculadetalle`.`matdet_iCodigo` = `registroeval`.`matdet_iCodigo`)
     INNER JOIN `seccion` ON (`matriculadetalle`.`sec_iCodigo` = `seccion`.`sec_iCodigo`)
     INNER JOIN `seccion_horario` ON (`seccion`.`sec_iCodigo` = `seccion_horario`.`sec_iCodigo`)
     INNER JOIN `matricula` ON (`matriculadetalle`.`mat_iCodigo` = `matricula`.`mat_iCodigo`)
   set 
   aplaz='$nota'
   WHERE
     `matricula`.`sem_iCodigo` = '$semestre' AND 
     `seccion`.`cur_iCodigo` = '$curso' AND 
     `matricula`.`alu_iCodigo` = '$codalumno'";
     $data1=DB::select($sql);
    return $data1;
   }

   public function show($mivistas)
   {return view("notas.".$mivistas."");
    
   }
    
}
