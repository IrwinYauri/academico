<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\ReportepdfController;
use App\Http\Controllers\AlumnodataController;
use App\Http\Controllers\SilabusemestreController;
use App\Http\Controllers\VerasistenciaController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SemestreController;
use App\Http\Controllers\AsistenciaController;
use App\Http\Controllers\NotasController;
use App\Http\Controllers\PlanactividadController;
use App\Http\Controllers\HojavidaController;
use App\Http\Controllers\CrudController;
use App\Http\Controllers\ActasController;
use App\Http\Controllers\PagosController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
  //  return view('welcome');
  return view('intro');
});


Route::resource('admin',AdminController::class);
Route::post('admin',[AdminController::class,'registrardocente'])->name('admin.registrardocente');
Route::get('admin/eliminardocente/{id}',[AdminController::class,'eliminar'])->name('admin.eliminardocente');
Route::get('admin/editardocente/{id}',[AdminController::class,'editar'])->name('admin.editardocente');
Route::post('admin/actualizardocente',[AdminController::class,'actualizar'])->name('admin.actualizardocente');
Route::post('admin/login',[AdminController::class,'login'])->name('admin.loginadmin');
Route::post('admin/validaradmin',[AdminController::class,'validaradmin'])->name('admin.validaradmin');

Route::get('encuesta/registrarcategoriaencuesta',[AdminController::class,'registrarencuestacategoria'])->name('admin.registrarencuestacategoria');
Route::get('encuesta/eliminarcategoriaencuesta',[AdminController::class,'eliminarencuestacategoria'])->name('admin.eliminarencuestacategoria');
Route::get('encuesta/nuevaencuesta',[AdminController::class,'nuevaencuesta'])->name('admin.nuevaencuesta');
Route::get('encuesta/eliminarencuesta',[AdminController::class,'eliminarencuesta'])->name('admin.eliminarencuesta');
Route::get('encuesta/registrarpreguntaencuesta',[AdminController::class,'registrarpreguntaencuesta'])->name('admin.registrarpreguntaencuesta');
Route::get('encuesta/eliminarencuestapreguntas',[AdminController::class,'eliminarencuestapreguntas'])->name('admin.eliminarencuestapreguntas');
Route::get('encuesta/activarencuesta',[AdminController::class,'activarencuesta'])->name('admin.activarencuesta');

//Route::post('docente/login',[DocenteController::class,'login'])->name('docente.login');
Route::resource('actas',ActasController::class);
Route::get('actasxls/registro',[ActasController::class,'notasxls'])->name('actas.notasxls');

Route::resource('notas',NotasController::class);

Route::resource('asistencia',AsistenciaController::class);

Route::resource('hojavida',HojavidaController::class);

Route::resource('crud',CrudController::class);

Route::get('docente/rptmatriculados',[DocenteController::class,'rptmatriculados'])->name('rptmatriculados');
Route::get('docente/rptcargahorario',[DocenteController::class,'rptcargahorario'])->name('rptcargahorario');
Route::get('docente/rptrecordacademico',[DocenteController::class,'rptrecordacademico'])->name('rptrecordacademico');
Route::get('semestre/semestreactivo',[SemestreController::class,'semestreactivo'])->name('semestre.semestreactivo');

Route::get('vercargahoraria',[DocenteController::class,'vercargahoraria'])->name('vercargahoraria');

Route::resource('semestre',SemestreController::class);
/*
Route::resource('docente',DocenteController::class);
Route::get('docente/matriculados/{id}',[DocenteController::class,'vermatriculados'])->name('docente.matriculados');
Route::post('docente/login',[DocenteController::class,'login'])->name('docente.login');
Route::post('docente/validardocente',[DocenteController::class,'validardocente'])->name('validardocente');*/
Route::resource('silabusemestre',SilabusemestreController::class);
Route::post('silabusemestre',[SilabusemestreController::class,'store'])->name('store');

Route::post('silabusemestre/{arch}', [SilabusemestreController::class,'destroy'])->name('destroy');


Route::resource('silabusemestre',SilabusemestreController::class);
Route::post('silabusemestre',[SilabusemestreController::class,'store'])->name('store');



Route::resource('pagosmatricula',PagosController::class);
Route::post('pagosmatriculax',[PagosController::class,'store'])->name('store');
//Route::post('pagosmatricula/{arch}', [SilabusemestreController::class,'destroy'])->name('destroy');

Route::post('pagosmatricula',[ReportepdfController::class,'recordalumno'])->name('recordalumno');
Route::post('boletaalumno',[ReportepdfController::class,'boletaalumno'])->name('boletaalumno');
//---Route::post('silabusemestre/{nomfile}',[SilabusemestreController::class,'destroy'])->name('destroy');
//Route::post('docente/validardocentes',[DocenteController::class,'validardocentes'])->name('docente.validardocentes');
//Route::get('alumno/reportepdf',[AlumnoController::class,'reportepdf'])->name('alumno.reportepdf');
//Route::post('animal/actualizar',[AnimalController::class,'actualizar'])->name('animal.actualizar');

require base_path('routes/rutaalumno.php');
require base_path('routes/rutadocente.php');
//Route::get('docente',[DocenteController::class,'index'])->name('docente.index');

//require(__DIR__ .'app/routes/rutaalumno.php');
/*Route::group(['prefix' => 'sales'], function () {
    require (__DIR__ . 'App/routes/Sales.php');
}); */
/*
Route::get('alumno',[AlumnoController::class,'index'])->name('alumno.index');
//Route::get('alumno/menu',[AlumnoController::class,'menu'])->name('alumno.menu');
Route::get('alumno/horario',[AlumnoController::class,'horario'])->name('alumno.horario');
Route::get('alumno/notascurso',[AlumnoController::class,'notascurso'])->name('alumno.notascurso');
Route::get('alumno/notascursodetalle',[AlumnoController::class,'notascursodetalle'])->name('alumno.notascursodetalle');
Route::get('alumno/reportepdf',[AlumnoController::class,'reportepdf'])->name('alumno.reportepdf');
Route::get('alumno/verasistencia',[AlumnoController::class,'verasistencia'])->name('alumno.verasistencia');
///---ruta de reportes
Route::get('reportepdf/boletasnotas',[ReportepdfController::class,'boletasnotas'])->name('reportepdf.boletasnotas');
Route::get('reportepdf/horariopdf',[ReportepdfController::class,'horariopdf'])->name('reportepdf.horariopdf');
//-datos alumnodatos
Route::resource('alumnodatos',AlumnodataController::class);
Route::get('alumnodatos1',[AlumnodataController::class,'alumnodatos']);
Route::resource('silabusemestre',SilabusemestreController::class);
Route::resource('verasistencia',VerasistenciaController::class);
//Route::get('alumno/actualizar',[AnimalController::class,'actualizar'])->name('alumno.actualizar');
*/
