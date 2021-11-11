@php
session_start();
 $coddocentex="";
 if(isset($_SESSION['coddocentex'])){
  $coddocentex=$_SESSION['coddocentex'];
 }

 

 use App\Http\Controllers\DocenteController; 
 $notas=new DocenteController();  
 // $vernotas=$notas->verregistronotas($coddocentex,semestreactual(),2);

  $miasistencia=new DocenteController();  
// $miscursos=$miasistencia->vercursos(20212,$coddocentex);
$miscursos=$miasistencia->vercursos(semestreactual(),$coddocentex);
$miscursosgrupo=$miasistencia->vercursosagrupado(semestreactual(),$coddocentex);
//dd($miscursosgrupo);

 @endphp
 <style>
   .table-responsive { 
      height:200px;
      overflow:scroll;
      font-size: 11px;
    }
    .tableFixHead          { overflow: auto; height: 100px; }
    .tableFixHead thead th { position: sticky; top: 0; z-index: 1; }
    
    /* Just common table stuff. Really. */
    table  { border-collapse: collapse; width: 100%; }
    th, td { padding: 8px 16px; }
    th     { background:navy; }
    
    
    #prueba {
   /*    position: absolute;
        background-color: #b5c8ca;
          margin-left:-100px;*/
    
    }
    .verticalconte {
           
               /*     transform: rotate(90deg);*/
               }
            .fix1 {
      position: sticky;
     left: 0px;
     color: #03091b;
      background-color:white;
    }
    .boqueartexto{
      background-color:#cdcdcd;
    }
    </style>
  @php
    use App\Http\Controllers\SilabusemestreController;   

    
  @endphp
      @include('docente.formulasnotas')
  @php
     // vercursonotas($coddocentex,semestreactual(),2)
function vercursonotas($coddocentex,$sem,$codcurso,$nro,$curso,$escuela)
{ $notas=new DocenteController();  
   //$vernotas=$notas->verregistronotas($coddocentex,$sem,$codcurso,$curso);
  $vernotas=$notas->verregistronotas($coddocentex,$sem,$codcurso);
  $ttunidad=totalnrounidad($sem,$codcurso);
 //  dd($vernotas); 
  //verregistronotas($codprofe,$semestre,$codcur)
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

           <div class="card-body tableFixHead table-responsive table-condensed" style="height: 600px; width:940px; overflow: scroll;"  >
       
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
              $nnnroevalx=array(array("1","","","","")
                              ,array("2","","","","")
                              ,array("3","","","","")
                              ,array("4","","","","")
                              ,array("5","","","",""));
              $promediox1=0;$promediox2=0;$promediox3=0;$promediox4=0;$promediox5=0;

              for($x = 1; $x < 6; $x++)
                { if( $ttunidad<$x)
                  $estadover="style='display:none;'";
                  ///versilabusnroeval($nota->sem_iCodigo,$nota->cur_iCodigo,$x)
                    echo "<td colspan='4' $estadover>Nro Ev: ".versilabusnroeval($sem,$codcurso,$x)."</td>";
                    
                    if(versilabusnroeval($sem,$codcurso,$x)<4)
                    $nnnroevalx[$x-1][4]="disabled class='boqueartexto'";
                    if(versilabusnroeval($sem,$codcurso,$x)<3)
                    $nnnroevalx[$x-1][3]="disabled class='boqueartexto'";
                    if(versilabusnroeval($sem,$codcurso,$x)<2)
                    $nnnroevalx[$x-1][2]="disabled class='boqueartexto'";
                    if(versilabusnroeval($sem,$codcurso,$x)<1)
                    $nnnroevalx[$x-1][1]="disabled class='boqueartexto'";
                    
                    if(versilabusnroeval($sem,$codcurso,$x)<1)
                    {$oculprom[$x-1]="style='display:none;'";
                     $oculpromx[$x-1]="class='ocultarnota'";
                    }
                    echo " <td  $estadover ></td>";
                    
              } 
              echo " <td>".formulapf($sem,$codcurso,1).formulapf($sem,$codcurso,2)." </td>";
                echo "</tr>";

                echo '<tr style="background-color:black;color:white">
                <th>NRO </th>
                <th>Codigo</th>
                <th>Alumno</th>';
     $estadover="";
                for($x = 1; $x < 6; $x++)
                { if( $ttunidad<$x)
                  $estadover="style='display:none;'";
                    for($n = 1; $n < 5; $n++)
                   { echo "<th  $estadover> CE$n</th>";
                    } 
                    echo " <th  $estadover> PU$x</th>";
              } 
                 echo " <th> PF</th>";
        echo "    </tr>
        </thead>";
    
         
                $n=0;
       //    dd($vernotas); 
        foreach ($vernotas as $nota)
           { $n++;
               echo "<tr>
                <td class='fix1'>$n</td>
                <td class='fix1'>$nota->alu_vcCodigo</td>
                <td class='fix1'>".$nota->alu_vcPaterno." ".$nota->alu_vcMaterno." ".$nota->alu_vcNombre."</td>
                <td $oculpromx[0]> <input type='text' value='".$nota->CE11."' size=2 name='nt10$n'
                    onkeyup='jsnotascolor(this);
                    grabarnotas(this,".$nota->cur_iCodigo.",".$nota->alu_iCodigo.",1,1)' 
                    ".cambiarcolornotas($nota->CE11)." ". 
                    $nnnroevalx[0][1]." ></td>

                <td $oculpromx[0]><input type='text' value='".$nota->CE12."' size=2 name='nt10$n' 
                  onkeyup='jsnotascolor(this);
                    grabarnotas(this,".$nota->cur_iCodigo.",".$nota->alu_iCodigo.",1,2)' 
                  ".cambiarcolornotas($nota->CE12)." ". 
                    $nnnroevalx[0][2]." ></td>

                <td $oculpromx[0]><input type='text' value='".$nota->CE13."' size=2 name='nt10$n' 
                  onkeyup='jsnotascolor(this);
                    grabarnotas(this,".$nota->cur_iCodigo.",".$nota->alu_iCodigo.",1,3)' 
                  ".cambiarcolornotas($nota->CE13)." ".
                   $nnnroevalx[0][3]." ></td>

                <td $oculpromx[0]><input type='text' value='".$nota->CE14."' size=2 name='nt10$n' 
                  onkeyup='jsnotascolor(this);
                    grabarnotas(this,".$nota->cur_iCodigo.",".$nota->alu_iCodigo.",1,4)' 
                  ".cambiarcolornotas($nota->CE14)." ". 
                  $nnnroevalx[0][4]." ></td>

                <td $oculpromx[0]>";
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

                  //echo versilabuscriterio($nota->sem_iCodigo,$nota->cur_iCodigo,1);
                  echo "</td>

                <td $oculpromx[1]><input type='text' value='".$nota->CE21."' size=2 name='nt20$n' 
                  onkeyup='jsnotascolor(this);
                  grabarnotas(this,".$nota->cur_iCodigo.",".$nota->alu_iCodigo.",2,1)' 
                  ".cambiarcolornotas($nota->CE21)." ". 
                  $nnnroevalx[1][1]." ></td>

                  
                <td $oculpromx[1]><input type='text' value='".$nota->CE22."' size=2 name='nt20$n' 
                  onkeyup='jsnotascolor(this);
                    grabarnotas(this,".$nota->cur_iCodigo.",".$nota->alu_iCodigo.",2,2)' 
                  ".cambiarcolornotas($nota->CE22)." ". 
                  $nnnroevalx[1][2]." ></td>

                <td $oculpromx[1]><input type='text' value='".$nota->CE23."' size=2 name='nt20$n' 
                  onkeyup='jsnotascolor(this);
                  grabarnotas(this,".$nota->cur_iCodigo.",".$nota->alu_iCodigo.",2,3)' 
                  ".cambiarcolornotas($nota->CE23)." ". 
                  $nnnroevalx[1][3]." ></td>

                <td $oculpromx[1]><input type='text' value='".$nota->CE24."' size=2 name='nt20$n' 
                  onkeyup='jsnotascolor(this);
                    grabarnotas(this,".$nota->cur_iCodigo.",".$nota->alu_iCodigo.",2,4)' 
                  ".cambiarcolornotas($nota->CE24)." ". 
                  $nnnroevalx[1][4]." ></td>


                <td $oculpromx[1]>";

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

                  //echo versilabuscriterio($nota->sem_iCodigo,$nota->cur_iCodigo,2);
                  echo "</td>

                <td $oculpromx[2]><input type='text' value='".$nota->CE31."' size=2 name='nt30$n' 
                  onkeyup='jsnotascolor(this);
                    grabarnotas(this,".$nota->cur_iCodigo.",".$nota->alu_iCodigo.",3,1)' 
                  ".cambiarcolornotas($nota->CE31)." ". 
                  $nnnroevalx[2][1]." ></td>

                <td $oculpromx[2]><input type='text' value='".$nota->CE32."' size=2 name='nt30$n' 
                  onkeyup='jsnotascolor(this);
                    grabarnotas(this,".$nota->cur_iCodigo.",".$nota->alu_iCodigo.",3,2)' 
                  ".cambiarcolornotas($nota->CE32)." ". 
                  $nnnroevalx[2][2]."></td>

                <td $oculpromx[2]><input type='text' value='".$nota->CE33."' size=2 name='nt30$n' 
                  onkeyup='jsnotascolor(this);
                    grabarnotas(this,".$nota->cur_iCodigo.",".$nota->alu_iCodigo.",3,3)' 
                  ".cambiarcolornotas($nota->CE33)." ". 
                  $nnnroevalx[2][3]."></td>

                <td $oculpromx[2]><input type='text' value='".$nota->CE34."' size=2 name='nt30$n'
                  onkeyup='jsnotascolor(this);
                    grabarnotas(this,".$nota->cur_iCodigo.",".$nota->alu_iCodigo.",3,4)' 
                  ".cambiarcolornotas($nota->CE34)." ". 
                  $nnnroevalx[2][4]." ></td>

                <td $oculpromx[2]>";

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

                  //echo versilabuscriterio($nota->sem_iCodigo,$nota->cur_iCodigo,3);
                  echo "</td>

                <td $oculpromx[3]><input type='text' value='".$nota->CE41."' size=2 name='nt40$n' 
                  onkeyup='jsnotascolor(this);
                    grabarnotas(this,".$nota->cur_iCodigo.",".$nota->alu_iCodigo.",4,1)' 
                  ".cambiarcolornotas($nota->CE41)." ". 
                  $nnnroevalx[3][1]." ></td>

                <td $oculpromx[3]><input type='text' value='".$nota->CE42."' size=2 name='nt40$n'
                  onkeyup='jsnotascolor(this);
                    grabarnotas(this,".$nota->cur_iCodigo.",".$nota->alu_iCodigo.",4,2)' 
                  ".cambiarcolornotas($nota->CE42)." ". 
                  $nnnroevalx[3][2]." ></td>

                <td $oculpromx[3]><input type='text' value='".$nota->CE43."' size=2 name='nt40$n'
                  onkeyup='jsnotascolor(this);
                    grabarnotas(this,".$nota->cur_iCodigo.",".$nota->alu_iCodigo.",4,3)' 
                  ".cambiarcolornotas($nota->CE43)." ". 
                  $nnnroevalx[3][3]." ></td>

                <td $oculpromx[3]><input type='text' value='".$nota->CE44."' size=2 name='nt40$n'
                  onkeyup='jsnotascolor(this);
                  grabarnotas(this,".$nota->cur_iCodigo.",".$nota->alu_iCodigo.",4,4)' 
                  ".cambiarcolornotas($nota->CE44)." ". 
                  $nnnroevalx[3][4]."></td>

                <td $oculpromx[3]>";
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

                  //echo versilabuscriterio($nota->sem_iCodigo,$nota->cur_iCodigo,4);
                  echo "</td>

                <td $oculpromx[4]><input type='text' value='".$nota->CE51."' size=2 name='nt50$n'
                  onkeyup='jsnotascolor(this);
                    grabarnotas(this,".$nota->cur_iCodigo.",".$nota->alu_iCodigo.",5,1)' 
                  ".cambiarcolornotas($nota->CE51)." ". 
                  $nnnroevalx[4][1]." ></td>

                <td $oculpromx[4]><input type='text' value='".$nota->CE52."' size=2 name='nt50$n'
                  onkeyup='jsnotascolor(this);
                    grabarnotas(this,".$nota->cur_iCodigo.",".$nota->alu_iCodigo.",5,2)'
                  ".cambiarcolornotas($nota->CE52)." ". 
                  $nnnroevalx[4][2]." ></td>

                <td $oculpromx[4]><input type='text' value='".$nota->CE53."' size=2 name='nt50$n'
                  onkeyup='jsnotascolor(this);
                    grabarnotas(this,".$nota->cur_iCodigo.",".$nota->alu_iCodigo.",5,3)' 
                  ".cambiarcolornotas($nota->CE53)." ". 
                  $nnnroevalx[4][3]." ></td>

                <td $oculpromx[4]><input type='text' value='".$nota->CE54."' size=2 name='nt50$n'
                  onkeyup='jsnotascolor(this);
                    grabarnotas(this,".$nota->cur_iCodigo.",".$nota->alu_iCodigo.",5,4)' 
                  ".cambiarcolornotas($nota->CE54)." ". 
                  $nnnroevalx[4][4]." ></td>

                <td $oculpromx[4]>";

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

                  //echo versilabuscriterio($nota->sem_iCodigo,$nota->cur_iCodigo,5) ;
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

                 echo " </tr>";
        }
         echo " </table> </div>
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
  <h3 style="color:rgb(13, 13, 206)">REGISTRAR NOTAS POR UNIDAD</h3>
  <div id="mimensajex">GRABANDO</div>
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
<td><button type="button"  class="btn btn-secondary" href="#"
  onclick="mostrarobjeto('tn{{$nn}}')" style="background-color: #301934;color:white">VER 
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





<script>
    function grabarnotas(idnota,idcurso,idalumno,unidad,nro)
    {//alert(id.value);
        if(idnota.value>=0 && idnota.value<=20)
        {men="GRABANDO:"+idnota.value.toString()+"";
        alertagrabarx(men,"#301934");
       //editarnotasjs(semestre,codcurso,codalumno,nota)
       editarnotasjs({{semestreactual()}},idcurso,idalumno,idnota.value,unidad,nro);
    }
        else
        {men="Error solo notas entre 0 a 20";
        alertagrabarx(men,"red");
        id.value="";
        }

    }
  //  alertagrabarx("COMPLETANDO","blue")
  
</script>
<script src="{{ asset('vendor/jquery/jquery.min.js')}}"></script>
<script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>
<script src="{{ asset('js/panelnotas.js')}}"></script>

