<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

//use Laravel\Sanctum\HasApiTokens;//opcional

use Illuminate\database\Eloquent\Model;
class Silabus extends Model
{
   protected $table="silabus";
   protected $fillable=[
      'sil_iCodigo','sec_iCodigo',
      'unidades','tipoPF',
      'formulaPF','tipoPU1',
      'formulaPU1','nro_evalPU1',
      'tipoPU2','formulaPU2',
      'nro_evalPU2','tipoPU3',
      'formulaPU3','nro_evalPU3',
      'tipoPU4','formulaPU4',
      'nro_evalPU4','tipoPU5','formulaPU5',
      'nro_evalPU5','fech_ent1_ini',
      'fech_ent1_fin','fech_ent2_ini',
      'fech_ent2_fin','fech_ent3_ini',
      'fech_ent3_fin','fech_ent4_ini','fech_ent4_fin'

   ];
   public $timestamps=false; //descativando funcion de laravel

}
