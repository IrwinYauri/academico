<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

//use Laravel\Sanctum\HasApiTokens;//opcional

use Illuminate\database\Eloquent\Model;
class Alumno_estado extends Model
{
   protected $table="alumno_estado";
   protected $fillable=[
      'aluest_iCodigo','aluest_vcNombre'
   ];
   public $timestamps=false; //descativando funcion de laravel

}
