
@unless (empty($sales))
<h2>DATOS UBICADOS</h2>
@foreach ($sales as $data)
{{ $data->are_vcNombre }} <br>
@endforeach
@else
<h2>Sin REGISTROS</h2>

@endif

  <div class="card mb-4">
<div class="card-header bg-primary text-white">
BOLETAS DE NOTAS
</div>
<div class="card-body">
<div style="overflow: scroll;">                               
<table class="table table-striped table-bordered table-sm " cellspacing="0"
   id="dataTable" >
<tr style="color:green;">
<td>codigo:A81557E</td>
<td>Escuela Prodesional:SEMESTRE 20211</td>
</tr>
<tr>
<td>Ape. y Nombre: {{ $alumno }}</td>
<td>Plan:RR-2017</td>
</tr>
</table>
<h2>SEMESTRES 20211</h2>
<table class="table table-striped table-bordered table-sm " cellspacing="0"
   id="dataTable" >
<tr>
<td>N°</td>
<td>Cod.Curso</td>
<td>Sec.</td>
<td>Sem.</td>
<td>Cred.</td>
<td>Nota</td>
</tr>
<tr>
<td>N°</td>
<td>Cod.Curso</td>
<td>Sec.</td>
<td>Sem.</td>
<td>Cred.</td>
<td>Nota</td>
</tr>

</table>
</div>
</div>
</div>