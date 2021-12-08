@php

function veruser()
{$sql="SELECT
seg_usuario.usu_iCodigo,
seg_usuario.usu_vcUsuario,
seg_usuario.usr_vcNombre,
seg_usuario.usu_vcApellido
from seg_usuario";
$data=DB::select($sql);
return $data;
}

$listauser =veruser();

@endphp

<table id="tabla-user" class="table table-hover table-condensed">
    <thead>
        <td>ID</td>
        <td>Usuario de sistema</td>
        <td>Nombre</td>
        <td>Apellidos</td>
        <td>ACCIONES</td>
    </thead>
    <tbody>
        @foreach ($listauser as $user)

            <tr>
                <td>{{ $user->usu_iCodigo }}</td>
                <td>{{ $user->usu_vcUsuario }}</td>
                <td>{{ $user->usr_vcNombre }}</td>
                <td>{{ $user->usu_vcApellido }}</td>
               

                <td>
                    <a name="bclave" id="x1" class="btn btn-primary btn-sm table-condensed" href="#openModal"
                        onclick="verclave('{{ $user->usu_vcUsuario }}','{{ $user->usr_vcNombre }} {{ $user->usu_vcApellido }}')">Cambiar
                        clave </a>
                    <a href="javascript:void(0)" 
                        class="btn btn-info btn-sm table-condensed"> Editar </a>
                    &nbsp;&nbsp;<button type="button" name="delete" id="'.$animales->id.'"
                        class="delete btn btn-danger btn-sm table-condensed"> Eliminar </button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<link rel="stylesheet" href="{{ asset('datatable/css/jquery.dataTables.min.css') }}">
<script src="{{ asset('datatable/js/jquery.dataTables.min.js') }}"></script> 


<script>
    $(document).ready(function() {
    $('#tabla-user').DataTable();
    });
</script>
<script>
 /*   function verclave(n1, alumno) {
        $('#idcod1').val(n1);
        $('#nomalumno').html("ALUMNO:" + alumno);

        // cambiarpassworddocente(cod,clave);
    }

    function crearcambio(n1, n2) {
        cod = document.getElementById(n1).value;
        clave = document.getElementById(n2).value;
        cambiarpasswordalumno(cod, clave);
        //     cambiarpassworddocente(cod,clave);
    }
    function verlistax()
{$("#xlistaalumno").html("...Cargando");
$("#xlistaalumno").load('admin/listaalumnotabla');

}        
function verformularioalumno()
{$("#fomularioalumno").html("...Cargando");
$("#fomularioalumno").load('admin/formularioalumno');

}        */
</script>