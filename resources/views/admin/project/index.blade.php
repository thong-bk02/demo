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
        {{-- <table class="table">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Họ và Tên</th>
                    <th scope="col">Chức vụ</th>
                    <th scope="col">Phòng ban</th>
                    <th scope="col">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <form action="" method="">
                        <td>
                            <input type="text" name="name" id="name" placeholder="Họ và tên" class="form-control">
                        </td>
                        <td>
                            <select class="form-control" name="position">
                                <option value="0" selected>tất cả</option>
                                @foreach ($positions as $position)
                                    <option value="{{ $position->id }}">
                                        {{ $position->position }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="form-control" name="department">
                                <option value="0" selected>tất cả</option>
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}">
                                        {{ $department->department }}</option>
                                @endforeach
                            </select>

                        </td>
                        <td>
                            <button type="submit" class="btn btn-primary">Search</button>
                            <a href="{{ route('admin.user.create') }}" class="btn btn-primary">Thêm nhân sự</a>
                        </td>
                    </form>
                </tr>
            </tbody>
        </table> --}}

        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Tên dự án</th>
                    <th scope="col">Quản lí dự án</th>
                    <th scope="col">ngày bắt đầu</th>
                    <th scope="col">Thời gian dự kiến</th>
                    <th scope="col">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($projects as $project)
                    <tr class="border-bottom border-dark">
                        <th scope="row">{{ $project->id }}</th>
                        <td>
                            {{ $project->project_name }}
                        </td>
                        <td>
                            {{ $project->project_manager }}
                        </td>
                        <td>
                            {{ $project->start_date }}
                        </td>
                        <td>
                            {{ $project->intend_time }}
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
