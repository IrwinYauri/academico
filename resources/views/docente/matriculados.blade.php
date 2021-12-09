@php
session_start();
 $coddocentex="";
 if(isset($_SESSION['coddocentex'])){
  $coddocentex=$_SESSION['coddocentex'];
 }

 
  
 $semestreactual=semestreactual();


 function  vercursos($semestre,$coddocente)
   { 
       $sql="SELECT DISTINCT
	seccion_horario.doc_iCodigo,
	seccion.cur_iCodigo,
	docente.doc_vcPaterno,
	docente.doc_vcMaterno,
	docente.doc_vcNombre,
	seccion.sem_iCodigo,
	curso.cur_vcNombre,
	curso.cur_iSemestre,
	curso.cur_iCodigo,
	curso.cur_vcCodigo,
	seccion.sec_iNumero,
	curso.escpla_iCodigo,
	escuelaplan.escpla_vcCodigo,
	seccion.sec_iCodigo
FROM
	seccion_horario
INNER JOIN docente ON (
	seccion_horario.doc_iCodigo = docente.doc_iCodigo
)
INNER JOIN seccion ON (
	seccion_horario.sec_iCodigo = seccion.sec_iCodigo
)
INNER JOIN curso ON (
	seccion.cur_iCodigo = curso.cur_iCodigo
)
INNER JOIN escuelaplan ON (
	curso.escpla_iCodigo = escuelaplan.escpla_iCodigo
)
WHERE
	`seccion`.`sem_iCodigo` = '$semestre'
AND `seccion_horario`.`doc_iCodigo` = '$coddocente'
ORDER BY
	curso.cur_vcCodigo,
	curso.cur_iCodigo
  ";
   $data1=DB::select($sql);
  return $data1;
  }
//$miscursos=$miasistencia->vercursos(semestreactual(),$coddocentex);
function  vercursosalumnos($codcurso,$semestre)
  { 
      $sql='SELECT 
      concat(alumno.alu_vcPaterno," ",
      alumno.alu_vcMaterno," ",
      alumno.alu_vcNombre) as alumno,
      curso.cur_vcNombre,
      curso.cur_vcCodigo,
      curso.cur_iCodigo,
      seccion.sem_iCodigo,
      seccion.sec_iCodigo,
      matriculadetalle.mat_iCodigo,
      matriculadetalle.matdet_iCodigo,
      matricula.alu_iCodigo,
      matricula.sem_iCodigo,
  alumno.alu_vcEmail,
   alumno.alu_vcCodigo
    FROM
      alumno
      INNER JOIN matricula ON (alumno.alu_iCodigo = matricula.alu_iCodigo)
      INNER JOIN matriculadetalle ON (matricula.mat_iCodigo = matriculadetalle.mat_iCodigo)
      INNER JOIN seccion ON (seccion.sec_iCodigo = matriculadetalle.sec_iCodigo)
      INNER JOIN curso ON (curso.cur_iCodigo = seccion.cur_iCodigo)
    WHERE
      curso.cur_iCodigo = "'.$codcurso.'" AND 
      seccion.sem_iCodigo = "'.$semestre.'"
      order by alumno.alu_vcPaterno';
  $data1=DB::select($sql);
 return $data1;
 }
function veralumnomatriculados($codcur,$semestre,$fila)
 {//$miasistencia=new DocenteController(); 

   echo "<table class='table table-striped'>
       <tr style='background-color:black;color:white;'>
    <td>Nro</td> <td>Codigo</td> <td>Nombre</td><td>Email</td>
  </tr>";
   //$misalumnos=$miasistencia->vercursosalumnos(trim($codcur),$semestre);
  
   $misalumnos=vercursosalumnos(trim($codcur),$semestre);
//dd($codcur);
$nro=0;
    foreach ($misalumnos as $alumno) {
      $nro++;
      $cod=$alumno->alu_vcCodigo;
      $estudiante=$alumno->alumno;
      $email=$alumno->alu_vcEmail;
     echo "<tr style='color:black'>
          <td>$nro</td>
          <td>$cod</td>
         <td>$estudiante</td>
         <td>$email</td>
        </tr>";
    }
echo "</table>";
echo "
<script>
  document.getElementById('nlista$fila').innerHTML = '$nro';
</script>";

}  
 //$miscursos=$miasistencia->vercursos($semestreactual,$coddocentex);
 $miscursos=vercursos($semestreactual,$coddocentex);
//dd($miscursos);

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




<div class="card shadow mb-4">
  <div class="card-header py-3">
  <h6 class="m-0 font-weight-bold text-primary">
  <i class="fa fa-id-card fa-2x" ></i> Lista de Alumnos Matriculados
  <a href="docente/pdfmatriculados" class="btn btn-info"> IMPRIMIR LISTA</a>
  </h6>
</div>
<div class="card-body" style='overflow: scroll;'>
<table border=1 frame=hsides rules=rows >
  <tr style='background-color:navy;color:white;'><td>codcurso</td><td>cursos</td><td>seccion</td><td>plan</td><td>escuela</td>
    <td>OP </td>
    <td>Alumnos </td>
    
  </tr>

  @php
      $nn=0;
  //    dd($miscursos);
  //$milistadata
  //foreach($miscursos as $listacur)
  @endphp
  @foreach($milistadata as $listacur)
  @php
  $nn++;
@endphp
    <tr>
      <td><button type="button"  class="btn btn-secondary" href="#"
        onclick="mostrarobjeto('tn{{$nn}}')">ver 
     </button> </td>
    <td>{{ $listacur["cur_vcCodigo"] }}</td>
    <td>{{ $listacur["cur_vcNombre"] }}</td>
    <td>{{ $listacur["sec_iNumero"] }}</td>
    <td>{{ $listacur["escpla_vcCodigo"] }}</td>
    <td>{{ left($listacur["cur_vcCodigo"],2) }}</td>
    <td id="nlista{{$nn}}">0</td>
   
  </tr>
  <tr style="display:none" id="tn{{$nn}}">
    <td colspan="6"> 
      @php
         veralumnomatriculados($listacur["cur_iCodigo"],semestreactual(),$nn);
      @endphp
    </td>
   </tr>
  @endforeach
  
</table>
</div>
</div>

<div style="display:none">
  {{dd($miscursos)}}
  </div>