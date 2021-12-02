@php
$r="";
function buscardni($dni)
{$sql="SELECT
alumno.alu_vcDocumento
from alumno where
alumno.alu_vcDocumento='$dni'";
$data=DB::select($sql);
return $data;
}
function buscaradmin($codadmin)
{$sql="SELECT
alumno.cod_vcCodigo
from alumno  where
alumno.cod_vcCodigo='$codadmin' ";
$data=DB::select($sql);
return $data;
}
function registrar($alu_vcCodigo,
$alu_vcDocumento,
$alu_vcPaterno, 
$alu_vcMaterno, 
$alu_vcNombre,
$escpla_iCodigo,
$alu_vcPassword,
$alu_cSexo,
$alu_dFechaNacimiento,
$cod_vcCodigo,
$proadm_vcCodigo,
$mod_cCodigo,
$pueind_iCodigo,
$aluest_iCodigo,
$alu_vcTelefono,$alu_vcCelular,$alu_vcEmail,
$alu_vcEmail_alt,$cal_iEapMerito){
     $sql="
insert into alumno(
 alu_vcCodigo,
 alu_vcDocumento,
 alu_vcPaterno,
 alu_vcMaterno,
 alu_vcNombre,
 escpla_iCodigo,
 alu_vcPassword,
 alu_cSexo,
 alu_dFechaNacimiento,
 cod_vcCodigo,
 proadm_vcCodigo,
 mod_cCodigo,
 pueind_iCodigo,
 aluest_iCodigo,
 alu_vcTelefono,
 alu_vcCelular,
 alu_vcEmail,
 alu_vcEmail_alt,cal_iEapMerito)
 values('$alu_vcCodigo',
 '$alu_vcDocumento',
 '$alu_vcPaterno',
 '$alu_vcMaterno',
 '$alu_vcNombre',
 '$escpla_iCodigo',
 '$alu_vcPassword',
 '$alu_cSexo',
 '$alu_dFechaNacimiento',
 '$cod_vcCodigo',
 '$proadm_vcCodigo',
 '$mod_cCodigo',
 '$pueind_iCodigo',
  '$aluest_iCodigo',
 '$alu_vcTelefono',
 '$alu_vcCelular',
 '$alu_vcEmail',
 '$alu_vcEmail_alt',
 '$cal_iEapMerito')";

 $data=DB::select($sql);

 return $data;
}

if($_REQUEST["alu_vcCodigo"])
{$alu_vcCodigo=$_REQUEST["alu_vcCodigo"];
 $alu_vcDocumento=$_REQUEST["alu_vcDocumento"];
 $alu_vcPaterno=$_REQUEST["alu_vcPaterno"];
 $alu_vcMaterno=$_REQUEST["alu_vcMaterno"];
 $alu_vcNombre=$_REQUEST["alu_vcNombre"];
 $escpla_iCodigo=$_REQUEST["escpla_iCodigo"];
 $alu_vcPassword=$_REQUEST["alu_vcPassword"];
 
 $alu_vcPassword=sha1($alu_vcPassword);
 
 $alu_cSexo=$_REQUEST["alu_cSexo"];
 $alu_dFechaNacimiento=$_REQUEST["alu_dFechaNacimiento"];
 $cod_vcCodigo=$_REQUEST["cod_vcCodigo"];
 $proadm_vcCodigo=$_REQUEST["proadm_vcCodigo"];
 $mod_cCodigo=$_REQUEST["mod_cCodigo"];
 $pueind_iCodigo=$_REQUEST["pueind_iCodigo"];
 $aluest_iCodigo=1;
 $alu_vcTelefono=$_REQUEST["alu_vcTelefono"];
 $alu_vcCelular=$_REQUEST["alu_vcCelular"];
 $alu_vcEmail=$_REQUEST["alu_vcEmail"];
 $alu_vcEmail_alt=$_REQUEST["alu_vcEmail_alt"];
 $cal_iEapMerito=$_REQUEST["cal_iEapMerito"];

 $cdni=buscardni($alu_vcDocumento);
 $codvancate=buscaradmin($cod_vcCodigo);

 if(count($cdni)>0)
 {echo "<script>alert('YA EXISTE EL DNI,VERIFICAR SUS DATOS')</script>";
  return 0;}
 
 //dd($codvancate);


 if(count($codvancate)>0)
 {echo "<script>alert('YA EXISTE EL CODIGO DE VACANTE,VERIFICAR SUS DATOS')</script>";
 return 0;
}

 $r=registrar($alu_vcCodigo,
$alu_vcDocumento,
$alu_vcPaterno,
$alu_vcMaterno,
$alu_vcNombre,
$escpla_iCodigo,
$alu_vcPassword,
$alu_cSexo,
$alu_dFechaNacimiento,
$cod_vcCodigo,
$proadm_vcCodigo,
$mod_cCodigo,
$pueind_iCodigo,
$aluest_iCodigo,
$alu_vcTelefono,$alu_vcCelular,$alu_vcEmail,
$alu_vcEmail_alt,$cal_iEapMerito);

}
echo "<script>alert('ALUMNO REGISTRADO')</script>";
//dd($r);
@endphp