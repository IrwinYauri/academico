<?php
session_start();
$codalumno = '';
if (isset($_SESSION['codalumnox'])) {
  $codalumno = $_SESSION['codalumnox'];
}
$semestreactual=semestreactual();

function desaprobados($semestre,$codalumno)
{$sql="SELECT
c.cur_vcNombre,
c.cur_vcCodigo,
c.cur_iSemestre,
Max(md.matdet_fPromedio) AS promediofinal,
c.cur_iCodigo
FROM `matriculadetalle` as md inner join seccion as s on md.sec_iCodigo=s.sec_iCodigo 
inner join curso as c on s.cur_iCodigo=c.cur_iCodigo 
inner join matricula as m on md.mat_iCodigo=m.mat_iCodigo 
inner join alumno as a on m.alu_iCodigo=a.alu_iCodigo
where a.alu_iCodigo='$codalumno' 
and m.sem_iCodigo <'$semestre'
and md.matdet_fPromedio < 10.5 #and c.cur_iCodigo not in(131,189)
GROUP BY
c.cur_vcNombre,
c.cur_vcCodigo,
md.matdet_fPromedio,
c.cur_iSemestre";
$data=DB::select($sql);
return $data;
}
function queciclo($codalumno, $semestre)
{
    $sql = "select quesemestreesta('$codalumno','$semestre') as ciclo";
    $data = DB::select($sql);
    return $data[0]->ciclo;
}

function vercarnet($semestre,$codigo)
{$sql="SELECT
pagos.estado
FROM
pagos
where pagos.sem_iCodigo='$semestre' AND
pagos.alu_iCodigo='$codigo'
and pagos.nomConcepto='CARNET UNIVERSITARIO'";
}

function vermatricula($semestre,$codigo,$tipo)
{$sql="SELECT
pagos.estado
FROM
pagos
where pagos.sem_iCodigo='$semestre' AND
pagos.alu_iCodigo='$codigo'
and pagos.nomConcepto='MATRICULA REGULAR ORDINARIO'";
}


$miciclo=queciclo($codalumno, $semestreactual);
$desaprobado=desaprobados($semestreactual,$codalumno);
$repite=count($desaprobado);

if($miciclo<1)
$matricula="MATRICULA INGRESANTE";
else {
	if($repite==0)
$matricula="MATRICULA REGULAR ORDINARIO";

if($repite>3)
$matricula="MATRICULA POR REPITENCIA";

}
/*
if($miciclo>0)
$matricula="BECA PRIMEROS PUESTOS";




if($miciclo>0)
$matricula="MATRICULA EXTEMPORANEA";

if($miciclo>0)
"$matricula=MATRICULA EXTEMPORANEA - MATRICULA POR REPITENCIA";
*/
$carnet="CARNET UNIVERSITARIO";
?>


<style>
    .colorx {
        color: white;
		background-color: rgb(23, 23, 70);
    }

	.colorlista {
        color: white;
		background-color:rgb(44, 9, 9);
    }
	

</style>
<div class="card shadow mb-4">
	<div class="card-header py-3 colorx">

		<h5 class="m-0 font-weight-bold text-white">Requisitos para la Matrícula</h5>
	</div>
	<div class="card-body">
		<p>
			Según la evaluación del sistema. La condición del estudiante exige los siguiente requisitos:
		</p>
	
		<!-- fin card -->
	</div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3 colorx ">
        <h6 class="m-0 font-weight-bold text-white">
           DOCUMENTOS SOLICITADOS PARA MATRICULARSE
        </h6>
    </div>
    <div class="card-body">
        <table>
		<tr>
		<td><a href="" class="nav-link"> 1:Voucher de Matricula </a></td>
		<td><a href="" class="nav-link"> 2:Voucher de Carnet </a></td>
		<td><a href="" class="nav-link"> 3:Constancia del Seguro</a></td>
		<td><a href="" class="nav-link">  4:Ficha Socio Economica</a></td>
		<td rowspan="2"><a  class="btn btn-primary"> SELECCIONAR CURSOS</a></td>
	</tr>
		<tr>
			<td>
				<a href="#" class="btn btn-danger btn-circle " disabled>
				<i class="fas circle"></i>
			</a> PENDIENTE</td>
			<td><a href="#" class="btn btn-danger btn-circle " disabled>
				<i class="fas circle"></i>
			</a> PENDIENTE</td>
			<td><a href="#" class="btn btn-danger btn-circle "disabled>
				<i class="fas circle"></i>
			</a> PENDIENTE</td>
			<td><a href="#" class="btn btn-danger btn-circle " disabled>
				<i class="fas circle"></i>
			</a> PENDIENTE</td></tr>
		</table>
		

        <div style="display: none">
            <a href="#" class="btn btn-danger btn-circle ">
                <i class="fas circle"></i>
            </a> 2:Pendiente
            <a href="#" class="btn btn-danger btn-circle ">
                <i class="fas circle"></i>
            </a> 3:Pendiente
            <a href="#" class="btn btn-danger btn-circle ">
                <i class="fas circle"></i>
            </a> 4:Pendiente

            <a href="#" class="btn btn-success btn-circle btn-lg">
                <i class="fas fa-check"></i>
            </a> PROCESO DE MATRICULA Completado
        </div>

    </div>
</div>



    <!-- inicio card -->
    

    
	<div class="container">
		
			@include('alumno.matriculapagovoucher')
			<!-- fin matricu//-->
	
			@include('alumno.matriculacarnetvoucher')
			<!-- fin carnet//-->
	
			@include('alumno.matriculaseguroconstancia')
			<!-- fin cosntseguro//-->
		
			@include('alumno.matriculafichaeconomica')
			
			<!-- fin cosntseguro//-->
		</div>
	</div>
<<<<<<< HEAD
=======
	if($model->getBienestar(Yii::$app->user->id,$semestre->sem_iCodigo) > 0)
	{
		$requisitos["bienestar"] = "SI";  
	}


	switch($model->getCantSeguro(Yii::$app->user->id))
	{
		case "":
			$requisitos["seguro"] = "NO";   
		break;
		case "0":
			$requisitos["seguro"] = "EVALUACION";                       
		break;
		case "1":
			$requisitos["seguro"] = "SI";  
			$requisitos["path_seguro"] = $model->getCantSeguroPATH(Yii::$app->user->id);
		break;
		case "2":
			$requisitos["seguro"] = "ACTUALIZAR";   
		break;
	}

	if(substr(trim($semestre->sem_iCodigo), -1) == '1' || $model->getMatriculas(Yii::$app->user->identity->username) == 0)
	{
		//insertar tabla pagos carnet pendiente  "CARNET UNIVERSITARIO"                  
		$requisitos["carnet"] = "16.00";
	
		switch($model->getPagoCarnet(Yii::$app->user->id,$semestre->sem_iCodigo))
		{                
			case "":
				//insertar tabla pagos carnet pendiente  "CARNET UNIVERSITARIO" 

				/*$pg = new Pago();

				$pg->alu_iCodigo = Yii::$app->user->id;
				$pg->sem_iCodigo = $semestre->sem_iCodigo;
				//$pg->recibo_path = $matricula->mat_iCodigo;
				//$pg->fechaUpload = $valor;
				//$pg->fechaUpdate = $matricula->mat_iCodigo;
				//$pg->estado = $valor;
				$pg->observacion = '';
				$pg->nomConcepto = "CARNET UNIVERSITARIO";
				$pg->costoConcepto = "16.00";
				//$pg->caja = $valor;

				$ok = $pg->save();*/

				$query="INSERT INTO `pagos`(`codPago`, `alu_iCodigo`, `sem_iCodigo`, `observacion`, `nomConcepto`, `costoConcepto`) VALUES (NULL,'".Yii::$app->user->id."','".$semestre->sem_iCodigo."','','CARNET UNIVERSITARIO','16.00')";
				Yii::$app->db->createCommand($query)->execute();

				//$transaction = Pago::getDb()->beginTransaction();
				//$transaction->commit();

				$requisitos["estadoCarnet"] = "SIN PAGO";   
			break;
			case "S":
				$requisitos["estadoCarnet"] = "SIN PAGO";   
			break;
			case "R":
				$requisitos["estadoCarnet"] = "EVALUACION";                           
			break;
			case "P":
				$requisitos["estadoCarnet"] = "SI";   
				$requisitos["path_vouCarnet"] = $model->getPagoCarnetPATH(Yii::$app->user->id,$semestre->sem_iCodigo);
			break;
		}
	}
	else
	{
		$requisitos["carnet"] = "";    
		$requisitos["estadoCarnet"] = "SI";   
	}

	/*if(substr(trim($semestre->sem_iCodigo), -1) == '1')
	{
		$requisitos["carnet"] = "16";
	}*/
	
   if($model->getMatriculas(Yii::$app->user->identity->username) == 0)
	{
		//$requisitos["carnet"] = "16";
		$requisitos["costomatricula"] = "50.00";                 
		$requisitos["tipomatricula"] = "MATRICULA INGRESANTE";                    
	}
	else
	{                
		switch($model->getTipoMatricula(Yii::$app->user->identity->username))
		{
			case "regular":
				$requisitos["costomatricula"] = "50.00";                 
				$requisitos["tipomatricula"] = "MATRICULA REGULAR ORDINARIO"; 
				
				if($model->extemporaneo($semestre->sem_iCodigo) > 0)
				{
					$requisitos["costomatricula"] = "80.00"; 
					$requisitos["tipomatricula"] = "MATRICULA EXTEMPORANEA"; 
				}

			break;
			case "reincorporacion":
				//$requisitos["costomatricula_reincorporacion"] = "75.00";                 
				//$requisitos["tipomatricula_reincorporacion"] = "MATRICULA POR REINCOPORACION";    

				if($model->getReincorporacionAlumno(Yii::$app->user->identity->username) == '')
				{
					//registrar reincorporación
					$query="INSERT INTO `historicoreincorporacion`(`codHisRei`, `alu_iCodigo`, `sem_iCodigo`, `resolucion`, `estado`) VALUES (NULL,".Yii::$app->user->id.",".$semestre->sem_iCodigo.",'','P')";
					//cambiar estado a reincorporcion
					//$query="UPDATE alumno SET reincoporacion='REINCOPORACION' WHERE alu_vcCodigo = '".Yii::$app->user->identity->username."'";
					Yii::$app->db->createCommand($query)->execute();
					
					Yii::$app->session->setFlash('error', 'Según su situación académica, usted debe realizar un trámite de reincorporación. Acerquese o comuniquese con la Dirección de Asuntos Académicos. Si tuviera alguna duda comuniquese con CPC. Jacqueline LLACZA MOLINA, Num.Cel. 950 808 500');
					return $this->render('message');                            
				}
				else if($model->getReincorporacionAlumno(Yii::$app->user->identity->username) == 'P')
				{
					Yii::$app->session->setFlash('error', 'Según su situación académica usted debe realizar un trámite de reincorporación. Acerquese o comuniquese con la Dirección de Asuntos Académicos. Si tuviera alguna duda comuniquese con CPC. Jacqueline LLACZA MOLINA, Num.Cel. 950 808 500');
					return $this->render('message');    
				}
				else
				{
					$requisitos["costomatricula"] = "50.00";                 
					$requisitos["tipomatricula"] = "MATRICULA REGULAR ORDINARIO"; 
					
					if($model->extemporaneo($semestre->sem_iCodigo) > 0)
					{
						$requisitos["costomatricula"] = "80.00"; 
						$requisitos["tipomatricula"] = "MATRICULA EXTEMPORANEA"; 
					}
				}
			break;
			case "repitente":
				$requisitos["costomatricula"] = "65.00";                 
				$requisitos["tipomatricula"] = "MATRICULA POR REPITENCIA";  

				if($model->extemporaneo($semestre->sem_iCodigo) > 0)
				{
					$requisitos["costomatricula"] = "80.00"; 
					$requisitos["tipomatricula"] = "MATRICULA EXTEMPORANEA - MATRICULA POR REPITENCIA"; 
				}  
			break;
			case "beca":
				$requisitos["costomatricula"] = "0.00";                 
				$requisitos["tipomatricula"] = "BECA PRIMEROS PUESTOS";    
			break;
			case "segundacarrera":
				$requisitos["costomatricula"] = "100.00";                 
				$requisitos["tipomatricula"] = "MATRICULA SEGUNDA CARRERA";    
			break;
			case "anulacion":
				$requisitos["costomatricula"] = "Después de tres (03) años de ausencia, la matrícula queda anulada definitivamente. Acerquese o comuniquese con la Dirección de Asuntos Académicos. Si tuviera alguna duda comuniquese con CPC. Jacqueline LLACZA MOLINA, Num.Cel. 950 808 500";                 
				$requisitos["tipomatricula"] = "ANULACION DE MATRICULA"; 

				Yii::$app->session->setFlash('error', 'Después de tres (03) años de ausencia, la matrícula queda anulada definitivamente. Acerquese o comuniquese con la Dirección de Asuntos Académicos. Si tuviera alguna duda comuniquese con CPC. Jacqueline LLACZA MOLINA, Num.Cel. 950 808 500');
				return $this->render('message');
			break;    

			case "repitencia sucesiva":
				$requisitos["costomatricula"] = "En caso el estudiante desapruebe una asignatura cuatro (4) veces, la Vicepresidencia Académica, en base a la información proporcionada por la Unidad de Registros Académicos, remitirá el informe sobre la situación académica del estudiante al Director de la Escuela Profesional, quien procederá al retiro definitivo del estudiante.";                 
				$requisitos["tipomatricula"] = "REPITENCIA SUCESIVA"; 

				Yii::$app->session->setFlash('error', 'En caso el estudiante desapruebe una asignatura cuatro (4) veces, la Vicepresidencia Académica, en base a la información proporcionada por la Unidad de Registros Académicos, remitirá el informe sobre la situación académica del estudiante al Director de la Escuela Profesional, quien procederá al retiro definitivo del estudiante. Si tuviera alguna duda comuniquese con CPC. Jacqueline LLACZA MOLINA, Num.Cel. 950 808 500');
				return $this->render('message');
			break; 

			case "matricula3":
				$requisitos["costomatricula"] = "La desaprobación de una misma materia por tres veces da lugar a que el estudiante sea separado temporalmente por un año de la universidad, al término de este plazo, el estudiante solo se podrá matricular en la materia que desaprobó anteriormente, para retornar de manera regular a sus estudios en el ciclo siguiente (Artículo 102 de la Ley Universitaria).";                 
				$requisitos["tipomatricula"] = "MATRICULA 3"; 

				Yii::$app->session->setFlash('error', 'La desaprobación de una misma materia por tres veces da lugar a que el estudiante sea separado temporalmente por un año de la universidad, al término de este plazo, el estudiante solo se podrá matricular en la materia que desaprobó anteriormente, para retornar de manera regular a sus estudios en el ciclo siguiente (Artículo 102 de la Ley Universitaria). Si tuviera alguna duda comuniquese con CPC. Jacqueline LLACZA MOLINA, Num.Cel. 950 808 500');
				return $this->render('message');
			break;                   

		}
	}
   
	if($requisitos["tipomatricula"]!="ANULACION DE MATRICULA")
	{

		switch($model->getPagoMatricula(Yii::$app->user->id, $semestre->sem_iCodigo, $requisitos["tipomatricula"]))
		{
			case "":
				
				/*$pg = new Pago();

				$pg->setIsNewRecord(true);
				$pg->alu_iCodigo = Yii::$app->user->id;
				$pg->sem_iCodigo = $semestre->sem_iCodigo;
				//$pg->recibo_path = $matricula->mat_iCodigo;
				//$pg->fechaUpload = $valor;
				//$pg->fechaUpdate = $matricula->mat_iCodigo;
				//$pg->estado = $valor;
				$pg->observacion = '';
				$pg->nomConcepto = $requisitos["tipomatricula"];
				$pg->costoConcepto = $requisitos["costomatricula"];
				//$pg->caja = $valor;

				$ok = $pg->save();*/

				$query="INSERT INTO `pagos`(`codPago`, `alu_iCodigo`, `sem_iCodigo`, `observacion`, `nomConcepto`, `costoConcepto`) VALUES (NULL,'".Yii::$app->user->id."','".$semestre->sem_iCodigo."','','".$requisitos["tipomatricula"]."','".$requisitos["costomatricula"]."')";
				Yii::$app->db->createCommand($query)->execute();

				
				//$transaction = Pago::getDb()->beginTransaction();
				//$transaction->commit();

				
				$requisitos["estadoMatricula"] = "SIN PAGO";                           
			break;
			case "S":
				$requisitos["estadoMatricula"] = "SIN PAGO";   
			break;
			case "R":
				$requisitos["estadoMatricula"] = "EVALUACION";   
			break;
			case "P":
				$requisitos["estadoMatricula"] = "SI";   
				$requisitos["path_matricula"] = $model->getPagoMatriculaPATH(Yii::$app->user->id, $semestre->sem_iCodigo, $requisitos["tipomatricula"]);
			break;
		}                
	}
>>>>>>> ferx
