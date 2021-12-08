
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <style>
        .table-condensed{
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
	background: rgba(0,0,0,0.8);
	z-index: 99999;
	opacity:0;
	-webkit-transition: opacity 400ms ease-in;
	-moz-transition: opacity 400ms ease-in;
	transition: opacity 400ms ease-in;
	pointer-events: none;
}
.modalDialog:target {
	opacity:1;
	pointer-events: auto;
}
.modalDialog > div {
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
	background: #606061;
	color: #FFFFFF;
	line-height: 25px;
	position: absolute;
	right: -12px;
	text-align: center;
	top: -10px;
	width: 24px;
	text-decoration: none;
	font-weight: bold;
	-webkit-border-radius: 12px;
	-moz-border-radius: 12px;
	border-radius: 12px;
	-moz-box-shadow: 1px 1px 3px #000;
	-webkit-box-shadow: 1px 1px 3px #000;
	box-shadow: 1px 1px 3px #000;
}
.close:hover { background: #00d9ff; }
      </style>
<body>

  <div id="openModal" class="modalDialog">
    <div>
        <a href="#close" title="Close" class="close">X</a>
        <h2>NUEVA CLAVE</h2>
        <div id="row">
            <input type="hidden" name="idcod1" id="idcod1"><br>
            <div id="nomalumno">USUARIO DE SISTEMA:</div>
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
        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Lista de cuenta de Sistema</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Nuevo cuenta de Sistema</button>
    </li>
    </ul>
    <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        <h3>Lista de cuentas de Sistema</h3>
       @include('admin.listausuariotabla')
    </div>
    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <h3>Nueva cuenta de Sistema</h3>
                          
        @include('admin.formulariousuario')
                
                </div> 
    </div>
    
    </div>






<!-- Modal Eliminar-->
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Eliminar - Confirmar</h5>
        <button type="button" class="close"  data-dismiss="modal" aria-label="Close" onclick="$('#confirmModal').modal('hide');">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      ¿Desea Eliminar el registro seleccionado?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$('#confirmModal').modal('hide');">Cancelar</button>
        <button type="button" class="btn btn-danger" name="btnEliminar" id="btnEliminar">Eliminar</button>
      </div>
    </div>
  </div>
</div>
</div><!-- //fin container //-->



<script>
  function editarAnimal(id){
 /* $.get('admin/docente/'+id,function(animal){
    $('#txtId2').val(animal[0].id);
    $('#txtNombre2').val(animal[0].nombre);
    $('#selEspecie2').val(animal[0].especie);
    //$('#rbGenero2').val(animal[0].genero);
    if(animal[0].genero=="Macho"){
      $('input[name=rbGenero2][value="Macho"]').prop('checked',true);
    }
    if(animal[0].genero=="Hembra"){
      $('input[name=rbGenero2][value="Hembra"]').prop('checked',true);
    }
    $("input[name=_token]").val();

      $('#animal_edit_modal').modal("toggle");
   });   */
  }
</script>





</body>
</html>

<link rel="stylesheet" href="{{ asset('bootstrap5/css/bootstrap.min.css') }}">
<script src="{{ asset('bootstrap5/js/bootstrap.js') }}"></script>
