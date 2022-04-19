<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LopHocController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;

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

Route::get('/', [LoginController::class, 'showViewLogin'])->name('login');
Route::get('/register', [UserController::class, 'showFormRegister'])->name('register');
Route::post('/logined', [LoginController::class, 'login'])->name('logined');
Route::post('/registered', [UserController::class, 'register'])->name('registered');

Route::middleware('auth')->group(function () {
    Route::prefix('/user')->group(function () {
        Route::get('/', [UserController::class, 'showListUser'])->name('user.listUser');
        Route::get('/create', [UserController::class, 'create'])->name('user.create');
        Route::get('/{id}/editUser', [UserController::class, 'edit'])->name('user.edit');
        Route::post('/{id}/updateUser', [UserController::class, 'update'])->name('user.update');
        Route::get('/{id}/destroy', [UserController::class, 'delete'])->name('user.delete');
        Route::get('/search', [UserController::class, 'search'])->name('user.search');
    });

    Route::prefix('/student')->group(function () {
        Route::get('/', [StudentController::class, 'index'])->name('student.index');
        Route::get('/create', [StudentController::class, 'create'])->name('student.create');
        Route::post('/store', [StudentController::class, 'store'])->name('student.store');
        Route::get('/{id}/edit', [StudentController::class, 'edit'])->name('student.edit');
        Route::post('/{id}/update', [StudentController::class, 'update'])->name('student.update');
        Route::get('/{id}/destroy', [StudentController::class, 'delete'])->name('student.delete');
        Route::get('/search',[StudentController::class,'showViewSearch'])->name('student.viewSearch');
        Route::get('/result', [StudentController::class, 'resultSearch'])->name('student.result');
    });

    Route::prefix('/lophoc')->group(function () {
        Route::get('/', [LopHocController::class, 'index'])->name('lophoc.index');
        Route::get('/create', [LopHocController::class, 'create'])->name('lophoc.create');
        Route::get('/{id}/edit', [LopHocController::class, 'edit'])->name('lophoc.edit');
        Route::post('/{id}/update', [LopHocController::class, 'update'])->name('lophoc.update');
        Route::post('/store', [LopHocController::class, 'store'])->name('lophoc.store');
        Route::get('/{id}/destroy', [LopHocController::class, 'delete'])->name('lophoc.delete');
        Route::get('/search', [LopHocController::class, 'search'])->name('lophoc.search');
        Route::get('/{id}/detail', [LopHocController::class, 'detail'])->name('lophoc.detail');
    });


    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
});
