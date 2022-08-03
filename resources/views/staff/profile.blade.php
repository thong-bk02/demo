@extends('staff.layouts.app')

@section('title')
    <title>Tài khoản cá nhân</title>
@endsection

@section('content')
    <div class="container">

        @include('layouts.message')

        <h2 class="text-center">
            Thông tin tài khoản
        </h2>
        <form action="{{ route('profile.update') }}" method="post">
            @csrf
            <div class="mx-lg-5 mx-2">
                <div>
                    <div class="form-group">
                        <label for="name">Tên Tài khoản</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Họ tên"
                            value="{{ Auth::user()->name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email"
                            placeholder="email@example.com" value="{{ Auth::user()->email }}" required>
                    </div>
                    <div class="form-group">
                        <label for="birthday">Ngày sinh</label>
                        <input type="date" class="form-control" name="birthday" placeholder="Họ tên" value="{{ $profile[0]->birthday }}"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="hometown">Quê quán</label>
                        <input type="text" class="form-control" name="address" placeholder="Quê quán" value="{{ $profile[0]->address }}"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Số điện thoại</label>
                        <input type="number" class="form-control" name="phone" id="phone" placeholder="Số điện thoại"
                            value="{{ $profile[0]->phone }}" minlength="10" required>
                    </div>
                </div>
            </div>
            <div class="mx-lg-5 m-2">
                <input type="submit" class="btn btn-primary mr-3" value="Cập nhật">
                <a href="{{ route('home') }}" class="btn btn-secondary mx-3">Thoát</a>
            </div>

        </form>
    </div>
@endsection
