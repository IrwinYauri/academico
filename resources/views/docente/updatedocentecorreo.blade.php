@php
use App\Http\Controllers\DocenteController; 
$listausuarios=new DocenteController();
if(isset($_REQUEST['xcod']))
{$cod =$_REQUEST['xcod'];
$correo1= $_REQUEST['correo1'];
$correo2= $_REQUEST['correo2'];
$cell= $_REQUEST['cell'];
$tef= $_REQUEST['tef'];
//updatedocentecorreo($coddoc,$email1,$email2,$cell,$tef)
$listausuario=$listausuarios->updatedocentecorreo($cod,$correo1,$correo2,$cell,$tef);
echo "DATOS ACTUALIZADOS";

}

@endphp