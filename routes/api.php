<?php

use App\Http\Controllers\Backend\AttendanceController;
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
Route::post('attendance', [AttendanceController::class, 'store'])->name('attendance.store');
Route::post('enroll-controller', [AttendanceController::class, 'enrollController'])->name('attendance.enroll-controller');
Route::post('regis-controller', [AttendanceController::class, 'regisController'])->name('attendance.regis-controller');
