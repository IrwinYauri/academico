<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Support\Facades\DB; //uso base datos
use Illuminate\Http\Request;//capturar datos

use DataTables;

class VerasistenciaController extends Controller
{
    public function verasistenciasemanal($semestre,$idalumno)
   {
     $data1=DB::select('SELECT
     c.cur_iCodigo,
     c.cur_vcCodigo,
     c.cur_vcNombre,
     c.cur_fCredito,
     c.cur_iSemestre,
     r.prom,
     r.PF,
     r.sust,
     r.aplaz,
     s.sec_iNumero,
     sh.dia_vcCodigo,
     sh.sechor_iHoraInicio,
     sh.sechor_iHoraFinal,
     sh.sectip_cCodigo,
     sh.aul_iCodigo as aula,
     sh.doc_iCodigo,concat(
     docente.doc_vcPaterno," ",
     docente.doc_vcMaterno," ",
     docente.doc_vcNombre) as docente,
     md.matdet_iCodigo,
     sh.sechor_iCodigo,
     sh.sec_iCodigo,
     s.sem_iCodigo
     FROM
     registroeval AS r
     INNER JOIN matriculadetalle AS md ON r.matdet_iCodigo = md.matdet_iCodigo
     INNER JOIN seccion AS s ON md.sec_iCodigo = s.sec_iCodigo
     INNER JOIN curso AS c ON s.cur_iCodigo = c.cur_iCodigo
     INNER JOIN matricula AS m ON md.mat_iCodigo = m.mat_iCodigo
     INNER JOIN alumno AS a ON m.alu_iCodigo = a.alu_iCodigo
     INNER JOIN escuelaplan AS ep ON a.escpla_iCodigo = ep.escpla_iCodigo
     INNER JOIN escuela AS e ON ep.esc_vcCodigo = e.esc_vcCodigo
     INNER JOIN seccion_horario AS sh ON s.sec_iCodigo = sh.sec_iCodigo
     INNER JOIN docente ON sh.doc_iCodigo = docente.doc_iCodigo
    where a.alu_iCodigo="'.$idalumno.'" and m.sem_iCodigo="'.$semestre.'"');    
    return $data1;
   }                                          //17     ,439         ,20212 , 1
   public function verasistenciasemanaldia($codmatricula,$codseccion,$semestre,$nrosemana,$codcur)
   {
     $datasemanal=DB::select('SELECT 
     seccion_horario.sechor_iCodigo,
     seccion_horario.sec_iCodigo,
     seccion_horario.dia_vcCodigo,
     seccion_horario.sechor_iHoraInicio,
     seccion_horario.sechor_iHoraFinal,
     seccion_horario.sectip_cCodigo,
     seccion_horario.aul_iCodigo,
     seccion_horario.doc_iCodigo,
     seccion_horarioasistencia.sechorasi_iSemana,
     seccion_horarioasistencia.sechorasi_dFecha,
     matricula.sem_iCodigo,
     seccion_horarioasistencia.sechorasi_iCodigo,
     seccion_horarioasistencia.sechor_iCodigo,
     seccion.sec_iCodigo,
     seccion.cur_iCodigo
   FROM
     seccion_horario
     INNER JOIN seccion_horarioasistencia ON (seccion_horario.sechor_iCodigo = seccion_horarioasistencia.sechor_iCodigo)
     INNER JOIN matricula ON (seccion_horario.aul_iCodigo = matricula.alu_iCodigo)
     INNER JOIN seccion ON (seccion_horario.sec_iCodigo = seccion.sec_iCodigo)
   WHERE

     seccion_horario.aul_iCodigo = "'.$codmatricula.'" AND
     seccion_horario.sec_iCodigo = "'.$codseccion.'" AND
     matricula.sem_iCodigo = "'.$semestre.'" 
     AND seccion_horarioasistencia.sechorasi_iSemana ="'.$nrosemana.'" AND
     seccion.cur_iCodigo = "'.$codcur.'"');    
    return $datasemanal;
   }

   public function registroasistenciaalumno($codregistro,$codalumno)
   {//sechoralu_iCodigo,sechorasi_iCodigo,alu_iCodigo,sechoralu_bPresente 
     $datasemanal=DB::select('SELECT 
     sechoralu_bPresente 
     FROM seccion_horarioalumno
     where seccion_horarioalumno.sechorasi_iCodigo="'.$codregistro.'" and alu_iCodigo="'.$codalumno.'"');
     //where seccion_horarioalumno.sechorasi_iCodigo=13808 and `alu_iCodigo`=447');
     //AND seccion_horarioasistencia.sechorasi_iSemana ="'.$nrosemana.'"');    
     $r="No registrado";
     foreach($datasemanal as $rpt)
     {$r=$rpt->sechoralu_bPresente ;

     }
    return $r;
   }
   //aul_iCodigo  matriculado se asigna
     //sec_iCodigo seccion que esta activo
     //sem_iCodig  nro semest
   public function index()
   {return view('verasistencia');
   }
}
