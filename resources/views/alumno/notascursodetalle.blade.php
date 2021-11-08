
<?php 
$n1=1;
if(isset($_REQUEST["n1"]))
{$n1=$_REQUEST["n1"];
  if($n1*1==0)
  $n1=1;
}
?>
<head>
  <title>Cursos Matriculados</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
</head>
@php

 function versilabuformula($data,$nro,$codcurso)
{
  $r1="0";
   foreach ($data as $object) {
       {  if($nro == 1 && $object->cur_vcCodigo == $codcurso)
          $r1= $object->tipoPU1.":".$object->formulaPU1;           
          if($nro == 2 && $object->cur_vcCodigo == $codcurso)
          $r1=$object->tipoPU2.":".$object->formulaPU2; 
          if($nro == 3 && $object->cur_vcCodigo == $codcurso)
          $r1=$object->tipoPU3.":".$object->formulaPU3; 
          if($nro == 4 && $object->cur_vcCodigo == $codcurso)
          $r1=$object->tipoPU4.":".$object->formulaPU4; 
          if($nro == 5 && $object->cur_vcCodigo == $codcurso)
          $r1=$object->tipoPU5.":".$object->formulaPU5; 
       }
    }
    return $r1;
}
function versilabunroeval($data,$nro,$codcurso)
{
  $r1="0";
   foreach ($data as $object) {
       {  if($nro == 1 && $object->cur_vcCodigo == $codcurso)
          $r1= $object->nro_evalPU1;           
          if($nro == 2 && $object->cur_vcCodigo == $codcurso)
          $r1= $object->nro_evalPU2; 
          if($nro == 3 && $object->cur_vcCodigo == $codcurso)
          $r1= $object->nro_evalPU3; 
          if($nro == 4 && $object->cur_vcCodigo == $codcurso)
          $r1= $object->nro_evalPU4; 
          if($nro == 5 && $object->cur_vcCodigo == $codcurso)
          $r1= $object->nro_evalPU5; 
       }
    }
    return $r1;
}
$codcurso='AN.EG.17.101';
if(isset($_REQUEST["codcurso"]))
$codcurso=$_REQUEST["codcurso"];
//echo $codcurso;

//echo 'rpt:'.versilabunroeval($misilabus,1,$codcurso);
@endphp


<div class="card shadow mb-4">
  <div class="card-header py-3">
  <h6 class="m-0 font-weight-bold text-primary">
  <i class="fa fa-id-card fa-2x" ></i>
  @foreach($misnotas as $nota)
  <table>
  <tr><td>  CURSO:</td><td> {{ $nota->cur_vcNombre }}</td></tr>
  <tr><td>ALUMNO:</td><td> {{ $nota->alumno }}</td></tr>
</table>
            @endforeach
  </h6>
</div>
<div class="card-body">

  <table class='table table-striped table-hover table-responsive-md' width='80%'>
<thead >
<tr style='background-color:navy;color:white;'>

  <td>NRO UNIDAD</td>
  <td>EV1</td>
  <td>EV2</td>
  <td>EV3</td>
  <td>EV4</td>
  <td>PM</td>
  <td>Formula</td>
  <td>NroEValu</td>
   </tr>
</thead>
<tbody>
@foreach($misnotas as $nota)
          <tr>
            <td>I</td>
            <td>{{ $nota->CE11 }}</td>
            <td>{{ $nota->CE12 }}</td>                 
            <td>{{ $nota->CE13 }}</td>
            <td>{{ $nota->CE14 }}</td>
            <td>PM</td>
            <td>
              {{ versilabuformula($misilabus,1,$codcurso) }}
            </td>
            <td>
              {{ versilabunroeval($misilabus,1,$codcurso) }}
            </td>
        </tr>
 @endforeach
  @if($n1>2)
  @foreach($misnotas as $nota)
          <tr>
            <td>II</td>
            <td>{{ $nota->CE21 }}</td>
            <td>{{ $nota->CE22 }}</td>                 
            <td>{{ $nota->CE23 }}</td>
            <td>{{ $nota->CE24 }}</td>
            <td>PM</td>
            <td>
              {{ versilabuformula($misilabus,2,$codcurso) }}
            </td>
            <td>
              {{ versilabunroeval($misilabus,2,$codcurso) }}

            </td>
        </tr>
 @endforeach
 @endif
 @if($n1>3)
 @foreach($misnotas as $nota)
          <tr>
            <td>III</td>
            <td>{{ $nota->CE31 }}</td>
            <td>{{ $nota->CE32 }}</td>                 
            <td>{{ $nota->CE33 }}</td>
            <td>{{ $nota->CE34 }}</td>
            <td>PM</td>
            <td>
              {{ versilabuformula($misilabus,3,$codcurso) }}
            </td>
            <td>{{ versilabunroeval($misilabus,3,$codcurso) }}

            </td>
        </tr>
 @endforeach
 @endif
 @if($n1>3)
 @foreach($misnotas as $nota)
          <tr>
            <td>IV</td>
            <td>{{ $nota->CE41 }}</td>
            <td>{{ $nota->CE42 }}</td>                 
            <td>{{ $nota->CE43 }}</td>
            <td>{{ $nota->CE44 }}</td>
            <td>PM</td> 
            <td>
              {{ versilabuformula($misilabus,4,$codcurso) }}
            </td>
            <td>
              {{ versilabunroeval($misilabus,4,$codcurso) }}

            </td>
        </tr>
 @endforeach
 @endif
 @if($n1>4)
 @foreach($misnotas as $nota)
          <tr>
            <td>V</td>
            <td>{{ $nota->CE51 }}</td>
            <td>{{ $nota->CE52 }}</td>                 
            <td>{{ $nota->CE53 }}</td>
            <td>{{ $nota->CE54 }}</td>
            <td>PM</td>  
            <td>
              {{ versilabuformula($misilabus,5,$codcurso) }}
            </td>
            <td>
              {{ versilabunroeval($misilabus,5,$codcurso) }}  
            </td> 
        </tr>
 @endforeach
 @endif
</tbody>
</table>
</div>
</div>