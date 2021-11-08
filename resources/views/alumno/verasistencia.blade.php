@php
use \App\Http\Controllers\VerasistenciaController;
//$codcur="";
if(isset($codcur))
{//$codcur=$_GET["codcur"];
}
else{$codcur="";}
$buscarasis =new VerasistenciaController();
//$rptasistencia=$buscarasis->registroasistenciaalumno(12,12);    
//$xasisdia=$buscarasis->verasistenciasemanaldia( 17 ,439  ,20212 , 1);
//$dia1=$buscarasis->verasistenciasemanaldia( 17 ,439  ,20212 , 1);
//$dia2=$buscarasis->registroasistenciaalumno( 17 ,439  ,20212 , 1);

//verasistenciasemanaldia($codmatricula,$codseccion,$semestre,$nrosemana)
function verdiamarcado($codmatriculado,$codseccion,$semestre,$nrosema,$dia,$codcur)
{$buscarasis =new VerasistenciaController();
    $hora="0";
  //  $codcur=2;
    $diax1=$buscarasis->verasistenciasemanaldia( $codmatriculado ,$codseccion  ,$semestre , $nrosema,2);
     foreach ($diax1 as $data) {
        if($data->dia_vcCodigo==$dia and $data->cur_iCodigo==$codcur)
         {
         $hora=$data->sechorasi_iCodigo;
            }
    }
       return $hora;

}
function lunes($aula,$seccionmat,$semestre,$dia,$codcur)
                    {$buscarasis =new VerasistenciaController();
                        $nf=0;
                        $np=0; 
                        $hora="";
                        for($c=1;$c<=16;$c++)
                    {// $hora=verdiamarcado( 17 ,439  ,20212 , $c,"LUN");
                    $hora=verdiamarcado($aula,$seccionmat,$semestre, $c,$dia,$codcur);
                //    echo $hora."--".$c."--";
                    $rpt1=$buscarasis->registroasistenciaalumno($hora,447);  
                    if($rpt1=="Falta")
                        $nf++;
                        if($rpt1=="Presente")
                        $np++;
                        }
                        $r=[$np,$nf];
                        return $r;
        }
echo "<pre>hora:";
//$xasisdia=$buscarasis->verasistenciasemanaldia( 17 ,439  ,20212 , 1,2);
//$hora=verdiamarcado( 17 ,439  ,20212 , 5,"LUN",2);
//echo $hora;
//$rptasistencia=$buscarasis->registroasistenciaalumno($hora,447);   
//dd($rptasistencia);
//echo $rptasistencia;
//dd($rptasistencia);
echo "</pre>"; 
//return 05;
//return $xasisdia;
@endphp

<div class="card mb-4">
    <div class="card-header bg-primary text-white">
    ASISTENCIA DE CURSOS MATRICULADOS
    {{ $codcur }}
    </div>
    <div class="card-body">
       <!-- <div style="overflow: scroll;">       //-->
            <div>                           
            <table class="table table-striped table-bordered table-sm " cellspacing="0"
            id="dataTable" border=5 >
            <tr>
            <td></td>
            <td>Codigo</td>
            <td>Curso</td>
            <td>Creditos</td>
            <td>Ciclo</td>
            <td>Seccion</td>
            <td>Docente</td>
            </tr>
            <tr>
            <td><button class="btn btn-success">Mostrar</button></td>
            <td>AN.EG.17.101</td>
            <td>MATEMATICA BASICA</td>
            <td>4</td>
            <td>1</td>
            <td>101</td>
            <td>Pocoy yauri victor alberto</td>
            </tr>
            <tr><td colspan="7">
                
                    <table>
                    <tr><td>dia</td>
                <td>Inicio</td><td>Final</td>
                <td>Tipo</td>
                <td>Aula</td>
                <td>Docente</td>
                <td>Asistencia</td>
            </tr>
            <tr><td>LUN</td>
                <td>13:30:00</td>
                <td>15:00:00</td>
                <td>T</td>
                <td>17</td>
                <td>pocoy</td>
                <td>1</td>
            </tr>
            <tr>
            <td colspan="7" align='right'>Total:3</td>
            </tr>

                    </table>

            </td></tr>
            <tr>
            <td><button class="btn btn-success">Mostrar</button></td>
            <td>AN.EG.17.101</td>
            <td>MATEMATICA BASICA</td>
            <td>4</td>
            <td>1</td>
            <td>101</td>
            <td>Pocoy yauri victor alberto
            </td>
            <td>
           
            </td>
            </tr>
            <tr><td colspan="7">
                
                    <table border="2">
                    <tr><td>dia</td>
                <td>Inicio</td><td>Final</td>
                <td>Tipo</td>
                <td>Aula</td>
                <td>Docente</td>
                <td>Asistencia</td>
            </tr>

                @foreach($xasis as $asis)
                @if($asis->cur_vcCodigo==$codcur)
                <tr>
                        <td>    {{$dia=$asis->dia_vcCodigo  }}</td>
                        <td>    {{$asis->sechor_iHoraInicio  }}</td>
                        <td>    {{$asis->sechor_iHoraFinal  }}</td>
                        <td>    {{$asis->sectip_cCodigo }}</td>
                        <td>    {{$aula=$asis->aula }}</td>
                        <td>    {{$asis->docente }}</td>
                        <td>    nro asis
                            {{ $asis->matdet_iCodigo }} <br>
                            {{$codsecc= $asis->sec_iCodigo }}
                            {{ $asis->cur_iCodigo }}
                            {{ $semestre=$asis->sem_iCodigo }}
                   
                     @php
                     //verdiamarcado
                        $vrp= lunes($aula ,$codsecc  ,20212 , $dia,2);
                      echo "asis:".$vrp[0]."--";   
                       echo "fal:".$vrp[1]."--";   
                     @endphp
                      
                        </td>
                    </tr>
                    @endif
                    
                @endforeach 


            
            <tr>
            <td colspan="7" align='right'>
                @php
                    
                    $vrp= lunes(17 ,439  ,20212 , "LUN",2);
                   echo "asis:".$vrp[0]."--";   
                   echo "fal:".$vrp[1]."--";  
                   dd($xasis); 
                    @endphp
                Total:3</td>
            </tr>

                    </table>

            </td></tr>
            </table>
        </div>
    </div>
</div>
