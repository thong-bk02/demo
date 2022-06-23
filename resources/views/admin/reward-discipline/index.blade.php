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
                    <th scope="col">Ngày phạt</th>
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
                            <input type="date" name="date_created" class="form-control">
                        </td>
                        <td>
                            <button type="submit" class="btn btn-primary">Search</button>
                            <a href="" class="btn btn-primary">Thêm Thưởng phạt</a>
                        </td>
                    </form>
                </tr>
            </tbody>
        </table>

        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Stt</th>
                    <th scope="col">Tên nhân viên</th>
                    <th scope="col">Hình thức</th>
                    <th scope="col">Lí do</th>
                    <th scope="col">Số tiền</th>
                    <th scope="col">Ngày quyết định</th>
                    <th scope="col">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rads as $rad)
                    <tr class="border-bottom border-dark">
                        <th scope="row">{{ $rad->id }}</th>
                        <td>
                            {{ $rad->name }}
                        </td>
                        <td>
                            {{ $rad->genre }}
                        </td>
                        <td>
                            {{ $rad->reasion }}
                        </td>
                        <td>
                            {{ $rad->money }}
                        </td>
                        <td>
                            {{ $rad->date_create }}
                        </td>
                        <td>
                            <a href="{{ route('admin.reward-discipline.show', $rad->user_id) }}" class="mx-1"><i
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
