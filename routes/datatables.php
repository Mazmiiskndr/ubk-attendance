<?php

use App\Livewire\Backend\{
    Setting\Datatables as SettingDatatables,
    Setting\KelasDatatables as KelasDatatables,
    Student\Datatables as UserDatatables,
    Course\Datatables as CourseDatatables,
    Course\ScheduleDatatables as ScheduleDatatables,
};
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Datatables Routes
|--------------------------------------------------------------------------
|
| Here is where you can register datatable routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "datatable" middleware group. Make something great!
|
*/

// Grouping datatable routes
Route::prefix('livewire/backend/')->group(function () {
    // Route for list what i dos page
    Route::get('setting/getDatatable', [SettingDatatables::class, 'getDatatable'])
        ->name('setting.getDatatable');
    Route::get('kelas/getDatatable', [KelasDatatables::class, 'getDatatable'])
        ->name('kelas.getDatatable');
    Route::get('student/getDatatable', [UserDatatables::class, 'getDatatable'])
        ->name('student.getDatatable');
    Route::get('course/getDatatable', [CourseDatatables::class, 'getDatatable'])
        ->name('course.getDatatable');
    Route::get('course-schedules/getDatatable/{courseId?}', [ScheduleDatatables::class, 'getDatatable'])
        ->name('course-schedules.getDatatable');
});
