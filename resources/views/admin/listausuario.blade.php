@php
use App\Http\Controllers\AdminController; 
$listausuarios=new AdminController();
$listausuario=$listausuarios->verusuarios();

@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.0/datatables.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script> //-->
    <script src="https://code.jquery.com/jquery-3.4.0.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.0/datatables.min.js"></script>
    
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
    
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
    @php
   //    dd($listadocentes); 
    @endphp
       
       <a href="#openModal">Lanzar el modal</a>

       <div id="openModal" class="modalDialog">
         <div>
           <a href="#close" title="Close" class="close">X</a>
           <h2>Mi modal</h2>
           <p>Este es un ejemplo de modal, creado gracias al poder de CSS3.</p>
           <p>Puedes hacer un montón de cosas aquí, como alertas o incluso crear un formulario de registro aquí mismo.</p>
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
        <table id="tabla-docente" class="table table-hover table-condensed">
        <thead>
            <td>ID</td>
            <td>Cuenta</td>
            <td>Nombre</td>
            <td>Apellido</td>
            <td>clave</td>
            <td>GENERO</td>
            <td>ACCIONES</td>
        </thead>
        <tbody>
       @foreach ($listausuario as $usu)
    
       <tr>
            <td>{{ $usu->usu_iCodigo }}</td>
            <td>{{ $usu->usu_vcUsuario }}</td>
            <td>{{$usu->usr_vcNombre}}</td>
            <td>{{$usu->usu_vcApellido}}</td>
            <td>{{$usu->usu_vcClave}}</td>
            <td>GENERO</td>
            <td><a href="javascript:void(0)" onclick="editarAnimal('.$animales->id.')" class="btn btn-info btn-sm table-condensed"> Editar </a>
                &nbsp;&nbsp;<button type="button" name="delete" id="'.$animales->id.'" class="delete btn btn-danger btn-sm table-condensed"> Eliminar </button>
            </td>
           </tr>
        @endforeach  
        </tbody>
        </table>
    </div>
    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <h3>Nueva cuenta de Sistema</h3>
                          
                  <div class="card">
                  
                    <form action="regtablacampo.php" class="was-validated">
                      <input type="hidden" value="seg_usuario" name="n">
                    
                    <div class="form-group">
                    <label for="usu_iCodigo">usu_iCodigo</label>
                    <input type="text" class="form-control" id="usu_iCodigo" placeholder="usu_iCodigo" name="usu_iCodigo" required="">
                    <!-- <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div> //-->
                    </div>
                         
                      
                    <div class="form-group">
                    <label for="usu_vcUsuario">usu_vcUsuario</label>
                    <input type="text" class="form-control" id="usu_vcUsuario" placeholder="usu_vcUsuario" name="usu_vcUsuario" required="">
                    <!-- <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div> //-->
                    </div>
                         
                      
                    <div class="form-group">
                    <label for="usu_vcPassword">usu_vcPassword</label>
                    <input type="text" class="form-control" id="usu_vcPassword" placeholder="usu_vcPassword" name="usu_vcPassword" required="">
                    <!-- <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div> //-->
                    </div>
                         
                      
                    <div class="form-group">
                    <label for="usr_vcNombre">usr_vcNombre</label>
                    <input type="text" class="form-control" id="usr_vcNombre" placeholder="usr_vcNombre" name="usr_vcNombre" required="">
                    <!-- <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div> //-->
                    </div>
                         
                      
                    <div class="form-group">
                    <label for="usu_vcApellido">usu_vcApellido</label>
                    <input type="text" class="form-control" id="usu_vcApellido" placeholder="usu_vcApellido" name="usu_vcApellido" required="">
                    <!-- <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div> //-->
                    </div>
                         
                      
                    <div class="form-group">
                    <label for="usu_vcClave">usu_vcClave</label>
                    <input type="text" class="form-control" id="usu_vcClave" placeholder="usu_vcClave" name="usu_vcClave" required="">
                    <!-- <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div> //-->
                    </div>
                         
                      
                    <button type="submit" class="btn btn-primary">Registrar</button></form>
                    </div>
                
                </div> 
    </div>
    
    </div>




<!-- Modal acctualizar -->
<div class="modal fade" id="animal_edit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Editar cuenta de Sistema</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="$('#animal_edit_modal').modal('hide');">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="animal_edit_form">
      <div class="modal-body">
      
                  @csrf
                  <input type="hidden" name="txtId2" id="txtId2">
             
                  --
                  <div class="card">
                    <h2>cuenta de Sistema</h2>
                    <form action="regtablacampo.php" class="was-validated">
                      <input type="hidden" value="seg_usuario" name="n">
                    
                    <div class="form-group">
                    <label for="usu_iCodigo">usu_iCodigo</label>
                    <input type="text" class="form-control" id="usu_iCodigo" placeholder="usu_iCodigo" name="usu_iCodigo" required="">
                    <!-- <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div> //-->
                    </div>
                         
                      
                    <div class="form-group">
                    <label for="usu_vcUsuario">usu_vcUsuario</label>
                    <input type="text" class="form-control" id="usu_vcUsuario" placeholder="usu_vcUsuario" name="usu_vcUsuario" required="">
                    <!-- <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div> //-->
                    </div>
                         
                      
                    <div class="form-group">
                    <label for="usu_vcPassword">usu_vcPassword</label>
                    <input type="text" class="form-control" id="usu_vcPassword" placeholder="usu_vcPassword" name="usu_vcPassword" required="">
                    <!-- <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div> //-->
                    </div>
                         
                      
                    <div class="form-group">
                    <label for="usr_vcNombre">usr_vcNombre</label>
                    <input type="text" class="form-control" id="usr_vcNombre" placeholder="usr_vcNombre" name="usr_vcNombre" required="">
                    <!-- <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div> //-->
                    </div>
                         
                      
                    <div class="form-group">
                    <label for="usu_vcApellido">usu_vcApellido</label>
                    <input type="text" class="form-control" id="usu_vcApellido" placeholder="usu_vcApellido" name="usu_vcApellido" required="">
                    <!-- <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div> //-->
                    </div>
                         
                      
                    <div class="form-group">
                    <label for="usu_vcClave">usu_vcClave</label>
                    <input type="text" class="form-control" id="usu_vcClave" placeholder="usu_vcClave" name="usu_vcClave" required="">
                    <!-- <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div> //-->
                    </div>
                         
                      
                    <button type="submit" class="btn btn-primary">Registrar</button></form>
                    </div></div>   
                   --
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$('#animal_edit_modal').modal('hide');">Cancelar</button>
        <button type="submit" class="btn btn-primary">Actualizar</button>
      </div>
      </form>
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
  $('#registro-animal').submit(function(e){
      e.preventDefault();
      
      var nombre=$('#txtNombre').val();
      var especie=$('#selEspecie').val();
      var genero=$("input[name='rbGenero']:checked").val();
      var _token=$("input[name=_token]").val();

      $.ajax({
          url:"{{ route('admin.registrardocente') }}",
          type:"POST",
          data:{
            nombre:nombre,
            especie:especie,
            genero:genero,
            _token:_token
          },
          
          success:function(response){
            if(response){
              $('#registro-animal')[0].reset();
              toastr.success('El registro se agrego','Nuevo Registro',{timeOut:3000});
               $('#tabla-animal').DataTable().ajax.reload();
                        
            }
          }
      });
    });  
</script>
<script>
  var ani_id;
  $(document).on('click','.delete',function(){
    ani_id=$(this).attr('id');
    $('#confirmModal').modal('show');
  });
  $('#btnEliminar').click(function(){
$.ajax({
  url:"admin/eliminardocente/"+ani_id,
  beforeSend:function(){
    $('#btnEliminar').text('Eliminado ...');
  },
  success:function(data){
    setTimeout(function(){
$('#confirmModal').modal('hide');
toastr.warning('El registro Fue Elimino ','Eliminar Registro',{timeOut:3000});
$('#tabla-animal').DataTable().ajax.reload();
    },1000);
    $('#btnEliminar').text('Eliminar');
  }
}); 
 });
</script>
<script>
  function editarAnimal(id){
  $.get('admin/docente/'+id,function(animal){
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
   });
  }
</script>
<script>
  $('#animal_edit_form').submit(function(e){
    e.preventDefault();
    var id2=$('#txtId2').val();
    var nombre2=$('#txtNombre2').val();
    var especie2=$('#selEspecie2').val();
    var genero2=$("input[name='rbGenero2']:checked").val();
    var _token2=$("input[name=_token]").val();

    $.ajax({
      url:"{{ route('admin.actualizardocente') }}",
      type:"POSt",
      data:{
        id:id2,
        nombre:nombre2,
        especie:especie2,
        genero:genero2,
        _token:_token2
      },
      success:function(response){
        if(response){
          $('#animal_edit_modal').modal('hide');
          toastr.info('El registro fue actualizado correctamente.','Actualizacion Completada',{timeOut:3000});
          $('#tabla-animal').DataTable().ajax.reload();
        }
      }
    });

  });
</script>

<script>
    $(document).ready(function() {
   
   $('#tabla-docente').DataTable();
} );
 
  
</script>


</body>
</html>