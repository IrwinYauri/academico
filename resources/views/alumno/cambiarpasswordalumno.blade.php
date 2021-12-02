@php
use App\Http\Controllers\AdminController; 
$listausuarios=new AdminController();
if(isset($_REQUEST['xcod']))
{$cod =$_REQUEST['xcod'];
$password = $_REQUEST['xnuevaclave'];
$listausuario=$listausuarios->cambiarclavealumno($cod ,$password);
echo "CLAVE EDITADA";
echo $password; 
echo "
<script>
    document.getElementById('n2').value='';
    document.getElementById('n3').value='';
</script>";
}

@endphp