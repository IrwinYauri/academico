@php
 session_start();
 $coddocentex="";
 if(isset($_SESSION['coddocentex'])){
  $coddocentex=$_SESSION['coddocentex'];
 }
  use App\Http\Controllers\DocenteController; 
    $mihoras=new DocenteController();
    //$listahora= $mihoras->vercargahoraria(51,20212)
     $listahora= $mihoras->verhorario($coddocentex,semestreactual())
@endphp
<head>
  <title>Horarios</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
</head>

<style>
  .table-condensed{
font-size: 10px;
color: black;
}

</style>


<div class="card shadow mb-4">
  <div class="card-header py-3" style="background-color:navy)">
    <h6 class="m-0 font-weight-bold text-dark-400">
       <i class="fa fa-calendar fa-2x" ></i> CARGA HORARIA 
       <a class="btn btn-primary"  href="docente/rptcargahorario"> IMPRIMIR </a>
      </h6>
   </div>

  
    <div class="card-body " style="overflow: scroll;">
    <table class='table table-striped table-hover table-responsive-md text-dark-400 table-condensed'>
     <thead>
     <tr style='background-color:royalblue;color:white;'>
      <th>Nro</th>
        <th>Grupo</th>
        <th>Día</th>
        <th>Tipo</th>
        <th>Inicio</th>
        <th>Final</th>
        <th>Aula</th>
        <th>Turno</th>
        <th>Local</th>
        <th>Codigo</th>
        <th>Curso</th>
        <th>EP</th>
        <th>Escuela</th>
        @php
            $n=0;
        @endphp
</tr>
</thead>

        @foreach($listahora as $horario)

       @php
            $n++;
           
       @endphp
        <tr style="color:#505050">
          <td>{{ $n }}</td>
          <td>{{ $horario->sec_iNumero }}</td>
          <td>{{ $horario->dia_vcCodigo }}</td>
          <td>{{ $horario->tipodictado }}</td>
          <td>{{ $horario->sechor_iHoraInicio }}</td>
          <td>{{ $horario->sechor_iHoraFinal }}</td>
          <td>{{ $horario->aul_vcCodigo}}</td>
          <td>{{ $horario->tur_cCodigo }}</td>
          <td>{{ $horario->loc_vcNombre}}</td>
          <td>{{ $horario->cur_vcCodigo }}</td>
          <td>{{ $horario->cur_vcNombre }}</td>
          <td>{{ $horario->esc_vcCodigo }}</td>
          <td>{{ $horario->esc_vcNombre }}</td>
           
        </tr>
       
        @endforeach
      </table>
    </div>
  </div>



<!--
<div class="card shadow mb-4" style="overflow: scroll;">
  <div class="card-header py-3">
  <h6 class="m-0 font-weight-bold text-primary">
  <i class="fa fa-table fa-2x " ></i> HORARIO - SEMANAL
  </h6>
</div>
<div class="card-body">

  <table class='table table-striped table-hover table-responsive-md' width='80%'>
<thead >
<tr style='background-color:navy;color:white;'>
<th>TURNO</th><th>LUNES</th><th>MARTES</th><th>MIERCOLES</th><th>JUEVES</th><th>VIERNES</th></tr>
</thead>
<tbody>
  <tr>
  <td>MAÑANA</td>
  <td>Curso1</td>
  <td>Curso2</td>
  <td>Curso3</td>
  <td>Curso4</td>
  <td>Curso5</td>
  </tr>
  <tr>
  <td>TARDE</td>
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
//-->


</div>

@php
/*
$nombre = $misareas2;
 echo saludo($nombre,"LUN","08:00");
 echo saludo($nombre,"MAR","08:00");
 echo saludo($nombre,"MIE","08:00") ;
 echo saludo($nombre,"JUE","08:00") ;
 echo saludo($nombre,"VIE","08:00") ; */



@endphp

<div style="display:none">
  {{dd($listahora)}}
  </div>