<?php

namespace App\Http\Controllers;

use App\Models\Timekeeping;
use Illuminate\Http\Request;
use App\Exports\TimeKeepingExport;
use App\Exports\TimekeepingExportOne;
use App\Http\Requests\TimekeepingCreateRequest;
use App\Imports\TimeKeepingImport;
use App\Models\Department;
use App\Models\Position;
use App\Models\RewardAndDiscipline;
use Exception;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class TimekeepingController extends Controller
{
    public $_KEY = 'timekeeping';
    
    public function __construct()
    {
        $this->middleware('auth');
    }
 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->clearSession(4);
        $positions = Position::all();
        $departments = Department::all();
        $timekeepings = Timekeeping::getAll($request);

        if ($request->ajax()) {
            $this->saveSearchSession($this->_KEY, $request->all());
            return view('admin.timekeeping.pagination_data', compact('timekeepings', 'positions', 'departments'));
        }
        return view('admin.timekeeping.index', compact('timekeepings', 'positions', 'departments'));
    }

    public function list(Request $request)
    {
        $positions = Position::all();
        $departments = Department::all();
        $users = RewardAndDiscipline::listSearch($request);

        if ($request->ajax()) {
            return view('admin.timekeeping.list_page_data', compact('users', 'positions', 'departments'));
        }

        return view('admin.timekeeping.list', compact('users', 'positions', 'departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $users = Timekeeping::formCreate($id);
        $user = $users[0];
        return view('admin.timekeeping.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TimekeepingCreateRequest $request, $id)
    {
        $request->validated();
        $input = $request->all();
        $input['timekeeping_month'] = $request['timekeeping_month'] . "-01";
        $input['timekeeping_code'] = $input['user_id'] . '-' . $request['timekeeping_month'];
        // dd($input);
        try {
            Timekeeping::createTimekeeping($input, $id);
            return redirect()->route('admin.timekeeping')->with('success', 'Thêm chấm công thành công ');
        } catch (Exception $ex) {
            return redirect()->route('admin.timekeeping')->with('failed', 'Lỗi không thêm được chấm công');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($code)
    {
        $timekeepings = Timekeeping::fetchOne($code);
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
    public function update(Request $request, $code)
    {
        $input = $request->except(['_token']);

        try {
            Timekeeping::upd($input, $code);
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

    public function exportOne($code)
    {
        session()->put('timekeeping_code', $code);
        $user = DB::table('users')
            ->join('timekeepings', 'timekeepings.user_id', 'users.id')
            ->where('timekeepings.timekeeping_code', $code)
            ->select('name')
            ->pluck('name');
        $user = $user->values();
        $name = $user[0];
        return Excel::download(new TimekeepingExportOne, 'Chấm_Công_' . $name . '.xlsx');
    }

    public function import(Request $request)
    {
        try {
            DB::beginTransaction();
            Timekeeping::truncate();
            Excel::import(new TimeKeepingImport, $request->file('cham_cong'));
            return redirect('admin/timekeeping')->with("success", 'cập nhật dữ liệu thành công');
            DB::commit();
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }
}
