@extends('layouts.app')

@section('title')
    <title>Quản lí tài khoản</title>
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
                            <select class="form-control" name="status" id="status">
                                <option value="" {{ Session('users.status') == '' ? 'selected' : '' }}>
                                    tất cả
                                </option>
                                <option value="1" {{ Session('users.status') == 1 ? 'selected' : '' }}>
                                    đang làm
                                </option>
                                <option value="2" {{ Session('users.status') == 2 ? 'selected' : '' }}>
                                    đã nghỉ
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

    @if (blank(session('users')))
    @else
        <script>
            $(function() {
                var page = '{{ Session('users.page') }}';
                if (page == "") {
                    var finalURL = "users?" + $("#searchform").serialize();
                } else {
                    var finalURL = "users?page=" + page + "&" + $("#searchform").serialize();
                }

                $.get(finalURL, function(data) {
                    $("#pagination_data").html(data);
                });
                return false;
            });
        </script>
    @endif
@endsection
