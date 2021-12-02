@php
function aulatipox()
{
    $sql = "SELECT
aulatipo.aultip_iCodigo,
aulatipo.aultip_vcNombre
FROM
aulatipo";
    $data = DB::select($sql);
    return $data;
}
function localesx()
{
    $sql = "SELECT
loc_iCodigo,
loc_vcNombre
FROM
local";
    $data = DB::select($sql);
    return $data;
}
$localesx = localesx();
$aulatipox = aulatipox();
@endphp
<div class="card">
    <h2>aula</h2>
    <form class="was-validated">
        <input type="hidden" value="aula" name="n">
    <div class="row g-4">
      


        <div class="col-sm">
            <label for="loc_iCodigo">LOCAL</label>
           
            <select name="loc_iCodigo" id="loc_iCodigo" class="form-control">
                @foreach ($localesx as $data)
                    <option value="{{ $data->loc_iCodigo }}">{{ $data->loc_vcNombre }}</option>
                @endforeach

            </select>
            <!-- <div class="valid-feedback">Valid.</div>
  <div class="invalid-feedback">Please fill out this field.</div> //-->
        </div>


        <div class="col-sm">
            <label for="aul_vcCodigo">CODIGO  DE AULA</label>
            <input type="text" class="form-control" id="aul_vcCodigo" placeholder="aul_vcCodigo" name="aul_vcCodigo"
                required="">
            <!-- <div class="valid-feedback">Valid.</div>
  <div class="invalid-feedback">Please fill out this field.</div> //-->
        </div>
    </div>

    <div class="col-sm">
            <label for="aul_vcNombre">NOMBRE DE AULA</label>
            <input type="text" class="form-control" id="aul_vcNombre" placeholder="aul_vcNombre" name="aul_vcNombre"
                required="">
            <!-- <div class="valid-feedback">Valid.</div>
  <div class="invalid-feedback">Please fill out this field.</div> //-->
        </div>

        <div class="row g-4">
        <div class="col-sm">
            <label for="aul_iCapacidad">CAPACIDAD DE AULA</label>
            <input type="text" class="form-control" id="aul_iCapacidad" placeholder="aul_iCapacidad"
                name="aul_iCapacidad" required="">
            <!-- <div class="valid-feedback">Valid.</div>
  <div class="invalid-feedback">Please fill out this field.</div> //-->
        </div>


        <div class="col-sm">
            <label for="aultip_iCodigo">TIPO DE AULA</label>
            <select name="aultip_iCodigo" id="aultip_iCodigo" class="form-control">
                @foreach ($aulatipox as $data)
                    <option value="{{ $data->aultip_iCodigo }}">{{ $data->aultip_vcNombre }}</option>
                @endforeach

            </select>
            <!-- <div class="valid-feedback">Valid.</div>
  <div class="invalid-feedback">Please fill out this field.</div> //-->
        </div>

    </div>
        <button type="button" class="btn btn-primary" onclick="registraraula()">Registrar</button>
    </form>
</div>
<div id="micontenido0">

</div>
<script>
    function registraraula(){
    
        //$("#micontenido" ).load( "../crud/registrardocente" );
       
        var  loc_iCodigo= $("#loc_iCodigo").val();
        var  aul_vcCodigo= $("#aul_vcCodigo").val();
        var  aul_vcNombre= $("#aul_vcNombre").val();
        var  aul_iCapacidad= $("#aul_iCapacidad").val();
        var  aultip_iCodigo= $("#aultip_iCodigo").val();
        $("#cargando").show();
        $.ajax({
            url: "admin/listaaulanuevo",
            success: function(result) {
               alert(result);
                $("#micontenido0").html(result);
                $("#cargando").hide();

            },
            data: {
                loc_iCodigo: loc_iCodigo,
                aul_vcCodigo: aul_vcCodigo,
                aul_vcNombre: aul_vcNombre,
                aul_iCapacidad: aul_iCapacidad,
                aultip_iCodigo: aultip_iCodigo
            },
            type: "GET"
        });

    }
    
</script>