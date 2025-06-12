<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;

use App\Http\Controllers\User\EnrollmentController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard')->middleware(['auth']);


Route::middleware(['auth'])->group(function () {

    // مسیرهای فقط ادمین
    Route::middleware(['admin'])->prefix('admin')->group(function () {
        Route::resource('courses', CourseController::class); // CRUD دوره‌ها
    });

    // مسیرهای کاربران عادی (user)
    Route::get('/courses', [EnrollmentController::class, 'index'])->name('courses.index');
    Route::post('/courses/{course}/enroll', [EnrollmentController::class, 'enroll'])->name('courses.enroll');
    Route::get('/my-courses', [EnrollmentController::class, 'myCourses'])->name('courses.my');
});

require __DIR__.'/auth.php';
