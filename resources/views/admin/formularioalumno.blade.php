@php
function verescuelaplan()
{
    $sql = "SELECT
escuelaplan.escpla_iCodigo,
concat(escuelaplan.esc_vcCodigo,'-',
escuelaplan.escpla_vcCodigo,'-',
escuela.esc_vcNombre) as escuela

FROM
escuelaplan
INNER JOIN escuela ON escuelaplan.esc_vcCodigo = escuela.esc_vcCodigo";
    $data = DB::select($sql);
    return $data;
}
function vercondicion()
{
    $sql = "SELECT
alumno_condicion.alucon_iCodigo,
alumno_condicion.alucon_vcNombre
FROM
alumno_condicion order by alumno_condicion.alucon_iCodigo 
";
    $data = DB::select($sql);
    return $data;
}
function versemestre()
{
    $sql = "SELECT
semestre.sem_iCodigo
FROM
semestre order by semestre.sem_iCodigo desc ";
    $data = DB::select($sql);
    return $data;
}
function modalidad()
{
    $sql = "SELECT
modalidad.mod_cCodigo,
modalidad.mod_vcNombre
FROM
modalidad";
    $data = DB::select($sql);
    return $data;
}
function pueblo()
{
    $sql = "SELECT
pueblos_indigenas.pueind_iCodigo,
pueblos_indigenas.pueind_vcNombre
FROM
pueblos_indigenas";
    $data = DB::select($sql);
    return $data;
}
$listasemestre = versemestre();

$plaescu = verescuelaplan();
$condicion = vercondicion();
$modalidad = modalidad();
$pueblo = pueblo();
@endphp

<form action="admin/listaalumnonuevo" class="was-validated">
    <input type="hidden" value="alumno" name="n">
    <div class="row">
        <div class="col-sm">
            FORMATO DE CODIGO DE ALUMNO
            <img src="img/code1.png" alt="" height="200px">
        </div>
    </div>
    <div class="row g-4">



        <div class="col-sm">
            <label for="alu_vcCodigo">CODIGO DE ALUMNO</label>
            <input type="text" class="form-control" id="alu_vcCodigo" placeholder="Codigo alumno" name="alu_vcCodigo"
                style="background-color:lightgoldenrodyellow" value="{{ right(semestreactual(), 3) }}" required
                readonly>
            <!-- <div class="valid-feedback">Valid.</div>
  <div class="invalid-feedback">Please fill out this field.</div> //-->
        </div>


        <div class="col-sm">
            <label for="alu_vcDocumento">DNI</label>
            <input type="text" class="form-control" id="alu_vcDocumento" placeholder="dni" name="alu_vcDocumento"
                onkeyup="copipas(this)" required>
            <div class="invalid-feedback">ingresar 8 digitos</div>
        </div>
    </div>
    <div class="row g-4">
        <div class="col-sm">
            <label for="alu_vcPaterno">Apellido Paterno</label>
            <input type="text" class="form-control" id="alu_vcPaterno" placeholder="Apellido Paterno"
                name="alu_vcPaterno" required>
            <!-- <div class="valid-feedback">Valid.</div>
  <div class="invalid-feedback">Please fill out this field.</div> //-->
        </div>


        <div class="col-sm">
            <label for="alu_vcMaterno">Apellido Materno</label>
            <input type="text" class="form-control" id="alu_vcMaterno" placeholder="Apellido Materno"
                name="alu_vcMaterno" required>
            <!-- <div class="valid-feedback">Valid.</div>
  <div class="invalid-feedback">Please fill out this field.</div> //-->
        </div>


        <div class="col-sm">
            <label for="alu_vcNombre">Nombres</label>
            <input type="text" class="form-control" id="alu_vcNombre" placeholder="Nombres" name="alu_vcNombre"
                required>
            <!-- <div class="valid-feedback">Valid.</div>
  <div class="invalid-feedback">Please fill out this field.</div> //-->
        </div>

    </div>

    <div class="row g-4">
        <div class="col-sm">
            <label for="escpla_iCodigo">PLAN DE ESTUDIOS</label>
            <select name="escpla_iCodigo" id="escpla_iCodigo" class="form-control" onchange="micodigo()">

                @foreach ($plaescu as $data)
                    <option value="{{ $data->escpla_iCodigo }}">{{ $data->escuela }}</option>
                @endforeach
            </select>

            <!-- <div class="valid-feedback">Valid.</div>
  <div class="invalid-feedback">Please fill out this field.</div> //-->
        </div>


        <div class="col-sm">
            <label for="alu_vcPassword">Password</label>
            <input type="text" class="form-control" id="alu_vcPassword" placeholder="password" name="alu_vcPassword"
                required>
            <!-- <div class="valid-feedback">Valid.</div>
  <div class="invalid-feedback">Please fill out this field.</div> //-->
        </div>
    </div>

    <div class="row g-4">
        <div class="col-sm">
            <label for="alu_cSexo">SEXO</label>

            <select name="alu_cSexo" id="alu_cSexo" class="form-control">
                <option value="F">F</option>
                <option value="F">M</option>
            </select>
            <!-- <div class="valid-feedback">Valid.</div>
  <div class="invalid-feedback">Please fill out this field.</div> //-->
        </div>


        <div class="col-sm">
            <label for="alu_dFechaNacimiento">Fecha de Nacimiento</label>
            <input type="date" class="form-control" id="alu_dFechaNacimiento" placeholder="FechaNacimiento"
                name="alu_dFechaNacimiento" required>
            <!-- <div class="valid-feedback">Valid.</div>
  <div class="invalid-feedback">Please fill out this field.</div> //-->
        </div>


        <div class="col-sm">
            <label for="alucon_iCodigo">Condicion del Estudiante</label>

            <select name="alucon_iCodigo" id="alucon_iCodigo" class="form-control">

                @foreach ($condicion as $data)
                    <option value="{{ $data->alucon_iCodigo }}">{{ $data->alucon_vcNombre }}</option>
                @endforeach
            </select>
            <!-- <div class="valid-feedback">Valid.</div>
  <div class="invalid-feedback">Please fill out this field.</div> //-->
        </div>
    </div>
    <div class="row g-4">
        <div class="col-sm">
            <label for="alu_vcTelefono">Telefono Fijo</label>
            <input type="tel" class="form-control" id="alu_vcTelefono" placeholder="alu_vcTelefono"
                name="alu_vcTelefono" required>
            <!-- <div class="valid-feedback">Valid.</div>
  <div class="invalid-feedback">Please fill out this field.</div> //-->
        </div>


        <div class="col-sm">
            <label for="alu_vcCelular">Celular</label>
            <input type="tel" class="form-control" id="alu_vcCelular" placeholder="alu_vcCelular" name="alu_vcCelular"
                required>
            <!-- <div class="valid-feedback">Valid.</div>
  <div class="invalid-feedback">Please fill out this field.</div> //-->
        </div>


        <div class="col-sm">
            <label for="alu_vcEmail">Email</label>
            <input type="email" class="form-control" id="alu_vcEmail" placeholder="Email" name="alu_vcEmail" required>
            <!-- <div class="valid-feedback">Valid.</div>
  <div class="invalid-feedback">Please fill out this field.</div> //-->
        </div>


        <div class="col-sm">
            <label for="alu_vcEmail_alt">Email alternativo</label>
            <input type="email" class="form-control" id="alu_vcEmail_alt" placeholder="alu_vcEmail_alt"
                name="alu_vcEmail_alt" required>
            <!-- <div class="valid-feedback">Valid.</div>
  <div class="invalid-feedback">Please fill out this field.</div> //-->
        </div>

    </div>

    <div class="row g-4">
        <div class="col-sm">
            <label for="proadm_vcCodigo">Proceso de Adminision</label>
            <select name="proadm_vcCodigo" id="proadm_vcCodigo" onclick="micodigo()" class="form-control">

                @foreach ($listasemestre as $data)
                    <option>{{ $data->sem_iCodigo }}</option>
                @endforeach
            </select>
            <!-- <div class="valid-feedback">Valid.</div>
  <div class="invalid-feedback">Please fill out this field.</div> //-->
        </div>


        <div class="col-sm">
            <label for="cod_vcCodigo">Codigo de Prospecto</label>
            <input type="text" class="form-control" id="cod_vcCodigo" placeholder="cod_vcCodigo" name="cod_vcCodigo"
                required>
            <!-- <div class="valid-feedback">Valid.</div>
  <div class="invalid-feedback">Please fill out this field.</div> //-->
        </div>




    </div>

    <div class="row g-4">
        <div class="col-sm">
            <label for="mod_cCodigo">Modalidad de ingreso</label>

            <select name="mod_cCodigo" id="mod_cCodigo" class="form-control" onchange="micodigo()" required>

                @foreach ($modalidad as $data)
                    <option value="{{ $data->mod_cCodigo }}">{{ $data->mod_vcNombre }}</option>
                @endforeach
            </select>
            <!-- <div class="valid-feedback">Valid.</div>
  <div class="invalid-feedback">Please fill out this field.</div> //-->
        </div>

        <div class="col-sm">
            <label for="cal_iEapMerito">Orden ingreso - Merito</label>
            <select name="cal_iEapMerito" id="cal_iEapMerito" class="form-control" onchange="micodigo()" required>

                @for ($x = 1; $x < 100; $x++)
                    @php
                        $n = right('0' . $x, 2);
                    @endphp
                    <option value="{{ $n }}">{{ $n }}</option>
                @endfor



            </select>

            <!-- <div class="valid-feedback">Valid.</div>
  <div class="invalid-feedback">Please fill out this field.</div> //-->
        </div>




    </div>

    <div class="row g-4">



        <div class="col-sm">
            <label for="pueind_iCodigo">Pueblo Indigena</label>


            <select name="pueind_iCodigo" id="pueind_iCodigo" class="form-control">

                @foreach ($pueblo as $data)
                    <option value="{{ $data->pueind_iCodigo }}">{{ $data->pueind_vcNombre }}</option>
                @endforeach
            </select>
            <!-- <div class="valid-feedback">Valid.</div>
  <div class="invalid-feedback">Please fill out this field.</div> //-->
        </div>



    </div>
    <div class="row g-4">
        <div class="col-sm  justify-content-center"><br>
            <button type="button" class="btn btn-primary" onclick="verficardatos()">REGISTRAR</button>
            <button type="reset" class="btn btn-dark">Nuevo registro</button>
        </div>
    </div>
</form>
<div id="micontenido0" style="display: none">

</div>
<script>
    function copipas(elem) {
        document.getElementById("alu_vcPassword").value = (elem.value)
        if (elem.value.length == 8)
            $(".invalid-feedback").hide();
        else
            $(".invalid-feedback").show();
    }

    function micodigo() {
        xcod = "";
        n1 = right($("#proadm_vcCodigo").val(), 3);
        n2 = $("#cal_iEapMerito").val();
        n3 = $("#mod_cCodigo").val();
        //  n4=left($("escpla_iCodigo").text(),1);
        elem = document.getElementById("escpla_iCodigo")
        n4 = left(elem.options[elem.selectedIndex].text, 1)

        xcod = xcod.concat(n1, n2, n3, n4);
        $("#alu_vcCodigo").val(xcod);


    }

    function right(str, chr) {
        return str.slice(str.length - chr, str.length);
    }

    function left(str, chr) {
        return str.slice(0, chr - str.length);
    }

    function verficardatos() {
        micodigo()
        const h1 = [];
        falta = 0;
        h1[1] = $("#alu_vcCodigo").val();
        h1[2] = $("#alu_vcDocumento").val();
       // if($("alu_vcDocumento").val().length == 8);
      //  alert('falta dni')
       // else
        //    falta = 1;

        h1[3] = $("#alu_vcPaterno").val();
        h1[4] = $("#alu_vcMaterno").val();
        h1[5] = $("#alu_vcNombre").val();
        h1[6] = $("#escpla_iCodigo").val();
        h1[7] = $("#alu_vcPassword").val();
        h1[8] = $("#alu_cSexo").val();
        h1[9] = $("#alu_dFechaNacimiento").val();
        h1[10] = $("#cod_vcCodigo").val();
        h1[11] = $("#proadm_vcCodigo").val();
        h1[12] = $("#mod_cCodigo").val();
        h1[13] = $("#pueind_iCodigo").val();
        h1[14] = $("#alu_vcTelefono").val();
        h1[15] = $("#alu_vcCelular").val();
        h1[16] = $("#alu_vcEmail").val();
        h1[17] = $("#alu_vcEmail_alt").val();
        h1[18] = $("#cal_iEapMerito").val();

        for (x = 1; x < 19; x++) {
            if (h1[x].length < 1)
                falta = falta + 1;
        }
        if (falta > 0)
            alert("ATENCION:INGRESE TODOS LOS CAMPOS")
        if (falta == 0)
            grabar()
    }

    function grabar() {
        //$("#micontenido" ).load( "../crud/registrardocente" );
        $("#cargando").show();
        var alu_vcCodigo = $("#alu_vcCodigo").val();
        var alu_vcDocumento = $("#alu_vcDocumento").val();
        var alu_vcPaterno = $("#alu_vcPaterno").val();
        var alu_vcMaterno = $("#alu_vcMaterno").val();
        var alu_vcNombre = $("#alu_vcNombre").val();
        var escpla_iCodigo = $("#escpla_iCodigo").val();
        var alu_vcPassword = $("#alu_vcPassword").val();
        var alu_cSexo = $("#alu_cSexo").val();
        var alu_dFechaNacimiento = $("#alu_dFechaNacimiento").val();
        var cod_vcCodigo = $("#cod_vcCodigo").val();
        var proadm_vcCodigo = $("#proadm_vcCodigo").val();
        var mod_cCodigo = $("#mod_cCodigo").val();
        var pueind_iCodigo = $("#pueind_iCodigo").val();
        var alu_vcTelefono = $("#alu_vcTelefono").val();
        var alu_vcCelular = $("#alu_vcCelular").val();
        var alu_vcEmail = $("#alu_vcEmail").val();
        var alu_vcEmail_alt = $("#alu_vcEmail_alt").val();
        var cal_iEapMerito = $("#cal_iEapMerito").val();
        $.ajax({
            url: "admin/listaalumnonuevo",
            success: function(result) {
               // alert(result);
                $("#micontenido0").html(result);

                $("#cargando").hide();

            },
            data: {
                alu_vcCodigo: alu_vcCodigo,
                alu_vcDocumento: alu_vcDocumento,
                alu_vcPaterno: alu_vcPaterno,
                alu_vcMaterno: alu_vcMaterno,
                alu_vcNombre: alu_vcNombre,
                escpla_iCodigo: escpla_iCodigo,
                alu_vcPassword: alu_vcPassword,
                alu_cSexo: alu_cSexo,
                alu_dFechaNacimiento: alu_dFechaNacimiento,
                cod_vcCodigo: cod_vcCodigo,
                proadm_vcCodigo: proadm_vcCodigo,
                mod_cCodigo: mod_cCodigo,
                pueind_iCodigo: pueind_iCodigo,
                alu_vcTelefono: alu_vcTelefono,
                alu_vcCelular: alu_vcCelular,
                alu_vcEmail: alu_vcEmail,
                alu_vcEmail_alt: alu_vcEmail_alt,
                cal_iEapMerito: cal_iEapMerito
            },
            type: "GET"
        });

    }
</script>
