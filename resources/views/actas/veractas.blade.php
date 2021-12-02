<?php
$gcodcurso = '0';
if (isset($_REQUEST['xcod'])) {
    $gcodcurso = $_REQUEST['xcod'];
    $semestre=$_REQUEST['semestre'];
    $coddocente=$_REQUEST['coddocente'];
} else {
 //   return 0;
}

?>
<div id="retonarx" style="display: none">
    <button type="button" class="btn btn-primary" onclick="xvercursos()">RETORNAR LISTA DE CURSOS</button>
</div>
<div id="micarga">
    <table>
        <tr><td>
            <img src="{{ asset('img/carga01.gif')}}" alt="UNAAT">  
        </td></tr>
    
    <tr align="center"><td>
        ...Cargando     
    </td></tr>
  
</table> 
</div>


<script src="{{ asset('datatable/js/jquery-1.12.4.js')}}"></script>
<script>
//$("#micarga").load('../actasxls/registro?xcod={{$gcodcurso}}')
$("#micarga").load('actasxls/registro?xcod={{$gcodcurso}}&semestre={{$semestre}}&coddocente={{$coddocente}}')

function xvercursos()
{$("#micontenido").load('docente/registronotas');

}
</script>

