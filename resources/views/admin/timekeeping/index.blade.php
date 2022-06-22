@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                <span>{{ session('success') }}</span>
            </div>
        @elseif (session('failed'))
            <div class="alert alert-error" role="alert">
                <span>{{ session('failed') }}</span>
            </div>
        @endif
        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Tên nhân viên</th>
                    <th scope="col">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <form action="" method="">
                        <td>
                            <input type="text" name="staff" class="form-control">
                        </td>
                        <td>
                            <button type="submit" class="btn btn-primary">Search</button>
                            <a href="{{ route('admin.timekeeping.create') }}" class="btn btn-primary">Thêm chấm công</a>
                        </td>
                    </form>
                </tr>
            </tbody>
        </table>

        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Stt</th>
                    <th scope="col">Tên nhân sự</th>
                    <th scope="col">Ngày bắt đầu</th>
                    <th scope="col">Hiện tại</th>
                    <th scope="col">Tổng số ngày làm</th>
                    <th scope="col">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($timekeepings as $timekeeping)
                    <tr class="border-bottom border-dark">
                        <th scope="row">{{ $timekeeping->id }}</th>
                        <td>
                            {{ $timekeeping->name }}
                        </td>
                        <td>
                            {{ $timekeeping->from_date }}
                        </td>
                        <td>
                            {{ $timekeeping->to_date }}
                        </td>
                        <td>
                            {{ $timekeeping->working_days }}
                        </td>
                        <td>
                            <a href="" class="mx-1"><i
                                    class="fa-solid fa-eye"></i></a>
                            <a href="" class="mx-1" onclick="return confirmDelete()"><i
                                    class="fa-solid fa-trash-can"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script>
        function confirmDelete() {
            if (confirm("xóa người nhân viên này ?") == true) {
                return true;
            } else {
                return false;
            }
        }
    </script>
@endsection
