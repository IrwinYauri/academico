@php
use App\Http\Controllers\AdminController; 
use App\Http\Controllers\DocenteController; 
$listadocente=new AdminController();
$semestre=0;
if(isset($_REQUEST["semestre"]))
$semestre=$_REQUEST["semestre"];

$listadocentes=$listadocente->listadocentesemestre(semestreactual());
//dd($listadocentes);


//inicio funcion
function vermiscursos($semestre,$coddocente)
     {
        $miasistencia=new DocenteController();  
        $miscursosgrupo=$miasistencia->vercursosagrupado($semestre,$coddocente);

 echo '
 
  <table>
      ';



$nn=0;
//    dd($miscursos);
//$milistadata
//foreach($miscursos as $listacur)

    foreach($miscursosgrupo as $listacur)
    {
        $nn++;
    
      echo '  <tr>
        <td><button type="button"  class="btn btn-primary" href="#"
        onclick="mostrarobjeto(\''.$nn.'\')">Configurar Fechas 
        </button> 
        '.$listacur["cur_vcCodigo"].'::
        '.$listacur["cur_vcNombre"].' ::
        '.$listacur["sec_iNumero"].'</td>
        <td>'. $listacur["escpla_vcCodigo"].'
            '.left($listacur["cur_vcCodigo"],2).'</td>
       
        </tr>
        <tr style="display:none" id="tn'.$nn.'">
        <td colspan="6"> ';
        
        // veralumnomatriculados($listacur["cur_iCodigo"],semestreactual(),$nn);
        // vercursonotas($coddocentex,semestreactual(),$listacur["cur_iCodigo"],$nn,$listacur["cur_vcNombre"],left($listacur["cur_vcCodigo"],2));
        
        echo '</td>
           </tr>';
    }
        echo "
        </table>
        ";
    }
//fin funcion
@endphp


<h3>Lista de docentes del semestre actual</h3>
<table id="tabla-docentesemestre" class="table  table-condensed">
<thead>
    <td>nro</td>
    <td>DNI</td>
    <td>PATERNO</td>
    <td>MATERNO</td>
    <td>NOMBRE</td>
 </thead>
<tbody>
    @php
        $n=1;
    @endphp
 
@foreach ($listadocentes as $salon)

<tr>
    <td>{{ $n++ }}</td>
    <td>{{ $salon->doc_vcDocumento }}</td>
    <td>{{ $salon->doc_vcPaterno }}</td>
    <td>{{$salon->doc_vcMaterno}}</td>
    <td>{{$salon->doc_vcNombre}}</td>
  
   </tr>
   <tr >
<td colspan="5">

    {{vermiscursos(semestreactual(),$salon->doc_iCodigo);}} 
</td>
   </tr>
@endforeach  
</tbody>
</table>

<script>
    $(document).ready(function() {
   
   $('#tabla-docentesemestre').DataTable();
} );
 
  
</script>


//-----
@php
session_start();
 $coddocentex="";
 if(isset($_SESSION['coddocentex'])){
  $coddocentex=$_SESSION['coddocentex'];
 }

 

 
 $notas=new DocenteController();  
  $vernotas=$notas->verregistronotas($coddocentex,semestreactual(),2);

  $miasistencia=new DocenteController();  
// $miscursos=$miasistencia->vercursos(20212,$coddocentex);
$miscursos=$miasistencia->vercursos(semestreactual(),$coddocentex);

//dd($miscursosgrupo);

 @endphp
 <style>
    .table-condensed{
  font-size: 10px;
  color: black;
  }
 
  
  </style>
  @php
    use App\Http\Controllers\SilabusemestreController;   

  @endphp
       @include('docente.formulasnotas')
  @php
     // vercursonotas($coddocentex,semestreactual(),2)

        //dd($vernotas); 
  //   vercursonotas($coddocentex,semestreactual(),2);
            @endphp


<script>
    function mostrarobjeto(id)
    {if(document.getElementById(id).style.display == "block")
    document.getElementById(id).style.display = "none";
    else
      document.getElementById(id).style.display = "block";
     }
  </script>
 

 @php
     

vermiscursos(semestreactual(),51);
@endphp
       

