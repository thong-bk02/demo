@extends('layouts.app')

@section('title')
    <title>Thêm Thưởng - Phạt</title>
@endsection

@section('content')
    <div class="container">
        <h2 class="text-center">
            Thêm Thưởng / Phạt
        </h2>
        <form action="" method="post">
            @csrf
            <div class="row mx-lg-5 mx-2">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="name">Họ Tên</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            placeholder="Họ tên" value="{{ old('name') }}">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="position">Chức vụ</label>
                        <select class="form-control" name="position">
                            
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="department">Phòng ban</label>
                        <select class="form-control" name="department">
                            
                        </select>
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
                        <input class="form-control" type="text" name="reasion" id="" placeholder="Lí do">
                        {{-- <select class="form-control" name="reasion">
                            @foreach ($reasions as $reasion)
                                <option value="{{ $reasion->id }}">
                                    {{ $reasion->reasion }}</option>
                            @endforeach
                        </select> --}}
                    </div>
                    <div class="form-group">
                        <label for="note">Ghi chú</label>
                        <input type="text" class="form-control" name="note" value="{{ old('note') }}">
                    </div>
                    <div class="form-group">
                        <label for="money">Số tiền</label>
                        <input type="number" class="form-control" name="money" value="{{ old('money') }}">
                    </div>
                    <div class="form-group">
                        <label for="">Ngày quyết định</label>
                        <input type="date" name="date_created" class="form-control">
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
