<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

//use Laravel\Sanctum\HasApiTokens;//opcional

use Illuminate\database\Eloquent\Model;
class Encuesta_categoria extends Model
{
   protected $table="encuesta_categoria";
   protected $fillable=[
      'enccat_iCodigo','enccat_vcNombre'
   ];
   public $timestamps=false; //descativando funcion de laravel

}
