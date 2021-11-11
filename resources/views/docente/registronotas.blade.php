@php
session_start();
 $coddocentex="";
 if(isset($_SESSION['coddocentex'])){
  $coddocentex=$_SESSION['coddocentex'];
 }

 

 use App\Http\Controllers\DocenteController; 
 $notas=new DocenteController();  
  $vernotas=$notas->verregistronotas($coddocentex,semestreactual(),2);

  $miasistencia=new DocenteController();  
// $miscursos=$miasistencia->vercursos(20212,$coddocentex);
$miscursos=$miasistencia->vercursos(semestreactual(),$coddocentex);
$miscursosgrupo=$miasistencia->vercursosagrupado(semestreactual(),$coddocentex);
//dd($miscursosgrupo);

 @endphp
 <style>
    .table-condensed{
  font-size: 10px;
  color: black;
  }
  /*
  .fondocol{
    background-color: navy;
    color: white;
  }
  .columpro
  {font-weight: bold;
    font-size: 11px;
  }
  .columprof
  {font-weight: bold;
    font-size: 12px;
  }
  .ocultarnota
  {display: none;

  }*/
  
  </style>
  @php
    use App\Http\Controllers\SilabusemestreController;   

  @endphp
       @include('docente.formulasnotas')
  @php
     // vercursonotas($coddocentex,semestreactual(),2)

function vercursonotas($coddocentex,$sem,$codcurso,$nro,$curso,$escuela)
{ $notas=new DocenteController();  
   $vernotas=$notas->verregistronotas($coddocentex,$sem,$codcurso,$curso);
   $ttunidad=totalnrounidad($sem,$codcurso);
   echo' <div class="card-body " style="overflow: scroll;">
        <div class="card-header py-3" style="background-color:navy)">
            <h6 class="m-0 font-weight-bold text-dark-400">
              <table>
                <tr>
                  <td class="fondocol"><i class="fa fa-book " ></i></td>
                  <td class="fondocol">
              CURSO</td><td>'.$curso.' 
              </td>
              </tr> 
              <tr><td class="fondocol">
                <i class="fa fa-award " ></i>
                </td>
                <td class="fondocol">
              ESCUELA</td><td>'.$notas->nescuela($escuela).'
              </td>
            </tr>
            <tr>
              <td class="fondocol">
                <i class="fa fa-cog " ></i></td>
              <td class="fondocol">TOTAL DE UNIDADES</td><td> &nbsp;&nbsp;';
                if($ttunidad<1)
                echo "<div style='background-color:red'>NO CRITERIOS DE EVALUACION</div>";
                else {
                 echo $ttunidad;
                }
                echo '</td>
              </tr>
              </table>
              </h6>
           </div>
        <table  class="table table-striped table-hover table-responsive-md text-dark-400 table-condensed">
           <thead>
            ';
            echo "<tr style='background-color:black;color:white'>
              <td></td>
              <td></td>
              <td></td>";
              $estadover="";
              $oculprom=array("","","","","");
              $oculpromx=array("","","","","");
              for($x = 1; $x < 6; $x++)
                { if( $ttunidad<$x)
                  $estadover="style='display:none;'";
                  ///versilabusnroeval($nota->sem_iCodigo,$nota->cur_iCodigo,$x)
                    echo "<td colspan='4' $estadover>Nro Ev: ".versilabusnroeval($sem,$codcurso,$x)."</td>";
                    if(versilabusnroeval($sem,$codcurso,$x)<1)
                    {$oculprom[$x-1]="style='display:none;'";
                     $oculpromx[$x-1]="class='ocultarnota'";
                    }
                    echo " <td  $estadover ></td>";
                    
              } 
              echo " <td>".formulapf($sem,$codcurso,1).formulapf($sem,$codcurso,2)." </td>";
                echo "</tr>";
            echo '<tr style="background-color:black;color:white">
                <td>NRO</td>
                <td>Codigo</td>
                <td>Alumno</td>';
              $estadover="";
                for($x = 1; $x < 6; $x++)
                { if( $ttunidad<$x)
                  $estadover="style='display:none;'";
                    for($n = 1; $n < 5; $n++)
                   { echo "<td  $estadover> CE$n</td>";
                    } 
                    echo " <td  $estadover> PU$x</td>";
              } 
                 echo " <td> PF</td>";
        echo "    </tr>
        </thead>";
    
         $promediox1=0;$promediox2=0;$promediox3=0;$promediox4=0;$promediox5=0;
                $n=0;
           // dd($vernotas);
        foreach ($vernotas as $nota)
           { $n++;
               echo "<tr>
                <td>$n</td>
                <td>$nota->alu_vcCodigo</td>
                <td>".$nota->alu_vcPaterno." ".$nota->alu_vcMaterno." ".$nota->alu_vcNombre."</td>
                <td ".cambiarcolornotas($nota->CE11)." $oculpromx[0]>" .$nota->CE11." </td>
                <td ".cambiarcolornotas($nota->CE12)." $oculpromx[0]>".$nota->CE12."  </td>
                <td ".cambiarcolornotas($nota->CE13)." $oculpromx[0]>".$nota->CE13."  </td>
                <td ".cambiarcolornotas($nota->CE14)." $oculpromx[0]>".$nota->CE14." </td>
                <td class='columpro'  $oculprom[0]>";
                  $prome=0;
                  if(versilabuscriterio($nota->sem_iCodigo,$nota->cur_iCodigo,1)=="PA")
                  {$prome=(sinnota($nota->CE11)+sinnota($nota->CE12)+sinnota($nota->CE13)+sinnota($nota->CE14))/versilabusnroeval($nota->sem_iCodigo,$nota->cur_iCodigo,1);
                  }
                  else {$xpp1=0;$xpp2=0;$xpp3=0;$xpp4=0;
                    $pesox = versilabusformula($nota->sem_iCodigo,$nota->cur_iCodigo,1);
                    $npeso = explode('-', $pesox);
               //     echo "xx".$npeso[0]."xx";
                    if(isset($npeso[0]))
                    $xpp1=$npeso[0];
                    if(isset($npeso[1]))
                    $xpp2=$npeso[1];
                    if(isset($npeso[2]))
                    $xpp3=$npeso[2];
                    if(isset($npeso[3]))
                    $xpp4=$npeso[3];
                    $prome=sinnota($nota->CE11)*sinnota($xpp1)+
                           sinnota($nota->CE12)*sinnota($xpp2)+
                           sinnota($nota->CE13)*sinnota($xpp3)+
                           sinnota($nota->CE14)*sinnota($xpp4);
                  }
                  $promediox1=$prome;
                 echo cambiarcolorpromedio($prome);
                // echo "--".versilabusnroeval($nota->sem_iCodigo,$nota->cur_iCodigo,1);
                 /*.versilabuscriterio($nota->sem_iCodigo,$nota->cur_iCodigo,1)
                     ."--".versilabusformula($nota->sem_iCodigo,$nota->cur_iCodigo,1)."--"
                  .versilabusnroeval($nota->sem_iCodigo,$nota->cur_iCodigo,1)
                  .*/
                  echo "</td>
                <td ".cambiarcolornotas($nota->CE21)." $oculpromx[1]>".$nota->CE21." </td>
                <td ".cambiarcolornotas($nota->CE22)." $oculpromx[1]>".$nota->CE22." </td>
                <td ".cambiarcolornotas($nota->CE23)." $oculpromx[1]>".$nota->CE23." </td>
                <td ".cambiarcolornotas($nota->CE24)." $oculpromx[1]>".$nota->CE24." </td>
                <td class='columpro' $oculprom[1]>";
                  $prome=0;
                  if(versilabuscriterio($nota->sem_iCodigo,$nota->cur_iCodigo,2)=="PA")
                  {$prome=(sinnota($nota->CE21)+sinnota($nota->CE22)+sinnota($nota->CE23)+sinnota($nota->CE24))/versilabusnroeval($nota->sem_iCodigo,$nota->cur_iCodigo,2);
                  }
                  else {$xpp1=0.0;$xpp2=0.0;$xpp3=0.0;$xpp4=0.0;
                    $pesox = versilabusformula($nota->sem_iCodigo,$nota->cur_iCodigo,2);
                    $npeso = explode('-', $pesox);
                  //  echo "xx".$npeso[0]."xx";
                    if(isset($npeso[0]))
                    $xpp1=$npeso[0];
                    if(isset($npeso[1]))
                    $xpp2=$npeso[1];
                    if(isset($npeso[2]))
                    $xpp3=$npeso[2];
                    if(isset($npeso[3]))
                    $xpp4=$npeso[3];
                    $prome=sinnota($nota->CE21)*sinnota($xpp1)+
                           sinnota($nota->CE22)*sinnota($xpp2)+
                           sinnota($nota->CE23)*sinnota($xpp3)+
                           sinnota($nota->CE24)*sinnota($xpp4);
                   
                      //     sinnota($nota->CE23)*$xpp3+
                    //       sinnota($nota->CE24)*$xpp4;
                    //+ $nota->CE22*$xpp2 + $nota->CE23*$xpp3 + $nota->CE24*$xpp4);
                  }
                  $promediox2=$prome;
                  echo cambiarcolorpromedio($prome);
                  /*.versilabuscriterio($nota->sem_iCodigo,$nota->cur_iCodigo,2)
                  .versilabusformula($nota->sem_iCodigo,$nota->cur_iCodigo,2)."--"
                  .versilabusnroeval($nota->sem_iCodigo,$nota->cur_iCodigo,2)
                  .*/
                 echo "</td>
                <td ".cambiarcolornotas($nota->CE31)." $oculpromx[2]>".$nota->CE31."</td>
                <td ".cambiarcolornotas($nota->CE32)." $oculpromx[2]>".$nota->CE32."</td>
                <td ".cambiarcolornotas($nota->CE33)." $oculpromx[2]>".$nota->CE33."</td>
                <td ".cambiarcolornotas($nota->CE34)." $oculpromx[2]>".$nota->CE34."</td>
                <td class='columpro' $oculprom[2]>";
                  $prome=0;
                  if(versilabuscriterio($nota->sem_iCodigo,$nota->cur_iCodigo,3)=="PA")
                  {$prome=(sinnota($nota->CE31)+sinnota($nota->CE32)+sinnota($nota->CE33)+sinnota($nota->CE34))/versilabusnroeval($nota->sem_iCodigo,$nota->cur_iCodigo,3);
                  }
                  else {$xpp1=0.0;$xpp2=0.0;$xpp3=0.0;$xpp4=0.0;
                    $pesox = versilabusformula($nota->sem_iCodigo,$nota->cur_iCodigo,3);
                    $npeso = explode('-', $pesox);
                //    echo "xx".$npeso[0]."xx";
                    if(isset($npeso[0]))
                    $xpp1=$npeso[0];
                    if(isset($npeso[1]))
                    $xpp2=$npeso[1];
                    if(isset($npeso[2]))
                    $xpp3=$npeso[2];
                    if(isset($npeso[3]))
                    $xpp4=$npeso[3];
                    $prome=sinnota($nota->CE31)*sinnota($xpp1)+
                           sinnota($nota->CE32)*sinnota($xpp2)+
                           sinnota($nota->CE33)*sinnota($xpp3)+
                           sinnota($nota->CE34)*sinnota($xpp4);
                     }
                     $promediox3=$prome;
                  echo cambiarcolorpromedio($prome);
                /*  .versilabuscriterio($nota->sem_iCodigo,$nota->cur_iCodigo,3)
                  .versilabusformula($nota->sem_iCodigo,$nota->cur_iCodigo,3)."--"
                  .versilabusnroeval($nota->sem_iCodigo,$nota->cur_iCodigo,3)
                  .*/
                echo  "</td>
                <td ".cambiarcolornotas($nota->CE41)." $oculpromx[3]>".$nota->CE41." </td>
                <td ".cambiarcolornotas($nota->CE42)." $oculpromx[3]>".$nota->CE42."  </td>
                <td ".cambiarcolornotas($nota->CE43)." $oculpromx[3]>".$nota->CE43."  </td>
                <td ".cambiarcolornotas($nota->CE44)." $oculpromx[3]>".$nota->CE44."  </td>
                <td class='columpro' $oculprom[3]>";
                  $prome=0;
                  if(versilabuscriterio($nota->sem_iCodigo,$nota->cur_iCodigo,4)=="PA")
                  {$prome=(sinnota($nota->CE41)+sinnota($nota->CE42)+sinnota($nota->CE43)+sinnota($nota->CE44))/versilabusnroeval($nota->sem_iCodigo,$nota->cur_iCodigo,4);
                  }
                  else {$xpp1=0.0;$xpp2=0.0;$xpp3=0.0;$xpp4=0.0;
                    $pesox = versilabusformula($nota->sem_iCodigo,$nota->cur_iCodigo,4);
                    $npeso = explode('-', $pesox);
                //    echo "xx".$npeso[0]."xx";
                    if(isset($npeso[0]))
                    $xpp1=$npeso[0];
                    if(isset($npeso[1]))
                    $xpp2=$npeso[1];
                    if(isset($npeso[2]))
                    $xpp3=$npeso[2];
                    if(isset($npeso[3]))
                    $xpp4=$npeso[3];
                    $prome=sinnota($nota->CE41)*sinnota($xpp1)+
                           sinnota($nota->CE42)*sinnota($xpp2)+
                           sinnota($nota->CE43)*sinnota($xpp3)+
                           sinnota($nota->CE44)*sinnota($xpp4);
                    }
                    $promediox4=$prome;
                  echo cambiarcolorpromedio($prome);
                  /*.versilabuscriterio($nota->sem_iCodigo,$nota->cur_iCodigo,4)
                  .versilabusformula($nota->sem_iCodigo,$nota->cur_iCodigo,4)."--"
                  .versilabusnroeval($nota->sem_iCodigo,$nota->cur_iCodigo,4)
                  .*/
                  echo "</td>
                <td ".cambiarcolornotas($nota->CE51)." $oculpromx[4]>".$nota->CE51."  </td>
                <td ".cambiarcolornotas($nota->CE52)." $oculpromx[4]>".$nota->CE52."  </td>
                <td ".cambiarcolornotas($nota->CE53)." $oculpromx[4]>".$nota->CE53." </td>
                <td ".cambiarcolornotas($nota->CE54)." $oculpromx[4]>".$nota->CE54."  </td>
                <td class='columpro' $oculprom[4]>";
                  $prome=0;
                  if(versilabuscriterio($nota->sem_iCodigo,$nota->cur_iCodigo,5)=="PA")
                  {$prome=(sinnota($nota->CE51)+sinnota($nota->CE52)+sinnota($nota->CE53)+sinnota($nota->CE54))/versilabusnroeval($nota->sem_iCodigo,$nota->cur_iCodigo,5);
                  }
                  else {$xpp1=0.0;$xpp2=0.0;$xpp3=0.0;$xpp4=0.0;
                    $pesox = versilabusformula($nota->sem_iCodigo,$nota->cur_iCodigo,5);
                    $npeso = explode('-', $pesox);
                  //  echo "xx".$npeso[0]."xx";
                    if(isset($npeso[0]))
                    $xpp1=$npeso[0];
                    if(isset($npeso[1]))
                    $xpp2=$npeso[1];
                    if(isset($npeso[2]))
                    $xpp3=$npeso[2];
                    if(isset($npeso[3]))
                    $xpp4=$npeso[3];
                    $prome=sinnota($nota->CE51)*sinnota($xpp1)+
                           sinnota($nota->CE52)*sinnota($xpp2)+
                           sinnota($nota->CE53)*sinnota($xpp3)+
                           sinnota($nota->CE54)*sinnota($xpp4);
                    }
                    $promediox5=$prome;
                  echo cambiarcolorpromedio($prome);
                  /*.versilabuscriterio($nota->sem_iCodigo,$nota->cur_iCodigo,4)
                  .versilabusformula($nota->sem_iCodigo,$nota->cur_iCodigo,5)."--"
                  .versilabusnroeval($nota->sem_iCodigo,$nota->cur_iCodigo,5)
                  .*/
                 echo "</td>";
                 echo " <td class='columprof'>"; 
                  $tpro=0;
                 if(formulapf($sem,$codcurso,1)=="PA")
                {
                  if($ttunidad>0)
                  $tpro=(sinnota($promediox1)+sinnota($promediox2)+sinnota($promediox3)+sinnota($promediox4)+sinnota($promediox5))/$ttunidad;
               // echo cambiarcolorpromedio($tpro);
                }else {$ps1=0.0;$ps2=0.0;$ps3=0.0;$ps4=0.0;$ps5=0.0;
                  $pesox = formulapf($sem,$codcurso,2);
                    $npeso = explode('-', $pesox);
                    if(isset($npeso[0]))
                    $ps1=$npeso[0];
                    if(isset($npeso[1]))
                    $ps2=$npeso[1];
                    if(isset($npeso[2]))
                    $ps3=$npeso[2];
                    if(isset($npeso[3]))
                    $ps4=$npeso[3];
                    if(isset($npeso[4]))
                    $ps5=$npeso[4];
                    $tpro=sinnota($promediox1)*sinnota($ps1)+
                           sinnota($promediox2)*sinnota($ps2)+
                           sinnota($promediox3)*sinnota($ps3)+
                           sinnota($promediox4)*sinnota($ps4)+
                           sinnota($promediox5)*sinnota($ps5);
                }

                echo cambiarcolorpromedio($tpro);
                 echo "</td>";
            echo "</tr>";
        }
         echo " </table>
               </div>";
               
               echo "
             <script>
              document.getElementById('nlista$nro').innerHTML = '$n ';
            </script>";
     }         //dd($vernotas); 
  //   vercursonotas($coddocentex,semestreactual(),2);
            @endphp


<script>
    function mostrarobjeto(id)
    {if(document.getElementById(id).style.display == "block")
    document.getElementById(id).style.display = "none";
    else
      document.getElementById(id).style.display = "block";
     }
  </script>
  <head>
    <title>Cursos Matriculados</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
  </head>
  <h5 style="color:Navy">REPORTE DE NOTAS POR UNIDAD</h5>
  <table>
<tr style="background-color: navy;color:white">
<td>CURSO</td>
<td>PLAN ES</td>
<td>ALUMNO</td>
    </tr>


@php
$nn=0;
//    dd($miscursos);
//$milistadata
//foreach($miscursos as $listacur)
@endphp
@foreach($miscursosgrupo as $listacur)
@php
$nn++;
@endphp
<tr>
<td><button type="button"  class="btn btn-primary" href="#"
  onclick="mostrarobjeto('tn{{$nn}}')">VER 
</button> 
{{ $listacur["cur_vcCodigo"] }} ::
{{ $listacur["cur_vcNombre"] }} ::
{{ $listacur["sec_iNumero"] }}</td>
<td>{{ $listacur["escpla_vcCodigo"] }}
{{ left($listacur["cur_vcCodigo"],2) }}</td>
<td id="nlista{{$nn}}">0</td>

</tr>
<tr style="display:none" id="tn{{$nn}}">
<td colspan="6"> 
@php
  // veralumnomatriculados($listacur["cur_iCodigo"],semestreactual(),$nn);
  vercursonotas($coddocentex,semestreactual(),$listacur["cur_iCodigo"],$nn,$listacur["cur_vcNombre"],left($listacur["cur_vcCodigo"],2));
@endphp
</td>
</tr>
@endforeach

</table>
</div>
</div>
       

