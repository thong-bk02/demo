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
                    <th scope="col">Tên dự án</th>
                    <th scope="col">Ngày báo cáo</th>
                    <th scope="col">Nhân viên</th>
                    <th scope="col">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <form action="" method="">
                        <td>
                            <select class="form-control" name="position">
                                @foreach ($projects as $project)
                                    <option value="{{ $project->id }}">
                                        {{ $project->project_name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="date" name="Day_report" class="form-control">
                        </td>
                        <td>
                            <input type="text" name="staff" class="form-control">
                        </td>
                        <td>
                            <button type="submit" class="btn btn-primary">Search</button>
                            <a href="{{ route('admin.user.create') }}" class="btn btn-primary">Thêm báo cáo</a>
                        </td>
                    </form>
                </tr>
            </tbody>
        </table>

        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Stt</th>
                    <th scope="col">Tên dự án</th>
                    <th scope="col">Tiêu đề</th>
                    <th scope="col">Nội dung</th>
                    <th scope="col">ngày báo cáo</th>
                    <th scope="col">Tiến độ</th>
                    <th scope="col">Nhân viên</th>
                    <th scope="col">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($task_lists as $task_list)
                    <tr class="border-bottom border-dark">
                        <th scope="row">{{ $task_list->id }}</th>
                        <td>
                            {{ $task_list->project_name }}
                        </td>
                        <td>
                            {{ $task_list->title }}
                        </td>
                        <td>
                            {{ $task_list->content }}
                        </td>
                        <td>
                            {{ $task_list->start_date }}
                        </td>
                        <td>
                            {{ $task_list->progress }}%
                        </td>
                        <td>
                            {{ $task_list->name }}
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
