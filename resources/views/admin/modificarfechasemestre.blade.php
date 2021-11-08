@php
use App\Http\Controllers\AdminController; 
$listasemestres=new AdminController();
//$listasemestre=$listasemestres->versemestre();
$sem_iMatriculaInicio="";
       		$sem_iMatriculaFinal="";
       		$sem_dEncuestaInicio="";
       		$sem_dEncuestaFinal="";
       		$sem_dInicioClases="";
       	   $sem_iSemanas="";
       	   $sem_dActaInicio="";
       	   $sem_dActaFinal="";
       	    $sem_iToleranciaInicio="";
       	    $sem_iToleranciaFinal="";
       	    $fech_ent1_ini="";
       	     $fech_ent1_fin ="";
       	    $fech_ent2_ini ="";
       	     $fech_ent2_fin="";
       	    $fech_ent3_ini ="";
       	     $fech_ent3_fin="";
       	    $fech_ent4_ini="";
       	     $fech_ent4_fin="";
       	    $fech_ent5_ini ="";
       	    $fech_ent5_fin="";
       	     $sem_dAplazadoInicio="";
       	    $sem_dAplazadoFinal="";
       	    $fecMatReg_ini="";
       	    $fecMatReg_fin="";
       	    $fecMatExt_ini="";
       	    $fecMatExt_fin="";
if(isset($_REQUEST["semestre"]))
{$semestre=$_REQUEST["semestre"];
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
        }
$rpt=$listasemestres->modificarfechasemestre($semestre,
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
       	    $fecMatExt_fin);
echo "Completado";

@endphp
<div id="micontenidoxx"></div>