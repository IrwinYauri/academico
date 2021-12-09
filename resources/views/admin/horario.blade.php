<?php

  function verescuela()
  {
    $sql="SELECT escuela.esc_vcCodigo,esc_vcNombre FROM escuela where esc_cActivo='S'";
    $data=DB::select($sql);
    return $data;
  }

  $escuela=verescuela();
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
  <h1 class="h3 mb-0 text-gray-600"><i class="fas fa-clock"></i> CURSOS Y HORARIOS</h1><br>

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
        ESCUELA PROFESIONAL:<select id="escuelax" name="escuelax" onchange="verhorario()">
          @foreach ($escuela as $data)
          <option value="{{$data->esc_vcCodigo}}">{{$data->esc_vcNombre}}</option>
          @endforeach
         </select>  <a href="#" class="btn btn-primary" onclick="printDiv('listahorario')"> IMPRIMIR</a>
        <div id="listahorario">
        include('admin.horariolista')  
        </div>
      </div>
      <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
        @include('admin.horariocrear')  
      </div>   
    </div> 
  </div>
</div> 
<script>
  function verhorario()
  { var escuela=$("#escuelax").val();
    var semestre='{{$semestreactual}}'
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
  verhorario();
</script>
<script>
  function printDiv(divName) {
   var printContents = document.getElementById(divName).innerHTML;
   var originalContents = document.body.innerHTML;

   document.body.innerHTML = printContents;

   window.print();

 //  document.body.innerHTML = originalContents;
}
</script>