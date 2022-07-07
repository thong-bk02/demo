<?php

use App\Http\Controllers\DepartmentController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\PowerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RewardAndDisciplineController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\TimekeepingController;
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
Route::post('/admin/users/show/{id}', [UserController::class, 'update'])->name('admin.user.update');
Route::get('/admin/users/create', [UserController::class, 'create'])->name('admin.user.create');
Route::post('/admin/users/create', [UserController::class, 'store'])->name('admin.users.store');
// Route::post('/admin/users/search/name', [UserController::class, 'searchAjax'])->name('admin.users.searchAjax');
Route::get('/admin/users/delete/{id}', [UserController::class, 'destroy'])->name('admin.user.delete');

//quản lí chức vụ
Route::get('/admin/position', [PositionController::class, 'index'])->name('admin.position');
Route::post('/admin/position/update/{id}', [PositionController::class, 'update'])->name('admin.position.update');
Route::post('/admin/position/create', [PositionController::class, 'store'])->name('admin.position.store');
Route::get('/admin/position/delete/{id}', [PositionController::class, 'destroy'])->name('admin.position.delete');

//quản lí phòng ban
Route::get('/admin/department', [DepartmentController::class, 'index'])->name('admin.department');
Route::post('/admin/department/update/{id}', [DepartmentController::class, 'update'])->name('admin.department.update');
Route::post('/admin/department/create', [DepartmentController::class, 'store'])->name('admin.department.store');
Route::get('/admin/department/delete/{id}', [DepartmentController::class, 'destroy'])->name('admin.department.delete');

//quản lí quyền
Route::get('/admin/access-rights', [PowerController::class, 'index'])->name('admin.access-rights');
Route::get('/admin/access-rights/show/{id}', [PowerController::class, 'show'])->name('admin.access-rights.show');
Route::post('/admin/access-rights/update/{id}', [PowerController::class, 'update'])->name('admin.access-rights.update');
Route::get('/admin/access-rights/create', [PowerController::class, 'create'])->name('admin.access-rights.create');

//quản lí chấm công
Route::get('/admin/timekeeping', [TimekeepingController::class, 'index'])->name('admin.timekeeping');
Route::get('/admin/timekeeping/show/{id}', [TimekeepingController::class, 'show'])->name('admin.timekeeping.show');
Route::post('/admin/timekeeping/update/{id}', [TimekeepingController::class, 'update'])->name('admin.timekeeping.update');
Route::get('/admin/timekeeping/create', [TimekeepingController::class, 'create'])->name('admin.timekeeping.create');

//quản lí thưởng phạt
Route::get('/admin/reward-discipline', [RewardAndDisciplineController::class, 'index'])->name('admin.reward-discipline');
Route::get('/admin/reward-discipline/show/{id}', [RewardAndDisciplineController::class, 'show'])->name('admin.reward-discipline.show');
Route::post('/admin/reward-discipline/update/{id}', [RewardAndDisciplineController::class, 'update'])->name('admin.reward-discipline.update');
Route::get('/admin/reward-discipline/create', [RewardAndDisciplineController::class, 'create'])->name('admin.reward-discipline.create');

//quản lí lương
Route::get('/admin/salary', [SalaryController::class, 'index'])->name('admin.salary');
Route::get('/admin/salary/show/{id}', [SalaryController::class, 'show'])->name('admin.salary.show');
Route::post('/admin/salary/update/{id}', [SalaryController::class, 'update'])->name('admin.salary.update');
Route::get('/admin/salary/create', [SalaryController::class, 'create'])->name('admin.salary.create');

//thông tin cá nhân
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
