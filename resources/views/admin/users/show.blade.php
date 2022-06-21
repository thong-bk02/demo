@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="text-center">
            Thông tin nhân viên:
        </h2>
        @foreach ($users as $user)
            <form action="{{ route('admin.user.update', $user->user_id) }}" method="post">
                @csrf
                <div class="row mx-lg-5 mx-2">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="name">Tên nhân viên</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Họ tên"
                                value="{{ $user->name }}">
                        </div>
                        <div class="form-group">
                            <label for="code">Mã nhân viên</label>
                            <input type="text" class="form-control" name="user_code" id="code"
                                placeholder="Mã nhân viên" value="{{ $user->user_code }}">
                        </div>
                        <div class="form-group">
                            <label for="birthday">Ngày sinh</label>
                            <input type="date" class="form-control" name="birthday" id="birthday" placeholder="Họ tên"
                                value="{{ $user->birthday }}">
                        </div>
                        <div class="form-group">
                            <label for="hometown">Quê quán</label>
                            <input type="text" class="form-control" name="address" id="hometown" placeholder="Quê quán"
                                value="{{ $user->address }}">
                        </div>
                        <div>
                            <label for="">Quyền truy cập</label>
                            <select class="form-control" name="power">
                                @foreach ($powers as $power)
                                    <option value="{{ $power->id }}"
                                        {{ $power->id == $user->power ? 'selected' : '' }}>
                                        {{ $power->power_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="phone">Số điện thoại</label>
                            <input type="number" class="form-control" name="phone" id="phone"
                                placeholder="Số điện thoại" value="{{ $user->phone }}">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="email"
                                placeholder="email@example.com" value="{{ $user->email }}">
                        </div>
                        <div class="form-group">
                            <label for="">Chức vụ</label>
                            <select class="form-control" name="position">
                                @foreach ($positions as $position)
                                    <option value="{{ $position->id }}"
                                        {{ $position->id == $user->position ? 'selected' : '' }}>
                                        {{ $position->position }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Phòng ban</label>
                            <select class="form-control" name="department">
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}"
                                        {{ $department->id == $user->department ? 'selected' : '' }}>
                                        {{ $department->department }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">tình trạng làm việc</label>
                            <select name="status" class="form-control">
                                <option value="1" {{ $user->status == 1 ? 'selected' : '' }}>đang làm</option>
                                <option value="0" {{ $user->status == 0 ? 'selected' : '' }}>đã nghỉ</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="mx-lg-5 m-2">
                    <input type="submit" class="btn btn-primary mx-3" value="Lưu">
                    <a href="{{ route('admin.user') }}" class="btn btn-secondary mx-3">Thoát</a>
                </div>

            </form>
        @endforeach
    </div>
@endsection
