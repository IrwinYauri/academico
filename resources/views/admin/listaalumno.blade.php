@php
use App\Http\Controllers\AdminController; 
$listaalumnos=new AdminController();
$listaalumno=$listaalumnos->veralumno();

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
	background: rgba(7, 153, 68, 0.61);
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
	background: -moz-linear-gradient(#fff, rgb(87, 207, 117));
	background: -webkit-linear-gradient(#fff, rgb(12, 104, 61));
	background: -o-linear-gradient(#fff, rgb(82, 145, 63));
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
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;
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
       
       <div id="openModal" class="modalDialog">
        <div>
          <a href="#close" title="Close" class="close">X</a>
          <h2>NUEVA CLAVE</h2>
              <div id="row">
              <input type="hidden" name="idcod1" id="idcod1" ><br>
              <div id="nomalumno">Docente:</div>
              <input type="text" name="idclave1" id="idclave1" ><br>
              <a  name="bclava1" id="bclava1" class="btn btn-primary btn-sm" href="#close" onclick="crearcambio('idcod1','idclave1')">
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
        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Lista de Alumno</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Nuevo Alumno</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">MATRICULAS/RESERVAS</button>
  </li>
    </ul>
    <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        <h3>Lista de Alumno</h3>
        <table id="tabla-docente" class="table table-hover table-condensed">
        <thead>
            <td>ID</td>
            <td>alu_vcDocumento</td>
            <td>alu_vcPaterno</td>
            <td>alu_vcMaterno</td>
            <td>alu_vcNombre</td>
            <td>foto</td>
            <td>ACCIONES</td>
        </thead>
        <tbody>
       @foreach ($listaalumno as $alu)
    
       <tr>
            <td>{{ $alu->alu_iCodigo }}</td>
            <td>{{ $alu->alu_vcDocumento }}</td>
            <td>{{$alu->alu_vcPaterno}}</td>
            <td>{{$alu->alu_vcMaterno}}</td>
            <td>{{$alu->alu_vcNombre}}</td>
            @php
                $url="http://app2.unaat.edu.pe/alumno/fotos/1_".$alu->alu_vcDocumento.".jpg"; 
               
            @endphp
           
            <td> <img src="{{ $url }}" alt="" width="50"> 
             </td>
        <!--      <td> <img src=" asset('fotos/1_'.$alu->alu_vcDocumento.'.jpg')}}" alt="" width="50">  /-->
             </td>
            
            <td>
              <a name="bclave" id="x1" class="btn btn-primary btn-sm table-condensed" href="#openModal" 
              onclick="verclave('{{  $alu->alu_iCodigo }}','{{ $alu->alu_vcPaterno}} {{$alu->alu_vcPaterno }} {{$alu->alu_vcNombre }}')">Cambiar clave </a>

              <a href="javascript:void(0)" onclick="editarAnimal('.$animales->id.')" class="btn btn-info btn-sm table-condensed"> Editar </a>
                &nbsp;&nbsp;<button type="button" name="delete" id="'.$animales->id.'" class="delete btn btn-danger btn-sm table-condensed"> Eliminar </button>
            </td>
           </tr>
        @endforeach  
        </tbody>
        </table>
    </div>
    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <h3>Nuevo Alumno</h3>
                          
                  <div class="card">
                  
                    <form action="regtablacampo.php" class="was-validated">
                      <input type="hidden" value="alumno" name="n">
                    
                    <div class="form-group">
                    <label for="alu_iCodigo">alu_iCodigo</label>
                    <input type="text" class="form-control" id="alu_iCodigo" placeholder="alu_iCodigo" name="alu_iCodigo" required>
                    <!-- <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div> //-->
                    </div>
                         
                      
                    <div class="form-group">
                    <label for="alu_vcCodigo">alu_vcCodigo</label>
                    <input type="text" class="form-control" id="alu_vcCodigo" placeholder="alu_vcCodigo" name="alu_vcCodigo" required>
                    <!-- <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div> //-->
                    </div>
                         
                      
                    <div class="form-group">
                    <label for="alu_vcDocumento">alu_vcDocumento</label>
                    <input type="text" class="form-control" id="alu_vcDocumento" placeholder="alu_vcDocumento" name="alu_vcDocumento" required>
                    <!-- <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div> //-->
                    </div>
                         
                      
                    <div class="form-group">
                    <label for="alu_vcPaterno">alu_vcPaterno</label>
                    <input type="text" class="form-control" id="alu_vcPaterno" placeholder="alu_vcPaterno" name="alu_vcPaterno" required>
                    <!-- <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div> //-->
                    </div>
                         
                      
                    <div class="form-group">
                    <label for="alu_vcMaterno">alu_vcMaterno</label>
                    <input type="text" class="form-control" id="alu_vcMaterno" placeholder="alu_vcMaterno" name="alu_vcMaterno" required>
                    <!-- <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div> //-->
                    </div>
                         
                      
                    <div class="form-group">
                    <label for="alu_vcNombre">alu_vcNombre</label>
                    <input type="text" class="form-control" id="alu_vcNombre" placeholder="alu_vcNombre" name="alu_vcNombre" required>
                    <!-- <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div> //-->
                    </div>
                         
                      
                    <div class="form-group">
                    <label for="escpla_iCodigo">escpla_iCodigo</label>
                    <input type="text" class="form-control" id="escpla_iCodigo" placeholder="escpla_iCodigo" name="escpla_iCodigo" required>
                    <!-- <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div> //-->
                    </div>
                         
                      
                    <div class="form-group">
                    <label for="alu_vcPassword">alu_vcPassword</label>
                    <input type="text" class="form-control" id="alu_vcPassword" placeholder="alu_vcPassword" name="alu_vcPassword" required>
                    <!-- <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div> //-->
                    </div>
                         
                      
                    <div class="form-group">
                    <label for="escpla_iNotas">escpla_iNotas</label>
                    <input type="text" class="form-control" id="escpla_iNotas" placeholder="escpla_iNotas" name="escpla_iNotas" required>
                    <!-- <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div> //-->
                    </div>
                         
                      
                    <div class="form-group">
                    <label for="escpla_iCreditos">escpla_iCreditos</label>
                    <input type="text" class="form-control" id="escpla_iCreditos" placeholder="escpla_iCreditos" name="escpla_iCreditos" required>
                    <!-- <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div> //-->
                    </div>
                         
                      
                    <div class="form-group">
                    <label for="escpla_iPuntaje">escpla_iPuntaje</label>
                    <input type="text" class="form-control" id="escpla_iPuntaje" placeholder="escpla_iPuntaje" name="escpla_iPuntaje" required>
                    <!-- <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div> //-->
                    </div>
                         
                      
                    <div class="form-group">
                    <label for="escpla_fPromedio">escpla_fPromedio</label>
                    <input type="text" class="form-control" id="escpla_fPromedio" placeholder="escpla_fPromedio" name="escpla_fPromedio" required>
                    <!-- <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div> //-->
                    </div>
                         
                      
                    <div class="form-group">
                    <label for="alu_cSexo">alu_cSexo</label>
                    <input type="text" class="form-control" id="alu_cSexo" placeholder="alu_cSexo" name="alu_cSexo" required>
                    <!-- <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div> //-->
                    </div>
                         
                      
                    <div class="form-group">
                    <label for="alu_dFechaNacimiento">alu_dFechaNacimiento</label>
                    <input type="text" class="form-control" id="alu_dFechaNacimiento" placeholder="alu_dFechaNacimiento" name="alu_dFechaNacimiento" required>
                    <!-- <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div> //-->
                    </div>
                         
                      
                    <div class="form-group">
                    <label for="alucon_iCodigo">alucon_iCodigo</label>
                    <input type="text" class="form-control" id="alucon_iCodigo" placeholder="alucon_iCodigo" name="alucon_iCodigo" required>
                    <!-- <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div> //-->
                    </div>
                         
                      
                    <div class="form-group">
                    <label for="alu_vcTelefono">alu_vcTelefono</label>
                    <input type="text" class="form-control" id="alu_vcTelefono" placeholder="alu_vcTelefono" name="alu_vcTelefono" required>
                    <!-- <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div> //-->
                    </div>
                         
                      
                    <div class="form-group">
                    <label for="alu_vcCelular">alu_vcCelular</label>
                    <input type="text" class="form-control" id="alu_vcCelular" placeholder="alu_vcCelular" name="alu_vcCelular" required>
                    <!-- <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div> //-->
                    </div>
                         
                      
                    <div class="form-group">
                    <label for="alu_vcEmail">alu_vcEmail</label>
                    <input type="text" class="form-control" id="alu_vcEmail" placeholder="alu_vcEmail" name="alu_vcEmail" required>
                    <!-- <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div> //-->
                    </div>
                         
                      
                    <div class="form-group">
                    <label for="alu_vcEmail_alt">alu_vcEmail_alt</label>
                    <input type="text" class="form-control" id="alu_vcEmail_alt" placeholder="alu_vcEmail_alt" name="alu_vcEmail_alt" required>
                    <!-- <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div> //-->
                    </div>
                         
                      
                    <div class="form-group">
                    <label for="proadm_vcCodigo">proadm_vcCodigo</label>
                    <input type="text" class="form-control" id="proadm_vcCodigo" placeholder="proadm_vcCodigo" name="proadm_vcCodigo" required>
                    <!-- <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div> //-->
                    </div>
                         
                      
                    <div class="form-group">
                    <label for="cod_vcCodigo">cod_vcCodigo</label>
                    <input type="text" class="form-control" id="cod_vcCodigo" placeholder="cod_vcCodigo" name="cod_vcCodigo" required>
                    <!-- <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div> //-->
                    </div>
                         
                      
                    <div class="form-group">
                    <label for="cal_iEapMerito">cal_iEapMerito</label>
                    <input type="text" class="form-control" id="cal_iEapMerito" placeholder="cal_iEapMerito" name="cal_iEapMerito" required>
                    <!-- <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div> //-->
                    </div>
                         
                      
                    <div class="form-group">
                    <label for="mod_cCodigo">mod_cCodigo</label>
                    <input type="text" class="form-control" id="mod_cCodigo" placeholder="mod_cCodigo" name="mod_cCodigo" required>
                    <!-- <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div> //-->
                    </div>
                         
                      
                    <div class="form-group">
                    <label for="alu_ori_mes">alu_ori_mes</label>
                    <input type="text" class="form-control" id="alu_ori_mes" placeholder="alu_ori_mes" name="alu_ori_mes" required>
                    <!-- <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div> //-->
                    </div>
                         
                      
                    <div class="form-group">
                    <label for="ubi_vcId">ubi_vcId</label>
                    <input type="text" class="form-control" id="ubi_vcId" placeholder="ubi_vcId" name="ubi_vcId" required>
                    <!-- <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div> //-->
                    </div>
                         
                      
                    <div class="form-group">
                    <label for="alu_vcCondicionResolucion">alu_vcCondicionResolucion</label>
                    <input type="text" class="form-control" id="alu_vcCondicionResolucion" placeholder="alu_vcCondicionResolucion" name="alu_vcCondicionResolucion" required>
                    <!-- <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div> //-->
                    </div>
                         
                      
                    <div class="form-group">
                    <label for="alu_vcCondicionVencimiento">alu_vcCondicionVencimiento</label>
                    <input type="text" class="form-control" id="alu_vcCondicionVencimiento" placeholder="alu_vcCondicionVencimiento" name="alu_vcCondicionVencimiento" required>
                    <!-- <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div> //-->
                    </div>
                         
                      
                    <div class="form-group">
                    <label for="pueind_iCodigo">pueind_iCodigo</label>
                    <input type="text" class="form-control" id="pueind_iCodigo" placeholder="pueind_iCodigo" name="pueind_iCodigo" required>
                    <!-- <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div> //-->
                    </div>
                         
                      
                    <div class="form-group">
                    <label for="aluest_iCodigo">aluest_iCodigo</label>
                    <input type="text" class="form-control" id="aluest_iCodigo" placeholder="aluest_iCodigo" name="aluest_iCodigo" required>
                    <!-- <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div> //-->
                    </div>
                       
                    
                  <button type="submit" class="btn btn-primary">Registrar</button></form>
                  </div>  </form>
                
                </div> 
    </div>
    
    </div>




<!-- Modal acctualizar -->
<div class="modal fade" id="animal_edit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Editar alumno</h5>
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
                    <h2>Alumno</h2>
                    <form action="regtablacampo.php" class="was-validated">
                      <input type="hidden" value="alumno" name="n">
                    
                    <div class="form-group">
                    <label for="alu_iCodigo">alu_iCodigo</label>
                    <input type="text" class="form-control" id="alu_iCodigo" placeholder="alu_iCodigo" name="alu_iCodigo" required>
                    <!-- <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div> //-->
                    </div>
                         
                      
                    <div class="form-group">
                    <label for="alu_vcCodigo">alu_vcCodigo</label>
                    <input type="text" class="form-control" id="alu_vcCodigo" placeholder="alu_vcCodigo" name="alu_vcCodigo" required>
                    <!-- <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div> //-->
                    </div>
                         
                      
                    <div class="form-group">
                    <label for="alu_vcDocumento">alu_vcDocumento</label>
                    <input type="text" class="form-control" id="alu_vcDocumento" placeholder="alu_vcDocumento" name="alu_vcDocumento" required>
                    <!-- <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div> //-->
                    </div>
                         
                      
                    <div class="form-group">
                    <label for="alu_vcPaterno">alu_vcPaterno</label>
                    <input type="text" class="form-control" id="alu_vcPaterno" placeholder="alu_vcPaterno" name="alu_vcPaterno" required>
                    <!-- <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div> //-->
                    </div>
                         
                      
                    <div class="form-group">
                    <label for="alu_vcMaterno">alu_vcMaterno</label>
                    <input type="text" class="form-control" id="alu_vcMaterno" placeholder="alu_vcMaterno" name="alu_vcMaterno" required>
                    <!-- <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div> //-->
                    </div>
                         
                      
                    <div class="form-group">
                    <label for="alu_vcNombre">alu_vcNombre</label>
                    <input type="text" class="form-control" id="alu_vcNombre" placeholder="alu_vcNombre" name="alu_vcNombre" required>
                    <!-- <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div> //-->
                    </div>
                         
                      
                    <div class="form-group">
                    <label for="escpla_iCodigo">escpla_iCodigo</label>
                    <input type="text" class="form-control" id="escpla_iCodigo" placeholder="escpla_iCodigo" name="escpla_iCodigo" required>
                    <!-- <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div> //-->
                    </div>
                         
                      
                    <div class="form-group">
                    <label for="alu_vcPassword">alu_vcPassword</label>
                    <input type="text" class="form-control" id="alu_vcPassword" placeholder="alu_vcPassword" name="alu_vcPassword" required>
                    <!-- <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div> //-->
                    </div>
                         
                      
                    <div class="form-group">
                    <label for="escpla_iNotas">escpla_iNotas</label>
                    <input type="text" class="form-control" id="escpla_iNotas" placeholder="escpla_iNotas" name="escpla_iNotas" required>
                    <!-- <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div> //-->
                    </div>
                         
                      
                    <div class="form-group">
                    <label for="escpla_iCreditos">escpla_iCreditos</label>
                    <input type="text" class="form-control" id="escpla_iCreditos" placeholder="escpla_iCreditos" name="escpla_iCreditos" required>
                    <!-- <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div> //-->
                    </div>
                         
                      
                    <div class="form-group">
                    <label for="escpla_iPuntaje">escpla_iPuntaje</label>
                    <input type="text" class="form-control" id="escpla_iPuntaje" placeholder="escpla_iPuntaje" name="escpla_iPuntaje" required>
                    <!-- <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div> //-->
                    </div>
                         
                      
                    <div class="form-group">
                    <label for="escpla_fPromedio">escpla_fPromedio</label>
                    <input type="text" class="form-control" id="escpla_fPromedio" placeholder="escpla_fPromedio" name="escpla_fPromedio" required>
                    <!-- <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div> //-->
                    </div>
                         
                      
                    <div class="form-group">
                    <label for="alu_cSexo">alu_cSexo</label>
                    <input type="text" class="form-control" id="alu_cSexo" placeholder="alu_cSexo" name="alu_cSexo" required>
                    <!-- <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div> //-->
                    </div>
                         
                      
                    <div class="form-group">
                    <label for="alu_dFechaNacimiento">alu_dFechaNacimiento</label>
                    <input type="text" class="form-control" id="alu_dFechaNacimiento" placeholder="alu_dFechaNacimiento" name="alu_dFechaNacimiento" required>
                    <!-- <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div> //-->
                    </div>
                         
                      
                    <div class="form-group">
                    <label for="alucon_iCodigo">alucon_iCodigo</label>
                    <input type="text" class="form-control" id="alucon_iCodigo" placeholder="alucon_iCodigo" name="alucon_iCodigo" required>
                    <!-- <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div> //-->
                    </div>
                         
                      
                    <div class="form-group">
                    <label for="alu_vcTelefono">alu_vcTelefono</label>
                    <input type="text" class="form-control" id="alu_vcTelefono" placeholder="alu_vcTelefono" name="alu_vcTelefono" required>
                    <!-- <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div> //-->
                    </div>
                         
                      
                    <div class="form-group">
                    <label for="alu_vcCelular">alu_vcCelular</label>
                    <input type="text" class="form-control" id="alu_vcCelular" placeholder="alu_vcCelular" name="alu_vcCelular" required>
                    <!-- <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div> //-->
                    </div>
                         
                      
                    <div class="form-group">
                    <label for="alu_vcEmail">alu_vcEmail</label>
                    <input type="text" class="form-control" id="alu_vcEmail" placeholder="alu_vcEmail" name="alu_vcEmail" required>
                    <!-- <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div> //-->
                    </div>
                         
                      
                    <div class="form-group">
                    <label for="alu_vcEmail_alt">alu_vcEmail_alt</label>
                    <input type="text" class="form-control" id="alu_vcEmail_alt" placeholder="alu_vcEmail_alt" name="alu_vcEmail_alt" required>
                    <!-- <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div> //-->
                    </div>
                         
                      
                    <div class="form-group">
                    <label for="proadm_vcCodigo">proadm_vcCodigo</label>
                    <input type="text" class="form-control" id="proadm_vcCodigo" placeholder="proadm_vcCodigo" name="proadm_vcCodigo" required>
                    <!-- <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div> //-->
                    </div>
                         
                      
                    <div class="form-group">
                    <label for="cod_vcCodigo">cod_vcCodigo</label>
                    <input type="text" class="form-control" id="cod_vcCodigo" placeholder="cod_vcCodigo" name="cod_vcCodigo" required>
                    <!-- <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div> //-->
                    </div>
                         
                      
                    <div class="form-group">
                    <label for="cal_iEapMerito">cal_iEapMerito</label>
                    <input type="text" class="form-control" id="cal_iEapMerito" placeholder="cal_iEapMerito" name="cal_iEapMerito" required>
                    <!-- <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div> //-->
                    </div>
                         
                      
                    <div class="form-group">
                    <label for="mod_cCodigo">mod_cCodigo</label>
                    <input type="text" class="form-control" id="mod_cCodigo" placeholder="mod_cCodigo" name="mod_cCodigo" required>
                    <!-- <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div> //-->
                    </div>
                         
                      
                    <div class="form-group">
                    <label for="alu_ori_mes">alu_ori_mes</label>
                    <input type="text" class="form-control" id="alu_ori_mes" placeholder="alu_ori_mes" name="alu_ori_mes" required>
                    <!-- <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div> //-->
                    </div>
                         
                      
                    <div class="form-group">
                    <label for="ubi_vcId">ubi_vcId</label>
                    <input type="text" class="form-control" id="ubi_vcId" placeholder="ubi_vcId" name="ubi_vcId" required>
                    <!-- <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div> //-->
                    </div>
                         
                      
                    <div class="form-group">
                    <label for="alu_vcCondicionResolucion">alu_vcCondicionResolucion</label>
                    <input type="text" class="form-control" id="alu_vcCondicionResolucion" placeholder="alu_vcCondicionResolucion" name="alu_vcCondicionResolucion" required>
                    <!-- <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div> //-->
                    </div>
                         
                      
                    <div class="form-group">
                    <label for="alu_vcCondicionVencimiento">alu_vcCondicionVencimiento</label>
                    <input type="text" class="form-control" id="alu_vcCondicionVencimiento" placeholder="alu_vcCondicionVencimiento" name="alu_vcCondicionVencimiento" required>
                    <!-- <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div> //-->
                    </div>
                         
                      
                    <div class="form-group">
                    <label for="pueind_iCodigo">pueind_iCodigo</label>
                    <input type="text" class="form-control" id="pueind_iCodigo" placeholder="pueind_iCodigo" name="pueind_iCodigo" required>
                    <!-- <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div> //-->
                    </div>
                         
                      
                    <div class="form-group">
                    <label for="aluest_iCodigo">aluest_iCodigo</label>
                    <input type="text" class="form-control" id="aluest_iCodigo" placeholder="aluest_iCodigo" name="aluest_iCodigo" required>
                    <!-- <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div> //-->
                    </div>
                       
                    
                  <button type="submit" class="btn btn-primary">Registrar</button></form>
                  </div>  </form>
                  </div>  </form></div>   
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
 
function verclave(n1,alumno)
{ $('#idcod1').val(n1);
  $('#nomalumno').html("ALUMNO:"+alumno);
 
 // cambiarpassworddocente(cod,clave);
}
function crearcambio(n1,n2)
    {cod= document.getElementById(n1).value;
     clave=document.getElementById(n2).value;
     cambiarpasswordalumno(cod,clave);
 //     cambiarpassworddocente(cod,clave);
    } 

</script>
</body>
</html>