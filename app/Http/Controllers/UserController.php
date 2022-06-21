<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Position;
use App\Models\Power;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::getAll();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $powers = Power::all();
        $positions = Position::all();
        $departments = Department::all();
        return view('admin.users.show', compact('users', 'powers','positions','departments'));
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
            'power' => $input['power'],
            'status' => $input['status']
        ];
        $profile = [
            'user_code' => $input['user_code'],
            'address' => $input['address'],
            'phone' => $input['phone'],
            'birthday' => $input['birthday'],
            'position' => $input['position'],
            'department' => $input['department']
        ];

        if ( User::upd($user, $profile, $id) == true) {
            return redirect()->route('admin.user')->with('success', 'Sửa thành công !');
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
        //
    }
}
