@php
use App\Http\Controllers\AdminController; 
$encuesta=new AdminController();
$encuestax=$encuesta->verlistaencuesta();
@endphp

<link  rel="icon"   href=" {{ asset('img/escudo.png')}}" type="image/png" />
<link href=" {{ asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">

<link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

<!-- Custom styles for this template-->
<link href="{{ asset('css/sb-admin-2.min.css')}}" rel="stylesheet">
<link href="{{ asset('css/seleccion.css')}}" rel="stylesheet" type="text/css">
<style>
.separaconte{
    margin: 5px;
    overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
  }
  .table-condensed{
      font-size: 12px;
      color: black;
      }
      
</style>
<body>
    
    <div class="container">
        
    </div>
    

  
<div class="container">
    
    <ul class="nav nav-tabs">
      <li class="active"><a data-toggle="tab" href="#home" class="separaconte btn">LISTA DE ENCUESTAS</a></li>
      <li><a data-toggle="tab" href="#menu1" class="separaconte btn">CONFIGURACION  ENCUESTA</a></li>
      <li><a data-toggle="tab" href="#menu2" class="separaconte btn">REGISTRO PROFESORES ENCUESTADOS</a></li>
      <li><a data-toggle="tab" href="#menu3" class="separaconte btn">LISTA CATEGORIA</a></li>
    </ul>
  
    <div class="tab-content">
      <div id="home" class="tab-pane fade show active">
        <h3>LISTA DE ENCUESTAS</h3>
        <table class='table table-striped table-hover table-responsive-md table-condensed' border="1">
            <thead>
            <tr style="background-color: navy; color:white;">
                <td>Semestre</td>
                <td>Puntaje</td>
                <td>Detalle</td>
                <td>ESTADO</td>
                <td>OP</td>
            </tr>
            </thead>
            <tbody>
            @foreach ($encuestax as $encu)
            <tr>
                <td>{{ $encu->sem_iCodigo }}</td>
                <td>{{ $encu->enc_iPuntaje }}</td>
                <td>{{ $encu->enc_vcObservacion}}</td>
                <td>{{$encu->enc_cActivo}}</td>
                
            
                <td>
                    <a href="javascript:void(0)" onclick="activarsemestre('{{$encu->sem_iCodigo}}'); " class="btn btn-success btn-sm table-condensed btn-block"> ACTIVAR</a>
                    <a href="javascript:void(0)" onclick="editarAnimal('.$animales->id.')" class="btn btn-info btn-sm table-condensed btn-block"> Editar </a>
                      &nbsp;&nbsp;<button type="button" name="delete" id="'.$animales->id.'" class="delete btn btn-danger btn-sm table-condensed btn-block"> Eliminar </button>
                </td>
            </tr>
            @endforeach  
        </tbody>
         </table> 
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
               <select name="" id="" onchange="listaencuestapreguntasemestre(this.value)">
                @foreach ($encuestax as $encu)
                
                    <option>{{ $encu->sem_iCodigo }}</option>
                  
                @endforeach  
             </select>
              <div id="tcategoria">
                  lista categorias
              </div>
              <div id="tpreguntas">
                
            </div> 

         </div>
        <!-- fin config//-->
      </div>
      <div id="menu2" class="tab-pane fade">
        <h3>Menu 2</h3>
        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
      </div>
      <div id="menu3" class="tab-pane fade">
        @include('admin.encuestacategoria')
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
                <i class="fa fa-book fa-2x" ></i> Lista de Encuesta
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

<script src="{{ asset('vendor/jquery/jquery.min.js')}}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('js/sb-admin-2.min.js')}}"></script>
