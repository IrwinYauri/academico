<?php

  function verescuela()
  {
    $sql="SELECT escuela.esc_vcCodigo,esc_vcNombre FROM escuela where esc_cActivo='S'";
    $data=DB::select($sql);
    return $data;
  }

  /*function listasemestre()
    {
        $sql = "SELECT semestre.sem_iCodigo FROM semestre  order by semestre.sem_iCodigo desc";
        $data = DB::select($sql);
        return $data;
    }*/
  function lisdocente()
  {
      $sql = "SELECT docente.doc_iCodigo,concat(docente.doc_vcPaterno,'',docente.doc_vcMaterno,'',docente.doc_vcNombre,'::',docente_categoria.doccat_vcNombre,'::',docentedepaca.depaca_vcNombre) as docente FROM docente INNER JOIN docente_categoria ON docente.doccat_iCodigo = docente_categoria.doccat_iCodigo INNER JOIN docentedepaca ON docente.depaca_iCodigo = docentedepaca.depaca_iCodigo where docente.doc_cActivo='S'";
      $data = DB::select($sql);
      return $data;
  }
  function listacurso($ciclo,$escuela)
  {
      $sql = "SELECT curso.cur_iCodigo,concat(curso.cur_vcNombre,'::',cursotipo.curtip_vcNombre) as curso FROM curso INNER JOIN escuelaplan ON curso.escpla_iCodigo = escuelaplan.escpla_iCodigo INNER JOIN escuela ON escuelaplan.esc_vcCodigo = escuela.esc_vcCodigo INNER JOIN cursotipo ON curso.curtip_vcCodigo = cursotipo.curtip_vcCodigo where escuela.esc_vcCodigo='$escuela' and curso.cur_iSemestre='$ciclo'";
      $data = DB::select($sql);
      return $data;
  }
  function turno()
  {
      $sql = "SELECT turno.tur_cCodigo, turno.tur_vcNombre FROM turno WHERE turno.tur_cActivo='S'";
      $data = DB::select($sql);
      return $data;
  }
  function dia()
  {
      $sql = "SELECT dia.dia_vcCodigo,dia.dia_vcNombre,dia.dia_iNumero FROM dia";
      $data = DB::select($sql);
      return $data;
  }

  $escuela = verescuela();
  $listadocente = lisdocente();
  //$listasemestre=listasemestre();
  //listacurso($ciclo,$escuela);
  $listacurso = listacurso(1,'AN');
  $turno = turno();
  $dia = dia();
  $semestreactual=semestreactual();
?>

<!--style>
  .table{
    color:black;
  }
</style-->
<!--nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">HORARIOS</a>
    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">CREAR HORARIOS</a>
  
  </div>
</nav-->
<div class="container table-condensed">
  <h1 class="h3 mb-0 text-gray-600"><i class="fa fa-table"></i> CURSOS Y HORARIOS</h1><br>

  <div class="alert alert-success" id="sms" style="display:none;">
    <strong>Correcto!</strong> Se registro bien.
  </div>
  <div class="alert alert-danger" id="sms2" style="display:none;">
    <strong>Error!</strong> <span id="sms2_1">Vuelva a intentarlo.</span>
  </div>
  <div class="card shadow mb-4">   
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">        
      <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item m-0 font-weight-bold text-primary" role="presentation">
            <button class="btn btn-primary active" id="home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="home" aria-selected="true" style="border:1px solid white;"><i class="fa fa-bars" aria-hidden="true"></i> HORARIOS</button>
        </li>
        <li class="nav-item m-0 font-weight-bold text-primary" role="presentation">
          <button class="btn btn-primary" id="semestre-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="semestrefecha" aria-selected="false" style="border:1px solid white;"><i class="fas fa-calendar-alt"></i> CREAR HORARIO</button>
        </li>
      </ul>
    </div>  

    <div class="tab-content" id="nav-tabContent">
      <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
        ESCUELA PROFESIONAL:
        <select id="escuelax" name="escuelax" onchange="verhorario()">
          @foreach ($escuela as $data)
          <option value="{{$data->esc_vcCodigo}}">{{$data->esc_vcNombre}}</option>
          @endforeach
        </select>  
        <a href="#" class="btn btn-primary" onclick="printDiv('listahorario')"> IMPRIMIR</a>
        <div id="listahorario">
        include('admin.horariolista')  
        </div>
      </div>
      <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
        <div class="row">
          <div class="col-sm-4">
              <div class="row form-group">
                  <div class="col-sm-12">
                      <select class="form-control" id="escuela" name="escuela">         
                          <option value="0">ESCUELA</option>           
                          @foreach ($escuela as $data)
                              <option value="{{ $data->esc_vcCodigo }}">{{ $data->esc_vcNombre }}</option>
                          @endforeach
                      </select>
                  </div>
              </div>
              
              <div class="row form-group">                
                  <div class="col-sm-6">                    
                      <select class="form-control" id="ciclo" name="ciclo" onchange="verdias()">
                          <option value="0">CICLO</option>
                          @for ($x = 1; $x <= 10; $x++)
                              <option value="{{ $x }}">{{ nroromano($x) }}</option>
                          @endfor
                      </select>
                  </div>       
                  <div class="col-sm-6">                    
                      <select class="form-control" id="dia" name="dia">
                          <option value="0">DIA</option>
                          @foreach ($dia as $datos)
                              <option value="{{ $datos->dia_vcCodigo }}">{{ $datos->dia_vcNombre }}</option>
                          @endforeach
                      </select>
                  </div>         
              </div>
              
              <div class="row form-group">                
                  <div class="col-sm-6">                    
                      <label>Hora Inicio</label>
                      <input class="form-control" type="time" id="appt" name="appt">
                  </div>       
                  <div class="col-sm-6">                    
                      <label>Hora Fin</label>
                      <input class="form-control" type="time" id="appt" name="appt">
                  </div>         
              </div>
              
              <div class="row form-group">                
                  <div class="col-sm-6">                    
                      <select class="form-control">
                          <option>TURNO</option>
                          @foreach ($turno as $datos)
                              <option value="{{ $datos->tur_cCodigo }}">{{ $datos->tur_vcNombre }}</option>
                          @endforeach

                      </select>
                  </div>       
                  <div class="col-sm-6">                    
                      <select class="form-control" id="dia" name="dia">
                          <option value="0">GRUPO</option>
                          <option value="G1">G1</option>
                          <option value="G2">G2</option>
                          <option value="G3">G3</option>
                          <option value="G4">G4</option>
                          <option value="G5">G5</option>                        
                      </select>
                  </div>         
              </div>

              <div class="row form-group">
                  <div class="col-sm-12">
                      <select class="form-control">
                          <option>DOCENTE</option>
                          @foreach ($listadocente as $datos)
                              <option value="{{ $datos->doc_iCodigo }}">{{ $datos->docente }}</option>
                          @endforeach
                      </select>
                  </div>
              </div>

              <div class="row form-group">
                  <div class="col-sm-12">
                      <select class="form-control" id="curso" name="curso">
                          <option>PLAN DE ESTUDIO</option>
                          
                      </select>
                  </div>
              </div>

              <div class="row form-group">
                  <div class="col-sm-12">
                      <select class="form-control" id="curso" name="curso">
                          <option>CURSO</option>
                          @foreach ($listacurso as $data)
                              <option value="{{ $data->cur_iCodigo }}">AN.EG.102.125 | {{ $data->curso }}</option>
                          @endforeach
                      </select>
                  </div>
              </div>


          </div>
          <div class="col-sm-6">
            <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>N°</th>
                  <th>Carrera</th>
                  <th>Curso</th>
                  <th>Ciclo</th>
                  <th>Día</th>
                  <th>Horas</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <hr>

        <table class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>Hora/Día</th>
              <th>Lunes</th>
              <th>Martes</th>
              <th>Miércoles</th>
              <th>Jueves</th>
              <th>Viernes</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
          </tbody>
        </table>

      </div>   
    </div> 
  </div>
</div> 

<script>
  $( document ).ready(function() {
      verhorario();
  });

  function verhorario()

  { 
    var escuela=$("#escuelax").val();
    var semestre='{{$semestreactual}}';
    $("#listahorario").html("<img src='img/carga01.gif'>");

    $.ajax({
        url: "admin/horariolista",
        success: function(result) {
           $("#listahorario").html(result);
          },
        data: {
          semestre:semestre,
          escuela:escuela
        },
        type: "GET"
    });
  }  

  function printDiv(divName) 
  {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
  }
</script>
<script>
    function verdias() 
    {
        var semestre = $("#semestre").val();
        var ciclo = $("#ciclo").val();
        var dia = $("#dia").val();
        var escuela = $("#escuela").val();
        $.ajax({
            url: "admin/horariobuscardatos",
            success: function(result) {
                $("#rep").html(result);
                console.log(semestre)
                console.log(ciclo)
                console.log(dia)
                console.log(escuela)
            },
            data: {
                operacion:'dias',
                semestre: semestre,
                ciclo: ciclo,
                dia: dia,
                escuela: escuela
            },
            type: "GET"
        }); 
    }
</script>