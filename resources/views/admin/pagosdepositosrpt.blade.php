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
?>
<style>
    .colorcab
    {color:white;
    background-color: navy;}
  
</style>
<div class="card" >
    <div class="card-header">
        <table class="table">
        <thead>
            <tr class='colorcab'>
                <td>SEMESTRE</td>
                <td></td>
            </tr>
            <tr>
                <td>
                    <select name="nsemestre" id="nsemestre" class="form-control" onchange="verrptpago()">
                        @foreach ($semestre as $data)
                            <option value="{{ $data->sem_iCodigo }}">{{ $data->sem_iCodigo }}</option>
                        @endforeach
                    </select>

                </td>
                <td>
                    <a href="#" class="btn btn-primary">IMPRIMIR</a>

                </td>
            </tr>
        </thead>
        </table>



        <div class="card-body" >
            <div id="listapago">
                
            </div>
        </div>

    </div>

    <script>
        function verrptpago() {
            semestre = $("#nsemestre").val();
            $("#listapago").html("<img src='img/cargar.gif'>");
            $.ajax({
                url: "admin/pagosdepositosrptlista",
                success: function(result) {
                    //alert(result);
                    $("#listapago").html(result);

                },
                data: {
                    semestre: semestre
                },
                type: "GET"
            });
        }
        verrptpago();
    </script>
