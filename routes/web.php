<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/tu', [App\Http\Controllers\TuController::class, 'index'])->name('tus');
Route::post('/tu/store', [App\Http\Controllers\TuController::class, 'store'])->name('tu-store');
Route::get('/tu/all', [App\Http\Controllers\TuController::class, 'all'])->name('tu-all');
Route::get('/tu/edit', [App\Http\Controllers\TuController::class, 'edit'])->name('tu-edit');
Route::post('/tu/update', [App\Http\Controllers\TuController::class, 'update'])->name('tu-update');
Route::delete('/tu/delete', [App\Http\Controllers\TuController::class, 'delete'])->name('tu-delete');

//guru
Route::get('/guru', [App\Http\Controllers\GuruController::class, 'index'])->name('gurus');
Route::post('/guru/store', [App\Http\Controllers\GuruController::class, 'store'])->name('guru-store');
Route::get('/guru/all', [App\Http\Controllers\GuruController::class, 'all'])->name('guru-all');
Route::get('/guru/edit', [App\Http\Controllers\GuruController::class, 'edit'])->name('guru-edit');
Route::post('/guru/update', [App\Http\Controllers\GuruController::class, 'update'])->name('guru-update');
Route::delete('/guru/delete', [App\Http\Controllers\GuruController::class, 'delete'])->name('guru-delete');

Route::get('/login', [App\Http\Controllers\Auth\GuruAuthController::class, 'login'])->name('admin.login');
Route::post('/login', [App\Http\Controllers\Auth\GuruAuthController::class, 'postLogin']);
Route::get('logout', [App\Http\Controllers\Auth\GuruAuthController::class, 'logout'])->name('logout');

