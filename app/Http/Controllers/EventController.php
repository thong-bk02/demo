<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class EventController extends Controller
{
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
        $data_event = Event::getAllEvent();
        return view('admin.event.index' , compact('data_event'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $start_date = strtotime($input['start_date']);
        $end_date = strtotime($input['end_date']);
        if($start_date > $end_date){
            return redirect()->back()->with('failed', 'Thời gian bắt đầu không thể lớn hơn thời gian kểt thúc');
        }
        try{
            Event::createEvent($input);
            return redirect()->route('admin.event')->with('success', 'Thêm thành công sự kiện');
        } catch (Exception $ex) {
            return redirect()->route('admin.event')->with('failed', 'Lỗi không thêm được sự kiện');
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
        //
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
        try{
            Event::updateEvent($input, $id);
            return redirect()->route('admin.event')->with('success', 'Cập nhật thành công sự kiện');
        } catch (Exception $ex) {
            return redirect()->route('admin.event')->with('failed', 'Lỗi sửa sự kiện');
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
            Event::find($id)->delete();
            return redirect()->route('admin.event')->with('success', 'Xóa thành công !');
        } catch (Exception $ex) {
            return redirect()->route('admin.event')->with('failed', 'Lỗi !');
        }
    }
}
