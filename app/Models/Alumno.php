<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

//use Laravel\Sanctum\HasApiTokens;//opcional

use Illuminate\database\Eloquent\Model;
class Alumno extends Model
{
   protected $table="alumno";
   protected $fillable=[
      'alu_iCodigo','alu_vcCodigo',
      'alu_vcDocumento','alu_vcPaterno',
      'alu_vcMaterno','alu_vcNombre',
      'escpla_iCodigo','alu_vcPassword',
      'escpla_iNotas','escpla_iCreditos',
      'escpla_iPuntaje','escpla_fPromedio',
      'alu_cSexo','alu_dFechaNacimiento',
      'alucon_iCodigo','alu_vcTelefono',
      'alu_vcCelular','alu_vcEmail',
      'alu_vcEmail_alt','proadm_vcCodigo',
      'cod_vcCodigo','cal_iEapMerito',
      'mod_cCodigo','alu_ori_mes',
      'ubi_vcId','alu_vcCondicionResolucion',
      'alu_vcCondicionVencimiento',
      'pueind_iCodigo','aluest_iCodigo'

   ];
   
   protected $primaryKey = 'alu_iCodigo'; //para usar con find
   public $timestamps=false; //descativando funcion de laravel
   public function escuelas()
    {
    //  return $this->belongsTo(Escuelaplan::class,'escpla_iCodigo');
      //return $this->hasMany('App\Models\Escuelaplan','escpla_iCodigo');
      return $this->belongsTo('App\Models\Escuelaplan','escpla_iCodigo');
    }

}
