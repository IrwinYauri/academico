@php
  use App\Http\Controllers\SilabusemestreController;   

function versilabuscriterio($sem,$codcurso)
{
  $silabos=new SilabusemestreController();
  $rptsilabo=$silabos->buscarcriteriosilabo($sem,$codcurso);
 // dd($rptsilabo);
  foreach ($rptsilabo as $versilaboc) {
    //$versilaboc->
   $cantunidad=$versilaboc->unidades;
   $tipocalculo= $versilaboc->tipoPF;
  }
 echo " <script>
    document.getElementById('nrounidad').innerHTML= '$cantunidad';
    document.getElementById('pesopromediodet').innerHTML='$tipocalculo';
</script>";
dd($rptsilabo);
}
@endphp
unidades
<div id="nrounidad"></div>
<div id="pesopromediodet"></div>

@php
   versilabuscriterio(semestreactual(),62) ;
@endphp

