@php
//use App\Http\Controllers\AdminController;
//$listaalumnos=new AdminController();
//$listaalumno=$listaalumnos->veralumno();
//namespace App\Http\Controllers;

//use App\Models\Alumno;
//$listaalumno = Alumno::select('alu_iCodigo', 'alu_vcDocumento', 'alu_vcPaterno', 'alu_vcMaterno', 'alu_vcNombre')->get();
$sql="
SELECT
alumno.alu_iCodigo,
alumno.alu_vcCodigo,
alumno.alu_vcDocumento,
alumno.alu_vcCodigo,
alumno.alu_vcPaterno,
alumno.alu_vcMaterno,
alumno.alu_vcNombre,
alumno.escpla_iCodigo,
escuelaplan.esc_vcCodigo,
escuelaplan.escpla_vcRR
FROM
alumno
INNER JOIN escuelaplan ON alumno.escpla_iCodigo = escuelaplan.escpla_iCodigo
";
$listaalumno=DB::Select($sql);
@endphp


<h3>Lista de Alumno</h3>
<table id="tabla-alumnolista" class="table">
    <thead>
        <tr style="background-color: navy;color:white;">
            <td>ID</td>
            <td>CODIGO</td>
            <td>DNI</td>
            <td>Paterno</td>
            <td>Materno</td>
            <td>Nombre</td>
            <td>Escuela</td>
            <td>foto</td>
            <td>ACCIONES</td>
        </tr>
    </thead>
    <tbody>
    
        @foreach ($listaalumno as $alu)

            <tr>
                <td>{{ $alu->alu_iCodigo }}</td>
                <td>{{ $alu->alu_vcCodigo}}</td>
                <td>{{ $foto=$alu->alu_vcDocumento }}</td>
                <td>{{ $alu->alu_vcPaterno }}</td>
                <td>{{ $alu->alu_vcMaterno }}</td>
                <td>{{ $alu->alu_vcNombre }}</td>
                <td>{{ $alu->esc_vcCodigo}}</td>
                @php
                    //$url = 'http://app2.unaat.edu.pe/alumno/fotos/1_' . $alu->alu_vcDocumento . '.jpg';
                    $url = 'storage/fotos/1_' . $alu->alu_vcDocumento . '.jpg';
                    
                @endphp

                <td> <img src="{{ $url }}" alt="Sin foto" width="50">
                </td>
                <!--      <td> <img src=" asset('fotos/1_'.$alu->alu_vcDocumento.'.jpg')}}" alt="" width="50">  /-->
                

                <td>
                    <a name="bclave" id="x1" class="btn btn-primary btn-sm table-condensed" href="#openModal"
                        onclick="verclave('{{ $alu->alu_iCodigo }}','{{ $alu->alu_vcPaterno }} {{ $alu->alu_vcPaterno }} {{ $alu->alu_vcNombre }}')">Cambiar
                        clave </a>

                    <a href="#" onclick="xnveralumno('{{ $alu->alu_iCodigo }}')"
                        class="btn btn-info btn-sm table-condensed"> Editar </a>
                    &nbsp;&nbsp;<button type="button" name="delete" id="xbeliminar"
                        onclick="$('#confirmModal').modal('show');" class="delete btn btn-danger btn-sm table-condensed">
                        Eliminar </button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>




<script>
    
    $(document).ready(function() {
        $('#tabla-alumnolista').DataTable({
            "pagingType": "full_numbers"
        });
    });

   
    function xnveralumno(codalumno) {

//$("#listacursos").html("...cargando");
$.ajax({
    url: "admin/formularioalumnoeditar",
    success: function(result) {
        //   alert(result);
        $("#modaleditar").modal('show');

        $("#listalumnomodal").html(result);

    },
    data: {
        id: codalumno
    },
    type: "GET"
});


}
</script>

<link rel="stylesheet" href="{{ asset('datatable/css/jquery.dataTables.min.css') }}">
<script src="{{ asset('datatable/js/jquery.dataTables.min.js') }}"></script>


<link rel="stylesheet" href="{{ asset('bootstrap5/css/bootstrap.min.css') }}">
<script src="{{ asset('bootstrap5/js/bootstrap.js') }}"></script>
