@php
 use App\Http\Controllers\DocenteController; 
 $miasistencia=new DocenteController();  
 $listahora= $miasistencia->vercargahoraria(51,20212);
 function veralumnomatriculados($codcur,$semestre)
 {$miasistencia=new DocenteController(); 

   echo "<table class='table table-striped'>
       <tr style='background-color:navy;color:white;'>
    <td>Nro</td> <td>Codigo</td> <td>Nombre</td><td>Operacion</td><td>Estado</td>
  </tr>";
   $misalumnos=$miasistencia->vercursosalumnos($codcur,$semestre);
//dd($misalumnos);
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
         <td>
            <button class='btn btn-success btn-icon-split' onclick='marcarasistencia( \"tnx$nro\",\"Presente\")'>
                                        <span class='icon text-white-50'>
                                            <i class='fas fa-check'></i>
                                        </span>
                                        <span class='text'>Presente</span>
                                    </button>
            <button  class='btn btn-danger btn-icon-split' onclick='marcarasistencia( \"tnx$nro\",\"FALTA\")'>
                                        <span class='icon text-white-50'>
                                            <i class='fas fa-check'></i>
                                        </span>
                                        <span class='text'>Falta</span>
                                    </button>
            </td>
            <td id='tnx$nro'>PRESENTE</td>
        </tr>";
    }
echo "</table>";
}  
@endphp
<script>
    function marcarasistencia(id,estado)
    { document.getElementById(id).innerHTML =estado;
       }
  </script>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Control de Asistencia de Alumnos</h1>vbj vfh
                    </div>
                    <div class="row">
<div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                CURSO EN CLASES</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">MATEMATICA BASICA</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x " style="color: black"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                         <!-- Earnings (Annual) Card Example -->
                         <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                               HORA DE INICIO-FIN</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">8:00 - 9:00</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-dark-800"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tasks Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tipo de Clase
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">TEORICO</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                         <!-- Pending Requests Card Example -->
                         <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                NRO AULA</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">101</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
</div>


            <div class="row">
                @php
                    veralumnomatriculados(2,20212);
                @endphp
            </div>

            <table >
                <tr style='background-color:royalblue;color:white;'><td>codcurso</td><td>Asignatura</td><td>seccion</td><td>plan</td><td>escuela</td>
                <td>OP </td>
                </tr>
                @php
                    $nn=0;
                
                @endphp
                @foreach($listahora as $listacur)
                @php
                $nn++;
              @endphp
                  <tr>
                  <td>{{ $listacur->cur_vcCodigo }}</td>
                  <td>{{ $listacur->cur_vcNombre }}</td>
                  <td>{{ $listacur->sec_iNumero }}</td>
                 
                  <td>{{ left($listacur->cur_vcCodigo,2) }}</td>
                  
                </tr>
                
                @endforeach
                <tr>
                    <td>
                        cargando
                @php
                $nn=0;
                $activarclase=0;
            //    date_default_timezone_set("America/Lima");
                $fecha = date('Y-m-d');
                $hora = date('H:i');
                $comparahora= $fecha." ".$hora;
                foreach($listahora as $listacur)
                {if($listacur->dia_vcCodigo=="MIE")
                  { $datetime1 = new DateTime($fecha." ".$listacur->sechor_iHoraInicio);
                    $datetime2 = new DateTime($comparahora);
                    echo "--".$datetime1."<br>--";
                       if($datetime2>$datetime1)
                        $activarclase=1;
                  }
                }
                echo $activarclase;
                echo "<br>". $fecha;
                echo "<br>". $hora ;
                 //    dd($listahora);
                @endphp
                </td>
                </tr>
              </table>  

            