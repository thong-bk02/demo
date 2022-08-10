<?php

use App\Http\Controllers\BasicSalaryController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\PowerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReasionController;
use App\Http\Controllers\RewardAndDisciplineController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\StaffController;
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

Route::get('/', [HomeController::class, 'main'])->name('main');

Auth::routes();
Auth::routes(['register' => false]);
Route::group(['middleware' => 'admin'], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    //quản lí tài khoản
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.user');
    Route::get('/admin/users/show/{id}', [UserController::class, 'show'])->name('admin.user.show');
    Route::post('/admin/users/show/{id}', [UserController::class, 'update'])->name('admin.user.update');
    Route::get('/admin/users/create', [UserController::class, 'create'])->name('admin.user.create');
    Route::post('/admin/users/create', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('/admin/users/delete/{id}', [UserController::class, 'destroy'])->name('admin.user.delete');
    Route::get('/admin/users/access-right/{id}/{admin}', [UserController::class, 'accessRights'])->name('admin.access-rights');
    Route::get('/admin/users/quit', [UserController::class, 'quit'])->name('admin.user.quit');
    Route::get('/admin/users/{id}/restore', [UserController::class, 'restore'])->name('admin.user.restore');

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

    //quản lí chấm công
    Route::get('/admin/timekeeping', [TimekeepingController::class, 'index'])->name('admin.timekeeping');
    Route::get('/admin/timekeeping/show/{code}', [TimekeepingController::class, 'show'])->name('admin.timekeeping.show');
    Route::post('/admin/timekeeping/update/{id}', [TimekeepingController::class, 'update'])->name('admin.timekeeping.update');
    Route::get('/admin/timekeeping/{id}/create', [TimekeepingController::class, 'create'])->name('admin.timekeeping.create');
    Route::post('/admin/timekeeping/{id}/create', [TimekeepingController::class, 'store'])->name('admin.timekeeping.store');
    Route::get('/admin/timekeeping/list-users', [TimekeepingController::class, 'list'])->name('admin.timekeeping.list');
    Route::controller(TimekeepingController::class)->group(function () {
        Route::get('/admin/timekeeping-export', 'export')->name('admin.timekeeping.export');
        Route::get('/admin/timekeeping-exportOne/{id}', 'exportOne')->name('admin.timekeeping.exportOne');
        Route::post('/admin/timekeeping-import', 'import')->name('admin.timekeeping.import');
    });
    Route::get('/admin/timekeeping/delete/{id}', [TimekeepingController::class, 'destroy'])->name('admin.timekeeping.delete');

    //quản lí thưởng phạt
    Route::get('/admin/reward-discipline', [RewardAndDisciplineController::class, 'index'])->name('admin.reward-discipline');
    Route::get('/admin/reward-discipline/show/{id}', [RewardAndDisciplineController::class, 'show'])->name('admin.reward-discipline.show');
    Route::post('/admin/reward-discipline/update/{id}', [RewardAndDisciplineController::class, 'update'])->name('admin.reward-discipline.update');
    Route::get('/admin/reward-discipline/{id}/create', [RewardAndDisciplineController::class, 'create'])->name('admin.reward-discipline.create');
    Route::post('/admin/reward-discipline/{id}/create', [RewardAndDisciplineController::class, 'store'])->name('admin.reward-discipline.store');
    Route::get('/admin/reward-discipline/list-users', [RewardAndDisciplineController::class, 'list'])->name('admin.reward-discipline.list');
    Route::get('/admin/reward-discipline/delete/{id}', [RewardAndDisciplineController::class, 'destroy'])->name('admin.reward-discipline.delete');

    // quản lí lý do thưởng phạt
    Route::get('/admin/reward-discipline/reasion', [ReasionController::class, 'index'])->name('admin.reasion');

    //quản lí lương
    Route::get('/admin/salary', [SalaryController::class, 'index'])->name('admin.salary');
    Route::get('/admin/salary/create/money', [SalaryController::class, 'demo'])->name('admin.salary.money');
    Route::get('/admin/salary/show/{id}', [SalaryController::class, 'show'])->name('admin.salary.show');
    Route::post('/admin/salary/update/{id}', [SalaryController::class, 'update'])->name('admin.salary.update');
    Route::get('/admin/salary/list-users', [SalaryController::class, 'listUser'])->name('admin.salary.list');
    Route::get('/admin/salary/{id}/create', [SalaryController::class, 'create'])->name('admin.salary.create');
    Route::post('/admin/salary/{id}/create', [SalaryController::class, 'store'])->name('admin.salary.store');
    Route::get('/admin/salary/delete/{id}', [SalaryController::class, 'destroy'])->name('admin.salary.delete');
    Route::get('/admin/salary/dataSlary', [SalaryController::class, 'month'])->name('admin.salary.dataSlary');
    Route::controller(SalaryController::class)->group(function () {
        Route::get('/admin/salary-export', 'export')->name('admin.salary.export');
        Route::get('/admin/salary-exportOne/{id}', 'exportOne')->name('admin.salary.exportOne');
        Route::post('/admin/salary-import', 'import')->name('admin.salary.import');
    });

    //quản lí lương cơ bản
    Route::get('/admin/salary/basic-salary', [BasicSalaryController::class, 'index'])->name('admin.basic-salary');

    //quản lí sự kiện
    Route::get('admin/event', [EventController::class, 'index'])->name('admin.event');
    Route::post('admin/event/create', [EventController::class, 'store'])->name('admin.event.create');
    Route::get('admin/event/delete/{id}', [EventController::class, 'destroy'])->name('admin.event.delete');
    Route::post('admin/event/update/{id}', [EventController::class, 'update'])->name('admin.event.update');
});


//thông tin cá nhân
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::get('/change-password', [ProfileController::class, 'changePassword'])->name('change-password');
Route::post('/change-password', [ProfileController::class, 'updatePassword'])->name('update-password');

// danh sách nhân sự
Route::get('/users', [StaffController::class, 'users'])->name('users');
Route::get('/position-department', [StaffController::class, 'position_department'])->name('position-department');
Route::get('/timekeeping', [StaffController::class, 'timekeeping'])->name('timekeeping');
Route::get('/reward-and-discipline', [StaffController::class, 'reward_discipline'])->name('reward.discipline');
Route::get('/salary', [StaffController::class, 'salary'])->name('salary');
Route::get('/event', [StaffController::class, 'event'])->name('event');
Route::get('/rules-and-regulations', [StaffController::class, 'rules'])->name('rules');
