<?php

use App\Http\Controllers\DepartmentController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\PowerController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskListController;
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
Route::post('/admin/users/update/{id}', [UserController::class, 'update'])->name('admin.user.update');
Route::get('/admin/users/create', [UserController::class, 'create'])->name('admin.user.create');

//quản lí chức vụ
Route::get('/admin/position', [PositionController::class, 'index'])->name('admin.position');
Route::post('/admin/position/update/{id}', [PositionController::class, 'update'])->name('admin.position.update');
Route::get('/admin/position/create', [PositionController::class, 'create'])->name('admin.position.create');

//quản lí phòng ban
Route::get('/admin/department', [DepartmentController::class, 'index'])->name('admin.department');
Route::post('/admin/department/update/{id}', [DepartmentController::class, 'update'])->name('admin.department.update');
Route::get('/admin/department/create', [DepartmentController::class, 'create'])->name('admin.department.create');

//quản lí quyền
Route::get('/admin/access-rights', [PowerController::class, 'index'])->name('admin.access-rights');
Route::get('/admin/access-rights/show/{id}', [PowerController::class, 'show'])->name('admin.access-rights.show');
Route::post('/admin/access-rights/update/{id}', [PowerController::class, 'update'])->name('admin.access-rights.update');
Route::get('/admin/access-rights/create', [PowerController::class, 'create'])->name('admin.access-rights.create');

//quản lí dự án
Route::get('/admin/projects', [ProjectController::class, 'index'])->name('admin.projects');
Route::get('/admin/projects/show/{id}', [ProjectController::class, 'show'])->name('admin.projects.show');
Route::post('/admin/projects/update/{id}', [ProjectController::class, 'update'])->name('admin.projects.update');
Route::get('/admin/projects/create', [ProjectController::class, 'create'])->name('admin.projects.create');

//quản lí công việc
Route::get('/admin/task-lists', [TaskListController::class, 'index'])->name('admin.task-lists');
Route::get('/admin/task-lists/show/{id}', [TaskListController::class, 'show'])->name('admin.task-lists.show');
Route::post('/admin/task-lists/update/{id}', [TaskListController::class, 'update'])->name('admin.task-lists.update');
Route::get('/admin/task-lists/create', [TaskListController::class, 'create'])->name('admin.task-lists.create');

//quản lí chấm công
Route::get('/admin/timekeeping', [TimekeepingController::class, 'index'])->name('admin.timekeeping');
Route::get('/admin/timekeeping/show/{id}', [TimekeepingController::class, 'show'])->name('admin.timekeeping.show');
Route::post('/admin/timekeeping/update/{id}', [TimekeepingController::class, 'update'])->name('admin.timekeeping.update');
Route::get('/admin/timekeeping/create', [TimekeepingController::class, 'create'])->name('admin.timekeeping.create');