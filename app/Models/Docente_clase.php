<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

//use Laravel\Sanctum\HasApiTokens;//opcional

use Illuminate\database\Eloquent\Model;
class Docente_clase extends Model
{
   protected $table="docente_clase";
   protected $fillable=[
      'doccla_iCodigo','doccla_vcNombre','doccla_cActivo','doccla_iHoras'
   ];
   public $timestamps=false; //descativando funcion de laravel

}
