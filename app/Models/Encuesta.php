<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

//use Laravel\Sanctum\HasApiTokens;//opcional

use Illuminate\database\Eloquent\Model;
class Encuesta extends Model
{
   protected $table="encuesta";
   protected $fillable=[
      'enc_iCodigo','sem_iCodigo','enc_iPuntaje','enc_cActivo','enc_vcObservacion'
   ];
   public $timestamps=false; //descativando funcion de laravel

}
