@php
    
    namespace App\Http\Controllers;

use App\Models\Docente;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //uso base datos

function registrar(
    $doc_vcDocumento,$doc_vcPaterno,$doc_vcMaterno,
    $doc_vcNombre,$doc_cActivo,
    $depaca_iCodigo,$doccat_iCodigo,
    $doccla_iCodigo,$doc_vcPassword,
    $doc_iPasswordCambiar,
    $doc_vcTelefonoFijo,
    $doc_vcTelefonoCelular,
    $doc_vcEmail1,$doc_vcEmail2,
    $condDocente,$cateDocente
)
{
 $bucar=Docente::where('doc_vcDocumento', '=', $doc_vcDocumento)->count();  
 if($bucar>0) 
 echo '<script>
        alertagrabarx("YA existe ese DNI","#ff0000","3000");
        </script>';
    else {
      
    
$sql="insert into docente(doc_vcDocumento,
doc_vcPaterno,doc_vcMaterno,doc_vcNombre,doc_cActivo,
depaca_iCodigo,doccat_iCodigo,doccla_iCodigo,
doc_vcPassword,doc_iPasswordCambiar,doc_vcTelefonoFijo,
doc_vcTelefonoCelular,doc_vcEmail1,doc_vcEmail2,condDocente,cateDocente)
values('$doc_vcDocumento','$doc_vcPaterno',
'$doc_vcMaterno','$doc_vcNombre','$doc_cActivo',
'$depaca_iCodigo','$doccat_iCodigo','$doccla_iCodigo',
'$doc_vcPassword','$doc_iPasswordCambiar','$doc_vcTelefonoFijo',
'$doc_vcTelefonoCelular',
'$doc_vcEmail1',
'$doc_vcEmail2',
'$condDocente','$cateDocente')
";
echo '<script>
        alertagrabarx("DOCENTE REGISTRADO","#301934");
        </script>';

$data1=DB::select($sql);
       return "completado";
    }
}
if(isset($_REQUEST["doc_vcDocumento"]))
{//$doc_iCodigo=$_REQUEST["doc_iCodigo"];
$doc_vcDocumento=$_REQUEST["doc_vcDocumento"];
$doc_vcPaterno=$_REQUEST["doc_vcPaterno"];
$doc_vcMaterno=$_REQUEST["doc_vcMaterno"];
$doc_vcNombre=$_REQUEST["doc_vcNombre"];
$doc_cActivo=$_REQUEST["doc_cActivo"];
$depaca_iCodigo=$_REQUEST["depaca_iCodigo"];
$doccat_iCodigo=$_REQUEST["doccat_iCodigo"];
$doccla_iCodigo=$_REQUEST["doccla_iCodigo"];

$doc_vcPassword=sha1($_REQUEST["doc_vcPassword"]);
if(isset($_REQUEST["doc_iPasswordCambiar"]) || is_null($_REQUEST["doc_iPasswordCambiar"]))
$doc_iPasswordCambiar='0';
else
$doc_iPasswordCambiar=$_REQUEST["doc_iPasswordCambiar"];

$doc_vcTelefonoFijo=$_REQUEST["doc_vcTelefonoFijo"];
$doc_vcTelefonoCelular=$_REQUEST["doc_vcTelefonoCelular"];
$doc_vcEmail1=$_REQUEST["doc_vcEmail1"];
$doc_vcEmail2=$_REQUEST["doc_vcEmail2"];
$condDocente=$_REQUEST["condDocente"];
$cateDocente=$_REQUEST["cateDocente"];

registrar($doc_vcDocumento,$doc_vcPaterno,$doc_vcMaterno,
    $doc_vcNombre,$doc_cActivo,
    $depaca_iCodigo,$doccat_iCodigo,
    $doccla_iCodigo,$doc_vcPassword,
    $doc_iPasswordCambiar,
    $doc_vcTelefonoFijo,
    $doc_vcTelefonoCelular,
    $doc_vcEmail1,$doc_vcEmail2,
    $condDocente,$cateDocente
);



}

@endphp