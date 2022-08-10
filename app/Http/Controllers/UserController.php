<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Department;
use App\Models\Position;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Exception;

class UserController extends Controller
{   
    public $_KEY = 'users';

    public function __construct()
    {
        $this->middleware('auth');
    }
 
    /*
        controller xử lí trang index quản lí tài khoản 
     */
    public function index(Request $request)
    {
        $this->clearSession(0);
        
        $positions = Position::all();
        $departments = Department::all();
        $users = User::search($request);
        
        if ($request->ajax()) {
            $this->saveSearchSession($this->_KEY, $request->all());
            return view('admin.users.pagination_data', compact('users', 'positions', 'departments'));
        }
        return view('admin.users.index', compact('users', 'positions', 'departments'));
    }

    /*
        xử lý chỉnh sửa quyền truy cập của tài khoản
     */
    public function accessRights($id, $admin){
        try {
            User::access($id, $admin);
            return redirect()->route('admin.user')->with('success', 'Sửa quyền truy cập thành công ');
        } catch (Exception $ex) {
            return redirect()->route('admin.user')->with('failed', 'Không thể sửa quyền truy cập !');
        }
    }

    /*
        xử lý hiển thị form tạo tài khoản
     */
    public function create()
    {
        $positions = Position::all();
        $departments = Department::all();
        return view('admin.users.create', compact('positions', 'departments'));
    }

    /*
        hàm xử lý và lưu trữ tài khoản
     */
    public function store(UserStoreRequest $request)
    {
        $input = $request->validated();
        $input = $request->all();
        $user = [
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['pword'])
        ];
        $profile = [
            'gender' => $input['gender'],
            'address' => $input['address'],
            'phone' => $input['phone'],
            'birthday' => $input['birthday'],
            'position' => $input['position'],
            'department' => $input['department'],
            'date_start' => Carbon::now('Asia/Saigon')
        ];

        try {
            User::newUser($user, $profile);
            return redirect()->route('admin.user')->with('success', 'Thêm thành công nhân sự : ' . $input['name']);
        } catch (Exception $ex) {
            return redirect()->route('admin.user')->with('failed', 'Không thêm được nhân sự');
        }
    }

    /*
        xử lý form hiển thị thông tin tài khoản
     */
    public function show($id)
    {
        $positions = Position::all();
        $departments = Department::all();
        try {
            $users = User::getUser($id);
            return view('admin.users.show', compact('users', 'positions', 'departments'));
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    /*
        cập nhật thông tin tài khoản
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $input = $request->validated();

        $input = $request->all();
        $user = [
            'name' => $input['name'],
            'email' => $input['email'],
        ];
        $profile = [
            'gender' => $input['gender'],
            'address' => $input['address'],
            'phone' => $input['phone'],
            'birthday' => $input['birthday'],
            'position' => $input['position'],
            'department' => $input['department']
        ];

        try {
            User::upd($user, $profile, $id);
            return redirect()->route('admin.user')->with('success', 'Sửa thông tin nhân sự: ' . $input['name'] . ' thành công');
        } catch (Exception $ex) {
            return redirect()->route('admin.user')->with('failed', 'Lỗi sửa thông tin nhân sự !');
        }
    }

    /*
        xóa tài khoản : soft delete
     */
    public function destroy($id)
    {
        try {
            User::dlt($id);
            return redirect()->back()->withInput()->with('success', 'Xóa thành công !');
        } catch (Exception $ex) {
            return redirect()->route('admin.user')->with('failed', 'Lỗi !');
        }
    }

    /**
     * danh sách tài khoản đã xóa
     */
    public function quit(Request $request){
        $positions = Position::all();
        $departments = Department::all();
        $users = User::deletedAccount($request);
        
        if ($request->ajax()) {
            $this->saveSearchSession($this->_KEY, $request->all());
            return view('admin.users.quit_page_data', compact('users', 'positions', 'departments'));
        }
        return view('admin.users.quit', compact('users', 'positions', 'departments'));
    }

    /**
     * mở lại tài khoản đã xóa
     */
    public function restore($user_id){
        try{
            User::restoreUser($user_id);
            return redirect()->route('admin.user')->with('success', 'Khôi phục tài khoản thành công !');
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}
