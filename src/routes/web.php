<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WeightLogController;
use App\Http\Controllers\WeightTargetController;
use App\Http\Requests\GoalSettingRequest;

Route::get('/register/step1', [AuthController::class, 'showRegisterStep1'])->name('register.step1');
Route::post('/register/step1', [AuthController::class, 'registerStep1'])->name('register.step1.post');

Route::get('/register/step2', [AuthController::class, 'showRegisterStep2'])->name('register.step2');
Route::post('/register/step2', [AuthController::class, 'registerStep2'])->name('register.step2.post');

Route::middleware('auth')->group(function () {
Route::get('/weight_logs', [WeightLogController::class, 'index'])->middleware('auth');
});

Route::get('/weight_logs/create', [WeightLogController::class, 'create'])->middleware('auth');
Route::post('/weight_logs/create', [WeightLogController::class, 'store'])->middleware('auth');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth');

Route::match(['get', 'post'], '/weight_logs/goal_setting', [WeightLogController::class, 'goalSetting'])->middleware('auth');

Route::get('/weight_logs/search', [WeightLogController::class, 'search'])->middleware('auth');

Route::get('/weight_logs/{id}', [WeightLogController::class, 'show'])->middleware('auth');
Route::put('/weight_logs/{id}/update', [WeightLogController::class, 'update'])->middleware('auth');

Route::delete('/weight_logs/{id}/delete', [WeightLogController::class, 'destroy'])->middleware('auth');

Route::get('/weight_logs/goal_setting', [WeightLogController::class, 'showGoalSetting'])->middleware('auth');
Route::post('/weight_logs/goal_setting', [WeightLogController::class, 'updateGoalSetting'])->middleware('auth');
