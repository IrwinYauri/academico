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

Route::resource('docente',DocenteController::class);
Route::get('docente/matriculados/{id}',[DocenteController::class,'vermatriculados'])->name('docente.matriculados');
Route::post('docente/login',[DocenteController::class,'login'])->name('docente.login');
Route::post('docente/validardocente',[DocenteController::class,'validardocente'])->name('validardocente');

