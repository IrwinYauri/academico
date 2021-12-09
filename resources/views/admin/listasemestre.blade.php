@php
  function versemestre()
  {
    $sql="select * from semestre";
    $data=DB::select($sql);
    return $data;
  }
  
  $listasemestre=versemestre();
@endphp
  <style>
    .table-condensed
    {
      font-size: 12px;
      color: black;        
    }

    .micolor
    {
      color:black;
    }
    
    .tamletra
    {
      color:navy;
      font-size: 10px;
      font-weight: bold;
    }
    
    .xfondo 
    {
      background-color: silver;
    }
  </style>
  
    <script>
      const semestre = [];
      const sem_cActivo = [];
      const sem_iMatriculaInicio = [];
      const sem_iMatriculaFinal = [];
      const sem_dEncuestaInicio = [];
      const sem_dEncuestaFinal = [];
      const sem_dInicioClases = [];
      const sem_iSemanas = [];
      const sem_dActaInicio = [];
      const sem_dActaFinal = [];
      const sem_iToleranciaInicio = [];
      const sem_iToleranciaFinal = [];
      const fech_ent1_ini = [];
      const fech_ent1_fin = [];
      const fech_ent2_ini = [];
      const fech_ent2_fin = [];
      const fech_ent3_ini = [];
      const fech_ent3_fin = [];
      const fech_ent4_ini = [];
      const fech_ent4_fin = [];
      const fech_ent5_ini = [];
      const fech_ent5_fin = [];
      const sem_dAplazadoInicio= [];
      const sem_dAplazadoFinal= [];
      const fecMatReg_ini= [];
      const fecMatReg_fin= [];
      const fecMatExt_ini= [];
      const fecMatExt_fin= [];
      
      @php

      $n=-1;

      foreach ($listasemestre as $sem)
      {       
        $n++;     
        echo "semestre[".$n."]=".$sem->sem_iCodigo.";";
        echo "sem_cActivo[".$n."]='".trim($sem->sem_cActivo)."';";
        echo "sem_iMatriculaInicio[".$n."]='".$sem->sem_iMatriculaInicio."';";
        echo "sem_iMatriculaFinal[".$n."]='".$sem->sem_iMatriculaFinal."';";
        echo "sem_dEncuestaInicio[".$n."]='".$sem->sem_dEncuestaInicio."';";
        echo "sem_dEncuestaFinal[".$n."]='".$sem->sem_dEncuestaFinal."';";
        echo "sem_dInicioClases[".$n."]='".$sem->sem_dInicioClases."';";
        echo "sem_iSemanas[".$n."]='".$sem->sem_iSemanas."';";
        echo "sem_dActaInicio[".$n."]='".$sem->sem_dActaInicio."';";
        echo "sem_dActaFinal[".$n."]='".$sem->sem_dActaFinal."';";
        echo "sem_iToleranciaInicio[".$n."]='".$sem->sem_iToleranciaInicio."';";
        echo "sem_iToleranciaFinal[".$n."]='".$sem->sem_iToleranciaFinal."';";
        echo " fech_ent1_ini[".$n."]='".$sem->fech_ent1_ini."';";
        echo "fech_ent1_fin[".$n."]='".$sem->fech_ent1_fin."';";
        echo " fech_ent2_ini[".$n."]='".$sem->fech_ent2_ini."';";
        echo "fech_ent2_fin[".$n."]='".$sem->fech_ent2_fin."';";
        echo " fech_ent3_ini[".$n."]='".$sem->fech_ent3_ini."';";
        echo "fech_ent3_fin[".$n."]='".$sem->fech_ent3_fin."';";
        echo " fech_ent4_ini[".$n."]='".$sem->fech_ent4_ini."';";
        echo "fech_ent4_fin[".$n."]='".$sem->fech_ent4_fin."';";

        if(isset($sem->fech_ent5_ini))
        { 
          echo " fech_ent5_ini[".$n."]='".$sem->fech_ent4_ini."';";
          echo "fech_ent5_fin[".$n."]='".$sem->fech_ent4_fin."';";}
        else
        { 
          echo " fech_ent5_ini[".$n."]='';";
          echo "fech_ent5_fin[".$n."]='';";
        }  

        echo "sem_dAplazadoInicio[".$n."]='".left($sem->sem_dAplazadoInicio,10)."';";
        echo "sem_dAplazadoFinal[".$n."]='".left($sem->sem_dAplazadoFinal,10)."';";
        echo "sem_dSustiInicio[".$n."]='".left($sem->sem_dSustituInicio,10)."';";
        echo "sem_dSustiFinal[".$n."]='".left($sem->sem_dSustituFin,10)."';";
        echo "fecMatReg_ini[".$n."]='".left($sem->fecMatReg_ini,10)."';";
        echo "fecMatReg_fin[".$n."]='".left($sem->fecMatReg_fin,10)."';";
        echo "fecMatExt_ini[".$n."]='".left($sem->fecMatExt_ini,10)."';";
        echo "fecMatExt_fin[".$n."]='".left($sem->fecMatExt_fin,10)."';";  

      }
      @endphp
    </script> 

    <div class="container table-condensed">
      <h1 class="h3 mb-0 text-gray-600"><i class="fas fa-clock"></i> MOD. SEMESTRE</h1><br>

      <div class="alert alert-success" id="sms" style="display:none;">
        <strong>Correcto!</strong> Se registro bien.
      </div>
      <div class="alert alert-danger" id="sms2" style="display:none;">
        <strong>Error!</strong> <span id="sms2_1">Vuelva a intentarlo.</span>
      </div>
      <div class="card shadow mb-4">        
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">        
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item m-0 font-weight-bold text-primary" role="presentation">
                <button class="btn btn-primary active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true" style="border:1px solid white;"><i class="fa fa-bars" aria-hidden="true"></i> Lista de Semestres</button>
            </li>
            <li class="nav-item m-0 font-weight-bold text-primary" role="presentation">
              <button class="btn btn-primary" id="semestre-tab" data-bs-toggle="tab" data-bs-target="#semestrefecha" type="button" role="tab" aria-controls="semestrefecha" aria-selected="false" style="border:1px solid white;"><i class="fas fa-calendar-alt"></i> Calendario Académico</button>
            </li>
            <li class="nav-item m-0 font-weight-bold text-primary" role="presentation">
              <button class="btn btn-primary" id="semestre-tab" data-bs-toggle="tab" data-bs-target="#semestre" type="button" role="tab" aria-controls="semestre" aria-selected="false" style="border:1px solid white;"><i class="fa fa-toggle-on" aria-hidden="true"></i> Apertura/Cierre Semestre</button>
            </li>
          </ul>
        </div>  
        <div class="tab-content" id="myTabContent">       
          <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">            
              <div class="row" style="padding: 20px 45px;">
                <table class="table table-striped table-bordered">
                  <thead>
                    <!--th>codigo</th-->
                    <th>SEMESTRE</th>
                    <th>ESTADO</th>
                    <th>INICIO MATRÍCULA</th>
                    <th>CIERRE MATRÍCULA</th>
                    <th>INICIO SEMESTRE</th>
                    <th>INICIO ENCUESTA</th>
                    <th>CIERRE ENCUESTA</th>        
                    <th>ACCIONES</th>
                  </thead>
                  <tbody>
                    @foreach ($listasemestre as $sem)
                      <tr>
                        <!--td>{{ $sem->sem_iCodigo }}</td-->
                        <td style="text-align: center;">
                           @if(trim($sem->sem_cActivo)=="S")
                            <span class="badge badge-pill badge-success" style="font-size: 11px;">{{ $sem->sem_nombre }}</span>
                          @else
                            <span style="font-size: 11px;">{{ $sem->sem_nombre }}</span>
                          @endif
                          
                        </td>               
                        <td style="text-align: center;">
                          @if(trim($sem->sem_cActivo)=="S")
                            <div class="bg-success text-white">
                              {{$sem->sem_cActivo}}  
                            </div>   
                          @else
                            {{$sem->sem_cActivo}}  
                          @endif                
                        </td>
                        <td style="text-align: center;">{{$sem->sem_iMatriculaInicio}}</td>
                        <td style="text-align: center;">{{$sem->sem_iMatriculaFinal}}</td>
                        <td style="text-align: center;">{{$sem->sem_dInicioClases}}</td>
                        <td style="text-align: center;">{{$sem->sem_dEncuestaInicio}}</td>
                        <td style="text-align: center;">{{$sem->sem_dEncuestaFinal}}</td>
                        <td style="text-align: center;">                          
                          @if(trim($sem->sem_cActivo)=="S")
                            <a href="javascript:void(0)" onclick="$('#editarSemestre').modal('show');" class="btn btn-success btn-sm btn-block"><i class="fa fa-pencil"></i> EDITAR</a>
                          @else
                            <a href="javascript:void(0)" onclick="activarsemestre('{{$sem->sem_iCodigo}}'); " class="btn btn-info btn-sm btn-block"><i class="fa fa-mail-reply-all"></i> RE-APERTURAR</a>
                          @endif   

                          @if($sem->inicio==0 && trim($sem->sem_cActivo)!="S")                            
                            <button type="button" onclick="eliminarSemestre('{{$sem->sem_iCodigo}}');" class="delete btn btn-danger btn-sm btn-block"> Eliminar </button>
                          @endif
                          
                        </td>
                      </tr>
                    @endforeach  
                  </tbody>
                </table>      
              </div> 
          </div>

          <div class="tab-pane fade " id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <h3>Nuevo Calendario semestre</h3>                                  
            @include('admin.semestrefechas');
          </div>

          <div class="tab-pane fade" id="semestrefecha" role="tabpanel" aria-labelledby="semestrefecha-tab" style="padding: 31px 32px;font-size: 12px;">
            <div id="row g-4">
              <select id="nrosemestre" class="form-control" aria-label=".form-select-lg example" onchange="vercalendario(this); revisarestadofecha();" style="font-size: 14px;">
                <option >Seleccionar semestre</option>
                @foreach ($listasemestre as $sem)
                  <option value="{{ $sem->sem_iCodigo }}">{{ $sem->sem_iCodigo }} 
                  @if(trim($sem->sem_cActivo)=="S")               
                  [Activo]
                  @endif
                  </option>               
                @endforeach
              </select>
            </div>

            <div class="row g-4" >
              <div class="col-sm">
                <label for="colFormLabelSm" class=" col-form-label  tamletra ">INICIO DE CLASES</label>
                  <input type="date" class="form-control" placeholder="sem_dInicioClases" aria-label="sem_dInicioClases" id="sem_dInicioClases" style="font-size:12px;">
              </div>
              <div class="col-sm">
                <label for="colFormLabelSm" class=" col-form-label  tamletra ">NRO DE SEMANAS</label>
                <input type="text" class="form-control" placeholder="sem_iSemanas" aria-label="sem_iSemanas" id="sem_iSemanas" style="font-size:12px;">
              </div>
              <div class="col-sm">
                <label for="colFormLabelSm" class=" col-form-label  tamletra ">MINUTOS ESPERA</label>
                  <input type="text" class="form-control" placeholder="sem_iToleranciaInicio" aria-label="sem_iToleranciaInicio" id="sem_iToleranciaInicio" style="font-size:12px;">
              </div>
              <div class="col-sm">
                <label for="colFormLabelSm" class=" col-form-label  tamletra ">MINUTOS CIERRE</label>
                <input type="text" class="form-control" placeholder="sem_iToleranciaFinal" aria-label="sem_iToleranciaFinal" id="sem_iToleranciaFinal" style="font-size:12px;">
              </div>              
            </div>
                                      
            <div class="row g-4">
              <div class="col-sm">
                <label for="colFormLabelSm" class=" col-form-label  tamletra  ">INICIO DE MATRICULAS</label>
                <input type="date" class="form-control" placeholder="sem_iMatriculaInicio" aria-label="sem_iMatriculaInicio" id="sem_iMatriculaInicio" style="font-size:12px;">
              </div>
              <div class="col-sm">
                <label for="colFormLabelSm" class=" col-form-label  tamletra ">CIERRE DE MATRICULAS</label>
                <input type="date" class="form-control" placeholder="sem_iMatriculaFinal" aria-label="sem_iMatriculaFinal" id="sem_iMatriculaFinal" style="font-size:12px;">
              </div>
              <div class="col-sm">
                <label for="colFormLabelSm" class=" col-form-label  tamletra ">INICIO DE ENCUESTA</label>
                <input type="date" class="form-control" placeholder="sem_dEncuestaInicio" aria-label="sem_dEncuestaInicio" id="sem_dEncuestaInicio" style="font-size:12px;">
              </div>
        
              <div class="col-sm">
                <label for="colFormLabelSm" class=" col-form-label  tamletra ">CIERRE DE ENCUESTA</label>
                <input type="date" class="form-control" placeholder="sem_dEncuestaFinal" aria-label="sem_dEncuestaFinal" id="sem_dEncuestaFinal" style="font-size:12px;">
              </div>                
            </div>
                
            <div class="row g-4">
              <div class="col-sm">
                <label for="colFormLabelSm" class=" col-form-label  tamletra ">INICIO DE ACTAS</label>
                <input type="date" class="form-control" placeholder="sem_dActaInicio" aria-label="sem_dActaInicio" id="sem_dActaInicio" style="font-size:12px;">
              </div>
        
              <div class="col-sm">
                <label for="colFormLabelSm" class=" col-form-label  tamletra ">CIERRE DE ACTAS</label>
                <input type="date" class="form-control" placeholder="sem_dActaFinal" aria-label="sem_dActaFinal" id="sem_dActaFinal" style="font-size:12px;">
              </div>
              <div class="col-sm">
                <label for="colFormLabelSm" class=" col-form-label  tamletra ">INICIO UNIDAD I</label>
                <input type="date" class="form-control" placeholder="fech_ent1_ini" aria-label="fech_ent1_ini" id="fech_ent1_ini" style="font-size:12px;">
              </div>
        
              <div class="col-sm">
                <label for="colFormLabelSm" class=" col-form-label  tamletra ">CIERRE UNIDAD I</label>
                <input type="date" class="form-control" placeholder="fech_ent1_fin" aria-label="fech_ent1_fin" id="fech_ent1_fin" style="font-size:12px;" >
              </div>                  
            </div>

            <div class="row g-4 ">   
              <div class="col-sm">
                <label for="colFormLabelSm" class="col-form-label  tamletra">INICIO UNIDAD II</label>
                  <input type="date" class="form-control" placeholder="fech_ent2_ini" aria-label="fech_ent2_ini" id="fech_ent2_ini" style="font-size:12px;">
              </div>
              <div class="col-sm">
                <label for="colFormLabelSm" class="col-form-label  tamletra">CIERRE UNIDAD II</label>
                <input type="date" class="form-control" placeholder="fech_ent2_fin" aria-label="fech_ent2_fin" id="fech_ent2_fin" style="font-size:12px;">
              </div>
              <div class="col-sm">
                <label for="colFormLabelSm" class="col-form-label  tamletra">INICIO UNIDAD III</label>
                <input type="date" class="form-control" placeholder="fech_ent3_ini" aria-label="fech_ent3_ini" id="fech_ent3_ini" style="font-size:12px;">
              </div>
              <div class="col-sm">
                <label for="colFormLabelSm" class="col-form-label  tamletra">CIERRE UNIDAD III</label>
                <input type="date" class="form-control" placeholder="fech_ent3_fin" aria-label="fech_ent3_fin" id="fech_ent3_fin" style="font-size:12px;">
              </div>
            </div>
        
            <div class="row g-4">
              <div class="col-sm">
                <label for="colFormLabelSm" class="col-form-label  tamletra">INICIO UNIDAD IV</label>
                  <input type="date" class="form-control" placeholder="fech_ent4_ini" aria-label="fech_ent4_ini" id="fech_ent4_ini" style="font-size:12px;">
              </div>
              <div class="col-sm">
                <label for="colFormLabelSm" class="col-form-label  tamletra">CIERRE UNIDAD IV</label>
                <input type="date" class="form-control" placeholder="fech_ent2_fin" aria-label="fech_ent4_fin" id="fech_ent4_fin" style="font-size:12px;">
              </div>
              <div class="col-sm">
                <label for="colFormLabelSm" class="col-form-label  tamletra">INICIO UNIDAD V</label>
                <input type="date" class="form-control" placeholder="fech_ent5_ini" aria-label="fech_ent5_ini" id="fech_ent5_ini" style="font-size:12px;">
              </div>
        
              <div class="col-sm">
                <label for="colFormLabelSm" class="col-form-label  tamletra">CIERRE UNIDAD V</label>
                <input type="date" class="form-control" placeholder="fech_ent5_fin" aria-label="fech_ent5_fin" id="fech_ent5_fin" style="font-size:12px;">
              </div>
            </div>
        
            <div class="row g-4">
              <div class="col-sm">
                <label for="colFormLabelSm" class="col-form-label  tamletra">INICIO APLAZADOS</label>
                  <input type="date" class="form-control" placeholder="sem_dAplazadoInicio" aria-label="sem_dAplazadoInicio" id="sem_dAplazadoInicio" style="font-size:12px;">
              </div>
              <div class="col-sm">
                <label for="colFormLabelSm" class="col-form-label  tamletra">CIERRE APLAZADOS</label>
                <input type="date" class="form-control" placeholder="sem_dAplazadoFinal" aria-label="sem_dAplazadoFinal" id="sem_dAplazadoFinal" style="font-size:12px;">
              </div>
              <div class="col-sm">
                <label for="colFormLabelSm" class="col-form-label  tamletra">INICIO SUSTITUTORIO</label>
                <input type="date" class="form-control" placeholder="sem_dSustiInicio" aria-label="sem_dSustiInicio" id="sem_dSustiInicio" style="font-size:12px;">
              </div>
        
              <div class="col-sm">
                <label for="colFormLabelSm" class="col-form-label  tamletra">CIERRE SUSTITUTORIO</label>
                <input type="date" class="form-control" placeholder="sem_dSustiFinal" aria-label="sem_dSustiFinal" id="sem_dSustiFinal" style="font-size:12px;">
              </div>
            </div>
        
            <div class="row g-4">
              <div class="col-sm-3">
                <label for="colFormLabelSm" class="col-form-label  tamletra">INICIO MATRICULA REGULAR</label>
                <input type="date" class="form-control" placeholder="fecMatReg_ini" aria-label="fecMatReg_ini" id="fecMatReg_ini" style="font-size:12px;">
              </div>
        
              <div class="col-sm-3">
                <label for="colFormLabelSm" class="col-form-label  tamletra">CIERRE MATRICULA REGULAR</label>
                <input type="date" class="form-control" placeholder="fecMatReg_fin" aria-label="fecMatReg_fin" id="fecMatReg_fin" style="font-size:12px;">
              </div>
              <div class="col-sm-3">
                <label for="colFormLabelSm" class="col-form-label  tamletra">INICIO  MATRICULA EXTEMPORANEA</label>
                  <input type="date" class="form-control" placeholder="fecMatExt_ini" aria-label="fecMatExt_ini" id="fecMatExt_ini" style="font-size:12px;">
              </div>
              <div class="col-sm-3">
                <label for="colFormLabelSm" class="col-form-label  tamletra">CIERRE MATRICULA EXTEMPORANEA</label>
                <input type="date" class="form-control" placeholder="fecMatExt_fin" aria-label="fecMatExt_fin" id="fecMatExt_fin" style="font-size:12px;">
              </div>
            </div>
            <br>
            <div class="" id="btnUpdate_" style="display: none;text-align: right;">                  
              <button type="button" class="btn btn-primary" onclick="modificarfechasemetre();revisarestadofecha();">
              <i class="fas fa-save"></i> GUARDAR CAMBIOS</button>                   
            </div>
          </div>  

          <div class="tab-pane fade" id="semestre" role="tabpanel" aria-labelledby="semestre-tab">
            <div class="row align-items-center ">
              <div class="col-6 mx-auto">
                <br>
                <div class="jumbotron">
                  <?php
                    $semestre_act=semestreactual();
                  ?>
                  
                  @if($semestre_act->sem_iCodigo == "")                    
                    <div class="form-group">
                      <button class="btn btn-primary btn-block">Aperturar Semestre</button>
                    </div>
                  @else
                    @if($semestre_act->inicio==0)
                      <div class="form-group">
                        <button class="btn btn-warning btn-block" onclick="IniciarSemestre();">Iniciar Semestre</button>
                      </div>              
                    @else
                      <div class="form-group">    
                        <button type="button" class="btn btn-primary" id="openModSem" data-toggle="modal" data-target="#nueSemestre" style="display: none;"></button>
                        <button class="btn btn-danger btn-block" onclick="openVerificNotsSetDateSem();">Cerrar Semestre - {{$semestre_act->sem_nombre}}</button>
                      </div>  
                    @endif
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div> 
      </div>

      <div class="modal fade" id="nueSemestre">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
          
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Cerrar y Abrir Nuevo Semestre</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <!-- Modal body -->
            <div class="modal-body" style="padding: 10px 30px;">
                <div class="row g-4">
                  <div class="col-sm">
                    <label for="colFormLabelSm" class=" col-form-label  tamletra">Código de semestre</label>
                    <input type="number" class="form-control" placeholder="XXXXY" aria-label="codsemestre_" id="codsemestre_" style="font-size:12px;">
                  </div>
                  <div class="col-sm">
                    <label for="colFormLabelSm" class=" col-form-label  tamletra">Nombre del Semestre</label>
                    <input type="text" class="form-control" placeholder="XXXY-Z" aria-label="nomsemestre_" id="nomsemestre_" style="font-size:12px;" maxlength="6">
                  </div>                
                </div>

                <div class="row g-4" >
                  <div class="col-sm">
                    <label for="colFormLabelSm" class=" col-form-label  tamletra ">INICIO DE CLASES</label>
                      <input type="date" class="form-control" placeholder="sem_dInicioClases" aria-label="sem_dInicioClases_" id="sem_dInicioClases_" style="font-size:12px;">
                  </div>
                  <div class="col-sm">
                    <label for="colFormLabelSm" class=" col-form-label  tamletra ">NRO DE SEMANAS</label>
                    <input type="text" class="form-control" placeholder="Nro Semanas" aria-label="sem_iSemanas_" id="sem_iSemanas_" style="font-size:12px;">
                  </div>
                  <div class="col-sm">
                    <label for="colFormLabelSm" class=" col-form-label  tamletra ">MINUTOS ESPERA</label>
                      <input type="text" class="form-control" placeholder="Min.Espera inicio" aria-label="sem_iToleranciaInicio_" id="sem_iToleranciaInicio_" style="font-size:12px;">
                  </div>
                  <div class="col-sm">
                    <label for="colFormLabelSm" class=" col-form-label  tamletra ">MINUTOS CIERRE</label>
                    <input type="text" class="form-control" placeholder="Min.Espera Fin" aria-label="sem_iToleranciaFinal_" id="sem_iToleranciaFinal_" style="font-size:12px;">
                  </div>                  
                </div>

                <div class="row g-4">
                  <div class="col-sm">
                    <label for="colFormLabelSm" class=" col-form-label  tamletra  ">INICIO DE MATRICULAS</label>
                    <input type="date" class="form-control" placeholder="sem_iMatriculaInicio" aria-label="sem_iMatriculaInicio_" id="sem_iMatriculaInicio_" style="font-size:12px;">
                  </div>
                  <div class="col-sm">
                    <label for="colFormLabelSm" class=" col-form-label  tamletra ">CIERRE DE MATRICULAS</label>
                    <input type="date" class="form-control" placeholder="sem_iMatriculaFinal" aria-label="sem_iMatriculaFinal_" id="sem_iMatriculaFinal_" style="font-size:12px;">
                  </div>
                  <div class="col-sm">
                    <label for="colFormLabelSm" class=" col-form-label  tamletra ">INICIO DE ENCUESTA</label>
                    <input type="date" class="form-control" placeholder="sem_dEncuestaInicio" aria-label="sem_dEncuestaInicio_" id="sem_dEncuestaInicio_" style="font-size:12px;">
                  </div>
            
                  <div class="col-sm">
                    <label for="colFormLabelSm" class=" col-form-label  tamletra ">CIERRE DE ENCUESTA</label>
                    <input type="date" class="form-control" placeholder="sem_dEncuestaFinal" aria-label="sem_dEncuestaFinal_" id="sem_dEncuestaFinal_" style="font-size:12px;">
                  </div>                
                </div>
                   
                                    
                <div class="row g-4">
                  <div class="col-sm">
                    <label for="colFormLabelSm" class=" col-form-label  tamletra ">INICIO DE ACTAS</label>
                    <input type="date" class="form-control" placeholder="sem_dActaInicio" aria-label="sem_dActaInicio_" id="sem_dActaInicio_" style="font-size:12px;">
                  </div>
            
                  <div class="col-sm">
                    <label for="colFormLabelSm" class=" col-form-label  tamletra ">CIERRE DE ACTAS</label>
                    <input type="date" class="form-control" placeholder="sem_dActaFinal" aria-label="sem_dActaFinal_" id="sem_dActaFinal_" style="font-size:12px;">
                  </div>
                  <div class="col-sm">
                    <label for="colFormLabelSm" class=" col-form-label  tamletra ">INICIO UNIDAD I</label>
                    <input type="date" class="form-control" placeholder="fech_ent1_ini" aria-label="fech_ent1_ini_" id="fech_ent1_ini_" style="font-size:12px;">
                  </div>
            
                  <div class="col-sm">
                    <label for="colFormLabelSm" class=" col-form-label  tamletra ">CIERRE UNIDAD I</label>
                    <input type="date" class="form-control" placeholder="fech_ent1_fin" aria-label="fech_ent1_fin_" id="fech_ent1_fin_" style="font-size:12px;" >
                  </div>                  
                </div>

                <div class="row g-4 ">   
                  <div class="col-sm">
                    <label for="colFormLabelSm" class="col-form-label  tamletra">INICIO UNIDAD II</label>
                      <input type="date" class="form-control" placeholder="fech_ent2_ini" aria-label="fech_ent2_ini_" id="fech_ent2_ini_" style="font-size:12px;">
                  </div>
                  <div class="col-sm">
                    <label for="colFormLabelSm" class="col-form-label  tamletra">CIERRE UNIDAD II</label>
                    <input type="date" class="form-control" placeholder="fech_ent2_fin" aria-label="fech_ent2_fin_" id="fech_ent2_fin_" style="font-size:12px;">
                  </div>
                  <div class="col-sm">
                    <label for="colFormLabelSm" class="col-form-label  tamletra">INICIO UNIDAD III</label>
                    <input type="date" class="form-control" placeholder="fech_ent3_ini" aria-label="fech_ent3_ini_" id="fech_ent3_ini_" style="font-size:12px;">
                  </div>
                  <div class="col-sm">
                    <label for="colFormLabelSm" class="col-form-label  tamletra">CIERRE UNIDAD III</label>
                    <input type="date" class="form-control" placeholder="fech_ent3_fin" aria-label="fech_ent3_fin_" id="fech_ent3_fin_" style="font-size:12px;">
                  </div>
                </div>
            
                <div class="row g-4">
                  <div class="col-sm">
                    <label for="colFormLabelSm" class="col-form-label  tamletra">INICIO UNIDAD IV</label>
                      <input type="date" class="form-control" placeholder="fech_ent4_ini" aria-label="fech_ent4_ini_" id="fech_ent4_ini_" style="font-size:12px;">
                  </div>
                  <div class="col-sm">
                    <label for="colFormLabelSm" class="col-form-label  tamletra">CIERRE UNIDAD IV</label>
                    <input type="date" class="form-control" placeholder="fech_ent2_fin" aria-label="fech_ent4_fin_" id="fech_ent4_fin_" style="font-size:12px;">
                  </div>
                  <div class="col-sm">
                    <label for="colFormLabelSm" class="col-form-label  tamletra">INICIO UNIDAD V</label>
                    <input type="date" class="form-control" placeholder="fech_ent5_ini" aria-label="fech_ent5_ini_" id="fech_ent5_ini_" style="font-size:12px;">
                  </div>
            
                  <div class="col-sm">
                    <label for="colFormLabelSm" class="col-form-label  tamletra">CIERRE UNIDAD V</label>
                    <input type="date" class="form-control" placeholder="fech_ent5_fin" aria-label="fech_ent5_fin_" id="fech_ent5_fin_" style="font-size:12px;">
                  </div>
                </div>
            
                <div class="row g-4">
                  <div class="col-sm">
                    <label for="colFormLabelSm" class="col-form-label  tamletra">INICIO APLAZADOS</label>
                      <input type="date" class="form-control" placeholder="sem_dAplazadoInicio" aria-label="sem_dAplazadoInicio_" id="sem_dAplazadoInicio_" style="font-size:12px;">
                  </div>
                  <div class="col-sm">
                    <label for="colFormLabelSm" class="col-form-label  tamletra">CIERRE APLAZADOS</label>
                    <input type="date" class="form-control" placeholder="sem_dAplazadoFinal" aria-label="sem_dAplazadoFinal_" id="sem_dAplazadoFinal_" style="font-size:12px;">
                  </div>
                  <div class="col-sm">
                    <label for="colFormLabelSm" class="col-form-label  tamletra">INICIO SUSTITUTORIO</label>
                    <input type="date" class="form-control" placeholder="sem_dSustiInicio" aria-label="sem_dSustiInicio_" id="sem_dSustiInicio_" style="font-size:12px;">
                  </div>
            
                  <div class="col-sm">
                    <label for="colFormLabelSm" class="col-form-label  tamletra">CIERRE SUSTITUTORIO</label>
                    <input type="date" class="form-control" placeholder="sem_dSustiFinal" aria-label="sem_dSustiFinal_" id="sem_dSustiFinal_" style="font-size:12px;">
                  </div>
                </div>
            
                <div class="row g-4">
                  <div class="col-sm-3">
                    <label for="colFormLabelSm" class="col-form-label  tamletra">INICIO MATRICULA REGULAR</label>
                    <input type="date" class="form-control" placeholder="fecMatReg_ini" aria-label="fecMatReg_ini_" id="fecMatReg_ini_" style="font-size:12px;">
                  </div>
            
                  <div class="col-sm-3">
                    <label for="colFormLabelSm" class="col-form-label  tamletra">CIERRE MATRICULA REGULAR</label>
                    <input type="date" class="form-control" placeholder="fecMatReg_fin" aria-label="fecMatReg_fin_" id="fecMatReg_fin_" style="font-size:12px;">
                  </div>
                  <div class="col-sm-3">
                    <label for="colFormLabelSm" class="col-form-label  tamletra">INICIO  MATRICULA EXTEMPORANEA</label>
                      <input type="date" class="form-control" placeholder="fecMatExt_ini" aria-label="fecMatExt_ini_" id="fecMatExt_ini_" style="font-size:12px;">
                  </div>
                  <div class="col-sm-3">
                    <label for="colFormLabelSm" class="col-form-label  tamletra">CIERRE MATRICULA EXTEMPORANEA</label>
                    <input type="date" class="form-control" placeholder="fecMatExt_fin" aria-label="fecMatExt_fin_" id="fecMatExt_fin_" style="font-size:12px;">
                  </div>
                </div>
                <br>
                <!--div class="row g-4" align="center">                  
                  <button type="button" class="btn btn-primary" onclick="modificarfechasemetre();revisarestadofecha();">
                  <i class="fas fa-save"></i> GUARDAR CAMBIOS</button>                   
                </div-->
              
            </div>
            
            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" onclick="cerrarAbrirN();">Cerrar y Abrir Nuevo</button>
              <button type="button" class="btn btn-secondary" id="ocultarModSem" data-dismiss="modal" style="display:none;">Close</button>
            </div>
            
          </div>
        </div>
      </div>

      <script type="text/javascript">
        
        function openVerificNotsSetDateSem()
        {          
          //Evaluar Notas, para ver si hay alguna observación               
          $('#openModSem').click();//abrir modulo de datos del nuevo semestre     
        }

        function cerrarAbrirN()
        {          
          if(validacionCreacion())
          {
            cerrarSemestre('{{$semestre_act->sem_iCodigo}}');  
            $("#ocultarModSem").click();//Cerrar modulo de datos del nuevo semestre            
          }
        }

        function validacionCreacion()
        {
          let key = true;
          
          if($("#codsemestre_").val()=="" || !Number.isInteger(parseFloat($("#codsemestre_").val())))
          {
            $("#codsemestre_").css("border","1px solid red");
            key=false;
          }
          else
          {
            $("#codsemestre_").css("border","1px solid #d1d3e2");
          }

          if($("#nomsemestre_").val()=="")
          {
            $("#nomsemestre_").css("border","1px solid red");
            key=false;
          }
          else
          {
            $("#nomsemestre_").css("border","1px solid #d1d3e2");
          }

          if($("#sem_dInicioClases_").val()=="")
          {
            $("#sem_dInicioClases_").css("border","1px solid red");
            key=false;
          }
          else
          {
            $("#sem_dInicioClases_").css("border","1px solid #d1d3e2");
          }

          if($("#sem_iSemanas_").val()=="")
          {
            $("#sem_iSemanas_").css("border","1px solid red");
            key=false;
          }
          else
          {
            $("#sem_iSemanas_").css("border","1px solid #d1d3e2");
          }

          if($("#sem_iToleranciaInicio_").val()=="")
          {
            $("#sem_iToleranciaInicio_").css("border","1px solid red");
            key=false;
          }
          else
          {
            $("#sem_iToleranciaInicio_").css("border","1px solid #d1d3e2");
          }

          if($("#sem_iToleranciaFinal_").val()=="")
          {
            $("#sem_iToleranciaFinal_").css("border","1px solid red");
            key=false;
          }
          else
          {
            $("#sem_iToleranciaFinal_").css("border","1px solid #d1d3e2");
          }

          if($("#sem_iMatriculaInicio_").val()=="")
          {
            $("#sem_iMatriculaInicio_").css("border","1px solid red");
            key=false;
          }
          else
          {
            $("#sem_iMatriculaInicio_").css("border","1px solid #d1d3e2");
          }

          if($("#sem_iMatriculaFinal_").val()=="")
          {
            $("#sem_iMatriculaFinal_").css("border","1px solid red");
            key=false;
          }
          else
          {
            $("#sem_iMatriculaFinal_").css("border","1px solid #d1d3e2");
          }

          if($("#sem_dEncuestaInicio_").val()=="")
          {
            $("#sem_dEncuestaInicio_").css("border","1px solid red");
            key=false;
          }
          else
          {
            $("#sem_dEncuestaInicio_").css("border","1px solid #d1d3e2");
          }

          if($("#sem_dEncuestaFinal_").val()=="")
          {
            $("#sem_dEncuestaFinal_").css("border","1px solid red");
            key=false;
          }
          else
          {
            $("#sem_dEncuestaFinal_").css("border","1px solid #d1d3e2");
          }

          if($("#sem_dActaInicio_").val()=="")
          {
            $("#sem_dActaInicio_").css("border","1px solid red");
            key=false;
          }
          else
          {
            $("#sem_dActaInicio_").css("border","1px solid #d1d3e2");
          }

          if($("#sem_dActaFinal_").val()=="")
          {
            $("#sem_dActaFinal_").css("border","1px solid red");
            key=false;
          }
          else
          {
            $("#sem_dActaFinal_").css("border","1px solid #d1d3e2");
          }

          if($("#fech_ent1_ini_").val()=="")
          {
            $("#fech_ent1_ini_").css("border","1px solid red");
            key=false;
          }
          else
          {
            $("#fech_ent1_ini_").css("border","1px solid #d1d3e2");
          }

          if($("#fech_ent1_fin_").val()=="")
          {
            $("#fech_ent1_fin_").css("border","1px solid red");
            key=false;
          }
          else
          {
            $("#fech_ent1_fin_").css("border","1px solid #d1d3e2");
          }

          if($("#fech_ent2_ini_").val()=="")
          {
            $("#fech_ent2_ini_").css("border","1px solid red");
            key=false;
          }
          else
          {
            $("#fech_ent2_ini_").css("border","1px solid #d1d3e2");
          }
          if($("#fech_ent2_fin_").val()=="")
          {
            $("#fech_ent2_fin_").css("border","1px solid red");
            key=false;
          }
          else
          {
            $("#fech_ent2_fin_").css("border","1px solid #d1d3e2");
          }
          if($("#fech_ent3_ini_").val()=="")
          {
            $("#fech_ent3_ini_").css("border","1px solid red");
            key=false;
          }
          else
          {
            $("#fech_ent3_ini_").css("border","1px solid #d1d3e2");
          }
          if($("#fech_ent3_fin_").val()=="")
          {
            $("#fech_ent3_fin_").css("border","1px solid red");
            key=false;
          }
          else
          {
            $("#fech_ent3_fin_").css("border","1px solid #d1d3e2");
          }

          if($("#fech_ent4_ini_").val()=="")
          {
            $("#fech_ent4_ini_").css("border","1px solid red");
            key=false;
          }
          else
          {
            $("#fech_ent4_ini_").css("border","1px solid #d1d3e2");
          }
          if($("#fech_ent4_fin_").val()=="")
          {
            $("#fech_ent4_fin_").css("border","1px solid red");
            key=false;
          }
          else
          {
            $("#fech_ent4_fin_").css("border","1px solid #d1d3e2");
          }

          if($("#fech_ent5_ini_").val()=="")
          {
            $("#fech_ent5_ini_").css("border","1px solid red");
            key=false;
          }
          else
          {
            $("#fech_ent5_ini_").css("border","1px solid #d1d3e2");
          }
          if($("#fech_ent5_fin_").val()=="")
          {
            $("#fech_ent5_fin_").css("border","1px solid red");
            key=false;
          }
          else
          {
            $("#fech_ent5_fin_").css("border","1px solid #d1d3e2");
          }

          if($("#sem_dAplazadoInicio_").val()=="")
          {
            $("#sem_dAplazadoInicio_").css("border","1px solid red");
            key=false;
          }
          else
          {
            $("#sem_dAplazadoInicio_").css("border","1px solid #d1d3e2");
          }
          if($("#sem_dAplazadoFinal_").val()=="")
          {
            $("#sem_dAplazadoFinal_").css("border","1px solid red");
            key=false;
          }
          else
          {
            $("#sem_dAplazadoFinal_").css("border","1px solid #d1d3e2");
          }

          if($("#sem_dSustiInicio_").val()=="")
          {
            $("#sem_dSustiInicio_").css("border","1px solid red");
            key=false;
          }
          else
          {
            $("#sem_dSustiInicio_").css("border","1px solid #d1d3e2");
          }
          if($("#sem_dSustiFinal_").val()=="")
          {
            $("#sem_dSustiFinal_").css("border","1px solid red");
            key=false;
          }
          else
          {
            $("#sem_dSustiFinal_").css("border","1px solid #d1d3e2");
          }
          if($("#fecMatReg_ini_").val()=="")
          {
            $("#fecMatReg_ini_").css("border","1px solid red");
            key=false;
          }
          else
          {
            $("#fecMatReg_ini_").css("border","1px solid #d1d3e2");
          }
          if($("#fecMatReg_fin_").val()=="")
          {
            $("#fecMatReg_fin_").css("border","1px solid red");
            key=false;
          }
          else
          {
            $("#fecMatReg_fin_").css("border","1px solid #d1d3e2");
          }

          if($("#fecMatExt_ini_").val()=="")
          {
            $("#fecMatExt_ini_").css("border","1px solid red");
            key=false;
          }
          else
          {
            $("#fecMatExt_ini_").css("border","1px solid #d1d3e2");
          }
          if($("#fecMatExt_fin_").val()=="")
          {
            $("#fecMatExt_fin_").css("border","1px solid red");
            key=false;
          }
          else
          {
            $("#fecMatExt_fin_").css("border","1px solid #d1d3e2");
          }

          return key;
        }

        function IniciarSemestre()
        {    
          //  asis_gen_asistencia_alumno();      
          ///cerrarSemestre('{{$semestre_act->sem_iCodigo}}');  
          //$("#ocultarModSem").click();//Cerrar modulo de datos del nuevo semestre
        }


      </script>


      <!-- Modal acctualizar -->
      <div class="modal fade" id="animal_edit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Editar Calendario semestre</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="$('#animal_edit_modal').modal('hide');">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id="animal_edit_form">
              <div class="modal-body">
                @csrf
                @include('admin.semestrefechas')          
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

      <!-- Editar semestre -->
      <div class="modal fade" id="editarSemestre" tabindex="-1" role="dialog" aria-labelledby="modalEditarSemestre" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalEditarSemestre">Editar Semestre</h5>
              <button type="button" class="close"  data-dismiss="modal" aria-label="Close" onclick="$('#editarSemestre').modal('hide');">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$('#editarSemestre').modal('hide');">Cancelar</button>
              <button type="button" class="btn btn-danger" name="btnEditSemestre" id="btnEditSemestre">Eliminar</button>
            </div>
          </div>
        </div>
      </div>

    </div><!-- //fin container //-->
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script>
      $('#registro-animal').submit(function(e)
      {
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
            success:function(response)
            {
              if(response)
              {
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
      $(document).on('click','.delete',function()
      {
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
      function editarAnimal(id)
      {
        $.get('admin/docente/'+id,function(animal)
        {
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
      $(document).ready(function() 
      {   
         //$('#tabla-semestre').DataTable();
      } );
     
      function vercalendario(element)
      { 
        $("#cargando").show();
        var t1={{$n}};
        var sem1=element.value;
        //alert(sem1)
        for(x=0;x<=t1;x++)
        {
          if(semestre[x]==sem1)
          { 
            //console.log(sem_iMatriculaInicio[x]);
            //alert(fecMatReg_ini[x]);
            $("#sem_iMatriculaInicio").val(sem_iMatriculaInicio[x]);
            $("#sem_iMatriculaFinal").val(sem_iMatriculaFinal[x]);
            $("#sem_dEncuestaInicio").val(sem_dEncuestaInicio[x]);
            $("#sem_dEncuestaFinal").val(sem_dEncuestaFinal[x]);
            $("#sem_dInicioClases").val(sem_dInicioClases[x]);
            $("#sem_iSemanas").val(sem_iSemanas[x]);
            $("#sem_dActaInicio").val(sem_dActaInicio[x]);
            $("#sem_dActaFinal").val(sem_dActaFinal[x]);
            $("#sem_iToleranciaInicio").val(sem_iToleranciaInicio[x]);
            $("#sem_iToleranciaFinal").val(sem_iToleranciaFinal[x]);
            $("#fech_ent1_ini").val(fech_ent1_ini[x]);
            $("#fech_ent1_fin").val(fech_ent1_fin[x]);
            $("#fech_ent2_ini").val(fech_ent2_ini[x]);
            $("#fech_ent2_fin").val(fech_ent2_fin[x]);
            $("#fech_ent3_ini").val(fech_ent3_ini[x]);
            $("#fech_ent3_fin").val(fech_ent3_fin[x]);
            $("#fech_ent4_ini").val(fech_ent4_ini[x]);
            $("#fech_ent4_fin").val(fech_ent4_fin[x]);
            $("#fech_ent5_ini").val(fech_ent5_ini[x]);
            $("#fech_ent5_fin").val(fech_ent5_fin[x]);
            $("#sem_dAplazadoInicio").val(sem_dAplazadoInicio[x]);
            $("#sem_dAplazadoFinal").val(sem_dAplazadoFinal[x]);
            $("#sem_dSustiInicio").val(sem_dSustiInicio[x]);
            $("#sem_dSustiFinal").val(sem_dSustiFinal[x]);
            $("#fecMatReg_ini").val(fecMatReg_ini[x]);
            $("#fecMatReg_fin").val(fecMatReg_fin[x]);
            $("#fecMatExt_ini").val(fecMatExt_ini[x]);
            $("#fecMatExt_fin").val(fecMatExt_fin[x]);

            if(sem_cActivo[x]=="S")
              $("#btnUpdate_").show();
            else
              $("#btnUpdate_").hide();
          }
        }
        $("#cargando").hide();
      }

      function revisarestadofecha()
      { 
        //inicio de cambio de color
        $("#sem_iMatriculaInicio").css('background-color', 'white');
        $("#sem_iMatriculaFinal").css('background-color', 'white');
        $("#sem_dEncuestaInicio").css('background-color', 'white');
        $("#sem_dEncuestaFinal").css('background-color', 'white');
        $("#sem_dInicioClases").css('background-color', 'white');
        $("#sem_iSemanas").css('background-color', 'white');
        $("#sem_dActaInicio").css('background-color', 'white');
        $("#sem_dActaFinal").css('background-color', 'white');
        $("#sem_iToleranciaInicio").css('background-color', 'white');
        $("#sem_iToleranciaFinal").css('background-color', 'white');
        $("#fech_ent1_ini").css('background-color', 'white');
        $("#fech_ent1_fin").css('background-color', 'white');
        $("#fech_ent2_ini").css('background-color', 'white');
        $("#fech_ent2_fin").css('background-color', 'white');
        $("#fech_ent3_ini").css('background-color', 'white');
        $("#fech_ent3_fin").css('background-color', 'white');
        $("#fech_ent4_ini").css('background-color', 'white');
        $("#fech_ent4_fin").css('background-color', 'white');
        $("#fech_ent5_ini").css('background-color', 'white');
        $("#fech_ent5_fin").css('background-color', 'white');
        $("#sem_dAplazadoInicio").css('background-color', 'white');
        $("#sem_dAplazadoFinal").css('background-color', 'white');
        $("#sem_dSustiInicio").css('background-color', 'white');
        $("#sem_dSustiFinal").css('background-color', 'white');
        $("#fecMatReg_ini").css('background-color', 'white');
        $("#fecMatReg_fin").css('background-color', 'white');
        $("#fecMatExt_ini").css('background-color', 'white');
        $("#fecMatExt_fin").css('background-color', 'white'); 
        ///fin cambio de color   
        if($("#sem_iMatriculaInicio").val()=="")
        $("#sem_iMatriculaInicio").css('background-color', 'lightyellow');

        if($("#sem_iMatriculaFinal").val()=="")
        $("#sem_iMatriculaFinal").css('background-color', 'lightyellow');

        if($("#sem_dEncuestaInicio").val()=="")
        $("#sem_dEncuestaInicio").css('background-color', 'lightyellow');

        if($("#sem_dEncuestaFinal").val()=="")
        $("#sem_dEncuestaFinal").css('background-color', 'lightyellow');

        if($("#sem_dInicioClases").val()=="")
        $("#sem_dInicioClases").css('background-color', 'lightyellow');

        if($("#sem_iSemanas").val()=="")
        $("#sem_iSemanas").css('background-color', 'lightyellow');

        if($("#sem_dActaInicio").val()=="")
        $("#sem_dActaInicio").css('background-color', 'lightyellow');

        if($("#sem_dActaFinal").val()=="")
        $("#sem_dActaFinal").css('background-color', 'lightyellow');

        if($("#sem_iToleranciaInicio").val()=="")
        $("#sem_iToleranciaInicio").css('background-color', 'lightyellow');

        if($("#sem_iToleranciaFinal").val()=="")
        $("#sem_iToleranciaFinal").css('background-color', 'lightyellow');

        if($("#fech_ent1_ini").val()=="")
        $("#fech_ent1_ini").css('background-color', 'lightyellow');

        if($("#fech_ent1_fin").val()=="")
        $("#fech_ent1_fin").css('background-color', 'lightyellow');

        if($("#fech_ent2_ini").val()=="")
        $("#fech_ent2_ini").css('background-color', 'lightyellow');

        if($("#fech_ent2_fin").val()=="")
        $("#fech_ent2_fin").css('background-color', 'lightyellow');

        if($("#fech_ent3_ini").val()=="")
        $("#fech_ent2_fin").css('background-color', 'lightyellow');

        if($("#fech_ent3_fin").val()=="")
        $("#fech_ent3_ini").css('background-color', 'lightyellow');

        if($("#fech_ent4_ini").val()=="")
        $("#fech_ent4_ini").css('background-color', 'lightyellow');

        if($("#fech_ent4_fin").val()=="")
        $("#fech_ent4_fin").css('background-color', 'lightyellow');

        if($("#fech_ent5_ini").val()=="")
        $("#fech_ent5_ini").css('background-color', 'lightyellow');

        if($("#fech_ent5_fin").val()=="")
        $("#fech_ent5_fin").css('background-color', 'lightyellow');

        if($("#sem_dAplazadoInicio").val()=="")
        $("#sem_dAplazadoInicio").css('background-color', 'lightyellow');

        if($("#sem_dAplazadoFinal").val()=="")
        $("#sem_dAplazadoFinal").css('background-color', 'lightyellow');

        if($("#sem_dSustiInicio").val()=="")
        $("#sem_dSustiInicio").css('background-color', 'lightyellow');

        if($("#sem_dSustiFinal").val()=="")
        $("#sem_dSustiFinal").css('background-color', 'lightyellow');

        if($("#fecMatReg_ini").val()=="")
        $("#fecMatReg_ini").css('background-color', 'lightyellow');

        if($("#fecMatReg_fin").val()=="")
        $("#fecMatReg_fin").css('background-color', 'lightyellow');

        if($("#fecMatExt_ini").val()=="")
        $("#fecMatExt_ini").css('background-color', 'lightyellow');

        if($("#fecMatExt_fin").val()=="")
        $("#fecMatExt_fin").css('background-color', 'lightyellow');
      }
        
    </script>

    <!--div id="mimensajex">GRABANDO</div-->
