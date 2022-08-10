@extends('layouts.app')

@section('title')
    <title>Nhân sự đã nghỉ</title>
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/users/btn-clear-value-input.css') }}">
@endsection

@section('header_page')
    Danh sách nhân sự đã nghỉ
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
                    <th scope="col">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <form id="searchform" name="searchform" method="post">
                        <td>
                            <span class="deleteicon w-100">
                                <input type="text" name="name" id="search_name" placeholder="Họ và tên"
                                    value="{{ Session('users.name') }}" class="form-control" autocomplete="off">
                                <span
                                    onclick="var input = this.previousElementSibling; input.value = ''; input.focus();">X</span>
                            </span>
                        </td>
                        <td>
                            <select class="form-control" name="position" id="position">
                                <option value="">tất cả</option>
                                @foreach ($positions as $position)
                                    <option value="{{ $position->id }}"
                                        {{ Session('users.position') == $position->id ? 'selected' : '' }}>
                                        {{ $position->position_name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="form-control" name="department" id="department">
                                <option value="">tất cả</option>
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}"
                                        {{ Session('users.department') == $department->id ? 'selected' : '' }}>
                                        {{ $department->department }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <a class='btn btn-primary' href='{{ url('admin/users/quit') }}' id='search_btn'>
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </a>
                            <a href="{{ route('admin.user') }}" class="btn btn-secondary mx-2">Thoát</a>
                        </td>
                    </form>
                </tr>
            </tbody>
        </table>

        {{-- Kết quả tìm kiếm --}}
        <div id="pagination_data">
            @include('admin.users.quit_page_data', ['users' => $users])
        </div>

    </div>

    {{-- Xác nhận khởi tạo lại tài khoản --}}
    <script>
        function confirmRestore() {
            if (confirm("Khôi phục lại tài khoản này ?") == true) {
                return true;
            } else {
                return false;
            }
        }
    </script>

    {{-- Search --}}
    <script>
        $(function() {
            //sự kiện nhấn enter khi nhập tên nhân viên
            var input = document.getElementById("search_name");
            input.addEventListener("keypress", function(event) {
                if (event.key === "Enter") {
                    event.preventDefault();
                    document.getElementById("search_btn").click();
                }
            });
            // sử dụng ajax để tìm kiếm
            $(document).on("click", "#pagination a,#search_btn", function() {
                var url = $(this).attr("href");
                var append = url.indexOf("?") == -1 ? "?" : "&";
                var finalURL = url + append + $("#searchform").serialize();

                event.preventDefault();
                $.get(finalURL, function(data) {
                    $("#pagination_data").html(data);
                });
                return false;
            })
        });
    </script>
@endsection
