@php
//use App\Http\Controllers\AdminController;
//$listaalumnos=new AdminController();
//$listaalumno=$listaalumnos->veralumno();
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>


    <style>
        .table-condensed {
            font-size: 10px;
            color: black;
        }

        .modalDialog {
            position: fixed;
            font-family: Arial, Helvetica, sans-serif;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background: rgba(7, 153, 68, 0.61);
            z-index: 99999;
            opacity: 0;
            -webkit-transition: opacity 400ms ease-in;
            -moz-transition: opacity 400ms ease-in;
            transition: opacity 400ms ease-in;
            pointer-events: none;
        }

        .modalDialog:target {
            opacity: 1;
            pointer-events: auto;
        }

        .modalDialog>div {
            width: 400px;
            position: relative;
            margin: 10% auto;
            padding: 5px 20px 13px 20px;
            border-radius: 10px;
            background: #fff;
            background: -moz-linear-gradient(#fff, rgb(87, 207, 117));
            background: -webkit-linear-gradient(#fff, rgb(12, 104, 61));
            background: -o-linear-gradient(#fff, rgb(82, 145, 63));
            -webkit-transition: opacity 400ms ease-in;
            -moz-transition: opacity 400ms ease-in;
            transition: opacity 400ms ease-in;
        }

        .close {
            background: #d3411c;
            color: #FFFFFF;
            line-height: 25px;
            position: absolute;
            right: 0px;
            text-align: center;
            top: 0px;
            width: 44px;
            text-decoration: none;
            font-weight: bold;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            -moz-box-shadow: 1px 1px 3px #000;
            -webkit-box-shadow: 1px 1px 3px #000;
            box-shadow: 1px 1px 3px #000;
        }

        .close:hover {
            background: #f30d0d;
        }

    </style>

<body>
    @php
        //    dd($listadocentes);
    @endphp

    <div id="openModal" class="modalDialog">
        <div>
            <a href="#close" title="Close" class="close">X</a>
            <h2>NUEVA CLAVE</h2>
            <div id="row">
                <input type="hidden" name="idcod1" id="idcod1"><br>
                <div id="nomalumno">Docente:</div>
                <input type="text" name="idclave1" id="idclave1"><br>
                <a name="bclava1" id="bclava1" class="btn btn-primary btn-sm" href="#close"
                    onclick="crearcambio('idcod1','idclave1')">
                    Modificar
                </a>
                <a name="bclava1" id="bclava1" class="btn btn-danger btn-sm" href="#close">
                    Cancelar
                </a>
            </div>
        </div>
    </div>


    <div class="container">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button"
                    role="tab" aria-controls="home" aria-selected="true"
                    onclick="verlistax()">Lista de Alumno</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                    type="button" role="tab" aria-controls="profile" aria-selected="false" onclick="verformularioalumno()">Nuevo Alumno</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="rematricula-tab" data-bs-toggle="tab" data-bs-target="#rematricula"
                    type="button" role="tab" aria-controls="profile" aria-selected="false">MATRICULAS/RESERVAS</button>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div id="xlistaalumno" >
                        @include('admin.listaalumnotabla')
                    </div>
               

            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <h3>Nuevo Alumno</h3>

                <div class="card">
                    <div id="fomularioalumno">
                    @include('admin.formularioalumno')
                    </div>
                </div>

            </div>

            <div class="tab-pane fade" id="rematricula" role="tabpanel" aria-labelledby="rematricula-tab">
                <h3>RESERVAR MATRICULA</h3>

                <div class="card">
                    include('admin.matricula')

                </div>

            </div>

        </div>


        <!---  inicio de modal //-->
        <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: navy;color:white;">
                        <h5 class="modal-title" id="exampleModalLabel">Eliminar - Confirmar</h5>
                        <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close"
                            onclick="$('#confirmModal').modal('hide');">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="xcodalu" id="xcodalu"><br>
                        <b>ALUMNO: </b><label id="xalumno1"></label><br>
                        ¿Desea Eliminar el registro seleccionado?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"
                            onclick="$('#confirmModal').modal('hide');">Cancelar</button>
                        <button type="button" class="btn btn-danger" name="btnEliminar" id="btnEliminar"
                            onclick="eliminardocente()">Eliminar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal cursos -->
        <!---  editar alumno//-->
        <div class="modal fade bd-example-modal-lg" id="modaleditar" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: navy;color:white">
                        <h5 class="modal-title" id="exampleModalLabel">ACTUALIZAR DATOS DEL ALUMNO</h5>
                        <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close"
                            onclick="$('#modaleditar').modal('hide');">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="listalumnomodal">
                        include('admin.formularioalumnoeditar')
                         </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"
                            onclick="$('#modaleditar').modal('hide');">Cancelar</button>

                    </div>
                </div>
            </div>
        </div>
        <!-- Modal fin de modal-->
        <div id="mimensajex">GRABANDO</div>



    </div>

    <link rel="stylesheet" href="{{ asset('datatable/css/jquery.dataTables.min.css') }}">
    <script src="{{ asset('datatable/js/jquery.dataTables.min.js') }}"></script>

    <script>
        function verclave(n1, alumno) {
            $('#idcod1').val(n1);
            $('#nomalumno').html("ALUMNO:" + alumno);

            // cambiarpassworddocente(cod,clave);
        }

        function crearcambio(n1, n2) {
            cod = document.getElementById(n1).value;
            clave = document.getElementById(n2).value;
            cambiarpasswordalumno(cod, clave);
            //     cambiarpassworddocente(cod,clave);
        }
        function verlistax()
{$("#xlistaalumno").html("...Cargando");
    $("#xlistaalumno").load('admin/listaalumnotabla');

}        
function verformularioalumno()
{$("#fomularioalumno").html("...Cargando");
    $("#fomularioalumno").load('admin/formularioalumno');

}        
    </script>
</body>

</html>


<link rel="stylesheet" href="{{ asset('bootstrap5/css/bootstrap.min.css') }}">
<script src="{{ asset('bootstrap5/js/bootstrap.js') }}"></script>
