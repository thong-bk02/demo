@extends('layouts.app')

@section('title')
    <title>Thêm chấm công</title>
@endsection

@section('content')
    <div class="container">
        <h2 class="text-center">
            Thêm Chấm công
        </h2>
        <form action="{{ route('admin.timekeeping.store', $user->user_id) }}" method="post">
            @csrf
            <div class="row mx-lg-5 mx-2">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="name">Nhân sự</label>
                        <input type="text" class="form-control" value="{{ $user->name }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Chức vụ</label>
                        <input type="text" class="form-control" value="{{ $user->position_name }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Phòng ban</label>
                        <input type="text" class="form-control" value="{{ $user->department }}" readonly>
                    </div>
                    <input type="hidden" name="user_id" value="{{ $user->user_id }}">
                    <div class="form-group">
                        <label for="">Tháng công</label>
                        <input type="month" class="form-control @error('timekeeping_month') is-invalid @enderror" name="timekeeping_month"
                            value="{{ old('timekeeping_month') }}">
                        @error('timekeeping_month')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Tổng ngày công</label>
                        <input type="number" class="form-control @error('working_days') is-invalid @enderror"
                            name="working_days" value="{{ old('working_days') }}">
                            @error('working_days')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="">Số ngày nghỉ</label>
                        <input type="text" class="form-control @error('day_off') is-invalid @enderror" name="day_off" value="{{ old('day_off') }}">
                        @error('day_off')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Số lần đi muộn</label>
                        <input type="text" class="form-control @error('arrive_late') is-invalid @enderror" name="arrive_late" value="{{ old('arrive_late') }}">
                        @error('arrive_late')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Tổng số giờ đi muộn</label>
                        <input type="text" class="form-control @error('hours_late') is-invalid @enderror" name="hours_late" value="{{ old('hours_late') }}">
                        @error('hours_late')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Số lần về sớm</label>
                        <input type="text" class="form-control @error('leave_early') is-invalid @enderror" name="leave_early" value="{{ old('leave_early') }}">
                        @error('leave_early')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Tổng số giờ về sớm</label>
                        <input type="text" class="form-control @error('hours_early') is-invalid @enderror" name="hours_early" value="{{ old('hours_early') }}">
                        @error('hours_early')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="mx-lg-5 m-2">
                <input type="submit" class="btn btn-primary mx-3" value="Lưu">
                <a href="{{ route('admin.timekeeping') }}" class="btn btn-secondary mx-3">Thoát</a>
            </div>

        </form>
    </div>
@endsection
