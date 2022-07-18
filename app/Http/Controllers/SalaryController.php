<?php

namespace App\Http\Controllers;

use App\Models\BasicSalary;
use App\Models\Department;
use App\Models\Payment;
use App\Models\Position;
use App\Models\Salary;
use Exception;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    public $_KEY = 'salary';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->clearSession(6);
        $salarys = Salary::getAll();
        $positions = Position::all();
        $departments = Department::all();
        // dd($salarys);
        return view('admin.salary.index', compact('salarys','positions','departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $salarys = Salary::getSalary($id);
        $basic_salary = BasicSalary::all();
        $total_reward = Salary::get_Total_RewardAndDiscipline($id, 1);
        $total_discipline = Salary::get_Total_RewardAndDiscipline($id, 2);
        $payments = Payment::all();
        $decisions = Salary::getDecision($id);
        return view('admin.salary.create', compact('salarys', 'total_reward', 'total_discipline','basic_salary', 'payments', 'decisions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request ,$id)
    {
        $input = $request->all();
        $input['coefficients_salarys'] = 3;
        $input['user_id'] = $id;
        try{
            Salary::createdSalary($input);
            return redirect()->route('admin.salary')->with('success', 'Thêm lương thành công !');
        } catch (Exception $ex) {
            throw $ex;
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
        $salarys = Salary::getOne($id);
        $total_reward = Salary::get_Total_RewardAndDiscipline($id, 1);
        $total_discipline = Salary::get_Total_RewardAndDiscipline($id, 2);
        $payments = Payment::all();
        $decisions = Salary::getDecision($id);
        return view('admin.salary.show', compact('salarys', 'total_reward', 'total_discipline', 'payments', 'decisions'));
    }

    public function listUser(Request $request)
    {
        $positions = Position::all();
        $departments = Department::all();
        $users = Salary::listSearch($request);

        if ($request->ajax()) {
            return view('admin.salary.list_page_data', compact('users', 'positions', 'departments'));
        }

        return view('admin.salary.list', compact('users', 'positions', 'departments'));
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
