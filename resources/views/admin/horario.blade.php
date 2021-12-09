@php

function verescuela()
  {$sql="SELECT
escuela.esc_vcCodigo,esc_vcNombre
FROM
escuela where esc_cActivo='S'";
$data=DB::select($sql);
return $data;
  }

  $escuela=verescuela();
  $semestreactual=semestreactual();
@endphp
<style>
  .table{
    color:black;
  }
</style>
<nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">HORARIOS</a>
    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">CREAR HORARIOS</a>
  
  </div>
</nav>
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
<script>
  function verhorario()
  { var escuela=$("#escuelax").val();
    var semestre='{{$semestreactual}}'
    $("#listahorario").html("<img src='img/cargar.gif'>");
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
  verhorario()

  
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