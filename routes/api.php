<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\GradeLevelController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function(){
    // Check Users
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // student
    Route::get('/students',[StudentController::class, 'students']);
    Route::post('/students',[StudentController::class, 'store']);
    Route::delete('/students/{id}',[StudentController::class, 'delete']);

    // teacher
    Route::get('/teachers',[TeacherController::class, 'teachers']);
    Route::post('/teachers',[TeacherController::class, 'store']);
    Route::delete('/teachers/{id}',[TeacherController::class, 'delete']);

    // subjects
    Route::get('/subjects',[SubjectController::class, 'subjects']);
    Route::post('/subjects',[SubjectController::class, 'store']);
    Route::delete('/subjects/{id}',[SubjectController::class, 'delete']);

    // grade levels
    Route::get('/grade_levels', [GradeLevelController::class, 'grade_levels']);
    Route::post('/grade_levels', [GradeLevelController::class, 'store']);
    Route::delete('/grade_levels/{id}', [GradeLevelController::class, 'delete']);
});