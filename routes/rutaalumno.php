<?php
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\ReportepdfController;
use App\Http\Controllers\AlumnodataController;
use App\Http\Controllers\SilabusemestreController;
use App\Http\Controllers\VerasistenciaController;

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
Route::resource('alumno',AlumnoController::class);
Route::get('alumnodatos1',[AlumnodataController::class,'alumnodatos']);

Route::resource('verasistencia',VerasistenciaController::class);
//Route::get('alumno/actualizar',[AnimalController::class,'actualizar'])->name('alumno.actualizar');
Route::post('alumno/login',[AlumnoController::class,'login'])->name('alumno.login');
Route::post('alumno/validaralumno',[AlumnoController::class,'validaralumno'])->name('validaralumno');