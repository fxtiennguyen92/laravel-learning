<?php

use App\Http\Controllers\SkillController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/project', [ProjectController::class,'store']);
Route::post('/project', [ProjectController::class,'create']);
Route::get('/projects', [ProjectController::class,'all']);
Route::get('/projects/{id}', [ProjectController::class,'edit']);
Route::post('/project/{id}', [ProjectController::class,'update']);
Route::delete('/project/{id}', [ProjectController::class,'delete']);


