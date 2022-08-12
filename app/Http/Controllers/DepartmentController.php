<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Exception;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public $_KEY = 'department';

    public function __construct()
    {
        $this->middleware('auth');
    }
 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->clearSession(4);
        $departments = Department::all();
        return view('admin.department.index', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        // dd($input);
        if (Department::newDepartment($input) == true) {
            return redirect()->route('admin.department')->with('success', 'Thêm phòng ban ' . $input['department'] . ' thành công ');
        } else {
            return redirect()->route('admin.department')->with('failed', 'Lỗi không thêm được phòng ban');
        }
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
        $input = $request->except(['_token']);
        if ( Department::upd($input, $id) == true) {
            return redirect()->route('admin.department')->with('success', 'Sửa thành công.');
        } else {
            return redirect()->route('admin.department')->with('failed', 'Sửa không thành công !');
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
        try{
            Department::where('id', $id)->delete();
            return redirect()->route('admin.department')->with('success', 'Xóa phòng ban thành công.');
        } catch (Exception $ex) {
            return redirect()->route('admin.department')->with('failed', 'Phòng ban đang được sử dụng!');
        }
        
    }
}
