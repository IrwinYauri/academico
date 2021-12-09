<?php

function semestre()
{
    $sql = "SELECT
semestre.sem_iCodigo
from semestre order by semestre.sem_iCodigo desc
 ";
    $data = DB::select($sql);
    return $data;
}

$semestre = semestre();

$n=0;
?>
<style>
    .colorcab
    {color:white;
    background-color: navy;}
  
</style>
<div class="card">
  <div class="card-header">
    LISTA ALUMNOS MATRICULADOS - 
    <select name="nsemestre" id="nsemestre" onchange="vermatriculadostabla()">
      @foreach ($semestre as $data)
          <option value="{{ $data->sem_iCodigo }}">{{ $data->sem_iCodigo }}</option>
      @endforeach
  </select>
  </div>
  <div class="card-body">
    
    <div id="matriculados">
      
    </div>
</div>
  
</div>
<script>
  function vermatriculadostabla() {
      semestre = $("#nsemestre").val();
     
      $("#matriculados").html("<img src='img/cargar.gif'>");
      $.ajax({
          url: "admin/consultamatriculadoslista",
          success: function(result) {
              //alert(result);
              $("#matriculados").html(result);

          },
          data: {
              semestre: semestre
          },
          type: "GET"
      });
  }
  vermatriculadostabla();
</script>
