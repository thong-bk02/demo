@extends('layouts.app')

@section('title')
    <title>Đổi mật khẩu</title>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Đổi mật khẩu') }}</div>

                    <form action="{{ route('update-password') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            @include('layouts.message')

                            <div class="mb-3">
                                <label for="oldPasswordInput" class="form-label">Mật khẩu cũ</label>
                                <input name="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror" id="oldPasswordInput"
                                    placeholder="Mật khẩu cũ" value="{{ old('old_password') }}">
                                @error('old_password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="newPasswordInput" class="form-label">Mật khẩu mới</label>
                                <input name="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" id="newPasswordInput"
                                    placeholder="Mật khẩu mới" value="{{ old('new_password') }}">
                                @error('new_password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="confirmNewPasswordInput" class="form-label">Nhập lại mật khẩu mới</label>
                                <input name="new_password_confirmation" type="password" class="form-control" id="confirmNewPasswordInput"
                                    placeholder="Mật khẩu mới" value="{{ old('new_password') }}">
                            </div>

                        </div>

                        <div class="card-footer">
                            <button class="btn btn-success">Cập nhật</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection