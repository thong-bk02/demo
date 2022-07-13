@extends('layouts.app')

@section('content')
    <div class="container">
        {{-- Thông báo --}}
        @include('layouts.message')

        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Tên nhân viên</th>
                    <th scope="col">Tháng công</th>
                    <th scope="col">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <form id="searchform" name="searchform">
                        @csrf
                        <td>
                            <input type="text" name="name" class="form-control"
                                value="{{ session('timekeeping.name') }}" required>
                        </td>
                        <td>
                            <input type="month" name="month" class="form-control"
                                value="{{ session('timekeeping.month') }}" required>
                        </td>
                        <td>
                            <a class='btn btn-primary' href='{{ url('admin/timekeeping') }}' id='search_btn'>
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </a>
                            <a href="" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">Thêm
                                chấm công</a>
                            <a class="btn btn-warning float-end" href="{{ route('admin.timekeeping.export') }}">Xuất
                                file</a>

                        </td>
                    </form>
                    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('admin.timekeeping.store') }}" method="post">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Thêm chấm công</h5>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <select class="form-control" name="user_id" id="user_id">
                                                <option value="">Nhân sự</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}">
                                                        {{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="from_date">Ngày bắt đầu</label>
                                            <input type="date" class="form-control" name="from_date" value="">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="submit" class="btn btn-primary" value="Lưu">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </tr>
            </tbody>
        </table>

        {{-- Kết quả tìm kiếm --}}
        <div id="pagination_data">
            @include('admin.timekeeping.pagination_data', ['timekeepings' => $timekeepings])
        </div>

    </div>

    {{-- <form action="{{ route('admin.timekeeping.import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" class="form-control">
        <br>
        <button class="btn btn-success">Import Data</button>
    </form> --}}

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
