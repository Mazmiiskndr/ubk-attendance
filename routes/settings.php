<?php

use App\Http\Controllers\{
    Backend\SettingController,
};
use Illuminate\Support\Facades\Route;


/*
| Here is where you can register portfolio routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "portfolio" middleware group. Make something great!
|
*/

// Grouping portfolios routes
Route::middleware('auth')->name('backend.')->group(function () {
    // Route for list portfolios page
    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::get('settings/kelas', [SettingController::class, 'kelas'])->name('kelas.index');
});
