ENCUESTA GRABADA<br>
<?php

$semestre = $_REQUEST['semestre'];
$coddocente = $_REQUEST['coddocente'];
$codmatricurso = $_REQUEST['codmatricurso'];
$codcurso= $_REQUEST['codcurso'];
$codalumno= $_REQUEST['codalumno'];

function buscardocente($semestre, $coddocente)
{
    $sql = "SELECT
    encuesta_docente.encdoc_iCodigo
    FROM
    encuesta
    INNER JOIN encuesta_docente ON encuesta_docente.enc_iCodigo = encuesta.enc_iCodigo
    where encuesta.sem_iCodigo='$semestre' and encuesta_docente.doc_iCodigo='$coddocente'";

    $data = DB::select($sql);
    return $data;
}
function buscarnroencuesta($semestre)
{
    $sql = "SELECT
            encuesta.enc_iCodigo
            FROM
            encuesta
            WHERE
            encuesta.sem_iCodigo = '$semestre'";

    $data = DB::select($sql);
    if (isset($data[0]->enc_iCodigo)) {
        return $data[0]->enc_iCodigo;
    } else {
        return 0;
    }
}

function buscarhora($semestre, $codalumno, $codcurso)
{
    $sql = "SELECT

            seccion_horario.sechor_iCodigo
            FROM
            matriculadetalle
            INNER JOIN seccion ON matriculadetalle.sec_iCodigo = seccion.sec_iCodigo
            INNER JOIN matricula ON matriculadetalle.mat_iCodigo = matricula.mat_iCodigo
            INNER JOIN seccion_horario ON seccion_horario.sec_iCodigo = seccion.sec_iCodigo
            where seccion.cur_iCodigo='$codcurso' and matricula.alu_iCodigo='$codalumno' and matricula.sem_iCodigo='$semestre' limit 1";
            $data = DB::select($sql);
            if (isset($data[0]->sechor_iCodigo)) {
                return $data[0]->sechor_iCodigo;
            } else {
                return 0;
            }
}

function registrodocente($codencuesta, $coddocente)
{
    $sql = "insert into encuesta_docente(enc_iCodigo,doc_iCodigo)
  values('$codencuesta','$coddocente')";
    $data = DB::select($sql);
    $sql = 'select max(encdoc_iCodigo) as nuevo from encuesta_docente';
    $data = DB::select($sql);
    return $data[0]->nuevo;
}

function encuestahora($coddocenteencuesta,$horaseccion,$codmatricurso)
{$sql="select enchor_cActivo from encuesta_horario 
where 
encdoc_iCodigo='$coddocenteencuesta'
and sechor_iCodigo='$horaseccion'
and matdet_iCodigo='$codmatricurso'";
$data = DB::select($sql);
    return $data;
}

function encuestahoraregistrar($coddocenteencuesta,$horaseccion,$codmatricurso)
{ $sql="insert into encuesta_horario(encdoc_iCodigo,sechor_iCodigo,matdet_iCodigo)
    values('$coddocenteencuesta','$horaseccion','$codmatricurso')";
    $data = DB::select($sql);
        return $data;
}

function buscarcodigohora($coddocenteencuesta,$codmatricurso)
{$sql="SELECT
enchor_iCodigo
        FROM
        encuesta_horario
        WHERE

        encuesta_horario.encdoc_iCodigo='$coddocenteencuesta'
        and matdet_iCodigo='$codmatricurso'";
        $data = DB::select($sql);
        if(isset($data[0]->enchor_iCodigo))
        return $data[0]->enchor_iCodigo;
        else {
            return 0;
        }
}

function encuestahorariopuntos($coddocenteencuesta,$horaseccion,$codmatricurso,$punto)
{$sql="update  encuesta_horario set enchor_iPuntaje='$punto' where 
encdoc_iCodigo='$coddocenteencuesta'
and sechor_iCodigo='$horaseccion'
and matdet_iCodigo='$codmatricurso'";
$data = DB::select($sql);
 return $data;
}

function cerrarhora($codhora)
{ $sql="update encuesta_horario set enchor_cActivo='N' 
      where enchor_iCodigo='$codhora'         ";

    $data = DB::select($sql);
        return $data;
}

function preguntasdocente($coddocenteenecuesta)
{   $sql="SELECT
    count(encuesta_docentepregunta.encpre_iCodigo) as total
    FROM encuesta_docentepregunta
    where encuesta_docentepregunta.encdoc_iCodigo='$coddocenteenecuesta'";
    $data = DB::select($sql);
        if(isset($data[0]->total))
        return $data[0]->total;
        else {
            return 0;
        }
}

function preguntadocenteregistrar($codsemestre,$coddocenteencuesta)
{$sql="insert into
        encuesta_docentepregunta
        (encdoc_iCodigo,
        encpre_iCodigo)
        SELECT '$coddocenteencuesta' as coddocenteencu,
        encuesta_pregunta.encpre_iCodigo
        FROM
        encuesta_pregunta
        WHERE
        encuesta_pregunta.enc_iCodigo='$codsemestre'";
        $data = DB::select($sql);
        return $data;  
}

function consultapreguntasregistrada($codhoraencu)
{$sql="SELECT
        count(encuesta_horariopregunta.enchor_iCodigo) as total
        FROM
        encuesta_horariopregunta
        WHERE
        encuesta_horariopregunta.enchor_iCodigo='$codhoraencu'";
        
        $data = DB::select($sql);
        if(isset($data[0]->total))
        return $data[0]->total; 
        else {
        return 0;
        } 
        
    }

function registropuntajepregunta($codigohoraregistro,$codpregunta,$punto)
{       $sql="insert into encuesta_horariopregunta(enchor_iCodigo,encpre_iCodigo,enchorpre_iPuntaje)
         values ('$codigohoraregistro','$codpregunta','$punto')
        ";
        $data = DB::select($sql);
            return $data;  
}



$bdocente = buscardocente($semestre, $coddocente);
$horario=buscarhora($semestre, $codalumno, $codcurso);


$coddocenteencuesta = 0;
$codencuesta = buscarnroencuesta($semestre);



if (isset($bdocente[0]->encdoc_iCodigo)) {
    echo 'existe docente' . $bdocente[0]->encdoc_iCodigo . '<br>';
    $coddocenteencuesta = $bdocente[0]->encdoc_iCodigo;
} else {
    echo 'no registrado<br>';
    
    $coddocenteencuesta = registrodocente($codencuesta, $coddocente);
}


$horaencuesta=encuestahora($coddocenteencuesta,$horario,$codmatricurso);
if(count($horaencuesta)<1)
encuestahoraregistrar($coddocenteencuesta,$horario,$codmatricurso);

$codhora=buscarcodigohora($coddocenteencuesta,$codmatricurso);

$preguntasrellenada =consultapreguntasregistrada($codhora);

$preguntadocente=preguntasdocente($coddocenteencuesta);

if($preguntadocente<1)
preguntadocenteregistrar($codencuesta,$coddocenteencuesta);
//registrar horaencuesta
//$horaencuesta=encuestahora(48,565,10870);
$puntos=0;
if (isset($_REQUEST['ntotal'])) {
    $total = $_REQUEST['ntotal'];

    echo '<br>--' . $coddocenteencuesta . '--<br>';
    echo $horario.'--<br>';
    echo count($horaencuesta).'--<br>';

    echo $coddocente . '<br>';
    echo $codmatricurso . '<br>';
    echo $codhora."***<br>";
    echo $horario."***<br>";
    echo $preguntasrellenada ."***<br>";
    if($preguntasrellenada<1)
        {for ($x = 1; $x <= $total; $x++) {
            echo $_REQUEST['rt' . $x] . '-';
            echo $_REQUEST['t' . $x] . '-pre:';
            echo $_REQUEST['pcod' . $x] . '<br>';

            $xcodpreg=$_REQUEST['pcod' . $x];
            $xpunto=$_REQUEST['rt' . $x];

            $puntos=$puntos+$_REQUEST['rt' . $x];

            registropuntajepregunta($codhora,$xcodpreg,$xpunto);
            }
        }
    encuestahorariopuntos($coddocenteencuesta,$horario,$codmatricurso,$puntos);
   // encuestahoraregistrar($coddocenteencuesta,$horario,$codmatricurso);

   // cerrarhora($coddocenteencuesta,$codhora,$codmatricurso);
    cerrarhora($codhora);
    echo "    <script>        location.href='alumno'        </script>";

}
?>
