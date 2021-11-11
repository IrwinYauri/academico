@php
session_start();
$coddocentex = '';
if (isset($_SESSION['coddocentex'])) {
    $coddocentex = $_SESSION['coddocentex'];
}
else {
    return "no esta logeado";
}

use App\Http\Controllers\DocenteController;
$docente = new DocenteController();
$listacur = $docente->verrecord($coddocentex);
$semestre = $docente->verrecordgrupo($coddocentex);
$docentex = $docente->verprofe($coddocentex);

$datodoc = new DocenteController();
$verdocente = $datodoc->verdatosdocente($coddocentex);
$dni = '';
foreach ($verdocente as $vdocente) {
    $dni = $vdocente->doc_vcDocumento;
}

@endphp
<button onclick="back()">Volver</button>
<div id="imprimir" class="container">
    <div class="row">
        <!-- Border Left Utilities -->
        <div> Record Académico </div>
        <div> 
        @foreach ($docentex as $profe)
            <table>
                <tr>
                    <td>
                        @php
                            echo 'DOCENTE:' . $profe->doc_vcPaterno . ' ' . $profe->doc_vcMaterno . ' ' . $profe->doc_vcNombre;
                            echo '<br>DNI:' . $profe->doc_vcDocumento;
                        @endphp

                    </td>

                    <td>
                        <!--   fotodocente($dni,6); //-->
                    </td>

                </tr>
            </table>
        @endforeach
    </div>
    </div>



    <div class="row">

        @foreach ($semestre as $sem)
            <div class="card-header">
                Semestre: {{ left($sem->sem_iCodigo, 4) }}-{{ right($sem->sem_iCodigo, 1) }}
            </div>
            <div class="card-body">
                
                    <table class="table" cellspacing="0" id="dataTable">
                        <thead>
                            <tr style='background-color:navy;color:white;'>
                                <td>#</td>
                                <td>codigo</td>
                                <td>curso</td>
                                <td>EP</td>
                                <td>Escuela</td>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $n = 1;
                            @endphp
                            @foreach ($listacur as $cursos)
                                @if ($cursos->sem_iCodigo == $sem->sem_iCodigo)
                                    <tr>
                                        <td>{{ $n++ }}</td>
                                        <td>{{ $cursos->cur_vcCodigo }}</td>
                                        <td>{{ $cursos->cur_vcNombre }}</td>
                                        <td>{{ left($cursos->cur_vcCodigo, 2) }}</td>
                                        <td>{{ $cursos->escuela }}</td>
                                    </tr>
                                @endif

                            @endforeach

                        </tbody>
                    </table>

                
            </div>

        @endforeach
    </div>
</div>

<link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    <script src="{{ asset('jspdf/jspdf.min.js') }}"></script>
    <script>
        function pruebaDivAPdf() {
            var pdf = new jsPDF('l', 'pt', 'A4');
            source = $('#imprimir')[0];
    
            specialElementHandlers = {
                '#bypassme': function(element, renderer) {
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
    
                function(dispose) {
                    pdf.save('horario.pdf');
                }, margins
            );
        }
    </script>

<script>
    pruebaDivAPdf()
</script>

<script type="text/javascript">
    function back() {
        history.back();
    }
</script>


