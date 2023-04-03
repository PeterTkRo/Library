<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\Library;
use App\Http\Controllers\Users;
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
Route::get('/login', [Auth::class, 'index'])->name('SignPage');
Route::post('/login', [Auth::class, 'login'])->name('login');
Route::post('/register', [Auth::class, 'register'])->name('register');
Route::middleware('auth')->group(function () {
    Route::get('/logout', [Auth::class, 'logout'])->name('logout');
    Route::get('/', [Dashboard::class, 'index'])->name('mainPage');
    Route::prefix('/library')->group(function (){
        Route::get('/', [Library::class, 'index'])->name('library');
        Route::get('/create', [Library::class, 'create'])->name('createBook');
        Route::get('/{book}', [Library::class, 'show'])->name('viewBook');
        Route::get('/{book}/edit', [Library::class, 'edit'])->name('editBook');
        Route::post('/update/{book?}', [Library::class, 'save'])->name('saveBook');
        Route::get('/{book}/delete', [Library::class, 'delete'])->name('deleteBook');
    });
    Route::prefix('/admin')->middleware('auth.admin')->group(function (){
        Route::get('/users', [Users::class, 'index'])->name('admin.users');
        Route::get('/user/{user}/delete', [Users::class, 'delete'])->name('admin.user.delete');
    });
});

Route::get('/welcome', function () {
    return view('welcome');
});
