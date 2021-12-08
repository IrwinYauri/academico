<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Semestre extends Model
{

    protected $table = 'semestre';
    protected $primaryKey = 'sem_iCodigo';    
    public $incrementing = false;
    public $timestamps = false;
  
    protected $fillable = [         

      'sem_nombre',
      'sem_cActivo',
      'sem_iNumeroActa',
      'sem_iNumeroAlumno',
      'sem_iMatriculaInicio',
      'sem_iMatriculaFinal',
      'sem_dEncuestaInicio',
      'sem_dEncuestaFinal',
      'sem_iHoraPedagogica',
      'sem_dInicioClases',
      'sem_iSemanas',
      'sem_dActaInicio',
      'sem_dActaFinal',
      'sem_iUnidad',
      'sem_iToleranciaInicio',
      'sem_iToleranciaFinal',
      'fech_ent1_ini',
      'fech_ent1_fin',
      'fech_ent2_ini',
      'fech_ent2_fin',
      'fech_ent3_ini',
      'fech_ent3_fin',
      'fech_ent4_ini',
      'fech_ent4_fin',
      'sem_dAplazadoInicio',
      'sem_dAplazadoFinal',
      'fecMatReg_ini',
      'fecMatReg_fin',
      'fecMatExt_ini',
      'fecMatExt_fin',
      'sem_dSustituInicio',
      'sem_dSustituFin',
      'inicio'
    ];


    /*
    public function preguntas()
    {
        return $this->hasMany('App\preguntas', 'CodEva');//de muchos a uno
    }   
    */

}

