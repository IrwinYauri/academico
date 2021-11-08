
<head>
  <title>Horarios</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
</head>

<link rel="stylesheet" href="css/font-awesome.css">
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/bootstrap-theme.css">

<div class="card shadow mb-4">
  <div class="card-header py-3">
  <h6 class="m-0 font-weight-bold text-primary">
  <i class="fa fa-search" ></i>HORARIO - TURNO MAÑANA
  </h6>
</div>
<div class="card-body">

  <table class='table table-striped table-hover table-responsive-md' width='80%'>
<thead >
<tr style='background-color:navy;color:white;'>
<th>hora</th><th>LUNES</th><th>MARTES</th><th>MIERCOLES</th><th>JUEVES</th><th>VIERNES</th></tr>
</thead>
<tbody>
  <tr>
  <td>08:00</td>
  <td>Curso1</td>
  <td>Curso2</td>
  <td>Curso3</td>
  <td>Curso4</td>
  <td>Curso5</td>
  </tr>
  <tr>
  <td>09:00</td>
  <td>Curso11</td>
  <td>Curso22</td>
  <td>Curso33</td>
  <td>Curso44</td>
  <td>Curso55</td>
  </tr>
  <tr>
  <td>10:00</td>
  <td>Curso11</td>
  <td>Curso22</td>
  <td>Curso33</td>
  <td>Curso44</td>
  <td>Curso55</td>
  </tr>
  <tr>
  <td>11:00</td>
  <td>Curso11</td>
  <td>Curso22</td>
  <td>Curso33</td>
  <td>Curso44</td>
  <td>Curso55</td>
  </tr>
</tbody>
</table>
</div>
</div>


<div class="card shadow mb-4">
  <div class="card-header py-3">
  <h6 class="m-0 font-weight-bold text-primary">
  <i class="fa fa-search" ></i>HORARIO - TURNO TARDE
  </h6>
</div>
<div class="card-body">

  <table class='table table-striped table-hover table-responsive-md' width='80%'>
<thead >
<tr style='background-color:royalblue;color:white;'>
<th>hora</th><th>LUNES</th><th>MARTES</th><th>MIERCOLES</th><th>JUEVES</th><th>VIERNES</th></tr>
</thead>
<tbody>
  <tr>
  <td>08:00</td>
  <td>Curso1</td>
  <td>Curso2</td>
  <td>Curso3</td>
  <td>Curso4</td>
  <td>Curso5</td>
  </tr>
  <tr>
  <td>09:00</td>
  <td>Curso11</td>
  <td>Curso22</td>
  <td>Curso33</td>
  <td>Curso44</td>
  <td>Curso55</td>
  </tr>
  <tr>
  <td>10:00</td>
  <td>Curso11</td>
  <td>Curso22</td>
  <td>Curso33</td>
  <td>Curso44</td>
  <td>Curso55</td>
  </tr>
  <tr>
  <td>11:00</td>
  <td>Curso11</td>
  <td>Curso22</td>
  <td>Curso33</td>
  <td>Curso44</td>
  <td>Curso55</td>
  </tr>
</tbody>
</table>
</div>
</div>


<div class="card shadow mb-4">
  <div class="card-header py-3">
  <h6 class="m-0 font-weight-bold text-primary">
  <i class="fa fa-search" ></i>HORARIO - TURNO NOCHE
  </h6>
</div>
<div class="card-body">

  <table class='table table-striped table-hover table-responsive-md' width='80%'>
<thead >
<tr style='background-color:orangered;color:white;'>
<th>hora</th><th>LUNES</th><th>MARTES</th><th>MIERCOLES</th><th>JUEVES</th><th>VIERNES</th></tr>
</thead>
<tbody>
  <tr>
  <td>08:00</td>
  <td>Curso1</td>
  <td>Curso2</td>
  <td>Curso3</td>
  <td>Curso4</td>
  <td>Curso5</td>
  </tr>
  <tr>
  <td>09:00</td>
  <td>Curso11</td>
  <td>Curso22</td>
  <td>Curso33</td>
  <td>Curso44</td>
  <td>Curso55</td>
  </tr>
  <tr>
  <td>10:00</td>
  <td>Curso11</td>
  <td>Curso22</td>
  <td>Curso33</td>
  <td>Curso44</td>
  <td>Curso55</td>
  </tr>
  <tr>
  <td>11:00</td>
  <td>Curso11</td>
  <td>Curso22</td>
  <td>Curso33</td>
  <td>Curso44</td>
  <td>Curso55</td>
  </tr>
</tbody>
</table>
</div>
</div>


<table>
    <tr><th>Nro</th>
        <th>Hora</th>
        <th>LUNES</th><th>MARTES</th><th>MIERCOLES</th><th>JUEVES</th><th>VIERNES</th>
</tr>
        @foreach($misareas as $horario)
        @if ($horario->turno === "MAÑANA")
        <tr>
            <td>{{ $horario->nrohora }}</td>
            <td>{{ $horario->hora }}</td>
            <th>
           

            </th><th>curMARTES</th><th>curMIERCOLES</th><th>curJUEVES</th><th>curVIERNES</th>
        </tr>
        @endif
        @endforeach
</table>

@php
$nombre = $misareas2;
 echo saludo($nombre,"LUN","08:00");
 echo saludo($nombre,"MAR","08:00");
 echo saludo($nombre,"MIE","08:00") ;
 echo saludo($nombre,"JUE","08:00") ;
 echo saludo($nombre,"VIE","08:00") ;
@endphp
