@php




//dd($listadocentes);
 function sqllistadocentesemestre($semestre)
        {$sql="SELECT
          seccion.sem_iCodigo,
          docente.doc_vcDocumento,
          docente.doc_vcPaterno,
          docente.doc_vcMaterno,
          docente.doc_vcNombre,
          docente.doc_iCodigo
          FROM
          seccion
          INNER JOIN seccion_horario ON seccion.sec_iCodigo = seccion_horario.sec_iCodigo
          INNER JOIN docente ON seccion_horario.doc_iCodigo = docente.doc_iCodigo
          where seccion.sem_iCodigo='$semestre' group by seccion.sem_iCodigo,docente.doc_vcDocumento,
          docente.doc_vcPaterno,
          docente.doc_vcMaterno,
          docente.doc_vcNombre,
          docente.doc_iCodigo
          ";
          $r=DB::select($sql);
          return $r;
          //  return back();
            }

 

//inicio funcion

//fin funcion


$listadocentes= sqllistadocentesemestre(semestreactual());//$listadocente->listadocentesemestre(semestreactual());
@endphp

<script>
	$(document).ready(function() {
    $('#tabla-docentesemestre').DataTable( {
        "pagingType": "full_numbers"
    } );
} );
	</script>


<h3>Lista de docentes del semestre actual</h3>
<table id="tabla-docentesemestre" width="800px">
<thead>
  <td>OP</td>
    <td>nro</td>
    <td>DNI</td>
    <td>PATERNO</td>
    <td>MATERNO</td>
    <td>NOMBRE</td>
 </thead>
<tbody>
    @php
        $n=1;
    @endphp
 
@foreach ($listadocentes as $salon)

<tr><td><a href="#openModalcursos" 
  onclick="versilabuscursos('{{$salon->doc_vcPaterno}} {{$salon->doc_vcMaterno}} {{$salon->doc_vcNombre}} ','{{$salon->doc_iCodigo}}','{{semestreactual()}}') "
   class="btn btn-primary">ver cursos</a></td>
    <td>{{ $n++ }}</td>
    <td>{{ $salon->doc_vcDocumento }}</td>
    <td>{{ $salon->doc_vcPaterno }}</td>
    <td>{{$salon->doc_vcMaterno}}</td>
    <td>{{$salon->doc_vcNombre}}</td>
  
   </tr>

@endforeach  
</tbody>
</table>



@php
/*

//dd($miscursosgrupo);
*/

 @endphp
 <style>

    .table-condensed{
  font-size: 10px;
  color: black;
  }
 
  
  </style>
  @php
   

  @endphp
 
  @php
     // vercursonotas($coddocentex,semestreactual(),2)

        //dd($vernotas); 
  //   vercursonotas($coddocentex,semestreactual(),2);
            @endphp



 

 @php
     

//vermiscursos(semestreactual(),51);
@endphp
       



<script src="{{ asset('datatable/js/jquery-1.12.4.js')}}"></script>


<link rel="stylesheet" href="{{ asset('datatable/css/jquery.dataTables.min.css')}}"> 
<script src="{{ asset('datatable/js/jquery.dataTables.min.js')}}"></script>



<script>
 /* function mostrarobjeto(id)
  {if(document.getElementById(id).style.display == "block")
  document.getElementById(id).style.display = "none";
  else
    document.getElementById(id).style.display = "block";
   }*/
</script>