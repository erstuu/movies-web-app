<?php

use App\Http\Controllers\View\DashBoardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\View\HomeController;

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

Route::get('/',[HomeController::class, 'index']);

Route::get('/dashboard', [DashBoardController::class, 'index'])->name('dashboard.index');
Route::get('/dashboard/movie/{id}/edit', [DashBoardController::class, 'edit'])->name('dashboard.movie.edit');
Route::post('/dashboard/movie', [DashBoardController::class, 'insert'])->name('dashboard.movie.insert');
Route::put('/dashboard/movie/{id}', [DashBoardController::class, 'update'])->name('dashboard.movie.update');
Route::delete('/dashboard/movie/{id}', [DashBoardController::class, 'delete'])->name('dashboard.movie.delete');
