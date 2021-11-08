@php
session_start();
 $coddocentex="";
 if(isset($_SESSION['coddocentex'])){
  $coddocentex=$_SESSION['coddocentex'];
 }

 

 use App\Http\Controllers\DocenteController; 
 $notas=new DocenteController();  
  $vernotas=$notas->verregistronotas($coddocentex,semestreactual(),2);

  $miasistencia=new DocenteController();  
// $miscursos=$miasistencia->vercursos(20212,$coddocentex);
$miscursos=$miasistencia->vercursos(semestreactual(),$coddocentex);
$miscursosgrupo=$miasistencia->vercursosagrupado(semestreactual(),$coddocentex);
//dd($miscursosgrupo);

 @endphp
 <style>
    .table-condensed{
  font-size: 11px;
  color: black;
  }
  
  </style>
   <link  rel="icon"   href=" {{ asset('img/escudo.png')}}" type="image/png" />
   <link href=" {{ asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
  
   <link
       href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
       rel="stylesheet">

   <!-- Custom styles for this template-->
   <link href="{{ asset('css/sb-admin-2.min.css')}}" rel="stylesheet">
   <link href="{{ asset('css/seleccion.css')}}" rel="stylesheet" type="text/css">
  @php
    use App\Http\Controllers\SilabusemestreController;   

    function versilabuscriterio($sem,$codcurso,$unidad)
    {
        $silabos=new SilabusemestreController();
        $rptsilabo=$silabos->buscarcriteriosilabo($sem,$codcurso);
        $tx=count($rptsilabo); 
      //  dd($rptsilabo);
        // if($tx>0)
        $u1="";
        $u2="";
        $u3="";
        $u4="";
        $u5="";
         foreach ($rptsilabo as $versilaboc) {
       
            $u1=$versilaboc->tipoPU1;
              $u2=$versilaboc->tipoPU2;
               $u3=$versilaboc->tipoPU3;
                $u4=$versilaboc->tipoPU4;
                $u5=$versilaboc->tipoPU5;
      
             }
          
        if($unidad==1)
          { return $u1;}
        if($unidad==2)
          { return $u2;}
        if($unidad==3)
          { return $u3;}
        if($unidad==4)
          { return $u4;}
        if($unidad==5)
          { return $u5;}
        
    }
  @endphp
      
@php
    function vercursonotas($coddocentex,$sem,$codcurso,$nro,$curso,$escuela)
{ $notas=new DocenteController();  
   $vernotas=$notas->verregistronotas($coddocentex,$sem,$codcurso,$curso);
   $n=0;
      foreach ($vernotas as $nota)
           { $n++;
                  }
                       
           echo "
             <script>
              document.getElementById('nlista$nro').innerHTML = '$n ';
            </script>";
     } 
@endphp


<script>
    function mostrarobjeto(id)
    {if(document.getElementById(id).style.display == "block")
    document.getElementById(id).style.display = "none";
    else
      document.getElementById(id).style.display = "block";
     }
  </script>
  <head>
    <title>Cursos Matriculados</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
  </head>
  <h5 style="color:rgb(4, 99, 11)"> <i class="fas fa-file-excel"> </i> REPORTES DE ASISTENCIA - EXCEL</h5>
  <table class="table table-striped table-bordered table-sm  table-condensed">
<tr style="background-color: navy;color:white" >
<td>CODIGO</td>
<td>CURSO</td>
<td>SECCCION</td>
<td>PLAN ES</td>
<td>ALUMNO</td>
    </tr>


@php
$nn=0;
//    dd($miscursos);
//$milistadata
//foreach($miscursos as $listacur)
@endphp
@foreach($miscursosgrupo as $listacur)
@php
$nn++;
@endphp
<tr class="table-condensed">
<td> 
{{ $listacur["cur_vcCodigo"] }} </td><td>
{{ $listacur["cur_vcNombre"] }} </td><td>
{{ $listacur["sec_iNumero"] }}</td>
<td>{{ $listacur["escpla_vcCodigo"] }}
{{ left($listacur["cur_vcCodigo"],2) }}</td>
<td id="nlista{{$nn}}">0</td>
<td><a   class="btn btn-secondary" href="asistencia/asistenciacursoxls?xcod=2"
 style="background-color: green;color:white" target="_blank">
    <i class="fas fa-file-excel"> </i> EXCEL 
       
    </a></td>
</tr>
<tr style="display:none" id="tn{{$nn}}">
<td colspan="6"> 
@php
  // veralumnomatriculados($listacur["cur_iCodigo"],semestreactual(),$nn);
  vercursonotas($coddocentex,semestreactual(),$listacur["cur_iCodigo"],$nn,$listacur["cur_vcNombre"],left($listacur["cur_vcCodigo"],2));
    
@endphp
</td>
</tr>
@endforeach

</table>
</div>
</div>
<div id="mimensajex">GRABANDO</div>

<script>
    function grabarnotas(idnota,idcurso,idalumno)
    {//alert(id.value);
        if(idnota.value>=0 && idnota.value<=20)
        {men="GRABANDO:"+idnota.value.toString()+"";
        alertagrabarx(men,"#301934");
       //editarnotasjs(semestre,codcurso,codalumno,nota)
       editarnotasjs(20212,idcurso,idalumno,idnota.value);
    }
        else
        {men="Error solo notas entre 0 a 20";
        alertagrabarx(men,"red");
        id.value="";
        }

    }
  //  alertagrabarx("COMPLETANDO","blue")
  
</script>
<script src="{{ asset('vendor/jquery/jquery.min.js')}}"></script>
<script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>
<script src="{{ asset('js/panelnotas.js')}}"></script>

<script>
  activarwow()
</script>