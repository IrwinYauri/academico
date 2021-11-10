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
                <th>NRO</th>
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
                    ".cambiarcolornotas($nota->CE11)."></td>
                <td $oculpromx[0]><input type='text' value='".$nota->CE12."' size=2 name='nt10$n' 
                  onkeyup='jsnotascolor(this);
                    grabarnotas(this,".$nota->cur_iCodigo.",".$nota->alu_iCodigo.",1,2)' 
                  ".cambiarcolornotas($nota->CE12)."></td>
                <td $oculpromx[0]><input type='text' value='".$nota->CE13."' size=2 name='nt10$n' 
                  onkeyup='jsnotascolor(this);
                    grabarnotas(this,".$nota->cur_iCodigo.",".$nota->alu_iCodigo.",1,3)' 
                  ".cambiarcolornotas($nota->CE13)."></td>
                <td $oculpromx[0]><input type='text' value='".$nota->CE14."' size=2 name='nt10$n' 
                  onkeyup='jsnotascolor(this);
                    grabarnotas(this,".$nota->cur_iCodigo.",".$nota->alu_iCodigo.",1,4)' 
                  ".cambiarcolornotas($nota->CE14)."></td>
                <td $oculpromx[0]>".versilabuscriterio($nota->sem_iCodigo,$nota->cur_iCodigo,1)."</td>

                <td $oculpromx[1]><input type='text' value='".$nota->CE21."' size=2 name='nt20$n' 
                  onkeyup='jsnotascolor(this);
                  grabarnotas(this,".$nota->cur_iCodigo.",".$nota->alu_iCodigo.",2,1)' 
                  ".cambiarcolornotas($nota->CE21)."></td>
                <td $oculpromx[1]><input type='text' value='".$nota->CE22."' size=2 name='nt20$n' 
                  onkeyup='jsnotascolor(this);
                    grabarnotas(this,".$nota->cur_iCodigo.",".$nota->alu_iCodigo.",2,2)' 
                  ".cambiarcolornotas($nota->CE22)."></td>
                <td $oculpromx[1]><input type='text' value='".$nota->CE23."' size=2 name='nt20$n' 
                  onkeyup='jsnotascolor(this);
                  grabarnotas(this,".$nota->cur_iCodigo.",".$nota->alu_iCodigo.",2,3)' 
                  ".cambiarcolornotas($nota->CE23)."></td>
                <td $oculpromx[1]><input type='text' value='".$nota->CE24."' size=2 name='nt20$n' 
                  onkeyup='jsnotascolor(this);
                    grabarnotas(this,".$nota->cur_iCodigo.",".$nota->alu_iCodigo.",2,4)' 
                  ".cambiarcolornotas($nota->CE24)."></td>
                <td $oculpromx[1]>".versilabuscriterio($nota->sem_iCodigo,$nota->cur_iCodigo,2)."</td>

                <td $oculpromx[2]><input type='text' value='".$nota->CE31."' size=2 name='nt30$n' 
                  onkeyup='jsnotascolor(this);
                    grabarnotas(this,".$nota->cur_iCodigo.",".$nota->alu_iCodigo.",3,1)' 
                  ".cambiarcolornotas($nota->CE31)."></td>
                <td $oculpromx[2]><input type='text' value='".$nota->CE32."' size=2 name='nt30$n' 
                  onkeyup='jsnotascolor(this);
                    grabarnotas(this,".$nota->cur_iCodigo.",".$nota->alu_iCodigo.",3,2)' 
                  ".cambiarcolornotas($nota->CE32)."></td>
                <td $oculpromx[2]><input type='text' value='".$nota->CE33."' size=2 name='nt30$n' 
                  onkeyup='jsnotascolor(this);
                    grabarnotas(this,".$nota->cur_iCodigo.",".$nota->alu_iCodigo.",3,3)' 
                  ".cambiarcolornotas($nota->CE33)."></td>
                <td $oculpromx[2]><input type='text' value='".$nota->CE34."' size=2 name='nt30$n'
                  onkeyup='jsnotascolor(this);
                    grabarnotas(this,".$nota->cur_iCodigo.",".$nota->alu_iCodigo.",3,4)' 
                  ".cambiarcolornotas($nota->CE34)."></td>
                <td $oculpromx[2]>".versilabuscriterio($nota->sem_iCodigo,$nota->cur_iCodigo,3)."</td>

                <td $oculpromx[3]><input type='text' value='".$nota->CE41."' size=2 name='nt40$n' 
                  onkeyup='jsnotascolor(this);
                    grabarnotas(this,".$nota->cur_iCodigo.",".$nota->alu_iCodigo.",4,1)' 
                  ".cambiarcolornotas($nota->CE41)."></td>
                <td $oculpromx[3]><input type='text' value='".$nota->CE42."' size=2 name='nt40$n'
                  onkeyup='jsnotascolor(this);
                    grabarnotas(this,".$nota->cur_iCodigo.",".$nota->alu_iCodigo.",4,2)' 
                  ".cambiarcolornotas($nota->CE42)."></td>
                <td $oculpromx[3]><input type='text' value='".$nota->CE43."' size=2 name='nt40$n'
                  onkeyup='jsnotascolor(this);
                    grabarnotas(this,".$nota->cur_iCodigo.",".$nota->alu_iCodigo.",4,3)' 
                  ".cambiarcolornotas($nota->CE43)."></td>
                <td $oculpromx[3]><input type='text' value='".$nota->CE44."' size=2 name='nt40$n'
                  onkeyup='jsnotascolor(this);
                  grabarnotas(this,".$nota->cur_iCodigo.",".$nota->alu_iCodigo.",4,4)' 
                  ".cambiarcolornotas($nota->CE44)."></td>
                <td $oculpromx[3]>".versilabuscriterio($nota->sem_iCodigo,$nota->cur_iCodigo,4)."</td>

                <td $oculpromx[4]><input type='text' value='".$nota->CE51."' size=2 name='nt50$n'
                  onkeyup='jsnotascolor(this);
                    grabarnotas(this,".$nota->cur_iCodigo.",".$nota->alu_iCodigo.",5,1)' 
                  ".cambiarcolornotas($nota->CE51)."></td>
                <td $oculpromx[4]><input type='text' value='".$nota->CE52."' size=2 name='nt50$n'
                  onkeyup='jsnotascolor(this);
                    grabarnotas(this,".$nota->cur_iCodigo.",".$nota->alu_iCodigo.",5,2)'
                  ".cambiarcolornotas($nota->CE52)."></td>
                <td $oculpromx[4]><input type='text' value='".$nota->CE53."' size=2 name='nt50$n'
                  onkeyup='jsnotascolor(this);
                    grabarnotas(this,".$nota->cur_iCodigo.",".$nota->alu_iCodigo.",5,3)' 
                  ".cambiarcolornotas($nota->CE53)."></td>
                <td $oculpromx[4]><input type='text' value='".$nota->CE54."' size=2 name='nt50$n'
                  onkeyup='jsnotascolor(this);
                    grabarnotas(this,".$nota->cur_iCodigo.",".$nota->alu_iCodigo.",5,4)' 
                  ".cambiarcolornotas($nota->CE54)."></td>
                <td $oculpromx[4]>".versilabuscriterio($nota->sem_iCodigo,$nota->cur_iCodigo,5) ."</td>
            </tr>";
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

<script>
  //activarwow()
</script>