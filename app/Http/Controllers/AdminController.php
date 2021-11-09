<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Support\Facades\DB; //uso base datos
use Illuminate\Http\Request;//capturar datos

use DataTables;

class AdminController extends Controller
{
    public function index()
   { 
    return view('admin.index');
   }
   public function show($mivistas)
   {return view("admin.".$mivistas."");
    
   }
   public function validaradmin(Request $request)
  {
    return view('admin.validaradmin');
  }


   public function verdocente()
   {
       $sql='Select * from docente order by doc_vcPaterno';
       $data1=DB::select($sql);    
       return $data1;
     //  return response()->json($docente);

       return view('admin.listadocente');
    }
    public function veralumno()
   {
       $sql='Select * from alumno';
       $data1=DB::select($sql);    
       return $data1;
     //  return response()->json($docente);
    
    }
    public function verusuario($coduser)
    {
        $sql='Select * from seg_usuario where usu_vcUsuario="'.$coduser.'"';
        $data1=DB::select($sql);    
        return $data1;
     
     }
     public function verusuarios()
    {
        $sql='Select * from seg_usuario';
        $data1=DB::select($sql);    
        return $data1;
     
     }
     public function versemestre()
    {
        $sql='Select * from semestre';
        $data1=DB::select($sql);    
        return $data1;
     
     }
     public function versemestreperiodo($semestre)
     {
         $sql='Select * from semestre where sem_iCodigo="'.$semestre.'"';
         $data1=DB::select($sql);    
         return $data1;
      
      }
     public function veraula()
     {
         $sql='Select * from aula';
         $data1=DB::select($sql);    
         return $data1;
      
      }

      public function verlistaencuesta()
      {
          $sql='Select * from encuesta';
          $data1=DB::select($sql);    
          return $data1;
       
       }
       public function verlistaencuestacategoria()
      {
          $sql='Select * from encuesta_categoria';
          $data1=DB::select($sql);    
          return $data1;
       
       }
       public function verlistaencuestapreguntasemestre($semestre)
      {
          $sql='SELECT 
          `encuesta`.`enc_iCodigo`,
          `encuesta`.`enc_vcObservacion`,
          `encuesta_pregunta`.`encpre_vcPregunta`,
          `encuesta_pregunta`.`encpre_iPuntaje`,
          `encuesta_pregunta`.`encpre_iPeso`,
          `encuesta_categoria`.`enccat_vcNombre`,
          `encuesta`.`sem_iCodigo`,
          `encuesta_pregunta`.`encpre_iNumero`,
          `encuesta_pregunta`.`encpre_iCodigo`
        FROM
          `encuesta`
          INNER JOIN `encuesta_pregunta` ON (`encuesta`.`enc_iCodigo` = `encuesta_pregunta`.`enc_iCodigo`)
          INNER JOIN `encuesta_categoria` ON (`encuesta_pregunta`.`enccat_iCodigo` = `encuesta_categoria`.`enccat_iCodigo`)
          
          where `encuesta`.`sem_iCodigo`="'.$semestre.'"';
          $data1=DB::select($sql);    
          return $data1;
       
       }
    public function verdocente2(Request $request)
   { if($request->ajax()){
       $animales=DB::select('Select * from docente');
       return DataTables::of($animales)
       ->addColumn('action',function($animales){
           $acciones='<a href="javascript:void(0)" onclick="editarAnimal('.$animales->id.')" class="btn btn-info btn-sm"> Editar </a>';
           $acciones.='&nbsp;&nbsp;<button type="button" name="delete" id="'.$animales->id.'" class="delete btn btn-danger btn-sm"> Eliminar </button>';
        return $acciones;
           })
           ->rawColumns(['action'])
           ->make(true);
         }

       return view('admin.listadocente');
    }

public function cambiarclavedocente($cod,$clave){
    // llamar procedimiento
   $xclave=strtoupper(sha1($clave));
   // return $cod."--".$clave;
    $sql="
   update docente
   set doc_vcPassword='$xclave'
   where doc_iCodigo='$cod'";
   $r=DB::select($sql);
  //  return back();
    }

    public function cambiarclavealumno($cod,$clave){
      // llamar procedimiento
     $xclave=strtoupper(sha1($clave));
     // return $cod."--".$clave;
      $sql="
     update alumno
     set alu_vcPassword='$xclave'
     where alu_iCodigo='$cod'";
     $r=DB::select($sql);
    //  return back();
      }

   public function registrardocente(Request $request){
    // llamar procedimiento
   $animal=DB::select('call spcre_animal(?,?,?)',
   [$request->nombre,$request->especie,$request->genero]);
    return back();
    }
    
    public function eliminardocente($id){
        $animal=DB::select('call spdel_animal(?)',[$id]);
        return back();
        }
        public function editardocente($id){
           $animal=DB::select('call spseledit_animal(?)',[$id]);
            return response()->json($animal);
        }
        
        public function actualizardocente(Request $request){
            $animal=DB::select('call spupd_animal(?,?,?,?)',
            [$request->id,$request->nombre,$request->especie,$request->genero]);
            return back();
        }
        public function modificarfechasemestre($semestre,
        $sem_iMatriculaInicio,
        $sem_iMatriculaFinal,
        $sem_dEncuestaInicio,
        $sem_dEncuestaFinal,
        $sem_dInicioClases,
         $sem_iSemanas,
         $sem_dActaInicio,
         $sem_dActaFinal,
          $sem_iToleranciaInicio,
          $sem_iToleranciaFinal,
          $fech_ent1_ini,
           $fech_ent1_fin ,
          $fech_ent2_ini ,
           $fech_ent2_fin,
          $fech_ent3_ini ,
           $fech_ent3_fin,
          $fech_ent4_ini,
           $fech_ent4_fin,
          $fech_ent5_ini ,
          $fech_ent5_fin,
           $sem_dAplazadoInicio,
          $sem_dAplazadoFinal,
          $fecMatReg_ini,
          $fecMatReg_fin,
          $fecMatExt_ini,
          $fecMatExt_fin){//inicio codigo 
          $semestre=$_REQUEST["semestre"];
          $sem_iMatriculaInicio=$_REQUEST["sem_iMatriculaInicio"];
          $sem_iMatriculaFinal=$_REQUEST["sem_iMatriculaFinal"];
          $sem_dEncuestaInicio=$_REQUEST["sem_dEncuestaInicio"];
          $sem_dEncuestaFinal=$_REQUEST["sem_dEncuestaFinal"];
          $sem_dInicioClases=$_REQUEST["sem_dInicioClases"];
          $sem_iSemanas=$_REQUEST["sem_iSemanas"];
          $sem_dActaInicio=$_REQUEST["sem_dActaInicio"];
          $sem_dActaFinal=$_REQUEST["sem_dActaFinal"];
          $sem_iToleranciaInicio=$_REQUEST["sem_iToleranciaInicio"];
          $sem_iToleranciaFinal=$_REQUEST["sem_iToleranciaFinal"];
          $fech_ent1_ini=$_REQUEST["fech_ent1_ini"];
          $fech_ent1_fin=$_REQUEST["fech_ent1_fin"];
          $fech_ent2_ini=$_REQUEST["fech_ent2_ini"];
          $fech_ent2_fin=$_REQUEST["fech_ent2_fin"];
          $fech_ent3_ini=$_REQUEST["fech_ent3_ini"];
          $fech_ent3_fin=$_REQUEST["fech_ent3_fin"];
          $fech_ent4_ini=$_REQUEST["fech_ent4_ini"];
          $fech_ent4_fin=$_REQUEST["fech_ent4_fin"];
          $fech_ent5_ini=$_REQUEST["fech_ent5_ini"];
          $fech_ent5_fin=$_REQUEST["fech_ent5_fin"];
          $sem_dAplazadoInicio=$_REQUEST["sem_dAplazadoInicio"];
          $sem_dAplazadoFinal=$_REQUEST["sem_dAplazadoFinal"];
          $fecMatReg_ini=$_REQUEST["fecMatReg_ini"];
          $fecMatReg_fin=$_REQUEST["fecMatReg_fin"];
          $fecMatExt_ini=$_REQUEST["fecMatExt_ini"];
          $fecMatExt_fin=$_REQUEST["fecMatExt_fin"];
          try { 
        $sql="update semestre set
      			sem_iMatriculaInicio='$sem_iMatriculaInicio'  where sem_iCodigo='$semestre'";
            $r=DB::select($sql);
          } catch(\Illuminate\Database\QueryException $ex){  }

          try { 
         $sql="update semestre set
          	sem_iMatriculaFinal='$sem_iMatriculaFinal' where sem_iCodigo='$semestre'";
            $r=DB::select($sql);
          } catch(\Illuminate\Database\QueryException $ex){  }

          try {
                  $sql="update semestre set
	        	sem_dEncuestaInicio='$sem_dEncuestaInicio' where sem_iCodigo='$semestre'";
           $r=DB::select($sql);} catch(\Illuminate\Database\QueryException $ex){  }
      
           try {
    $sql="update semestre set
		sem_dEncuestaFinal='$sem_dEncuestaFinal' where sem_iCodigo='$semestre'";
    $r=DB::select($sql);} catch(\Illuminate\Database\QueryException $ex){  }
    
    try {
    $sql="update semestre set
		sem_dInicioClases='$sem_dInicioClases' where sem_iCodigo='$semestre'";
    $r=DB::select($sql);} catch(\Illuminate\Database\QueryException $ex){  }

    try {
	  $sql="update semestre set 
    sem_iSemanas='$sem_iSemanas' where sem_iCodigo='$semestre'";
    $r=DB::select($sql);} catch(\Illuminate\Database\QueryException $ex){  }

    try {
    $sql="update semestre set 
	   sem_dActaInicio='$sem_dActaInicio'  where sem_iCodigo='$semestre'";
     $r=DB::select($sql);} catch(\Illuminate\Database\QueryException $ex){  }

     try {
    $sql="update semestre set 
	   sem_dActaFinal='$sem_dActaFinal' where sem_iCodigo='$semestre'";
     $r=DB::select($sql);} catch(\Illuminate\Database\QueryException $ex){  }

     try {
     $sql="update semestre set 
	    sem_iToleranciaInicio='$sem_iToleranciaInicio'  where sem_iCodigo='$semestre'";
      $r=DB::select($sql);} catch(\Illuminate\Database\QueryException $ex){  }

      try {
      $sql="update semestre set 
	    sem_iToleranciaFinal='$sem_iToleranciaFinal'  where sem_iCodigo='$semestre'";
      $r=DB::select($sql);} catch(\Illuminate\Database\QueryException $ex){  }

      try {
      $sql="update semestre set
	    fech_ent1_ini='$fech_ent1_ini'   where sem_iCodigo='$semestre'";
      $r=DB::select($sql);} catch(\Illuminate\Database\QueryException $ex){  }

      try {
      $sql="update semestre set
	     fech_ent1_fin='$fech_ent1_fin' where sem_iCodigo='$semestre'";
       $r=DB::select($sql);} catch(\Illuminate\Database\QueryException $ex){  }

       try {
       $sql="update semestre set
	    fech_ent2_ini='$fech_ent2_ini' where sem_iCodigo='$semestre'";
      $r=DB::select($sql);} catch(\Illuminate\Database\QueryException $ex){  }

      try {
      $sql="update semestre set
	     fech_ent2_fin='$fech_ent2_fin'  where sem_iCodigo='$semestre'";
       $r=DB::select($sql);} catch(\Illuminate\Database\QueryException $ex){  }

       try {
       $sql="update semestre set
	    fech_ent3_ini ='$fech_ent3_ini'  where sem_iCodigo='$semestre'";
      $r=DB::select($sql);} catch(\Illuminate\Database\QueryException $ex){  }

      try {
      $sql="update semestre set
	     fech_ent3_fin='$fech_ent3_fin' where sem_iCodigo='$semestre'";
       $r=DB::select($sql);} catch(\Illuminate\Database\QueryException $ex){  }

       try {
       $sql="update semestre set
	    fech_ent4_ini ='$fech_ent4_ini' where sem_iCodigo='$semestre'";
      $r=DB::select($sql);} catch(\Illuminate\Database\QueryException $ex){  }
      
      try {
      $sql="update semestre set
	     fech_ent4_fin='$fech_ent4_fin' where sem_iCodigo='$semestre'";
       $r=DB::select($sql);} catch(\Illuminate\Database\QueryException $ex){  }

       try { 
              $sql="update semestre set
          fech_ent5_ini ='$fech_ent5_ini' where sem_iCodigo='$semestre'";
          $r=DB::select($sql);} catch(\Illuminate\Database\QueryException $ex){  }

          try { 
          $sql="update semestre set
          fech_ent5_fin='$fech_ent5_fin' where sem_iCodigo='$semestre'";
          $r=DB::select($sql); } catch(\Illuminate\Database\QueryException $ex){ 
              //dd($ex->getMessage()); 
              echo "<script>
              alert('::ATENCION:: Tiene que Agregar los campos de fecha de 5 Unidad')
              </script>";
              // Note any method of class PDOException can be called on $ex.
            }
      
       $sql="update semestre set
	     sem_dAplazadoInicio='$sem_dAplazadoInicio' where sem_iCodigo='$semestre'";
       $r=DB::select($sql);
      $sql="update semestre set
	    sem_dAplazadoFinal='$sem_dAplazadoFinal' where sem_iCodigo='$semestre'";
      $r=DB::select($sql);
      $sql="update semestre set
	    fecMatReg_ini='$fecMatReg_ini' where sem_iCodigo='$semestre'";
      $r=DB::select($sql);
      $sql="update semestre set
	     fecMatReg_fin='$fecMatReg_fin' where sem_iCodigo='$semestre'";
       $r=DB::select($sql);
       $sql="update semestre set
	    fecMatExt_ini='$fecMatExt_ini' where sem_iCodigo='$semestre'";
      $r=DB::select($sql);
      
      $sql="update semestre set
	     fecMatExt_fin='$fecMatExt_fin' where sem_iCodigo='$semestre'";
       $r=DB::select($sql);
       
      
      //  return back();
        }



 public function activarsemestre($semestre){
        $sql="
       update semestre
       set sem_cActivo='N'
         ";
       $r=DB::select($sql);
        $sql="
       update semestre
       set sem_cActivo='S'
       where sem_iCodigo='$semestre'";
       $r=DB::select($sql);
      //  return back();
        }

        public function listadocentesemestre($semestre)
        {$sql="SELECT
          seccion.sem_iCodigo,
          docente.doc_vcDocumento,
          docente.doc_vcPaterno,
          docente.doc_vcMaterno,
          docente.doc_vcNombre,
          docente.doc_iCodigo
          FROM
          seccion
          INNER JOIN seccion_horario ON seccion.sec_iCodigo = seccion_horario.sec_iCodigo
          INNER JOIN docente ON seccion_horario.doc_iCodigo = docente.doc_iCodigo
          where seccion.sem_iCodigo='$semestre' group by seccion.sem_iCodigo,docente.doc_vcDocumento,
          docente.doc_vcPaterno,
          docente.doc_vcMaterno,
          docente.doc_vcNombre,
          docente.doc_iCodigo
          ";
          $r=DB::select($sql);
          return $r;
          //  return back();
            }

        
  
    
}
