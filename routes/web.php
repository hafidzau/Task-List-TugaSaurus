<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\TaskController;

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard'); // Perbaikan utama
    Route::get('/tasks', [TaskController::class, 'tasks'])->name('tasks.tasks');
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store'); // Tambah task
    Route::get('/tasks/{id}', [TaskController::class, 'show'])->name('tasks.show'); // Detail task
    Route::put('/tasks/{id}', [TaskController::class, 'update'])->name('tasks.update'); // Update task
    Route::patch('/tasks/{id}/complete', [TaskController::class, 'complete'])->name('tasks.complete');
    Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])->name('tasks.destroy'); // Hapus task
    Route::get('/today', [TaskController::class, 'today'])->name('tasks.today');
    Route::get('/tasks/date/{date}', [TaskController::class, 'showByDate'])->name('tasks.date');

});

Route::get('/token', function () {
    return csrf_token();
});

Route::get('/', [HomeController::class, 'index'])->name('home');
