<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\MateriaController;
use App\Http\Controllers\HorarioController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\InscripcionController;
use App\Http\Controllers\CalificacionController;
use App\Http\Controllers\TareaController;

// ── Raíz ──────────────────────────────────────────────
Route::get('/', fn() => redirect()->route('login'));

// ── Auth ──────────────────────────────────────────────
Route::get('/login',    [AuthController::class, 'showLogin'])->name('login');
Route::post('/login',   [AuthController::class, 'login'])->name('login.post');
Route::get('/registro', [AuthController::class, 'showRegistro'])->name('registro');
Route::post('/registro',[AuthController::class, 'registro'])->name('registro.post');
Route::post('/logout',  [AuthController::class, 'logout'])->name('logout');

// ── Alumno ────────────────────────────────────────────
Route::get('/mi-panel',                [AlumnoController::class,       'dashboard'])->name('alumno.dashboard');
Route::get('/mi-panel/materias',       [MateriaController::class,      'index'])->name('alumno.materias');
Route::get('/mi-panel/horarios',       [HorarioController::class,      'index'])->name('alumno.horarios');
Route::get('/mi-panel/grupos',         [GrupoController::class,        'index'])->name('alumno.grupos');
Route::get('/mi-panel/calificaciones', [CalificacionController::class, 'index'])->name('alumno.calificaciones');
Route::get('/mi-panel/tareas',         [TareaController::class, 'misTablas'])->name('alumno.tareas');
Route::post('/mi-panel/tareas/{tarea}/subir', [TareaController::class, 'subirEntrega'])->name('alumno.tareas.subir');

// ── Maestro: CRUD completo ─────────────────────────────
Route::resource('usuarios', UsuarioController::class)->parameters(['usuarios' => 'usuario']);

Route::resource('materias', MateriaController::class)->parameters(['materias' => 'materia']);

Route::resource('horarios', HorarioController::class)->parameters(['horarios' => 'horario']);

Route::resource('grupos', GrupoController::class)->parameters(['grupos' => 'grupo']);

Route::resource('inscripciones', InscripcionController::class)
    ->only(['index', 'create', 'store', 'show', 'destroy'])
    ->parameters(['inscripciones' => 'inscripcion']);

Route::get('calificaciones/alumnos/{grupoId}', [CalificacionController::class, 'alumnosPorGrupo'])
    ->name('calificaciones.alumnos');

Route::resource('calificaciones', CalificacionController::class)
    ->parameters(['calificaciones' => 'calificacion']);

// Tareas (maestro)
Route::get('tareas/entregas/{entrega}/descargar', [TareaController::class, 'descargarEntrega'])
    ->name('tareas.entregas.descargar');
Route::resource('tareas', TareaController::class)
    ->parameters(['tareas' => 'tarea']);