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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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
            'address' => $input['address'],
            'phone' => $input['phone'],
            'birthday' => $input['birthday'],
            'position' => $input['position'],
            'department' => $input['department'],
            'date_start' => Carbon::now('Asia/Saigon')
        ];

        try {
            User::newUser($user, $profile);
            return redirect()->route('admin.user')->with('success', 'Th??m nh??n s??? ' . $input['name'] . ' th??nh c??ng ');
        } catch (Exception $ex) {
            return redirect()->route('admin.user')->with('failed', 'Kh??ng th??m ???????c nh??n s???');
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
        $positions = Position::all();
        $departments = Department::all();
        try {
            $users = User::getUser($id);
            return view('admin.users.show', compact('users', 'positions', 'departments'));
        } catch (Exception $ex) {
            throw $ex;
        }
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
    public function update(UserUpdateRequest $request, $id)
    {
        $input = $request->validated();

        $input = $request->all();
        $user = [
            'name' => $input['name'],
            'email' => $input['email'],
            'status' => $input['status']
        ];
        $profile = [
            'address' => $input['address'],
            'phone' => $input['phone'],
            'birthday' => $input['birthday'],
            'position' => $input['position'],
            'department' => $input['department']
        ];

        try {
            User::upd($user, $profile, $id);
            return redirect()->route('admin.user')->with('success', 'S???a th??nh c??ng nh??n s???: ' . $input['name']);
        } catch (Exception $ex) {
            return redirect()->route('admin.user')->with('failed', 'L???i s???a th??ng tin nh??n vi??n !');
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
        try {
            User::dlt($id);
            return redirect()->back()->withInput()->with('success', 'X??a th??nh c??ng !');
        } catch (Exception $ex) {
            return redirect()->route('admin.user')->with('failed', 'L???i !');
        }
    }
}
