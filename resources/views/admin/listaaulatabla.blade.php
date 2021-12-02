@php

function veraula()
{$sql="SELECT
aula.aul_iCodigo,
aula.aul_vcCodigo,
aula.aul_vcNombre,
aula.aul_iCapacidad,
`local`.loc_vcNombre,
aulatipo.aultip_vcNombre
FROM
aula
INNER JOIN `local` ON aula.loc_iCodigo = `local`.loc_iCodigo
INNER JOIN aulatipo ON aula.aultip_iCodigo = aulatipo.aultip_iCodigo";
$data=DB::select($sql);
return $data;
}

$listaaula =veraula();

@endphp
<h3>Lista de Aula</h3>
<table id="tabla-aula" class="table table-hover table-condensed">
    <thead>
        <td>ID</td>
        <td>codigo</td>
        <td>nombre</td>
        <td>capacidad</td>
        <td>local</td>
        <td>tipo</td>

        <td>ACCIONES</td>
    </thead>
    <tbody>
        @foreach ($listaaula as $salon)

            <tr>
                <td>{{ $salon->aul_iCodigo }}</td>
                <td>{{ $salon->aul_vcCodigo }}</td>
                <td>{{ $salon->aul_vcNombre }}</td>
                <td>{{ $salon->aul_iCapacidad }}</td>
                <td>{{ $salon->loc_vcNombre }}</td>
                <td>{{ $salon->aultip_vcNombre}}</td>

                <td><a href="javascript:void(0)" 
                        class="btn btn-info btn-sm table-condensed"> Editar </a>
                    &nbsp;&nbsp;<button type="button" name="delete" id="'.$animales->id.'"
                        class="delete btn btn-danger btn-sm table-condensed"> Eliminar </button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>
    $(document).ready(function() {

        $('#tabla-aula').DataTable();
    });
</script>