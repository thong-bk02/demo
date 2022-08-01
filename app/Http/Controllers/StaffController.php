<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Event;
use App\Models\Position;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
 
    /*
        danh sách nhân sự
     */
    public function users(Request $request)
    {
        $positions = Position::all();
        $departments = Department::all();
        $users = User::search($request);
        
        if ($request->ajax()) {
            return view('staff.users.pagination_data', compact('users', 'positions', 'departments'));
        }
        return view('staff.users.index', compact('users', 'positions', 'departments'));
    }

    /*
        danh sách các chức vụ, phòng ban
     */
    public function position_department()
    {
        $positions = Position::all();
        $departments = Department::all();
        return view('staff.position-department.index', compact('positions', 'departments'));
    }

    /*
        chấm công
     */
    public function timekeeping(Request $request)
    {
        $timekeeping = Staff::getTimekeeping($request);
        $timekeeping = $timekeeping[0];
        if ($request->ajax()) {
            return view('staff.timekeeping.list', compact('timekeeping'));
        }
        return view('staff.timekeeping.index', compact('timekeeping'));
    }

    /*
        danh sách thưởng / phạt
     */
    public function reward_discipline(Request $request)
    {
        $decisions = Staff::getDecision($request);
        if ($request->ajax()) {
            return view('staff.reward-discipline.index_page_data', compact('decisions'));
        }
        return view('staff.reward-discipline.index', compact('decisions'));
    }

    /*
        lương
     */
    public function salary(Request $request)
    {
        $salarys = Staff::getSalary($request);
        if ($request->ajax()) {
            return view('staff.salary.salary_data', compact('salarys'));
        }
        return view('staff.salary.index', compact('salarys'));
    }

    /*
        danh sách sự kiện
     */
    public function event()
    {
        $data_event = Staff::getAllEvent();
        return view('staff.event.index', compact('data_event'));
    }

    /*
        nội quy và chế tài
     */
    public function rules()
    {
        return view('staff.rules.index');
    }
}
