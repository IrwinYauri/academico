@php
function crucehoras($semestre, $dia, $codcurso, $ciclo)
{
    $sql = "SELECT
seccion.sem_iCodigo,
seccion.cur_iCodigo,
seccion.doc_iCodigo,
seccion_horario.dia_vcCodigo,
seccion_horario.sechor_iHoraInicio,
seccion_horario.sechor_iHoraFinal,
curso.cur_vcNombre,
escuela.esc_vcNombre,
curso.cur_iSemestre,
docente.doc_vcPaterno,
docente.doc_vcMaterno,
docente.doc_vcNombre
FROM
seccion
INNER JOIN seccion_horario ON seccion_horario.sec_iCodigo = seccion.sec_iCodigo
INNER JOIN curso ON seccion.cur_iCodigo = curso.cur_iCodigo
INNER JOIN escuelaplan ON curso.escpla_iCodigo = escuelaplan.escpla_iCodigo
INNER JOIN escuela ON escuelaplan.esc_vcCodigo = escuela.esc_vcCodigo
INNER JOIN docente ON seccion.doc_iCodigo = docente.doc_iCodigo AND seccion_horario.doc_iCodigo = docente.doc_iCodigo
where seccion.sem_iCodigo='$semestre' and seccion_horario.dia_vcCodigo='$dia'
and curso.cur_iSemestre='$ciclo'";
    $data = DB::select($sql);
    return $data;
}

function buscardias($semestre, $ciclo, $dia, $escuela)
{
    $sql = "SELECT
seccion.sem_iCodigo,
seccion.cur_iCodigo,
seccion.doc_iCodigo,
seccion_horario.dia_vcCodigo,
seccion_horario.sechor_iHoraInicio,
seccion_horario.sechor_iHoraFinal,
curso.cur_vcNombre,
escuela.esc_vcNombre,
curso.cur_iSemestre,
concat(
docente.doc_vcPaterno,' ',
docente.doc_vcMaterno,' ',
docente.doc_vcNombre) AS docente,
escuela.esc_vcCodigo,
seccion_horario.sectip_cCodigo
FROM
seccion
INNER JOIN seccion_horario ON seccion_horario.sec_iCodigo = seccion.sec_iCodigo
INNER JOIN curso ON seccion.cur_iCodigo = curso.cur_iCodigo
INNER JOIN escuelaplan ON curso.escpla_iCodigo = escuelaplan.escpla_iCodigo
INNER JOIN escuela ON escuelaplan.esc_vcCodigo = escuela.esc_vcCodigo
INNER JOIN docente ON seccion.doc_iCodigo = docente.doc_iCodigo AND seccion_horario.doc_iCodigo = docente.doc_iCodigo
where seccion.sem_iCodigo='$semestre' and seccion_horario.dia_vcCodigo='$dia'
and curso.cur_iSemestre='$ciclo'
and escuela.esc_vcCodigo='$escuela'
order by seccion_horario.sechor_iHoraInicio";
    $data = DB::select($sql);
    return $data;
}

if (isset($_REQUEST['operacion'])) {
    $op = $_REQUEST['operacion'];
    if ($op == 'cruces') {
        $semestre = $_REQUEST['semestre'];
        $dia = $_REQUEST['dia'];
        $codcurso = $_REQUEST['codcurso'];
        $ciclo = $_REQUEST['ciclo'];
        crucehoras($semestre, $dia, $codcurso, $coddocente);
    }

    if ($op == 'cursos') {
        crucehoras($semestre, $dia, $codcurso, $coddocente);
    }

    if ($op == 'dias') {
        $semestre = $_REQUEST['semestre'];
        $dia = $_REQUEST['dia'];
        $escuela = $_REQUEST['escuela'];
        $ciclo = $_REQUEST['ciclo'];

        $dias = buscardias($semestre, $ciclo, 'LUN', $escuela);
      //  $dias = buscardias('20212', 1,'LUN','AN');
        $rep="";
        foreach ($dias as $data) {
                if($data->sectip_cCodigo="T")
                $teo="TEORIA";

                if($data->sectip_cCodigo="P")
                $teo="PRACTICA";

            $rep=$rep.$data->cur_vcNombre."<br>".
            $data->docente."<br>". 
            $data->sechor_iHoraInicio."-".
            $data->sechor_iHoraFinal."<br>".$teo."<br><br>";
        }
        echo "<script>
            $('#LUN').html('$rep<br>-');
            </script>";
       ////martes
       $semestre = $_REQUEST['semestre'];
        $dia = $_REQUEST['dia'];
        $escuela = $_REQUEST['escuela'];
        $ciclo = $_REQUEST['ciclo'];

        //$dias = buscardias($semestre, $ciclo, $dia, $escuela);
        $dias = buscardias($semestre,  $ciclo,'MAR',$escuela);
        $rep="";
        foreach ($dias as $data) {
             if($data->sectip_cCodigo="T")
        $teo="TEORIA";

        if($data->sectip_cCodigo="P")
        $teo="PRACTICA";

            $rep=$rep.$data->cur_vcNombre."<br>".
            $data->docente."<br>". 
            $data->sechor_iHoraInicio."-".
            $data->sechor_iHoraFinal."<br>".$teo."<br><br>";
        }
        echo "<script>
            $('#MAR').html('$rep<br>-');
            </script>";

            /////mier
            $semestre = $_REQUEST['semestre'];
        $dia = $_REQUEST['dia'];
        $escuela = $_REQUEST['escuela'];
        $ciclo = $_REQUEST['ciclo'];

        //$dias = buscardias($semestre, $ciclo, $dia, $escuela);
        $dias = buscardias($semestre, $ciclo,'MIE',$escuela);
        $rep="";
        foreach ($dias as $data) {
             if($data->sectip_cCodigo="T")
        $teo="TEORIA";

        if($data->sectip_cCodigo="P")
        $teo="PRACTICA";

            $rep=$rep.$data->cur_vcNombre."<br>".
            $data->docente."<br>". 
            $data->sechor_iHoraInicio."-".
            $data->sechor_iHoraFinal."<br>".$teo."<br><br>";
        }
        echo "<script>
            $('#MIE').html('$rep<br>-');
            </script>";

              /////JUEVES
              $semestre = $_REQUEST['semestre'];
        $dia = $_REQUEST['dia'];
        $escuela = $_REQUEST['escuela'];
        $ciclo = $_REQUEST['ciclo'];

        //$dias = buscardias($semestre, $ciclo, $dia, $escuela);
        $dias = buscardias($semestre, $ciclo,'JUE',$escuela);
        $rep="";
        foreach ($dias as $data) {
             if($data->sectip_cCodigo="T")
        $teo="TEORIA";

        if($data->sectip_cCodigo="P")
        $teo="PRACTICA";

            $rep=$rep.$data->cur_vcNombre."<br>".
            $data->docente."<br>". 
            $data->sechor_iHoraInicio."-".
            $data->sechor_iHoraFinal."<br>".$teo."<br><br>";
        }
        echo "<script>
            $('#JUE').html('$rep<br>-');
            </script>";

              /////VIERNES
              $semestre = $_REQUEST['semestre'];
        $dia = $_REQUEST['dia'];
        $escuela = $_REQUEST['escuela'];
        $ciclo = $_REQUEST['ciclo'];

        //$dias = buscardias($semestre, $ciclo, $dia, $escuela);
        $dias = buscardias($semestre, $ciclo,'VIE',$escuela);
        $rep="";
        foreach ($dias as $data) {
             if($data->sectip_cCodigo="T")
        $teo="TEORIA";

        if($data->sectip_cCodigo="P")
        $teo="PRACTICA";

            $rep=$rep.$data->cur_vcNombre."<br>".
            $data->docente."<br>". 
            $data->sechor_iHoraInicio."-".
            $data->sechor_iHoraFinal."<br>".$teo."<br><br>";
        }
        echo "<script>
            $('#VIE').html('$rep<br>-');
            </script>";
            
    }
}
@endphp

var sel = document.getElementById("existingList");

var opt = document.createElement("option");
opt.value = "3";
opt.text = "Option: Value 3";

sel.add(opt, null);
