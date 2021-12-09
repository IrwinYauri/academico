@php
$semestreactual=semestreactual();
$gcodcurso="0";
$curso="";
$escuela="";
if(isset($_REQUEST["xcod"]))
{$gcodcurso=$_REQUEST["xcod"];
$curso=$_REQUEST["curso"];
$escuela=$_REQUEST["escuela"];
}
else {
    return 0;
}
//preparando lista


function  vercursosalumnos($codcurso,$semestre)
  { 
      $sql='SELECT 
      concat(alumno.alu_vcPaterno," ",
      alumno.alu_vcMaterno," ",
      alumno.alu_vcNombre) as alumno,
      curso.cur_vcNombre,
      curso.cur_vcCodigo,
      curso.cur_iCodigo,
      seccion.sem_iCodigo,
      seccion.sec_iCodigo,
      matriculadetalle.mat_iCodigo,
      matriculadetalle.matdet_iCodigo,
      matricula.alu_iCodigo,
      matricula.sem_iCodigo,
  alumno.alu_vcEmail,
   alumno.alu_vcCodigo
    FROM
      alumno
      INNER JOIN matricula ON (alumno.alu_iCodigo = matricula.alu_iCodigo)
      INNER JOIN matriculadetalle ON (matricula.mat_iCodigo = matriculadetalle.mat_iCodigo)
      INNER JOIN seccion ON (seccion.sec_iCodigo = matriculadetalle.sec_iCodigo)
      INNER JOIN curso ON (curso.cur_iCodigo = seccion.cur_iCodigo)
    WHERE
      curso.cur_iCodigo = "'.$codcurso.'" AND 
      seccion.sem_iCodigo = "'.$semestre.'"
      order by alumno.alu_vcPaterno';
  $data1=DB::select($sql);
 return $data1;
 }

function veralumnomatriculadostotal($codcur,$semestre)
 {$sql ="SELECT
count(matricula.alu_iCodigo) as total
FROM
seccion
INNER JOIN matriculadetalle ON matriculadetalle.sec_iCodigo = seccion.sec_iCodigo
INNER JOIN matricula ON matriculadetalle.mat_iCodigo = matricula.mat_iCodigo
WHERE seccion.cur_iCodigo='$codcur' and seccion.sem_iCodigo='$semestre'";
    $data1 = DB::select($sql);
    //  return $data1;
    return $data1[0]->total;
} 
function extraeasistencia($codcurso,$semestre)
{$sql="SELECT
matricula.alu_iCodigo,
seccion_horarioasistencia.sechorasi_dFecha,
seccion.sem_iCodigo,
seccion_horario.sec_iCodigo,
seccion_horarioasistencia.sechor_iCodigo,
seccion_horarioasistencia.dia_vcCodigo,
seccion_horarioasistencia.sechorasi_iCodigo,
seccion_horarioasistencia.sechorasi_iSemana,

seccion_horario.sectip_cCodigo,
matriculadetalle.mat_iCodigo,

(
SELECT
     sechoralu_bPresente
FROM
seccion_horarioalumno
WHERE
        seccion_horarioalumno.sechorasi_iCodigo=seccion_horarioasistencia.sechorasi_iCodigo


     and seccion_horarioalumno.alu_iCodigo=matricula.alu_iCodigo
) AS estado
FROM
seccion_horario
INNER JOIN seccion_horarioasistencia ON (seccion_horario.sechor_iCodigo = seccion_horarioasistencia.sechor_iCodigo)
INNER JOIN seccion ON (seccion_horario.sec_iCodigo = seccion.sec_iCodigo)
INNER JOIN matriculadetalle ON matriculadetalle.sec_iCodigo = seccion.sec_iCodigo
INNER JOIN matricula ON matriculadetalle.mat_iCodigo = matricula.mat_iCodigo
WHERE
            seccion.cur_iCodigo = '$codcurso' AND
            seccion.sem_iCodigo = '$semestre' 
					
ORDER BY
            seccion_horarioasistencia.sechorasi_dFecha ASC";

            $data1=DB::select($sql);  
            return $data1;
}


/////------------------------- 
function buscarasistenciafecha($semestre,$codcurso,$fecha,$codalumno){
     $sql="SELECT
     sechoralu_bPresente
FROM
seccion_horario
INNER JOIN seccion_horarioasistencia ON (seccion_horario.sechor_iCodigo = seccion_horarioasistencia.sechor_iCodigo)
INNER JOIN seccion ON (seccion_horario.sec_iCodigo = seccion.sec_iCodigo)
INNER JOIN seccion_horarioalumno ON seccion_horarioalumno.sechorasi_iCodigo = seccion_horarioasistencia.sechorasi_iCodigo
WHERE
     seccion.cur_iCodigo = '$codcurso' AND
     seccion.sem_iCodigo = '$semestre' 
     and seccion_horarioasistencia.sechorasi_dFecha='$fecha'
     and seccion_horarioalumno.alu_iCodigo='$codalumno'
     ";
      $data1=DB::select($sql);  
      if(count($data1)<1)
      return "";
      else
      return $data1[0]->sechoralu_bPresente;
   }
   function fechacursoasistencia($codcurso,$semestre)
           {/*$semana=$cur->sechorasi_iSemana;
    $fecha1=$cur->sechorasi_dFecha;
    $xtipo=$cur->sectip_cCodigo;
    if($semana==1)
    {  $ndia1++;
        if($ndia1==1)
      { $worksheet->getCell('K13')->setValue($fecha1);
        $worksheet->getCell('K16')->setValue($xtipo);
       }*/
               
            $sql="SELECT
            seccion.sem_iCodigo,
            seccion_horario.sec_iCodigo,
            seccion_horarioasistencia.sechor_iCodigo,
            seccion_horarioasistencia.dia_vcCodigo,
            seccion_horarioasistencia.sechorasi_iCodigo,
            seccion_horarioasistencia.sechorasi_iSemana,
            seccion_horarioasistencia.sechorasi_dFecha,
            seccion_horario.sectip_cCodigo,
            (select count(*)
              from seccion_horarioalumno where seccion_horarioalumno.sechorasi_iCodigo= 
              seccion_horarioasistencia.sechorasi_iCodigo) as asis
FROM
seccion_horario
INNER JOIN seccion_horarioasistencia ON (seccion_horario.sechor_iCodigo = seccion_horarioasistencia.sechor_iCodigo)
INNER JOIN seccion ON (seccion_horario.sec_iCodigo = seccion.sec_iCodigo)
WHERE
            seccion.cur_iCodigo = '$codcurso' AND
            seccion.sem_iCodigo = '$semestre'
ORDER BY
            seccion_horarioasistencia.sechorasi_dFecha ASC";
                $data1=DB::select($sql); 
                return $data1;

           }

           function buscarcursoescuela($codcurso,$semestre)
   {$sql="SELECT
    seccion.sem_iCodigo,
    seccion.cur_iCodigo,
    curso.cur_vcNombre,
    seccion.tur_cCodigo,
    docente.doc_vcDocumento,
    docente.doc_vcPaterno,
    docente.doc_vcMaterno,
    docente.doc_vcNombre,
    curso.cur_vcCodigo,
    escuelaplan.escpla_iCodigo,
    curso.cur_iSemestre,
    (SELECT `escuela`.`esc_vcNombre` FROM `escuela` where `escuela`.`esc_vcCodigo`=left(curso.cur_vcCodigo,2)) AS escuela,
    turno.tur_vcNombre
    FROM
    seccion
    INNER JOIN curso ON (seccion.cur_iCodigo = curso.cur_iCodigo)
    INNER JOIN docente ON seccion.doc_iCodigo = docente.doc_iCodigo
    INNER JOIN escuelaplan ON curso.escpla_iCodigo = escuelaplan.escpla_iCodigo
    INNER JOIN turno ON seccion.tur_cCodigo = turno.tur_cCodigo
    WHERE
        seccion.cur_iCodigo = '$codcurso' AND
        seccion.sem_iCodigo = '$semestre'";
     $data1=DB::select($sql);    
     return $data1;

   }
   @endphp
<style>
    
.verticalText
{
text-align: center;
vertical-align: middle;
width: 20px;
margin: 0px;
padding: 0px;
padding-left: 3px;
padding-right: 3px;
padding-top: 10px;
white-space: nowrap;
-webkit-transform: rotate(-90deg);
-moz-transform: rotate(-90deg);
background-color: navy;
color: white;
}
.colorcolum,.fondocol
{background-color: navy;
color: white;}

.tableFixHead          { overflow: auto; height: 100px; 
background-color: navy;
color: white;}
.tableFixHead thead th { position: sticky; top: 0; z-index: 1;
    background-color: navy;
color: white;
}
.fix1 {
  position: sticky;
 left: 0px;
  background-color:white;
}
.fix2 {
  position: sticky;
 top: 0px;
  background-color:navy;
  color: white;
}



</style>
@php
$nn=0;
$listaasis=extraeasistencia($gcodcurso,$semestreactual);
//dd($listaasis);
foreach ($listaasis as $nasis) {

$miasis["$nasis->alu_iCodigo"]["$nasis->sechorasi_dFecha"]["fecha"] =$nasis->sechorasi_dFecha;
$miasis["$nasis->alu_iCodigo"]["$nasis->sechorasi_dFecha"]["estado"] =$nasis->estado;
$miasis["$nasis->alu_iCodigo"]["$nasis->sechorasi_dFecha"]["hora"] =$nasis->sechorasi_iCodigo;
//$miasis["$nasis->alu_iCodigo"]["$nasis->sechorasi_dFecha"][""] =$nasis->estado;
///
 $nn++; 
}


$xcurso="";
$xescuela="";
$xdocente="";
$xciclo="";
$xturno="";


$tt=0;


//veralumnomatriculados($gcodcurso,$semestreactual);
$tt=veralumnomatriculadostotal($gcodcurso,$semestreactual);

//echo "Procesados:".$tt."<br><br><br>";
//
@endphp
<div class="container">
    <div class="card-header">
      <table>
        <tr>
            <td class="fondocol"><i class="fa fa-book "></i></td>
            <td class="fondocol">
                CURSO</td>
            <td  width="400px">{{ $curso }}
            </td>
            <td rowspan="3">

              <button class="btn btn-primary w-100" type="button" 
                     onclick="vercursoreg()">VER LISTA DE CURSOS </button><br>
             

          </td>
        </tr>
        <tr>
            <td class="fondocol">
                <i class="fa fa-award "></i>
            </td>
            <td class="fondocol">
                ESCUELA</td>
            <td>{{ $escuela }}
            </td>
        </tr>
        <tr>
            <td class="fondocol">
                <i class="fa fa-cog "></i>
            </td>
            <td class="fondocol">ALUMNOS</td>
            <td> &nbsp;&nbsp;
                {{$tt}}
               
            </td>
        </tr>
    </table>
   
    </div >
    <div class="card-body tableFixHead " style='height: 500px; width:980px; overflow: scroll;background-color: navy;border: none;'>
       <div style="background-color: navy" class="container ;border: none" >
        <br>
        <br>
        <br>
            </div>
            <table class='table '  >
@php


$misemestre=left($semestreactual,4)."-".right($semestreactual,1);

$curso=fechacursoasistencia($gcodcurso,$semestreactual);

$misalumnos=vercursosalumnos($gcodcurso,$semestreactual);


//$tletra=count($letra);
//dd($curso);
foreach ($curso as $cur) {
    
    $semana=$cur->sechorasi_iSemana;
    $fecha1=$cur->sechorasi_dFecha;
    $xtipo=$cur->sectip_cCodigo;
    $nfecha[]=$cur->sechorasi_dFecha;
    $ndia[]=$cur->dia_vcCodigo;
    $nnhora[]=$cur->asis;
    $dhora[]=$cur->sechorasi_iCodigo;

}
$totalfe=0;
if(isset($nfecha))
{$totalfe=count($nfecha);
}


echo "
    <thead>
    <tr style='background-color:navy;color:white;'>
        <th >
           
        </th>
        <th >
            
        </th>
        ";

    for($xx=0;$xx<$totalfe;$xx++)
        { $xfe=$nfecha[$xx]; 
          echo "<th class='colorcolum' >
           
                <div class='verticalText' >
                ".$xfe."
               
                    <div>
            </th>";
        }
        //---boton
        echo "</tr><tr>
            <th></th><th></th>
            ";
        for($xx=0;$xx<$totalfe;$xx++)
        { $xdia=$ndia[$xx]; 
          $chora=$nnhora[$xx];
          $ddhora=$dhora[$xx];
          if($chora*1<1)
          {echo "<th >  <button type='button' name='b$xx' id='b$xx' class='btn btn-primary btn-sm' onclick='ncrearsemana(\"".$ddhora."\",\"$xx\");ocultarboton(this)'>
                   +</button>                     
             </th>";}else {
               echo "<th > </th>";
             }
        }
        
        //finboton
        echo "</tr><tr>
            <th></th><th></th>
            ";
        for($xx=0;$xx<$totalfe;$xx++)
        { $xdia=$ndia[$xx]; 
          echo "<th >                       
                ".$xdia."
             
            </th>";
        }
        echo "</tr><tr>
            <th> nro</th>
            <th>ESTUDIANTE</th>
            ";
     for($xx=0;$xx<$totalfe;$xx++)
        { $xfe=$nfecha[$xx]; 
          echo "<th >                       
                ".($xx+1)."
             
            </th>";
        }
        echo "<tr>";
        echo "</thead>
        <tbody>
        ";
        echo "";
$nn=0;

$pintar='';
    foreach ($misalumnos as $alumno) {
      //$nro++;
      $nn++;
     // if($nn<3)
     if(($nn % 2)==0)
     $pintar="style='background-color:white;'";
     else {
        $pintar="style='background-color:#cacaca;'";
     }
     
      $cod=$alumno->alu_vcCodigo;
      $xcodalu=$alumno->alu_iCodigo;
      $estudiante=$alumno->alumno;
      $email=$alumno->alu_vcEmail;

 echo "<tr ".$pintar."> <td >";
        echo  $nn."</td><td class='fix1' ".$pintar.">";
       // echo $cod."</td><td>";
        echo $estudiante."</td><td>";
        for($xx=0;$xx<$totalfe;$xx++)
        { $xfe=$nfecha[$xx]; 
          $horaver=$nnhora[$xx];
          if($horaver<1)
          $botonh="d".$dhora[$xx];
          else {
            $botonh="";
          }
          $xestado=$miasis["$alumno->alu_iCodigo"]["$xfe"]["estado"];
          $xhora=$miasis["$alumno->alu_iCodigo"]["$xfe"]["hora"];
          $asisesta=left($xestado,1);
            $testadop = '';
            $testadof = '';
            $testadoj = '';
            if (strtoupper(left($asisesta, 1)) == 'P') {
                $testadop = "selected";
            }
            if (strtoupper(left($asisesta, 1)) == 'J') {
                $testadoj = "selected";
            }
            if (strtoupper(left($asisesta, 1)) == 'F') 
             {
                $testadof = "selected";
            } //echo $asisesta;
            //|| strtoupper(left($asisesta, 1)) == '')
       // echo $testadof;
          echo "<select id='".$alumno->alu_iCodigo.$xx."' name='".$alumno->alu_iCodigo.$xx."' width='20px'
            onchange='editarasis(this.value,\"".$xhora."\",\"".$alumno->alu_iCodigo."\")' 
            class='$botonh' >
            <option value='P' $testadop>P</option>
            <option value='F' $testadof>F</option>
            <option value='J' $testadoj>J</option></select>
            ";
          echo "</td><td>";}//fin del for
           echo "<script>
              $('#".$alumno->alu_iCodigo.($xx-1)."').css('display','none');
              </script>";
        echo "</tr>";
        /* if(isset($miasis["$xcodalu"]["$buscfecha"]))
        { $xestado= $miasis["$xcodalu"]["$buscfecha"] ;
         } */
   
       ///   if(strlen($xestado)>0)
        // $xestado=left($xestado,1);

       
         }


        // dd($listaasis);
      
    
    @endphp
       </table>
       </div>
    <div id="mimensajex">GRABANDO</div>
      <!---  inicio de modal //-->
      <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header" style="background-color: navy;color:white;">
                  <h5 class="modal-title" id="exampleModalLabel"> Confirmar- CREAR SEMANA DE ASISTENCIA</h5>
                  <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close"
                      onclick="$('#confirmModal').modal('hide');">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <input type="hidden" name="lhora" id="lhora"><br>
                  <table>
                    <tr><td align="right">NRO SEMANA</td>
                      <td> <input type="text" id="nrosemana" name="nrosemana"  disabled style="background-color:#cacaca"></td>
                      <tr><td align="right">TEMA</td>
                      <td><input type="text" id="nrotema" name="nrotema"></td>
                </table>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal"
                      onclick="$('#confirmModal').modal('hide');">Cancelar</button>
                  <button type="button" class="btn btn-primary" name="btncrear" id="btncrear"
                      onclick="confirsemana()">CREAR</button>
              </div>
          </div>
      </div>
  </div>
  <!-- Modal cursos -->
</div>

    <script>
       function ncrearsemana(n,sem) {
        // alert(sem);
       //     $((".d"+n.toString())).css("display", "none");
       $("#confirmModal").modal('show');
       $("#lhora").val(n);
       $("#nrosemana").val(sem);
       $("#nrotema").val("");
        
          }
          function confirsemana()
          { n1=$("#lhora").val();
            //$("#nrosemana").val(sem);
           n2= $("#nrotema").val();

            $((".d"+n1.toString())).css('background-color', 'yellow');       
            $(("#d"+n1.toString())).val("P");
          
//crearsemanaasis(\''.$codcur.'\',\''.$x.'\',\''.$diax.'\',\''.$codcur.$diax.$x.'\',\''.asset('asistencia').'\')
//function crearsemanaasis(codcur,semana,dia,boton1,urlx)
//crearsemanaasis('{{$gcodcurso}}',
//crearsemanaasisfinal(codcur,semana,horax)
crearsemanaasisfinal('{{$gcodcurso}}','{{$semestreactual}}',n1,n2)
$("#confirmModal").modal('hide');
          }
        function vercursoreg() {
            $("#micontenido").html(
                "<img src='img/cargar.gif'>"
            );
            $("#micontenido").load('docente/completarasistencia');
    
        }
        function ocultarboton(ele){
          var xele=ele;
          xele.style.display='none';
                }
        /*  function mostrartarboton(ele){
          var xele=ele;
          xele.style.display='none';
                }*/
        function editarasis(elemento,idhora,idalumno)
  	{
 // 		alert(elemento);
  //    alert(idhora);
   //   alert(idalumno);
   
  //	var hora=document.getElementById(idhora).value;
    var hora=idhora;
  		// var alumno=document.getElementById(idalumno).value;
  		var alumno=idalumno;
   		//var estado=elemento.value;
       var estado=elemento;
   		//editar 
   		if(estado.substring(0, 1).toUpperCase().trim()=="P" || estado.substring(0, 1).toUpperCase().trim()=="F" || estado.substring(0, 1).toUpperCase().trim()=="J" )
     	{
     		//alert(hora.concat(":",alumno,":",estado.substring(0, 1)));
       		updateasistenciadia(hora,alumno,estado);
      	}
      	//else{}  
        
   }
        </script>     
    <link rel="stylesheet" href="{{ asset('bootstrap5/css/bootstrap.min.css') }}">
<script src="{{ asset('bootstrap5/js/bootstrap.js') }}"></script>

<script src="{{ asset('js/panelasistencia.js')}}"></script>