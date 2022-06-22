@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="text-center">
            Thông tin chức vụ:
        </h2>
        <form action="{{ route('admin.position.update', $position->id) }}" method="post">
            @csrf
            <div class="row mx-lg-5 mx-2">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="name">Tên nhân viên</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Họ tên"
                            value="{{ $user->name }}">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="code">Mã nhân viên</label>
                        <input type="text" class="form-control" name="user_code" id="code"
                            placeholder="Mã nhân viên" value="{{ $user->user_code }}">
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
