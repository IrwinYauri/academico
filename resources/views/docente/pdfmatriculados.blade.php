<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>  //-->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/polyfills.umd.js"></script> //-->

<script src="{{ asset('jspdf/jspdf.min.js')}}"></script>

<link  rel="icon"   href=" {{ asset('img/escudo.png')}}" type="image/png" />
<link href=" {{ asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">

<link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

<!-- Custom styles for this template-->
<link href="{{ asset('css/sb-admin-2.min.css')}}" rel="stylesheet">
<link href="{{ asset('css/seleccion.css')}}" rel="stylesheet" type="text/css">
<style>
  .table-condensed{
  font-size: 10px;
  color: black;
  }
  .fletra{
    font-size: 10px;
    background-color: navy;
    color: white;
  }
</style>
<script>
  function pruebaDivAPdf() {
      var pdf = new jsPDF('p', 'pt', 'A4');
      source = $('#imprimir')[0];

      specialElementHandlers = {
          '#bypassme': function (element, renderer) {
              return true
          }
      };
      margins = {
          top: 80,
          bottom: 60,
          left: 40,
          width: 522
      };

      pdf.fromHTML(
          source, 
          margins.left, // x coord
          margins.top, { // y coord
              'width': margins.width, 
              'elementHandlers': specialElementHandlers
          },

          function (dispose) {
              pdf.save('Prueba.pdf');
          }, margins
      );
  }
</script>
<!-- <a href="javascript:pruebaDivAPdf()" class="button">Pasar a PDF</a>  //-->
<div id="imprimir">

@php
session_start();
 $coddocentex="";
 if(isset($_SESSION['coddocentex'])){
  $coddocentex=$_SESSION['coddocentex'];
  $nombredoc =$_SESSION['docentex'];
 }
else {
  return "::No logeado::";
}
 use App\Http\Controllers\DocenteController; 
 $miasistencia=new DocenteController();  
// $miscursos=$miasistencia->vercursos(20212,$coddocentex);
$miscursos=$miasistencia->vercursos(semestreactual(),$coddocentex);
function veralumnomatriculados($codcur,$semestre)
 {$miasistencia1=new DocenteController(); 

   echo "<table class='table table-striped  table-responsive-md text-dark-400 table-condensed'>
      <thead> <tr style='background-color:black;color:white;'>
    <td>Nro</td> <td>Codigo</td> <td>Nombre</td><td>Email</td>
    </thead>
  </tr>";
   $misalumnos1=$miasistencia1->vercursosalumnos(trim($codcur),$semestre);
//dd($codcur);
$nro=0;
    foreach ($misalumnos1 as $alumno) {
      $nro++;
      $cod=$alumno->alu_vcCodigo;
      $estudiante=$alumno->alumno;
      $email=$alumno->alu_vcEmail;
     // if($nro % 2 ==0)
    //  $color="background-color:black;color:white;";
      $color="";
   //   else 
    //  $color="background-color:white";
     echo "<tbody>
     <tr style=' $color'>
          <td>$nro</td>
          <td>$cod</td>
         <td>$estudiante</td>
         <td>$email</td>
        </tr>";
    }
echo "</tbody></table>";

}  


function nombreescuela($cod)
{//use App\Http\Controllers\DocenteController;
  $r="";
  $doc=new DocenteController();
  $r=$doc->nescuela($cod);
  return $r;
}

//dd($miscursos);

@endphp



  <title>Cursos Matriculados - {{semestreactual()}}</title>
  <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
   /* table {
      border-collapse: collapse;
      border-spacing: 0;
      width: 100%;
      border: 1px solid #ddd;
    }
    
    th, td {
      text-align: left;
      padding: 16px;
    }
    
    tr:nth-child(even) {
      background-color: #f2f2f2;
    } */
    </style> 
</head>

@php
//agrupando filtrando evitar duplicados
$milista = array();
$milistadata = array();
$micc=0;
foreach ( $miscursos as $value ) {


$t=count($milista);

$b=0;
if($t>0)
 { for($x=0;$x<$t;$x++)
  {if(trim($milista[$x])==trim($value->cur_vcCodigo))
  $b=1;
// echo '<br>'.$milista[$x];
 //echo  '--'.$value->cur_vcCodigo;
  }
}
  if($b==0)
 { $milista[]=$value->cur_vcCodigo; 
   $milistadata[]=["cur_vcCodigo"=>$value->cur_vcCodigo,
                   "cur_vcNombre"=>$value->cur_vcNombre,
                   "sec_iNumero"=>$value->sec_iNumero,
                   "escpla_vcCodigo"=>$value->escpla_vcCodigo,
                   "escuela"=>left($value->cur_vcCodigo,2),
                   "cur_iCodigo"=>$value->cur_iCodigo                   
                  ];
 }
  
//echo "xxx--".$milista[$t]."<br><br>";
}
//dd($miscursos); //antiguo
//dd($milistadata);
//FIN agrupando filtrando evitar duplicados
@endphp


<body>
    







@php
   /* 

  foreach($milistadata as $listacur)
   {
echo "<table border=1 >
  <tr style='background-color:navy;color:white;'>
    <td>codcurso</td>
    <td>cursos</td>
    <td>seccion</td>
    <td>plan</td>
    <td>escuela</td>
   
    <td>Alumnos </td>
    
  </tr>
      ";
  echo '<tr>
      
    <td>'.$listacur["cur_vcCodigo"].'</td>
    <td>'.$listacur["cur_vcNombre"].'</td>
    <td>'. $listacur["sec_iNumero"].'</td>
    <td>'.$listacur["escpla_vcCodigo"].'</td>
    <td>'.left($listacur["cur_vcCodigo"],2).'</td>
    <td >0</td>
   
  </tr>
</table>
<br>
  ';
//  veralumnomatriculados(2,semestreactual());
 
}
*/
//$codx=new array();


foreach($milistadata as $listacur)
   {$codx[]=$listacur["cur_iCodigo"];
   $codx1[]=$listacur["cur_vcCodigo"];
   $cursox[]=$listacur["cur_vcNombre"];
   $escuela[]=nombreescuela($listacur["escuela"]);
   }
  @endphp

 
@php

//--$nombreImagen = asset('escudo1.jpg');
//--$imagenBase64 = "data:image/png;base64," . base64_encode(file_get_contents($nombreImagen));
//$t=count($codx);
//--echo "<img src='".$imagenBase64."'  width='50' height='68' />";

echo "<table class='table table-striped  table-responsive-md  text-dark-400 table-condensed'>";
echo "<tbody>
      <tr >
        <td>DOCENTE</td>
        <td >".$nombredoc."</td> </tr>";
echo "<tr>
  <td >CURSOS ASIGNADOS:</td>
  <td >".count($codx)."</td></tr>";
//veralumnomatriculados($listacur["cur_iCodigo"],semestreactual());
echo "</tbody></table>";
$semx=semestreactual();
for($x=0;$x<$t;$x++)
{$cod1=$codx[$x];
  $codn=$codx1[$x];
  $curso1=$cursox[$x];
  $escuelax=$escuela[$x];
  echo "<table class='table table-striped  table-responsive-md  text-dark-400 table-condensed'>
       <tr><td class='fletra'>CODIGO</td><td>".$codn."</td></tr>";
  echo "<tr><td class='fletra'>CURSO</td><td>".$curso1."</td></tr>";
  echo "<tr><td class='fletra'>ESCUELA</td><td>".$escuelax."</td></tr>
      </table>";
  veralumnomatriculados($cod1,$semx);
 // echo $cod1;
} 
//veralumnomatriculados(2,$semx); 
//veralumnomatriculados($cod1,$semx); 
@endphp

</body>
</div>
<script src="{{ asset('vendor/jquery/jquery.min.js')}}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('js/sb-admin-2.min.js')}}"></script>
<script>
pruebaDivAPdf()
</script>