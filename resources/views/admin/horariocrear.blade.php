@php
/*
function verescuela()
  {$sql="SELECT
escuela.esc_vcCodigo,esc_vcNombre
FROM
escuela where esc_cActivo='S'";
$data=DB::select($sql);
return $data;
  } */

$escuela = verescuela();
function listasemestre()
{
    $sql = "SELECT
semestre.sem_iCodigo
FROM
semestre  order by semestre.sem_iCodigo desc";
    $data = DB::select($sql);
    return $data;
}
function lisdocente()
{
    $sql = "SELECT
docente.doc_iCodigo,

concat(docente.doc_vcPaterno,'',
docente.doc_vcMaterno,'',
docente.doc_vcNombre,'::',
docente_categoria.doccat_vcNombre,'::',
docentedepaca.depaca_vcNombre) as docente
FROM
docente
INNER JOIN docente_categoria ON docente.doccat_iCodigo = docente_categoria.doccat_iCodigo
INNER JOIN docentedepaca ON docente.depaca_iCodigo = docentedepaca.depaca_iCodigo
where docente.doc_cActivo='S'";
    $data = DB::select($sql);
    return $data;
}
function listacurso($ciclo,$escuela)
{
    $sql = "SELECT
curso.cur_iCodigo,
concat(
curso.cur_vcNombre,'::',
cursotipo.curtip_vcNombre) as curso
FROM
curso
INNER JOIN escuelaplan ON curso.escpla_iCodigo = escuelaplan.escpla_iCodigo
INNER JOIN escuela ON escuelaplan.esc_vcCodigo = escuela.esc_vcCodigo
INNER JOIN cursotipo ON curso.curtip_vcCodigo = cursotipo.curtip_vcCodigo
where escuela.esc_vcCodigo='$escuela'
and curso.cur_iSemestre='$ciclo'
";
    $data = DB::select($sql);
    return $data;
}
function turno()
{
    $sql = "SELECT
turno.tur_cCodigo,
turno.tur_vcNombre
FROM
turno WHERE 
turno.tur_cActivo='S'";
    $data = DB::select($sql);
    return $data;
}
function dia()
{
    $sql = "SELECT
dia.dia_vcCodigo,
dia.dia_vcNombre,
dia.dia_iNumero
FROM
dia";
    $data = DB::select($sql);
    return $data;
}

$listadocente = lisdocente();
$listasemestre=listasemestre();
//listacurso($ciclo,$escuela)
$listacurso = listacurso(1,'AN');
$turno = turno();
$dia = dia();
@endphp
<div class="card shadow mb-8">
    <div class="card-header py-8">
        <h6 class="m-0 font-weight-bold text-primary">
            ESCUELA PROFESIONAL:<select id="escuela" name="escuela" onchange="verdias()">
                <option>Escuela</option>
                @foreach ($escuela as $data)
                    <option value="{{ $data->esc_vcCodigo }}">{{ $data->esc_vcNombre }}</option>
                @endforeach
            </select>

            CICLO:<select id="ciclo" name="ciclo" onchange="verdias()">
                <option>Seccionar</option>
                @for ($x = 1; $x <= 10; $x++)
                    <option value="{{ $x }}">{{ nroromano($x) }}</option>

                @endfor
            </select>
            
            <br>
            <i class="fa fa-table fa-2x "></i> HORARIO - SEMANAL

        </h6>
    </div>
    <div class="card-body">
        <table>
            <tr>
                <td>
                <td><button class="btn btn-primary btn-sm">REGISTRAR</button>
                <td rowspan="10">
                    <div id="nhoras">
                        CRUCES DE HORAS
                    </div>
                </td>
            </tr>
            <tr>
                <td>CODIGO SECCION</td>
                <td><input type="text">
                    <div id="estadox"></div>
                <td>
            </tr>
            <tr>
                <td> SEMESTRE</td>
                <td>
                    <select id="semestre" name="semestre">
                        @foreach ($listasemestre as $datos)
                            <option value="{{ $datos->sem_iCodigo }}">{{ $datos->sem_iCodigo }}</option>
                        @endforeach

                    </select>
    </div>
    <td>
        </tr>
        <tr>
            <td>NRO SECCION</td>
            <td><input type="text">
                <div id="estadox"></div>
            <td>
        </tr>
        <tr>
            <td> TURNO </td>
            <td><select>
                    <option>TURNO</option>

                    @foreach ($turno as $datos)
                        <option value="{{ $datos->tur_cCodigo }}">{{ $datos->tur_vcNombre }}</option>
                    @endforeach

                </select>
            <td>
        </tr>
        <tr>
            <td colspan="2">
                <select id="curso" name="curso">
                    <option>Curso</option>
                    @foreach ($listacurso as $data)
                        <option value="{{ $data->cur_iCodigo }}">{{ $data->curso }}</option>
                    @endforeach


                </select>
            <td>
        </tr>

        <tr>
            <td colspan="2">
                <select style="width: 400px">
                    <option>DOCENTE</option>
                    @foreach ($listadocente as $datos)
                        <option value="{{ $datos->doc_iCodigo }}">{{ $datos->docente }}</option>
                    @endforeach
                </select>
            <td>
        </tr>
        <tr>
            <td colspan="2">

        <tr style="background-color:yellow">
            <td>HORARIO</td>
            <td></td>
        </tr>
    <td>
        </tr>
        <tr>
            <td colspan="2">
                DIA:
                <select id="dia" name="dia">
                    <option>DIA</option>

                    @foreach ($dia as $datos)
                        <option value="{{ $datos->dia_vcCodigo }}">{{ $datos->dia_vcNombre }}</option>
                    @endforeach

                </select>
            <td>
        </tr>
        <tr>
            <td colspan="2">

                HORA INICIO <input type="text">
                HORA FINAL <input type="text">
            <td>
        </tr>
        </table>

        <table class='table table-striped  table-responsive-md' >
            <thead>
                <tr style='background-color:navy;color:white;'>

                    <th>LUNES</th>
                    <th>MARTES</th>
                    <th>MIERCOLES</th>
                    <th>JUEVES</th>
                    <th>VIERNES</th>
                </tr>
            </thead>
            <tbody>



                <tr>

                    <th>
                        <div id="LUN"></div>
                    </th>
                    <th>
                        <div id="MAR"></div>
                    </th>
                    <th>
                        <div id="MIE"></div>
                    </th>
                    <th>
                        <div id="JUE"></div>
                    </th>
                    <th>
                        <div id="VIE"></div>
                    </th>
                </tr>
            </tbody>
        </table>
</div>
</div>

<div id="rep" style="display: none">
</div>
<script>
    function vercruce() {
      /*  $semestre,
        $dia,
        $codcurso,
        $ciclo

        $.ajax({
            url: "admin/horariolista",
            success: function(result) {
                $("#listahorario").html(result);
            },
            data: {
                semestre: semestre,
                escuela: escuela
            },
            type: "GET"
        });*/
    }

    function verdias() {
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
