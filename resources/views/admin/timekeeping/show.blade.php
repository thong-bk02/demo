@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach ($timekeepings as $timekeeping)
            <h2 class="text-center mb-5">
                Thông tin chấm công nhân viên
            </h2>
            <form action="{{ route('admin.timekeeping.update', $timekeeping->user_id) }}" method="post">
                @csrf
                <div class="row mx-lg-5 mx-2">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">Tên nhân viên</label>
                            <input type="text" class="form-control" name="" 
                                placeholder="" value="{{ $timekeeping->name }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="">Ngày bắt đầu</label>
                            <input type="date" class="form-control" name="from_date" 
                                placeholder="" value="{{ $timekeeping->from_date }}">
                        </div>
                        <div class="form-group">
                            <label for="">Ngày hiện tại</label>
                            <input type="date" class="form-control" name="to_date"
                                value="{{ $timekeeping->to_date }}">
                        </div>
                        <div class="form-group">
                            <label for="">Tổng số ngày làm</label>
                            <input type="text" class="form-control" name="working_days"
                                value="{{ $timekeeping->working_days }}">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">Số lần về sớm</label>
                            <input type="number" class="form-control" name="arrive_late"
                                placeholder="Số điện thoại" value="{{ $timekeeping->arrive_late }}">
                        </div>
                        <div class="form-group">
                            <label for="">Tổng số giờ về sớm</label>
                            <input type="number" class="form-control" name="hours_late"
                                placeholder="email@example.com" value="{{ $timekeeping->hours_late }}">
                        </div>
                        <div class="form-group">
                            <label for="">Số lần đi muộn</label>
                            <input type="number" class="form-control" name="leave_early"
                                placeholder="Số điện thoại" value="{{ $timekeeping->leave_early }}">
                        </div>
                        <div class="form-group">
                            <label for="">Tổng số giờ đi muộn</label>
                            <input type="number" class="form-control" name="hours_early"
                                placeholder="email@example.com" value="{{ $timekeeping->hours_early }}">
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
