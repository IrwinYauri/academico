@php
    
    namespace App\Http\Controllers;

use App\Models\Docente;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //uso base datos



if(isset($_REQUEST["coddocente"]))
{$doc_iCodigo=$_REQUEST["coddocente"];

    $docente=Docente::where('doc_iCodigo', '=', $doc_iCodigo)->delete();
  //  ::where('active', 0)->delete();
}
@endphp