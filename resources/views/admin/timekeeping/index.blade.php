@extends('layouts.app')

@section('title')
    <title>Quản lí chấm công</title>
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/users/btn-clear-value-input.css') }}">
    <link rel="stylesheet" href="{{ asset('css/input-file.css') }}">
@endsection

@section('content')
    <div class="container">
        {{-- Thông báo --}}
        @include('layouts.message')

        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Tên nhân viên</th>
                    <th scope="col">Chức vụ</th>
                    <th scope="col">Phòng ban</th>
                    <th scope="col">Tháng công</th>
                    <th scope="col">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <form id="searchform" name="searchform">
                        @csrf
                        <td>
                            <span class="deleteicon w-100">
                                <input type="text" name="name" id="search_name" placeholder="Họ và tên"
                                    value="{{ Session('timekeeping.name') }}" class="form-control" autocomplete="off">
                                <span
                                    onclick="var input = this.previousElementSibling; input.value = ''; input.focus();">X</span>
                            </span>
                        </td>
                        <td>
                            <select class="form-control" name="position" id="position">
                                <option value="">tất cả</option>
                                @foreach ($positions as $position)
                                    <option value="{{ $position->id }}"
                                        {{ Session('timekeeping.position') == $position->id ? 'selected' : '' }}>
                                        {{ $position->position_name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="form-control" name="department" id="department">
                                <option value="">tất cả</option>
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}"
                                        {{ Session('timekeeping.department') == $department->id ? 'selected' : '' }}>
                                        {{ $department->department }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="month" name="month" class="form-control"
                                value="{{ session('timekeeping.month') }}">
                        </td>
                        <td style="width: 25vw;">
                            <a class='btn btn-primary' href='{{ url('admin/timekeeping') }}' id='search_btn'>
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </a>
                            <a href="{{ route('admin.timekeeping.list') }}" class="btn btn-primary">
                                <i class="fa-solid fa-plus"></i>
                            </a>
                            <a class="btn btn-outline-primary float-end"
                                href="{{ route('admin.timekeeping.export') }}">Xuất excel</a>
                            <a class="btn btn-outline-primary float-end" href="" data-toggle="modal"
                                data-target="#exampleModal">Cập nhật</a>

                        </td>
                    </form>
                </tr>
            </tbody>
        </table>
       
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="{{ route('admin.timekeeping.import') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Cập nhật thông tin chấm công</h5>
                        </div>
                        <div class="modal-body">
                            <input type="file" class="" id="customFile" name="cham_cong" accept=".xlsx, .xls, .csv"
                                required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                            <input type="submit" value="Tải lên" class="btn btn-primary">
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- Kết quả tìm kiếm --}}
        <div id="pagination_data">
            @include('admin.timekeeping.pagination_data', ['timekeepings' => $timekeepings])
        </div>

    </div>

    <script>
        function confirmDelete() {
            if (confirm("xóa bảng chấm công này ?") == true) {
                return true;
            } else {
                return false;
            }
        }
    </script>

    <script>
        $(function() {
            $(document).on("click", "#pagination a,#search_btn", function() {
                var url = $(this).attr("href");
                var append = url.indexOf("?") == -1 ? "?" : "&";
                var finalURL = url + append + $("#searchform").serialize();

                $.get(finalURL, function(data) {
                    $("#pagination_data").html(data);
                });
                return false;
            })

        });
    </script>

    @if (blank(session('timekeeping')))
    @else
        <script>
            $(function() {
                var page = '{{ Session('timekeeping.page') }}';
                if (page == "") {
                    var finalURL = "timekeeping?" + $("#searchform").serialize();
                } else {
                    var finalURL = "timekeeping?page=" + page + "&" + $("#searchform").serialize();
                }

                $.get(finalURL, function(data) {
                    $("#pagination_data").html(data);
                });
                return false;
            });
        </script>
    @endif
@endsection
