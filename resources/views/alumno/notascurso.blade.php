<head>
  <title>Cursos Matriculados</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
</head>



<div class="card shadow mb-4">
  <div class="card-header py-3">
  <h6 class="m-0 font-weight-bold text-primary">
  <i class="fa fa-id-card fa-2x" ></i> Lista de Notas Por Cursos Matriculados
  </h6>
</div>
<div class="card-body">

  <table class='table table-striped table-hover table-responsive-md' width='80%'>
<thead >
<tr style='background-color:royalblue;color:white;'>
  <td>Codigo</td>
  <td>Curso</td>
  <td>Cred</td>
  <td>Ciclo</td>
  <td>Secc</td>
  <td>Docente</td>
  <td>Turno</td>
  <td>OP</td>
  </tr>
</thead>
<tbody>

@foreach($miscursos as $curso)

          <tr>
            <td>{{ $codcurso=$curso->codigo }}</td>
            <td>{{ $curso->curso }}</td>
            <td>{{ $curso->credito }}</td>                 
            <td>{{ $curso->ciclo }}</td>
            <td>{{ $curso->secc }}</td>
            <td>{{ $curso->docente }}</td>
            <td>{{ $curso->turno }}</td>
           
  @php     
 $unidad = versilabusunidad($silabus,$codcurso); 
 
  @endphp
            <td><button type="button" onclick="vernotasdetalle('{{ $unidad }}','{{$curso->sem_iCodigo }}','{{ $curso->codigo }}','{{ $curso->alu_iCodigo }}')" class="btn btn-secondary" href="#">ver {{ $curso->codigo }}
            </button> </td>
        </tr>
       @endforeach
  
</tbody>
</table>
</div>
</div>

