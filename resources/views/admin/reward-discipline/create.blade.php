@extends('layouts.app')

@section('title')
    <title>Thêm Thưởng - Phạt</title>
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/users/btn-clear-value-input.css') }}">
@endsection

@section('content')
    <div class="container">
        <h2 class="text-center pt-3 pb-4">
            Thêm Thưởng / Phạt
        </h2>

        <form action="{{ route('admin.reward-discipline.store', $user['0']->user_id) }}" method="post">
            @csrf
            <div class="row mx-lg-5 mx-2">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="name">Họ Tên</label>
                        <input type="text" class="form-control" name=""
                            value="{{ old('name',$user['0']->name) }}" disabled>
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="position">Chức vụ</label>
                        <input type="text" class="form-control" name=""
                            value="{{ old('name',$user['0']->position_name) }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="department">Phòng ban</label>
                        <input type="text" class="form-control" name=""
                            value="{{ old('name',$user['0']->department) }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="type">Hình thức</label>
                        <select class="form-control" name="type">
                            @foreach ($genres as $genre)
                                <option value="{{ $genre->id }}">
                                    {{ $genre->genre }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="reasion">Lí do</label>
                        <input class="form-control" type="text" name="reasion" id="" placeholder="Lí do" value="{{ old('reasion') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="note">Ghi chú</label>
                        <input type="text" class="form-control" name="note" value="{{ old('note') }}">
                    </div>
                    <div class="form-group">
                        <label for="money">Số tiền</label>
                        <input type="number" class="form-control" name="money" value="{{ old('money') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="">Ngày quyết định</label>
                        <input type="date" name="date_created" class="form-control" value="{{ old('date_created') }}" required>
                    </div>
                </div>
            </div>

            <div class="mx-lg-5 m-2">
                <input type="submit" class="btn btn-primary mx-3" value="Lưu">
                <a href="{{ route('admin.reward-discipline') }}" class="btn btn-secondary mx-3">Thoát</a>
            </div>

        </form>
    </div>
@endsection
