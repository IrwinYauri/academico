@php
    $semestre=0;
    $codalumno=0;
    $escuela='';
    $cod2=0;
    if(isset($_REQUEST["semestre"]))
    $semestre=$_REQUEST["semestre"];
    if(isset($_REQUEST["codalumno"]))
    $codalumno=$_REQUEST["codalumno"];
    if(isset($_REQUEST["escuela"]))
    $escuela=$_REQUEST["escuela"];

    if(isset($_REQUEST["cod2"]))
    $cod2=$_REQUEST["cod2"];

    function vernotasdet($semestre,$codalumno)
    {$sql="SELECT  c.cur_iCodigo,c.cur_vcCodigo,
     c.cur_vcNombre, c.cur_fCredito,c.cur_iSemestre,
     r.prom, r.PF,r.sust,r.aplaz,s.sec_iNumero FROM 
     registroeval as r inner join `matriculadetalle` as md on 
     r.matdet_iCodigo=md.matdet_iCodigo inner join seccion as s on
      md.sec_iCodigo=s.sec_iCodigo inner join curso as c on
       s.cur_iCodigo=c.cur_iCodigo inner join matricula as m on
        md.mat_iCodigo=m.mat_iCodigo inner join alumno as a on
         m.alu_iCodigo=a.alu_iCodigo inner join escuelaplan as ep on
          a.escpla_iCodigo=ep.escpla_iCodigo inner join escuela as e on ep.esc_vcCodigo=e.esc_vcCodigo 
    where a.alu_iCodigo='$codalumno' and m.sem_iCodigo='$semestre'";
    $data=DB::select($sql);
    return $data;
    }

    function queciclo($codalumno,$semestre)
{$sql="select quesemestreesta('$codalumno','$semestre') as ciclo";
 $data=DB::select($sql);
 return $data[0]->ciclo;
}

function calcularponderado($semestre,$codalumno,$escuela,$ciclo)
{$sql="SELECT 
sum(r.prom * c.cur_fCredito)/sum(c.cur_fCredito) as promedio 
FROM 
registroeval as r 
inner join matriculadetalle as md on r.matdet_iCodigo=md.matdet_iCodigo 
inner join matricula as m on md.mat_iCodigo=m.mat_iCodigo 
inner join alumno as a on m.alu_iCodigo=a.alu_iCodigo 
inner join escuelaplan as ep on a.escpla_iCodigo=ep.escpla_iCodigo 
inner join escuela as e on ep.esc_vcCodigo=e.esc_vcCodigo 
inner join seccion as s on md.sec_iCodigo = s.sec_iCodigo 
inner join curso as c on s.cur_iCodigo=c.cur_iCodigo 
where e.esc_vcCodigo='$escuela' and m.sem_iCodigo='$semestre' 
and quesemestreesta(a.alu_vcCodigo,m.sem_iCodigo) in('$ciclo') 
and a.alu_iCodigo = '$codalumno' and c.cur_iCodigo NOT IN(131,189)";
$data=DB::select($sql);
return $data[0]->promedio;
}

$miciclo=queciclo($cod2,$semestre);

//echo "-".$semestre."-".$codalumno."-".$miciclo;

$miprome=calcularponderado($semestre,$codalumno,$escuela,$miciclo);
    //calcularponderado($semestre,$codalumno,$escuela,$ciclo)

    $cursosx=vernotasdet($semestre,$codalumno);
    $colum1='style="background: #eee;border-collapse: collapse;padding: 0.3em;caption-side: bottom;text-align:center;"';
@endphp
<div class="row">
    <h2 style="font-size: 14px;">SEMESTRES {{ left($semestre, 4) }}-{{ right($semestre, 1) }}</h2>
    <table style="font-size:10px;width: 100%;border: 1px solid #000;">
        <tr>
            @php
                
           echo "
            <td $colum1>N°</td>
            <td $colum1>Cod.Curso</td>
            <td $colum1>Sec.</td>
            <td $colum1>Asignatura</td>
            <td $colum1>Sem.</td>
            <td $colum1>Cred.</td>
            <td $colum1>Prome.</td>
            <td $colum1>Sust.</td>
            <td $colum1>Aplaz.</td>
            <td $colum1>PF</td>" ;

            @endphp

        </tr>
        @php
            $nn = 1;
            $cred=0;
        @endphp
      
        @foreach($cursosx as $data)
            <tr>
                @php
                $ncred= $data->cur_fCredito;
                echo "
                <td $colum1> $nn</td>
                <td $colum1> $data->cur_vcCodigo </td>
                <td $colum1> $data->sec_iNumero </td>
                <td $colum1> $data->cur_vcNombre </td>
                <td $colum1>$data->cur_iSemestre </td>
                <td $colum1>$data->cur_fCredito </td>
                <td $colum1> $data->prom </td>
                <td $colum1> $data->sust</td>
                <td $colum1> $data->aplaz</td>
                <td $colum1> $data->PF</td>";
                $nn++;
                @endphp
@php
  $cred=$cred+ $ncred ;
@endphp
            </tr>
        @endforeach

    </table>
 </div>
 <script>
     $("#micredito").html("{{$cred}}");
     $("#miponderado").html("{{$miprome}}");
 </script>