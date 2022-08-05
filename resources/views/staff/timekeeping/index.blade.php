@extends('staff.layouts.app')

@section('title')
    <title>Thông tin chấm công</title>
@endsection

@section('content')
    <div class="container">
        <h2 class="mb-4">
            Chấm công
        </h2>
        @foreach ($user_info as $user)
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col" colspan="7">Tên nhân viên : {{ $user->name }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th style="width: 10rem;">Chức vụ</th>
                        <td>{{ $user->position_name }}</td>
                        <td></td>
                        <th style="width: 10rem;">Phòng ban</th>
                        <td>{{ $user->department }}</td>
                        <td></td>
                        <th>
                            Tháng công:
                            <form id="searchform" name="searchform" method="post">
                                <input type="month" name="month" id="month" class="form-control" value="{{ date('Y-m') }}">
                                <a href='{{ url('timekeeping') }}' id='search_btn'></a>
                            </form>
                        </th>
                    </tr>
                </tbody>
            </table>
        @endforeach

        <div id="data"></div>
    </div>

    <script>
        $(function() {
            var url = $("#search_btn").attr("href");
            var finalURL = url + "?" + $("#searchform").serialize();
            $.get(finalURL, function(data) {
                $("#data").html(data);
            });

            $(document).on("change", "#month", function() {
                var url = $("#search_btn").attr("href");
                var finalURL = url + "?" + $("#searchform").serialize();

                event.preventDefault();
                $.get(finalURL, function(data) {
                    $("#data").html(data);
                });
                return false;
            })

        });
    </script>
@endsection
