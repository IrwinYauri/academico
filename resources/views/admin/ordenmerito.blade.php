@php
use App\Http\Controllers\AdminController; 
use App\Http\Controllers\DocenteController; 
$encuesta=new AdminController();
$encuestax=$encuesta->verlistaencuesta();
@endphp

@php
    function veralumnomatriculados($codcur,$semestre,$fila)
 {$miasistencia=new DocenteController(); 

   echo "<table class='table table-striped'>
      <thead> <tr style='background-color:black;color:white;'>
    <td>Nro</td> <td>Codigo</td> <td>Nombre</td>
    <td>EP</td>
    <td>Promedio</td>
  </tr>
  </thead>
  ";
   $misalumnos=$miasistencia->vercursosalumnos(trim($codcur),$semestre);
//dd($misalumnos);
$nro=0;
    foreach ($misalumnos as $alumno) {
      $nro++;
      $cod=$alumno->alu_vcCodigo;
      $estudiante=$alumno->alumno;
      $esp=left($alumno->cur_vcCodigo,2);
     echo "<tr style='color:black'>
          <td>$nro</td>
          <td>$cod</td>
         <td>$estudiante</td>
          <td>$esp</td>
          <td></td>
        </tr>";
    }
echo "</table>";
echo "
<script>
  document.getElementById('nlista$fila').innerHTML = '$nro';
</script>";

}  
@endphp

<div class="container">
    <div class="panel panel-primary">
        <div class="card-header py-3 bg-primary">
            <h6 class="m-0 font-weight-bold text-white">
            
            <i class="fa fa-desktop"></i> ORDEN DE MERITO
            </h6>
          </div>
       
     </div>

     <div class="card-body bg-white">
         SELECCIONAR PERIODO ACADEMICO:
           <select name="" id="" onchange="listaencuestapreguntasemestre(this.value)">
            @foreach ($encuestax as $encu)
            
                <option>{{ $encu->sem_iCodigo }}</option>
              
            @endforeach  
         </select>
          <div id="tmerito">
            preubasewfwvwevw s
          </div>
          <div id="talumno" style="display:block;">
            @php
            veralumnomatriculados(2,semestreactual(),1);
         @endphp
           </div> 

     </div>
</div>
