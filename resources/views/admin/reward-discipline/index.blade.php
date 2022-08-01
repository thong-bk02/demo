@extends('layouts.app')

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
                    <th scope="col">Ngày phạt</th>
                    <th scope="col">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <form id="searchform" name="searchform" method="post">
                        <td>
                            <span class="deleteicon w-100">
                                <input type="text" name="name" id="search_name" placeholder="Họ và tên"
                                    value="{{ Session('reward_and_discipline.name') }}" class="form-control"
                                    autocomplete="off">
                                <span
                                    onclick="var input = this.previousElementSibling; input.value = ''; input.focus();">X</span>
                            </span>
                        </td>
                        <td>
                            <select class="form-control" name="position" id="position">
                                <option value="">tất cả</option>
                                @foreach ($positions as $position)
                                    <option value="{{ $position->id }}"
                                        {{ Session('reward_and_discipline.position') == $position->id ? 'selected' : '' }}>
                                        {{ $position->position_name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="form-control" name="department" id="department">
                                <option value="">tất cả</option>
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}"
                                        {{ Session('reward_and_discipline.department') == $department->id ? 'selected' : '' }}>
                                        {{ $department->department }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="date" name="date_created" class="form-control"
                                value="{{ Session('reward_and_discipline.date_created') }}">
                        </td>
                        <td style="width: 25vw;">
                            <a class='btn btn-primary' href='{{ url('admin/reward-discipline') }}' id='search_btn'>
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </a>
                            <a href="{{ route('admin.reward-discipline.list') }}" class="btn btn-primary">
                                Thêm Thưởng phạt</a>
                            <a href="{{ route('admin.reasion') }}" class="btn btn-primary">
                                Quyết định</a>
                        </td>
                    </form>
                </tr>
            </tbody>
        </table>

        {{-- Kết quả tìm kiếm --}}
        <div id="pagination_data">
            @include('admin.reward-discipline.index_page_data', [
                'reward_and_disciplines' => $reward_and_disciplines,
            ])
        </div>
    </div>
    <script>
        function confirmDelete() {
            if (confirm("xóa quyết định này ?") == true) {
                return true;
            } else {
                return false;
            }
        }
    </script>

    @if (blank(session('reward_and_discipline')))
    @else
        <script>
            $(function() {
                var page = '{{ Session('reward_and_discipline.page') }}';
                if (page == "") {
                    var finalURL = "reward-discipline?" + $("#searchform").serialize();
                } else {
                    var finalURL = "reward-discipline?page=" + page + "&" + $("#searchform").serialize();
                }

                $.get(finalURL, function(data) {
                    $("#pagination_data").html(data);
                });
                return false;
            });
        </script>
    @endif

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
