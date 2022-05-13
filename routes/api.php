<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentAPIController;
use App\Http\Controllers\API\APILoginController;
use App\Http\Controllers\API\APICourseController;

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

//Register student
Route::post('/registerStudent', [StudentAPIController::class, 'registerStudent']);
//Get All Student
Route::get('/getStudents', [StudentAPIController::class, 'getAllStudent']);
//Get Student by ID
Route::get('/getStudent/{id}', [StudentAPIController::class, 'getStudentID']);
//Update Student
Route::put('/updateStudent/{id}', [StudentAPIController::class, 'updateStudent']);
//Delete Student
Route::delete('deleteStudent/{id}', [StudentAPIController::class, 'deleteStudent']);

Route::post('login', [APILoginController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [APILoginController::class, 'logout']);
    Route::prefix('courses')->group(function () {
        Route::get('/', [APICourseController::class, 'index']);
        Route::get('create', [APICourseController::class, 'create']);
        Route::post('/', [APICourseController::class, 'store']);
        Route::get('{id}', [APICourseController::class, 'show']);
        Route::get('{id}/edit', [APICourseController::class, 'edit']);
        Route::patch('{id}', [APICourseController::class, 'update']);
        Route::delete('{id}', [APICourseController::class, 'destroy']);
    });
});
