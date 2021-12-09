<!DOCTYPE html>
<html>
<head>
	<!--title>Factura</title-->
	
</head>
<?php

session_start();
$codalumno = '';
if (isset($_SESSION['alumnox'])) {
    $codalumno = $_SESSION['codalumnox'];
}
$semestreactual = semestreactual();
function getPonderado($alu_vcCodigo,$escuela,$semestre,$ciclo)
    {
  
      $sql="SELECT sum(r.prom * c.cur_fCredito)/sum(c.cur_fCredito) as rn 
      FROM registroeval as r 
      inner join matriculadetalle as md 
      on r.matdet_iCodigo=md.matdet_iCodigo 
      inner join matricula as m 
      on md.mat_iCodigo=m.mat_iCodigo 
      inner join alumno as a 
      on m.alu_iCodigo=a.alu_iCodigo 
      inner join escuelaplan as ep 
      on a.escpla_iCodigo=ep.escpla_iCodigo 
      inner join escuela as e on ep.esc_vcCodigo=e.esc_vcCodigo 
      inner join seccion as s on md.sec_iCodigo = s.sec_iCodigo 
      inner join curso as c on s.cur_iCodigo=c.cur_iCodigo
       where e.esc_vcCodigo='".$escuela."' and m.sem_iCodigo=".$semestre." 
       and quesemestreesta(a.alu_vcCodigo,m.sem_iCodigo) in(".$ciclo.") 
       and a.alu_vcCodigo = '".$alu_vcCodigo."' and c.cur_iCodigo NOT IN(131,189)"; 
      $data=DB::select($sql);
  
      return (!empty($data))?$data[0]->rn:"";
    }
function getNotas($alumno,$periodo) 
    {
        $sql = "SELECT  c.cur_iCodigo,c.cur_vcCodigo, c.cur_vcNombre, 
        c.cur_fCredito,c.cur_iSemestre,r.prom, r.PF,r.sust,r.aplaz,s.sec_iNumero 
        FROM registroeval as r inner join `matriculadetalle` 
        as md on r.matdet_iCodigo=md.matdet_iCodigo 
        inner join seccion as s on md.sec_iCodigo=s.sec_iCodigo 
        inner join curso as c on s.cur_iCodigo=c.cur_iCodigo
         inner join matricula as m on md.mat_iCodigo=m.mat_iCodigo 
         inner join alumno as a on m.alu_iCodigo=a.alu_iCodigo 
         inner join escuelaplan as ep on a.escpla_iCodigo=ep.escpla_iCodigo 
         inner join escuela as e on ep.esc_vcCodigo=e.esc_vcCodigo 
         where a.alu_vcCodigo='".$alumno."' and m.sem_iCodigo=".$periodo;
        $data=DB::select($sql);
            //->bindValue(':codigo', $codigo)
          //  ->queryAll();
        return $data;
    }
function datosalumno($codalumno)
{
    $sql = "SELECT
alumno.alu_iCodigo,
alumno.alu_vcCodigo,
alumno.alu_vcDocumento,
concat(alumno.alu_vcPaterno,' ',
alumno.alu_vcMaterno,' ',
alumno.alu_vcNombre) as nombre,
alumno.escpla_iCodigo,
escuelaplan.escpla_vcCodigo,
escuela.esc_vcNombre,
escuela.esc_vcCodigo,
escuelaplan.escpla_vcRR
FROM
alumno
INNER JOIN escuelaplan ON alumno.escpla_iCodigo = escuelaplan.escpla_iCodigo
INNER JOIN escuela ON escuelaplan.esc_vcCodigo = escuela.esc_vcCodigo
WHERE alumno.alu_iCodigo='$codalumno'";
    $data = DB::select($sql);
    return $data;
}

function queciclo($codalumno, $semestre)
{
    $sql = "select quesemestreesta('$codalumno','$semestre') as ciclo";
    $data = DB::select($sql);
    return $data[0]->ciclo;
}

$alumno = datosalumno($codalumno);
$notas=getNotas($codalumno,$semestreactual);
$miciclo=queciclo($codalumno, $semestreactual);

	function calificar($valor)
	{
		if($valor>=65)
			return "EXCELENTE";
		else if($valor>=49)
			return "BUENO";
		else if($valor>=35)
			return "REGULAR";
		else if($valor>=20)
			return "DEFICIENTE";
	}
?>
<body>
		
	
	<?php	
	/*
	use app\models\docente\Docente;
	$contGen=0;
	for($i=0;$i<sizeof($modelo);$i++) 
	{
		$alumnito = Docente::getDatosAlumno($modelo[$i]["alu_vcCodigo"]);*/
	?>
	<br><br>
	<div style="text-align:center;">
		<h3>BOLETA DE NOTAS</h3>		
	</div>
	<br>
	<div>
		<div style="float: left;width: 50%;">
			<div>
				<p style="font-size:12px;"><strong>Código:</strong>{{ $alumno[0]->alu_vcCodigo}}</p>
			</div>
			<div>
				<p style="font-size:12px;"><strong>Ape. y Nombre:</strong> {{ $alumno[0]->nombre}} </p>
			</div>
		</div>
		<div style="float: left;width: 50%;">
			<div>
				<p style="font-size:12px;"><strong>Escuela Profesional:</strong>{{ $alumno[0]->esc_vcNombre}}</p>
			</div>
			<div>
				<p style="font-size:12px;"><strong>Plan:</strong>{{ $alumno[0]->escpla_vcRR}}</p>			
			</div>
		</div>
	</div>

		@php
          //  return 0;
        @endphp
	<strong>SEMESTRE {{$semestreactual}}</strong>
	
	<br>
	<?php 
		//$modelNotas = Docente::getNotas($modelo[$i]["alu_vcCodigo"],20211);
	?>
	<table style="font-size:12px;width: 100%;border: 1px solid #000;">
		<thead>
			<tr>
				<th style="background: #eee;border-collapse: collapse;padding: 0.3em;caption-side: bottom;text-align:center;">N°</th>
				<th style="background: #eee;border-collapse: collapse;padding: 0.3em;caption-side: bottom;text-align:center;">Cod.Curso</th>
				<th style="background: #eee;border-collapse: collapse;padding: 0.3em;caption-side: bottom;text-align:center;">Sec.</th>
				<th style="background: #eee;border-collapse: collapse;padding: 0.3em;caption-side: bottom;text-align:center;">Curso</th>
				<th style="background: #eee;border-collapse: collapse;padding: 0.3em;caption-side: bottom;text-align:center;">Sem.</th>
				<th style="background: #eee;border-collapse: collapse;padding: 0.3em;caption-side: bottom;text-align:center;">Cred.</th>
				<th style="background: #eee;border-collapse: collapse;padding: 0.3em;caption-side: bottom;text-align:center;">Nota</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$acumCred=0;
			$sumCreNota=0;
			$j=0;
			foreach ($notas as $notax) 
			{
			?>
			<tr>
			
				<td style="border-collapse: collapse;padding: 0.3em;caption-side: bottom;text-align:center;font-size:12px;text-align: center;"><?php echo $j+1; ?></td>				
				<td style="border-collapse: collapse;padding: 0.3em;caption-side: bottom;font-size:12px;text-align: center;"><?php echo $modelNotas[$j]["cur_vcCodigo"]; ?></td>
				<td style="border-collapse: collapse;padding: 0.3em;caption-side: bottom;font-size:12px;text-align: center;"><?php echo $modelNotas[$j]["sec_iNumero"]; ?></td>
				<td style="border-collapse: collapse;padding: 0.3em;caption-side: bottom;font-size:12px;text-align: left;"><?php echo $modelNotas[$j]["cur_vcNombre"]; ?></td>
				

				<td style="border-collapse: collapse;padding: 0.3em;caption-side: bottom;font-size:12px;text-align: center;"><?php echo $modelNotas[$j]["cur_iSemestre"]; ?></td>

				<?php 
				//if($notax->cur_iCodigo != 131&& $notax->cur_iCodigo != 189)
				{
				?>
				<td style="border-collapse: collapse;padding: 0.3em;caption-side: bottom;font-size:12px;text-align: center;"><?php echo $notax->cur_fCredito ?></td>
				<td style="border-collapse: collapse;padding: 0.3em;caption-side: bottom;font-size:12px;text-align: left;"><?php echo $notax->PF ?><span style="font-size: 8px;"><?php echo ($notax->sust!="")?"(Sust)":"";?></span><span style="font-size: 8px;"><?php echo ($notax->aplaz!="")?"(Aplaz)":"";?></span></td>	
				<?php
				}
			
                ?>
			</tr>	
			<?php 

				if($notax->cur_iCodigo != 131 && $notax->cur_iCodigo != 189)
				{
				$acumCred+=$notax->cur_fCredito;
				$sumCreNota+=$notax->cur_fCredito*$notax->PF;
				}

			}
			?>
			<?php
			for(;$j<8;$j++) 
			{
			?>
			<tr>
			
				<td style="border-collapse: collapse;padding: 0.3em;caption-side: bottom;text-align:center;font-size:12px;">&nbsp;</td>				
				<td style="border-collapse: collapse;padding: 0.3em;caption-side: bottom;font-size:12px;">&nbsp;</td>
				<td style="border-collapse: collapse;padding: 0.3em;caption-side: bottom;font-size:12px;">&nbsp;</td>
				<td style="border-collapse: collapse;padding: 0.3em;caption-side: bottom;font-size:12px;">&nbsp;</td>
				<td style="border-collapse: collapse;padding: 0.3em;caption-side: bottom;font-size:12px;">&nbsp;</td>
				<td style="border-collapse: collapse;padding: 0.3em;caption-side: bottom;font-size:12px;">&nbsp;</td>
				<td style="border-collapse: collapse;padding: 0.3em;caption-side: bottom;font-size:12px;">&nbsp;</td>

			</tr>		
			<?php 
			}
			?>		

		</tbody>
	</table>
	<br>
	<div>
		<div style="float: left;width: 50%;">
			<div>
				&nbsp;
			</div>
			<div>
				&nbsp;
			</div>
		</div>
		<div style="float: left;width: 50%;">
			<div>
				<p style="font-size:12px;"><strong>Créditos Matriculados:</strong> <?php echo $acumCred;?></p>
			</div>
			<div>
			<?php 			
				$modelPP = getPonderado($alumno[0]->alu_vcCodigo,$alumno[0]->esc_vcCodigo,$semestreactual,$miciclo);
			?>
				<!--p style="font-size:12px;"><strong>Promedio Ponderado (Prim.):</strong> <?php echo round($modelPP, 4);?></p-->			
				<p style="font-size:12px;"><strong>Promedio Ponderado:</strong> <?php
                if($acumCred==0)
                echo "";
                else {
                    echo number_format($sumCreNota/$acumCred, 2, '.', '');
                }
               ?></p>			
			</div>
		</div>
	</div>

	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>

	
	<div style="font-size:12px;">
		<div style="float:left;width:50%;text-align:center;color:white;">
			&nbsp;			
		</div>
		<div style="float:left;width:50%;text-align:center;">
  


			<img src="firma1.png" style="opacity: 0;">
			<br><br>
			<br><br>
			<br><br>

		</div>
	</div>

	<?php
//	}
	?>
</body>
</html>