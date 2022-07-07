@extends('layouts.app')

@section('title')
    <title>Tài khoản</title>
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/users/btn-clear-value-input.css') }}">
@endsection

@section('content')
    <div class="container">
        {{-- Thông báo --}}
        @include('layouts.message')

        {{-- Thanh tìm kiếm --}}
        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Họ và Tên</th>
                    <th scope="col">Chức vụ</th>
                    <th scope="col">Phòng ban</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <form id="searchform" name="searchform">
                        <td>
                            <span class="deleteicon">
                                <input type="text" name="name" id="user_name" placeholder="Họ và tên"
                                    value="{{ request()->get('name', '') }}" class="form-control" autocomplete="off">
                                <span
                                    onclick="var input = this.previousElementSibling; input.value = ''; input.focus();">X</span>
                            </span>
                        </td>
                        <td>
                            <select class="form-control" name="position" id="position">
                                <option value="">tất cả</option>
                                @foreach ($positions as $position)
                                    <option value="{{ $position->id }}"
                                        {{ request()->get('position') == $position->id ? 'selected' : '' }}>
                                        {{ $position->position_name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="form-control" name="department" id="department">
                                <option value="">tất cả</option>
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}"
                                        {{ request()->get('department') == $department->id ? 'selected' : '' }}>
                                        {{ $department->department }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="form-control" name="status" id="status">
                                <option value="" {{ request()->get('status') == '' ? 'selected' : '' }}>tất cả
                                </option>
                                <option value="1" {{ request()->get('status') == 1 ? 'selected' : '' }}>đang làm
                                </option>
                                <option value="2" {{ request()->get('status') == 2 ? 'selected' : '' }}>đã nghỉ
                                </option>
                            </select>
                        </td>
                        <td>
                            <a class='btn btn-primary' href='{{ url('admin/users') }}' id='search_btn'>
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </a>
                            <a href="{{ route('admin.user.create') }}" class="btn btn-primary">Thêm nhân sự</a>
                        </td>
                    </form>
                </tr>
            </tbody>
        </table>

        {{-- Kết quả tìm kiếm --}}
        <div id="pagination_data">
            @include('admin.users.pagination_data', ['users' => $users])
        </div>

    </div>

    {{-- Xác nhận xóa nhân sự --}}
    <script>
        function confirmDelete() {
            if (confirm("xóa nhân viên này ?") == true) {
                return true;
            } else {
                return false;
            }
        }
    </script>

    {{-- Search --}}
    <script>
        $(function() {
            $(document).on("click", "#pagination a,#search_btn", function() {

                var url = $(this).attr("href");
                var append = url.indexOf("?") == -1 ? "?" : "&";
                var finalURL = url + append + $("#searchform").serialize();

                window.history.pushState({}, null, finalURL);

                $.get(finalURL, function(data) {
                    $("#pagination_data").html(data);
                });

                return false;
            })

        });
    </script>
@endsection
