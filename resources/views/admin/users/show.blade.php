@extends('layouts.app')

@section('title')
    <title>Tài khoản</title>
@endsection

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
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                id="name" placeholder="Họ tên" value="{{old('name', $user->name)}}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="birthday">Ngày sinh</label>
                            <input type="date" class="form-control @error('birthday') is-invalid @enderror" name="birthday"
                                id="birthday" placeholder="Họ tên" value="{{old('birthday', $user->birthday)}}">
                            @error('birthday')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="address">Quê quán</label>
                            <input type="text" class="form-control @error('address') is-invalid @enderror" name="address"
                                id="address" placeholder="Quê quán" value="{{old('address', $user->address)}}">
                            @error('address')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">tình trạng làm việc</label>
                            <select name="status" class="form-control">
                                <option value="1" {{ old('status', $user->status) == 1 ? 'selected' : '' }}>đang làm</option>
                                <option value="2" {{ old('status', $user->status) == 2 ? 'selected' : '' }}>đã nghỉ</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="phone">Số điện thoại</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone"
                                id="phone" placeholder="Số điện thoại" value="{{old('phone', $user->phone)}}" pattern="(((\+|)84)|0)(3|5|7|8|9)+([0-9]{8})\b">
                            @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                id="email" placeholder="email@example.com" value="{{old('email', $user->email)}}">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Chức vụ</label>
                            <select class="form-control" name="position">
                                @foreach ($positions as $position)
                                    <option value="{{ $position->id }}"
                                        {{ $position->id == old('position', $user->position) ? 'selected' : '' }}>
                                        {{ $position->position_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Phòng ban</label>
                            <select class="form-control" name="department">
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}"
                                        {{ $department->id == old('department', $user->department) ? 'selected' : '' }}>
                                        {{ $department->department }}</option>
                                @endforeach
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
