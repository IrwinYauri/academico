@php
  use App\Http\Controllers\SilabusemestreController;   
$seccion="0";
$unidades="0";
                            $tipoPF="";
                            $formulaPF="";
                            $tipoPU1="";
                            $formulaPU1="";
                            $nro_evalPU1="";
                            $tipoPU2="";
                            $formulaPU2="";
                            $nro_evalPU2="";
                            $tipoPU3="";
                            $formulaPU3="";
                            $nro_evalPU3="";
                            $tipoPU4="";
                            $formulaPU4="";
                            $nro_evalPU4="";
                            $tipoPU5="";
                            $formulaPU5="";
                            $nro_evalPU5="";
                            $fech_ent1_ini="";
                            $fech_ent1_fin="";
                            $fech_ent2_ini="";
                            $fech_ent2_fin="";
                            $fech_ent3_ini="";
                            $fech_ent3_fin="";
                            $fech_ent4_ini="";
                            $fech_ent4_fin="";
                            $fech_ent5_ini="";
                            $fech_ent5_fin="";

if(isset($_GET["seccion"]))
{$seccion=$_GET["seccion"];  }




  $silabos=new SilabusemestreController();
  $rptsilabo=$silabos->silabusseccion($seccion);
  $cant=count($rptsilabo);
  echo $cant;
 //dd($rptsilabo);
 foreach($rptsilabo as $silabu) {
    //$versilaboc->
    $unidades= $silabu->unidades;
     $tipoPF=$silabu->tipoPF;
      $formulaPF=$silabu->formulaPF;
       $tipoPU1=$silabu->tipoPU1;
      $formulaPU1=$silabu->formulaPU1;
     $nro_evalPU1=$silabu->nro_evalPU1;
       $tipoPU2=$silabu->tipoPU2;
       $formulaPU2=$silabu->formulaPU2;
      $nro_evalPU2=$silabu->nro_evalPU2;
        $tipoPU3=$silabu->tipoPU3;
        $formulaPU3=$silabu->formulaPU3;
       $nro_evalPU3=$silabu->nro_evalPU3;
       $tipoPU4=$silabu->tipoPU4;
        $formulaPU4=$silabu->formulaPU4;
       $nro_evalPU4=$silabu->nro_evalPU4;
       $tipoPU5=$silabu->tipoPU5;
       $formulaPU5=$silabu->formulaPU5;
        $nro_evalPU5=$silabu->nro_evalPU5;
        $fech_ent1_ini=$silabu->fech_ent1_ini;
        $fech_ent1_fin=$silabu->fech_ent1_fin;
        $fech_ent2_ini=$silabu->fech_ent2_ini;
        $fech_ent2_fin=$silabu->fech_ent2_fin;
        $fech_ent3_ini=$silabu->fech_ent3_ini;
        $fech_ent3_fin=$silabu->fech_ent3_fin;
        $fech_ent4_ini=$silabu->fech_ent4_ini;
        $fech_ent4_fin=$silabu->fech_ent4_fin;
        if(isset($silabu->fech_ent5_ini))
         {$fech_ent5_ini=$silabu->fech_ent5_ini;
          $fech_ent5_fin=$silabu->fech_ent5_fin;} 

  
        } //fin foreach
        $ps1=0;$ps2=0;$ps3=0;$ps4=0;$ps5=0;
        $ps11=0;$ps12=0;$ps13=0;$ps14=0;
        $ps21=0;$ps22=0;$ps23=0;$ps24=0;
        $ps31=0;$ps32=0;$ps33=0;$ps34=0;
        $ps41=0;$ps42=0;$ps43=0;$ps44=0;
        $ps51=0;$ps52=0;$ps53=0;$ps54=0;
       if($tipoPF=="PA")
       {$tipoPF="Aritmetico";
        }
        if($tipoPF=="Pesos")
        {$pesox =$formulaPF;
        $npeso = explode('-', $pesox);
                    if(isset($npeso[0]))
                    $ps1=$npeso[0]*100;
                    if(isset($npeso[1]))
                    $ps2=$npeso[1]*100;
                    if(isset($npeso[2]))
                    $ps3=$npeso[2]*100;
                    if(isset($npeso[3]))
                    $ps4=$npeso[3]*100;
                    if(isset($npeso[4]))
                    $ps5=$npeso[4]*100;

        }

       if($tipoPU1=="PA")
       $tipoPU1="Aritmetico";
        if($tipoPU1=="Pesos")
        {$pesox =$formulaPU1;
        $npeso = explode('-', $pesox);
                    if(isset($npeso[0]))
                    $ps11=$npeso[0]*100;
                    if(isset($npeso[1]))
                    $ps12=$npeso[1]*100;
                    if(isset($npeso[2]))
                    $ps13=$npeso[2]*100;
                    if(isset($npeso[3]))
                    $ps14=$npeso[3]*100;
                  

        }


       if($tipoPU2=="PA")
       $tipoPU2="Aritmetico";
       if($tipoPU3=="PA")
       $tipoPU3="Aritmetico";
       if($tipoPU4=="PA")
       $tipoPU4="Aritmetico";
@endphp

@php
    if($unidades>0)
   {echo "<script>
   document.getElementById('seccion').value ='".$seccion."'  
   document.getElementById('nrounidad').value='".$unidades."' 
   document.getElementById('pesopromediodet').value='".$tipoPF."' 
   document.getElementById('pesopf1').value=$ps1
   document.getElementById('pesopf2').value=$ps2
   document.getElementById('pesopf3').value=$ps3
   document.getElementById('pesopf4').value=$ps4
   document.getElementById('pesopf5').value=$ps5

   document.getElementById('pesoevaluacion1').value='".$tipoPU1."'
   document.getElementById('nroevaluacion1').value='".$nro_evalPU1."'

         document.getElementById('nroeva11').value=$ps11
         document.getElementById('nroeva12').value=$ps12
         document.getElementById('nroeva13').value=$ps13
         document.getElementById('nroeva14').value=$ps14

   document.getElementById('pesoevaluacion2').value='".$tipoPU2."'
   document.getElementById('nroevaluacion2').value='".$nro_evalPU2."'

   document.getElementById('pesoevaluacion3').value='".$tipoPU3."'
   document.getElementById('nroevaluacion3').value='".$nro_evalPU3."'

   document.getElementById('pesoevaluacion4').value='".$tipoPU4."'
   document.getElementById('nroevaluacion4').value='".$nro_evalPU4."'


   vernrounidad($unidades)
   </script> ";
   }else {
           echo "<script>
                vernrounidad($unidades)
                </script> ";
          
   }

@endphp

<script>
        
</script>

seccion=document.getElementById('seccion').value;
      //   alert(seccion)
        unidades=document.getElementById('nrounidad').value;
        tipoPF=document.getElementById('pesopromediodet').value;

ff11=(document.getElementById('pesopf1').value*1)/100;
ff12=(document.getElementById('pesopf2').value*1)/100;
ff13=(document.getElementById('pesopf3').value*1)/100;
ff14=(document.getElementById('pesopf4').value*1)/100;

tipoPU1=document.getElementById('pesoevaluacion1').value;//pesos
        nro_evalPU1=document.getElementById('nroevaluacion1').value;

ff11=(document.getElementById('nroeva11').value*1)/100;
          ff12=(document.getElementById('nroeva12').value*1)/100;
          ff13=(document.getElementById('nroeva13').value*1)/100;
          ff14=(document.getElementById('nroeva14').value*1)/100;

tipoPU2=document.getElementById('pesoevaluacion2').value; //pesos
        nro_evalPU2=document.getElementById('nroevaluacion2').value;

        ff11=(document.getElementById('nroeva21').value*1)/100;
        ff12=(document.getElementById('nroeva22').value*1)/100;
        ff13=(document.getElementById('nroeva23').value*1)/100;
        ff14=(document.getElementById('nroeva24').value*1)/100;


tipoPU3=document.getElementById('pesoevaluacion3').value; //pesos
        nro_evalPU3=document.getElementById('nroevaluacion3').value;

ff11=(document.getElementById('nroeva31').value*1)/100;
          ff12=(document.getElementById('nroeva32').value*1)/100;
          ff13=(document.getElementById('nroeva33').value*1)/100;
          ff14=(document.getElementById('nroeva34').value*1)/100;

          tipoPU4=document.getElementById('pesoevaluacion4').value;//pesos
        nro_evalPU4=document.getElementById('nroevaluacion4').value;

ff11=(document.getElementById('nroeva41').value*1)/100;
ff12=(document.getElementById('nroeva42').value*1)/100;
ff13=(document.getElementById('nroeva43').value*1)/100;
ff14=(document.getElementById('nroeva44').value*1)/100;

tipoPU5=document.getElementById('pesoevaluacion5').value;//pesos
nro_evalPU5=document.getElementById('nroevaluacion5').value;

ff11=(document.getElementById('nroeva51').value*1)/100;
          ff12=(document.getElementById('nroeva52').value*1)/100;
          ff13=(document.getElementById('nroeva53').value*1)/100;
          ff14=(document.getElementById('nroeva54').value*1)/100;


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