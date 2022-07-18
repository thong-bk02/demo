@extends('layouts.app')

@section('title')
    <title>Tạo tài khoản</title>
@endsection

@section('content')
    <div class="container">
        <h2 class="text-center p-3">
            Thêm nhân sự
        </h2>
        <form action="{{ route('admin.users.store') }}" method="post">
            @csrf
            <div class="row mx-lg-5 mx-2">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="name">Họ và tên</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            placeholder="Họ tên" value="{{ old('name') }}">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="birthday">Ngày sinh</label>
                        <input type="date" class="form-control @error('birthday') is-invalid @enderror" name="birthday"
                            placeholder="" value="{{ old('birthday') }}">
                        @error('birthday')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
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
                        <label for="phone">Số điện thoại</label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone"
                            id="phone" placeholder="03******** / +84*********" value="{{ old('phone') }}"
                            pattern="(((\+|)84)|0)(3|5|7|8|9)+([0-9]{8})\b">
                        @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                    </div>
                </div>
                <div class="col-sm-6">

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                            placeholder="email@example.com" value="{{ old('email') }}">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="hometown">Quê quán</label>
                        <input type="text" class="form-control @error('address') is-invalid @enderror" name="address"
                            placeholder="Quê quán" value="{{ old('address') }}">
                        @error('address')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
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
                        <label for="pword">Mật khẩu</label>
                        <input type="text" class="form-control @error('pword') is-invalid @enderror" name="pword"
                            value="{{ old('pword') }}" autocomplete="off">
                        @error('pword')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
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
