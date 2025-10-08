<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\GuardiansController;
use App\Http\Controllers\GetData;
use App\Http\Controllers\ClassRoomController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', function () {
//     return "<h1>Hello from laravel</h1>";
// });
// Route::get('/profile', function () {
//     return view('profile');
// });
// Route::get('/profile2', [ProfilController::class, 'index']);

Route::get('/profile', [ProfilController::class, 'profile']);

Route::get('/kontak', [KontakController::class, 'kontak']);
Route::get('/', [HomeController::class, 'home']);
Route::get('/datasiswa', [StudentController::class, 'index']);
Route::get('/guardians', [GuardiansController::class, 'index']);
Route::get('/classroom', [ClassRoomController::class, 'index']);
Route::get('/subject', [SubjectController::class, 'index']);
Route::get('/teacher', [TeacherController::class, 'index']);