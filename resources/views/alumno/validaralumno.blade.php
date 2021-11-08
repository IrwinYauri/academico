@php
use App\Http\Controllers\AlumnoController; 
   
$docentex=new AlumnoController();
//$rpt=$docentex->buscardocente('41231912');
$rpt=$docentex->buscaralumno($_REQUEST['userx']);
$user =$_REQUEST['userx'];
$password = $_REQUEST['passwordx'];
$xcodalumno="";
$alumnox="";
$xuser="";
$xpassword="";
//if()
echo $password."<br>" ;
foreach ($rpt as $data) {
$alumnox=  $data->alu_vcPaterno." ".$data->alu_vcMaterno." ".$data->alu_vcNombre;
$xuser=$data->alu_vcDocumento;
$xpassword=$data->alu_vcPassword;
$xcodalumno=$data->alu_iCodigo;
}
if(($user==$xuser) && (strtoupper(sha1($password))==$xpassword))
{  session_start();
     $_SESSION['alumnox'] = $alumnox;
     $_SESSION['codalumnox'] = $xcodalumno;
    echo "TIENE ACESSO<br>
<script>
    location.href='../alumno';
</script>
";}else {
 echo    '<script>
    //alertagrabarx("ERROR DE ACCESO","red");  
    location.href="loginalumno?error=1"; 
</script>';

}
echo strtoupper(sha1($password));
echo "<br>";
echo $xpassword;
//dd($rpt);
@endphp