<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\TaskController;

// Route untuk registrasi dan login
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');

// Route yang membutuhkan autentikasi
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Route untuk task
    Route::get('/tasks', [TaskController::class, 'tasks'])->name('tasks.index');
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store'); // Menambah task
    Route::get('/tasks/{id}', [TaskController::class, 'show'])->name('tasks.show'); // Menampilkan detail task
    Route::get('tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit'); // Form edit task
    Route::put('/tasks/{id}', [TaskController::class, 'update'])->name('tasks.update');

    Route::patch('/tasks/{id}/complete', [TaskController::class, 'complete'])->name('tasks.complete'); // Tandai task selesai
    Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])->name('tasks.destroy'); // Hapus task
    Route::get('/today', [TaskController::class, 'today'])->name('tasks.today');
    Route::get('/tasks/date/{date}', [TaskController::class, 'showByDate'])->name('tasks.date');
});

// Route untuk token csrf
Route::get('/token', function () {
    return csrf_token();
});

// Route utama home
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::post('/tasks/toggle-status/{id}', [App\Http\Controllers\TaskController::class, 'complete'])->name('tasks.toggle-status');
