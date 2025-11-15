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
use App\Http\Controllers\Admin\AdminStudent;
use App\Http\Controllers\Admin\AdminClassroom;
use App\Http\Controllers\Admin\Dashboard;
use App\Http\Controllers\Admin\AdminSubject;
use App\Http\Controllers\Admin\AdminTeacher;
use App\Http\Controllers\Admin\AdminGuardians;

Route::get('/profile', [ProfilController::class, 'profile']);

Route::get('/kontak', [KontakController::class, 'kontak']);
Route::get('/', [HomeController::class, 'home']);
Route::get('/datasiswa', [StudentController::class, 'index']);
Route::get('/guardians', [GuardiansController::class, 'index']);
Route::get('/classroom', [ClassRoomController::class, 'index']);
Route::get('/subject', [SubjectController::class, 'index']);
Route::get('/teacher', [TeacherController::class, 'index']);

// Admin route
Route::get('/admin', [Dashboard::class, 'index']);
// Hierarki endpoint admin
Route::prefix('admin')->group(function () {
    Route::get('/student', [AdminStudent::class, 'index'])->name('admin.student.index');
    Route::post('/student', [AdminStudent::class, 'store'])->name('admin.student.store');
    Route::put('/student/{id}', [AdminStudent::class, 'update'])->name('admin.student.update');
    Route::delete('/student/{id}', [AdminStudent::class, 'destroy'])->name('admin.student.destroy');

    Route::get('/classroom', [AdminClassroom::class, 'index'])->name('admin.classroom.index');
    Route::post('/classroom', [AdminClassroom::class, 'store'])->name('admin.classroom.store');

    Route::get('/subject', [AdminSubject::class, 'index'])->name('admin.subject.index');
    Route::post('/subject', [AdminSubject::class, 'store'])->name('admin.subject.store');

    Route::get('/teacher', [AdminTeacher::class, 'index'])->name('admin.teacher.index');
    Route::post('/teacher', [AdminTeacher::class, 'store'])->name('admin.teacher.store');
    Route::put('/teacher/{id}', [AdminTeacher::class, 'update'])->name('admin.teacher.update');
    Route::delete('/teacher/{id}', [AdminTeacher::class, 'destroy'])->name('admin.teacher.destroy');
    
    Route::get('/guardians', [AdminGuardians::class, 'index'])->name('admin.guardians.index');
    Route::post('/guardians', [AdminGuardians::class, 'store'])->name('admin.guardians.store');
    Route::put('/guardians/{id}', [AdminGuardians::class, 'update'])->name('admin.guardians.update');
    Route::delete('/guardians/{id}', [AdminGuardians::class, 'destroy'])->name('admin.guardians.destroy');
});