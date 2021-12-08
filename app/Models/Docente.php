<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

//use Laravel\Sanctum\HasApiTokens;//opcional

use Illuminate\database\Eloquent\Model;
class Docente extends Model
{
   protected $table="docente";
   protected $fillable=[
      'doc_iCodigo','doc_vcDocumento',
      'doc_vcPaterno','doc_vcMaterno',
      'doc_vcNombre','doc_cActivo',
      'depaca_iCodigo','doccat_iCodigo',
      'doccla_iCodigo','doc_vcPassword',
      'doc_iPasswordCambiar','doc_vcTelefonoFijo',
      'doc_vcTelefonoCelular','doc_vcEmail1',
      'doc_vcEmail2','condDocente','cateDocente'
   ];
   public $timestamps=false; //descativando funcion de laravel

}
