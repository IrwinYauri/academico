@php
use App\Http\Controllers\DocenteController; 
   
$docentex=new DocenteController();
//$rpt=$docentex->buscardocente('41231912');
$rpt=$docentex->buscardocente($_REQUEST['userx']);
$user =$_REQUEST['userx'];
$password = $_REQUEST['passwordx'];
$xcoddocente="";
$docentex="";
$xuser="";
$xpassword="";
//if()
echo $password."<br>" ;
foreach ($rpt as $data) {
$docentex=  $data->doc_vcPaterno." ".$data->doc_vcMaterno." ".$data->doc_vcNombre;
$xuser=$data->doc_vcDocumento;
$xpassword=$data->doc_vcPassword;
$xcoddocente=$data->doc_iCodigo;
}
if(($user==$xuser) && (strtoupper(sha1($password))==$xpassword))
{  session_start();
     $_SESSION['docentex'] = $docentex;
     $_SESSION['coddocentex'] = $xcoddocente;
  echo "TIENE ACESSO<br>
<script>
    location.href='../docente';
</script>  
   ";
}else {
 echo    '<script>
    //alertagrabarx("ERROR DE ACCESO","red");  
    location.href="logindocente?error=1"; 
</script>';
}
echo strtoupper(sha1($password));
echo "<br>";
echo $xpassword;
//dd($rpt);
@endphp