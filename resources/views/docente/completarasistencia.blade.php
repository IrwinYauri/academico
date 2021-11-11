@php
 session_start();
 $coddocentex="";
 if(isset($_SESSION['coddocentex'])){
  $coddocentex=$_SESSION['coddocentex'];
 }
  use App\Http\Controllers\DocenteController; 
  use App\Http\Controllers\AsistenciaController ;
    $mihoras=new DocenteController();
    $asistencias=new AsistenciaController();
    //$listahora= $mihoras->vercargahoraria(51,20212)
    $listahora= $mihoras->vercargahoraria($coddocentex,20212);
    //asistenciaalumno($codalumno,$codcursosec,$s1,$s16)
   
    function verasis1($codalumno,$codseccion,$s1,$s2,$dia,$codcur,$xhora)
 { $asistencias=new AsistenciaController();  
    $asistencia=$asistencias->asistenciaalumno($codalumno,$codseccion,$s1,$s2,$dia);
   
    $sm1=0;$sm2=0;$sm3=0;$sm4=0;$sm5=0;
           $sm6=0;$sm7=0;$sm8=0;$sm9=0;$sm10=0;
           $sm11=0;$sm12=0;$sm13=0;$sm14=0;$sm15=0;
           $sm16=0;
           $mixhora = array();
     foreach ($asistencia as $verasis){
       $semana=$verasis->sechorasi_iSemana;
       $rcodestado=$dia.$semana."estado".$codseccion;
       $rcodhora=$dia.$semana."codhora".$codseccion;
       $rcodalu=$dia.$semana."codalu".$codseccion;
       $xcodalu=$codalumno;
       $ocultar="";
       $ocultarbot="";

       echo  "<td>";
        /*echo  ":".$dia;
           echo  ":".$verasis->estado;
           echo  ":".$verasis->sechorasi_dFecha;
           echo ":".$verasis->alu_iCodigo;
           echo ":".$verasis->sechorasi_iCodigo;
           echo ":".$verasis->sechoralu_iCodigo;
           echo ":".$codalumno; */
  //hora de la semana
  //--dd($xhora);
  //--         $mixhora[($semana-1)]= $xhora[0];    //cambiar por array
 //hora defin           
if($semana==1 && $verasis->sechorasi_iCodigo*1<1)
  $sm1++;
  if($semana==2 && $verasis->sechorasi_iCodigo*1<1)
  $sm2++;
  if($semana==3 && $verasis->sechorasi_iCodigo*1<1)
  $sm3++;
  if($semana==4 && $verasis->sechorasi_iCodigo*1<1)
  $sm4++;
  if($semana==5 && $verasis->sechorasi_iCodigo*1<1)
  $sm5++;
  if($semana==6 && $verasis->sechorasi_iCodigo*1<1)
  $sm6++;
  if($semana==7 && $verasis->sechorasi_iCodigo*1<1)
  $sm7++;
  if($semana==8 && $verasis->sechorasi_iCodigo*1<1)
  $sm8++;
  if($semana==9 && $verasis->sechorasi_iCodigo*1<1)
  $sm9++;
  if($semana==10 && $verasis->sechorasi_iCodigo*1<1)
  $sm10++;
  if($semana==11 && $verasis->sechorasi_iCodigo*1<1)
  $sm11++;
  if($semana==12 && $verasis->sechorasi_iCodigo*1<1)
  $sm12++;
  if($semana==13 && $verasis->sechorasi_iCodigo*1<1)
  $sm13++;
  if($semana==14 && $verasis->sechorasi_iCodigo*1<1)
  $sm14++;
  if($semana==15 && $verasis->sechorasi_iCodigo*1<1)
  $sm15++;
  if($semana==16 && $verasis->sechorasi_iCodigo*1<1)
  $sm16++;

           if($verasis->sechorasi_iCodigo*1>0)
           {$ocultar="style='display:block'"; }
           else {
            $ocultar="style='display:none'";
           }

           if($verasis->sechorasi_iCodigo*1>0)
           $ocultarbot="style='display:none'";
           else {
            $ocultarbot="style='display:block'";
           }
      // dd($xhora);
   //   echo "--".$xhora[($semana-1)];
     //   echo "--".$mixhora[($semana-1)];
       // echo "-:-".$xhora[$semana]."**";
       $testadop="";
       $testadof="";
       $testadoj="";

       if(strtoupper(left($verasis->estado,1))=="P")
       $testadop="selected";
       if(strtoupper(left($verasis->estado,1))=="J")
       $testadoj="selected";
       if(strtoupper(left($verasis->estado,1))=="F" || strtoupper(left($verasis->estado,1))=="")
       $testadof="selected";

          echo"   <select name='".$rcodestado."' id='".$rcodestado."' value='".left($verasis->estado,1)."' onchange='editarasis(this,\"".$rcodhora."\",\"".$xcodalu."\",\"".$rcodestado."\")'  ".$ocultar.">
            <option value='P' $testadop>P</option>
            <option value='F' $testadof>F</option>
            <option value='J' $testadoj>J</option></select>
             <input type='hidden' name='".$rcodhora."' id='".$rcodhora."'  value='".$verasis->sechorasi_iCodigo."'>
             <input type='hidden' name='".$rcodalu."' id='".$rcodalu."'  value='".$verasis->alu_iCodigo."'>
                   ";

            echo " <button type='button'  class='btn btn-secondary table-condensed' href='#'
            onclick='crearasistenciadiaalumno(\"".$xhora[$semana]."\",\"".$codalumno."\"
            ,\"".$rcodhora.$semana.$codalumno."\",\"".$rcodestado."\")' 
            name='".$rcodhora.$semana.$codalumno."' id='".$rcodhora.$semana.$codalumno."' $ocultarbot>creardia
            </button> "; 
           echo  "</td>";
     }

    // dd($asistencia);
     if($sm1<1)
     { $mmcod=$codcur.$dia."1";
       mostrarbotonx($mmcod);
      }
      if($sm2<1)
     {$mmcod=$codcur.$dia."2";
       mostrarbotonx($mmcod);
      }
      if($sm3<1)
     { $mmcod=$codcur.$dia."3";
       mostrarbotonx($mmcod);
      }
      if($sm4<1)
     { $mmcod=$codcur.$dia."4";
       mostrarbotonx($mmcod);
      }
      if($sm5<1)
     { $mmcod=$codcur.$dia."5";
       mostrarbotonx($mmcod);
      }
      if($sm6<1)
     {$mmcod=$codcur.$dia."6";
       mostrarbotonx($mmcod);
      }
      if($sm7<1)
     { $mmcod=$codcur.$dia."7";
       mostrarbotonx($mmcod);
      }
      if($sm8<1)
     {$mmcod=$codcur.$dia."8";
       mostrarbotonx($mmcod);
      }
      if($sm9<1)
     { $mmcod=$codcur.$dia."9";
       mostrarbotonx($mmcod);
      }
      if($sm10<1)
     { $mmcod=$codcur.$dia."10";
       mostrarbotonx($mmcod);
      }
      if($sm11<1)
     { $mmcod=$codcur.$dia."11";
       mostrarbotonx($mmcod);
      }
      if($sm12<1)
     { $mmcod=$codcur.$dia."12";
       mostrarbotonx($mmcod);
      }
      if($sm13<1)
     { $mmcod=$codcur.$dia."13";
       mostrarbotonx($mmcod);
      }
      if($sm14<1)
     { $mmcod=$codcur.$dia."14";
       mostrarbotonx($mmcod);
      }
      if($sm15<1)
     { $mmcod=$codcur.$dia."15";
       mostrarbotonx($mmcod);
      }
      if($sm16<1)
     { $mmcod=$codcur.$dia."16";
       mostrarbotonx($mmcod);
      }
  ///---revisar
    // dd($asistencia);
  }
@endphp
<style>
.tableFixHead          { overflow: auto; height: 100px; }
.tableFixHead thead th { position: sticky; top: 0; z-index: 1; }

/* Just common table stuff. Really. */
table  { border-collapse: collapse; width: 100%; }
th, td { padding: 8px 16px; }
th     { background:navy; }

.table-responsive { 
  height:200px;
  overflow:scroll;
}
#prueba {
   position: absolute;
    background-color: #b5c8ca;
      margin-left:-100px;

}
.verticalconte {
       
           /*     transform: rotate(90deg);*/
           }
        .fix1 {
  position: sticky;
 left: 0px;
  background-color:white;
}

</style>
@php
function mostrarbotonx($codboton)
{     echo "<td>";
    //   $mmcod=$codcur.$dia."2";
    $mmcod=$codboton;
       echo "<script>"; 
       echo " mostrarboton1('".$mmcod."')";
       echo "</script>";
      echo "</td>";
}
   function veralumnomatriculados($codcur,$semestre,$fila,$diax)
 {$miasistencia=new DocenteController(); 
  $asistencias=new AsistenciaController();
 // class='table-wrapper-scroll-y my-custom-scrollbar'
 //<div class='card-body' style='overflow: scroll;'> style='height: 600px;overflow: scroll;''
   echo "<div class='card-body tableFixHead table-responsive table-condensed' style='height: 600px; width:940px; overflow: scroll;'  >
   <table class='table table-responsive table-condensed ' style='height: 500px; width:940px; overflow: scroll;' >
  <thead style='background-color:black;color:white;'>     <tr style='background-color:black;color:white;'>
    <th >Nro</th> 
    <th >Codigo</th> 
    <th >Nombre</th>";
    $mixhoras =array();
    for($x=1;$x<=16;$x++)
        { /// prepara boton de semana
          $xhora="";
          $xdia="";
          $fechax1="";
          $rtphora=$asistencias->verasistenciacurso($codcur,semestreactual(),$diax,$x);
        
          foreach ($rtphora as $horaasistencia) {
          $xhora=$horaasistencia->sechorasi_iCodigo;
          $xdia=$horaasistencia->dia_vcCodigo;
          $fechax1=$horaasistencia->sechorasi_dFecha;
         }
         $mixhoras[$x]=$xhora;
          ///fin semana-- crearsemana(codcur,semana,dia)
       //  dd($rtphora);
          echo '<th >
            
            S'.$x.'
          <button type="button"  class="btn btn-secondary table-condensed" href="#"
            onclick="crearsemanaasis(\''.$codcur.'\',\''.$x.'\',\''.$diax.'\',\''.$codcur.$diax.$x.'\',\''.asset('asistencia').'\')" 
            name="'.$codcur.$diax.$x.'" id="'.$codcur.$diax.$x.'" >+ sem
         </button>  
         <input type="hidden" name="" value="'.$x.'">
         <input type="hidden" name="" value="'.$codcur.'">
         <input type="hidden" name="" value="'.$diax.'">
         <input type="hidden" name="" value="'.$xhora.'">';
       echo  $fechax1;
      
       //  $mixhoras=$xhora;
        // echo $mixhoras[$x];
        echo ' &nbsp;  &nbsp; 
       
        </th>';
            }
  echo "</tr>
      </thead>";
   $misalumnos=$miasistencia->vercursosalumnos(trim($codcur),$semestre);
//dd($misalumnos);
$nro=0;
    foreach ($misalumnos as $alumno) {
      $nro++;
      $cod=$alumno->alu_vcCodigo;
      $estudiante=$alumno->alumno;
      $email=$alumno->alu_vcEmail;
     echo "<tr style='color:black'>";
    
          echo "<td class='fix1'>$nro</td>
          <td class='fix1'>$cod</td>
         <td class='fix1'>$estudiante</td>
         
          ";
       // dd($mixhoras);
          verasis1($alumno->alu_iCodigo,$alumno->sec_iCodigo,1,16,$diax,$codcur,$mixhoras);
          //verasis1($alumno->alu_iCodigo,$alumno->sec_iCodigo,1,16,"LUN");
      /*  for($x=1;$x<=16;$x++)
        { echo '<td>
        			<input type="text" name="" id="" size="2">
             	</td>';
            }
          echo "</tr>";*/
          echo "</tr>";
    }
echo "</table>
</div>";
echo "
<script>
  document.getElementById('nlista$fila').innerHTML = '$nro';
</script>";

} 
@endphp
<head>
  <title>Asistencias</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    .table-condensed{
  font-size: 10px;
}
  </style>

<style>
  #snackbar {
    visibility: hidden;
    min-width: 250px;
    margin-left: -125px;
    background-color: #333;
    color: #fff;
    text-align: center;
    border-radius: 2px;
    padding: 16px;
    position: fixed;
    z-index: 1;
    left: 50%;
    bottom: 30px;
    font-size: 17px;
  }
  
  #snackbar.show {
    visibility: visible;
    -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
    animation: fadein 0.5s, fadeout 0.5s 2.5s;
  }
  
  @-webkit-keyframes fadein {
    from {bottom: 0; opacity: 0;} 
    to {bottom: 30px; opacity: 1;}
  }
  
  @keyframes fadein {
    from {bottom: 0; opacity: 0;}
    to {bottom: 30px; opacity: 1;}
  }
  
  @-webkit-keyframes fadeout {
    from {bottom: 30px; opacity: 1;} 
    to {bottom: 0; opacity: 0;}
  }
  
  @keyframes fadeout {
    from {bottom: 30px; opacity: 1;}
    to {bottom: 0; opacity: 0;}
  }
  </style>

</head>
<div id="snackbar">Grabando asistencias</div>
<script>
  function alertagrabar(t) {
    var x = document.getElementById("snackbar");
    x.value=t;
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 2000);
  }///mstar
  </script>
<script>
  function mostrarobjeto(id)
  {if(document.getElementById(id).style.display == "block")
    {document.getElementById(id).style.display = "none";
     document.getElementById(id).colSpan = "8";
     }
  else
     { 
       document.getElementById(id).style.display = "block";
       document.getElementById(id).colSpan = "8";
       
      }
   }

   	function editarasis(elemento,idhora,idalumno,idestado)
  	{
  		//alert(idhora);
    	var hora=document.getElementById(idhora).value;
  		// var alumno=document.getElementById(idalumno).value;
  		var alumno=idalumno;
   		var estado=elemento.value;
   		//editar 
   		if(estado.substring(0, 1).toUpperCase().trim()=="P" || estado.substring(0, 1).toUpperCase().trim()=="F" || estado.substring(0, 1).toUpperCase().trim()=="J" )
     	{
     		//alert(hora.concat(":",alumno,":",estado.substring(0, 1)));
       		updateasistenciadia(hora,alumno,estado);
      	}
      	//else{}
   }

   function mostrarboton1(id)
   {//alert(id);   
    document.getElementById(id).style.display = "none";
    
   }

   
</script>


<div class="card shadow mb-4">
  <div class="card-header py-3" style="background-color:navy)">
    <h6 class="m-0 font-weight-bold text-dark-400">
       <i class="fa fa-calendar fa-2x" ></i> COMPLETAR ASISTENCIA
      </h6>
   </div>

  
    <div class="card-body " style="overflow: scroll;">
    <table  >
     <thead>
     <tr style='background-color:royalblue;color:white;'>
      <th>Nro::CURSO</th>
      
         <th>Escuela</th>
         <th>ALUMNOS</th>
         
        @php
            $n=0;
        @endphp
</tr>
</thead>
@php
 // dd($listahora);  
@endphp

        @foreach($listahora as $horario)
       @php
            $n++;
           
       @endphp
        <tr style="color:#505050">
          <td>
            <button type="button"  class="btn btn-primary" 
            onclick="mostrarobjeto('tn{{$n}}')">ver 
         </button> 
         {{ $n }} {{ $horario->sec_iNumero }}::{{ $horario->dia_vcCodigo }}::{{ left($horario->tipodictado,1) }}
         ::{{ $codcur=$horario->cur_vcCodigo }}
         ::{{ $horario->cur_vcNombre }}
        </td>
                   
            <td>{{ $horario->esc_vcCodigo }}</td>
            <td id="nlista{{$n}}">0
            </td>
           
            
        </tr>
       <tr >

          <td style="display: none" id="tn{{$n}}">
            @php
            // veralumnomatriculados($codcur,$semestre,$fila);
              veralumnomatriculados($horario->cur_iCodigo,semestreactual(),$n,$horario->dia_vcCodigo);          
            //  veralumnomatriculados($horario->cur_iCodigo,semestreactual(),$n,"LUN");          
            @endphp
            </td>
                    
        </tr>          
     
       
        @endforeach
      </table>
    </div>
  </div>
@php
$asistencia=$asistencias->asistenciaalumno(447,439,1,16,"LUN");

//verasis(447,439,1,16,"LUN");

//$miasistencia=new DocenteController(); 
//$misalumnos=$miasistencia->vercursosalumnos(2,20212);
//dd($asistencia);
//dd($misalumnos);
@endphp


<script src="{{ asset('vendor/jquery/jquery.min.js')}}"></script>
<script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>
<script src="{{ asset('js/panelasistencia.js')}}"></script>

