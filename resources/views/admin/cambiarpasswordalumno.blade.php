@php
use App\Http\Controllers\AdminController; 
$listausuarios=new AdminController();
if(isset($_REQUEST['xcod']))
{$cod =$_REQUEST['xcod'];
$password = $_REQUEST['xnuevaclave'];
$listausuario=$listausuarios->cambiarclavealumno($cod ,$password);
echo "CLAVE EDITADA";
echo $password; 
}

@endphp