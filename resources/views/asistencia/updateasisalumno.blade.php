@php
use App\Http\Controllers\AsistenciaController;
$miupdate=new AsistenciaController();
if(isset($_GET["codhora"]) && isset($_GET["codalumno"])   && isset($_GET["estado"]) )
{$codhora=$_GET["codhora"];
 $codalumno=$_GET["codalumno"];
 $estado=$_GET["estado"];
 echo "Actualizando-hora";
 $r=$miupdate->updateasistenciadia($codhora,$codalumno,$estado);
 return $r;
}
@endphp
<div id="micontenidowww"></div>
