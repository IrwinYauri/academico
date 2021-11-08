@php
 session_start();
 $coddocentex="";
 if(isset($_SESSION['coddocentex'])){
  $coddocentex=$_SESSION['coddocentex'];
 }

use App\Http\Controllers\DocenteController; 
$datodoc=new DocenteController();
$verdocente=$datodoc->verdatosdocente($coddocentex);
$dni="";
foreach ($verdocente as $vdocente) {
    $dni=$vdocente->doc_vcDocumento;
}
@endphp
<div class="card shadow mb-4">
    <div class="card-header py-3">
     <h6 class="m-0 font-weight-bold text-primary">
      <i class="fa fa-list-alt" ></i> Por favor elija su hoja de vida. El tamaño debe ser máximo 3Mb, en formato pdf
      </h6>
                                   
                        <i class="far fa-id-card fa-6x"></i>
                                </div>
             <div class="card-body">
                <form action="hojavida" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input id="file" name="file" type="file" class="file" data-show-preview="false" >
<span class="icon text-dark-50">
   <br>
   <button class="btn btn-success ">
   <i class="fas fa-check"></i>
 
   <span class="text">Subir</span>

</button> 
@php
    $url="#";
    if(hojadevida($dni)=="COMPLETADO")
    $url="storage/hojavida/".$dni.".pdf";

@endphp

<input type="hidden" name="dni" value="{{$dni}}">
<a class="btn btn-info " href="{{$url}}">
    <i class="fas fa-search"></i>
    
    <span class="text">VER</span>
    <br>
</a>

<br><span style="color: navy"> ESTADO: {{hojadevida($dni)}}
    </span>
<br>
Solo archivos PDF
                </form>
          </div>
    </div>