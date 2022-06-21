@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="text-center">
            Thông tin nhân viên:
        </h2>
        @foreach ($users as $user)
            <form action="{{ route('admin.user.update', $user->id) }}" method="post">
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
                            <label for="position">Chức vụ</label>
                            <input type="text" class="form-control" name="position" id="position" placeholder="Chức vụ"
                                value="{{ $user->position }}">
                        </div>
                        <div class="form-group">
                            <label for="department">Phòng ban</label>
                            <input type="text" class="form-control" name="department" id="department"
                                placeholder="Phòng ban" value="{{ $user->department }}">
                        </div>
                        <div class="form-group">
                            <div><label for="">tình trạng làm việc</label></div>
                            <div class="d-flex align-item-center">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="op1"
                                        value="1" {{ $user->status == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="op1">đang làm</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="op2"
                                        value="0" {{ $user->status == 0 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="op2">đã nghỉ</label>
                                </div>
                            </div>
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
