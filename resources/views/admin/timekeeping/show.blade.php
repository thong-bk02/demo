@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="text-center mb-5">
            Thông tin chấm công nhân viên
        </h2>
        @foreach ($timekeepings as $timekeeping)
            <form action="{{ route('admin.timekeeping.update', $timekeeping->timekeeping_code) }}" method="post">
                @csrf
                <div class="row mx-lg-5 mx-2">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">Tên nhân viên</label>
                            <input type="text" class="form-control"
                                value="{{ $timekeeping->name }}" readonly>
                        </div>
                        
                        <div class="form-group">
                            <label for="">Tháng lương</label>
                            <input type="text" class="form-control"
                                value="{{ date('m/Y', strtotime($timekeeping->timekeeping_month)) }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Số lần về sớm</label>
                            <input type="text" class="form-control" name="leave_early"
                                value="{{ $timekeeping->leave_early }}">
                        </div>
                        <div class="form-group">
                            <label for="">Số lần đi muộn</label>
                            <input type="text" class="form-control" name="arrive_late"
                                value="{{ $timekeeping->arrive_late }}">
                        </div>
                        <div class="form-group">
                            <label for="">Số ngày nghỉ</label>
                            <input type="text" class="form-control" name="day_off" value="{{ $timekeeping->day_off }}">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">Chức vụ</label>
                            <input type="text" class="form-control"
                                value="{{ $timekeeping->position_name }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Phòng ban</label>
                            <input type="text" class="form-control"
                                value="{{ $timekeeping->department }}" readonly>
                        </div>
                        
                        <div class="form-group">
                            <label for="">Tổng số giờ về sớm</label>
                            <input type="number" class="form-control" name="hours_early"
                                value="{{ $timekeeping->hours_early }}">
                        </div>
                        <div class="form-group">
                            <label for="">Tổng số giờ đi muộn</label>
                            <input type="text" class="form-control" name="hours_late"
                                value="{{ $timekeeping->hours_late }}">
                        </div>
                        <div class="form-group">
                            <label for="">Tổng ngày làm</label>
                            <input type="text" class="form-control" name="working_days"
                                value="{{ $timekeeping->working_days }}">
                        </div>
                    </div>
                </div>

                <div class="mx-lg-5 m-2">
                    <input type="submit" class="btn btn-primary mx-3" value="Lưu">
                    <a href="{{ route('admin.timekeeping') }}" class="btn btn-secondary mx-3">Thoát</a>
                </div>
            </form>
        @endforeach
    </div>
@endsection
