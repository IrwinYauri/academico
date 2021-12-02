<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

//use Laravel\Sanctum\HasApiTokens;//opcional

use Illuminate\database\Eloquent\Model;
class Docentedepaca extends Model
{
   protected $table="docentedepaca";
   protected $fillable=[
      'depaca_iCodigo','depaca_vcNombre','depaca_cActivo'
   ];
   public $timestamps=false; //descativando funcion de laravel

}
