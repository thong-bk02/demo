@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">
                <p class="text-center">{{ session('success') }}</p>
            </div>
        @elseif (session('failed'))
            <div class="alert alert-error">
                <p class="text-center">{{ session('failed') }}</p>
            </div>
        @endif
        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Đơn vị phòng ban</th>
                    <th scope="col">Họ và Tên</th>
                    <th scope="col">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <form action="" method="">
                        <th>
                            <select class="custom-select" name="department">
                                <option selected>Tất cả</option>
                                <option value="1">Phòng ban 1</option>
                                <option value="2">Phòng ban 2</option>
                                <option value="3">Phòng ban 3</option>
                            </select>
                        </th>
                        <td>
                            <input type="text" name="name" id="name" placeholder="Họ và tên">
                        </td>
                        <td>
                            <button type="submit" class="btn btn-primary">Search</button>
                            <a href="" class="btn btn-primary">Thêm nhân sự</a>
                        </td>
                    </form>
                </tr>
            </tbody>
        </table>

        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Mã nhân viên</th>
                    <th scope="col">Tên nhân viên</th>
                    <th scope="col">Chức vụ</th>
                    <th scope="col">Phòng ban</th>
                    <th scope="col">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr class="border-bottom border-dark">
                        <th scope="row">{{ $user->user_id }}</th>
                        <td>
                            {{ $user->user_code }}
                        </td>
                        <td>
                            {{ $user->name }}
                        </td>
                        <td>
                            {{ $user->position }}
                        </td>
                        <td>
                            {{ $user->department }}
                        </td>
                        <td>
                            <a href="{{ route('admin.user.show', $user->user_id) }}" class="mx-1"><i
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
