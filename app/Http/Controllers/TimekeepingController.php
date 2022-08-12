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

    /*
        xử lý và tìm kiếm chấm công
     */
    public function index(Request $request)
    {
        $this->clearSession(1);
        $positions = Position::all();
        $departments = Department::all();
        $timekeepings = Timekeeping::getAll($request);

        if ($request->ajax()) {
            $this->saveSearchSession($this->_KEY, $request->all());
            return view('admin.timekeeping.pagination_data', compact('timekeepings', 'positions', 'departments'));
        }
        return view('admin.timekeeping.index', compact('timekeepings', 'positions', 'departments'));
    }

    /*
        hiển thị và tìm kiếm nhân sự để đưa ra quyết định thưởng phạt
     */
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
     * Hiển thị form thêm chấm công
     */
    public function create($id)
    {
        $users = Timekeeping::formCreate($id);
        $user = $users[0];
        return view('admin.timekeeping.create', compact('user'));
    }

    /**
     * Tạo mới 1 record chấm công vào DB
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
     * Hiển thị thông tin chấm công
     */
    public function show($code)
    {
        $timekeepings = Timekeeping::fetchOne($code);
        return view('admin.timekeeping.show', compact('timekeepings'));
    }

    /**
     * Cập nhật dữ liệu chấm công
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
     * Xóa tạm thời bảng công
     */
    public function destroy($timekeeping_code)
    {
        try {
            Timekeeping::dlt($timekeeping_code);
            return redirect()->route('admin.timekeeping')->with('success', 'Xóa thành công !');
        } catch (Exception $ex) {
            return redirect()->route('admin.timekeeping')->with('failed', 'Lỗi !');
        }
    }

    /**
     * lấy danh sách các record chấm công đã xóa tạm thời
     */
    public function recycleBin(Request $request){
        $positions = Position::all();
        $departments = Department::all();
        $timekeepings = Timekeeping::deletedTimekeeping($request);

        if ($request->ajax()) {
            return view('admin.timekeeping.recycle_bin_page_data', compact('timekeepings', 'positions', 'departments'));
        }
        return view('admin.timekeeping.recycle_bin', compact('timekeepings', 'positions', 'departments'));
    }

    /**
     * khôi phục lại các record đã xóa
     */
    public function restore($user_id){
        try{
            Timekeeping::restoreTimekeeping($user_id);
            return redirect()->route('admin.timekeeping.recycle-bin')->with('success', 'Khôi phục bảng công thành công !');
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    /**
     * Xuất thông tin chấm công mà người quản trị tìm kiếm
     */
    public function export()
    {
        return Excel::download(new TimekeepingExport, 'Chấm_Công.xlsx');
    }

    /**
     * xuất thông tin về tháng chấm công của nhân viên được chọn
     */
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

    /**
     * lấy thông tin chấm công từ file excel
     */
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
            return redirect('admin/timekeeping')->with("failed", 'dữ liệu cập nhật không phù hợp!');
        }
    }
}
