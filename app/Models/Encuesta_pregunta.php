<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

//use Laravel\Sanctum\HasApiTokens;//opcional

use Illuminate\database\Eloquent\Model;
class Encuesta_pregunta extends Model
{
   protected $table="encuesta_pregunta";
   protected $fillable=[
      'encpre_iCodigo','enc_iCodigo','encpre_iNumero','enccat_iCodigo','encpre_vcPregunta','encpre_iPuntaje','encpre_iPeso'
   ];
   public $timestamps=false; //descativando funcion de laravel

}
