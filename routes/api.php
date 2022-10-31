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


Route::controller(AuthController::class)->group(function () {
    Route::post('/login',  'login');

    Route::prefix('register')->group(function () {
        Route::post('/', 'register');
        Route::post('/student', 'register_student');
        Route::post('/teacher', 'register_teacher');
    });
});


Route::middleware('auth:sanctum')->group(function () {

    // Check Users
    Route::controller(AuthController::class)->group(function () {
        Route::get('/user', 'user');
        Route::post('/logout', 'logout');
    });


    // student
    Route::controller(StudentController::class)
        ->prefix('students')
        ->group(function () {
            Route::get('/', 'students');
            Route::post('/', 'store');
            Route::delete('/{id}', 'delete');
        });

    // teacher
    Route::controller(TeacherController::class)->group(function () {
        Route::prefix('teachers')->group(function () {
            Route::get('/', 'teachers');
            Route::post('/', 'store');
            Route::delete('/{id}', 'delete');
            Route::post('/add_subject', 'add_subject');
            Route::post('/remove_subject', 'remove_subject');
        });

        Route::prefix('teacher')->group(function () {
            Route::get('/{id}', 'teacher');
            Route::get('/{teacher}/subjects', 'subjects');
            Route::get('/{teacher}/topics', 'topics');
            Route::get('/{id}/grade_levels', 'grade_levels');
            Route::get('/{id}/students', 'students');
        });
    });

    // subjects
    Route::controller(SubjectController::class)
        ->prefix('subjects')
        ->group(function () {
            Route::get('/', 'subjects');
            Route::get('/{subject}', 'show');
            Route::get('/{subject}/topics', 'topics');
            Route::post('/', 'store');
            Route::delete('/{id}', 'delete');
        });


    // grade levels
    Route::controller(GradeLevelController::class)
        ->prefix('grade_levels')
        ->group(function () {
            Route::get('/', 'grade_levels');
            Route::get('/{id}', 'grade_level');
            Route::get('/{id}/students', 'students');
            Route::get('/{id}/subjects', 'subjects');
            Route::get('/{grade_level}/topics', 'topics');
            Route::post('/{grade_level}/topics', 'add_topic');
            Route::delete('/{grade_level}/topics', 'remove_topic');
            Route::post('/', 'store');
            Route::delete('/{id}', 'delete');
            Route::post('/add_students', 'add_students');
            Route::post('/remove_students', 'remove_students');
            Route::post('/add_subject', 'add_subject');
            Route::post('/remove_subject', 'remove_subject');
        });


    // subject_teacher
    Route::controller(SubjectTeacherController::class)->prefix('subject_teacher')->group(function () {
        Route::get('/',  'subject_teacher');
    });

    // topics
    Route::resource('topics', TopicController::class);
});
