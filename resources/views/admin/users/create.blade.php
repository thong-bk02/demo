@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="text-center">
            Thêm nhân viên:
        </h2>
        <form action="{{ route('admin.users.store') }}" method="post">
            @csrf
            <div class="row mx-lg-5 mx-2">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="name">Tên nhân viên</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Họ tên"
                            value="" required>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="code">Mã nhân viên</label>
                            <input type="text" class="form-control" name="user_code" placeholder="Mã nhân viên"
                                value="" required>
                        </div>
                        <div class="form-group col-6">
                            <label for="birthday">Ngày sinh</label>
                            <input type="date" class="form-control" name="birthday" placeholder="Họ tên" value="" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="hometown">Quê quán</label>
                        <input type="text" class="form-control" name="address" placeholder="Quê quán" value="" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Số điện thoại</label>
                        <input type="number" class="form-control" name="phone" id="phone" placeholder="Số điện thoại"
                            value="" minlength="10" required>
                    </div>
                </div>
                <div class="col-sm-6">

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email"
                            placeholder="email@example.com" value="" required>
                    </div>
                    <div class="form-group">
                        <label for="">Chức vụ</label>
                        <select class="form-control" name="position">
                            @foreach ($positions as $position)
                                <option value="{{ $position->id }}">
                                    {{ $position->position_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Phòng ban</label>
                        <select class="form-control" name="department">
                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}">
                                    {{ $department->department }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="phone">Mật khẩu</label>
                        <input type="text" class="form-control" name="password"  required>
                    </div>
                </div>
            </div>

            <div class="mx-lg-5 m-2">
                <input type="submit" class="btn btn-primary mx-3" value="Lưu">
                <a href="{{ route('admin.user') }}" class="btn btn-secondary mx-3">Thoát</a>
            </div>

        </form>
    </div>
@endsection
