<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

//use Laravel\Sanctum\HasApiTokens;//opcional

use Illuminate\database\Eloquent\Model;
class Curso extends Model
{
   protected $table="curso";
   protected $fillable=[
      'cur_iCodigo','cur_vcCodigo',
      'cur_vcNombre','cur_fCredito',
      'cur_fCreditoRequisito',
      'cur_cTipo','cur_iSemestre',
      'escpla_iCodigo','arefor_vcCodigo',
      'curtip_vcCodigo'
   ];
   public $timestamps=false; //descativando funcion de laravel

}
