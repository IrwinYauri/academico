<script src="{{ asset('vendor/jquery/jquery.min.js')}}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('js/sb-admin-2.min.js')}}"></script>
<div id="mimensajex">GRABANDO</div>
@php
use App\Http\Controllers\AdminController; 
   
$adminx=new AdminController();
//$rpt=$docentex->buscardocente('41231912');

$rpt=$adminx->verusuario($_REQUEST['userx']);
$user =$_REQUEST['userx'];
$password = $_REQUEST['passwordx'];
$xcodalumno="";
$adminxx="";
$xuser="";
$xpassword="";
//if()
//echo $password."<br>" ;
foreach ($rpt as $data) {
$adminxx=  $data->usr_vcNombre." ".$data->usu_vcApellido;
$xuser=$data->usu_vcUsuario;
$xpassword=$data->usu_vcPassword;
$xcodadmin=$data->usu_iCodigo;
}
//if(($user==$xuser) && (strtoupper(sha1($password))==$xpassword))
//if(($user==$xuser) && ($password==$xpassword))
if((strtoupper($user)==strtoupper($xuser)) && (strtoupper(sha1($password))==strtoupper($xpassword)))
{  session_start();
     $_SESSION['adminx'] = $adminxx;
     $_SESSION['codadminx'] = $xuser;
    echo "TIENE ACESSO<br>
<script>
    location.href='../admin';
</script>
";}
else {
 echo    '<script>
    //alertagrabarx("ERROR DE ACCESO","red");  
    location.href="loginadmin?error=1"; 
</script>';

}
echo "<br>".$user;
echo "<br>".$xuser;
echo strtoupper(sha1($password));
//echo $password;
echo "<br>";
//echo $xpassword;
//dd($rpt);
@endphp