@php

 use App\Http\Controllers\SilabusemestreController;
             $seccion="0";
                            $unidades="";
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
            { $seccion=$_GET["seccion"];
                            $unidades=$_GET["unidades"];
                            $tipoPF=left($_GET["tipoPF"],5);
                            $formulaPF=$_GET["formulaPF"];
                            $tipoPU1=left($_GET["tipoPU1"],5);
                            $formulaPU1=$_GET["formulaPU1"];
                            $nro_evalPU1=$_GET["nro_evalPU1"];
                            $tipoPU2=left($_GET["tipoPU2"],5);
                            $formulaPU2=$_GET["formulaPU2"];
                            $nro_evalPU2=$_GET["nro_evalPU2"];
                            $tipoPU3=left($_GET["tipoPU3"],5);
                            $formulaPU3=$_GET["formulaPU3"];
                            $nro_evalPU3=$_GET["nro_evalPU3"];
                            $tipoPU4=left($_GET["tipoPU4"],5);
                            $formulaPU4=$_GET["formulaPU4"];
                            $nro_evalPU4=$_GET["nro_evalPU4"];
                            $tipoPU5=left($_GET["tipoPU5"],5);
                            $formulaPU5=$_GET["formulaPU5"];
                            $nro_evalPU5=$_GET["nro_evalPU5"];
                            $fech_ent1_ini=$_GET["fech_ent1_ini"];
                            $fech_ent1_fin=$_GET["fech_ent1_fin"];
                            $fech_ent2_ini=$_GET["fech_ent2_ini"];
                            $fech_ent2_fin=$_GET["fech_ent2_fin"];
                            $fech_ent3_ini=$_GET["fech_ent3_ini"];
                            $fech_ent3_fin=$_GET["fech_ent3_fin"];
                            $fech_ent4_ini=$_GET["fech_ent4_ini"];
                            $fech_ent4_fin=$_GET["fech_ent4_fin"];
                            $fech_ent5_ini=$_GET["fech_ent5_ini"];
                            $fech_ent5_fin=$_GET["fech_ent5_fin"]; 
                            //registrando
                            $silabos=new SilabusemestreController();
                           $xsilabu=$silabos->registrarsilabus($seccion,
                            $unidades,
                            $tipoPF,
                            $formulaPF,
                            $tipoPU1,
                            $formulaPU1,
                            $nro_evalPU1,
                            $tipoPU2,
                            $formulaPU2,
                            $nro_evalPU2,
                            $tipoPU3,
                            $formulaPU3,
                            $nro_evalPU3,
                            $tipoPU4,
                            $formulaPU4,
                            $nro_evalPU4,
                            $tipoPU5,
                            $formulaPU5,
                            $nro_evalPU5,
                            $fech_ent1_ini,
                            $fech_ent1_fin,
                            $fech_ent2_ini,
                            $fech_ent2_fin,
                            $fech_ent3_ini,
                            $fech_ent3_fin,
                            $fech_ent4_ini,
                            $fech_ent4_fin,
                            $fech_ent5_ini,
                            $fech_ent5_fin );
            }

        echo  $seccion."<br>";
        echo $unidades."<br>";
        echo $tipoPF;

@endphp
Procesando silabus
<script>
 //   alert("resultado")
 //   mostrarsilabusconfigurar();
</script>