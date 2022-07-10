<?php

namespace App\Http\Controllers;

use App\Models\Timekeeping;
use Illuminate\Http\Request;
use App\Exports\TimeKeepingExport;
use App\Imports\TimeKeepingImport;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Maatwebsite\Excel\Facades\Excel;

class TimekeepingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $timekeepings = Timekeeping::getAll($request);
        $users = User::all();

        if ($request->ajax()) {
            return view('admin.timekeeping.pagination_data', compact('timekeepings','users', 'request'));
        }
        return view('admin.timekeeping.index', compact('timekeepings','users', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('admin.timekeeping.create',compact('users'));
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
        $input['to_date'] = Carbon::today();

        if (Timekeeping::newTimekeeping($input) == true) {
            return redirect()->route('admin.timekeeping')->with('success', 'Thêm thành công ');
        } else {
            return redirect()->route('admin.timekeeping')->with('failed', 'Lỗi không thêm được chấm công');
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
        $timekeepings = Timekeeping::fetchOne($id);
        return view('admin.timekeeping.show', compact('timekeepings'));
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
        $input = $request->except(['_token']);

        try {
            Timekeeping::upd($input, $id);
            return redirect()->route('admin.timekeeping')->with('success', 'Sửa thành công');
        } catch (Exception $ex) {
            throw $ex;
            // return redirect()->route('admin.timekeeping')->with('failed', 'Lỗi sửa thông tin chấm công !');
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
            Timekeeping::dlt($id);
            return redirect()->route('admin.timekeeping')->with('success', 'Xóa thành công !');
        } catch (Exception $ex) {
            return redirect()->route('admin.timekeeping')->with('failed', 'Lỗi !');
        }
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function export() 
    {
        return Excel::download(new TimekeepingExport, 'Chấm_Công.xlsx');
    }
       
    /**
    * @return \Illuminate\Support\Collection
    */
    public function import() 
    {
        Excel::import(new TimekeepingImport,request()->file('file'));
               
        return back();
    }
}
