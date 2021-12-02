<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

//use Laravel\Sanctum\HasApiTokens;//opcional

use Illuminate\database\Eloquent\Model;
class Escuelaplan extends Model
{
   protected $table="escuelaplan";
   protected $fillable=[
      'esc_vcCodigo','esc_vcNombre','are_cCodigo','esc_cActivo','fac_vcCodigo','esc_iNumero','facultad'
   ];
   public $timestamps=false; //descativando funcion de laravel

   protected $primaryKey = 'escpla_iCodigo';

   public function escuela()
   {
   //  return $this->belongsTo(Escuelaplan::class,'escpla_iCodigo');
     //return $this->hasMany('App\Models\Escuelaplan','escpla_iCodigo');
     return $this->hasMany('App\Models\Alumno','alumno.escpla_iCodigo');
   }
}
