@php
 session_start();
 $codalumno="";

 if (isset($_SESSION['alumnox'])) {
    $codalumno = $_SESSION['codalumnox'];
   }

    function alumnodni($codalumno)
    {  $sql="SELECT
       alumno.alu_vcDocumento
       from alumno
       where alumno.alu_iCodigo='$codalumno'";
       $data=DB::select($sql);
        if(isset($data[0]->alu_vcDocumento))
        return  $data[0]->alu_vcDocumento;
        else {
            return "";
        }
    }

$dni=alumnodni($codalumno);


@endphp



<div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">
                                    <i class="fa fa-portrait" ></i> Por favor ingrese su foto. El tamaño debe ser 240x288, la resolución debe ser 300dpi y debe pesar menos de 50Kb
                                    </h6>
                            <!--        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;"
                                            src="img/undraw_posting_photo.svg" alt="..."> //-->
                                              
                                </div>
                                <div class="card-body" style="color:black">
                                    {{fotoalumno($dni,6);}}
                                    <form action="alumno" method="POST" enctype="multipart/form-data">
                                        @csrf
                                    <input id="file" name="file" type="file" class="file" data-show-preview="false" >
                                    <input id="codalumno" name="codalumno" type="hidden" value="{{$dni}}" >
<span class="icon text-dark-50">
   <br>
   <button class="btn btn-success ">
   <i class="fas fa-check"></i>
   <span class="text">Subir</span>
</button>Solo archivos JPG
</form>
                                </div>
                            </div>