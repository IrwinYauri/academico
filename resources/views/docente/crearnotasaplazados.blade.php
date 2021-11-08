<script>
function color(t)
{ t.style.color='red';}
</script>
<style>
    .table th,table td
    {  font-size: .80em;

    }
    .input{
        max:2;
        size:2;
    }
    </style>
<div class="card mb-4">
    <div class="card-header" style='background-color:maroon;color:white;'>
    NOTAS APLAZADOS
    </div>
    <div class="card-body">
    <div style="overflow: scroll;">                               
    <table class="table table-striped table-bordered table-sm " cellspacing="0"
       id="dataTable"   >
    <thead>
    <tr style='background-color:navy;color:white;'>
    <td>#</td>
    <td>Semestre</td>
    <td>EP</td>
    <td>Escuela</td>
    <td>Plan</td>
    <td>CodCur</td>
    <td>Curso</td>
    <td>Grupo</td>
    <td>Alumnos</td>
    <td>NOTAS</td>
    </tr>
    </thead>
    <tbody>
    <tr>
    <td>1</td>
    <td>20212</td>
    <td>EN</td>
    <td>ENFERMERIA</td>
    <td>2017</td>
    <td>EN.EG.17.101</td>
    <td>MATEMATICA BASiCA</td>
    <td>U</td>
    <td>32</td>
    <td><a class="btn btn-success " onclick="notasaplazadoscurso()" id="bnotassustitoriocurso">EVALUAR</a></td>
    </tr>
    </tbody>
    </table>
    </div>
    </div>
    </div>