@php
use App\Http\Controllers\AdminController; 
$listasemestres=new AdminController();
//$listasemestre=$listasemestres->versemestre();
$semestre="";
if(isset($_REQUEST["semestre"]))
{$semestre=$_REQUEST["semestre"];
$rpt=$listasemestres->activarsemestre($semestre);
echo "Completado";
}
@endphp
<div id="micontenidoxx"></div>