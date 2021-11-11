@php

session_start();
$coddocentex = '';
if (isset($_SESSION['coddocentex'])) {
    $coddocentex = $_SESSION['coddocentex'];
    $nombredoc = $_SESSION['docentex'];
} else {
    return '::No logeado::';
}
use App\Http\Controllers\DocenteController;
$mihoras = new DocenteController();
//$listahora= $mihoras->vercargahoraria(51,20212)
$listahora = $mihoras->vercargahoraria($coddocentex, 20212);
@endphp

<head>
    <title>Horarios</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<style>
    .table-condensed {
        font-size: 10px;
        color: black;
    }

</style>

<div id="imprimir">
    <link rel="icon" href=" {{ asset('img/escudo.png') }}" type="image/png" />
    <link href=" {{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    <script src="{{ asset('jspdf/jspdf.min.js') }}"></script>


    <div class=" table-condensed">
        <!-- <img src='asset('img/escudo.png')'  width='50' height='68' /> //-->
        <!--  <img src="img/escudo.png" alt="" width='50' height='68'> //-->

        <i class="fa fa-calendar fa-2x"></i> CARGA HORARIA

    </div>
    <div>
        <h3>DOCENTE:{{ $nombredoc }}</h3>
        <table class=' table-condensed something'>
            <thead>
                <tr style='background-color:royalblue;color:white;'>
                    <th>Nro</th>
                    <th>Grupo</th>
                    <th>Día</th>
                    <th>Tipo</th>
                    <th>Inicio</th>
                    <th>Final</th>
                    <th>Aula</th>
                    <th>Turno</th>
                    <th>Local</th>
                    <th>Codigo</th>
                    <th>Curso</th>
                    <th>EP</th>
                    <th>Escuela</th>
                    @php
                        $n = 0;
                    @endphp
                </tr>
            </thead>
            @foreach ($listahora as $horario)
                @php
                    $n++;
                    
                @endphp
                <tr style="color:#505050">
                    <td>{{ $n }}</td>
                    <td>{{ $horario->sec_iNumero }}</td>
                    <td>{{ $horario->dia_vcCodigo }}</td>
                    <td>{{ $horario->tipodictado }}</td>
                    <td>{{ $horario->sechor_iHoraInicio }}</td>
                    <td>{{ $horario->sechor_iHoraFinal }}</td>
                    <td>{{ $horario->aul_vcCodigo }}</td>
                    <td>{{ $horario->tur_cCodigo }}</td>
                    <td>{{ $horario->loc_vcNombre }}</td>
                    <td>{{ $horario->cur_vcCodigo }}</td>
                    <td>{{ $horario->cur_vcNombre }}</td>
                    <td>{{ $horario->esc_vcCodigo }}</td>
                    <td>{{ $horario->esc_vcNombre }}</td>

                </tr>

            @endforeach
        </table>

    </div>
</div>

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
                pdf.save('Prueba.pdf');
            }, margins
        );
    }
</script>


<script>
    pruebaDivAPdf()
</script>

<script type="text/javascript">
  function back(){
    history.back();
  }
</script>

<button onclick="back()">Volver</button>