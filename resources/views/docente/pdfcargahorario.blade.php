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
    $mihoras=new DocenteController();
    //$listahora= $mihoras->vercargahoraria(51,20212)
    $listahora= $mihoras->vercargahoraria($coddocentex,20212)
@endphp
<head>
  <title>Horarios</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
</head>




<div >
    <!-- <img src='asset('img/escudo.png')'  width='50' height='68' /> //-->
   <!--  <img src="img/escudo.png" alt="" width='50' height='68'> //-->
    <h3 class="m-0 font-weight-bold text-dark-400">
       <i class="fa fa-calendar fa-2x" ></i> CARGA HORARIA
      </h3>
   </div>

<h3>DOCENTE:{{$nombredoc}}</h3>
    <table class='table '>
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







