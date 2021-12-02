@php
  session_start();
 
 $codalumno = '';
 if (isset($_SESSION['alumnox'])) {
     $codalumno = $_SESSION['codalumnox'];
 }
 
function buscaralumnocod($codalumno)
{$sql="SELECT
alumno.alu_iCodigo,
alumno.alu_vcPassword
FROM
alumno
where alumno.alu_iCodigo='$codalumno'";
$data=DB::select($sql);
return $data;
}

@endphp
<script>
   function cambiarpasswordalumno(n1,n2)//activo
 {  $.ajax({
		url:"alumno/cambiarpasswordalumno",
	success:function(result){
	//alert(result);
	vermensaje();
	$("#micontenido11").html(result);
	 },
	data:{xcod:n1,
		xnuevaclave:n2  },
		type:"GET"   
	 } );
	
}
</script>

@php
   $rpt=buscaralumnocod($codalumno);

$user =$_REQUEST['xcod'];
$password = $_REQUEST['xpass'];
$xcodalumno="";
$xpassword="";
$nuevopass=$_REQUEST['nuevapass'];
//if()
echo $password."<br>" ;
echo $user."<br>" ;

$xpassword=$rpt[0]->alu_vcPassword;
$xcodalumno=$rpt[0]->alu_iCodigo;

if(($user==$xcodalumno) && (strtoupper(sha1($password))==$xpassword))
{ //$pas=(strtoupper(sha1($password))==$xpassword);    
   echo "TIENE ACESSO";
      echo "<script>
           cambiarpasswordalumno('".$xcodalumno."','".$nuevopass."')
        </script>";
          // vermensaje();
}else {
  echo "<script>
    alertagrabarx('ERROR:CLAVE ANTIGUA NO VALIDAD','red',3000);
        </script>";
}

echo $xpassword."<br>" ;
echo $xcodalumno."<br>" ;
@endphp
