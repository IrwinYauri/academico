@php
    
 session_start();
 $coddocentex="";
 if(isset($_SESSION['coddocentex'])){
  $coddocentex=$_SESSION['coddocentex'];
 }
  
 use App\Http\Controllers\DocenteController; 
 use App\Http\Controllers\PlanactividadController; 
 use Illuminate\Support\Facades\Storage;

 function verboton($semestre,$coddoc,$nro)
 {         $verpla=new PlanactividadController();                    
            
                              $doc=$verpla->planactividadnombre($semestre,$coddoc,$nro);
                              $bloq=asset('storage/planactividad/'.$doc);
                                  if($doc=="")
                                  $bloq="#";
                         

                        echo "<a href='$bloq' class='btn btn-info btn-icon-split table-condensed' >
                              <span class='icon text-white-50 table-condensed'>
                                  <i class='fas fa-search'></i>
                              </span>
                              <span class='text'>ver</span>
                             </a>";
   }
   function estadoplan($semestre,$coddoc,$nro)
   {  $verpla=new PlanactividadController();                    
      $doc=$verpla->planactividadnombre($semestre,$coddoc,$nro);
      if($doc=="")
      return "PENDIENTE";
      else {
        return "COMPLETO";
      }
    }
@endphp
<style>
    .table-condensed{
  font-size: 14px;
  color: black;
  }
  
  </style>
<div class="card shadow mb-4">
  @php
    $verpla=new PlanactividadController();
    $r=$verpla->consultasemestreplan(semestreactual(),$coddocentex);
    //dd($r);
    if($r==0)
    {echo "<h5>CREANDO REGISTRO DE PLAN DE ACTIVIDADES LECTIVAS Y NO LECTIVAS</h5>";
      $verpla->crearplansemestre($coddocentex,semestreactual());
    }
  @endphp
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">
                                    <i class="fa fa-book" ></i> PLAN DE ACTIVIDADES LECTIVAS Y NO LECTIVAS DEL DOCENTE {{semestreactual()}}
                                    </h6>
                                </div>
                                <div class="card-body">
                             <table class='table table-striped table-hover table-responsive-md text-dark-80 table-condensed'>
                              <thead>
                                <tr style="background-color: navy;color:white;">
                                    <td>ACTIVIDAD</td>
                                    <td> ARCHIVO</td>
                                    <td> ESTADO</td>
                                    <td> OP</td>
                                </tr>
                                </thead>
                                    <tr>

                                <td>Plan general </td>
                                  <td>
                                    <form action="planactividad" method="POST" enctype="multipart/form-data">
                                      @csrf
                                      <input id="file" name="file" type="file" class="file" data-show-preview="false" >
                                  <span class="icon text-white-50">
                                  <br>
                                  <button class="btn btn-success ">
                                  <i class="fas fa-check"></i>
                                  </span>
                                  <span class="text">Subir</span>
                                  </button>Solo archivos PDF
                                  <input id="coddoc" name="coddoc" type="hidden" value="{{$coddocentex}}" >
                                  <input id="semestre" name="semestre" type="hidden" value="{{semestreactual()}}" >
                                  <input id="nro" name="nro" type="hidden" value="0" >
                                </form>
                            </td>
                            <td>
                             {{ estadoplan(semestreactual(),$coddocentex,0)}} 
                            </td>
                            <td> 
                              @php
                              verboton(semestreactual(), $coddocentex,0);
                              @endphp
                           </td>
                  
                            </tr>

                            <tr>
                                <td>1 mes </td>
                                  <td>
                              <form action="planactividad" method="POST" enctype="multipart/form-data">
                                @csrf
                               <input id="file" name="file" type="file" class="file" data-show-preview="false" >
                            <span class="icon text-white-50">
                            <br>
                            <button class="btn btn-success ">
                            <i class="fas fa-check"></i>
                            </span>
                            <span class="text">Subir</span>
                            </button>Solo archivos PDF
                            <input id="coddoc" name="coddoc" type="hidden" value="{{$coddocentex}}" >
                            <input id="semestre" name="semestre" type="hidden" value="{{semestreactual()}}" >
                            <input id="nro" name="nro" type="hidden" value="1" >
                          </form>
                            </td>
                            <td>
                              {{ estadoplan(semestreactual(),$coddocentex,1)}}  </td>

                            <td> 
                              @php
                              verboton(semestreactual(), $coddocentex,1);
                              @endphp
                           </td>

                            </tr>

                            <tr>
                                <td>2 mes </td>
                                  <td>
                             <form action="planactividad" method="POST" enctype="multipart/form-data">
                             @csrf
                             <input id="file" name="file" type="file" class="file" data-show-preview="false" >
                              <span class="icon text-white-50">
                            <br>
                            <button class="btn btn-success ">
                            <i class="fas fa-check"></i>
                            </span>
                            <span class="text">Subir</span>
                            </button>Solo archivos PDF
                            <input id="coddoc" name="coddoc" type="hidden" value="{{$coddocentex}}" >
                            <input id="semestre" name="semestre" type="hidden" value="{{semestreactual()}}" >
                            <input id="nro" name="nro" type="hidden" value="2" >
                          </form>
                            </td>
                            <td>  {{ estadoplan(semestreactual(),$coddocentex,2)}}  </td>
                            <td> 
                              @php
                              verboton(semestreactual(), $coddocentex,2);
                              @endphp
                           </td>
                            </tr>

                            <tr>
                                <td>3 mes </td>
                                  <td>
                                    <form action="planactividad" method="POST" enctype="multipart/form-data">
                                      @csrf
                                      <input id="file" name="file" type="file" class="file" data-show-preview="false" >
                            <span class="icon text-white-50">
                            <br>
                            <button class="btn btn-success ">
                            <i class="fas fa-check"></i>
                            </span>
                            <span class="text">Subir</span>
                            </button>Solo archivos PDF
                            <input id="coddoc" name="coddoc" type="hidden" value="{{$coddocentex}}" >
                            <input id="semestre" name="semestre" type="hidden" value="{{semestreactual()}}" >
                            <input id="nro" name="nro" type="hidden" value="3" >
                          </form>
                            </td>
                            <td>  {{ estadoplan(semestreactual(),$coddocentex,3)}}  </td>
                            <td> 
                              @php
                              verboton(semestreactual(), $coddocentex,3);
                              @endphp
                           </td>
                            </tr>

                            <tr>
                                <td>4 mes </td>
                                  <td>
                                    <form action="planactividad" method="POST" enctype="multipart/form-data">
                                      @csrf
                                      <input id="file" name="file" type="file" class="file" data-show-preview="false" >
                            <span class="icon text-white-50">
                            <br>
                            <button class="btn btn-success ">
                            <i class="fas fa-check"></i>
                            </span>
                            <span class="text">Subir</span>
                            </button>Solo archivos PDF
                            <input id="coddoc" name="coddoc" type="hidden" value="{{$coddocentex}}" >
                            <input id="semestre" name="semestre" type="hidden" value="{{semestreactual()}}" >
                            <input id="nro" name="nro" type="hidden" value="4" >
                          </form>
                            </td>
                            <td>  {{ estadoplan(semestreactual(),$coddocentex,4)}}  </td>
                            <td> 
                              @php
                              verboton(semestreactual(), $coddocentex,4);
                              @endphp
                           </td>
                            </tr>
                            <tr>
                              <td>5 mes </td>
                                <td>
                                  <form action="planactividad" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input id="file" name="file" type="file" class="file" data-show-preview="false" >
                          <span class="icon text-white-50">
                          <br>
                          <button class="btn btn-success ">
                          <i class="fas fa-check"></i>
                          </span>
                          <span class="text">Subir</span>
                          </button>Solo archivos PDF
                          <input id="coddoc" name="coddoc" type="hidden" value="{{$coddocentex}}" >
                            <input id="semestre" name="semestre" type="hidden" value="{{semestreactual()}}" >
                            <input id="nro" name="nro" type="hidden" value="5" >
                          </form>
                          </td>
                          <td>  {{ estadoplan(semestreactual(),$coddocentex,5)}}  </td>
                          <td> 
                            @php
                            verboton(semestreactual(), $coddocentex,5);
                            @endphp
                         </td>
                          </tr>
</table>
                                </div>
                            </div>

                            <script>
                              activarwow()
                            </script>