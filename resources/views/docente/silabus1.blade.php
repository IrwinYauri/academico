@php
 session_start();
 $coddocentex="";
 if(isset($_SESSION['coddocentex'])){
  $coddocentex=$_SESSION['coddocentex'];
 }else {
   echo "NO esta autorizado";
   return "no identificado";
 }
  
 use App\Http\Controllers\DocenteController; 
 use App\Http\Controllers\SilabusemestreController; 
 use Illuminate\Support\Facades\Storage;

 $silabus=new SilabusemestreController();
 $miasistencia=new DocenteController();  


 function  vercursos($semestre,$coddocente)
   { 
       $sql="SELECT DISTINCT
	seccion_horario.doc_iCodigo,
	seccion.cur_iCodigo,
	docente.doc_vcPaterno,
	docente.doc_vcMaterno,
	docente.doc_vcNombre,
	seccion.sem_iCodigo,
	curso.cur_vcNombre,
	curso.cur_iSemestre,
	curso.cur_iCodigo,
	curso.cur_vcCodigo,
	seccion.sec_iNumero,
	curso.escpla_iCodigo,
	escuelaplan.escpla_vcCodigo,
	seccion.sec_iCodigo
FROM
	seccion_horario
INNER JOIN docente ON (
	seccion_horario.doc_iCodigo = docente.doc_iCodigo
)
INNER JOIN seccion ON (
	seccion_horario.sec_iCodigo = seccion.sec_iCodigo
)
INNER JOIN curso ON (
	seccion.cur_iCodigo = curso.cur_iCodigo
)
INNER JOIN escuelaplan ON (
	curso.escpla_iCodigo = escuelaplan.escpla_iCodigo
)
WHERE
	`seccion`.`sem_iCodigo` = '$semestre'
AND `seccion_horario`.`doc_iCodigo` = '$coddocente'
ORDER BY
	curso.cur_vcCodigo,
	curso.cur_iCodigo
  ";
   $data1=DB::select($sql);
  return $data1;
  }
 //$miscursos=$miasistencia->vercursos(semestreactual(),$coddocentex);
 $miscursos=vercursos(semestreactual(),$coddocentex);
//dd($miscursos);

@endphp

@php
//agrupando filtrando evitar duplicados
$milista = array();
$milistadata = array();
$micc=0;
foreach ( $miscursos as $value ) {
/*
echo "<br>".$value->cur_vcCodigo ;*/

$t=count($milista);
//echo "<br>total:".$t ;
//$micc=0;

//echo "<br>";
// echo "<br>total:".$micc ;
$b=0;
if($t>0)
 { for($x=0;$x<$t;$x++)
  {if($milista[$x]==$value->cur_vcCodigo)
  $b=1;
//  echo $milista[$x];
  }
}
  if($b==0)
 { $milista[]=$value->cur_vcCodigo; 
   $milistadata[]=["cur_vcCodigo"=>$value->cur_vcCodigo,
                   "cur_vcNombre"=>$value->cur_vcNombre,
                   "sec_iNumero"=>$value->sec_iNumero,
                   "escpla_vcCodigo"=>$value->escpla_vcCodigo,
                   "escuela"=>left($value->cur_vcCodigo,2),
                   "cur_iCodigo"=>$value->cur_iCodigo,
                   "cur_iSemestre"=>$value->cur_iSemestre,
                   "sem_iCodigo"=>$value->sem_iCodigo
                  ];
 }
  
//echo "xxx--".$milista[$t]."<br><br>";
}
//dd($miscursos); //antiguo
//dd($milistadata);
//FIN agrupando filtrando evitar duplicados
@endphp
<style>
  .table{

color: black;
}

</style>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-dark-800">SILABO</h1>
        </div>
                  

<div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">
      <i class="fa fa-book fa-2x" ></i> Lista de Cursos Asignado 
      </h6>
    </div>
  
      <div class="card-body">
      <table class='table table-striped   '>
      <thead>
        <tr style='background-color:navy;color:white;'>
          <td>NRO</td><td>Curso</td><td>Escuela</td><td>Semestre</td>
          <td>Archivo</td>
          <td>Estado </td>
          <td>Operacion </td>

        </tr>
      </thead>
        @php
            $nn=0;
        //    dd($miscursos);
        //$milistadata
        //foreach($miscursos as $listacur)
      //  dd($milistadata);
      $pendiente=0;
      $completado=0;
        @endphp
      
        @foreach($miscursos as $listacur)

        @php
      
        $nn++;
      @endphp
     
          <tr>
            
          <td>{{$nn}}</td>
          <td>{{ $listacur->cur_vcNombre }}</td>
          <td>{{ $listacur->escpla_vcCodigo }}</td>
          <td>{{ nroromano($listacur->cur_iSemestre) }}</td>
          <td>
            @php
            $resta=$silabus->estadosilasbufile($listacur->sem_iCodigo,$listacur->cur_iCodigo);
            $doc=$silabus->silabusfilenombre($listacur->sem_iCodigo,$listacur->cur_iCodigo);
            @endphp

            <form action="silabusemestre" method="POST" enctype="multipart/form-data">
            @csrf
            
            <input id="file" name="file" type="file" class="file" data-show-preview="false" >
            <input id="codcurso" name="codcurso" type="hidden" value="{{$listacur->cur_iCodigo}}" >
            <input id="semestre" name="semestre" type="hidden" value="{{$listacur->sem_iCodigo}}" >
            
            <input type="submit"  value="SUBIR" class="btn btn-primary btn-sm table-condensed">
          </form>                                
                                          
          </td>
          <td >
               @php
            //  dd($doc);

              if($resta=="COMPLETADO")
                  $completado++;
              if($resta=="PENDIENTE")
                 $pendiente++;
              echo $resta;
          @endphp
           </td>
          <td>
        @php
        $bloq=asset('storage/'.$doc);
            if($doc=="")
            $bloq="#";
        @endphp
          <a href="{{$bloq }}" class="btn btn-info btn-icon-split table-condensed" >
            <span class="icon text-white-50 table-condensed">
                <i class="fas fa-search"></i>
            </span>
            <span class="text">ver</span>
        </a>

        <form action="{{asset('silabusemestre')}}/555" method="post">
          <button type="submit" class="btn btn-danger btn-icon-split table-condensed" >
            <input type="hidden" name="arch" value="{{ $doc }}">

            <span class="icon text-white-50 table-condensed">
                <i class="fas fa-times"></i>
            </span>
            <span class="text">Eliminar</span>
          </button>
          {{ method_field('DELETE') }}
          @csrf
          <input id="codcurso" name="codcurso" type="hidden" value="{{$listacur->cur_iCodigo}}" >
          <input id="semestre" name="semestre" type="hidden" value="{{$listacur->sem_iCodigo}}" >
          </form>
        </td>
        </td>
      
        </tr>
    
        @endforeach
        
      </table>

          <!-- Basic Card Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Observaciones</h6>
            </div>
            <div class="card-body">
                Cumplidos:{{$completado}}  Faltantes:{{$pendiente}}
            </div>
        </div>

    </div>  

  </div>  
 
  <div id="miresultadoxy"></div>