
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

    </style>

<body>
    @php
        //    dd($listadocentes);
    @endphp


    <div class="container">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button"
                    role="tab" aria-controls="home" aria-selected="true" onclick="miaulas()">Lista de AULA</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                    type="button" role="tab" aria-controls="profile" aria-selected="false">Nuevo AULA</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
               <div id="miaula">
                @include('admin.listaaulatabla')
               </div>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <h3>Nuevo AULA</h3>
                  @include('admin.formularioaula')
                
            </div>
        </div>

    </div>




    <!-- Modal acctualizar -->
    <div class="modal fade" id="animal_edit_modal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Editar </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        onclick="$('#animal_edit_modal').modal('hide');">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="animal_edit_form">
                    <div class="modal-body">




                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"
                            onclick="$('#animal_edit_modal').modal('hide');">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    



   
</body>

</html>
<link rel="stylesheet" href="{{ asset('datatable/css/jquery.dataTables.min.css') }}">
<script src="{{ asset('datatable/js/jquery.dataTables.min.js') }}"></script>


<link rel="stylesheet" href="{{ asset('bootstrap5/css/bootstrap.min.css') }}">
<script src="{{ asset('bootstrap5/js/bootstrap.js') }}"></script>

<script>
     function miaulas(){
 
    $("#miaula").html("<img src='img/cargar.gif'>");
    $.ajax({
        url: "admin/listaaulatabla",
        success: function(result) {
           $("#miaula").html(result);
          },
        data: {
          
        },
        type: "GET"
    });

}
</script>