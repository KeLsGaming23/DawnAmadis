<?php

use App\Http\Controllers\ParentController;
use App\Http\Controllers\ParentDashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SchoolYearController;
use App\Http\Controllers\StudentDetailsController;
use App\Http\Controllers\UserPortalController;
use App\Models\SchoolYear;
use App\Models\UserPortal;
use Illuminate\Support\Facades\Route;
use App\Models\User;

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



Route::get('/dashboard', function () {
    $schoolYears = SchoolYear::all();
    return view('dashboard', compact('schoolYears'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/parentdashboard', function () {
    return view('parentdboard');
})->name('parent.dashboard');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// Route::get('/userstable', function () {
//     return view('userstable');
// })->middleware(['auth', 'verified'])->name('userstable');

Route::get('/viewadduser', [UserPortalController::class, 'selectRole'])->middleware(['auth', 'verified'])->name('viewadduser');

Route::post('/add/user', [UserPortalController::class, 'store'])
    ->middleware(['auth', 'verified'])->name('store.user');

Route::get('/userstable', [UserPortalController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('userstable');

Route::post('/school-years', [SchoolYearController::class, 'store'])   
    ->name('school-years.store');

Route::delete('/users/{user}', [UserPortalController::class, 'sDeletes'])
    ->name('users.destroy');

Route::get('/users/{userId}', [UserPortalController::class, 'getUserDetails']);

Route::post('/add-parent-info', [ParentController::class, 'store'])   
    ->name('add-parent-info');

Route::get('/school-years/{schoolYear}', [SchoolYearController::class, 'show'])
    ->name('school-years.show');

Route::delete('/delete/students-information{userId}', [SchoolYearController::class, 'softDelete'])
    ->name('delete-student-information');
Route::get('student/{id}', [StudentDetailsController::class, 'show'])->name('student.show');
Route::get('/parent/dashboard', [ParentDashboardController::class, 'index'])
    ->middleware(['auth', 'role:parent'])
    ->name('parent.dashboard');

require __DIR__.'/auth.php';
