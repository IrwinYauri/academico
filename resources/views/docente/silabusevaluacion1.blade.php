@php
 use App\Http\Controllers\DocenteController; 
 use App\Http\Controllers\SilabusemestreController;
 
 use App\Http\Controllers\AdminController; 
 $listasemestres=new AdminController();
$listasemestre=$listasemestres->versemestre();

 session_start();
 $coddocentex="";
 if(isset($_SESSION['coddocentex'])){
  $coddocentex=$_SESSION['coddocentex'];
 }
 $miasistencia=new DocenteController();  
 $miscursos=$miasistencia->vercursos(semestreactual(),$coddocentex);

//dd($miscursos);

@endphp

@php
$ncomp=0;
$npen=0;
function versilabuscriterioexiste($sem,$codcurso)
{ $cantunidad="";
  $silabos=new SilabusemestreController();
  $rptsilabo=$silabos->buscarcriteriosilabo($sem,$codcurso);

 // $xsilabu=$silabos->registrarsilabus(439);
 
  //dd($xsilabu);
  $cantunidad=0;
  foreach ($rptsilabo as $versilaboc) {
    //$versilaboc->
   $cantunidad=$versilaboc->unidades;
  // echo  $cantunidad;
 }
 //if(isset($cantunidad))
 //$cantunidad=0;
 
 if($cantunidad*1>0)
return "COMPLETADO";
else
return "PENDIENTE";
//dd($rptsilabo);
}

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
                   "sec_iCodigo"=>$value->sec_iCodigo
                  ];
 }
  
//echo "xxx--".$milista[$t]."<br><br>";
}
//dd($miscursos); //antiguo
//dd($milistadata);
//FIN agrupando filtrando evitar duplicados
@endphp

<style>
  .table-condensed{
font-size: 10px;
color: black;
}
.filacolor
{ background-color: white;
color: black;}
.modalDialog {
	position: fixed;
	font-family: Arial, Helvetica, sans-serif;
	top: 0;
	right: 0;
	bottom: 0;
	left: 0;
	background: rgba(7, 153, 68, 0.61);
	z-index: 99999;
	opacity:0;
	-webkit-transition: opacity 400ms ease-in;
	-moz-transition: opacity 400ms ease-in;
	transition: opacity 400ms ease-in;
	pointer-events: none;
}
.modalDialog:target {
	opacity:1;
	pointer-events: auto;
}
.modalDialog > div {
	width: 800px;
	position: relative;
	margin: 10% auto;
	padding: 5px 20px 13px 20px;
	border-radius: 10px;
	background: #fff;
	background: -moz-linear-gradient(#fff, rgb(87, 207, 117));
	background: -webkit-linear-gradient(#fff, rgb(12, 104, 61));
	background: -o-linear-gradient(#fff, rgb(82, 145, 63));
  -webkit-transition: opacity 400ms ease-in;
-moz-transition: opacity 400ms ease-in;
transition: opacity 400ms ease-in;
}
.close {
	background: red;
	color: #FFFFFF;
	line-height: 25px;
	position: absolute;
	right: 10px;
	text-align: center;
	top: 0px;
	width: 40px;
	text-decoration: none;
	font-weight: bold;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;
	-moz-box-shadow: 1px 1px 3px #000;
	-webkit-box-shadow: 1px 1px 3px #000;
	box-shadow: 1px 1px 3px #000;
}
.close:hover { background: #d60787; }

</style>



<div class="card shadow mb-4">
  <div class="card shadow mb-4">
    <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">
    <i class="fa fa-book fa-2x" ></i> Lista de Curso - Criterios de Evaluacion
    </h6>
  </div>
  <div class="card-body" style='overflow: scroll;'>
  <table border=1 frame=hsides rules=rows class='table table-striped table-condensed' >
    <thead>
    <tr style='background-color:navy;color:white;'>
      <td>NRO</td>
      <td>SEMESTRE</td>
      <td>EP</td>
      <td>PLAN</td>
      <td>CODIGO</td>
      <td>CURSO</td><td>GRUPO</td>
      <td>ALUMNOS </td>
      <th>ESTADO</th>
      <th>OP</th> 
    </tr>
  </thead>
    @php
    function veralumnomatriculados($codcur,$semestre,$fila)
  {$miasistencia=new DocenteController(); 

    echo "<table class='table table-striped table-condensed'>
        <tr style='background-color:black;color:white;'>
      <td>Nro</td> <td>Codigo</td> <td>Nombre</td><td>Email</td>
    </tr>";
    $misalumnos=$miasistencia->vercursosalumnos(trim($codcur),$semestre);
   // dd($misalumnos);
  $nro=0;
      foreach ($misalumnos as $alumno) {
        $nro++;
        $cod=$alumno->alu_vcCodigo;
        $estudiante=$alumno->alumno;
        $email=$alumno->alu_vcEmail;
      echo "<tr style='color:black'>
            <td>$nro</td>
            <td>$cod</td>
          <td>$estudiante</td>
          <td>$email</td>
          </tr>";
      }
  echo "</table>";
  echo "
  <script>
    document.getElementById('nlista$fila').innerHTML = '$nro';
  </script>";

  }  
 
        $nn=0;
    //    dd($miscursos);
    //$milistadata
    //foreach($miscursos as $listacur)
    @endphp
    @foreach($milistadata as $listacur)
    @php
    $nn++;
  @endphp
      <tr>
        <td>{{$nn}} </td>
        <td> {{ semestreactual()}}</td>
      <td>{{ left($listacur["cur_vcCodigo"],2) }}</td>
      <td>{{ $listacur["escpla_vcCodigo"] }}</td>
      <td>{{$codcurso= $listacur["cur_vcCodigo"] }}</td>
      <td>{{ $curso=$listacur["cur_vcNombre"] }}</td>
      <td>{{ $listacur["sec_iNumero"] }}</td>
  
      <td id="nlista{{$nn}}">0</td>
      <td id="pendiente{{$nn}}">
      {{ versilabuscriterioexiste(semestreactual(),$listacur["cur_iCodigo"]) }}
      @php
          if(versilabuscriterioexiste(semestreactual(),$listacur["cur_iCodigo"])=="COMPLETADO")
          {$ncomp++;}
          if(versilabuscriterioexiste(semestreactual(),$listacur["cur_iCodigo"])=="PENDIENTE")
          {$npen++;}
      @endphp
      
     
      </td>
      <td><a  class="btn btn-primary" 
        onclick="vercursoscriterio('{{ $codcurso }} ', '{{ $curso }}',{{$listacur['sec_iCodigo'] }},{{semestreactual()}},'{{ versilabuscriterioexiste(semestreactual(),$listacur['cur_iCodigo']) }}');" >configurar</a>
        </td>
    </tr>
    <tr style="display:none" id="tn{{$nn}}">
      <td colspan="6"> 
        @php
          veralumnomatriculados($listacur["cur_iCodigo"],semestreactual(),$nn);
        @endphp
      </td>
    </tr>
    @endforeach
    
  </table>
  </div>
  </div>

 
  </div>

<script> 
function vercursoscriterio(idcurso,curso,seccion,semestre,estado)
{ if(estado==="PENDIENTE")
    {//location.href=""
    location.href="#openModal"
       document.getElementById("idcurso").innerHTML=idcurso;
      document.getElementById("idcursonombre").innerHTML=curso;
      document.getElementById("seccion").value=seccion;
      reiniciar();
      buscarfechasemestre({{semestreactual()}});
      versemestrecriterios(seccion);
    }
    if(estado==="COMPLETADO")
    { location.href="#close"
      alertagrabarx("CRITERIO DE EVALUACION YA ESTA CONFIGURADO",'navy')
    }
}
</script>



                     


<script>
  function vernroevaluacion(elemento,nro)
  {r=elemento.value;
    switch(r*1) {
  case 1:
  ocultarnroeval(nro);
  //document.getElementById("nroeva11").style.display="block";
  document.getElementById("pesoevaluacion"+nro.toString()).value="Aritmetico";

    break;
  case 2:
  ocultarnroeval(nro);
  document.getElementById("nroeva"+nro.toString()+"1").style.display="block";
  document.getElementById("nroeva"+nro.toString()+"2").style.display="block";
  document.getElementById("pesoevaluacion"+nro.toString()).value="Pesos";
  
    break;
    case 3:
    ocultarnroeval(nro);
    document.getElementById("nroeva"+nro.toString()+"1").style.display="block";
    document.getElementById("nroeva"+nro.toString()+"2").style.display="block";
    document.getElementById("nroeva"+nro.toString()+"3").style.display="block";
    document.getElementById("pesoevaluacion"+nro.toString()).value="Pesos";
    break;
    case 4:
    ocultarnroeval(nro);
    document.getElementById("nroeva"+nro.toString()+"1").style.display="block";
    document.getElementById("nroeva"+nro.toString()+"2").style.display="block";
    document.getElementById("nroeva"+nro.toString()+"3").style.display="block";
    document.getElementById("nroeva"+nro.toString()+"4").style.display="block";
    document.getElementById("pesoevaluacion"+nro.toString()).value="Pesos";
    break;
  default:
  ocultarnroeval(nro);
    // code block
     }
   }

   function vernrounidad(elemento)
  {//r=elemento.value;
    r=elemento;
   // alert(r)
    switch(r*1) {
  case 1:
 // ocultarnrounidad();
 // document.getElementById("unidad11").style.display="block";
// ocultarnrounidad();
ocultarnrounidad();
  document.getElementById("unidad1").style.visibility="visible";
  document.getElementById("labelunidad1").innerHTML="ACTIVADO";
  document.getElementById("pesopromediodet").value="Aritmetico";
  //.visibility
  
    break;
  case 2:
  ocultarnrounidad();
  document.getElementById("unidad1").style.visibility="visible";
  document.getElementById("unidad2").style.visibility="visible";
  document.getElementById("labelunidad1").innerHTML="ACTIVADO";
  document.getElementById("labelunidad2").innerHTML="ACTIVADO";
  document.getElementById("pesopf1").value=50;
  document.getElementById("pesopf2").value=50;
  document.getElementById("pesopf1").disabled = false;
  document.getElementById("pesopf2").disabled = false;
  
  document.getElementById("pesopromediodet").disabled = false;
    break;
    case 3:
    ocultarnrounidad();
    document.getElementById("unidad1").style.visibility="visible";
  document.getElementById("unidad2").style.visibility="visible";
  document.getElementById("unidad3").style.visibility="visible";
  document.getElementById("labelunidad1").innerHTML="ACTIVADO";
  document.getElementById("labelunidad2").innerHTML="ACTIVADO";
  document.getElementById("labelunidad3").innerHTML="ACTIVADO";
  document.getElementById("pesopf1").value=30;
  document.getElementById("pesopf2").value=30;
  document.getElementById("pesopf3").value=40;
  document.getElementById("pesopf1").disabled = false;
  document.getElementById("pesopf2").disabled = false;
  document.getElementById("pesopf3").disabled = false;
  document.getElementById("pesopromediodet").disabled = false;
    break;
    case 4:
    ocultarnrounidad();
    document.getElementById("unidad1").style.visibility="visible";
    document.getElementById("unidad2").style.visibility="visible";
    document.getElementById("unidad3").style.visibility="visible";
    document.getElementById("unidad4").style.visibility="visible";
    document.getElementById("labelunidad1").innerHTML="ACTIVADO";
    document.getElementById("labelunidad2").innerHTML="ACTIVADO";
    document.getElementById("labelunidad3").innerHTML="ACTIVADO"; 
    document.getElementById("labelunidad4").innerHTML="ACTIVADO"; 
    document.getElementById("pesopf1").value=25;
    document.getElementById("pesopf2").value=25;
    document.getElementById("pesopf3").value=25;
    document.getElementById("pesopf4").value=25;
    document.getElementById("pesopf1").disabled = false;
    document.getElementById("pesopf2").disabled = false;
    document.getElementById("pesopf3").disabled = false;
    document.getElementById("pesopf4").disabled = false;
    document.getElementById("pesopromediodet").disabled = false;
    break;
    case 5:
    ocultarnrounidad();
    document.getElementById("unidad1").style.visibility="visible";
    document.getElementById("unidad2").style.visibility="visible";
    document.getElementById("unidad3").style.visibility="visible";
    document.getElementById("unidad4").style.visibility="visible";
    document.getElementById("unidad5").style.visibility="visible";
    document.getElementById("labelunidad1").innerHTML="ACTIVADO";
    document.getElementById("labelunidad2").innerHTML="ACTIVADO";
    document.getElementById("labelunidad3").innerHTML="ACTIVADO"; 
    document.getElementById("labelunidad4").innerHTML="ACTIVADO"; 
    document.getElementById("labelunidad5").innerHTML="ACTIVADO"; 
    document.getElementById("pesopf1").value=20;
    document.getElementById("pesopf2").value=20;
    document.getElementById("pesopf3").value=20;
    document.getElementById("pesopf4").value=20;
    document.getElementById("pesopf5").value=20;
    document.getElementById("pesopf1").disabled = false;
    document.getElementById("pesopf2").disabled = false;
    document.getElementById("pesopf3").disabled = false;
    document.getElementById("pesopf4").disabled = false;
    document.getElementById("pesopf5").disabled = false;
    document.getElementById("pesopromediodet").disabled = false;
    
    break;
  default:
  ocultarnrounidad();
    // code block
     }
   }


   function ocultarnrounidad()
   {// document.getElementById("unidad11").style.display="none";
  // document.getElementById("dataTablex").style.display="none";
  // document.getElementById("unidad0").style.display="none";
   document.getElementById("unidad1").style.visibility= "hidden";
    document.getElementById("unidad2").style.visibility="hidden";
    document.getElementById("unidad3").style.visibility="hidden";
    document.getElementById("unidad4").style.visibility="hidden";
    document.getElementById("unidad5").style.visibility="hidden";
    document.getElementById("labelunidad1").innerHTML="BLOQUEADO";
    document.getElementById("labelunidad2").innerHTML="BLOQUEADO";
    document.getElementById("labelunidad3").innerHTML="BLOQUEADO";
    document.getElementById("labelunidad4").innerHTML="BLOQUEADO";
    document.getElementById("labelunidad5").innerHTML="BLOQUEADO";
    ///
    document.getElementById("pesopf1").value=0;
    document.getElementById("pesopf2").value=0;
    document.getElementById("pesopf3").value=0;
    document.getElementById("pesopf4").value=0;
    document.getElementById("pesopf5").value=0;
    document.getElementById("pesopf1").disabled = true;
    document.getElementById("pesopf2").disabled = true;
    document.getElementById("pesopf3").disabled = true;
    document.getElementById("pesopf4").disabled = true;
    document.getElementById("pesopf5").disabled = true;
    
    document.getElementById("pesopromediodet").disabled = true;
    document.getElementById("pesopromediodet").value="Pesos";
    }

    function ocultarnroeval(nro)
   {document.getElementById("nroeva"+nro.toString()+"1").style.display="none";
    document.getElementById("nroeva"+nro.toString()+"2").style.display="none";
    document.getElementById("nroeva"+nro.toString()+"3").style.display="none";
    document.getElementById("nroeva"+nro.toString()+"4").style.display="none";
    }
</script>





    <div class="card-body">
    

        <!-- Basic Card Example -->
        <div class="card shadow mb-4">
          <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Observaciones</h6>
          </div>
          <div class="card-body">
              Cumplidos:{{$ncomp}}  faltantes:{{$npen}}
             
          </div>
      </div>

                          <!--  fin ventana popap  //-->
      <div id="openModal" class="modalDialog">
        <div>
         <a href="#close" title="CERRAR" class="close btn btn-danger"> X </a>  
         <div class="row" style="background-color: navy;color:white">
          &nbsp &nbsp<i class="fa fa-book fa-2x" ></i> <h5 class="modal-title " id="exampleModalLongTitle"> CONFIGURAR CRITERIOS DE EVALUACION</h5>
          
        </div> 
                              <div class="modal-header">
                                
                               <!-- <a class="close"  href="#close">
                                  <span aria-hidden="true">&times;</span>
                                </a>  //-->
                              </div>
                              <div class="modal-body">
                              <table class="table-condensed">
                              <tr>   
                              <td cols=2> Codigo:  <label id="idcurso">mat</label> <input type="text" id="seccion"></td>   
                              </tr> 
                              <tr>   
                                <td cols=2> Curso:  <label id="idcursonombre">mat</label></td>   
                                </tr>      
                        <tr>  <td>   NRO de Unidades</td>
                              <td>  <select id="nrounidad" onchange="vernrounidad(this.value)">
                                <option>Seleccionar</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                                </select> (max:5)</td>
                        </tr> 
                        <tr>
                        <td>Tipo Promedio</td>
                        <td><select id="pesopromediodet" disabled>
                        <option>Aritmetico</option>
                        <option>Pesos</option>
                        </select> 
                        <input type="number"  max="5" size="5" id="pesopf1" disabled>
                        <input type="number"  max="5" size="5" id="pesopf2" disabled>
                        <input type="number"  max="5" size="5" id="pesopf3" disabled>
                        <input type="number"  max="5" size="5" id="pesopf4" disabled>
                        <input type="number"  max="5" size="5" id="pesopf5" disabled>
                        </td>
                        
                        </tr>
                        <!-- <tr><td><button>generar</button></td></tr> //-->
                        </table>
                        <table class="table table-bordered table-condensed" id="dataTablex" 
                        width="100%" cellspacing="0"  >
                        <thead>
                        <tr style='background-color:navy;color:white;' id="unidad0" >
                        <th>Nro UNI</th>
                        <th>Nro Evals</th>
                        <th>Detalle</th>
                        <th>Tipo evals</th>
                        <th>%Pesos de Unidad </th>
                        <th>inicio</th>
                        <th>Vence</th>
                        <th>Estado</th>
                        </tr>
                        </thead>
                        <tbody>
                        
                        
                        <tr  id="unidad1" style="visibility:hidden;" class="filacolor">
                          <td >Unidad I</td>
                          <td ><select id="nroevaluacion1" onchange="vernroevaluacion(this,1)">
                            <option>Seleccionar</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            </select></td>
                          <td >Tipo Pro. Unidad I</td>
                          <td >
                          <select id="pesoevaluacion1">
                          <option>Seleccionar</option>
                          <option>Aritmetico</option>
                          <option>Pesos</option>
                          </select></td>
                          <td ><form>
                          <input type="number"  max="5" size="5" style="display:none" id="nroeva11">
                          <input type="number"  max="5" size="5" style="display:none" id="nroeva12">
                          <input type="number"  max="5" size="5" style="display:none" id="nroeva13">
                          <input type="number"  max="5" size="5" style="display:none" id="nroeva14">
                          </form></td>
                          <td ><input type="date"  max="10" size="10"  id="fecha1"></td>
                          <td ><input type="date"  max="10" size="10" id="fecha11"></td>
                          <td ><Label id="labelunidad1">Bloqueado</Label> </td>
                          </tr>
                        
                          <tr id="unidad2" style="visibility:hidden;" class="filacolor">
                            <td>Unidad II</td>
                            <td><select id="nroevaluacion2" onchange="vernroevaluacion(this,2)">
                              <option>Seleccionar</option>
                              <option>1</option>
                              <option>2</option>
                              <option>3</option>
                              <option>4</option>
                              </select></td>
                            <td>Tipo Pro. Unidad II</td>
                            <td>
                            <select id="pesoevaluacion2">
                            <option>Seleccionar</option>
                            <option>Aritmetico</option>
                            <option>Pesos</option>
                            </select></td>
                            <td><form>
                            <input type="number"  max="5" size="5" style="display:none" id="nroeva21">
                            <input type="number"  max="5" size="5" style="display:none" id="nroeva22">
                            <input type="number"  max="5" size="5" style="display:none" id="nroeva23">
                            <input type="number"  max="5" size="5" style="display:none" id="nroeva24">
                            </form></td>
                            <td ><input type="date"  max="10" size="10"  id="fecha2"></td>
                            <td ><input type="date"  max="10" size="10" id="fecha22"></td>
                            <td ><Label id="labelunidad2">Bloqueado</Label> </td>
                        
                            </tr>
                        
                            <tr id="unidad3" style="visibility:hidden;" class="filacolor">
                              <td>Unidad III</td>
                              <td><select id="nroevaluacion3" onchange="vernroevaluacion(this,3)">
                                <option>Seleccionar</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                </select></td>
                              <td>Tipo Pro. Unidad III</td>
                              <td>
                              <select id="pesoevaluacion3">
                              <option>Seleccionar</option>
                              <option>Aritmetico</option>
                              <option>Pesos</option>
                              </select></td>
                              <td><form>
                              <input type="number"  max="5" size="5" style="display:none" id="nroeva31">
                              <input type="number"  max="5" size="5" style="display:none" id="nroeva32">
                              <input type="number"  max="5" size="5" style="display:none" id="nroeva33">
                              <input type="number"  max="5" size="5" style="display:none" id="nroeva34">
                              </form></td>
                              <td ><input type="date"  max="10" size="10"  id="fecha3"></td>
                              <td ><input type="date"  max="10" size="10"  id="fecha33"></td>
                            <td ><Label id="labelunidad3">Bloqueado</Label> </td> 
                              </tr>
                        
                              <tr id="unidad4" style="visibility:hidden;" class="filacolor">
                                <td>Unidad IV</td>
                                <td><select id="nroevaluacion4" onchange="vernroevaluacion(this,4)">
                                  <option>Seleccionar</option>
                                  <option>1</option>
                                  <option>2</option>
                                  <option>3</option>
                                  <option>4</option>
                                  </select></td>
                                <td>Tipo Pro. Unidad IV</td>
                                <td>
                                <select id="pesoevaluacion4">
                                <option>Seleccionar</option>
                                <option>Aritmetico</option>
                                <option>Pesos</option>
                                </select></td>
                                <td><form>
                                <input type="number"  max="5" size="5" style="display:none" id="nroeva41">
                                <input type="number"  max="5" size="5" style="display:none" id="nroeva42">
                                <input type="number"  max="5" size="5" style="display:none" id="nroeva43">
                                <input type="number"  max="5" size="5" style="display:none" id="nroeva44">
                                </form></td>
                                <td ><input type="date"  max="10" size="10"  id="fecha4"></td>
                                <td ><input type="date"  max="10" size="10"  id="fecha44"></td>
                                <td ><Label id="labelunidad4">Bloqueado</Label> </td> 
                                </tr>
                        
                                <tr id="unidad5" style="visibility:hidden;" class="filacolor">
                                  <td>Unidad V</td>
                                  <td><select id="nroevaluacion5" onchange="vernroevaluacion(this,5)">
                                    <option>Seleccionar</option>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    </select></td>
                                  <td>Tipo Pro. Unidad V</td>
                                  <td>
                                  <select id="pesoevaluacion5">
                                  <option>Seleccionar</option>
                                  <option>Aritmetico</option>
                                  <option>Pesos</option>
                                  </select></td>
                                  <td><form>
                                  <input type="number"  max="5" size="5" style="display:none" id="nroeva51">
                                  <input type="number"  max="5" size="5" style="display:none" id="nroeva52">
                                  <input type="number"  max="5" size="5" style="display:none" id="nroeva53">
                                  <input type="number"  max="5" size="5" style="display:none" id="nroeva54">
                                  </form></td>
                                  <td ><input type="date"  max="10" size="10"  id="fecha5"></td>
                                  <td ><input type="date"  max="10" size="10"  id="fecha55"></td>
                                  <td ><Label id="labelunidad5">Bloqueado</Label> </td> 
                                  </tr>
                        
                        </tbody>
                        </table>
                              </div>
                              <a  name="bclava1" id="bclava1" class="btn btn-primary btn-sm"  onclick="ncrearsilabus()">
                               GUARDAR
                              </a>
                              <a name="bclava1" id="bclava1" class="btn btn-danger btn-sm" href="#close">
                              Cancelar
                            </a>
          
              
                </div>
              </div>
                 <!--  fin ventana popap  //-->

                 <!--  procesar contenido  //-->
                 <div id="micontenidoxyx" style="display: none"></div>

      <script>
        
       activarwow()

       function ncrearsilabus()
       {error=0
        rrep=0
         seccion=document.getElementById('seccion').value;
      //   alert(seccion)
        unidades=document.getElementById('nrounidad').value;
        tipoPF=document.getElementById('pesopromediodet').value;
        formulaPF=""

          ff11=(document.getElementById('pesopf1').value*1)/100;
          ff12=(document.getElementById('pesopf2').value*1)/100;
          ff13=(document.getElementById('pesopf3').value*1)/100;
          ff14=(document.getElementById('pesopf4').value*1)/100;
          ff15=(document.getElementById('pesopf5').value*1)/100;
          
        
          if(tipoPF=="Pesos")
          {if(unidades==2)
            {formulaPF=formulaPF.concat(ff11,"-",ff12)
            rrep=ff11+ff12
            if(rrep!=1)
            error=1
              }
           if(unidades==3)
                {formulaPF=formulaPF.concat(ff11,"-",ff12,"-",ff13)
                rrep=ff11+ff12+ff13
                if(rrep!=1)
                error=1}
              if(unidades==4)
              { formulaPF=formulaPF.concat(ff11,"-",ff12,"-",ff13,"-",ff14)
                rrep=ff11+ff12+ff13+ff14
                if(rrep!=1)
                error=1}
              if(unidades==4)
                { formulaPF=formulaPF.concat(ff11,"-",ff12,"-",ff13,"-",ff14,"-",ff15)
                  rrep=ff11+ff12+ff13+ff14
                if(rrep!=1)
                error=1}
             
          }

        
        tipoPU1=document.getElementById('pesoevaluacion1').value;//pesos
        nro_evalPU1=document.getElementById('nroevaluacion1').value;
        formulaPU1=""

          ff11=(document.getElementById('nroeva11').value*1)/100;
          ff12=(document.getElementById('nroeva12').value*1)/100;
          ff13=(document.getElementById('nroeva13').value*1)/100;
          ff14=(document.getElementById('nroeva14').value*1)/100;
          
        
          if(tipoPU1=="Pesos")
          {if(nro_evalPU1==2)
              {formulaPU1=formulaPU1.concat(ff11,"-",ff12)
              rrep=ff11+ff12
              if(rrep!=1)
              error=1
              }
          if(nro_evalPU1==3)
            {formulaPU1=formulaPU1.concat(ff11,"-",ff12,"-",ff13)
            rrep=ff11+ff12+ff13
                if(rrep!=1)
                error=1
                }
          
              if(nro_evalPU1==4)
              {formulaPU1=formulaPU1.concat(ff11,"-",ff12,"-",ff13,"-",ff14)
                rrep=ff11+ff12+ff13+ff14
                if(rrep!=1)
                error=1
              }
          }

        tipoPU2=document.getElementById('pesoevaluacion2').value; //pesos
        nro_evalPU2=document.getElementById('nroevaluacion2').value;
        formulaPU2=""
        
          ff11=(document.getElementById('nroeva21').value*1)/100;
          ff12=(document.getElementById('nroeva22').value*1)/100;
          ff13=(document.getElementById('nroeva23').value*1)/100;
          ff14=(document.getElementById('nroeva24').value*1)/100;
          
        
          if(tipoPU2=="Pesos")
          { if(nro_evalPU2==2)
              { formulaPU2=formulaPU2.concat(ff11,"-",ff12)
              rrep=ff11+ff12
                if(rrep!=1)
                error=1
                }
            if(nro_evalPU2==3)
             { formulaPU2=formulaPU2.concat(ff11,"-",ff12,"-",ff13)
                 rrep=ff11+ff12+ff13
                if(rrep!=1)
                error=1
                }
            if(nro_evalPU2==4)
             {formulaPU2=formulaPU2.concat(ff11,"-",ff12,"-",ff13,"-",ff14)
                rrep=ff11+ff12+ff13+ff14
                if(rrep!=1)
                error=1
                }
          }




        tipoPU3=document.getElementById('pesoevaluacion3').value; //pesos
        nro_evalPU3=document.getElementById('nroevaluacion3').value;
        formulaPU3=""
        
        ff11=(document.getElementById('nroeva31').value*1)/100;
          ff12=(document.getElementById('nroeva32').value*1)/100;
          ff13=(document.getElementById('nroeva33').value*1)/100;
          ff14=(document.getElementById('nroeva34').value*1)/100;
          
        
          if(tipoPU3=="Pesos")
          {   if(nro_evalPU3==2)
             {formulaPU3=formulaPU3.concat(ff11,"-",ff12)
              rrep=ff11+ff12
                if(rrep!=1)
                error=1
                }
              if(nro_evalPU3==3)
                {formulaPU3=formulaPU3.concat(ff11,"-",ff12,"-",ff13)
                rrep=ff11+ff12+ff13
                  if(rrep!=1)
                  error=1
                  }
              if(nro_evalPU3==4)
                {formulaPU3=formulaPU3.concat(ff11,"-",ff12,"-",ff13,"-",ff14)
                rrep=ff11+ff12+ff13+ff14
                    if(rrep!=1)
                    error=1
                    }
          }

        
        tipoPU4=document.getElementById('pesoevaluacion4').value;//pesos
        nro_evalPU4=document.getElementById('nroevaluacion4').value;
        formulaPU4=""

        ff11=(document.getElementById('nroeva41').value*1)/100;
          ff12=(document.getElementById('nroeva42').value*1)/100;
          ff13=(document.getElementById('nroeva43').value*1)/100;
          ff14=(document.getElementById('nroeva44').value*1)/100;
          
        
          if(tipoPU4=="Pesos")
          {   if(nro_evalPU4==2)
                {formulaPU4=formulaPU4.concat(ff11,"-",ff12)
                  rrep=ff11+ff12
                    if(rrep!=1)
                    error=1
                    }

              if(nro_evalPU4==3)
              {formulaPU4=formulaPU4.concat(ff11,"-",ff12,"-",ff13)
              rrep=ff11+ff12+ff13
                    if(rrep!=1)
                    error=1
                    }

              if(nro_evalPU4==4)
              {formulaPU4=formulaPU4.concat(ff11,"-",ff12,"-",ff13,"-",ff14)
               rrep=ff11+ff12+ff13+ff14
                    if(rrep!=1)
                    error=1
                    }

          }
        

        tipoPU5=document.getElementById('pesoevaluacion5').value;//pesos
        nro_evalPU5=document.getElementById('nroevaluacion5').value;
        formulaPU5=""
        
        ff11=(document.getElementById('nroeva51').value*1)/100;
          ff12=(document.getElementById('nroeva52').value*1)/100;
          ff13=(document.getElementById('nroeva53').value*1)/100;
          ff14=(document.getElementById('nroeva54').value*1)/100;
          
        
          if(tipoPU5=="Peso")
          {if(nro_evalPU5==2)
              {formulaPU4=formulaPU5.concat(ff11,"-",ff12)
              rrep=ff11+ff12
                      if(rrep!=1)
                      error=1
                      }
          if(nro_evalPU5==3)
              {formulaPU5=formulaPU5.concat(ff11,"-",ff12,"-",ff13)
                rrep=ff11+ff12+ff13
                        if(rrep!=1)
                        error=1
                        }
          if(nro_evalPU5==4)
              {formulaPU5=formulaPU5.concat(ff11,"-",ff12,"-",ff13,"-",ff14)
              rrep=ff11+ff12+ff13+ff14
                            if(rrep!=1)
                            error=1
                          }
          }


        fech_ent1_ini=document.getElementById('fecha1').value;
        fech_ent1_fin=document.getElementById('fecha11').value;
        fech_ent2_ini=document.getElementById('fecha2').value;
        fech_ent2_fin=document.getElementById('fecha22').value;
        fech_ent3_ini=document.getElementById('fecha3').value;
        fech_ent3_fin=document.getElementById('fecha33').value;
        fech_ent4_ini=document.getElementById('fecha4').value;
        fech_ent4_fin=document.getElementById('fecha44').value;
        fech_ent5_ini=document.getElementById('fecha5').value;
        fech_ent5_fin=document.getElementById('fecha55').value; 


        if(nro_evalPU1=='Seleccionar')
        nro_evalPU1=0;
        if(nro_evalPU2=='Seleccionar')
        nro_evalPU2=0;
        if(nro_evalPU3=='Seleccionar')
        nro_evalPU3=0;
        if(nro_evalPU4=='Seleccionar') 
        nro_evalPU4=0;
        if(nro_evalPU5=='Seleccionar')
        nro_evalPU5=0;


        if(tipoPF=="Aritmetico")
        tipoPF="PA";

        if(tipoPU1=="Aritmetico")
        tipoPU1="PA";

        if(tipoPU2=="Aritmetico")
        tipoPU2="PA";

        if(tipoPU3=="Aritmetico")
        tipoPU3="PA";
        
        if(tipoPU4=="Aritmetico")
        tipoPU4="PA";
        
      //  alert(error)
        if(error==1)
       { 
         alert("ERROR: LA SUMA DE PORCENTAJES NO ES 100") 
          
      }
        else
        {alertagrabarx("CRITERIO DE EVALUACION ACTUALIZADO",'navy');
     /*   nrounidad
pesopromediodet
unidad1
pesoevaluacion1
unidad2
pesoevaluacion2
unidad3
pesoevaluacion3
unidad4
pesoevaluacion4
unidad5
pesoevaluacion5*/
//alert(tipoPU3)
        crearsilabus(seccion,unidades,
        tipoPF,
        formulaPF,
        tipoPU1,
        formulaPU1,
        nro_evalPU1,
        tipoPU2,
        formulaPU2,
        nro_evalPU2,
        tipoPU3,
        formulaPU3,
        nro_evalPU3,
        tipoPU4,
        formulaPU4,
        nro_evalPU4,
        tipoPU5,
        formulaPU5,
        nro_evalPU5,
        fech_ent1_ini,
        fech_ent1_fin,
        fech_ent2_ini,
        fech_ent2_fin,
        fech_ent3_ini,
        fech_ent3_fin,
        fech_ent4_ini,
        fech_ent4_fin,
        fech_ent5_ini,
        fech_ent5_fin)
        location.href="#close" 
        }

       }

       function reiniciar()
       {//document.getElementById('seccion').value

document.getElementById('nrounidad').value='Seleccionar'
document.getElementById('pesopromediodet').value=='Seleccionar' //pes

document.getElementById('pesopf1').value=0
document.getElementById('pesopf2').value=0
document.getElementById('pesopf3').value=0
document.getElementById('pesopf4').value=0
document.getElementById('pesopf5').value=0

document.getElementById('pesoevaluacion1').value='Seleccionar'  //peso
document.getElementById('nroevaluacion1').value='Seleccionar'
document.getElementById('nroeva11').value=0
document.getElementById('nroeva12').value=0
document.getElementById('nroeva13').value=0
document.getElementById('nroeva14').value=0

document.getElementById('pesoevaluacion2').value='Seleccionar'
document.getElementById('nroevaluacion2').value='Seleccionar'
document.getElementById('nroeva21').value=0
document.getElementById('nroeva22').value=0
document.getElementById('nroeva23').value=0
document.getElementById('nroeva24').value=0

document.getElementById('pesoevaluacion3').value='Seleccionar'
document.getElementById('nroevaluacion3').value='Seleccionar'
document.getElementById('nroeva31').value=0
document.getElementById('nroeva32').value=0
document.getElementById('nroeva33').value=0
document.getElementById('nroeva34').value=0


document.getElementById('pesoevaluacion4').value='Seleccionar'
document.getElementById('nroevaluacion4').value='Seleccionar'
document.getElementById('nroeva41').value=0
document.getElementById('nroeva42').value=0
document.getElementById('nroeva43').value=0
document.getElementById('nroeva44').value=0


document.getElementById('pesoevaluacion5').value='Seleccionar'
document.getElementById('nroevaluacion5').value='Seleccionar'
document.getElementById('nroeva51').value=0
document.getElementById('nroeva52').value=0
document.getElementById('nroeva53').value=0
document.getElementById('nroeva54').value=0

document.getElementById('fecha1').value=''
document.getElementById('fecha11').value=''
document.getElementById('fecha2').value=''
document.getElementById('fecha22').value=''
document.getElementById('fecha3').value=''
document.getElementById('fecha33').value=''
document.getElementById('fecha4').value=''
document.getElementById('fecha44').value=''
document.getElementById('fecha5').value=''
document.getElementById('fecha55').value=''

       }
      </script>
      <div id="miresultadoxy" style="display: none;"></div>
      <div id="mimensajex">GRABANDO</div>