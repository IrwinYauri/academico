@php

namespace App\Http\Controllers;

use App\Models\Docente_clase;
use App\Models\Docente_categoria;
use App\Models\Docente_tipo;
use App\Models\Docentedepaca;

use Illuminate\Http\Request;
@endphp
<div class="container">
    <div class="card">
        
        <form action="regtablacampo.php" class="was-validated">
            <input type="hidden" value="docente" name="n">
            <div class="row g-4">
                <div class="col-sm">
                    <label for="doc_iCodigo">doc_iCodigo</label>
                    <input type="text" class="form-control" id="doc_iCodigo1" placeholder="doc_iCodigo"
                        name="doc_iCodigo"  disabled>
                    <!-- <div class="valid-feedback">Valid.</div>
    <div class="invalid-feedback">Please fill out this field.</div> //-->
                </div>


                <div class="col-sm">
                    <label for="doc_vcDocumento">NRO DNI</label>
                    <input type="text" class="form-control" id="doc_vcDocumento1" placeholder="doc_vcDocumento"
                        name="doc_vcDocumento" required>
                    <!-- <div class="valid-feedback">Valid.</div>
    <div class="invalid-feedback">Please fill out this field.</div> //-->
                </div>
            </div>

            <div class="row g-8">

                <div class="col-sm">
                    <label for="doc_vcPaterno">Apellido Paterno</label>
                    <input type="text" class="form-control" id="doc_vcPaterno1" placeholder="doc_vcPaterno"
                        name="doc_vcPaterno" required>
                    <!-- <div class="valid-feedback">Valid.</div>
    <div class="invalid-feedback">Please fill out this field.</div> //-->
                </div>


                <div class="col-sm">
                    <label for="doc_vcMaterno">Apellido Materno</label>
                    <input type="text" class="form-control" id="doc_vcMaterno1" placeholder="doc_vcMaterno"
                        name="doc_vcMaterno" required>
                    <!-- <div class="valid-feedback">Valid.</div>
    <div class="invalid-feedback">Please fill out this field.</div> //-->
                </div>


                <div class="col-sm">
                    <label for="doc_vcNombre">Nombres</label>
                    <input type="text" class="form-control" id="doc_vcNombre1" placeholder="doc_vcNombre"
                        name="doc_vcNombre" required>
                    <!-- <div class="valid-feedback">Valid.</div>
    <div class="invalid-feedback">Please fill out this field.</div> //-->
                </div>

            </div>

            <div class="row g-8">

                <div class="col-sm">
                    <label for="doc_cActivo">Estado</label>
                  <!--  <input type="text" class="form-control" id="doc_cActivo" placeholder="doc_cActivo"
                        name="doc_cActivo" required> //-->
                        <select name="doc_cActivo" id="doc_cActivo1" class="form-control">
                          <option>S</option>
                          <option>N</option>
                            
                        </select>
                    <!-- <div class="valid-feedback">Valid.</div>
    <div class="invalid-feedback">Please fill out this field.</div> //-->
                </div>


                <div class="col-sm">
                    <label for="depaca_iCodigo">DEP. ACADEMICO</label>
                    <select name="depaca_iCodigo" id="depaca_iCodigo1" class="form-control">

                        @php
                         //   $dataclase = Docente_clase::all();
                         $dataclase = Docentedepaca::select('depaca_iCodigo','depaca_vcNombre')->get();
                        @endphp
                        @foreach ($dataclase as $item)
                        <option value="{{$item->depaca_iCodigo }}">
                          {{$item->depaca_vcNombre }}
                          </option>
                        @endforeach
                        
                    </select>
                  <!--  <input type="text" class="form-control" id="depaca_iCodigo" placeholder="depaca_iCodigo"
                        name="depaca_iCodigo" required> //-->
                    <!-- <div class="valid-feedback">Valid.</div>
    <div class="invalid-feedback">Please fill out this field.</div> //-->
                </div>


                <div class="col-sm">
                    <label for="doccat_iCodigo">MODALIDAD CARGO</label>
                    <select name="doccat_iCodigo" id="doccat_iCodigo1" class="form-control">

                        @php
                         //   $dataclase = Docente_clase::all();
                         $dataclase = Docente_categoria::select('doccat_iCodigo','doccat_vcNombre')->get();
                        @endphp
                        @foreach ($dataclase as $item)
                        <option value="{{$item->doccat_iCodigo }}">
                          {{$item->doccat_vcNombre }}
                          </option>
                        @endforeach
                        
                    </select>

                  <!--   <input type="text" class="form-control" id="doccat_iCodigo" placeholder="doccat_iCodigo"
                        name="doccat_iCodigo" required> //-->
                    <!-- <div class="valid-feedback">Valid.</div>
    <div class="invalid-feedback">Please fill out this field.</div> //-->
                </div>


                <div class="col-sm">
                    <label for="doccla_iCodigo">Clasificacion</label>
                    <select name="doccla_iCodigo" id="doccla_iCodigo1" class="form-control">

                        @php
                         //   $dataclase = Docente_clase::all();
                         $dataclase = Docente_clase::select('doccla_iCodigo','doccla_vcNombre')->get();
                        @endphp
                        @foreach ($dataclase as $item)
                        <option value="{{$item->doccla_iCodigo }}">
                          {{$item->doccla_vcNombre }}
                          </option>
                        @endforeach
                        
                    </select>
                    <!--         <input type="text" class="form-control" id="doccla_iCodigo" placeholder="doccla_iCodigo"
                        name="doccla_iCodigo" required> //-->
                    <!-- <div class="valid-feedback">Valid.</div>
    <div class="invalid-feedback">Please fill out this field.</div> //-->
                </div>

            </div>

            <div style="display: none">
                <div class="col-sm">
                    <label for="doc_vcPassword">Password</label>
                    <input type="text" class="form-control" id="doc_vcPassword1" placeholder="doc_vcPassword"
                        name="doc_vcPassword" required>
                    <!-- <div class="valid-feedback">Valid.</div>
    <div class="invalid-feedback">Please fill out this field.</div> //-->
                </div>

                <div style="display: none">
                    <label for="doc_iPasswordCambiar">doc_iPasswordCambiar</label>
                    <input type="text" class="form-control" id="doc_iPasswordCambiar1"
                        placeholder="doc_iPasswordCambiar" name="doc_iPasswordCambiar" required>
                    <!-- <div class="valid-feedback">Valid.</div>
    <div class="invalid-feedback">Please fill out this field.</div> //-->
                </div>
            </div>

            <div class="row g-8">
                <div class="col-sm">
                    <label for="doc_vcTelefonoFijo">Telefono Fijo</label>
                    <input type="text" class="form-control" id="doc_vcTelefonoFijo1" placeholder="doc_vcTelefonoFijo"
                        name="doc_vcTelefonoFijo" required>
                    <!-- <div class="valid-feedback">Valid.</div>
    <div class="invalid-feedback">Please fill out this field.</div> //-->
                </div>


                <div class="col-sm">
                    <label for="doc_vcTelefonoCelular"> Telefono Celular</label>
                    <input type="text" class="form-control" id="doc_vcTelefonoCelular1"
                        placeholder="doc_vcTelefonoCelular" name="doc_vcTelefonoCelular" required>
                    <!-- <div class="valid-feedback">Valid.</div>
    <div class="invalid-feedback">Please fill out this field.</div> //-->
                </div>


                <div class="col-sm">
                    <label for="doc_vcEmail1">Email Primario</label>
                    <input type="text" class="form-control" id="doc_vcEmail11" placeholder="doc_vcEmail1"
                        name="doc_vcEmail1" required>
                    <!-- <div class="valid-feedback">Valid.</div>
    <div class="invalid-feedback">Please fill out this field.</div> //-->
                </div>


                <div class="col-sm">
                    <label for="doc_vcEmail2">Email Secundario</label>
                    <input type="text" class="form-control" id="doc_vcEmail21" placeholder="doc_vcEmail2"
                        name="doc_vcEmail2" >
                    <!-- <div class="valid-feedback">Valid.</div>
    <div class="invalid-feedback">Please fill out this field.</div> //-->
                </div>
            </div>
            <div class="row g-8">
                <div class="col-sm">
                    <label for="condDocente">Tipo de contrato</label>
                    <select name="condDocente" id="condDocente1" class="form-control">

                        @php
                         //   $dataclase = Docente_clase::all();
                         $dataclase = Docente_tipo::select('doctip_iCodigo','doctip_vcNombre')->get();
                        @endphp
                        @foreach ($dataclase as $item)
                        <option >
                          {{$item->doctip_vcNombre }}
                          </option>
                        @endforeach
                        
                    </select>

                    <!--      <input type="text" class="form-control" id="condDocente" placeholder="condDocente"
                        name="condDocente" required>//-->
                    <!-- <div class="valid-feedback">Valid.</div>
    <div class="invalid-feedback">Please fill out this field.</div> //-->
                </div>


                <div style="display: none">
                    <label for="cateDocente">cateDocente</label>
                   
                    -    <input type="text" class="form-control" id="cateDocente1" placeholder="cateDocente"
                        name="cateDocente" required>
                    <!-- <div class="valid-feedback">Valid.</div>
    <div class="invalid-feedback">Please fill out this field.</div> //-->
                </div>
            </div>
            <div class="row g-4">
                <div class="col-sm">
                    <br>
            <button type="button" class="btn btn-success btn-lg" onclick="procesareditar()">ACTUALIZAR</button>
                    </div>    
        </div>
          
            
        </form>
    </div>
</div>




<script src="{{ asset('datatable/js/jquery-1.12.4.js')}}"></script>

<script>
    // Disable form submissions if there are invalid fields
    function procesareditar()
    {
     // r= document.getElementById("doccat_iCodigo").text;
      elem=document.getElementById("doccat_iCodigo1");
      document.getElementById("cateDocente1").value=elem.options[elem.selectedIndex].text;

    doc_iCodigo=$("#doc_iCodigo1").val();
    doc_vcDocumento=$("#doc_vcDocumento1").val();
    doc_vcPaterno=$("#doc_vcPaterno1").val();
    doc_vcMaterno=$("#doc_vcMaterno1").val();
    doc_vcNombre=$("#doc_vcNombre1").val();
    doc_cActivo=$("#doc_cActivo1").val();
    depaca_iCodigo=$("#depaca_iCodigo1").val();
    doccat_iCodigo=$("#doccat_iCodigo1").val();
    doccla_iCodigo=$("#doccla_iCodigo1").val();
    doc_vcPassword=$("#doc_vcPassword1").val();
    doc_iPasswordCambiar=$("#doc_iPasswordCambiar1").val();
    doc_vcTelefonoFijo=$("#doc_vcTelefonoFijo1").val();
    doc_vcTelefonoCelular=$("#doc_vcTelefonoCelular1").val();
    doc_vcEmail1=$("#doc_vcEmail11").val();
    doc_vcEmail2=$("#doc_vcEmail21").val();
    condDocente=$("#condDocente1").val();
    cateDocente=$("#cateDocente1").val();

    editardocente(doc_iCodigo,doc_vcDocumento,
    doc_vcPaterno,doc_vcMaterno,
    doc_vcNombre,doc_cActivo,
    depaca_iCodigo,doccat_iCodigo,
    doccla_iCodigo,doc_vcPassword,
    doc_iPasswordCambiar,doc_vcTelefonoFijo,
    doc_vcTelefonoCelular,doc_vcEmail1,
    doc_vcEmail2,condDocente,cateDocente
    );

   //   alert(elem.options[elem.selectedIndex].text);
    //  alert(r)
    //  document.getElementById("doccat_iCodigo").value=2
    }
    function validar() {
        // Get the forms we want to add validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }

    function editardocente(doc_iCodigo,doc_vcDocumento,
    doc_vcPaterno,doc_vcMaterno,
    doc_vcNombre,doc_cActivo,
    depaca_iCodigo,doccat_iCodigo,
    doccla_iCodigo,doc_vcPassword,
    doc_iPasswordCambiar,doc_vcTelefonoFijo,
    doc_vcTelefonoCelular,doc_vcEmail1,
    doc_vcEmail2,condDocente,cateDocente
    )
 {

   //$("#micontenido" ).load( "../crud/registrardocente" );
     $.ajax({
		url:"{{asset('crud/editardocente')}}",
	success:function(result){
	//alert(result);
    $('#modaleditar').modal('hide');
	$("#divprueba").html(result);
    alertagrabarx("DOCENTE ACTUALIZADO","#301934");
	//$("#cargando").hide();

	 },
	data:{
        doc_iCodigo:doc_iCodigo,
        doc_vcDocumento:doc_vcDocumento,
    doc_vcPaterno:doc_vcPaterno,
    doc_vcMaterno:doc_vcMaterno,
    doc_vcNombre:doc_vcNombre,
    doc_cActivo:doc_cActivo,
    depaca_iCodigo:depaca_iCodigo,
    doccat_iCodigo:doccat_iCodigo,
    doccla_iCodigo:doccla_iCodigo,
    doc_vcPassword:doc_vcPassword,
    doc_iPasswordCambiar:doc_iPasswordCambiar,
    doc_vcTelefonoFijo:doc_vcTelefonoFijo,
    doc_vcTelefonoCelular:doc_vcTelefonoCelular,
    doc_vcEmail1:doc_vcEmail1,
    doc_vcEmail2:doc_vcEmail2,
    condDocente:condDocente,
    cateDocente:cateDocente
	  },
		type:"GET"   
	 } );
	
}

function limpiar()
{
    $("#doc_iCodigo").val("");
    $("#doc_vcDocumento").val("");
    $("#doc_vcPaterno").val("");
    $("#doc_vcMaterno").val("");
    $("#doc_vcNombre").val("");
    $("#doc_cActivo").val("S");
    $("#depaca_iCodigo").val("");
    $("#doccat_iCodigo").val("");
    $("#doccla_iCodigo").val("");
    $("#doc_vcPassword").val("");
    $("#doc_iPasswordCambiar").val("");
    $("#doc_vcTelefonoFijo").val("");
    $("#doc_vcTelefonoCelular").val("");
    $("#doc_vcEmail1").val("");
    $("#doc_vcEmail2").val("");
    $("#condDocente").val("");
    $("#cateDocente").val("");
}
</script>
<div id="micontenidoww">

</div>
<div id="mimensajex">GRABANDO</div>