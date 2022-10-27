<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\GradeLevelController;
use App\Http\Controllers\SubjectTeacherController;
use App\Http\Controllers\TopicController;

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
Route::post('/register/student', [AuthController::class, 'register_student']);
Route::post('/register/teacher', [AuthController::class, 'register_teacher']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    // Check Users
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // student
    Route::get('/students', [StudentController::class, 'students']);
    Route::post('/students', [StudentController::class, 'store']);
    Route::delete('/students/{id}', [StudentController::class, 'delete']);

    // teacher
    Route::get('/teachers', [TeacherController::class, 'teachers']);
    Route::get('/teacher/{id}', [TeacherController::class, 'teacher']);
    Route::get('/teacher/{teacher}/subjects', [TeacherController::class, 'subjects']);
    Route::get('/teacher/{id}/grade_levels', [TeacherController::class, 'grade_levels']);
    Route::get('/teacher/{id}/students', [TeacherController::class, 'students']);
    Route::post('/teachers', [TeacherController::class, 'store']);
    Route::delete('/teachers/{id}', [TeacherController::class, 'delete']);
    Route::post('/teachers/add_subject', [TeacherController::class, 'add_subject']);
    Route::post('/teachers/remove_subject', [TeacherController::class, 'remove_subject']);

    // subjects
    Route::get('/subjects', [SubjectController::class, 'subjects']);
    Route::post('/subjects', [SubjectController::class, 'store']);
    Route::delete('/subjects/{id}', [SubjectController::class, 'delete']);

    // grade levels
    Route::get('/grade_levels', [GradeLevelController::class, 'grade_levels']);
    Route::get('/grade_levels/{id}', [GradeLevelController::class, 'grade_level']);
    Route::get('/grade_levels/{id}/students', [GradeLevelController::class, 'students']);
    Route::get('/grade_levels/{id}/subjects', [GradeLevelController::class, 'subjects']);
    Route::post('/grade_levels', [GradeLevelController::class, 'store']);
    Route::delete('/grade_levels/{id}', [GradeLevelController::class, 'delete']);
    Route::post('/grade_levels/add_students', [GradeLevelController::class, 'add_students']);
    Route::post('/grade_levels/remove_students', [GradeLevelController::class, 'remove_students']);
    Route::post('/grade_levels/add_subject', [GradeLevelController::class, 'add_subject']);
    Route::post('/grade_levels/remove_subject', [GradeLevelController::class, 'remove_subject']);

    // subject_teacher
    Route::get('/subject_teacher', [SubjectTeacherController::class, 'subject_teacher']);

    // topics
    Route::resource('topics', TopicController::class);
});
