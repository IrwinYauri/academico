@php
    
    session_start();
 $coddocentex="";
 if(isset($_SESSION['coddocentex'])){
  $coddocentex=$_SESSION['coddocentex'];
 }
use App\Http\Controllers\DocenteController; 
   
   $docentex=new DocenteController();

 //  $rpt=$docentex->buscardocente($coddocentex);


   $rpt=$docentex->buscardocentecod($coddocentex);

$user =$_REQUEST['xcod'];
$password = $_REQUEST['xpass'];
$xcoddocente="";
$xpassword="";
$nuevopass=$_REQUEST['nuevapass'];
//if()
echo $password."<br>" ;
echo $user."<br>" ;
foreach ($rpt as $data) {
$xpassword=$data->doc_vcPassword;
$xcoddocente=$data->doc_iCodigo;
}
if(($user==$xcoddocente) && (strtoupper(sha1($password))==$xpassword))
{ //$pas=(strtoupper(sha1($password))==$xpassword);    
   echo "TIENE ACESSO";
      echo "<script>
           cambiarpassworddocente('".$xcoddocente."','".$nuevopass."')
        </script>";
          // vermensaje();
}else {
  echo "<script>
    alertagrabarx('ERROR:CLAVE ANTIGUA NO VALIDAD','red',3000);
        </script>";
}

echo $xpassword."<br>" ;
echo $xcoddocente."<br>" ;
@endphp

