<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

//use Laravel\Sanctum\HasApiTokens;//opcional

use Illuminate\database\Eloquent\Model;
class Seccion extends Model
{
   protected $table="seccion";
   protected $fillable=[
      'sec_iCodigo','sem_iCodigo','cur_iCodigo','sec_iNumero',
      'sec_iCapacidad','sec_iMatriculados',
      'doc_iCodigo','tur_cCodigo','act_iCodigo','grupo'
   ];
   public $timestamps=false; //descativando funcion de laravel

}
