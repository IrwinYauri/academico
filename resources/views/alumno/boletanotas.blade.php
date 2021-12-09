@php
session_start();
$codalumno = '';
if (isset($_SESSION['alumnox'])) {
    $codalumno = $_SESSION['codalumnox'];
}
$semestreactual = semestreactual();
function versemestre($codalumno)
{
    $sql = "SELECT
semestre.sem_iCodigo
FROM
semestre
INNER JOIN matricula ON matricula.sem_iCodigo = semestre.sem_iCodigo
where matricula.alu_iCodigo='$codalumno'
GROUP BY  semestre.sem_iCodigo order by sem_iCodigo desc";
    $data = DB::select($sql);
    return $data;
}

function sqlvercursosalu($semestre, $codalu)
{
    $sql = "SELECT
matricula.alu_iCodigo,
matriculadetalle.sec_iCodigo,
seccion.cur_iCodigo,
curso.cur_vcCodigo,
curso.cur_vcNombre,
curso.cur_fCredito,
seccion.sem_iCodigo,
curso.cur_iSemestre,
seccion.sec_iNumero
FROM
matricula
INNER JOIN matriculadetalle ON matriculadetalle.mat_iCodigo = matricula.mat_iCodigo
INNER JOIN seccion ON matriculadetalle.sec_iCodigo = seccion.sec_iCodigo
INNER JOIN curso ON seccion.cur_iCodigo = curso.cur_iCodigo
WHERE matricula.alu_iCodigo='$codalu' AND
seccion.sem_iCodigo='$semestre'";
    $data1 = DB::select($sql);
    return $data1;
}
function datosalumno($codalumno)
{
    $sql = "SELECT
alumno.alu_iCodigo,
alumno.alu_vcCodigo,
alumno.alu_vcDocumento,
alumno.alu_vcPaterno,
alumno.alu_vcMaterno,
alumno.alu_vcNombre,
alumno.escpla_iCodigo,
escuelaplan.escpla_vcCodigo,
escuela.esc_vcNombre,
escuela.esc_vcCodigo
FROM
alumno
INNER JOIN escuelaplan ON alumno.escpla_iCodigo = escuelaplan.escpla_iCodigo
INNER JOIN escuela ON escuelaplan.esc_vcCodigo = escuela.esc_vcCodigo
WHERE alumno.alu_iCodigo='$codalumno'";
    $data = DB::select($sql);
    return $data;
}
$cursos = sqlvercursosalu($semestreactual, $codalumno);
$alumno = datosalumno($codalumno);
$sem = versemestre($codalumno);
$cod2 = $alumno[0]->alu_vcCodigo;
//dd($alumno);
@endphp
<style>
    .table {
        color: black;
    }

</style>
<div class="card">
    <div class="card-header bg-primary text-white">
        <table width="600px">
            <tr>
                <td style="color: white">
                    BOLETA DE NOTAS - SEMESTRE:
                    <select name="nsemestre" id="nsemestre" class="form-control "
                        onchange="vernotas(this.value,'{{ $codalumno }}','{{ $escuela = $alumno[0]->esc_vcCodigo }}','{{ $cod2 }}')">
                        @foreach ($sem as $data)
                            <option value="{{ $data->sem_iCodigo }}">{{ $data->sem_iCodigo }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
               
                        @csrf
                        <button input="button" class="btn btn-success" onclick="pruebaDivAPdf()"> IMPRIMIR </button>
                        <textarea name="imprimirx" id="imprimirx" style="display: none;">

              </textarea>
             
                </td>
            </tr>
        </table>
    </div>
    <div id="imprimir">
        <div class="card-body">

            <div class="row">
                <table  style="font-size:10px;width: 100%;border: 1px solid #000;">
                    <tr>
                        <td><img src=" {{ asset('img/escudo.png') }}" alt="" width="100"> </td>
                        <td><img src="http://app2.unaat.edu.pe/alumno/fotos/1_{{ $alumno[0]->alu_vcDocumento }}.jpg"
                                alt="" width="100"></td>
                    </tr>
                    <tr>
                        <td>SISTEMA ACADEMICO</td>
                        <td>{{ $dni = $alumno[0]->alu_vcDocumento }}</td>
                    </tr>
                </table>
            </div>
            <div class="text-center">
                <span class="badge badge-pill badge-dark" style="font-size: 14px;">
                    BOLETA DE NOTAS
                </span>
                <br><br>
            </div>
            <div class="row">
                <table class="table table-striped table-bordered table-sm " cellspacing="0" id="dataTable">
                    <tr>
                        <td>codigo:{{ $alumno[0]->alu_vcCodigo }}</td>
                        <td>Escuela Profesional:{{ $alumno[0]->esc_vcNombre }}</td>
                    </tr>
                    <tr>
                        <td>Ape. y Nombre:{{ $alumno[0]->alu_vcPaterno }} {{ $alumno[0]->alu_vcMaterno }}
                            {{ $alumno[0]->alu_vcNombre }}</td>
                        <td>Plan:RR-{{ $alumno[0]->escpla_vcCodigo }}</td>
                    </tr>
                </table>
            </div>

            <div id="detallex">

            </div>


            <div class="text-center">

                CREDITOS MATRICULADOS:<label id="micredito">.</label><br>
                PROMEDIO PONDERADO:<label id="miponderado">.</label>

                <br>

            </div>
            <center>
                @php
                    $dnif = $dni . '-' . $semestreactual . '-boleta';
                    echo "<img src='phpqrcode/mibarra2.php?numero=$dnif' width='120'>";
                @endphp
            </center>

        </div>
    </div>
</div>
<script src="{{ asset('jspdf/jspdf.min.js') }}"></script>
<script>
    function vernotas(semestre, codalumno, escuela, cod2) {
        $("#detallex").html('<img src="img/cargar.gif">');
        $.ajax({
            url: "alumno/boletanotasdetalle",
            success: function(result) {
                //  alert(result);
                $("#detallex").html(result);
                imprimir();
            },
            data: {
                semestre: semestre,
                codalumno: codalumno,
                escuela: escuela,
                cod2: cod2

            },
            type: "GET"
        });
    }
    vernotas('{{ $semestreactual }}', '{{ $codalumno }}', '{{ $codalumno }}', )

  /*  function imprimir() {
        var imprimir = $("#imprimir").html();
        $("#imprimirx").val(imprimir);

    }*/

    

    function pruebaDivAPdf() {
      var pdf = new jsPDF('p', 'pt', 'A4');
      source = $('#imprimir')[0];

      specialElementHandlers = {
          '#bypassme': function (element, renderer) {
              return true
          }
      };
      margins = {
          top: 80,
          bottom: 60,
          left: 40,
          width: 522
      };

      pdf.fromHTML(
          source, 
          margins.left, // x coord
          margins.top, { // y coord
              'width': margins.width, 
              'elementHandlers': specialElementHandlers
          },

          function (dispose) {
              pdf.save('Prueba.pdf');
          }, margins
      );
  }
  //  imprimir();
</script>
