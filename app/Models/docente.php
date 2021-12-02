<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class docente extends Model
{
    //use HasFactory;

    protected $table = 'docente';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'CodNot';
    //public $incrementing = false;

    public $timestamps = false;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */

    protected $fillable = [                
    	'doc_iCodigo',
		'doc_vcDocumento',
		'doc_vcPaterno',
		'doc_vcMaterno',
		'doc_vcNombre',
		'doc_cActivo',
		'depaca_iCodigo',
		'doccat_iCodigo',
		'doccla_iCodigo',
		'doc_vcPassword',
		'doc_iPasswordCambiar',
		'doc_vcTelefonoFijo',
		'doc_vcTelefonoCelular',
		'doc_vcEmail1',
		'doc_vcEmail2',
		'condDocente',
		'cateDocente'
    ];

    /*public function notas()
    {
        return $this->belongsTo('App\aula', 'CodAul');//de muchos a uno
    }
    
    public function matriculados()
    {
        return $this->belongsTo('App\matriculados', 'CodMat');//de muchos a uno
    }*/

    
    public function getClaseSincronizadas($cCodEve)
    {
        $datosE=DB::table("clasesSincro")->where("cCodEve",$cCodEve)->get();

        return $datosE;//de muchos a uno
    }
}
