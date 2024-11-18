<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
    return redirect('dashboard');
});

// Route::get('/', function () {
//     Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [HomeController::class, 'adminDashboard'])->name('admin.dashboard');
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user', [HomeController::class, 'userDashboard'])->name('user.dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route::get('/users', [UserController::class, 'index'])->name('users');
    // Route::get('/users/get', [UserController::class, 'getUsers'])->name('users.get');

});

Route::middleware(['auth', 'role:admin'])->controller(UserController::class)->prefix('users')->group(function () {
    Route::get('/', 'index')->name('users.index');
    Route::get('/data', 'getUsers')->name('users.get');
    Route::post('/store', 'store')->name('users.store');
    Route::get('/{id}/edit', 'edit')->name('users.edit');
    Route::post('/{id}/update', 'update')->name('users.update');
    Route::delete('/{id}', 'destroy')->name('users.destroy');
});


require __DIR__ . '/auth.php';
