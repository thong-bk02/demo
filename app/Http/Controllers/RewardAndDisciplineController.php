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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->clearSession(5);
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $genres = Genre::all();
        $reasions  = Reasion::all();
        $user = RewardAndDiscipline::createUser($id);
        return view('admin.reward-discipline.create', compact('user', 'genres','reasions'));
    }

    public function store(Request $request, $id)
    {
        $data = $request->all();
        $data['user_id'] = $id;
        try {
            RewardAndDiscipline::createRAD($data);
            if ($data['type'] == 1) {
                return redirect()->route('admin.reward-discipline')->with('success', 'Th??m th?????ng th??nh c??ng');
            } else {
                return redirect()->route('admin.reward-discipline')->with('success', 'Th??m ph???t th??nh c??ng');
            }
        } catch (Exception $ex) {
            return redirect()->route('admin.reward-discipline')->with('failed', 'Th??m th?????ng - ph???t th???t b???i !');
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
        $data_reasion = Reasion::all();
        $genres = Genre::all();
        $decisions = RewardAndDiscipline::showRAD($id);
        return view('admin.reward-discipline.show', compact('decisions', 'genres', 'data_reasion'));
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
        $data = $request->except(['_token']);
        $data['user_id'] = $id;
        try {
            RewardAndDiscipline::upd($data,$id);
            return redirect()->route('admin.reward-discipline')->with('success', 'C???p nh???t th??nh c??ng');
        } catch (Exception $ex) {
            // throw $ex;
            return redirect()->route('admin.reward-discipline')->with('failed', 'S???a th???t b???i !');
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
            RewardAndDiscipline::deleteDecision($id);
            return redirect()->route('admin.reward-discipline')->with('success', 'X??a th??nh c??ng');
        } catch (Exception $ex) {
            return redirect()->route('admin.reward-discipline')->with('failed', 'X??a th???t b???i !');
        }
    }
}
