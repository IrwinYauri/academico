@php
    
    namespace App\Http\Controllers;

use App\Models\Docente;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //uso base datos



if(isset($_REQUEST["doc_iCodigo"]))
{$doc_iCodigo=$_REQUEST["doc_iCodigo"];

    $docente=Docente::where('doc_iCodigo', '=', $doc_iCodigo)->get();

  foreach ($docente as $campo) {
    $doc_vcDocumento= $campo->doc_vcDocumento;
    $doc_vcPaterno=$campo->doc_vcPaterno;
$doc_vcMaterno=$campo->doc_vcMaterno;
$doc_vcNombre=$campo->doc_vcNombre;
$doc_cActivo=$campo->doc_cActivo;
$depaca_iCodigo=$campo->depaca_iCodigo;
$doccat_iCodigo=$campo->doccat_iCodigo;
$doccla_iCodigo=$campo->doccla_iCodigo;

$doc_vcPassword=$campo->doc_vcPassword;

$doc_iPasswordCambiar=$campo->doc_iPasswordCambiar;

$doc_vcTelefonoFijo=$campo->doc_vcTelefonoFijo;
$doc_vcTelefonoCelular=$campo->doc_vcTelefonoCelular;
$doc_vcEmail1=$campo->doc_vcEmail1;
$doc_vcEmail2=$campo->doc_vcEmail2;
$condDocente=$campo->condDocente;
$cateDocente=$campo->cateDocente;
   }
    echo $doc_vcDocumento;



echo "<script>
document.getElementById('doc_iCodigo1').value='$doc_iCodigo'
    document.getElementById('doc_vcDocumento1').value='$doc_vcDocumento'
    document.getElementById('doc_vcPaterno1').value='$doc_vcPaterno'
    document.getElementById('doc_vcMaterno1').value='$doc_vcMaterno'
    document.getElementById('doc_vcNombre1').value='$doc_vcNombre'
    document.getElementById('depaca_iCodigo1').value='$depaca_iCodigo'
    document.getElementById('depaca_iCodigo1').value='$depaca_iCodigo'
    document.getElementById('doccla_iCodigo1').value='$doccla_iCodigo'
    document.getElementById('doccla_iCodigo1').value='$doccla_iCodigo'
    document.getElementById('doc_vcPassword1').value='$doc_vcPassword'
    document.getElementById('doc_vcTelefonoFijo1').value='$doc_vcTelefonoFijo'
    document.getElementById('doc_vcTelefonoCelular1').value='$doc_vcTelefonoCelular'
    document.getElementById('doc_vcEmail11').value='$doc_vcEmail1'
    document.getElementById('doc_vcEmail21').value='$doc_vcEmail2'
    document.getElementById('condDocente1').value='$condDocente'
    document.getElementById('cateDocente1').value='$cateDocente'
</script> "; 

}
@endphp