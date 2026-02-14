<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CoursesController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function (){
    // rutas para cursos
    Route::get('curso/select', [CoursesController::class, 'select']);
    Route::post('curso/insert', [CoursesController::class, 'insert']);
    Route::put('curso/update/{id}', [CoursesController::class, 'update']);
    Route::delete('curso/delete/{id}', [CoursesController::class, 'delete']);
    Route::get ('curso/find/{id}', [CoursesController::class, 'find']);
    // rutas para estudiante
    Route::get('student/select', [StudentController::class, 'select']);
    Route::post('student/insert', [StudentController::class, 'insert']);
    Route::put('student/update/{id}', [StudentController::class, 'update']);
    Route::delete('student/delete/{id}', [StudentController::class, 'delete']);
    Route::get ('student/find/{id}', [StudentController::class, 'find']);
    // rutas para inscripcion
});
    // rutas para user
    Route::post('user/register', [UserController::class, 'registrar']);
    Route::post('user/login', [UserController::class, 'login']);
