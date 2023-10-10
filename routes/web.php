<?php

use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\FilterController;
use App\Http\Controllers\Admin\GroupController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\StatusController;
use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\Admin\WorkerController;
use App\Http\Controllers\Admin\ChatController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\MessageController;
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

Route::get('/', [\App\Http\Controllers\StatisticController::class,'index'])->middleware(['auth', 'verified'])->middleware(['auth', 'verified']);

Route::get('/dashboard',[\App\Http\Controllers\StatisticController::class,'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/download-pdf', [\App\Http\Controllers\StatisticController::class, 'generatePDF']);
    Route::get('/download-pdf/{id}', [\App\Http\Controllers\StatisticController::class, 'generatePDF']);


    Route::resource('/group',GroupController::class);
    Route::resource('/worker',WorkerController::class);
    Route::resource('/city', CityController::class);
    Route::resource('/company', CompanyController::class);
    Route::resource('/task',TaskController::class);
    Route::resource('/client',ClientController::class);
    Route::resource('/status',StatusController::class);
    Route::get('/filterTask',[FilterController::class, 'filtertask'])->name('filterTask');
    Route::get('/chat',[ChatController::class, 'index'])->name('chat');
    Route::get('/messages/{id}',[MessageController::class, 'index'])->name('messages');
    Route::post('/messages',[MessageController::class, 'store']);
    Route::get('/filterClient',[FilterController::class, 'filterClient'])->name('filterClient');
    Route::resource('/notification',NotificationController::class);
    Route::get('/notifigroup',[NotificationController::class, 'createGroup'])->name('createGroup');
    Route::post('/notifigroup',[NotificationController::class, 'storeGroup'])->name('storeGroup');
    Route::get('/moderation',[WorkerController::class, 'moderation']);
    Route::get('/statistic',[\App\Http\Controllers\StatisticController::class,'index']);
    Route::get('/statistic/{id}',[\App\Http\Controllers\StatisticController::class,'index']);
});


require __DIR__.'/auth.php';
