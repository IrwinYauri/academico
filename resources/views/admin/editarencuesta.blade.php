@php
//namespace App\Http\Controllers;
//use App\Http\Controllers\AdminController;
//$encuesta=new AdminController();
//$encuestax=$encuesta->verlistaencuesta();

use App\Models\Encuesta;
use App\Models\Semestre;

$encuestax = Encuesta::all();

@endphp

<link rel="icon" href=" {{ asset('img/escudo.png') }}" type="image/png" />
<link href=" {{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">


<!-- Custom styles for this template-->
<link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/seleccion.css') }}" rel="stylesheet" type="text/css">
<style>
    .separaconte {
        margin: 5px;
        overflow: hidden;
        border: 1px solid #ccc;
        background-color: #f1f1f1;
    }

    .table-condensed {
        font-size: 12px;
        color: black;
    }

</style>

<body>
   
    <div class="container">

        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#home" class="separaconte btn">LISTA DE ENCUESTAS</a>
            </li>
            <li><a data-toggle="tab" href="#menu1" class="separaconte btn">PREGUNTAS</a></li>
            <li ><a data-toggle="tab" href="#menu2" class="separaconte btn" onclick="verhistorial2()">REGISTRO PROFESORES ENCUESTADOS</a></li>
            <li><a data-toggle="tab" href="#menu3" class="separaconte btn" onclick="vercate2()">LISTA CATEGORIA</a></li>
        </ul>

        <div class="tab-content">
            <div id="home" class="tab-pane fade show active">
                @include('admin.encuestalista')
            </div>

            <div id="menu1" class="tab-pane fade">
                <!-- config encuetra //-->
                <div class="panel panel-primary">
                    <div class="card-header py-3 bg-primary">
                        <h6 class="m-0 font-weight-bold text-white">

                            <i class="fa fa-question-circle"></i> Lista de PREGUNTAS
                        </h6>
                    </div>

                </div>

                <div class="card-body bg-white">
                    SELECCIONAR PERIODO:
                    <select name="" id="xxsemetre" onchange="listaencuestapreguntasemestre(this.value)">
                        @foreach ($encuestax as $encu)

                            <option>{{ $encu->sem_iCodigo }}</option>

                        @endforeach
                    </select>
                    <div id="tcategoria">
                        lista de categorias
                    </div>
                    <div id="tpreguntas">

                    </div>

                </div>
                <!-- fin config//-->
            </div>

            <div id="menu2" class="tab-pane fade">
                
                <div class="container" id="encuestahistorial">
                    @include('admin.encuestadocentehistorial')
                </div>
                
            </div>

            <div id="menu3" class="tab-pane fade">
                <div class="container" id="encuestacategoria1">
                @include('admin.encuestacategoria')
                </div>
            </div>
        </div>
    </div>




</body>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fa fa-book fa-2x"></i> Lista de Encuesta
                </h6>
            </div>
            <div class="modal-body">
                <div id="mirespuesta">
                    <p>- Respuesta 1:<i class="fa fa-check-square"></i></p>
                    <p>- Respuesta 2:<i class="fa fa-close"></i></p>
                    <p>- Respuesta 3:<i class="fa fa-close"></i></p>
                    <p>- Respuesta 4:<i class="fa fa-check-square"></i></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" onclick="volver()">CERRAR</button>
            </div>
        </div>

    </div>
</div>


<div id="mimensajex">GRABANDO</div>

<script>
    function vercate2()
    {$('#encuestahistorial').hide();
    $('#encuestacategoria1').show();

    }
    function verhistorial2(){
    $('#encuestahistorial').show();
    $('#encuestacategoria1').hide();   
    }
</script>

<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
