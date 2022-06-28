@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="text-center">
            Thêm chức vụ:
        </h2>
        <form action="{{ route('admin.position.store') }}" method="post">
            @csrf
            <div class="row">
                <div class="form-group col-6">
                    <label for="code">Mã nhân viên</label>
                    <input type="text" class="form-control" name="position_code" placeholder="Tên chức vụ"required>
                </div>
                <div class="form-group col-6">
                    <label for="birthday">Ngày sinh</label>
                    <input type="text" class="form-control" name="position_name" placeholder="Mã chức vụ" required>
                </div>
            </div>
            <div class="mx-lg-5 m-2">
                <input type="submit" class="btn btn-primary mx-3" value="Lưu">
                <a href="{{ route('admin.position') }}" class="btn btn-secondary mx-3">Thoát</a>
            </div>
        </form>
    </div>
@endsection
