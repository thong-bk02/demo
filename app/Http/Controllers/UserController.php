<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequest;
use App\Models\Department;
use App\Models\Position;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(request());
        
        $positions = Position::all();
        $departments = Department::all();

        $request = request()->all();
        $name = request()->name;
        $position = request()->position;
        $department = request()->department;

        $users = User::search($name, $position, $department);
        return view('admin.users.index', compact('users', 'positions', 'departments', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $positions = Position::all();
        $departments = Department::all();
        return view('admin.users.create', compact('positions', 'departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $input = $request->validated();
        $input = $request->all();
        $user = [
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['pword'])
        ];
        $profile = [
            'user_id' => null,
            'user_code' => null,
            'address' => $input['address'],
            'phone' => $input['phone'],
            'birthday' => $input['birthday'], 
            'position' => $input['position'],
            'department' => $input['department'],
            'date_start' => Carbon::now('Asia/Saigon')
        ];

        if (User::newUser($user, $profile) == true) {
            return redirect()->route('admin.user')->with('success', 'Thêm nhân sự ' . $input['name'] . ' thành công ');
        } else {
            return redirect()->route('admin.user')->with('failed', 'Không thêm được nhân sự');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $users = User::getUser($id);
        $positions = Position::all();
        $departments = Department::all();
        return view('admin.users.show', compact('users', 'positions', 'departments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $input = $request->all();
        $user = [
            'name' => $input['name'],
            'email' => $input['email'],
            'status' => $input['status']
        ];
        $profile = [
            // 'user_code' => $input['user_code'],
            'address' => $input['address'],
            'phone' => $input['phone'],
            'birthday' => $input['birthday'],
            'position' => $input['position'],
            'department' => $input['department']
        ];

        if (User::upd($user, $profile, $id) == true) {
            return redirect()->route('admin.user')->with('success', 'Sửa thành công nhân sự: ' . $input['name']);
        } else {
            return redirect()->route('admin.user')->with('failed', 'Lỗi sửa thông tin nhân viên !');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::dlt($id);
        return redirect()->route('admin.user')->with('success', 'Xóa thành công !');
    }

    public function searchAjax(Request $request)
    {
        if ($request->get('query')) {
            $query = $request->get('query');
            $data = DB::table('users')
                ->where('name', 'LIKE', "%{$query}%")
                ->select('users.name')
                ->distinct()
                ->get();
            $output = '<div class="dropdown-menu" style="display:block; position: relative;">';
            foreach ($data as $row) {
                $output .= '<a class="dropdown-item" style="cursor: pointer;">' . $row->name. '</a>';
            }
            $output .= '</ul>';
            echo $output;
        }
    }
}
