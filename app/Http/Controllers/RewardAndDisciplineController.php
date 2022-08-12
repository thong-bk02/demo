<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Genre;
use App\Models\Position;
use App\Models\Reasion;
use App\Models\RewardAndDiscipline;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class RewardAndDisciplineController extends Controller
{
    public $_KEY = 'reward_and_discipline';
    
    public function __construct()
    {
        $this->middleware('auth');
    }
 
    /**
     * Lấy danh sách thưởng phạt
     */
    public function index(Request $request)
    {
        $this->clearSession(2);
        $_KEY = 'reward_and_discipline';
        $positions = Position::all();
        $departments = Department::all();
        $reward_and_disciplines = RewardAndDiscipline::indexSearch($request);

        if ($request->ajax()) {
            $this->saveSearchSession($this->_KEY, $request->all());
            return view('admin.reward-discipline.index_page_data', compact('reward_and_disciplines', 'positions', 'departments'));
        }
        return view('admin.reward-discipline.index', compact('reward_and_disciplines', 'positions', 'departments'));
    }

    /**
     * lấy danh sách nhân sự thêm thưởng phạt
     */
    public function list(Request $request)
    {
        $positions = Position::all();
        $departments = Department::all();
        $users = RewardAndDiscipline::listSearch($request);

        if ($request->ajax()) {
            return view('admin.reward-discipline.list_page_data', compact('users', 'positions', 'departments'));
        }

        return view('admin.reward-discipline.list', compact('users', 'positions', 'departments'));
    }

    /**
     * form thêm thưởng phạt
     */
    public function create($id)
    {
        $genres = Genre::all();
        $reasions  = Reasion::all();
        $user = RewardAndDiscipline::createUser($id);
        return view('admin.reward-discipline.create', compact('user', 'genres','reasions'));
    }

    /**
     * tạo mới 1 record thưởng phạt trong DB
     */
    public function store(Request $request, $id)
    {
        $data = $request->all();
        $data['user_id'] = $id;
        try {
            RewardAndDiscipline::createRAD($data);
            if ($data['type'] == 1) {
                return redirect()->route('admin.reward-discipline')->with('success', 'Thêm thưởng thành công');
            } else {
                return redirect()->route('admin.reward-discipline')->with('success', 'Thêm phạt thành công');
            }
        } catch (Exception $ex) {
            return redirect()->route('admin.reward-discipline')->with('failed', 'Thêm thưởng - phạt thất bại !');
        }
    }

    /**
     * hiển thị thông tin thưởng phạt
     */
    public function show($id)
    {
        $data_reasion = Reasion::all();
        $genres = Genre::all();
        $decisions = RewardAndDiscipline::showRAD($id);
        return view('admin.reward-discipline.show', compact('decisions', 'genres', 'data_reasion'));
    }

    /**
     * cập nhật thông tin thưởng phạt
     */
    public function update(Request $request, $id)
    {
        $data = $request->except(['_token']);
        $data['user_id'] = $id;
        try {
            RewardAndDiscipline::upd($data,$id);
            return redirect()->route('admin.reward-discipline')->with('success', 'Cập nhật thành công');
        } catch (Exception $ex) {
            throw $ex;
            // return redirect()->route('admin.reward-discipline')->with('failed', 'Sửa thất bại !');
        }
    }

    /**
     * xóa tạm thời thông tin thưởng phạt
     */
    public function destroy($id)
    {
        try {
            RewardAndDiscipline::dlt($id);
            return redirect()->route('admin.reward-discipline')->with('success', 'Xóa thành công');
        } catch (Exception $ex) {
            return redirect()->route('admin.reward-discipline')->with('failed', 'Xóa thất bại !');
        }
    }

    /**
     * lấy danh sách thông tin thưởng phạt đã xóa tạm thời
     */
    public function recycleBin(Request $request){
        $positions = Position::all();
        $departments = Department::all();
        $reward_and_disciplines = RewardAndDiscipline::deletedDecision($request);

        if ($request->ajax()) {
            return view('admin.reward-discipline.recycle_bin_page_data', compact('reward_and_disciplines', 'positions', 'departments'));
        }
        return view('admin.reward-discipline.recycle_bin', compact('reward_and_disciplines', 'positions', 'departments'));
    }

    /**
     * khôi phục lại quyết định thưởng phạt
     */
    public function restore($id){
        try{
            RewardAndDiscipline::restoreDecision($id);
            return redirect()->route('admin.reward-discipline.recycle-bin')->with('success', 'Khôi phục quyết định thành công !');
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}
