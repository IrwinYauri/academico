@php
session_start();
 $coddocentex="0";
 $semestre="0";
 $codcurso="0";
 $codalumno="0";
 $nota="0";
 //$unidad="0";
 //$nro="0";
 if(isset($_SESSION['coddocentex'])){
  $coddocentex=$_SESSION['coddocentex'];
 }
else {
   return "NO TIENES ACCESO";
}
if(isset($_GET["semestre"]) && isset($_GET["codalumno"]) && isset($_GET["codcurso"]) && isset($_GET["nota"]))
{$coddocentex="";
 $semestre=$_GET["semestre"];
 $codcurso=$_GET["codcurso"];
 $codalumno=$_GET["codalumno"];
 $nota=$_GET["nota"];
 //$unidad=$_GET["unidad"];
 //$nro=$_GET["nro"];
}

 use App\Http\Controllers\NotasController; 
 //editarnota($semestre,$codcurso,$codalumno,$nota)
 $pnotas=new NotasController();
//--xx$r=$pnotas->editarnota($semestre,$codcurso,$codalumno,$nota);
$r=$pnotas->editarnotasustitutorio($semestre,$codcurso,$codalumno,$nota);

//dd($r);
 @endphp
 <div id="micontenidowww">
     minota
     <script>
    //  alertagrabarx("{{dd($r)}}");
    </script>
    </div>
 