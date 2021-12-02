@php

namespace App\Http\Controllers;

use App\Models\Alumno;
$id="0";

if(isset($_REQUEST["id"]))
$id=$_REQUEST["id"];

//$xalumno=Alumno::where('alu_iCodigo','=', $id)->first();

//$xalumno=Alumno::all();
//dd($xalumno);
$xalumno=Alumno::find($id);
if(is_null($xalumno))
{echo "Sin datos";
return "";}
@endphp



<form action="regtablacampo.php" class="was-validated">
    <input type="hidden" value="alumno" name="n">
    <div class="row g-4">

        <div class="col-sm">

            <label for="alu_iCodigo">alu_iCodigo</label>
            <input type="text" class="form-control" id="alu_iCodigo" placeholder="alu_iCodigo" name="alu_iCodigo"
            value="{{$xalumno->alu_iCodigo}}"
                required>
            <!-- <div class="valid-feedback">Valid.</div>
  <div class="invalid-feedback">Please fill out this field.</div> //-->
        </div>


        <div class="col-sm">
            <label for="alu_vcCodigo">alu_vcCodigo</label>
            <input type="text" class="form-control" id="alu_vcCodigo" placeholder="alu_vcCodigo" name="alu_vcCodigo"
            value="{{$xalumno->alu_vcCodigo}}"
                required>
            <!-- <div class="valid-feedback">Valid.</div>
  <div class="invalid-feedback">Please fill out this field.</div> //-->
        </div>


        <div class="col-sm">
            <label for="alu_vcDocumento">alu_vcDocumento</label>
            <input type="text" class="form-control" id="alu_vcDocumento" placeholder="alu_vcDocumento"
            value="{{$xalumno->alu_vcDocumento}}"
                name="alu_vcDocumento" required>
            <!-- <div class="valid-feedback">Valid.</div>
  <div class="invalid-feedback">Please fill out this field.</div> //-->
        </div>
    </div>
    <div class="row g-4">
        <div class="col-sm">
            <label for="alu_vcPaterno">alu_vcPaterno</label>
            <input type="text" class="form-control" id="alu_vcPaterno" placeholder="alu_vcPaterno"
            value="{{$xalumno->alu_vcPaterno}}"
                name="alu_vcPaterno" required>
            <!-- <div class="valid-feedback">Valid.</div>
  <div class="invalid-feedback">Please fill out this field.</div> //-->
        </div>


        <div class="col-sm">
            <label for="alu_vcMaterno">alu_vcMaterno</label>
            <input type="text" class="form-control" id="alu_vcMaterno" placeholder="alu_vcMaterno"
            value="{{$xalumno->alu_vcMaterno}}"
                name="alu_vcMaterno" required>
            <!-- <div class="valid-feedback">Valid.</div>
  <div class="invalid-feedback">Please fill out this field.</div> //-->
        </div>


        <div class="col-sm">
            <label for="alu_vcNombre">alu_vcNombre</label>
            <input type="text" class="form-control" id="alu_vcNombre" placeholder="alu_vcNombre" name="alu_vcNombre"
            value="{{$xalumno->alu_vcNombre}}"
                required>
            <!-- <div class="valid-feedback">Valid.</div>
  <div class="invalid-feedback">Please fill out this field.</div> //-->
        </div>

    </div>

    <div class="row g-4">
        <div class="col-sm">
            <label for="escpla_iCodigo">escpla_iCodigo</label>
            <input type="text" class="form-control" id="escpla_iCodigo" placeholder="escpla_iCodigo"
            value="{{$xalumno->escpla_iCodigo}}"
                name="escpla_iCodigo" required>
            <!-- <div class="valid-feedback">Valid.</div>
  <div class="invalid-feedback">Please fill out this field.</div> //-->
        </div>


        <div class="col-sm">
            <label for="alu_vcPassword">alu_vcPassword</label>
            <input type="text" class="form-control" id="alu_vcPassword" placeholder="alu_vcPassword"
            value="{{$xalumno->alu_vcPassword}}"
                name="alu_vcPassword" required>
            <!-- <div class="valid-feedback">Valid.</div>
  <div class="invalid-feedback">Please fill out this field.</div> //-->
        </div>
    </div>
    <div class="row g-4">
        <div class="col-sm">
            <label for="escpla_iNotas">escpla_iNotas</label>
            <input type="text" class="form-control" id="escpla_iNotas" placeholder="escpla_iNotas"
            value="{{$xalumno->escpla_iNotas}}"
                name="escpla_iNotas" required>
            <!-- <div class="valid-feedback">Valid.</div>
  <div class="invalid-feedback">Please fill out this field.</div> //-->
        </div>


        <div class="col-sm">
            <label for="escpla_iCreditos">escpla_iCreditos</label>
            <input type="text" class="form-control" id="escpla_iCreditos" placeholder="escpla_iCreditos"
            value="{{$xalumno->escpla_iCreditos}}"
                name="escpla_iCreditos" required>
            <!-- <div class="valid-feedback">Valid.</div>
  <div class="invalid-feedback">Please fill out this field.</div> //-->
        </div>


        <div class="col-sm">
            <label for="escpla_iPuntaje">escpla_iPuntaje</label>
            <input type="text" class="form-control" id="escpla_iPuntaje" placeholder="escpla_iPuntaje"
            value="{{$xalumno->escpla_iPuntaje}}"
                name="escpla_iPuntaje" required>
            <!-- <div class="valid-feedback">Valid.</div>
  <div class="invalid-feedback">Please fill out this field.</div> //-->
        </div>


        <div class="col-sm">
            <label for="escpla_fPromedio">escpla_fPromedio</label>
            <input type="text" class="form-control" id="escpla_fPromedio" placeholder="escpla_fPromedio"
            value="{{$xalumno->escpla_fPromedio}}"
                name="escpla_fPromedio" required>
            <!-- <div class="valid-feedback">Valid.</div>
  <div class="invalid-feedback">Please fill out this field.</div> //-->
        </div>
    </div>
    <div class="row g-4">
        <div class="col-sm">
            <label for="alu_cSexo">alu_cSexo</label>
            <input type="text" class="form-control" id="alu_cSexo" placeholder="alu_cSexo" 
            value="{{$xalumno->alu_cSexo}}"
            name="alu_cSexo" required>
            <!-- <div class="valid-feedback">Valid.</div>
  <div class="invalid-feedback">Please fill out this field.</div> //-->
        </div>


        <div class="col-sm">
            <label for="alu_dFechaNacimiento">alu_dFechaNacimiento</label>
            <input type="text" class="form-control" id="alu_dFechaNacimiento" placeholder="alu_dFechaNacimiento"
            value="{{$xalumno->alu_dFechaNacimiento}}"
                name="alu_dFechaNacimiento" required>
            <!-- <div class="valid-feedback">Valid.</div>
  <div class="invalid-feedback">Please fill out this field.</div> //-->
        </div>


        <div class="col-sm">
            <label for="alucon_iCodigo">alucon_iCodigo</label>
            <input type="text" class="form-control" id="alucon_iCodigo" placeholder="alucon_iCodigo"
            value="{{$xalumno->alucon_iCodigo}}"
                name="alucon_iCodigo" required>
            <!-- <div class="valid-feedback">Valid.</div>
  <div class="invalid-feedback">Please fill out this field.</div> //-->
        </div>
    </div>
    <div class="row g-4">
        <div class="col-sm">
            <label for="alu_vcTelefono">alu_vcTelefono</label>
            <input type="text" class="form-control" id="alu_vcTelefono" placeholder="alu_vcTelefono"
            value="{{$xalumno->alu_vcTelefono}}"
                name="alu_vcTelefono" required>
            <!-- <div class="valid-feedback">Valid.</div>
  <div class="invalid-feedback">Please fill out this field.</div> //-->
        </div>


        <div class="col-sm">
            <label for="alu_vcCelular">alu_vcCelular</label>
            <input type="text" class="form-control" id="alu_vcCelular" placeholder="alu_vcCelular"
            value="{{$xalumno->alu_vcCelular}}"
                name="alu_vcCelular" required>
            <!-- <div class="valid-feedback">Valid.</div>
  <div class="invalid-feedback">Please fill out this field.</div> //-->
        </div>


        <div class="col-sm">
            <label for="alu_vcEmail">alu_vcEmail</label>
            <input type="text" class="form-control" id="alu_vcEmail" placeholder="alu_vcEmail" name="alu_vcEmail"
            value="{{$xalumno->alu_vcEmail}}"
                required>
            <!-- <div class="valid-feedback">Valid.</div>
  <div class="invalid-feedback">Please fill out this field.</div> //-->
        </div>


        <div class="col-sm">
            <label for="alu_vcEmail_alt">alu_vcEmail_alt</label>
            <input type="text" class="form-control" id="alu_vcEmail_alt" placeholder="alu_vcEmail_alt"
            value="{{$xalumno->alu_vcEmail_alt}}"
                name="alu_vcEmail_alt" required>
            <!-- <div class="valid-feedback">Valid.</div>
  <div class="invalid-feedback">Please fill out this field.</div> //-->
        </div>

    </div>

    <div class="row g-4">
        <div class="col-sm">
            <label for="proadm_vcCodigo">proadm_vcCodigo</label>
            <input type="text" class="form-control" id="proadm_vcCodigo" placeholder="proadm_vcCodigo"
            value="{{$xalumno->proadm_vcCodigo}}"
                name="proadm_vcCodigo" required>
            <!-- <div class="valid-feedback">Valid.</div>
  <div class="invalid-feedback">Please fill out this field.</div> //-->
        </div>


        <div class="col-sm">
            <label for="cod_vcCodigo">cod_vcCodigo</label>
            <input type="text" class="form-control" id="cod_vcCodigo" placeholder="cod_vcCodigo" 
            value="{{$xalumno->cod_vcCodigo}}"
            name="cod_vcCodigo"
                required>
            <!-- <div class="valid-feedback">Valid.</div>
  <div class="invalid-feedback">Please fill out this field.</div> //-->
        </div>


        <div class="col-sm">
            <label for="cal_iEapMerito">cal_iEapMerito</label>
            <input type="text" class="form-control" id="cal_iEapMerito" placeholder="cal_iEapMerito"
            value="{{$xalumno->cal_iEapMerito}}"
             name="cal_iEapMerito" required>
            <!-- <div class="valid-feedback">Valid.</div>
  <div class="invalid-feedback">Please fill out this field.</div> //-->
        </div>

    </div>

    <div class="row g-4">
        <div class="col-sm">
            <label for="mod_cCodigo">mod_cCodigo</label>
            <input type="text" class="form-control" id="mod_cCodigo" placeholder="mod_cCodigo" 
            value="{{$xalumno->mod_cCodigo}}"
            name="mod_cCodigo" required>
            <!-- <div class="valid-feedback">Valid.</div>
  <div class="invalid-feedback">Please fill out this field.</div> //-->
        </div>


        <div class="col-sm">
            <label for="alu_ori_mes">alu_ori_mes</label>
            <input type="text" class="form-control" id="alu_ori_mes" placeholder="alu_ori_mes" 
            value="{{$xalumno->alu_ori_mes}}"
            name="alu_ori_mes"       required>
            <!-- <div class="valid-feedback">Valid.</div>
  <div class="invalid-feedback">Please fill out this field.</div> //-->
        </div>


        <div class="col-sm">
            <label for="ubi_vcId">ubi_vcId</label>
            <input type="text" class="form-control" id="ubi_vcId" placeholder="ubi_vcId" 
            value="{{$xalumno->ubi_vcId}}"
            name="ubi_vcId" required>
            <!-- <div class="valid-feedback">Valid.</div>
  <div class="invalid-feedback">Please fill out this field.</div> //-->
        </div>

    </div>

    <div class="row g-4">

    <div class="col-sm">
        <label for="alu_vcCondicionResolucion">alu_vcCondicionResolucion</label>
        <input type="text" class="form-control" id="alu_vcCondicionResolucion"
            placeholder="alu_vcCondicionResolucion" 
            value="{{$xalumno->alu_vcCondicionResolucion}}"
            name="alu_vcCondicionResolucion" required>
        <!-- <div class="valid-feedback">Valid.</div>
  <div class="invalid-feedback">Please fill out this field.</div> //-->
    </div>

    
    <div class="col-sm">
        <label for="alu_vcCondicionVencimiento">alu_vcCondicionVencimiento</label>
        <input type="text" class="form-control" id="alu_vcCondicionVencimiento"
            placeholder="alu_vcCondicionVencimiento" 
            value="{{$xalumno->alu_vcCondicionVencimiento}}"
            name="alu_vcCondicionVencimiento" required>
        <!-- <div class="valid-feedback">Valid.</div>
  <div class="invalid-feedback">Please fill out this field.</div> //-->
    </div>


    <div class="col-sm">
        <label for="pueind_iCodigo">pueind_iCodigo</label>
        <input type="text" class="form-control" id="pueind_iCodigo" placeholder="pueind_iCodigo"
        value="{{$xalumno->pueind_iCodigo}}"
            name="pueind_iCodigo" required>
        <!-- <div class="valid-feedback">Valid.</div>
  <div class="invalid-feedback">Please fill out this field.</div> //-->
    </div>


    <div class="col-sm">
        <label for="aluest_iCodigo">aluest_iCodigo</label>
        <input type="text" class="form-control" id="aluest_iCodigo" placeholder="aluest_iCodigo"
        value="{{$xalumno->aluest_iCodigo}}"
             name="aluest_iCodigo" required>
        <!-- <div class="valid-feedback">Valid.</div>
  <div class="invalid-feedback">Please fill out this field.</div> //-->
    </div>
</div>
<div class="row g-4">
<div class="col-sm"><br>
    <button type="submit" class="btn btn-primary">Registrar</button>
    <button type="submit" class="btn btn-primary">Nuevo registro</button>
</div> 
</div> 
</form>
