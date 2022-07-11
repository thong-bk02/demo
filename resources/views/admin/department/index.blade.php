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
        <div class="my-3">
            <a href="" class="btn btn-primary" data-toggle="modal" data-target="#add-department">Thêm phòng ban</a>

            <div class="modal fade" id="add-department" data-backdrop="static" data-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('admin.department.store') }}" method="post">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Thêm phòng ban</h5>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Mã phòng ban</label>
                                    <input type="text" class="form-control" name="department_code"
                                        placeholder="Mã phòng ban">
                                </div>
                                <div class="form-group">
                                    <label>Tên phòng ban</label>
                                    <input type="text" class="form-control" name="department"
                                        placeholder="Tên phòng ban">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Lưu</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Stt</th>
                    <th scope="col">Mã phòng ban</th>
                    <th scope="col">Tên phòng ban</th>
                    <th scope="col">Ngày tạo</th>
                    <th scope="col">Cập nhật</th>
                    <th scope="col">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($departments as $department)
                    <tr class="border-bottom border-dark">
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>
                            {{ $department->department_code }}
                        </td>
                        <td>
                            {{ $department->department }}
                        </td>
                        <td>
                            {{ $department->created_at }}
                        </td>
                        <td>
                            {{ $department->updated_at }}
                        </td>
                        <td>
                            <a href="" class="mx-1" data-toggle="modal"
                                data-target="#staticBackdrop{{ $department->id }}">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.department.delete',$department->id) }}" class="mx-1" onclick="return confirmDelete()"><i
                                    class="fa-solid fa-trash-can"></i></a>
                        </td>
                        <div class="modal fade" id="staticBackdrop{{ $department->id }}" data-backdrop="static"
                            data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ route('admin.department.update', $department->id) }}"
                                        method="post">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Thông tin phòng ban:
                                                {{ $department->department }}</h5>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label>Mã phòng ban</label>
                                                <input type="text" class="form-control" name="department_code"
                                                    value="{{ $department->department_code }}">
                                            </div>
                                            <div class="form-group">
                                                <label>Tên phòng ban</label>
                                                <input type="text" class="form-control" name="department"
                                                    value="{{ $department->department }}">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Lưu</button>
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Đóng</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    <script>
        function confirmDelete() {
            if (confirm("xóa phòng ban này ?") == true) {
                return true;
            } else {
                return false;
            }
        }
    </script>
@endsection
