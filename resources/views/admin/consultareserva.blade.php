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

function escuela()
{
    $sql = "SELECT
escuela.esc_vcCodigo,
escuela.esc_vcNombre
FROM
escuela where  esc_cActivo='S'

 ";
    $data = DB::select($sql);
    return $data;
}

$semestre = semestre();
$escuela=escuela();
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
                <td>ESCUELA</td>
                <td></td>
            </tr>
            <tr>
                <td>
                    <select name="nsemestre" id="nsemestre" class="form-control" onchange="verreserva()">
                        @foreach ($semestre as $data)
                            <option value="{{ $data->sem_iCodigo }}">{{ $data->sem_iCodigo }}</option>
                        @endforeach
                    </select>

                </td>
                <td>
                    <select name="nescuela" id="nescuela" class="form-control" onchange="verreserva()">
                        <option value=""></option>
                        @foreach ($escuela as $data)
                            <option value="{{ $data->esc_vcCodigo }}">{{ $data->esc_vcNombre }}</option>
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
            <div id="listareserva">
                
            </div>
        </div>

    </div>

    <script>
        function verreserva() {
            semestre = $("#nsemestre").val();
            escuela = $("#nescuela").val();
            $("#listareserva").html("<img src='img/cargar.gif'>");
            $.ajax({
                url: "admin/consultareservalista",
                success: function(result) {
                    //alert(result);
                    $("#listareserva").html(result);

                },
                data: {
                    semestre: semestre,
                    escuela: escuela
                },
                type: "GET"
            });
        }
        verreserva();
    </script>
