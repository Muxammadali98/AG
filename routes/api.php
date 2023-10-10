<?php

use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\StatusController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\TaskImageController;
use App\Http\Controllers\Api\TaskLocationController;
use App\Http\Controllers\Api\WorkerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register',[WorkerController::class, 'register']);

Route::post('/login',[WorkerController::class, 'login']);

Route::middleware('auth:api')->group(function(){

    Route::get('/home',[HomeController::class, 'home']);
    Route::post('/addlocation',[TaskLocationController::class, 'addlocation']);
    Route::post('/addimages',[TaskImageController::class, 'addimages']);
    Route::post('/client',[ClientController::class, 'store']);
    Route::get('/worker',[WorkerController::class, 'show']);
    Route::put('/worker/{id}',[WorkerController::class, 'update']);
    Route::get('/task/{id}',[TaskController::class, 'index']);
    Route::get('/status',[StatusController::class, 'index']);
    Route::post('/company',[CompanyController::class, 'store']);
    Route::get('/tasks',[CompanyController::class, 'index']);
    Route::get('/changeTask/{id}',[TaskController::class, 'changeStatus']);

    Route::post('/message',[MessageController::class, 'store']);
    Route::get('/message',[MessageController::class, 'index']);
    Route::delete('/message/{id}',[MessageController::class, 'destroy']);

});

Route::get('/city',[CityController::class, 'index']); 


 