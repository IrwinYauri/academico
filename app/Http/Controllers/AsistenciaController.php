<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Support\Facades\DB; //uso base datos
use Illuminate\Http\Request;//capturar datos

use DataTables;

class AsistenciaController extends Controller
{
    public function index()
   { 
    //return view('admin.index');
   }
   public function show($mivistas)
   {return view("asistencia.".$mivistas."");
    
   }
   public function asistenciaalumno($codalumno,$codcursosec,$s1,$s16,$dia)
   {// echo "Semestre";
   // return "Proceso completado";
   $sql="select 
   concat( sh.sectip_cCodigo, sha.sechorasi_iCodigo ) as pk,
  
   al.alu_iCodigo,
   al.alu_vcCodigo,    
   sha.sechorasi_iSemana,

   sha.sechorasi_dFecha,
   sh.sectip_cCodigo,    
   IF(shal.sechoralu_bPresente = 'Presente', 'P',IF(shal.sechoralu_bPresente = 'Falta','F',IFNULL(shal.sechoralu_bPresente,'F') )) as estado
   ,concat(al.alu_vcMaterno,' ',al.alu_vcMaterno,' ',al.alu_vcNombre) as alumno
   ,sh.dia_vcCodigo
   ,shal.sechorasi_iCodigo
    ,shal.sechoralu_iCodigo

from 
   seccion  as sc 
   inner join matriculadetalle as matd
   on(sc.sec_iCodigo=matd.sec_iCodigo)
   inner join matricula as mat 
   on(matd.mat_iCodigo=mat.mat_iCodigo and mat.estado<>'R')
   inner join alumno as al
   on(mat.alu_iCodigo=al.alu_iCodigo)
   inner join seccion_horario as sh
   on(sc.sec_iCodigo=sh.sec_iCodigo)
   inner join seccion_horarioasistencia as sha 
   on(sh.sechor_iCodigo=sha.sechor_iCodigo)
   left join seccion_horarioalumno as shal
   on(sha.sechorasi_iCodigo=shal.sechorasi_iCodigo and al.alu_iCodigo=shal.alu_iCodigo)

where sc.sec_iCodigo='$codcursosec' and (sha.sechorasi_iSemana>='$s1' and sha.sechorasi_iSemana<='$s16')
and al.alu_iCodigo='$codalumno'
and sh.dia_vcCodigo like '".$dia."%'
";
    $data1=DB::select($sql);    
    return $data1;
   }
 public function updateasistenciadia($codhora,$codalumno,$estado)
 { $sql="update seccion_horarioalumno  set sechoralu_bPresente='$estado'  where
    sechorasi_iCodigo='$codhora'
    and alu_iCodigo='$codalumno'
    
    ";
    $data1=DB::select($sql);    
    return $data1;
 }

 public function verasistenciacurso($codcurso,$semestre,$dia,$semana)
  {
    $sql="SELECT 
      `seccion`.`sem_iCodigo`,
      `seccion_horario`.`sec_iCodigo`,
      `seccion_horarioasistencia`.`sechor_iCodigo`,
      `seccion`.`cur_iCodigo`,
      `curso`.`cur_vcNombre`,
      `seccion`.`tur_cCodigo`,
      `seccion_horarioasistencia`.`sechorasi_iHoraFinal`,
      `seccion_horarioasistencia`.`sechorasi_iHoraInicio`,
      `seccion_horarioasistencia`.`dia_vcCodigo`,
      `seccion_horarioasistencia`.`sechorasi_iCodigo`,
      `seccion_horarioasistencia`.`sechorasi_iSemana`,
      `seccion_horarioasistencia`.`sechorasi_dFecha`
      FROM
      `seccion_horario`
      INNER JOIN `seccion_horarioasistencia` ON (`seccion_horario`.`sechor_iCodigo` = `seccion_horarioasistencia`.`sechor_iCodigo`)
      INNER JOIN `seccion` ON (`seccion_horario`.`sec_iCodigo` = `seccion`.`sec_iCodigo`)
      INNER JOIN `curso` ON (`seccion`.`cur_iCodigo` = `curso`.`cur_iCodigo`)
      WHERE
      `seccion`.`cur_iCodigo` = $codcurso AND 
      `seccion`.`sem_iCodigo` = $semestre AND 
      `seccion_horarioasistencia`.`dia_vcCodigo` = '$dia' AND 
      `seccion_horarioasistencia`.`sechorasi_iSemana` = $semana ";

    $data1=DB::select($sql);    
    
    return $data1;
  }
   public function contarasistenciacurso($codhora)
   {$sql="SELECT count(*) as total FROM `seccion_horarioalumno` WHERE `sechorasi_iCodigo`=$codhora
       ";
    $data1=DB::select($sql);    
     return $data1;
   }
   public function crearasistenciasemana($codhora,$codalumno)
   {$sql="insert into seccion_horarioalumno(sechorasi_iCodigo,alu_iCodigo,sechoralu_bPresente) 
      values($codhora,$codalumno,'Presente')";
    $data1=DB::select($sql);    
     return $data1;
   }

   public function asistenciaalumnodia($codcurso,$codalumno,$fecha,$tipo)
   {$sql="SELECT 
    `seccion`.`sem_iCodigo`,
    `seccion`.`cur_iCodigo`,
    `seccion_horarioasistencia`.`dia_iNumero`,
    `seccion_horarioasistencia`.`dia_vcCodigo`,
    `seccion_horarioasistencia`.`sechorasi_iSemana`,
    `seccion_horarioalumno`.`alu_iCodigo`,
    `curso`.`cur_vcNombre`,
    `alumno`.`alu_vcPaterno`,
    `alumno`.`alu_vcMaterno`,
    `alumno`.`alu_vcNombre`,
    `alumno`.`alu_icodigo`,
    `seccion`.`tur_cCodigo`,
    `seccion_horario`.`sectip_cCodigo`,
    `seccion_horario`.`sec_iCodigo`,
    `seccion_horarioasistencia`.`sechorasi_dFecha`,
    `seccion_horarioalumno`.`sechoralu_bPresente`, 
    `seccion_horarioasistencia`.`sechorasi_iCodigo`
  FROM
    `seccion`
    INNER JOIN `seccion_horario` ON (`seccion`.`sec_iCodigo` = `seccion_horario`.`sec_iCodigo`)
    INNER JOIN `seccion_horarioasistencia` ON (`seccion_horarioasistencia`.`sechor_iCodigo` = `seccion_horario`.`sechor_iCodigo`)
    INNER JOIN `seccion_horarioalumno` ON (`seccion_horarioalumno`.`sechorasi_iCodigo` = `seccion_horarioasistencia`.`sechorasi_iCodigo`)
    INNER JOIN `curso` ON (`seccion`.`cur_iCodigo` = `curso`.`cur_iCodigo`)
    INNER JOIN `alumno` ON (`seccion_horarioalumno`.`alu_iCodigo` = `alumno`.`alu_iCodigo`)
  WHERE
    `seccion`.`cur_iCodigo` = '$codcurso' AND 
    `alumno`.`alu_icodigo` ='$codalumno' AND 
    `seccion_horario`.`sectip_cCodigo` LIKE '$tipo%' AND 
    `seccion_horarioasistencia`.`sechorasi_dFecha` = '$fecha'";
    $data1=DB::select($sql);    
     return $data1;
   }
   public function buscarasistenciafecha($semestre,$codcurso,$fecha,$codalumno){
     $sql="SELECT
     seccion.sem_iCodigo,
     seccion_horario.sec_iCodigo,
     seccion.cur_iCodigo,
     curso.cur_vcNombre,
     seccion.tur_cCodigo,
     seccion_horarioasistencia.sechorasi_iHoraFinal,
     seccion_horarioasistencia.sechorasi_iHoraInicio,
     seccion_horarioasistencia.dia_vcCodigo,
     seccion_horarioasistencia.sechorasi_iSemana,
     seccion_horarioasistencia.sechorasi_dFecha,
     seccion_horario.sectip_cCodigo,
     seccion_horarioasistencia.sechor_iCodigo,
     seccion_horarioasistencia.sechorasi_iCodigo,
     seccion_horarioalumno.alu_iCodigo,
     alumno.alu_vcPaterno,
     alumno.alu_vcMaterno,
     alumno.alu_vcNombre,
     seccion_horarioalumno.sechoralu_bPresente
     FROM
     seccion_horario
     INNER JOIN seccion_horarioasistencia ON (seccion_horario.sechor_iCodigo = seccion_horarioasistencia.sechor_iCodigo)
     INNER JOIN seccion ON (seccion_horario.sec_iCodigo = seccion.sec_iCodigo)
     INNER JOIN curso ON (seccion.cur_iCodigo = curso.cur_iCodigo)
     INNER JOIN seccion_horarioalumno ON seccion_horarioalumno.sechorasi_iCodigo = seccion_horarioasistencia.sechorasi_iCodigo
     INNER JOIN alumno ON alumno.alu_iCodigo = seccion_horarioalumno.alu_iCodigo
     WHERE
     seccion.cur_iCodigo = '$codcurso' AND
     seccion.sem_iCodigo = '$semestre' 
     and seccion_horarioasistencia.sechorasi_dFecha='$fecha'
     and seccion_horarioalumno.alu_iCodigo='$codalumno'
     ";
      $data1=DB::select($sql);    
      return $data1;
   }
   
   public function totalasisdia($codcurso,$codalumno,$fecha,$tipo)
   {$sql="SELECT 
    count(*) as total
  FROM
    `seccion`
    INNER JOIN `seccion_horario` ON (`seccion`.`sec_iCodigo` = `seccion_horario`.`sec_iCodigo`)
    INNER JOIN `seccion_horarioasistencia` ON (`seccion_horarioasistencia`.`sechor_iCodigo` = `seccion_horario`.`sechor_iCodigo`)
    INNER JOIN `seccion_horarioalumno` ON (`seccion_horarioalumno`.`sechorasi_iCodigo` = `seccion_horarioasistencia`.`sechorasi_iCodigo`)
    INNER JOIN `curso` ON (`seccion`.`cur_iCodigo` = `curso`.`cur_iCodigo`)
    INNER JOIN `alumno` ON (`seccion_horarioalumno`.`alu_iCodigo` = `alumno`.`alu_iCodigo`)
  WHERE
    `seccion`.`cur_iCodigo` = '$codcurso' AND 
   
    `seccion_horario`.`sectip_cCodigo` LIKE '$tipo%' AND 
    `seccion_horarioasistencia`.`sechorasi_dFecha` = '$fecha'";
    $data1=DB::select($sql);    
     return $data1;
   }
   
   public function nrosemanaasistencia($codcurso,$fecha,$tipo)
   {$sql="SELECT 
    `seccion`.`sem_iCodigo`,
    `seccion`.`cur_iCodigo`,
    `seccion_horarioasistencia`.`dia_iNumero`,
    `seccion_horarioasistencia`.`dia_vcCodigo`,
    `seccion_horarioasistencia`.`sechorasi_iSemana`,
    `curso`.`cur_vcNombre`,
    `seccion`.`tur_cCodigo`,
    `seccion_horario`.`sectip_cCodigo`,
    `seccion_horario`.`sec_iCodigo`,
    `seccion_horarioasistencia`.`sechorasi_dFecha`,
    `seccion_horarioasistencia`.`sechorasi_iCodigo`
  FROM
    `seccion`
    INNER JOIN `seccion_horario` ON (`seccion`.`sec_iCodigo` = `seccion_horario`.`sec_iCodigo`)
    INNER JOIN `seccion_horarioasistencia` ON (`seccion_horarioasistencia`.`sechor_iCodigo` = `seccion_horario`.`sechor_iCodigo`)
    INNER JOIN `curso` ON (`seccion`.`cur_iCodigo` = `curso`.`cur_iCodigo`)
  WHERE
    `seccion`.`cur_iCodigo` = '$codcurso' AND 
    `seccion_horario`.`sectip_cCodigo` LIKE '$tipo%' AND 
    `seccion_horarioasistencia`.`sechorasi_dFecha` = '$fecha'";
    $data1=DB::select($sql);    
     return $data1;
   }

   public function buscarcursoescuela($codcurso,$semestre)
   {$sql="SELECT
    seccion.sem_iCodigo,
    seccion.cur_iCodigo,
    curso.cur_vcNombre,
    seccion.tur_cCodigo,
    docente.doc_vcDocumento,
    docente.doc_vcPaterno,
    docente.doc_vcMaterno,
    docente.doc_vcNombre,
    curso.cur_vcCodigo,
    escuelaplan.escpla_iCodigo,
    curso.cur_iSemestre,
    (SELECT `escuela`.`esc_vcNombre` FROM `escuela` where `escuela`.`esc_vcCodigo`=left(curso.cur_vcCodigo,2)) AS escuela,
    turno.tur_vcNombre
    FROM
    seccion
    INNER JOIN curso ON (seccion.cur_iCodigo = curso.cur_iCodigo)
    INNER JOIN docente ON seccion.doc_iCodigo = docente.doc_iCodigo
    INNER JOIN escuelaplan ON curso.escpla_iCodigo = escuelaplan.escpla_iCodigo
    INNER JOIN turno ON seccion.tur_cCodigo = turno.tur_cCodigo
    WHERE
        seccion.cur_iCodigo = '$codcurso' AND
        seccion.sem_iCodigo = '$semestre'";
     $data1=DB::select($sql);    
     return $data1;

   }


}
