<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

//use Laravel\Sanctum\HasApiTokens;//opcional

use Illuminate\database\Eloquent\Model;
class Docente_categoria extends Model
{
   protected $table="docente_categoria";
   protected $fillable=[
      'doctip_iCodigo','doccat_iCodigo','doccat_vcNombre','doccat_cActivo'
   ];
   public $timestamps=false; //descativando funcion de laravel

}
