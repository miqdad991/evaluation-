<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PositionController;
use App\Http\Controllers\Admin\PositionKPIController;
use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SprintController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\LoginController;
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

Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::middleware('auth:admin')->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/dashboard/user-tasks', [DashboardController::class, 'userTasks'])->name('dashboard.user_tasks');

        Route::resource('sprints', SprintController::class);
        Route::resource('positions', PositionController::class);
        Route::resource('positions.kpis', PositionKPIController::class)->except(['edit', 'show']);

        // ✅ ✅ Make sure this is INSIDE the 'auth:admin' middleware group
        Route::get('positions/{position}/kpis/edit', [PositionKPIController::class, 'edit']);
        Route::resource('users', UserController::class);
        Route::get('tasks/pending', [TaskController::class, 'pendingTasks'])->name('tasks.pending');
        Route::resource('tasks', TaskController::class);
    });
});


Route::middleware('auth:web')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\User\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/user/new-task', [\App\Http\Controllers\User\TaskController::class, 'create'])->name('user.tasks.create');
    Route::post('/user/new-task', [\App\Http\Controllers\User\TaskController::class, 'store'])->name('user.tasks.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
