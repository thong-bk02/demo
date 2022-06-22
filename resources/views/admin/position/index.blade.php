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
            <a href="{{ route('admin.user.create') }}" class="btn btn-primary">Thêm chức vụ</a>
        </div>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Mã chức vụ</th>
                    <th scope="col">Tên chức vụ</th>
                    <th scope="col">Ngày tạo</th>
                    <th scope="col">Cập nhật</th>
                    <th scope="col">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($positions as $position)
                    <tr class="border-bottom border-dark">
                        <th scope="row">{{ $position->id }}</th>
                        <td>
                            {{ $position->position_code }}
                        </td>
                        <td>
                            {{ $position->position_name }}
                        </td>
                        <td>
                            {{ $position->created_at }}
                        </td>
                        <td>
                            {{ $position->updated_at }}
                        </td>
                        <td>
                            <a href="" class="mx-1" data-toggle="modal"
                                data-target="#staticBackdrop{{ $position->id }}">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            <a href="" class="mx-1" onclick="return confirmDelete()"><i
                                    class="fa-solid fa-trash-can"></i></a>
                        </td>
                        <div class="modal fade" id="staticBackdrop{{ $position->id }}" data-backdrop="static"
                            data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="" method="">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Thông tin chức vụ</h5>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="position">Mã chức vụ</label>
                                                <input type="text" class="form-control" name="position" id="position"
                                                    placeholder="Mã chức vụ" value="{{ $position->position_code }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="position_code">Tên chức vụ</label>
                                                <input type="text" class="form-control" name="position_code"
                                                    id="position_code" placeholder="Tên chức vụ"
                                                    value="{{ $position->position }}">
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
            if (confirm("xóa người nhân viên này ?") == true) {
                return true;
            } else {
                return false;
            }
        }
    </script>
@endsection
