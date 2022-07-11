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
                            <a href="{{ route('admin.reward-discipline.create') }}" class="btn btn-primary">Thêm Thưởng phạt</a>
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
                @foreach ($reward_and_disciplines as $reward_and_discipline)
                    <tr class="border-bottom border-dark">
                        <th scope="row">{{ $reward_and_discipline->id }}</th>
                        <td>
                            {{ $reward_and_discipline->name }}
                        </td>
                        <td>
                            {{ $reward_and_discipline->genre }}
                        </td>
                        <td>
                            {{ $reward_and_discipline->reasion }}
                        </td>
                        <td>
                            {{ $reward_and_discipline->money }}
                        </td>
                        <td>
                            {{ $reward_and_discipline->date_created }}
                        </td>
                        <td>
                            <a href="{{ route('admin.reward-discipline.show', $reward_and_discipline->user_id) }}" class="mx-1"><i
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
