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
                    <th scope="col">Chức vụ</th>
                    <th scope="col">Phòng ban</th>
                    <th scope="col">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <form action="" method="">
                        <td>
                            <input type="text" name="name" class="form-control">
                        </td>
                        <td>
                            <div class="form-group">
                                <select class="form-control" name="position">
                                    <option value="0"></option>
                                    @foreach ($positions as $position)
                                        <option value="{{ $position->id }}">
                                            {{ $position->position_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <select class="form-control" name="department">
                                    <option value="0"></option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}">
                                            {{ $department->department }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </td>
                        <td>
                            <button type="submit" class="btn btn-primary">Tìm</button>
                            <a href="" class="btn btn-primary">Thêm Lương</a>
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
                    <th scope="col">Chức vụ</th>
                    <th scope="col">Tổng lương</th>
                    <th scope="col">Thanh toán</th>
                    <th scope="col">Ngày thanh toán</th>
                    <th scope="col">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($salarys as $key => $salary)
                    <tr class="border-bottom border-dark">
                        <th scope="row">{{ $salary->id }}</th>
                        <td>
                            {{ $salary->name }}
                        </td>
                        <td>
                            {{ $salary->position_name }}
                        </td>
                        <td>
                            {{ $salary->total_money }}
                        </td>
                        <td>
                            {{ $salary->payment }}
                        </td>
                        <td>
                            {{ $salary->created_at }}
                        </td>
                        <td>
                            <a href="{{ route('admin.salary.show', $salary->id) }}" class="mx-1"><i class="fa-solid fa-eye"></i></a>
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
