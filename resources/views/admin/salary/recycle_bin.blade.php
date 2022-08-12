@extends('layouts.app')

@section('title')
    <title>Quản lí lương</title>
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/users/btn-clear-value-input.css') }}">
@endsection

@section('header_page')
    Danh sách lương đã xóa
@endsection

@section('content')
    <div class="container">

        @include('layouts.message')

        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Tên nhân viên</th>
                    <th scope="col">Chức vụ</th>
                    <th scope="col">Phòng ban</th>
                    <th scope="col">Tháng lương</th>
                    <th scope="col">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <form id="searchform" name="searchform" method="post">
                        <td>
                            <span class="deleteicon w-100">
                                <input type="text" name="name" id="search_name" placeholder="Họ và tên"
                                    value="{{ Session('salary.name') }}" class="form-control" autocomplete="off">
                                <span
                                    onclick="var input = this.previousElementSibling; input.value = ''; input.focus();">X</span>
                            </span>
                        </td>
                        <td>
                            <select class="form-control" name="position">
                                <option value="">tất cả</option>
                                @foreach ($positions as $position)
                                    <option value="{{ $position->id }}"
                                        {{ Session('salary.position') == $position->id ? 'selected' : '' }}>
                                        {{ $position->position_name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="form-control" name="department">
                                <option value="">tất cả</option>
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}"
                                        {{ Session('salary.department') == $department->id ? 'selected' : '' }}>
                                        {{ $department->department }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="month" name="month" class="form-control" value="{{ Session('salary.month') }}">
                        </td>
                        <td>
                            <a class='btn btn-outline-primary' href='{{ url('admin/salary') }}' id='search_btn'>
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </a>
                            <a href="{{ route('admin.salary') }}" class="btn btn-outline-dark">Thoát</a>
                        </td>
                    </form>
                </tr>
            </tbody>
        </table>

        {{-- Kết quả tìm kiếm --}}
        <div id="pagination_data">
            @include('admin.salary.recycle_bin_page_data', [
                'salarys' => $salarys,
            ])
        </div>

    </div>

    {{-- Xác nhận khôi phục lương --}}
    <script>
        function confirmRestore() {
            if (confirm("Khôi phục lại lương tháng của nhân viên này ?") == true) {
                return true;
            } else {
                return false;
            }
        }
    </script>

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
