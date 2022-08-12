<?php

namespace App\Http\Controllers;

use App\Exports\SalaryExport;
use App\Exports\SalaryExportOne;
use App\Imports\SalaryImport;
use App\Models\BasicSalary;
use App\Models\Department;
use App\Models\Payment;
use App\Models\Position;
use App\Models\Salary;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class SalaryController extends Controller
{
    public $_KEY = 'salary';
    
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
        $this->clearSession(3);
        $salarys = Salary::getAll($request);
        $positions = Position::all();
        $departments = Department::all();

        if ($request->ajax()) {
            $this->saveSearchSession($this->_KEY, $request->all());
            return view('admin.salary.index_page_data', compact('salarys', 'positions', 'departments'));
        }
        return view('admin.salary.index', compact('salarys', 'positions', 'departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id)
    {
        $month = $request->get('month');

        $salarys = Salary::getSalary($id, $month);
        $basic_salary = BasicSalary::all();
        $total_reward = Salary::get_Total_RewardAndDiscipline($id, $month, 1);
        $total_discipline = Salary::get_Total_RewardAndDiscipline($id, $month, 2);
        $payments = Payment::all();
        $decisions = Salary::getDecision($id, $month);
        if ($request->ajax()) {
            return view('admin.salary.data_decision', compact('decisions'));
        }
        return view('admin.salary.create', compact('salarys', 'total_reward', 'total_discipline', 'basic_salary', 'payments', 'decisions'));
    }

    public function demo(Request $request)
    {
        $month = $request->get('month');
        $user_id = $request->get('user_id');

        $total_reward = Salary::get_Total_RewardAndDiscipline($user_id, $month, 1);
        $total_discipline = Salary::get_Total_RewardAndDiscipline($user_id, $month, 2);
        $working_days = Salary::getWorkingDays($user_id, $month);
        if ($request->ajax()) {
            return ['total_reward' => $total_reward,'total_discipline' => $total_discipline, 'working_days' => $working_days];
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $input = $request->all();
        $input['user_id'] = $id;
        $input['salary_code'] = $input['user_id'] . '-' . $input['month'];
        $input['month'] = $input['month'] . '-01';
        try {
            Salary::createdSalary($input);
            return redirect()->route('admin.salary')->with('success', 'Thêm lương thành công !');
        } catch (Exception $ex) {
            return redirect()->route('admin.salary')->with('failed', 'Thêm lương không thành công !');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($salary_code)
    {
        $id = Str::substr($salary_code, 0, 2);
        $month = Str::substr($salary_code,-7);

        $salarys = Salary::getOne($salary_code);
        $total_reward = Salary::get_Total_RewardAndDiscipline($id, $month, 1);
        $total_discipline = Salary::get_Total_RewardAndDiscipline($id, $month, 2);
        $payments = Payment::all();
        $decisions = Salary::getDecision($id, $month);
        return view('admin.salary.show', compact('salarys', 'total_reward', 'total_discipline', 'payments', 'decisions'));
    }

    public function listUser(Request $request)
    {
        $positions = Position::all();
        $departments = Department::all();
        $users = Salary::listSearch($request);

        if ($request->ajax()) {
            $this->saveSearchSession('list_users', $request->all());
            return view('admin.salary.list_page_data', compact('users', 'positions', 'departments'));
        }

        return view('admin.salary.list', compact('users', 'positions', 'departments'));
    }

    /**
     * cập nhật thông tin lương
     */
    public function update(Request $request, $id)
    {
        $input = $request->except(['_token']);
        try {
            Salary::updateSalary($input, $id);
            return redirect()->route('admin.salary')->with('success', 'Sửa lương thành công !');
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    /**
     * xóa tạm thời lương tháng
     */
    public function destroy($salary_code)
    {
        try {
            Salary::dlt($salary_code);
            return redirect()->route('admin.salary')->with('success', 'Xóa thành công !');
        } catch (Exception $ex) {
            return redirect()->route('admin.salary')->with('failed', 'Xoá không thành công !');
        }
    }

    /**
     * lấy danh sách các tháng lương đã xóa
     */
    public function recycleBin(Request $request){
        $positions = Position::all();
        $departments = Department::all();
        $salarys = Salary::deletedSalary($request);

        if ($request->ajax()) {
            return view('admin.salary.recycle_bin_page_data', compact('salarys', 'positions', 'departments'));
        }
        return view('admin.salary.recycle_bin', compact('salarys', 'positions', 'departments'));
    }

    /**
     * khôi phục lại lương tháng đã xóa
     */
    public function restore($salary_code){
        try {
            Salary::restoreSalary($salary_code);
            return redirect()->route('admin.salary.recycle-bin')->with('success', 'Khôi phục thành công !');
        } catch (Exception $ex) {
            return redirect()->route('admin.salary.recycle-bin')->with('failed', 'Không thể khôi phục !');
        }
    }

    /**
     * xuất thông tin lương theo tìm kiến của người quản trị
     */
    public function export()
    {
        return Excel::download(new SalaryExport, 'Bảng_lương.xlsx');
    }

    /**
     * xuất thông tin về tháng chấm công của nhân viên được chọn
     */
    public function exportOne($salary_code)
    {
        session()->put('salary_code', $salary_code);
        $user = DB::table('users')
            ->join('salary', 'salary.user_id', 'users.id')
            ->where('salary.salary_code', $salary_code)
            ->select('name')
            ->pluck('name');
        $user = $user->values();
        $name = $user[0];
        return Excel::download(new SalaryExportOne, 'Chấm_Công_' . $name . '.xlsx');
    }
}
