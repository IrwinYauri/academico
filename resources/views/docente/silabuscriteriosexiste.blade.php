@php
  use App\Http\Controllers\SilabusemestreController;   
$sem="";
$codcurso="";
if(isset($_GET["sem"]))
{$sem=$_GET["sem"];  }
if(isset($_GET["codcurso"]))
{$codcurso=$_GET["codcurso"]; }


function versilabuscriterio($sem,$codcurso)
{
  $silabos=new SilabusemestreController();
  $rptsilabo=$silabos->buscarcriteriosilabo($sem,$codcurso);
  $cantunidad="";
 // dd($rptsilabo);
  foreach ($rptsilabo as $versilaboc) {
    //$versilaboc->
   $cantunidad=$versilaboc->unidades;
 }
return $cantunidad; //finalizar busqueda
dd($rptsilabo);
}
@endphp


@php
echo   versilabuscriterio($sem,$codcurso) ;
@endphp