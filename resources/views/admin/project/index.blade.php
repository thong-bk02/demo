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
                    <th scope="col">Họ Tên Quản Lí</th>
                    <th scope="col">Tên Dự án</th>
                    <th scope="col">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <form action="" method="">
                        <td>
                            <input type="text" name="project_manager" id="name" placeholder="Họ và tên" class="form-control">
                        </td>
                        <td>
                            <input type="text" name="project_name" id="name" placeholder="Tên dự án" class="form-control">
                        </td>
                        <td>
                            <button type="submit" class="btn btn-primary">Search</button>
                            <a href="{{ route('admin.user.create') }}" class="btn btn-primary">Thêm nhân sự</a>
                        </td>
                    </form>
                </tr>
            </tbody>
        </table>

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
                            {{ $project->name }}
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
