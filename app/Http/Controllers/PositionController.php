<?php

namespace App\Http\Controllers;

use App\Http\Requests\PositionRequest;
use App\Models\Position;
use Exception;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public $_KEY = 'position';

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
        $this->clearSession(1);
        $positions = Position::all();
        return view('admin.position.index', compact('positions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        try{
            Position::newPosition($input);
            return redirect()->route('admin.position')->with('success', 'Thêm chức vụ ' . $input['position_name'] . ' thành công ');
        } catch (Exception $ex) {
            return redirect()->route('admin.position')->with('failed', 'Lỗi không thêm được chức vụ');
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
        try{
            Position::upd($input, $id);
            return redirect()->route('admin.position')->with('success', 'Sửa thành công !');
        } catch (Exception $ex) {
            return redirect()->route('admin.position')->with('failed', 'Sửa không thành công !');
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
            Position::dlt($id);
            return redirect()->route('admin.position')->with('success', 'Xóa chức vụ thành công !');
        } catch (Exception $ex) {
            return redirect()->route('admin.position')->with('failed', 'Không thể xóa chức vụ này !');
        }
    }
}
