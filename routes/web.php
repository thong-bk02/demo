<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Auth::routes(['register' => false]);

Route::get('/home', [HomeController::class, 'index'])->name('home');

//quản lí tài khoản
Route::get('/admin/users', [UserController::class, 'index'])->name('admin.user');
Route::get('/admin/users/show/{id}', [UserController::class, 'show'])->name('admin.user.show');
Route::post('/admin/users/update/{id}', [UserController::class, 'update'])->name('admin.user.update');

