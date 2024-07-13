<?php

use App\Http\Controllers\{
    Backend\CourseController,
};
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Portfolios Routes
|--------------------------------------------------------------------------
|
| Here is where you can register portfolio routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "portfolio" middleware group. Make something great!
|
*/

// Grouping portfolios routes
Route::middleware('auth')->name('backend.')->group(function () {
    // Route for list portfolios page
    Route::get('courses', [CourseController::class, 'index'])->name('courses.index');
});
