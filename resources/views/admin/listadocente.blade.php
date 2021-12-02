@php

@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LISTA DOCENTES</title>




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
            background: rgba(0, 0, 0, 0.8);
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
            background: -moz-linear-gradient(#fff, #999);
            background: -webkit-linear-gradient(#fff, #999);
            background: -o-linear-gradient(#fff, #999);
            -webkit-transition: opacity 400ms ease-in;
            -moz-transition: opacity 400ms ease-in;
            transition: opacity 400ms ease-in;
        }

        .close {
            background: #ff0000;
            color: #FFFFFF;
            line-height: 25px;
            position: absolute;
            right: 0px;
            text-align: center;
            top: 0px;
            width: 60px;
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
            background: #4b0606;
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
            <form action="">
                <input type="hidden" name="idcod1" id="idcod1"><br>
                <div id="nomdocente">Docente:</div>
                <input type="text" name="idclave1" id="idclave1"><br>
                <a name="bclava1" id="bclava1" class="btn btn-primary btn-sm" href="#close"
                    onclick="crearcambio('idcod1','idclave1')">
                    Modificar
                </a>
                <a name="bclava1" id="bclava1" class="btn btn-danger btn-sm" href="#close">
                    Cancelar
                </a>
            </form>
        </div>
    </div>


    <div class="container">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button"
                    role="tab" aria-controls="home" aria-selected="true" onclick="verlistadocentetabla()">Lista de Docente</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                    type="button" role="tab" aria-controls="profile" aria-selected="false">Nuevo Docente</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#semestreactual"
                    type="button" role="tab" aria-controls="semestreactual" aria-selected="false"
                    onclick="verlistasementredoc()">
                    VER DOCENTES ACTIVOS</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <h3>Lista de Docente</h3>


                @include('admin.listadocentetabla')
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <h3>Nuevo Docente</h3>

                <div class="container">

                    @include('admin.formulariodocente')

                </div>

            </div>

            <div class="tab-pane fade" id="semestreactual" role="tabpanel" aria-labelledby="semestreactual-tab">

                <div id="milistasemestre" style="display: none">
                    ...cargando
                    include('admin.listadocentesemestre')
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
                        <input type="hidden" name="xxcod" id="xxcod"><br>
                        <b>Docente: </b><label id="xdocente1"></label><br>
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
        <!---  nuevo pass//-->
        <div class="modal fade bd-example-modal-lg" id="modaleditar" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: navy;color:white">
                        <h5 class="modal-title" id="exampleModalLabel">ACTUALIZAR DATOS DEL DOCENTE</h5>
                        <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close"
                            onclick="$('#modaleditar').modal('hide');">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @include('admin.formulariodocenteedit')
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



    </div><!-- //fin container //-->

    <!-- Modal cursos -->

    <div id="openModalcursos" class="modalDialog">
        <div style="width: 600">
            <a href="#close" title="Close" class="close">X</a>
            <h2>Lista de cursos a cargo</h2>
            <form action="">
                <div id="nomdocentex">Docente:</div>
                <div id="listacursos" class="container">
                    ... cargando
                </div>



            </form>
        </div>
    </div>
    <!-- fin cursos //-->


  
   


    <link rel="stylesheet" href="{{ asset('datatable/css/jquery.dataTables.min.css') }}">
    <script src="{{ asset('datatable/js/jquery.dataTables.min.js') }}"></script>




    <script>
        function verclave(n1, docente) {
            $('#idcod1').val(n1);
            $('#nomdocente').html("DOCENTE:" + docente);

        }

        function crearcambio(n1, n2) {
            cod = document.getElementById(n1).value;
            clave = document.getElementById(n2).value;
            cambiarpassworddocente(cod, clave);
        }

        function versilabuscursos(docente, coddocente, semestre) {

            $('#nomdocentex').html("DOCENTE:" + docente);
            // alert(docente)
            $("#listacursos").html("...cargando");
            $.ajax({
                url: "admin/listadocentesilabu",
                success: function(result) {
                    //   alert(result);
                    $("#listacursos").html(result);
                },
                data: {
                    coddocente: coddocente,
                    semestre: semestre
                },
                type: "GET"
            });


        }
    </script>

    <link rel="stylesheet" href="{{ asset('bootstrap5/css/bootstrap.min.css') }}">
    <script src="{{ asset('bootstrap5/js/bootstrap.js') }}"></script>

    <script>
        function nbuscardocente(coddocente) {

            //$("#listacursos").html("...cargando");
            $.ajax({
                url: "crud/buscardocente",
                success: function(result) {
                    //   alert(result);
                    $("#modaleditar").modal('show');

                    $("#divprueba").html(result);

                    //  $('a[href="#profile"]').tabs('show');
                    //   $('#home').hide();

                },
                data: {
                    doc_iCodigo: coddocente
                },
                type: "GET"
            });


        }

        function verlistasementredoc() //panel tabpage
        {
            $('#milistasemestre').show();
            $('#milistasemestre').html("...cargando");
            $.ajax({
                url: "admin/listadocentesemestre",
                success: function(result) {

                    $("#milistasemestre").html(result);
                },
                data: {

                },
                type: "GET"
            });

        }

        function verlistadocentetabla() //panel tabpage
        {
          //  $('#milistasemestre').show();
          //  $('#milistasemestre').html("...cargando");
            $.ajax({
                url: "admin/listadocentetabla",
                success: function(result) {

                    $("#home").html(result);
                },
                data: {

                },
                type: "GET"
            });

        }

        function vereliminarx(codigo, nombre) {
            $("#xxcod").val(codigo);
            $("#xdocente1").html(nombre);
        }

        function eliminardocente() {
            cod = $("#xxcod").val()
            //   alert(cod)



            $.ajax({
                url: "crud/eliminardocente",
                success: function(result) {
                    //  alert(result);
                    $("#divprueba").html(result);
                    $('#confirmModal').modal('hide');
               //     $('#home').load('admin/listadocentetabla');
               verlistadocentetabla() ;
                    alertagrabarx("PROCESO COMPLETADO","#301934");
                },
                data: {
                    coddocente: cod
                },
                type: "GET"
            });



        }
    </script>

    <div id="divprueba" style="display: none"></div>
</body>

</html>
