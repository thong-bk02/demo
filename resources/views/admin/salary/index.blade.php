@extends('layouts.app')

@section('title')
    <title>Quản lí lương</title>
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/users/btn-clear-value-input.css') }}">
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
                            <div class="form-group">
                                <select class="form-control" name="position">
                                    <option value="">tất cả</option>
                                    @foreach ($positions as $position)
                                        <option value="{{ $position->id }}"
                                            {{ Session('salary.position') == $position->id ? 'selected' : '' }}>
                                            {{ $position->position_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <select class="form-control" name="department">
                                    <option value="">tất cả</option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}"
                                            {{ Session('salary.department') == $department->id ? 'selected' : '' }}>
                                            {{ $department->department }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </td>
                        <td>
                            <input type="month" name="month" class="form-control"
                                value="{{ Session('salary.month') }}">
                        </td>
                        <td>
                            <a class='btn btn-primary' href='{{ url('admin/salary') }}' id='search_btn'>
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </a>
                            <a href="{{ route('admin.salary.list') }}" class="btn btn-primary">Thêm Lương</a>
                        </td>
                    </form>
                </tr>
            </tbody>
        </table>

        {{-- Kết quả tìm kiếm --}}
        <div id="pagination_data">
            @include('admin.salary.index_page_data', [
                'salarys' => $salarys,
            ])
        </div>

    </div>
    <script>
        function confirmDelete() {
            if (confirm("xóa lương nhân viên này ?") == true) {
                return true;
            } else {
                return false;
            }
        }
    </script>

    @if (blank(session('salary')))
    @else
        <script>
            $(function() {
                var page = '{{ Session('salary.page') }}';
                if (page == "") {
                    var finalURL = "salary?" + $("#searchform").serialize();
                } else {
                    var finalURL = "salary?page=" + page + "&" + $("#searchform").serialize();
                }

                $.get(finalURL, function(data) {
                    $("#pagination_data").html(data);
                });
                return false;
            });
        </script>
    @endif

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
